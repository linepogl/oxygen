<?php

abstract class Scope implements ArrayAccess /*, Countable, IteratorAggregate*/ {
	const APC = 1;
	const HDD = 2;

	/** @var HybridScope */ public static $APPLICATION;
	/** @var HybridScope */ public static $DATABASE;
	/** @var HybridScope */ public static $SESSION;
	/** @var HybridScope */ public static $WINDOW;
	/** @var MemoryScope */ public static $REQUEST;

	protected static $base = '';
	protected static $is_apc_available = false;
	public static function IsAPCAvailable(){
		return function_exists('apc_add') && function_exists('apc_exists'); // because apc_exists was added later on, in 3.1.4
	}
	public static function InitScopes(){
		self::$is_apc_available = self::IsAPCAvailable();
		self::$base = '';
		if (isset($_SERVER["SERVER_NAME"])) self::$base .= $_SERVER["SERVER_NAME"];
		if (isset($_SERVER["SERVER_PORT"])) self::$base .= '.'.$_SERVER["SERVER_PORT"];
		self::$base .= __BASE__;
		Scope::$APPLICATION = new HybridScope( new ApplicationApcScope(), new ApplicationHddScope() );
		Scope::$DATABASE    = new HybridScope( new DatabaseApcScope(), new DatabaseHddScope() );
		Scope::$SESSION     = new HybridScope( new SessionApcScope(), new SessionHddScope() );
		Scope::$WINDOW      = new HybridScope( new WindowApcScope(), new WindowHddScope() );
		Scope::$REQUEST     = new RequestScope();
	}
	public static function ResetScopes(){
		if (self::$is_apc_available){
			Debug::Write('Cleaning APC user cache...');
			apc_clear_cache('user');
			Debug::Write('Cleaning APC system cache...');
			apc_clear_cache();
		}
		Debug::Write('Cleaning APPLICATION scope...');
		Scope::$APPLICATION->Reset();
		Debug::Write('Cleaning DATABASE scope...');
		Scope::$DATABASE->Reset();
		Debug::Write('Cleaning SESSION scope...');
		Scope::$SESSION->Reset();
		Debug::Write('Cleaning WINDOW scope...');
		Scope::$WINDOW->Reset();
		Debug::Write('Cleaning REQUEST scope...');
		Scope::$REQUEST->Reset();
	}

	protected $prefix;
	protected function __construct($prefix){ $this->prefix = $prefix; }

	public abstract function ForceGet($offset);
	public function Contains($key){ return $this->offsetExists($key); }

	public abstract function Reset();
	public abstract function SoftReset();
}








abstract class MemoryScope extends Scope {
	protected $data = array();
	protected abstract function Hash($name);
	public function Reset(){ $this->SoftReset(); }
	public function SoftReset(){ $this->data = array(); }
	public function offsetExists($offset) {
		$key = $this->Hash($offset);
		return isset($this->data[$key]);
	}
	public function offsetGet($offset) {
		$key = $this->Hash($offset);
		if (isset($this->data[$key]))
			return $this->data[$key];
		else
			return null;
	}
	public function offsetSet($offset, $value) {
		if ($offset == null) throw new Exception('All variables should be named.');
		$key = $this->Hash($offset);
		$this->data[$key] = $value;
	}
	public function offsetUnset($offset) {
		$key = $this->Hash($offset);
		unset($this->data[$key]);
	}
	public function ForceGet($offset){
		$key = $this->Hash($offset);
		if (isset($this->data[$key]))
			return $this->data[$key];
		else
			return null;
	}
}



abstract class ApcScope extends MemoryScope {
	private $use_apc_storage = true;
	public function SetUseApcStorage($value){ $this->use_apc_storage = $value; }
	public function Reset(){
		if ($this->use_apc_storage) {
			apc_clear_cache('user');
		}
		$this->SoftReset();
	}
	public function offsetExists($offset) {
		$key = $this->Hash($offset);
		if (isset($this->data[$key]))
			return true;
		elseif ($this->use_apc_storage)
			return apc_exists($key);
		else
			return false;
	}
	public function offsetGet($offset) {
		$key = $this->Hash($offset);
		if (isset($this->data[$key]))
			return $this->data[$key];
		elseif ($this->use_apc_storage && apc_exists($key)) {
			$this->data[$key] = apc_fetch($key);
			return $this->data[$key];
		}
		else
			return null;
	}
	public function offsetSet($offset, $value) {
		if ($offset == null) throw new Exception('All variables should be named.');
		$key = $this->Hash($offset);
		$this->data[$key] = $value;
		if ($this->use_apc_storage){
			if (is_null($value))
				apc_delete($key);
			else
				apc_store($key,$value);
		}
	}
	public function offsetUnset($offset) {
		$key = $this->Hash($offset);
		unset($this->data[$key]);
		if ($this->use_apc_storage) {
			apc_delete($key);
		}
	}
	public function ForceGet($offset) {
		$key = $this->Hash($offset);
		if ($this->use_apc_storage){
			if (apc_exists($key)) {
				$this->data[$key] = apc_fetch($key);
				return $this->data[$key];
			}
			else {
				$this->data[$key] = null;
				return null;
			}
		}
		elseif (isset($this->data[$key]))
			return $this->data[$key];
		else
			return null;
	}
}




abstract class HddScope extends MemoryScope {
	protected $folder = null;
	private $use_hdd_storage = true;
	public function SetUseHddStorage($value){ $this->use_hdd_storage = $value; }
	public function GetFolder(){ if (is_null($this->folder)) return Oxygen::GetTempFolder(); return $this->folder; }
	public function SetFolder($value){
		$this->folder = $value;
		if (!is_null($this->folder)) if (!file_exists($this->folder)) mkdir($this->folder,0777,true);
		$this->SoftReset();
	}
	public function Reset(){
		if ($this->use_hdd_storage){
			$f = $this->GetFolder();
			foreach (scandir($f.'/'.$this->prefix.'_*') as $ff){
				if (is_dir($f)) continue;
				try{ unlink($f.'/'.$ff); } catch(Exception $ex){}
			}
		}
		$this->SoftReset();
	}
	protected function get_filename($key){
		return $this->GetFolder() . '/' . $key . '.object';
	}
	private function hdd_unset($filename){
		if (file_exists($filename))
			unlink($filename);
	}
	private function hdd_store($filename,$object){
		$f = fopen($filename,'w');
		if (flock($f,LOCK_EX)){
			fwrite($f,serialize($object));
			flock($f,LOCK_UN);
			fclose($f);
		}
	}
	private function hdd_fetch($filename){
		$r = null;
		$f = fopen($filename,'r');
		if (flock($f,LOCK_SH)){
			$size = filesize($filename);
			if ($size > 0) {
				try {
					$r = unserialize(fread($f, $size));
				}
				catch(Exception $ex){}
			}
			flock($f,LOCK_UN);
		}
		fclose($f);
		return $r;
	}
	public function offsetExists($offset) {
		$key = $this->Hash($offset);
		if (isset($this->data[$key]))
			return true;
		elseif ($this->use_hdd_storage)
			return file_exists($this->get_filename($key));
		else
			return false;
	}
	public function offsetGet($offset) {
		$key = $this->Hash($offset);
		if (isset($this->data[$key]))
			return $this->data[$key];
		elseif ($this->use_hdd_storage){
			$filename = $this->get_filename($key);
			if (file_exists($filename)) {
				$this->data[$key] = $this->hdd_fetch($filename);
				return $this->data[$key];
			}
		}
		return null;
	}
	public function offsetSet($offset, $value) {
		if ($offset == null) throw new Exception('All variables should be named.');
		$key = $this->Hash($offset);
		$this->data[$key] = $value;
		if ($this->use_hdd_storage){
			$filename = $this->get_filename($key);
			if (is_null($value))
				$this->hdd_unset($filename);
			else
				$this->hdd_store($filename,$value);
		}
	}
	public function offsetUnset($offset) {
		$key = $this->Hash($offset);
		unset($this->data[$key]);
		if ($this->use_hdd_storage){
			$filename = $this->get_filename($key);
			$this->hdd_unset($filename);
		}
	}
	public function ForceGet($offset) {
		$key = $this->Hash($offset);
		if ($this->use_hdd_storage){
			$filename = $this->get_filename($key);
			if (file_exists($filename)) {
				$this->data[$key] = $this->hdd_fetch($filename);
				return $this->data[$key];
			}
			else {
				$this->data[$key] = null;
				return null;
			}
		}
		elseif (isset($this->data[$key]))
			return $this->data[$key];
		else
			return null;
	}
}



class HybridScope extends Scope {
	private $mode;
	/** @var Scope */ private $scope;
	/** @var ApcScope */ private $SOFT;
	/** @var HddScope */ public  $HARD;
	protected function __construct(ApcScope $soft_scope, HddScope $hard_scope){
		parent::__construct($soft_scope->prefix);
		$this->SOFT = $soft_scope;
		$this->HARD = $hard_scope;
		$this->SetMode( self::APC );
	}
	public function GetMode(){ return $this->mode; }
	public function GetModeTranslated(){ return $this->mode == self::APC ? 'APC' : 'HDD'; }
	public function SetUseExternalStorage($value){
		$this->SOFT->SetUseApcStorage($value);
		$this->HARD->SetUseHddStorage($value);
	}
	public function SetMode( $value ) {
		if ($value == self::APC && self::$is_apc_available) {
			$this->mode = self::APC;
			$this->scope = $this->SOFT;
		}
		else {
			$this->mode = self::HDD;
			$this->scope = $this->HARD;
		}
	}

	public function offsetExists($offset)      { return $this->scope->offsetExists($offset); }
	public function offsetGet($offset)         { return $this->scope->offsetGet($offset); }
	public function offsetSet($offset, $value) { $this->scope->offsetSet($offset, $value); }
	public function offsetUnset($offset)       { $this->scope->offsetUnset($offset); }

	public function Hash($name)       { return $this->scope->Hash($name); }
	public function ForceGet($offset) { return $this->scope->ForceGet($offset); }

	public function SoftReset(){
		$this->SOFT->SoftReset();
		$this->HARD->SoftReset();
	}
	public function Reset() {
		$this->SOFT->Reset();
		$this->HARD->Reset();
	}
}





class ApplicationApcScope extends ApcScope  {
	public function __construct(){ parent::__construct('app'); }
	protected function Hash($name){ return $this->prefix.'_'.self::$base.'_'.$name; }
}
class ApplicationHddScope extends HddScope  {
	public function __construct(){ parent::__construct('app'); }
	protected function Hash($name){ return $this->prefix.'_'.Oxygen::Hash32(self::$base.$name); }
}

class DatabaseApcScope extends ApcScope  {
	public function __construct(){ parent::__construct('dat'); }
	protected function Hash($name){ return $this->prefix.'_'.self::$base.'_'.Database::GetServer().'_'.Database::GetSchema().'_'.$name; }
}
class DatabaseHddScope extends HddScope  {
	public function __construct(){ parent::__construct('dat'); }
	protected function Hash($name){ return $this->prefix.'_'.Oxygen::Hash32(self::$base.$name.Database::GetServer().Database::GetSchema()); }
}

class SessionApcScope extends ApcScope {
	public function __construct(){ parent::__construct('ses'); }
	protected function Hash($name){ return $this->prefix.'_'.self::$base.'_'.Oxygen::GetSessionHash().'_'.$name; }
}
class SessionHddScope extends HddScope {
	public function __construct(){ parent::__construct('ses'); }
	protected function Hash($name){ return $this->prefix.'_'.Oxygen::Hash32(self::$base.$name.Oxygen::GetSessionHash()); }
}

class WindowApcScope extends ApcScope {
	public function __construct(){ parent::__construct('win'); }
	protected function Hash($name){ return $this->prefix.'_'.self::$base.'_'.Oxygen::GetWindowHash() . '_' . $name; }
}
class WindowHddScope extends HddScope {
	public function __construct(){ parent::__construct('win'); }
	protected function Hash($name){ return $this->prefix.'_'.Oxygen::Hash32(self::$base.$name.Oxygen::GetWindowHash() ); }
}

class RequestScope extends MemoryScope {
	public function __construct(){ parent::__construct('req'); }
	protected function Hash($name){ return $this->prefix.'_'.self::$base.'_'.$name; }
}

Scope::InitScopes();


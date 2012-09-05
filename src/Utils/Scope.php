<?php

abstract class Scope implements ArrayAccess,IteratorAggregate {
	const APC = 0x00;
	const HDD = 0x01;
	const HDD_SHARED = 0x11;
	const MEMCACHED = 0x02;
	const MEMCACHED_SHARED = 0x12;


	/** @var HybridScope */ public static $APPLICATION;
	/** @var HybridScope */ public static $DATABASE;
	/** @var HybridScope */ public static $SESSION;
	/** @var HybridScope */ public static $WINDOW;
	/** @var MemoryScope */ public static $REQUEST;

	protected static $base = '';
	protected static $is_memcached_initialised = false;
	/** @var Memcached */
	protected static $memcached = null;

	private static $memcached_servers = array('localhost:11211');
	public static function SetMemcachedServer( $server ){
		self::$memcached_servers = array($server);
	}
	public static function SetMemcachedServers( $servers ){
		self::$memcached_servers = $servers;
	}
	protected static function InitMemcached(){
		if (!IS_MEMCACHED_AVAILABLE) return;
		if (self::$is_memcached_initialised) return;
		self::$memcached = new Memcached();
		self::$memcached->setOption(Memcached::OPT_COMPRESSION,true);
		self::$memcached->setOption(Memcached::OPT_NO_BLOCK,true);
		foreach (self::$memcached_servers as $s){
			$a = explode(':',$s);
			$host = $a[0];
			$port = count($a) > 1 ? $a[1] : '11211';
			self::$memcached->addServer( $host , $port );
		}
		self::$is_memcached_initialised = true;
	}
	public static function InitScopes(){
		self::$base = '';
		if (isset($_SERVER["SERVER_NAME"])) self::$base .= $_SERVER["SERVER_NAME"];
		//if (isset($_SERVER["SERVER_PORT"])) self::$base .= ':'.$_SERVER["SERVER_PORT"];
		self::$base .= __BASE__;
		Scope::$APPLICATION = new HybridScope( new ApplicationHddScope() , new ApplicationApcScope() , new ApplicationMemcachedScope() );
		Scope::$DATABASE    = new HybridScope( new DatabaseHddScope() , new DatabaseApcScope() , new DatabaseMemcachedScope() );
		Scope::$SESSION     = new HybridScope( new SessionHddScope() , new SessionApcScope() , new SessionMemcachedScope() );
		Scope::$WINDOW      = new HybridScope( new WindowHddScope() , new WindowApcScope() , new WindowMemcachedScope() );
		Scope::$REQUEST     = new RequestScope();
	}
	public static function ResetScopes(){
		if (IS_APC_AVAILABLE){
			Debug::Write('Cleaning APC user cache...');
			apc_clear_cache('user');
			Debug::Write('Cleaning APC system cache...');
			apc_clear_cache();
		}
		if (IS_MEMCACHED_AVAILABLE){
			Scope::InitMemcached();
			Debug::Write('Cleaning Memcached...');
			self::$memcached->flush();
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


	public function GetIterator(){ throw new NonImplementedException(); }

	protected function SimpleOffsetGet( $offset ) { return $this->OffsetGet($offset); }
	protected function SimpleOffsetSet( $offset , $value ) { $this->OffsetSet($offset,$value); }
	protected function SimpleOffsetUnset( $offset ) { $this->OffsetUnset($offset); }
	private function LinkedListRemove($offset){
		$prev_offset = $this->SimpleOffsetGet( $offset . ':prev' );
		$next_offset = $this->SimpleOffsetGet( $offset . ':next' );
		$this->SimpleOffsetSet( is_null($prev_offset) ? ':head' : $prev_offset . ':next' , $next_offset );
		if (!is_null($next_offset)) $this->SimpleOffsetSet( $next_offset . ':prev' , $prev_offset );
		$this->SimpleOffsetUnset( $offset . ':prev' );
		$this->SimpleOffsetUnset( $offset . ':next' );
	}
	private function LinkedListInsert($offset){
		$curr_offset = null;
		$next_offset = $this->SimpleOffsetGet(':head');
		while (!is_null($next_offset)) {
			$curr_offset = $next_offset;
			$next_offset = $this->SimpleOffsetGet( $curr_offset . ':next' );
			if ($curr_offset === $next_offset) throw new Exception('Linked list error.');
		}
		if (is_null($curr_offset)) {
			$this->SimpleOffsetSet( ':head' , $offset );
		}
		else {
			$this->SimpleOffsetSet( $curr_offset . ':next' , $offset );
			$this->SimpleOffsetSet( $offset . ':prev' , $curr_offset );
		}
	}
	protected function LinkedListSet($offset,$value){
		if ($this->OffsetExists($offset)) {
			if (is_null($value)) {
				$this->LinkedListRemove($offset);
			}
		}
		elseif (!is_null($value)) {
			$this->LinkedListInsert($offset);
		}
	}
	protected function LinkedListUnset($offset) {
		if ($this->OffsetExists($offset)) {
			$this->LinkedListRemove( $offset );
		}
	}
}

class ScopeIterator implements Iterator {
	private $scope = null;
	private $offset = null;
	public function __construct( Scope $scope ){ $this->scope = $scope; $this->Rewind(); }
	public function Current() { return $this->scope[$this->offset]; }
	public function Next() { $this->offset = $this->scope[ $this->offset.':next' ]; }
	public function Key() { return $this->offset; }
	public function Valid() { return !is_null($this->offset); }
	public function Rewind() { $this->offset = $this->scope[ ':head' ]; }
}







abstract class MemoryScope extends Scope {
	protected $data = array();
	protected abstract function Hash($name);
	public function Reset(){ $this->SoftReset(); }
	public function SoftReset(){ $this->data = array(); }
	public function OffsetExists($offset) {
		$key = $this->Hash($offset);
		return isset($this->data[$key]);
	}
	public function OffsetGet($offset) {
		$key = $this->Hash($offset);
		if (isset($this->data[$key]))
			return $this->data[$key];
		else
			return null;
	}
	public function OffsetSet($offset, $value) {
		if ($offset == null) throw new Exception('All variables should be named.');
		$key = $this->Hash($offset);
		$this->data[$key] = $value;
	}
	public function OffsetUnset($offset) {
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
	protected $use_apc_storage;
	public function __construct( $prefix ){
		parent::__construct($prefix);
		$this->use_apc_storage = IS_APC_AVAILABLE;
	}
	public function SetUseApcStorage($value){ $this->use_apc_storage = $value && IS_APC_AVAILABLE; }
	public function Reset(){
		if ($this->use_apc_storage) {
			apc_clear_cache('user');
		}
		$this->SoftReset();
	}
	public function OffsetExists($offset) {
		$key = $this->Hash($offset);
		if (isset($this->data[$key]))
			return true;
		elseif ($this->use_apc_storage)
			return apc_exists($key);
		else
			return false;
	}
	public function OffsetGet($offset) {
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
	public function OffsetSet($offset, $value) {
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
	public function OffsetUnset($offset) {
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


abstract class LinkedListApcScope extends ApcScope {
	public function GetIterator(){ return new ScopeIterator($this); }
	protected function SimpleOffsetGet($offset){ return parent::OffsetGet($offset); }
	protected function SimpleOffsetSet($offset,$value){ parent::OffsetSet($offset,$value); }
	protected function SimpleOffsetUnset($offset){ parent::OffsetUnset($offset); }
	public function OffsetSet($offset, $value) {
		if ($this->use_apc_storage) $this->LinkedListSet($offset,$value);
		parent::OffsetSet( $offset , $value );
	}
	public function OffsetUnset($offset) {
		if ($this->use_apc_storage) $this->LinkedListUnset($offset);
		parent::OffsetUnset($offset);
	}
}




abstract class MemcachedScope extends MemoryScope {
	protected $use_memcached_storage;
	public function __construct( $prefix ){
		parent::__construct($prefix);
		$this->use_memcached_storage = IS_MEMCACHED_AVAILABLE;
	}
	public function SetUseMemcachedStorage($value){ $this->use_memcached_storage = $value && IS_MEMCACHED_AVAILABLE; }
	public function Reset(){
		if ($this->use_memcached_storage) {
			self::$memcached->flush();
		}
		$this->SoftReset();
	}
	public function OffsetExists($offset) {
		$key = $this->Hash($offset);
		if (isset($this->data[$key]))
			return true;
		elseif ($this->use_memcached_storage) {
			$r = self::$memcached->get( $key );
			if (self::$memcached->getResultCode() === Memcached::RES_NOTFOUND) {
				$this->data[$key] = null;
				return false;
			}
			else {
				$this->data[$key] = $r;
				return true;
			}
		}
		else
			return false;
	}
	public function OffsetGet($offset) {
		$key = $this->Hash($offset);
		if (isset($this->data[$key]))
			return $this->data[$key];
		elseif ($this->use_memcached_storage) {
			$r = self::$memcached->get( $key );
			if (self::$memcached->getResultCode() === Memcached::RES_NOTFOUND) {
				$this->data[$key] = null;
				return null;
			}
			else {
				$this->data[$key] = $r;
				return $r;
			}
		}
		else
			return null;
	}
	public function OffsetSet($offset, $value) {
		if ($offset == null) throw new Exception('All variables should be named.');
		$key = $this->Hash($offset);
		$this->data[$key] = $value;
		if ($this->use_memcached_storage){
			if (is_null($value))
				self::$memcached->delete( $key );
			else
				self::$memcached->set( $key , $value , 86400 ); // one day
		}
	}
	public function OffsetUnset($offset) {
		$key = $this->Hash($offset);
		unset($this->data[$key]);
		if ($this->use_memcached_storage) {
			self::$memcached->delete( $key );
		}
	}
	public function ForceGet($offset) {
		$key = $this->Hash($offset);
		if ($this->use_memcached_storage){
			$r = self::$memcached->get( $key );
			if (self::$memcached->getResultCode() !== Memcached::RES_NOTFOUND) {
				$this->data[$key] = $r;
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
abstract class LinkedListMemcachedScope extends MemcachedScope {
	public function GetIterator(){ return new ScopeIterator($this); }
	protected function SimpleOffsetGet($offset){ return parent::OffsetGet($offset); }
	protected function SimpleOffsetSet($offset,$value){ parent::OffsetSet($offset,$value); }
	protected function SimpleOffsetUnset($offset){ parent::OffsetUnset($offset); }
	public function OffsetSet($offset, $value) {
		if ($this->use_memcached_storage) $this->LinkedListSet($offset,$value);
		parent::OffsetSet( $offset , $value );
	}
	public function OffsetUnset($offset) {
		if ($this->use_memcached_storage) $this->LinkedListUnset($offset);
		parent::OffsetUnset($offset);
	}
}




abstract class HddScope extends MemoryScope {
	protected $shared = false;
	protected $use_hdd_storage = true;
	public function SetUseHddStorage($value){ $this->use_hdd_storage = $value; }
	public function GetFolder(){ return $this->shared ? Oxygen::GetSharedTempFolder() : Oxygen::GetTempFolder(); }
	public function SetIsShared($value){
		$this->shared = $value;
		$this->SoftReset();
	}
	public function Reset(){
		if ($this->use_hdd_storage){
			$f = $this->GetFolder();
			$a = glob($f.'/'.$this->prefix.'_*');
			if (is_array($a)){
				foreach ($a as $ff){
					if (is_dir($ff)) continue;
					try{ unlink($ff); } catch(Exception $ex){}
				}
			}
		}
		$this->SoftReset();
	}
	protected function get_filename($key){
		return $this->GetFolder() . '/' . $key . '.object';
	}
	private function hdd_unset($filename){
		if (file_exists($filename)) {
			try{ unlink($filename); } catch(Exception $ex){}
		}
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
		if (file_exists($filename)) {
			try { $f = fopen($filename,'r'); } catch (Exception $ex){ $f = null; }
			if (!is_null($f)){
				if (flock($f,LOCK_SH)){
					try {
						$size = filesize($filename);
						if ($size > 0) $r = unserialize(fread($f, $size));
					}
					catch(Exception $ex){}
					flock($f,LOCK_UN);
				}
				fclose($f);
			}
		}
		return $r;
	}
	public function OffsetExists($offset) {
		$key = $this->Hash($offset);
		if (isset($this->data[$key]))
			return true;
		elseif ($this->use_hdd_storage)
			return file_exists($this->get_filename($key));
		else
			return false;
	}
	public function OffsetGet($offset) {
		$key = $this->Hash($offset);
		if (isset($this->data[$key]))
			return $this->data[$key];
		elseif ($this->use_hdd_storage){
			$filename = $this->get_filename($key);
			$this->data[$key] = $this->hdd_fetch($filename);
			return $this->data[$key];
		}
		return null;
	}
	public function OffsetSet($offset, $value) {
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
	public function OffsetUnset($offset) {
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
			$this->data[$key] = $this->hdd_fetch($filename);
			return $this->data[$key];
		}
		elseif (isset($this->data[$key]))
			return $this->data[$key];
		else
			return null;
	}
}
abstract class LinkedListHddScope extends HddScope {
	public function GetIterator(){ return new ScopeIterator($this); }
	protected function SimpleOffsetGet($offset){ return parent::OffsetGet($offset); }
	protected function SimpleOffsetSet($offset,$value){ parent::OffsetSet($offset,$value); }
	protected function SimpleOffsetUnset($offset){ parent::OffsetUnset($offset); }
	public function OffsetSet($offset, $value) {
		if ($this->use_hdd_storage) $this->LinkedListSet($offset,$value);
		parent::OffsetSet( $offset , $value );
	}
	public function OffsetUnset($offset) {
		if ($this->use_hdd_storage) $this->LinkedListUnset($offset);
		parent::OffsetUnset($offset);
	}
}


class HybridScope extends Scope {
	private $mode;
	/** @var Scope */ public $WEAK;
	/** @var Scope */ public $HARD;

	/** @var ApcScope */ private $apc_scope;
	/** @var HddScope */ private $hdd_scope;
	/** @var MemcachedScope */ private $memcached_scope;

	protected function __construct( HddScope $hdd_scope , ApcScope $apc_scope , MemcachedScope $memcached_scope ){
		parent::__construct($hdd_scope->prefix);
		$this->HARD = $hdd_scope;
		$this->hdd_scope = $hdd_scope;
		$this->apc_scope = $apc_scope;
		$this->memcached_scope = $memcached_scope;
		$this->SetMode( self::APC );
	}
	public function GetMode(){ return $this->mode; }
	public function GetModeTranslated(){
		switch ($this->mode){
			case Scope::APC: return 'APC';
			case Scope::HDD: return 'HDD';
			case Scope::HDD_SHARED: return 'HDD_SHARED';
			case Scope::MEMCACHED: return 'MEMCACHED';
			case Scope::MEMCACHED_SHARED: return 'MEMCACHED_SHARED';
		}
	}
	public function SetUseExternalStorage($value) {
		$this->hdd_scope->SetUseHddStorage($value);
		$this->apc_scope->SetUseApcStorage($value);
		$this->memcached_scope->SetUseMemcachedStorage($value);
	}
	public function SetMode( $value = Scope::APC ) {
		if ($value == Scope::APC && IS_APC_AVAILABLE) {
			$this->mode = $value;
			$this->WEAK = $this->apc_scope;
			$this->HARD->SetIsShared( false );
		}
		elseif (($value == Scope::MEMCACHED || $value == Scope::MEMCACHED_SHARED) && IS_MEMCACHED_AVAILABLE) {
			Scope::InitMemcached();
			$this->mode = $value;
			$this->WEAK = $this->memcached_scope;
			$this->HARD->SetIsShared( $value == Scope::MEMCACHED_SHARED );
		}
		elseif ($value == Scope::HDD_SHARED || $value == Scope::MEMCACHED_SHARED) {
			$this->mode = Scope::HDD_SHARED;
			$this->WEAK = $this->hdd_scope;
			$this->HARD->SetIsShared( true );
		}
		else {
			$this->mode = Scope::HDD;
			$this->WEAK = $this->hdd_scope;
			$this->HARD->SetIsShared( false );
		}
	}

	public function GetIterator(){ return new ScopeIterator($this->WEAK); }

	public function OffsetExists($offset)      { return $this->WEAK->offsetExists($offset); }
	public function OffsetGet($offset)         { return $this->WEAK->offsetGet($offset); }
	public function OffsetSet($offset, $value) { $this->WEAK->offsetSet($offset, $value); }
	public function OffsetUnset($offset)       { $this->WEAK->offsetUnset($offset); }

	public function Hash($name)       { return $this->WEAK->Hash($name); }
	public function ForceGet($offset) { return $this->WEAK->ForceGet($offset); }

	public function SoftReset(){
		$this->hdd_scope->SoftReset();
		$this->apc_scope->SoftReset();
		$this->memcached_scope->SoftReset();
	}
	public function Reset() {
		$this->hdd_scope->Reset();
		$this->apc_scope->Reset();
		$this->memcached_scope->Reset();
	}
}





class ApplicationApcScope extends ApcScope  {
	private $q;
	public function __construct(){ parent::__construct('app'); $this->q = $this->prefix . (IS_IGBINARY_AVAILABLE?'+ig':'') . '[' . self::$base . ']'; }
	protected function Hash($name){ return $this->q.$name; }
}
class ApplicationMemcachedScope extends MemcachedScope  {
	private $q;
	public function __construct(){ parent::__construct('app'); $this->q = $this->prefix . (IS_IGBINARY_AVAILABLE?'+ig':'') . '[' . self::$base . ']'; }
	protected function Hash($name){ return $this->q.$name; }
}
class ApplicationHddScope extends HddScope  {
	private $q;
	public function __construct(){ parent::__construct('app'); $this->q = $this->prefix . (IS_IGBINARY_AVAILABLE?'+ig':'') . '_'; }
	protected function Hash($name){ return $this->q.Oxygen::Hash32(self::$base.$name); }
}

class DatabaseApcScope extends ApcScope  {
	private $q;
	public function __construct(){ parent::__construct('dat'); $this->q = $this->prefix . (IS_IGBINARY_AVAILABLE?'+ig':'') . '['; }
	protected function Hash($name){ return $this->q.Database::GetServer().'/'.Database::GetSchema().']'.$name; }
}
class DatabaseMemcachedScope extends MemcachedScope  {
	private $q;
	public function __construct(){ parent::__construct('dat'); $this->q = $this->prefix . (IS_IGBINARY_AVAILABLE?'+ig':'') . '['; }
	protected function Hash($name){ return $this->q.Database::GetServer().'/'.Database::GetSchema().']'.$name; }
}
class DatabaseHddScope extends HddScope  {
	private $q;
	public function __construct(){ parent::__construct('dat'); $this->q = $this->prefix . (IS_IGBINARY_AVAILABLE?'+ig':'') . '_'; }
	protected function Hash($name){ return $this->q.Oxygen::Hash32($name.Database::GetServer().Database::GetSchema()); }
}

class SessionApcScope extends ApcScope {
	private $q;
	public function __construct(){ parent::__construct('ses'); $this->q = $this->prefix . (IS_IGBINARY_AVAILABLE?'+ig':'') . '[' . self::$base; }
	protected function Hash($name){ return $this->q.Oxygen::GetSessionHash().']'.$name; }
}
class SessionMemcachedScope extends MemcachedScope {
	private $q;
	public function __construct(){ parent::__construct('ses'); $this->q = $this->prefix . (IS_IGBINARY_AVAILABLE?'+ig':'') . '[' . self::$base; }
	protected function Hash($name){ return $this->q.Oxygen::GetSessionHash().']'.$name; }
}
class SessionHddScope extends HddScope {
	private $q;
	public function __construct(){ parent::__construct('ses'); $this->q = $this->prefix . (IS_IGBINARY_AVAILABLE?'+ig':'') . '_'; }
	protected function Hash($name){ return $this->q.Oxygen::Hash32(self::$base.$name.Oxygen::GetSessionHash()); }
}

class WindowApcScope extends LinkedListApcScope {
	private $q;
	public function __construct(){ parent::__construct('win'); $this->q = $this->prefix . (IS_IGBINARY_AVAILABLE?'+ig':'') . '[' . self::$base; }
	protected function Hash($name){ return $this->q.Oxygen::GetWindowHash().']'.$name; }
}
class WindowMemcachedScope extends LinkedListMemcachedScope {
	private $q;
	public function __construct(){ parent::__construct('win'); $this->q = $this->prefix . (IS_IGBINARY_AVAILABLE?'+ig':'') . '[' . self::$base; }
	protected function Hash($name){ return $this->q.Oxygen::GetWindowHash().']'.$name; }
}
class WindowHddScope extends LinkedListHddScope {
	private $q;
	public function __construct(){ parent::__construct('win'); $this->q = $this->prefix . (IS_IGBINARY_AVAILABLE?'+ig':'') . '_'; }
	protected function Hash($name){ return $this->q.Oxygen::Hash32(self::$base.$name.Oxygen::GetWindowHash() ); }
}

class RequestScope extends MemoryScope {
	public function __construct(){ parent::__construct('req'); }
	protected function Hash($name){ return 'req['.self::$base.']'.$name; }
}

Scope::InitScopes();


<?php


class Lemma implements ArrayAccess,IteratorAggregate,Serializable{
	private $name;
	private $data = array();

	public function offsetExists($offset) { return isset($this->data[$offset]); }
	public function offsetGet($offset) { return isset($this->data[$offset]) ? $this->data[$offset] : null; }
	public function offsetSet($offset, $value) { throw new Exception('Lemmas are immutable.'); }
	public function offsetUnset($offset) { throw new Exception('Lemmas are immutable.'); }
	public function getIterator(){ return new ArrayIterator($this->data); }

	//const DELIMETER = '‡';  // I wish...
	const DELIMETER = '~';
	const DEFAULT_NAME = '+';
	private static function escape($string) { return str_replace(self::DELIMETER,'\\'.self::DELIMETER,$string); }
	private static function unescape($string) { return str_replace('\\'.self::DELIMETER,self::DELIMETER,$string); }


	public function serialize(){
		$a = array();
		$a['name'] = $this->name;
		$a['data'] = $this->data;
		return serialize($a);
	}
	public function unserialize($data){
		$a = unserialize($data);
		$this->name = $a['name'];
		$this->data = $a['data'];
	}


	public function HasName(){ return $this->name !== self::DEFAULT_NAME; }
	public function GetName(){ return $this->name; }

	private static function Merge($lemma1, $lemma2){
		$a = array();
		foreach ($lemma1->data as $lang=>$value)
			$a[$lang] = $value;
		foreach ($lemma2->data as $lang=>$value)
			$a[$lang] = $value;
		$r = new Lemma();
		$r->name = $lemma1->name;
		$r->data = $a;
		return $r;
	}


	/*
	 * new Lemma($array)
	 * new Lemma($encoded_string)
	 * new Lemma($lang_value_pairs)
	 */
	public function __construct(){
		$a = func_get_args();
		$z = count($a);
		if ($z==1 && is_array($a[0])) {
			$a = $a[0];
			$z = count($a);
		}
		$this->name = $z%2 == 0 ? self::DEFAULT_NAME : $a[0];
		for ($i = $z%2; $i < $z; $i+=2) $this->data[$a[$i]] = $a[$i+1];
	}

	/**
	 * @return string
	 */
	public function Encode(){
		$r = '';
		if ($this->name != self::DEFAULT_NAME) $r .= $this->name;
		foreach ($this->data as $lang=>$value){
			if ($r != '') $r .= self::DELIMETER;
			$r.=$lang.self::DELIMETER.self::escape($value);
		}
		return $r;
	}

	/**
	 * @param $string string
	 * @return Lemma
	 */
	public static function Decode($string){
		$a = explode(self::DELIMETER,$string);
		$z = count($a);
		for ($i = $z%2; $i < $z; $i+=2) $a[$i+1] = self::unescape($a[$i+1]);
		return new static($a);
	}


	public function TranslateTo($lang){
		if (isset($this->data[$lang])) return $this->data[$lang];
		//if (isset($this->data['en'])) return $this->data['en'];
		return '['.$this->name.'.'.$lang.']';
	}
	public function Translate(){ return $this->TranslateTo(Oxygen::$lang); }
	public function __toString(){ return $this->TranslateTo(Oxygen::$lang); }





	public function IsEmpty(){
		foreach ($this as $value)
			if (trim($value) != '')
				return false;
		return true;
	}
	public function HasAllLanguages(){
		foreach (Oxygen::$langs as $lang)
			if (trim($this[$lang]) == '')
				return false;
		return true;
	}





	public static function __callStatic($name, $arguments) { return Lemma::Retrieve($name); }

	private static $basic_dictionary = array();
	private static $local_dictionary = array();
	private static $current_dictionary = null;
	public static function GetBasicDictionary(){ return self::$basic_dictionary; }
	public static function GetLocalDictionary(){ return self::$local_dictionary; }

	public static function Pick($name){
		return isset(self::$current_dictionary[$name]) ? self::$current_dictionary[$name] : new Lemma($name);
	}
	public static function Retrieve($name){
		return isset(self::$current_dictionary[$name]) ? self::$current_dictionary[$name] : new Lemma($name);
	}
	public static function Sprintf($name){
		$a = func_get_args();
		$a = array_splice($a,1);
		return vsprintf(Lemma::Retrieve($name),$a);
	}




	private static function MakeFileList($files){
		$r = '';
		foreach ($files as $f) if (file_exists($f)) $r .= $f . strval(filemtime($f));
		return $r;
	}

	//
	//
	// Basic Dictionary
	//
	//
	private static function IsBasicDictionaryLoaded($files){
		if (!isset(Scope::$APPLICATION['Lemma::basic_dictionary'])) return false;
		if (!isset(Scope::$APPLICATION['Lemma::basic_dictionary_filelist'])) return false;
		return self::MakeFileList($files) == Scope::$APPLICATION['Lemma::basic_dictionary_filelist'];
	}
	private static function SaveBasicDictionary($files){
		Scope::$APPLICATION['Lemma::basic_dictionary'] = self::$basic_dictionary;
		Scope::$APPLICATION['Lemma::basic_dictionary_filelist'] = self::MakeFileList($files);
	}
	public static function LoadBasicDictionary(){
		$files = Oxygen::GetDictionaryFiles();
    if (self::IsBasicDictionaryLoaded($files))
			self::$basic_dictionary = Scope::$APPLICATION['Lemma::basic_dictionary'];
    else {
			self::$basic_dictionary = array();
			foreach ($files as $f) {
				if (!file_exists($f)) continue;
				$xml = new DOMDocument();
				$xml->load($f);
				foreach ($xml->getElementsByTagName('lemma') as $e) {
					$name = $e->getAttribute('name');
					if (!array_key_exists($name,self::$basic_dictionary)){
						$x = new Lemma();
						$x->name = $name;
						self::$basic_dictionary[$name] = $x;
					}
					$l = self::$basic_dictionary[$name];
					foreach ($e->getElementsByTagName('*') as $ee){
						$l->data[$ee->nodeName] = Oxygen::ReadUnicode( $ee->nodeValue );
					}
				}
			}
			self::SaveBasicDictionary($files);
		}
		self::$current_dictionary =& self::$basic_dictionary;
	}







	//
	//
	// Local Dictionary
	//
	//
	private static function IsLocalDictionaryLoaded($files){
		if (!self::IsBasicDictionaryLoaded($files)) return false;
		if (!isset(Scope::$DATABASE['Lemma::local_dictionary'])) return false;
		if (!isset(Scope::$DATABASE['Lemma::local_dictionary_filelist'])) return false;
		return self::MakeFileList($files) == Scope::$DATABASE['Lemma::local_dictionary_filelist'];
	}
	private static function SaveLocalDictionary($files){
		Scope::$DATABASE['Lemma::local_dictionary'] = self::$local_dictionary;
		Scope::$DATABASE['Lemma::local_dictionary_filelist'] = self::MakeFileList($files);
	}
	public static function ReloadLocalDictionary(){
		Scope::$DATABASE['Lemma::local_dictionary'] = null;
		Scope::$DATABASE['Lemma::local_dictionary_filelist'] = null;
		self::LoadBasicDictionary();
	}
	public static function LoadLocalDictionary(){
		$files = Oxygen::GetDictionaryFiles();
    if (self::IsLocalDictionaryLoaded($files))
			self::$local_dictionary = Scope::$DATABASE['Lemma::local_dictionary'];
    else {
			self::$local_dictionary = array();
			foreach (self::$basic_dictionary as $key=>$value)
				self::$local_dictionary[$key] = $value;
	    /** @var $local_lemma LocalLemma */
			foreach (LocalLemma::Select()->SetIsAggressive(true) as $local_lemma){
				$key = $local_lemma->Name;
				if (array_key_exists($key,self::$local_dictionary))
					self::$local_dictionary[$key] = self::Merge(self::$local_dictionary[$key],$local_lemma->Overlap);
				else
					self::$local_dictionary[$key] = $local_lemma->Overlap;
			}
			self::SaveLocalDictionary($files);
		}
		self::$current_dictionary =& self::$local_dictionary;
	}
	public static function UnloadLocalDictionary(){
		self::$current_dictionary =& self::$basic_dictionary;
	}








}



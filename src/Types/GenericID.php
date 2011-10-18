<?php

class GenericID extends ID implements OmniValue {
	private $classname;

	public function OmniType(){ return OmniGenericID::Type(); }
	public function serialize(){ return serialize(array('classname'=>$this->classname,'value'=>$this->value)); }
	public function unserialize($data){ $a = unserialize($data); $this->classname=$a['classname']; $this->value=$a['value']; }

	public function __construct($classname,$value=null){
		parent::__construct($value);
		$this->classname = $classname;
	}

	public function ToXItem(){
		return XItem::PickGeneric($this->classname,$this);
	}
	public function PickXItem(){
		return XItem::PickGeneric($this->classname,$this);
	}
	public function GetClassName(){
		return $this->classname;
	}

	const DELIMETER = '~';
	public function Encode(){
		return $this->classname . self::DELIMETER .$this->AsHex();
	}
	public static function Decode($data){
		if (is_null($data)) return null;
		$a = explode(self::DELIMETER,$data);
		if (count($a) < 2) return null;
		return new GenericID($a[0],$a[1]);
	}


	public static function EncodeList($list){
		$r = '';
		$a = array();
		foreach ($list as $gid){
			if (!array_key_exists($gid->classname,$a)) $a[$gid->classname] = array();
			$a[$gid->classname][] = $gid->AsHex();
		}
		foreach ($a as $classname=>$hids){
			if ($r != '') $r .= self::DELIMETER;
			$r .= $classname . self::DELIMETER . implode($hids);
		}
		return $r;
	}
	public static function DecodeList($string){
		if (is_null($string)) return null;
		$r = array();
		$a = explode(self::DELIMETER,$string);
		if (count($a) < 2) return $r;
		for ($i = 0; $i < count($a); $i += 2){
			$classname = $a[$i];
			$hids = $a[$i+1];
			foreach (str_split($hids,8) as $hid)
				$r[] = new GenericID($classname,$hid);
		}
		return $r;
	}

}




<?php

class GenericID extends ID {
	private $classname;

	public function MetaType(){ return MetaGenericID::Type(); }
	public function Serialize(){ return Oxygen::SerializeInner(array($$this->classname,$this->value)); }
	public function Unserialize($data){ list($this->classname,$this->value) = Oxygen::UnserializeInner( $data ); }

	public function __construct($classname,$value=null){
		parent::__construct($value);
		$this->classname = $classname;
	}

	public function GetID(){ return new ID($this->AsInt()); }
	public function ToXItem(){
		return XMeta::Of($this->classname)->PickItem($this);
	}
	public function PickXItem(){
		return XMeta::Of($this->classname)->PickItem($this);
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
		return new GenericID($a[0], ID::ParseHex($a[1]) );
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




	public function IsEqualTo( $x ) {
		if (is_int($x)||is_float($x)) return $this->value == $x;
		if ($x instanceof GenericID) return $this->classname == $x->classname && $this->value == $x->value;
		if ($x instanceof ID) return $this->value == $x->value;
		if ($x instanceof XItem) return $this->classname = $x->GetClassName() && $this->value == $x->id->value;
		return parent::IsEqualTo( $x );
	}

	public function CompareTo($x) {
		if (is_int($x)||is_float($x)) return $this->value - $x;
		if ($x instanceof GenericID) { $r = strcmp($this->classname,$x->classname); return $r == 0 ? $this->value - $x->value : $r; }
		if ($x instanceof ID) return $this->value - $x->value;
		if ($x instanceof XItem) { $r = strcmp($this->classname,$x->GetClassName()); return $r == 0 ? $this->value - $x->id->AsInt() : $r; }
		return parent::CompareTo($x);
	}


}




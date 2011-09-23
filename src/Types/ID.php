<?php

class ID implements Serializable {
	protected $value;
	private $hex = null;

	public function serialize(){ return serialize(array('value'=>$this->value)); }
	public function unserialize($data){ $a = unserialize($data); $this->value=$a['value']; $this->hex = null; }

	public static function GetNextFor($tablename,$primarykey='id'){ return Database::ExecuteGetNextIDFor($tablename,$primarykey); }

	private function parse(&$string){
		$s = strtoupper(trim($string));
		if (!Oxygen::IsID($s)) throw new Exception('Invalid ID: '.$s.'.');
		$x = intval(substr($s,0,1),16);
		if ($x < 0x8)
			$this->value = intval($s,16);
		else { // Stupid PHP does not understand negative hex while scanning back
			$s = strval($x-0x8) . substr($s,1,7);
			$this->value = intval($s,16) ^ 0x7FFFFFFF + 1;
		}
	}

	public function __construct($value=null){
		if (is_null($value))
			$this->value = mt_rand(-0x7FFFFFF,0x7FFFFFFF);
		elseif ($value instanceof ID)
			$this->value = $value->value;
		elseif ($value instanceof XItem)
			$this->value = $value->id->value;
		elseif (is_string($value))
			$this->parse($value);
		elseif (is_int($value))
			$this->value = $value;
		else
			$this->parse(strval($value));
	}

	public static function Random(){ return new ID(); }
	public static function Hash($value){ return new ID(substr(md5(strval($value)),0,8)); }

	public function AsInt(){
		return $this->value;
	}
	public function &AsHex(){
		if (is_null($this->hex)){
			$this->hex = sprintf('%08X',$this->value);
			$l = strlen($this->hex); if ( $l > 8 ) $this->hex = substr( $this->hex , $l - 8); // Stupid PHP might use 64bits for an integer in MacOS
		}
		return $this->hex;
	}
	public function &__toString(){
		return $this->AsHex();
	}



	public function IsEqualTo($x) { return XType::AreEqual($this,$x); }
	public function CompareTo($x){ return XType::Compare($this,$x); }
}



?>

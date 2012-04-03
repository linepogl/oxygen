<?php

class ID implements Serializable, XValue {
	protected $value;
	private $hex = null;

	public function MetaType(){ return MetaID::Type(); }
	public function serialize(){ return serialize($this->value); }
	public function unserialize($data){ $this->value = unserialize($data); $this->hex = null; }


	private static $temp_sequences = array();
	public static function GetNextPermID($sequence,$primarykey='id') {
		return Database::ExecuteGetNextID($sequence,$primarykey);
	}
	public static function GetNextTempID($sequence){
		if (!isset(self::$temp_sequences[$sequence])) self::$temp_sequences[$sequence] = -0x7FFFFFF; else self::$temp_sequences[$sequence]++;
		return new ID(self::$temp_sequences[$sequence]);
	}



	public function __construct($value=null){
		if (is_null($value))
			$this->value = mt_rand(-0x7FFFFFF,0x7FFFFFFF);
		elseif ($value instanceof ID)
			$this->value = $value->value;
		elseif ($value instanceof XItem)
			$this->value = $value->id->value;
		elseif (is_int($value))
			$this->value = $value;
		else
			$this->value = intval($value);
	}

	/** @return ID */
	public static function Random(){
		return new ID();
	}

	/** @return ID */
	public static function ParseHex( $hex ){
		$s = strtoupper(trim($hex));
		if (!Oxygen::IsID($s)) throw new Exception('Invalid ID: '.$s.'.');
		$x = intval(substr($s,0,1),16);
		if ($x < 0x8)
			return new ID( intval($s,16) );
		else // Stupid PHP does not understand negative hex while scanning back
			return new ID( intval(strval($x-0x8).substr($s,1,7),16) ^ 0x7FFFFFFF + 1 );
	}

	public function AsInt(){
		return $this->value;
	}
	public function AsHex(){
		if (is_null($this->hex)){
			$this->hex = sprintf('%08X',$this->value);
			$l = strlen($this->hex); if ( $l > 8 ) $this->hex = substr( $this->hex , $l - 8); // Stupid PHP might use 64bits for an integer in MacOS
		}
		return $this->hex;
	}
	public function __toString(){
		return strval($this->AsInt());
	}



	public function IsEqualTo($x) { return XType::AreEqual($this,$x); }
	public function CompareTo($x){ return XType::Compare($this,$x); }
}





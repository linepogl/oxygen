<?php

class ID extends XValue implements Serializable {
	protected $value;
	private $hex = null;

	public function MetaType(){ return MetaID::Type(); }
	public function Serialize(){ return Oxygen::SerializeInner( $this->value ); }
	public function Unserialize($data){ $this->value = Oxygen::UnserializeInner($data); }

	private static $temp_sequences = array();
	public static function GetNextPermID($tablename,$primarykey='id') {
		return Database::ExecuteGetNextID($tablename,$primarykey);
	}
	public static function GetNextPermIDFromSequence($sequence) {
		return Database::ExecuteGetNextIDFromSequence($sequence);
	}
	public static function GetNextTempID($tablename){
		if (!isset(self::$temp_sequences[$tablename])) self::$temp_sequences[$tablename] = -0x7FFFFFF; else self::$temp_sequences[$tablename]++;
		return new ID(self::$temp_sequences[$tablename]);
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




	public function IsEqualTo( $x ) {
		if (is_int($x)||is_float($x)) return $this->value == $x;
		if ($x instanceof ID) return $this->value == $x->value;
		if ($x instanceof XItem) return $this->value == $x->id->value;
		return parent::IsEqualTo( $x );
	}
	public function CompareTo( $x ) {
		if (is_int($x)||is_float($x)) return $this->value - $x;
		if ($x instanceof ID) return $this->value - $x->value;
		if ($x instanceof XItem) return $this->value - $x->id->value;
		return parent::CompareTo( $x );
	}

}





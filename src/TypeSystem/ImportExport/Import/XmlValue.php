<?php

class XmlValue extends ImportValue {

	/** @return string|null */
	public function GetInnerValue(){ return $this->value; }

	private static function unescape($string){
		return str_replace(
  		array('&amp;','&gt;','&lt;','&quot;'),
  		array('&','>','<','"'),
  		Oxygen::ReadUnicode($string)
  		);
	}
  public function __construct($value){
   	parent::__construct( is_null($value) ? null : self::unescape($value) ) ;
  }



	public function AsStringArray(){
		if (is_null($this->value) || $this->value==='')
			return array();
		else
			return explode(',',$this->value);
	}
	public function AsIntegerArray(){
		if (is_null($this->value) || $this->value==='')
			return array();
		else {
			$a = array();
			foreach (explode(',',$this->value) as $s)
				$a[] = intval($s);
			return $a;
		}
	}
  public function AsIDArray(){
	  if (is_null($this->value) || $this->value==='')
			return array();
  	else {
			$r = array();
			foreach (explode(',',$this->value) as $s) $r[]= is_null($s) || $s=='' ? null : ID::ParseHex($s);
  		return $r;
		}
	}



	public function CastTo(XType $type) {
		return $type->ImportDomValue($this->value);
	}
}

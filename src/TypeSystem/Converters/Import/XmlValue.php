<?php

class XmlValue extends ImportConverter {

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




	public function CastTo(XType $type) {
		return $type->ImportDomValue($this->value);
	}
}

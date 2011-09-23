<?php

class XmlValue extends ImportConverter {

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



	public function AsString(){ return is_null($this->value) ? null : strval($this->value); }
	public function AsID(){ return is_null($this->value) ? null : new ID(intval($this->value)); }
  public function AsDateTime(){
  	return empty($this->value) ? null : XDateTime::Parse($this->value,'Y-m-d\TH:i:s');
  }
  public function AsDate(){
  	return empty($this->value) ? null : XDate::Parse($this->value,'Y-m-d');
  }
  public function AsTime(){
  	return empty($this->value) ? null : XTime::Parse($this->value,'H:i:s');
  }
  public function AsTimeSpan(){
  	return empty($this->value) ? null : XTimeSpan::Parse($this->value);
	}

  public function AsBoolean(){ return is_null($this->value) ? false : $this->value=='true'; }
  public function AsInteger(){ return is_null($this->value) ? 0 : intval($this->value); }
  public function AsFloat(){ return is_null($this->value) ? 0.0 : floatval($this->value); }


}
?>
<?php

class DBValue extends ImportConverter {

	public function AsString(){ return is_null($this->value) ? null : strval($this->value); }
	public function AsID(){ return is_null($this->value) ? null : new ID(intval($this->value)); }
  public function AsDateTime(){
  	return is_null($this->value) || $this->value == '0000-00-00 00:00:00' ? null : XDateTime::Parse($this->value,'Y-m-d H:i:s');
  }
  public function AsDate(){
  	return is_null($this->value) || $this->value == '0000-00-00 00:00:00' ? null : XDate::Parse($this->value,'Y-m-d H:i:s');
  }
  public function AsTime(){
  	return is_null($this->value) || $this->value == '0000-00-00 00:00:00' ? null : XTime::Parse($this->value,'Y-m-d H:i:s');
  }
  public function AsTimeSpan(){
  	return is_null($this->value) ? null : new XTimeSpan(intval($this->value));
	}

	public function AsBoolean(){ return is_null($this->value) ? false : $this->value == true; }
  public function AsInteger(){ return is_null($this->value) ? 0 : intval($this->value); }
  public function AsFloat(){ return is_null($this->value) ? 0.0 : floatval($this->value); }


	
	public function CastTo(OmniType $type) {
		return $type->ImportDBValue($this->value);
	}
}

<?php


class HttpValue extends ImportConverter {
  public function __construct($value){
  	if (is_array($value)){
  		$a = array();
  		foreach ($value as $s)
  			$a[] = is_null($s) ? null : htmlspecialchars_decode( rawurldecode( $s) );
  		parent::__construct($a);
		}
		else{
    	parent::__construct( is_null($value) ? null : htmlspecialchars_decode( rawurldecode( $value ) ) ) ;
		}
  }


  public function AsString() { return $this->value;  }
  public function AsID() { return is_null($this->value) || $this->value=='' ? null : new ID($this->value); }
  public function AsDateTime() { return is_null($this->value) || $this->value=='' ? null : XDateTime::Parse($this->value,'YmdHis'); }
  public function AsDate() { return is_null($this->value) || $this->value=='' ? null : XDate::Parse($this->value,'YmdHis'); }
  public function AsTime() { return is_null($this->value) || $this->value=='' ? null : XTime::Parse($this->value,'YmdHis'); }
  public function AsTimeSpan(){ return is_null($this->value) || $this->value=='' ? null : new XTimeSpan(intval($this->value)); }

  public function AsInteger() { return is_null($this->value) ? 0 : intval($this->value); }
  public function AsBoolean() { return $this->value=='true'; }
  public function AsFloat() { return is_null($this->value) ? 0.0 : floatval( str_replace( Language::GetDecimalSeparator() , '.' , str_replace( Language::GetThousandsSeparator() , '' , $this->value ) ) ); }

	public function AsStringArray(){
		if (empty($this->value))
			return array();
		else if (is_array($this->value))
			return $this->value;
		else
			return explode(',',$this->value);
	}
	public function AsIntegerArray(){
		if (is_null($this->value))
			return array();
		else if (is_array($this->value)){
			$a = array();
			foreach ($this->value as $s)
				$a[] = intval($s);
			return $a;
		}
		else {
			$a = array();
			foreach (explode(',',$this->value) as $s)
				$a[] = intval($s);
			return $a;
		}
	}
  public function AsIDArray(){
  	if (empty($this->value))
  		return array();
  	else if (is_array($this->value)){
			$r = array();
			foreach ($this->value as $s) $r[]= is_null($s) || $s=='' ? null : new ID($s);
  		return $r;
		}
  	else {
			$r = array();
			foreach (explode(',',$this->value) as $s) $r[]= is_null($s) || $s=='' ? null : new ID($s);
  		return $r;
		}
	}

}





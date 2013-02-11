<?php


class HttpValue extends ImportValue {

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
			foreach ($this->value as $key=>$s)
				$a[$key] = intval($s);
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
			foreach ($this->value as $key=>$s) $r[$key]= is_null($s) || $s=='' ? null : ID::ParseHex($s);
  		return $r;
		}
  	else {
			$r = array();
			foreach (explode(',',$this->value) as $s) $r[]= is_null($s) || $s=='' ? null : ID::ParseHex($s);
  		return $r;
		}
	}



	public function CastTo(XType $type) {
		return $type->ImportHttpValue($this->value);
	}

}





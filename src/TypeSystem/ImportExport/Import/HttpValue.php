<?php


class HttpValue extends ImportValue {

	public function HasValue(){ return $this->value !== null; }

	public function AsStringArray(){
		if ($this->value===null || $this->value==='')
			return array();
		else if (is_array($this->value))
			return $this->value;
		else
			return explode(',',$this->value);
	}
	public function AsIntegerArray(){
		if ($this->value===null || $this->value==='')
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
	  if ($this->value===null || $this->value==='')
			return array();
  	else if (is_array($this->value)){
			$r = array();
			foreach ($this->value as $key=>$s) $r[$key]= $s===null||$s=='' ? null : ID::ParseHex($s);
  		return $r;
		}
  	else {
			$r = array();
			foreach (explode(',',$this->value) as $s) $r[]= $s===null||$s=='' ? null : ID::ParseHex($s);
  		return $r;
		}
	}



	public function CastTo(XType $type) {
		return $type->ImportHttpValue($this->value);
	}

}





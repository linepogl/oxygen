<?php

class Enum implements ArrayAccess,Countable,IteratorAggregate {

	public function OffsetExists($offset) { return isset($this->array[$offset]); }
	public function OffsetGet($offset) { return $this->array[$offset]; }
	public function OffsetSet($offset, $value) { if (is_null($offset)) $this->array[] = $value; else $this->array[$offset] = $value; }
	public function OffsetUnset($offset) { unset($this->array[$offset]); }
	public function Count(){ return count($this->array); }
	public function GetIterator(){ return new ArrayIterator($this->array); }

	private $array;
	private $is_map;
	public function __construct(array $array = array(),$is_map = false){
		$this->array = $array;
		$this->is_map = $is_map;
	}

	/** @return array */
	public function GetInnerArray(){ return $this->array; }

	/** @return Enum */
	public function WithIsMap($value){ $this->is_map = $value; return $this; }
	public function IsMap(){ return $this->is_map; }



	public static function FromList($array){
		return new Enum($array,false);
	}
	public static function FromMap($array){
		return new Enum($array,true);
	}

	public function AsString($number){
		return $this->AsStringOr($number,null);
	}
	public function AsStringOr($number,$default){
		if ($this->is_map) {
			return array_key_exists($number,$this->array)
				? $this->array[$number]
				: $default;
		}
		else {
			$r = array_search($number,$this->array);
			return $r===false
				? $default
				: $number;
		}
	}


	public function AsNumber($string){
		return $this->AsNumberOr($string,null);
	}
	public function AsNumberOr($string,$default){
		$r = array_search($string,$this->array);
		if ($this->is_map)
			return $r === false ? $default : $r;
		else
			return $r === false ? $default : $string;
	}


}



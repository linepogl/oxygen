<?php

class Enum implements ArrayAccess,Countable,IteratorAggregate {
	private $array;

	public function offsetExists($offset) { return isset($this->array[$offset]); }
	public function offsetGet($offset) { return $this->array[$offset]; }
	public function offsetSet($offset, $value) { if (is_null($offset)) $this->array[] = $value; else $this->array[$offset] = $value; }
	public function offsetUnset($offset) { unset($this->array[$offset]); }
	public function count(){ return count($this->array); }
	public function getIterator(){ return new ArrayIterator($this->array); }



	public static function From(&$array){
		$r = new Enum();
		$r->array = $array;
		return $r;
	}

	public function AsString($number){
		return $this->AsStringOr($number,null);
	}
	public function AsStringOr($number,$default){
		return array_key_exists($number,$this->array)
			? $this->array[$number]
			: $default;
	}


	public function AsNumber($string){
		return $this->AsNumberOr($string,null);
	}
	public function AsNumberOr($string,$default){
		$r = array_search($string,$this->array);
		return $r === false ? $default : $r;
	}


}



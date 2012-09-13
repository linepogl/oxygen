<?php

class LinqSelectIterator extends LinqIterator {
	private $function_select;
	public function __construct(Iterator $iterator, $function_select){ parent::__construct($iterator); $this->function_select = $function_select; }
	public function Current(){
		$f = $this->function_select;
		$v = $f($this->iterator->current(),$this->iterator->key());
		return $v;
	}
}


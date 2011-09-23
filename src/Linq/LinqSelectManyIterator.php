<?php

class LinqSelectManyIterator extends LinqIterator {
	private $function_select_many;
	private $nested_iterator = null;
	private $index = -1;
	public function __construct(Iterator $iterator, $function_select_many){ parent::__construct($iterator); $this->function_select_many = $function_select_many; }

	public function rewind(){
		$this->nested_iterator = null;
		for($this->iterator->rewind(); $this->iterator->valid(); $this->iterator->next()) {
			$f = $this->function_select_many;
			$this->nested_iterator = from($f($this->iterator->current(),$this->iterator->key()));
			$this->nested_iterator->rewind();
			if ($this->nested_iterator->valid()) break;
			$this->nested_iterator = null;
		}
		$this->index = 0;
	}
	public function next(){
		$this->nested_iterator->next();
		if (!$this->nested_iterator->valid()){
			$this->nested_iterator = null;
			for($this->iterator->next(); $this->iterator->valid(); $this->iterator->next()) {
				$f = $this->function_select_many;
				$this->nested_iterator = from($f($this->iterator->current(),$this->iterator->key()));
				$this->nested_iterator->rewind();
				if ($this->nested_iterator->valid()) break;
				$this->nested_iterator = null;
			}
		}
		$this->index++;
	}
	public function valid(){ return !is_null($this->nested_iterator); }
	public function current(){ return $this->nested_iterator->current(); }
	public function key(){ return $this->index; }

}
?>
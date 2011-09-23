<?php

class LinqRecurseIterator extends LinqIterator {
	private $function_children;
	private $nested_iterator;
	private $checked_children;
	public function __construct(Iterator $iterator, $function_children){ parent::__construct($iterator); $this->function_children = $function_children; }

	public function rewind(){
		$this->stack = array();
		$this->nested_iterator = null;
		$this->checked_children = false;
		$this->iterator->rewind();
	}
	public function next(){
		if (!$this->checked_children){
			$f = $this->function_children;
			$children = $f($this->iterator->current(),$this->iterator->key());
			$this->nested_iterator = from($children)->Recurse($f);
			$this->checked_children = true;
			$this->nested_iterator->rewind();
			if (!$this->nested_iterator->valid()) $this->nested_iterator = null;
		}
		else {
			$this->nested_iterator->next();
			if (!$this->nested_iterator->valid()) $this->nested_iterator = null;
		}
		if (is_null($this->nested_iterator)){
			$this->iterator->next();
			$this->checked_children = false;
		}
	}
	public function current(){ return is_null($this->nested_iterator) ? $this->iterator->current() : $this->nested_iterator->current(); }
	public function key(){ return is_null($this->nested_iterator) ? $this->iterator->key() : $this->nested_iterator->key(); }


}

?>
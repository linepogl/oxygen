<?php

class LinqRecurseIterator extends LinqIterator {
	private $function_children;
	/** @var Iterator */
	private $nested_iterator;
	private $have_children_been_checked;
	public function __construct(Iterator $iterator, $function_children){ parent::__construct($iterator); $this->function_children = $function_children; }

	public function Rewind(){
		$this->nested_iterator = null;
		$this->have_children_been_checked = false;
		$this->iterator->rewind();
	}
	public function Next(){
		if (!$this->have_children_been_checked){
			$f = $this->function_children;
			$children = $f($this->iterator->current(),$this->iterator->key());
			$this->nested_iterator = from($children)->Recurse($f);
			$this->have_children_been_checked = true;
			$this->nested_iterator->rewind();
			if (!$this->nested_iterator->valid()) $this->nested_iterator = null;
		}
		else {
			$this->nested_iterator->next();
			if (!$this->nested_iterator->valid()) $this->nested_iterator = null;
		}
		if ($this->nested_iterator===null){
			$this->iterator->next();
			$this->have_children_been_checked = false;
		}
	}
	public function Current(){ return $this->nested_iterator===null ? $this->iterator->current() : $this->nested_iterator->current(); }
	public function Key(){ return $this->nested_iterator===null ? $this->iterator->key() : $this->nested_iterator->key(); }


}


<?php

/** Breadth-first recursive iterator */
class LinqWaveIterator extends LinqIterator {
	private $function_children;
	/** @var Iterator */
	private $current_iterator = null;
	private $nested_iterators_index = -1;
	private $nested_iterators = array();
	public function __construct(Iterator $iterator, $function_children){ parent::__construct($iterator); $this->function_children = $function_children; }

	private function append_children() {
		$f = $this->function_children;
		$children = $f($this->current_iterator->current(),$this->current_iterator->key());
		$this->nested_iterators[] = from($children);
	}
	public function Rewind(){
		$this->nested_iterators = array();
		$this->nested_iterators_index = -1;
		$this->current_iterator = $this->iterator;
		$this->current_iterator->rewind();
		if (!$this->current_iterator->valid())
			$this->current_iterator = null;
		else
			$this->append_children();
	}
	public function Next(){
		if ($this->current_iterator === null) return;
		$this->current_iterator->next();
		while (!$this->current_iterator->valid()) {
			if ($this->nested_iterators_index < count($this->nested_iterators)-1) {
				$this->nested_iterators_index++;
				$this->current_iterator = $this->nested_iterators[ $this->nested_iterators_index ];
				$this->current_iterator->rewind();
			}
			else {
				$this->current_iterator = null;
				return;
			}
		}
		if ($this->current_iterator !== null) $this->append_children();
	}
	public function Current(){ return $this->current_iterator->current(); }
	public function Key(){ return $this->current_iterator->key(); }
	public function Valid(){ return $this->current_iterator !== null; }


}


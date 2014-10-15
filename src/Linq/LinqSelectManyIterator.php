<?php

class LinqSelectManyIterator extends LinqIterator {
	private $function_select_many;
	/** @var Iterator|null */
	private $nested_iterator = null;
	private $index = -1;
	public function __construct(Iterator $iterator, $function_select_many){ parent::__construct($iterator); $this->function_select_many = $function_select_many; }

	public function Rewind(){
		$this->nested_iterator = null;
		for($this->iterator->rewind(); $this->iterator->valid(); $this->iterator->next()) {
			/** @var $f closure */
			$f = $this->function_select_many;
			$this->nested_iterator = from($f($this->iterator->current(),$this->iterator->key()));
			$this->nested_iterator->rewind();
			if ($this->nested_iterator->valid()) break;
			$this->nested_iterator = null;
		}
		$this->index = 0;
	}
	public function Next(){
		$this->nested_iterator->next();
		if (!$this->nested_iterator->valid()){
			$this->nested_iterator = null;
			for($this->iterator->next(); $this->iterator->valid(); $this->iterator->next()) {
				/** @var $f closure */
				$f = $this->function_select_many;
				$this->nested_iterator = from($f($this->iterator->current(),$this->iterator->key()));
				$this->nested_iterator->rewind();
				if ($this->nested_iterator->valid()) break;
				$this->nested_iterator = null;
			}
		}
		$this->index++;
	}
	public function Valid(){ return !is_null($this->nested_iterator); }
	public function Current(){ return $this->nested_iterator->current(); }
	public function Key(){ return $this->index; }

}

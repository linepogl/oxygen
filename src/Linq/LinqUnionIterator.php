<?php

class LinqUnionIterator extends LinqIterator {
	private $other_iterator;
	private $iterating_other;
	public function __construct(Iterator $iterator, Traversable $other_iterator){ parent::__construct($iterator); $this->other_iterator = new IteratorIterator($other_iterator); }

	public function Rewind(){
		$this->iterating_other = false;
		$this->iterator->rewind();
		if (!$this->iterator->valid()){
			$this->iterating_other = true;
			$this->other_iterator->rewind();
		}
	}
	public function Next(){
		if ($this->iterating_other){
			$this->other_iterator->next();
		}
		else{
			$this->iterator->next();
			if (!$this->iterator->valid()){
				$this->iterating_other = true;
				$this->other_iterator->rewind();
			}
		}
	}
	public function Valid(){ return !$this->iterating_other || $this->other_iterator->valid(); }
	public function Current(){ return $this->iterating_other ? $this->other_iterator->current() : $this->iterator->current(); }
	public function Key(){ return $this->iterating_other ? $this->other_iterator->key() : $this->iterator->key(); }


}


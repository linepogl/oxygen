<?php

class LinqTakeIterator extends LinqIterator {
	private $how_many;
	private $now_at;
	public function __construct(Iterator $iterator, $how_many){ parent::__construct($iterator); $this->how_many = $how_many; }
	public function rewind(){ $this->now_at = 0; $this->iterator->rewind(); }
	public function next(){ $this->now_at++; $this->iterator->next(); }
	public function valid(){ return $this->iterator->valid() && $this->now_at < $this->how_many; }
}


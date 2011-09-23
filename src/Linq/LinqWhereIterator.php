<?php

class LinqWhereIterator extends LinqIterator {
	private $function_where;
	public function __construct(Iterator $iterator, $function_where){ parent::__construct($iterator); $this->function_where = $function_where; }
	public function rewind(){
		$f = $this->function_where;
		for ($this->iterator->rewind();$this->iterator->valid();$this->iterator->next())
			if ($f($this->iterator->current(),$this->iterator->key()))
				return;
	}
	public function next(){
		$f = $this->function_where;
		for ($this->iterator->next();$this->iterator->valid();$this->iterator->next())
			if ($f($this->iterator->current(),$this->iterator->key()))
				return;
	}
}

?>
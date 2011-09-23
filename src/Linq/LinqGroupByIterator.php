<?php

class LinqGroupByIterator extends LinqIterator {
	private $hash_function;
	public function __construct(Iterator $iterator, $hash_function){ parent::__construct($iterator); $this->hash_function = $hash_function; }

	private $groups = null;
	private $grouped_iterators = null;
	private $inner_iterator = null;

	private function init(){
		if (!is_null($this->groups)) return;
		$this->groups = array();
		/** @var $hash_function closure */
		$hash_function = $this->hash_function;
		for($this->iterator->rewind(); $this->iterator->valid(); $this->iterator->next()) {
			/** @var $key int|string */
			$key = $this->iterator->key();
			$value = $this->iterator->current();
			$hash = $hash_function($value,$key);
			if (!array_key_exists( $hash , $this->groups ))
				$this->groups[$hash] = array();
			$this->groups[$hash][$key] = $value;
		}

		$this->grouped_iterators = array();
		foreach ($this->groups as $hash=>$group)
			$this->grouped_iterators[$hash] = from($group);
		$this->inner_iterator = from($this->grouped_iterators);
	}

	public function rewind(){ $this->init(); $this->inner_iterator->rewind(); }
	public function next(){ $this->inner_iterator->next(); }
	public function valid(){ return $this->inner_iterator->valid(); }
	public function current(){ return $this->inner_iterator->current(); }
	public function key(){ return $this->inner_iterator->key(); }

}
?>
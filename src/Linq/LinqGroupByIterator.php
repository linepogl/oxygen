<?php

class LinqGroupByIterator extends LinqIterator implements ArrayAccess {
	private $hash_function;
	public function __construct(Iterator $iterator, $hash_function){ parent::__construct($iterator); $this->hash_function = $hash_function; }

	private $groups = null;
	private $grouped_iterators = null;
	/** @var Iterator */
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

	public function Rewind(){ $this->init(); $this->inner_iterator->rewind(); }
	public function Next(){ $this->inner_iterator->next(); }
	public function Valid(){ return $this->inner_iterator->valid(); }
	public function Current(){ return $this->inner_iterator->current(); }
	public function Key(){ return $this->inner_iterator->key(); }

	public function OffsetExists($offset) { $this->init(); return array_key_exists($offset,$this->groups); }
	public function OffsetGet($offset) { $this->init(); return array_key_exists($offset,$this->groups) ? $this->groups[$offset] : new LinqIterator(new ArrayIterator(array())); }
	public function OffsetSet($offset,$value) { $this->init(); $this->groups[$offset] = $value; }
	public function OffsetUnset($offset) { $this->init(); unset($this->groups[$offset]); }

}

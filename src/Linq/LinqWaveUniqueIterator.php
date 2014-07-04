<?php

/** Breadth-first recursive unique iterator */
class LinqWaveUniqueIterator extends LinqIterator {
	private $served = array();
	private $hash_function;
	private $function_children;
	/** @var Iterator */
	private $current_iterator = null;
	private $nested_iterators_index = -1;
	private $nested_iterators = array();
	public function __construct(Iterator $iterator, $function_children, $hash_function = null){
		parent::__construct($iterator);
		$this->function_children = $function_children;
		$this->hash_function = is_null($hash_function)
			? function($x){
				if (is_numeric($x)) return $x;
				//if ($x instanceof IHashable) return $x->GetHashCode();
				return strval($x);
			}
			: $hash_function;
	}

	private function append_children() {
		$f = $this->function_children;
		$children = $f($this->current_iterator->current(),$this->current_iterator->key());
		$this->nested_iterators[] = from($children);
	}
	public function Rewind(){
		$this->served = array();
		$this->nested_iterators = array();
		$this->nested_iterators_index = -1;
		$this->current_iterator = $this->iterator;
		$this->current_iterator->rewind();
		if ($this->current_iterator->valid()) {
			$f = $this->hash_function;
			$hash = $f($this->current_iterator->current(),$this->current_iterator->key());
			$this->served[$hash] = $hash;
			$this->append_children();
		}
		else {
			$this->current_iterator = null;
		}
	}
	public function Next(){
		if ($this->current_iterator === null) return;
		$found = false;
		for($this->current_iterator->next();$this->current_iterator->valid();$this->current_iterator->next()) {
			$f = $this->hash_function;
			$hash = $f($this->current_iterator->current(),$this->current_iterator->key());
			if (!array_key_exists($hash,$this->served)) {
				$this->served[$hash] = $hash;
				$found = true;
				break;
			}
		}
		while (!$found) {
			if ($this->nested_iterators_index < count($this->nested_iterators)-1) {
				$this->nested_iterators_index++;
				$this->current_iterator = $this->nested_iterators[ $this->nested_iterators_index ];
				for($this->current_iterator->rewind();$this->current_iterator->valid();$this->current_iterator->next()) {
					$f = $this->hash_function;
					$hash = $f($this->current_iterator->current(),$this->current_iterator->key());
					if (!array_key_exists($hash,$this->served)) {
						$this->served[$hash] = $hash;
						$found = true;
						break;
					}
				}
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

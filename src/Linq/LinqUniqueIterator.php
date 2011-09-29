<?php

class LinqUniqueIterator extends LinqIterator {
	private $served = array();
	private $hash_function;
	public function __construct(Iterator $iterator, $hash_function = null){
		parent::__construct($iterator);
		$this->hash_function = is_null($hash_function)
			? function($x){
				if (is_numeric($x)) return $x;
				//if ($x instanceof IHashable) return $x->GetHashCode();
				return strval($x);
			}
			: $hash_function;
	}


	public function rewind(){
		$this->iterator->rewind();
		if ($this->iterator->valid()){
			$f = $this->hash_function;
			$hash = $f($this->iterator->current(),$this->iterator->key());
			$this->served[] = $hash;
		}
	}
	public function next(){
		for($this->iterator->next();$this->iterator->valid();$this->iterator->next()){
			$f = $this->hash_function;
			$hash = $f($this->iterator->current(),$this->iterator->key());
			if (!in_array($hash,$this->served)) {
				$this->served[] = $hash;
				break;
			}
		}
	}


}


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


	public function Rewind(){
		$this->served = array();
		$this->iterator->rewind();
		if ($this->iterator->valid()){
			$f = $this->hash_function;
			$hash = $f($this->iterator->current(),$this->iterator->key());
			$this->served[$hash] = $hash;
		}
	}
	public function Next(){
		for($this->iterator->next();$this->iterator->valid();$this->iterator->next()){
			$f = $this->hash_function;
			$hash = $f($this->iterator->current(),$this->iterator->key());
			if (!array_key_exists($hash,$this->served)) {
				$this->served[$hash] = $hash;
				break;
			}
		}
	}


}


<?php

class LinqOrderByIterator extends LinqIterator {
	const ASC = 0;
	const DESC = 1;


	private $hash_functions = array();
	private $sort_orders = array();
	private $pairs = null;
	private $index = -1;

	public function __construct(Iterator $iterator, $hash_function, $sort_order = self::ASC){
		parent::__construct($iterator);
		$this->hash_functions[] = $hash_function;
		$this->sort_orders[] = $sort_order;
	}

	/** @return LinqOrderByIterator */
	public function ThenBy($hash_function){
		$this->hash_functions[] = $hash_function;
		$this->sort_orders[] = self::ASC;
		return $this;
	}
	/** @return LinqOrderByIterator */
	public function ThenByDesc($hash_function){
		$this->hash_functions[] = $hash_function;
		$this->sort_orders[] = self::DESC;
		return $this;
	}


	private function init(){
		if (!is_null($this->pairs)) return;

		$this->pairs = array();
		for($this->iterator->rewind(); $this->iterator->valid(); $this->iterator->next())
			$this->pairs[] = array($this->iterator->current(),$this->iterator->key());

		if (count($this->pairs) > 0){
			$functions =& $this->hash_functions;
			$orders =& $this->sort_orders;
			usort($this->pairs,function(&$pair1,&$pair2)use(&$functions,&$orders){
				for ($i = 0; $i < count($functions); $i++){
					/** @var $f closure */
					$f = $functions[$i];
					$x1 = $f($pair1[0],$pair1[1]);
					$x2 = $f($pair2[0],$pair2[1]);
					$r = XType::Compare($x1,$x2);
					if ($r!=0) return $orders[$i] == LinqOrderByIterator::ASC ? $r : -$r;
				}
				return 0;
			});
		}
	}
	public function rewind(){ $this->init(); $this->index = 0; }
	public function next(){ $this->index++; }
	public function valid(){ return $this->index < count($this->pairs); }
	public function current(){ return $this->pairs[$this->index][0]; }
	public function key(){ return $this->pairs[$this->index][1]; }
}


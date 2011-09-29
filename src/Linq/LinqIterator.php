<?php


class LinqIterator implements Iterator, Countable {
	protected $iterator;
	public function __construct(Iterator $iterator){
		$this->iterator = $iterator;
	}

	public function current(){ return $this->iterator->current(); }
	public function key(){ return $this->iterator->key(); }
	public function next(){ $this->iterator->next(); }
	public function rewind(){ $this->iterator->rewind(); }
	public function valid(){ return $this->iterator->valid(); }


	/** Lazy O(n) @return LinqIterator */
	public function Where($function_where){
		return new LinqWhereIterator($this,$function_where);
	}

	/** Lazy O(n) @return LinqIterator */
	public function WhereNotNull(){
		return new LinqWhereIterator($this,function($x){return !is_null($x);});
	}
	/** Lazy O(n) @return LinqIterator */
	public function WhereKeyNotNull(){
		return new LinqWhereIterator($this,function($x,$key){return !is_null($key);});
	}

	/** Aggressive O(n) @return LinqIterator */
	public function GroupBy($hash_function){
		return new LinqGroupByIterator($this,$hash_function);
	}

	/** Aggressive O(nlogn) @return LinqOrderByIterator */
	public function OrderBy($hash_function,$desc=false){
		return new LinqOrderByIterator($this,$hash_function,$desc?LinqOrderByIterator::DESC:LinqOrderByIterator::ASC);
	}

	/** Aggressive O(nlogn) @return LinqOrderByIterator */
	public function OrderByDesc($hash_function){
		return new LinqOrderByIterator($this,$hash_function,LinqOrderByIterator::DESC);
	}

	/** Lazy O(n) @return LinqIterator */
	public function Select($function_select){
		return new LinqSelectIterator($this,$function_select);
	}

	/** Lazy O(n*m) @return LinqIterator */
	public function SelectMany($function_select_many){
		return new LinqSelectManyIterator($this,$function_select_many);
	}

	/** Lazy O(1) @return LinqIterator */
	public function Take($how_many){
		return new LinqTakeIterator($this,$how_many);
	}

	/** Lazy O(n) @return LinqIterator */
	public function Skip($how_many){
		return new LinqSkipIterator($this,$how_many);
	}

	/** Lazy O(n) @return LinqIterator */
	public function Unique($hash_function = null){
		return new LinqUniqueIterator($this,$hash_function);
	}

	/** Lazy O(n) @return LinqIterator */
	public function Recurse($function_children){
		return new LinqRecurseIterator($this,$function_children);
	}

	/** Lazy O(n) @return LinqIterator */
	public function Union(Traversable $other_iterator){
		return new LinqUnionIterator($this,$other_iterator);
	}

	/** Aggressive O(1) @return value */
	public function GetFirst(){
		$this->rewind();
		return $this->valid() ? $this->current() : null;
	}
	/** Aggressive O(1) @return value */
	public function GetFirstOr($default){
		$this->rewind();
		return $this->valid() ? $this->current() : $default;
	}

	/** Aggressive O(n) @return value */
	public function GetLast(){
		$r = null;
		for($this->rewind();$this->valid();$this->next())
			$r = $this->current();
		return $r;
	}

	/** Aggressive O(n) @return value */
	public function GetLastOr($default){
		$r = $default;
		for($this->rewind();$this->valid();$this->next())
			$r = $this->current();
		return $r;
	}


	/** Aggressive O(1) @return key */
	public function GetFirstKey(){
		$this->rewind();
		return $this->valid() ? $this->key() : null;
	}

	/** Aggressive O(n) @return key */
	public function GetLastKey(){
		$r = null;
		for($this->rewind();$this->valid();$this->next())
			$r = $this->key();
		return $r;
	}



	/** Aggressive O(n) @return int */
	public function count(){
		$r = 0;
		for($this->rewind();$this->valid();$this->next())
			$r++;
		return $r;
	}


	/** O(n) @return boolean */
	public function Exists($equality_function){
		for($this->rewind();$this->valid();$this->next())
			if ($equality_function($this->current(),$this->key()))
				return true;
		return false;
	}

	/** O(n) @return boolean */
	public function ForAll($equality_function){
		for($this->rewind();$this->valid();$this->next())
			if (!$equality_function($this->current(),$this->key()))
				return false;
		return true;
	}

	/** O(n) @return void */
	public function Run($function){
		for($this->rewind();$this->valid();$this->next())
			$function($this->current(),$this->key());
	}

	/** O(n) @return string */
	public function Implode($glue=''){
		$r = '';
		for($this->rewind();$this->valid();$this->next()){
			if ($r!='') $r.=$glue;
			$r .= strval($this->current());
		}
		return $r;
	}

	/** O(n) */
	public function Sum(){
		$r = 0;
		for($this->rewind();$this->valid();$this->next())
			$r += $this->current();
		return $r;
	}
	/** O(n) */
	public function Max(){
		$r = null;
		for($this->rewind();$this->valid();$this->next()){
			$x = $this->current();
			if (is_null($r) || $r < $x) $r = $x;
		}
		return $r;
	}
	/** O(n) */
	public function Min(){
		$r = null;
		for($this->rewind();$this->valid();$this->next()){
			$x = intval($this->current());
			if (is_null($r) || $r > $x) $r = $x;
		}
		return $r;
	}



	/** O(n) @return XList */
	public function AsXList(XMeta $meta=null){
		$r = new XList($meta);
		for($this->rewind();$this->valid();$this->next())
			$r[] = $this->current();
		return $r;
	}

	/** O(n) @return array */
	public function AsArray(){
		$r = array();
		for($this->rewind();$this->valid();$this->next())
			$r[] = $this->current();
		return $r;
	}

	/** Lazy O(n) @return void */
	public function Apply($function_apply){
		for($this->rewind();$this->valid();$this->next())
			$function_apply($this->current(),$this->key());
	}


}




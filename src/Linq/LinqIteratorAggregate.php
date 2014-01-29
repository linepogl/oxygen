<?php


abstract class LinqIteratorAggregate implements IteratorAggregate,Countable {

	/** @return Iterator */
	public function GetIterator(){ throw new NonImplementedException(); }

	/** Lazy O(n) @return LinqIterator */
	public function Where($function_where){
		return new LinqWhereIterator($this->getIterator(),$function_where);
	}

	/** Lazy O(n) @return LinqIterator */
	public function WhereNotNull(){
		return new LinqWhereIterator($this->getIterator(),function($x){return !is_null($x);});
	}
	/** Lazy O(n) @return LinqIterator */
	public function WhereKeyNotNull(){
		/** @noinspection PhpUnusedParameterInspection */
		return new LinqWhereIterator($this->getIterator(),function($x,$key){return !is_null($key);});
	}

	/** Aggressive O(n) @return LinqIterator */
	public function GroupBy($hash_function){
		return new LinqGroupByIterator($this->getIterator(),$hash_function);
	}

	/** Aggressive O(nlogn) @return LinqOrderByIterator */
	public function OrderBy($hash_function,$desc=false){
		return new LinqOrderByIterator($this->getIterator(),$hash_function,$desc?LinqOrderByIterator::DESC:LinqOrderByIterator::ASC);
	}
	/** Aggressive O(nlogn) @return LinqOrderByIterator */
	public function OrderByDesc($hash_function){
		return new LinqOrderByIterator($this->getIterator(),$hash_function,LinqOrderByIterator::DESC);
	}

	/** Lazy O(n) @return LinqIterator */
	public function Select($function_select){
		return new LinqSelectIterator($this->getIterator(),$function_select);
	}

	/** Lazy O(n*m) @return LinqIterator */
	public function SelectMany($function_select_many){
		return new LinqSelectManyIterator($this->getIterator(),$function_select_many);
	}

	/** Lazy O(1) @return LinqIterator */
	public function Take($how_many){
		return new LinqTakeIterator($this->getIterator(),$how_many);
	}

	/** Lazy O(n) @return LinqIterator */
	public function Skip($how_many){
		return new LinqSkipIterator($this->getIterator(),$how_many);
	}

	/** Lazy O(n) @return LinqIterator */
	public function Unique($hash_function = null){
		return new LinqUniqueIterator($this->getIterator(),$hash_function);
	}

	/** Lazy O(n) @return LinqIterator */
	public function Recurse($function_children){
		return new LinqRecurseIterator($this->getIterator(),$function_children);
	}

	/** Lazy O(n) @return LinqIterator */
	public function Union(Traversable $other_iterator){
		return new LinqUnionIterator($this->getIterator(),$other_iterator);
	}

	/** Aggressive O(1) @return mixed value */
	public function GetFirst(){
		$it = $this->getIterator();
		$it->rewind();
		return $it->valid() ? $it->current() : null;
	}
	/** Aggressive O(1) @return mixed value */
	public function GetFirstOr($default){
		$it = $this->getIterator();
		$it->rewind();
		return $it->valid() ? $it->current() : $default;
	}

	/** Aggressive O(n) @return mixed value */
	public function GetLast(){
		$it = $this->getIterator();
		$r = null;
		for($it->rewind();$it->valid();$it->next())
			$r = $it->current();
		return $r;
	}

	/** Aggressive O(n) @return mixed value */
	public function GetLastOr($default){
		$it = $this->getIterator();
		$r = $default;
		for($it->rewind();$it->valid();$it->next())
			$r = $it->current();
		return $r;
	}

	/** Aggressive O(1) @return mixed key */
	public function GetFirstKey(){
		$it = $this->getIterator();
		$it->rewind();
		return $it->valid() ? $it->key() : null;
	}

	/** Aggressive O(n) @return mixed key */
	public function GetLastKey(){
		$it = $this->getIterator();
		$r = null;
		for($it->rewind();$it->valid();$it->next())
			$r = $it->key();
		return $r;
	}


	/** Aggressive O(n) @return int */
	public function Count(){
		$it = $this->getIterator();
		$r = 0;
		for($it->rewind();$it->valid();$it->next())
			$r++;
		return $r;
	}

	/** O(n) @return boolean */
	public function Exists($equality_function){
		$it = $this->getIterator();
		for($it->rewind();$it->valid();$it->next())
			if ($equality_function($it->current(),$it->key()))
				return true;
		return false;
	}
	/** O(n) @return boolean */
	public function ForAll($equality_function){
		$it = $this->getIterator();
		for($it->rewind();$it->valid();$it->next())
			if (!$equality_function($it->current(),$it->key()))
				return false;
		return true;
	}

	/** O(n) @return void */
	public function Run($function){
		$it = $this->getIterator();
		for($it->rewind();$it->valid();$it->next())
			$function($it->current(),$it->key());
	}


	/** O(n) @return string */
	public function Implode($glue=''){
		$r = '';
		$it = $this->getIterator();
		for($it->rewind();$it->valid();$it->next()){
			if ($r!='') $r.=$glue;
			$r .= strval($it->current());
		}
		return $r;
	}

	/** O(n) @return mixed value */
	public function Sum(){
		$r = 0;
		$it = $this->getIterator();
		for($it->rewind();$it->valid();$it->next())
			$r += $it->current();
		return $r;
	}
	/** O(n) @return mixed value */
	public function Max($default = null){
		$r = null;
		$it = $this->getIterator();
		for($it->rewind();$it->valid();$it->next()) {
			$x = $it->current();
			if (is_null($r) || $r < $x) $r = $x;
		}
		return is_null($r) ? $default : $r;
	}
	/** O(n) @return mixed value */
	public function Min($default = null){
		$r = null;
		$it = $this->getIterator();
		for($it->rewind();$it->valid();$it->next()){
			$x = intval($it->current());
			if (is_null($r) || $r > $x) $r = $x;
		}
		return is_null($r) ? $default : $r;
	}


	/** O(n) @return XList */
	public function AsXList(XMeta $meta=null){
		$r = new XList($meta);
		$it = $this->getIterator();
		for($it->rewind();$it->valid();$it->next())
			$r[] = $it->current();
		return $r;
	}

	/** O(n) @return array */
	public function AsArray(){
		$r = array();
		$it = $this->getIterator();
		for($it->rewind();$it->valid();$it->next())
			$r[$it->key()] = $it->current();
		return $r;
	}

	/** Lazy O(n) @return static */
	public function Apply($function_apply){
		$it = $this->getIterator();
		for($it->rewind();$it->valid();$it->next())
			$function_apply($it->current(),$it->key());
		return $this;
	}
}






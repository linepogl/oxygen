<?php

class XPredList extends XPred implements ArrayAccess,Countable,IteratorAggregate {

	const OP_AND = 0;
	const OP_OR = 1;

	private $preds;
	private $op;
	public function __construct($preds = array(), $op = self::OP_AND){
		$this->preds = $preds;
		$this->op = $op;
	}


	public function Count(){ return count($this->preds); }
	public function GetIterator(){ return from($this->preds); }
	public function offsetExists($offset) { return isset($this->preds[$offset]); }
	public function offsetGet($offset) { if (!isset($this->preds[$offset])) throw new Exception('Offset '.$offset.' not found.'); return $this->preds[$offset]; }
	public function offsetSet($offset, $value) { if (is_null($offset)) $this->preds[] = $value; else $this->preds[$offset] = $value; }
	public function offsetUnset($offset) { unset($this->preds[$offset]); }



	public function ToSql(){
		if ($this->op  == self::OP_AND){
			if (0 == count($this->preds))
				return '1=1';
			$r = '';
			foreach ($this->preds as $pred) {
				if ($r != '') $r .= ' AND ';
				$r .= '(' . $pred->ToSql() . ')';
			}
			return $r;
		}
		else {
			if (0 == count($this->preds))
				return '0=1';
			$r = '';
			foreach ($this->preds as $pred) {
				if ($r != '') $r .= ' OR ';
				$r .= '(' . $pred->ToSql() . ')';
			}
			return $r;
		}
	}


	public function GetSqlParams(){
		$r = array();
		/** @var $pred XPred */
		foreach ($this->preds as $pred)
			foreach ($pred->GetSqlParams() as $param)
				array_push($r,$param);
		return $r;
	}
}
<?php

class XAggrIterator implements Iterator {
	private $index;
	private $xaggr;
	public function __construct($xaggr){ $this->xaggr = $xaggr; }
	function Key() { return $this->index; }
	function Current() { return $this->xaggr[$this->index]; }
	function Valid() { return $this->index < count($this->xaggr); }
	function Rewind() { $this->index = -1; $this->next(); }
	function Next() { $this->index++; }
}


class XAggr extends LinqIteratorAggregate implements ArrayAccess,Countable {

	/** @var XMeta */
	private $meta;
	private $selectors;
	private $data;
	public function __construct(XMeta $meta,$selectors){
		$this->meta = is_null($meta) ? XItem::Meta() : $meta;
		$this->selectors = $selectors;
  }








	/** @return XAggr */
	public function Evaluate(){
		if (is_null($this->data)) {
			$params = null;
			$sql = $this->MakeQuery($params);
			$this->data = array();
			$dr = Database::ExecuteX($sql,$params);
			while ($dr->Read()) {
				if (is_array($this->selectors)) {
					$a = array();
					/** @var $selector XMetaField|XAggrField */
					foreach ($this->selectors as $key=>$selector) {
						$a[ $key ] = $dr['AGGR'.$key]->CastTo($selector->GetType());
					}
					$this->data[] = $a;
				}
				else {
					/** @var $selector XMetaField|XAggrField */
					$selector = $this->selectors;
					$this->data[] = $dr['AGGR0']->CastTo($selector->GetType());
				}
			}
			$dr->Close();
		}
		return $this;
	}


	
	private function MakeQuery(&$params){

		//
		// SELECT
		//
		$sql = 'SELECT ';
		if ($this->distinct) $sql .= 'DISTINCT ';

		if (is_array($this->selectors)) {
			$i = 0;
			/** @var $selector XMetaField|XAggrField */
			foreach ($this->selectors as $key=>$selector) {
				if ($i++>0) $sql.=',';
				$sql .= $selector->ToSql().' '.new SqlName('AGGR'.$key);
			}
		}
		else {
			/** @var $selector XMetaField|XAggrField */
			$selector = $this->selectors;
			$sql .= $selector->ToSql().' '.new SqlName('AGGR0');
		}

		//
		// FROM
		//
		$sql .= ' FROM '.new SqlName($this->meta->GetDBTableName()).' a';
		for ($mm = $this->meta->GetParent(); !is_null($mm); $mm = $mm->GetParent())
			$sql .= ','.new SqlName($mm->GetDBTableName());


		//
		// WHERE
		//
		$where = is_null($this->where) ? null : $this->where->ToSql();
		for ($mm = $this->meta->GetParent(); !is_null($mm); $mm = $mm->GetParent()) {
			if (!is_null($where)) $where .= ' AND ';
			$where .= new SqlName($mm->GetDBTableName()).'.'.new SqlName($mm->id).'=a.'.new SqlName($this->meta->id);
		}
		if (!empty($where)) $sql .= ' WHERE '.$where;


		//
		// GROUP BY !!!
		//
		if (0 != count($this->groupers)){
			$sql .= ' GROUP BY ';
			$i = 0;
			foreach ($this->groupers as $grouper){
				if ($i++>0) $sql .= ',';
				$sql .= new SqlName($grouper);
			}
		}

		//
		// ORDER BY
		//
		$order_by = $this->order_by;
//		if (is_null($order_by)) {
//			for ($mm = $this->meta; !is_null($mm); $mm = $mm->GetParent()) {
//				if (!is_null($mm->GetOrderBy())) {
//					$order_by = $mm->GetOrderBy();
//					break;
//				}
//			}
//		}
		if (!is_null($order_by)) $sql .= ' ORDER BY '.$order_by->ToSql();

		$params = is_null($this->where) ? array() : $this->where->GetSqlParams();





		//
		// LIMIT
		//
		$has_min = $this->skip > 0;
		$has_max = !is_null($this->take);
		if ($has_min || $has_max){
			if (Database::GetType() == Database::ORACLE){
				if ($has_min && $has_max){
					$min = $this->skip + 1;
					$max = $this->skip + $this->take;
					$sql = 'SELECT * FROM ( SELECT b.*,ROWNUM AS oracle_rownum FROM ('.$sql.') b WHERE ROWNUM<=?) WHERE oracle_rownum>=?';
					$params[]= $max;
					$params[]= $min;
				}
				elseif ($has_max){
					$max = $this->take;
					$sql = 'SELECT * FROM ('.$sql.') WHERE ROWNUM<=?';
					$params[]= $max;
				}
				elseif ($has_min){
					$min = $this->skip + 1;
					$sql = 'SELECT * FROM ( SELECT b.*,ROWNUM AS oracle_rownum FROM ('.$sql.') b) WHERE oracle_rownum>=?';
					$params[]= $min;
				}
			}
			else {
				if ($has_max) {
					$sql .= ' LIMIT '.$this->skip.','.$this->take;
				}
				else {
					$sql .= ' LIMIT '.$this->skip.',18446744073709551615';
				}
			}
		}
		return $sql;
	}



	/** @var array */
	private $groupers = array();

	/** @return XAggr|LinqIterator */
	public function GroupBy($grouper_or_function){
		if (is_null($grouper_or_function))
			return $this;
		elseif ( $grouper_or_function instanceof XMetaField ) {
			$this->groupers[] = $grouper_or_function;
			return $this;
		}
		elseif ( is_string($grouper_or_function) ) {
			$this->groupers[] = $grouper_or_function;
			return $this;
		}
		else
			return parent::GroupBy( $grouper_or_function );
	}




	/** @var XPred */
	private $where = null;

	/** @return XAggr|LinqIterator */
	public function Where( $pred_or_function ){
		if ( is_null($pred_or_function) )
			return $this;
		elseif ( $pred_or_function instanceof XPred ) {
			if (is_null($this->where))
				$this->where = XPred::All($pred_or_function);
			else
				$this->where[] = $pred_or_function;
			return $this;
		}
		else
			return parent::Where($pred_or_function);
	}



	/** @var XOrderBy */
	private $order_by = null;

	/** @return XAggr|LinqIterator */
	public function OrderBy( $orderby_or_field_or_function , $desc = false ){
		if (is_null($orderby_or_field_or_function))
			return $this;
		elseif ( $orderby_or_field_or_function instanceof XOrderBy ) {
			$this->order_by = $orderby_or_field_or_function;
			return $this;
		}
		elseif ( $orderby_or_field_or_function instanceof XMetaField ) {
			$this->order_by = $orderby_or_field_or_function->Order($desc);
			return $this;
		}
		else
			return parent::OrderBy( $orderby_or_field_or_function , $desc );
	}


	private $skip = 0;
	/** @return XAggr|LinqIterator */
	public function Skip( $how_many ){
		if (is_null($this->data)) {
			$this->skip = intval($how_many);
			if ($this->skip < 0) $this->skip = 0;
			return $this;
		}
		return parent::Skip( $how_many );
	}

	private $take = null;
	/** @return XAggr|LinqIterator */
	public function Take( $how_many ){
		if (is_null($this->data)) {
			$this->take = is_null($how_many) ? null : intval($how_many);
			return $this;
		}
		return parent::Take( $how_many );
	}


	/** @return XAggr|LinqIterator */
	private $distinct = false;
	public function Unique( $hash_function = null){
		if (is_null($hash_function)){
			if (is_null($this->data)) {
				$this->distinct = true;
				return $this;
			}
		}
		return parent::Unique( $hash_function );
	}

	public function Count(){
		$this->Evaluate();
		return count($this->data);
	}
	public function GetIterator(){
		$this->Evaluate();
		return from(new XAggrIterator($this));
	}



	public function OffsetExists($offset) {
		$this->Evaluate();
		return isset($this->data[$offset]);
	}
	public function OffsetGet($offset) {
		$this->Evaluate();
		if (!array_key_exists($offset,$this->data)) throw new Exception('Offset '.$offset.' not found.');
		return $this->data[$offset];
	}
	public function OffsetSet($offset, $value) {
		$this->Evaluate();
		if (is_null($offset))
			$this->data[] = $value;
		else
			$this->data[$offset] = $value;
	}
	public function OffsetUnset($offset) {
		$this->Evaluate();
		unset($this->data[$offset]);
		$a = array();
		foreach ($this->data as $value) $a[] = $value;
		$this->data = $a;
	}

	public function Invalidate() {
		$this->data = null;
		return $this;
	}

	public function GetFirst(){ $this->Evaluate(); return count($this)>0 ? $this[0] : null; }
	public function GetFirstOr($default){ $this->Evaluate(); return count($this)>0 ? $this[0] : $default; }

	public function GetLast(){ $this->Evaluate(); return count($this)>0 ? $this[count($this)-1] : null; }
	public function GetLastOr($default){ $this->Evaluate(); return count($this)>0 ? $this[count($this)-1] : $default; }


}



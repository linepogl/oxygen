<?php

class XListIterator implements Iterator {
	private $index;
	private $xlist;
	public function __construct($xlist){ $this->xlist = $xlist; }
	function key() { return $this->index; }
	function current() { return $this->xlist[$this->index]; }
	function valid() { return $this->index < count($this->xlist); }
	function rewind() { $this->index = -1; $this->next(); }
	function next() { $this->index++; }
}


class XList extends LinqIteratorAggregate implements ArrayAccess,Countable {

	/** @var XMeta */
	protected $meta;
	private $data;
	public function __construct(XMeta $meta=null,$auto_load = false){
		$this->meta = is_null($meta) ? XItem::Meta() : $meta;
		$this->data = $auto_load ? null : array();
  }





	//
	//
	// Auto loader
	//
	//
	private $is_aggressive = false;
	/** @return XList */
	public function Aggressively($value = true){ $this->is_aggressive = $value; return $this; }






	/** @return void */
	private function Load(){
		if (!is_null($this->data)) return;
		$params = null;
		$sql = $this->MakeQuery($params);
		$this->data = array();
		if ($this->is_aggressive) {
			$dr = Database::ExecuteX($sql,$params);
			while ($dr->Read())
				$this->data[] = $this->meta->PickItem($dr[0]->AsID(),$dr);
			$dr->Close();
		}
		else {
			$dr = Database::ExecuteX($sql,$params);
			while ($dr->Read())
				$this->data[] = $dr[0]->AsID();
			$dr->Close();
		}
	}


	
	private function MakeQuery(&$params){

		//
		// SELECT
		//
		$sql = 'SELECT a.'.new SqlName($this->meta->id).' AS id';

		if ($this->is_aggressive)
			for ($mm = $this->meta; !is_null($mm); $mm = $mm->GetParent())
				/** @var $f XMetaField */
				foreach ($mm->GetDBFields() as $f)
					$sql .= ',' . new SqlName($f);

		//
		// FROM
		//
		$sql .= ' FROM '.$this->meta->GetDBTableName().' a';
		for ($mm = $this->meta->GetParent(); !is_null($mm); $mm = $mm->GetParent())
			$sql .= ','.$mm->GetDBTableName();


		//
		// WHERE
		//
		$where = is_null($this->where) ? null : $this->where->ToSql();
		for ($mm = $this->meta->GetParent(); !is_null($mm); $mm = $mm->GetParent()) {
			if (!is_null($where)) $where .= ' AND ';
			$where .= $mm->GetDBTableName().'.'.new SqlName($mm->id).'=a.'.new SqlName($this->meta->id);
		}
		if (!empty($where)) $sql .= ' WHERE '.$where;


		//
		// ORDER BY
		//
		$order_by = $this->order_by;
		if (is_null($order_by)) {
			for ($mm = $this->meta; !is_null($mm); $mm = $mm->GetParent()) {
				if (!is_null($mm->GetOrderBy())) {
					$order_by = $mm->GetOrderBy();
					break;
				}
			}
		}
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





	public function LoadAggressively(){
		if (is_null($this->data)){
			$old = $this->is_aggressive;
			$this->is_aggressive = true;
			$this->Load();
			$this->is_aggressive = $old;
		}
		else {
			$ids = array();
			foreach ($this->data as $x)
				if ($x instanceof ID)
					$ids[] = $x;

			if (count($ids) > 0){
				$a = new XList($this->meta,true);
				$a->is_aggressive = true;
				$a->where = XPred::All( $this->meta->id->In($ids) );
				$b = array();
				foreach ($a as $x)
					$b[$x->id->AsInt()] = $x;
				foreach (array_keys($this->data) as $offset)
					$this->data[$offset] = $b[ $this->data[$offset]->AsInt() ];
			}
		}
	}



	/** @var XPred */
	private $where = null;

	/** @return XList|LinqIterator */
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

	/** @return XList|LinqIterator */
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
	/** @return XList|LinqIterator */
	public function Skip( $how_many ){
		if (is_null($this->data)) {
			$this->skip = intval($how_many);
			if ($this->skip < 0) $this->skip = 0;
			return $this;
		}
		return parent::Skip( $how_many );
	}

	private $take = null;
	/** @return XList|LinqIterator */
	public function Take( $how_many ){
		if (is_null($this->data)) {
			$this->take = is_null($how_many) ? null : intval($how_many);
			return $this;
		}
		return parent::Take( $how_many );
	}



	public function SaveAll(){ foreach ($this as $x) $x->Save(); }
	public function KillAll(){ foreach ($this as $x) $x->Kill(); }






	public function count(){
		if (is_null($this->data)){
			$sql = $this->MakeQuery($params);
			$sql = 'SELECT COUNT(*) FROM ('.$sql.') c';
			return Database::ExecuteScalarX($sql,$params)->AsInteger();
		}
		//$this->Load();
		return count($this->data);
	}
	public function getIterator(){
		$this->Load();
		return from(new XListIterator($this));
	}



	public function offsetExists($offset) {
		$this->Load();
		return isset($this->data[$offset]);
	}
	public function offsetGet($offset) {
		$this->Load();
		if (!array_key_exists($offset,$this->data)) throw new Exception('Offset '.$offset.' not found.');
		if ($this->data[$offset] instanceof ID) $this->data[$offset] = $this->meta->PickItem( $this->data[$offset] );
		return $this->data[$offset];
	}
	public function offsetSet($offset, $value) {
		$this->Load();
		if (is_null($offset))
			$this->data[] = $value;
		else
			$this->data[$offset] = $value;
	}
	public function offsetUnset($offset) {
		$this->Load();
		unset($this->data[$offset]);
		$a = array();
		foreach ($this->data as $value) $a[] = $value;
		$this->data = $a;
	}

	public function Invalidate() {
		$this->data = null;
		return $this;
	}
	public function LoadAll(){
		foreach ($this as $x)
			;
		return $this;
	}

	public function GetFirst(){ $this->Load(); return count($this)>0 ? $this[0] : null; }
	public function GetFirstOr($default){ $this->Load(); return count($this)>0 ? $this[0] : $default; }

	public function GetLast(){ $this->Load(); return count($this)>0 ? $this[count($this)-1] : null; }
	public function GetLastOr($default){ $this->Load(); return count($this)>0 ? $this[count($this)-1] : $default; }


	public function AsIDList(){ return $this->ToIDList(); }
	public function ToIDList(){
		$this->Load();
		$r = array();
		foreach ($this->data as $x) {
			if ($x instanceof XItem)
				$r[] = $x->id;
			elseif ($x instanceof ID)
				$r[] = $x;
		}
		return $r;
	}

	public function AsGenericIDList(){ return $this->AsGenericIDList(); }
	public function ToGenericIDList(){
		$this->Load();
		$r = array();
		foreach ($this->data as $x) {
			if ($x instanceof XItem)
				$r[] = $x->AsGenericID();
			elseif ($x instanceof ID)
				$r[] = new GenericID($this->meta->GetClassName(),$x);
		}
		return $r;
	}

	/** @return XList */
	public function Sort(){
		$this->LoadAll();
		usort($this->data, array($this->meta->GetClassName(),'Compare'));
		return $this;
	}
	/** @return XList */
	public function Reverse(){
		$this->data	= array_reverse($this->data);
		return $this;
	}

	public function Merge($array){
		$this->Load();
		foreach ($array as $x)
			$this[] = $x;
	}

	public function Clear(){
		$this->data = array();
	}

	public function Contains($dbitem_or_id){
		$this->Load();
		foreach ($this->data as $xx)
			if ($xx->IsEqualTo($dbitem_or_id))
				return true;
		return false;
	}

	public function Remove($dbitem_or_id){
		$this->Load();
		$a = array();
		foreach ($this->data as $key=>$xx)
			if ($xx->IsEqualTo($dbitem_or_id))
				$a[] = $key;
		$a = array_reverse($a);
		foreach ($a as $key)
			unset($this[$key]);
	}

	public function RemoveWhere($predicate_function){
		$this->Load();
		$a = array();
		foreach ($this as $key=>$value)
			if ($predicate_function($value))
				$a[] = $key;
		$a = array_reverse($a);
		foreach ($a as $key)
			unset($this[$key]);
	}

	public function IsEqualTo($list) {
		if ($this->Count()!=$list->Count()) return false;
		foreach ($this->data as $xx) if (!$list->Contains($xx)) return false;
		return true;
	}

}



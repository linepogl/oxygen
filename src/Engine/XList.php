<?php

class XListIterator implements Iterator {
	private $index;
	private $xlist;
	private $current;
	public function __construct($xlist){ $this->xlist = $xlist; }
	function Key() { return $this->index; }
	function Current() { return $this->current; }
	function Valid() { return $this->index < count($this->xlist); }
	function Rewind() { $this->index = -1; $this->Next(); }
	function Next() {
		$this->index++;
		if ($this->index < count($this->xlist)) {
			$this->current = $this->xlist[$this->index];
			if ($this->current === null) $this->Next();
		}
		else $this->current = null;
	}
}


class XList extends LinqIteratorAggregate implements ArrayAccess,Countable {

	/** @var XMeta */
	protected $meta;
	/** @var XItem[]|ID[]|null */
	private $data;
	public function __construct(XMeta $meta=null,$auto_load = false){
		$this->meta = $meta === null ? XItem::Meta() : $meta;
		$this->data = $auto_load ? null : array();
  }

	/** @return XMeta */
	public function GetMeta(){ return $this->meta; }




	//
	//
	// Auto loader
	//
	//
	private $is_aggressive = false;
	/** @return XList */
	public function Aggressively($value = true){ $this->is_aggressive = $value; return $this; }






	/** @return XList */
	public function Evaluate(){
		if ($this->data === null) {
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
		return $this;
	}


	
	private function MakeQuery(&$params){
		$params = $this->where===null ? array() : $this->where->GetSqlParams();

		//
		// SELECT
		//
		$sql = $this->meta->id->IsDBAliasComplex()
			? 'SELECT '.new SqlIden($this->meta->id).' AS id'
			: 'SELECT a.'.new SqlIden($this->meta->id).' AS id'
			;

		if ($this->is_aggressive) {
			/** @var $f XMetaField */
			foreach ($this->meta->GetDBFields() as $f) {
				$sql .= ',' . new SqlIden($f);
				if ($f->IsDBAliasComplex()) $sql .= ' AS '.new SqlIden($f->GetName());
			}
		}

		//
		// FROM
		//
		$sql .= ' FROM ';
		$found = false;
		for ($mm = $this->meta; $mm!==null; $mm = $mm->GetParent()) {
			if ($mm->SharesDBTableWithParent()) continue;
			if ($found)
				$sql .= ','.new SqlIden($mm->GetDBTableName());
			else
				$sql .= new SqlIden($mm->GetDBTableName()).' a';
			$found = true;
		}


		//
		// WHERE
		//
		$where = $this->where === null ? null : $this->where->ToSql();
		for ($mm = $this->meta; $mm!==null; $mm = $mm->GetParent()) if (!$mm->SharesDBTableWithParent()) break;
		if ($mm !== null) {
			for ($mx = $mm->GetParent(); $mx !== null; $mx = $mx->GetParent()) {
				if ($mx->SharesDBTableWithParent()) continue;
				if ($where !== null) $where .= ' AND ';
				$where .= new SqlIden($mx->GetDBTableName()).'.'.new SqlIden($mx->id).'=a.'.new SqlIden($this->meta->id);
			}
		}
		$class_name_db_field = $this->meta->GetClassNameDBField();
		if ($class_name_db_field !== null) {
			if ($where !== null) $where .= ' AND ';
			$where .= 'a.'.new SqlIden($mm->GetClassNameDBField()).'=?';
			$params[] = $this->meta->GetClassName();
		}
		if (!empty($where)) $sql .= ' WHERE '.$where;


		//
		// ORDER BY
		//
		$order_by = $this->order_by;
		if ($order_by===null) {
			for ($mm = $this->meta; $mm!==null; $mm = $mm->GetParent()) {
				if ($mm->GetOrderBy()!==null) {
					$order_by = $mm->GetOrderBy();
					break;
				}
			}
		}
		if ($order_by!==null) $sql .= ' ORDER BY '.$order_by->ToSql();






		//
		// LIMIT
		//
		$has_min = $this->skip > 0;
		$has_max = $this->take!==null;
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





	/** @return XList */
	public function LoadAll(){
		/** @noinspection PhpUnusedLocalVariableInspection */
		foreach ($this as $x)
			;
		return $this;
	}

	/** @return XList */
	public function LoadAllAggressively(){
		if ($this->data===null){
			$old = $this->is_aggressive;
			$this->is_aggressive = true;
			$this->Evaluate();
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
		return $this;
	}



	/** @var XPred */
	private $where = null;

	/** @return XList|LinqIterator */
	public function Where( $pred_or_function ){
		if ( $pred_or_function === null )
			return $this;
		elseif ( $pred_or_function instanceof XPred ) {
			if ($this->where === null)
				$this->where = XPred::All($pred_or_function);
			else
				$this->where[] = $pred_or_function;
			return $this;
		}
		else
			return parent::Where($pred_or_function);
	}
	/** @return XList|LinqIterator */
	public function WhereNot( $pred_or_function ){
		if ( $pred_or_function === null )
			return $this;
		elseif ( $pred_or_function instanceof XPred ) {
			if ($this->where === null)
				$this->where = XPred::All(XPred::Not($pred_or_function));
			else
				$this->where[] = XPred::Not($pred_or_function);
			return $this;
		}
		else
			return parent::WhereNot($pred_or_function);
	}
	/** @return XList|LinqIterator */
	public function WhereAny( /* ... */ ) { return $this->WhereAnyX(XPred::AnyX(func_get_args())); }
	/** @return XList|LinqIterator */
	public function WhereAnyX( $preds ) { return $this->Where(XPred::AnyX($preds)); }
	/** @return XList|LinqIterator */
	public function WhereAll( /* ... */ ) { return $this->Where(XPred::AllX(func_get_args())); }
	/** @return XList|LinqIterator */
	public function WhereAllX( $preds ) { return $this->Where(XPred::AllX($preds)); }
	/** @return XList|LinqIterator */
	public function WhereNone( /* ... */ ) { return $this->Where(XPred::NoneX(func_get_args())); }
	/** @return XList|LinqIterator */
	public function WhereNoneX( $preds ) { return $this->Where(XPred::NoneX($preds)); }


	/** @return XList|LinqIterator */
	public function Apply( $function ){ parent::Apply($function); return $this; }

	/** @var XOrderBy */
	private $order_by = null;

	/** @return XList|LinqIterator */
	public function OrderBy( $orderby_or_field_or_function , $desc = false ){
		if ($orderby_or_field_or_function === null)
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
		if ($this->data === null) {
			$this->skip = intval($how_many);
			if ($this->skip < 0) $this->skip = 0;
			return $this;
		}
		return parent::Skip( $how_many );
	}

	private $take = null;
	/** @return XList|LinqIterator */
	public function Take( $how_many ){
		if ($this->data===null) {
			$this->take = $how_many===null ? null : intval($how_many);
			return $this;
		}
		return parent::Take( $how_many );
	}



	/** @return XList */ public function SaveAll(){ /** @var $x XItem */ foreach ($this as $x) $x->Save(); return $this; }
	/** @return XList */ public function KillAll(){ /** @var $x XItem */ foreach ($this as $x) $x->Kill(); return $this; }

	/** @return XList */
	public function FreeAll(){
		$this->Evaluate();
		foreach ($this->data as $offset => $x) {
			if ($x instanceof ID)
				$this->meta->RemoveFromCache( $x->AsInt() );
			elseif ($x instanceof XItem) {
				$this->data[$offset] = $x->id;
				$x->Free();
			}
		}
		return $this;
	}





	public function IsEmpty(){ return $this->Count() === 0; }

	private $count = null;
	public function Count(){
		if ($this->data===null){
			if ($this->count===null) {
				$sql = $this->MakeQuery($params);
				$sql = 'SELECT COUNT(*) FROM ('.$sql.') c';
				$this->count = Database::ExecuteScalarX($sql,$params)->AsInteger();
			}
			return $this->count;
		}
		//$this->Evaluate();
		return count($this->data);
	}
	public function GetIterator(){
		$this->Evaluate();
		return new LinqIterator(new XListIterator($this));
	}



	public function OffsetExists($offset) {
		$this->Evaluate();
		return isset($this->data[$offset]);
	}
	public function OffsetGet($offset) {
		$this->Evaluate();
		if (!array_key_exists($offset,$this->data)) throw new Exception('Offset '.$offset.' not found.');
		if ($this->data[$offset] instanceof ID) $this->data[$offset] = $this->meta->PickItem( $this->data[$offset] );
		return $this->data[$offset];
	}
	public function OffsetSet($offset, $value) {
		$this->Evaluate();
		if ($offset===null)
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

	public function IsEvaluated(){
		return $this->data!==null;
	}
	public function Invalidate() {
		$this->data = null;
		return $this;
	}

	public function GetFirst(){ $this->Evaluate(); return count($this)>0 ? $this[0] : null; }
	public function GetFirstOr($default){ $this->Evaluate(); return count($this)>0 ? $this[0] : $default; }

	public function GetLast(){ $this->Evaluate(); return count($this)>0 ? $this[count($this)-1] : null; }
	public function GetLastOr($default){ $this->Evaluate(); return count($this)>0 ? $this[count($this)-1] : $default; }


	public function AsIDList(){ return $this->ToIDList(); }
	public function ToIDList(){
		$this->Evaluate();
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
		$this->Evaluate();
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
	public function Sort($compare_function=null){
		$this->LoadAllAggressively();
		if ($compare_function === null)
			usort($this->data, array($this->meta->GetClassName(),'Compare'));
		else
			usort($this->data, $compare_function);
		return $this;
	}
	/** @return XList */
	public function Reverse(){
		$this->Evaluate();
		$this->data	= array_reverse($this->data);
		return $this;
	}

	/** @return XItem|null */
	public function Pop(){
		$this->Evaluate();
		$l = count($this->data);
		if ($l > 0) {
			$r = $this[$l-1];
			array_pop($this->data);
			return $r;
		}
		return null;
	}

	/** @return XList */
	public function Copy(){
		$r = clone $this;
		if ($r->where!==null) $r->where = clone $r->where;
		if ($r->order_by!==null) $r->order_by = clone $r->order_by;
		return $r;
	}

	public function Merge($traversable){
		$this->Evaluate();
		foreach ($traversable as $x)
			$this[] = $x;
		return $this;
	}

	public function MergeNewOnly($traversable) {
		$this->Evaluate();
		foreach ($traversable as $x)
			if (!$this->Contains( $x ) )
				$this[] = $x;
		return $this;
	}
	public function Append($dbitem_or_id){
		$this->Evaluate();
		$this[] = $dbitem_or_id;
		return $this;
	}

	public function AppendNewOnly($dbitem_or_id) {
		$this->Evaluate();
		if (!$this->Contains( $dbitem_or_id ) )
			$this[] = $dbitem_or_id;
		return $this;
	}

	public function Clear(){
		$this->data = array();
		return $this;
	}

	public function Contains($dbitem_or_id){
		$this->Evaluate();
		/** @var $xx XItem|ID */
		foreach ($this->data as $xx)
			if ($xx->IsEqualTo($dbitem_or_id))
				return true;
		return false;
	}

	public function Pick($dbitem_or_id){
		$this->Evaluate();
		/** @var $xx XItem|ID */
		foreach ($this->data as $xx)
			if ($xx->IsEqualTo($dbitem_or_id))
				return $xx;
		return null;
	}

	public function Remove($dbitem_or_id){
		$this->Evaluate();
		$a = array();
		/** @var $xx XItem|ID */
		foreach ($this->data as $key=>$xx)
			if ($xx!==null && $xx->IsEqualTo($dbitem_or_id))
				$a[] = $key;
		$a = array_reverse($a);
		foreach ($a as $key)
			unset($this[$key]);
		return $this;
	}

	public function RemoveMany($traversable){
		$this->Evaluate();
		$a = array();
		/** @var $xx XItem|ID */
		foreach ($this->data as $key=>$xx)
			if ($xx!==null)
				/** @var $x XItem|ID|int */
				foreach ($traversable as $x)
					if ($xx->IsEqualTo($x)) { $a[] = $key; break; }
		$a = array_reverse($a);
		foreach ($a as $key)
			unset($this[$key]);
		return $this;
	}

	public function RemoveWhere($predicate_function){
		$this->Evaluate();
		$a = array();
		foreach ($this as $key=>$value)
			if ($predicate_function($value))
				$a[] = $key;
		$a = array_reverse($a);
		foreach ($a as $key)
			unset($this[$key]);
		return $this;
	}

	public function IsEqualTo($list) {
		/** @var $list XList */
		if ($this->Count()!=$list->Count()) return false;
		foreach ($this->data as $xx) if (!$list->Contains($xx)) return false;
		return true;
	}

}



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
			if (is_null($this->current)) $this->Next();
		}
		else $this->current = null;
	}
}


class XList extends LinqIteratorAggregate implements ArrayAccess,Countable {

	/** @var XMeta */
	protected $meta;
	private $data;
	public function __construct(XMeta $meta=null,$auto_load = false){
		$this->meta = is_null($meta) ? XItem::Meta() : $meta;
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
		if (is_null($this->data)) {
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

		//
		// SELECT
		//
		$sql = $this->meta->id->IsDBAliasComplex()
			? 'SELECT '.new SqlIden($this->meta->id).' AS id'
			: 'SELECT a.'.new SqlIden($this->meta->id).' AS id'
			;

		if ($this->is_aggressive) {
			for ($mm = $this->meta; !is_null($mm); $mm = $mm->GetParent()) {
				/** @var $f XMetaField */
				foreach ($mm->GetDBFields() as $f) {
					$sql .= ',' . new SqlIden($f);
					if ($f->IsDBAliasComplex()) $sql .= ' AS '.new SqlIden($f->GetName());
				}
			}
		}

		//
		// FROM
		//
		$sql .= ' FROM '.new SqlIden($this->meta->GetDBTableName()).' a';
		for ($mm = $this->meta->GetParent(); !is_null($mm); $mm = $mm->GetParent())
			$sql .= ','.new SqlIden($mm->GetDBTableName());


		//
		// WHERE
		//
		$where = is_null($this->where) ? null : $this->where->ToSql();
		for ($mm = $this->meta->GetParent(); !is_null($mm); $mm = $mm->GetParent()) {
			if (!is_null($where)) $where .= ' AND ';
			$where .= $mm->GetDBTableName().'.'.new SqlIden($mm->id).'=a.'.new SqlIden($this->meta->id);
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





	/** @return XList */
	public function LoadAll(){
		/** @noinspection PhpUnusedLocalVariableInspection */
		foreach ($this as $x)
			;
		return $this;
	}

	/** @return XList */
	public function LoadAllAggressively(){
		if (is_null($this->data)){
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
	/** @return XList|LinqIterator */
	public function WhereAny( /* ... */ ) { return $this->WhereAnyX( func_get_args() ); }
	/** @return XList|LinqIterator */
	public function WhereAnyX( $preds ) { return $this->Where(XPred::AnyX($preds)); }
	/** @return XList|LinqIterator */
	public function WhereAll( /* ... */ ) { return $this->WhereAllX( func_get_args() ); }
	/** @return XList|LinqIterator */
	public function WhereAllX( $preds ) { return $this->Where(XPred::AllX($preds)); }



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



	/** @return XList */ public function SaveAll(){ foreach ($this as $x) $x->Save(); return $this; }
	/** @return XList */ public function KillAll(){ foreach ($this as $x) $x->Kill(); return $this; }

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






	private $count = null;
	public function Count(){
		if (is_null($this->data)){
			if (is_null($this->count)) {
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

	public function IsEvaluated(){
		return !is_null($this->data);
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
	public function Sort(){
		$this->LoadAllAggressively();
		usort($this->data, array($this->meta->GetClassName(),'Compare'));
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
		if (!is_null($r->where)) $r->where = clone $r->where;
		if (!is_null($r->order_by)) $r->order_by = clone $r->order_by;
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
		foreach ($this->data as $xx)
			if ($xx->IsEqualTo($dbitem_or_id))
				return true;
		return false;
	}

	public function Pick($dbitem_or_id){
		$this->Evaluate();
		foreach ($this->data as $xx)
			if ($xx->IsEqualTo($dbitem_or_id))
				return $xx;
		return null;
	}

	public function Remove($dbitem_or_id){
		$this->Evaluate();
		$a = array();
		foreach ($this->data as $key=>$xx)
			if (!is_null($xx) && $xx->IsEqualTo($dbitem_or_id))
				$a[] = $key;
		$a = array_reverse($a);
		foreach ($a as $key)
			unset($this[$key]);
		return $this;
	}

	public function RemoveMany($traversable){
		$this->Evaluate();
		$a = array();
		foreach ($this->data as $key=>$xx)
			if (!is_null($xx))
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
		if ($this->Count()!=$list->Count()) return false;
		foreach ($this->data as $xx) if (!$list->Contains($xx)) return false;
		return true;
	}

}



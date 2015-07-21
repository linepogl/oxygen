<?php

class XMeta extends stdClass {
	public $id;
	private $__class_name;
	private function __construct($class_name){
		$this->__class_name=$class_name;
		$this->id = XMeta::ID();
	}
	public function GetClassName(){ return $this->__class_name; }

	private $__db_signature;
	private $__db_table_name = null;
	/** @return XMeta */ public function SetDBTableName($value){ $this->__db_table_name = $value; return $this; }
	public function GetDBTableName(){ return $this->__db_table_name; }

	private $__db_sequence = null;
	/** @return XMeta */ public function SetDBSequence($value){ $this->__db_sequence = $value; return $this; }
	public function GetDBSequence(){ return $this->__db_sequence; }

	private $__xml_tag_name = null;
	/** @return XMeta */ public function SetXmlTagName($value){ $this->__xml_tag_name = $value; return $this;}
	public function GetXmlTagName(){ return $this->__xml_tag_name===null ? $this->__class_name : $this->__xml_tag_name; }

	/** @var XOrderBy */
	private $__order_by = null;
	/** @return XMeta */
	public function SetOrderBy($order_by_or_field, $desc=false) {
		if($order_by_or_field instanceof XMetaField)
			$this->__order_by = $order_by_or_field->Order($desc);
		elseif($order_by_or_field instanceof XOrderBy)
			$this->__order_by = $order_by_or_field;
		else
			$this->__order_by = null;
		return $this;
	}
	/** @return XOrderBy|null */
	public function GetOrderBy(){ return $this->__order_by; }

	/** @var XMetaField|null */ private $__class_name_db_field = null;
	/** @return XMetaField|null */public function GetClassNameDBField(){ return $this->__class_name_db_field; }
	/** @return XMeta */
	public function SetClassNameDBField(XMetaField $value){
		if ($this->__class_name_db_field !== null) throw new Exception('Cannot inherit a second class name db field.');
		$this->__class_name_db_field = $value;
		return $this;
	}

	/** @var XMeta|null */ private $__parent = null;
	/** @var bool     */ private $__shares_db_table = false;
	/** @var bool     */ private $__shares_class_name_db_field = false;
	/** @return bool  */ public function SharesDBTableWithParent(){ return $this->__shares_db_table; }
	/** @return bool  */ public function SharesClassNameDBFieldWithRoot(){ return $this->__shares_class_name_db_field; }
	/** @return XMeta */ public function GetParent(){ return $this->__parent; }
	/** @return XMeta */ public function GetRoot(){ return $this->__parent === null ? $this : $this->__parent->GetRoot(); }
	/** @return XMeta */ public function GetDBParent(){ return $this->__shares_db_table && $this->__parent !== null ? $this->__parent->GetDBParent() : $this->__parent; }
	/** @return XMeta */ public function GetDBRoot(){ return $this->__parent === null || $this->__parent->__class_name_db_field === null ? $this : $this->__parent->GetDBRoot(); }

	/** @return XMeta */
	public function Inherit(XMeta $parent, $share_db_table = false){
		if ($this->__parent !== null) throw new Exception('Cannot inherit a second meta class.');
		$this->__parent = $parent;
		$this->__class_name_db_field = $parent->__class_name_db_field;
		$this->__shares_db_table = $share_db_table;
		if ($share_db_table) {
			$this->__db_table_name = $parent->__db_table_name;
			$this->__shares_class_name_db_field = $parent->__shares_class_name_db_field;
		}
		$this->Merge($parent);
		return $this;
	}

	/** @return XMeta */
	public function Merge(XMeta $trait){
		foreach ($trait->GetFields() as $key=>$field)
			if (!property_exists($this,$key))
				$this->$key = clone $field;
		return $this;
	}



	/** @var string|null */  private $__depends_on = null;
	/** @var closure|null */ private $__dependency = null;
	public function SetDependency( $value ){ $this->__dependency = $value; }


	public function Compile(){
		$this->__fields = array();
		$this->__db_fields = array();
		$this->__my_db_fields = array();
		$this->__xml_fields = array();
		$this->__slaves = array();
		$this->__db_slaves = array();
		$this->__xml_slaves = array();
		$db_parent = $this->GetDBParent();
		$parent_fields = $db_parent === null ? null : $this->__parent->GetFields();
		/** @var $value XMetaField|XMetaSlave */
		foreach ($this as $key=>$value){
			$is_field = $value instanceof XMetaField;
			$is_slave = $value instanceof XMetaSlave;
			if (!$is_field && !$is_slave) continue;
			if ($key==='__class_name_db_field') continue;
			$value->SetMeta($this);
			$value->SetName($key);
			if ($value->GetLabel() == null) $value->WithLabel(oxy::txt($key));
			if ($is_field) {
				if ($key !== 'id') {
					$this->__fields[$key] = $value;
					if ($value->IsDBBound()) {
						$this->__db_fields[$key] = $value;
						if ($parent_fields === null || !isset($parent_fields[$key])) $this->__my_db_fields[$key] = $value;
					}
					if ($value->IsXmlBound()) $this->__xml_fields[$key] = $value;
				}
			}
			else {
				$this->__slaves[$key] = $value;
				if ($value->IsDBBound()) $this->__db_slaves[$key] = $value;
				if ($value->IsXmlBound()) $this->__xml_slaves[$key] = $value;
			}
		}
		$s = '';
		for ($m = $this; $m!==null; $m = $m->GetParent()){
			$s .= $m->__class_name;
			$s .= '|';
			$s .= $m->__db_table_name;
		}
		$this->__db_signature = Oxygen::Hash32($s);
		$g = $this->__dependency;
		if ($g!==null) $this->__depends_on = $g();
	}

	private $__fields;
	public function GetFields(){ return $this->__fields; }

	private $__db_fields;
	private $__my_db_fields;
	public function GetDBFields($same_table_only = false){ return $same_table_only ? $this->__db_fields : $this->__my_db_fields; }

	private $__xml_fields;
	public function GetXmlFields(){ return $this->__xml_fields; }

	private $__slaves;
	public function GetSlaves(){ return $this->__slaves; }

	private $__db_slaves;
	public function GetDBSlaves(){ return $this->__db_slaves; }

	private $__xml_slaves;
	public function GetXmlSlaves(){ return $this->__xml_slaves; }


	public function IsEqualTo(XMeta $c){
		return $this->__class_name === $c->GetClassName();
	}

















	//
	//
	// Singleton
	//
	//
	private static $__cache_all = array(); // $class_name.$depends_on => XMeta
	private static $__cache_last_used = array(); // $class_name => XMeta;
	/** @return XMeta */
	public static function Of($class_name){
		/** @var $r XMeta */
		$r = null;
		if (isset(self::$__cache_last_used[$class_name])) {
			$r = self::$__cache_last_used[$class_name];
			$g = $r->__dependency;
			if ($g===null) return $r;
			$depends_on = $g();
			if ($depends_on == $r->__depends_on) return $r;
			$key = $class_name . $depends_on;
			if (isset(self::$__cache_all[$key])) {
				$r = self::$__cache_all[$key];
				self::$__cache_last_used[$class_name] = $r;
				return $r;
			}
		}
		$propagate_source = $r;

		$r = new XMeta($class_name);
		$m = new ReflectionMethod($class_name,'FillMeta');
		$m->invoke(null,$r);
		$r->Compile();

		if ($propagate_source!==null) {
			$r->__remote_cache_is_trusted = $propagate_source->__remote_cache_is_trusted;
		}

		$key = $class_name;
		if ($r->__depends_on!==null) $key .= $r->__depends_on;
		self::$__cache_all[$key] = $r;
		self::$__cache_last_used[$class_name] = $r;
		return $r;
	}

	public static function SoftResetItemCaches() { /** @var $m XMeta */ foreach (self::$__cache_all as $m) $m->SoftResetItemCache(); }




	/** @return ID */
	public function GetNextPermID(){
		$cx = $this->GetRoot();
		if ($cx->id->IsDBAliasComplex())
			return $cx->GetNextTempID();
		$sequence = $cx->GetDBSequence();
		if ($sequence!==null)
			return ID::GetNextPermIDFromSequence($sequence);
		return ID::GetNextPermID($cx->GetDBTableName(),$cx->id->GetDBName());
	}
	/** @return ID */ public function GetNextTempID(){ $cx = $this->GetRoot(); return ID::GetNextTempID($cx->GetDBSequence()); }















	//
	//
	// Items
	//
	//
	/** @return XList */
	public function MakeItemList(){ return new XList($this); }

	/** @return XList */
	public function SeekItems(){ return new XList($this,true); }

	/** @return XAggr */
	public function Aggr($selectors){ return new XAggr($this,$selectors); }

	/** @return XItem */
	public final function MakeTempItem($id = null){
		$class_name = $this->__class_name;
		if ($id === null)
			$id = $this->GetNextTempID();
		elseif (!($id instanceof ID))
			$id = new ID($id);
		$r = new $class_name($id,false);
		$class_name_db_field = $this->GetClassNameDBField();
		if ($class_name_db_field !== null) {
			$n = $class_name_db_field->GetName();
			$r->$n = $class_name;
		}
		//$this->SaveInCache($id->AsInt(),$r); // this is under question.
		return $r;
	}

	/** @return XItem */
	public final function MakePermItem($id = null){
		$class_name = $this->__class_name;
		if ($id === null) {
			if ($this->id->IsDBAliasComplex())
				$id = $this->GetNextTempID();
			else
				$id = $this->GetNextPermID();
		}
		if (!$id instanceof ID) $id = new ID($id);
		$r = new $class_name($id,true);
		$class_name_db_field = $this->GetClassNameDBField();
		if ($class_name_db_field !== null) {
			$n = $class_name_db_field->GetName();
			$r->$n = $class_name;
		}
		if (!$this->id->IsDBAliasComplex()) $this->SaveInCache($id->AsInt(),$r);
		return $r;
	}

	/** @return XItem|null */
	public final function PickItem($id,DBReader $dr=null) {
		if ($id===null) return null;
		if (!($id instanceof ID)) $id = new ID($id);
		$idi = $id->AsInt();
		if ($this->ExistsInLocalCache($idi)) return $this->PickFromLocalCache($idi);
		/** @var $r XItem */
		$r = $this->PickFromRemoteCache($idi);
		if ($r===null) {
			$meta = $this;
			if ($this->__class_name_db_field !== null) {
				if (!array_key_exists($idi,$this->__item_concrete_meta_cache)) {
					$class_name = null;
					if ($this->__shares_class_name_db_field) {
						$n = $this->__class_name_db_field->GetDBAlias();
						if ($dr->OffsetExists($n)) $this->__item_concrete_meta_cache[$idi] = $dr[$n]->AsStringOrNull();
					}
					if ($class_name === null) {
						$class_name = Database::ExecuteScalar('SELECT '.new SqlIden($this->__class_name_db_field->GetDBAlias()).' FROM '.new SqlIden($this->GetDBRoot()->GetDBTableName()).' WHERE '.new SqlIden($this->id->GetDBName()).'=?',$id)->AsStringOrNull();
					}
					$this->__item_concrete_meta_cache[$idi] = $class_name===null ? null : XMeta::Of( $class_name );
				}
				/** @var $m XMeta */
				$meta = $this->__item_concrete_meta_cache[$idi];
				if ($meta === null) $meta = $this;
			}

			if ($meta !== $this) {
				$r = $meta->PickItem($id);
			}
			else {
				$class_name = $this->__class_name;
				$r = new $class_name($id,true);
				if (!$r->Load($dr))
					$r = null;
				elseif ($this->__class_name_db_field !== null) {
					$n = $this->__class_name_db_field->GetName();
					if ($r->$n !== $class_name) $r = null;
				}
			}
			$this->SaveInCache($idi,$r);
		}
		return $r;
	}



	/** @return XItem */
	public function CopyItem( XItem $item, $with_a_perm_id = false , $id = null , XMetaField $slave_hook_field = null, $slave_hook_id = null){
		$r = clone $item;
		if ($id !== null) {
			if ($id instanceof ID)
				$r->id = $id;
			else
				$r->id = new ID($id);
		}
		if ($slave_hook_field!==null) {
			$n = $slave_hook_field->GetName();
			$r->$n = $slave_hook_id;
		}

		if ($this->id->IsDBAliasComplex()) {
			if ($id === null) $r->id = $this->GetNextTempID();
			$r->has_temp_id = !$with_a_perm_id;
		}
		else {
			if ($id === null ) {
				if ( $with_a_perm_id )
					$r->id = $this->GetNextPermID();
				else
					$r->id = $this->GetNextTempID();
			}
			$r->has_temp_id = !$with_a_perm_id;

			// 1. Clone data folder
			if ($with_a_perm_id && !$item->IsTemporary() && $item->HasDataFolder()) {
				self::copy_folder_recursive($item->GetDataFolder(),$r->GetDataFolder());
			}

			// 2. Clone slaves
			for ($mx = $this; $mx!==null; $mx = $mx->GetParent()){
				$slaves = $mx->GetSlaves();
				/** @var $sl XMetaSlave */
				foreach ($slaves as $sl) {
					$n = $sl->GetName();
					$a = $item->$n;
					$aa = $sl->MakeItemList();
					/** @var $x XItem */
					foreach ($a as $x)
						$aa[] = $x->Copy($with_a_perm_id,null,$sl->GetHookField(),$r->id);
					$r->$n = $aa;
				}
			}

			// 3. Save in cache
			if ($with_a_perm_id) {
				$this->SaveInCache( $r->id->AsInt(), $r );
			}
		}
		return $r;
	}





	private static function copy_folder_recursive($src,$dst){
		Fs::Ensure($dst);
		foreach (scandir($src) as $f){
			if ($f=='.'||$f=='..') continue;
			if (is_dir("$src/$f")) self::copy_folder_recursive("$src/$f","$dst/$f");
			else copy("$src/$f","$dst/$f");
		}
	}




	//
	//
	// Item Cache
	//
	//
	private $__remote_cache_is_trusted = true;
	private $__item_cache = array();
	private $__item_concrete_meta_cache = array();
	private function SoftResetItemCache(){ $this->__item_cache = array(); $this->__item_concrete_meta_cache = array(); }
	private function ExistsInLocalCache($idi)  { return array_key_exists($idi,$this->__item_cache); }
	/** @return XItem */ private function PickFromLocalCache($idi)  { return $this->__item_cache[$idi]; }
	/** @return XItem */
	private function PickFromRemoteCache($idi) {
		$r = null;
		if ($this->__remote_cache_is_trusted && Oxygen::IsItemCacheEnabled() && Scope::$DATABASE->Contains($this->__class_name.$this->__db_signature.'::'.$idi)) {
			$r = Scope::$DATABASE[$this->__class_name.$this->__db_signature.'::'.$idi];
			if ($r===null || $r instanceof XItem) $this->__item_cache[$idi] = $r; else $r = null;
		}
		return $r;
	}
	public function SetIsRemoteCacheTrusted($value){ $this->__remote_cache_is_trusted = $value; return $this; }
	public function IsRemoteCacheTrusted(){ return $this->__remote_cache_is_trusted; }
	public function SaveInCache($idi,$item)   { $this->__item_cache[$idi] = $item; if (($item===null || !$item->IsTemporary()) && Oxygen::IsItemCacheEnabled()) Scope::$DATABASE[$this->__class_name.$this->__db_signature.'::'.$idi] = $item; }
	public function RemoveFromCache($idi) { unset($this->__item_cache[$idi]);  if (Oxygen::IsItemCacheEnabled()) Scope::$DATABASE[$this->__class_name.$this->__db_signature.'::'.$idi] = null; }
	public function RemoveFromLocalCache($idi) { unset($this->__item_cache[$idi]); }























	private function get_choise_element(DOMElement $parent){
		$xml = $parent->ownerDocument;
		$x = $parent;
		$xx = $x->firstChild;
		if ($xx===null || $xx->tagName != 'xs:complexType'){
			$xxx = $xml->createElementNS(Xml::XS,'xs:complexType');
			$xx = $xx===null ? $x->appendChild($xxx) : $x->insertBefore($xxx,$xx);
		}
		$x = $xx;
		$xx = $x->firstChild;
		if ($xx===null || $xx->tagName != 'xs:choice'){
			$xxx = $xml->createElementNS(Xml::XS,'xs:choice');
			$xx = $xx===null ? $x->appendChild($xxx) : $x->insertBefore($xxx,$xx);
			$xx->setAttribute('minOccurs','0');
			$xx->setAttribute('maxOccurs','unbounded');
		}
		return $xx;
	}
	private function get_exported_already(DOMElement $parent,$name){
		$x = $parent;
		$x = $x->firstChild; if ($x===null || $x->tagName != 'xs:complexType') return null;
		$x = $x->firstChild; if ($x===null || $x->tagName != 'xs:choice') return null;
		foreach ($x->childNodes as $xx){
			if ($xx->nodeType != XML_ELEMENT_NODE) continue;
			if ($xx->nodeName != 'xs:element') continue;
			if ($xx->getAttribute('name') == $name) return $x;
		}
		return null;
	}
	public function ExportXsd(DOMElement $parent,$meta_fields_to_be_ignored=array()){
		$r = $this->get_exported_already($parent,$this->GetXmlTagName());
		if ($r!==null) return $r;
		$xml = $parent->ownerDocument;
		$parent_choice = $this->get_choise_element($parent);
		/** @var $r DOMElement */
		$r = $parent_choice->appendChild($xml->createElementNS(Xml::XS,'xs:element'));
		$r->setAttribute('name',$this->GetXmlTagName());
		$r->setAttribute('minOccurs','0');
		$r->setAttribute('maxOccurs','unbounded');
		$e = $r->appendChild($xml->createElementNS(Xml::XS,'xs:complexType'));
		/** @var $f XMetaField */
		foreach ($this->GetXmlFields() as $f){
			$found = false; foreach ($meta_fields_to_be_ignored as $ff) if ($f->IsEqualTo($ff)) { $found = true; break; }
			if ($found) continue;
			if ($f->GetXmlBehaviour() == Xml::Element){
				$c = $this->get_choise_element($r);
				/** @var $x DOMElement */
				$x = $c->appendChild($xml->createElementNS(Xml::XS,'xs:element'));
				$x->setAttribute('name',$f->GetXmlName());
				$x->setAttribute('minOccurs','0');
				$x->setAttribute('maxOccurs','1');
			}
			else {
				/** @var $x DOMElement */
				$x = $e->appendChild($xml->createElementNS(Xml::XS,'xs:attribute'));
				$x->setAttribute('name',$f->GetXmlName());
			}
			$enum = $f->GetXmlEnum();
			if ($enum===null)
				$x->setAttribute('type',$f->GetXsdType());
			else {
				$x = $x->appendChild($xml->createElementNS(Xml::XS,'xs:simpleType'));
				$x = $x->appendChild($xml->createElementNS(Xml::XS,'xs:restriction'));
				$x->setAttribute('base','xs:string');
				foreach ($enum as $value){
					/** @var $xx DOMElement */
					$xx = $x->appendChild($xml->createElementNS(Xml::XS,'xs:enumeration'));
					$xx->setAttribute('value',$value);
				}
			}
		}
		/** @var $sl XMetaSlave */
		foreach ($this->GetXmlSlaves() as $sl){
			$sl->GetHookMeta()->ExportXsd($r,array($sl->GetHookField()));
		}
		return $r;
	}







	/** @return XMetaField */ public static function String()         { return new XMetaField( MetaString::Type() ); }
	/** @return XMetaField */ public static function StringOrNull()   { return new XMetaField( MetaStringOrNull::Type() ); }
	/** @return XMetaField */ public static function Integer()        { return new XMetaField( MetaInteger::Type() ); }
	/** @return XMetaField */ public static function IntegerOrNull()  { return new XMetaField( MetaIntegerOrNull::Type() ); }
	/** @return XMetaField */ public static function Decimal()        { return new XMetaField( MetaDecimal::Type() ); }
	/** @return XMetaField */ public static function DecimalOrNull()  { return new XMetaField( MetaDecimalOrNull::Type() ); }
	/** @return XMetaField */ public static function Boolean()        { return new XMetaField( MetaBoolean::Type() ); }
	/** @return XMetaField */ public static function BooleanOrNull()  { return new XMetaField( MetaBooleanOrNull::Type() ); }
	/** @return XMetaField */ public static function ID()             { return new XMetaField( MetaID::Type() ); }
	/** @return XMetaField */ public static function Date()           { return new XMetaField( MetaDate::Type() ); }
	/** @return XMetaField */ public static function DateOrToday()    { return new XMetaField( MetaDateOrToday::Type() ); }
	/** @return XMetaField */ public static function DateTime()       { return new XMetaField( MetaDateTime::Type() ); }
	/** @return XMetaField */ public static function DateTimeOrNow()  { return new XMetaField( MetaDateTimeOrNow::Type() ); }
	/** @return XMetaField */ public static function Time()           { return new XMetaField( MetaTime::Type() ); }
	/** @return XMetaField */ public static function TimeOrCurrent()  { return new XMetaField( MetaTimeOrCurrent::Type() ); }
	/** @return XMetaField */ public static function TimeOrMidnight() { return new XMetaField( MetaTimeOrMidnight::Type() ); }
	/** @return XMetaField */ public static function TimeSpan()       { return new XMetaField( MetaTimeSpan::Type() ); }
	/** @return XMetaField */ public static function TimeSpanOrZero() { return new XMetaField( MetaTimeSpanOrZero::Type() ); }
	/** @return XMetaField */ public static function Lemma()          { return new XMetaField( MetaLemma::Type() ); }
	/** @return XMetaField */ public static function LemmaOrEmpty()   { return new XMetaField( MetaLemmaOrEmpty::Type() ); }

	/** @return XMetaField */ public static function IntegerArray()        { return new XMetaField( MetaIntegerArray::Type() ); }
	/** @return XMetaField */ public static function IntegerArrayOrNull()  { return new XMetaField( MetaIntegerArrayOrNull::Type() ); }
	/** @return XMetaField */ public static function StringArray()         { return new XMetaField( MetaStringArray::Type() ); }
	/** @return XMetaField */ public static function StringArrayOrNull()   { return new XMetaField( MetaStringArrayOrNull::Type() ); }
	/** @return XMetaField */ public static function IDArray()             { return new XMetaField( MetaIDArray::Type() ); }
	/** @return XMetaField */ public static function IDArrayOrNull()       { return new XMetaField( MetaIDArrayOrNull::Type() ); }

	/** @return XMetaSlave */ public static function Slave(XMetaField $hook_meta_field){ return new XMetaSlave($hook_meta_field); }
}







<?php

class XMeta extends stdClass {
	public $id;
	private $__classname;
	private function __construct($classname){
		$this->__classname=$classname;
		$this->id = MetaID::Field();
	}
	public function GetClassName(){ return $this->__classname; }

	private $__db_signature;
	private $__db_table_name = null;
	/** @return XMeta */ public function SetDBTableName($value){ $this->__db_table_name = $value; return $this; }
	public function GetDBTableName(){ return is_null($this->__db_table_name) ? $this->__classname : $this->__db_table_name; }

	private $__db_sequence = null;
	/** @return XMeta */ public function SetDBSequence($value){ $this->__db_sequence = $value; return $this; }
	public function GetDBSequence(){ return is_null($this->__db_sequence) ? $this->GetDBTableName() : $this->__db_sequence; }

	private $__xml_tag_name = null;
	/** @return XMeta */ public function SetXmlTagName($value){ $this->__xml_tag_name = $value; return $this;}
	public function GetXmlTagName(){ return is_null($this->__xml_tag_name) ? $this->__classname : $this->__xml_tag_name; }

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

	private $__abstract_dbfield_name = null;
	/** @return XMeta */ public function SetAbstractDBFieldName($value){ $this->__abstract_dbfield_name = $value; return $this; }
	public function GetAbstractDBFieldName(){ return $this->__abstract_dbfield_name; }
	public function IsAbstract(){ return !is_null($this->__abstract_dbfield_name); }

	private $__parent = null;
	/** @return XMeta */ public function SetParent(XMeta $parent = null){ $this->__parent = $parent; return $this; }
	/** @return XMeta */ public function GetParent(){ return $this->__parent; }
	/** @return XMeta */ public function GetRoot(){ return is_null($this->__parent) ? $this : $this->GetParent()->GetRoot(); }




	public function Compile(){
		$this->__fields = array();
		$this->__dbfields = array();
		$this->__xmlfields = array();
		$this->__slaves = array();
		$this->__dbslaves = array();
		$this->__xmlslaves = array();
		foreach ($this as $key=>$value){
			$is_field = $value instanceof XMetaField;
			$is_slave = $value instanceof XMetaSlave;
			if ($is_field || $is_slave) {
				$value->SetMeta($this);
				$value->SetName($key);
				if ($value->GetLabel() == null) $value->WithLabel(Lemma::Pick($key));

				if ($is_field) {
					if ($key !== 'id') {
						$this->__fields[$key] = $value;
						if ($value->IsDBBound()) $this->__dbfields[$key] = $value;
						if ($value->IsXmlBound()) $this->__xmlfields[$key] = $value;
					}
				}
				else {
					$this->__slaves[$key] = $value;
					if ($value->IsDBBound()) $this->__dbslaves[$key] = $value;
					if ($value->IsXmlBound()) $this->__xmlslaves[$key] = $value;
				}
			}
		}
		$s = '';
		for ($m = $this; !is_null($m); $m = $m->GetParent()){
			$s .= $m->__classname;
			$s .= '|';
			$s .= $m->__db_table_name;
		}
		$this->__db_signature = Oxygen::Hash32($s);
	}

	private $__fields;
	public function GetFields(){ return $this->__fields; }

	private $__dbfields;
	public function GetDBFields(){ return $this->__dbfields; }

	private $__xmlfields;
	public function GetXmlFields(){ return $this->__xmlfields; }

	private $__slaves;
	public function GetSlaves(){ return $this->__slaves; }

	private $__dbslaves;
	public function GetDBSlaves(){ return $this->__dbslaves; }

	private $__xmlslaves;
	public function GetXmlSlaves(){ return $this->__xmlslaves; }


	public function IsEqualTo(XMeta $c){
		return $this->__classname == $c->GetClassName();
	}















	

	//
	//
	// Singleton
	//
	//
	private static $__cache = array();
	/** @return XMeta */
	public static function Of($classname){
		if (!isset(self::$__cache[$classname])) {
			self::$__cache[$classname] = new XMeta($classname);
			$m = new ReflectionMethod($classname,'FillMeta');
			$m->invoke(null,self::$__cache[$classname]);
			self::$__cache[$classname]->Compile();
		}
		return self::$__cache[$classname];
	}

	public static function SoftResetItemCaches() { /** @var $m XMeta */ foreach (self::$__cache as $m) $m->SoftResetItemCache(); }




	/** @return ID */ public function GetNextPermID(){ return ID::GetNextPermID($this->GetDBSequence(),$this->id->GetDBName()); }
	/** @return ID */ public function GetNextTempID(){ return ID::GetNextTempID($this->GetDBSequence()); }















	//
	//
	// Items
	//
	//
	/** @return XList */
	public function MakeItemList(){ return new XList($this); }

	/** @return XList */
	public function SeekItems(){ return new XList($this,true); }

	/** @return XItem */
	public final function MakeTempItem($id = null){
		$classname = $this->__classname;
		if (is_null($id))
			$id = $this->GetNextTempID();
		elseif (!($id instanceof ID))
			$id = new ID($id);
		$r = new $classname($id,false);
		//$this->SaveInCache($id->AsInt(),$r); // this is under question.
		return $r;
	}

	/** @return XItem */
	public final function MakePermItem(){
		$classname = $this->__classname;
		if ($this->id->IsDBAliasComplex())
			$id = $this->GetNextTempID();
		else
			$id = $this->GetNextPermID();
		$r = new $classname($id,true);
		if (!$this->id->IsDBAliasComplex()) $this->SaveInCache($id->AsInt(),$r);
		return $r;
	}

	/** @return XItem|null */
	public final function PickItem($id,DBReader $dr=null) {
		if (is_null($id)) return null;
		if (!($id instanceof ID)) $id = new ID($id);
		$idi = $id->AsInt();
		if ($this->ExistsInLocalCache($idi))
			return $this->PickFromLocalCache($idi);
		elseif ($this->ExistsInRemoteCache($idi))
			return $this->PickFromRemoteCache($idi);
		elseif ($this->IsAbstract()){
			if (!array_key_exists($idi,$this->__item_concrete_meta_cache)) {
				$this->__item_concrete_meta_cache[$idi] = XMeta::Of( Database::ExecuteScalar('SELECT '.$this->GetAbstractDBFieldName().' FROM '.$this->GetDBTableName().' WHERE '.$this->id->GetDBName().'=?',$id)->AsString() );
			}
			/** @var $m XMeta */
			$m = $this->__item_concrete_meta_cache[$idi];
			$x = $m->PickItem($id);
			$this->SaveInCache($idi,$x);
		}
		else {
			/** @var $x XItem */
			$classname = $this->__classname;
			$x = new $classname($id,true);
			$found = $x->Load($dr);
			if (!$found)
				$x = null;
		}
		$this->SaveInCache($idi,$x);
		return $x;
	}



	/** @return XItem */
	public function CopyItem( XItem $item, $with_a_perm_id = false ){
		$r = clone $item;

		if ( $with_a_perm_id )
			$r->id = $this->GetNextPermID();
		else
			$r->id = $this->GetNextTempID();
		$r->has_temp_id = !$with_a_perm_id;

		// 1. Clone data folder
		if ($with_a_perm_id && !$item->IsTemporary() && $item->HasDataFolder()) {
			self::copy_folder_recursive($item->GetDataFolder(),$r->GetDataFolder());
		}

		// 2. Clone slaves
		for ($mx = $this; !is_null($mx); $mx = $mx->GetParent()){
			$slaves = $mx->GetSlaves();
			/** @var $sl XMetaSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$a = $item->$n;
				$aa = $sl->MakeItemList();
				/** @var $x XItem */
				foreach ($a as $x) {
					$xx = $x->Copy($with_a_perm_id);
					$nn = $sl->GetHookField()->GetName();
					$xx->$nn = $r->id;
					$aa[] = $xx;
				}
				$r->$n = $aa;
			}
		}

		// 3. Save in cache
		if ($with_a_perm_id) {
			$this->SaveInCache( $r->id->AsInt(), $r );
		}

		return $r;
	}


	private static function delete_folder_recursive($folder){
		foreach (scandir($folder) as $f){
			if ($f=='.'||$f=='..') continue;
			if (is_dir("$folder/$f")) self::delete_folder_recursive("$folder/$f");
			else unlink("$folder/$f");
		}
		rmdir($folder);
	}
	private static function copy_folder_recursive($src,$dst){
		if (!is_dir($dst)) mkdir($dst,0777,true);
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
	private $__item_cache = array();
	private $__item_concrete_meta_cache = array();
	private function SoftResetItemCache(){ $this->__item_cache = array(); $this->__item_concrete_meta_cache = array(); }
	private function ExistsInLocalCache($idi)  { return array_key_exists($idi,$this->__item_cache); }
	private function PickFromLocalCache($idi)  { return $this->__item_cache[$idi]; }
	private function ExistsInRemoteCache($idi) { return Oxygen::IsItemCacheEnabled() && Scope::$DATABASE->Contains($this->__classname.$this->__db_signature.'::'.$idi); }
	private function PickFromRemoteCache($idi) { return $this->__item_cache[$idi] = Scope::$DATABASE[$this->__classname.$this->__db_signature.'::'.$idi]; }
	public function SaveInCache($idi,$item)   { $this->__item_cache[$idi] = $item; if ((is_null($item) || !$item->IsTemporary()) && Oxygen::IsItemCacheEnabled()) Scope::$DATABASE[$this->__classname.$this->__db_signature.'::'.$idi] = $item; }
	public function RemoveFromCache($idi) { unset($this->__item_cache[$idi]);  if (Oxygen::IsItemCacheEnabled()) Scope::$DATABASE[$this->__classname.$this->__db_signature.'::'.$idi] = null; }























	private function get_choise_element(DOMElement $parent){
		$xml = $parent->ownerDocument;
		$x = $parent;
		$xx = $x->firstChild;
		if (is_null($xx) || $xx->tagName != 'xs:complexType'){
			$xxx = $xml->createElementNS(Xml::XS,'xs:complexType');
			$xx = is_null($xx) ? $x->appendChild($xxx) : $x->insertBefore($xxx,$xx);
		}
		$x = $xx;
		$xx = $x->firstChild;
		if (is_null($xx) || $xx->tagName != 'xs:choice'){
			$xxx = $xml->createElementNS(Xml::XS,'xs:choice');
			$xx = is_null($xx) ? $x->appendChild($xxx) : $x->insertBefore($xxx,$xx);
			$xx->setAttribute('minOccurs','0');
			$xx->setAttribute('maxOccurs','unbounded');
		}
		return $xx;
	}
	private function get_exported_already(DOMElement $parent,$name){
		$x = $parent;
		$x = $x->firstChild; if (is_null($x) || $x->tagName != 'xs:complexType') return null;
		$x = $x->firstChild; if (is_null($x) || $x->tagName != 'xs:choice') return null;
		foreach ($x->childNodes as $xx){
			if ($xx->nodeType != XML_ELEMENT_NODE) continue;
			if ($xx->nodeName != 'xs:element') continue;
			if ($xx->getAttribute('name') == $name) return $x;
		}
		return null;
	}
	public function ExportXsd(DOMElement $parent,$meta_fields_to_be_ignored=array()){
		$r = $this->get_exported_already($parent,$this->GetXmlTagName());
		if (!is_null($r)) return $r;
		$xml = $parent->ownerDocument;
		$parent_choice = $this->get_choise_element($parent);
		$r = $parent_choice->appendChild($xml->createElementNS(Xml::XS,'xs:element'));
		$r->setAttribute('name',$this->GetXmlTagName());
		$r->setAttribute('minOccurs','0');
		$r->setAttribute('maxOccurs','unbounded');
		$e = $r->appendChild($xml->createElementNS(Xml::XS,'xs:complexType'));
		foreach ($this->GetXmlFields() as $f){
			$found = false; foreach ($meta_fields_to_be_ignored as $ff) if ($f->IsEqualTo($ff)) { $found = true; break; }
			if ($found) continue;
			if ($f->GetXmlBehaviour() == Xml::Element){
				$c = $this->get_choise_element($r);
				$x = $c->appendChild($xml->createElementNS(Xml::XS,'xs:element'));
				$x->setAttribute('name',$f->GetXmlName());
				$x->setAttribute('minOccurs','0');
				$x->setAttribute('maxOccurs','1');
			}
			else {
				$x = $e->appendChild($xml->createElementNS(Xml::XS,'xs:attribute'));
				$x->setAttribute('name',$f->GetXmlName());
			}
			$enum = $f->GetXmlEnum();
			if (is_null($enum))
				$x->setAttribute('type',$f->GetXsdType());
			else {
				$x = $x->appendChild($xml->createElementNS(Xml::XS,'xs:simpleType'));
				$x = $x->appendChild($xml->createElementNS(Xml::XS,'xs:restriction'));
				$x->setAttribute('base','xs:string');
				foreach ($enum as $key=>$value){
					$xx = $x->appendChild($xml->createElementNS(Xml::XS,'xs:enumeration'));
					$xx->setAttribute('value',$value);
				}
			}
		}
		foreach ($this->GetXmlSlaves() as $sl){
			$sl->GetHookMeta()->ExportXsd($r,array($sl->GetHookField()));
		}
		return $r;
	}







	/** @return XMetaField */ public static function ID() { return new XMetaField( MetaID::Type() ); }
	/** @return XMetaField */ public static function String() { return new XMetaField( MetaString::Type() ); }
	/** @return XMetaField */ public static function StringOrNull() { return new XMetaField( MetaStringOrNull::Type() ); }
	/** @return XMetaField */ public static function Integer() { return new XMetaField( MetaInteger::Type() ); }
	/** @return XMetaField */ public static function IntegerOrNull() { return new XMetaField( MetaIntegerOrNull::Type() ); }
	/** @return XMetaField */ public static function Decimal() { return new XMetaField( MetaDecimal::Type() ); }
	/** @return XMetaField */ public static function DecimalOrNull() { return new XMetaField( MetaDecimalOrNull::Type() ); }
	/** @return XMetaField */ public static function Boolean() { return new XMetaField( MetaBoolean::Type() ); }
	/** @return XMetaField */ public static function BooleanOrNull() { return new XMetaField( MetaBooleanOrNull::Type() ); }
	/** @return XMetaField */ public static function Date() { return new XMetaField( MetaDate::Type() ); }
	/** @return XMetaField */ public static function DateTime() { return new XMetaField( MetaDateTime::Type() ); }
	/** @return XMetaField */ public static function Time() { return new XMetaField( MetaTime::Type() ); }
	/** @return XMetaField */ public static function TimeSpan() { return new XMetaField( MetaTimeSpan::Type() ); }
	/** @return XMetaField */ public static function Lemma() { return new XMetaField( MetaLemma::Type() ); }

	/** @return XMetaSlave */ public static function Slave(XMetaField $hook_meta_field){ return new XMetaSlave($hook_meta_field); }
}







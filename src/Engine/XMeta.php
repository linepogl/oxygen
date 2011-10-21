<?php

class XMeta extends stdClass {
	public $id;
	private $__classname;
	private function __construct($classname){
		$this->__classname=$classname;
		$this->id = OmniID::Field();
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
		if($order_by_or_field instanceof XField)
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
			$is_field = $value instanceof XField;
			$is_slave = $value instanceof XSlave;
			if ($is_field || $is_slave) {
				$value->SetMeta($this);
				$value->SetName($key);
				if ($value->GetLabel() == null) $value->WithLabel(Lemma::Retrieve($key));

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





	/** @return ID */
	public function GetNextID(){
		return Database::ExecuteGetNextIDFor($this->GetDBSequence(),$this->id->GetDBName());
	}

















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
	public final function MakeItem(){
		$classname = $this->__classname;
		$r = new $classname();
		$this->SaveInCache($r->id->AsInt(),$r);
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
			$x = new $classname($idi);
			$found = $x->Load($dr);
			if (!$found)
				$x = null;
		}
		$this->SaveInCache($idi,$x);
		return $x;
	}
	
	//
	//
	// Item Cache
	//
	//
	private $__item_cache = array();
	private $__item_concrete_meta_cache = array();
	private function ExistsInLocalCache($idi)  { return array_key_exists($idi,$this->__item_cache); }
	private function PickFromLocalCache($idi)  { return $this->__item_cache[$idi]; }
	private function ExistsInRemoteCache($idi) { return Oxygen::IsItemCacheEnabled() && Scope::$DATABASE->Contains($this->__classname.'::'.$this->__db_signature.'::'.$idi); }
	private function PickFromRemoteCache($idi) { return $this->__item_cache[$idi] = Scope::$DATABASE[$this->__classname.'::'.$this->__db_signature.'::'.$idi]; }
	public function SaveInCache($idi,$item)   { $this->__item_cache[$idi] = $item; if (Oxygen::IsItemCacheEnabled()) Scope::$DATABASE[$this->__classname.'::'.$this->__db_signature.'::'.$idi] = $item; }
	public function RemoveFromCache($idi) { unset($this->__item_cache[$idi]);  if (Oxygen::IsItemCacheEnabled()) Scope::$DATABASE[$this->__classname.'::'.$this->__db_signature.'::'.$idi] = null; }
	public static function ResetItemCaches() { /** @var $m XMeta */ foreach (self::$__cache as $m) { $m->__item_cache = array(); $m->__item_concrete_meta_cache = array(); } }























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







	/** @return XField */ public static function ID() { return new XField( OmniIDOrNull::Type() ); }
	/** @return XField */ public static function String() { return new XField( OmniStringOrNull::Type() ); }
	/** @return XField */ public static function Integer() { return new XField( OmniInteger::Type() ); }
	/** @return XField */ public static function NullableInteger() { return new XField( OmniIntegerOrNull::Type() ); }
	/** @return XField */ public static function Float() { return new XField( OmniDecimal::Type() ); }
	/** @return XField */ public static function NullableFloat() { return new XField( OmniDecimalOrNull::Type() ); }
	/** @return XField */ public static function Boolean() { return new XField( OmniBoolean::Type() ); }
	/** @return XField */ public static function NullableBoolean() { return new XField( OmniBooleanOrNull::Type() ); }
	/** @return XField */ public static function Date() { return new XField( OmniDateOrNull::Type() ); }
	/** @return XField */ public static function DateTime() { return new XField( OmniDateTimeOrNull::Type() ); }
	/** @return XField */ public static function Time() { return new XField( OmniTimeTimeOrNull::Type() ); }
	/** @return XField */ public static function TimeSpan() { return new XField( OmniTimeSpanOrNull::Type() ); }
	/** @return XField */ public static function Lemma() { return new XField( OmniLemmaOrNull::Type() ); }

	/** @return XSlave */ public static function Slave(XField $hook_meta_field){ return new XSlave($hook_meta_field); }
}







<?php

class XMeta extends stdClass {
	public $id;
	private $__classname;
	protected function __construct($classname){
		$this->__classname=$classname;
		$this->id = XMeta::ID();
	}
	public function GetClassName(){ return $this->__classname; }

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


	/** @return XList */
	public function MakeListFromDB(){ return new XList($this,true); }

	/** @return XList */
	public function MakeList(){ return new XList($this,false); }


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

	}

	/** @return ID */
	public function GetNextID(){
		return Database::ExecuteGetNextIDFor($this->GetDBSequence(),$this->id->GetDBName());
	}


	private $__fields;
	public function & GetFields(){
		return $this->__fields;
	}

	private $__dbfields;
	public function & GetDBFields(){
		return $this->__dbfields;
	}

	private $__xmlfields;
	public function & GetXmlFields(){
		return $this->__xmlfields;
	}

	private $__slaves;
	public function & GetSlaves(){
		return $this->__slaves;
	}

	private $__dbslaves;
	public function & GetDBSlaves(){
		return $this->__dbslaves;
	}

	private $__xmlslaves;
	public function & GetXmlSlaves(){
		return $this->__xmlslaves;
	}


	public function IsEqualTo(XMeta $c){
		return $this->__classname == $c->GetClassName();
	}



	private static $cache = array();
	/** @deprecated @return XMeta */
	public static function Retrieve($classname){ return self::Pick($classname); }
	/** @return XMeta */
	public static function Pick($classname){
		if (!array_key_exists($classname,self::$cache)) {
			self::$cache[$classname] = new XMeta($classname);
			$m = new ReflectionMethod($classname,'FillMeta');
			$m->invoke(null,self::$cache[$classname]);
			self::$cache[$classname]->Compile();
		}
		return self::$cache[$classname];
	}



















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







	/** @return XField */ public static function ID() { return new XField( NullableID::Type() ); }
	/** @return XField */ public static function String() { return new XField( NullableString::Type() ); }
	/** @return XField */ public static function Integer() { return new XField( JustInteger::Type() ); }
	/** @return XField */ public static function NullableInteger() { return new XField( NullableInteger::Type() ); }
	/** @return XField */ public static function Float() { return new XField( JustDecimal::Type() ); }
	/** @return XField */ public static function NullableFloat() { return new XField( NullableDecimal::Type() ); }
	/** @return XField */ public static function Boolean() { return new XField( JustBoolean::Type() ); }
	/** @return XField */ public static function NullableBoolean() { return new XField( NullableBoolean::Type() ); }
	/** @return XField */ public static function Date() { return new XField( NullableDate::Type() ); }
	/** @return XField */ public static function DateTime() { return new XField( NullableDateTime::Type() ); }
	/** @return XField */ public static function Time() { return new XField( NullableTime::Type() ); }
	/** @return XField */ public static function TimeSpan() { return new XField( NullableTimeSpan::Type() ); }
	/** @return XField */ public static function Lemma() { return new XField( NullableLemma::Type() ); }

	/** @return XSlave */ public static function Slave(XField $hook_meta_field){ return new XSlave($hook_meta_field); }
}







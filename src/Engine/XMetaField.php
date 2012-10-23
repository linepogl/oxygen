<?php

class XMetaField extends XValue {
	/** @var XMeta */
	private $meta;
	/** @return XMeta */
	public function GetMeta(){ return $this->meta; }
	public function SetMeta(XMeta $value){ $this->meta = $value; }

	private $name;
	public function GetName(){ return $this->name; }
	public function SetName($value){ $this->name = $value; if (is_null($this->db_alias)) $this->db_alias = $value; if (is_null($this->xml_alias)) $this->xml_alias = $value; }

	/** @var XType */
	private $type;
	public function __construct(XType $type){ $this->type = $type; }
	/** @return XType */
	public function GetType(){ return $this->type; }
	public function GetXsdType(){
		return is_null($this->xml_foreign_field)
			? $this->type->GetXsdType()
			: $this->xml_foreign_field->type->GetXsdType()
			;
	}

	public function MetaType(){ return MetaMetaField::Type(); }
	public function __toString(){
		return strval($this->GetLabel());
	}
	public function ToSql(){ return new SqlName($this); }

	
	private $db_alias;
	private $is_db_alias_complex = false;
	/** @return XMetaField */
	public function WithDBAlias($value){ $this->db_alias = strval($value); $this->is_db_alias_complex=false; return $this; }
	public function WithDBComplexAlias($value){ $this->db_alias = strval($value); $this->is_db_alias_complex=true; return $this; }
	public function GetDBAlias(){ return $this->db_alias; }
	public function GetDBName(){ return $this->db_alias; }
	public function IsDBAliasComplex(){ return $this->is_db_alias_complex; }

	private $xml_alias = null;
	/** @return XMetaField */
	public function WithXmlAlias($value){ $this->xml_alias = $value; return $this; }
	public function GetXmlAlias(){ return $this->xml_alias; }
	public function GetXmlName(){ return $this->xml_alias; }

	private $is_db_bound = true;
	/** @return XMetaField */
	public function WithIsDBBound($value){ $this->is_db_bound = $value; return $this; }
	public function IsDBBound(){ return $this->is_db_bound; }

	private $is_xml_bound = true;
	/** @return XMetaField */
	public function WithIsXmlBound($value){ $this->is_xml_bound = $value; return $this; }
	public function IsXmlBound(){ return $this->is_xml_bound; }

	private $label;
	public function GetLabel(){ return $this->label; }
	/** @return XMetaField */
	public function WithLabel($args){
		if ($args instanceof Lemma)
			$this->label = $args;
		else {
			$a = func_get_args();
      $z = func_num_args();
      if ($z == 1)
        $this->label = Lemma::Pick($a[0]);
      else
			  $this->label = new Lemma($a);
		}
		return $this;
	}


	private $xml_behaviour = Xml::Attribute;
	/** @return XMetaField */
	public function WithXmlBehaviour($value){ $this->xml_behaviour = $value; return $this; }
	public function GetXmlBehaviour(){ return $this->xml_behaviour; }

	private $xml_foreign_field = null;
	/** @return XMetaField */
	public function WithXmlForeignField($value){ $this->xml_foreign_field = $value; return $this; }
	/** @return XMetaField */
	public function GetXmlForeignField(){ return $this->xml_foreign_field; }

	private $xml_exporter = null;
	/**
	@param void function($value,XmlExportState $state)
	@return XMetaField
	*/
	public function WithXmlExporter($value){ $this->xml_exporter = $value; return $this; }
	public function GetXmlExporter(){ return $this->xml_exporter; }

	private $xml_importer = null;
	/**
	@param void function($value,XmlImportState $state,Validator $v)
	@return XMetaField
	*/
	public function WithXmlImporter($value){ $this->xml_importer = $value; return $this; }
	public function GetXmlImporter(){ return $this->xml_importer; }

	/** @var Enum|null */
	private $xml_enum = null;
	/** @return XMetaField */
	public function WithXmlEnum($value){
		$this->xml_enum = $value instanceof Enum
			? new Enum($value->GetInnerArray())
			: new Enum($value);
		return $this;
	}
	/** @return XMetaField */
	public function WithXmlEnumMap($value){
		$this->xml_enum = $value instanceof Enum
			? new Enum($value->GetInnerArray(),true)
			: new Enum($value,true);
		return $this;
	}
	/** @return Enum */
	public function GetXmlEnum(){ return $this->xml_enum; }

	private $xml_import_phase = 0;
	/** @return XMetaField */
	public function WithXmlImportPhase($value){ $this->xml_import_phase = $value; return $this; }
	public function GetXmlImportPhase(){ return $this->xml_import_phase; }




	public function IsEqualTo( $x ){
		if ( $x instanceof XMetaField ) return $this->meta->GetClassName() == $x->meta->GetClassName() && $this->name == $x->GetName();
		return parent::IsEqualTo( $x );
	}
	public function CompareTo( $x ){
		if ( $x instanceof XMetaField ) { $r = strcmp($this->meta->GetClassName(),$x->meta->GetClassName()); return $r == 0 ? strcmp($this->name,$x->GetName()) : $r; }
		return parent::CompareTo( $x );
	}




	


	/** @return XPred */ public function Eq($field_or_value){ return new XPredFieldOp($this,$field_or_value,XPredFieldOp::OP_EQ); }
	/** @return XPred */ public function NotEq($field_or_value){ return new XPredFieldOp($this,$field_or_value,XPredFieldOp::OP_NOT_EQ); }
	/** @return XPred */ public function IsNull(){ return new XPredFieldOp($this,null,XPredFieldOp::OP_EQ); }
	/** @return XPred */ public function IsNotNull(){ return new XPredFieldOp($this,null,XPredFieldOp::OP_NOT_EQ); }
	/** @return XPred */ public function Lt($field_or_value){ return new XPredFieldOp($this,$field_or_value,XPredFieldOp::OP_LT); }
	/** @return XPred */ public function Le($field_or_value){ return new XPredFieldOp($this,$field_or_value,XPredFieldOp::OP_LE); }
	/** @return XPred */ public function Gt($field_or_value){ return new XPredFieldOp($this,$field_or_value,XPredFieldOp::OP_GT); }
	/** @return XPred */ public function Ge($field_or_value){ return new XPredFieldOp($this,$field_or_value,XPredFieldOp::OP_GE); }
	/** @return XPred */ public function In($field_or_value){ return new XPredFieldOp($this,$field_or_value,XPredFieldOp::OP_IN); }
	/** @return XPred */ public function NotIn($field_or_value){ return new XPredFieldOp($this,$field_or_value,XPredFieldOp::OP_NOT_IN); }
	/** @return XPred */ public function Like($field_or_value){ return new XPredFieldOp($this,$field_or_value,XPredFieldOp::OP_LIKE); }
	/** @return XPred */ public function NotLike($field_or_value){ return new XPredFieldOp($this,$field_or_value,XPredFieldOp::OP_NOT_LIKE); }

	/** @return XOrderBy */ public function Order($desc = false){ return new XOrderByField($this,$desc); }
	/** @return XOrderBy */ public function Asc(){ return new XOrderByField($this,false); }
	/** @return XOrderBy */ public function Desc(){ return new XOrderByField($this,true); }

	/** @return XFuncField */ public function Count(){ return new XFuncField($this,XFuncField::COUNT); }
	/** @return XFuncField */ public function CountDistinct(){ return new XFuncField($this,XFuncField::COUNT_DISTINCT); }
	/** @return XFuncField */ public function Sum(){ return new XFuncField($this,XFuncField::SUM); }
	/** @return XFuncField */ public function Avg(){ return new XFuncField($this,XFuncField::AVG); }
	/** @return XFuncField */ public function Min(){ return new XFuncField($this,XFuncField::MIN); }
	/** @return XFuncField */ public function Max(){ return new XFuncField($this,XFuncField::MAX); }

	/** @return XFuncField */ public function HashYear(){ return new XFuncField($this,XFuncField::HASH_YEAR); }
	/** @return XFuncField */ public function HashMonth(){ return new XFuncField($this,XFuncField::HASH_MONTH); }
	/** @return XFuncField */ public function HashDay(){ return new XFuncField($this,XFuncField::HASH_DAY); }
	/** @return XFuncField */ public function HashWeekDay(){ return new XFuncField($this,XFuncField::HASH_WEEKDAY); }
	/** @return XFuncField */ public function HashHour(){ return new XFuncField($this,XFuncField::HASH_HOUR); }
	/** @return XFuncField */ public function HashExactDay(){ return new XFuncField($this,XFuncField::HASH_EXACT_DAY); }
	/** @return XFuncField */ public function HashExactMonth(){ return new XFuncField($this,XFuncField::HASH_EXACT_MONTH); }
}



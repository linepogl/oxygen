<?php

class XMetaField implements OmniValue {
	/** @var XMeta */
	private $meta;
	/** @return XMeta */
	public function GetMeta(){ return $this->meta; }
	public function SetMeta(XMeta $value){ $this->meta = $value; }

	private $name;
	public function GetName(){ return $this->name; }
	public function SetName($value){ $this->name = $value; if (is_null($this->db_alias)) $this->db_alias = $value; if (is_null($this->xml_alias)) $this->xml_alias = $value; }

	/** @var OmniType */
	private $type;
	public function __construct(OmniType $type){ $this->type = $type; }
	/** @return OmniType */
	public function GetType(){ return $this->type; }
	public function GetXsdType(){
		return is_null($this->xml_foreign_field)
			? $this->type->GetXsdType()
			: $this->xml_foreign_field->type->GetXsdType()
			;
	}

	public function OmniType(){ return OmniMetaField::Type(); }
	public function __toString(){
		return strval($this->GetLabel());
	}

	
	private $db_alias;
	private $db_alias_complex;
	/** @return XMetaField */
	public function WithDBAlias($value){ $this->db_alias = $value; $this->db_alias_complex=false; return $this; }
	public function WithDBComplexAlias($value){ $this->db_alias = $value; $this->db_alias_complex=true; return $this; }
	public function GetDBAlias(){ return $this->db_alias; }
	public function GetDBName(){ return $this->db_alias; }
	public function IsDBAliasComplex(){ return $this->db_alias_complex; }

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

	private $xml_enum = null;
	/** @return XMetaField */
	public function WithXmlEnum($value){
		$this->xml_enum = $value instanceof Enum
			? $value
			: Enum::From($value);
		return $this;
	}
	/** @return Enum */
	public function GetXmlEnum(){ return $this->xml_enum; }

	private $xml_import_phase = 0;
	/** @return XMetaField */
	public function WithXmlImportPhase($value){ $this->xml_import_phase = $value; return $this; }
	public function GetXmlImportPhase(){ return $this->xml_import_phase; }

	public function IsEqualTo(XMetaField $f){
		return $this->name == $f->GetName() && $this->meta->IsEqualTo($f->GetMeta());
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

}


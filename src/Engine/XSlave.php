<?php

class XSlave {
	private $metaclass;
	/** @return XMeta */
	public function GetMeta(){ return $this->metaclass; }
	public function SetMeta(XMeta $value){ $this->metaclass = $value; }

	private $name;
	public function GetName(){ return $this->name; }
	public function SetName($value){ $this->name = $value; }

	private $is_aggressive = true;
	public function SetIsAggressive($value){ $this->is_aggressive = $value; return $this; }
	public function IsAggressive(){ return $this->is_aggressive; }

	private $hook_meta_field;
	public function __construct(XField $hook_meta_field){ $this->hook_meta_field = $hook_meta_field; }
	/** @return XMeta */ public function GetHookMeta(){ return $this->hook_meta_field->GetMeta(); }
	/** @return XField */ public function GetHookField(){ return $this->hook_meta_field; }


	/** @return XList */
	public function MakeListFromDB(XItem $master_item){
		$hook_field = $this->GetHookField();
		$a = $hook_field->GetMeta()->MakeListFromDB()
			->SetIsAggressive($this->is_aggressive)
			->Where($hook_field->Eq($master_item))
			->Where($this->Where);
		if (!is_null($this->OrderBy)) $a->OrderBy($this->OrderBy);
		return $a;
	}

	private $label;
	public function GetLabel(){ return $this->label; }
	/** @return XSlave */
	public function WithLabel($args){
		if ($args instanceof Lemma)
			$this->label = $args;
		else {
			$a = func_get_args();
      $z = func_num_args();
      if ($z == 1)
        $this->label = Lemma::Retrieve($a[0]);
      else
			  $this->label = new Lemma($a);
		}
		return $this;
	}

	/** @var XPred */
	public $Where = null;
	/** @return XSlave */
	public function WithWhere(XPred $value){ $this->Where=$value; return $this; }

	/** @var XOrderBy */
	public $OrderBy = null;
	/** @return XSlave */
	public function WithOrderBy($value){ $this->OrderBy=$value; return $this; }


	private $is_db_bound = true;
	/** @return XSlave */
	public function WithIsDBBound($value){ $this->is_db_bound = $value; return $this; }
	public function IsDBBound(){ return $this->is_db_bound; }

	private $is_xml_bound = true;
	/** @return XSlave */
	public function WithIsXmlBound($value){ $this->is_xml_bound = $value; return $this; }
	public function IsXmlBound(){ return $this->is_xml_bound; }
}


?>
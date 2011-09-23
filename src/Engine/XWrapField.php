<?php

class XWrapField {

	/** @var XWrap */
	private $wrap;

	/** @var XField */
	private $field;

	public function __construct(XWrap $wrap,XField $field){
		$this->wrap = $wrap;
		$this->field = $field;
	}

	/** @return XWrap */
	public function GetWrap(){ return $this->wrap; }

	/** @return XItem */
	public function GetItem(){ return $this->wrap->GetItem(); }

	/** @return XField */
	public function GetField(){ return $this->field; }
	
	public function GetValue(){
		$o = $this->wrap->GetItem();
		$f = $this->field->GetName();
		return $o->$f;
	}
	public function SetValue($value){
		$o = $this->wrap->GetItem();
		$f = $this->field->GetName();
		$o->$f = $value;	
	}
	public function GetName(){
		return 'x'.ID::Hash($this->wrap->GetName().$this->field->GetName())->AsHex();
	}
	public function GetLabel(){
		return $this->field->GetLabel();
	}
	public function GetType(){
		return $this->field->GetType();
	}
}
	
	
?>
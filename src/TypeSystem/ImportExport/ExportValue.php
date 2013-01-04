<?php

abstract class ExportValue extends XValue {
  protected $value;
	protected $type;
	public function __construct($value){
		$this->value = $value;
		$this->type = XType::Of($this->value);
	}

	public function GetInnerValue(){ return $this->value; }
	public function GetInnerType(){ return $this->type; }

  public abstract function Export();

	public final function __toString(){
	  try {
			return $this->Export();
	  }
	  catch (Exception $ex){
			Debug::RecordExceptionRethrown($ex,'Export Converter Exception Handler');
		  throw $ex;
	  }
  }

}
<?php

abstract class ExportConverter {
  protected $value;
	protected $type;
	public function __construct($value){
		$this->value = $value instanceof ExportConverter ? $value->value : $value ;
		$this->type = XType::Of($this->value);
	}

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
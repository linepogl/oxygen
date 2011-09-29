<?php

abstract class ExportConverter {
  protected $value;
	public function __construct($value){
		$this->value = $value instanceof ExportConverter ? $value->value : $value ;
	}

  public abstract function Export();
  public final function __toString(){
		return $this->Export();
  }


}
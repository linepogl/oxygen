<?php

abstract class ExportConverter {
  protected $value;
	protected $omnitype;
	public function __construct($value,$omnitype = null){
		$this->value = $value instanceof ExportConverter ? $value->value : $value ;
//		if (is_null($omnitype))
//			$this->omnitype = OmniType::GetBestFor($this->value);
//		else
//			$this->omnitype = $omnitype;
	}

  public abstract function Export();
  public final function __toString(){
		return $this->Export();
  }


}
<?php

abstract class ValueControl extends Control {
	public $value;
	public function WithValue($value){ $this->value = $value; return $this; }

	public function __construct(){
		$a = func_get_args();
		$z = func_num_args();
		if ($z==1 && is_array( $a[0] )) { $a = $a[0]; $z = count($a); }
		$name = null;
		$value = null;
		$label = null;
		if ($z > 0) {
			if ($a[0] instanceof XWrapField) {
				$name = $a[0]->GetName();
				$value = $a[0]->GetValue();
				$label = $a[0]->GetLabel();
			}
			else $name = $a[0];
		}
		if ($z > 1) $value = $a[1];
		parent::__construct($name);
		$this->value = $value;
		$this->label = $label;
	}

	public $label;
	public function WithLabel($value){ $this->label = $value; return $this; }
	public function GetLabel(){ return $this->label; }

	public static function Fill(XWrapField $ui){
		return new static($ui);
	}

}



<?php

class SelectBoxOption {

	private $Value = null;
	public function WithValue($value){ $this->Value = $value; return $this; }
	public function GetValue(){ return $this->Value; }

	private $url_value = null;
	/** @return string */
	public function GetUrlValue(){
		if (is_null($this->url_value))
			$this->url_value = strval(new Url($this->Value));
		return $this->url_value;
	}

	private $Caption = null;
	public function WithCaption($value){ $this->Caption = $value; return $this; }
	public function GetCaption(){ return is_null($this->Caption) ? $this->Value : $this->Caption; }


	private $before = null;
	public function WithBefore($value){ $this->before = $value; return $this; }
	public function GetBefore(){ return $this->before; }

	private $after = null;
	public function WithAfter($value){ $this->after = $value; return $this; }
	public function GetAfter(){ return $this->after; }

	public function __construct($value = null){
		$this->Value = $value;
	}
	public static function Make($value = null){
		return new SelectBoxOption($value);
	}
}

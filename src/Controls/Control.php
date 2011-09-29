<?php


abstract class Control {
	public $name;
	public function __construct($name=null){
		if (empty($name)) $name = 'x'.ID::Random()->AsHex();
		if (is_array($name)) $name = $name[0];
		if ($name instanceof XWrapField) $name = $name->GetName();
		$this->name = $name;
		$this->OnInit();
	}

	protected function OnInit(){}
	public abstract function Render();

	public $mode = UIMode::Edit;
	public function WithMode($value){ $this->mode = $value; return $this;}


	public function GetContent() {
		ob_start();
		$this->Render();
		return ob_get_clean();
	}

	public function __toString(){
		ob_start();
		$this->Render();
		return ob_get_clean();
	}


	public static function Make(){
		$a = func_get_args();
		return new static($a);
	}
	public static function GetClassName(){ return get_called_class(); }
}




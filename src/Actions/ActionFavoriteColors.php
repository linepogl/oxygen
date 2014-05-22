<?php

class ActionFavoriteColors extends Action {
	public function GetDefaultMode(){ return Action::MODE_RAW; }
	public function GetContentType(){ return 'application/json'; }
	public function IsPermitted(){ return true; }

	private $append;
	private $remove;
	public function __construct($append = array(), $remove = array()){ parent::__construct(); $this->append = $append; $this->remove = $remove; }
	public function GetUrlArgs(){ return array('append'=>$this->append,'remove'=>$this->remove) + parent::GetUrlArgs(); }
	public static function Make(){ return new static(Http::$GET['append']->AsStringArray(),Http::$GET['remove']->AsStringArray()); }


	public function Render() {
		echo new Js(oxy::GetFavoriteColors($this->append,$this->remove));
	}
}
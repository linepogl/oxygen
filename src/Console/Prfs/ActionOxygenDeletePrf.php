<?php


class ActionOxygenDeletePrf extends Action {

	public function GetDefaultMode(){ return self::AJAX_DIALOG; }
	public function GetTitle(){ return 'Delete profiler report '.$this->prf; }

	private $prf;
	public function __construct($prf){ parent::__construct(); $this->prf = $prf; }
	public function GetUrlArgs(){ return array('prf'=>$this->prf) + parent::GetUrlArgs(); }
	public static function Make(){ return new static(Http::$GET['prf']->AsString()); }


	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder();
		if (!is_dir($f)) Oxygen::MakeLogFolder();

		$ff = $f . '/' . $this->prf . '.prf';

		unlink($ff);
		Oxygen::Refresh();


	}

}
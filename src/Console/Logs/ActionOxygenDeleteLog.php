<?php


class ActionOxygenDeleteLog extends Action {

	public function GetDefaultMode(){ return self::AJAX_DIALOG; }
	public function GetTitle(){ return 'Delete log '.$this->log; }

	private $log;
	public function __construct($log){ parent::__construct(); $this->log = $log; }
	public function GetUrlArgs(){ return array('log'=>$this->log) + parent::GetUrlArgs(); }
	public static function Make(){ return new static(Http::$GET['log']->AsString()); }


	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder();
		if (!is_dir($f)) Oxygen::MakeLogFolder();

		$ff = $f . '/' . $this->log . '.log';

		unlink($ff);
		Oxygen::Refresh();


	}

}
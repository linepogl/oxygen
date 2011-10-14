<?php


class ActionOxygenDeleteAllLogs extends Action {

	public function GetDefaultMode(){ return self::AJAX_DIALOG; }
	public function GetTitle(){ return 'Delete all logs'; }


	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder();
		if (!is_dir($f)) Oxygen::MakeLogFolder();
		$a = glob("$f/*.log");

		foreach ($a as $ff)
			unlink($ff);

		Oxygen::Refresh();


	}

}
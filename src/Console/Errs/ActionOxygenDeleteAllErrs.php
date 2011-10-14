<?php


class ActionOxygenDeleteAllErrs extends Action {

	public function GetDefaultMode(){ return self::AJAX_DIALOG; }
	public function GetTitle(){ return 'Delete all error reports'; }


	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder();
		if (!is_dir($f)) Oxygen::MakeLogFolder();
		$a = glob("$f/*.err");

		foreach ($a as $ff)
			unlink($ff);

		Oxygen::Refresh();


	}

}
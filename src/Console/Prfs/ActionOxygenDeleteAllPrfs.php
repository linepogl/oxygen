<?php


class ActionOxygenDeleteAllPrfs extends Action {

	public function GetDefaultMode(){ return self::AJAX_DIALOG; }
	public function GetTitle(){ return 'Delete all profiler reports'; }


	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder();
		if (!is_dir($f)) Oxygen::MakeLogFolder();
		$a = glob("$f/*.prf");

		foreach ($a as $ff)
			unlink($ff);

		Oxygen::Refresh();


	}

}
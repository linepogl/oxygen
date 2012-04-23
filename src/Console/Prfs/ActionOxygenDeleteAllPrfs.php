<?php


class ActionOxygenDeleteAllPrfs extends Action {

	public function GetDefaultMode(){ return Action::MODE_AJAX_DIALOG; }
	public function GetTitle(){ return 'Delete all profiler reports'; }


	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder(true);
		$a = glob("$f/*.prf");

		if (is_array($a)) foreach ($a as $ff) unlink($ff);

		Oxygen::Refresh();


	}

}
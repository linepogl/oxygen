<?php


class ActionOxygenDeleteAllLogs extends Action {

	public function GetDefaultMode(){ return Action::MODE_AJAX_DIALOG; }
	public function GetTitle(){ return 'Delete all logs'; }


	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder(true);
		$a = glob("$f/*.log");

		if (is_array($a)) foreach ($a as $ff) unlink($ff);

		Oxygen::Refresh();


	}

}
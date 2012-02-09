<?php


class ActionOxygenDeleteAllErrs extends Action {

	public function GetDefaultMode(){ return self::AJAX_DIALOG; }
	public function GetTitle(){ return 'Delete all error reports'; }


	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder(true);
		$a = glob("$f/*.err");

		if (is_array($a)) foreach ($a as $ff) unlink($ff);

		Oxygen::Refresh();


	}

}
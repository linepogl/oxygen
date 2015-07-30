<?php


class ActionOxygenReset extends Action {

	public function GetDefaultMode(){ return Action::MODE_AJAX_DIALOG; }
	public function GetTitle(){ return 'Reset'; }
	public function IsPermitted(){
		return true;
	}

	public function Render(){
		Scope::ResetAllSoft();
		Scope::ResetAllHard();
		Oxygen::ClearTempFolders();
		Oxygen::Refresh();
	}

}
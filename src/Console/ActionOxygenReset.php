<?php


class ActionOxygenReset extends Action {

	public function GetDefaultMode(){ return self::AJAX_DIALOG; }
	public function GetTitle(){ return 'Reset oxygen cache'; }
	public function IsPermitted(){
		return true;
	}

	public function Render(){
		Debug::Write('Cleaning Oxygen scopes...');
		Scope::ResetScopes();
		Debug::Write('Cleaning Oxygen temp folder...');
		Oxygen::ClearTempFolder();
		Oxygen::Refresh();

	}

}
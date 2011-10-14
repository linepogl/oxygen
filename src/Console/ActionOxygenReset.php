<?php


class ActionOxygenReset extends Action {

	public function GetDefaultMode(){ return self::AJAX_DIALOG; }
	public function GetTitle(){ return 'Reset oxygen cache'; }
	public function IsPermitted(){
		return true;
	}

	public function Render(){

		Scope::ResetScopes();
		Oxygen::Refresh();

	}

}
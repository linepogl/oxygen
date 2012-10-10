<?php


class ActionOxygenResetCache extends Action {

	public function GetDefaultMode(){ return Action::MODE_AJAX_DIALOG; }
	public function GetTitle(){ return 'Reset cache'; }
	public function IsPermitted(){
		return true;
	}

	public function Render(){
		Scope::ResetAllWeak();
		Oxygen::Refresh();
	}

}
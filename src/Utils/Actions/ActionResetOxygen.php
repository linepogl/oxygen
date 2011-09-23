<?php

class ActionResetOxygen extends Action {
	public function IsPermitted(){ return true; }
	public function Render(){
		Log::EnableImmediateFlushing();
		Scope::ResetScopes();
		Log::Write('Done.');
	}
}
?>

<?php

class ActionOxygen extends ConsoleAction {

	public function GetNormalTabIconSrc(){ return 'oxy/img/console_tab_info.png'; }
	public function GetActiveTabIconSrc(){ return 'oxy/img/console_tab_info_active.png'; }
	public function GetBadgeText(){ return ''; }
	public function GetTabTitle(){ return 'Info'; }
	public function GetTitle(){ return 'Oxygen info'; }

	public function IsPermitted(){
		return true;
	}

	public function Render(){

		echo Oxygen::GetInfoAsHtml();

	}

}

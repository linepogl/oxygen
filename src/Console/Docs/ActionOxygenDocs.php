<?php


class ActionOxygenDocs extends ConsoleAction {

	public function GetNormalTabIconSrc(){ return 'oxy/img/console_tab_docs.png'; }
	public function GetActiveTabIconSrc(){ return 'oxy/img/console_tab_docs_active.png'; }
	public function GetBadgeText(){ return ''; }
	public function GetTabTitle(){ return 'Docs'; }
	public function GetTitle(){ return 'Documentation'; }

	public function IsPermitted(){
		return true;
	}

	public function Render(){


		echo $this->GetName();


	}

}
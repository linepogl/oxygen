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


		foreach (Oxygen::GetInfo() as $a){
			foreach ($a as $label=>$value){
				echo '<div class="label">'.new Html($label).'</div><div class="value">'.new Html($value).'</div>';
			}
			echo '<br class="clear"/><br/>';
		}


	}

}

<?php


abstract class ConsoleAction extends Action {

	public abstract function GetNormalTabIconSrc();
	public abstract function GetActiveTabIconSrc();
	public abstract function GetBadgeText();
	public abstract function GetTabTitle();

	public function OnBeforeRender(){
		Console::BeginModal();
		echo '<h1>'.$this->GetTitle().'</h1>';
	}

	public function OnAfterRender(){
		Console::EndModal();
	}


}
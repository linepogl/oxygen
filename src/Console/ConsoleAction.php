<?php


abstract class ConsoleAction extends Action {
	public function GetDefaultMode(){ return self::MODE_HTML_DOCUMENT; }

	public abstract function GetNormalTabIconSrc();
	public abstract function GetActiveTabIconSrc();
	public abstract function GetBadgeText();
	public abstract function GetTabTitle();

	public function OnBeforeRender(){
		echo '<html><head>'.Oxygen::GetHead().'</head><body>';
		Console::BeginModal();
		echo '<h1>'.$this->GetTitle().'</h1>';
	}

	public function OnAfterRender(){
		Console::EndModal();
		echo '</body></html>';
	}


}
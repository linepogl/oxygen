<?php


class ActionOxygenUpgrade extends Action {

	public function GetDefaultMode(){ return Action::MODE_LONG_AJAX_DIALOG; }
	public function GetTitle(){ return 'Upgrade'; }
	public function IsPermitted(){
		return true;
	}

	public function GetWidth(){ return 700; }

	public function Render(){

		Progress::Start(new InfoMessage('Upgrading database...'),true);
		try{
			$logger = new MultiMessage();
			Database::Upgrade(true,$logger->WithOnAdd(function(Message $m){ Progress::Write($m); }));
			Progress::Finish();
		}
		catch (Exception $ex){
			Progress::HandleExceptionAndFinish($ex);
		}

		echo '<div class="buttons">';
		echo ButtonBox::Make()->WithValue(oxy::txtRefresh())->WithOnClick('window.location.href=window.location.href;');
		echo '</div>';

	}
}
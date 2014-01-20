<?php

class ActionUpdateProgress extends Action{
	public function GetDefaultMode(){ return Action::MODE_HTML_FRAGMENT; }
	public function IsPermitted(){ return true; }

	const INTERVAL = 1000;

	private $progress_name;
	public function __construct($name){$this->progress_name = $name; parent::__construct();}
	public function GetUrlArgs(){ return array('name'=>$this->progress_name); }
	public static function Make(){ return new static(Http::GET('name')->AsString()); }

	public function Render(){
		$finished = Progress::HasFinished();
		$progress = Progress::GetProgress();

		$a = Progress::GetLogEntries();
		if (count($a) > 0){
			foreach($a as $index => $entry){
				echo '<div class="progress-message" id="'.$this->progress_name.'_log_'.$index.'">';
				echo $entry;
				echo '</div>';
			}
			if (isset($index)) {
				echo Js::BEGIN;
				echo "$(".new Js($this->progress_name.'_log').").scrollTop = $(".new Js($this->progress_name.'_log_'.$index).").cumulativeOffset().top-$(".new Js($this->progress_name.'_log').").cumulativeOffset().top-5;";
				echo Js::END;
			}
		}

		echo Js::BEGIN;
		if ($progress < 0){
			echo "$(".new Js($this->progress_name.'_progress').").hide();";
			echo "$(".new Js($this->progress_name.'_progress_bar').").style.width = ".new Js('0').";";
		}
		else {
			echo "$(".new Js($this->progress_name.'_progress').").update(".new Js(floor($progress*100).'%').");";
			echo "$(".new Js($this->progress_name.'_progress_bar').").style.width = ".new Js(floor($progress*100).'%').";";
		}

		if(!$finished)
			echo "setTimeout(function(){new Ajax.Updater(".new Js($this->progress_name.'_log').",".new Js($this).",{method:'get',encoding:Oxygen.Encoding,evalScripts:true,insertion:'bottom'});},".self::INTERVAL.");";
		else{
			echo "\$(".new Js($this->progress_name.'_cancelling').").hide();";
			echo "\$(".new Js($this->progress_name.'_table').").hide();";
			echo "\$(".new Js($this->progress_name.'_actual').").show();";
			Progress::Clear();
		}
		echo Js::END;
	}
}


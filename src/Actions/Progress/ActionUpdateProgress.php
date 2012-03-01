<?php

class ActionUpdateProgress extends Action{
	public function GetDefaultMode(){ return self::AJAX; }
	public function IsPermitted(){ return true; }

	const INTERVAL = 1000;

	private $name;
	public function __construct($name){$this->name = $name; parent::__construct();}
	public function GetUrlArgs(){ return array('name'=>$this->name); }
	public static function Make(){ return new static(Http::$GET['name']->AsString()); }

	public function Render(){
		$finished = Progress::HasFinished();
		$progress = Progress::GetProgress();

		$a = Progress::GetLogEntries();
		if (count($a) > 0){
			foreach($a as $index => $entry){
				echo '<div class="progress-message" id="'.$this->name.'_log_'.$index.'">';
				echo $entry;
				echo '</div>';
			}
			echo Js::BEGIN;
			echo "$(".new Js($this->name.'_log').").scrollTop = $(".new Js($this->name.'_log_'.$index).").cumulativeOffset().top-$(".new Js($this->name.'_log').").cumulativeOffset().top-5;";
			echo Js::END;
		}

		echo Js::BEGIN;
		echo "$(".new Js($this->name.'_progress').").update(".new Js(floor($progress*100).'%').");";
		echo "$(".new Js($this->name.'_progress_bar').").style.width = ".new Js(floor($progress*100).'%').";";

		if(!$finished)
			echo "setTimeout(function(){new Ajax.Updater(".new Js($this->name.'_log').",".new Js($this).",{method:'get',encoding:Oxygen.Encoding,evalScripts:true,insertion:'bottom'});},".self::INTERVAL.");";
		else{
			echo "\$(".new Js($this->name.'_cancelling').").hide();";
			echo "\$(".new Js($this->name.'_table').").hide();";
			echo "\$(".new Js($this->name.'_actual').").show();";
			Progress::Clear();
		}
		echo Js::END;
	}
}


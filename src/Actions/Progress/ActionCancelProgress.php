<?php

class ActionCancelProgress extends Action{
	public function GetDefaultMode(){ return Action::MODE_HTML_FRAGMENT; }
	public function IsPermitted(){ return true; }

	private $progress_name;
	public function __construct($name){$this->progress_name = $name; parent::__construct();}
	public function GetUrlArgs(){ return array('name'=>$this->progress_name); }
	public static function Make(){ return new static(Http::$GET['name']->AsString()); }

	public function Render(){

		Progress::Cancel();
		echo Js::BEGIN;
		echo "$(".new Js($this->progress_name.'_table').").hide();";
		echo "$(".new Js($this->progress_name.'_cancelling').").show();";
		echo Js::END;

	}
}


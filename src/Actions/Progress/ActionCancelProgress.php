<?php

class ActionCancelProgress extends Action{
	public function GetDefaultMode(){ return self::HTML_FRAGMENT; }
	public function IsPermitted(){ return true; }

	private $name;
	public function __construct($name){$this->name = $name; parent::__construct();}
	public function GetUrlArgs(){ return array('name'=>$this->name); }
	public static function Make(){ return new static(Http::$GET['name']->AsString()); }

	public function Render(){

		Progress::Cancel();
		echo Js::BEGIN;
		echo "$(".new Js($this->name.'_table').").hide();";
		echo "$(".new Js($this->name.'_cancelling').").show();";
		echo Js::END;

	}
}


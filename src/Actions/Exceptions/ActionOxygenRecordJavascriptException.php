<?php

class ActionOxygenRecordJavascriptException extends Action{
	public function GetDefaultMode(){ return Action::MODE_HTML_FRAGMENT; }
	public function IsPermitted(){ return true; }

	private $message;
	private $line;
	public function __construct($message,$line){ $this->message = $message; $this->line = $line; parent::__construct(); }
	public function GetUrlArgs(){ return array('message'=>$this->message,'line'=>$this->line); }
	public static function Make(){ return new static(Http::$GET['message']->AsString(),Http::$GET['line']->AsString()); }

	public function Render(){

		Debug::RecordExceptionServed( new JavascriptException( $this->message , $_SERVER['HTTP_REFERER'] , $this->line ) );

	}
}


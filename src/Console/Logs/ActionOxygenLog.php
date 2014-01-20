<?php


class ActionOxygenLog extends ConsoleAction {

	public function GetNormalTabIconSrc(){ return 'oxy/img/console_tab_logs.png'; }
	public function GetActiveTabIconSrc(){ return 'oxy/img/console_tab_logs_active.png'; }
	public function GetBadgeText(){ return ''; }
	public function GetTabTitle(){ return 'Event logs'; }
	public function GetTitle(){
		$micro_timestamp = floatval($this->log);
		$timestamp = intval($micro_timestamp);
		$d = new XDateTime($timestamp);
		return 'Event log '.$this->log.' ('.$d->Format('Y-m-d H:i:s').')';
	}


	private $log;
	public function __construct($log){ parent::__construct(); $this->log = $log; }
	public function GetUrlArgs(){ return array('log'=>$this->log) + parent::GetUrlArgs(); }
	public static function Make(){ return new static(Http::GET('log')->AsString()); }


	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder(true);
		$ff = $f . '/' . $this->log . '.log';

		$data = unserialize( file_get_contents($ff) );


		Console::RenderInfo( $data['head'] );

		Debug::Render($data['body']);



	}

}
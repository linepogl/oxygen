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
	public static function Make(){ return new static(Http::$GET['log']->AsString()); }


	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder();
		if (!is_dir($f)) Oxygen::MakeLogFolder();
		$ff = $f . '/' . $this->log . '.log';

		$data = unserialize( file_get_contents($ff) );


		echo '<div style="height:120px;overflow:auto;border:1px dotted #888888;background:#eeeeee;margin-bottom:10px;padding:5px;">';
		foreach ($data['head'] as $a){
			foreach ($a as $label=>$value){
				echo '<div class="label">'.new Html($label).'</div><div class="value">'.new Html($value).'</div>';
			}
			echo '<br class="clear"/><br/>';
		}
		echo '</div>';



		Debug::Render($data['body']);



	}

}
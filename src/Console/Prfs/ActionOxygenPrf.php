<?php


class ActionOxygenPrf extends ConsoleAction {

	public function GetNormalTabIconSrc(){ return 'oxy/img/console_tab_prfs.png'; }
	public function GetActiveTabIconSrc(){ return 'oxy/img/console_tab_prfs_active.png'; }
	public function GetBadgeText(){ return ''; }
	public function GetTabTitle(){ return 'Profiler'; }
	public function GetTitle(){
		$micro_timestamp = floatval($this->prf);
		$timestamp = intval($micro_timestamp);
		$d = new XDateTime($timestamp);
		return 'Profiler report '.$this->prf.' ('.$d->Format('Y-m-d H:i:s').')';
	}


	private $prf;
	public function __construct($prf){ parent::__construct(); $this->prf = $prf; }
	public function GetUrlArgs(){ return array('prf'=>$this->prf) + parent::GetUrlArgs(); }
	public static function Make(){ return new static(Http::$GET['prf']->AsString()); }


	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder();
		if (!is_dir($f)) Oxygen::MakeLogFolder();
		$ff = $f . '/' . $this->prf . '.prf';

		$data = unserialize( file_get_contents($ff) );


		echo '<div style="height:120px;overflow:auto;border:1px dotted #888888;background:#eeeeee;margin-bottom:10px;padding:5px;">';
		foreach ($data['head'] as $a){
			foreach ($a as $label=>$value){
				echo '<div class="label">'.new Html($label).'</div><div class="value">'.new Html($value).'</div>';
			}
			echo '<br class="clear"/><br/>';
		}
		echo '</div>';



		Profiler::Analyse($data['body']);



	}

}
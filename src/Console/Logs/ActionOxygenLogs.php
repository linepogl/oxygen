<?php


class ActionOxygenLogs extends ConsoleAction {

	public function GetNormalTabIconSrc(){ return 'oxy/img/console_tab_logs.png'; }
	public function GetActiveTabIconSrc(){ return 'oxy/img/console_tab_logs_active.png'; }
	public function GetBadgeText(){
		$f = Oxygen::GetLogFolder();
		if (!is_dir($f)) return '';
		$a = glob("$f/*.log");
		$c = is_array($a) ? count($a) : 0;
		return $c == 0 ? '' : strval($c);
	}
	public function GetTabTitle(){ return 'Logs'; }
	public function GetTitle(){ return 'Event logs'; }

	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder();
		if (!is_dir($f)) Oxygen::MakeLogFolder();
		$a = glob("$f/*.log");
		rsort($a);


//		for ($i = 0; $i < 1000; $i++)
//			Debug::Write($i);
//		throw new Exception('xx');
		echo '<a href="'.new Html(new ActionOxygenDeleteAllLogs()).'">Delete all</a>';
		echo '<br/><br/>';


		echo '<table class="console" cellpadding="0" cellspacing="0" border="0">';
		echo '<tr>';
		echo '<th></th>';
		echo '<th class="hleft" style="width:140px;">Log</th>';
		echo '<th class="hleft" style="width:150px;">Date</th>';
		echo '<th></th>';
		echo '</tr>';



		$i = 0;
		foreach ($a as $ff){
			$log = basename($ff,'.log');
			$micro_timestamp = floatval($log);
			$timestamp = intval($micro_timestamp);
			$d = new XDateTime($timestamp);

			echo '<tr'.(++$i%2==0?' class="alt"':'').'>';
			echo '<td style="text-align:right;">'.$i.'</td>';
			echo '<td>';
			echo '<a href="'.new Html(new ActionOxygenLog($log)).'">'.$log.'</a>';
			echo '</td>';
			echo '<td>';
			echo $d->Format('Y-m-d H:i:s');
			echo '</td>';
			echo '<td>';
			echo '<a href="'.new Html(new ActionOxygenDeleteLog($log)).'">X</a>';
			echo '</td>';
			echo '</tr>';
		}
		echo '</table>';


	}

}
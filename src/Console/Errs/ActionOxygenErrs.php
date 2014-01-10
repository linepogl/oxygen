<?php


class ActionOxygenErrs extends ConsoleAction {

	public function GetNormalTabIconSrc(){ return 'oxy/img/console_tab_errs.png'; }
	public function GetActiveTabIconSrc(){ return 'oxy/img/console_tab_errs_active.png'; }
	public function GetBadgeText(){
		$f = Oxygen::GetLogFolder();
		if (!is_dir($f)) return '';
		$a = glob("$f/*.err");
		$c = is_array($a) ? count($a) : 0;
		return $c == 0 ? '' : strval($c);
	}
	public function GetTabTitle(){ return 'Errors'; }
	public function GetTitle(){ return 'Error reports'; }

	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder(true);
		$a = glob("$f/*.err");
		if (!is_array($a)) $a = array();
		rsort($a);


		echo '<a href="'.new Html(new ActionOxygenDeleteAllErrs()).'">Delete all</a>';
		echo '<br/><br/>';


		echo '<table class="console" cellpadding="0" cellspacing="0" border="0">';
		echo '<tr>';
		echo '<th></th>';
		echo '<th class="hleft" style="width:140px;">Err</th>';
		echo '<th class="hleft" style="width:150px;">Date</th>';
		echo '<th></th>';
		echo '</tr>';



		$i = 0;
		foreach ($a as $ff){
			$err = basename($ff,'.err');
			$micro_timestamp = floatval($err);
			$timestamp = intval($micro_timestamp);
			$d = new XDateTime($timestamp);

			echo '<tr'.(++$i%2==0?' class="alt"':'').'>';
			echo '<td style="text-align:right;">'.$i.'</td>';
			echo '<td>';
			echo '<a href="'.new Html(new ActionOxygenErr($err)).'">'.$err.'</a>';
			echo '</td>';
			echo '<td>';
			echo $d->Format('Y-m-d H:i:s');
			echo '</td>';
			echo '<td>';
			echo '<a href="'.new Html(new ActionOxygenDeleteErr($err)).'">X</a>';
			echo '</td>';
			echo '</tr>';
		}
		echo '</table>';


	}

}
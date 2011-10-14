<?php


class ActionOxygenPrfs extends ConsoleAction {

	public function GetNormalTabIconSrc(){ return 'oxy/img/console_tab_prfs.png'; }
	public function GetActiveTabIconSrc(){ return 'oxy/img/console_tab_prfs_active.png'; }
	public function GetBadgeText(){
		$f = Oxygen::GetLogFolder();
		if (!is_dir($f)) return '';
		$a = glob("$f/*.prf");
		$c = is_array($a) ? count($a) : 0;
		return $c == 0 ? '' : strval($c);
	}
	public function GetTabTitle(){ return 'Profiler'; }
	public function GetTitle(){ return 'Profiler reports'; }

	public function IsPermitted(){
		return true;
	}

	public function Render(){

		$f = Oxygen::GetLogFolder();
		if (!is_dir($f)) Oxygen::MakeLogFolder();
		$a = glob("$f/*.prf");
		rsort($a);


		echo '<a href="'.new Html(new ActionOxygenDeleteAllPrfs()).'">Delete all</a>';
		echo '<br/><br/>';


		echo '<table class="console" cellpadding="0" cellspacing="0" border="0">';
		echo '<tr>';
		echo '<th></th>';
		echo '<th class="hleft" style="width:140px;">Prf</th>';
		echo '<th class="hleft" style="width:150px;">Date</th>';
		echo '<th></th>';
		echo '</tr>';



		$i = 0;
		foreach ($a as $ff){
			$prf = basename($ff,'.prf');
			$micro_timestamp = floatval($prf);
			$timestamp = intval($micro_timestamp);
			$d = new XDateTime($timestamp);

			echo '<tr'.(++$i%2==0?' class="alt"':'').'>';
			echo '<td style="text-align:right;">'.$i.'</td>';
			echo '<td>';
			echo '<a href="'.new Html(new ActionOxygenPrf($prf)).'">'.$prf.'</a>';
			echo '</td>';
			echo '<td>';
			echo $d->Format('Y-m-d H:i:s');
			echo '</td>';
			echo '<td>';
			echo '<a href="'.new Html(new ActionOxygenDeletePrf($prf)).'">X</a>';
			echo '</td>';
			echo '</tr>';
		}
		echo '</table>';


	}

}
<?php

class Profiler {


	public static function Start(){
		if (!function_exists('xhprof_enable')) return;
		xhprof_enable(XHPROF_FLAGS_NO_BUILTINS);
	}
	
	public static function Stop(){
		if (!function_exists('xhprof_disable')) return;
		$results = xhprof_disable();
		$dir = Oxygen::GetProfilerFolder();
		if (!file_exists($dir))
			mkdir($dir,0777,true);
		file_put_contents( $dir .'/'.str_replace(',','.',sprintf('%0.4f',microtime(true))).'.oxygen', serialize($results));


		self::Analyse($results);

	}






	public static function Analyse($results){
		$total_calls = array();
		$direct_calls = array();
		$total_time = array();
		$exclusive_time = array();

		foreach ($results as $key=>$a){
			$f = explode('==>',$key);
			$ff = explode('@',$f[count($f)-1]);
			$fz = $ff[0];
			$total_calls[$fz] = array();
			$direct_calls[$fz] = array();
			$total_time[$fz] = array();
			$exclusive_time[$fz] = array();
		}
		foreach ($results as $key=>$a){
			$f = explode('==>',$key);
			$ff = explode('@',$f[0]); $fo = $ff[0];
			if (!array_key_exists('',$total_calls[$fo])) {
				$total_calls[$fo][''] = 0;
				$direct_calls[$fo][''] = 0;
				$total_time[$fo][''] = 0;
				$exclusive_time[$fo][''] = 0;
			}
			if (count($f) == 1){
				$total_calls[$fo][''] += $a['ct'];
				$direct_calls[$fo][''] += $a['ct'];
				$total_time[$fo][''] += $a['wt'];
				$exclusive_time[$fo][''] += $a['wt'];
			}
			elseif (count($f) == 2) {
				$exclusive_time[$fo][''] -= $a['wt'];
			}
			for ($i = 0; $i < count($f) - 1; $i++){
				$ff = explode('@',$f[$i]); $fi = $ff[0];
				for ($j = $i+1; $j < count($f); $j++){
					$ff = explode('@',$f[$j]); $fj = $ff[0];
					if (!array_key_exists($fi,$total_calls[$fj])) {
						$total_calls[$fj][$fi] = 0;
						$direct_calls[$fj][$fi] = 0;
						$total_time[$fj][$fi] = 0;
						$exclusive_time[$fj][$fi] = 0;
					}
					if ($i == count($f)-2 && $j == count($f)-1) {
						$total_calls[$fj][$fi] += $a['ct'];
						$direct_calls[$fj][$fi] += $a['ct'];
						$total_time[$fj][$fi] += $a['wt'];
						$exclusive_time[$fj][$fi] += $a['wt'];
					}
					elseif ($i == count($f)-3 && $j == count($f)-2) {
						$exclusive_time[$fj][$fi] -= $a['wt'];
					}
					elseif ($j == count($f)-1) {
						$total_time[$fj][$fi] += $a['wt'];
						$total_calls[$fj][$fi] += $a['ct'];
					}
				}
			}
		}


		$a = array();
		foreach ($total_calls as $key=>$value){
			if (array_key_exists('',$total_calls[$key]))
				$a[$key] = array($total_calls[$key][''],$total_time[$key][''],array_sum($exclusive_time[$key]));
			else
				$a[$key] = array($total_calls[$key]['main()'],$total_time[$key]['main()'],array_sum($exclusive_time[$key]));
		}

		uasort($a,function($x1,$x2){return $x2[2]-$x1[2]; });

		$b = array();
		$b[0] = array_sum(array_map( function($x){ return $x[0]; }, $a));
		$b[1] = $total_time['main()'][''];
		$b[2] = array_sum(array_map( function($x){ return $x[2]; }, $a));


		echo '<style>';
		echo 'table.system td, table.system th { font:11px/12px monospace; padding:2px 24px 2px 4px; border-bottom:1px solid #cccccc; color:#333333; }';
		echo 'table.system .alt { background:#eeeeee; }';
		echo '</style>';

		echo '<div style="position:fixed;top:30px;left:30px;right:30px;bottom:30px;;overflow:auto;z-index:10000;white-space:pre;background:#f4f4f4;border:6px solid #333333;padding:10px;">';
    echo '<table class="system" width="100%" cellpadding="0" cellspacing="0" border="0">';
    echo '<tr>';
    echo '<th class="expand">&nbsp;</th>';
    echo '<th colspan="2" class="hcenter">Total calls</th>';
    echo '<th colspan="2" class="hcenter">Total time</th>';
    echo '<th colspan="2" class="hcenter">Exclusive time</th>';
    echo '</tr>';

		$i = 0;
		foreach ($a as $key=>$aa){
			//if ($i++>100) break;
			echo '<tr'.($i%2==0?' class="alt"':'').'>';
			echo '<th class="hleft">'.$key.'</th>';
			echo '<td class="hright">'.$aa[0].'</td>';
			echo '<td class="hright">'.sprintf('%.2f',$aa[0]/$b[0]*100).'%</td>';
			echo '<td class="hright">'.$aa[1].'</td>';
			echo '<td class="hright">'.sprintf('%.2f',$aa[1]/$b[1]*100).'%</td>';
			echo '<td class="hright">'.$aa[2].'</td>';
			echo '<td class="hright">'.sprintf('%.2f',$aa[2]/$b[2]*100).'%</td>';
			echo '</tr>';
		}

		echo '</table>';
		echo '</div>';
	}


}
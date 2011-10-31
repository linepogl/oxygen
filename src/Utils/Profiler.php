<?php

class Profiler {


	private static $results = null;
	private static $serial = null;
	public static function Start(){
		if (!function_exists('xhprof_enable')) return;
		xhprof_enable(XHPROF_FLAGS_NO_BUILTINS);
	}
	
	public static function StopAndSave(){
		if (!function_exists('xhprof_disable')) return;
		self::$results = xhprof_disable();
		$f = Oxygen::GetLogFolder();
		if (!is_dir($f)) Oxygen::MakeLogFolder();
		self::$serial = str_replace(',','.',sprintf('%0.3f',microtime(true)));
		file_put_contents( $f .'/'.self::$serial.'.prf',
			serialize(array( 'head' => Oxygen::GetInfo() , 'body' => self::$results ))
		);
	}


	public static function ShowConsole(){
		Console::BeginPopup('oxy/img/console_tab_prfs_active.png','Quick profiler','Quick profiler '.self::$serial);
		Console::RenderInfo( Oxygen::GetInfo() );
		self::Analyse(self::$results);
		Console::EndPopup();
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



    echo '<table class="console" width="100%" cellpadding="0" cellspacing="0" border="0">';
    echo '<tr>';
    echo '<th class="expand">&nbsp;</th>';
    echo '<th colspan="2" class="hcenter">Total calls</th>';
    echo '<th colspan="2" class="hcenter">Total time</th>';
    echo '<th colspan="2" class="hcenter">Exclusive time</th>';
    echo '</tr>';

		$i = 0;
		foreach ($a as $key=>$aa){
			//if ($i++>100) break;
			echo '<tr'.(++$i%2==0?' class="alt"':'').'>';
			echo '<td class="hleft">'.$key.'</td>';
			echo '<td class="hright">'.$aa[0].'</td>';
			echo '<td class="hright">'.sprintf('%.2f',$aa[0]/$b[0]*100).'%</td>';
			echo '<td class="hright">'.$aa[1].'</td>';
			echo '<td class="hright">'.sprintf('%.2f',$aa[1]/$b[1]*100).'%</td>';
			echo '<td class="hright">'.$aa[2].'</td>';
			echo '<td class="hright">'.sprintf('%.2f',$aa[2]/$b[2]*100).'%</td>';
			echo '</tr>';
		}

		echo '</table>';
	}


}
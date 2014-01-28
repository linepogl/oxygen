<?php

class Profiler {


	private static $results = null;
	private static $serial = null;
	public static function Start(){
		if (!function_exists('xhprof_enable')) return;
		/** @noinspection PhpUndefinedConstantInspection */
		xhprof_enable(XHPROF_FLAGS_NO_BUILTINS);
	}
	
	public static function StopAndSave(){
		if (!function_exists('xhprof_disable')) return;
		self::$results = xhprof_disable();
		$f = Oxygen::GetLogFolder(true);
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

		$calls = array();
		$inclu = array();
		$exclu = array();

		foreach ($results as $key=>$z){
			$b = explode('==>',$key);
			if (count($b) == 1){
				$from = '';
				$call = $b[ 0 ];
			}
			else {
				$from = $b[ 0 ];
				$call = $b[ 1 ];
			}

			list($from) = explode('@',$from);
			list($call) = explode('@',$call);

			if (!array_key_exists($call,$calls)) $calls[$call] = 0;
			$calls[$call] += $z['ct'];

			if (!array_key_exists($call,$inclu)) $inclu[$call] = 0;
			$inclu[$call] += $z['wt'];

			if (!array_key_exists($call,$exclu)) $exclu[$call] = 0;
			$exclu[$call] += $z['wt'];

			if ($from !== '') {
				if (!array_key_exists($from,$exclu)) $exclu[$from] = 0;
				$exclu[$from] -= $z['wt'];
			}
		}

		arsort($exclu);

		$t_calls = array_sum($calls);
		$t_exclu = array_sum($exclu);


    echo '<table class="console" width="100%" cellpadding="0" cellspacing="0" border="0">';
    echo '<tr>';
    echo '<th class="expand">&nbsp;</th>';
    echo '<th colspan="2" class="hcenter">Total calls</th>';
    echo '<th colspan="2" class="hcenter">Total time</th>';
    echo '<th colspan="2" class="hcenter">Exclusive time</th>';
    echo '</tr>';

		$i = 0;
		foreach ($exclu as $key=>$v){
			if ($i++>60) break;
			echo '<tr'.($i%2==0?' class="alt"':'').'>';
			echo '<td class="hleft">'.$key.'</td>';
			echo '<td class="hright">'.$calls[$key].'</td>';
			echo '<td class="hright">'.sprintf('%.2F',$calls[$key]/$t_calls*100).'%</td>';
			echo '<td class="hright">'.$inclu[$key].'</td>';
			echo '<td class="hright">'.sprintf('%.2F',$inclu[$key]/$t_exclu*100).'%</td>';
			echo '<td class="hright">'.$exclu[$key].'</td>';
			echo '<td class="hright">'.sprintf('%.2F',$exclu[$key]/$t_exclu*100).'%</td>';
			echo '</tr>';
		}

		echo '<tr>';
	  echo '<th class="expand" colspan="5">&nbsp;</th>';
		echo '<th class="hright">'.$t_exclu.'</td>';
		echo '<th class="hright">'.sprintf('%.2F',100).'%</td>';
	  echo '</tr>';

		echo '</table>';
	}


}
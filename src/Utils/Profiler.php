<?php

class Profiler {


	public static function Start(){
		if (!function_exists('xhprof_enable')) return;
		xhprof_enable();
	}
	
	public static function Stop(){
		if (!function_exists('xhprof_disable')) return;
		$results = xhprof_disable();
		$dir = ini_get('xhprof.output_dir');
		file_put_contents( empty($dir)?Oxygen::GetProfilerFolder():$dir .'/'.str_replace(',','.',sprintf('%0.4f',microtime(true))).'.oxygen', serialize($results));
	}






}
<?php

class Fn {

	public static function Insist($function,$times = 0,$sleep = 1) {
		$i = 0;
		while(true) {
			try {
				return $function();
			}
			catch (Exception $ex) {
				if ($times > 0) if (++$i >= $times) throw $ex;
				if ($sleep > 0) sleep($sleep);
			}
		}
		return null; // should never reach this
	}


}
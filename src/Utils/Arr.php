<?php


class Arr {

	public static function UnsetPath( &$a = array() , $path = array() ) {
		$count = count($path);
		if ($count > 0) {
			$x = array_shift($path);
			if ($x === null) {
				if ($count > 1) {
					foreach ($a as $key => &$aa)
						if (is_array($aa))
							self::UnsetPath($aa,$path);
				}
				else {
					foreach ($a as $key => $aa)
						unset($a[$key]);
				}
			}
			elseif (array_key_exists($x,$a)) {
				if ($count > 1) {
					if (is_array($a[$x]))
						self::UnsetPath($a[$x],$path);
				}
				else {
					unset($a[$x]);
				}
			}
		}
	}


}
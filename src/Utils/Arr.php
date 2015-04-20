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


	public static function ToCsv( $a ){
    ob_start();
    $f = fopen( "php://output" , 'w' );
		foreach ($a as $aa) fputcsv( $f , $aa , "\t" );
    fclose( $f );
		return chr( 255 ) . chr( 254 ) . mb_convert_encoding( ob_get_clean() , 'UTF-16LE' , 'UTF-8' );
	}

}
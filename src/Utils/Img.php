<?php

class Img {

	public static function FitIn($max_width, $max_height, &$width, &$height) {
		if ($max_width / $max_height  <  $width / $height) {
			$height = intval($height*($max_width/$width));
			$width = $max_width;
		}
		else {
			$width = intval($width*($max_height/$height));
			$height = $max_height;
		}
	}

}
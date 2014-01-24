<?php

final class Css  {

	const BEGIN = "<style type=\"text/css\">\n/*<![CDATA[*/\n";
	const END = "\n/*]]>*/\n</style>";

	public static function GetLink($href){
		return '<link rel="stylesheet" type="text/css" href="'.new Html($href).'" />';
	}
}





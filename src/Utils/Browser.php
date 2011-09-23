<?php

class Browser {

	public static function GetUA(){
		return $_SERVER['HTTP_USER_AGENT'];
	}
	public static function GetIP(){
		return $_SERVER['REMOTE_ADDR'];
	}
	public static function GetName(){
		if (self::IsIE()) return 'ie';
		if (self::IsOpera()) return 'opera';
		if (self::IsChrome()) return 'chrome';
		if (self::IsFirefox()) return 'firefox';
		return '';
	}

	public static function GetCssClasses(){
		if (self::IsIE5()) return 'notouch ie ie5';
		if (self::IsIE6()) return 'notouch ie ie6';
		if (self::IsIE7()) return 'notouch ie ie7';
		if (self::IsIE8()) return 'notouch ie ie8';
		if (self::IsIE9()) return 'notouch ie ie9';
		if (self::IsIE()) return 'notouch ie';
		if (self::IsOpera()) return 'notouch opera';
		if (self::IsChrome()) return 'notouch chrome';
		if (self::IsFirefox()) return 'notouch firefox';
		if (self::IsSafariIPad()) return 'touch safari ios ipad';
		if (self::IsSafariIPod()) return 'touch safari ios ipod';
		if (self::IsSafariIPhone()) return 'touch safari ios iphone';
		if (self::IsSafari()) return 'notouch safari';
		return '';
	}


	public static function IsWindows(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') !== false;
	}
	public static function IsWindows2000(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows nt 5.0') !== false;
	}
	public static function IsWindowsXP(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows nt 5.1') !== false;
	}
	public static function IsWindowsVista(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows nt 6.0') !== false;
	}
	public static function IsWindows7(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows nt 7.0') !== false;
	}


	public static function IsIE(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'msie') !== false;
	}
	public static function IsIE5(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'msie 5') !== false;
	}
	public static function IsIE6(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'msie 6') !== false;
	}
	public static function IsIE7(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'msie 7') !== false;
	}
	public static function IsIE8(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'msie 8') !== false;
	}
	public static function IsIE9(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'msie 9') !== false;
	}
	public static function IsOpera(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera') !== false;
	}
	public static function IsChrome(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'chrome') !== false;
	}
	public static function IsFirefox(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'firefox') !== false;
	}
	public static function IsSafari(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'safari') !== false;
	}
	public static function IsSafariIPad(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'ipad') !== false;
	}
	public static function IsSafariIPod(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'ipod') !== false;
	}
	public static function IsSafariIPhone(){
		return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'iphonesafari') !== false;
	}
	public static function IsSafariIOS(){
		return self::IsSafariIPad() || self::IsSafariIPhone() || self::IsSafariIPod();
	}

}
?>

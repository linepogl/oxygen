<?php

class Browser {

	public static function GetUA(){
		return isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'unknown';
	}
	public static function GetIP(){
		return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
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
		return strpos(strtolower(self::GetUA()),'windows') !== false;
	}
	public static function IsWindows2000(){
		return strpos(strtolower(self::GetUA()),'windows nt 5.0') !== false;
	}
	public static function IsWindowsXP(){
		return strpos(strtolower(self::GetUA()),'windows nt 5.1') !== false;
	}
	public static function IsWindowsVista(){
		return strpos(strtolower(self::GetUA()),'windows nt 6.0') !== false;
	}
	public static function IsWindows7(){
		return strpos(strtolower(self::GetUA()),'windows nt 7.0') !== false;
	}


	public static function IsIE(){
		return strpos(strtolower(self::GetUA()),'msie') !== false;
	}
	public static function IsIE5(){
		return strpos(strtolower(self::GetUA()),'msie 5') !== false;
	}
	public static function IsIE6(){
		return strpos(strtolower(self::GetUA()),'msie 6') !== false;
	}
	public static function IsIE7(){
		return strpos(strtolower(self::GetUA()),'msie 7') !== false;
	}
	public static function IsIE8(){
		return strpos(strtolower(self::GetUA()),'msie 8') !== false;
	}
	public static function IsIE9(){
		return strpos(strtolower(self::GetUA()),'msie 9') !== false;
	}
	public static function IsOpera(){
		return strpos(strtolower(self::GetUA()),'opera') !== false;
	}
	public static function IsChrome(){
		return strpos(strtolower(self::GetUA()),'chrome') !== false;
	}
	public static function IsFirefox(){
		return strpos(strtolower(self::GetUA()),'firefox') !== false;
	}
	public static function IsSafari(){
		return strpos(strtolower(self::GetUA()),'safari') !== false;
	}
	public static function IsSafariIPad(){
		return strpos(strtolower(self::GetUA()),'ipad') !== false;
	}
	public static function IsSafariIPod(){
		return strpos(strtolower(self::GetUA()),'ipod') !== false;
	}
	public static function IsSafariIPhone(){
		return strpos(strtolower(self::GetUA()),'iphonesafari') !== false;
	}
	public static function IsSafariIOS(){
		return self::IsSafariIPad() || self::IsSafariIPhone() || self::IsSafariIPod();
	}

}


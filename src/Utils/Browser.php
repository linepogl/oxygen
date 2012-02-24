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
		if (self::IsSafari()) return 'safari';
		return '';
	}

	public static function GetCssClasses(){
		$os = 'notouch';
		if (self::IsIPhone()) $os = 'touch ios iphone';
		elseif (self::IsIPad()) $os = 'touch ios ipad';
		elseif (self::IsIPod()) $os = 'touch ios ipod';
		if (self::IsIE5())     return $os.' ie ie5';
		if (self::IsIE6())     return $os.' ie ie6';
		if (self::IsIE7())     return $os.' ie ie7';
		if (self::IsIE8())     return $os.' ie ie8';
		if (self::IsIE9())     return $os.' ie ie9';
		if (self::IsIE())      return $os.' ie';
		if (self::IsOpera())   return $os.' opera';
		if (self::IsChrome())  return $os.' chrome';
		if (self::IsFirefox()) return $os.' firefox';
		if (self::IsSafari())  return $os.' safari';
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
	public static function IsIPad(){
		return strpos(strtolower(self::GetUA()),'ipad') !== false;
	}
	public static function IsIPod(){
		return strpos(strtolower(self::GetUA()),'ipod') !== false;
	}
	public static function IsIPhone(){
		return strpos(strtolower(self::GetUA()),'iphone') !== false;
	}
	public static function IsIOS(){
		return self::IsIPad() || self::IsIPhone() || self::IsIPod();
	}

}


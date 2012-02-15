<?php

class Str {

	public static function StartsWith($str,$tok) {
		if (strlen($str)>=strlen($tok))
			return substr($str,0,strlen($tok))==$tok;
		else
			return false;
	}

	public static function MBStartsWith($str,$tok) {
		if (mb_strlen($str)>=mb_strlen($tok))
			return mb_substr($str,0,mb_strlen($tok))==$tok;
		else
			return false;
	}

	public static function EndsWith($str,$tok) {
		if (strlen($str)>=strlen($tok))
			return substr($str,-strlen($tok))==$tok;
		else
			return false;
	}

	public static function MBEndsWith($str,$tok) {
		if (mb_strlen($str)>=mb_strlen($tok))
			return mb_substr($str,-mb_strlen($tok))==$tok;
		else
			return false;
	}


	public static function MBReplace($search, $replace, $subject, $encoding = 'auto') {
		if(! is_array($search)) {
			$search = array($search);
		}
		if(! is_array($replace)) {
			$replace = array($replace);
		}
		if(strtolower($encoding) === 'auto') {
			$encoding = mb_internal_encoding();
		}
		if(is_array($subject)) {
			$result = array();
			foreach($subject as $key => $val) {
				$result[$key] = self::MBReplace($search, $replace, $val, $encoding);
			}
			return $result;
		}

		$currentpos = 0;
		while(true) {
			$index = -1;
			$minpos = -1;
			foreach($search as $key => $find) {
				if($find == '') {
					continue;
				}
				$findpos = mb_strpos($subject, $find, $currentpos, $encoding);
				if($findpos !== false) {
					if($minpos < 0 || $findpos < $minpos) {
						$minpos = $findpos;
						$index = $key;
					}
				}
			}
			if($minpos < 0) {
				break;
			}

			$r = array_key_exists($index, $replace) ? $replace[$index] : '';
			$subject = sprintf('%s%s%s',
				mb_substr($subject, 0, $minpos, $encoding),
				$r,
			mb_substr(
				$subject,
				$minpos + mb_strlen($search[$index], $encoding),
				mb_strlen($subject, $encoding),
				$encoding
				)
				);
			$currentpos = $minpos + mb_strlen($r, $encoding);
		}
		return $subject;
	}







	public static function IsUTF8($string) {
		return (@iconv("ISO-8859-1","UTF-8",@iconv("UTF-8","ISO-8859-1",$string)) == $string);
	}


	public static function ForceUTF8($string) {
		if (Str::IsUTF8($string))
			return $string;
		else
			return @iconv("ISO-8859-1","UTF-8",$string);
	}


	public static function ForceISO($string) {
		if (Str::IsUTF8($string))
			return @iconv("UTF-8","ISO-8859-1",$string);
		else
			return $string;
	}

	public static function RemoveAccents($str) {
		return strtr(Str::ForceISO($str),"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ","aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
	}

}
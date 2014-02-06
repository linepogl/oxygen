<?php

class Str {

	public static function StartsWith($str,$tok) {
		if (mb_strlen($str)>=mb_strlen($tok))
			return mb_substr($str,0,mb_strlen($tok))==$tok;
		else
			return false;
	}
	public static function TrimStart($str,$tok) {
		if (mb_strlen($str)>=mb_strlen($tok))
			if (mb_substr($str,0,mb_strlen($tok))==$tok)
				return mb_substr($str,mb_strlen($tok));
		return $str;
	}

	public static function EndsWith($str,$tok) {
		if (mb_strlen($str)>=mb_strlen($tok))
			return mb_substr($str,-mb_strlen($tok))==$tok;
		else
			return false;
	}

	public static function Limit($str,$number_of_chars){
		return mb_strlen($str)>$number_of_chars ? mb_substr($str,0,$number_of_chars) : $str;
	}

	public static function Replace($search, $replace, $subject, &$count = 0) {
		if (!is_array($subject)) {
			// Normalize $search and $replace so they are both arrays of the same length
			$searches = is_array($search) ? array_values($search) : array($search);
			$replacements = is_array($replace) ? array_values($replace) : array($replace);
			$replacements = array_pad($replacements, count($searches), '');

			foreach ($searches as $key => $search) {
				$parts = mb_split(preg_quote($search), $subject);
				$count += count($parts) - 1;
				$subject = implode($replacements[$key], $parts);
			}
		} else {
			// Call mb_str_replace for each subject in array, recursively
			foreach ($subject as $key => $value) {
				$subject[$key] = self::Replace($search, $replace, $value, $count);
			}
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
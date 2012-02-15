<?php

final class Language {

	/** @return string */
	public static function MakeHref($lang){
		return Oxygen::MakeHrefPreservingValues(array('lang'=>$lang));
	}

	/** @return string */
	public static function GetDecimalSeparator(){
		$l = Lemma::Pick('DecimalSeparator');
		return $l->HasLanguage() ? $l->Translate() : self::GetDecimalSeparatorInvariant();
	}
	/** @return string */
	public static function GetThousandsSeparator(){
		$l = Lemma::Pick('ThousandsSeparator');
		return $l->HasLanguage() ? $l->Translate() : self::GetThousandsSeparatorInvariant();
	}

	/** @return string */
	public static function GetDecimalSeparatorInvariant(){
		return '.';
	}
	/** @return string */
	public static function GetThousandsSeparatorInvariant(){
		return '';
	}


	/** @return string */
	public static function FormatDecimal($value,$number_of_decimals=-1) {
		if (is_int($value) || is_float($value)){
			if ($number_of_decimals < 0) {
				$number_of_decimals = 0;
				$s = sprintf('%F',$value);
				$x = strstr($s,self::GetDecimalSeparatorInvariant());
				if ($x !== false) {
					$s = rtrim($s,'0');
					$x = strstr($s,self::GetDecimalSeparatorInvariant());
					$number_of_decimals = strlen($x) - 1;
				}
				if ($number_of_decimals == 0) $number_of_decimals = 1;
			}
			return number_format($value, $number_of_decimals, self::GetDecimalSeparator(), self::GetThousandsSeparator());
		}
		return '';
	}
	/** @return float|null */
	public static function ParseDecimal($string, $default = null) {
		$string = strval($string);
		$s = preg_replace('/[^1234567890\\'.self::GetDecimalSeparator().']/','',$string);
		$s = str_replace( self::GetDecimalSeparator() , self::GetDecimalSeparatorInvariant() , $s );
		$s_length = strlen($s);
		$d_count = substr_count($s,self::GetDecimalSeparatorInvariant());
		if ($d_count == $s_length || $d_count > 1 || $s_length == 0) return $default;
		return floatval($s);
	}

	/** @return string */
	public static function FormatDecimalInvariant($value,$number_of_decimals=-1) {
		if (is_int($value) || is_float($value)){
			if ($number_of_decimals < 0) {
				$number_of_decimals = 0;
				$s = sprintf('%F',$value);
				$x = strstr($s,self::GetDecimalSeparatorInvariant());
				if ($x !== false) {
					$s = rtrim($s,'0');
					$x = strstr($s,self::GetDecimalSeparatorInvariant());
					$number_of_decimals = strlen($x) - 1;
				}
				if ($number_of_decimals == 0) $number_of_decimals = 1;
			}
			return number_format($value, $number_of_decimals, self::GetDecimalSeparatorInvariant(), self::GetThousandsSeparatorInvariant());
		}
		return '';
	}
	/** @return float|null */
	public static function ParseDecimalInvariant($string, $default = null) {
		$string = strval($string);
		$s = preg_replace('/[^1234567890\\'.self::GetDecimalSeparatorInvariant().']/','',$string);
		$s_length = strlen($s);
		$d_count = substr_count($s,self::GetDecimalSeparatorInvariant());
		if ($d_count == $s_length || $d_count > 1 || $s_length == 0) return $default;
		return floatval($s);
	}





	/** @return string */
	public static function FormatNumber($value,$number_of_decimals=-1) {
		if (is_int($value) || is_float($value)){
			if ($number_of_decimals < 0) {
				$number_of_decimals = 0;
				$s = sprintf('%F',$value);
				$x = strstr($s,self::GetDecimalSeparatorInvariant());
				if ($x !== false) {
					$s = rtrim($s,'0');
					$x = strstr($s,self::GetDecimalSeparatorInvariant());
					$number_of_decimals = strlen($x) - 1;
				}
			}
			return number_format($value, $number_of_decimals, self::GetDecimalSeparator(), self::GetThousandsSeparator());
		}
		return '';
	}


	/** @return float|int|null */
	public static function ParseNumber($string, $default = null) {
		$string = strval($string);
		$s = preg_replace('/[^1234567890\\'.self::GetDecimalSeparator().']/','',$string);
		$s = str_replace( self::GetDecimalSeparator() , self::GetDecimalSeparatorInvariant() , $s );
		$s_length = strlen($s);
		$d_count = substr_count($s,self::GetDecimalSeparatorInvariant());
		if ($d_count == $s_length || $d_count > 1 || $s_length == 0) return $default;
		$x1 = floatval($s);
		$x2 = intval($x1);
		return $x1 == $x2 ? $x2 : $x1;
	}


	/** @return string */
	public static function FormatNumberInvariant($value,$number_of_decimals=-1) {
		if (is_int($value) || is_float($value)){
			if ($number_of_decimals < 0) {
				$number_of_decimals = 0;
				$s = sprintf('%F',$value);
				$x = strstr($s,self::GetDecimalSeparatorInvariant());
				if ($x !== false) {
					$s = rtrim($s,'0');
					$x = strstr($s,self::GetDecimalSeparatorInvariant());
					$number_of_decimals = strlen($x) - 1;
				}
			}
			return number_format($value, $number_of_decimals, self::GetDecimalSeparatorInvariant(), self::GetThousandsSeparatorInvariant());
		}
		return '';
	}

	/** @return float|int|null */
	public static function ParseNumberInvariant($string, $default = null) {
		$string = strval($string);
		$s = preg_replace('/[^1234567890\\'.self::GetDecimalSeparatorInvariant().']/','',$string);
		$s_length = strlen($s);
		$d_count = substr_count($s,self::GetDecimalSeparatorInvariant());
		if ($d_count == $s_length || $d_count > 1 || $s_length == 0) return $default;
		$x1 = floatval($s);
		$x2 = intval($x1);
		return $x1 == $x2 ? $x2 : $x1;
	}



	/** @return string */
	public static function FormatTimeSpan($value,$show_milliseconds = true){
		if (is_int($value))
			$value = new XTimeSpan($value);
//		if ($value instanceof DateInterval)
//			$value = new XTimeSpan($value);
    if ( $value instanceof XTimeSpan ){
    	$d = $value->GetDays();
    	$h = $value->GetHours();
    	$m = $value->GetMinutes();
    	$s = $value->GetSeconds();
	    $ms = $value->GetMilliseconds();
	    $r = '';

	    if ($d != 0) $r .= $d.Lemma::Pick('d.');
	    if ($r == '') { if ($h != 0) $r .= $h.Lemma::Pick('h.'); } else $r .= ' '.$h.Lemma::Pick('h.');
			if ($r == '') { if ($m != 0) $r .= $m.'\''; } else $r .= ' '.$m.'\'';
	    if ($show_milliseconds){
				if ($s != 0 || $ms != 0){
					if ($r != '') $r .= ' ';
					$r .= $s;
					if ($ms != 0) $r .= self::GetDecimalSeparator().sprintf('%03d',$ms);
					$r .= '\'\'';
				}
	    }
	    else {
		    if ($s != 0){
			    if ($r != '') $r .= ' ';
			    $r .= $s;
			    $r .= '\'\'';
		    }
	    }

			if ($value->GetSign()<0) $r = '-'.$r;
	    return $r;
		}
		return '';
	}

	/** @return string */
	public static function FormatDateTime($value,$format = 'D, j M Y, H:i:s'){
		if (is_int( $value ))
			$value = new XDateTime($value);
		if ($value instanceof DateTime)
			$value = new XDateTime($value);
		return $value instanceof XDateTime ? $value->Format($format) : '';
	}
	/** @return string */
	public static function FormatDate($value,$format = 'D, j M Y'){
		if (is_int( $value ))
			$value = new XDateTime($value);
		if ($value instanceof DateTime)
			$value = new XDateTime($value);
		return $value instanceof XDateTime ? $value->Format($format) : '';
	}
	/** @return string */
	public static function FormatTime($value,$format = 'H:i:s'){
		if (is_int( $value ))
			$value = new XDateTime($value);
		if ($value instanceof DateTime)
			$value = new XDateTime($value);
		return $value instanceof XDateTime ? $value->Format($format) : '';
	}




	/** @return string */
	public static function FormatDateTimeRelatively($value,$null_caption = ''){
		if (is_int( $value ))
			$value = new XDateTime($value);
		if ($value instanceof DateTime)
			$value = new XDateTime($value);
		if (!($value instanceof XDateTime))
			return $null_caption;

		/** @var $value XDateTime */
		/** @var $today XDate */
		$today = XDate::Today();
		$y1 = $today->GetYear();
		$y2 = $value->GetYear();
		$m1 = $today->GetMonth();
		$m2 = $value->GetMonth();
		$d1 = $today->GetDay();
		$d2 = $value->GetDay();

		/** @var $diff XTimeSpan */
		$diff = $today->Diff($value);
		$hours = $diff->GetTotalHours();

		if (!($y1 == $y2 || ($y1 - $y2 == 1 && $m1 - $m2 > 0)))
			return $value->Format('j F Y');
		if (!($y1 == $y2 || ($y1 - $y2 == 1 && $m1 - $m2 > 0)))
			return $value->Format('j F Y');
		elseif ($y1 == $y2 && $m1 == $m2 && $d1 == $d2)
			return $value->Format('H:i');
		elseif ($hours < 0 && $hours >= -25)
			return Lemma::Pick('Tomorrow');
		elseif ($hours < -25 && $hours >= -49)
			return Lemma::Pick('xDays')->Sprintf(2);
		elseif ($hours < -49 && $hours >= -73)
			return Lemma::Pick('xDays')->Sprintf(3);
		elseif ($hours < -73 && $hours >= -97)
			return Lemma::Pick('xDays')->Sprintf(4);
		elseif ($hours < -97 && $hours >= -121)
			return Lemma::Pick('xDays')->Sprintf(5);
		elseif ($hours < -121 && $hours >= -145)
			return Lemma::Pick('xDays')->Sprintf(6);
		elseif ($hours < -145 && $hours >= -169)
			return Lemma::Pick('xDays')->Sprintf(7);
		else
			return $value->GetDay().' '.$value->Format('F');
	}
	/** @return string */
	public static function FormatDateRelatively($value,$null_caption = ''){
		if (is_int( $value ))
			$value = new XDateTime($value);
		if ($value instanceof DateTime)
			$value = new XDateTime($value);
		if (!($value instanceof XDateTime))
			return $null_caption;


		/** @var $value XDateTime */
		/** @var $today XDate */
		$today = XDate::Today();
		$y1 = $today->GetYear();
		$y2 = $value->GetYear();
		$m1 = $today->GetMonth();
		$m2 = $value->GetMonth();
		$d1 = $today->GetDay();
		$d2 = $value->GetDay();

		/** @var $diff XTimeSpan */
		$diff = $today->Diff($value);
		$hours = $diff->GetTotalHours();

		if (!($y1 == $y2 || ($y1 - $y2 == 1 && $m1 - $m2 > 0)))
			return $value->Format('j F Y');
		elseif ($y1 == $y2 && $m1 == $m2 && $d1 == $d2)
			return Lemma::Pick('Today');
		elseif ($hours < 0 && $hours >= -25)
			return Lemma::Pick('Tomorrow');
		elseif ($hours < -25 && $hours >= -49)
			return Lemma::Sprintf('xDays',2);
		elseif ($hours < -49 && $hours >= -73)
			return Lemma::Sprintf('xDays',3);
		elseif ($hours < -73 && $hours >= -97)
			return Lemma::Sprintf('xDays',4);
		elseif ($hours < -97 && $hours >= -121)
			return Lemma::Sprintf('xDays',5);
		elseif ($hours < -121 && $hours >= -145)
			return Lemma::Sprintf('xDays',6);
		elseif ($hours < -145 && $hours >= -169)
			return Lemma::Sprintf('xDays',7);
		else
			return $value->GetDay().' '.$value->Format('F');
	}




	public static function FormatBytes($size){
		$unit = Lemma::Pick('unit:byte');
		if ($size >= 1000) { $size /= 1000; $unit = 'K'.Lemma::Pick('unit:byte'); }
		if ($size >= 1000) { $size /= 1000; $unit = 'M'.Lemma::Pick('unit:byte');	}
		if ($size >= 1000) { $size /= 1000; $unit = 'G'.Lemma::Pick('unit:byte');	}
		if ($size >= 1000) { $size /= 1000; $unit = 'T'.Lemma::Pick('unit:byte');	}
		$size = round($size,1);
		return Language::FormatNumber($size).' '.$unit;
	}
	public static function FormatSizeBinary($size){
		$unit = Lemma::Pick('unit:byte');
		if ($size >= 1024) { $size /= 1024; $unit = 'Ki'.Lemma::Pick('unit:byte'); }
		if ($size >= 1024) { $size /= 1024; $unit = 'Mi'.Lemma::Pick('unit:byte');	}
		if ($size >= 1024) { $size /= 1024; $unit = 'Gi'.Lemma::Pick('unit:byte');	}
		if ($size >= 1024) { $size /= 1024; $unit = 'Ti'.Lemma::Pick('unit:byte');	}
		$size = round($size,1);
		return Language::FormatNumber($size).' '.$unit;
	}

	public static $EnumCommon = array (
		'en','de','el','es','it','fi','fr','ja','ko','nl','no','pl','pt','ru','sv','zh'
		);

	public static function Translate($lang) {
		return Lemma::Pick('lang:'.$lang);
	}
}
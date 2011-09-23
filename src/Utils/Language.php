<?php

final class Language {

	/** @return string */
	public static function GetDecimalSeparator(){
		switch (Oxygen::$lang) {
			case 'fr': case 'el': return ',';
			default: return '.';
		}
	}
	/** @return string */
	public static function GetThousandsSeparator(){
		switch (Oxygen::$lang) {
			case 'fr': case 'el': return '.';
			default: return ',';
		}
	}

	/** @return string */
	public static function FormatDecimal($value,$number_of_decimals=-1) {
		if (is_numeric($value)){
			$value = floatval($value);
			if ($number_of_decimals < 0){
				$s1 = strstr(''.$value,'.');
				$s2 = strstr(''.$value,self::GetDecimalSeparator());
				$number_of_decimals = 0;
				if ($s1!==false) $number_of_decimals = strlen($s1)-1;
				if ($s2!==false) $number_of_decimals = strlen($s2)-1;
			}
			return number_format($value, $number_of_decimals, self::GetDecimalSeparator(), '');
		}
		return '';
	}

	/** @return string */
	public static function FormatNumber($value,$number_of_decimals=-1) {
		if (is_numeric($value)){
			$value = floatval($value);
			if ($number_of_decimals < 0){
				$s1 = strstr(''.$value,'.');
				$s2 = strstr(''.$value,self::GetDecimalSeparator());
				$number_of_decimals = 0;
				if ($s1!==false) $number_of_decimals = strlen($s1)-1;
				if ($s2!==false) $number_of_decimals = strlen($s2)-1;
			}
			return number_format($value, $number_of_decimals, self::GetDecimalSeparator(), self::GetThousandsSeparator());
		}
		return '';
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

	    if ($d != 0) $r .= $d.Lemma::Retrieve('d.');
	    if ($r == '') { if ($h != 0) $r .= $h.Lemma::Retrieve('h.'); } else $r .= ' '.$h.Lemma::Retrieve('h.');
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
			return Lemma::Retrieve('Tomorrow');
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
			return Lemma::Retrieve('Today');
		elseif ($hours < 0 && $hours >= -25)
			return Lemma::Retrieve('Tomorrow');
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
		$unit = Lemma::Retrieve('unit:byte');
		if ($size >= 1000) { $size /= 1000; $unit = 'K'.Lemma::Retrieve('unit:byte'); }
		if ($size >= 1000) { $size /= 1000; $unit = 'M'.Lemma::Retrieve('unit:byte');	}
		if ($size >= 1000) { $size /= 1000; $unit = 'G'.Lemma::Retrieve('unit:byte');	}
		if ($size >= 1000) { $size /= 1000; $unit = 'T'.Lemma::Retrieve('unit:byte');	}
		$size = round($size,1);
		return Language::FormatDecimal($size).' '.$unit;
	}
	public static function FormatSizeBinary($size){
		$unit = Lemma::Retrieve('unit:byte');
		if ($size >= 1024) { $size /= 1024; $unit = 'Ki'.Lemma::Retrieve('unit:byte'); }
		if ($size >= 1024) { $size /= 1024; $unit = 'Mi'.Lemma::Retrieve('unit:byte');	}
		if ($size >= 1024) { $size /= 1024; $unit = 'Gi'.Lemma::Retrieve('unit:byte');	}
		if ($size >= 1024) { $size /= 1024; $unit = 'Ti'.Lemma::Retrieve('unit:byte');	}
		$size = round($size,1);
		return Language::FormatDecimal($size).' '.$unit;
	}

	public static $EnumCommon = array (
		'en','de','el','es','it','fi','fr','ja','ko','nl','no','pl','pt','ru','sv','zh'
		);

	public static function Translate($lang) {
		return Lemma::Retrieve('lang:'.$lang);
	}
}
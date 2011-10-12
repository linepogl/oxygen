<?php

class XDateTime implements Serializable, OmniValue {
	private $timestamp;
	public static function Make($year,$month,$day,$hours=0,$minutes=0,$seconds=0){
		return new static(mktime($hours,$minutes,$seconds,$month,$day,$year));
	}
	public function __construct($timestamp = null){
		if ($timestamp instanceof DateTime) $timestamp = $timestamp->getTimestamp();
		$this->timestamp = is_null($timestamp) ? time() : $timestamp;
	}

	public function OmniType(){ return OmniDateTime::Type(); }
	public function serialize(){ return serialize($this->timestamp); }
	public function unserialize($data){ $this->timestamp = unserialize($data); }

	public static function Now(){ return new XDateTime(); }

	public function GetYear()      { return intval(date('Y',$this->timestamp)); }
	public function GetMonth()     { return intval(date('m',$this->timestamp)); }
	public function GetDay()       { return intval(date('d',$this->timestamp)); }
	public function GetHours()     { return intval(date('H',$this->timestamp)); }
	public function GetMinutes()   { return intval(date('i',$this->timestamp)); }
	public function GetSeconds()   { return intval(date('s',$this->timestamp)); }
	public function GetWeek()      { return intval(date('W',$this->timestamp)); }
	public function GetTimestamp() { return $this->timestamp; }
	public function GetDate() { return new XDate($this->timestamp); }
	public function GetTime() { return new XTime($this->timestamp); }
	public function AsDate() { return new XDate($this->timestamp); }
	public function AsTime() { return new XTime($this->timestamp); }
	public function AsInt()  { return $this->timestamp; }


	/** @return XTimeSpan */
	public function Diff(XDateTime $value){
		return new XTimeSpan($this->GetTimestamp() - $value->GetTimestamp());
	}

	/** @return XDateTime */
	public function AddYears($value){
		return new XDateTime(mktime(
			 $this->GetHours()
			,$this->GetMinutes()
			,$this->GetSeconds()
			,$this->GetMonth()
			,$this->GetDay()
			,$this->GetYear() + $value
 			));
	}
	/** @return XDateTime */
	public function AddMonths($value){
		return new XDateTime(mktime(
			 $this->GetHours()
			,$this->GetMinutes()
			,$this->GetSeconds()
			,$this->GetMonth() + $value
			,$this->GetDay()
			,$this->GetYear()
 			));
	}
	/** @return XDateTime */
	public function AddDays($value){
		return new XDateTime(mktime(
			 $this->GetHours()
			,$this->GetMinutes()
			,$this->GetSeconds()
			,$this->GetMonth()
			,$this->GetDay() + $value
			,$this->GetYear()
 			));
	}
	/** @return XDateTime */
	public function AddHours($value){
		return new XDateTime(mktime(
			 $this->GetHours() + $value
			,$this->GetMinutes()
			,$this->GetSeconds()
			,$this->GetMonth()
			,$this->GetDay()
			,$this->GetYear()
 			));
	}
	/** @return XDateTime */
	public function AddMinutes($value){
		return new XDateTime(mktime(
			 $this->GetHours()
			,$this->GetMinutes() + $value
			,$this->GetSeconds()
			,$this->GetMonth()
			,$this->GetDay()
			,$this->GetYear()
 			));
	}
	/** @return XDateTime */
	public function AddSeconds($value){
		return new XDateTime(mktime(
			 $this->GetHours()
			,$this->GetMinutes()
			,$this->GetSeconds() + $value
			,$this->GetMonth()
			,$this->GetDay()
			,$this->GetYear()
 			));
	}
	/** @return XDateTime */
	public function AddTimeSpan(TimeStamp $value){
		return $this->AddSeconds($value->GetTotalSeconds());
	}


	/**
	* @param string $value
	* @param string $format  --see date()
	* @return XDateTime
	*/
	public static function Parse($value,$format){
		$d = DateTime::createFromFormat($format,$value);
		if ($d === false)
			throw new Exception('Invalid date or time.');
		else
		return new static($d->getTimestamp());
	}



	private static $translations = array('%'=>'%%','d'=>'%d','D'=>'%a','j'=>'%d','l'=>'%A','N'=>'%u','S'=>null,'w'=>'%w','z'=>'%j','W'=>'%W','F'=>'%B','m'=>'%m','M'=>'%b','n'=>null,'t'=>null,'L'=>null,'o'=>'%G','Y'=>'%Y','y'=>'%y','a'=>'%P','A'=>'%p','B'=>null,'g'=>'%l','G'=>null,'h'=>'%I','H'=>'%H','i'=>'%M','s'=>'%S','u'=>null,'e'=>null,'I'=>null,'O'=>'%Z','P'=>null,'T'=>null,'Z'=>null,'c'=>'%Y-%m-%dT%H:%M:%S%Z','r'=>'%a, %e %b %Y %H:%M:%S %Z','U'=>null);
	private static $translated_formats_cache = array();
	private static function translate_format($format){
		if (!array_key_exists($format,self::$translated_formats_cache)){
			$f = ''; $escape = false;
			foreach (str_split($format) as $x){
				if ($escape){ $f .= $x; $escape = false; }
				elseif ($x == '\\') { $escape = true; continue; }
				else $f .= array_key_exists($x,self::$translations) ? self::$translations[$x] : $x;
			}
			self::$translated_formats_cache[$format] = $f;
		}
		return self::$translated_formats_cache[$format];
	}
	/**
	* @param string $format  --see date()
	* @return string
	*/
	public function Format($format){
		$r = strftime(self::translate_format($format),$this->timestamp);
		return $r!==false ? $r : date($format,$this->timestamp);
	}



}



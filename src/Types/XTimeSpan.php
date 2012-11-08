<?php

class XTimeSpan extends XValue implements Serializable {
	private $value;

	public static function Make($days,$hours,$minutes,$seconds=0,$milliseconds=0,$sign=1){
		return new XTimeSpan($sign * ($days*self::MILLISECONDS_IN_DAY + $hours*self::MILLISECONDS_IN_HOUR + $minutes * self::MILLISECONDS_IN_MINUTE + $seconds * self::MILLISECONDS_IN_SECOND + $milliseconds));
	}
	public function __construct($total_milliseconds=0){
		$this->value = $total_milliseconds;
	}

	public function MetaType(){ return MetaTimeSpan::Type(); }
	public function Serialize(){ return Oxygen::SerializeWithTheCurrentMethod( $this->value ); }
	public function Unserialize($data){ $this->value = Oxygen::UnserializeWithTheCurrentMethod( $data ); }

	const MILLISECONDS_IN_WEEK = 604800000;
	const MILLISECONDS_IN_DAY = 86400000;
	const MILLISECONDS_IN_HOUR = 3600000;
	const MILLISECONDS_IN_MINUTE = 60000;
	const MILLISECONDS_IN_SECOND = 1000;


	public function GetTotalWeeks(){ return intval($this->value/self::MILLISECONDS_IN_WEEK); }
	public function GetTotalDays(){ return intval($this->value/self::MILLISECONDS_IN_DAY); }
	public function GetTotalHours(){ return intval($this->value/self::MILLISECONDS_IN_HOUR); }
	public function GetTotalMinutes(){ return intval($this->value/self::MILLISECONDS_IN_MINUTE); }
	public function GetTotalSeconds(){ return intval($this->value/self::MILLISECONDS_IN_SECOND); }
	public function GetTotalMilliSeconds(){ return $this->value; }
	public function GetSign(){ return $this->value < 0 ? -1 : 1; }


	public function GetJustWeeks(){ return intval($this->value/self::MILLISECONDS_IN_WEEK); }
	public function GetJustDays(){ return $this->GetSign() * intval((abs($this->value) % self::MILLISECONDS_IN_WEEK) / self::MILLISECONDS_IN_DAY); }
	public function GetJustHours(){ return $this->GetSign() * intval((abs($this->value) % self::MILLISECONDS_IN_DAY) / self::MILLISECONDS_IN_HOUR); }
	public function GetJustMinutes(){ return $this->GetSign() * intval((abs($this->value) % self::MILLISECONDS_IN_HOUR) / self::MILLISECONDS_IN_MINUTE); }
	public function GetJustSeconds(){ return $this->GetSign() * intval((abs($this->value) % self::MILLISECONDS_IN_MINUTE) / self::MILLISECONDS_IN_SECOND); }
	public function GetJustMilliseconds(){ return $this->GetSign() * (abs($this->value) % self::MILLISECONDS_IN_SECOND); }

	public function GetDecimalWeeks(){ return $this->value / self::MILLISECONDS_IN_DAY; }
	public function GetDecimalDays(){ return $this->value / self::MILLISECONDS_IN_DAY; }
	public function GetDecimalHours(){ return $this->value / self::MILLISECONDS_IN_HOUR; }
	public function GetDecimalMinutes(){ return $this->value / self::MILLISECONDS_IN_MINUTE; }
	public function GetDecimalSeconds(){ return $this->value/self::MILLISECONDS_IN_SECOND; }
	public function GetDecimalMilliSeconds(){ return $this->value; }

	// TODO: REMOVE THESE DEPRECATED FUNCTIONS
	public function GetDays(){ return intval($this->value/self::MILLISECONDS_IN_DAY); }
	public function GetHours(){ return $this->GetSign() * intval((abs($this->value) % self::MILLISECONDS_IN_DAY) / self::MILLISECONDS_IN_HOUR); }
	public function GetMinutes(){ return $this->GetSign() * intval((abs($this->value) % self::MILLISECONDS_IN_HOUR) / self::MILLISECONDS_IN_MINUTE); }
	public function GetSeconds(){ return $this->GetSign() * intval((abs($this->value) % self::MILLISECONDS_IN_MINUTE) / self::MILLISECONDS_IN_SECOND); }
	public function GetMilliseconds(){ return $this->GetSign() * (abs($this->value) % self::MILLISECONDS_IN_SECOND); }
	/////


	/** @return XTimeSpan */ public function Add( XTimeSpan $value = null ){ return new XTimeSpan( $this->value + (is_null($value) ? 0 : $value->GetTotalMilliSeconds()) ); }
	/** @return XTimeSpan */ public function AddWeeks( $value ){ return new XTimeSpan( $this->value + $value * self::MILLISECONDS_IN_WEEK ); }
	/** @return XTimeSpan */ public function AddDays( $value ){ return new XTimeSpan( $this->value + $value * self::MILLISECONDS_IN_DAY ); }
	/** @return XTimeSpan */ public function AddHours( $value ){ return new XTimeSpan( $this->value + $value * self::MILLISECONDS_IN_HOUR ); }
	/** @return XTimeSpan */ public function AddMinutes( $value ){ return new XTimeSpan( $this->value + $value * self::MILLISECONDS_IN_MINUTE ); }
	/** @return XTimeSpan */ public function AddSeconds( $value ){ return new XTimeSpan( $this->value + $value * self::MILLISECONDS_IN_SECOND ); }
	/** @return XTimeSpan */ public function AddMilliSeconds( $value ){ return new XTimeSpan( $this->value + $value  ); }


	/**
	* @param string $value W3C duration format
	* @return XTimeSpan
	*/
	public static function Parse($value){
		$x = new DateInterval($value);
		return self::Make(
			intval($x->format('%a')),
			intval($x->format('%h')),
			intval($x->format('%i')),
			intval($x->format('%s')),
			(floatval($x->format('%s'))*1000) % 1000,
			$x->format('%r')=='-' ? -1 : 1
			);
	}

	/**
	* @return string in W3C duration format
	*/
	public function AsString(){
		$r = '';
		if ($this->GetSign() < 0) $r .= '-';
		$r .= 'P';
//		$x = $this->GetDays(); if ($x > 0) $r .= $x . 'D';
		$r1 = '';
		$x = $this->GetTotalHours(); if ($x >= 0) $r1 .= $x . 'H';
		$x = $this->GetMinutes(); if ($x >= 0) $r1 .= $x . 'M';
		$x = $this->GetSeconds();
		$x1 = $this->GetMilliseconds();
		if ($x >= 0) {
			$r1 .= $x;
			if ($x1>=0) $r1 .= '.'.sprintf('%03d',$x1);
			$r1 .= 'S';
		}
		if ($r1 != '') $r .= 'T' . $r1;
		return $r;
	}


	public function AsInt(){
		return $this->value;
	}


	public function IsEqualTo( $x ){
		if ($x instanceof XTimeSpan) return $this->value == $x->value;
		if (is_int($x)||is_float($x)) return $this->value == $x;
		return parent::IsEqualTo($x);
	}
	public function CompareTo( $x ){
		if ($x instanceof XTimeSpan) return $this->value - $x->value;
		if (is_int($x)||is_float($x)) return $this->value - $x;
		return parent::CompareTo($x);
	}



}

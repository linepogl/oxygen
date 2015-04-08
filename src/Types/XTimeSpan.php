<?php

class XTimeSpan extends XValue implements Serializable {
	private $value;

	public static function Make($days,$hours,$minutes,$seconds=0,$milliseconds=0,$sign=1){
		return new XTimeSpan($sign * ($days*self::MILLISECONDS_IN_DAY + $hours*self::MILLISECONDS_IN_HOUR + $minutes * self::MILLISECONDS_IN_MINUTE + $seconds * self::MILLISECONDS_IN_SECOND + $milliseconds));
	}
	public function VarExport() { return '(new '.get_called_class().'('.$this->value.'))'; }
	public function __construct($total_milliseconds=0){
		$this->value = $total_milliseconds;
	}

	public function MetaType(){ return MetaTimeSpan::Type(); }
	public function Serialize(){ return serialize( $this->value ); }
	public function Unserialize($data){ $this->value = unserialize( $data ); }

	const MILLISECONDS_IN_WEEK = 604800000;
	const MILLISECONDS_IN_DAY = 86400000;
	const MILLISECONDS_IN_HOUR = 3600000;
	const MILLISECONDS_IN_MINUTE = 60000;
	const MILLISECONDS_IN_SECOND = 1000;

	/** @return XTimeSpan */ public static function Zero(){ static $r=null; if($r===null)$r=new XTimeSpan(); return $r; }

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

	public function GetDecimalWeeks(){ return $this->value / self::MILLISECONDS_IN_WEEK; }
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

	/** @return XTimeSpan */ public function MultiplyBy( $value ){ return new XTimeSpan( $this->value * $value  ); }
	/** @return XTimeSpan */ public function Invert(){ return new XTimeSpan( -$this->value ); }


	/**
	* @param string $value W3C duration format
	* @return XTimeSpan
	*/
	private static $W3C_DURATION_REGEXP = '/^(-?)P(([0-9]+)D)?(T(([0-9]+)H)?(([0-9]+)M)?(([0-9]+\.?[0-9]*?)S)?)?$/';
	public static function Parse($value){
		preg_match_all(self::$W3C_DURATION_REGEXP,$value,$matches,PREG_SET_ORDER);
		if (empty($matches)) throw new Exception('Invalid timespan.');
		$count = count($matches[0]);
		$milliseconds = 0;
		$seconds = 0;
		$minutes = 0;
		$hours = 0;
		$days = 0;
		$sign = 1;
		if ($count>1) {
			$sign = $matches[0][1]==='-' ? -1 : 1;
			if ($count>3) {
				$days = intval($matches[0][3]);
				if ($count>6) {
					$hours = intval($matches[0][6]);
					if ($count>8) {
						$minutes = intval($matches[0][8]);
						if ($count>10) {
							$seconds = intval($matches[0][10]);
							if ($count>12) {
								$milliseconds = intval($matches[0][12]);
							}
						}
					}
				}
			}
		}
		return XTimeSpan::Make($days,$hours,$minutes,$seconds,$milliseconds,$sign);
	}

	/**
	* @return string in W3C duration format
	*/
	public function AsString(){
		$r = '';
		if ($this->GetSign() < 0) $r .= '-';
		$r .= 'PT';
		$x = $this->GetTotalHours(); if ($x > 0) $r .= $x . 'H';
		$x = $this->GetMinutes(); if ($x > 0) $r .= $x . 'M';
		$x = $this->GetSeconds();
		$x1 = $this->GetMilliseconds();
		if ($x > 0 || $x1 > 0) {
			$r .= $x;
			if ($x1>0) $r .= '.'.sprintf('%03d',$x1);
			$r .= 'S';
		}
		if ($r == 'PT') $r .= '0S';
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

<?php

class MetaTimeSpanOrZero extends XType {

	private static $default;
	private static $instance;
	public static function Init(){ self::$instance = new self(); self::$default = new XTimeSpan(); }
	/** @return MetaTimeSpanOrZero */ public static function Type() { return self::$instance; }
	/** @return XTimeSpan */ public static function GetDefaultValue() { return self::$default; }





	/**
	 * @param $address XTimeSpan
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value instanceof XTimeSpan) { $address = $value; return; }
		throw new ValidationException();
	}





	//
	//
	// Database round-trip
	//
	//
	/** @return int */
	public static function GetPdoType() { return PDO::PARAM_INT; }

	/**
	 * @param $value XTimeSpan
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return $value->GetTotalMilliSeconds();
	}

	/**
	 * @param $value XTimeSpan
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return strval($value->GetTotalMilliSeconds());
	}

	/**
	 * @param $value XTimeSpan
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return XTimeSpan
	 */
	public static function ImportDBValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		return new XTimeSpan(intval($value));
	}





	//
	//
	// Interface round-trip
	//
	//
	/** @return string */
	public static function GetXsdType() { return 'xs:duration'; }








	/**
	 * @param $value XTimeSpan
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return strval($value->GetTotalMilliseconds());
	}

	/**
	 * @param $value XTimeSpan
	 * @return string
	 */
	public static function ExportXmlString($value) {
		return $value->AsString();
	}

	/**
	 * @param $value XTimeSpan
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return strval($value->GetTotalMilliseconds());
	}

	/**
	 * @param $value XTimeSpan
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		$d = $value->GetDays();
		$h = $value->GetHours();
		$m = $value->GetMinutes();
		$s = $value->GetSeconds();
		return ($d==0?'':$d.Lemma::Pick('d.'))
				 . ($h==0?'':$h.Lemma::Pick('h.'))
				 . ($m+$s==0?'': ($m==0?'':$m.'\'').($s==0?'':$s.'\'\'') )
				 ;
	}

	/**
	 * @param $value XTimeSpan
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return strval($value->GetTotalMilliseconds());
	}


	/**
	 * @param $value string|null
	 * @return XTimeSpan
	 */
	public static function ImportDomValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		return new XTimeSpan(intval($value));
	}

	/**
	 * @param $value string|null|array
	 * @return XTimeSpan
	 */
	public static function ImportHttpValue($value) {
		if (is_array($value)) throw new ConvertionException();
		return new XTimeSpan(intval($value));
	}
}

MetaTimeSpanOrZero::Init();

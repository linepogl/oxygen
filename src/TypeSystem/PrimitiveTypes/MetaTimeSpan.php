<?php

class MetaTimeSpan extends XNullableType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaTimeSpan */ public static function Type() { return self::$instance; }
	/** @return XTimeSpan|null */ public static function GetDefaultValue() { return null; }





	/**
	 * @param $address XTimeSpan|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if (is_null($value)) { $address = $value; return; }
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
	 * @param $value XTimeSpan|null
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		if (is_null($value)) return null;
		return $value->GetTotalMilliSeconds();
	}

	/**
	 * @param $value XTimeSpan|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		if (is_null($value)) return Sql::Null;
		return strval($value->GetTotalMilliSeconds());
	}

	/**
	 * @param $value XTimeSpan|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return XTimeSpan|null
	 */
	public static function ImportDBValue($value) {
		if (is_null($value)) return null;
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
	 * @param $value XTimeSpan|null
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		if (is_null($value)) return Js::Null;
		return strval($value->GetTotalMilliseconds());
	}

	/**
	 * @param $value XTimeSpan|null
	 * @return string
	 */
	public static function ExportXmlString($value) {
		if (is_null($value)) return '';
		return $value->AsString();
	}

	/**
	 * @param $value XTimeSpan|null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if (is_null($value)) return '';
		return strval($value->GetTotalMilliseconds());
	}

	/**
	 * @param $value XTimeSpan|null
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		if (is_null($value)) return '';
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
	 * @param $value XTimeSpan|null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if (is_null($value)) return '';
		return strval($value->GetTotalMilliseconds());
	}


	/**
	 * @param $value string|null
	 * @return XTimeSpan|null
	 */
	public static function ImportDomValue($value) {
		if (is_null($value)) return null;
		if ($value === '') return null;
		return new XTimeSpan(intval($value));
	}

	/**
	 * @param $value string|null|array
	 * @return XTimeSpan|null
	 */
	public static function ImportHttpValue($value) {
		if (is_null($value)) return null;
		if ($value === '') return null;
		if (is_array($value)) throw new ConvertionException();
		return new XTimeSpan(intval($value));
	}
}

MetaTimeSpan::Init();
<?php

class OmniDate extends OmniDateTime {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return OmniDate */ public static function Type() { return self::$instance; }
	/** @return XDate */ public static function GetDefaultValue() { return new XDate(); }





	/**
	 * @param $address XDate
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value instanceof XDate) { $address = $value; return; }
		throw new ValidationException();
	}





	//
	//
	// Database round-trip
	//
	//
	/** @return int */
	public static function GetPdoType() { return PDO::PARAM_STR; }

	/**
	 * @param $value XDate
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		switch ($platform) {
			default:
			case Database::MYSQL:   return $value->Format('Y-m-d H:i:s');
			case Database::ORACLE:  return $value->Format('Y-m-d H:i:s');
		}
		throw new ConvertionException();
	}

	/**
	 * @param $value XDate
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		switch ($platform) {
			default:
			case Database::MYSQL:   return '\''.$value->Format('Y-m-d H:i:s').'\'';
			case Database::ORACLE:  return '\''.$value->Format('Y-m-d H:i:s').'\'';
		}
		throw new ConvertionException();
	}

	/**
	 * @param $value XDate
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return XDate
	 */
	public static function ImportDBValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		if ($value === '0000-00-00 00:00:00') return self::GetDefaultValue();
		return XDate::Parse($value,'Y-m-d H:i:s');
	}





	//
	//
	// Interface round-trip
	//
	//
	/** @return string */
	public static function GetXsdType() { return 'xs:date'; }








	/**
	 * @param $value XDate
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return 'new Date('.$value->GetYear().','.($value->GetMonth()-1).','.$value->GetDay().','.$value->GetHours().','.$value->GetMinutes().','.$value->GetSeconds().')';
	}

	/**
	 * @param $value XDate
	 * @return string
	 */
	public static function ExportXmlString($value) {
		return $value->Format('Y-m-d');
	}

	/**
	 * @param $value XDate
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return $value->Format('YmdHis');
	}

	/**
	 * @param $value XDate
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		return self::EncodeAsHtmlString( Language::FormatDate($value) );
	}

	/**
	 * @param $value XDate
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return $value->Format('YmdHis');
	}


	/**
	 * @param $value string|null
	 * @return XDate
	 */
	public static function ImportDomValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		if ($value === '') return self::GetDefaultValue();
		return XDate::Parse($value,'Y-m-d');
	}

	/**
	 * @param $value string|null|array
	 * @return XDate
	 */
	public static function ImportHttpValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		if ($value === '') return self::GetDefaultValue();
		if (is_array($value)) throw new ConvertionException();
		return XDate::Parse($value,'YmdHis');
	}
}

OmniDate::Init();
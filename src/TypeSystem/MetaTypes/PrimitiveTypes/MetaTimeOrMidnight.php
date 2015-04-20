<?php

class MetaTimeOrMidnight extends XConcreteType {

	private static $default;
	private static $instance;
	public static function Init(){ self::$instance = new self(); self::$default = XTime::Midnight(); }
	/** @return MetaTimeOrMidnight */ public static function Type() { return self::$instance; }
	/** @return MetaTime */ public static function GetNullableType(){ return MetaTime::Type(); }
	/** @return XTime */ public static function GetDefaultValue() { return self::$default; }
	




	/** @return int */
	public static function GetPdoType() { return PDO::PARAM_STR; }

	/** @return string */
	public static function GetXsdType() { return 'xs:time'; }



	/**
	 * @param $address XTime
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value instanceof XTime) { $address = $value; return; }
		throw new ValidationException();
	}


	/**
	 * @param $value XTime
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		switch ($platform) {
			default:
			case Database::MYSQL:   return Oxygen::WithServerTimeZone(function()use($value){ return date('Y-m-d H:i:s',$value->AsInt()); });
			case Database::ORACLE:  return Oxygen::WithServerTimeZone(function()use($value){ return date('Y-m-d H:i:s',$value->AsInt()); });
		}
	}

	/**
	 * @param $value XTime
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		switch ($platform) {
			default:
			case Database::MYSQL:   return Oxygen::WithServerTimeZone(function()use($value){ return '\''.date('Y-m-d H:i:s',$value->AsInt()).'\''; });
			case Database::ORACLE:  return Oxygen::WithServerTimeZone(function()use($value){ return '\''.date('Y-m-d H:i:s',$value->AsInt()).'\''; });
		}
	}

	/**
	 * @param $value XTime
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value XTime
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return 'new Date('.$value->GetYear().','.($value->GetMonth()-1).','.$value->GetDay().','.$value->GetHours().','.$value->GetMinutes().','.$value->GetSeconds().')';
	}

	/**
	 * @param $value XTime
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		return $value->Format('H:i:s');
	}

	/**
	 * @param $value XTime
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return self::EncodeAsHtmlString( Language::FormatTime($value) );
	}

	/**
	 * @param $value XTime
	 * @return string
	 */
	public static function ExportTextString($value) {
		return Language::FormatTime($value);
	}

	/**
	 * @param $value XTime
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return $value->Format('YmdHis');
	}

	/**
	 * @param $value XTime
	 * @return string
	 */
	public static function ExportValString($value) {
		return $value->Format('YmdHis');
	}

	/**
	 * @param $value string|null
	 * @return XTime
	 */
	public static function ImportDBValue($value) {
		if ($value===null) return self::GetDefaultValue();
		if ($value == '0000-00-00 00:00:00') return self::GetDefaultValue();
		return XTime::Parse($value,'Y-m-d H:i:s');
	}

	/**
	 * @param $value string|null
	 * @return XTime
	 */
	public static function ImportDomValue($value) {
		if ($value===null) return self::GetDefaultValue();
		if ($value === '') return self::GetDefaultValue();
		return XTime::Parse($value,'H:i:s');
	}

	/**
	 * @param $value string|null|array
	 * @return XTime
	 */
	public static function ImportHttpValue($value) {
		if ($value===null) return self::GetDefaultValue();
		if ($value === '') return self::GetDefaultValue();
		if (is_array($value)) throw new ConvertionException();
		return XTime::Parse($value,'YmdHis');
	}
}

MetaTimeOrMidnight::Init();

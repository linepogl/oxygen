<?php

class MetaTime extends XNullableType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaTime */ public static function Type() { return self::$instance; }
	/** @return XTime|null */ public static function GetDefaultValue() { return null; }






	/** @return int */
	public static function GetPdoType() { return PDO::PARAM_STR; }

	/** @return string */
	public static function GetXsdType() { return 'xs:time'; }



	/**
	 * @param $address XTime|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value===null) { $address = $value; return; }
		if ($value instanceof XTime) { $address = $value; return; }
		throw new ValidationException();
	}


	/**
	 * @param $value XTime|null
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		if ($value===null) return null;
		switch ($platform) {
			default:
			case Database::MYSQL:      return Oxygen::WithServerTimeZone(function()use($value){ return date('Y-m-d H:i:s',$value->AsInt()); });
			case Database::SQLSERVER:  return Oxygen::WithServerTimeZone(function()use($value){ return date('Y-m-d H:i:s',$value->AsInt()); });
			case Database::ORACLE:     return Oxygen::WithServerTimeZone(function()use($value){ return date('Y-m-d H:i:s',$value->AsInt()); });
		}
	}

	/**
	 * @param $value XTime|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		if ($value===null) return Sql::Null;
		switch ($platform) {
			default:
			case Database::MYSQL:      return Oxygen::WithServerTimeZone(function()use($value){ return '\''.date('Y-m-d H:i:s',$value->AsInt()).'\''; });
			case Database::SQLSERVER:  return Oxygen::WithServerTimeZone(function()use($value){ return '\''.date('Y-m-d H:i:s',$value->AsInt()).'\''; });
			case Database::ORACLE:     return Oxygen::WithServerTimeZone(function()use($value){ return '\''.date('Y-m-d H:i:s',$value->AsInt()).'\''; });
		}
	}

	/**
	 * @param $value XTime|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value XTime|null
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		if ($value===null) return Js::Null;
		return 'new Date('.$value->GetYear().','.($value->GetMonth()-1).','.$value->GetDay().','.$value->GetHours().','.$value->GetMinutes().','.$value->GetSeconds().')';
	}

	/**
	 * @param $value XTime|null
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		if ($value===null) return '';
		return $value->Format('H:i:s');
	}

	/**
	 * @param $value XTime|null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if ($value===null) return '';
		return self::EncodeAsHtmlString( Language::FormatTime($value) );
	}

	/**
	 * @param $value XTime|null
	 * @return string
	 */
	public static function ExportTextString($value) {
		if ($value===null) return '';
		return Language::FormatTime($value);
	}

	/**
	 * @param $value XTime|null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if ($value===null) return '';
		return $value->Format('YmdHis');
	}

	/**
	 * @param $value XTime|null
	 * @return string
	 */
	public static function ExportValString($value) {
		if ($value===null) return '';
		return $value->Format('YmdHis');
	}

	/**
	 * @param $value string|null
	 * @return XTime|null
	 */
	public static function ImportDBValue($value) {
		if ($value===null) return null;
		if ($value == '0000-00-00 00:00:00') return null;
		return XTime::Parse($value,'Y-m-d H:i:s+');
	}

	/**
	 * @param $value string|null
	 * @return XTime|null
	 */
	public static function ImportDomValue($value) {
		if ($value===null) return null;
		if ($value === '') return null;
		return XDateTime::Parse($value,'H:i:s');
	}

	/**
	 * @param $value string|null|array
	 * @return XTime|null
	 */
	public static function ImportHttpValue($value) {
		if ($value===null) return null;
		if ($value === '') return null;
		if (is_array($value)) throw new ConvertionException();
		return XTime::Parse($value,'YmdHis');
	}
}

MetaTime::Init();
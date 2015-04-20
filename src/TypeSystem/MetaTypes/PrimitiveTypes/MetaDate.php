<?php

class MetaDate extends MetaDateTime {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaDate */ public static function Type() { return self::$instance; }
	/** @return XDate|null */ public static function GetDefaultValue() { return null; }





	/**
	 * @param $address XDate|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value===null) { $address = $value; return ; }
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
	 * @param $value XDate|null
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		if ($value===null) return null;
		switch ($platform) {
			default:
			case Database::MYSQL:   return Oxygen::WithServerTimeZone(function()use($value){ return date('Y-m-d H:i:s',$value->AsInt()); });
			case Database::ORACLE:  return Oxygen::WithServerTimeZone(function()use($value){ return date('Y-m-d H:i:s',$value->AsInt()); });
		}
	}

	/**
	 * @param $value XDate|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		if ($value===null) return Sql::Null;
		switch ($platform) {
			default:
			case Database::MYSQL:   return Oxygen::WithServerTimeZone(function()use($value){ return '\''.date('Y-m-d H:i:s',$value->AsInt()).'\''; });
			case Database::ORACLE:  return Oxygen::WithServerTimeZone(function()use($value){ return '\''.date('Y-m-d H:i:s',$value->AsInt()).'\''; });
		}
	}

	/**
	 * @param $value XDate|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return XDate|null
	 */
	public static function ImportDBValue($value) {
		if ($value===null) return null;
		if ($value === '0000-00-00 00:00:00') return null;
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
	 * @param $value XDate|null
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		if ($value===null) return Js::Null;
		return 'new Date('.$value->GetYear().','.($value->GetMonth()-1).','.$value->GetDay().','.$value->GetHours().','.$value->GetMinutes().','.$value->GetSeconds().')';
	}

	/**
	 * @param $value XDate|null
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		if ($value===null) return '';
		return $value->Format('Y-m-d');
	}

	/**
	 * @param $value XDate|null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if ($value===null) return '';
		return self::EncodeAsHtmlString( Language::FormatDate($value) );
	}


	/**
	 * @param $value XDate|null
	 * @return string
	 */
	public static function ExportTextString($value) {
		if ($value===null) return '';
		return Language::FormatDate($value);
	}


	/**
	 * @param $value XDate|null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if ($value===null) return '';
		return $value->Format('YmdHis');
	}

	/**
	 * @param $value XDate|null
	 * @return string
	 */
	public static function ExportValString($value) {
		if ($value===null) return '';
		return $value->Format('YmdHis');
	}


	/**
	 * @param $value string|null
	 * @return XDate|null
	 */
	public static function ImportDomValue($value) {
		if ($value===null) return null;
		if ($value === '') return null;
		return XDate::Parse($value,'Y-m-d');
	}

	/**
	 * @param $value string|null|array
	 * @return XDate|null
	 */
	public static function ImportHttpValue($value) {
		if ($value===null) return null;
		if ($value === '') return null;
		if (is_array($value)) throw new ConvertionException();
		return XDate::Parse($value,'YmdHis');
	}
}

MetaDate::Init();
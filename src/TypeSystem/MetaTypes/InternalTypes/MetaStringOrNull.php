<?php

class MetaStringOrNull extends XNullableType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }

	/**
	 * @return MetaStringOrNull
	 */
	public static function Type(){
		return self::$instance;
	}

	/**
	 * @return string|null
	 */
	public static function GetDefaultValue() {
		return null;
	}

	/**
	 * @param $address string|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value!==null && !is_string($value)) throw new ValidationException();
		$address = $value;
	}

	/**
	 * @return int
	 */
	public static function GetPdoType() {
		return PDO::PARAM_STR;
	}

	/**
	 * @return string
	 */
	public static function GetXsdType() {
		return 'xs:string';
	}

	/**
	 * @param $value string|null
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return $value;
	}

	/**
	 * @param $value string|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		if ($value===null) return Sql::Null;
		return self::EncodeAsSqlStringLiteral($value,$platform);
	}

	/**
	 * @param $value string|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		if ($value===null) throw new ConvertionException();
		if ($value === '') throw new ConvertionException();
		return self::EncodeAsSqlIdentifier($value,$platform);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		if ($value===null) return Js::Null;
		return self::EncodeAsJsStringLiteral($value);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		if ($value===null) return '';
		return self::EncodeAsXmlString($value,$attr);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if ($value===null) return '';
		return self::EncodeAsHtmlString($value);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public static function ExportTextString($value) {
		if ($value===null) return '';
		return $value;
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if ($value===null) return '';
		return self::EncodeAsUrlString($value);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public static function ExportValString($value) {
		if ($value===null) return '';
		return $value;
	}

	/**
	 * @param $value string|null
	 * @return string|null
	 */
	public static function ImportDBValue($value) {
		return $value;
	}

	/**
	 * @param $value string|null
	 * @return string|null
	 */
	public static function ImportDomValue($value) {
		if ($value===null) return null;
		return self::DecodeXmlString($value);
	}

	/**
	 * @param $value string|null|array
	 * @return string|null
	 */
	public static function ImportHttpValue($value) {
		if ($value===null) return null;
		if (is_array($value)) return implode(',',$value);
		return $value;
	}
}

MetaStringOrNull::Init();
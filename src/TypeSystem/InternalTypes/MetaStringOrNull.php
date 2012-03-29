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
		if (!is_null($value) && !is_string($value)) throw new ValidationException();
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
		if (is_null($value)) return Sql::Null;
		return self::EncodeAsSqlStringLiteral($value,$platform);
	}

	/**
	 * @param $value string|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		if (is_null($value)) throw new ConvertionException();
		if ($value === '') throw new ConvertionException();
		return self::EncodeAsSqlIdentifier($value,$platform);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		if (is_null($value)) return Js::Null;
		return self::EncodeAsJsStringLiteral($value);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public static function ExportXmlString($value) {
		if (is_null($value)) return '';
		return self::EncodeAsHtmlString($value);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if (is_null($value)) return '';
		return self::EncodeAsHtmlString($value);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		if (is_null($value)) return '';
		return self::EncodeAsHtmlString($value);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if (is_null($value)) return '';
		return self::EncodeAsUrlString($value);
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
		if (is_null($value)) return null;
		return self::DecodeXmlString($value);
	}

	/**
	 * @param $value string|null|array
	 * @return string|null
	 */
	public static function ImportHttpValue($value) {
		if (is_null($value)) return null;
		if (is_array($value)) return self::DecodeHtmlString(self::DecodeUrlString( implode(',',$value) ) );
		return self::DecodeHtmlString( self::DecodeUrlString( $value ) );
	}
}

MetaStringOrNull::Init();
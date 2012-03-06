<?php

class MetaString extends XType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaString */ public static function Type(){ return self::$instance; }
	/** @return string */ public static function GetDefaultValue() { return ''; }





	/**
	 * @param $address string
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if (!is_string($value)) throw new ValidationException();
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
		return PDO::PARAM_STR;
	}

	/**
	 * @param $value string
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportPdoValue($value, $platform) {
		return $value;
	}

	/**
	 * @param $value string
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return self::EncodeAsSqlStringLiteral($value,$platform);
	}

	/**
	 * @param $value string
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		if ($value === '') throw new ConvertionException();
		return self::EncodeAsSqlIdentifier($value,$platform);
	}

	/**
	 * @param $value string
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return self::EncodeAsJsStringLiteral($value);
	}

	/**
	 * @param $value string
	 * @return string
	 */
	public static function ExportXmlString($value) {
		return self::EncodeAsXmlString($value);
	}

	/**
	 * @param $value string
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return self::EncodeAsHtmlString($value);
	}

	/**
	 * @param $value string
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		return self::EncodeAsHtmlString($value);
	}

	/**
	 * @param $value string
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return self::EncodeAsUrlString($value);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public static function ImportDBValue($value) {
		if (is_null($value)) return '';
		return $value;
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public static function ImportDomValue($value) {
		if (is_null($value)) return '';
		return self::DecodeXmlString($value);
	}

	/**
	 * @param $value string|null|array
	 * @return string
	 */
	public static function ImportHttpValue($value) {
		if (is_null($value)) return '';
		if (is_array($value)) return self::DecodeHtmlString(self::DecodeUrlString( implode(',',$value) ) );
		return self::DecodeHtmlString( self::DecodeUrlString( $value ) );
	}
}

MetaString::Init();
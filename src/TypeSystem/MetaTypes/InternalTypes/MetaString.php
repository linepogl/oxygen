<?php

class MetaString extends XConcreteType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaString */ public static function Type(){ return self::$instance; }
	/** @return MetaStringOrNull */ public static function GetNullableType(){ return MetaStringOrNull::Type(); }
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
		return 'xs:string';
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
	public static function ExportXmlString($value,$attr=false) {
		return self::EncodeAsXmlString($value,$attr);
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
		if (is_array($value)) return implode(',',$value);
		return $value;
	}
}

MetaString::Init();
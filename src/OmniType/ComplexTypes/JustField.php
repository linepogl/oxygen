<?php

class JustField extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return JustField */ public static function Type() { return self::$instance; }
	/** @return XField */ public static function GetDefaultValue() { throw new ConvertionException(); }




	
	/**
	 * @param $address XField
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value instanceof XField) $address = $value;
		throw new ValidationException();
	}

	/**
	 * @return int
	 */
	public static function GetPdoType() {
		throw new ConvertionException();
	}

	/**
	 * @return string
	 */
	public static function GetXsdType() {
		return 'xs:string';
	}

	/**
	 * @param $value XField
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return PDO::PARAM_STR;
	}

	/**
	 * @param $value XField
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return self::EncodeAsSqlStringLiteral($value->GetName(),$platform);
	}

	/**
	 * @param $value XField
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		return self::EncodeAsSqlIdentifier($value->GetDBName(),$platform);
	}

	/**
	 * @param $value XField
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return self::EncodeAsJsStringLiteral($value->GetName());
	}

	/**
	 * @param $value XField
	 * @return string
	 */
	public static function ExportXmlString($value) {
		return self::EncodeAsXmlString($value->GetName());
	}

	/**
	 * @param $value XField
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return self::EncodeAsHtmlString($value->GetName());
	}

	/**
	 * @param $value XField
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		return self::EncodeAsHtmlString($value->GetLabel());
	}

	/**
	 * @param $value XField
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return self::EncodeAsUrlString($value->GetLabel());
	}

	/**
	 * @param $value string|null
	 * @return XField
	 */
	public static function ImportDBValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return XField
	 */
	public static function ImportDomValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null|array
	 * @return XField
	 */
	public static function ImportHttpValue($value) {
		throw new ConvertionException();
	}
}

JustField::Init();
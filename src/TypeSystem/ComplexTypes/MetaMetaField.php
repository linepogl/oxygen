<?php

class MetaMetaField extends XType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaMetaField */ public static function Type() { return self::$instance; }
	/** @return XMetaField */ public static function GetDefaultValue() { throw new ConvertionException(); }




	
	/**
	 * @param $address XMetaField
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value instanceof XMetaField) $address = $value;
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
	 * @param $value XMetaField
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return PDO::PARAM_STR;
	}

	/**
	 * @param $value XMetaField
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return self::EncodeAsSqlStringLiteral($value->GetName(),$platform);
	}

	/**
	 * @param $value XMetaField
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		if ($value->IsDBAliasComplex())
			return $value->GetDBName();
		else
			return self::EncodeAsSqlIdentifier($value->GetDBName(),$platform);
	}

	/**
	 * @param $value XMetaField
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return self::EncodeAsJsStringLiteral($value->GetName());
	}

	/**
	 * @param $value XMetaField
	 * @return string
	 */
	public static function ExportXmlString($value) {
		return self::EncodeAsXmlString($value->GetName());
	}

	/**
	 * @param $value XMetaField
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return self::EncodeAsHtmlString($value->GetName());
	}

	/**
	 * @param $value XMetaField
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		return self::EncodeAsHtmlString($value->GetLabel());
	}

	/**
	 * @param $value XMetaField
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return self::EncodeAsUrlString($value->GetLabel());
	}

	/**
	 * @param $value string|null
	 * @return XMetaField
	 */
	public static function ImportDBValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return XMetaField
	 */
	public static function ImportDomValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null|array
	 * @return XMetaField
	 */
	public static function ImportHttpValue($value) {
		throw new ConvertionException();
	}
}

MetaMetaField::Init();
<?php

class MetaWrapField extends XConcreteType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaWrapField */ public static function Type() { return self::$instance; }
	/** @return MetaWrapField */ public static function GetNullableType() { throw new ConvertionException(); }
	/** @return XWrapField */ public static function GetDefaultValue() { throw new ConvertionException(); }




	
	/**
	 * @param $address XWrapField
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value instanceof XWrapField) $address = $value;
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
	 * @param $value XWrapField
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return PDO::PARAM_STR;
	}

	/**
	 * @param $value XWrapField
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return self::EncodeAsSqlStringLiteral($value->GetName(),$platform);
	}

	/**
	 * @param $value XWrapField
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		return self::EncodeAsSqlIdentifier($value->GetField()->GetDBName(),$platform);
	}

	/**
	 * @param $value XWrapField
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return self::EncodeAsJsStringLiteral($value->GetName());
	}

	/**
	 * @param $value XWrapField
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		return self::EncodeAsXmlString($value->GetName(),$attr);
	}

	/**
	 * @param $value XWrapField
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return self::EncodeAsHtmlString($value->GetLabel());
	}

	/**
	 * @param $value XWrapField
	 * @return string
	 */
	public static function ExportTextString($value) {
		return strval($value->GetLabel());
	}

	/**
	 * @param $value XWrapField
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return self::EncodeAsUrlString($value->GetName());
	}

	/**
	 * @param $value XWrapField
	 * @return string
	 */
	public static function ExportValString($value) {
		return $value->GetName();
	}

	/**
	 * @param $value string|null
	 * @return XWrapField
	 */
	public static function ImportDBValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return XWrapField
	 */
	public static function ImportDomValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null|array
	 * @return XWrapField
	 */
	public static function ImportHttpValue($value) {
		throw new ConvertionException();
	}
}

MetaWrapField::Init();
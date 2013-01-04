<?php

class MetaXml extends XConcreteType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaXml */ public static function Type() { return self::$instance; }
	/** @return MetaXml */ public static function GetNullableType() { throw new ConvertionException(); }
	/** @return Xml */ public static function GetDefaultValue() { throw new ConvertionException(); }





	/**
	 * @param $address Xml
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		$address = $value;
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
	 * @param $value Xml
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value Xml
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return self::EncodeAsSqlStringLiteral($value->Export(),$platform);
	}

	/**
	 * @param $value Xml
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		return self::EncodeAsSqlIdentifier($value->Export(),$platform);
	}

	/**
	 * @param $value Xml
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return self::EncodeAsJsStringLiteral($value->Export());
	}

	/**
	 * @param $value Xml
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		return $value->GetInnerType()->ExportXmlString($value->GetInnerValue(),$attr);
	}

	/**
	 * @param $value Xml
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return self::EncodeAsHtmlString($value->Export());
	}

	/**
	 * @param $value Xml
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return self::EncodeAsUrlString($value->Export());
	}

	/**
	 * @param $value string|null
	 * @return Xml
	 */
	public static function ImportDBValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return Xml
	 */
	public static function ImportDomValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null|array
	 * @return Xml
	 */
	public static function ImportHttpValue($value) {
		throw new ConvertionException();
	}
}

MetaXml::Init();
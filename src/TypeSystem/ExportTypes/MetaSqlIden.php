<?php

class MetaSqlIden extends XConcreteType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaSqlIden */ public static function Type() { return self::$instance; }
	/** @return MetaSqlIden */ public static function GetNullableType() { throw new ConvertionException(); }
	/** @return SqlIden */ public static function GetDefaultValue() { throw new ConvertionException(); }





	/**
	 * @param $address SqlIden
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
	 * @param $value SqlIden
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value SqlIden
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return self::EncodeAsSqlStringLiteral($value->Export(),$platform);
	}

	/**
	 * @param $value SqlIden
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		return $value->GetInnerType()->EncodeAsSqlIdentifier($value->GetInnerValue(),$platform);
	}

	/**
	 * @param $value SqlIden
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return self::EncodeAsJsStringLiteral($value->Export());
	}

	/**
	 * @param $value SqlIden
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		return self::EncodeAsXmlString($value->Export(),$attr);
	}

	/**
	 * @param $value SqlIden
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return self::EncodeAsHtmlString($value->Export());
	}

	/**
	 * @param $value SqlIden
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return self::EncodeAsUrlString($value->Export());
	}

	/**
	 * @param $value string|null
	 * @return SqlIden
	 */
	public static function ImportDBValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return SqlIden
	 */
	public static function ImportDomValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null|array
	 * @return SqlIden
	 */
	public static function ImportHttpValue($value) {
		throw new ConvertionException();
	}
}

MetaSqlIden::Init();
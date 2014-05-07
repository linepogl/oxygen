<?php

class MetaSql extends XConcreteType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaSql */ public static function Type() { return self::$instance; }
	/** @return MetaSql */ public static function GetNullableType() { throw new ConvertionException(); }
	/** @return Sql */ public static function GetDefaultValue() { throw new ConvertionException(); }





	/**
	 * @param $address Sql
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
	 * @param $value Sql
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value Sql
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return $value->GetInnerType()->ExportSqlLiteral($value->GetInnerValue(),$platform);
	}

	/**
	 * @param $value Sql
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		return self::EncodeAsSqlIdentifier($value->Export(),$platform);
	}

	/**
	 * @param $value Sql
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return self::EncodeAsJsStringLiteral($value->Export());
	}

	/**
	 * @param $value Sql
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		return self::EncodeAsXmlString($value->Export(),$attr);
	}

	/**
	 * @param $value Sql
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return self::EncodeAsHtmlString($value->Export());
	}

	/**
	 * @param $value Sql
	 * @return string
	 */
	public static function ExportTextString($value) {
		return strval($value->Export());
	}

	/**
	 * @param $value Sql
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return self::EncodeAsUrlString($value->Export());
	}

	/**
	 * @param $value Sql
	 * @return string
	 */
	public static function ExportValString($value) {
		return $value->Export();
	}

	/**
	 * @param $value string|null
	 * @return Sql
	 */
	public static function ImportDBValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return Sql
	 */
	public static function ImportDomValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null|array
	 * @return Sql
	 */
	public static function ImportHttpValue($value) {
		throw new ConvertionException();
	}
}

MetaSql::Init();
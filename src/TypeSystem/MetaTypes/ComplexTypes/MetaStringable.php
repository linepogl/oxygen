<?php

class MetaStringable extends XConcreteType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaStringable */ public static function Type() { return self::$instance; }
	/** @return MetaStringable */ public static function GetNullableType() { throw new ConvertionException(); }
	/** @return mixed */ public static function GetDefaultValue() { throw new ConvertionException(); }




	
	/**
	 * @param $address mixed
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
	 * @param $value mixed
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value mixed
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return MetaString::ExportSqlLiteral(strval($value),$platform);
	}

	/**
	 * @param $value mixed
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		return MetaString::ExportSqlIdentifier(strval($value),$platform);
	}

	/**
	 * @param $value mixed
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return MetaString::ExportJsLiteral(strval($value));
	}

	/**
	 * @param $value mixed
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		return MetaString::ExportXmlString(strval($value),$attr);
	}

	/**
	 * @param $value mixed
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return MetaString::ExportHtmlString(strval($value));
	}

	/**
	 * @param $value mixed
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return MetaString::ExportUrlString(strval($value));
	}

	/**
	 * @param $value mixed
	 * @return string
	 */
	public static function ExportValString($value) {
		return MetaString::ExportValString(strval($value));
	}

	/**
	 * @param $value string|null
	 * @return Traversable
	 */
	public static function ImportDBValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return Traversable
	 */
	public static function ImportDomValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null|array
	 * @return Traversable
	 */
	public static function ImportHttpValue($value) {
		throw new ConvertionException();
	}
}

MetaStringable::Init();
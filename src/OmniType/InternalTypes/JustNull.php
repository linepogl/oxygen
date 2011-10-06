<?php

class JustNull extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return JustNull */ public static function Type(){ return self::$instance; }
	/** @return null */ public static function GetDefaultValue() { return null; }





	/**
	 * @param $address null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if (!is_null($value)) throw new ValidationException();
		$address = $value;
	}

	/**
	 * @return int
	 */
	public static function GetPdoType() {
		return PDO::PARAM_NULL;
	}

	/**
	 * @return string
	 */
	public static function GetXsdType() {
		return 'xs:string';
	}


	/**
	 * @param $value null
	 * @param $platform int|null
	 * @return null
	 */
	public static function ExportPdoValue($value, $platform) {
		return null;
	}

	/**
	 * @param $value null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return 'NULL';
	}

	/**
	 * @param $value null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value null
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return 'null';
	}

	/**
	 * @param $value null
	 * @return string
	 */
	public static function ExportXmlString($value) {
		return '';
	}

	/**
	 * @param $value null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return '';
	}

	/**
	 * @param $value null
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		return '';
	}

	/**
	 * @param $value null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return '';
	}

	/**
	 * @param $value string|null
	 * @return null
	 */
	public static function ImportDBValue($value) {
		return null;
	}

	/**
	 * @param $value string|null
	 * @return null
	 */
	public static function ImportDomValue($value) {
		return null;
	}

	/**
	 * @param $value string|null|array
	 * @return null
	 */
	public static function ImportHttpValue($value) {
		return null;
	}
}

JustNull::Init();
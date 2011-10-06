<?php

class JustBoolean extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return JustBoolean */ public static function Type(){ return self::$instance; }
	/** @return boolean */ public static function GetDefaultValue() { return false; }





	/**
	 * @param $address boolean
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if (is_bool($value)) $address = $value;
		throw new ValidationException();
	}

	/**
	 * @return int
	 */
	public static function GetPdoType() {
		return PDO::PARAM_BOOL;
	}

	/**
	 * @return string
	 */
	public static function GetXsdType(){
		return 'xs:boolean';
	}

	/**
	 * @param $value boolean
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		if ($value) return 1;
		return 0;
	}

	/**
	 * @param $value boolean
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		if ($value) return '1';
		return '0';
	}

	/**
	 * @param $value boolean
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value boolean
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value boolean
	 * @return string
	 */
	public static function ExportXmlString($value) {
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value boolean
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value boolean
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		if ($value) return (string)Lemma::Retrieve('Yes');
		return (string)Lemma::Retrieve('No');
	}

	/**
	 * @param $value boolean
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value string|null
	 * @return boolean
	 */
	public static function ImportDBValue($value) {
		return $value === '1'; // TODO: this needs testing
	}

	/**
	 * @param $value string|null
	 * @return boolean
	 */
	public static function ImportDomValue($value) {
		return $value === 'true';
	}

	/**
	 * @param $value string|null|array
	 * @return boolean
	 */
	public static function ImportHttpValue($value) {
		if (is_array($value)) throw new ConvertionException();
		return $value === 'true';
	}
}

JustBoolean::Init();




<?php

class OmniIntegerOrNull extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }

	/**
	 * @return OmniIntegerOrNull
	 */
	public static function Type(){
		return self::$instance;
	}

	/**
	 * @return int|null
	 */
	public static function GetDefaultValue() {
		return null;
	}

	/**
	 * @param $address int|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if (!is_null($value) && !is_int($value)) throw new ValidationException();
		$address = $value;
	}

	/**
	 * @return int
	 */
	public static function GetPdoType() {
		return PDO::PARAM_INT;
	}

	/**
	 * @return string
	 */
	public static function GetXsdType(){
		return 'xs:integer';
	}

	/**
	 * @param $value int|null
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return $value;
	}

	/**
	 * @param $value int|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		if (is_null($value)) return Sql::Null;
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		if (is_null($value)) return Js::Null;
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public static function ExportXmlString($value) {
		if (is_null($value)) return '';
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if (is_null($value)) return '';
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		if (is_null($value)) return '';
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if (is_null($value)) return '';
		return sprintf('%d',$value);
	}

	/**
	 * @param $value string|null
	 * @return int|null
	 */
	public static function ImportDBValue($value) {
		if (is_null($value)) return null;
		return intval($value);
	}

	/**
	 * @param $value string|null
	 * @return int|null
	 */
	public static function ImportDomValue($value) {
		if (is_null($value)) return null;
		if ($value === '') return null;
		return intval($value);
	}

	/**
	 * @param $value string|null|array
	 * @return int|null
	 */
	public static function ImportHttpValue($value) {
		if (is_null($value)) return null;
		if (is_array($value)) throw new ConvertionException();
        if (!is_numeric($value)) return null;
		return intval($value);
	}
}

OmniIntegerOrNull::Init();

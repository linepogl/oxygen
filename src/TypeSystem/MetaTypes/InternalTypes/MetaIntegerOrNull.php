<?php

class MetaIntegerOrNull extends XNullableType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }

	/**
	 * @return MetaIntegerOrNull
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
		if ($value!==null && !is_int($value)) throw new ValidationException();
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
		if ($value===null) return Sql::Null;
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
		if ($value===null) return Js::Null;
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		if ($value===null) return '';
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if ($value===null) return '';
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public static function ExportTextString($value) {
		if ($value===null) return '';
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if ($value===null) return '';
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public static function ExportValString($value) {
		if ($value===null) return '';
		return sprintf('%d',$value);
	}

	/**
	 * @param $value string|null
	 * @return int|null
	 */
	public static function ImportDBValue($value) {
		if ($value===null) return null;
		return intval($value);
	}

	/**
	 * @param $value string|null
	 * @return int|null
	 */
	public static function ImportDomValue($value) {
		if ($value===null) return null;
		if ($value === '') return null;
		return intval($value);
	}

	/**
	 * @param $value string|null|array
	 * @return int|null
	 */
	public static function ImportHttpValue($value) {
		if ($value===null) return null;
		if (is_array($value)) throw new ConvertionException();
        if (!is_numeric($value)) return null;
		return intval($value);
	}
}

MetaIntegerOrNull::Init();

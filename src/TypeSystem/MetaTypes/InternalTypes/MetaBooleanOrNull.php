<?php

class MetaBooleanOrNull extends XNullableType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }

	/**
	 * @return MetaBooleanOrNull
	 */
	public static function Type(){
		return self::$instance;
	}

	/**
	 * @return boolean|null
	 */
	public static function GetDefaultValue() {
		return null;
	}

	/**
	 * @param $address boolean|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value!==null && !is_bool($value)) throw new ValidationException();
		$address = $value;
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
	 * @param $value boolean|null
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return $value;
	}

	/**
	 * @param $value boolean|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		if ($value===null) return Sql::Null;
		if ($value) return '1';
		return '0';
	}

	/**
	 * @param $value boolean|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value boolean|null
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		if ($value===null) return Js::Null;
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value boolean|null
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		if ($value===null) return '';
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value boolean|null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if ($value===null) return '';
		if ($value) return (string)Lemma::Pick('Yes');
		return (string)Lemma::Pick('No');
	}

	/**
	 * @param $value boolean|null
	 * @return string
	 */
	public static function ExportTextString($value) {
		if ($value===null) return '';
		if ($value) return (string)Lemma::Pick('Yes');
		return (string)Lemma::Pick('No');
	}

	/**
	 * @param $value boolean|null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if ($value===null) return '';
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value boolean|null
	 * @return string
	 */
	public static function ExportValString($value) {
		if ($value===null) return '';
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value string|null
	 * @return boolean|null
	 */
	public static function ImportDBValue($value) {
		if ($value===null) return null;
		if ($value === '1') return true; /// TODO: this needs testing
		return false;
	}

	/**
	 * @param $value string|null
	 * @return boolean|null
	 */
	public static function ImportDomValue($value) {
		if ($value===null) return null;
		if ($value === 'true') return true;
		if ($value === 'false') return false;
		return null;
	}

	/**
	 * @param $value string|null|array
	 * @return boolean|null
	 */
	public static function ImportHttpValue($value) {
		if ($value===null) return null;
		if (is_array($value)) throw new ConvertionException();
		if ($value === 'true') return true;
		if ($value === 'false') return false;
		return null;
	}
}

MetaBooleanOrNull::Init();
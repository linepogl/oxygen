<?php


//
// TODO: The conversions for decimal are not entirely clear. First of all PHP does not support decimals but floats. Then decimals are locale-sensitive so the round-trip PHP->(URL|(HTML<->JS))->HTTP->PHP needs work...
//


class JustDecimal extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return JustDecimal */ public static function Type(){ return self::$instance; }
	/** @return float */ public static function GetDefaultValue() { return 0.0; }




	/**
	 * @param $address float
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if (is_float($value)) $address = $value;
		if (is_int($value)) $address = $value; // implicit casting!!!
		throw new ValidationException();
	}

	/**
	 * @return int
	 */
	public static function GetPdoType() {
		return PDO::PARAM_STR;
	}

	/**
	 * @return string
	 */
	public static function GetXsdType() {
		return 'xs:decimal';
	}

	/**
	 * @param $value float
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return $value;
	}

	/**
	 * @param $value float
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return sprintf('%F',$value);
	}

	/**
	 * @param $value float
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return sprintf('%F',$value);
	}

	/** @return string */
	public static function GetJsFunctionImportHtmlValue(){
		echo "function(value){ return decimal.parse(value); }";
	}

	/** @return string */
	public static function GetJsFunctionExportHtmlString(){
		echo "function(value){ return decimal.parse(value); }";
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public static function ExportXmlString($value) {
		return sprintf('%F',$value);
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return sprintf('%F',$value);
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		return Language::FormatDecimal($value);
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return sprintf('%F',$value);
	}

	/**
	 * @param $value string|null
	 * @return float
	 */
	public static function ImportDBValue($value) {
		return floatval($value);
	}

	/**
	 * @param $value string|null
	 * @return float
	 */
	public static function ImportDomValue($value) {
		return floatval($value);
	}

	/**
	 * @param $value string|null|array
	 * @return float
	 */
	public static function ImportHttpValue($value) {
		if (is_array($value)) throw new ConvertionException();
		return floatval($value);
	}

}

JustDecimal::Init();
<?php

class MetaDecimal extends XConcreteType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaDecimal */ public static function Type(){ return self::$instance; }
	/** @return MetaDecimalOrNull */ public static function GetNullableType() { return MetaDecimalOrNull::Type(); }
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
		return Language::FormatDecimalInvariant($value);
	}

	/**
	 * @param $value float
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return Language::FormatDecimalInvariant($value);
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
		return Language::FormatDecimalInvariant($value);
	}

	/** @return string */
	public static function GetJsFunctionImportHtmlValue(){
		echo "function(value){ return decimal.parse(value); }";  // TODO: use language-specific conversion
	}

	/** @return string */
	public static function GetJsFunctionExportHtmlString(){
		echo "function(value){ return decimal.parse(value); }";  // TODO: use language-specific conversion
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		return Language::FormatDecimalInvariant($value);
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return Language::FormatDecimal($value);
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public static function ExportTextString($value) {
		return Language::FormatDecimal($value);
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return self::EncodeAsUrlString(Language::FormatDecimal($value));
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public static function ExportValString($value) {
		return Language::FormatDecimal($value);
	}

	/**
	 * @param $value string|null
	 * @return float
	 */
	public static function ImportDBValue($value) {
		return Language::ParseDecimalInvariant($value,0.0);
	}

	/**
	 * @param $value string|null
	 * @return float
	 */
	public static function ImportDomValue($value) {
		return Language::ParseDecimalInvariant($value,0.0);
	}

	/**
	 * @param $value string|null|array
	 * @return float
	 */
	public static function ImportHttpValue($value) {
		if (is_array($value)) throw new ConvertionException();
		return Language::ParseDecimal($value,0.0);
	}

}

MetaDecimal::Init();
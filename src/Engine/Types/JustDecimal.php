<?php


//
// TODO: The conversions for decimal are not entirely clear. First of all PHP does not support decimals but floats. Then decimals are locale-sensitive so the round-trip PHP->(URL|(HTML<->JS))->HTTP->PHP needs work...
//


class JustDecimal extends OmniType {

	/**
	 * @return float
	 */
	public function GetDefaultValue() {
		return 0.0;
	}

	/**
	 * @param $address float
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public function Assign(&$address,$value) {
		if (is_float($value)) $address = $value;
		if (is_int($value)) $address = $value; // implicit casting!!!
		throw new ValidationException();
	}

	/**
	 * @return int
	 */
	public function GetPdoType() {
		return PDO::PARAM_STR;
	}

	/**
	 * @param $value float
	 * @param $platform int
	 * @return mixed
	 */
	public function ExportPdoValue($value, $platform) {
		return $value;
	}

	/**
	 * @param $value float
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlLiteral($value, $platform) {
		return sprintf('%F',$value);
	}

	/**
	 * @param $value float
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public function ExportJsLiteral($value) {
		return sprintf('%F',$value);
	}

	/** @return string */
	public function GetJsFunctionImportHtmlValue(){
		echo "function(value){ return decimal.parse(value); }";
	}

	/** @return string */
	public function GetJsFunctionExportHtmlString(){
		echo "function(value){ return decimal.parse(value); }";
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public function ExportXmlString($value) {
		return sprintf('%F',$value);
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public function ExportHtmlString($value) {
		return sprintf('%F',$value);
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public function ExportHumanReadableHtmlString($value) {
		return Language::FormatDecimal($value);
	}

	/**
	 * @param $value float
	 * @return string
	 */
	public function ExportUrlString($value) {
		return sprintf('%F',$value);
	}

	/**
	 * @param $value string|null
	 * @return float
	 */
	public function ImportDBValue($value) {
		if (is_null($value)) return 0.0;
		return floatval($value);
	}

	/**
	 * @param $value string|null
	 * @return float
	 */
	public function ImportDOMValue($value) {
		if (is_null($value)) return 0.0;
		return floatval($value);
	}

	/**
	 * @param $value string|null|array
	 * @return float
	 */
	public function ImportHttpValue($value) {
		if (is_null($value)) return 0.0;
		if (is_array($value)) throw new ConvertionException();
		return floatval($value);
	}

}
<?php

class NullableDecimal extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }

	/**
	 * @return NullableDecimal
	 */
	public static function Type(){
		return self::$instance;
	}

	/**
	 * @return float|null
	 */
	public function GetDefaultValue() {
		return null;
	}

	/**
	 * @param $address float|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public function Assign(&$address,$value) {
		if (is_null($value)) $address = $value;
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
	 * @return string
	 */
	public function GetXsdType() {
		return 'xs:decimal';
	}

	/**
	 * @param $value float|null
	 * @param $platform int
	 * @return mixed
	 */
	public function ExportPdoValue($value, $platform) {
		return $value;
	}

	/**
	 * @param $value float|null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlLiteral($value, $platform) {
		if (is_null($value)) return Sql::Null;
		return sprintf('%F',$value);
	}

	/**
	 * @param $value float|null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value float|null
	 * @return string
	 */
	public function ExportJsLiteral($value) {
		if (is_null($value)) return Js::Null;
		return sprintf('%F',$value);
	}

	/**
	 * @param $value float|null
	 * @return string
	 */
	public function ExportXmlString($value) {
		if (is_null($value)) return '';
		return sprintf('%F',$value);
	}

	/**
	 * @param $value float|null
	 * @return string
	 */
	public function ExportHtmlString($value) {
		if (is_null($value)) return '';
		return sprintf('%F',$value);
	}

	/**
	 * @param $value float|null
	 * @return string
	 */
	public function ExportHumanReadableHtmlString($value) {
		if (is_null($value)) return '';
		return Language::FormatDecimal($value);
	}

	/**
	 * @param $value float|null
	 * @return string
	 */
	public function ExportUrlString($value) {
		if (is_null($value)) return '';
		return sprintf('%F',$value);
	}

	/**
	 * @param $value string|null
	 * @return float|null
	 */
	public function ImportDBValue($value) {
		if (is_null($value)) return null;
		return floatval($value);
	}

	/**
	 * @param $value string|null
	 * @return float|null
	 */
	public function ImportDOMValue($value) {
		if (is_null($value)) return null;
		if ($value === '') return null;
		return floatval($value);
	}

	/**
	 * @param $value string|null|array
	 * @return float|null
	 */
	public function ImportHttpValue($value) {
		if (is_null($value)) return null;
		if ($value === '') return null;
		if (is_array($value)) throw new ConvertionException();
		return floatval($value);
	}
}

NullableDecimal::Init();

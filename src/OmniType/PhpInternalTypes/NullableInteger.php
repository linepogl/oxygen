<?php

class NullableInteger extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }

	/**
	 * @return NullableInteger
	 */
	public static function Type(){
		return self::$instance;
	}

	/**
	 * @return int|null
	 */
	public function GetDefaultValue() {
		return null;
	}

	/**
	 * @param $address int|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public function Assign(&$address,$value) {
		if (!is_null($value) && !is_int($value)) throw new ValidationException();
		$address = $value;
	}

	/**
	 * @return int
	 */
	public function GetPdoType() {
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
	 * @param $platform int
	 * @return mixed
	 */
	public function ExportPdoValue($value, $platform) {
		return $value;
	}

	/**
	 * @param $value int|null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlLiteral($value, $platform) {
		if (is_null($value)) return Sql::Null;
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public function ExportJsLiteral($value) {
		if (is_null($value)) return Js::Null;
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public function ExportXmlString($value) {
		if (is_null($value)) return '';
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public function ExportHtmlString($value) {
		if (is_null($value)) return '';
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public function ExportHumanReadableHtmlString($value) {
		if (is_null($value)) return '';
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int|null
	 * @return string
	 */
	public function ExportUrlString($value) {
		if (is_null($value)) return '';
		return sprintf('%d',$value);
	}

	/**
	 * @param $value string|null
	 * @return int|null
	 */
	public function ImportDBValue($value) {
		if (is_null($value)) return null;
		return intval($value);
	}

	/**
	 * @param $value string|null
	 * @return int|null
	 */
	public function ImportDOMValue($value) {
		if (is_null($value)) return null;
		if ($value === '') return null;
		return intval($value);
	}

	/**
	 * @param $value string|null|array
	 * @return int|null
	 */
	public function ImportHttpValue($value) {
		if (is_null($value)) return null;
		if (is_array($value)) throw new ConvertionException();
		return intval($value);
	}
}

NullableInteger::Init();

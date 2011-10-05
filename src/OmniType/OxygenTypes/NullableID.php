<?php

class NullableID extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }

	/**
	 * @return OmniType
	 */
	public static function Type() {
		return self::$instance;
	}

	/**
	 * @return ID|null
	 */
	public function GetDefaultValue() {
		return null;
	}

	/**
	 * @param $address ID|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public function Assign(&$address,$value) {
		if (is_null($value)) $address = $value;
		if ($value instanceof ID) $address = $value;
		throw new ValidationException();
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
	public static function GetXsdType() {
		return 'xs:string';
	}

	/**
	 * @param $value ID|null
	 * @param $platform int
	 * @return mixed
	 */
	public function ExportPdoValue($value, $platform) {
		if (is_null($value)) return null;
		return $value->AsInt();
	}

	/**
	 * @param $value ID|null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlLiteral($value, $platform) {
		if (is_null($value)) return Sql::Null;
		return strval($value->AsInt());
	}

	/**
	 * @param $value ID|null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value ID|null
	 * @return string
	 */
	public function ExportJsLiteral($value) {
		if (is_null($value)) return Js::Null;
		return '\''.$value->AsHex().'\'';
	}

	/**
	 * @param $value ID|null
	 * @return string
	 */
	public function ExportXmlString($value) {
		if (is_null($value)) return '';
		return $value->AsHex();
	}

	/**
	 * @param $value ID|null
	 * @return string
	 */
	public function ExportHtmlString($value) {
		if (is_null($value)) return '';
		return $value->AsHex();
	}

	/**
	 * @param $value ID|null
	 * @return string
	 */
	public function ExportHumanReadableHtmlString($value) {
		if (is_null($value)) return '';
		return $value->AsHex();
	}

	/**
	 * @param $value ID|null
	 * @return string
	 */
	public function ExportUrlString($value) {
		if (is_null($value)) return '';
		return $value->AsHex();
	}

	/**
	 * @param $value string|null
	 * @return ID|null
	 */
	public function ImportDBValue($value) {
		if (is_null($value)) return null;
		return new ID(intval($value));
	}

	/**
	 * @param $value string|null
	 * @return ID|null
	 */
	public function ImportDOMValue($value) {
		if (is_null($value)) return null;
		if ($value === '') return null;
		return new ID($value);
	}

	/**
	 * @param $value string|null|array
	 * @return ID|null
	 */
	public function ImportHttpValue($value) {
		if (is_null($value)) return null;
		if (is_array($value)) throw new ConvertionException();
		return new ID($value);
	}
}

NullableID::Init();
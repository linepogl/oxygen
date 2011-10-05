<?php

class JustID extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }

	/**
	 * @return OmniType
	 */
	public static function Type() {
		return self::$instance;
	}

	/**
	 * @return ID
	 */
	public static function GetDefaultValue() {
		return new ID(0);
	}

	/**
	 * @param $address ID
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value instanceof ID) { $address = $value; return; }
		throw new ValidationException();
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
	public static function GetXsdType() {
		return 'xs:string';
	}

	/**
	 * @param $value ID
	 * @param $platform int
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return $value->AsInt();
	}

	/**
	 * @param $value ID
	 * @param $platform int
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return strval($value->AsInt());
	}

	/**
	 * @param $value ID
	 * @param $platform int
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value ID
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return '\''.$value->AsHex().'\'';
	}

	/**
	 * @param $value ID
	 * @return string
	 */
	public static function ExportXmlString($value) {
		return $value->AsHex();
	}

	/**
	 * @param $value ID
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return $value->AsHex();
	}

	/**
	 * @param $value ID
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		return $value->AsHex();
	}

	/**
	 * @param $value ID
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return $value->AsHex();
	}

	/**
	 * @param $value string|null
	 * @return ID
	 */
	public static function ImportDBValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		return new ID(intval($value));
	}

	/**
	 * @param $value string|null
	 * @return ID
	 */
	public static function ImportDomValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		if ($value === '') return self::GetDefaultValue();
		return new ID($value);
	}

	/**
	 * @param $value string|null|array
	 * @return ID
	 */
	public static function ImportHttpValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		if ($value === '') return self::GetDefaultValue();
		if (is_array($value)) throw new ConvertionException();
		return new ID($value);
	}
}


JustID::Init();
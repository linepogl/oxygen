<?php

class MetaID extends XType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaID */ public static function Type() { return self::$instance; }
	/** @return ID|null */ public static function GetDefaultValue() { return null; }




	
	/**
	 * @param $address ID|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if (is_null($value)) $address = $value;
		if ($value instanceof ID) $address = $value;
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
	 * @param $value ID|null
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		if (is_null($value)) return null;
		return $value->AsInt();
	}

	/**
	 * @param $value ID|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		if (is_null($value)) return Sql::Null;
		return strval($value->AsInt());
	}

	/**
	 * @param $value ID|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value ID|null
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		if (is_null($value)) return Js::Null;
		return '\''.$value->AsHex().'\'';
	}

	/**
	 * @param $value ID|null
	 * @return string
	 */
	public static function ExportXmlString($value) {
		if (is_null($value)) return '';
		return $value->AsHex();
	}

	/**
	 * @param $value ID|null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if (is_null($value)) return '';
		return $value->AsHex();
	}

	/**
	 * @param $value ID|null
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		if (is_null($value)) return '';
		return $value->AsHex();
	}

	/**
	 * @param $value ID|null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if (is_null($value)) return '';
		return $value->AsHex();
	}

	/**
	 * @param $value string|null
	 * @return ID|null
	 */
	public static function ImportDBValue($value) {
		if (is_null($value)) return null;
		return new ID(intval($value));
	}

	/**
	 * @param $value string|null
	 * @return ID|null
	 */
	public static function ImportDomValue($value) {
		if (is_null($value)) return null;
		if ($value === '') return null;
		return new ID($value);
	}

	/**
	 * @param $value string|null|array
	 * @return ID|null
	 */
	public static function ImportHttpValue($value) {
		if (is_null($value)) return null;
		if ($value === '') return null;
		if (is_array($value)) throw new ConvertionException();
		return new ID($value);
	}
}

MetaID::Init();
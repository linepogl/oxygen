<?php

class MetaItem extends XType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaItem */ public static function Type() { return self::$instance; }
	/** @return XItem */ public static function GetDefaultValue() { throw new ConvertionException(); }




	
	/**
	 * @param $address XItem
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value instanceof XItem) $address = $value;
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
	 * @param $value XItem
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return $value->id->AsInt();
	}

	/**
	 * @param $value XItem
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return strval($value->id->AsInt());
	}

	/**
	 * @param $value XItem
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value XItem
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return '\''.$value->id->AsHex().'\'';
	}

	/**
	 * @param $value XItem
	 * @return string
	 */
	public static function ExportXmlString($value) {
		return $value->id->AsHex();
	}

	/**
	 * @param $value XItem
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return $value->id->AsHex();
	}

	/**
	 * @param $value XItem
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		return $value->id->AsHex();
	}

	/**
	 * @param $value XItem
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return $value->id->AsHex();
	}

	/**
	 * @param $value string|null
	 * @return XItem
	 */
	public static function ImportDBValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return XItem
	 */
	public static function ImportDomValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null|array
	 * @return XItem
	 */
	public static function ImportHttpValue($value) {
		throw new ConvertionException();
	}
}

MetaItem::Init();
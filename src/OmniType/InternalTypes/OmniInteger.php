<?php

class OmniInteger extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return OmniInteger */ public static function Type(){ return self::$instance; }
	/** @return int */ public static function GetDefaultValue() { return 0; }




	
	/**
	 * @param $address int
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if (!is_int($value)) throw new ValidationException();
		$address = $value;
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
	public static function GetXsdType(){
		return 'xs:integer';
	}


	/**
	 * @param $value int
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return $value;
	}

	/**
	 * @param $value int
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value int
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int
	 * @return string
	 */
	public static function ExportXmlString($value) {
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return sprintf('%d',$value);
	}

	/**
	 * @param $value string|null
	 * @return int
	 */
	public static function ImportDBValue($value) {
		return intval($value);
	}

	/**
	 * @param $value string|null
	 * @return int
	 */
	public static function ImportDomValue($value) {
		return intval($value);
	}

	/**
	 * @param $value string|null|array
	 * @return int
	 */
	public static function ImportHttpValue($value) {
		if (is_array($value)) throw new ConvertionException();
		return intval($value);
	}
}

OmniInteger::Init();
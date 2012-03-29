<?php

class MetaArray extends XConcreteType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaArray */ public static function Type() { return self::$instance; }
	/** @return MetaArray */ public static function GetNullableType() { throw new ConvertionException(); }
	/** @return array */ public static function GetDefaultValue() { return array(); }




	
	/**
	 * @param $address array
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if (is_array($value)) $address = $value;
		throw new ValidationException();
	}

	/**
	 * @return int
	 */
	public static function GetPdoType() {
		throw new ConvertionException();
	}

	/**
	 * @return string
	 */
	public static function GetXsdType() {
		return 'xs:string';
	}

	/**
	 * @param $value array
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value array
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		if (count($value) == 0)
			return '(-11111111)';
		return '('.implode(',',array_map(function($x)use($platform){ return XType::Of($x)->ExportSqlLiteral($x,$platform); },$value)).')';
	}

	/**
	 * @param $value array
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value array
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return '['.implode(',',array_map(function($x){ return XType::Of($x)->ExportJsLiteral($x); },$value)).']';
	}

	/**
	 * @param $value array
	 * @return string
	 */
	public static function ExportXmlString($value) {
		return implode(',',array_map(function($x){ return XType::Of($x)->ExportXmlString($x); },$value));
	}

	/**
	 * @param $value array
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return implode(',',array_map(function($x){ return XType::Of($x)->ExportHtmlString($x); },$value));
	}

	/**
	 * @param $value array
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value array
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return implode(',',array_map(function($x){ return XType::Of($x)->ExportUrlString($x); },$value));
	}

	/**
	 * @param $value string|null
	 * @return array
	 */
	public static function ImportDBValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return array
	 */
	public static function ImportDomValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null|array
	 * @return array
	 */
	public static function ImportHttpValue($value) {
		throw new ConvertionException();
	}
}

MetaArray::Init();
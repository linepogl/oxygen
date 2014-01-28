<?php

class MetaTraversable extends XConcreteType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaTraversable */ public static function Type() { return self::$instance; }
	/** @return MetaTraversable */ public static function GetNullableType() { throw new ConvertionException(); }
	/** @return Traversable */ public static function GetDefaultValue() { throw new ConvertionException(); }




	
	/**
	 * @param $address Traversable
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value instanceof Traversable) $address = $value;
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
	 * @param $value Traversable
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value Traversable
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		$a = array();
		foreach ($value as $x)
			$a[] = XType::Of($x)->ExportSqlLiteral($x,$platform);
		return empty($a) ? '(-11111111)' : '('.implode(',',$a).')';
	}

	/**
	 * @param $value Traversable
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value Traversable
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		$a = array();
		foreach ($value as $x)
			$a[] = XType::Of($x)->ExportJsLiteral($x);
		return '['.implode(',',$a).']';
	}

	/**
	 * @param $value Traversable
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		$a = array();
		foreach ($value as $x)
			$a[] = XType::Of($x)->ExportXmlString($x,$attr);
		return implode(',',$a);
	}

	/**
	 * @param $value Traversable
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		$a = array();
		foreach ($value as $x)
			$a[] = XType::Of($x)->ExportHtmlString($x);
		return implode(',',$a);
	}

	/**
	 * @param $value Traversable
	 * @return string
	 */
	public static function ExportUrlString($value) {
		$a = array();
		foreach ($value as $x)
			$a[] = XType::Of($x)->ExportUrlString($x);
		return implode(',',$a);
	}

	/**
	 * @param $value Traversable
	 * @return string
	 */
	public static function ExportValString($value) {
		$a = array();
		foreach ($value as $x)
			$a[] = XType::Of($x)->ExportValString($x);
		return implode(',',$a);
	}

	/**
	 * @param $value string|null
	 * @return Traversable
	 */
	public static function ImportDBValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return Traversable
	 */
	public static function ImportDomValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null|array
	 * @return Traversable
	 */
	public static function ImportHttpValue($value) {
		throw new ConvertionException();
	}
}

MetaTraversable::Init();
<?php

abstract class XConcreteArrayType extends XConcreteType {

	/** @return array */ public static function GetDefaultValue() { return array(); }


	/** @return string */ protected static function Encode($array){ throw new NonImplementedException(); }
	/** @return array */ protected static function Decode($string){ throw new NonImplementedException(); }



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
		return PDO::PARAM_STR;
	}

	/**
	 * @return string
	 */
	public static function GetXsdType(){
		return 'xs:string';
	}

	/**
	 * @param $value array
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return static::encode($value);
	}

	/**
	 * @param $value array
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return static::EncodeAsSqlStringLiteral(static::encode($value),$platform);
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
		return '['.implode(',',array_map(function($x){ return MetaString::ExportJsLiteral($x); },$value)).']';
	}

	/**
	 * @param $value array
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		return static::EncodeAsXmlString(static::encode($value),$attr);
	}

	/**
	 * @param $value array
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return static::EncodeAsHtmlString( static::encode($value));
	}

	/**
	 * @param $value array
	 * @return string
	 */
	public static function ExportTextString($value) {
		return static::encode($value);
	}

	/**
	 * @param $value array
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return static::EncodeAsUrlString(static::encode($value));
	}

	/**
	 * @param $value array
	 * @return string
	 */
	public static function ExportValString($value) {
		return static::encode($value);
	}

	/**
	 * @param $value string|null
	 * @return array
	 */
	public static function ImportDBValue($value) {
		if ($value === null) return array();
		return static::decode($value);
	}

	/**
	 * @param $value string|null
	 * @return array
	 */
	public static function ImportDomValue($value) {
		if ($value === null) return array();
		return static::decode($value);
	}

	/**
	 * @param $value string|null|array
	 * @return array
	 */
	public static function ImportHttpValue($value) {
		if (is_array($value)) {
			$r = array();
			foreach ($value as $x)
				$r = array_merge( $r , static::decode($x) );
			return $r;
		}
		if ($value === null) return array();
		return static::decode($value);
	}
}





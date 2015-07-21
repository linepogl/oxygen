<?php

abstract class XNullableArrayType extends XNullableType {

	/** @return array|null */ public static function GetDefaultValue() { return null; }


	/** @return string */ protected static function Encode($array){ throw new NonImplementedException(); }
	/** @return array */ protected static function Decode($string){ throw new NonImplementedException(); }



	/**
	 * @param $address array|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value!==null && !is_array($value)) throw new ValidationException();
		$address = $value;
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
	 * @param $value array|null
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return $value === null ? null : self::encode($value);
	}

	/**
	 * @param $value array|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		if ($value===null) return Sql::Null;
		return self::EncodeAsSqlStringLiteral(self::encode($value),$platform);
	}

	/**
	 * @param $value array|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value array|null
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		if ($value===null) return Js::Null;
		return '['.implode(',',array_map(function($x){ return MetaString::ExportJsLiteral($x); },$value)).']';
	}

	/**
	 * @param $value array|null
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		if ($value===null) return '';
		return self::EncodeAsXmlString(self::encode($value),$attr);
	}

	/**
	 * @param $value array|null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if ($value===null) return '';
		return self::EncodeAsHtmlString( self::encode($value));
	}

	/**
	 * @param $value array|null
	 * @return string
	 */
	public static function ExportTextString($value) {
		if ($value===null) return '';
		return self::encode($value);
	}

	/**
	 * @param $value array|null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if ($value===null) return '';
		return self::EncodeAsUrlString(self::encode($value));
	}

	/**
	 * @param $value array|null
	 * @return string
	 */
	public static function ExportValString($value) {
		if ($value===null) return '';
		return self::encode($value);
	}

	/**
	 * @param $value string|null
	 * @return array|null
	 */
	public static function ImportDBValue($value) {
		if ($value===null) return null;
		return self::decode($value);
	}

	/**
	 * @param $value string|null
	 * @return array|null
	 */
	public static function ImportDomValue($value) {
		if ($value===null) return null;
		return self::decode($value);
	}

	/**
	 * @param $value string|null|array
	 * @return array|null
	 */
	public static function ImportHttpValue($value) {
		if ($value===null) return null;
		if (is_array($value)) {
			$r = array();
			foreach ($value as $x)
				$r = array_merge( $r , self::decode($x) );
			return $r;
		}
		if ($value === null) return array();
		return self::decode($value);
	}
}

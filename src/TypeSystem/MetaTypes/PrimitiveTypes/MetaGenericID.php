<?php

class MetaGenericID extends XNullableType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaGenericID */ public static function Type() { return self::$instance; }
	/** @return GenericID|null */ public static function GetDefaultValue() { return null; }



	/** @return int */
	public static function GetPdoType() { return PDO::PARAM_STR; }

	/** @return string */
	public static function GetXsdType() { return 'xs:string'; }



	/**
	 * @param $address GenericID|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value===null) { $address = $value; return; }
		if ($value instanceof GenericID) { $address = $value; return; }
		throw new ValidationException();
	}


	/**
	 * @param $value GenericID|null
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		if ($value===null) return null;
		return $value->Encode();
	}

	/**
	 * @param $value GenericID|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		if ($value===null) return Sql::Null;
		return self::EncodeAsSqlStringLiteral( $value->Encode() , $platform );
	}

	/**
	 * @param $value GenericID|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		if ($value===null) return Js::Null;
		return self::EncodeAsJsStringLiteral( $value->Encode() );
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		if ($value===null) return '';
		return self::EncodeAsXmlString( $value->Encode() , $attr );
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if ($value===null) return '';
		return self::EncodeAsHtmlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public static function ExportTextString($value) {
		if ($value===null) return '';
		return $value->Encode();
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if ($value===null) return '';
		return self::EncodeAsUrlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public static function ExportValString($value) {
		if ($value===null) return '';
		return $value->Encode();
	}

	/**
	 * @param $value string|null
	 * @return GenericID|null
	 */
	public static function ImportDBValue($value) {
		if ($value===null) return null;
		return GenericID::Decode($value);
	}

	/**
	 * @param $value string|null
	 * @return GenericID|null
	 */
	public static function ImportDomValue($value) {
		if ($value===null) return null;
		if ($value === '') return null;
		return GenericID::Decode($value);
	}

	/**
	 * @param $value string|null|array
	 * @return GenericID|null
	 */
	public static function ImportHttpValue($value) {
		if ($value===null) return null;
		if ($value === '') return null;
		if (is_array($value)) throw new ConvertionException();
		return GenericID::Decode($value);
	}
}

MetaGenericID::Init();
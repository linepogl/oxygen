<?php

class NullableGenericID extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return NullableGenericID */ public static function Type() { return self::$instance; }
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
		if (is_null($value)) { $address = $value; return; }
		if ($value instanceof GenericID) { $address = $value; return; }
		throw new ValidationException();
	}


	/**
	 * @param $value GenericID|null
	 * @param $platform int
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		if (is_null($value)) return null;
		return $value->Encode();
	}

	/**
	 * @param $value GenericID|null
	 * @param $platform int
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		if (is_null($value)) return Sql::Null;
		return self::EncodeAsSqlStringLiteral( $value->Encode() , $platform );
	}

	/**
	 * @param $value GenericID|null
	 * @param $platform int
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
		if (is_null($value)) return Js::Null;
		return self::EncodeAsJsStringLiteral( $value->Encode() );
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public static function ExportXmlString($value) {
		if (is_null($value)) return '';
		return self::EncodeAsXmlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if (is_null($value)) return '';
		return self::EncodeAsHtmlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		if (is_null($value)) return '';
		return self::EncodeAsHtmlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if (is_null($value)) return '';
		return self::EncodeAsUrlString( $value->Encode() );
	}

	/**
	 * @param $value string|null
	 * @return GenericID|null
	 */
	public static function ImportDBValue($value) {
		if (is_null($value)) return null;
		return GenericID::Decode($value);
	}

	/**
	 * @param $value string|null
	 * @return GenericID|null
	 */
	public static function ImportDomValue($value) {
		if (is_null($value)) return null;
		if ($value === '') return null;
		return GenericID::Decode($value);
	}

	/**
	 * @param $value string|null|array
	 * @return GenericID|null
	 */
	public static function ImportHttpValue($value) {
		if (is_null($value)) return null;
		if ($value === '') return null;
		if (is_array($value)) throw new ConvertionException();
		return GenericID::Decode($value);
	}
}

NullableGenericID::Init();
<?php

class JustGenericID extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return JustGenericID */ public static function Type() { return self::$instance; }
	/** @return GenericID */ public static function GetDefaultValue() { return new GenericID('XItem',0); }



	/** @return int */
	public static function GetPdoType() { return PDO::PARAM_STR; }

	/** @return string */
	public static function GetXsdType() { return 'xs:string'; }



	/**
	 * @param $address GenericID
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value instanceof GenericID) { $address = $value; return; }
		throw new ValidationException();
	}


	/**
	 * @param $value GenericID
	 * @param $platform int
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return $value->Encode();
	}

	/**
	 * @param $value GenericID
	 * @param $platform int
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return self::EncodeAsSqlStringLiteral( $value->Encode() , $platform );
	}

	/**
	 * @param $value GenericID
	 * @param $platform int
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value GenericID
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return self::EncodeAsJsStringLiteral( $value->Encode() );
	}

	/**
	 * @param $value GenericID
	 * @return string
	 */
	public static function ExportXmlString($value) {
		return self::EncodeAsXmlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return self::EncodeAsHtmlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		return self::EncodeAsHtmlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return self::EncodeAsUrlString( $value->Encode() );
	}

	/**
	 * @param $value string|null
	 * @return GenericID
	 */
	public static function ImportDBValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		return GenericID::Decode($value);
	}

	/**
	 * @param $value string|null
	 * @return GenericID
	 */
	public static function ImportDomValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		if ($value === '') return self::GetDefaultValue();
		return GenericID::Decode($value);
	}

	/**
	 * @param $value string|null|array
	 * @return GenericID
	 */
	public static function ImportHttpValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		if ($value === '') return self::GetDefaultValue();
		if (is_array($value)) throw new ConvertionException();
		return GenericID::Decode($value);
	}
}

JustGenericID::Init();
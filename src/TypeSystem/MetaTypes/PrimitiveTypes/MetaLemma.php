<?php

class MetaLemma extends XNullableType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }

	/**
	 * @return MetaLemma
	 */
	public static function Type() {
		return self::$instance;
	}

	/**
	 * @return Lemma|null
	 */
	public static function GetDefaultValue() {
		return null;
	}

	/**
	 * @param $address Lemma|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value===null) $address = $value;
		if ($value instanceof Lemma) $address = $value;
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
	 * @param $value Lemma|null
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		if ($value===null) return null;
		return $value->Encode();
	}

	/**
	 * @param $value Lemma|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		if ($value===null) return Sql::Null;
		return self::EncodeAsSqlStringLiteral( $value->Encode() , $platform );
	}

	/**
	 * @param $value Lemma|null
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value Lemma|null
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		if ($value===null) return Js::Null;
		return self::EncodeAsJsStringLiteral( $value->Translate() ); /// ?
	}

	/**
	 * @param $value Lemma|null
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		if ($value===null) return '';
		return self::EncodeAsXmlString( $value->Encode() , $attr );
	}

	/**
	 * @param $value Lemma|null
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		if ($value===null) return '';
		return self::EncodeAsHtmlString( $value->Translate() );
	}

	/**
	 * @param $value Lemma|null
	 * @return string
	 */
	public static function ExportTextString($value) {
		if ($value===null) return '';
		return $value->Translate();
	}

	/**
	 * @param $value Lemma|null
	 * @return string
	 */
	public static function ExportUrlString($value) {
		if ($value===null) return '';
		return self::EncodeAsUrlString( $value->Encode() );
	}

	/**
	 * @param $value Lemma|null
	 * @return string
	 */
	public static function ExportValString($value) {
		if ($value===null) return '';
		return $value->Encode();
	}

	/**
	 * @param $value string|null
	 * @return Lemma|null
	 */
	public static function ImportDBValue($value) {
		if ($value===null) return null;
		return Lemma::Decode($value);
	}

	/**
	 * @param $value string|null
	 * @return Lemma|null
	 */
	public static function ImportDomValue($value) {
		if ($value===null) return null;
		if ($value === '') return null;
		return Lemma::Decode($value);
	}

	/**
	 * @param $value string|null|array
	 * @return Lemma|null
	 */
	public static function ImportHttpValue($value) {
		if ($value===null) return null;
		if ($value === '') return null;
		if (is_array($value)) throw new ConvertionException();
		return Lemma::Decode($value);
	}
}


MetaLemma::Init();
<?php

class MetaLemmaOrEmpty extends XConcreteType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaLemmaOrEmpty */ public static function Type() { return self::$instance; }
	/** @return MetaLemma */ public static function GetNullableType(){ return MetaLemma::Type(); }
	/** @return Lemma */ public static function GetDefaultValue() { return new Lemma(); }



	/**
	 * @param $address Lemma
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value instanceof Lemma) { $address = $value; return; }
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
	 * @param $value Lemma
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		return $value->Encode();
	}

	/**
	 * @param $value Lemma
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		return self::EncodeAsSqlStringLiteral( $value->Encode() , $platform );
	}

	/**
	 * @param $value Lemma
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value Lemma
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return self::EncodeAsJsStringLiteral( $value->Translate() ); /// ?
	}

	/**
	 * @param $value Lemma
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		return self::EncodeAsXmlString( $value->Encode() , $attr );
	}

	/**
	 * @param $value Lemma
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return self::EncodeAsHtmlString( $value->Translate() );
	}

	/**
	 * @param $value Lemma
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return self::EncodeAsUrlString( $value->Encode() );
	}

	/**
	 * @param $value Lemma
	 * @return string
	 */
	public static function ExportValString($value) {
		return $value->Encode();
	}

	/**
	 * @param $value string|null
	 * @return Lemma
	 */
	public static function ImportDBValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		return Lemma::Decode($value);
	}

	/**
	 * @param $value string|null
	 * @return Lemma
	 */
	public static function ImportDomValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		return Lemma::Decode($value);
	}

	/**
	 * @param $value string|null|array
	 * @return Lemma
	 */
	public static function ImportHttpValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		if (is_array($value)) throw new ConvertionException();
		return Lemma::Decode($value);
	}

}


MetaLemmaOrEmpty::Init();

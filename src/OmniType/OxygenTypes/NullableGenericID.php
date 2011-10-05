<?php

class NullableGenericID extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }

	/**
	 * @return OmniType
	 */
	public static function Type() {
		return self::$instance;
	}

	/**
	 * @return GenericID|null
	 */
	public function GetDefaultValue() {
		return null;
	}

	/**
	 * @param $address GenericID|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public function Assign(&$address,$value) {
		if (is_null($value)) { $address = $value; return; }
		if ($value instanceof GenericID) { $address = $value; return; }
		throw new ValidationException();
	}

	/**
	 * @return int
	 */
	public function GetPdoType() {
		return PDO::PARAM_STR;
	}

	/**
	 * @return string
	 */
	public function GetXsdType() {
		return 'xs:string';
	}

	/**
	 * @param $value GenericID|null
	 * @param $platform int
	 * @return mixed
	 */
	public function ExportPdoValue($value, $platform) {
		if (is_null($value)) return null;
		return $value->Encode();
	}

	/**
	 * @param $value GenericID|null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlLiteral($value, $platform) {
		if (is_null($value)) return Sql::Null;
		return self::EncodeAsSqlStringLiteral( $value->Encode() , $platform );
	}

	/**
	 * @param $value GenericID|null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public function ExportJsLiteral($value) {
		if (is_null($value)) return Js::Null;
		return self::EncodeAsJsStringLiteral( $value->Encode() );
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public function ExportXmlString($value) {
		if (is_null($value)) return '';
		return self::EncodeAsXmlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public function ExportHtmlString($value) {
		if (is_null($value)) return '';
		return self::EncodeAsHtmlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public function ExportHumanReadableHtmlString($value) {
		if (is_null($value)) return '';
		return self::EncodeAsHtmlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID|null
	 * @return string
	 */
	public function ExportUrlString($value) {
		if (is_null($value)) return '';
		return self::EncodeAsUrlString( $value->Encode() );
	}

	/**
	 * @param $value string|null
	 * @return GenericID|null
	 */
	public function ImportDBValue($value) {
		if (is_null($value)) return null;
		return GenericID::Decode($value);
	}

	/**
	 * @param $value string|null
	 * @return GenericID|null
	 */
	public function ImportDOMValue($value) {
		if (is_null($value)) return null;
		if ($value === '') return null;
		return GenericID::Decode($value);
	}

	/**
	 * @param $value string|null|array
	 * @return GenericID|null
	 */
	public function ImportHttpValue($value) {
		if (is_null($value)) return null;
		if (is_array($value)) throw new ConvertionException();
		return GenericID::Decode($value);
	}
}

NullableGenericID::Init();
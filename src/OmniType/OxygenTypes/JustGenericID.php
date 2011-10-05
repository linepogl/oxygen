<?php

class JustGenericID extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }

	/**
	 * @return OmniType
	 */
	public static function Type() {
		return self::$instance;
	}

	/**
	 * @return GenericID
	 */
	public function GetDefaultValue() {
		return new GenericID('XItem',0);
	}

	/**
	 * @param $address GenericID
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public function Assign(&$address,$value) {
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
	 * @param $value GenericID
	 * @param $platform int
	 * @return mixed
	 */
	public function ExportPdoValue($value, $platform) {
		return $value->Encode();
	}

	/**
	 * @param $value GenericID
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlLiteral($value, $platform) {
		return self::EncodeAsSqlStringLiteral( $value->Encode() , $platform );
	}

	/**
	 * @param $value GenericID
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value GenericID
	 * @return string
	 */
	public function ExportJsLiteral($value) {
		return self::EncodeAsJsStringLiteral( $value->Encode() );
	}

	/**
	 * @param $value GenericID
	 * @return string
	 */
	public function ExportXmlString($value) {
		return self::EncodeAsXmlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID
	 * @return string
	 */
	public function ExportHtmlString($value) {
		return self::EncodeAsHtmlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID
	 * @return string
	 */
	public function ExportHumanReadableHtmlString($value) {
		return self::EncodeAsHtmlString( $value->Encode() );
	}

	/**
	 * @param $value GenericID
	 * @return string
	 */
	public function ExportUrlString($value) {
		return self::EncodeAsUrlString( $value->Encode() );
	}

	/**
	 * @param $value string|null
	 * @return GenericID
	 */
	public function ImportDBValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		return GenericID::Decode($value);
	}

	/**
	 * @param $value string|null
	 * @return GenericID
	 */
	public function ImportDOMValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		if ($value === '') return null;
		return GenericID::Decode($value);
	}

	/**
	 * @param $value string|null|array
	 * @return GenericID
	 */
	public function ImportHttpValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		if (is_array($value)) throw new ConvertionException();
		return GenericID::Decode($value);
	}
}

JustGenericID::Init();
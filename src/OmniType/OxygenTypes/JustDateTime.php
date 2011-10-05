<?php

class JustDateTime extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }

	/**
	 * @return OmniType
	 */
	public static function Type() {
		return self::$instance;
	}

	/**
	 * @return XDateTime
	 */
	public function GetDefaultValue() {
		return new XDateTime();
	}

	/**
	 * @param $address XDateTime
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public function Assign(&$address,$value) {
		if ($value instanceof XDateTime) { $address = $value; return; }
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
		return 'xs:dateTime';
	}

	/**
	 * @param $value XDateTime
	 * @param $platform int
	 * @return mixed
	 */
	public function ExportPdoValue($value, $platform) {
		return self::EncodeAsPdoDateTimeValue($value,$platform);
	}

	/**
	 * @param $value XDateTime
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlLiteral($value, $platform) {
		return self::EncodeAsSqlDateTimeLiteral($value,$platform);
	}

	/**
	 * @param $value XDateTime
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value XDateTime
	 * @return string
	 */
	public function ExportJsLiteral($value) {
		return self::EncodeAsJsDateTimeLiteral( $value );
	}

	/**
	 * @param $value XDateTime
	 * @return string
	 */
	public function ExportXmlString($value) {
		return $this->value->Format('Y-m-d\TH:i:s');
	}

	/**
	 * @param $value XDateTime
	 * @return string
	 */
	public function ExportHtmlString($value) {
		$r = $this->value->Format('YmdHis');
	}

	/**
	 * @param $value XDateTime
	 * @return string
	 */
	public function ExportHumanReadableHtmlString($value) {
		return self::EncodeAsHtmlString( $value->Encode() );
	}

	/**
	 * @param $value XDateTime
	 * @return string
	 */
	public function ExportUrlString($value) {
		return self::EncodeAsUrlString( $value->Encode() );
	}

	/**
	 * @param $value string|null
	 * @return XDateTime
	 */
	public function ImportDBValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		return GenericID::Decode($value);
	}

	/**
	 * @param $value string|null
	 * @return XDateTime
	 */
	public function ImportDOMValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		if ($value === '') return null;
		return GenericID::Decode($value);
	}

	/**
	 * @param $value string|null|array
	 * @return XDateTime
	 */
	public function ImportHttpValue($value) {
		if (is_null($value)) return self::GetDefaultValue();
		if (is_array($value)) throw new ConvertionException();
		return GenericID::Decode($value);
	}
}

JustDateTime::Init();
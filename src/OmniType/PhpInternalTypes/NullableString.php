<?php

class OmniStringOrNull extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }

	/**
	 * @return OmniStringOrNull
	 */
	public static function Type(){
		return self::$instance;
	}

	/**
	 * @return string|null
	 */
	public function GetDefaultValue() {
		return null;
	}

	/**
	 * @param $address string|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public function Assign(&$address,$value) {
		if (!is_null($value) && !is_string($value)) throw new ValidationException();
		$address = $value;
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
	 * @param $value string|null
	 * @param $platform int
	 * @return mixed
	 */
	public function ExportPdoValue($value, $platform) {
		return $value;
	}

	/**
	 * @param $value string|null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlLiteral($value, $platform) {
		if (is_null($value)) return Sql::Null;
		return $this->EncodeAsSqlStringLiteral($value,$platform);
	}

	/**
	 * @param $value string|null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlIdentifier($value, $platform) {
		if (is_null($value)) throw new ConvertionException();
		if ($value === '') throw new ConvertionException();
		return $this->EncodeAsSqlIdentifier($value,$platform);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public function ExportJsLiteral($value) {
		if (is_null($value)) return Js::Null;
		return $this->EncodeAsJsStringLiteral($value);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public function ExportXmlString($value) {
		if (is_null($value)) return '';
		return $this->EncodeAsHtmlString($value);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public function ExportHtmlString($value) {
		if (is_null($value)) return '';
		return $this->EncodeAsHtmlString($value);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public function ExportHumanReadableHtmlString($value) {
		if (is_null($value)) return '';
		return $this->EncodeAsHtmlString($value);
	}

	/**
	 * @param $value string|null
	 * @return string
	 */
	public function ExportUrlString($value) {
		if (is_null($value)) return '';
		return $this->EncodeAsUrlString($value);
	}

	/**
	 * @param $value string|null
	 * @return string|null
	 */
	public function ImportDBValue($value) {
		return $value;
	}

	/**
	 * @param $value string|null
	 * @return string|null
	 */
	public function ImportDOMValue($value) {
		if (is_null($value)) return null;
		return $this->DecodeXmlString($value);
	}

	/**
	 * @param $value string|null|array
	 * @return string|null
	 */
	public function ImportHttpValue($value) {
		if (is_null($value)) return null;
		if (is_array($value)) return $this->DecodeHtmlString($this->DecodeUrlString( implode(',',$value) ) );
		return $this->DecodeHtmlString( $this->DecodeUrlString( $value ) );
	}
}

OmniStringOrNull::Init();
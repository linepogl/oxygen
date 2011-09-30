<?php

class JustInteger extends OmniType {

	/**
	 * @return int
	 */
	public function GetDefaultValue() {
		return 0;
	}

	/**
	 * @param $address int
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public function Assign(&$address,$value) {
		if (!is_int($value)) throw new ValidationException();
		$address = $value;
	}

	/**
	 * @return int
	 */
	public function GetPdoType() {
		return PDO::PARAM_INT;
	}

	/**
	 * @param $value int
	 * @param $platform int
	 * @return mixed
	 */
	public function ExportPdoValue($value, $platform) {
		return $value;
	}

	/**
	 * @param $value int
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlLiteral($value, $platform) {
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value int
	 * @return string
	 */
	public function ExportJsLiteral($value) {
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int
	 * @return string
	 */
	public function ExportXmlString($value) {
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int
	 * @return string
	 */
	public function ExportHtmlString($value) {
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int
	 * @return string
	 */
	public function ExportHumanReadableHtmlString($value) {
		return sprintf('%d',$value);
	}

	/**
	 * @param $value int
	 * @return string
	 */
	public function ExportUrlString($value) {
		return sprintf('%d',$value);
	}

	/**
	 * @param $value string|null
	 * @return int
	 */
	public function ImportDBValue($value) {
		if (is_null($value)) return 0;
		return intval($value);
	}

	/**
	 * @param $value string|null
	 * @return int
	 */
	public function ImportDOMValue($value) {
		if (is_null($value)) return 0;
		return intval($value);
	}

	/**
	 * @param $value string|null|array
	 * @return int
	 */
	public function ImportHttpValue($value) {
		if (is_null($value)) return 0;
		if (is_array($value)) throw new ConvertionException();
		return intval($value);
	}
}
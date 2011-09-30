<?php

class JustNull extends OmniType {

	/**
	 * @return null
	 */
	public function GetDefaultValue() {
		return null;
	}

	/**
	 * @param $address null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public function Assign(&$address,$value) {
		if (!is_null($value)) throw new ValidationException();
		$address = $value;
	}

	/**
	 * @return int
	 */
	public function GetPdoType() {
		return PDO::PARAM_NULL;
	}

	/**
	 * @param $value null
	 * @param $platform int
	 * @return null
	 */
	public function ExportPdoValue($value, $platform) {
		return null;
	}

	/**
	 * @param $value null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlLiteral($value, $platform) {
		return 'NULL';
	}

	/**
	 * @param $value null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value null
	 * @return string
	 */
	public function ExportJsLiteral($value) {
		return 'null';
	}

	/**
	 * @param $value null
	 * @return string
	 */
	public function ExportXmlString($value) {
		return '';
	}

	/**
	 * @param $value null
	 * @return string
	 */
	public function ExportHtmlString($value) {
		return '';
	}

	/**
	 * @param $value null
	 * @return string
	 */
	public function ExportHumanReadableHtmlString($value) {
		return '';
	}

	/**
	 * @param $value null
	 * @return string
	 */
	public function ExportUrlString($value) {
		return '';
	}

	/**
	 * @param $value string|null
	 * @return null
	 */
	public function ImportDBValue($value) {
		return null;
	}

	/**
	 * @param $value string|null
	 * @return null
	 */
	public function ImportDOMValue($value) {
		return null;
	}

	/**
	 * @param $value string|null|array
	 * @return null
	 */
	public function ImportHttpValue($value) {
		return null;
	}
}
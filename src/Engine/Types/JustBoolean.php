<?php

class JustBoolean extends OmniType {

	/**
	 * @return boolean
	 */
	public function GetDefaultValue() {
		return false;
	}

	/**
	 * @param $address boolean
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public function Assign(&$address,$value) {
		if (is_bool($value)) $address = $value;
		throw new ValidationException();
	}

	/**
	 * @return int
	 */
	public function GetPdoType() {
		return PDO::PARAM_BOOL;
	}

	/**
	 * @param $value boolean
	 * @param $platform int
	 * @return mixed
	 */
	public function ExportPdoValue($value, $platform) {
		return $value;
	}

	/**
	 * @param $value boolean
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlLiteral($value, $platform) {
		if ($value) return '1';
		return '0';
	}

	/**
	 * @param $value boolean
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value boolean
	 * @return string
	 */
	public function ExportJsLiteral($value) {
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value boolean
	 * @return string
	 */
	public function ExportXmlString($value) {
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value boolean
	 * @return string
	 */
	public function ExportHtmlString($value) {
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value boolean
	 * @return string
	 */
	public function ExportHumanReadableHtmlString($value) {
		if ($value) return (string)Lemma::Retrieve('Yes');
		return (string)Lemma::Retrieve('No');
	}

	/**
	 * @param $value boolean
	 * @return string
	 */
	public function ExportUrlString($value) {
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value string|null
	 * @return boolean
	 */
	public function ImportDBValue($value) {
		if (is_null($value)) return false;
		if ($value === '1') return true; /// TODO: this needs testing
		return false;
	}

	/**
	 * @param $value string|null
	 * @return boolean
	 */
	public function ImportDOMValue($value) {
		if (is_null($value)) return false;
		if ($value === 'true') return true;
		return false;
	}

	/**
	 * @param $value string|null|array
	 * @return boolean
	 */
	public function ImportHttpValue($value) {
		if (is_null($value)) return false;
		if (is_array($value)) throw new ConvertionException();
		if ($value === 'true') return true;
		return false;
	}
}
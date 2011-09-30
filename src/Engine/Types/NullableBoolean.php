<?php

class NullableBoolean extends OmniType {

	/**
	 * @return boolean|null
	 */
	public function GetDefaultValue() {
		return null;
	}

	/**
	 * @param $address boolean|null
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public function Assign(&$address,$value) {
		if (!is_null($value) && !is_bool($value)) throw new ValidationException();
		$address = $value;
	}

	/**
	 * @return int
	 */
	public function GetPdoType() {
		return PDO::PARAM_BOOL;
	}

	/**
	 * @param $value boolean|null
	 * @param $platform int
	 * @return mixed
	 */
	public function ExportPdoValue($value, $platform) {
		return $value;
	}

	/**
	 * @param $value boolean|null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlLiteral($value, $platform) {
		if (is_null($value)) return $this->GetSqlNullLiteral();
		if ($value) return '1';
		return '0';
	}

	/**
	 * @param $value boolean|null
	 * @param $platform int
	 * @return string
	 */
	public function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value boolean|null
	 * @return string
	 */
	public function ExportJsLiteral($value) {
		if (is_null($value)) return $this->GetJsNullLiteral();
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value boolean|null
	 * @return string
	 */
	public function ExportXmlString($value) {
		if (is_null($value)) return '';
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value boolean|null
	 * @return string
	 */
	public function ExportHtmlString($value) {
		if (is_null($value)) return '';
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value boolean|null
	 * @return string
	 */
	public function ExportHumanReadableHtmlString($value) {
		if (is_null($value)) return '';
		if ($value) return (string)Lemma::Retrieve('Yes');
		return (string)Lemma::Retrieve('No');
	}

	/**
	 * @param $value boolean|null
	 * @return string
	 */
	public function ExportUrlString($value) {
		if (is_null($value)) return '';
		if ($value) return 'true';
		return 'false';
	}

	/**
	 * @param $value string|null
	 * @return boolean|null
	 */
	public function ImportDBValue($value) {
		if (is_null($value)) return null;
		if ($value === '1') return true; /// TODO: this needs testing
		return false;
	}

	/**
	 * @param $value string|null
	 * @return boolean|null
	 */
	public function ImportDOMValue($value) {
		if (is_null($value)) return null;
		if ($value === 'true') return true;
		if ($value === 'false') return false;
		return null;
	}

	/**
	 * @param $value string|null|array
	 * @return boolean|null
	 */
	public function ImportHttpValue($value) {
		if (is_null($value)) return null;
		if (is_array($value)) throw new ConvertionException();
		if ($value === 'true') return true;
		if ($value === 'false') return false;
		return null;
	}
}
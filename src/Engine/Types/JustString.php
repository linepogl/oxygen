<?php


abstract class OmniString extends OmniType {

	/**
	 * @param int|null $value
	 * @return $this
	 */
	public function SetMaxLength($value){ $this->max_length = $value; return $this; }
	protected $max_length = null;


	/**
	 * @param Lemma|string|null $value
	 * @return $this
	 */
	public function SetMaxLengthMessage($value){ $this->max_length_message = $value; return $this; }
	protected $max_length_message = null;


	/**
	 * @param int|null $value
	 * @return $this
	 */
	public function SetMinLength($value){ $this->max_length = $value; return $this; }
	protected $min_length = null;


	/**
	 * @param Lemma|string|null $value
	 * @return $this
	 */
	public function SetMinLengthMessage($value){ $this->min_length_message = $value; return $this; }
	protected $min_length_message = null;


	/**
	 * @param int|null $value
	 * @return $this
	 */
	public function SetRegExp($value){ $this->max_length = $value; return $this; }
	protected $reg_exp = null;


	/**
	 * @param Lemma|string|null $value
	 * @return $this
	 */
	public function SetRegExpMessage($value){ $this->min_length_message = $value; return $this; }
	protected $reg_exp_message = null;

}


class JustString extends OmniType {

	/**
	 * @param string|null $value
	 * @return string
	 */
	public function ConvertPdoToPhp($value){
		if (is_null($value)) return '';
	  return $value;
	}

	/**
	 * @param string $value
	 * @return string|null
	 */
	public function ConvertPhpToPdo($value){
		if ($value == '') return null;
		return $value;
	}


	/**
	 * @param string $value
	 * @return string
	 */
	public function ConvertPhpToSql($value){
		if ($value == '') return 'NULL';
		return mysql_real_escape_string($value);
	}


	/**
	 * @return int
	 */
	public function GetPdoType(){
		return PDO::PARAM_STR;
	}


	/**
	 * @param mixed $value
	 * @throws ValidationException
	 */
	public function Validate($value){
		if (is_string($value)) return;
		throw new ValidationException();
	}


	public function GetDefaultValue(){
		return '';
	}
}


class NullableString extends  OmniType {

	public function ConvertPdoToPhp($value){
		return $value;
	}

	public function ConvertPhpToPdo($value){
		return $value;
	}

	public function ConvertPhpToSql($value){
		if (is_null($value))
		return mysql_real_escape_string($value);
	}

	public function GetPdoType(){
		return PDO::PARAM_STR;
	}

	/**
	 * @param mixed $value
	 * @throws ValidationException
	 */
	public function Validate($value){
		if (is_null($value)) return;
		if (is_string($value)) return;
		throw new ValidationException();
	}

	public function GetDefaultValue(){
		return null;
	}
}
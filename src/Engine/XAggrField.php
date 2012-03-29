<?php

class XAggrField {
	const COUNT = 0;
	const SUM = 1;
	const MIN = 2;
	const MAX = 3;
	const AVG = 4;

	private $field;
	private $function;
	public function __construct( XMetaField $field , $function = self::COUNT ){
		$this->field = $field;
		$this->function = $function;
	}
	public function ToSql() {
		switch ($this->function){
			default:
			case self::COUNT: return 'COUNT('.new SqlName($this->field).')';
			case self::MAX: return 'MAX('.new SqlName($this->field).')';
			case self::MIN: return 'MIN('.new SqlName($this->field).')';
			case self::SUM: return 'SUM('.new SqlName($this->field).')';
			case self::AVG: return 'AVG('.new SqlName($this->field).')';
		}
	}

	/** @return XType */
	public function GetType(){
		switch ($this->function){
			case self::COUNT: return MetaInteger::Type();
			default: return $this->field->GetType();
		}
	}

}




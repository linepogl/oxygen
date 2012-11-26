<?php

class XFuncField {
	const COUNT = 0;
	const SUM = 1;
	const MIN = 2;
	const MAX = 3;
	const AVG = 4;
	const COUNT_DISTINCT = 5;

	const HASH_YEAR = 80;
	const HASH_MONTH = 81;
	const HASH_DAY = 82;
	const HASH_WEEKDAY = 83;
	const HASH_HOUR = 84;
	const HASH_EXACT_DAY = 90;
	const HASH_EXACT_MONTH = 91;


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
			case self::COUNT_DISTINCT: return 'COUNT(DISTINCT '.new SqlName($this->field).')';

			// TODO: TRANSLATE THESE TO MYSQL ALSO:
			case self::HASH_YEAR: return 'TO_CHAR('.new SqlName($this->field).',\'YYYY\')';
			case self::HASH_MONTH: return 'TO_CHAR('.new SqlName($this->field).',\'MM\')';
			case self::HASH_DAY: return 'TO_CHAR('.new SqlName($this->field).',\'DD\')';
			case self::HASH_WEEKDAY: return '(TO_CHAR('.new SqlName($this->field).',\'D\')-1)';
			case self::HASH_HOUR: return 'TO_CHAR('.new SqlName($this->field).',\'HH24\')';
			case self::HASH_EXACT_DAY: return 'TO_CHAR('.new SqlName($this->field).',\'YYYYMMDD\')';
			case self::HASH_EXACT_MONTH: return 'TO_CHAR('.new SqlName($this->field).',\'YYYYMM\')';

		}
	}

	/** @return XType */
	public function GetType(){
		switch ($this->function){
			case self::COUNT:
			case self::COUNT_DISTINCT:
				return MetaInteger::Type();
			case self::HASH_YEAR:
			case self::HASH_MONTH:
			case self::HASH_DAY:
			case self::HASH_WEEKDAY:
			case self::HASH_HOUR:
			case self::HASH_EXACT_DAY:
			case self::HASH_EXACT_MONTH:
				return MetaString::Type();

			case self::SUM:
				return $this->field->GetType()->GetNullableType();

			default:
				return $this->field->GetType()->GetNullableType();
		}
	}

}




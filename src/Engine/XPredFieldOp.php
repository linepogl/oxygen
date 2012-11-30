<?php

class XPredFieldOp extends XPred {

	const OP_EQ = 0;
	const OP_NOT_EQ = 1;

	const OP_LT = 2;
	const OP_LE = 3;

	const OP_GT = 4;
	const OP_GE = 5;

	const OP_LIKE = 6;
	const OP_NOT_LIKE = 7;

	const OP_IN = 8;
	const OP_NOT_IN = 9;



	/** @var XMetaField */
	private $field1;
	private $field2_or_value;
	private $op;
	public function __construct(XMetaField $field1, $field2_or_value, $op = self::OP_EQ){
		$this->field1 = $field1;
		$this->field2_or_value = $field2_or_value;
		$this->op = $op;
	}


	public function ToSql(){
		switch ($this->op){

			case self::OP_EQ:
				if (is_null($this->field2_or_value))
					return new SqlIden($this->field1) . ' IS NULL';
				if ($this->field2_or_value instanceof XMetaField)
					return '(('.new SqlIden($this->field1) . '=' . new SqlIden($this->field2_or_value).') OR ('.new SqlIden($this->field1) . ' IS NULL AND ' . new SqlIden($this->field2_or_value).' IS NULL))' ;
				return '('.new SqlIden($this->field1) .' IS NOT NULL AND '.new SqlIden($this->field1) . '=?)';

			case self::OP_NOT_EQ:
				if (is_null($this->field2_or_value))
					return new SqlIden($this->field1) . ' IS NOT NULL';
				if ($this->field2_or_value instanceof XMetaField)
					return 'NOT ('.new SqlIden($this->field1) . '=' . new SqlIden($this->field2_or_value).')';
				return '(' . new SqlIden($this->field1) . ' IS NULL OR NOT (' . new SqlIden($this->field1) . '=?))';

			case self::OP_GT:
				if ($this->field2_or_value instanceof XMetaField)
					return new SqlIden($this->field1) . '>' . new SqlIden($this->field2_or_value);
				return new SqlIden($this->field1) . '>?';

			case self::OP_GE:
				if ($this->field2_or_value instanceof XMetaField)
					return new SqlIden($this->field1) . '>=' . new SqlIden($this->field2_or_value);
				return new SqlIden($this->field1) . '>=?';

			case self::OP_LT:
				if ($this->field2_or_value instanceof XMetaField)
					return new SqlIden($this->field1) . '<' . new SqlIden($this->field2_or_value);
				return new SqlIden($this->field1) . '<?';

			case self::OP_LE:
				if ($this->field2_or_value instanceof XMetaField)
					return new SqlIden($this->field1) . '<=' . new SqlIden($this->field2_or_value);
				return new SqlIden($this->field1) . '<=?';

			case self::OP_LIKE:
				if ($this->field2_or_value instanceof XMetaField)
					return new SqlIden($this->field1) . ' LIKE ' . new SqlIden($this->field2_or_value);
				return new SqlIden($this->field1) . ' LIKE ?';

			case self::OP_NOT_LIKE:
				if ($this->field2_or_value instanceof XMetaField)
					return new SqlIden($this->field1) . ' NOT LIKE ' . new SqlIden($this->field2_or_value);
				return new SqlIden($this->field1) . ' NOT LIKE ?';

			case self::OP_IN:
				return new SqlIden($this->field1) . ' IN '. new Sql($this->field2_or_value);

			case self::OP_NOT_IN:
				return new SqlIden($this->field1) . ' NOT IN '. new Sql($this->field2_or_value);

		}
		throw new InvalidArgumentException('Unsupported field comparison filter operator: ' . $this->op );
	}




	public function GetSqlParams(){
		if (is_null($this->field2_or_value))
			return array();

		if ($this->field2_or_value instanceof XMetaField)
			return array();

		switch ($this->op){
			case self::OP_EQ:
			case self::OP_NOT_EQ:
			case self::OP_GT:
			case self::OP_GE:
			case self::OP_LT:
			case self::OP_LE:
			case self::OP_LIKE:
			case self::OP_NOT_LIKE:
				return array($this->field2_or_value);
		}

		return array();
	}


}
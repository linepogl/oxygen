<?php

class XPredBinaryOp extends XPred {

	const OP_AND = 0;
	const OP_OR = 1;
	const OP_AND_NOT = 2;
	const OP_OR_NOT = 3;


	private $op;
	/** @var XPred */ private $pred1;
	/** @var XPred */ private $pred2;

	public function __construct(XPred $pred1, XPred $pred2, $op = self::OP_AND){
		$this->pred1 = $pred1;
		$this->pred2 = $pred2;
		$this->op = $op;
	}


	public function ToSql(){
		switch ($this->op){
			case self::OP_AND: return '('.$this->pred1->ToSql().') AND ('.$this->pred2->ToSql().')';
			case self::OP_OR: return '('.$this->pred1->ToSql().') OR ('.$this->pred2->ToSql().')';
			case self::OP_AND_NOT: return '('.$this->pred1->ToSql().') AND (NOT ('.$this->pred2->ToSql().'))';
			case self::OP_OR_NOT: return '('.$this->pred1->ToSql().') OR (NOT ('.$this->pred2->ToSql().'))';
		}
		throw new InvalidArgumentException('Unsupported binary filter operator: ' . $this->op );
	}

	public function GetSqlParams(){
		return array_merge($this->pred1->GetSqlParams(),$this->pred2->GetSqlParams());
	}



}
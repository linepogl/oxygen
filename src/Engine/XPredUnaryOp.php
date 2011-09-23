<?php

class XPredUnaryOp extends XPred {

	const OP_NOT = 0;

	private $op;
	/** @var XPred */ private $pred;

	public function __construct(XPred $pred, $op = self::OP_NOT){
		$this->pred = $pred;
		$this->op = $op;
	}


	public function ToSql(){
		switch ($this->op){
			case self::OP_NOT: return 'NOT ('.$this->pred->ToSql().')';
		}
		throw new InvalidArgumentException('Unsupported unary filter operator: ' . $this->op );
	}


	public function GetSqlParams(){
		return $this->pred->GetSqlParams();
	}



}
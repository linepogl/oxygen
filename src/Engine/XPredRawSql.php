<?php

class XPredRawSql extends XPred {

	private $sql;
	private $params;

	public function __construct($sql, $params = array()){
		$this->sql = $sql;
		$this->params = $params;
	}


	public function ToSql(){
		return $this->sql;
	}

	public function GetSqlParams(){
		return $this->params;
	}


}
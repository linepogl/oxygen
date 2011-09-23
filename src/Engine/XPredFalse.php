<?php

class XPredFalse extends XPred {

	public function ToSql(){ return '1=0'; }
	public function GetSqlParams(){ return array(); }

}
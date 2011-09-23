<?php

class XPredTrue extends XPred {

	public function ToSql(){ return '1=1'; }
	public function GetSqlParams(){ return array(); }

}
<?php

class XOrderByField extends XOrderBy {

	private $field;
	private $desc;
	public function __construct( $field , $desc = false ){
		$this->field = $field;
		$this->desc = $desc;
	}

	public function ToSql(){
		return new SqlName($this->field) . ($this->desc ? ' DESC' : ' ASC');
	}


}
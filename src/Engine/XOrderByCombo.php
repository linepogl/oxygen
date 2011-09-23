<?php

class XOrderByCombo extends XOrderBy {

	private $order_by1;
	private $order_by2;
	public function __construct( XOrderBy $order_by1 , XOrderBy $order_by2 ){
		$this->order_by1 = $order_by1;
		$this->order_by2 = $order_by2;
	}

	public function ToSql() {
		return $this->order_by1->ToSql().','.$this->order_by2->ToSql();
	}

}
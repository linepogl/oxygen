<?php

abstract class XOrderBy {

	/** @return XOrderBy */ public function ThenBy(XOrderBy $order_by){ return new XOrderByCombo($this,$order_by); }
		
	abstract function ToSql();


}
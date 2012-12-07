<?php

abstract class Box extends ValueControl {

	protected $on_change = '';
	public function WithOnChange($value){ $this->on_change = $value; return $this; }

	protected $readonly = '';
	public function WithReadOnly($value) { $this->readonly = $value; return $this; }

}





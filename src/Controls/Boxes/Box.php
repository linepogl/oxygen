<?php

abstract class Box extends ValueControl {

	protected $readonly = '';
	public function WithReadOnly($value) { $this->readonly = $value; return $this; }

	protected $on_change = '';
	public function WithOnChange($value){ $this->on_change = $value; return $this; }

	protected $on_focus = '';
	public function WithOnFocus($value){ $this->on_focus = $value; return $this; }

	protected $on_blur = '';
	public function WithOnBlur($value){ $this->on_blur = $value; return $this; }

}





<?php

abstract class Box extends ValueControl {

	protected $readonly = '';
	/** @return static */ public function WithReadOnly($value) { $this->readonly = $value; return $this; }

	protected $on_change = '';
	/** @return static */ public function WithOnChange($value){ $this->on_change = $value; return $this; }

	protected $on_focus = '';
	/** @return static */ public function WithOnFocus($value){ $this->on_focus = $value; return $this; }

	protected $on_blur = '';
	/** @return static */ public function WithOnBlur($value){ $this->on_blur = $value; return $this; }

}





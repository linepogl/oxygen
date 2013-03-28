<?php

class LiteralBox extends Box {

	private $is_rich = false;
	/** @return static */ public function WithIsRich($value){ $this->is_rich=$value; return $this; }

	public function Render(){
		echo $this->is_rich ? $this->value : new Html($this->value);
	}

}
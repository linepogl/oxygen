<?php

class Glyph extends Control {
	private $code;
	private $css_class;
	public function __construct($css_class,$code){
		$this->css_class = $css_class;
		$this->code = $code;
	}

	private $size = null;
	/** @return static */ public function WithSize($size){ $this->size = $size; return $this; }

	public function Render() {
		echo '<span class="glyph '.$this->css_class.'"'.($this->size===null?'':' style="font-size:'.$this->size.'px;"').'>&#x'.sprintf('%x',$this->code).';</span>';
	}
}


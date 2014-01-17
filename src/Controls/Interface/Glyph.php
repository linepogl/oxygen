<?php

class Glyph extends Control {
	private $code;
	private $css_class;
	private $size;
	public function __construct($css_class,$code,$size=null){
		$this->code = $code;
		$this->css_class = $css_class;
		$this->size = $size;
	}
	public function Render() {
		echo '<span class="glyph '.$this->css_class.'"'.($this->size===null?'':'style="font-size:'.$this->size.'px;"').'>&#x'.sprintf('%x',$this->code).';</span>';
	}
}


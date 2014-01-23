<?php

class Glyph extends Control {
	private $code;
	private $base_css_class;
	public function __construct($base_css_class,$code){
		$this->base_css_class = $base_css_class;
		$this->code = $code;
	}

	private $size = null;
	/** @return static */ public function WithSize($size){ $this->size = $size; return $this; }

	private $title = null;
	/** @return static */ public function WithTitle($title){ $this->title = $title; return $this; }

	private $css_style = null;
	/** @return static */ public function WithCssStyle($css_style){ $this->css_style = $css_style; return $this; }

	private $css_class = null;
	/** @return static */ public function WithCssClass($css_class){ $this->css_class = $css_class; return $this; }

	public function Render() {
		echo '<span class="icon '.$this->base_css_class.' '.$this->css_class.'" style="'
				.($this->size===null?'':'font-size:'.$this->size.'px;')
				.$this->css_style.'"'
				.($this->title===null?'':' title="'.new Html($this->title).'"')
				.'>&#x'.sprintf('%x',$this->code).';</span>';
	}
}


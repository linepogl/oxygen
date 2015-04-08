<?php

class Glyph extends _Icon {
	private $code;
	private $base_css_class;
	public function __construct($base_css_class,$code){
		$this->base_css_class = $base_css_class;
		$this->code = $code;
	}

	public function Render() {
		$class='icon'.($this->base_css_class==''?'':' '.$this->base_css_class).($this->css_class==''?'':' '.$this->css_class); if($class!='')$class=' class="'.$class.'"';
		$style=($this->size===null?'':'font-size:'.$this->size.'px;').$this->css_style; if($style!='')$style=' style="'.$style.'"';
		echo '<span'.$class.$style
				.($this->title===null?'':' title="'.new Html($this->title).'"')
				.'>&#x'.sprintf('%x',$this->code).';</span>';
	}
}


<?php

class Icon extends _Icon {
	private $icon_name;
	private $icon_type;
	public function __construct($icon_name,$size=16,$icon_type=null){
		$this->icon_name = $icon_name;
		$this->size = $size;
		$this->icon_type = $icon_type===null ? Oxygen::GetDefaultIconType() : $icon_type;
	}
	public function Render() {
		$size = $this->size===null ? 16 : $this->size;
		echo '<img class="icon'.$this->css_class.'"'
				.($this->css_style==''?'':' style="'.$this->css_style.'"')
				.($this->title===null?'':' title="'.new Html($this->title).'" alt="'.new Html($this->title).'"')
				.' src="'.$this->icon_name.$this->size.'.'.$this->icon_type.'" width="'.$size.'" height="'.$size.'" />';
	}
}

<?php

class Spacer extends Control {
	private $width;
	private $height;

	public function __construct($width=1,$height=1) {
		$this->width = $width;
		$this->height = $height;
	}

	public function Render(){
		echo '<img src="oxy/img/spacer.gif" style="width:'.$this->width.'px;height:'.$this->height.'px;" alt="" />';
	}
}



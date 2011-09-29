<?php

class Icon extends Control {

	private $iconname;
	private $iconsize;
	private $icontype;
	public function __construct($iconname,$iconsize=16,$icontype='gif'){
		$this->iconname = $iconname;
		$this->iconsize = $iconsize;
		$this->icontype = $icontype;
	}
	public function Render() {
		echo '<img class="icon" src="'.$this->iconname.$this->iconsize.'.'.$this->icontype.'" width="'.$this->iconsize.'" height="'.$this->iconsize.'" alt="" />';
	}


}


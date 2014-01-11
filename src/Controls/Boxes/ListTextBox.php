<?php

class ListTextBox extends Box {

	private $width = '100%';
	public function WithWidth($value){ $this->width = $value; return $this; }

	private $height = '10px';
	public function WithHeight($value){ $this->width = $value; return $this; }

	private $css_style = '';
	public function WithCssStyle($value){ $this->css_style = $value; return $this; }

	private $css_class = '';
	public function WithCssClass($value){ $this->css_class = $value; return $this; }


	public function Render(){

		$ns = $this->mode !== UIMode::Edit || $this->readonly ? 'x'.Oxygen::HashRandom32() : $this->name;

		TextBox::Make($ns,$this->value)->WithHttpName($ns)->WithWidth($this->width)->WithReadOnly($this->readonly || $this->mode !== UIMode::Edit)->Render();

		echo Js::BEGIN;
		echo "jQuery('#$ns').tagsInput({defaultText:'+',width:".new Js($this->width).",height:".new Js($this->height).",interactive:".new Js(!$this->readonly && $this->mode==UIMode::Edit).",cssClass:".new Js($this->readonly?'formLocked':($this->mode==UIMode::Edit?'formPane':''))."});";
		echo Js::END;

	}
}




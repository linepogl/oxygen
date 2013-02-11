<?php

class HiddenBox extends Box {

	private $debug = false;
	public function WithDebug($value){ $this->debug = $value; return $this; }

	public function Render(){
		echo '<input type="'.($this->debug?'text':'hidden').'" id="'.$this->name.'"';
		if ($this->mode == UIMode::Edit) echo ' name="'.$this->name.'"';
		echo ' value="'.new Html(rawurldecode(new Url($this->value))).'" />';
	}


}


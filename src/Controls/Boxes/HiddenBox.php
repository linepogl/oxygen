<?php

class HiddenBox extends Box {

	private $debug = false;
	public function WithDebug($value){ $this->debug = $value; return $this; }

	private $css_class = null;
	public function WithCssClass($value){ $this->css_class = $value; return $this; }

	public function Render(){
		echo '<input type="'.($this->debug?'text':'hidden').'" id="'.$this->name.'"';
		if ($this->mode == UIMode::Edit && !empty($this->http_name)) echo ' name="'.$this->name.'"';
		if (!empty($this->css_class)) echo ' class="'.$this->css_class.'"';
		echo ' value="'.new Html(new Val($this->value)).'" />';
	}


}


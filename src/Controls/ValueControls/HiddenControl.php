<?php

/** @deprecated Use HiddenBox instead */
class HiddenControl extends ValueControl {

	public function Render(){
		echo '<input type="hidden" id="'.$this->name.'"';
		if ($this->mode == UIMode::Edit && !empty($this->http_name)) echo ' name="'.$this->name.'"';
		echo ' value="'.new Html(new Val($this->value)).'" />';
	}


}


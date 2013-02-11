<?php

/** @deprecated */
class HiddenControl extends ValueControl {

	public function Render(){
		echo '<input type="hidden" id="'.$this->name.'"';
		if ($this->mode == UIMode::Edit) echo ' name="'.$this->name.'"';
		echo ' value="'.new Html(rawurldecode(new Url($this->value))).'" />';
	}


}


<?php

/** @deprecated Use TextBox WithIsPassword(true) instead */
class PasswordControl extends ValueControl {

 	private $width = '100%';
	public function WithWidth($value){ $this->width = $value; return $this; }
		
	public function Render(){
		if ($this->mode == UIMode::Edit){
			echo '<input type="password" id="'.$this->name.'"';
			echo ' name="'.$this->name.'"';
			echo ' class="formPane"';
			echo ' style="width:'.(empty($this->width)?'auto':$this->width).'"';
			echo ' value="'.new Html($this->value).'"';
			echo ' />';
		}
		else {
			echo '*****';
		}
	}

	
}

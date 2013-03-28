<?php

/** @deprecated Use CheckBox instead */
class CheckboxControl extends ValueControl {

	private $show_label = false;
	public function WithShowLabel($value){ $this->show_label = $value; return $this; }

	private $on_change = '';
	public function WithOnChange($value){ $this->on_change = $value; return $this; }

	public function Render(){
		if ($this->mode == UIMode::Edit){
			echo new HiddenControl($this->name,$this->value);
			echo Js::BEGIN;
			echo $this->name . "_OnClick = function(){";
			echo "var x = \$(".new Js($this->name).");";
			echo "x.value = x.value=='true'?'false':'true';";
			echo $this->on_change;
			echo "};";
			echo Js::END;
		}
		echo '<input class="formCheck" type="checkbox" id="'.$this->name.'_chk"';
		if ($this->mode != UIMode::Edit)
			echo ' disabled="disabled"';
		if ($this->value) echo ' checked="checked"';
		echo ' onclick="'.$this->name.'_OnClick();"';
		echo ' />';
		if ($this->show_label)
			echo '<label for="'.$this->name.'_chk">'.new Html($this->label).'</label>';
	}


}


<?php

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
			echo "\$(".new Js($this->name).").value = \$(".new Js($this->name.'_chk').").checked?'true':'false';";
			echo $this->on_change;
			echo "};";
			echo Js::END;
		}
		echo '<input type="checkbox" id="'.$this->name.'_chk"';
		if ($this->mode == UIMode::Edit)
			echo ' name="'.$this->name.'"';
		else
			echo ' disabled="disabled"';
		if ($this->value) echo ' checked="checked"';
		echo ' onclick="'.$this->name.'_OnClick();"';
		echo ' value="'.new Url(true).'" />';
		if ($this->show_label)
			echo '<label for="'.$this->name.'_chk">'.new Html($this->label).'</label>';
	}


}

?>
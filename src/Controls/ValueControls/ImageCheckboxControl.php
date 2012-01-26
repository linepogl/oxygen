<?php

class ImageCheckboxControl extends ValueControl {

	private $show_label = false;
	public function WithShowLabel($value){ $this->show_label = $value; return $this; }

	private $icon = null;
	public function WithIcon($value){ $this->icon = $value; return $this; }

	private $on_change = null;
	public function WithOnChange($value){ $this->on_change = $value; return $this; }

	private $checked_image = 'oxy/img/Checked.gif';
	public function WithCheckedImage($value){ $this->checked_image = $value; return $this; }

	private $unchecked_image = 'oxy/img/Unchecked.gif';
	public function WithUncheckedImage($value){ $this->unchecked_image = $value; return $this; }

	private $checked_readonly_image = 'oxy/img/CheckedReadonly.gif';
	public function WithCheckedReadonlyImage($value){ $this->checked_readonly_image = $value; return $this; }

	private $unchecked_readonly_image = 'oxy/img/UncheckedReadonly.gif';
	public function WithUncheckedReadonlyImage($value){ $this->unchecked_readonly_image = $value; return $this; }

	private $is_dirty = false;
	public function WithIsDirty($value) { $this->is_dirty = $value; return $this; }

	private $style = '';
	public function WithStyle($value){ $this->style=$value; return $this; }

	private $is_readonly = false;
	public function WithReadOnly($value){ $this->is_readonly = $value; return $this; }

	public function Render(){

		echo HiddenControl::Make($this->name,$this->value);
		if ($this->mode == UIMode::Edit && !$this->is_readonly){
			echo '<a class="imagecheckbox" href="javascript:'.$this->name.'_Toggle();" style="white-space:nowrap;'.$this->style.'"><img id="'.$this->name.'_img" src="'.($this->is_dirty ? ($this->value ? $this->checked_readonly_image : $this->unchecked_readonly_image) : ($this->value ? $this->checked_image : $this->unchecked_image)) . '" alt="" />';
			if ($this->show_label){
				if (!is_null($this->icon)) echo $this->icon . new Spacer(3);
				echo new Html($this->label);
			}
			echo '</a>';
		}
		else {
			echo '<span class="imagecheckbox" style="white-space:nowrap;'.$this->style.'">';
			echo '<img src="'.($this->value ? $this->checked_readonly_image : $this->unchecked_readonly_image) . '" alt="" />';
			if ($this->show_label) {
				if (!is_null($this->icon)) echo $this->icon . new Spacer(3);
				echo new Html($this->label);
			}
			echo '</span>';
		}


		echo Js::BEGIN;
		echo "var ".$this->name . "_is_dirty = ".new Js($this->is_dirty).";";
		echo $this->name . "_SetValue = function(value){";
		echo "changed = $(".new Js($this->name).").value != value;";
		echo "$(".new Js($this->name).").value = value;";
		echo "if (".$this->name."_is_dirty){";
		echo "$(".new Js($this->name.'_img').").src= $(".new Js($this->name).").value=='true' ? ".new Js($this->checked_readonly_image)." : ".new Js($this->unchecked_readonly_image).";";
		echo "}";
		echo "else {";
		echo "$(".new Js($this->name.'_img').").src= $(".new Js($this->name).").value=='true' ? ".new Js($this->checked_image)." : ".new Js($this->unchecked_image).";";
		echo "}";
		echo "if (changed){";
		echo $this->on_change;
		echo "}";
		echo "};";
		echo $this->name . "_IsDirty = function(){";
		echo "return ".$this->name . "_is_dirty;";
		echo "};";
		echo $this->name . "_SetDirty = function(dirty){";
		echo $this->name . "_is_dirty = dirty;";
		echo $this->name."_SetValue(\$F(".new Js($this->name)."));";
		echo "};";
		echo $this->name . "_Toggle = function(){";
		echo $this->name."_SetValue(\$F(".new Js($this->name).")=='true' ? 'false' : 'true');";
		echo "};";
		echo Js::END;

	}


}


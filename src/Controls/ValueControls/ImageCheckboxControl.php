<?php

class ImageCheckboxControl extends ValueControl {

	private $show_label = false;
	public function WithShowLabel($value){ $this->show_label = $value; return $this; }

	private $icon = null;
	public function WithIcon($value){ $this->icon = $value; return $this; }

	private $on_change = null;
	public function WithOnChange($value){ $this->on_change = $value; return $this; }

//	private $checked_image = 'oxy/img/Checked.gif';
//	public function WithCheckedImage($value){ $this->checked_image = $value; return $this; }
//
//	private $unchecked_image = 'oxy/img/Unchecked.gif';
//	public function WithUncheckedImage($value){ $this->unchecked_image = $value; return $this; }
//
//	private $checked_readonly_image = 'oxy/img/CheckedReadonly.gif';
//	public function WithCheckedReadonlyImage($value){ $this->checked_readonly_image = $value; return $this; }
//
//	private $unchecked_readonly_image = 'oxy/img/UncheckedReadonly.gif';
//	public function WithUncheckedReadonlyImage($value){ $this->unchecked_readonly_image = $value; return $this; }

	private $is_dirty = false;
	public function WithIsDirty($value) { $this->is_dirty = $value; return $this; }

	private $style = '';
	public function WithStyle($value){ $this->style=$value; return $this; }

	private $is_readonly = false;
	public function WithReadOnly($value){ $this->is_readonly = $value; return $this; }

	public function Render(){

		echo HiddenControl::Make($this->name,$this->value);
		$readonly = $this->is_readonly || $this->mode != UIMode::Edit;
		$mode = ( $readonly ? 'readonly-' : '' ) . ( $this->is_dirty ? 'dirty-' : '' ) . ( $this->value ? 'checked' : 'unchecked' );

		if ($readonly)
			echo '<span class="checkbox-anchor" style="'.$this->style.'">';
		else
			echo '<a class="checkbox-anchor" href="javascript:'.$this->name.'_Toggle();" style="'.$this->style.'">';

		echo '<img src="oxy/img/spacer.gif" class="checkbox checkbox-'.$mode.'" id="'.$this->name.'-check" />';
		if ($this->show_label){
			if (!is_null($this->icon)) echo $this->icon . new Spacer(3);
			echo new Html($this->label);
		}

		if ($readonly)
			echo '</span>';
		else
			echo '</a>';



		echo Js::BEGIN;
		echo $this->name .'={';
		echo "  is_readonly:".new Js($readonly);
		echo " ,is_dirty:".new Js($this->is_dirty);
		echo " ,SetValue:function(value){";
		echo "    var old = this.GetValue();";
		echo "    $(".new Js($this->name).").value = value ? ".new Js(strval(new Url(true)))." : ".new Js(strval(new Url(false))).";";
		echo "    $(".new Js($this->name.'-check').").className = 'checkbox checkbox-' + ( this.is_readonly ? 'readonly-' : '' ) + ( this.is_dirty ? 'dirty-' : '' ) + ( value ? 'checked' : 'unchecked' );";
		echo "    if (old!=value){".$this->on_change."}";
		echo "  }";
		echo " ,GetValue:function(){";
		echo "    return \$F(".new Js($this->name).") == ".new Js(strval(new Url(true))).";";
		echo "  }";
		echo " ,IsDirty:function(){";
		echo "    return ".$this->name.".is_dirty;";
		echo "  }";
		echo " ,SetDirty:function(dirty){";
		echo "    ".$this->name.".is_dirty = dirty;";
		echo "    ".$this->name.".SetValue(\$F(".new Js($this->name)."));";
		echo "  }";
		echo " ,Toggle:function(){";
		echo "    ".$this->name.".SetValue(\$F(".new Js($this->name).")!='true');";
		echo "  }";
		echo "};";


		/// Backwards compatibility:
		echo $this->name . "_SetValue = function(value){".$this->name.".SetValue(value=='true');};";
		echo $this->name . "_IsDirty = ".$this->name.".IsDirty;";
		echo $this->name . "_SetDirty = ".$this->name.".SetDirty;";
		echo $this->name . "_Toggle = ".$this->name.".Toggle;";
		//////////


		echo Js::END;

	}


}


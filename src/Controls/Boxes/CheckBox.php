<?php

class CheckBox extends Box {

	private $show_label = false;
	public function WithShowLabel($value){ $this->show_label = $value; return $this; }

	private $is_rich = false;
	public function WithIsRich($value){ $this->is_rich = $value; return $this; }

	private $is_dirty = false;
	public function WithIsDirty($value) { $this->is_dirty = $value; return $this; }

	private $css_style = '';
	public function WithCssStyle($value){ $this->css_style=$value; return $this; }

	private $css_class = '';
	public function WithCssClass($value){ $this->css_class = $value; return $this; }

	private $list_name = null;
	public function WithListName($value){ $this->list_name = $value; return $this; }

	private $list_value = null;
	public function WithListValue($value){ $this->list_value = $value; return $this; }


	public function Render(){

		$readonly = $this->readonly || $this->mode != UIMode::Edit;
		$mode = ( $readonly ? 'readonly-' : '' ) . ( $this->is_dirty ? 'dirty-' : '' ) . ( $this->value ? 'checked' : 'unchecked' );

		echo HiddenBox::Make($this->name,$this->value)->WithHttpName($readonly?null:$this->http_name)->WithCssClass(empty($this->list_name)?'':'list-'.$this->list_name);

		echo '<a class="checkbox-anchor '.$this->css_class.'" href="javascript:'.($readonly?';':'window.'.$this->name.'.Toggle();').'" style="'.$this->css_style.'">';

		echo '<img src="oxy/img/spacer.gif" class="checkbox checkbox-'.$mode.'" id="'.$this->name.'-check" />';
		if ($this->show_label){
			if ($this->is_rich)
				echo $this->label;
			else
				echo '<span class="text">'.new Html($this->label).'</span>';
		}

		echo '</a>';

		if (!$readonly) {
		echo Js::BEGIN;
			echo "window.".$this->name .'={';
			echo "  is_readonly:".new Js($readonly);
			echo " ,is_dirty:".new Js($this->is_dirty);
			echo " ,list_value:".new Js(new Val($this->list_value));
			echo " ,SetValue:function(value){";
			echo "    var old = this.GetValue();";
			echo "    jQuery('#$this->name').val( value ? ".new Js(new Val(true))." : ".new Js(new Val(false))." );";
			echo "    this.Update();";
			echo "    if (old!=value) this.OnChange();";
			echo "  }";
			echo " ,GetValue:function(){";
			echo "    return jQuery('#$this->name').val() == ".new Js(new Val(true)).";";
			echo "  }";
			echo " ,GetListValue:function(){";
			echo "    return this.list_value;";
			echo "  }";
			echo " ,Update:function(){";
			echo "    var value = this.GetValue();";
			echo "    $(".new Js($this->name.'-check').").className = 'checkbox checkbox-' + ( this.is_readonly ? 'readonly-' : '' ) + ( this.is_dirty ? 'dirty-' : '' ) + ( value ? 'checked' : 'unchecked' );";
			echo "  }";
			echo " ,IsDirty:function(){";
			echo "    return ".$this->name.".is_dirty;";
			echo "  }";
			echo " ,SetDirty:function(dirty){";
			echo "    ".$this->name.".is_dirty = dirty;";
			echo "    this.Update();";
			echo "  }";
			echo " ,Toggle:function(){";
			echo "    ".$this->name.".SetValue(jQuery('#$this->name').val()!='true');";
			echo "  }";
			echo " ,OnChange:function(){";
			if (!is_null($this->list_name)) echo "$this->list_name.OnChangeOne();";
			echo $this->on_change;
			echo "  }";
			echo "};";
			echo Js::END;
		}
	}


}


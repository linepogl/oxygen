<?php

class CheckBox extends Box {

	private $show_label = false;
	public function WithShowLabel($value){ $this->show_label = $value; return $this; }

	private $is_rich = false;
	public function WithIsRich($value){ $this->is_rich = $value; return $this; }

	private $is_button = false;
	public function WithIsButton( $value ) { $this->is_button = $value; return $this; }

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
		$ns = $this->name;
		ob_start();

		$readonly = $this->readonly || $this->mode != UIMode::Edit;
		echo HiddenBox::Make($ns,$this->value)->WithHttpName($readonly?null:$this->http_name)->WithCssClass(empty($this->list_name)?'':'list-'.$this->list_name);

		if ($readonly) {
			$class='checkbox checkbox-anchor'.($this->css_class==''?'':' '.$this->css_class); if($class!='')$class=' class"'.$class.'"';
			$style=$this->css_style; if($style!='')$style=' style"'.$style.'"';
			echo '<span'.$class.$style.'>';
			if ($this->readonly)
				echo $this->is_dirty ? oxy::icoBoxDirtyLocked() : ( $this->value ? oxy::icoBoxCheckedLocked() : oxy::icoBoxUncheckedLocked() );
			else
				echo $this->is_dirty ? oxy::icoMinus() : ( $this->value ? oxy::icoYes() : oxy::icoNo() );
			if ($this->show_label) echo $this->is_rich ? $this->label : '<span class="text spacer2">'.new Html($this->label).'</span>';
			echo '</span>';
		}
		else {
			if ($this->is_button) {
				echo ButtonBox::Make()->WithCssClass(' '.$this->css_class)->WithCssStyle($this->css_style)->WithIsRich(true)->WithOnClick('window.'.$ns.'.Toggle();')
					->WithValue(
						'<span class="checkbox checkbox-anchor">'
						.'<span id="'.$ns.'-box">'.($this->is_dirty?oxy::icoBoxDirty():($this->value?oxy::icoBoxChecked():oxy::icoBoxUnchecked())).'</span>'
						.($this->show_label?($this->is_rich?$this->label:'<span class="text spacer2">'.new Html($this->label).'</span>') : '')
						.'</span>'
						);
			}
			else {
				$class='checkbox checkbox-anchor'.($this->css_class==''?'':' '.$this->css_class); if($class!='')$class=' class"'.$class.'"';
				$style=$this->css_style; if($style!='')$style=' style"'.$style.'"';
				echo '<a'.$class.$style.' href="javascript:window.'.$ns.'.Toggle();">';
				echo '<span id="'.$ns.'-box">';
				echo $this->is_dirty?oxy::icoBoxDirty():($this->value?oxy::icoBoxChecked():oxy::icoBoxUnchecked());
				echo '</span>';
				if ($this->show_label) echo $this->is_rich?$this->label:'<span class="text spacer2">'.new Html($this->label).'</span>';
				echo '</a>';
			}

			echo Js::BEGIN;
			$list_value = strval(new Val($this->list_value));
			echo "Oxygen.CheckBox({ns:".new Js($ns);
			echo ",ico_checked:".new Js(oxy::icoBoxChecked());
			echo ",ico_unchecked:".new Js(oxy::icoBoxUnchecked());
			echo ",ico_dirty:".new Js(oxy::icoBoxDirty());
			if($this->is_dirty)      echo ",is_dirty:".new Js($this->is_dirty);
			if($this->list_name!='') echo ",list_ns:".new Js($this->list_name);
			if($list_value!='')      echo ",list_value:".new Js($list_value);
			if($this->on_change!='') echo ",on_change:function(){{$this->on_change}}";
			echo "});";
			echo Js::END;

			//echo Js::BEGIN;
			//echo "window.".$ns .'={';
			//echo "  is_dirty:".new Js($this->is_dirty);
			//echo " ,list_value:".new Js(new Val($this->list_value));
			//echo " ,SetValue:function(value){";
			//echo "    var old = this.GetValue();";
			//echo "    jQuery('#$ns').val( value ? ".new Js(new Val(true))." : ".new Js(new Val(false))." );";
			//echo "    this.Update();if(old!=value)this.OnChange();";
			//echo "  }";
			//echo " ,GetValue:function(){return jQuery('#$ns').val()==".new Js(new Val(true)).";}";
			//echo " ,GetListValue:function(){return this.list_value;}";
			//echo " ,Update:function(){jQuery('#$ns-box').html(this.is_dirty?".new Js(oxy::icoBoxDirty()).":this.GetValue()?".new Js(oxy::icoBoxChecked()).":".new Js(oxy::icoBoxUnchecked()).");}";
			//echo " ,IsDirty:function(){return this.is_dirty;}";
			//echo " ,SetDirty:function(dirty){ this.is_dirty=dirty;this.Update();}";
			//echo " ,Toggle:function(){ this.SetValue(jQuery('#$ns').val()!=".new Js(new Val(true)).");}";
			//echo " ,OnChange:function(){".($this->list_name===null?'':"$this->list_name.OnChangeOne();")."$this->on_change;jQuery('#$ns').trigger('change');}";
			//echo "};";
			//echo Js::END;
		}

		$r = ob_get_clean();
		echo $r;
		static $inst = 0;
		static $total = 0;
		$inst++;
		$total += strlen($r);
		error_log('CheckBox #'.$inst.':'.$total);

	}
}


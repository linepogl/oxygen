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

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $css_style = '';
	public function WithCssStyle($value){ $this->css_style=$value; return $this; }

	private $css_class = '';
	public function WithCssClass($value){ $this->css_class = $value; return $this; }

	private $list_names = [];
	public function WithListName($value){ $this->list_names[] = $value instanceof Control ? $value->name : strval($value); return $this; }
	public function WithListNames(){ foreach (func_get_args() as $value) $this->list_names[] = $value instanceof Control ? $value->name : strval($value); return $this; }
	public function WithList($value){ $this->list_names[] = $value instanceof Control ? $value->name : strval($value); return $this; }
	public function WithLists(){ foreach (func_get_args() as $value) $this->list_names[] = $value instanceof Control ? $value->name : strval($value); return $this; }

	private $list_value = null;
	public function WithListValue($value){ $this->list_value = $value; return $this; }

	private $optgroup_name = null;
	public function WithOptGroup($value){ $this->optgroup_name = $value instanceof Control ? $value->name : strval($value); return $this; }
	public function WithOptGroupName($value){ $this->optgroup_name = $value instanceof Control ? $value->name : strval($value); return $this; }


	public function Render(){
		$ns = $this->name;
		ob_start();

		$readonly = $this->readonly || $this->mode != UIMode::Edit;
		$allow_null = $this->allow_null && $this->optgroup_name === null; // cannot have both !

		$list_css_classes = implode(' ',array_map(function($x){return'list-'.$x;},$this->list_names));
		echo HiddenBox::Make($ns,$this->value)->WithHttpName($readonly?null:$this->http_name)->WithCssClass($list_css_classes.($this->optgroup_name===null?'':' optgroup-'.$this->optgroup_name));



		if ($this->mode !== UIMode::Edit) {
			if ($this->is_dirty)
				$ico = oxy::icoMinus();
			elseif (!$allow_null)
				$ico = $this->value ? oxy::icoYes() : oxy::icoNo();
			elseif ($this->value !== null)
				$ico = oxy::icoSpacer();
			else
				$ico = $this->value === true ? oxy::icoYes() : oxy::icoNo();
		}
		elseif ($this->readonly) {
			if ($this->optgroup_name !== null) {
				if ($this->is_dirty)
					$ico = oxy::icoOptionDirtyLocked();
				else
					$ico = $this->value?oxy::icoOptionCheckedLocked():oxy::icoOptionUncheckedLocked();
			}
			else {
				if ($this->is_dirty)
					$ico = oxy::icoBoxDirtyLocked();
				elseif (!$allow_null)
					$ico = $this->value ? oxy::icoBoxCheckedLocked() : oxy::icoBoxUncheckedLocked();
				elseif ($this->value === null)
					$ico = oxy::icoBoxUncheckedLocked();
				else
					$ico = $this->value === true ? oxy::icoBoxCheckedLocked() : oxy::icoBoxCheckedFalseLocked();
			}
		}
		else {
			if ($this->optgroup_name !== null) {
				if ($this->is_dirty)
					$ico = oxy::icoOptionDirty();
				else
					$ico = $this->value ? oxy::icoOptionChecked() : oxy::icoOptionUnchecked();
			}
			else {
				if ($this->is_dirty)
					$ico = oxy::icoBoxDirty();
				elseif (!$allow_null)
					$ico = $this->value ? oxy::icoBoxChecked() : oxy::icoBoxUnchecked();
				elseif ($this->value === null)
					$ico = oxy::icoBoxUnchecked();
				else
					$ico = $this->value === true ? oxy::icoBoxChecked() : oxy::icoBoxCheckedFalse();
			}
		}







		if ($readonly) {
			$class='checkbox checkbox-anchor'.($this->css_class==''?'':' '.$this->css_class); if($class!='')$class=' class="'.$class.'"';
			$style=$this->css_style; if($style!='')$style=' style="'.$style.'"';
			echo '<span'.$class.$style.'>';
			echo $ico;
			if ($this->show_label) echo $this->is_rich ? $this->label : '<span class="text spacer2">'.new Html($this->label).'</span>';
			echo '</span>';
		}
		else {
			if ($this->is_button) {
				echo ButtonBox::Make()->WithCssClass(' '.$this->css_class)->WithCssStyle($this->css_style)->WithIsRich(true)->WithOnClick('window.'.$ns.($this->optgroup_name===null?'.Toggle()':'.Check()').';')
					->WithValue(
						'<span class="checkbox checkbox-anchor">'
						.'<span id="'.$ns.'-box">'.$ico.'</span>'
						.($this->show_label?($this->is_rich?$this->label:'<span class="text spacer2">'.new Html($this->label).'</span>') : '')
						.'</span>'
						);
			}
			else {
				$class='checkbox checkbox-anchor'.($this->css_class==''?'':' '.$this->css_class); if($class!='')$class=' class="'.$class.'"';
				$style=$this->css_style; if($style!='')$style=' style="'.$style.'"';
				echo '<a'.$class.$style.' href="javascript:window.'.$ns.($this->optgroup_name===null?'.Toggle()':'.Check()').';">';
				echo '<span id="'.$ns.'-box">'.$ico.'</span>';
				if ($this->show_label) echo $this->is_rich?$this->label:'<span class="text spacer2">'.new Html($this->label).'</span>';
				echo '</a>';
			}

			echo Js::BEGIN;
			$list_value = strval(new Val($this->list_value));
			echo "Oxygen.CheckBox({ns:".new Js($ns);
			if ($this->optgroup_name === null) {
				echo ",ico_checked:".new Js(oxy::icoBoxChecked());
				echo ",ico_checked_false:".new Js(oxy::icoBoxCheckedFalse());
				echo ",ico_unchecked:".new Js(oxy::icoBoxUnchecked());
				echo ",ico_dirty:".new Js(oxy::icoBoxDirty());
			}
			else {
				echo ",ico_checked:".new Js(oxy::icoOptionChecked());
				echo ",ico_unchecked:".new Js(oxy::icoOptionUnchecked());
				echo ",ico_dirty:".new Js(oxy::icoOptionDirty());
			}
			if($this->allow_null) echo ",allow_null:".new Js($this->allow_null);
			if($this->optgroup_name!==null) echo ",optgroup_ns:".new Js($this->optgroup_name);
			if($this->is_dirty) echo ",is_dirty:".new Js($this->is_dirty);
			if(!empty($this->list_names)) echo ",list_ns:".new Js($this->list_names);
			if($list_value!='') echo ",list_value:".new Js($list_value);
			if($this->on_change!='') echo ",on_change:function(){{$this->on_change}}";
			echo "});";
			echo Js::END;
		}

		$r = ob_get_clean();
		echo $r;
		static $inst = 0;
		static $total = 0;
		$inst++;
		$total += strlen($r);

	}
}


<?php

class ListCheckBox extends Box {

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

	private $all_values = null;
	public function WithAllValues($value){ $this->all_values = $value; return $this; }

	public function Render(){

		echo HiddenBox::Make($this->name,$this->value)->WithHttpName($this->http_name);
		echo CheckBox::Make($this->name.'_all',false)->WithHttpName('')->WithOnChange("window.$this->name.OnChangeAll();")->WithLabel($this->label)->WithShowLabel($this->show_label)->WithCssClass($this->css_class)->WithCssStyle($this->css_style);

		echo Js::BEGIN;
		echo "window.$this->name = {";
		echo "  running : false";
		echo " ,all_values_are_fixed : ".new Js(!is_null($this->all_values));
		echo " ,all_values : ".new Js($this->all_values);
		echo " ,selected_values : []";
		echo " ,IsChecked : function(){ return {$this->name}_all.GetValue(); }";
		echo " ,Check : function(value){ {$this->name}_all.SetValue(value); }";
		echo " ,Toggle : function(value){ {$this->name}_all.SetValue( !{$this->name}_all.GetValue() ); }";
		echo " ,CountSelected : function(){";
		echo "    return this.selected_values.length;";
		echo "  }";
		echo " ,Invalidate : function(){";
		echo "    if (!this.all_values_are_fixed) this.all_values = null;";
		echo "    this.OnChangeAll();";
		echo "  }";
		echo " ,Init : function(){";
		echo "    if (this.all_values !== null) return;";
		echo "    this.all_values = [];";
		echo "    jQuery('.list-$this->name').each(function(){var x;eval('x='+this.id);";
		echo "      $this->name.all_values.push(x.GetListValue());";
		echo "    });";
		echo "  }";
		echo " ,Update : function(){";
		echo "    this.Init();";
		echo "    var s = '';";
		echo "    for (var i = 0; i < this.selected_values.length; i++)";
		echo "      s +=(i>0?',':'')+this.selected_values[i];";
		echo "    var all = this.selected_values.length == this.all_values.length;";
		echo "    var any = this.selected_values.length > 0;";
		echo "    {$this->name}_all.SetValue(any);";
		echo "    {$this->name}_all.SetDirty(any&&!all);";
		echo "    var old = jQuery('#$this->name').val();";
		echo "    jQuery('#$this->name').val(s);";
		echo "    if (old != s) this.OnChange();";
		echo "  }";
		echo " ,OnChangeAll : function(){";
		echo "    if(this.running) return;";
		echo "    this.running = true;";
		echo "    this.Init();";
		echo "    var v = {$this->name}_all.GetValue();";
		echo "    jQuery('.list-$this->name').each(function(){var x;eval('x='+this.id);";
		echo "      x.SetValue(v);";
		echo "    });";
		echo "    this.selected_values = v ? this.all_values : [];";
		echo "    this.Update();";
		echo "    this.running = false;";
		echo "  }";
		echo " ,OnChangeOne : function(){";
		echo "    if(this.running) return;";
		echo "    this.running = true;";
		echo "    this.Init();";
		echo "    var a = {};";
		echo "    for (var i = 0; i < this.all_values.length; i++) a[this.selected_values[i]] = false;";
		echo "    for (var i = 0; i < this.selected_values.length; i++) a[this.selected_values[i]] = true;";
		echo "    jQuery('.list-$this->name').each(function(){var x;eval('x='+this.id);";
		echo "      a[x.GetListValue()] = x.GetValue();";
		echo "    });";
		echo "    this.selected_values = [];";
		echo "    for (var key in a) if (a[key]) this.selected_values.push(key);";
		echo "    this.Update();";
		echo "    this.running = false;";
		echo "  }";
		echo " ,OnChange : function(){";
		echo $this->on_change;
		echo "  }";
		echo "};";
		echo Js::END;

	}
}


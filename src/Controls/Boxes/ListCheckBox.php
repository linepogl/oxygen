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

	public function Render(){

		echo HiddenBox::Make($this->name,$this->value)->WithHttpName($this->http_name);
		echo CheckBox::Make($this->name.'_all',false)->WithHttpName('')->WithOnChange("window.$this->name.OnChangeAll();");

		echo Js::BEGIN;
		echo "window.$this->name = {";
		echo "  running : false";
		echo " ,IsChecked : function(){ return {$this->name}_all.GetValue(); }";
		echo " ,Check : function(value){ {$this->name}_all.SetValue(value); }";
		echo " ,CountSelected : function(){";
		echo "    var r = 0;";
		echo "    jQuery('.list-$this->name').each(function(){var x;eval('x='+this.id);";
		echo "      if (x.GetValue()) r++;";
		echo "    });";
		echo "    return r;";
		echo "  }";
		echo " ,Update : function(){";
		echo "    var s = '';";
		echo "    var all = true;";
		echo "    var any = false;";
		echo "    jQuery('.list-$this->name').each(function(){var x;eval('x='+this.id);";
		echo "      if (x.GetValue()) {";
		echo "        if(s!='')s+=',';";
		echo "        s+=x.GetListValue();";
		echo "        any = true;";
		echo "      }";
		echo "      else all = false;";
		echo "    });";
		echo "    {$this->name}_all.SetValue(any);";
		echo "    {$this->name}_all.SetDirty(any&&!all);";
		echo "    var old = jQuery('#$this->name').val();";
		echo "    jQuery('#$this->name').val(s);";
		echo "    if (old != s) this.OnChange();";
		echo "  }";
		echo " ,OnChangeAll : function(){";
		echo "    if(this.running) return;";
		echo "    this.running = true;";
		echo "    var v = {$this->name}_all.GetValue();";
		echo "    jQuery('.list-$this->name').each(function(){var x;eval('x='+this.id);";
		echo "      x.SetValue(v);";
		echo "    });";
		echo "    this.Update();";
		echo "    this.running = false;";
		echo "  }";
		echo " ,OnChangeOne : function(){";
		echo "    if(this.running) return;";
		echo "    this.running = true;";
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


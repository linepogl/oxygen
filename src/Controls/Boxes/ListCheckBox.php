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

	private $is_button = false;
	public function WithIsButton( $value ) { $this->is_button = $value; return $this; }

	private $debug = false;
	public function WithDebug( $value ) { $this->debug = $value; return $this; }

	public function Render(){
		$ns = $this->name;

		echo HiddenBox::Make($this->name,$this->value)->WithHttpName($this->http_name)->WithDebug($this->debug);
		echo CheckBox::Make($ns.'_all',false)->WithHttpName('')->WithOnChange("window.$ns.OnChangeAll();")->WithLabel($this->label)->WithShowLabel($this->show_label)->WithCssClass($this->css_class)->WithCssStyle($this->css_style)->WithMode($this->mode)->WithReadOnly($this->readonly)->WithIsRich($this->is_rich)->WithIsButton($this->is_button);

		echo Js::BEGIN;
		echo "window.$ns = {";
		echo "  running : false";
		echo " ,all_values_are_fixed : ".new Js(!is_null($this->all_values));
		echo " ,all_values : ".new Js($this->all_values);
		echo " ,selected_values : []";
		echo " ,IsChecked : function(){ return {$ns}_all.GetValue(); }";
		echo " ,Check : function(value){ {$ns}_all.SetValue(value); }";
		echo " ,Toggle : function(value){ {$ns}_all.SetValue( !{$ns}_all.GetValue() ); }";
		echo " ,CountSelected:function(){ return this.selected_values.length; }";
		echo " ,GetAllValues:function(){return this.all_values;}";
		echo " ,GetSelectedValues:function(){return this.selected_values;}";
		echo " ,SetSelectedValues:function(a){return this.selected_values=a;this.Update();}";
		echo " ,Invalidate : function(){";
		echo "    if (!this.all_values_are_fixed) this.all_values = null;";
		echo "    if(this.running) return;";
		echo "    this.running = true;";
		echo "    this.Init();";
		echo "    jQuery('.list-$ns').each(function(){var x;eval('x='+this.id);if(!x.GetListValue)return;";
		echo "      var list_value = x.GetListValue();";
		echo "      var found = false;";
		echo "      for (var i = 0; i < $ns.selected_values.length; i++) {";
		echo "        if ($ns.selected_values[i] === list_value) {";
		echo "          found = true;";
		echo "          break;";
		echo "        }";
		echo "      }";
		echo "      x.SetValue(found);";
		echo "    });";
		echo "    var a=[];";
		echo "    for(var i=0;i<this.selected_values.length;i++){var x=this.selected_values[i];for(var j=0;j<this.all_values.length;j++)if(x===this.all_values[j]){a.push(x);break;}}";
		echo "    this.selected_values = a;";
		echo "    this.Update();";
		echo "    this.running = false;";
		echo "  }";
		echo " ,Init : function(){";
		echo "    if (this.all_values !== null) return;";
		echo "    this.all_values = [];";
		echo "    jQuery('.list-$ns').each(function(){var x;eval('x='+this.id);if(!x.GetListValue)return;";
		echo "      $ns.all_values.push(x.GetListValue());";
		echo "    });";
		echo "  }";
		echo " ,Update : function(){";
		echo "    this.Init();";
		echo "    if(this.selected_values.length>1){"; //let's sort...
		echo "      var a = [];";
		echo "      for(var i=0;i<this.all_values.length;i++)if(jQuery.inArray(this.all_values[i],this.selected_values)>=0)a.push(this.all_values[i]);";
		echo "      this.selected_values = a;";
		echo "    }";
		echo "    var s = '';";
		echo "    for (var i = 0; i < this.selected_values.length; i++)";
		echo "      s +=(i>0?',':'')+this.selected_values[i];";
		echo "    var all = this.selected_values.length == this.all_values.length;";
		echo "    var any = this.selected_values.length > 0;";
		echo "    {$ns}_all.SetValue(any);";
		echo "    {$ns}_all.SetDirty(any&&!all);";
		echo "    var old = jQuery('#$ns').val();";
		echo "    jQuery('#$ns').val(s);";
		echo "    if (old != s) this.OnChange();";
		echo "  }";
		echo " ,OnChangeAll : function(){";
		echo "    if(this.running) return;";
		echo "    this.running = true;";
		echo "    this.Init();";
		echo "    var v = {$ns}_all.GetValue();";
		echo "    jQuery('.list-$ns').each(function(){var x=window[this.id];if(!x.GetListValue)return;";
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
		echo "    jQuery('.list-$ns').each(function(){var x=window[this.id];if(!x.GetListValue)return;";
		echo "      a[x.GetListValue()] = x.GetValue();";
		echo "    });";
		echo "    this.selected_values = [];";
		echo "    for (var key in a) if (a[key]) this.selected_values.push(key);";
		echo "    this.Update();";
		echo "    this.running = false;";
		echo "  }";
		echo " ,last_clicked_id:null";
		echo " ,SetLastClicked:function(id){ this.last_clicked_id=id; }";
		echo " ,Cascade:function(id){";
		echo "    if (this.last_clicked_id===null) return false;";
		echo "    var xa = window[this.last_clicked_id]; if(!xa.GetListValue)return false;";
		echo "    var xb = window[id]; if(!xb.GetListValue)return false;";
		echo "    if (xa===xb) return true;";
		echo "    this.running = true;";
		echo "    var v = xa.GetValue();";
		echo "    var on = false;";
		echo "    jQuery('.list-$ns').each(function(){var x=window[this.id];if(!x.GetListValue)return;";
		echo "      if (on) { x.SetValue(v); if (x === xa || x === xb) on = false; }";
		echo "      else if (x === xa || x === xb) { x.SetValue(v); on = true; }";
		echo "    });";
		echo "    this.running = false;";
		echo "    this.OnChangeOne();";
		echo "    return true;";
		echo "  }";
		echo " ,OnChange : function(){";
		echo $this->on_change;
		echo "  }";
		echo "};";
		echo Js::END;

	}
}


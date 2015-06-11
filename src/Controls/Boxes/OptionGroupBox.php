<?php

class OptionGroupBox extends Box {

	private $debug = false;
	public function WithDebug( $value ) { $this->debug = $value; return $this; }

	public function Render(){
		$ns = $this->name;

		echo HiddenBox::Make($this->name,$this->value)->WithHttpName($this->http_name)->WithDebug($this->debug);

		echo Js::BEGIN;
		echo "window.$ns = {";
		echo "  all_values : null";
		echo " ,Init : function(){ if(this.all_values!==null)return; this.all_values=[]; jQuery('.optgroup-$ns').each(function(){var x=window[this.id];if(!x.GetListValue)return;window.$ns.all_values.push(x.GetListValue());});}";
		echo " ,GetValue:function(){ return jQuery('#$ns').val(); }";
		echo " ,SetValue:function(v){ jQuery('.optgroup-$ns').each(function(){var x=window[this.id];if(!x.GetListValue)return; if(v===x.GetListValue()) { x.SetValue(true); var xx = jQuery('#$ns'); if (v!==xx.val()) { xx.val(v); $this->on_change; xx.trigger('change'); }} else x.SetValue(false); }); }";
		echo " ,GetAllValues:function(){ this.Init(); return this.all_values;}";
		echo "};";
		echo Js::END;

	}
}


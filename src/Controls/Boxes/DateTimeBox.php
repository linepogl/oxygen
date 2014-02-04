<?php

class DateTimeBox extends Box {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '∅';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

	private $show_seconds = false;
	public function WithShowSeconds($value){ $this->show_seconds = $value; return $this; }

	private $simple = false;
	public function WithSimple($value){ $this->simple = $value; return $this; }

	public function Render(){
		$readonly = $this->readonly || $this->mode != UIMode::Edit;
		echo HiddenBox::Make($this->name,$this->value)->WithHttpName($readonly ? null : $this->http_name);

		if ($readonly) {

			echo oxy::AbbrDateTime($this->value);

		}
		else {
			DateBox::Make($this->name . '_date' , $this->value )
				->WithMode($this->mode)
				->WithReadOnly($this->readonly)
				->WithAllowNull($this->allow_null)
				->WithNullCaption($this->null_caption)
				->WithOnChange('window.'.$this->name.'.UpdateD();')
				->Render();

			echo '&nbsp;';

			TimeBox::Make($this->name . '_time' , $this->value )
				->WithMode($this->mode)
				->WithReadOnly($this->readonly)
				->WithOnChange('window.'.$this->name.'.UpdateT();')
				->WithNullCaption($this->null_caption)
				->WithAllowNull($this->allow_null)
				->WithSimple($this->simple)
				->WithShowSeconds($this->show_seconds)
				->Render();


			echo Js::BEGIN;
			echo "window.$this->name = {";
			echo "  UpdateD : function(){";
			echo "    var d = jQuery('#{$this->name}_date').val();";
			echo "    var t = jQuery('#{$this->name}_time').val();";
			echo "    jQuery('#$this->name').val( d==='' ? '' : d.substring(0,8) + (t===''?'000000':t.substring(8)) );";
			echo "  }";
			echo " ,UpdateT : function(){";
			echo "    var d = jQuery('#{$this->name}_date').val();";
			echo "    var t = jQuery('#{$this->name}_time').val();";
			echo "    jQuery('#$this->name').val( t==='' ? '' : (d===''?".new Js(XDate::Today()->Format('Ymd')).":d.substring(0,8)) + t.substring(8) );";
			echo "  }";
			echo " ,SetDate:function(d){ {$this->name}_date.SetDate(d); {$this->name}_time.SetDate(d); }";
			echo " ,GetDate:function(){ var d = {$this->name}_date.GetDate(); if(d===null)return null; var t = {$this->name}_time.GetDate(); if(t===null)return null; return new Date(d.getFullYear(),d.getMonth(),d.getDate(),t.getHours(),t.getMinutes(),t.getSeconds()); }";
			echo "};";
			echo Js::END;
		}


	}
}





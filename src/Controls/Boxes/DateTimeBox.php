<?php

class DateTimeBox extends Box {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '∅';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

	public function Render(){

		if ($this->mode == UIMode::Edit && $this->readonly){
			HiddenControl::Make($this->name,$this->value)
				->Render();
		}

		DateBox::Make($this->name . '_date' , $this->value )
			->WithMode($this->mode)
			->WithReadOnly($this->readonly)
			->WithAllowNull($this->allow_null)
			->WithNullCaption($this->null_caption)
			->WithOnChange($this->name.'.Update();')
			->Render();

		echo '&nbsp;';

		TimeControl::Make($this->name . '_time' , $this->value )
			->WithMode($this->mode)
			->WithReadOnly($this->readonly)
			->WithOnChange($this->name.'_Update();')
			->WithAllowNull($this->allow_null)
			->Render();


		echo Js::BEGIN;
		echo "window.$this->name = {";
		echo "  Update : function(){";
		echo "    var d = jQuery('#{$this->name}_date').val();";
		echo "    var t = jQuery('#{$this->name}_time').val();";
		echo "    jQuery('#$this->name').val( d==='' ? '' : (t==='' ? '' : d.substring(0,8) + t.substring(8)) );";
		echo "  }";
		echo "};";
		echo Js::END;



	}
}





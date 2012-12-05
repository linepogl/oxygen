<?php

class DateTimeControl extends ValueControl {

	private $is_readonly;
	public function WithReadOnly($value){ $this->is_readonly = $value; return $this; }

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '&empty;';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

	public function Render(){

		if ($this->mode == UIMode::Edit){
			HiddenControl::Make($this->name,$this->value)
				->Render();
		}

		DateControl::Make($this->name . '_date' , $this->value )
			->WithMode($this->mode)
			->WithReadOnly($this->is_readonly)
			->WithAllowNull($this->allow_null)
			->WithNullCaption($this->null_caption)
			->WithOnChange($this->name.'_Update();')
			->Render();

		echo '&nbsp;';

		TimeControl::Make($this->name . '_time' , $this->value )
			->WithMode($this->mode)
			->WithReadOnly($this->is_readonly)
			->WithOnChange($this->name.'_Update();')
			->WithAllowNull($this->allow_null)
			->Render();


		echo Js::BEGIN;
		echo $this->name ."_Update = function(){";
		echo "  var d = \$F(".new Js($this->name.'_date').");";
		echo "  var t = \$F(".new Js($this->name.'_time').");";
		echo "  \$(".new Js($this->name).").value = d==='' ? '' : (t==='' ? '' : d.substring(0,8) + t.substring(8));";
		echo "};";
		echo Js::END;

	}
}
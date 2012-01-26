<?php

class DateTimeControl extends ValueControl {

	private $is_readonly;
	public function WithReadOnly($value){ $this->is_readonly = $value; return $this; }

	public function Render(){


		HiddenControl::Make($this->name,$this->value)
			->Render();

		DateControl::Make($this->name . '_date' , $this->value )
			->WithMode($this->mode)
			->WithReadOnly($this->is_readonly)
			->WithOnChange($this->name.'_Update();')
			->Render();

		echo '&nbsp;';

		TimeControl::Make($this->name . '_time' , $this->value )
			->WithMode($this->mode)
			->WithReadOnly($this->is_readonly)
			->WithOnChange($this->name.'_Update();')
			->Render();


		echo Js::BEGIN;
		echo $this->name ."_Update = function(){";
		echo "  \$(".new Js($this->name).").value = \$F(".new Js($this->name.'_date').").substring(0,8) + \$F(".new Js($this->name.'_time').").substring(8);";
		echo "};";
		echo Js::END;

	}
}
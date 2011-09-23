<?php

class DateTimeControl extends ValueControl {


	public function Render(){


		HiddenControl::Make($this->name,$this->value)
			->Render();

		DateControl::Make($this->name . '_date' , $this->value )
			->WithOnChange($this->name.'_Update();')
			->Render();

		TimeControl::Make($this->name . '_time' , $this->value )
			->WithOnChange($this->name.'_Update();')
			->Render();


		echo Js::BEGIN;
		echo $this->name ."_Update = function(){";
		echo "  \$(".new Js($this->name).").value = \$F(".new Js($this->name.'_date').").substring(0,8) + \$F(".new Js($this->name.'_time').").substring(8);";
		echo "};";
		echo Js::END;

	}
}
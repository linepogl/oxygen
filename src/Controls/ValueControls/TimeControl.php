<?php

class TimeControl extends ValueControl {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $show_seconds = false;
	public function WithShowSeconds($value){ $this->show_seconds = $value; return $this; }

	private $on_change = '';
	public function WithOnChange($value){ $this->on_change = $value; return $this; }

	private $is_readonly;
	public function WithReadOnly($value){ $this->is_readonly = $value; return $this; }

	public function Render(){
		$v = null;
		if ($this->value instanceof DateTime)
			$v = new XDateTime($this->value);
		elseif ($this->value instanceof XDateTime)
			$v = $this->value;

		echo new HiddenControl($this->name,$v);

		if ($this->mode != UIMode::Edit && is_null($this->value)){
			return;
		}

		$h = is_null($v) ? null : $v->GetHours();
		$m = is_null($v) ? null : $v->GetMinutes();
		$s = is_null($v) ? null : $v->GetSeconds();


		if (!is_null($h)) $h = ($h<10?'0':'').$h;
		if (!is_null($m)) $m = ($m<10?'0':'').$m;
		if (!is_null($s)) $s = ($s<10?'0':'').$s;

		echo '<span class="nowrap" style="vertical-align:baseline;">';
		$c = SelectControl::Make($this->name.'_hours',$h)->WithOnChange($this->name.'_UpdateTime();')->WithAllowNull($this->allow_null)->WithWidth('4em')->WithStyle('text-align:center;')->WithMode($this->mode)->WithReadOnly($this->is_readonly);
		for ($i = 0; $i<24; $i++)
			$c->Add(($i<10?'0':'') . $i);
		$c->Render();

		echo ':';
		$c = SelectControl::Make($this->name.'_minutes',$m)->WithOnChange($this->name.'_UpdateTime();')->WithAllowNull($this->allow_null)->WithWidth('4em')->WithStyle('text-align:center;')->WithMode($this->mode)->WithReadOnly($this->is_readonly);
		for ($i = 0; $i<60; $i++)
			$c->Add(($i<10?'0':'') . $i);
		$c->Render();

		if ($this->show_seconds){
			echo ':';
			$c = SelectControl::Make($this->name.'_seconds',$s)->WithOnChange($this->name.'_UpdateTime();')->WithAllowNull($this->allow_null)->WithWidth('4em')->WithStyle('text-align:center;')->WithMode($this->mode)->WithReadOnly($this->is_readonly);
			for ($i = 0; $i<60; $i++)
				$c->Add(($i<10?'0':'') . $i);
			$c->Render();
		}
		echo '</span>';

		


		echo Js::BEGIN;
		echo $this->name."_UpdateTime = function(){";
		echo "e = $('".$this->name."');";
		echo "e.value = '20000101';";
		echo "h = \$F('".$this->name."_hours');";
		echo "if (h=='') { e.value = ''; return; } else e.value+=h;";
		echo "m = \$F('".$this->name."_minutes');";
		echo "if (m=='') { e.value = ''; return; } else e.value+=m;";
		if ($this->show_seconds) {
			echo "s = \$F('".$this->name."_seconds');";
			echo "if (s=='') { e.value = ''; return; } else e.value+=s;";
		}
		else {
			echo "e.value+='00';";
		}
		echo $this->on_change;
		echo "};";
		echo Js::END;

	}

}




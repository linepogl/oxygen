<?php

class TimeSpanControl extends ValueControl {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $show_days = false;
	public function WithShowDays($value){ $this->show_days = $value; return $this; }

	private $show_hours = true;
	public function WithShowHours($value){ $this->show_hours = $value; return $this; }

	private $show_minutes = true;
	public function WithShowMinutes($value){ $this->show_minutes = $value; return $this; }

	private $show_seconds = false;
	public function WithShowSeconds($value){ $this->show_seconds = $value; return $this; }

	private $readonly = false;
	public function WithReadonly($value){ $this->readonly = $value; return $this; }

	public function Render(){

		$v = $this->value;
		if (is_null($v)) {
			if (!$this->allow_null){
				$v = new XTimeSpan();
			}
		}

		if ($this->mode != UIMode::Edit){
			echo Language::FormatTimeSpan($this->value);
			return;
		}

		echo new HiddenControl($this->name,$v);

		$d = is_null($v) ? null : $v->GetDays();
		$h = is_null($v) ? null : ($this->show_days ? $v->GetHours() : $v->GetTotalHours());
		$m = is_null($v) ? null : ($this->show_hours ? $v->GetMinutes() : $v->GetTotalMinutes());
		$s = is_null($v) ? null : ($this->show_minutes ? $v->GetSeconds() : $v->GetTotalSeconds());

		if ($this->show_days){
			echo TextBox::Make($this->name.'_days',$d)->WithWidth('4em')->WithCssClass('contentbox hcenter')->WithOnChange($this->name."_UpdateTimeSpan();")->WithMode($this->mode)->WithReadonly($this->readonly);
			echo '&nbsp;'.Lemma::Pick('d.').'&nbsp;';
		}
		if ($this->show_hours){
			echo TextBox::Make($this->name.'_hours',$h)->WithWidth('3em')->WithCssClass('contentbox hcenter')->WithOnChange($this->name."_UpdateTimeSpan();")->WithMode($this->mode)->WithReadonly($this->readonly);
			echo '&nbsp;'.Lemma::Pick('h.').'&nbsp;';
		}
		if ($this->show_minutes){
			echo TextBox::Make($this->name.'_minutes',$m)->WithWidth('3em')->WithCssClass('contentbox hcenter')->WithOnChange($this->name."_UpdateTimeSpan();")->WithMode($this->mode)->WithReadonly($this->readonly);
			echo '&nbsp;&prime;';
		}
		if ($this->show_seconds){
			echo '&nbsp;';
			echo TextBox::Make($this->name.'_seconds',$s)->WithWidth('3em')->WithCssClass('contentbox hcenter')->WithOnChange($this->name."_UpdateTimeSpan();")->WithMode($this->mode)->WithReadonly($this->readonly);
			echo '&nbsp;&Prime;';
		}


		echo Js::BEGIN;
		echo $this->name."_UpdateTimeSpan = function(){";
		echo "var e = $(".new Js($this->name).");";
		echo "var found = false;";
		echo "var x = 0;";
		if ($this->show_days) {
			echo "var d = \$F(".new Js($this->name.'_days').");";
			echo "if (d !== '') { d = parseInt(d); if (''+d=='NaN') {e.value = ''; return;} else {found=true; x+=d*24*60*60*1000;} }";
		}
		if ($this->show_hours) {
			echo "var h = \$F(".new Js($this->name.'_hours').");";
			echo "if (h !== '') { h = parseInt(h); if (''+h=='NaN') {e.value = ''; return;} else {found=true; x+=h*60*60*1000;} }";
		}
		if ($this->show_minutes) {
			echo "var m = \$F(".new Js($this->name.'_minutes').");";
			echo "if (m !== '') { m = parseInt(m); if (''+m=='NaN') {e.value = ''; return;} else {found=true; x+=m*60*1000;} }";
		}
		if ($this->show_seconds) {
			echo "var s = \$F(".new Js($this->name.'_seconds').");";
			echo "if (s !== '') { s = parseInt(s); if (''+s=='NaN') {e.value = ''; return;} else {found=true; x+=s*1000;} }";
		}
		echo "e.value = found ? ''+x : '';";
		echo "};";
		echo Js::END;

	}
}




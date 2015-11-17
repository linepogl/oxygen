<?php

class DateBox extends Box {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '∅';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

	private $show_value = true;
	public function WithShowValue($value){ $this->show_value = $value; return $this; }

	public function Render(){
		$ns = $this->name;

    if (!($this->value instanceof XDateTime)) {
      $this->value = $this->allow_null ? null : XDate::Today();
		}

		echo HiddenBox::Make($ns,$this->value)->WithHttpName($this->readonly || $this->mode != UIMode::Edit ? null : $this->http_name);

		if ($this->mode == UIMode::View || $this->mode == UIMode::Printer) {
			if ($this->show_value) {
				$caption = $this->value instanceof XDateTime ? Language::FormatDate($this->value) : ( $this->allow_null ? $this->null_caption : '' );
				echo new Html($caption);
			}
			return;
		}

		$n = $this->allow_null ? $this->null_caption : '';
		$y = is_null($this->value) ? '' : $this->value->Format('Y');
		$m = is_null($this->value) ? '' : $this->value->Format('m');
		$d = is_null($this->value) ? '' : $this->value->Format('d');

		if ($this->show_value) {
			echo '<span id="'.$ns.'-span" class="formPane'.($this->readonly?' formLocked':'').'" style="padding:0;border:0;position:relative;display:inline-block;">';
		}
		else {
			echo '<span id="'.$ns.'-span" style="position:relative;display:inline-block;">';
		}

		if (!$this->readonly){
			echo '<div id="'.$ns.'-dropdown" class="formDropDown formDateDropDown" style="display:none;">';
			echo '<div class="formDropDownHook"></div>';
			echo '<div class="formDropDownHead">';
			echo '<a class="button button-prev" href="javascript:'.$ns.'.ShowPrevMonth();"></a>';
			echo '<a class="button button-next" href="javascript:'.$ns.'.ShowNextMonth();"></a>';
			echo '<div id="'.$ns.'-month"></div>';
			echo '</div>';
			echo '<div class="formDropDownBody">';
			echo '<div id="'.$ns.'-dropdown-body"></div>';
			echo '</div>';
			echo '<div class="formDropDownFoot">';
			if ($this->allow_null){
				$null_caption = trim($this->null_caption);
				echo '<a id="'.$ns.'-null" class="fleft button" href="javascript:'.$ns.'.SetDate(null);">'.new Html($null_caption===''?'∅':$null_caption).'</a>';
			}
			echo '<a id="'.$ns.'-today" class="button" href="javascript:'.$ns.'.SetDate('.new Js(XDate::Today()).');">'.new Html(oxy::txtToday()).'</a>';
			echo '<div id="'.$ns.'-month"></div>';
			echo '<a class="button button-next" href="javascript:'.$ns.'.ShowNextYear();"></a>';
			echo '<a class="button button-prev" href="javascript:'.$ns.'.ShowPrevYear();"></a>';
			echo '</div>';
			echo '</div>';
		}

		if ($this->show_value) {
			echo '<div id="'.$ns.'-box-null" class="formPaneInnerWrap" style="'.(is_null($this->value)?'':'display:none;').'"><div class="formPane formPaneInner" style="background:none;border:0;margin:0;padding:0;">';
			echo new Html($n);
			echo '</div></div>';
			echo '<div id="'.$ns.'-box-date" class="formPaneInnerWrap" style="'.(is_null($this->value)?'display:none;':'').'"><div class="formPane formPaneInner" style=";border:0;margin:0;padding:0;">';
			echo '<span id="'.$ns.'-d">'.$d.'</span>/<span id="'.$ns.'-m">'.$m.'</span>/<span id="'.$ns.'-y">'.$y.'</span>';
			echo '</div></div>';
			echo '<div id="'.$ns.'-anchor" class="formPaneAnchorWrap formDateAnchorWrap"><div class="formPaneAnchor">'.oxy::icoDate().'</div></div>';
			echo '<input id="'.$ns.'-box"';
			echo ' class="formPane formDate'.($this->readonly?' formLocked':'').'"';
			echo ' style="margin:0;cursor:pointer;"';
			echo ' value=""';
			echo ' readonly="readonly"';
			echo '/>';
		}
		elseif (!$this->readonly) {
			echo '<a id="'.$ns.'-anchor" href="javascript:" class="formPaneAnchor">'.oxy::icoDate().'</a>';
		}
		echo '</span>';


		echo Js::BEGIN;
		if ($this->show_value) {
			echo "Oxygen.AdjustFormPaneAnchorIcon('$ns');";
		}
		if (!$this->readonly){
			echo "Oxygen.DateBox({ns:".new Js($ns);
			echo ",date:".new Js($this->value);
			echo ",month_labels:[".new Js(oxy::txtJan_()).",".new Js(oxy::txtFeb_()).",".new Js(oxy::txtMar_()).",".new Js(oxy::txtApr_()).",".new Js(oxy::txtMay_()).",".new Js(oxy::txtJun_()).",".new Js(oxy::txtJul_()).",".new Js(oxy::txtAug_()).",".new Js(oxy::txtSep_()).",".new Js(oxy::txtOct_()).",".new Js(oxy::txtNov_()).",".new Js(oxy::txtDec_())."]";
			echo ",day_labels:[".new Js(substr(oxy::txtMonday(),0,3)).",".new Js(substr(oxy::txtTuesday(),0,3)).",".new Js(substr(oxy::txtWednesday(),0,3)).",".new Js(substr(oxy::txtThursday(),0,3)).",".new Js(substr(oxy::txtFriday(),0,3)).",".new Js(substr(oxy::txtSaturday(),0,3)).",".new Js(substr(oxy::txtSunday(),0,3))."]";
			if($this->allow_null) echo ",allow_null:true";
			if(!$this->show_value) echo ",allow_null:false";
			if($this->on_change!='') echo ",on_change:function(){{$this->on_change}}";
			echo "});";
		}
		echo Js::END;


	}
}





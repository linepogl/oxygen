<?php

class FormMonitoringControl extends Control {

	private $form_name;
	public function WithFormName($value){ $this->form_name = $value; return $this; }

	private $message = null;
	public function WithMessage($value){ $this->message = $value; return $this; }

	private $on_form_changed = null;
	public function WithOnFormChanged($value){ $this->on_form_changed = $value; return $this; }

	private $on_form_unchanged = null;
	public function WithOnFormUnchanged($value){ $this->on_form_unchanged = $value; return $this; }

	private $is_blocked = false;
	public function WithIsBlocked($value){ $this->is_blocked = $value; return $this; }

	public function Render() {
		$ns = $this->name;
		$message = $this->message === null ? oxy::txtMsgUnsavedChanges() : $this->message;

		echo Js::BEGIN;
		echo "window.$ns = {";
		echo "  initial_form_serialization:".new Js($this->is_blocked?'!':null);
		echo " ,form_has_changed:false";
		echo " ,CheckFormChanged:function(){";
		echo "    var s = jQuery('#$this->form_name').serialize();";
		echo "    if (this.initial_form_serialization === null) {";
		echo "      this.initial_form_serialization = s;";
		echo "    }";
		echo "    else {";
		echo "      changed = s!==this.initial_form_serialization;";
		echo "      if (changed && !this.form_has_changed) { $this->on_form_changed; }";
		echo "      if (!changed && this.form_has_changed) { $this->on_form_unchanged; }";
		echo "      this.form_has_changed = changed;";
		echo "    }";
		echo "    setTimeout(function(){ window.$ns.CheckFormChanged(); },1000);";
		echo "  }";
		echo "};";
		echo "setTimeout(function(){ window.$ns.CheckFormChanged(); },1);";
		echo "jQuery('#$this->form_name').bind('submit',function() { window.$ns.form_has_changed = false; });";
		echo "jQuery(window).bind('beforeunload',function() { if (window.$ns.form_has_changed) return ".new Js($message)."; });";
		echo Js::END;


	}
}
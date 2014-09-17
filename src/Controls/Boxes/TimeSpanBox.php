<?php

class TimeSpanBox extends Box {

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

	public function Render(){

		if (!($this->value instanceof XTimeSpan)) {
	    $this->value = $this->allow_null ? null : new XTimeSpan();
		}

		echo HiddenBox::Make($this->name,$this->value)->WithHttpName($this->readonly || $this->mode != UIMode::Edit ? null : $this->http_name);

		if ($this->mode != UIMode::Edit){
			echo Language::FormatTimeSpan($this->value);
			return;
		}


		if (is_null($this->value)) {
			$d = '';
			$h = '';
			$m = '';
			$s = '';
		}
		else {
			$v = $this->value->GetTotalSeconds();
			$sign = $v < 0 ? -1 : 1;
			$v = abs($v);
			$d = floor($v / (60*60*24)); $v -= $d*60*60*24;
			$h = floor($v / (60*60)); $v -= $h*60*60;
			$m = floor($v / 60); $v -= $m*60;
			$s = $v;
			if (!$this->show_days) { $h+=$d*24; $d=0; }
			if (!$this->show_hours) { $m+=$h*60; $h=0; }
			if (!$this->show_minutes) { $s+=$m*60; $m=0; }

			$d *= $sign;
			$h *= $sign;
			$m *= $sign;
			$s *= $sign;
		}
		$pseudo_focus = $this->show_days ? 'd' : ($this->show_hours ? 'h' : ($this->show_minutes ? 'm' : 's'));



		echo '<span id="'.$this->name.'-span" class="formPane '.($this->readonly?' formLocked':'').'" style="padding:0;border:0;position:relative;display:inline-block;">';


		echo '<div id="'.$this->name.'-box-inner" class="formPaneInnerWrap"><div class="formPane '.($this->readonly?'formLocked':'').' formPaneInner formTimeSpanInner" style="border:0;margin:0;padding:0;">';
		if ($this->show_days) {
			echo '<span id="'.$this->name.'-d" style="padding:0 0.2em;">&nbsp;'.$d.'</span>';
			echo Lemma::Pick('Unit_day');
			echo '&nbsp;&nbsp;';
		}
		if ($this->show_hours) {
			echo '<span id="'.$this->name.'-h" style="padding:0 0.2em;">&nbsp;'.$h.'</span>';
			echo Lemma::Pick('Unit_hour');
			echo '&nbsp;&nbsp;';
		}
		if ($this->show_minutes) {
			echo '<span id="'.$this->name.'-m" style="padding:0 0.2em;">&nbsp;'.$m.'</span>';
			echo '&prime;';
			echo '&nbsp;&nbsp;';
		}
		if ($this->show_seconds) {
			echo '<span id="'.$this->name.'-s" style="padding:0 0.2em;">&nbsp;'.$s.'</span>';
			echo '&Prime;';
			echo '&nbsp;&nbsp;';
		}
		echo '</div></div>';

		echo '<div id="'.$this->name.'-anchor" class="formPaneAnchorWrap formTimeSpanAnchorWrap"><div class="formPaneAnchor">'.oxy::icoTime().'</div></div>';

		echo '<input id="'.$this->name.'-box"';
		echo ' class="formPane formTimeSpan'.($this->readonly?' formLocked':'').'"';
		echo ' style="margin:0;cursor:pointer;"';
		echo ' value=""';
		echo ' readonly="readonly"';
		echo '/>';
		echo '</span>';




		echo Js::BEGIN;
		echo "var f = function(){";
		echo "  var x =  jQuery('#$this->name-box');";
		echo "  jQuery('#$this->name-anchor').css({'margin-top':x.css('border-top-width'),'margin-right':x.css('border-right-width'),'padding-top':x.css('padding-top'),'padding-right':x.css('padding-right')});";
		echo "  jQuery('#$this->name-span .formPaneInnerWrap').css({'margin-top':x.css('border-top-width'),'margin-left':x.css('border-left-width'),'padding-top':x.css('padding-top'),'padding-left':x.css('padding-left')});";
		echo "  jQuery('#$this->name-span .formPaneInner').css({'height':x.height()+'px','width':(x.width()-16)+'px','line-height':x.height()+'px'});";
		echo "};";
		echo "jQuery(document).ready(f);f();";
		if (!$this->readonly){
			echo "jQuery('#$this->name-box,#$this->name-anchor,#$this->name-box-inner').click(function(e){ $this->name.OnClick(); }).keydown(function(e){ $this->name.OnKeyDown(e); }).blur(function(e){ $this->name.OnBlur(e); }).focus(function(e){ $this->name.OnFocus(); });";
			echo "jQuery('#$this->name-d').click(function(e){ $this->name.SetPseudoFocus('d'); });";
			echo "jQuery('#$this->name-h').click(function(e){ $this->name.SetPseudoFocus('h'); });";
			echo "jQuery('#$this->name-m').click(function(e){ $this->name.SetPseudoFocus('m'); });";
			echo "jQuery('#$this->name-s').click(function(e){ $this->name.SetPseudoFocus('s'); });";
			echo "window.".$this->name." = {";
			echo "  pseudo_focus : ".new Js($pseudo_focus);
			echo " ,SetPseudoFocus:function(f){ this.pseudo_focus = f; this.Update(); }";
			echo " ,OnKeyDown : function(ev){";
			echo "    switch(ev.which){";
			echo "      case 9:";
			echo "        var x = this.pseudo_focus;";
			echo "        if (!ev.shiftKey) {";
			echo "          if(x==='d'){".($this->show_hours?"this.SetPseudoFocus('h');ev.preventDefault();return;":"x='h';")."}";
			echo "          if(x==='h'){".($this->show_minutes?"this.SetPseudoFocus('m');ev.preventDefault();return;":"x='m';")."}";
			echo "          if(x==='m'){".($this->show_seconds?"this.SetPseudoFocus('s');ev.preventDefault();return;":"x='s';")."}";
			echo "        }";
			echo "        else {";
			echo "          if(x==='s'){".($this->show_minutes?"this.SetPseudoFocus('m');ev.preventDefault();return;":"x='m';")."}";
			echo "          if(x==='m'){".($this->show_hours?"this.SetPseudoFocus('h');ev.preventDefault();return;":"x='h';")."}";
			echo "          if(x==='h'){".($this->show_days?"this.SetPseudoFocus('d');ev.preventDefault();return;":"x='d';")."}";
			echo "        }";
			echo "        return;";
			echo "      case 61:case 109:this.Inv();ev.preventDefault();return;";
			echo "      case 38:case 39:this.Inc();ev.preventDefault();return;";
			echo "      case 40:case 37:this.Dec();ev.preventDefault();return;";
			echo "      case 48:case  96:this.Press('0');ev.preventDefault();return;";
			echo "      case 49:case  97:this.Press('1');ev.preventDefault();return;";
			echo "      case 50:case  98:this.Press('2');ev.preventDefault();return;";
			echo "      case 51:case  99:this.Press('3');ev.preventDefault();return;";
			echo "      case 52:case 100:this.Press('4');ev.preventDefault();return;";
			echo "      case 53:case 101:this.Press('5');ev.preventDefault();return;";
			echo "      case 54:case 102:this.Press('6');ev.preventDefault();return;";
			echo "      case 55:case 103:this.Press('7');ev.preventDefault();return;";
			echo "      case 56:case 104:this.Press('8');ev.preventDefault();return;";
			echo "      case 57:case 105:this.Press('9');ev.preventDefault();return;";
			echo "      case 8:this.Backspace();ev.preventDefault();return;";
			echo "      case 46:this.Del();ev.preventDefault();return;";
			echo "    }";
			echo "  }";
			echo " ,get_s : function(){ return jQuery('#$this->name-'+this.pseudo_focus).html().replace(/&nbsp;/g,''); }";
			echo " ,set_s : function(s){ jQuery('#$this->name-'+this.pseudo_focus).html('&nbsp;'+(s===''?'&nbsp;':s)); this.Update(); }";
			echo " ,Inv : function(){ var x = parseInt(this.get_s()); this.set_s( ''+x=='NaN' ? '0' : -x ); }";
			echo " ,Inc : function(){ var x = parseInt(this.get_s()); this.set_s( ''+x=='NaN' ? '0' : x + 1 ); }";
			echo " ,Dec : function(){ var x = parseInt(this.get_s()); this.set_s( ''+x=='NaN' ? '0' : x - 1 ); }";
			echo " ,Del : function(s){ this.set_s( '' ); }";
			echo " ,Press : function(s){ var x = this.get_s(); this.set_s( (x==='0' ? '' : x) + s ); }";
			echo " ,Backspace : function(s){ var x = this.get_s(); if (x==='') return; this.set_s( x.slice(0,-1) ); }";
			echo " ,Focus : function(){ jQuery('#$this->name-box').trigger('focus'); }";
			echo " ,OnFocus : function(ev){";
			echo "    this.ShowPseudoFocus();";
			echo $this->on_focus;
			echo "  }";
			echo " ,OnBlur : function(ev){";
			echo "    this.HidePseudoFocus();";
			echo $this->on_blur;
			echo "  }";

			echo " ,GetValue : function(){ var s = jQuery('#$this->name').val(); if (s==='') return null; var v = parseInt(s,10); if(''+v==='NaN') return null; return v; }";
			echo " ,SetValue : function(v){";
			echo "    if (v!==null) { v=parseInt(v,10); if(''+v==='NaN') v = null; }";
			echo "    var old_pseudo_focus = this.pseudo_focus;";
			if ($this->show_days)    echo "this.pseudo_focus='d'; if (v===null) this.set_s(''); else { this.set_s( Math.floor(v/(24*60*60*1000))); v = v % (24*60*60*1000); }";
			if ($this->show_hours)   echo "this.pseudo_focus='h'; if (v===null) this.set_s(''); else { this.set_s( Math.floor(v/(   60*60*1000))); v = v % (   60*60*1000); }";
			if ($this->show_minutes) echo "this.pseudo_focus='m'; if (v===null) this.set_s(''); else { this.set_s( Math.floor(v/(      60*1000))); v = v % (      60*1000); }";
			if ($this->show_seconds) echo "this.pseudo_focus='s'; if (v===null) this.set_s(''); else { this.set_s( Math.floor(v/(         1000))); v = v % (         1000); }";
			echo "    this.pseudo_focus = old_pseudo_focus;";
			echo "    this.Update();";
			echo "  }";
			echo " ,Update : function(){";
			echo "    this.ShowPseudoFocus();";
			echo "    var found = false;";
			echo "    var x = 0;";
			if ($this->show_days)    echo "    var d = jQuery('#$this->name-d').html().replace('&nbsp;',''); if (d !== '') { d = parseInt(d); if (''+d!=='NaN') { found=true; x+=d*24*60*60*1000; } }";
			if ($this->show_hours)   echo "    var h = jQuery('#$this->name-h').html().replace('&nbsp;',''); if (h !== '') { h = parseInt(h); if (''+h!=='NaN') { found=true; x+=h*60*60*1000; } }";
			if ($this->show_minutes) echo "    var m = jQuery('#$this->name-m').html().replace('&nbsp;',''); if (m !== '') { m = parseInt(m); if (''+m!=='NaN') { found=true; x+=m*60*1000; } }";
			if ($this->show_seconds) echo "    var s = jQuery('#$this->name-s').html().replace('&nbsp;',''); if (s !== '') { s = parseInt(s); if (''+s!=='NaN') { found=true; x+=s*1000; } }";
			echo "    jQuery('#$this->name').val( found ? x : '' );";
			echo "  }";
			echo " ,OnClick : function (){ jQuery('#$this->name-box').focus(); }";
			echo " ,ShowPseudoFocus : function(){";
			echo "    jQuery('#$this->name-d').css({'text-decoration':this.pseudo_focus==='d'?'underline':'none'});";
			echo "    jQuery('#$this->name-h').css({'text-decoration':this.pseudo_focus==='h'?'underline':'none'});";
			echo "    jQuery('#$this->name-m').css({'text-decoration':this.pseudo_focus==='m'?'underline':'none'});";
			echo "    jQuery('#$this->name-s').css({'text-decoration':this.pseudo_focus==='s'?'underline':'none'});";
			echo "  }";
			echo " ,HidePseudoFocus : function(){";
			echo "    jQuery('#$this->name-d,#$this->name-h,#$this->name-m,#$this->name-s').css({'text-decoration':'none'});";
			echo "  }";

			echo "};";
		}
		echo Js::END;
	}
}




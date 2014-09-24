<?php

class DateBox extends Box {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '∅';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

	private $show_value = true;
	public function WithShowValue($value){ $this->show_value = $value; return $this; }

	public function Render(){
    if (!($this->value instanceof XDateTime)) {
      $this->value = $this->allow_null ? null : XDate::Today();
		}

		echo HiddenBox::Make($this->name,$this->value)->WithHttpName($this->readonly || $this->mode != UIMode::Edit ? null : $this->http_name);

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
			echo '<span id="'.$this->name.'-span" class="formPane'.($this->readonly?' formLocked':'').'" style="padding:0;border:0;position:relative;display:inline-block;">';
		}
		else {
			echo '<span id="'.$this->name.'-span" style="position:relative;display:inline-block;">';
		}

		if (!$this->readonly){
			echo '<div id="'.$this->name.'-dropdown" class="formDropDown formDateDropDown" style="display:none;">';
			echo '<div class="formDropDownHook"></div>';
			echo '<div class="formDropDownHead">';
			echo '<a class="button button-prev" href="javascript:'.$this->name.'.ShowPrevMonth();"></a>';
			echo '<a class="button button-next" href="javascript:'.$this->name.'.ShowNextMonth();"></a>';
			echo '<div id="'.$this->name.'-month"></div>';
			echo '</div>';
			echo '<div class="formDropDownBody">';
			echo '<div id="'.$this->name.'-dropdown-body"></div>';
			echo '</div>';
			echo '<div class="formDropDownFoot">';
			if ($this->allow_null){
				$null_caption = trim($this->null_caption);
				echo '<a id="'.$this->name.'-null" class="fleft button" href="javascript:'.$this->name.'.SetDate(null);">'.new Html($null_caption===''?'∅':$null_caption).'</a>';
			}
			echo '<a id="'.$this->name.'-today" class="button" href="javascript:'.$this->name.'.SetDate('.new Js(XDate::Today()).');">'.new Html(oxy::txtToday()).'</a>';
			echo '<div id="'.$this->name.'-month"></div>';
			echo '<a class="button button-next" href="javascript:'.$this->name.'.ShowNextYear();"></a>';
			echo '<a class="button button-prev" href="javascript:'.$this->name.'.ShowPrevYear();"></a>';
			echo '</div>';
			echo '</div>';
		}

		if ($this->show_value) {
			echo '<div id="'.$this->name.'-box-null" class="formPaneInnerWrap" style="'.(is_null($this->value)?'':'display:none;').'"><div class="formPane formPaneInner" style="background:none;border:0;margin:0;padding:0;">';
			echo new Html($n);
			echo '</div></div>';

			echo '<div id="'.$this->name.'-box-date" class="formPaneInnerWrap" style="'.(is_null($this->value)?'display:none;':'').'"><div class="formPane formPaneInner" style=";border:0;margin:0;padding:0;">';
			echo '<span id="'.$this->name.'-d">'.$d.'</span>/<span id="'.$this->name.'-m">'.$m.'</span>/<span id="'.$this->name.'-y">'.$y.'</span>';
			echo '</div></div>';

			echo '<div id="'.$this->name.'-anchor" class="formPaneAnchorWrap formDateAnchorWrap"><div class="formPaneAnchor">'.oxy::icoDate().'</div></div>';

			echo '<input id="'.$this->name.'-box"';
			echo ' class="formPane formDate'.($this->readonly?' formLocked':'').'"';
			echo ' style="margin:0;cursor:pointer;"';
			echo ' value=""';
			echo ' readonly="readonly"';
			echo '/>';
		}
		elseif (!$this->readonly) {
			echo '<a id="'.$this->name.'-anchor" href="javascript:" class="formPaneAnchor">'.oxy::icoDate().'</a>';
		}
		echo '</span>';


		echo Js::BEGIN;
		if ($this->show_value) {
			echo "var f = function(){";
			echo "  var x =  jQuery('#$this->name-box');";
			echo "  jQuery('#$this->name-anchor').css({'margin-top':x.css('border-top-width'),'margin-right':x.css('border-right-width'),'padding-top':x.css('padding-top'),'padding-right':x.css('padding-right')});";
			echo "  jQuery('#$this->name-span .formPaneInnerWrap').css({'margin-top':x.css('border-top-width'),'margin-left':x.css('border-left-width'),'padding-top':x.css('padding-top'),'padding-left':x.css('padding-left')});";
			echo "  jQuery('#$this->name-span .formPaneInner').css({'height':x.height()+'px','line-height':x.height()+'px'});";
			echo "};";
			echo "jQuery(document).ready(f);f();";
		}
		if (!$this->readonly){
			echo "jQuery('#$this->name-box,#$this->name-anchor,#$this->name-box-date,#$this->name-box-null').click(function(e){ $this->name.OnClick(); }).keydown(function(e){ $this->name.OnKeyDown(e); }).blur(function(e){ $this->name.OnBlur(e); }).focus(function(e){ $this->name.ShowPseudoFocus(); });";
			echo "jQuery('#$this->name-dropdown').mousedown(function(e){ window.$this->name.KeepFocus(); });";
			echo "window.".$this->name." = {";
			echo "  date : ".new Js($this->value);
			echo " ,month : null";
			echo " ,is_open : false";
			echo " ,pseudo_focus : 'd'";
			echo " ,keep_focus : false";
			echo " ,SetDate : function(x){this.SetD(x);this.HideDropDown();}";
			echo " ,GetDate : function(){return this.date;}";
			echo " ,SetD : function(x){";
			echo "    this.date=x;";
			echo "    if (x==null){";
			echo "      jQuery('#$this->name-box-null').show();";
			echo "      jQuery('#$this->name-box-date').hide();";
			echo "      jQuery('#$this->name').val('');";
			echo "      this.pseudo_focus = 'd';";
			echo "    }";
			echo "    else {";
			echo "      jQuery('#$this->name-box-null').hide();";
			echo "      jQuery('#$this->name-box-date').show();";
			echo "      var d = x.getDate(); d=(d<10?'0':'')+d;";
			echo "      var m = x.getMonth()+1; m=(m<10?'0':'')+m;";
			echo "      var y = x.getFullYear()+'';";
			echo "      jQuery('#$this->name-d').html(d);";
			echo "      jQuery('#$this->name-m').html(m);";
			echo "      jQuery('#$this->name-y').html(y);";
			echo "      jQuery('#$this->name').val(y+m+d+'000000');";
			echo "    }";
			echo "    this.ShowMonth(x);";
			echo $this->on_change;
			echo "  }";

			echo " ,CloneDate:function(d){ return new Date(d.getFullYear(),d.getMonth(),d.getDate()); }";
			echo " ,IncD : function(){this.SetD(this.date===null?".new Js(XDate::Today()).":this.CloneDate(this.date).add({days:1}));}";
			echo " ,DecD : function(){this.SetD(this.date===null?".new Js(XDate::Today()).":this.CloneDate(this.date).add({days:-1}));}";
			echo " ,IncM : function(){this.SetD(this.date===null?".new Js(XDate::Today()).":this.CloneDate(this.date).add({months:1}));}";
			echo " ,DecM : function(){this.SetD(this.date===null?".new Js(XDate::Today()).":this.CloneDate(this.date).add({months:-1}));}";
			echo " ,IncY : function(){this.SetD(this.date===null?".new Js(XDate::Today()).":this.CloneDate(this.date).add({years:1}));}";
			echo " ,DecY : function(){this.SetD(this.date===null?".new Js(XDate::Today()).":this.CloneDate(this.date).add({years:-1}));}";


			echo " ,ShowPrevMonth:function(){this.ShowMonth(this.CloneDate(this.month).add({months:-1}));}";
			echo " ,ShowNextMonth:function(){this.ShowMonth(this.CloneDate(this.month).add({months:1}));}";
			echo " ,ShowPrevYear:function(){this.ShowMonth(this.CloneDate(this.month).add({years:-1}));}";
			echo " ,ShowNextYear:function(){this.ShowMonth(this.CloneDate(this.month).add({years:1}));}";
			echo " ,ShowMonth : function(x){";
			echo "    var today = ".new Js(XDate::Today()).";";
			echo "    var cm = x==null ? today : x;";
			echo "    this.month = new Date(cm.getFullYear(),cm.getMonth(),1);";
			echo "    this.Update();";
			echo "  }";

			echo " ,SetPseudoFocus:function(f){ this.pseudo_focus = f; this.Update(); }";

			echo " ,OnKeyDown : function(ev){";
			echo "    switch(ev.which){";
			echo "      case 13:case 27:if(this.is_open){this.HideDropDown();ev.preventDefault();}break;";
			echo "      case 32:this.ToggleDropDown();break;";
			if ($this->allow_null){
				echo "    case 8:case 46:this.SetD(null);ev.preventDefault();break;";
			}
			echo "      case 9:if(this.date===null)return;if(this.pseudo_focus==='d'&&!ev.shiftKey)this.SetPseudoFocus('m');else if(this.pseudo_focus==='m')this.SetPseudoFocus(ev.shiftKey?'d':'y');else if(this.pseudo_focus==='y'&&ev.shiftKey)this.SetPseudoFocus('m');else return;ev.preventDefault();break;";
			echo "      case 38:case 39:if(this.pseudo_focus==='d')this.IncD();if(this.pseudo_focus==='m')this.IncM();if(this.pseudo_focus==='y')this.IncY();ev.preventDefault();break;";
			echo "      case 40:case 37:if(this.pseudo_focus==='d')this.DecD();if(this.pseudo_focus==='m')this.DecM();if(this.pseudo_focus==='y')this.DecY();ev.preventDefault();break;";
			echo "      case 33:if(this.is_open){this.ShowPrevMonth();ev.preventDefault();}break;";
			echo "      case 34:if(this.is_open){this.ShowNextMonth();ev.preventDefault();}break;";

			echo "    }";
			echo "  }";
			echo " ,OnBlur : function(ev){";
			if ($this->show_value) {
				echo "    setTimeout(function(){if(!$this->name.keep_focus&&!jQuery('#$this->name-box').is(':focus')){ $this->name.HideDropDown();$this->name.HidePseudoFocus();}},200);";
			}
			echo "  }";
			echo " ,KeepFocus : function(){ this.keep_focus = true; setTimeout(function(){ $this->name.Update(); },500); }";
			echo " ,Update : function(){";
			echo "    this.ShowPseudoFocus();";
			echo "    if (!this.is_open) return;";
			echo "    var d = this.date;";
			echo "    var today = ".new Js(XDate::Today()).";";
			echo "    cm = this.CloneDate(this.month);";
			echo "    var dp = this.CloneDate(this.month).add({months:-1});";
			echo "    var dn = this.CloneDate(this.month).add({months:1});";
			echo "    var dyp = this.CloneDate(this.month).add({years:-1});";
			echo "    var dyn = this.CloneDate(this.month).add({years:1});";
			echo "    var months=new Array(".new Js(oxy::txtJan_()).",".new Js(oxy::txtFeb_()).",".new Js(oxy::txtMar_()).",".new Js(oxy::txtApr_()).",".new Js(oxy::txtMay_()).",".new Js(oxy::txtJun_()).",".new Js(oxy::txtJul_()).",".new Js(oxy::txtAug_()).",".new Js(oxy::txtSep_()).",".new Js(oxy::txtOct_()).",".new Js(oxy::txtNov_()).",".new Js(oxy::txtDec_()).");";
			echo "    var days=new Array(".new Js(substr(oxy::txtMonday(),0,3)).",".new Js(substr(oxy::txtTuesday(),0,3)).",".new Js(substr(oxy::txtWednesday(),0,3)).",".new Js(substr(oxy::txtThursday(),0,3)).",".new Js(substr(oxy::txtFriday(),0,3)).",".new Js(substr(oxy::txtSaturday(),0,3)).",".new Js(substr(oxy::txtSunday(),0,3)).");";
			echo "    jQuery('#$this->name-month').html(months[cm.getMonth()]+' '+cm.getFullYear());";
			echo "    var s = '';";
			echo "    s+='<table class=\"calendar\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">';";
			echo "    s+='<tr>';";
			echo "    for (i=0;i<days.length;i++) s+='<th class=\"day\">'+days[i]+'</th>';";
			echo "    s+='</tr>';";
			echo "    var dd;";
			echo "    dd=cm.getDay();if(dd==0)dd=7;";
			echo "    for (i=1; i<dd; i++){ if (i==0) s+='<tr>'; s+='<td class=\"empty\">&nbsp;</td>'; }";
			echo "    var m = cm.getMonth();";
			echo "    for (;m==cm.getMonth();cm.add({days:1})){";
			echo "      dd=cm.getDay();if(dd==0)dd=7;";
			echo "      var b=false;";
			echo "      if (d!=null) b=cm.getFullYear()==d.getFullYear()&&cm.getMonth()==d.getMonth()&&cm.getDate()==d.getDate();";
			echo "      if (dd==1) s+='<tr>';";
			echo "      s+='<td class=\"day'+(b?' selected':'')+(cm.compareTo(today)<0?' past':(cm.compareTo(today)==0?' today':' future'))+(cm.getDay()==0||cm.getDay()==6?' weekend':'')+'\">';";
			echo "      s+='<a href=\"javascript:$this->name.SetDate(new Date('+cm.getFullYear()+','+cm.getMonth()+','+cm.getDate()+'));\">';";
			echo "      s+=cm.getDate();";
			echo "      s+='</a>';";
			echo "      s+='</td>';";
			echo "      if (dd==7) s+='</tr>';";
			echo "    }";
			echo "    dd=cm.getDay();if(dd==0)dd=7;";
			echo "    if (dd!=1) for (i=dd;i<8;i++){ s+='<td class=\"empty\">&nbsp;</td>'; if (i==7) s+='</tr>'; }";
			echo "    s+='</table>';";
			echo "    jQuery('#$this->name-dropdown-body').html(s);";
			echo "    jQuery('#$this->name-box').focus();";
			echo "    this.keep_focus = false;";
			echo "  }";



			echo " ,Clicking : false";
			echo " ,OnClick : function (){ if(this.Clicking) return; this.Clicking = true; this.ToggleDropDown(); setTimeout(function(){ $this->name.Clicking = false; },500); }";
			echo " ,ToggleDropDown : function(){ if (jQuery('#$this->name-dropdown').is(':visible')) this.HideDropDown(); else this.ShowDropDown(); }";
			echo " ,Showing : false";
			echo " ,ShowDropDown : function(){";
			echo "    this.Showing = true;";
			echo "    var b = jQuery('#$this->name".($this->show_value?'-box':'-anchor')."');";
			echo "    var d = jQuery('#$this->name-dropdown');";
			echo "    d.show();";
			echo "    var w = d.width();";
			echo "    var ww = b.outerWidth(false) - (d.outerWidth(false) - w);";
			echo "    if (ww > w) d.css({width:ww+'px'});";
			echo "    d.css({'margin-top':(1+b.outerHeight(false))+'px','margin-left':Math.floor((b.outerWidth(false)-d.outerWidth(false))/2)+'px'});";
			echo "    this.is_open = true;";
			echo "    this.ShowMonth(this.date);";
			echo "    jQuery('html').on('click.$this->name', function(e){ if ($this->name.Showing) { $this->name.Showing = false; return; } if($this->name.Clicking)return; if (jQuery('#$this->name-dropdown').has(e.target).length === 0) $this->name.HideDropDown(); });";
			echo "  }";
			echo " ,HideDropDown : function(){";
			echo "    this.keep_focus = false;";
			echo "    this.is_open = false;";
			echo "    jQuery('#$this->name-dropdown').hide();";
			echo "    jQuery('html').off('click.$this->name');";
			echo "    this.ShowPseudoFocus();";
			echo "  }";
			echo " ,ShowPseudoFocus : function(){";
			echo "    jQuery('#$this->name-d').css({'text-decoration':this.pseudo_focus==='d'?'underline':'none'});";
			echo "    jQuery('#$this->name-m').css({'text-decoration':this.pseudo_focus==='m'?'underline':'none'});";
			echo "    jQuery('#$this->name-y').css({'text-decoration':this.pseudo_focus==='y'?'underline':'none'});";
			echo "  }";
			echo " ,HidePseudoFocus : function(){";
			echo "    jQuery('#$this->name-d,#$this->name-m,#$this->name-y').css({'text-decoration':'none'});";
			echo "  }";
			echo "};";

		}
		echo Js::END;


	}
}





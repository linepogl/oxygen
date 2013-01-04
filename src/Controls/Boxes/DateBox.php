<?php

class DateBox extends Box {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '∅';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

	public function Render(){
    if (!($this->value instanceof XDateTime)) {
      $this->value = $this->allow_null ? null : XDate::Today();
		}

		if ($this->mode == UIMode::View || $this->mode == UIMode::Printer) {
			$caption = $this->value instanceof XDateTime ? Language::FormatDate($this->value) : ( $this->allow_null ? $this->null_caption : '' );
			echo new Html($caption);
			return;
		}
		$caption = $this->value instanceof XDateTime ? $this->value->Format('d/m/Y') : ( $this->allow_null ? $this->null_caption : '' );

		echo '<span class="formPane '.($this->readonly?' formLocked':'').'" style="padding:0;border:0;position:relative;display:inline-block;">';

		if (!$this->readonly){
			echo new HiddenControl($this->name,$this->value);
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
			echo '<a id="'.$this->name.'-today" class="button" href="javascript:'.$this->name.'.SetDate('.new Js(XDate::Today()).');">'.new Html(Lemma::Pick('Today')).'</a>';
			echo '<div id="'.$this->name.'-month"></div>';
			echo '<a class="button button-next" href="javascript:'.$this->name.'.ShowNextYear();"></a>';
			echo '<a class="button button-prev" href="javascript:'.$this->name.'.ShowPrevYear();"></a>';
			echo '</div>';
			echo '</div>';
		}

		echo '<span id="'.$this->name.'-anchor" class="formPaneAnchor formDateAnchor">&nbsp;</span>';

		echo '<input id="'.$this->name.'-box"';
		echo ' class="formPane formDate'.($this->readonly?' formLocked':'').'"';
		echo ' style="margin:0;"';
		echo ' value="'.new Html($caption).'"';
		echo ' readonly="readonly"';
		echo '/>';

		echo '</span>';

		echo Js::BEGIN;
		echo "jQuery('#$this->name-anchor').css({'margin-top':jQuery('#$this->name-box').css('padding-top'),'margin-right':jQuery('#$this->name-box').css('padding-right')});";
		if (!$this->readonly){
			echo "jQuery('#$this->name-box,#$this->name-anchor').click(function(e){ $this->name.ToggleDropDown(); }).keydown(function(e){ $this->name.OnKeyDown(e); }).blur(function(e){ $this->name.OnBlur(e); }).focus(function(e){ $this->name.ShowPseudoFocus(); });";
			echo "jQuery('#$this->name-dropdown').mousedown(function(e){ window.$this->name.KeepFocus(); });";
			echo "window.".$this->name." = {";
			echo "  date : ".new Js($this->value);
			echo " ,month : null";
			echo " ,is_open : false";
			echo " ,pseudo_focus : 'd'";
			echo " ,keep_focus : false";
			echo " ,SetDate : function(x){this.SetD(x);this.HideDropDown();}";
			echo " ,SetD : function(x){";
			echo "    this.date=x;";
			echo "    if (x==null){";
			echo "      jQuery('#$this->name-box').val( jQuery('<div/>').html(".new Js($this->null_caption).").text() );"; // This is interesting...
			echo "      jQuery('#$this->name').val('');";
			echo "      this.pseudo_focus = 'd'";
			echo "    }";
			echo "    else {";
			echo "      var day = x.getDate(); if (x.getDate()<10) {day='0'+x.getDate();}";
			echo "      var month = x.getMonth()+1; if ((x.getMonth()+1)<10) {month='0'+(x.getMonth()+1);}";
			echo "      var year = x.getFullYear();";
			echo "      jQuery('#$this->name-box').val(day+'/'+month+'/'+year);";
			echo "      jQuery('#$this->name').val(year+''+month+''+day+'000000');";
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
			echo "    setTimeout(function(){if(!$this->name.keep_focus&&!jQuery('#$this->name-box').is(':focus')){ $this->name.HideDropDown();$this->name.HidePseudoFocus();}},200);";
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
			echo "    var months=new Array(".new Js(Lemma::Pick('Jan.')).",".new Js(Lemma::Pick('Feb.')).",".new Js(Lemma::Pick('Mar.')).",".new Js(Lemma::Pick('Apr.')).",".new Js(Lemma::Pick('May.')).",".new Js(Lemma::Pick('Jun.')).",".new Js(Lemma::Pick('Jul.')).",".new Js(Lemma::Pick('Aug.')).",".new Js(Lemma::Pick('Sep.')).",".new Js(Lemma::Pick('Oct.')).",".new Js(Lemma::Pick('Nov.')).",".new Js(Lemma::Pick('Dec.')).");";
			echo "    var days=new Array(".new Js(substr(Lemma::Pick('Monday'),0,3)).",".new Js(substr(Lemma::Pick('Tuesday'),0,3)).",".new Js(substr(Lemma::Pick('Wednesday'),0,3)).",".new Js(substr(Lemma::Pick('Thursday'),0,3)).",".new Js(substr(Lemma::Pick('Friday'),0,3)).",".new Js(substr(Lemma::Pick('Saturday'),0,3)).",".new Js(substr(Lemma::Pick('Sunday'),0,3)).");";
			echo "    jQuery('#$this->name-month').html(months[cm.getMonth()]+' '+cm.getFullYear());";
			echo "    var s = '';";
			echo "    s+='<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">';";
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



			echo " ,ToggleDropDown : function(){ if (jQuery('#$this->name-dropdown').is(':visible')) this.HideDropDown(); else this.ShowDropDown(); }";
			echo " ,Showing : false";
			echo " ,ShowDropDown : function(){";
			echo "    this.Showing = true;";
			echo "    var b = jQuery('#$this->name-box');";
			echo "    var d = jQuery('#$this->name-dropdown');";
			echo "    d.show();";
			echo "    var w = d.width();";
			echo "    var ww = b.outerWidth(false) - (d.outerWidth(false) - w);";
			echo "    if (ww > w) d.css({width:ww+'px'});";
			echo "    d.css({'margin-top':(1+b.outerHeight(false))+'px','margin-left':Math.floor((b.outerWidth(false)-d.outerWidth(false))/2)+'px'});";
			echo "    this.is_open = true;";
			echo "    this.ShowMonth(this.date);";
			echo "    jQuery('html').on('click.$this->name', function(e){ if ($this->name.Showing) { $this->name.Showing = false; return; } if (jQuery('#$this->name-dropdown').has(e.target).length === 0) $this->name.HideDropDown(); });";
			echo "  }";
			echo " ,HideDropDown : function(){";
			echo "    this.keep_focus = false;";
			echo "    this.is_open = false;";
			echo "    jQuery('#$this->name-dropdown').hide();";
			echo "    jQuery('html').off('click.$this->name');";
			echo "    this.ShowPseudoFocus();";
			echo "  }";
			echo " ,ShowPseudoFocus : function(){";
			echo "    var el = jQuery('#$this->name-box')[0];";
			echo "    var from = this.pseudo_focus==='d'?0:(this.pseudo_focus==='m'?3:6);";
			echo "    var till = this.pseudo_focus==='d'?2:(this.pseudo_focus==='m'?5:10);";
			echo "    if(el.setSelectionRange)el.setSelectionRange(from,till);else{var r=el.createTextRange();r.collapse(true);r.moveEnd('character',till);r.moveStart('character',from);r.select();}";
			echo "  }";
			echo " ,HidePseudoFocus : function(){";
			echo "    var el = jQuery('#$this->name-box')[0];";
			echo "    if(el.setSelectionRange)el.setSelectionRange(0,0);else{var r=el.createTextRange();r.collapse(true);r.moveEnd('character',0);r.moveStart('character',0);r.select();}";
			echo "  }";
			echo "};";

		}
		echo Js::END;


	}
}




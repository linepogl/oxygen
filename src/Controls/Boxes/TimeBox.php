<?php

class TimeBox extends Box {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '∅';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

  private $show_seconds = false;
  public function WithShowSeconds($value){ $this->show_seconds = $value; return $this; }

	public function Render(){
    if (!($this->value instanceof XDateTime)) {
        $this->value = $this->allow_null ? null : XTime::Midnight();
		}

    $caption = !is_null($this->value) ? Language::FormatTime($this->value,$this->show_seconds?'H:i:s':'H:i') : ( $this->allow_null ? $this->null_caption : '' );
		$null_caption = trim($this->null_caption);

		echo HiddenBox::Make($this->name,$this->value)->WithHttpName($this->readonly || $this->mode != UIMode::Edit ? null : $this->http_name);

		if ($this->mode == UIMode::View || $this->mode == UIMode::Printer) {
			echo new Html($caption);
			return;
		}

		$n = $this->allow_null ? $this->null_caption : '';
		$h = is_null($this->value) ? '' : $this->value->Format('H');
		$m = is_null($this->value) ? '' : $this->value->Format('i');
		$s = is_null($this->value) ? '' : $this->value->Format('s');

		echo '<span id="'.$this->name.'-span" class="formPane '.($this->readonly?' formLocked':'').'" style="padding:0;border:0;position:relative;display:inline-block;">';

		if (!$this->readonly){
			echo '<div id="'.$this->name.'-dropdown" class="formDropDown formTimeDropDown" style="display:none;">';
			echo '<div class="formDropDownHook"></div>';
			echo '<div class="formDropDownBody">';
			echo '<div id="'.$this->name.'-clock" class="clock" style="height:180px;">';
			echo '<div style="padding-top:80px;text-align:center;">';
			echo '<span id="'.$this->name.'-h" onclick="window.'.$this->name.'.SetPseudoFocus(\'h\');">'.(is_null($this->value)?'':$this->value->Format('H')).'</span>';
			echo '<span>:</span>';
			echo '<span id="'.$this->name.'-m" onclick="window.'.$this->name.'.SetPseudoFocus(\'m\');">'.(is_null($this->value)?'':$this->value->Format('i')).'</span>';
			if ($this->show_seconds) {
				echo '<span>:</span>';
				echo '<span id="'.$this->name.'-s" onclick="window.'.$this->name.'.SetPseudoFocus(\'s\');">'.(is_null($this->value)?'':$this->value->Format('s')).'</span>';
			}
			echo '</div>';
			echo '</div>';
			echo '</div>';
      echo '<div class="formDropDownFoot">';
			if ($this->allow_null){
          echo '<a id="'.$this->name.'-null" class="fleft button" href="javascript:'.$this->name.'.SetH(null);'.$this->name.'.HideDropDown();">'.new Html($null_caption===''?'∅':$null_caption).'</a>';
      }
			echo '<a class="button button-pm" href="javascript:'.$this->name.'.SetPM();">'.Lemma::Pick('p.m.').'</a>';
			echo '<a class="button button-am" href="javascript:'.$this->name.'.SetAM();">'.Lemma::Pick('a.m.').'</a>';
      echo '</div>';
      echo '</div>';
		}

		echo '<div id="'.$this->name.'-box-null" class="formPaneInnerWrap" style="'.(is_null($this->value)?'':'display:none;').'"><div class="formPane formPaneInner" style="background:none;border:0;margin:0;padding:0;">';
		echo new Html($n);
		echo '</div></div>';

		echo '<div id="'.$this->name.'-box-time" class="formPaneInnerWrap" style="'.(is_null($this->value)?'display:none;':'').'"><div class="formPane formPaneInner" style="background:none;border:0;margin:0;padding:0;">';
		echo '<span id="'.$this->name.'-box-h">'.$h.'</span>:<span id="'.$this->name.'-box-m">'.$m.'</span>'.($this->show_seconds?':<span id="'.$this->name.'-box-s">'.$s.'</span>':'');
		echo '</div></div>';

		echo '<div id="'.$this->name.'-anchor" class="formPaneAnchorWrap formTimeAnchorOuter"><div class="formPaneAnchor formTimeAnchor"></div></div>';

		echo '<input id="'.$this->name.'-box"';
		echo ' class="formPane formTime'.($this->readonly?' formLocked':'').'"';
		echo ' style="margin:0;"';
		echo ' value=""';
		echo ' readonly="readonly"';
		echo '/>';

		echo '</span>';

		echo Js::BEGIN;
		echo "var f = function(){";
		echo "  var x =  jQuery('#$this->name-box');";
		echo "  jQuery('#$this->name-anchor').css({'margin-top':x.css('border-top-width'),'margin-right':x.css('border-right-width'),'padding-top':x.css('padding-top'),'padding-right':x.css('padding-right')});";
		echo "  jQuery('#$this->name-span .formPaneInnerWrap').css({'margin-top':x.css('border-top-width'),'margin-left':x.css('border-left-width'),'padding-top':x.css('padding-top'),'padding-left':x.css('padding-left')});";
		echo "  jQuery('#$this->name-span .formPaneInner').css({'height':x.height()+'px','line-height':x.height()+'px'});";
		echo "};";
		echo "jQuery(document).ready(f);f();";
		if (!$this->readonly){
			echo "jQuery('#$this->name-box,#$this->name-anchor,#$this->name-box-time,#$this->name-box-null').click(function(e){ $this->name.OnClick(); }).keydown(function(e){ $this->name.OnKeyDown(e); }).blur(function(e){ $this->name.OnBlur(e); }).focus(function(e){ $this->name.ShowPseudoFocus(); });";
			echo "jQuery('#$this->name-dropdown').mousedown(function(e){ window.$this->name.KeepFocus(); });";
			echo "window.".$this->name." = {";
			echo "  pseudo_focus : 'h'";
			echo " ,is_open : false";
			echo " ,keep_focus : false";
			echo " ,h : ".new Js(is_null($this->value) ? null : $this->value->Format('H'));
			echo " ,m : ".new Js(is_null($this->value) ? null : $this->value->Format('i'));
			echo " ,s : ".new Js(is_null($this->value) ? null : $this->value->Format('s'));
			echo " ,SetH : function(x){if(x===null){this.h=this.m=this.s=null;this.pseudo_focus='h';}else{ if(x<0)x+=24;x%=24;this.h=x<10?'0'+x:''+x;if(this.m===null)this.m='00';if(this.s===null)this.s='00';this.pseudo_focus='h'; } this.OnChange(); this.Update(); }";
			echo " ,SetM : function(x){if(x===null){this.h=this.m=this.s=null;this.pseudo_focus='h';}else{ if(x<0)x+=60;x%=60;this.m=x<10?'0'+x:''+x;if(this.s===null)this.s='00';if(this.h===null)this.h='00';this.pseudo_focus='m'; } this.OnChange(); this.Update(); }";
			echo " ,SetS : function(x){if(x===null){this.h=this.m=this.s=null;this.pseudo_focus='h';}else{ if(x<0)x+=60;x%=60;this.s=x<10?'0'+x:''+x;if(this.h===null)this.h='00';if(this.m===null)this.m='00';this.pseudo_focus='s'; } this.OnChange(); this.Update(); }";
			echo " ,SetAM : function(){ this.SetH( this.h===null ? 0 : parseInt(this.h,10) % 12 ); }";
			echo " ,SetPM : function(){ this.SetH( this.h===null ? 12 : parseInt(this.h,10) % 12 + 12 ); }";
			echo " ,OnChange : function(){";
			echo "    if(this.h===null){";
			echo "      jQuery('#$this->name-box-null').show();";
			echo "      jQuery('#$this->name-box-time').hide();";
			echo "      jQuery('#$this->name').val('');";
			echo "    }";
			echo "    else {";
			echo "      jQuery('#$this->name-box-null').hide();";
			echo "      jQuery('#$this->name-box-time').show();";
			echo "      jQuery('#$this->name-box-h').html(this.h);";
			echo "      jQuery('#$this->name-box-m').html(this.m);";
			echo "      jQuery('#$this->name-box-s').html(this.s);";
			echo "      jQuery('#$this->name').val('20000000'+this.h+this.m+this.s);";
			echo "    }";
			echo $this->on_change;
			echo "  }";
			echo " ,OnKeyDown : function(ev){";
			echo "    switch(ev.which){";
			echo "      case 13:case 27:if(this.is_open){this.HideDropDown();ev.preventDefault();}break;";
			echo "      case 32:this.ToggleDropDown();break;";
			if ($this->allow_null){
				echo "    case 8:case 46:this.SetH(null);ev.preventDefault();break;";
			}
			if ($this->show_seconds)
				echo "      case 9:if(this.h===null)return;if(this.pseudo_focus==='h'&&!ev.shiftKey)this.SetPseudoFocus('m');else if(this.pseudo_focus==='m')this.SetPseudoFocus(ev.shiftKey?'h':'s');else if(this.pseudo_focus==='s'&&ev.shiftKey)this.SetPseudoFocus('m');else return;ev.preventDefault();break;";
			else
				echo "      case 9:if(this.h===null)return;if(this.pseudo_focus==='h'&&!ev.shiftKey)this.SetPseudoFocus('m');else if(this.pseudo_focus==='m'&&ev.shiftKey)this.SetPseudoFocus('h');else return;ev.preventDefault();break;";
			echo "      case 38:case 39:if(this.pseudo_focus=='h')this.SetH(this.h===null?0:(parseInt(this.h,10)+1)); else if(this.pseudo_focus=='m')this.SetM(this.m===null?0:(parseInt(this.m,10)+1)); else if(this.pseudo_focus=='s')this.SetS(this.s===null?0:(parseInt(this.s,10)+1)); break;";
			echo "      case 40:case 37:if(this.pseudo_focus=='h')this.SetH(this.h===null?0:(parseInt(this.h,10)-1)); else if(this.pseudo_focus=='m')this.SetM(this.m===null?0:(parseInt(this.m,10)-1)); else if(this.pseudo_focus=='s')this.SetS(this.s===null?0:(parseInt(this.s,10)-1)); break;";
			echo "    }";
			echo "  }";
			echo " ,OnBlur : function(ev){";
			echo "    setTimeout(function(){if(!$this->name.keep_focus&&!jQuery('#$this->name-box').is(':focus')){ $this->name.HideDropDown();$this->name.HidePseudoFocus(); }},200);";
			echo "  }";
			echo " ,SetPseudoFocus : function(f){ this.pseudo_focus=f; this.Update(); }";
			echo " ,KeepFocus : function(){ this.keep_focus = true; setTimeout(function(){ $this->name.Update(); },500); }";
      echo " ,Update : function(){";
			echo "    this.ShowPseudoFocus();";
			echo "    if (!this.is_open) return;";
			echo "    jQuery('#$this->name-h').html(this.h);";
			echo "    jQuery('#$this->name-m').html(this.m);";
			echo "    jQuery('#$this->name-s').html(this.s);";
      echo "    if (this.pseudo_focus==='h') {";
			echo "      var xo=90,yo=90,R=75,r=6,s='',v=parseInt(this.h,10),o=v<12?0:12;";
      echo "      jQuery('#$this->name-clock a').detach();";
      echo "      for(var i = o; i < o+12; i++){";
      echo "        var x = Math.floor(xo - r - R * Math.cos((i-o) * Math.PI / 6));";
      echo "        var y = Math.floor(yo - r + R * Math.sin((i-o) * Math.PI / 6));";
      echo "        s += '<a id=\"$this->name-h-'+(i<10?'0':'')+i+'\" href=\"javascript:$this->name.SetH('+i+');\" class=\"'+(i==v?'selected':'')+'\" style=\"width:'+(2*r)+'px;height:'+(2*r)+'px;margin:'+x+'px 0 0 '+y+'px;\">'+".new Js(new Spacer())."+'</a>'";
      echo "      }";
      echo "      jQuery('#$this->name-clock').prepend(s);";
			echo "      jQuery('#$this->name-clock span').removeClass('focus');";
      echo "      jQuery('#$this->name-h').addClass('focus');";
      echo "    }";
			echo "    else if (this.pseudo_focus==='m') {";
			echo "      var xo=90,yo=90,R=85,r1=5,r2=2,s='',v=parseInt(this.m,10);";
			echo "      jQuery('#$this->name-clock a').detach();";
			echo "      for(var i = 0; i < 60; i++){";
			echo "        var r = i%5==0 ? r1 : r2;";
			echo "        var x = Math.floor(xo - r - R * Math.cos(i * Math.PI / 30));";
			echo "        var y = Math.floor(yo - r + R * Math.sin(i * Math.PI / 30));";
			echo "        s += '<a id=\"$this->name-m-'+(i<10?'0':'')+i+'\" href=\"javascript:$this->name.SetM('+i+');\" class=\"'+(i==v?'selected':'')+'\" style=\"width:'+(2*r)+'px;height:'+(2*r)+'px;margin:'+x+'px 0 0 '+y+'px;\">'+".new Js(new Spacer())."+'</a>'";
			echo "      }";
			echo "      jQuery('#$this->name-clock').prepend(s);";
			echo "      jQuery('#$this->name-clock span').removeClass('focus');";
			echo "      jQuery('#$this->name-m').addClass('focus');";
			echo "    }";
			echo "    else if (this.pseudo_focus==='s') {";
			echo "      var xo=90,yo=90,R=85,r1=5,r2=2,s='',v=parseInt(this.s,10);";
			echo "      jQuery('#$this->name-clock a').detach();";
			echo "      for(var i = 0; i < 60; i++){";
			echo "        var r = i%5==0 ? r1 : r2;";
			echo "        var x = Math.floor(xo - r - R * Math.cos(i * Math.PI / 30));";
			echo "        var y = Math.floor(yo - r + R * Math.sin(i * Math.PI / 30));";
			echo "        s += '<a id=\"$this->name-s-'+(i<10?'0':'')+i+'\" href=\"javascript:$this->name.SetS('+i+');\" class=\"'+(i==v?'selected':'')+'\" style=\"width:'+(2*r)+'px;height:'+(2*r)+'px;margin:'+x+'px 0 0 '+y+'px;\">'+".new Js(new Spacer())."+'</a>'";
			echo "      }";
			echo "      jQuery('#$this->name-clock').prepend(s);";
			echo "      jQuery('#$this->name-clock span').removeClass('focus');";
			echo "      jQuery('#$this->name-s').addClass('focus');";
			echo "    }";
			echo "    jQuery('#$this->name-box').focus();";
			echo "    this.keep_focus = false;";
      echo "  }";
			echo " ,Clicking : false";
			echo " ,OnClick : function (){ if(this.Clicking) return; this.Clicking = true; this.ToggleDropDown(); setTimeout(function(){ $this->name.Clicking = false; },500); }";
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
			echo "    this.Update();";
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
			echo "    jQuery('#$this->name-box-h').css({'text-decoration':this.pseudo_focus==='h'?'underline':'none'});";
			echo "    jQuery('#$this->name-box-m').css({'text-decoration':this.pseudo_focus==='m'?'underline':'none'});";
			echo "    jQuery('#$this->name-box-s').css({'text-decoration':this.pseudo_focus==='s'?'underline':'none'});";
			echo "  }";
			echo " ,HidePseudoFocus : function(){";
			echo "    jQuery('#$this->name-box-h,#$this->name-box-m,#$this->name-box-s').css({'text-decoration':'none'});";
			echo "  }";
			echo "};";
		}
		echo Js::END;


	}
}





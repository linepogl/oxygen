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

    $caption = $this->value instanceof XDateTime ? Language::FormatTime($this->value,$this->show_seconds?'H:i:s':'H:i') : ( $this->allow_null ? $this->null_caption : '' );
		$null_caption = trim($this->null_caption);

		if ($this->mode == UIMode::View || $this->mode == UIMode::Printer) {
			echo new Html($caption);
			return;
		}

		echo '<span';
		echo ' class="formPane '.($this->readonly?' formLocked':'').'"';
		echo ' style="padding:0;border:0;position:relative;"';
		echo '>';


		if (!$this->readonly){
			echo new HiddenControl($this->name,$this->value);
			echo '<div id="'.$this->name.'-dropdown" class="formDropDown formTimeDropDown" style="display:none;">';
			echo '<div class="formDropDownHook"></div>';
//			echo '<div class="formDropDownHead">';
//			echo '</div>';

			echo '<div class="formDropDownBody">';
			echo '<div id="'.$this->name.'-clock" class="clock" style="height:180px;">';
			echo '<div style="padding-top:80px;text-align:center;">';


			echo '<input class="input" readonly="readonly" id="'.$this->name.'-h" value="'.(is_null($this->value)?'':$this->value->Format('H')).'"/>';
			echo ' : ';
			echo '<input class="input" readonly="readonly" id="'.$this->name.'-m" value="'.(is_null($this->value)?'':$this->value->Format('i')).'"/>';
			if ($this->show_seconds) {
				echo ' : ';
				echo '<input class="input" readonly="readonly" id="'.$this->name.'-s" value="'.(is_null($this->value)?'':$this->value->Format('s')).'"/>';
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

		echo '<span id="'.$this->name.'-anchor" class="formPaneAnchor formTimeAnchor">&nbsp;</span>';

		echo '<input id="'.$this->name.'-box"';
		echo ' class="formPane formTime'.($this->readonly?' formLocked':'').'"';
		echo ' style="margin:0;"';
		echo ' value="'.new Html($caption).'"';
		echo ' readonly="readonly"';
		echo '/>';

		echo '</span>';

		echo Js::BEGIN;
		echo "jQuery('#$this->name-anchor').css({'margin-top':jQuery('#$this->name-box').css('padding-top'),'margin-right':jQuery('#$this->name-box').css('padding-right')});";
		if (!$this->readonly){
			echo "jQuery('#$this->name-box,#$this->name-anchor').keydown(function(e){ $this->name.OnKeyDown(e); }).click(function(e){ $this->name.ToggleDropDown(); });";
			echo "jQuery('#$this->name-h').focus(function(e){ $this->name.focus='h';$this->name.ShowH();$this->name.Unselect(this); }).blur(function(e){ $this->name.OnBlur(e); }).keydown(function(e){ $this->name.OnKeyDown(e); });";
			echo "jQuery('#$this->name-m').focus(function(e){ $this->name.focus='m';$this->name.ShowM();$this->name.Unselect(this); }).blur(function(e){ $this->name.OnBlur(e); }).keydown(function(e){ $this->name.OnKeyDown(e); });";
			echo "jQuery('#$this->name-s').focus(function(e){ $this->name.focus='s';$this->name.ShowS();$this->name.Unselect(this); }).blur(function(e){ $this->name.OnBlur(e); }).keydown(function(e){ $this->name.OnKeyDown(e); });";
			echo "jQuery('#$this->name-dropdown').mousedown(function(e){ $this->name.KeepFocus=true; }).mouseup(function(e){ setTimeout(function(){jQuery('#$this->name-'+$this->name.focus).focus();$this->name.KeepFocus=false;},100); });";
			echo "window.".$this->name." = {";
			echo "  focus : null";
			echo " ,h : ".new Js(is_null($this->value) ? null : $this->value->Format('H'));
			echo " ,m : ".new Js(is_null($this->value) ? null : $this->value->Format('i'));
			echo " ,s : ".new Js(is_null($this->value) ? null : $this->value->Format('s'));
			echo " ,Unselect : function(el){ if (el.setSelectionRange) el.setSelectionRange(0,0); else if (input.createTextRange) { var range = el.createTextRange(); range.collapse(true); range.moveEnd('character',0); range.moveStart('character',0); range.select();}}";
			echo " ,SetH : function(x){ if (x===null) { this.h=this.m=this.s=null; } else { if(x<0)x+=24;x%=24;this.h=x<10?'0'+x:''+x;if(this.m===null)this.m='00'; if(this.s===null)this.s='00'; } this.OnChange();jQuery('#$this->name-h').focus(); }";
			echo " ,SetM : function(x){ if (x===null) { this.h=this.m=this.s=null; } else { if(x<0)x+=60;x%=60;this.m=x<10?'0'+x:''+x;if(this.s===null)this.s='00'; if(this.h===null)this.h='00'; } this.OnChange();jQuery('#$this->name-m').focus(); }";
			echo " ,SetS : function(x){ if (x===null) { this.h=this.m=this.s=null; } else { if(x<0)x+=60;x%=60;this.s=x<10?'0'+x:''+x;if(this.h===null)this.h='00'; if(this.m===null)this.m='00'; } this.OnChange();jQuery('#$this->name-s').focus(); }";
			echo " ,SetAM : function(){ this.SetH( this.h===null ? 0 : parseInt(this.h,10) % 12 ); }";
			echo " ,SetPM : function(){ this.SetH( this.h===null ? 12 : parseInt(this.h,10) % 12 + 12 ); }";
			echo " ,IncH : function(){ this.SetH( this.h===null ? 0 : (parseInt(this.h,10)+1) );}";
			echo " ,DecH : function(){ this.SetH( this.h===null ? 0 : (parseInt(this.h,10)-1) );}";
			echo " ,IncM : function(){ this.SetM( this.m===null ? 0 : (parseInt(this.m,10)+1) );}";
			echo " ,DecM : function(){ this.SetM( this.m===null ? 0 : (parseInt(this.m,10)-1) );}";
			echo " ,IncS : function(){ this.SetS( this.s===null ? 0 : (parseInt(this.s,10)+1) );}";
			echo " ,DecS : function(){ this.SetS( this.s===null ? 0 : (parseInt(this.s,10)-1) );}";
			echo " ,OnChange : function(){";
			echo "    jQuery('#$this->name-h').val(this.h);";
			echo "    jQuery('#$this->name-m').val(this.m);";
			echo "    jQuery('#$this->name-s').val(this.s);";
			echo "    jQuery('#$this->name-box').val( this.h===null ? ".new Js($null_caption)." : this.h+':'+this.m".($this->show_seconds?"+':'+this.s":"").");";
			echo "    jQuery('#$this->name').val(this.h===null?'':'20000000'+this.h+this.m+this.s);";
			echo $this->on_change;
			echo "  }";
			echo " ,OnKeyDown : function(ev){";
			echo "   if (this.focus===null){ switch(ev.which){case 38:case 40:case 32:this.ShowDropDown();} }";
			echo "   else if (this.focus==='h'){ switch(ev.which){case 38:this.IncH();break;case 40:this.DecH();break;case 13:case 32:jQuery('#$this->name-box').focus();ev.preventDefault();}}";
			echo "   else if (this.focus==='m'){ switch(ev.which){case 38:this.IncM();break;case 40:this.DecM();break;case 13:case 32:jQuery('#$this->name-box').focus();ev.preventDefault();}}";
			echo "   else if (this.focus==='s'){ switch(ev.which){case 38:this.IncS();break;case 40:this.DecS();break;case 13:case 32:jQuery('#$this->name-box').focus();ev.preventDefault();}}";
			echo "  }";
			echo " ,KeepFocus : false";
			echo " ,OnBlur : function(ev){";
			echo "    if ($this->name.KeepFocus) return;";
			echo "    setTimeout(function(){";
			echo "      if (jQuery('#$this->name-h:focus,#$this->name-m:focus,#$this->name-s:focus').length>0) return;";
			echo "      $this->name.HideDropDown();";
			echo "    },100);";
			echo "  }";
      echo " ,ShowH : function(){";
      echo "    var xo=90,yo=90,R=75,r=6,s='',v=parseInt(this.h,10),o=v<12?0:12;";
      echo "    jQuery('#$this->name-clock a').detach();";
      echo "    for(var i = o; i < o+12; i++){";
      echo "      var x = Math.floor(xo - r - R * Math.cos(i * Math.PI / 6));";
      echo "      var y = Math.floor(yo - r + R * Math.sin(i * Math.PI / 6));";
      echo "      s += '<a id=\"$this->name-h-'+(i<10?'0':'')+i+'\" href=\"javascript:$this->name.SetH('+i+');\" class=\"'+(i==v?'selected':'')+'\" style=\"width:'+(2*r)+'px;height:'+(2*r)+'px;margin:'+x+'px 0 0 '+y+'px;\">'+".new Js(new Spacer())."+'</a>'";
      echo "    }";
      echo "    jQuery('#$this->name-clock').prepend(s);";
      echo "  }";
      echo " ,ShowM : function(){";
      echo "    var xo=90,yo=90,R=85,r1=5,r2=2,s='',v=parseInt(this.m,10);";
      echo "    jQuery('#$this->name-clock a').detach();";
      echo "    for(var i = 0; i < 60; i++){";
      echo "      var r = i%5==0 ? r1 : r2;";
      echo "      var x = Math.floor(xo - r - R * Math.cos(i * Math.PI / 30));";
      echo "      var y = Math.floor(yo - r + R * Math.sin(i * Math.PI / 30));";
      echo "      s += '<a id=\"$this->name-m-'+(i<10?'0':'')+i+'\" href=\"javascript:$this->name.SetM('+i+');\" class=\"'+(i==v?'selected':'')+'\" style=\"width:'+(2*r)+'px;height:'+(2*r)+'px;margin:'+x+'px 0 0 '+y+'px;\">'+".new Js(new Spacer())."+'</a>'";
      echo "    }";
      echo "    jQuery('#$this->name-clock').prepend(s);";
      echo "  }";
      echo " ,ShowS : function(){";
      echo "    var xo=90,yo=90,R=85,r1=5,r2=2,s='',v=parseInt(this.s,10);";
      echo "    jQuery('#$this->name-clock a').detach();";
      echo "    for(var i = 0; i < 60; i++){";
      echo "      var r = i%5==0 ? r1 : r2;";
      echo "      var x = Math.floor(xo - r - R * Math.cos(i * Math.PI / 30));";
      echo "      var y = Math.floor(yo - r + R * Math.sin(i * Math.PI / 30));";
      echo "      s += '<a id=\"$this->name-s-'+(i<10?'0':'')+i+'\" href=\"javascript:$this->name.SetS('+i+');\" class=\"'+(i==v?'selected':'')+'\" style=\"width:'+(2*r)+'px;height:'+(2*r)+'px;margin:'+x+'px 0 0 '+y+'px;\">'+".new Js(new Spacer())."+'</a>'";
      echo "    }";
      echo "    jQuery('#$this->name-clock').prepend(s);";
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
            echo "    jQuery('#$this->name-h').focus();";
			echo "    jQuery('html').on('click.$this->name', function(e){ if ($this->name.Showing) { $this->name.Showing = false; return; } if (jQuery('#$this->name-dropdown').has(e.target).length === 0) $this->name.HideDropDown(); });";
			echo "  }";
			echo " ,HideDropDown : function(){";
			echo "    this.focus = null;";
			echo "    this.KeepFocus = false;";
			echo "    jQuery('#$this->name-dropdown').hide();";
			echo "    jQuery('html').off('click.$this->name');";
			echo "  }";
			echo "};";

		}
		echo Js::END;


	}
}





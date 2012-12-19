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
            echo '<input class="input" id="'.$this->name.'-h" value="'.(is_null($this->value)?'':$this->value->Format('H')).'"/>';
            echo ' : ';
            echo '<input class="input" id="'.$this->name.'-m" value="'.(is_null($this->value)?'':$this->value->Format('i')).'"/>';
            if ($this->show_seconds) {
                echo ' : ';
                echo '<input class="input" id="'.$this->name.'-s" value="'.(is_null($this->value)?'':$this->value->Format('s')).'"/>';
            }
            echo '</div>';

            echo '</div>';




			echo '</div>';
            echo '<div class="formDropDownFoot">';
            if ($this->allow_null){
                $null_caption = trim($this->null_caption);
                echo '<a id="'.$this->name.'-null" class="fleft button" href="javascript:'.$this->name.'.SetTime(null);">'.new Html($null_caption===''?'∅':$null_caption).'</a>';
            }
            echo '<a class="button button-next1" href="javascript:'.$this->name.'.SetAM();">'.Lemma::Pick('a.m.').'</a>';
            echo '<a class="button button-prev1" href="javascript:'.$this->name.'.SetPM();">'.Lemma::Pick('p.m.').'</a>';
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
			echo "jQuery('#$this->name-box,#$this->name-anchor').click(function(e){ $this->name.ToggleDropDown(); });";
			echo "jQuery('#$this->name-h').focus(function(e){ $this->name.ShowH(); });";
			echo "jQuery('#$this->name-m').focus(function(e){ $this->name.ShowM(); });";
			echo "jQuery('#$this->name-s').focus(function(e){ $this->name.ShowS(); });";
			echo "window.".$this->name." = {";
			echo "  date : ".new Js($this->value);
			echo " ,month : ".new Js($this->value);
			echo " ,SetH : function(x){ jQuery('#$this->name-h').val(x).focus();}";
			echo " ,SetM : function(x){ jQuery('#$this->name-m').val(x).focus();}";
			echo " ,SetAM : function(){ this.SetH(parseInt( jQuery('#$this->name-h').val()%12 ));}";
			echo " ,SetPM : function(){ this.SetH(parseInt( 12+jQuery('#$this->name-h').val()%12 ));}";
			echo " ,SetTime : function(x){";
			echo "    this.date=x;";
			echo "    if (x==null){";
			echo "      jQuery('#$this->name-box').val( jQuery('<div/>').html(".new Js($this->null_caption).").text() );"; // This is interesting...
			echo "      jQuery('#$this->name').val('');";
			echo '    }';
			echo '    else {';
			echo "      var day = x.getDate(); if (x.getDate()<10) {day='0'+x.getDate();}";
			echo "      var month = x.getMonth()+1; if ((x.getMonth()+1)<10) {month='0'+(x.getMonth()+1);}";
			echo "      var year = x.getFullYear();";
			echo "      jQuery('#$this->name-box').val(day+'/'+month+'/'+year);";
			echo "      jQuery('#$this->name').val(year+''+month+''+day+'000000');";
			echo "    }";
			echo "    this.HideDropDown();";
			echo $this->on_change;
			echo "  }";
            echo " ,ShowH : function(){";
            echo "    var xo=90,yo=90,R=75,r=6,s='',h=parseInt(jQuery('#$this->name-h').val()),o=h<12?0:12;";
            echo "    jQuery('#$this->name-clock a').detach();";
            echo "    for(var i = o; i < o+12; i++){";
            echo "      var x = Math.floor(xo - r - R * Math.cos(i * Math.PI / 6));";
            echo "      var y = Math.floor(yo - r + R * Math.sin(i * Math.PI / 6));";
            echo "      s += '<a href=\"javascript:$this->name.SetH('+i+');\" class=\"'+(i==h?'selected':'')+'\" style=\"width:'+(2*r)+'px;height:'+(2*r)+'px;margin:'+x+'px 0 0 '+y+'px;\">'+".new Js(new Spacer())."+'</a>'";
            echo "    }";
            echo "    jQuery('#$this->name-clock').prepend(s);";
            echo "  }";
            echo " ,ShowM : function(){";
            echo "    var xo=90,yo=90,R=85,r1=5,r2=2,s='',m=parseInt(jQuery('#$this->name-m').val());";
            echo "    jQuery('#$this->name-clock a').detach();";
            echo "    for(var i = 0; i < 60; i++){";
            echo "      var r = i%5==0 ? r1 : r2;";
            echo "      var x = Math.floor(xo - r - R * Math.cos(i * Math.PI / 30));";
            echo "      var y = Math.floor(yo - r + R * Math.sin(i * Math.PI / 30));";
            echo "      s += '<a href=\"javascript:$this->name.SetM('+i+');\" class=\"'+(i==m?'selected':'')+'\" style=\"width:'+(2*r)+'px;height:'+(2*r)+'px;margin:'+x+'px 0 0 '+y+'px;\">'+".new Js(new Spacer())."+'</a>'";
            echo "    }";
            echo "    jQuery('#$this->name-clock').prepend(s);";
            echo "  }";


			echo " ,ShowPrevYear:function(){if(this.month)this.ShowMonth(new Date(this.month.getFullYear(),this.month.getMonth(),1).add({years:-1}));}";
			echo " ,ShowNextYear:function(){if(this.month)this.ShowMonth(new Date(this.month.getFullYear(),this.month.getMonth(),1).add({years:1}));}";
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
			echo "    jQuery('#$this->name-dropdown').hide();";
			echo "    jQuery('html').off('click.$this->name');";
			echo "  }";
			echo "};";

		}
		echo Js::END;


	}
}





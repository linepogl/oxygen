<?php

class TimeBox extends Box {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '∅';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

  private $show_seconds = false;
  public function WithShowSeconds($value){ $this->show_seconds = $value; return $this; }


	private $simple = false;
	public function WithSimple($value){ $this->simple = $value; return $this; }

	public function Render(){
		$ns = $this->name;

    if (!($this->value instanceof XDateTime)) {
      $this->value = $this->allow_null ? null : XTime::Midnight();
		}

    $caption = !is_null($this->value) ? Language::FormatTime($this->value,$this->show_seconds?'H:i:s':'H:i') : ( $this->allow_null ? $this->null_caption : '' );
		$null_caption = trim($this->null_caption);

		echo HiddenBox::Make($ns,$this->value)->WithHttpName($this->readonly || $this->mode != UIMode::Edit ? null : $this->http_name);

		if ($this->mode == UIMode::View || $this->mode == UIMode::Printer) {
			echo new Html($caption);
			return;
		}

		$n = $this->allow_null ? $this->null_caption : '';
		$h = is_null($this->value) ? '' : $this->value->Format('H');
		$m = is_null($this->value) ? '' : $this->value->Format('i');
		$s = is_null($this->value) ? '' : $this->value->Format('s');


		if ($this->simple) {
			echo SelectBox::Make($ns.'_h',$h)->WithHttpName(null)->WithReadOnly($this->readonly)->WithOnChange("window.$ns.OnChange();")->WithAllowNull($this->allow_null)->AddMany(array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23'));
			echo SelectBox::Make($ns.'_m',$m)->WithHttpName(null)->WithReadOnly($this->readonly)->WithOnChange("window.$ns.OnChange();")->WithAllowNull($this->allow_null)->AddMany(array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59'));
			echo SelectBox::Make($ns.'_s',$s)->WithHttpName(null)->WithReadOnly($this->readonly)->WithOnChange("window.$ns.OnChange();")->WithAllowNull($this->allow_null)->AddMany(array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59'))->WithCssStyle($this->show_seconds?'':'display:none;');

			if (!$this->readonly) {
				echo Js::BEGIN;
				echo "window.".$ns." = {";
				echo "  OnChange : function(){";
				echo "    var s = '20000101';";
				echo "    s+=jQuery('#{$ns}_h').val();";
				echo "    s+=jQuery('#{$ns}_m').val();";
				echo "    s+=".($this->show_seconds?"jQuery('#{$ns}_s').val()":"'00'").";";
				echo "    jQuery('#$ns').val( s.length===14 ? s : '' );";
				echo $this->on_change;
				echo "  }";
				echo " ,SetDate:function(d){";
				echo "    if(d===null){";
				echo "      jQuery('#{$ns}_h').val(".($this->allow_null?"''":"'00'").");";
				echo "      jQuery('#{$ns}_m').val(".($this->allow_null?"''":"'00'").");";
				echo "      jQuery('#{$ns}_s').val(".($this->allow_null?"''":"'00'").");";
				echo "    }";
				echo "    else {";
				echo "      var x = d.getHours();   jQuery('#{$ns}_h').val(x<10?'0'+x:''+x);";
				echo "      var x = d.getMinutes(); jQuery('#{$ns}_m').val(x<10?'0'+x:''+x);";
				echo "      var x = d.getSeconds(); jQuery('#{$ns}_s').val(x<10?'0'+x:''+x);";
				echo "    }";
				echo "    this.OnChange();";
				echo "  }";
				echo " ,GetDate:function(d){";
				echo "    var h = jQuery('#{$ns}_h').val(); if(h==='')return null; h=parseInt(h,10);";
				echo "    var m = jQuery('#{$ns}_m').val(); if(m==='')return null; m=parseInt(m,10);";
				echo "    var s = jQuery('#{$ns}_s').val(); if(s==='')return null; s=parseInt(s,10);";
				echo "    return new Date(2000,01,01,h,m,s);";
				echo "  }";
				echo "};";
				echo Js::END;
			}
		}
		else {
			echo '<span id="'.$ns.'-span" class="formPane '.($this->readonly?' formLocked':'').'" style="padding:0;border:0;position:relative;display:inline-block;">';

			if (!$this->readonly){
				echo '<div id="'.$ns.'-dropdown" class="formDropDown formTimeDropDown" style="display:none;">';
				echo '<div class="formDropDownHook"></div>';
				echo '<div class="formDropDownBody">';
				echo '<div id="'.$ns.'-clock" class="clock" style="height:180px;">';
				echo '<div style="padding-top:80px;text-align:center;">';
				echo '<span id="'.$ns.'-h" onclick="window.'.$ns.'.SetPseudoFocus(\'h\');">'.(is_null($this->value)?'':$this->value->Format('H')).'</span>';
				echo '<span>:</span>';
				echo '<span id="'.$ns.'-m" onclick="window.'.$ns.'.SetPseudoFocus(\'m\');">'.(is_null($this->value)?'':$this->value->Format('i')).'</span>';
				if ($this->show_seconds) {
					echo '<span>:</span>';
					echo '<span id="'.$ns.'-s" onclick="window.'.$ns.'.SetPseudoFocus(\'s\');">'.(is_null($this->value)?'':$this->value->Format('s')).'</span>';
				}
				echo '</div>';
				echo '</div>';
				echo '</div>';
	      echo '<div class="formDropDownFoot">';
				if ($this->allow_null){
	          echo '<a id="'.$ns.'-null" class="fleft button" href="javascript:'.$ns.'.SetH(null);'.$ns.'.HideDropDown();">'.new Html($null_caption===''?'∅':$null_caption).'</a>';
	      }
				echo '<a class="button button-pm" href="javascript:'.$ns.'.SetPM();">'.oxy::txtPM().'</a>';
				echo '<a class="button button-am" href="javascript:'.$ns.'.SetAM();">'.oxy::txtAM().'</a>';
	      echo '</div>';
	      echo '</div>';
			}

			echo '<div id="'.$ns.'-box-null" class="formPaneInnerWrap" style="'.(is_null($this->value)?'':'display:none;').'"><div class="formPane formPaneInner" style="background:none;border:0;margin:0;padding:0;">';
			echo new Html($n);
			echo '</div></div>';

			echo '<div id="'.$ns.'-box-time" class="formPaneInnerWrap" style="'.(is_null($this->value)?'display:none;':'').'"><div class="formPane formPaneInner" style="background:none;border:0;margin:0;padding:0;">';
			echo '<span id="'.$ns.'-box-h">'.$h.'</span>:<span id="'.$ns.'-box-m">'.$m.'</span>'.($this->show_seconds?':<span id="'.$ns.'-box-s">'.$s.'</span>':'');
			echo '</div></div>';

			echo '<div id="'.$ns.'-anchor" class="formPaneAnchorWrap formTimeAnchorOuter"><div class="formPaneAnchor">'.oxy::icoTime().'</div></div>';

			echo '<input id="'.$ns.'-box"';
			echo ' class="formPane formTime'.($this->readonly?' formLocked':'').'"';
			echo ' style="margin:0;"';
			echo ' value=""';
			echo ' readonly="readonly"';
			echo '/>';

			echo '</span>';

			echo Js::BEGIN;
			echo "var f=function(){";
			echo "var x=jQuery('#$ns-box');";
			echo "jQuery('#$ns-anchor').css({'margin-top':x.css('border-top-width'),'margin-right':x.css('border-right-width'),'padding-top':x.css('padding-top'),'padding-right':x.css('padding-right')});";
			echo "jQuery('#$ns-span .formPaneInnerWrap').css({'margin-top':x.css('border-top-width'),'margin-left':x.css('border-left-width'),'padding-top':x.css('padding-top'),'padding-left':x.css('padding-left')});";
			echo "jQuery('#$ns-span .formPaneInner').css({'height':x.height()+'px','line-height':x.height()+'px'});";
			echo "};";
			echo "jQuery(document).ready(f);f();";
			if (!$this->readonly){
				echo "jQuery('#$ns-box,#$ns-anchor,#$ns-box-time,#$ns-box-null').click(function(e){{$ns}.OnClick();}).keydown(function(e){{$ns}.OnKeyDown(e);}).blur(function(e){{$ns}.OnBlur(e);}).focus(function(e){{$ns}.ShowPseudoFocus();});";
				echo "jQuery('#$ns-dropdown').mousedown(function(e){window.$ns.KeepFocus();});";
				echo "Oxygen.TimeBox({ns:".new Js($ns);
				echo ",h:".new Js(is_null($this->value) ? null : $this->value->Format('H'));
				echo ",m:".new Js(is_null($this->value) ? null : $this->value->Format('i'));
				echo ",s:".new Js(is_null($this->value) ? null : $this->value->Format('s'));
				if($this->allow_null) echo ",allow_null:true";
				if($this->show_seconds) echo ",show_seconds:true";
				if($this->on_change!='') echo ",on_change:function(){{$this->on_change}}";
				echo "});";
			}
			echo Js::END;
		}

	}
}





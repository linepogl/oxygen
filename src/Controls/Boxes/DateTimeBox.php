<?php

class DateTimeBox extends Box {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '∅';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

	private $show_seconds = false;
	public function WithShowSeconds($value){ $this->show_seconds = $value; return $this; }

	private $simple = false;
	public function WithSimple($value){ $this->simple = $value; return $this; }

	private $_24 = false;
	public function With24($value){ $this->_24 = $value; return $this; }




	public function Render(){
		$readonly = $this->readonly || $this->mode != UIMode::Edit;
		echo HiddenBox::Make($this->name,$this->value)->WithHttpName($readonly ? null : $this->http_name);

		if ($readonly) {

			if ($this->_24)
				echo oxy::AbbrDateTime24($this->value);
			else
				echo oxy::AbbrDateTime($this->value);

		}

		elseif ($this->_24) {
			$date = null;
			$time = null;
			if ($this->value instanceof XDateTime){
				$date = $this->value->GetDate();
				$time = $this->value->GetTime();
				if ($time->Format('His')==='000000') $date = $date->AddDays(-1);
			}
			elseif (!$this->allow_null) {
				$date = XDate::Today();
				$time = XTime::Midnight();
			}
			$h = $time === null ? '' : $time->Format('H');
			$m = $time === null ? '' : $time->Format('i');
			$s = $time === null ? '' : $time->Format('s');
			if ("$h$m$s" === '000000') $h = '24';


			DateBox::Make($this->name . '_date' , $date )
				->WithHttpName(null)
				->WithMode($this->mode)
				->WithReadOnly($this->readonly)
				->WithAllowNull($this->allow_null)
				->WithNullCaption($this->null_caption)
				->WithOnChange('window.'.$this->name.'.OnChange();')
				->Render();

			echo '&nbsp;';

			if ($this->mode == UIMode::View || $this->mode == UIMode::Printer) {
				echo $time === null ? '' : ($this->show_seconds?"$h:$m:$s":"$h:$m");
			}
			else {
				echo SelectBox::Make($this->name.'_h',$h)->WithHttpName(null)->WithReadOnly($this->readonly)->WithOnChange("window.$this->name.OnChangeH();")->WithAllowNull($this->allow_null)->AddMany(array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'));
				echo SelectBox::Make($this->name.'_m',$m)->WithHttpName(null)->WithReadOnly($this->readonly)->WithOnChange("window.$this->name.OnChange();")->WithAllowNull($this->allow_null)->AddMany($h=='24'?array('00'):array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59'));
				echo SelectBox::Make($this->name.'_s',$s)->WithHttpName(null)->WithReadOnly($this->readonly)->WithOnChange("window.$this->name.OnChange();")->WithAllowNull($this->allow_null)->AddMany($h=='24'?array('00'):array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59'))->WithCssStyle($this->show_seconds?'':'display:none;');

				if (!$this->readonly) {
					echo Js::BEGIN;
					echo "window.".$this->name." = {";
					echo "  changing : false";
					echo " ,OnChangeH : function (){";
					echo "    this.changing = true;";
					echo "    var h = jQuery('#{$this->name}_h').val();";
					echo "    if (h==='24') {";
					echo "      jQuery('#{$this->name}_m option').each(function(i,e){ var x = jQuery(e); if (x.val()!=='00' && x.val()!=='') x.remove(); });";
					echo "      jQuery('#{$this->name}_s option').each(function(i,e){ var x = jQuery(e); if (x.val()!=='00' && x.val()!=='') x.remove(); });";
					echo "    }";
					echo "    else {";
					echo "      if (jQuery('#{$this->name}_m option').length<60) { for(var i=1;i<60;i++){ var s =(i<10?'0':'')+i;jQuery('#{$this->name}_m').append('<option value=\\\"'+s+'\\\">'+s+'</option>'); }}";
					echo "      if (jQuery('#{$this->name}_s option').length<60) { for(var i=1;i<60;i++){ var s =(i<10?'0':'')+i;jQuery('#{$this->name}_s').append('<option value=\\\"'+s+'\\\">'+s+'</option>'); }}";
					echo "    }";
					echo "    this.changing = false;";
					echo "    this.OnChange();";
					echo "  }";
					echo " ,Update:function(){jQuery('#$this->name').val(this.format_date(this.GetDate()));}";
					echo " ,OnChange : function (){if(this.changing)return;this.Update();$this->on_change;}";
					echo " ,format_date:function(d){";
					echo "    if(d===null)return'';";
					echo "    var r='';var x;";
					echo "    x=d.getFullYear();r+=x;";
					echo "    x=d.getMonth()+1;r+=x<10?'0'+x:''+x;";
					echo "    x=d.getDate();r+=x<10?'0'+x:''+x;";
					echo "    x=d.getHours();r+=x<10?'0'+x:''+x;";
					echo "    x=d.getMinutes();r+=x<10?'0'+x:''+x;";
					echo "    x=d.getSeconds();r+=x<10?'0'+x:''+x;";
					echo "    return r;";
					echo "  }";
					echo " ,SetDate:function(d){";
					echo "    this.changing=true;";
					echo "    if(d===null){";
					echo "      window.{$this->name}_date.SetDate(".new Js($this->allow_null?null:XDate::Today()).");";
					echo "      jQuery('#{$this->name}_h').val(".new Js($this->allow_null?'':'24').");";
					echo "      jQuery('#{$this->name}_m').val(".new Js($this->allow_null?'':'00').");";
					echo "      jQuery('#{$this->name}_s').val(".new Js($this->allow_null?'':'00').");";
					echo "    }";
					echo "    else {";
					echo "      var s = this.format_date(d);";
					echo "      if(s.substring(8)==='000000')d=d.addDays(-1);";
					echo "      window.{$this->name}_date.SetDate(d);";
					echo "      jQuery('#{$this->name}_h').val(s.substring(8)==='000000'?'24':s.substring(8,10));";
					echo "      jQuery('#{$this->name}_m').val(s.substring(10,12));";
					echo "      jQuery('#{$this->name}_s').val(s.substring(12,14));";
					echo "    }";
					echo "    this.changing=false;";
					echo "    this.OnChange();";
					echo "  }";
					echo " ,GetDate:function(){";
					echo "    var h = jQuery('#{$this->name}_h').val();if(h==='')return null;h=parseInt(h,10);";
					echo "    var m = jQuery('#{$this->name}_m').val();if(m==='')return null;m=parseInt(m,10);";
					echo "    var s = jQuery('#{$this->name}_s').val();if(s==='')return null;s=parseInt(s,10);";
					echo "    var d = jQuery('#{$this->name}_date').val();if(d==='')return null;";
					echo "    var YY = parseInt(d.substring(0,4),10);";
					echo "    var MM = parseInt(d.substring(4,6),10);";
					echo "    var DD = parseInt(d.substring(6,8),10);";
					echo "    var r = new Date(YY,MM-1,DD,h%24,m,s);";
					echo "    if (h===24) r = r.addDays(1);";
					echo "    return r;";
					echo "  }";
					echo "};";
					echo "window.$this->name.Update();";
					echo Js::END;
				}
			}
		}





		else {
			DateBox::Make($this->name . '_date' , $this->value )
				->WithHttpName(null)
				->WithMode($this->mode)
				->WithReadOnly($this->readonly)
				->WithAllowNull($this->allow_null)
				->WithNullCaption($this->null_caption)
				->WithOnChange('window.'.$this->name.'.UpdateD();')
				->Render();

			echo '&nbsp;';

			TimeBox::Make($this->name . '_time' , $this->value )
				->WithHttpName(null)
				->WithMode($this->mode)
				->WithReadOnly($this->readonly)
				->WithOnChange('window.'.$this->name.'.UpdateT();')
				->WithNullCaption($this->null_caption)
				->WithAllowNull($this->allow_null)
				->WithSimple($this->simple)
				->WithShowSeconds($this->show_seconds)
				->Render();


			echo Js::BEGIN;
			echo "window.$this->name = {";
			echo "  UpdateD : function(){";
			echo "    var d = jQuery('#{$this->name}_date').val();";
			echo "    var t = jQuery('#{$this->name}_time').val();";
			echo "    jQuery('#$this->name').val( d==='' ? '' : d.substring(0,8) + (t===''?'000000':t.substring(8)) );";
			echo "  }";
			echo " ,UpdateT : function(){";
			echo "    var d = jQuery('#{$this->name}_date').val();";
			echo "    var t = jQuery('#{$this->name}_time').val();";
			echo "    jQuery('#$this->name').val( t==='' ? '' : (d===''?".new Js(XDate::Today()->Format('Ymd')).":d.substring(0,8)) + t.substring(8) );";
			echo "  }";
			echo " ,SetDate:function(d){ {$this->name}_date.SetDate(d); {$this->name}_time.SetDate(d); }";
			echo " ,GetDate:function(){ var d = {$this->name}_date.GetDate(); if(d===null)return null; var t = {$this->name}_time.GetDate(); if(t===null)return null; return new Date(d.getFullYear(),d.getMonth(),d.getDate(),t.getHours(),t.getMinutes(),t.getSeconds()); }";
			echo "};";
			echo Js::END;
		}


	}
}





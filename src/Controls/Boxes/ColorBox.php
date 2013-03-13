<?php

class ColorBox extends Box {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '∅';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

	public function Render(){
		if ((is_null($this->value) || trim($this->value) === '') && !$this->allow_null) {
			$this->value = '#ffffff';
		}
		$is_null = is_null($this->value) || trim($this->value) === '';

		if ($this->mode == UIMode::View || $this->mode == UIMode::Printer) {
			if ($is_null) {
				echo '<span style="background:url(oxy/img/checkers.gif) 50% 50% repeat;padding:0 0.65em;margin:0;border:1px solid #999999;">'.new Spacer().'</span>&nbsp;';
				$null_caption = trim($this->null_caption);
				echo $null_caption===''?'&empty;':new Html($null_caption);
			}
			else {
				echo '<span style="background:'.$this->value.';padding:0 0.65em;margin:0;border:1px solid #999999;">'.new Spacer().'</span>&nbsp;';
			}
			return;
		}

		echo '<span';
		echo ' class="formPane '.($this->readonly?' formLocked':'').'"';
		echo ' style="padding:0;border:0;position:relative;display:inline-block;"';
		echo '>';

		if (!$this->readonly){
			echo new HiddenBox($this->name,$this->value);
			echo '<div id="'.$this->name.'-dropdown" class="formDropDown formColorDropDown" style="display:none;">';
			echo '<div class="formDropDownHook"></div>';
//			echo '<div class="formDropDownHead">';
//			echo '<div id="'.$this->name.'-dropdown-header"></div>';
//			echo '</div>';
			echo '<div class="formDropDownBody">';
			echo '<div id="'.$this->name.'-dropdown-body"></div>';
			echo '</div>';
			echo '<div class="formDropDownFoot">';
			if ($this->allow_null){
				$null_caption = trim($this->null_caption);
				echo '<a class="fleft button" href="javascript:'.$this->name.'.SetColor(null);">'.($null_caption===''?'&empty;':new Html($null_caption)).'</a>';
			}
			echo '<div class="formDropDownFootRight">';
			echo '# <input id="'.$this->name.'-text" type="text" class="formPane" style="width:45px;" onchange="window.'.$this->name.'.OnChange();" onkeyup="window.'.$this->name.'.OnChange();" />';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}


		echo '<div id="'.$this->name.'-anchor" class="formPane formPaneAnchorWrap formColorAnchorOuter" style="background:none;border:0;margin:0;"><div class="formPaneAnchor formColorAnchor"></div></div>';

		echo '<input id="'.$this->name.'-box"';
		echo ' class="formPane formColor'.($this->readonly?' formLocked':'').'"';
		echo ' style="margin:0;background:'.($is_null?'url(oxy/img/checkers.gif) 50% 50% repeat':$this->value).';"';
		echo ' readonly="readonly"';
		echo '/>';

		echo '</span>';

		echo Js::BEGIN;
		if (!$this->readonly){
			echo "jQuery('#$this->name-box,#$this->name-anchor').click(function(e){ $this->name.OnClick(); }).keydown(function(e){ $this->name.OnKeyDown(e); }).blur(function(e){ $this->name.OnBlur(e); });";
			echo "jQuery('#$this->name-dropdown').mousedown(function(e){ window.$this->name.KeepFocus(); });";
			echo "window.".$this->name." = {";
			echo "  is_open : false";
			echo " ,keep_focus : false";
			echo " ,IntToHex : function(d){return (d<0x10?'0':'')+d.toString(16).toUpperCase();}";
			echo " ,RgbToColor : function(r,g,b){return '#'+this.IntToHex(r)+this.IntToHex(g)+this.IntToHex(b);}";
			echo " ,RgbToCell : function(r,g,b){return '<td class=\"color\"><a style=\"background:'+this.RgbToColor(r,g,b)+'\" href=\"javascript:$this->name.SetColor(\\''+$this->name.RgbToColor(r,g,b)+'\\');\">".new Spacer(1,1)."</a></td>';}";
			echo " ,SetColor : function(x,keep_open){";
			echo "    if (x==null){";
			echo "      jQuery('#$this->name-box').css({background:'url(oxy/img/checkers.gif) 50% 50% repeat'});";
			echo "      jQuery('#$this->name').val('');";
			echo "    }";
			echo "    else {";
			echo "      jQuery('#$this->name-box').css({background:x});";
			echo "      jQuery('#$this->name').val(x);";
			echo "    }";
			echo $this->on_change;
			echo "    if (!keep_open) { this.Update(); this.HideDropDown(); }";
			echo "  }";


			echo " ,OnKeyDown : function(ev){";
			echo "    switch(ev.which){";
			echo "      case 13:case 27:if(this.is_open){this.HideDropDown();ev.preventDefault();}break;";
			echo "      case 32:this.ToggleDropDown();break;";
			if ($this->allow_null){
				echo "    case 8:case 46:this.SetColor(null);ev.preventDefault();break;";
			}
			echo "    }";
			echo "  }";
			echo " ,OnBlur : function(ev){";
			echo "    setTimeout(function(){if(!$this->name.keep_focus&&!jQuery('#$this->name-box').is(':focus')&&!jQuery('#$this->name-text').is(':focus')){ $this->name.HideDropDown(); }},200);";
			echo "  }";
			echo " ,OnChange : function(ev){";
			echo "    var x = jQuery('#$this->name-text');";
			echo "    if (x.val().match(/[a-fA-F0-9]{6}/)!=x.val()) return;";
			echo "    this.SetColor('#'+x.val(),true);";
			echo "  }";
			echo " ,KeepFocus : function(){ this.keep_focus = true; setTimeout(function(){ $this->name.Update(); },500); }";
			echo " ,Update : function(){";
			echo "    if (!this.is_open) return;";
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
			echo "    this.FillPalette();";
			echo "    this.is_open = true;";
			echo "    this.Update();";
			echo "    jQuery('#$this->name-text').val(jQuery('#$this->name').val().replace('#','')).focus();";
			echo "    jQuery('html').on('click.$this->name', function(e){ if ($this->name.Showing) { $this->name.Showing = false; return; } if($this->name.Clicking)return; if (jQuery('#$this->name-dropdown').has(e.target).length === 0) $this->name.HideDropDown(); });";
			echo "  }";
			echo " ,HideDropDown : function(){";
			echo "    this.keep_focus = false;";
			echo "    this.is_open = false;";
			echo "    jQuery('#$this->name-dropdown').hide();";
			echo "    jQuery('html').off('click.$this->name');";
			echo "  }";
			echo " ,FillPalette : function(){";
			echo "    var s = '<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">';";
			echo "    a=new Array(0xFF,0xEE,0xDD,0xCC,0xBB,0xAA,0x99,0x88,0x77,0x66,0x55,0x44,0x33,0x22,0x11,0x00);";
			echo "    bo=new Array(0xFF,0xB6,0x91,0x6D,0x48,0x24,0x00);";
			echo "    bx=new Array(0x7F,0x5B,0x48,0x36,0x24,0x12,0x00);";
			echo "    co=new Array(0xFF,0xF3,0xE6,0xD9,0xCB,0xBC,0xAB,0x99,0x85,0x6C,0x4C);";
			echo "    cx=new Array(0xFF,0x79,0x73,0x6C,0x65,0x5E,0x55,0x4C,0x42,0x36,0x26);";
			echo "    z=new Array();";
			echo "    for(i=0;i<a.length;i++)z.push(new Array(a[i],a[i],a[i]));";
			echo "    for(i=1;i<bo.length;i++)z.push(new Array(0xFF,bo[i],bo[i]));";
			echo "    for(i=1;i<co.length;i++)z.push(new Array(co[i],0x00,0x00));";
			echo "    for(i=1;i<bx.length;i++)z.push(new Array(0xFF,0x7F+bx[i],bo[i]));";
			echo "    for(i=1;i<cx.length;i++)z.push(new Array(co[i],cx[i],0x00));";
			echo "    for(i=1;i<bo.length;i++)z.push(new Array(0xFF,0xFF,bo[i]));";
			echo "    for(i=1;i<co.length;i++)z.push(new Array(co[i],co[i],0x00));";
			echo "    for(i=1;i<bo.length;i++)z.push(new Array(0x7F+bx[i],0xFF,bo[i]));";
			echo "    for(i=1;i<co.length;i++)z.push(new Array(cx[i],co[i],0x00));";
			echo "    for(i=a.length;i<5*a.length;i++)z.push(new Array(z[i][2],z[i][0],z[i][1]));";
			echo "    for(i=a.length;i<5*a.length;i++)z.push(new Array(z[i][1],z[i][2],z[i][0]));";
			echo "    for(i=0;i<z.length;i++){";
			echo "    if(i%a.length==0)s+='<tr>';";
			echo "    s+=this.RgbToCell(z[i][0],z[i][1],z[i][2]);";
			echo "    if(i%a.length==a.length-1)s+='</tr>';";
			echo "    }";
			echo "    s+='</table>';";
			echo "    jQuery('#$this->name-dropdown-body').html(s);";
			echo "  }";
			echo "};";
		}
		echo Js::END;


	}
}





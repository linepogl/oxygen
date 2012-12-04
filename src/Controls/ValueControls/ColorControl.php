<?php

class ColorControl extends ValueControl {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '&empty;';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

	public function Render(){
		if ($this->mode==UIMode::Edit){
			echo new HiddenControl($this->name,$this->value);
			echo '<a id="'.$this->name.'angor" class="formPane" href="javascript:'.$this->name.'.TogglePalette();" style="padding:2px 0 4px 2px;">';
		}

		echo '<span id="'.$this->name.'box" style="border:1px solid #666666;border-radius:2px;">';
		echo new Spacer(26,16);
		echo '</span>';
		if ($this->mode==UIMode::Edit){
			echo '<img src="oxy/img/arrow_down.gif" alt="" hspace="2" />';
			echo '</a>';

			echo Js::BEGIN;
			echo "window.".$this->name." = {";
			echo "  Hex : function(d){return (d<0x10?'0':'')+d.toString(16).toUpperCase();}";
			echo " ,GetColorCell : function(r,g,b){return '<td bgcolor=\"'+this.GetColor(r,g,b)+'\"><a href=\"javascript:".$this->name.".SetColor(\\''+".$this->name.".GetColor(r,g,b)+'\\');\">".new Spacer(10,10)."</a></td>';}";
			echo " ,GetColor : function(r,g,b){return '#'+this.Hex(r)+this.Hex(g)+this.Hex(b);}";
			echo " ,SetColor : function(c){";
			echo "    if (c==null || c=='') {";
			echo "      $('".$this->name."').value='';";
			echo "      jQuery('#".$this->name."box').css({'background':'#ffffff','border-width':'0','padding':'1px'});";
			echo "    }";
			echo "    else {";
			echo "      $('".$this->name."').value=c;";
			echo "      jQuery('#".$this->name."box').css({'background':c,'border-width':'1px','padding':'0'});";
			echo "    }";
			echo "    $('".$this->name."palette').hide();";
			echo "  }";
			echo " ,TogglePalette : function(){";
			echo "    var p = $('".$this->name."palette');";
			echo "    if (p == null) $(document.body).insert(". new Js('<div class="colorbox-popup" id="'.$this->name.'palette" style="position:absolute;display:none;z-index:1000;"></div>').');';
			echo "    var p = $('".$this->name."palette');";
			echo "    if (p.style.display!='none'){ p.hide(); return; }";
			echo "    var s = '<table cellspacing=\"1\" cellpadding=\"0\" border=\"0\" style=\"background:#ffffff;border:1px solid #666666;\">';";
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
			echo "    s+=this.GetColorCell(z[i][0],z[i][1],z[i][2]);";
			echo "    if(i%a.length==a.length-1)s+='</tr>';";
			echo "    }";
			if ($this->allow_null) {
				$null_caption = trim($this->null_caption);
				if ($null_caption=='') $null_caption = '&empty;';
				echo "    s+='<tr><td class=\"hcenter\" colspan=\"'+a.length+'\"><a class=\"null\" href=\"javascript:".$this->name.".SetColor(null);\">&nbsp;'+".new Js($null_caption)."+'&nbsp;</td></tr>';";
			}
			echo "    s+='</table>';";
			echo "    var p = $('".$this->name."palette');";
			echo "    p.update(s);";
			echo "    p.show();";
			echo "    p.style.left=$('".$this->name."angor').positionedOffset().left+'px';";
			echo "    p.style.top=($('".$this->name."angor').positionedOffset().top+$('".$this->name."angor').getHeight())+'px';";
			if (Browser::IsIE6()){
				echo "  for (var x = $('".$this->name."angor').up(); x.style; x = x.up()){";
				echo "    if (x.style.position == 'absolute') {";
				echo "      p.style.left = (p.positionedOffset().left +  x.positionedOffset().left) + 'px';";
				echo "      p.style.top = (p.positionedOffset().top + x.positionedOffset().top) + 'px';";
				echo "    }";
				echo "  }";
			}
			echo "  }";
			echo "};";
			echo $this->name.".SetColor(".new Js($this->value).");";

			echo Js::END;

		}
	}
}

<?php

class ColorBox extends Box {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '∅';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

	public function Render(){
		$ns = $this->name;
		if (( $this->value===null || trim($this->value) === '') && !$this->allow_null) $this->value = '#ffffff';
		$is_null = is_null($this->value) || trim($this->value) === '';

		$favorites = $this->mode !== UIMode::Edit || $this->readonly ? null : oxy::GetFavoriteColors();

		if ($this->mode === UIMode::Edit) {
			echo HiddenBox::Make($ns,$this->value)->WithHttpName($this->readonly || $this->mode != UIMode::Edit ? null : $this->http_name);
		}

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
			echo '<div id="'.$ns.'-dropdown" class="formDropDown formColorDropDown" style="display:none;">';
			echo '<div class="formDropDownHook"></div>';
//			echo '<div class="formDropDownHead">';
//			echo '<div id="'.$ns.'-dropdown-header"></div>';
//			echo '</div>';
			echo '<div class="formDropDownBody">';
			echo '<div id="'.$ns.'-dropdown-body"></div>';
			if ($favorites !== null) {
				echo '<div id="'.$ns.'-dropdown-favs" style="margin-top:10px;padding-top:10px;border-top:1px dashed #eeeeee;'.(empty($favorites)?'display:none;':'').'"></div>';
			}
			echo '</div>';
			echo '<div class="formDropDownFoot">';
			if ($favorites!==null) {
				$is_favorite = in_array($this->value,$favorites);
				echo '<a id="'.$ns.'-append-fav"class="fleft button" href="javascript:window.'.$ns.'.AppendFav();"'.($is_favorite?' style="display:none;"':'').'>'.oxy::icoFavoritize().'</a>';
				echo '<a id="'.$ns.'-remove-fav"class="fleft button" href="javascript:window.'.$ns.'.RemoveFav();"'.($is_favorite?'':' style="display:none;"').'>'.oxy::icoUnfavoritize().'</a>';
			}
			if ($this->allow_null){
				$null_caption = trim($this->null_caption);
				echo '<a class="fleft button" href="javascript:window.'.$ns.'.SetColor(null);">'.($null_caption===''?'&empty;':new Html($null_caption)).'</a>';
			}
			echo '<div class="formDropDownFootRight">';
			echo '# <input id="'.$ns.'-text" type="text" class="formPane" style="width:45px;" onchange="window.'.$ns.'.OnChange();" onkeyup="window.'.$ns.'.OnChange();" />';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}


		echo '<div id="'.$ns.'-anchor" class="formPane formPaneAnchorWrap formColorAnchorOuter" style="background:none;border:0;margin:0;"><div class="formPaneAnchor formColorAnchor">'.oxy::icoMenuDown().'</div></div>';

		echo '<input id="'.$ns.'-box"';
		echo ' class="formPane formColor'.($this->readonly?' formLocked':'').'"';
		echo ' style="margin:0;background:'.($is_null?'url(oxy/img/checkers.gif) 50% 50% repeat':$this->value).';"';
		echo ' readonly="readonly"';
		echo '/>';

		echo '</span>';

		echo Js::BEGIN;
		if (!$this->readonly){
			echo "jQuery('#$ns-box,#$ns-anchor').click(function(e){ $ns.OnClick(); }).keydown(function(e){ $ns.OnKeyDown(e); }).blur(function(e){ $ns.OnBlur(e); });";
			echo "jQuery('#$ns-dropdown').mousedown(function(e){ window.$ns.KeepFocus(); });";
			echo "window.".$ns." = {";
			echo "  is_open : false";
			echo " ,keep_focus : false";
			echo " ,IntToHex : function(d){return (d<0x10?'0':'')+d.toString(16).toUpperCase();}";
			echo " ,RgbToColor : function(r,g,b){return '#'+this.IntToHex(r)+this.IntToHex(g)+this.IntToHex(b);}";
			echo " ,RgbToCell : function(r,g,b){return '<td class=\"color\"><a style=\"background:'+this.RgbToColor(r,g,b)+'\" href=\"javascript:$ns.SetColor(\\''+$ns.RgbToColor(r,g,b)+'\\');\">".new Spacer(1,1)."</a></td>';}";
			echo " ,GetColor:function(){return jQuery('#$ns').val();}";
			echo " ,SetColor:function(x,keep_open){";
			echo "    if (x==null){";
			echo "      jQuery('#$ns-box').css({background:'url(oxy/img/checkers.gif) 50% 50% repeat'});";
			echo "      jQuery('#$ns').val('');";
			echo "    }";
			echo "    else {";
			echo "      jQuery('#$ns-box').css({background:x});";
			echo "      jQuery('#$ns').val(x);";
			echo "    }";
			if ($favorites!==null) echo "this.UpdateFavs();";
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
			echo "    setTimeout(function(){if(!$ns.keep_focus&&!jQuery('#$ns-box').is(':focus')&&!jQuery('#$ns-text').is(':focus')){ $ns.HideDropDown(); }},200);";
			echo "  }";
			echo " ,OnChange : function(ev){";
			echo "    var x = jQuery('#$ns-text');";
			echo "    if (x.val().match(/[a-fA-F0-9]{6}/)!=x.val()) return;";
			echo "    this.SetColor('#'+x.val(),true);";
			echo "  }";
			echo " ,KeepFocus : function(){ this.keep_focus = true; setTimeout(function(){ $ns.Update(); },500); }";
			echo " ,Update : function(){";
			echo "    if (!this.is_open) return;";
			echo "    jQuery('#$ns-text').focus();";
			echo "    this.keep_focus = false;";
			echo "  }";


			echo " ,Clicking : false";
			echo " ,OnClick : function (){ if(this.Clicking) return; this.Clicking = true; this.ToggleDropDown(); setTimeout(function(){ $ns.Clicking = false; },500); }";
			echo " ,ToggleDropDown : function(){ if (jQuery('#$ns-dropdown').is(':visible')) this.HideDropDown(); else this.ShowDropDown(); }";
			echo " ,Showing : false";
			echo " ,ShowDropDown : function(){";
			echo "    this.Showing = true;";
			echo "    var b = jQuery('#$ns-box');";
			echo "    var d = jQuery('#$ns-dropdown');";
			echo "    d.show();";
			echo "    var w = d.width();";
			echo "    var ww = b.outerWidth(false) - (d.outerWidth(false) - w);";
			echo "    if (ww > w) d.css({width:ww+'px'});";
			echo "    d.css({'margin-top':(1+b.outerHeight(false))+'px','margin-left':Math.floor((b.outerWidth(false)-d.outerWidth(false))/2)+'px'});";
			echo "    this.FillPalette();";
			if ($favorites!==null) echo "this.UpdateFavs('update');";
			echo "    this.is_open = true;";
			echo "    this.Update();";
			echo "    jQuery('#$ns-text').val(jQuery('#$ns').val().replace('#','')).focus();";
			echo "    jQuery('html').on('click.$ns', function(e){ if ($ns.Showing) { $ns.Showing = false; return; } if($ns.Clicking)return; if (jQuery('#$ns-dropdown').has(e.target).length === 0) $ns.HideDropDown(); });";
			echo "  }";
			echo " ,HideDropDown : function(){";
			echo "    this.keep_focus = false;";
			echo "    this.is_open = false;";
			echo "    jQuery('#$ns-dropdown').hide();";
			echo "    jQuery('html').off('click.$ns');";
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
			echo "    if(i%16==0)s+='<tr>';";
			echo "    s+=this.RgbToCell(z[i][0],z[i][1],z[i][2]);";
			echo "    if(i%16==15)s+='</tr>';";
			echo "    }";
			echo "    s+='</table>';";
			echo "    jQuery('#$ns-dropdown-body').html(s);";
			echo "  }";
			if ($favorites !== null){
				$act = new ActionFavoriteColors(null,null);
				echo ",favorites:".new Js($favorites);
				echo ",AppendFav:function(){this.UpdateFavs('append');}";
				echo ",RemoveFav:function(){this.UpdateFavs('remove');}";
				echo ",UpdateFavs:function(verb){";
				echo "   var c=this.GetColor().toUpperCase();";
				echo "   if(''+verb!='undefined'){var p={};p[verb]=c;Oxygen.AjaxRequest(".new Js($act).",{parameters:p,onSuccess:function(t){var x=window.$ns;x.favorites=t.responseJSON;x.UpdateFavs();}});}";
				echo "   if(this.favorites===null)this.favorites=[];";
				echo "   var found=false;for(var i=0;i<this.favorites.length;i++)if(c===this.favorites[i].toUpperCase()){found=true;break;}";
				echo "   jQuery('#$ns-append-fav').toggle(!found);";
				echo "   jQuery('#$ns-remove-fav').toggle(found);";
				echo "   var s = '<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">';";
				echo "   for(i=0;i<this.favorites.length;i++){";
				echo "     var fav=this.favorites[i];";
				echo "     if(i%16===0)s+='<tr>';";
				echo "     s+='<td class=\"color\"><a style=\"background:'+fav+'\" href=\"javascript:$ns.SetColor(\\''+fav+'\\');\">".new Spacer(1,1)."</a></td>';";
				echo "     if(i%16===15)s+='</tr>';";
				echo "   }";
				echo "   if (i%16!==0){for(;i%16!==0;i++)s+='<td class=\"color\"><a>".new Spacer(1,1)."</a></td>';s+='</tr>';}";
				echo "   s+='</table>';";
				echo "   jQuery('#$ns-dropdown-favs').html(s).toggle(this.favorites.length!==0);";
				echo " }";
			}
			echo "};";
		}
		echo Js::END;


	}
}


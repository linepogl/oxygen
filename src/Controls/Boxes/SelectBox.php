<?php

class SelectBox extends Box {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }


	public function Render(){

		$caption = '';

		if ($this->mode == UIMode::View || $this->mode == UIMode::Printer) {
			echo new Html($caption);
			return;
		}

		$caption = '';
		echo '<span class="formPane '.($this->readonly?' formLocked':'').'" style="padding:0;border:0;position:relative;display:inline-block;">';

		if (!$this->readonly){
			echo new HiddenControl($this->name,$this->value);
			echo '<div id="'.$this->name.'-dropdown" class="formDropDown" style="display:none;">';
			echo '<div class="formDropDownHook"></div>';
//    echo '<div class="formDropDownHead"></div>';
			echo '<div class="formDropDownBody">';

			echo '</div>';
//    echo '<div class="formDropDownFoot"></div>';
			echo '</div>';
		}

		echo '<span id="'.$this->name.'-anchor" class="formPaneAnchor">&nbsp;</span>';

		echo '<input id="'.$this->name.'-box"';
		echo ' class="formPane'.($this->readonly?' formLocked':'').'"';
		echo ' style="width:100%;margin:0;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"';
		echo ' value="'.new Html($caption).'"';
		echo ' readonly="readonly"';
		echo '/>';

		echo '</span>';

		echo Js::BEGIN;
		echo "jQuery('#$this->name-anchor').css({'margin-top':jQuery('#$this->name-box').css('padding-top'),'margin-right':jQuery('#$this->name-box').css('padding-right')});";
		if (!$this->readonly){
			echo "jQuery('#$this->name-box,#$this->name-anchor').click(function(e){ $this->name.ToggleDropDown(); }).keydown(function(e){ $this->name.OnKeyDown(e); }).blur(function(e){ $this->name.OnBlur(e); });";
			echo "jQuery('#$this->name-dropdown').mousedown(function(e){ window.$this->name.KeepFocus(); });";
			echo "window.".$this->name." = {";
			echo "  is_open : false";
			echo " ,value : null";
			echo " ,keep_focus : false";
			echo " ,OnChange : function(){";
			echo $this->on_change;
			echo "  }";
			echo " ,SetV : function(v){ this.OnChange(); }";
			echo " ,OnKeyDown : function(ev){";
			echo "    switch(ev.which){";
			echo "      case 13:case 27:if(this.is_open){this.HideDropDown();ev.preventDefault();}break;";
			echo "      case 32:this.ToggleDropDown();break;";
			if ($this->allow_null){
				echo "    case 8:case 46:this.SetV(null);ev.preventDefault();break;";
			}
			echo "      case 38:case 39:ev.preventDefault();break;";
			echo "      case 40:case 37:ev.preventDefault();break;";
			echo "    }";
			echo "  }";
			echo " ,OnBlur : function(ev){";
			echo "    setTimeout(function(){if(!$this->name.keep_focus&&!jQuery('#$this->name-box').is(':focus')){ $this->name.HideDropDown(); }},200);";
			echo "  }";
			echo " ,KeepFocus : function(){ this.keep_focus = true; setTimeout(function(){ jQuery('#$this->name-box').focus(); this.keep_focus = false; },500); }";
      echo " ,Update : function(){";
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
			echo "    this.Update();";
			echo "    jQuery('html').on('click.$this->name', function(e){ if ($this->name.Showing) { $this->name.Showing = false; return; } if (jQuery('#$this->name-dropdown').has(e.target).length === 0) $this->name.HideDropDown(); });";
			echo "  }";
			echo " ,HideDropDown : function(){";
			echo "    this.keep_focus = false;";
			echo "    this.is_open = false;";
			echo "    jQuery('#$this->name-dropdown').hide();";
			echo "    jQuery('html').off('click.$this->name');";
			echo "  }";
			echo "};";

		}
		echo Js::END;


	}
}





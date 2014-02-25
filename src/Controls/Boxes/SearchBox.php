<?php

class SearchBox extends Box {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '∅';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

	private $width = '100%';
	public function WithWidth($value){ $this->width = $value; return $this; }

	/** @var $action SearchBoxAction */
	private $action = null;
	public function WithAction(SearchBoxAction $action){ $this->action = $action; return $this; }

	public function Render(){
		echo HiddenBox::Make($this->name,$this->value)->WithHttpName($this->readonly || $this->mode != UIMode::Edit ? null : $this->http_name);

		$null_caption = trim($this->null_caption);
		$html_caption = '';
		if ($this->allow_null) $html_caption = new Html($this->null_caption);
		if (!is_null($this->value) && $this->action instanceof SearchBoxAction) $html_caption = $this->action->GetResultHtmlCaption($this->value);

		if ($this->mode == UIMode::View || $this->mode == UIMode::Printer) {
			echo $html_caption;
			return;
		}

		echo '<span id="'.$this->name.'-span" class="formPane formDropDownPane'.($this->readonly?' formLocked':'').'" style="padding:0;border:0;position:relative;display:inline-block;">';


		if (!$this->readonly){
			echo '<div id="'.$this->name.'-dropdown" class="formDropDown" style="display:none;">';
			echo '<div class="formDropDownHook"></div>';
			echo '<div class="formDropDownHead" style="text-align:left;">';
			echo TextBox::Make($this->name.'_search_string')->WithHttpName(null)->WithWidth('100%')->WithOnChange("window.$this->name.Search();");
//			echo '<a class="button button-next" href="javascript:;"></a>';
			echo '</div>';
			echo '<div class="formDropDownBody">';
			echo '<div id="'.$this->name.'-dropdown-body"></div>';
			echo '</div>';
			echo '<div class="formDropDownFoot">';
			if ($this->allow_null){
				echo '<a id="'.$this->name.'-null" class="fleft button" href="javascript:'.$this->name.'.SetNull();">'.new Html($null_caption===''?'∅':$null_caption).'</a>';
			}
			echo '</div>';
			echo '</div>';
		}


		echo '<div id="'.$this->name.'-anchor" class="formPaneAnchorWrap"><div class="formPaneAnchor">'.oxy::icoMenuDown().'</div></div>';

		echo '<input id="'.$this->name.'-box"';
		echo ' class="formPane formDropDownPane'.($this->readonly?' formLocked':'').'"';
		echo ' style="margin:0;cursor:pointer;width:'.$this->width.'"';
		echo ' value="'.$html_caption.'"';
		echo ' readonly="readonly"';
		echo '/>';

		echo '</span>';


		echo Js::BEGIN;
		echo "var f = function(){";
		echo "  var x =  jQuery('#$this->name-box');";
		echo "  jQuery('#$this->name-anchor').css({'margin-top':x.css('border-top-width'),'margin-right':x.css('border-right-width'),'padding-top':x.css('padding-top'),'padding-rightt':x.css('padding-right')});";
		echo "};";
		echo "jQuery(document).ready(f);f();";

		if (!$this->readonly){
			echo "jQuery('#$this->name-box,#$this->name-anchor').click(function(e){ $this->name.OnClick(); }).keydown(function(e){ $this->name.OnKeyDown(e); }).blur(function(e){ $this->name.OnBlur(e); });";
			echo "jQuery('#$this->name-dropdown').mousedown(function(e){ window.$this->name.KeepFocus(); });";
			echo "window.".$this->name." = {";
			echo "  is_open : false";
			echo " ,keep_focus : false";
			echo " ,OnKeyDown : function(ev){";
			echo "    switch(ev.which){";
			echo "      case 13:case 27:if(this.is_open){this.HideDropDown();ev.preventDefault();}break;";
			echo "      case 32:this.ToggleDropDown();break;";
			if ($this->allow_null)
				echo "    case 8:case 46:this.SetNull();ev.preventDefault();break;";
			echo "    }";
			echo "  }";
			echo " ,OnBlur : function(ev){";
			echo "    setTimeout(function(){if(!$this->name.keep_focus&&!jQuery('#$this->name-box,#{$this->name}_search_string').is(':focus')){ $this->name.HideDropDown();}},200);";
			echo "  }";
			echo " ,KeepFocus : function(){ this.keep_focus = true; setTimeout(function(){ $this->name.Update(); },500); }";
			echo " ,Update : function(){";
			echo "    if (!this.is_open) return;";
			echo "    this.keep_focus = false;";
			echo "  }";

			echo " ,SetValue:function(v,c){";
			echo "    jQuery('#$this->name-box').val(c);";
			echo "    jQuery('#$this->name').val(v);";
			echo "    this.HideDropDown();";
			echo "  }";
			echo " ,SetNull:function(){";
			echo "    jQuery('#$this->name-box').val(".new Js($null_caption===''?'∅':$null_caption).");";
			echo "    jQuery('#$this->name').val('');";
			echo "    this.HideDropDown();";
			echo "  }";


			echo " ,search_string:null";
			echo " ,Search : function(){";
			echo "    var s = jQuery('#{$this->name}_search_string').val();";
			echo "    if (s===this.search_string) return;";
			echo "    this.search_string = s;";
			echo "    jQuery('#$this->name-dropdown-body').html('<div class=\"hcenter\" style=\"padding:30px;\"><img src=\"oxy/img/ajax.gif\" /></div>');";
			echo "    new Ajax.Updater('$this->name-dropdown-body',".new Js($this->action).",{method:'get',encoding:Oxygen.Encoding,evalScripts:true,parameters:{namespace:".new Js($this->name).",search_string:s} });";
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
			echo "    jQuery('#{$this->name}_search_string').focus();";
			echo "    this.Search();";
			echo "    jQuery('html').on('click.$this->name', function(e){ if ($this->name.Showing) { $this->name.Showing = false; return; } if($this->name.Clicking)return; if (jQuery('#$this->name-dropdown').has(e.target).length === 0) $this->name.HideDropDown(); });";
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





<?php

class SelectBox extends Box {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_option = null;
	public function WithNullCaption($value){
		if ($value instanceof SelectBoxOption)
			$this->null_option = $value->WithValue(null);
		else
			$this->null_option = SelectBoxOption::Make()->WithValue(null)->WithCaption($value);
		return $this;
	}

	private $options = array();
	public function Add($value,$caption = null){
		return $this->AddMany(array($value),$caption);
	}
	public function AddMany($values,$captions = null){
		if (is_callable($captions)) {
			foreach ($values as $key=>$value){
				$x = $captions($value,$key);
				if (is_null($x))
					$this->options[] = SelectBoxOption::Make()->WithValue($value);
				elseif ($x instanceof SelectBoxOption)
					$this->options[] = $x->WithValue($value);
				else
					$this->options[] = SelectBoxOption::Make()->WithValue($value)->WithCaption($x);
			}
		}
		elseif (is_array($captions) || $captions instanceof Traversable) {
			$o = from($captions);
			$o->Rewind();
			foreach ($values as $value){
				$x = null;
				if ($o->Valid()){
					$x = $o->Current();
					$o->Next();
				}
				if (is_null($x))
					$this->options[] = SelectBoxOption::Make()->WithValue($value);
				elseif ($x instanceof SelectBoxOption)
					$this->options[] = $x->WithValue($value);
				else
					$this->options[] = SelectBoxOption::Make()->WithValue($value)->WithCaption($x);
			}
		}
		else {
			foreach ($values as $value){
				if ($value instanceof SelectBoxOption)
					$this->options[] = $value;
				else
					$this->options[] = SelectBoxOption::Make()->WithValue($value)->WithCaption($captions);
			}
		}
		return $this;
	}



	
	public function Render(){
		if (is_null($this->null_option)) $this->null_option = SelectBoxOption::Make()->WithValue(null)->WithCaption('');

		$options = array();
		if ($this->allow_null || count($this->options) == 0) $options[] = $this->null_option;
		foreach ($this->options as $option) $options[] = $option;


		$selected_index = 0;
		$url_value = strval(new Url($this->value));
		$i = 0;
		/** @var $option SelectBoxOption */
		foreach ($options as $option) {
			if ( $option->GetUrlValue() === $url_value ) {
				$selected_index = $i;
				break;
			}
			$i++;
		}
		/** @var $selected_option SelectBoxOption */
		$selected_option = $options[$selected_index];

		if ($this->mode == UIMode::View || $this->mode == UIMode::Printer) {
			echo new Html( $selected_option->GetCaption() );
			return;
		}

		$caption = new Html($selected_option->GetCaption());
		echo '<span class="formPane '.($this->readonly?' formLocked':'').'" style="padding:0;border:0;position:relative;display:inline-block;">';

		if (!$this->readonly){
			echo new HiddenBox($this->name,$this->value);
			echo '<div id="'.$this->name.'-dropdown" class="formDropDown formSelectDropDown" style="display:none;">';
			echo '<div class="formDropDownHook"></div>';
//    echo '<div class="formDropDownHead"></div>';
			echo '<div class="formDropDownBody">';

			foreach ($options as $option){
				echo '<a class="option" href="#">';
				echo new Html($option->GetCaption());
				echo '</a>';
			}

			echo '</div>';
//    echo '<div class="formDropDownFoot"></div>';
			echo '</div>';
		}

		echo '<span id="'.$this->name.'-anchor" class="formPaneAnchor">&nbsp;</span>';

		echo '<input id="'.$this->name.'-box"';
		echo ' class="formPane'.($this->readonly?' formLocked':'').'"';
		echo ' style="width:100%;margin:0;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"';
		echo ' readonly="readonly"';
		echo ' value="'.new Html($caption).'"';
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





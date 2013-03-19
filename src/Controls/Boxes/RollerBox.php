<?php

class RollerBox extends Box {

	private $is_rich = false;
	public function WithIsRich($value){ $this->is_rich = $value; return $this; }

	private $show_captions = true;
	public function WithShowCaption($value){ $this->show_captions = $value; return $this; }

	private $css_style = '';
	private $css_class = '';

	private $list_values = array();
	private $list_captions = array();
	private $list_css_classes = array();
	private $list_css_styles = array();
	private $last_index_from = -1;

	/** @return static */
	public function Add($value,$caption=null){
		$this->list_values[] = $value;
		$this->list_captions[] = is_null($caption) ? new Html($value) : $caption;
		$this->list_css_classes[] = '';
		$this->list_css_styles[] = '';
		$this->last_index_from = count($this->list_values) - 1;
		return $this;
	}

	/** @return static */
	public function AddMany($values,$captions=null){
		$a = array();
		if (!is_null($captions))
			foreach ($captions as $caption)
				$a[] = $caption;
		$i = 0;
		foreach ($values as $value)
			$this->Add( $value , $i++ < count($a) ? $a[$i] : null );
		$this->last_index_from = count($this->list_values) - $i;
		return $this;
	}

	/** @return static */
	public function WithCaption($value){
		for ($i = $this->last_index_from; $i < count($this->list_captions); $i++)
			$this->list_captions[ $i ] = $value;
		return $this;
	}
	/** @return static */
	public function WithCaptions($values){
		$i = $this->last_index_from;
		foreach ($values as $value)
			if ($i < count($this->list_captions))
				$this->list_captions[ $i++ ] = $value;
		return $this;
	}

	/** @return static */
	public function WithCssStyle($value){
		if ($this->last_index_from < 0)
			$this->css_style = $value;
		else
			for ($i = $this->last_index_from; $i < count($this->list_css_styles); $i++)
				$this->list_css_styles[ $i ] = $value;
		return $this;
	}
	/** @return static */
	public function WithCssStyles($values){
		$i = $this->last_index_from;
		foreach ($values as $value)
			if ($i < count($this->list_css_styles))
				$this->list_css_styles[ $i++ ] = $value;
		return $this;
	}

	/** @return static */
	public function WithCssClass($value){
		if ($this->last_index_from < 0)
			$this->css_class = $value;
		else
			for ($i = $this->last_index_from; $i < count($this->list_css_classes); $i++)
				$this->list_css_classes[ $i ] = $value;
		return $this;
	}
	/** @return static */
	public function WithCssClasses($values){
		$i = $this->last_index_from;
		foreach ($values as $value)
			if ($i < count($this->list_css_classes))
				$this->list_css_classes[ $i++ ] = $value;
		return $this;
	}


	private function GetSelectedIndex(){
		$val = strval( new Val( $this->value ) );
		foreach ($this->list_values as $i => $value)
			if ($val === strval( new Val( $value ) ) )
				return $i;
		return 0;
	}

	public function Render(){

		echo HiddenBox::Make($this->name,$this->value)->WithHttpName($this->http_name);

		$readonly = $this->readonly || $this->mode != UIMode::Edit;

		if ($readonly)
			echo '<span class="rollerbox-anchor '.$this->css_class.'" style="'.$this->css_style.'">';
		else
			echo '<a class="rollerbox-anchor '.$this->css_class.'" href="javascript:'.$this->name.'.Change();" style="'.$this->css_style.'">';

		$selected_index = $this->GetSelectedIndex();
		for ($i = 0; $i < count($this->list_values); $i++) {
			echo '<span id="'.$this->name.'-'.$i.'" style="'.$this->list_css_styles[$i].($i==$selected_index?'':'display:none;').'">';
			if ($this->show_captions){
				if ($this->is_rich)
					echo $this->list_captions[$i];
				else
					echo new Html($this->list_captions[$i]);
			}
			echo '</span>';
		}

		if ($readonly)
			echo '</span>';
		else
			echo '</a>';

		echo Js::BEGIN;
		echo "window.".$this->name .'={';
		echo "  is_readonly : ".new Js($readonly);
		echo " ,values : ".new Js($this->list_values);
		echo " ,selected_index : ".new Js($selected_index);
		echo " ,SetValue : function(value){";
		echo "    var old = this.selected_index;";
		echo "    for(var i = 0; i < this.values.length; i++) if (this.values[i]===value) {";
		echo "      this.selected_index = i;";
		echo "      break;";
		echo "    }";
		echo "    this.Update();";
		echo "    if (this.selected_index!=old) this.OnChange();";
		echo "  }";
		echo " ,GetValue : function(){";
		echo "    return jQuery('#$this->name').val();";
		echo "  }";
		echo " ,Update:function(){";
		echo "    jQuery('#$this->name').val(this.values[this.selected_index]);";
		echo "    for(var i = 0; i < this.values.length; i++) if (i===this.selected_index) jQuery('#$this->name-'+i).show(); else jQuery('#$this->name-'+i).hide();";
		echo "  }";
		echo " ,Change:function(){";
		echo "    this.selected_index++;";
		echo "    if (this.selected_index >= this.values.length) this.selected_index = 0;";
		echo "    this.Update();";
		echo "    this.OnChange();";
		echo "  }";
		echo " ,OnChange:function(){";
		echo $this->on_change;
		echo "  }";
		echo "};";
		echo Js::END;

	}


}


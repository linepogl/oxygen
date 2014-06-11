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
	public function AddMany($values,$captions_or_caption_map=null){
		$a = array();
		if (!is_null($captions_or_caption_map)) {
			if (!is_string($captions_or_caption_map) && !is_array($captions_or_caption_map) && is_callable($captions_or_caption_map)) {
				foreach ($values as $value)
					$a[] = $captions_or_caption_map($value);
			}
			else {
				foreach ($captions_or_caption_map as $caption)
					$a[] = $caption;
			}
		}
		$i = 0;
		foreach ($values as $value) {
			$this->Add( $value , $i < count($a) ? $a[$i] : null );
			$i++;
		}
		$this->last_index_from = count($this->list_values) - $i;
		return $this;
	}
	/** @return static */
	public function AddManyAssoc($value_caption_map){
		$i = 0;
		foreach ($value_caption_map as $value => $caption) {
			$this->Add( $value , $caption );
			$i++;
		}
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
	public function WithCaptions($captions_or_caption_map){
		if (!is_string($captions_or_caption_map) && !is_array($captions_or_caption_map) && is_callable($captions_or_caption_map)) {
			for ($i = $this->last_index_from; $i < count($this->list_captions); $i++)
				$this->list_captions[ $i ] = $captions_or_caption_map($this->list_values[$i]);
		}
		else {
			$i = $this->last_index_from;
			foreach ($captions_or_caption_map as $value)
				if ($i < count($this->list_captions))
					$this->list_captions[ $i++ ] = $value;
		}
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
	public function WithCssStyles($css_styles_or_css_style_map){
		if (!is_string($css_styles_or_css_style_map) && !is_array($css_styles_or_css_style_map) && is_callable($css_styles_or_css_style_map)) {
			for ($i = $this->last_index_from; $i < count($this->list_css_classes); $i++)
				$this->list_css_styles[ $i ] = $css_styles_or_css_style_map($this->list_values[$i]);
		}
		else {
			$i = $this->last_index_from;
			foreach ($css_styles_or_css_style_map as $value)
				if ($i < count($this->list_css_styles))
					$this->list_css_styles[ $i++ ] = $value;
		}
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
	public function WithCssClasses($css_classes_or_css_class_map){
		if (!is_string($css_classes_or_css_class_map) && !is_array($css_classes_or_css_class_map) && is_callable($css_classes_or_css_class_map)) {
			for ($i = $this->last_index_from; $i < count($this->list_css_classes); $i++)
				$this->list_css_classes[ $i ] = $css_classes_or_css_class_map($this->list_values[$i]);
		}
		else {
			$i = $this->last_index_from;
			foreach ($css_classes_or_css_class_map as $value)
				if ($i < count($this->list_css_classes))
					$this->list_css_classes[ $i++ ] = $value;
		}
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
		$ns = $this->name;
		ob_start();


		$readonly = $this->readonly || $this->mode != UIMode::Edit;
		echo HiddenBox::Make($ns,$this->value)->WithHttpName($readonly?null:$this->http_name);


		$class=' class="rollerbox-anchor'.($this->css_class==''?'':' '.$this->css_class).'"';
		$style=$this->css_style==''?'':' style="'.$this->css_style.'"';
		if ($readonly)
			echo '<span'.$class.$style.'>';
		else
			echo '<a'.$class.$style.' href="javascript:'.$ns.'.Change();">';

		$selected_index = $this->GetSelectedIndex();
		for ($i = 0; $i < count($this->list_values); $i++) {
			$style = ' style="'.$this->list_css_styles[$i].($i==$selected_index?'':'display:none;').'"'; if ($style==' style=""') $style = '';
			echo '<span'.$style.' id="'.$ns.'-'.$i.'">';
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

		$vals = [];
		foreach ($this->list_values as $value)
			$vals[] = ''.new Val($value);

		echo Js::BEGIN;
		echo "Oxygen.RollerBox({ns:".new Js($ns);
		if($readonly)            echo ",is_readonly:".new Js($readonly);
		if(!empty($vals))        echo ",values:".new Js($vals);
		if($selected_index!==0)  echo ",selected_index:".new Js($selected_index);
		if($this->on_change!='') echo ",on_change:function(){{$this->on_change}}";
		echo "});";
		echo Js::END;
		$r = ob_get_clean();
		echo $r;
		static $inst = 0;
		static $total = 0;
		$inst++;
		$total += strlen($r);

	}


}


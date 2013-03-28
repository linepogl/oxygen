<?php

class SelectBox extends Box {

	private $width = '';
	/** @return static */ public function WithWidth($value){ $this->width = $value; return $this; }

	private $rows = 1;
	/** @return static */ public function WithRows($value){ $this->rows = $value; return $this; }

	private $css_style = '';
	/** @return static */ public function WithCssStyle($value){ $this->css_style = $value; return $this; }

	private $css_class = '';
	/** @return static */ public function WithCssClass($value){ $this->css_class = $value; return $this; }

	private $is_multiple = false;
	/** @return static */ public function WithIsMultiple($value){ $this->is_multiple = $value; return $this; }

	private $allow_null = false;
	/** @return static */ public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '';
	/** @return static */ public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

	private $list_values = array();
	private $list_captions = array();
	private $list_group_captions = array();
	private $last_index_from = -1;

	/** @return static */
	public function Add($value,$caption=null){
		$this->list_values[] = $value;
		$this->list_captions[] = is_null($caption) ? new Html($value) : $caption;
		$this->list_group_captions[] = count($this->list_group_captions) > 0 ? $this->list_group_captions[count($this->list_group_captions)-1] : null;
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
	public function WithGroupCaption($value){
		for ($i = $this->last_index_from; $i < count($this->list_captions); $i++)
			$this->list_group_captions[ $i ] = strval($value);
		return $this;
	}
	/** @return static */
	public function WithGroupCaptions($group_captions_or_group_caption_map){
		if (!is_string($group_captions_or_group_caption_map) && !is_array($group_captions_or_group_caption_map) && is_callable($group_captions_or_group_caption_map)) {
			for ($i = $this->last_index_from; $i < count($this->list_group_groups); $i++)
				$this->list_group_groups[ $i ] = strval($group_captions_or_group_caption_map($this->list_values[$i]));
		}
		else {
			$i = $this->last_index_from;
			foreach ($group_captions_or_group_caption_map as $value)
				if ($i < count($this->list_group_groups))
					$this->list_group_groups[ $i++ ] = strval($value);
		}
		return $this;
	}



	private function IsSelected($value){
		if ($this->is_multiple){
			if (!is_null($this->value)){
				foreach ($this->value as $x) {
					if ( strval(new Val($value)) === strval(new Val($x)))
						return true;
				}
			}
			return false;
		}
		else {
			return strval(new Val($value)) === strval(new Val($this->value));
		}
	}



	public function Render(){
		if ($this->mode == UIMode::Edit){
			echo '<select id="'.$this->name.($this->is_multiple?'[]':'').'"';
			echo ' name="'.$this->name.'"';
			echo ' class="'.($this->readonly?'formLocked':'formPane').'"';
				echo ' onchange="'.$this->on_change.'"';
				echo ' style="'.(empty($this->display)?'':'display:'.$this->display.';').'width:'.(empty($this->width)?'auto':$this->width).';'.$this->css_style.'"';
			if ($this->is_multiple) echo ' multiple="multiple"';
			if ($this->readonly) echo ' disabled="disabled"';
			echo ' size="'.$this->rows.'">';

			if ( $this->allow_null )
				echo '<option value=""'.($this->IsSelected(null)?' selected="selected"':'').'>'.$this->null_caption.'</option>';

			$previous_group_caption = null;
			for ($i = 0; $i < count($this->list_values); $i++) {
				if ($this->list_group_captions[$i] != $previous_group_caption) {
					if (!is_null($previous_group_caption)) echo '</optgroup>';
					echo '<optgroup label="'.new Html($this->list_group_captions[$i]).'">';
				}
				echo '<option value="'.new Html(new Val($this->list_values[$i])).'"'.($this->IsSelected($this->list_values[$i])?' selected="selected"':'').'>'.$this->list_captions[$i].'</option>';

			}
			if (!is_null($previous_group_caption)) echo '</optgroup>';

			echo '</select>';
		}
		else {
			$j = 0;
			for ($i = 0; $i < count($this->list_values); $i++) {
				if ($this->IsSelected($this->list_values[$i])) {
					if ($j++>0) echo ', ';
					echo $this->list_captions[$i];
					break;
				}
			}
		}
	}

}




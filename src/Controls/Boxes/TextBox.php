<?php

class TextBox extends Box {

	private $width = '100%';
	public function WithWidth($value){ $this->width = $value; return $this; }

	private $rows = 1;
	public function WithRows($value){ $this->rows = $value; return $this; }

	private $css_style = '';
	public function WithCssStyle($value){ $this->css_style = $value; return $this; }

	private $css_class = '';
	public function WithCssClass($value){ $this->css_class = $value; return $this; }

	private $max_characters = null;
	public function WithMaxCharacters($value){ $this->max_characters = $value; return $this; }

	private $nowrap = false;
	public function WithNoWrap($value){ $this->nowrap = $value; return $this; }

	private $is_password = false;
	public function WithIsPassword($value){ $this->is_password = $value; return $this; }

	public function Render(){

		if ($this->mode != UIMode::Edit) {
			if ($this->is_password)
				echo '*****';
			else {
				echo '<span id="'.$this->name.'"';
				echo ' style="white-space:pre;'.($this->nowrap?'':'white-space:pre-wrap;').'"';
				echo '>'.new Html( $this->value ).'</span>';
			}
			return;
		}

		$css_class = 'formPane';
		if ($this->readonly) $css_class .= ' formLocked';
		$css_class .= ' '.$this->css_class;

		$css_style = 'width:'.(empty($this->width)?'auto':$this->width).';';
		$css_style .= $this->css_style;

		if ($this->is_password)
			echo '<input type="password"';
		elseif ($this->rows == 1)
			echo '<input type="text"';
		else
			echo '<textarea rows="'.$this->rows.'"';

		echo ' id="'.$this->name.'"';

		if ($this->readonly)
			echo ' readonly="readonly"';
		else
			echo ' name="'.$this->name.'"';

		echo ' class="'.$css_class.'"';
		echo ' style="'.$css_style.'"';

		if (!is_null($this->max_characters))
			echo ' maxlength="'.$this->max_characters.'"';

		if ($this->nowrap && $this->rows != 1 && !$this->is_password)
			echo ' wrap="off"';

		if (!is_null($this->on_change)){
			echo ' onchange="'.$this->on_change.'"';
			echo ' onkeyup="'.$this->on_change.'"';
		}

		if (!is_null($this->on_focus))
			echo ' onfocus="'.$this->on_focus.'"';

		if (!is_null($this->on_blur))
			echo ' onblur="'.$this->on_blur.'"';

		if ($this->rows == 1 || $this->is_password)
			echo ' value="'.new Html($this->value).'" />';
		else
			echo '>'.new Html($this->value).'</textarea>';
	}
}




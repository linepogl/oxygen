<?php


class PasswordBox extends Box {

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

	public function Render(){

		if ($this->mode != UIMode::Edit) {
			echo '*****';
			return;
		}

		$css_class = 'formPane';
		if ($this->readonly) $css_class .= ' formLocked';
		$css_class .= ' '.$this->css_class;

		$css_style = 'width:'.(empty($this->width)?'auto':$this->width).';';
		$css_style .= $this->css_style;

		echo '<input type="password"';
		echo ' id="'.$this->name.'"';

		if ($this->readonly)
			echo ' readonly="readonly"';
		else
			echo ' name="'.$this->name.'"';

		echo ' class="'.$css_class.'"';
		echo ' style="'.$css_style.'"';

		if (!is_null($this->max_characters))
			echo ' maxlength="'.$this->max_characters.'"';

		if (!is_null($this->on_change)){
			echo ' onchange="'.$this->on_change.'"';
			echo ' onkeyup="'.$this->on_change.'"';
		}

		if (!is_null($this->on_focus))
			echo ' onfocus="'.$this->on_focus.'"';

		if (!is_null($this->on_blur))
			echo ' onblur="'.$this->on_blur.'"';

		echo ' value="'.new Html($this->value).'" />';

	}
}




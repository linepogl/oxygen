<?php

class ButtonBox extends Box {

  private $on_click;
  public function WithOnClick($value){$this->on_click=$value; return $this; }

  private $is_submit = false;
  public function WithIsSubmit($value){$this->is_submit=$value; return $this; }

  private $is_reset = false;
  public function WithIsReset($value){$this->is_reset=$value; return $this; }

	private $is_rich = false;
	public function WithIsRich($value){$this->is_rich=$value; return $this; }

  private $is_disabled = false;
  public function WithIsDisabled($value){ $this->is_disabled=$value; return $this; }

	private $css_class = '';
	public function WithCssClass($value){ $this->css_class = $value; return $this; }

	private $css_style = '';
	public function WithCssStyle($value){ $this->css_style = $value; return $this; }

  public function Render(){
	  $type = 'button';
	  if ($this->is_submit) $type = 'submit';
	  elseif ($this->is_submit) $type = 'reset';

	  if ($this->is_rich) {
		  echo '<button type="'.$type.'" id="'.$this->name.'" onclick="'.new Html($this->on_click).'"'.($this->is_disabled?' class="formButtonDisabled '.$this->css_class.'" disabled="disabled"':' class="formButton '.$this->css_class.'"').' style="'.$this->css_style.'">'.$this->value.'</button>';
	  }
	  else {
			echo '<input type="'.$type.'" id="'.$this->name.'" name="'.$this->name.'" value="'.$this->value.'" onclick="'.new Html($this->on_click).'"'.($this->is_disabled?' class="formButtonDisabled '.$this->css_class.'" disabled="disabled"':' class="formButton '.$this->css_class.'"').'  style="'.$this->css_style.'"/>';
	  }
  }

}


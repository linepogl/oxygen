<?php

class ButtonControl extends ValueControl {

  private $onclick;
  public function WithOnClick($value){$this->onclick=$value; return $this; }

  private $issubmit = false;
  public function WithIsSubmit($value){$this->issubmit=$value; return $this; }

  private $isreset = false;
  public function WithIsReset($value){$this->isreset=$value; return $this; }

	private $isrichbutton = false;
	public function WithIsRichButton($value){$this->isrichbutton=$value; return $this; }

  private $isdisabled = false;
  public function WithIsDisabled($value){ $this->isdisabled=$value; return $this; }

	private $css_class = '';
	public function WithCssClass($value){ $this->css_class = $value; return $this; }

	private $css_style = '';
	public function WithCssStyle($value){ $this->css_style = $value; return $this; }

  public function Render(){
	  $type = 'button';
	  if ($this->issubmit) $type = 'submit';
	  elseif ($this->isreset) $type = 'reset';

	  if ($this->isrichbutton) {
		  echo '<button type="'.$type.'" id="'.$this->name.'" onclick="'.new Html($this->onclick).'"'.($this->isdisabled?' class="formButtonDisabled '.$this->css_class.'" disabled="disabled"':' class="formButton '.$this->css_class.'"').' style="'.$this->css_style.'">'.$this->value.'</button>';
	  }
	  else {
			echo '<input type="'.$type.'" id="'.$this->name.'" name="'.$this->name.'" value="'.$this->value.'" onclick="'.new Html($this->onclick).'"'.($this->isdisabled?' class="formButtonDisabled '.$this->css_class.'" disabled="disabled"':' class="formButton '.$this->css_class.'"').'  style="'.$this->css_style.'"/>';
	  }
  }

}

?>
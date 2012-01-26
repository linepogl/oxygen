<?php

class TextboxControl extends ValueControl {

	private $width = '100%';
	public function WithWidth($value){ $this->width = $value; return $this; }

	private $rows = 1;
	public function WithRows($value){ $this->rows = $value; return $this; }

	protected $readonly = false;
	public function WithReadonly($value){ $this->readonly = $value; return $this; }

	private $style = '';
	public function WithStyle($value){ $this->style = $value; return $this; }

	private $on_change = null;
	public function WithOnChange($value){ $this->on_change = $value; return $this; }

	private $on_blur = null;
	public function WithOnBlur($value){ $this->on_blur = $value; return $this; }

	private $max_characters = null;
	public function WithMaxCharacters($value){ $this->max_characters = $value; return $this; }

	private $nowrap = false;
	public function WithNoWrap($value){ $this->nowrap = $value; return $this; }

	private $has_expander = false;
	public function WithExpander($value){ $this->has_expander = $value; return $this; }

	public function Render(){
		if ($this->mode == UIMode::Edit){
			if ($this->rows == 1){
				echo '<input type="text" id="'.$this->name.'"';
				if (!$this->readonly) {
					echo ' name="'.$this->name.'"';
					echo ' class="formPane"';
				}
				else {
					echo ' readonly="readonly"';
					echo ' class="formLocked"';
				}
				echo ' style="width:'.(empty($this->width)?'auto':$this->width).';'.$this->style.'"';

				if (!is_null($this->max_characters))
					echo ' maxlength="'.$this->max_characters.'"';

				if (!is_null($this->on_change)){
					echo ' onchange="'.$this->on_change.'"';
					echo ' onkeyup="'.$this->on_change.'"';
				}

				if (!is_null($this->on_blur)){
					echo ' onblur="'.$this->on_blur.'"';
				}


				if ($this->readonly)
					echo ' value="'.new HumanReadableHtml($this->value).'" />';
				else
					echo ' value="'.new Html($this->value).'" />';
			}
			else {
				echo '<textarea id="'.$this->name.'" rows="'.$this->rows.'"';
				echo ' name="'.$this->name.'"';
				if (!$this->readonly) {
					echo ' name="'.$this->name.'"';
					echo ' class="formPane"';
				}
				else {
					echo ' readonly="readonly"';
					echo ' class="formLocked"';
				}

				if (!is_null($this->on_change)){
					echo ' onchange="'.$this->on_change.'"';
					echo ' onkeyup="'.$this->on_change.'"';
				}
				if (!is_null($this->on_blur)){
					echo ' onblur="'.$this->on_blur.'"';
				}

				if ($this->nowrap)
					echo ' wrap="off"';

				echo ' style="width:'.(empty($this->width)?'auto':$this->width).';'.$this->style.'"';


				echo '>'.new Html($this->value).'</textarea>';

				if ($this->has_expander){
					echo '<div id="'.$this->name.'_expander" class="notext" style="background:#f0f0f0;cursor:s-resize;'.(empty($this->width)?'auto':$this->width).'">';
					echo new Spacer(1,6);
					echo '</div>';
					echo Js::BEGIN;
					echo "var ".$this->name."_drag = null;";
					echo "$(".new Js($this->name.'_expander').").observe('mousedown',function(ev){";
					echo $this->name."_drag={x:ev.pointerX(),y:ev.pointerY()};";
					echo "});";
					echo "$(document.body).observe('mouseup',function(ev){";
					echo $this->name."_drag=null;";
					echo "});";
					echo "$(document.body).observe('mousemove',function(ev){";
					echo "if (".$this->name."_drag != null) {";
					echo "  var d = {x:ev.pointerX(),y:ev.pointerY()};";
					echo "  var dy = d.y - ".$this->name."_drag.y;";
					echo "  var x = $(".new Js($this->name).");";
					echo "  var h = x.getHeight();";
					echo "  h += dy - 4;";
					echo "  if (h > 13) x.style.height = h + 'px';";
					echo "  ".$this->name."_drag = d;";
					echo "}";
					echo "});";
					echo "Event.observe(window,'load',function(ev){";
					echo "$(".new Js($this->name.'_expander').").style.width = $(".new Js($this->name).").getWidth() + 'px';";
					echo "});";
					echo Js::END;
				}
			}
		}
		else {
			echo new HumanReadableHtml( $this->value );
		}
	}

}




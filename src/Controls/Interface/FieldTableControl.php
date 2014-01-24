<?php

class FieldTableControl extends Control {

	private $width = '50px';
	/** @return static */ public function WithWidth($value){ $this->width = $value; return $this; }

	private $css_class = '';
	/** @return static */ public function WithCssClass($value){ $this->css_class = $value; return $this; }

	private $label_width = '50px';
	/** @return static */ public function WithLabelWidth($value){ $this->label_width = $value; return $this; }

	private $labels_on_top = false;
	/** @return static */ public function WithLabelsOnTop($value){ $this->labels_on_top = $value; return $this; }

	private $label_nowrap = false;
	/** @return static */ public function WithLabelNoWrap($value){ $this->label_nowrap = $value; return $this; }

	private $title = null;
	/** @return static */ public function WithTitle($value){ $this->title = $value; return $this; }

	private $hide_validators = false;
	/** @return static */ public function WithHideValidators($value){ $this->hide_validators = $value; return $this; }


	private $labels = array();
	private $contents = array();
	private $asterisks = array();
	private $validators = array();
	private $row_names = array();
	private $row_css_styles = array();
	private $row_css_classes = array();

	public function Add($that){
		if ($that instanceof XWrapField || $that instanceof XMetaField || $that instanceof XWrapSlave || $that instanceof XMetaSlave){
			$this->labels[] = $that->GetLabel();
			$this->contents[] = '';
		}
		elseif ($that instanceof ValueControl){
			$this->labels[] = $that->label;
			$this->contents[] = $that->GetContent();
		}
		else {
			$this->labels[] = $that;
			$this->contents[] = '';
		}
		$this->asterisks[] = false;
		$this->validators[] = null;
		$this->row_names[] = 'tr'.ID::Random()->AsHex();
		$this->row_css_classes[] = '';
		$this->row_css_styles[] = '';
		return $this;
	}

	public function AddOKCancel(){
		$this->Add('');
		$this->Write(ButtonBox::Make()->WithIsSubmit(true)->WithValue(Lemma::Pick('OK')).'&nbsp;'.ButtonBox::Make()->WithValue(Lemma::Pick('Cancel'))->WithOnClick("history.back();"));
	}

	public function AddSubmitReset(){
		$this->Add('');
		$this->Write(ButtonBox::Make()->WithValue(Lemma::Pick('OK'))->WithIsSubmit(true).new Spacer(7).ButtonBox::Make()->WithValue(Lemma::Pick('Cancel'))->WithIsReset(true));
	}


	public function Write($that){
		$this->contents[count($this->contents) - 1] .= $that;
		return $this;
	}

	public function WithAsterisk($value){
		$this->asterisks[count($this->asterisks) - 1] = $value;
		return $this;
	}
	public function WithValidator($validator){
		$this->validators[count($this->validators) - 1] = $validator;
		return $this;
	}
	public function WithRowName($value){
		$this->row_names[count($this->row_names) - 1] = $value;
		return $this;
	}
	public function WithRowCssStyle($value){
		$this->row_css_styles[count($this->row_css_styles) - 1] = $value;
		return $this;
	}
	public function WithRowCssClass($value){
		$this->row_css_classes[count($this->row_css_classes) - 1] = $value;
		return $this;
	}

	public function Render(){

		if ($this->labels_on_top){
			echo '<table class="fieldtable '.$this->css_class.'" style="width:'.(empty($this->width)?'auto':$this->width).';">';

			if (!is_null($this->title)) echo '<tr><td><h2>'.$this->title.'</h2></td></tr>';

			for ($i=0; $i<count($this->labels); $i++){
				if ($this->labels[$i]=='-'){
					echo '<tr><td class="notext '.$this->row_css_classes[$i].'" style="border-bottom:1px solid #cccccc;">'.new Spacer(1,10).'</td></tr>';
					echo '<tr><td class="notext '.$this->row_css_classes[$i].'">'.new Spacer(1,10).'</td></tr>';
				}
				else{
					$vcode = null; if ($this->validators[$i] != null) if (count($this->validators[$i])>0) $vcode = $this->validators[$i]->GetCode();
					echo '<tr class="'.$vcode.' '.$this->row_css_classes[$i].'"><td style="text-align:left;padding:15px 1px 1px 1px;">'.$this->labels[$i].($this->asterisks[$i]?oxy::icoRequired():'').'</td></tr>';
					echo '<tr class="'.$vcode.' '.$this->row_css_classes[$i].'"><td style="text-align:left;">'.$this->contents[$i].'</td></tr>';
					if (!is_null($vcode) && !$this->hide_validators)
						echo '<tr class="'.$vcode.' '.$this->row_css_classes[$i].'"><td style="text-align:left;padding:1px 0 0 0">'.new MessageControl($this->validators[$i]).'</td></tr>';
				}
			}
			echo '</table>';
		}
		else {
			echo '<table class="fieldtable '.$this->css_class.'" style="width:'.(empty($this->width)?'auto':$this->width).';">';

			echo '<tr><td class="notext">'.new Spacer(intval($this->label_width)).'</td>';
			if (!is_null($this->title))
				echo '<td class="expand"><h2>'.$this->title.'</h2></td>';
			else
				echo '<td class="expand notext">'.new Spacer().'</td>';
			echo '</tr>';

			for ($i=0; $i<count($this->labels); $i++){
				if ($this->labels[$i]=='-'){
					echo '<tr><td class="notext">'.new Spacer().'</td><td class="notext" style="border-bottom:1px solid #cccccc;">'.new Spacer(1,10).'</td></tr>';
					echo '<tr><td class="notext">'.new Spacer().'</td><td class="notext">'.new Spacer(1,10).'</td></tr>';
				}
				else{
					$vcode = null; if ($this->validators[$i] != null) if (count($this->validators[$i])>0) $vcode = $this->validators[$i]->GetCode();
					echo '<tr id="'.$this->row_names[$i].'" class="'.$vcode.' '.$this->row_css_classes[$i].'" style="'.$this->row_css_styles[$i].'">';
					echo '<td class="label" style="'.($this->label_nowrap?'white-space:nowrap;':'').'width:'.$this->label_width.';">'.($this->asterisks[$i]?oxy::icoRequired():'').$this->labels[$i].'</td>';
					echo '<td class="value">'.$this->contents[$i];
					if (!is_null($vcode) && !$this->hide_validators)
						echo '<div style="padding:2px 0 0 0">'.new MessageControl($this->validators[$i]).'</div>';
					echo '</td>';
					echo '</tr>';
				}
			}
			echo '</table>';
		}
	}


}



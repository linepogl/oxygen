<?php

class FieldTableControl extends Control {

	private $width = '50px';
	public function WithWidth($value){ $this->width = $value; return $this; }

	private $label_width = '50px';
	public function WithLabelWidth($value){ $this->label_width = $value; return $this; }

	private $labels_on_top = false;
	public function WithLabelsOnTop($value){ $this->labels_on_top = $value; return $this; }

	private $label_nowrap = false;
	public function WithLabelNoWrap($value){ $this->label_nowrap = $value; return $this; }

	private $title = null;
	public function WithTitle($value){ $this->title = $value; return $this; }

	private $hide_validators = false;
	public function WithHideValidators($value){ $this->hide_validators = $value; return $this; }


	private $labels = array();
	private $contents = array();
	private $asterisks = array();
	private $validators = array();
	private $row_names = array();

	public function Add($that){
		if ($that instanceof XWrapField || $that instanceof XField || $that instanceof XWrapSlave || $that instanceof XSlave){
			$this->labels[] = $that->GetLabel();
			$this->contents[] = '';
		}
		elseif ($that instanceof ValueControl){
			$this->labels[] = $that->label;
			$this->contents[] = '' . $that;
		}
		else {
			$this->labels[] = $that;
			$this->contents[] = '';
		}
		$this->asterisks[] = false;
		$this->validators[] = null;
		$this->row_names[] = 'tr'.ID::Random()->AsHex();
		return $this;
	}

	public function AddOKCancel(){
		$this->Add('');
		$this->Write(ButtonControl::Make()->WithIsSubmit(true)->WithValue(Lemma::Pick('OK')).'&nbsp;'.ButtonControl::Make()->WithValue(Lemma::Pick('Cancel'))->WithOnClick("history.back();"));
	}

	public function AddSubmitReset(){
		$this->Add('');
		$this->Write(ButtonControl::Make()->WithValue(Lemma::Pick('OK'))->WithIsSubmit(true).new Spacer(7).ButtonControl::Make()->WithValue(Lemma::Pick('Cancel'))->WithIsReset(true));
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

	public function Render(){

		if ($this->labels_on_top){
			echo '<table class="fieldtable" cellspacing="0" cellpadding="0" border="0" style="width:'.(empty($this->width)?'auto':$this->width).';">';

			if (!is_null($this->title)) echo '<tr><td><h2>'.$this->title.'</h2></td></tr>';

			for ($i=0; $i<count($this->labels); $i++){
				if ($this->labels[$i]=='-'){
					echo '<tr><td class="notext" style="border-bottom:1px solid #cccccc;">'.new Spacer(1,10).'</td></tr>';
					echo '<tr><td class="notext">'.new Spacer(1,5).'</td></tr>';
				}
				else{
					$vcode = null; if ($this->validators[$i] != null) if (count($this->validators[$i])>0) $vcode = $this->validators[$i]->GetCode();
					echo '<tr class="'.$vcode.'"><td style="text-align:left;padding:15px 1px 1px 1px;">'.$this->labels[$i].($this->asterisks[$i]?'<span style="word-spacing:1px;font-size:1px;">&nbsp;<img src="oxy/img/asterisk.gif" /></span>':'').'</td></tr>';
					echo '<tr class="'.$vcode.'"><td style="text-align:left;">'.$this->contents[$i].'</td></tr>';
					if (!is_null($vcode) && !$this->hide_validators)
						echo '<tr class="'.$vcode.'"><td style="text-align:left;padding:1px 0 0 0">'.new MessageControl($this->validators[$i]).'</td></tr>';
				}
			}
			echo '</table>';
		}
		else {
			echo '<table class="fieldtable" cellspacing="5" cellpadding="0" border="0" style="width:'.(empty($this->width)?'auto':$this->width).';">';

			echo '<tr><td class="notext">'.new Spacer(intval($this->label_width)).'</td>';
			if (!is_null($this->title))
				echo '<td class="expand"><h2>'.$this->title.'</h2></td>';
			else
				echo '<td class="expand notext">'.new Spacer().'</td>';
			echo '</tr>';

			for ($i=0; $i<count($this->labels); $i++){
				if ($this->labels[$i]=='-'){
					echo '<tr><td class="notext">'.new Spacer().'</td><td class="notext" style="border-bottom:1px solid #cccccc;">'.new Spacer(1,10).'</td></tr>';
					echo '<tr><td class="notext">'.new Spacer().'</td><td class="notext">'.new Spacer(1,5).'</td></tr>';
				}
				else{
					$vcode = null; if ($this->validators[$i] != null) if (count($this->validators[$i])>0) $vcode = $this->validators[$i]->GetCode();
					echo '<tr id="'.$this->row_names[$i].'" class="'.$vcode.'">';
					echo '<td class="vtop hright label" style="'.($this->label_nowrap?'white-space:nowrap;':'').'width:'.$this->label_width.';">'.($this->asterisks[$i]?'<span style="word-spacing:1px;font-size:1px;"><img src="oxy/img/asterisk.gif" />&nbsp;</span>':'').$this->labels[$i].'</td>';
					echo '<td class="hleft value">'.$this->contents[$i];
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



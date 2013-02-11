<?php

class SelectControl extends ValueControl {

	private $width = '';
	public function WithWidth($value){ $this->width = $value; return $this; }

	private $rows = 1;
	public function WithRows($value){ $this->rows = $value; return $this; }

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $is_multiple = false;
	public function WithIsMultiple($value){ $this->is_multiple = $value; return $this; }

	private $use_check_boxes = false;
	public function WithCheckBoxes($value){ $this->use_check_boxes = $value; return $this; }

	private $style = '';
	public function WithStyle($value){ $this->style = $value; return $this; }

	private $display = null;
	public function WithDisplay($value){ $this->display = $value; return $this; }

	private $on_change = '';
	public function WithOnChange($value){ $this->on_change = $value; return $this; }

	private $NullCaption = '&nbsp;';
	public function WithNullCaption($value){ $this->NullCaption = $value; return $this; }

	private $is_readonly = false;
	public function WithReadonly($value){ $this->is_readonly = $value; return $this; }

	private $list_values = array();
	private $list_groups = array();
	private $list_captions = array();
	public function Add($value,$caption=null){
		$this->list_values[] = $value;
		$this->list_groups[] = null;
		if (is_null($caption)){
			$caption = strval(new Html($value));
		}
		$this->list_captions[] = $caption;
		return $this;
	}
	public function AddGroup($caption){
		$this->list_values[] = null;
		$this->list_groups[] = $caption;
		$this->list_captions[] = null;
	}

	public function AddXItemWithVersion(XItem $dbitem){
		return $this->Add( $dbitem->id , $dbitem->GetCode() . ' '. Lemma::Pick('TITRE_VERSION'). ' '. $dbitem->version. ' &rarr; ' . $dbitem->GetTitle() );
	}

	public function AddXItem(XItem $dbitem){
		return $this->Add( $dbitem->id , $dbitem->GetCode() . ' &rarr; ' . $dbitem->GetTitle() );
	}
	public function AddXItemCodeOnly(XItem $dbitem){
		return $this->Add( $dbitem->id , $dbitem->GetCode());
	}
	public function AddXItemTitleOnly(XItem $dbitem){
		return $this->Add( $dbitem->id , $dbitem->GetTitle() );
	}

	public function WithOptions($value_caption_array){
		foreach ($value_caption_array as $value=>$caption)
			$this->Add($value,$caption);
		return $this;
	}
	public function WithSimpleOptions($value_array){
		foreach ($value_array as $value)
			$this->Add($value,$value);
		return $this;
	}
	public function WithOption($value,$caption=null){
		$this->Add($value,$caption);
		return $this;
	}
	public function WithGroup($caption){
		$this->AddGroup($caption);
		return $this;
	}
	public function WithXList($dblist){
		foreach ($dblist as $x) $this->AddXItem($x);
		return $this;
	}
	public function WithDBVersionnedList($dblist){
		foreach ($dblist as $x) $this->AddXItemWithVersion($x);
		return $this;
	}
	public function WithXListCodeOnly($dblist){
		foreach ($dblist as $x) $this->AddXItemCodeOnly($x);
		return $this;
	}
	public function WithXListTitleOnly($dblist){
		foreach ($dblist as $x) $this->AddXItemTitleOnly($x);
		return $this;
	}

	private function IsSelected($value){
		if ($this->is_multiple){
			if (!is_null($this->value)){
				foreach ($this->value as $x) {
					if ((is_null($x) || $x === '') && (is_null($value) || $value===''))
						return true;
					if ( strval(new Html($value)) === strval(new Html($x)))
						return true;
				}
			}
			return false;
		}
		else {
			return strval(new Html($value)) === strval(new Html($this->value));
		}
	}

	public function Render(){
		if ($this->mode == UIMode::Edit){
			if ($this->use_check_boxes) {
				echo '<div class="formPane" style="'.(empty($this->display)?'':'display:'.$this->display.';').'height:'.($this->rows*23).'px;width:'.(empty($this->width)?'auto':$this->width).';overflow:auto;white-space:nowrap;'.$this->style.'">';

				if ( $this->allow_null )
					echo '<div><input class="formCheck" type="'.($this->is_multiple?'checkbox':'radio').'" name="'.$this->name.($this->is_multiple?'[]':'').'" id="'.$this->name.'_null" value=""'.($this->IsSelected(null)?' checked="checked"':'').' onclick="'.$this->on_change.'" /><label for="'.$this->name.'_null">' . $this->NullCaption . '</label></div>';

				for ($i = 0; $i < count($this->list_values); $i++)
					echo '<div><input class="formCheck" type="'.($this->is_multiple?'checkbox':'radio').'" name="'.$this->name.($this->is_multiple?'[]':'').'" id="'.$this->name.$i.'" value="'.new Html($this->list_values[$i]).'"'.($this->IsSelected($this->list_values[$i])?' checked="checked"':'').' onclick="'.$this->on_change.'" /><label for="'.$this->name.$i.'">'.$this->list_captions[$i].'</label></div>';

				echo '</div>';
			}
			else {
				echo '<select id="'.$this->name.($this->is_multiple?'[]':'').'"';
				echo ' name="'.$this->name.'"';
				echo ' class="'.($this->is_readonly?'formLocked':'formPane').'"';
 				echo ' onchange="'.$this->on_change.'"';
 				echo ' style="'.(empty($this->display)?'':'display:'.$this->display.';').'width:'.(empty($this->width)?'auto':$this->width).';'.$this->style.'"';
				if ($this->is_multiple) echo ' multiple="multiple"';
				if ($this->is_readonly) echo ' disabled="disabled"';
				echo ' size="'.$this->rows.'">';

				if ( $this->allow_null )
					echo '<option value=""'.($this->IsSelected(null)?' selected="selected"':'').'>'.$this->NullCaption.'</option>';

				$group_count = 0;
				for ($i = 0; $i < count($this->list_values); $i++)
					if (!is_null($this->list_groups[$i])){
						if ($group_count++ > 0) echo '</optgroup>';
						echo '<optgroup label="'.new Html($this->list_groups[$i]).'">';
					}
					else
						echo '<option value="'.new Html(rawurldecode(new Url($this->list_values[$i]))).'"'.($this->IsSelected($this->list_values[$i])?' selected="selected"':'').'>'.$this->list_captions[$i].'</option>';

					if ($group_count > 0) echo '</optgroup>';


				echo '</select>';
			}
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




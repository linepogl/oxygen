<?php

class ReportTableControl extends ValueControl {


	private $on_change = '';
	/** @return ReportTableControl */ public function WithOnChange($value){ $this->on_change = $value; return $this; }

	private $on_none_selected = '';
	/** @return ReportTableControl */ public function WithOnNoneSelected($value){ $this->on_none_selected = $value; return $this; }

	private $on_row_selected = '';
	/** @return ReportTableControl */ public function WithOnRowSelected($value){ $this->on_row_selected = $value; return $this; }

	private $on_many_rows_selected = '';
	/** @return ReportTableControl */ public function WithOnManyRowsSelected($value){ $this->on_many_rows_selected = $value; return $this; }



	/** @var Action */ private $menu_panel = null;
	/** @return ReportTableControl */ public function WithMenuPanel($value){ $this->menu_panel = $value; return $this; }

	private $require_two_or_more_items_to_show_menu_panel = false;
	public function WithRequireTwoOrMoreItemsToShowMenuPanel($value){ $this->require_two_or_more_items_to_show_menu_panel = $value; return $this; }


	private $icon = null;
	/** @return ReportTableControl */ public function WithIcon($value){ $this->icon = $value; return $this; }

	private $empty_message = null;
	/** @return ReportTableControl */ public function WithEmptyMessage(Message $value){ $this->empty_message = $value; return $this; }

	private $use_check_boxes = false;
	public function WithCheckBoxes($value){ $this->use_check_boxes = $value; return $this; }

	private $is_multiple = false;
	public function WithIsMultiple($value){ $this->is_multiple = $value; return $this; }

	private $show_header = true;
	public function WithShowHeader($value){ $this->show_header = $value; return $this; }

	private $show_numbers = true;
	public function WithShowNumbers($value){ $this->show_numbers = $value; return $this; }

	private $begin_numbering_from = 1;
	public function WithBeginNumberingFrom($value){ $this->begin_numbering_from = $value; return $this; }

	private $css_class = 'report';
	private $css_style = '';

	private $rows = array();
	private $row_css_class = array();
	private $row_css_style = array();
	private $row_value = array();
	private $row_mode = array();
	private $row_js = array();
	private $row_has_value = array();

	private $cells = array( array() );
	private $cell_css_class = array( array() );
	private $cell_css_style = array( array() );
	private $cell_fill_row = array( array() );
	private $cell_onclick = array( array() );


	private $sorted_by = null;
	private $sorted_desc = false;
	/** @return ReportTableControl */ public function WithIsSortedBy($col,$desc=false){ $this->sorted_by = $col; $this->sorted_desc = $desc; return $this; }



	const ROW_NORMAL = 0;
	const ROW_SPECIAL = 1;
	const ROW_GROUP = 2;
	private function add_row($value,$mode){
		$this->rows[] = $value;
		$this->row_mode[] = $mode;
		$this->row_css_class[] = '';
		$this->row_css_style[] = '';
		$this->row_value[] = null;
		$this->row_has_value[] = false;
		$this->row_js[] = new Js(null);
		$this->cells[] = array();
		$this->cell_css_class[] = array();
		$this->cell_css_style[] = array();
		$this->cell_onclick[] = array();
		$this->cell_tag[] = array();
		$this->cell_fill_row[] = array();
	}
	/** @return ReportTableControl */ public function AddRow($value=null){ $this->add_row($value,self::ROW_NORMAL); return $this;}
	/** @return ReportTableControl */ public function AddSpecialRow($value=null){ $this->add_row($value,self::ROW_SPECIAL); return $this; }
	/** @return ReportTableControl */ public function AddGroupRow(){ $this->add_row(null,self::ROW_GROUP); return $this; }


	private function add_cell($value,$tag){
		$i = count($this->rows) - 1;
		$this->cells[$i+1][] = strval($value);
		$this->cell_tag[$i+1][] = $tag;
		$this->cell_css_class[$i+1][] = '';
		$this->cell_css_style[$i+1][] = '';
		$this->cell_fill_row[$i+1][] = false;
		$this->cell_onclick[$i+1][] = '';
	}
	/** @return ReportTableControl */ public function AddTh($value=''){ $this->add_cell($value,'th'); return $this; }
	/** @return ReportTableControl */ public function AddTd($value=''){ $this->add_cell($value,'td'); return $this; }
	/** @return ReportTableControl */ public function Write($value){
		$i = count($this->rows) - 1;
		$j = count($this->cells[$i+1]) - 1;
		$this->cells[$i+1][$j] .= $value;
		return $this;
	}
	/** @return ReportTableControl */ public function WithCssClass($value){
		$i = count($this->rows) - 1;
		$j = count($this->cells[$i+1]) - 1;
		if ($j < 0) {
			if ($i < 0)
				$this->css_class = $value;
			else
				$this->row_css_class[$i] = $value;
		}
		else
			$this->cell_css_class[$i+1][$j] = $value;
		return $this;
	}
	/** @return ReportTableControl */ public function WithCssStyle($value){
		$i = count($this->rows) - 1;
		$j = count($this->cells[$i+1]) - 1;
		if ($j < 0) {
			if ($i < 0)
				$this->css_style = $value;
			else
				$this->row_css_style[$i] = $value;
		}
		else
			$this->cell_css_style[$i+1][$j] = $value;
		return $this;
	}
	/** @return ReportTableControl */ public function WithOnClick($value){
		$i = count($this->rows) - 1;
		$j = count($this->cells[$i+1]) - 1;
		if ($j < 0) {
		}
		else
			$this->cell_onclick[$i+1][$j] = $value;
		return $this;
	}
	/** @return ReportTableControl */ public function WithFillRow($value){
		$i = count($this->rows) - 1;
		$j = count($this->cells[$i+1]) - 1;
		if ($i < 0)
			;
		else
			$this->cell_fill_row[$i+1][$j] = $value;
		return $this;
	}

	/** @return ReportTableControl */ public function WithRowValue($value){
		$i = count($this->rows) - 1;
		if ($i < 0)
			;
		else {
			$this->row_value[$i] = $value;
			$this->row_has_value[$i] = true;

			if ($value instanceof XItem) {
				$this->row_js[$i] = '{'
					.' name:'.new Js($this->name.$value->GetClassName().$value->id->AsHex())
					.',idItem:'.new Js($value->id)
					.',ItemClassName:'.new Js($value->GetClassName())
					.'}';
			}
			else {
				$this->row_js[$i] = new Js(strval(new Url($value)));
			}
		}
		return $this;
	}



	private function IsClickable($row_indwx){
		if ($this->row_mode[$row_indwx] == self::ROW_NORMAL) {
			return $this->row_has_value[$row_indwx];
		}
		elseif ($this->row_mode[$row_indwx] == self::ROW_GROUP && $this->is_multiple) {
			$found = false;
			for ($i = $row_indwx + 1; $i < count($this->rows); $i++) {
				if ($this->row_mode[$i] == self::ROW_NORMAL) {
					if ($this->row_has_value[$i]) {
						$found = true;
						break;
					}
				}
				if ($this->row_mode[$i] == self::ROW_GROUP) {
					break;
				}
			}
			return $found;
		}
		return false;
	}

	private function IsSelected($value){
		if ($this->is_multiple){
			if (!is_null($this->value)){
				foreach ($this->value as $x) {
					if ((is_null($x) || $x == '') && (is_null($value) || $value==''))
						return true;
					if (strval(new Url($value)) == strval(new Url($x)))
						return true;
				}
			}
			return false;
		}
		else {
			return strval(new Url($value)) == strval(new Url($this->value));
		}
	}








	public function Render(){
		$count_rows = count($this->rows);
		$count_cols = 0; foreach ($this->cells as &$a){ $x = count($a); if ($x > $count_cols) $count_cols = $x; }
		$has_values = false; foreach ($this->row_has_value as &$b) if ($b) { $has_values = true; break; }
		$displayed_row_number = $this->begin_numbering_from;




















		$row_indices = array();
		$row_with_values_indices = array();
		for ($i = 0; $i < count($this->rows); $i++) $row_indices[] = $i;
		for ($i = 0; $i < count($this->rows); $i++) if ($this->row_has_value[$i]) $row_with_values_indices[] = $i;


		$group_row_indices_to_row_with_values_indices_map = array();
		for ($i = 0; $i < count($this->rows); $i++) {
			if ($this->row_mode[$i] == self::ROW_GROUP){
				$a = array();
				for ($j = $i + 1; $j < count($this->rows); $j++){
					if ($this->row_mode[$j] == self::ROW_GROUP) break;
					if ($this->IsClickable($j)) $a[] = $j;
				}
				$group_row_indices_to_row_with_values_indices_map[$i] = $a;
			}
		}


		//
		//
		// JAVASCRIPT
		//
		//
		echo Js::BEGIN;
		echo $this->name . " = {";
		echo "  event_running : false";
		$s = ''; foreach ($row_indices as $i) $s .= ($s==''?'':',') . $this->row_js[$i];
		echo " ,rows : [" . $s . "]";

		echo " ,OnMouseOver : function(ev,i){";
		echo "    $('".$this->name."_tr_'+i).addClassName('hover');";
		echo "  }";
		echo " ,OnMouseOut : function(ev,i){";
		echo "    $('".$this->name."_tr_'+i).removeClassName('hover');";
		echo "  }";

		echo " ,OnRowClick : function(ev,i){";
		echo "    ev = Event.extend(ev||window.event);";
		echo "    if (ev.element().tagName != 'TD' && ev.element().tagName != 'TH') return;";
		echo "    if (this.event_running) return; this.event_running = true;";
		if ($this->is_multiple) {
			echo "var v = this.IsChecked(i);";
			echo "if (this.AreMoreChecked(i)) v=false;";
			if ($has_values) echo "this.SetAllChecks(false);";
			echo "this.SetCheck(i,!v);";
			echo "this.UpdateValue();";
			if ($has_values) echo "this.SetCheck('all',this.AreAllChecked());";
		}
		else {
			if ($has_values) echo "this.SetAllChecks(false);";
			echo "this.SetCheck(i,true);";
			echo "this.UpdateValue();";
		}
		echo "    this.event_running = false;";
		echo "  }";

		if ($this->is_multiple) {
			echo " ,OnGroupRowClick : function(ev,i){";
			echo "    ev = Event.extend(ev||window.event);";
			echo "    if (ev.element().tagName != 'TD' && ev.element().tagName != 'TH') return;";
			echo "    ev.stop();";
			echo "    var v = !this.IsChecked(i);";
			echo "    this.SetCheck(i,v);";
			echo "    this.SetGroupChecks(i,v);";
			echo "  }";
		}



		echo " ,OnCheckThClick : function(ev,i){";
		echo "    ev = Event.extend(ev||window.event);";
		echo "    if (ev.element().tagName != 'TD' && ev.element().tagName != 'TH') return;";
		echo "    ev.stop();";
		echo "    this.SetAllChecks(!this.IsChecked('all'));";
		echo "  }";
		echo " ,OnGroupCheckTdClick : function(ev,i){";
		echo "    ev = Event.extend(ev||window.event);";
		echo "    if (ev.element().tagName != 'TD' && ev.element().tagName != 'TH') return;";
		echo "    ev.stop();";
		echo "    var v = !this.IsChecked(i);";
		echo "    this.SetCheck(i,v);";
		echo "    this.SetGroupChecks(i,v);";
		echo "  }";
		echo " ,OnCheckTdClick : function(ev,i){";
		echo "    ev = Event.extend(ev||window.event);";
		echo "    if (ev.element().tagName != 'TD' && ev.element().tagName != 'TH') return;";
		echo "    ev.stop();";
		echo "    this.SetCheck(i,!this.IsChecked(i));";
		echo "  }";





		echo " ,OnCheckChange : function(i){";
		echo "    if (this.event_running) return; this.event_running = true;";
		echo "    var v = this.IsChecked(i);";
		if (!$this->is_multiple) echo "v = true;";
		if (!$this->is_multiple && $has_values) echo "this.SetAllChecks(false);";
		echo "    this.SetCheck(i,v);";
		if ($this->is_multiple && $has_values) echo "this.SetCheck('all',this.AreAllChecked());";
		foreach ($group_row_indices_to_row_with_values_indices_map as $ii=>$a){
			echo "this.SetCheck(".new Js($ii).",this.AreAllInGroupChecked(".new Js($ii)."));";
		}
		echo "    this.UpdateValue();";
		echo "    this.event_running = false;";
		echo "  }";
		echo " ,OnGroupCheckChange : function(i){";
		echo "    if (this.event_running) return; this.event_running = true;";
		echo "    var v = this.IsChecked(i);";
		echo "    this.SetCheck(i,v);";
		echo "    this.SetGroupChecks(i,v);";
		echo "    this.UpdateValue();";
		echo "    this.event_running = false;";
		echo "  }";
		echo " ,OnCheckAllChange : function(){";
		echo "    if (this.event_running) return; this.event_running = true;";
		echo "    var v = this.IsChecked('all');";
		echo "    this.SetAllChecks(v);";
		echo "    this.UpdateValue();";
		echo "    this.event_running = false;";
		echo "  }";

		echo " ,IsChecked : function(i){";
		echo "    var x = ".new Js($this->name)." + '_check_' + i;";
		echo "    return \$F(x)=='true';";
		echo "  }";
		echo " ,AreAllChecked : function(){";
		echo "    var r = true"; foreach ($row_with_values_indices as $i) echo "&&this.IsChecked(".new Js($i).")"; echo ";";
		echo "    return r;";
		echo "  }";
		echo " ,AreAllInGroupChecked : function(i){";
		echo "    var r = true;";
		foreach ($group_row_indices_to_row_with_values_indices_map as $i=>$a) {
			echo "    if (i == ".new Js($i).") r = r"; foreach ($a as $j) echo "&&this.IsChecked(".new Js($j).")"; echo ";";
		}
		echo "    return r;";
		echo "  }";
		echo " ,AreMoreChecked : function(i){";
		echo "    var r = false"; foreach ($row_with_values_indices as $i) echo "||(i!=".$i."&&this.IsChecked(".new Js($i)."))"; echo ";";
		echo "    return r;";
		echo "  }";
		echo " ,SetCheck : function(i,v){";
		echo "    var x = ".new Js($this->name)." + '_check_' + i;";
		echo "    if (v) eval(x+'_SetValue(\\'true\\');'); else eval(x+'_SetValue(\\'false\\');');";
		echo "    var tr = $('".$this->name."_tr_'+i);";
		echo "    if (tr != null) {";
		echo "      if (v) tr.addClassName('selected'); else tr.removeClassName('selected');";
		echo "    }";
		echo "  }";
		echo " ,SetAllChecks : function(v){";
		echo "    var a = [" . implode(',',$row_with_values_indices) ."];";
		echo "    for (var i = 0; i < a.length; i++) this.SetCheck(a[i],v);";
		foreach ($group_row_indices_to_row_with_values_indices_map as $ii=>$a){
			echo "this.SetCheck(".new Js($ii).",this.AreAllInGroupChecked(".new Js($ii)."));";
		}
		echo "  }";
		echo " ,SetGroupChecks : function(i,v){";
		foreach ($group_row_indices_to_row_with_values_indices_map as $i=>$a){
			echo "    if(i==".new Js($i).") {";
			echo "      var a = [" . implode(',',$a) ."];";
			echo "      for (var j = 0; j < a.length; j++) this.SetCheck(a[j],v);";
			echo "    }";
		}
		if ($has_values) echo "this.SetCheck('all',this.AreAllChecked());";
		echo "  }";
		echo " ,UpdateValue : function(){";
		echo "    var s = '';";
		foreach ($row_with_values_indices as $i) echo "if(this.IsChecked(".new Js($i)."))s+=(s==''?'':',')+".new Js(strval(new Url($this->row_value[$i]))).";";
		echo "    var rows = [];";
		echo "    var a = [" . implode(',',$row_with_values_indices) ."];";
		echo "    for (var i = 0; i < a.length; i++) if(this.IsChecked(a[i])) rows.push(this.rows[a[i]]);";
		echo "    \$(".new Js($this->name).").value = s;";
		echo "    if (IsPageLoaded()) {";
		echo "      if (rows.length == 0) " . $this->name . ".OnNoneSelected();";
		echo "      else if (rows.length == 1) " . $this->name . ".OnRowSelected(rows[0]);";
		echo "      else " . $this->name . ".OnManyRowsSelected(rows);";
		echo "    }";
		echo "  }";
		echo " ,OnNoneSelected : function() {";
		if (!is_null($this->menu_panel)) echo "this.HideMenuPanel();";
		echo $this->on_none_selected;
		echo $this->on_change;
		echo "  }";
		echo " ,OnRowSelected : function(row) {";
		if (!is_null($this->menu_panel)) echo $this->require_two_or_more_items_to_show_menu_panel ? "this.HideMenuPanel();" : "this.ShowMenuPanel([row]);";
		echo $this->on_row_selected;
		echo $this->on_change;
		echo "  }";
		echo " ,OnManyRowsSelected : function(rows) {";
		if (!is_null($this->menu_panel)) echo "this.ShowMenuPanel(rows);";
		echo $this->on_many_rows_selected;
		echo $this->on_change;
		echo "  }";

		if (!is_null($this->menu_panel)){
			echo " ,HideMenuPanel : function(){";
			echo "    \$(".new Js($this->name.'_menu_panel_1').").hide();";
			echo "    \$(".new Js($this->name.'_menu_panel_2').").hide();";
			echo "  }";
			echo " ,ShowMenuPanel : function(rows){";
			echo "    var x1 = \$(".new Js($this->name.'_menu_panel_1').");";
			echo "    var x2 = \$(".new Js($this->name.'_menu_panel_2').");";
			echo "    x1.update('<img src=\"oxy/img/ajax.gif\" width=\"22\" />').show();";
			echo "    x2.update('<img src=\"oxy/img/ajax.gif\" width=\"22\" />').show();";
			echo "    var a = {};";
			echo "    var i;";
			echo "    for (i = 0; i<rows.length; i++) { ";
			echo "      var c = rows[i].ItemClassName;";
			echo "      if (''+a[c] == 'undefined') a[c] = [];";
			echo "      a[c].push(rows[i].idItem);";
			echo "    }";
			echo "    s = '';";
			echo "    for (c in a){";
			echo "      if (s!='') s += ".new Js(GenericID::DELIMETER).";";
			echo "      s += c + ".new Js(GenericID::DELIMETER).";";
			echo "      for (i=0; i<a[c].length; i++) s += a[c][i];";
			echo "    }";
			echo "    var url = ;";
			echo "    new Ajax.Request(url,{method:'get',encoding:Oxygen.Encoding,evalScripts:true";
			echo "      ,onSuccess : function(transport){";
			echo "        x1.update(transport.responseText).show();";
			echo "        x2.update(transport.responseText).show();";
			echo "      }});";
			echo "  }";
		}
		echo "};";
		echo Js::END;
































		echo new HiddenControl($this->name,$this->value);
		echo '<div id="'.$this->name.'_menu_panel_1" class="group reportmenupanel" style="display:none;margin:0 1px 1px 0;"></div>';
		echo '<table id="'.$this->name.'_div" class="'.$this->css_class.'" width="100%" style="'.$this->css_style.'" cellspacing="0" cellpadding="0" border="0">';



		//
		//
		// HEADER
		//
		//
		echo '<tr class="header" '.($this->show_header?'':' style="display:none;"').'>';
		if ($this->show_numbers)
			echo '<th class="number icon contract">'.(is_null($this->icon) ? new Spacer(16) : $this->icon).'</th>';

		if ($this->use_check_boxes && $has_values){
			if ($this->is_multiple) {
				echo '<th class="contract checkbox" style="cursor:pointer;"';
				echo ' onclick="'.$this->name.'.OnCheckThClick(event)"';
				echo ' >';
				ImageCheckboxControl::Make($this->name.'_check_all',false)
					->WithOnChange($this->name.'.OnCheckAllChange();')
					->Render();
				echo '</th>';
			}
			else {
				echo '<th class="contract checkbox">';
				echo new Spacer(16);
				echo '</th>';
			}
		}


		for ($j = 0; $j < $count_cols; $j++){
			if ($j < count($this->cells[0])){
				$css_class = $this->cell_css_class[0][$j];
				$css_style = $this->cell_css_style[0][$j];
				$onclick = $this->cell_onclick[0][$j];
				$fill_row = $this->cell_fill_row[0][$j];
				$v = trim($this->cells[0][$j]);
				$tag = $this->cell_tag[0][$j];
				echo '<';
				echo $tag;
				if (!empty($css_class)) echo ' class="'.$css_class.'"';
				if (!empty($css_style)) echo ' style="'.$css_style.'"';
				if (!empty($onclick)) echo ' onclick="'.$onclick.'"';
				if ($fill_row) echo ' colspan="'.($count_cols-$j).'"';
				echo '>';
				echo $v == '' ? new Spacer() : $v;
				if ($j === $this->sorted_by){
					echo '<span style="font-size:50%;">&nbsp;'.($this->sorted_desc?'&darr;':'&uarr;').'</span>';
				}
				echo '</'.$tag.'>';
				if ($fill_row) break;
			}
			else
				echo '<th class="contract">' . new Spacer(). '</th>';
		}
		echo '</tr>';




		//
		//
		// ROWS
		//
		//
		if ($count_rows == 0){
			echo '<tr>';
			if ($this->show_numbers) echo '<th class="number">'.new Spacer().'</th>';
			$c = new MessageControl( is_null($this->empty_message)?new InfoMessage(Lemma::Pick('MsgNoObjectFound')):$this->empty_message );
			$c->WithShowBorder(false);
			echo '<td colspan="'.$count_cols.'">'.$c.'</td>';
			echo '</tr>';
		}
		$alt = 0;
		for ($i = 0; $i < $count_rows; $i++){
			$css_class = $this->row_css_class[$i];
			$css_style = $this->row_css_style[$i];
			if ($this->row_mode[$i] == self::ROW_NORMAL){
				if ($alt++%2==1){
					if ($css_class !='') $css_class .= ' ';
					$css_class .= 'alt';
				}
			}
			elseif ($this->row_mode[$i] == self::ROW_GROUP){
				$css_class .= 'grp';
			}
			$selected = $this->row_has_value[$i] && $this->IsSelected($this->row_value[$i]);
			if ($selected) $css_class .= ' selected';

			if ($this->IsClickable($i)) {
				$css_style .= 'cursor:pointer;';
			}

			echo '<tr id="'.$this->name.'_tr_'.$i.'" class="'.$css_class.'" style="'.$css_style.'"';
			if ($this->row_mode[$i] == self::ROW_NORMAL){
				echo ' onmouseover="'.$this->name.'.OnMouseOver(event,'.$i.')"';
				echo ' onmouseout="'.$this->name.'.OnMouseOut(event,'.$i.')"';
				if ($this->IsClickable($i)){
					echo ' onclick="'.$this->name.'.OnRowClick(event,'.$i.')"';
				}
			}
			elseif ($this->row_mode[$i] == self::ROW_GROUP){
				if ($this->IsClickable($i)){
					echo ' onclick="'.$this->name.'.OnGroupRowClick(event,'.$i.')"';
				}
			}
			echo '>';

			if ($this->show_numbers){
				if (!is_null($this->rows[$i]))
					echo '<th class="number hright">' . $this->rows[$i] . '</th>';
				elseif ($this->row_mode[$i] == self::ROW_NORMAL)
					echo '<th class="number hright">'.( $displayed_row_number++ ).'.</th>';
				else
					echo '<th class="number hright">' . new Spacer(). '</th>';
			}

			if ($has_values && $this->use_check_boxes){
				if ($this->IsClickable($i)){
					if ($this->row_mode[$i] == self::ROW_NORMAL) {
						echo '<td class="contract checkbox" style="cursor:pointer;" onclick="'.$this->name.'.OnCheckTdClick(event,'.$i.')">';
							ImageCheckboxControl::Make($this->name.'_check_'.$i,$selected)
								->WithOnChange($this->name.'.OnCheckChange('.$i.');')
								->Render();
						echo '</td>';
					}
					elseif ($this->row_mode[$i] == self::ROW_GROUP){
						echo '<td class="contract checkbox" style="cursor:pointer;" onclick="'.$this->name.'.OnGroupCheckTdClick(event,'.$i.')">';
							ImageCheckboxControl::Make($this->name.'_check_'.$i,$selected)
								->WithOnChange($this->name.'.OnGroupCheckChange('.$i.');')
								->Render();
						echo '</td>';
					}
				}
				else
					echo '<td class="contract">'.new Spacer().'</td>';
			}


			for ($j = 0; $j < $count_cols; $j++){
				if ($j < count($this->cells[$i+1])){
					$css_class = $this->cell_css_class[$i+1][$j];
					$css_style = $this->cell_css_style[$i+1][$j];
					$onclick = $this->cell_onclick[$i+1][$j];
					$fill_row = $this->cell_fill_row[$i+1][$j];
					$v = trim($this->cells[$i+1][$j]);
					$tag = $this->cell_tag[$i+1][$j];
					echo '<';
					echo $tag;
					if (!empty($css_class)) echo ' class="'.$css_class.'"';
					if (!empty($css_style)) echo ' style="'.$css_style.'"';
					if (!empty($onclick)) echo ' style="'.$onclick.'"';
					if ($fill_row) echo ' colspan="'.($count_cols-$j).'"';
					echo '>';
					echo $v == '' ? new Spacer() : $v;
					echo '</'.$tag.'>';
					if ($fill_row) break;
				}
				else
					echo '<td>' . new Spacer(). '</td>';
			}
		}

		echo '</table>';


		echo '<div id="'.$this->name.'_menu_panel_2" class="group reportmenupanel" style="display:none;margin:0 1px 0 0;"></div>';








		echo Js::BEGIN;
		if ($this->is_multiple && $has_values) echo $this->name . ".SetCheck('all',".$this->name.".AreAllChecked());";
		echo $this->name.".UpdateValue();";
		echo Js::END;
	}
}



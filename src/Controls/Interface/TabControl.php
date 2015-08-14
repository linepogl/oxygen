<?php

class TabControl extends Control {

	private $pages = array();
	private $content = array();
	private $current_page_name = null;

	private $height = 0;
	public function WithHeight($value) { $this->height = $value; return $this; }

	private $scrollbars = false;
	public function WithScrollbars($value) { $this->scrollbars = $value; return $this; }

	private $selected_page = null;
	public function WithSelectedPage($value){ $this->selected_page = $value; return $this; }

	public function AddPage($name,$title){
		$this->pages[$name] = $title;
		$this->content[$name] = '';
		$this->current_page_name = $name;
		return $this;
	}

	public function Write($that){
		if ($that instanceof Control){ ob_start(); $that->Render(); $that = ob_get_clean(); }
		$this->content[$this->current_page_name] .= $that;
		return $this;
	}

	public function Render(){

		echo '<table class="tab_buttons" width="100%" cellspacing="0" cellpadding="0" border="0"><tr>';
		$i = 0;
		foreach ($this->pages as $name=>$title){
			$is_selected = $this->selected_page==$name || (is_null($this->selected_page) && $i==0);
			echo '<td>'.new Spacer(2).'</td>';
			echo '<td class="tab_button">';
			echo '<a';
			echo ' id="'.$this->name.'_'.$name.'_tab_button"';
			echo ' href="javascript:'.$this->name.'_ChangeTab('.new Js($name).');"';
			if ($is_selected) echo ' class="active"';
			echo '>';
			echo new Html($title);
			echo '</a>';
			echo '</td>';
			$i++;
		}
		echo '<td class="expand">'.new Spacer().'</td>';
		echo '</tr></table>';

		$i = 0;
		foreach ($this->pages as $name=>$title){
			$is_selected = $this->selected_page==$name || (is_null($this->selected_page) && $i==0);
			echo '<div class="tab_page'.($this->scrollbars?'':'overflow').'"';
			echo ' id="'.$this->name.'_'.$name.'_tab_page"';
			echo ' style="height:'.$this->height.';';
			if (!$is_selected) echo 'display:none;';
			echo '"';
			echo '>';
			echo $this->content[$name];
			echo '</div>';
			$i++;
		}

		echo Js::BEGIN;
		echo $this->name . '_ChangeTab = function(name){';
		foreach ($this->pages as $name=>$title){
			echo "if (name==".new Js($name).'){';
			echo "$(".new Js($this->name.'_'.$name.'_tab_page').").show();";
			echo "$(".new Js($this->name.'_'.$name.'_tab_button').").addClassName('active');";
			echo "}";
			echo "else {";
			echo "$(".new Js($this->name.'_'.$name.'_tab_page').").hide();";
			echo "$(".new Js($this->name.'_'.$name.'_tab_button').").removeClassName('active');";
			echo "}";
		}
		echo '};';
		echo Js::END;
	}


}


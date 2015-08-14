<?php

class TabBox extends Box {

	private $pages = array();
	private $content = array();
	private $current_page_name = null;

	public function Add($name,$title){
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
		$ns = $this->name;
		if (!array_key_exists($this->value,$this->pages)) {
			foreach ($this->pages as $page=>$title) {
				$this->value = $page;
				break;
			}
		}
		echo HiddenBox::Make($this->name,$this->value);



		echo '<table class="tab_buttons" width="100%" cellspacing="0" cellpadding="0" border="0"><tr>';
		$i = 0;
		foreach ($this->pages as $name=>$title){
			$is_selected = $this->value===$name;
			echo '<td>'.new Spacer(2).'</td>';
			echo '<td class="tab_button">';
			echo '<a';
			echo ' id="'.$ns.'_'.$name.'_tab_button"';
			echo ' href="javascript:'.$ns.'_ChangeTab('.new Js($name).');"';
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
			$is_selected = $this->value===$name;
			echo '<div class="tab_page"';
			echo ' id="'.$ns.'_'.$name.'_tab_page"';
			if (!$is_selected) echo 'style="display:none;"';
			echo '>';
			echo $this->content[$name];
			echo '</div>';
			$i++;
		}

		echo Js::BEGIN;
		echo $ns . '_ChangeTab = function(name){';
		foreach ($this->pages as $name=>$title){
			echo "if (name==".new Js($name).'){';
			echo "$(".new Js($ns.'_'.$name.'_tab_page').").show();";
			echo "$(".new Js($ns.'_'.$name.'_tab_button').").addClassName('active');";
			echo "}";
			echo "else {";
			echo "$(".new Js($ns.'_'.$name.'_tab_page').").hide();";
			echo "$(".new Js($ns.'_'.$name.'_tab_button').").removeClassName('active');";
			echo "}";
		}
		echo "jQuery('#$ns').val(name);";
		echo '};';
		echo Js::END;
	}


}


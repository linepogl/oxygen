<?php

class MessageControl extends Control {



	private $multi_message;
	public function __construct(){
		$a = func_get_args();
		$this->multi_message = new MultiMessage($a);
	}

	private $show_border = true;
	public function WithShowBorder($value){ $this->show_border = $value; return $this; }

	private $icon_size = 16;
	public function WithIconSize($value){ $this->icon_size = $value; return $this; }

	public function Render(){

		if ($this->show_border) echo '<div class="message-panel message-panel-'.$this->multi_message->GetCode().'">';
		foreach ($this->multi_message as $m){
			echo '<div class="message message-'.$m->GetCode().'">';
			echo $m->AsString();
			echo '</div>';
		}
		if ($this->show_border) echo '</div>';


//		echo '<table class="message layout" width="100%" cellpadding="0" border="0" cellspacing="0"';
//		if ($this->show_border)
//			echo ' style="background:'.$this->multi_message->GetBackgroundColor().';border:1px solid '.$this->multi_message->GetBorderColor().';"';
//		echo '>';
//		foreach ($this->multi_message as $m){
//			echo '<tr>';
//			echo '<td class="vtop notext" style="padding:'.($this->show_border?'5px':'3px').';">'.$m->GetIcon($this->icon_size).'</td>';
//			echo '<td class="vmiddle expand" style="padding:'.($this->show_border?'5px 5px 5px':'3px 3px 3px').' 0;">'.$m->AsString().'</td>';
//			echo '</tr>';
//		}
//		echo '</table>';
	}
}



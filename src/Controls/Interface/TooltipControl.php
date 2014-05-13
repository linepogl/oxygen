<?php

class TooltipControl extends Control {


	private $anchor_name;
	private $message;
	public function __construct($anchor,$message) {
		parent::__construct();
		$this->anchor_name = $anchor instanceof Control ? $anchor->name : $anchor;
		$this->message = $message;
	}

	private $is_rich = false;
	public function WithIsRich($value){ $this->is_rich = $value; return $this; }

	const VALIGN_TOP = 1;
	const VALIGN_BOTTOM = 0;
	private $valign = self::VALIGN_BOTTOM;
	public function WithVAlign($value){ $this->valign = $value; return $this; }

	public function Render() {
		$ns = $this->name;


		echo '<div id="'.$ns.'"  style="display:none;position:absolute;">';
		if ($this->valign === self::VALIGN_BOTTOM) echo '<div class="tooltip-arrow top"></div>';
		echo '<div class="tooltip">';

		if ($this->message instanceof Message)
			echo new Html($this->message->AsString());
		elseif ($this->is_rich)
			echo $this->message;
		else
			echo new Html($this->message);

		echo '</div>';
		if ($this->valign === self::VALIGN_TOP) echo '<div class="tooltip-arrow bottom"></div>';
		echo '</div>';



		echo Js::BEGIN;
		echo "window.$ns = {";
		echo "  Show:function(id){";
		echo "    var anchor = jQuery('#$this->anchor_name');";
		echo "    if (anchor.length == 0) return;";
		echo "    var popup = jQuery('#$ns');";
		echo "    var o = anchor.offset();";
		echo "    var offset_parent = anchor.offsetParent();";
		echo "    var oo = offset_parent.is('body') ? {top:0,left:0} : offset_parent.offset();";
		echo "    var w1 = anchor.outerWidth(false);";
		echo "    var h1 = anchor.outerHeight(false);";
		echo "    popup.css({top:(o.top-oo.top)+'px',left:(o.leth-oo.left)+'px'});";
		echo "    popup.show();";
		echo "    var w2 = popup.outerWidth(false);";
		echo "    var h2 = popup.outerHeight(false);";
		echo "    popup.css({top:(o.top-oo.top".($this->valign===self::VALIGN_TOP?'-h2':'+h1').")+'px',left:(o.left-oo.left+Math.floor((w1-w2)/2))+'px'});";
		echo "  }";
		echo " ,Hide:function(){jQuery('#$ns').hide();}";
		echo "};";
		echo "jQuery('#$this->anchor_name').hover(function(){window.$ns.Show();},function(){window.$ns.Hide();});";
		echo Js::END;

	}
}



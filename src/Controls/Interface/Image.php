<?php

class Image extends Control {

	private $src;
	private $alt="";
	public function __construct($arg1_name_or_src,$arg2_src=null){
		if (is_null(arg2)){
			parent::__construct();
			$this->src = $arg1_name_or_src;
		}
		else{
			parent::__construct($arg1_name_or_src);
			$this->src = $arg2_src;
		}
	}
	public function Render() {
		echo '<img id="'.$this->name.'" src="'.$this->src.'" alt="'.$this->alt.'" />';
	}


}
?>

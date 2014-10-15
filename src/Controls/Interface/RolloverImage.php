<?php

/** @deprecated */
class RolloverImage extends Control {
	private $href;
	private $image;
	private $hover_image;
	private $onmouseover;
	private $onmouseout;

	private $target = null;
	public function WithTarget($value){ $this->target = $value; return $this; }

	public function __construct($href,$image,$hover_image,$onmouseover=null,$onmouseout=null){
		parent::__construct();
		$this->href = $href;
		$this->image = $image;
		$this->hover_image = $hover_image;
		$this->onmouseover = $onmouseover;
		$this->onmouseout = $onmouseout;
	}

	public function Render(){
		echo Js::BEGIN.'im=new Image();im.src=\''.$this->hover_image.'\';'.Js::END;
		echo '<a href="'.new Html($this->href).'"'
			.' onmouseover="$(\''.$this->name.'\').src=\''.$this->hover_image.'\';'.$this->onmouseover.'"'
			.' onmouseout="$(\''.$this->name.'\').src=\''.$this->image.'\';'.$this->onmouseout.'"'
			.(is_null($this->target)?'':' target="'.$this->target.'"')
			.'><img id="'.$this->name.'" src="'.$this->image.'" alt="" /></a>'
		;
	}
}


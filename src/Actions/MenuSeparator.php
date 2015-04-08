<?php

class MenuSeparator extends Action {
	private $title;
	public function __construct($title='-'){ $this->title = $title; }
	public function GetTitle(){ return $this->title; }
	public function IsPermitted(){ return true; }
	public function IsMenuSeparator(){ return true; }
	public function Render() { }
}



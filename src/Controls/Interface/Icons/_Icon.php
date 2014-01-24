<?php

abstract class _Icon extends Control {

	protected $size = null;
	/** @return static */ public function WithSize($size){ $this->size = $size; return $this; }

	protected $title = null;
	/** @return static */ public function WithTitle($title){ $this->title = $title; return $this; }

	protected $css_style = null;
	/** @return static */ public function WithCssStyle($css_style){ $this->css_style = $css_style; return $this; }

	protected $css_class = null;
	/** @return static */ public function WithCssClass($css_class){ $this->css_class = $css_class; return $this; }

}


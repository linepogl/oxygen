<?php

abstract class XWrapControl extends Control {

	/** @var XWrap */ protected $ui;
	public function __construct(){
		$a = func_get_args();
		$z = func_num_args();
		if ($z==1 && is_array( $a[0] )) { $a = $a[0]; $z = count($a); }
		$this->ui = $a[0];
		parent::__construct();
	}


	public function Read(Http $http){ }

	public static function Fill(XWrap $ui){
		return new static($ui);
	}
}

?>

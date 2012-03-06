<?php

class ConvertionException extends Exception {

	public function __construct($m='',$c=0,$p=null){

		parent::__construct('Conversion error.' . $m,$c,$p);
	}

}

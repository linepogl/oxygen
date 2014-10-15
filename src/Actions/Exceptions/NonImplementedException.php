<?php

class NonImplementedException extends Exception {
	public function __construct($message=null){
		parent::__construct(is_null($message) ? oxy::txtMsgNonImplemented() : $message);
	}
}


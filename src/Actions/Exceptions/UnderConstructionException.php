<?php

class UnderConstructionException extends ApplicationException {
	public function __construct($message=null){
		parent::__construct(is_null($message) ? oxy::txtMsgUnderConstruction() : $message);
	}
}


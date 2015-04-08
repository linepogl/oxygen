<?php
class AccessHaltedException extends ApplicationException {
	public function __construct($message = null , $code = 0 , $previous = null) {
		parent::__construct( $message === null ? oxy::txtMsgAccessHalted() : $message , $code , $previous );
	}
}


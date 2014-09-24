<?php
class SecurityException extends ApplicationException {
	public function __construct($message = null , $code = 0 , $previous = null) {
		if ($message instanceof Message)
			$m = $message;
		elseif ($message === null)
			$m = new SecurityMessage(oxy::txtMsgAccessDenied());
		else
			$m = new SecurityMessage($message);
		parent::__construct($m,$code,$previous);
	}
}


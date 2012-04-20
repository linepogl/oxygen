<?php
class SecurityException extends ApplicationException {

	/**
	 * @param string|Message $message
	 * @param int $code
	 * @param null $previous
	 */
	public function __construct($message = '',$code = 0,$previous = null) {
		if (empty($message)) {
			$message = Lemma::Pick('MsgSecurityException');
		}
		parent::__construct($message,$code,$previous);
	}


}


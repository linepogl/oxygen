<?php
class ApplicationException extends Exception {

	private $inner_message;
	/**
	 * @param null|string|Message $message
	 * @param int $code
	 * @param null $previous
	 */
	public function __construct($message = null,$code = 0,$previous = null) {
		if ($message instanceof Message)
			$this->inner_message = $message;
		elseif ($message === null)
			$this->inner_message = new ErrorMessage(Lemma::Pick('MsgAnErrorOccurred'));
		else
			$this->inner_message = new ErrorMessage($message);
		parent::__construct($this->inner_message->AsString(),$code,$previous);
	}

	public function GetInnerMessage() {
		return $this->inner_message;
	}
}


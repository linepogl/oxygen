<?php

class MessageException extends ApplicationException {

	private $multi_message;
	public function __construct(){
		$a = func_get_args();
		$this->multi_message = new MultiMessage($a);
		parent::__construct($this->multi_message->AsString());
	}

	public function AsMessage(){ return $this->multi_message; }

}

?>

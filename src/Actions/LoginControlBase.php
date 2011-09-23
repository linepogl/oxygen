<?php

abstract class LoginControlBase extends Control {

	protected $message = null;
	public function WithMessage($value){ $this->message = strval($value); return $this; }

	protected $redirect_on_success;
	public function WithRedirectOnSuccess($value){ $this->redirect_on_success = $value; return $this; }

	public function WrapAsException(){ return true; }

}
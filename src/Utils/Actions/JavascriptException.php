<?php


class JavascriptException extends Exception {
	public function __construct($message, $url, $line) {
		$browser = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
		parent::__construct( $message . " --- " . $url . " --- " . $line . "\n---\n" . $browser);
	}
}
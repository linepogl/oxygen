<?php


class JavascriptException extends Exception {
	public function __construct($message, $url, $line) {
		parent::__construct( $message . " --- " . $url . " --- " . $line );
	}
}
<?php

final class ErrorMessage extends Message {
	public function GetDefaultIcon(){ return oxy::icoError(); }
	public function GetSeverity(){ return Message::ERROR; }
}



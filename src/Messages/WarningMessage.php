<?php

final class WarningMessage extends Message {
	public function GetDefaultIcon(){ return oxy::icoWarning(); }
	public function GetSeverity() { return Message::WARNING; }
}



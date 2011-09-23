<?php

final class WarningMessage extends Message {
	public function GetDefaultIconName() { return 'oxy/ico/Warning'; }
	public function GetSeverity() { return Message::WARNING; }
	public function GetBackgroundColor() { return '#fcfcf0'; }
	public function GetBorderColor() { return '#e0e088'; }

}

?>

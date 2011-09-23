<?php

final class ErrorMessage extends Message {
	public function GetDefaultIconName(){ return 'oxy/ico/Error'; }
	public function GetSeverity(){ return Message::ERROR; }
	public function GetBackgroundColor() { return '#ffeeee'; }
	public function GetBorderColor() { return '#ffcccc'; }
}

?>

<?php

final class SuccessMessage extends Message {
	public function GetDefaultIconName(){ return 'oxy/ico/Success'; }
	public function GetSeverity(){ return Message::SUCCESS; }
	public function GetBackgroundColor() { return '#eeffee'; }
	public function GetBorderColor() { return '#ccffcc'; }
}

?>

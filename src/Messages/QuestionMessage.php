<?php

final class QuestionMessage extends Message {
	public function GetDefaultIconName(){ return 'oxy/ico/Question'; }
	public function GetSeverity(){ return Message::QUESTION; }
	public function GetBackgroundColor() { return '#eeeeff'; }
	public function GetBorderColor() { return '#ccccff'; }
}

?>

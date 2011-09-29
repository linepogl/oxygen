<?php

final class BugMessage extends Message {
	public function GetDefaultIconName(){ return 'oxy/ico/Bug'; }
	public function GetSeverity(){ return Message::BUG; }
	public function GetBackgroundColor() { return '#f4f4f4'; }
	public function GetBorderColor() { return '#999999'; }
}



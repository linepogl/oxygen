<?php

final class BugMessage extends Message {
	public function GetDefaultIcon(){ return oxy::icoBug(); }
	public function GetSeverity(){ return Message::BUG; }
}



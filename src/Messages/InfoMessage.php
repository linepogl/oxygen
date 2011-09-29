<?php

final class InfoMessage extends Message {
	public function GetDefaultIconName(){ return 'oxy/ico/Info'; }
	public function GetSeverity(){ return Message::INFO; }
	public function GetBackgroundColor() { return '#eeeeee'; }
	public function GetBorderColor() { return '#cccccc'; }
}



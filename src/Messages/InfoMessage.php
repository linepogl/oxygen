<?php

final class InfoMessage extends Message {
	public function GetDefaultIcon(){ return oxy::icoInfo(); }
	public function GetSeverity(){ return Message::INFO; }
}



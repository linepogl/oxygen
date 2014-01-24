<?php

final class SuccessMessage extends Message {
	public function GetDefaultIcon(){ return oxy::icoSuccess(); }
	public function GetSeverity(){ return Message::SUCCESS; }
}



<?php

final class SecurityMessage extends Message {
	public function GetDefaultIcon(){ return oxy::icoSecurity(); }
	public function GetSeverity(){ return Message::SECURITY; }
}



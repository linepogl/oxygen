<?php

final class QuestionMessage extends Message {
	public function GetDefaultIcon(){ return oxy::icoQuestion(); }
	public function GetSeverity(){ return Message::QUESTION; }
}



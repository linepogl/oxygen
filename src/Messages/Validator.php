<?php

class Validator extends MultiMessage {

	public function HasPassed(){ return $this->GetSeverity() <= Message::SUCCESS; }

	public function Check($condition,$message=null){
		if (!$condition)
			$this[] =  is_null($message) ? new WarningMessage(oxy::txtMsgInvalidValue()) : ($message instanceof Message ? $message : new WarningMessage($message)) ;
		return $condition;
	}

	public function CheckMandatory($that,$message=null){
		if (is_null($that))
			return $this->Check(false , is_null($message) ? oxy::txtMsgMandatoryField() : $message);
		if (is_string($that))
			return $this->Check(trim($that) != '', is_null($message) ? oxy::txtMsgMandatoryField() : $message);
		if ($that instanceof Lemma)
			return $this->Check(!$that->IsEmpty(), is_null($message) ? oxy::txtMsgMandatoryField() : $message);
		return true;
	}

	public function CheckEmail($that,$message=null){
		return $this->Check( Oxygen::IsEmail($that), is_null($message) ? oxy::txtMsgInvalidEmail() : $message);
	}
	public function CheckPhone($that,$message=null){
		return $this->Check( Oxygen::IsPhone($that), is_null($message) ? oxy::txtMsgInvalidPhone() : $message);
	}
	public function CheckURL($that,$message=null){
		return $this->Check( Oxygen::IsURL($that), is_null($message) ? oxy::txtMsgInvalidURL() : $message);
	}
}




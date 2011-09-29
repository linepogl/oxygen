<?php

class Validator extends MultiMessage {

	public function HasPassed(){ return $this->GetSeverity() <= Message::SUCCESS; }

	public function Check($condition,$message){
		if (!$condition)
			$this[] =  $message instanceof Message ? $message : new WarningMessage($message) ;
		return $condition;
	}

	public function CheckMandatory($that,$message=null){
		if (is_null($that))
			return $this->Check(false , is_null($message) ? Lemma::Retrieve('MsgMandatoryField') : $message);
		if (is_string($that))
			return $this->Check(trim($that) != '', is_null($message) ? Lemma::Retrieve('MsgMandatoryField') : $message);
		if ($that instanceof Lemma)
			return $this->Check(!$that->IsEmpty(), is_null($message) ? Lemma::Retrieve('MsgMandatoryField') : $message);
		return true;
	}

	public function CheckEmail($that,$message=null){
		return $this->Check( Oxygen::IsEmail($that), is_null($message) ? Lemma::Retrieve('MsgInvalidEmail') : $message);
	}
	public function CheckURL($that,$message=null){
		return $this->Check( Oxygen::IsURL($that), is_null($message) ? Lemma::Retrieve('MsgInvalidURL') : $message);
	}
}




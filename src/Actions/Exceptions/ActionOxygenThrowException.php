<?php

class ActionOxygenThrowException extends Action {
	public function ContentCompromised(){ return true; }
	public function IsPermitted(){ return true; }
	public function GetTitle(){ return Lemma::Pick('Error'); }

	private $ex;
	public function __construct(Exception $ex){ $this->ex = $ex; }
	public static function Make(){ throw new Exception('Cannot call ActionOxygenThrowException directly from HTTP.'); }

	public function Render(){
		throw $this->ex;
	}

}
<?php

class ActionException extends Action {
	public function ContentCompromised(){ return true; }
	public function IsPermitted(){ return true; }
	public function GetTitle(){ return Lemma::Pick('Error'); }

	private $ex;
	public function __construct(Exception $ex){ $this->ex = $ex; }
	public function GetUrlArgs(){ return array('class'=>get_class($this->ex),'message'=>$this->ex->getMessage()) + parent::GetUrlArgs(); }
	public static function Make(){
		$classname = Http::$GET['classname']->AsString();
		$reflection_class = new ReflectionClass($classname);
		$ex = $reflection_class->newInstance( array( Http::$GET['message']->AsString() ) );
		return new static( $ex );
	}

	public function Render(){
		throw $this->ex;
	}

}
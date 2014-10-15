<?php


class XmlImportState {

	private $phase = 0;
	public function WithPhase($value){ $this->phase = $value; return $this; }
	public function GetPhase(){ return $this->phase; }

	private $stack = array();
	public function &GetStack(){ return $this->stack; }
	public function WithStack($value){ $this->stack = $value; return $this; }
	public function Push($object){ array_push($this->stack,$object); return $object; }
	public function Pop(){ return array_pop($this->stack); }


}



<?php


class XmlExportState {

	private $stack = array();
	public function &GetStack(){ return $this->stack; }
	public function Push($object){ array_push($this->stack,$object); return $object; }
	public function Pop(){ return array_pop($this->stack); }


}

?>

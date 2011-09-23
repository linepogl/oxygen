<?php

class XWrapSlave {

	/** @var XWrap */
	private $wrap;

	/** @var XSlave */
	private $slave;

	public function __construct(XWrap $wrap,XSlave $slave){
		$this->wrap = $wrap;
		$this->slave = $slave;
	}

	/** @return XWrap */
	public function GetWrap(){ return $this->wrap; }

	/** @return XItem */
	public function GetItem(){ return $this->wrap->GetItem(); }

	/** @return XSlave */
	public function GetSlave(){ return $this->slave; }
	
	public function GetValue(){
		$o = $this->wrap->GetItem();
		$f = $this->slave->GetName();
		return $o->$f;
	}
	public function SetValue($value){
		$o = $this->wrap->GetItem();
		$f = $this->slave->GetName();
		$o->$f = $value;	
	}
	public function GetName(){
		return 'x'.ID::Hash($this->wrap->GetName().$this->slave->GetName())->AsHex();
	}
	public function GetLabel(){
		return $this->slave->GetLabel();
	}

}
	
	
?>
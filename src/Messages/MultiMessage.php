<?php

class MultiMessage extends Message implements IteratorAggregate,ArrayAccess,Countable{
	private $messages = array();
	private $dominant = null;
	public function __construct(){
		parent::__construct('');
		$this->dominant = new InfoMessage('');
		$a = func_get_args();
		array_walk_recursive( $a , function($value,$key,$mm){
			$mm->Add(Message::Cast($value));
		},$this);
	}

	public function Add(Message $m=null){
		if (is_null($m))
			return;
		elseif ($m instanceof MultiMessage){
			foreach ($m as $mm)
				$this->Add($mm);
		}
		else {
			if ($m->GetSeverity() >= $this->dominant->GetSeverity())
				$this->dominant = $m;
			if (!empty($this->value)) $this->value .= "\\n";
			$this->value .= $m->AsString();
			$this->messages[] = $m;
		}
	}
	public function GetCode(){ return $this->dominant->GetCode(); }
	public function GetDefaultIconName(){ return $this->dominant->GetIconName(); }
	public function GetSeverity(){ return $this->dominant->GetSeverity(); }
	public function GetBackgroundColor(){ return $this->dominant->GetBackgroundColor(); }
	public function GetBorderColor(){ return $this->dominant->GetBorderColor(); }


	public function Count(){ return count($this->messages); }
	public function GetIterator(){ return new ArrayIterator($this->messages); }
	public function OffsetExists($offset) { return isset($this->messages[$offset]); }
	public function OffsetGet($offset) { return $this->messages[$offset]; }
	public function OffsetUnset($offset) { unset($this->messages[$offset]); }
	public function OffsetSet($offset, $value) {
		if (is_null($offset))
			$this->Add(Message::Cast($value));
		else
			throw new InvalidArgumentException('Cannot modify existing messages of a MultiMessage.');
	}


}



<?php

class MultiMessage extends Message implements IteratorAggregate,ArrayAccess,Countable{
	private $messages = array();
	private $dominant = null;
	public function __construct(){
		parent::__construct('',null);
		$this->dominant = new InfoMessage('');
		$a = func_get_args();
		/** @noinspection PhpUnusedParameterInspection */
		array_walk_recursive( $a , function($value,$key,MultiMessage $mm){
			$mm->Add(Message::Cast($value));
		},$this);
	}

	public function Add(Message $m=null){
		if ($m===null)
			return;
		elseif ($m instanceof MultiMessage){
			foreach ($m as $mm)
				$this->Add($mm);
		}
		else {
			if ($m->GetSeverity() >= $this->dominant->GetSeverity())
				$this->dominant = $m;
			if (!empty($this->value)) $this->value .= "\n";
			$this->value .= $m->AsString();
			$this->messages[] = $m;
			if (is_callable($this->on_add)) {  $f = $this->on_add; $f($m); }
		}
	}
	public function AddNewOnly(Message $m=null) {
		if ($m===null)
			return;
		elseif ($m instanceof MultiMessage) {
			foreach ($m as $mm)
				$this->AddNewOnly($mm);
		}
		else {
			$s = $m->AsString();
			$found = false;
			/** @var $mm Message */
			foreach ($this->messages as $mm) {
				if ($mm->AsString() === $s) {
					$found = true;
					break;
				}
			}
			if (!$found) $this->Add($m);
		}
	}
	public function GetCode(){ return $this->dominant->GetCode(); }
	public function GetIcon(){ return $this->dominant->GetIcon(); }
	public function GetSeverity(){ return $this->dominant->GetSeverity(); }


	public function IsEmpty(){ return 0 == count($this->messages); }
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


	/** @var callable */ private $on_add = null;
	public function WithOnAdd( $callback = null ){ $this->on_add = $callback; return $this; }

}



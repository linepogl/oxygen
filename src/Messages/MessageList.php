<?php
//
//class MessageList implements IteratorAggregate,ArrayAccess,Countable{
//
//	private $messages = array();
//	public function __construct(){ $a = func_get_args(); $this->Add($a); }
//
//	public function Add($m) {
//		if ($m instanceof Message)
//			$this->messages[] = $m;
//		elseif ($m instanceof MessageList)
//			foreach ($m as $mm) $this->Add($mm);
//		elseif ($m instanceof ApplicationException)
//			$this->Add($m->GetMessageList());
//		elseif ($m instanceof Exception)
//			$this->Add(new ErrorMessage($m->getMessage()));
//		elseif ($m instanceof Validator)
//			foreach ($m->GetMessageList() as $mm) $this->Add($mm);
//		elseif (is_array($m))
//			foreach ($m as $mm) $this->Add($mm);
//		else
//			$this->Add(new ErrorMessage(strval($m)));
//	}
//	public function GetMessages() { return $this->messages; }
//
//	public function AsException(){
//		return new ApplicationException($this);
//	}
//
//
//	public function GetDominantMessage(){
//		$r = null;
//		$max = -1;
//		foreach ($this->messages as $m){
//			if ($m->GetSeverity() > $max){
//				$max = $m->GetSeverity();
//				$r = $m;
//			}
//		}
//		return $r;
//	}
//
//	public function __toString(){
//		$r = '';
//		foreach ($this->messages as $message) {
//			if ($r != '') $r .= "\\n";
//			$r .= $message->__toString();
//		}
//		return $r;
//	}
//
//
//	public function count(){ return count($this->messages); }
//	public function getIterator(){
//		return new ArrayIterator($this->messages);
//	}
//
//
//	public function offsetExists($offset) {
//		return isset($this->messages[$offset]);
//	}
//	public function offsetGet($offset) {
//		return $this->messages[$offset];
//	}
//	public function offsetSet($offset, $value) {
//		if (is_null($offset))
//			$this->Add($value);
//		else
//			$this->messages[$offset] = $value;
//	}
//	public function offsetUnset($offset) {
//		unset($this->messages[$offset]);
//	}
//
//
//}


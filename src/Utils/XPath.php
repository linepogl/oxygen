<?php

class XPath implements ArrayAccess,IteratorAggregate,Countable {

	/** @var DOMXPath */
	private $engine;

	/** @var DOMNode|array|string|float|null */
	private $data;

	private function __construct(DOMXPath $engine,$data){
		$this->engine = $engine;
		$this->data = $data;
	}
	/** @return XPath */
	public static function FromString( $xml_string ) {
		$dom = new DOMDocument();
		$dom->loadXML($xml_string);
		return new XPath(new DOMXPath($dom),$dom->documentElement);
	}
	/** @return XPath */
	public static function FromFile( $xml_filename ) {
		$dom = new DOMDocument();
		$dom->load($xml_filename);
		return new XPath(new DOMXPath($dom),$dom->documentElement);
	}
	/** @return XPath */
	public static function FromNode( DOMNode $xml_node ) {
		$dom = $xml_node->ownerDocument;
		return new XPath(new DOMXPath($dom),$dom->documentElement);
	}


	//
	//
	// Interfaces
	//
	//
	/** @return XPath */
	public function OffsetGet($offset){
		if (is_int($offset)) {
			if (is_array($this->data) && isset($this->data[$offset]))
				return $this->Unit($this->data[$offset]);
			else
				return $this->Unit(null);
		}
		return $this->Select($offset);
	}
	public function OffsetExists($offset){
		if (is_int($offset))
			return is_array($this->data) && isset($this->data[$offset]);
		return !$this->Select($offset)->IsEmpty();
	}
	public function OffsetSet($offset,$value){ throw new NonImplementedException(); }
	public function OffsetUnset($offset){ throw new NonImplementedException(); }

	/** @return Iterator */
	public function GetIterator() {
		$a = array();
		if (is_array($this->data)) {
			foreach ($this->data as $data)
				$a[] = $this->Unit($data);
		}
		elseif ($this->data !== null) {
			$a[] = $this;
		}
		return new ArrayIterator($a);
	}
	public function Count() {
		if (is_array($this->data)) return count($this->data);
		if ($this->data === null)  return 0;
		return 1;
	}


	//
	//
	// Monad
	//
	//
	/** @return XPath */
	private function Unit( $data ){
		return new XPath($this->engine,$data);
	}
	/** @return XPath */
	public function Select($xpath='.') {
		if ($xpath === '.') return $this;
		$r = null;
		if (is_array($this->data)) {
			$r = [];
			foreach ($this->data as $node) {
				$rr = $this->engine->evaluate($xpath,$node);
				if ($rr instanceof DOMNodeList) { // flatMap, removing duplicates
					foreach ($rr as $x) {
						$found = false; foreach ($r as $xx) if ($x === $xx) { $found = true; break; }
						if (!$found) $r[] = $x;
					}
				}
				else $r[] = $rr;
			}
		}
		elseif ($this->data instanceof DOMNode) {
			$rr = $this->engine->evaluate($xpath,$this->data);
			if ($rr instanceof DOMNodeList) {
				$r = [];
				foreach ($rr as $x) $r[] = $x;
			}
			else
				$r = $rr;
		}
		return $this->Unit($r);
	}


	//
	//
	// Unboxing the first
	//
	//
	/** @return string|float|null */
	public function GetValue() {
		if (is_array($this->data)) {
			if (empty($this->data))
				return null;
			elseif ($this->data[0] instanceof DOMNode)
				return $this->engine->evaluate('string(.)',$this->data[0]);
			else
				return $this->data[0];
		}
		if ($this->data instanceof DOMNode) {
			return $this->engine->evaluate('string(.)',$this->data);
		}
		return $this->data;
	}
	/** @return DOMNode|null */
	public function GetNode() {
		if ($this->data instanceof DOMNode)
			return $this->data;
		if (is_array($this->data) && count($this->data)>0 && $this->data[0] instanceof DOMNode)
			return $this->data[0];
		return null;
	}


	//
	//
	// Other helping methods
	//
	//
	/** @return string|null */  public function GetName() { $node = $this->GetNode(); return $node instanceof DOMElement || $node instanceof DOMAttr ? $node->nodeName : null; }
	/** @return string|null */  public function GetAttr($attr) { $node = $this->GetNode(); return $node instanceof DOMElement && $node->hasAttribute($attr) ? $node->getAttribute($attr) : null; }
	/** @return string  */      public function __toString(){ return strval($this->GetValue()); }
	/** @return string  */      public function AsString(){ return strval($this->GetValue()); }
	/** @return int */          public function AsInteger(){ return intval($this->GetValue()); }
	/** @return bool */         public function IsEmpty(){ return $this->Count()===0; }
	/** @return bool */         public function IsElement(){ return $this->GetNode() instanceof DOMElement; }
	/** @return bool */         public function IsAttribute(){ return $this->GetNode() instanceof DOMAttr; }
	/** @return bool */         public function IsText(){ return $this->GetNode() instanceof DOMText; }
	/** @return bool */         public function IsCData(){ return $this->GetNode() instanceof DOMCdataSection; }
}

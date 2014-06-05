<?php

class XPath implements IteratorAggregate,ArrayAccess,Countable {
	private $dom;
	private $eng;
	private $data;  // DOMNode | DOMNodeList | scalar | null
	private function __construct(){}
	private function unit( $data ){ $r = new XPath(); $r->dom = $this->dom; $r->eng = $this->eng; $r->data = $data; return $r; }
	public static function FromString( $xml_string ) { $dom = new DOMDocument(); $dom->loadXML($xml_string); $r = new XPath(); $r->data = $dom->documentElement; $r->dom = $dom; $r->eng = new XPath($dom); return $r; }
	public static function FromFile( $xml_filename ) { $dom = new DOMDocument(); $dom->load($xml_filename);  $r = new XPath(); $r->data = $dom->documentElement; $r->dom = $dom; $r->eng = new XPath($dom); return $r; }
	/** @return XPath */ public function OffsetGet($offset){ return $this->XPath($offset); }
	/** @return XPath */ public function OffsetSet($offset,$value){ throw new NonImplementedException(); }
	/** @return XPath */ public function OffsetExists($offset){ return !$this->XPath($offset)->IsEmpty(); }
	/** @return XPath */ public function OffsetUnset($offset){ throw new NonImplementedException(); }
	public function GetIterator() {
		$a = array();
		if ($this->data instanceof Traversable) {
			foreach ($this->data as $data)
				$a[] = $this->unit($data);
		}
		elseif ($this->data !== null) {
			$a[] = $this;
		}
		return new ArrayIterator($a);
	}
	public function Count() {
		if ($this->data instanceof DOMNodeList) return $this->data->length;
		if ($this->data instanceof Countable)   return $this->data->Count();
		if ($this->data === null)               return 0;
		return 1;
	}
	private function evaluate($node,$xpath){ if($node instanceof DOMDocument){$x=new DOMXPath($node);return$x->evaluate($xpath);}else{$x=new DOMXPath($node->ownerDocument);return $x->evaluate($xpath,$node);} }
	/** @return XPath */
	public function XPath($xpath='.') {
		if ($xpath === '.') return $this;
		$node = $this->GetNode();
		return $this->unit( $node === null ? null : $this->evaluate($node,$xpath) );
	}
	/** @return string|float|null */
	public function GetValue() {
		if ($this->data instanceof DOMNodeList) {
			if ($this->data->length === 0)
				return null;
			else
				return $this->evaluate($this->data->item(0),'string(.)');
		}
		if ($this->data instanceof DOMNode) {
			return $this->evaluate($this->data,'string(.)');
		}
		return $this->data;
	}
	/** @return DOMNode|null */ public function GetNode() { if ($this->data instanceof DOMNode) return $this->data; if ($this->data instanceof DOMNodeList && $this->data->length !== 0) return $this->data->item(0); return null; }
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

<?php

class LiteralControl extends ValueControl {

	private $format;
	public function WithFormat($value){ $this->format=$value; return $this; }
	
	private $escape = true;
	public function WithEscape($value){ $this->escape=$value; return $this; }
	
	public function Render(){
		$s = $this->value;
		if ($this->format != null) $s = $s->format($this->format);
		if ($this->escape) $s = new Html($s);
		echo $s;
	}
}

?>

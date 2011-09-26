<?php

final class Js extends ExportConverter {


	public function Export(){

		if ( $this->value instanceof Action) {
			$r = "'".str_replace("'","\\'",$this->value->GetHref())."'";
			return $r;
		}

		if ( $this->value instanceof XItem ) {
			$r = "'" . $this->value->id->AsHex() . "'";
			return $r;
		}

		if ( $this->value instanceof ID ) {
			if ( $this->value instanceof GenericID ) {
				$r = "'" . $this->value->Encode() . "'";
				return $r;
			}
			$r = "'" . $this->value->AsHex() . "'";
			return $r;
		}

		if ( is_string($this->value) ) {
			$r = "'".str_replace(array("\\","'","\n"),array("\\\\","\\'","\\n"),$this->value)."'";
			return $r;
		}


		if ( is_int($this->value) ) {
			$r = sprintf('%d',$this->value);
			return $r;
		}

		if ( is_null($this->value) ) {
			$r = 'null';
			return $r;
		}

		if ($this->value instanceof XWrapField) {
			$r = "'".$this->value->GetName()."'";
			return $r;
		}

		if ( is_bool($this->value) ) {
			$r = $this->value ? 'true' : 'false';
			return $r;
		}


		if ( is_float($this->value) ) {
			$r = sprintf('%F',$this->value);
			return $r;
		}


    if ($this->value instanceof DateTime)
    	$this->value = new XDateTime($this->value);
		if ( $this->value instanceof XDateTime ) {
			$r = 'new Date('.$this->value->GetYear().','.($this->value->GetMonth()-1).','.$this->value->GetDay().','.$this->value->GetHours().','.$this->value->GetMinutes().','.$this->value->GetSeconds().')';
			return $r;
		}


//    if ($this->value instanceof DateInterval)
//    	$this->value = new XTimeSpan($this->value);
		if ( $this->value instanceof XTimeSpan ) {
			$r = strval($this->value->GetTotalMilliseconds());
			return $r;
		}



		$r = "'".str_replace(array("\\","'","\n"),array("\\\\","\\'","\\n"),$this->value)."'";
		return $r;
	}


	const BEGIN = "<script type=\"text/javascript\">\n//<![CDATA[\n";
	const END = "\n//]]>\n</script>";

}



?>

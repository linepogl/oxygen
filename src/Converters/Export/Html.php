<?php


final class Html extends ExportConverter {

	private static function escape($string){
  	return str_replace(
  		array('&','>','<','"'),
  		array('&amp;','&gt;','&lt;','&quot;'),
  		$string);
	}

	public function Export(){

		if (is_null($this->value)) {
		  $r = '';
			return $r;
		}

	  if ( is_string($this->value) ) {
		  $r = self::escape( $this->value );
		  return $r;
	  }

    if ( $this->value instanceof Action) {
	    $r = self::escape( $this->value->GetHref() );
	    return $r;
    }

	  if ( is_bool($this->value) ) {
	    $r = $this->value ? 'true' : 'false';
		  return $r;
	  }

	  if ( is_int($this->value) ) {
	    $r = sprintf('%d',$this->value);
		  return $r;
	  }


	  if ( is_float($this->value) ) {
	  	$r = Language::FormatDecimal($this->value);
		  return $r;
	  }


	  if ( $this->value instanceof GenericID ) {
	    $r = $this->value->Encode();
		  return $r;
	  }

	  if ( $this->value instanceof ID ) {
	    $r = $this->value->AsHex();
		  return $r;
	  }

	  if ($this->value instanceof Lemma) {
		  $r = self::escape( strval($this->value) );
		  return $r;
	  }

	  if ($this->value instanceof DateTime)
		  $this->value = new XDateTime($this->value);
	  if ( $this->value instanceof XDateTime ) {
		  $r = $this->value->Format('YmdHis');
		  return $r;
	  }

//	  if ($this->value instanceof DateInterval)
//		  $this->value = new XTimeSpan($this->value);
	  if ( $this->value instanceof XTimeSpan ) {
	    $r = strval($this->value->GetTotalMilliseconds());
		  return $r;
	  }


	  if ( $this->value instanceof XItem ) {
	    $r = $this->value->id->AsHex();
		  return $r;
	  }

	  if ( is_array($this->value) || $this->value instanceof Traversable ) {
		  $a = array();
		  foreach ( from($this->value) as $x )
			  $a[] = strval(new Html($x));
		  $r = implode($a,',');
		  return $r;
		}

		$r = self::escape( strval($this->value) );
		return $r;
	}


}



?>

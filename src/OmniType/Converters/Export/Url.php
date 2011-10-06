<?php


final class Url extends ExportConverter {

	public function Export(){
		return OmniType::Of($this->value)->ExportUrlString($this->value,Database::GetType());
	}

//  public function Export(){
//
//	  // this is quite often, so I put it first
//    if ( $this->value instanceof XItem ) {
//      $r = $this->value->id->AsHex();
//	    return $r;
//    }
//
//	  // second most often
//    if ( $this->value instanceof ID ) {
//	    if ( $this->value instanceof GenericID ) {
//	      $r = $this->value->Encode();
//		    return $r;
//	    }
//      $r = $this->value->AsHex();
//	    return $r;
//    }
//
//
//	  // third (and always before is_int...)
//    if ( is_string($this->value) ) {
//      $r = rawurlencode( $this->value );   // <-- I wrote this inline because, when I place it in a separate
//                                           //     escape function (as I should), the performance deteriorates
//	                                         //     severely! There is another similar call at the end...
//	    return $r;
//    }
//
//
//	  // fourth
//    if ( is_int($this->value) ) {
//      $r = sprintf('%d',$this->value);
//	    return $r;
//    }
//
//
//	  // fifth
//    if ( is_bool($this->value) ) {
//       $r = $this->value ? 'true' : 'false';
//	     return $r;
//     }
//
//
//	  // and the rest
//    if (is_null($this->value)) {
//	    $r = '';
//	    return $r;
//    }
//
//
//
//    if ( is_float($this->value) ) {
//    	$r = Language::FormatDecimal($this->value);
//	    return $r;
//    }
//
//
//    if ($this->value instanceof Lemma) {
//    	$r = $this->value->Encode();
//	    return $r;
//    }
//
//    if ($this->value instanceof DateTime)
//    	$this->value = new XDateTime($this->value);
//    if ( $this->value instanceof XDateTime ) {
//    	$r = $this->value->Format('YmdHis');
//	    return $r;
//    }
//
////    if ($this->value instanceof DateInterval)
////    	$this->value = new XTimeSpan($this->value);
//    if ( $this->value instanceof XTimeSpan ) {
//      $r = strval($this->value->GetTotalMilliseconds());
//	    return $r;
//    }
//
//    if ( is_array($this->value) || $this->value instanceof Traversable ){
//    	$a = array();
//    	foreach ( from($this->value) as $x )
//    		$a[] = strval(new self($x));
//    	$r = implode($a,',');
//	    return $r;
//		}
//
//
//	  $r = strval($this->value);
//	  $r = rawurlencode($r);
//	  return $r;
//  }




}





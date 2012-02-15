<?php


final class HumanReadableHtml extends ExportConverter {

	public function Export(){
		return $this->omnitype->ExportHumanReadableHtmlString($this->value);
	}

//
//	private static function escape($string){
//  	return str_replace(
//  		array('&','>','<','"'),
//  		array('&amp;','&gt;','&lt;','&quot;'),
//  		$string);
//	}
//
//	public function Export(){
//	  if (is_null($this->value)) {
//		  $r = '';
//		  return $r;
//	  }
//
//	  if ( is_string($this->value) ) {
//	    $r = self::escape( $this->value );
//		  return $r;
//	  }
//
//	  if ( is_bool($this->value) ) {
//		  $r = self::escape( strval ($this->value ? Lemma::Pick('Yes') : Lemma::Pick('No')));
//		  return $r;
//	  }
//
//	  if ( is_int($this->value) ) {
//		  $r = sprintf('%d',$this->value);
//		  return $r;
//	  }
//
//	  if ( is_float($this->value) ) {
//	  	$r = Language::FormatNumber($this->value);
//		  return $r;
//	  }
//
//	  if ($this->value instanceof Lemma) {
//		  $r = self::escape( strval($this->value) );
//		  return $r;
//	  }
//
//	  if ($this->value instanceof DateTime)
//		  $this->value = new XDateTime($this->value);
//	  if ( $this->value instanceof XDateTime ) {
//	    if ($this->value instanceof XDate) {
//				$r = Language::FormatDate($this->value);
//				return $r;
//			}
//			if ($this->value instanceof XTime) {
//				$r = Language::FormatTime($this->value);
//				return $r;
//			}
//		  $r = Language::FormatDateTime($this->value);
//		  return $r;
//	  }
//
////	  if ($this->value instanceof DateInterval)
////		  $this->value = new XTimeSpan($this->value);
//    if ( $this->value instanceof XTimeSpan ){
//    	$d = $this->value->GetDays();
//    	$h = $this->value->GetHours();
//    	$m = $this->value->GetMinutes();
//    	$s = $this->value->GetSeconds();
//    	$r = ($d==0?'':$d.Lemma::Pick('d.'))
//    			 . ($h==0?'':$h.Lemma::Pick('h.'))
//    			 . ($m+$s==0?'': ($m==0?'':$m.'\'').($s==0?'':$s.'\'\'') )
//    			 ;
//	    return $r;
//		}
//	  $r = self::escape( strval($this->value) );
//		return $r;
//	}
//


}





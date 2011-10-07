<?php


class Xml extends ExportConverter {

	public function Export(){
		return $this->omnitype->ExportXmlString($this->value,Database::GetType());
	}

//	private static function escape($string){
//		return Oxygen::ToUnicode(str_replace(
//  		array('&','>','<','"',"\r\n"),
//  		array('&amp;','&gt;','&lt;','&quot;',"\n"),
//  		$string)
//  		);
//	}

	const Attribute = 1;
	const Element = 2;

	const NS = 'http://www.w3.org/2000/xmlns/';
	const XS = 'http://www.w3.org/2001/XMLSchema';

//  public function Export(){
//    if (is_null($this->value)) {
//      $r = '';
//      return $r;
//    }
//
//    if ( is_string($this->value) ) {
//      $r = self::escape($this->value);
//	    return $r;
//    }
//
//    if ( is_bool($this->value) ) {
//      $r = $this->value ? 'true' : 'false';
//	    return $r;
//    }
//
//    if ( is_int($this->value) ) {
//      $r = sprintf('%d',$this->value);
//	    return $r;
//    }
//
//	  if ( is_float($this->value) ) {
//      $r = sprintf('%F',$this->value);
//		  return $r;
//	  }
//
//    if ( $this->value instanceof ID ) {
//	    $r = self::escape($this->value->AsHex());
//	    return $r;
//    }
//
//    if ($this->value instanceof Lemma) {
//    	$r = utf8_encode($this->value->Encode());
//	    return $r;
//    }
//
//    if ( $this->value instanceof DateTime )
//    	$this->value = new XDateTime($this->value);
//    if ( $this->value instanceof XDate) {
//      $r = $this->value->Format('Y-m-d');
//	    return $r;
//    }
//    if ( $this->value instanceof XTime ) {
//	    $r = $this->value->Format('H:i:s');
//	    return $r;
//    }
//
//    if ( $this->value instanceof XDateTime ) {
//	    $r = $this->value->Format('Y-m-d\TH:i:s');
//	    return $r;
//    }
//
////    if ( $this->value instanceof DateInterval )
////    	$this->value = new XTimeSpan($this->value);
//    if ( $this->value instanceof XTimeSpan ) {
//	    $r = $this->value->AsString();
//	    return $r;
//    }
//
//
//	  $r = strval($this->value);
//	  $r = self::escape($r);
//	  return $r;
//  }



}





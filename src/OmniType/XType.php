<?php

class XType {


  public static function AreEqual($x1,$x2){
  	return 0 == self::Compare($x1,$x2);
	}
  public static function Compare($x1,$x2){
  	if (is_null($x1)) {
  		return is_null($x2) ? 0 : -1;
		}
	  elseif (is_string($x1)) {
		  if (is_null($x2)) return 1;
		  if (is_string($x2)) return strcmp($x1,$x2);
		  if ($x2 instanceof Lemma) return strcmp($x1,strval($x2));
	  }
		elseif (is_int($x1)||is_float($x1)) {
			if (is_null($x2)) return 1;
			if (is_int($x2)||is_float($x2)) return $x1 - $x2;
			if ($x2 instanceof ID) return $x1 - $x2->AsInt();
			if ($x2 instanceof XItem) return $x1 - $x2->id->AsInt();
		}
		elseif (is_bool($x1)) {
			if (is_null($x2)) return 1;
			if (is_bool($x2)) return $x1 ? ($x2 ? 0 : 1) : ($x2 ? -1: 0);
		}
		elseif ($x1 instanceof GenericID){
			if (is_null($x2)) return 1;
			if (is_int($x2)||is_float($x2)) return $x1->AsInt() - $x2;
			if ($x2 instanceof GenericID) {
				//$r = $x1->GetClassOrder() - $x2->GetClassOrder(); if ($r != 0) return $r;
				$r = strcmp($x1->GetClassName(),$x2->GetClassName()); if ($r != 0) return $r;
				return $x1->AsInt() - $x2->AsInt();
			}
			if ($x2 instanceof ID) return $x1->AsInt() - $x2->AsInt();
			if ($x2 instanceof XItem) {
				//$r = $x1->GetClassOrder() - $x2->GetClassOrder(); if ($r != 0) return $r;
				$r = strcmp($x1->GetClassName(),$x2->GetClassName()); if ($r != 0) return $r;
				return $x1->AsInt() - $x2->id->AsInt();
			}
		}
		elseif ($x1 instanceof ID){
			if (is_null($x2)) return 1;
			if (is_int($x2)||is_float($x2)) return $x1->AsInt() - $x2;
			if ($x2 instanceof ID) return $x1->AsInt() - $x2->AsInt();
			if ($x2 instanceof XItem) return $x1->AsInt() - $x2->id->AsInt();
		}
		elseif ($x1 instanceof XItem){
			if (is_null($x2)) return 1;
			if (is_int($x2)||is_float($x2)) return $x1->id->AsInt() - $x2;
			if ($x2 instanceof GenericID) {
				//$r = $x1->GetClassOrder() - $x2->GetClassOrder(); if ($r != 0) return $r;
				$r = strcmp($x1->GetClassName(),$x2->GetClassName()); if ($r != 0) return $r;
				return $x1->id->AsInt() - $x2->AsInt();
			}
			if ($x2 instanceof ID) return $x1->id->AsInt() - $x2->AsInt();
			if ($x2 instanceof XItem) {
				//$r = $x1->GetClassOrder() - $x2->GetClassOrder(); if ($r != 0) return $r;
				$r = strcmp($x1->GetClassName(),$x2->GetClassName()); if ($r != 0) return $r;
				return $x1->id->AsInt() - $x2->id->AsInt();
			}

		}
		elseif ($x1 instanceof XDateTime){
			if (is_null($x2)) return 1;
			if ($x2 instanceof XDateTime) return $x1->AsInt() - $x2->AsInt();
			if ($x2 instanceof DateTime) return $x1->AsInt() - $x2->getTimestamp();
		}
		elseif ($x1 instanceof DateTime){
			if (is_null($x2)) return 1;
			if ($x2 instanceof XDateTime) return $x1->getTimestamp() - $x2->AsInt();
			if ($x2 instanceof DateTime) return $x1->getTimestamp() - $x2->getTimestamp();
		}
		elseif ($x1 instanceof XTimeSpan){
			if (is_null($x2)) return 1;
			if ($x2 instanceof XTimeSpan) return $x1->AsInt() - $x2->AsInt();
		}
		elseif ($x1 instanceof Lemma){
			if (is_null($x2)) return 1;
			if (is_string($x2)) return strcmp(strval($x1),$x2);
			if ($x2 instanceof Lemma) return strcmp(strval($x1),strval($x2));
		}
		throw new InvalidArgumentException('Unsupported comparison: ' . (is_object($x1)?get_class($x1):gettype($x1)) . ' - ' . (is_object($x2)?get_class($x2):gettype($x2))  );



	}


}

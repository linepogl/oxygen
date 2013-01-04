<?php

abstract class XValue {

	/**
	 * @return XType;
	 */
	public abstract function MetaType();

	/** @return int */
	public function CompareTo($x){
		if (is_null($x)) return 1;
		throw new InvalidArgumentException('Unsupported comparison: ' . get_class($this) . ' - ' . (is_object($x)?get_class($x):gettype($x))  );
	}
	/** @return bool */
	public function IsEqualTo($x){
		if (is_null($x)) return false;
		throw new InvalidArgumentException('Unsupported comparison: ' . get_class($this) . ' - ' . (is_object($x)?get_class($x):gettype($x))  );
	}






	public static function AreEqual($x1,$x2){
		if ( $x1 instanceof XValue )
			return $x1->IsEqualTo( $x2 );

		if ( $x2 instanceof XValue )
			return $x2->IsEqualTo( $x1 );

		if ( gettype( $x1 ) == gettype( $x2 ) )
			return $x1 === $x1;

		if ( ( is_int($x1)&&is_float($x2) ) || ( is_int($x2)&&is_float($x1) ) )
			return $x1 == $x2;

		if ( $x1 instanceof DateTime && $x2 instanceof DateTime )
			return $x1->getTimestamp() == $x2->getTimestamp();

		throw new InvalidArgumentException('Unsupported comparison: ' . (is_object($x1)?get_class($x1):gettype($x1)) . ' - ' . (is_object($x2)?get_class($x2):gettype($x2))  );
	}
	public static function Compare($x1,$x2){
		if ( $x1 instanceof XValue )
			return $x1->CompareTo( $x2 );

		if ( $x2 instanceof XValue )
			return $x2->CompareTo( $x1 );

		if (is_null($x1)) {
		  return is_null($x2) ? 0 : -1;
		}

		elseif (is_null($x2)) {
			return 1;
		}

		elseif (is_int($x1)||is_float($x1)) {
			if (is_int($x2)||is_float($x2)) return $x1 - $x2;
		}

		elseif ( is_string($x1) ){
			if (is_string($x2)) return strcmp( $x1 , $x2 );
		}

		elseif (is_bool($x1)) {
			if (is_bool($x2)) return $x1 ? ($x2 ? 0 : 1) : ($x2 ? -1: 0);
		}

		elseif ( $x1 instanceof DateTime ) {
			if ( $x2 instanceof DateTime ) return $x1->getTimestamp() - $x2->getTimestamp();
		}

		throw new InvalidArgumentException('Unsupported comparison: ' . (is_object($x1)?get_class($x1):gettype($x1)) . ' - ' . (is_object($x2)?get_class($x2):gettype($x2))  );
	}




}

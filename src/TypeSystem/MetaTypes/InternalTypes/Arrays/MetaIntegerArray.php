<?php

class MetaIntegerArray extends XConcreteArrayType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaIntegerArray */ public static function Type(){ return self::$instance; }
	/** @return MetaIntegerArrayOrNull */ public static function GetNullableType() { return MetaIntegerArrayOrNull::Type(); }


	public static function Encode($array){
		return implode(',',$array);
	}
	public static function Decode($string){
		$a = array();
		foreach (explode(',',$string) as $s) {
			$s = trim($s);
			if ($s === '') continue;
			$a[] = intval($s,10);
		}
		return $a;
	}

}

MetaIntegerArray::Init();




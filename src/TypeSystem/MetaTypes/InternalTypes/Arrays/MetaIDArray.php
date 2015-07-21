<?php

class MetaIDArray extends XConcreteArrayType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaIDArray */ public static function Type(){ return self::$instance; }
	/** @return MetaIDArrayOrNull */ public static function GetNullableType() { return MetaIDArrayOrNull::Type(); }


	public static function Encode($array){
		return implode(',',array_map(function(ID $id){ return $id->AsHex(); },$array));
	}
	public static function Decode($string){
		$a = array();
		foreach (explode(',',$string) as $s) {
			$s = trim($s);
			if ($s === '') continue;
			try {
				$a[] = ID::ParseHex($s);
			}
			catch (Exception $ex){}
		}
		return $a;
	}

}

MetaIDArray::Init();




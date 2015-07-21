<?php

class MetaKeywords extends XConcreteArrayType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaKeywords */ public static function Type(){ return self::$instance; }
	/** @return MetaKeywordsOrNull */ public static function GetNullableType() { return MetaKeywordsOrNull::Type(); }


	public static function Encode($array){
		$count = count($array);
		if ($count>0&&$array[$count-1]==='')
			return implode(',',$array).',';
		else
			return implode(',',$array);
	}
	public static function Decode($string){
		$l = strlen($string);
		if ($l === 0)
			return array();
		elseif (substr($string,$l-1) === ',')
			$string = substr($string,0,$l-1);
		return explode(',',$string);
	}

}

MetaKeywords::Init();




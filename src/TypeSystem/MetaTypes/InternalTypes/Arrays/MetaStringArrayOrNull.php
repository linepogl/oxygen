<?php

class MetaStringArrayOrNull extends XNullableArrayType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaStringArrayOrNull */ public static function Type(){ return self::$instance; }


	protected static function Encode($array){ return MetaStringArray::Encode($array); }
	protected static function Decode($string){ return MetaStringArray::Decode($string); }


}

MetaStringArrayOrNull::Init();

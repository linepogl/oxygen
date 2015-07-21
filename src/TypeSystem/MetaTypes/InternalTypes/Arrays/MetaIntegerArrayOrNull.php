<?php

class MetaIntegerArrayOrNull extends XNullableArrayType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaIntegerArrayOrNull */ public static function Type(){ return self::$instance; }


	protected static function Encode($array){ return MetaIntegerArray::Encode($array); }
	protected static function Decode($string){ return MetaIntegerArray::Decode($string); }


}

MetaIntegerArrayOrNull::Init();

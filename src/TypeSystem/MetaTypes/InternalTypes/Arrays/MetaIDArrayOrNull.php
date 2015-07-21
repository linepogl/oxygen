<?php

class MetaIDArrayOrNull extends XNullableArrayType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaIDArrayOrNull */ public static function Type(){ return self::$instance; }


	protected static function Encode($array){ return MetaIDArray::Encode($array); }
	protected static function Decode($string){ return MetaIDArray::Decode($string); }


}

MetaIDArrayOrNull::Init();

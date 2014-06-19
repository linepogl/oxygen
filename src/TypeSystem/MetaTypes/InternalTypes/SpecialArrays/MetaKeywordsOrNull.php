<?php

class MetaKeywordsOrNull extends XNullableArrayType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaKeywordsOrNull */ public static function Type(){ return self::$instance; }


	protected static function Encode($array){ return MetaKeywords::Encode($array); }
	protected static function Decode($string){ return MetaKeywords::Decode($string); }


}

MetaKeywordsOrNull::Init();

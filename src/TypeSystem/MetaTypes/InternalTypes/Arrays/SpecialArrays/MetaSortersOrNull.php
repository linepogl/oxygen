<?php

class MetaSortersOrNull extends XNullableArrayType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaSortersOrNull */ public static function Type(){ return self::$instance; }


	protected static function Encode($array){ return MetaSorters::Encode($array); }
	protected static function Decode($string){ return MetaSorters::Decode($string); }


}

MetaSortersOrNull::Init();

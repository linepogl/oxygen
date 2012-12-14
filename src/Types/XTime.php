<?php

class XTime extends XDateTime {

	public function __construct($timestamp=null){
		if ($timestamp instanceof DateTime) $timestamp = $timestamp->getTimestamp();
		parent::__construct(is_null($timestamp)
			? mktime(date('H'),date('i'),date('s'),1,1,2000)
			: mktime(date('H',$timestamp),date('i',$timestamp),date('s',$timestamp),1,1,2000)
			);
	}

	/** @return XTime */
	public static function MakeTime($hours=0,$minutes=0,$seconds=0){
		return parent::Make(2000,1,1,$hours,$minutes,$seconds);
	}

	/** @return XTime */
	public static function Current(){ return new XTime(); }

	/** @return XTime */
	public static function Midnight(){ return XDateTime::Make(2000,1,1)->GetTime(); }

	public function MetaType(){ return MetaTime::Type(); }
}




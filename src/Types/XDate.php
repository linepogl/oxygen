<?php


class XDate extends XDateTime {

	public function __construct($timestamp=null){
		if ($timestamp instanceof DateTime) $timestamp = $timestamp->getTimestamp();
		parent::__construct(is_null($timestamp)
			? mktime(0,0,0)
			: mktime(0,0,0,date('m',$timestamp),date('d',$timestamp),date('Y',$timestamp))
			);
	}

	public static function Today(){ return new XDate(); }

	public function MetaType(){ return MetaDate::Type(); }
}



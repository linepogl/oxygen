<?php

class XTime extends XDateTime {

	public function __construct($timestamp=null){
		if ($timestamp instanceof DateTime) $timestamp = $timestamp->getTimestamp();
		parent::__construct(is_null($timestamp)
			? mktime(date('H'),date('i'),date('s'),1,1,2000)
			: mktime(date('H',$timestamp),date('i',$timestamp),date('s',$timestamp),1,1,2000)
			);
	}

}




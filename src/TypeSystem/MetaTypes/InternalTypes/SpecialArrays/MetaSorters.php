<?php

class MetaSorters extends XConcreteArrayType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaSorters */ public static function Type(){ return self::$instance; }
	/** @return MetaSortersOrNull */ public static function GetNullableType() { return MetaSortersOrNull::Type(); }


	public static function Encode($array){
		$r = '';
		foreach ($array as $key => $asc) {
			if ($r!=='')$r.=',';
			$r .= $key.($asc?'-ASC':'-DESC');
		}
		return $r;
	}
	public static function Decode($string){
		if (empty($string))
			return array();
		$r = array();
		foreach (explode(',',$string) as $s) {
			$a = explode(',',$s);
			$r[$a[0]]= count($a)===1 || strtoupper($a[1])==='DESC';
		}
		return $r;
	}

}

MetaSorters::Init();




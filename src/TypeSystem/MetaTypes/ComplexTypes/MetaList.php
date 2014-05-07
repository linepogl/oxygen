<?php

class MetaList extends XConcreteType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaList */ public static function Type() { return self::$instance; }
	/** @return MetaList */ public static function GetNullableType() { throw new ConvertionException(); }
	/** @return XList */ public static function GetDefaultValue() { return new XList(); }




	
	/**
	 * @param $address XList
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value instanceof XList) $address = $value;
		throw new ValidationException();
	}

	/**
	 * @return int
	 */
	public static function GetPdoType() {
		throw new ConvertionException();
	}

	/**
	 * @return string
	 */
	public static function GetXsdType() {
		return 'xs:string';
	}

	/**
	 * @param $value XList
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value XList
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		$ids = $value->ToIDList();
		if (count($ids) == 0) $ids[] = new ID(-11111111);
		return '('.implode(',',array_map(function(ID $id){ return strval($id->AsInt()); },$ids)).')';
	}

	/**
	 * @param $value XList
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value XList
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		$ids = $value->ToIDList();
		return '['.implode(',',array_map(function($id){ return MetaID::ExportJsLiteral($id); },$ids)).']';
	}

	/**
	 * @param $value XList
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		$ids = $value->ToIDList();
		return implode(',',array_map(function($id)use($attr){ return MetaID::ExportXmlString($id,$attr); },$ids));
	}

	/**
	 * @param $value XList
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		$ids = $value->ToIDList();
		return implode(',',array_map(function($id){ return MetaID::ExportHtmlString($id); },$ids));
	}

	/**
	 * @param $value XList
	 * @return string
	 */
	public static function ExportTextString($value) {
		$ids = $value->ToIDList();
		return implode(',',array_map(function($id){ return MetaID::ExportTextString($id); },$ids));
	}

	/**
	 * @param $value XList
	 * @return string
	 */
	public static function ExportUrlString($value) {
		$ids = $value->ToIDList();
		return implode(',',array_map(function($id){ return MetaID::ExportUrlString($id); },$ids));
	}

	/**
	 * @param $value XList
	 * @return string
	 */
	public static function ExportValString($value) {
		$ids = $value->ToIDList();
		return implode(',',array_map(function($id){ return MetaID::ExportValString($id); },$ids));
	}


	/**
	 * @param $value string|null
	 * @return XList
	 */
	public static function ImportDBValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return XList
	 */
	public static function ImportDomValue($value) {
		$r = new XList();
		foreach (explode(',',$value) as $sid) $r[] = MetaID::ImportDomValue($sid);
		return $r;
	}

	/**
	 * @param $value string|null|array
	 * @return XList
	 */
	public static function ImportHttpValue($value) {
		$r = new XList();
		if (is_array($value)) {
			foreach ($value as $sid) $r[] = MetaID::ImportHttpValue($sid);
		}
		else {
			foreach (explode(',',$value) as $sid) $r[] = MetaID::ImportHttpValue($sid);
		}
		return $r;
	}
}

MetaList::Init();
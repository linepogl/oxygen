<?php

class OmniList extends OmniType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return OmniList */ public static function Type() { return self::$instance; }
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
		return '('.implode(',',array_map(function($id){ return strval($id->AsInt()); },$ids)).')';
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
		return '['.implode(',',array_map(function($id){ return OmniID::ExportJsLiteral($id); },$ids)).']';
	}

	/**
	 * @param $value XList
	 * @return string
	 */
	public static function ExportXmlString($value) {
		$ids = $value->ToIDList();
		return implode(',',array_map(function($id){ return OmniID::ExportXmlString($id); },$ids));
	}

	/**
	 * @param $value XList
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		$ids = $value->ToIDList();
		return implode(',',array_map(function($id){ return OmniID::ExportHtmlString($id); },$ids));
	}

	/**
	 * @param $value XList
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value XList
	 * @return string
	 */
	public static function ExportUrlString($value) {
		$ids = $value->ToIDList();
		return implode(',',array_map(function($id){ return OmniID::ExportUrlString($id); },$ids));
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
		foreach (explode(',',$value) as $sid) $r[] = OmniID::ImportDomValue($sid);
		return $r;
	}

	/**
	 * @param $value string|null|array
	 * @return XList
	 */
	public static function ImportHttpValue($value) {
		$r = new XList();
		if (is_array($value)) {
			foreach ($value as $sid) $r[] = OmniID::ImportHttpValue($sid);
		}
		else {
			foreach (explode(',',$value) as $sid) $r[] = OmniID::ImportHttpValue($sid);
		}
		return $r;
	}
}

OmniList::Init();
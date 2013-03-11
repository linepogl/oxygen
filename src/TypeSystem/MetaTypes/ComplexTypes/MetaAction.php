<?php

class MetaAction extends XConcreteType {

	private static $instance;
	public static function Init(){ self::$instance = new self(); }
	/** @return MetaAction */ public static function Type() { return self::$instance; }
	/** @return MetaAction */ public static function GetNullableType() { throw new ConvertionException(); }
	/** @return Action */ public static function GetDefaultValue() { throw new ConvertionException(); }





	
	/**
	 * @param $address Action
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value) {
		if ($value instanceof Action) $address = $value;
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
	 * @param $value Action
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value Action
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value Action
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlIdentifier($value, $platform) {
		throw new ConvertionException();
	}

	/**
	 * @param $value Action
	 * @return string
	 */
	public static function ExportJsLiteral($value) {
		return self::EncodeAsJsStringLiteral($value->GetHref());
	}

	/**
	 * @param $value Action
	 * @return string
	 */
	public static function ExportHtmlString($value) {
		return self::EncodeAsHtmlString($value->GetHref());
	}

	/**
	 * @param $value Action
	 * @return string
	 */
	public static function ExportXmlString($value,$attr=false) {
		throw new ConvertionException();
	}


	/**
	 * @param $value Action
	 * @return string
	 */
	public static function ExportUrlString($value) {
		return self::EncodeAsUrlString($value->GetHref());
	}


	/**
	 * @param $value Action
	 * @return string
	 */
	public static function ExportValString($value) {
		return $value->GetHref();
	}


	/**
	 * @param $value string|null
	 * @return Action
	 */
	public static function ImportDBValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null
	 * @return Action
	 */
	public static function ImportDomValue($value) {
		throw new ConvertionException();
	}

	/**
	 * @param $value string|null|array
	 * @return Action
	 */
	public static function ImportHttpValue($value) {
		throw new ConvertionException();
	}
}

MetaAction::Init();
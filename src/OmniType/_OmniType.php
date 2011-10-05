<?php

interface _OmniType {

	/**
	 * @return OmniType
	 */
	public static function Type();


	/**
	 * @return mixed <T>
	 */
	public static function GetDefaultValue();



	/**
	 * @param $address mixed <T>
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public static function Assign(&$address,$value);



	/**
	 * @return int
	 */
	public static function GetPdoType();


	/**
	 * @return string
	 */
	public static function GetXsdType();


	/**
	 * @param $value mixed <T>
	 * @param $platform int
	 * @return mixed
	 */
	public static function ExportPdoValue($value,$platform);


	/**
	 * @param $value mixed <T>
	 * @param $platform int
	 * @return string
	 */
	public static function ExportSqlLiteral($value,$platform);


	/**
	 * @param $value mixed <T>
	 * @param $platform int
	 * @return string
	 */
	public static function ExportSqlIdentifier($value,$platform);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public static function ExportJsLiteral($value);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public static function ExportXmlString($value);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public static function ExportHtmlString($value);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public static function ExportHumanReadableHtmlString($value);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public static function ExportUrlString($value);


	/**
	 * @param $value string|null
	 * @return mixed <T>
	 */
	public static function ImportDBValue($value);


	/**
	 * @param $value string|null
	 * @return mixed <T>
	 */
	public static function ImportDomValue($value);


	/**
	 * @param $value string|null|array
	 * @return mixed <T>
	 */
	public static function ImportHttpValue($value);



}

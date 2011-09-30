<?php

class ValidationException extends ApplicationException {}
class ConvertionException extends ApplicationException {}

abstract class OmniType {

	//
	//
	// Helpers
	//
	//
	/** @return string */
	protected function GetSqlNullLiteral(){ return 'NULL'; }

	/** @return string */
	protected function GetJsNullLiteral(){ return 'null'; }

	/**
	 * @param $string string
	 * @param $platform int
	 * @return string
	 */
	protected function GetSqlStringLiteral($string,$platform){
		switch ($platform) {
			default:
			case Database::MYSQL:   return '\''.str_replace('\'','\\\'',str_replace('\\','\\\\',$string)).'\'';
			case Database::ORACLE:  return '\''.str_replace('\'','\'\'',$string).'\'';
		}
		throw new ConvertionException();
	}

	/**
	 * @param $string string
	 * @param $platform int
	 * @return string
	 */
	protected function GetSqlIdentifier($string,$platform){
		switch ($platform) {
			default:
			case Database::MYSQL:   return '`'.str_replace(array( "`"  ,"/" ,"\\" ,"." ),array( "``" ,""  ,""   ,""  ),$string).'`';
			case Database::ORACLE:  return '"'.str_replace('"','""',$string).'"';
		}
		throw new ConvertionException();
	}


	/**
	 * @param $string string
	 * @return string
	 */
	protected function GetJsStringLiteral($string){
		return '\''.str_replace(array('\\','\'',"\n"),array('\\\\','\\\'','\\n'),$string).'\'';
	}



	/**
	 * @param $string string
	 * @return string
	 */
	protected function EncodeToXmlString($string) {
		return Oxygen::ToUnicode(str_replace(array('&','>','<','"',"\r\n"),array('&amp;','&gt;','&lt;','&quot;',"\n"),$string));
	}

	/**
	 * @param $string string
	 * @return string
	 */
	protected function EncodeToHtmlString($string) {
		return str_replace(array('&','>','<','"'),array('&amp;','&gt;','&lt;','&quot;'),$string);
	}

	/**
	 * @param $string string
	 * @return string
	 */
	protected function EncodeToUrlString($string) {
		return rawurlencode($string);
	}


	/**
	 * @param $string string
	 * @return string
	 */
	protected function DecodeFromXmlString($string) {
		return str_replace(array('&amp;','&gt;','&lt;','&quot;'),array('&','>','<','"'),Oxygen::ReadUnicode($string));
	}

	/**
	 * @param $string string
	 * @return string
	 */
	protected function DecodeFromHtmlString($string) {
		return htmlspecialchars_decode($string);
	}

	/**
	 * @param $string string
	 * @return string
	 */
	protected function DecodeFromUrlString($string) {
		return rawurldecode($string);
	}





	/**
	 * @return mixed <T>
	 */
	public abstract function GetDefaultValue();


	
	/**
	 * @param $address mixed <T>
	 * @param $value mixed
	 * @throws ValidationException
	 * @return void
	 */
	public abstract function Assign(&$dest,$value);



	/**
	 * @return int
	 */
	public abstract function GetPdoType();


	/**
	 * @param $value mixed <T>
	 * @param $platform int
	 * @return mixed
	 */
	public abstract function ExportPdoValue($value,$platform);


	/**
	 * @param $value mixed <T>
	 * @param $platform int
	 * @return string
	 */
	public abstract function ExportSqlLiteral($value,$platform);


	/**
	 * @param $value mixed <T>
	 * @param $platform int
	 * @return string
	 */
	public abstract function ExportSqlIdentifier($value,$platform);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public abstract function ExportJsLiteral($value);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public abstract function ExportXmlString($value);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public abstract function ExportHtmlString($value);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public abstract function ExportHumanReadableHtmlString($value);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public abstract function ExportUrlString($value);


	/**
	 * @param $value string|null
	 * @return mixed <T>
	 */
	public abstract function ImportDBValue($value);


	/**
	 * @param $value string|null
	 * @return mixed <T>
	 */
	public abstract function ImportDOMValue($value);


	/**
	 * @param $value string|null|array
	 * @return mixed <T>
	 */
	public abstract function ImportHttpValue($value);




}



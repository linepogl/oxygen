<?php


abstract class OmniType implements _OmniType {

	protected function __construct(){}




	/**
	 * @param $value mixed
	 * @return OmniType
	 */
	public final static function Of($value){
		if (is_string($value)) return OmniString::Type();
		if ($value instanceof OmniValue) /** @var $value OmniValue */ return $value->OmniType();
		if (is_int($value)) return OmniInteger::Type();
		if (is_float($value)) return OmniDecimal::Type();
		if (is_bool($value)) return OmniBoolean::Type();
		if (is_null($value)) return OmniNull::Type();
		throw new ConvertionException();
	}







	/**
	 * @return XField
	 */
	public final static function Field(){
		return new XField( static::Type() );
	}





























	//
	//
	// Helpers
	//
	//

	/**
	 * @param $string string
	 * @param $platform int
	 * @return string
	 */
	protected static function EncodeAsSqlStringLiteral($string,$platform){
		switch ($platform) {
			default:
			case Database::MYSQL:   return '\''.str_replace('\'','\\\'',str_replace('\\','\\\\',$string)).'\'';
			case Database::ORACLE:  return '\''.str_replace('\'','\'\'',$string).'\'';
		}
		throw new ConvertionException();
	}

	/**
	 * @param $datetime XDateTime
	 * @param $platform int
	 * @return string
	 */
	protected static function EncodeAsPdoDateTimeValue($datetime,$platform){
		switch ($platform) {
			default:
			case Database::MYSQL:   return $datetime->Format('Y-m-d H:i:s');
			case Database::ORACLE:  return $datetime->Format('Y-m-d H:i:s');
		}
		throw new ConvertionException();
	}

	/**
	 * @param $datetime XDateTime
	 * @param $platform int
	 * @return string
	 */
	protected static function EncodeAsSqlDateTimeLiteral($datetime,$platform){
		switch ($platform) {
			default:
			case Database::MYSQL:   return '\''.$datetime->Format('Y-m-d H:i:s').'\'';
			case Database::ORACLE:  return '\''.$datetime->Format('Y-m-d H:i:s').'\'';
		}
		throw new ConvertionException();
	}

	/**
	 * @param $string string
	 * @param $platform int
	 * @return string
	 */
	protected static function EncodeAsSqlIdentifier($string,$platform){
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
	protected static function EncodeAsJsStringLiteral($string){
		return '\''.str_replace(array('\\','\'',"\n"),array('\\\\','\\\'','\\n'),$string).'\'';
	}

	/**
	 * @param $datetime XDateTime
	 * @return string
	 */
	protected static function EncodeAsJsDateTimeLiteral($datetime){
		return 'new Date('.$datetime->GetYear().','.($datetime->GetMonth()-1).','.$datetime->GetDay().','.$datetime->GetHours().','.$datetime->GetMinutes().','.$datetime->GetSeconds().')';
	}


	/**
	 * @param $string string
	 * @return string
	 */
	protected static function EncodeAsXmlString($string) {
		return Oxygen::ToUnicode(str_replace(array('&','>','<','"',"\r\n"),array('&amp;','&gt;','&lt;','&quot;',"\n"),$string));
	}

	/**
	 * @param $string string
	 * @return string
	 */
	protected static function EncodeAsHtmlString($string) {
		return str_replace(array('&','>','<','"'),array('&amp;','&gt;','&lt;','&quot;'),$string);
	}

	/**
	 * @param $string string
	 * @return string
	 */
	protected static function EncodeAsUrlString($string) {
		return rawurlencode($string);
	}


	/**
	 * @param $string string
	 * @return string
	 */
	protected static function DecodeXmlString($string) {
		return str_replace(array('&amp;','&gt;','&lt;','&quot;'),array('&','>','<','"'),Oxygen::ReadUnicode($string));
	}

	/**
	 * @param $string string
	 * @return string
	 */
	protected static function DecodeHtmlString($string) {
		return htmlspecialchars_decode($string);
	}

	/**
	 * @param $string string
	 * @return string
	 */
	protected static function DecodeUrlString($string) {
		return rawurldecode($string);
	}






}



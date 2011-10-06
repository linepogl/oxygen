<?php


abstract class OmniType implements _OmniType {

	protected function __construct(){}




	/**
	 * @param $value mixed
	 * @return OmniType
	 */
	public final static function Of($value){
		if (is_string($value)) return JustString::Type();
		if (is_null($value)) return JustNull::Type();
		if ($value instanceof OmniValue) /** @var $value OmniValue */ return $value->OmniType();
		if (is_int($value)) return JustInteger::Type();
		if (is_float($value)) return JustDecimal::Type();
		if (is_bool($value)) return JustBoolean::Type();
		if (is_array($value)) return JustArray::Type();
		if ($value instanceof Traversable) return JustTraversable::Type();
		return JustStringable::Type();
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
	 * @param $platform int|null
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
	 * @param $string string
	 * @param $platform int|null
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



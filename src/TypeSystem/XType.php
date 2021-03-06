<?php


interface _XType {


	/**
	 * @return XNullableType
	 */
	public static function GetNullableType();

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
	 * @param $platform int|null
	 * @return mixed
	 */
	public static function ExportPdoValue($value,$platform);


	/**
	 * @param $value mixed <T>
	 * @param $platform int|null
	 * @return string
	 */
	public static function ExportSqlLiteral($value,$platform);


	/**
	 * @param $value mixed <T>
	 * @param $platform int|null
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
	public static function ExportXmlString($value,$attr=false);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public static function ExportHtmlString($value);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public static function ExportTextString($value);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public static function ExportUrlString($value);


	/**
	 * @param $value mixed <T>
	 * @return string
	 */
	public static function ExportValString($value);


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

abstract class XType implements _XType {

	protected function __construct(){}


	/**
	 * @param $value mixed
	 * @return XType
	 */
	public final static function Of($value){
		if (is_string($value)) return MetaString::Type();
		if (is_null($value)) return MetaNull::Type();
		if ($value instanceof XValue) return $value->MetaType();
		if (is_int($value)) return MetaInteger::Type();
		if (is_float($value)) return MetaDecimal::Type();
		if (is_bool($value)) return MetaBoolean::Type();
		if (is_array($value)) return MetaArray::Type();
		if ($value instanceof XList) return MetaList::Type();
		if ($value instanceof Traversable) return MetaTraversable::Type();
		return MetaStringable::Type();
	}




	/** @return XType */
	public static function Type(){ throw new NonImplementedException(); }



	/**
	 * @return XMetaField
	 */
	public final static function Field(){
		return new XMetaField( static::Type() );
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
			case Database::MYSQL:      return '\''.str_replace('\'','\\\'',str_replace('\\','\\\\',$string)).'\'';
			case Database::ORACLE:     return '\''.str_replace('\'','\'\'',$string).'\'';
			case Database::SQLSERVER:  return '\''.str_replace('\'','\'\'',$string).'\'';
		}
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
			case Database::SQLSERVER:  return '['.$string.']';
		}
	}


	/**
	 * @param $string string
	 * @return string
	 */
	protected static function EncodeAsJsStringLiteral($string){
		return '\''.str_replace(array('\\','\'',"\n",'</script>','<![CDATA[',']]>'),array('\\\\','\\\'','\\n','</*script>','<!*[CDATA[',']]*>'),$string).'\'';
	}


	/**
	 * @param $string string
	 * @return string
	 */
	protected static function EncodeAsXmlString($string,$attr=false) {
		$string = preg_replace('/[^\\x{0009}\\x{000A}\\x{000D}\\x{0020}-\\x{D7FF}\\x{E000}-\\x{FFFD}]/u', '',Oxygen::ToUnicode($string));
		if ($attr)
			return str_replace(array('&','>','<','"',"\r\n","\n","\r","\t"),array('&amp;','&gt;','&lt;','&quot;','&#10;','&#10;','&#13;','&#9;'),$string);
		else
			return str_replace(array('&','>','<','"',"\r\n"),array('&amp;','&gt;','&lt;','&quot;',"\n"),$string);
	}



	/**
	 * @param $string string
	 * @return string
	 */
	protected static function EncodeAsHtmlString($string) {
		return Str::Replace( array('&','>','<','"'),array('&amp;','&gt;','&lt;','&quot;'),$string);
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

abstract class XNullableType extends XType {
	public static function GetNullableType(){ return static::Type(); }
}

abstract class XConcreteType extends XType {
}



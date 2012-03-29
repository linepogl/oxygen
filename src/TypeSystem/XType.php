<?php


interface _XType {

	/**
	 * @return XType
	 */
	public static function Type();

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






/** @return int|null */
function int_or_null($var){
	if (is_null($var)) return null;
	if ($var instanceof ID) return $var->AsInt();
	if ($var instanceof XItem) return $var->id->AsInt();
	if (is_integer($var)) return $var;
	if (is_float($var)) return intval($var);
	return intval(strval($var));
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
		if ($value instanceof XValue) /** @var $value XValue */ return $value->MetaType();
		if (is_int($value)) return MetaInteger::Type();
		if (is_float($value)) return MetaDecimal::Type();
		if (is_bool($value)) return MetaBoolean::Type();
		if (is_array($value)) return MetaArray::Type();
		if ($value instanceof Traversable) return MetaTraversable::Type();
		return MetaStringable::Type();
	}







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












	public static function AreEqual($x1,$x2){
	  return 0 == self::Compare($x1,$x2);
	}
	public static function Compare($x1,$x2){
		if (is_null($x1)) {
		  return is_null($x2) ? 0 : -1;
		}
		elseif (is_string($x1)) {
		  if (is_null($x2)) return 1;
		  if (is_string($x2)) return strcmp($x1,$x2);
		  if ($x2 instanceof Lemma) return strcmp($x1,strval($x2));
		}
		elseif (is_int($x1)||is_float($x1)) {
			if (is_null($x2)) return 1;
			if (is_int($x2)||is_float($x2)) return $x1 - $x2;
			if ($x2 instanceof ID) return $x1 - $x2->AsInt();
			if ($x2 instanceof XItem) return $x1 - $x2->id->AsInt();
		}
		elseif (is_bool($x1)) {
			if (is_null($x2)) return 1;
			if (is_bool($x2)) return $x1 ? ($x2 ? 0 : 1) : ($x2 ? -1: 0);
		}
		elseif ($x1 instanceof GenericID){
			if (is_null($x2)) return 1;
			if (is_int($x2)||is_float($x2)) return $x1->AsInt() - $x2;
			if ($x2 instanceof GenericID) {
				//$r = $x1->GetClassOrder() - $x2->GetClassOrder(); if ($r != 0) return $r;
				$r = strcmp($x1->GetClassName(),$x2->GetClassName()); if ($r != 0) return $r;
				return $x1->AsInt() - $x2->AsInt();
			}
			if ($x2 instanceof ID) return $x1->AsInt() - $x2->AsInt();
			if ($x2 instanceof XItem) {
				//$r = $x1->GetClassOrder() - $x2->GetClassOrder(); if ($r != 0) return $r;
				$r = strcmp($x1->GetClassName(),$x2->GetClassName()); if ($r != 0) return $r;
				return $x1->AsInt() - $x2->id->AsInt();
			}
		}
		elseif ($x1 instanceof ID){
			if (is_null($x2)) return 1;
			if (is_int($x2)||is_float($x2)) return $x1->AsInt() - $x2;
			if ($x2 instanceof ID) return $x1->AsInt() - $x2->AsInt();
			if ($x2 instanceof XItem) return $x1->AsInt() - $x2->id->AsInt();
		}
		elseif ($x1 instanceof XItem){
			if (is_null($x2)) return 1;
			if (is_int($x2)||is_float($x2)) return $x1->id->AsInt() - $x2;
			if ($x2 instanceof GenericID) {
				//$r = $x1->GetClassOrder() - $x2->GetClassOrder(); if ($r != 0) return $r;
				$r = strcmp($x1->GetClassName(),$x2->GetClassName()); if ($r != 0) return $r;
				return $x1->id->AsInt() - $x2->AsInt();
			}
			if ($x2 instanceof ID) return $x1->id->AsInt() - $x2->AsInt();
			if ($x2 instanceof XItem) {
				//$r = $x1->GetClassOrder() - $x2->GetClassOrder(); if ($r != 0) return $r;
				$r = strcmp($x1->GetClassName(),$x2->GetClassName()); if ($r != 0) return $r;
				return $x1->id->AsInt() - $x2->id->AsInt();
			}

		}
		elseif ($x1 instanceof XDateTime){
			if (is_null($x2)) return 1;
			if ($x2 instanceof XDateTime) return $x1->AsInt() - $x2->AsInt();
			if ($x2 instanceof DateTime) return $x1->AsInt() - $x2->getTimestamp();
		}
		elseif ($x1 instanceof DateTime){
			if (is_null($x2)) return 1;
			if ($x2 instanceof XDateTime) return $x1->getTimestamp() - $x2->AsInt();
			if ($x2 instanceof DateTime) return $x1->getTimestamp() - $x2->getTimestamp();
		}
		elseif ($x1 instanceof XTimeSpan){
			if (is_null($x2)) return 1;
			if ($x2 instanceof XTimeSpan) return $x1->AsInt() - $x2->AsInt();
		}
		elseif ($x1 instanceof Lemma){
			if (is_null($x2)) return 1;
			if (is_string($x2)) return strcmp(strval($x1),$x2);
			if ($x2 instanceof Lemma) return strcmp(strval($x1),strval($x2));
		}
		throw new InvalidArgumentException('Unsupported comparison: ' . (is_object($x1)?get_class($x1):gettype($x1)) . ' - ' . (is_object($x2)?get_class($x2):gettype($x2))  );

	}







//	/** @return MetaString         */ public static function String()         { return MetaString::Type(); }
//	/** @return MetaStringOrNull   */ public static function StringOrNull()   { return MetaStringOrNull::Type(); }
//	/** @return MetaInteger        */ public static function Integer()        { return MetaInteger::Type(); }
//	/** @return MetaIntegerOrNull  */ public static function IntegerOrNull()  { return MetaIntegerOrNull::Type(); }
//	/** @return MetaDecimal        */ public static function Decimal()        { return MetaDecimal::Type(); }
//	/** @return MetaDecimalOrNull  */ public static function DecimalOrNull()  { return MetaDecimalOrNull::Type(); }
//	/** @return MetaBoolean        */ public static function Boolean()        { return MetaBoolean::Type(); }
//	/** @return MetaBooleanOrNull  */ public static function BooleanOrNull()  { return MetaBooleanOrNull::Type(); }
//	/** @return MetaID             */ public static function ID()             { return MetaID::Type(); }
//	/** @return MetaDate           */ public static function Date()           { return MetaDate::Type(); }
//	/** @return MetaDateOrToday    */ public static function DateOrToday()    { return MetaDateOrToday::Type(); }
//	/** @return MetaDateTime       */ public static function DateTime()       { return MetaDateTime::Type(); }
//	/** @return MetaDateTimeOrNow  */ public static function DateTimeOrNow()  { return MetaDateTimeOrNow::Type(); }
//	/** @return MetaTime           */ public static function Time()           { return MetaTime::Type(); }
//	/** @return MetaTimeOrCurrent  */ public static function TimeOrCurrent()  { return MetaTimeOrCurrent::Type(); }
//	/** @return MetaTimeOrMidnight */ public static function TimeOrMidnight() { return MetaTimeOrMidnight::Type(); }
//	/** @return MetaTimeSpan       */ public static function TimeSpan()       { return MetaTimeSpan::Type(); }
//	/** @return MetaTimeSpanOrZero */ public static function TimeSpanOrZero() { return MetaTimeSpanOrZero::Type(); }
//	/** @return MetaLemma          */ public static function Lemma()          { return MetaLemma::Type(); }
//	/** @return MetaLemmaOrEmpty   */ public static function LemmaOrEmpty()   { return MetaLemmaOrEmpty::Type(); }


}

abstract class XNullableType extends XType {
	public static function GetNullableType(){ return static::Type(); }
}

abstract class XConcreteType extends XType {
}



<?php

abstract class ImportConverter {
  protected $value;
  public function __construct($value){
    $this->value = $value;
  }


  /** @return ID|null        */ public final function AsID()       { return $this->CastTo(MetaID::Type()); }
  /** @return XDate|null     */ public final function AsDate()     { return $this->CastTo(MetaDate::Type()); }
  /** @return XTime|null     */ public final function AsTime()     { return $this->CastTo(MetaTime::Type()); }
  /** @return XDateTime|null */ public final function AsDateTime() { return $this->CastTo(MetaDateTime::Type()); }
  /** @return XTimeSpan|null */ public final function AsTimeSpan() { return $this->CastTo(MetaTimeSpan::Type()); }

	/** @return string  */ public final function AsString()  { return $this->CastTo(MetaString::Type()); }
	/** @return boolean */ public final function AsBoolean() { return $this->CastTo(MetaBoolean::Type()); }
	/** @return integer */ public final function AsInteger() { return $this->CastTo(MetaInteger::Type()); }
	/** @return float   */ public final function AsDecimal() { return $this->CastTo(MetaDecimal::Type()); }

	/** @return string|null  */ public final function AsStringOrNull()   { return $this->CastTo(MetaStringOrNull::Type()); }
	/** @return boolean|null */ public final function AsBooleanOrNull() { return $this->CastTo(MetaBooleanOrNull::Type()); }
	/** @return integer|null */ public final function AsIntegerOrNull() { return $this->CastTo(MetaIntegerOrNull::Type()); }
	/** @return float|null   */ public final function AsDecimalOrNull()   { return $this->CastTo(MetaDecimalOrNull::Type()); }


	/** @return Lemma|null     */ public function AsLemma() { return $this->CastTo(MetaLemmaOrNull::Type()); }
	/** @return GemnericID|null */ public function AsGenericID(){ return $this->CastTo(MetaGenericID::Type()); }
  /** @return XItem|null */ public function AsGenericXItem(){ $r = $this->AsGenericID(); return is_null($r) ? $r : $r->ToXItem(); }


  public abstract function CastTo(XType $type);


}


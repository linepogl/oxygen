<?php

abstract class ImportConverter {
  protected $value;
  public function __construct($value){
    $this->value = $value;
  }


	/** @return string|null    */ public final function AsString()   { return $this->CastTo(OmniStringOrNull::Type()); }
  /** @return ID|null        */ public final function AsID()       { return $this->CastTo(OmniIDOrNull::Type()); }
  /** @return XDate|null     */ public final function AsDate()     { return $this->CastTo(OmniDateOrNull::Type()); }
  /** @return XTime|null     */ public final function AsTime()     { return $this->CastTo(OmniTimeOrNull::Type()); }
  /** @return XDateTime|null */ public final function AsDateTime() { return $this->CastTo(OmniDateTimeOrNull::Type()); }
  /** @return XTimeSpan|null */ public final function AsTimeSpan() { return $this->CastTo(OmniTimeSpanOrNull::Type()); }


  /** @return boolean */ public final function AsBoolean() { return $this->CastTo(OmniBoolean::Type()); }
  /** @return integer */ public final function AsInteger() { return $this->CastTo(OmniInteger::Type()); }
  /** @return float   */ public final function AsFloat()   { return $this->CastTo(OmniDecimal::Type()); }

	/** @return boolean|null */ public final function AsNullableBoolean() { return $this->CastTo(OmniBooleanOrNull::Type()); }
	/** @return integer|null */ public final function AsNullableInteger() { return $this->CastTo(OmniIntegerOrNull::Type()); }
	/** @return float|null   */ public final function AsNullableFloat()   { return $this->CastTo(OmniDecimalOrNull::Type()); }

  /** @return Lemma|null */ public function AsLemma() { return $this->CastTo(OmniLemmaOrNull::Type()); }

  /** @return GemnericID|null */ public function AsGenericID(){ return $this->CastTo(OmniGenericIDOrNull::Type()); }
  /** @return XItem|null */ public function AsGenericXItem(){ $r = $this->AsGenericID(); return is_null($r) ? $r : $r->ToXItem(); }


  public abstract function CastTo(OmniType $type);


}


<?php

abstract class ImportConverter {
  protected $value;
  public function __construct($value){
    $this->value = $value;
  }


  public abstract function AsString();
  /** @return ID */ public abstract function AsID();
  /** @return XDateTime */ public abstract function AsDate();
  /** @return XDateTime */ public abstract function AsTime();
  /** @return XDateTime */ public abstract function AsDateTime();
  /** @return XTimeSpan */ public abstract function AsTimeSpan();

  public abstract function AsBoolean();
  public abstract function AsInteger();
  public abstract function AsFloat();

  public final function AsNullableBoolean(){ return is_null($this->value) || trim($this->value)=='' ? null : $this->AsBoolean(); }
  public final function AsNullableInteger(){ return is_null($this->value) || trim($this->value)=='' ? null : $this->AsInteger(); }
  public final function AsNullableFloat(){ return is_null($this->value) || trim($this->value)=='' ? null : $this->AsFloat(); }

  /** @return Lemma */ public function AsLemma() { return is_null($this->value) ? null : new Lemma($this->AsString()); }

  /** @return GemnericID */ public function AsGenericID(){ return is_null($this->value) ? null : GenericID::Decode($this->value); }
  /** @return XItem */ public function AsGenericXItem(){ return is_null($this->value) ? null : GenericID::Decode($this->value)->ToXItem(); }


  public final function CastTo($type){
    switch($type){
      case XType::String: return $this->AsString();
      case XType::ID: return $this->AsID();
      case XType::Date: return $this->AsDate();
      case XType::DateTime: return $this->AsDateTime();
      case XType::TimeSpan: return $this->AsTimeSpan();
      case XType::Time: return $this->AsTime();
      case XType::Lemma: return $this->AsLemma();

	    case XType::Integer: return $this->AsInteger();
      case XType::Boolean: return $this->AsBoolean();
      case XType::Float: return $this->AsFloat();

      case XType::NullableInteger: return $this->AsNullableInteger();
      case XType::NullableBoolean: return $this->AsNullableBoolean();
      case XType::NullableFloat: return $this->AsNullableFloat();
    }
  }

}
?>

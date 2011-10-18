<?php
  
class LocalLemma extends XItem {

	public $Name;
	public $Overlap;
	public static function FillMeta(XMeta $m){
		$m->SetDBTableName('oxy_local_lemmas');
		$m->Name = XMeta::String();
		$m->Overlap = XMeta::Lemma();
	}	
	
		
		
	public static function PickByName($name){
		return self::Seek()->Where( self::Meta()->Name->Eq($name) )->GetFirst();
	}


}  



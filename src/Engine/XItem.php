<?php

abstract class XItem implements Serializable,XValue {
	/** @var ID */
	public $id;
	public $has_temp_id = true;
	public function IsTemporary(){ return $this->has_temp_id; }
	/**
	 * Do not use this function directly. Instead, use the static functions Make() and Temp()
	 * @param null $id
	 * @param bool $this_is_a_perm_id
	 */
	public function __construct($id = null, $this_is_a_perm_id = false){
		if (is_null($id)) {
			if ($this_is_a_perm_id) throw new Exception('Please provide a perm ID.');
			$this->id = $this->GetNextTempID();
		}
		elseif ($id instanceof ID)
			$this->id = $id;
		else
			$this->id = new ID($id);
		$this->has_temp_id = !$this_is_a_perm_id;
		$this->Init();
	}
	public static function FillMeta(XMeta $m){}
	public function __toString(){
		return $this->id->AsHex();
	}

	public function GetMenu(){ return new Menu(); }

	public static function GetClassName(){ return get_called_class(); }
	public static function GetClassTitle(){ return Lemma::Pick(get_called_class()); }
	public static function GetClassTitlePlural(){ return Lemma::Pick(get_called_class().'s'); }
	public static function GetClassTitleGeneric($classname) { return $classname::GetClassTitle(); }
	public static function GetClassTitlePluralGeneric($classname) { return $classname::GetClassTitlePlural(); }

	public static function GetClassIconName() { return 'oxy/ico/Icon'; }
	public static final function GetClassIconNameGeneric($classname){ return $classname::GetClassIconName(); }
	public static function GetClassIconType() { return 'gif'; }
	public static final function GetClassIconTypeGeneric($classname){ return $classname::GetClassIconType(); }
	public static function GetClassIconSrc($size=16){ return static::GetClassIconName().$size.'.'.static::GetClassIconType(); }
	public static final function GetClassIconSrcGeneric($classname,$size=16){ return self::GetClassIconNameGeneric($classname).$size.'.'.self::GetClassIconTypeGeneric($classname); }
	public static function GetClassIcon($size=16) { return '<img src="'.static::GetClassIconSrc($size).'" width="'.$size.'" height="'.$size.'" alt="" />'; }
	public static final function GetClassIconGeneric($classname,$size=16){ return '<img src="'.self::GetClassIconSrcGeneric($classname,$size).'" width="'.$size.'" height="'.$size.'" alt="" />'; }




	public function GetCode(){ return $this->id->AsHex();}
	public function GetCodeWidth(){ return '16px'; }
	public function GetTitle(){return $this->id->AsHex();}
	public final function GetTrimmedTitle($size){ $s = $this->GetTitle(); return strlen($s) > $size ? substr($s,0,$size-1).'&hellip;' : $s; }
	public function GetVersion(){return null;}
	public function GetDefaultAction(){return null;}

	public function GetIconName() { return static::GetClassIconName(); }
	public function GetIconType() { return static::GetClassIconType(); }
	protected function GetIconSrc($size=16){ return $this->GetIconName().$size.'.'.$this->GetIconType(); }
	public function GetIcon($size=16) { return '<img class="icon" src="'.$this->GetIconSrc($size).'" width="'.$size.'" height="'.$size.'" alt="" />'; }
	public final function GetIconScr16(){ return $this->GetIconSrc(16); }
	public final function GetIconScr32(){ return $this->GetIconSrc(32); }
	public final function GetIconScr48(){ return $this->GetIconSrc(48); }
	public final function GetIcon16() { return $this->GetIcon(16); }
	public final function GetIcon32() { return $this->GetIcon(32); }
	public final function GetIcon48() { return $this->GetIcon(48); }

	public function MetaType(){ return MetaItem::Type(); }
	public function serialize(){
		$a = array();
		$meta = $this->Meta();
		$a['id'] = serialize($this->id);
		$a['has_temp_id'] = serialize($this->has_temp_id);
		/** @var $f XMetaField */
		foreach ($meta->GetFields() as $f){
			$n = $f->GetName();
			$a[$n] = serialize($this->$n);
		}
		return serialize($a);
	}
	public function unserialize($data){
		try {
			$a = unserialize($data);
			foreach ($a as $key=>$value)
				$this->$key = unserialize($value);
			$c = $this->Meta();
			for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
				$slaves = $cx->GetDBSlaves();
				/** @var $sl XMetaSlave */
				foreach ($slaves as $sl) {
					$n = $sl->GetName();
					$this->$n = $sl->SeekItemsByMaster($this);
				}
			}
			$this->OnLoad();
		}
		catch (Exception $ex){
			Debug::RecordExceptionSilenced($ex,'XItem Unserializer');
		}
	}

	private function Init(){
		$c = $this->Meta();
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$fields = $cx->GetFields();
			/** @var $f XMetaField */
			foreach ($fields as $f){
				$n = $f->GetName();
				$this->$n = $f->GetType()->GetDefaultValue();
			}
			$slaves = $cx->GetSlaves();
			/** @var $sl XMetaSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$this->$n = $sl->MakeItemList();
			}
		}
		$this->OnInit();
	}
	protected function OnInit() {}



	protected function OnLoad() {}
	public final function Load(DBReader $dr = null){
		if ($this->has_temp_id) throw new Exception('Cannot load an XItem('.$this->GetClassName().') with a temporary ID.');
		$c = $this->Meta();

		//
		//
		// Load Fields
		//
		//
		/** @var $cx XMeta */
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$fields = $cx->GetDBFields();
			if (is_null($dr) || $cx !== $c){
				$sql = 'SELECT '.new SqlName($cx->id);
				/** @var $f XMetaField */
				foreach ($fields as $f)
					$sql .= ',' . new SqlName($f);
				$sql .= ' FROM '.$cx->GetDBTableName();
				$sql .= ' WHERE '.new SqlName($cx->id).'=?';

				$dr = Database::Execute($sql,$this->id);
				if (!$dr->Read()) return false;
				foreach ($fields as $f){
					$n = $f->GetName();
					$this->$n = $dr[$f->GetDBName()]->CastTo($f->GetType());
				}
				$dr->Close();
			}
			else {
				foreach ($fields as $f){
					$n = $f->GetName();
					$this->$n = $dr[$f->GetDBName()]->CastTo($f->GetType());
				}
			}
		}


		//
		//
		// Load slaves (lazily)
		//
		//
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$slaves = $cx->GetDBSlaves();
			/** @var $sl XMetaSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$this->$n = $sl->SeekItemsByMaster($this);
			}
		}

		$this->OnLoad();
		return true;
	}






	protected function OnBeforeSave(){}
	protected function OnAfterSave(){}
	public function Save(){
		$c = $this->Meta();
		if ($this->has_temp_id) throw new Exception('Cannot save an XItem('.$this->GetClassName().') with a temporary ID.');
		$this->OnBeforeSave();



		//
		//
		// Save fields
		//
		//
		/** @var $cx XMeta */
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$fields = $cx->GetDBFields();
			if (0==Database::ExecuteScalar('SELECT COUNT('.new SqlName($cx->id).') FROM '.$cx->GetDBTableName().' WHERE '.new SqlName($cx->id).'=?',$this->id)->AsInteger()){
				$params = array();
				$sql = 'INSERT INTO '.$cx->GetDBTableName().'(';

				$i = 0;
				if (!$cx->id->IsDBAliasComplex()) {
					$params[] =& $this->id;
					$sql .= new SqlName($cx->id);
					$i++;
				}

				/** @var $f XMetaField */
				foreach ($fields as $f) {
					if ($f->IsDBAliasComplex()) continue;
					if ($i++ > 0) $sql .= ',';
					$sql .= new SqlName($f);
					$n = $f->GetName();
					$params[] =& $this->$n;
				}
				$sql .= ') VALUES (?' . str_repeat(',?',$i-1).')';

				Database::ExecuteX($sql,$params);
			}
			elseif (count($fields) > 0){
				$params = array();
				$sql = 'UPDATE '.$cx->GetDBTableName().' SET ';
				$i = 0;
				foreach ($fields as $f) {
					if ($f->IsDBAliasComplex()) continue;
					if ($i++ > 0) $sql.=',';
					$sql .= new SqlName($f) . '=?';
					$n = $f->GetName();
					$params[] =& $this->$n;
				}
				$sql .= ' WHERE '.new SqlName($cx->id).'=?';
				$params[] =& $this->id;
				Database::ExecuteX($sql,$params);
			}
		}
		$c->SaveInCache($this->id->AsInt(),$this);

		//
		//
		// Save slaves
		//
		//
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$slaves = $cx->GetDBSlaves();
			/** @var $sl XMetaSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$a = $this->$n;

				// delete removed slaves
				$hook_field = $sl->GetHookField();
				$hook_class = $hook_field->GetMeta();
				$to_be_deleted = $hook_class->SeekItems()
					->Where($hook_field->Eq($this))
					->Where($hook_class->id->NotIn($a));
				if (!is_null($sl->Where))
					$to_be_deleted->Where($sl->Where);

				$to_be_deleted->KillAll();

				/** @var $x XItem */
				foreach ($a as $i=>$x) {
					if ($x->IsTemporary()){
						$x = $x->Copy(true);
						$a[$i] = $x;
					}
					$x->Save();
				}
			}
		}

		$this->OnAfterSave();
	}




	protected function OnBeforeKill(){}
	protected function OnAfterKill(){}
	public function Kill(){
		if ($this->has_temp_id) throw new Exception('Cannot kill an XItem('.$this->GetClassName().') with a temporary ID.');
		$this->OnBeforeKill();
		$c = $this->Meta();


		// 1. Delete slaves
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$slaves = $cx->GetDBSlaves();
			/** @var $sl XMetaSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$a = $this->$n;
				/** @var $x XItem */
				foreach ($a as $x)
					$x->Kill();
			}
		}


		// 2. Delete attachments
		if ($this->HasDataFolder()){
			self::delete_folder_recursive($this->GetDataFolder());
		}

		// 3. Delete me
		/** @var $cx XMeta */
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$sql = 'DELETE FROM '.$cx->GetDBTableName().' WHERE '.new SqlName($cx->id).'=?';
			Database::Execute($sql,$this->id);
		}
		$c->RemoveFromCache($this->id->AsInt());


		$this->OnAfterKill();
	}




	protected function OnBeforeCopy(){}
	protected function OnAfterCopy(){}
	/** @return XItem */
	public function Copy( $with_a_perm_id = false , XMetaField $slave_hook_field = null , $slave_hook_id = null ){
		$this->OnBeforeCopy();
		$r = $this->Meta()->CopyItem($this,$with_a_perm_id,$slave_hook_field,$slave_hook_id);
		$r->OnAfterCopy();
		return $r;
	}







	protected function OnBeforeExportXml(DOMNode $e, XmlExportState $st){}
	protected function CheckBeforeExportXml(){return true;}
	protected function OnAfterExportXml(DOMNode $e, XmlExportState $st){}
	public function ExportXml(DOMNode $parent, XmlExportState $st=null, $meta_fields_to_be_ignored=array()){
		if (is_null($st)) $st = new XmlExportState();

		if (! $this->CheckBeforeExportXml()) return null;
		$xml = $parent instanceof DOMDocument ? $parent : $parent->ownerDocument;
		$c = $this->Meta();
		/** @var $e DOMElement */
		$e = $parent->appendChild($xml->createElement($c->GetXmlTagName()));
		$st->Push($this);
		$this->OnBeforeExportXml($e,$st);


		// Export fields
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$fields = $cx->GetXmlFields();
			/** @var $f XMetaField */
			foreach ($fields as $f){
				$found = false; foreach ($meta_fields_to_be_ignored as $ff) if ($f->IsEqualTo($ff)) { $found = true; break; }
				if ($found) continue;

				$n = $f->GetName();
				$value = $this->$n;

				$foreign_field = $f->GetXmlForeignField();
				if (!is_null($foreign_field)) {
					$nn = $foreign_field->GetName();
					$x = $foreign_field->GetMeta()->PickItem($value);
					$value = is_null($x) ? null : $x->$nn;
				}

				$enum = $f->GetXmlEnum();
				if (!is_null($enum)){
					$value = $enum->AsString($value);
				}

				/** @var $exporter string */
				$exporter = $f->GetXmlExporter();
				if (!is_null($exporter)) $value = $exporter($value,$st);
				$value = trim(strval(new Xml($value)));
				if ($value == '') continue;

				switch($f->GetXmlBehaviour()){
					case Xml::Attribute:
						$e->setAttribute($f->GetXmlName(), $value);
						break;
					case Xml::Element:
						$e->appendChild($xml->createElement($f->GetXmlName(),$value));
						break;
				}
			}
		}

		// Export slaves
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$slaves = $cx->GetXmlSlaves();
			/** @var $sl XMetaSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$a = $this->$n;
				/** @var $x XItem */
				foreach ($a as $x)
					$x->ExportXml($e,$st,array($sl->GetHookField()));
			}
		}

		$this->OnAfterExportXml($e,$st);
		$st->Pop();
		return $e;
	}




	protected function OnBeforeImportXml(DOMNode $e, XmlImportState $st, Validator $v){ }
	protected function OnAfterImportXml(DOMNode $e, XmlImportState $st, Validator $v){ }

	public function ImportXml(DOMNode $e, XmlImportState $st=null, $meta_fields_to_be_ignored=array() ){
		if (is_null($st)) $st = new XmlImportState();
		$v = new Validator();

		$st->Push($this);
		$this->OnBeforeImportXml($e,$st,$v);

		//$xml = $e->ownerDocument;
		$c = $this->Meta();

		// Import fields
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$fields = $cx->GetXmlFields();
			/** @var $f XMetaField */
			foreach ($fields as $f){
				if ($f->GetXmlImportPhase() != $st->GetPhase()) continue;
				$found = false; foreach ($meta_fields_to_be_ignored as $ff) if ($f->IsEqualTo($ff)) { $found = true; break; }
				if ($found) continue;

				$value = null;
				switch($f->GetXmlBehaviour()){
					case Xml::Attribute:
						$value = $e->hasAttribute($f->GetXmlName()) ? $e->getAttribute($f->GetXmlName()) : null;
						break;
					case Xml::Element:
						/** @var $ee DOMElement */
						foreach ($e->childNodes as $ee){
							if (!($ee instanceof DOMElement)) continue;
							if ($ee->tagName != $f->GetXmlName()) continue;
							$value = $ee->textContent;
							break;
						}
						break;
				}

				$enum = $f->GetXmlEnum();
				if (!is_null($enum)){
					$value = $enum->AsNumber($value);
				}

				/** @var $importer string */
				$importer = $f->GetXmlImporter();
				if (!is_null($importer)) $value = $importer($value,$st,$v);
				$value = new XmlValue($value);

				$foreign_field = $f->GetXmlForeignField();
				if (!is_null($foreign_field)) {
					if (!is_null($value)){
						$value = $value->CastTo($foreign_field->GetType());
						if (!is_null($value)) {
							$x = $foreign_field->GetMeta()->MakeListFromDB()
								->Where($foreign_field->Eq($value))
								->GetFirst();

							if (is_null($x)) $v[] = new ErrorMessage(sprintf(Lemma::Pick('MsgXItemNotFound'),XItem::GetClassTitleGeneric($foreign_field->GetMeta()->GetClassName()),$value));
							$value = is_null($x) ? null : $x->id;
						}
					}
				}
				else {
					$value = $value->CastTo($f->GetType());
				}

				$n = $f->GetName();
				if (!is_null($value)) $this->$n = $value;
			}
		}

		// Import slaves
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$slaves = $cx->GetXmlSlaves();
			/** @var $sl XMetaSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$foreign_meta_field = $sl->GetHookField();
				$foreign_meta_class = $foreign_meta_field->GetMeta();
				if ($st->GetPhase() == 0) { // on phase 0 the slaves must be created
					$a = new XList($foreign_meta_class);
					foreach ($e->childNodes as $ee){
						if (!($ee instanceof DOMElement)) continue;
						if ($ee->tagName != $foreign_meta_class->GetXmlTagName()) continue;
						$x = $foreign_meta_class->MakeTempItem();
						$nn = $foreign_meta_field->GetName();
						$x->$nn = $this->id;
						$v[] = $x->ImportXml($ee,$st,array($foreign_meta_field));
						$a[] = $x;
					}
					$this->$n = $a;
				}
				else { // on the other phases, just the event has to be propagated
					$i = 0;
					foreach ($e->childNodes as $ee){
						if (!($ee instanceof DOMElement)) continue;
						if ($ee->tagName != $foreign_meta_class->GetXmlTagName()) continue;
						$x = $this->{$n}[$i];
						$v[] = $x->ImportXml($ee,$st,array($foreign_meta_field));
						$i++;
					}
				}
			}
		}

		$this->OnAfterImportXml($e,$st,$v);
		$st->Pop();
		return $v;
	}

















	
	/** @return XWrap */
	public final function Wrap($name=null){
		if (is_null($name)) $name = 'x'.Oxygen::Hash32($this->GetClassName().$this->id->AsHex());
		return new XWrap($this->Meta(),$this,$name);
	}

	public final function Read(Http $http,$name=null){
		return $this->Wrap($name)->Read($http);
	}









	//
	//
	// Meta
	//
	//
	/** @return XMeta */ public static final function Meta(){ return XMeta::Of(get_called_class()); }

	/** @return XList */ public static final function MakeList(){ return static::Meta()->MakeItemList(); }
	/** @return XList */ public static final function MakeListGeneric($classname){ return XMeta::Of($classname)->MakeItemList(); }

	/** @return XItem */ public static final function Temp($id=null){ return static::Meta()->MakeTempItem($id); }
	/** @return XItem */ public static final function TempGeneric($classname,$id=null){ return XMeta::Of($classname)->MakeTempItem($id); }

	/** @return XItem */ public static final function Make(){ return static::Meta()->MakePermItem(); }
	/** @return XItem */ public static final function MakeGeneric($classname){ return XMeta::Of($classname)->MakePermItem(); }


	/** @return XAggr */ public static final function Aggr($selectors){ return static::Meta()->Aggr($selectors); }
	/** @return XAggr */ public static final function AggrGeneric($classname,$selectors){ return XMeta::Of($classname)->Aggr($selectors); }

	/** @return XList */ public static final function Seek(){ return static::Meta()->SeekItems(); }
	/** @return XList */ public static final function SeekAggressively(){ return static::Meta()->SeekItems()->Aggressively(); }
	/** @return XList */ public static final function SeekGeneric($classname){ return XMeta::Of($classname)->SeekItems(); }

	/** @return XItem|null */ public static final function Pick($id,DBReader $dr=null){ return static::Meta()->PickItem($id,$dr); }
	/** @return XItem|null */ public static final function PickGeneric($classname,$id,DBReader $dr=null){ return XMeta::Of($classname)->PickItem($id,$dr); }


	/** @return ID */ public static function GetNextPermID(){ return static::Meta()->GetNextPermID(); }
	/** @return ID */ public static function GetNextTempID(){ return static::Meta()->GetNextTempID(); }











	/** @return array */
	public static function SelectField(XMetaField $meta_field,$where=null,$orderby=null){
		return self::SelectFieldX($meta_field,$where,$orderby,array_slice(func_get_args(),3));
	}
	/** @return array */
	public static function SelectFieldX(XMetaField $meta_field,$where=null,$orderby=null,$params=array()){
		$c = $meta_field->GetMeta();
		$sql = 'SELECT a.'.new SqlName($meta_field).' AS id FROM '.$c->GetDBTableName().' AS a';

		/** @var $cx XMeta */
		for ($cx = $c->GetParent(); !is_null($cx); $cx = $cx->GetParent())
			$sql .= ','.$cx->GetDBTableName();

		for ($cx = $c->GetParent(); !is_null($cx); $cx = $cx->GetParent()) {
			if (!is_null($where)) $where .= ' AND ';
			$where .= $cx->GetDBTableName().'.'.new SqlName($cx->id).'='.$c->GetDBTableName().'.'.new SqlName($c->id);
		}

		for ($cx = $c->GetParent(); !is_null($cx); $cx = $cx->GetParent()) {
			if (is_null($cx->GetOrderBy())) continue;
			if (!is_null($orderby)) $orderby .= ',';
			$orderby .= $cx->GetOrderBy();
		}

		if (!is_null($where)) $sql .= ' WHERE '.$where;
		if (!is_null($orderby)) $sql .= ' ORDER BY '.$orderby;

		return Database::ExecuteColumnOfX($meta_field->GetType(),$sql,$params);
	}

	/** @return GenericID */
	public function AsGenericID(){
		return new GenericID($this->GetClassName(),$this->id);
	}



	public function IsLocked(){ return false; }
	public function IsHidden(){ return false; }

	// TODO: this is used by XItem::Sort but should be removed.
	public static function Compare($x1,$x2){ return XType::Compare($x1,$x2); }

	public function IsEqualTo($x) { return XType::AreEqual($this,$x); }
	public function CompareTo($x){ return XType::Compare($this,$x); }




	//
	//
	// Attachments
	//
	//
	public function GetDataFolder(){
		return Oxygen::GetDataFolder().'/'.Database::GetSchema().'/'.$this->GetClassName().'/'.$this->id->AsHex();
	}
	public function HasDataFolder(){
		return is_dir($this->GetDataFolder());
	}
	public function EnsureDataFolder(){
		if (!is_dir($this->GetDataFolder())) $this->MakeDataFolder();
	}
	public function MakeDataFolder(){
		return mkdir($this->GetDataFolder(),0777,true);
	}
	public function KillDataFolder(){
		$f = $this->GetDataFolder();
		if (!file_exists($f)) return;
		if (!is_dir($f)) return;
		rmdir($f);
	}
	private static function delete_folder_recursive($folder){
		foreach (scandir($folder) as $f){
			if ($f=='.'||$f=='..') continue;
			if (is_dir("$folder/$f")) self::delete_folder_recursive("$folder/$f");
			else unlink("$folder/$f");
		}
		rmdir($folder);
	}
	private static function copy_folder_recursive($src,$dst){
		if (!is_dir($dst)) mkdir($dst,0777,true);
		foreach (scandir($src) as $f){
			if ($f=='.'||$f=='..') continue;
			if (is_dir("$src/$f")) self::copy_folder_recursive("$src/$f","$dst/$f");
			else copy("$src/$f","$dst/$f");
		}
	}









}





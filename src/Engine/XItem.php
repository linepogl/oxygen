<?php

abstract class XItem implements Serializable {
	public $id;
	private $is_temp = false;
	public function __construct($id = null){
		$this->id = is_null($id) ? self::GetNextID() : ($id instanceof ID ? $id : new ID($id));
		$this->Init();
	}
	public function __toString(){
		return $this->id->AsHex();
	}

	public function GetMenu(){ return new Menu(); }

	public static function GetClassName(){ return get_called_class(); }
	public static function GetClassTitle(){ return Lemma::Retrieve(get_called_class()); }
	public static function GetClassTitlePlural(){ return Lemma::Retrieve(get_called_class().'s'); }
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

	public function serialize(){
		$a = array();
		$meta = $this->Meta();
		$a['id'] = serialize($this->id);
		/** @var $f XField */
		foreach ($meta->GetFields() as $f){
			$n = $f->GetName();
			$a[$n] = serialize($this->$n);
		}
		return json_encode($a);
	}
	public function unserialize($data){
		$a = json_decode($data,true);
		foreach ($a as $key=>$value)
			$this->$key = unserialize($value);
		$c = $this->Meta();
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$slaves = $cx->GetDBSlaves();
			/** @var $sl XSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$this->$n = new XList($sl->GetHookMeta());
			}
		}
		$this->OnLoad();
	}

	private function Init(){
		$c = $this->Meta();
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$slaves = $cx->GetDBSlaves();
			/** @var $sl XSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$this->$n = new XList($sl->GetHookMeta());
			}
		}
		$this->OnInit();
	}
	protected function OnInit() {}



	protected function OnLoad() {}
	public final function Load(DBReader $dr = null){
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
				$sql = 'SELECT '.$cx->id->GetDBName();
				/** @var $f XField */
				foreach ($fields as $f)
					$sql .= ',' . $f->GetDBName();
				$sql .= ' FROM '.$cx->GetDBTableName();
				$sql .= ' WHERE '.$cx->id->GetDBName().'=?';

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
			/** @var $sl XSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$this->$n = $sl->MakeListFromDB($this);
			}
		}

		$this->OnLoad();
		return true;
	}






	protected function OnBeforeSave(){}
	protected function OnAfterSave(){}
	public function Save(){
		$this->OnBeforeSave();
		$c = $this->Meta();



		//
		//
		// Save fields
		//
		//
		/** @var $cx XMeta */
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$fields = $cx->GetDBFields();
			if (0==Database::ExecuteScalar('SELECT COUNT('.$cx->id->GetDBName().') FROM '.$cx->GetDBTableName().' WHERE '.$cx->id->GetDBName().'=?',$this->id)->AsInteger()){
				$params = array();
				$params[] =& $this->id;

				$sql = 'INSERT INTO '.$cx->GetDBTableName().'('.$cx->id->GetDBName();
				/** @var $f XField */
				foreach ($fields as $f) {
					$sql .= ','.$f->GetDBName();
					$n = $f->GetName();
					$params[] =& $this->$n;
				}
				$sql .= ') VALUES (?' . str_repeat(',?',count($fields)).')';

				Database::ExecuteX($sql,$params);
			}
			elseif (count($fields) > 0){
				$params = array();
				$sql = 'UPDATE '.$cx->GetDBTableName().' SET ';
				$i = 0;
				foreach ($fields as $f) {
					if ($i++ > 0) $sql.=',';
					$sql .= $f->GetDBName() . '=?';
					$n = $f->GetName();
					$params[] =& $this->$n;
				}
				$sql .= ' WHERE '.$cx->id->GetDBName().'=?';
				$params[] =& $this->id;
				Database::ExecuteX($sql,$params);
			}
		}

		//
		//
		// Save slaves
		//
		//
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$slaves = $cx->GetDBSlaves();
			/** @var $sl XSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$a = $this->$n;

				// delete removed slaves
				$hook_field = $sl->GetHookField();
				$hook_class = $hook_field->GetMeta();
				$to_be_deleted = $hook_class->MakeListFromDB()
					->Where($hook_field->Eq($this))
					->Where($hook_class->id->NotIn($a));
				if (!is_null($sl->Where))
					$to_be_deleted->Where($sl->Where);

				/** @var $x XItem */
				foreach ($to_be_deleted as $x)
					$x->Delete();

				/** @var $x XItem */
				foreach ($a as $x)
					$x->Save();
			}
		}

		$this->OnAfterSave();
	}


	protected function OnBeforeDelete(){}
	protected function OnAfterDelete(){}
	public function Delete(){
		$this->OnBeforeDelete();
		$c = $this->Meta();


		// 1. Delete slaves
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$slaves = $cx->GetDBSlaves();
			/** @var $sl XSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$a = $this->$n;
				/** @var $x XItem */
				foreach ($a as $x)
					$x->Delete();
			}
		}


		// 2. Delete attachments
		if ($this->HasDataFolder()){
			self::delete_folder_recursive($this->GetDataFolder());
		}

		// 3. Delete me
		/** @var $cx XMeta */
		for ($cx = $c; !is_null($cx); $cx = $cx->GetParent()){
			$sql = 'DELETE FROM '.$cx->GetDBTableName().' WHERE '.$cx->id->GetDBName().'=?';
			Database::Execute($sql,$this->id);
		}

		$this->OnAfterDelete();
	}



	/** @return XItem */
	public static function Temp($id){
		return self::TempGeneric(get_called_class(),$id);
	}
	/** @return XItem */
	public static function TempGeneric($classname,$id){
		$r = new $classname($id);
		return $r;
	}

	/** @return XItem */
	public static function Create(){
		return self::CreateGeneric(get_called_class());
	}
	/** @return XItem */
	public static function CreateGeneric($classname){
		$r = new $classname();
		self::SaveInCache($classname,$r->id->AsInt(),$r);
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
			/** @var $f XField */
			foreach ($fields as $f){
				$found = false; foreach ($meta_fields_to_be_ignored as $ff) if ($f->IsEqualTo($ff)) { $found = true; break; }
				if ($found) continue;

				$n = $f->GetName();
				$value = $this->$n;

				$foreign_field = $f->GetXmlForeignField();
				if (!is_null($foreign_field)) {
					$nn = $foreign_field->GetName();
					$x = XItem::RetrieveGeneric($foreign_field->GetMeta()->GetClassName(),$value);
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
			/** @var $sl XSlave */
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
			/** @var $f XField */
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

							if (is_null($x)) $v[] = new ErrorMessage(sprintf(Lemma::Retrieve('MsgXItemNotFound'),XItem::GetClassTitleGeneric($foreign_field->GetMeta()->GetClassName()),$value));
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
			/** @var $sl XSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$foreign_meta_field = $sl->GetHookField();
				$foreign_meta_class = $foreign_meta_field->GetMeta();
				if ($st->GetPhase() == 0) { // on phase 0 the slaves must be created
					$a = new XList($foreign_meta_class);
					foreach ($e->childNodes as $ee){
						if (!($ee instanceof DOMElement)) continue;
						if ($ee->tagName != $foreign_meta_class->GetXmlTagName()) continue;
						$x = XItem::CreateGeneric($foreign_meta_class->GetClassName());
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








	public function __clone() {
		$m = $this->Meta();
		$id = $m->GetNextID();
		$old_data_folder = $this->HasDataFolder() ? $this->GetDataFolder() : null;
		$this->id = $id;

		// 1. Clone data folder
		if (!is_null($old_data_folder)){
			self::copy_folder_recursive($old_data_folder,$this->GetDataFolder());
		}

		// 2. Clone slaves
		for ($mx = $m; !is_null($mx); $mx = $mx->GetParent()){
			$slaves = $mx->GetSlaves();
			/** @var $sl XSlave */
			foreach ($slaves as $sl) {
				$n = $sl->GetName();
				$a = $this->$n;
				$aa = new XList();
				foreach ($a as $x) {
					$xx = clone $x;
					$nn = $sl->GetHookField()->GetName();
					$xx->$nn = $this->id;
					$aa[] = $xx;
				}
				$this->$n = $aa;
			}
		}

		self::SaveInCache(get_called_class(),$this->id->AsInt(),$this);
	}



















	public static function GetNextID(){
		return self::Meta()->GetNextID();
	}


	public static function NewList(){ return new XList(self::Meta()); }


	public static function FillMeta(XMeta $m) { }
	/** @return XMeta */ public static final function Meta(){ return XMeta::Pick(get_called_class()); }

	
	/** @return XWrap */
	public final function Wrap($name=null){
		if (is_null($name)) $name = 'x'.Oxygen::Hash32($this->GetClassName().$this->id->AsHex());
		return new XWrap($this->Meta(),$this,$name);
	}

	public final function Read(Http $http,$name=null){
		return $this->Wrap($name)->Read($http);
	}


	/** @return XItem|null */
	public static final function Retrieve($id,DBReader $dr=null){ return self::RetrieveGeneric(get_called_class(),$id,$dr); }
	/** @return XItem|null */
	public static final function RetrieveGeneric($classname,$id,DBReader $dr=null) {
		if (is_null($id) || is_null($classname)) return null;
		if (!($id instanceof ID)) $id = new ID($id);
		$idi = $id->AsInt();
		if (self::ExistsInLocalCache($classname,$idi))
			return self::RetrieveFromLocalCache($classname,$idi);
		elseif (self::ExistsInRemoteCache($classname,$idi))
			return self::RetrieveFromRemoteCache($classname,$idi);
		else {
			$c = XMeta::Pick($classname);
			$tablename = $c->GetDBTableName();
			$primarykey = $c->id->GetDBName();

			if ($c->IsAbstract()){
				if (!array_key_exists($tablename,self::$abstract_classnames)) self::$abstract_classnames[$tablename] = array();
				if (!array_key_exists($idi,self::$abstract_classnames[$tablename])) {
					self::$abstract_classnames[$tablename][$idi] = Database::ExecuteScalar('SELECT '.$c->GetAbstractDBFieldName().' FROM '.$tablename.' WHERE '.$primarykey.'=?',$id)->AsString();
				}
				$classname = self::$abstract_classnames[$tablename][$idi];
				$x = self::RetrieveGeneric($classname,$id);
			}
			else {
				/** @var $x XItem */
				$x = new $classname($idi);
				$found = $x->Load($dr);
				if (!$found)
					$x = null;
			}
			self::SaveInCache($classname,$idi,$x);
		}
		return $x;
	}



	/** @return XList */ public static final function MakeList(){ return static::Meta()->MakeList(); }
	/** @return XList */ public static final function MakeListFromDB(){ return static::Meta()->MakeListFromDB(); }

	/** @return XList */ public static final function Find(XPred $where = null){ return static::Meta()->MakeListFromDB()->Where($where); }
	/** @return XList */ public static final function FindGeneric($classname, XPred $where = null){ return XMeta::Pick($classname)->MakeListFromDB()->Where($where); }

	/** @return XList */ public static final function Select(XPred $where = null){ return static::Meta()->MakeListFromDB()->Where($where); }
	/** @return XList */ public static final function SelectGeneric($classname, XPred $where = null){ return XMeta::Pick($classname)->MakeListFromDB()->Where($where); }






	/** @return array */
	public static function SelectField(XField $meta_field,$where=null,$orderby=null){
		return self::SelectFieldX($meta_field,$where,$orderby,array_slice(func_get_args(),3));
	}
	/** @return array */
	public static function SelectFieldX(XField $meta_field,$where=null,$orderby=null,$params=array()){
		$c = $meta_field->GetMeta();
		$sql = 'SELECT a.'.$meta_field->GetDBName().' AS id FROM '.$c->GetDBTableName().' AS a';

		/** @var $cx XMeta */
		for ($cx = $c->GetParent(); !is_null($cx); $cx = $cx->GetParent())
			$sql .= ','.$cx->GetDBTableName();

		for ($cx = $c->GetParent(); !is_null($cx); $cx = $cx->GetParent()) {
			if (!is_null($where)) $where .= ' AND ';
			$where .= $cx->GetDBTableName().'.'.$cx->id->GetDBName().'='.$c->GetDBTableName().'.'.$c->id->GetDBName();
		}

		for ($cx = $c->GetParent(); !is_null($cx); $cx = $cx->GetParent()) {
			if (is_null($cx->GetOrderBy())) continue;
			if (!is_null($orderby)) $orderby .= ',';
			$orderby .= $cx->GetOrderBy();
		}

		if (!is_null($where)) $sql .= ' WHERE '.$where;
		if (!is_null($orderby)) $sql .= ' ORDER BY '.$orderby;

		return Database::ExecuteListOfX($meta_field->GetType(),$sql,$params);
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








	//
	//
	// Cache
	//
	//
	private static $request_scope_item_cache = array();
	private static $abstract_classnames = array();
	public static final function ResetRequestScopeCache(){ self::$request_scope_item_cache = array(); }
	private static function ExistsInLocalCache($classname,$idi){
		return isset(self::$request_scope_item_cache[$classname][$idi]); //<-- this works!
	}
	private static function ExistsInRemoteCache($classname,$idi){
		return Oxygen::IsItemCacheEnabled() && Scope::$DATABASE->Contains('XItem::Cache::'.$classname.$idi);
	}
	private static function RetrieveFromLocalCache($classname,$idi){
		return self::$request_scope_item_cache[$classname][$idi];
	}
	private static function RetrieveFromRemoteCache($classname,$idi){
		$r = Scope::$DATABASE['XItem::Cache::'.$classname.$idi];
		if (!array_key_exists($classname,self::$request_scope_item_cache)) self::$request_scope_item_cache[$classname] = array();
		self::$request_scope_item_cache[$classname][$idi] = $r;
		return $r;
	}
	private static function SaveInCache($classname,$idi,$item){
		if (!array_key_exists($classname,self::$request_scope_item_cache)) self::$request_scope_item_cache[$classname] = array();
		self::$request_scope_item_cache[$classname][$idi] = $item;
		if (Oxygen::IsItemCacheEnabled())
			Scope::$DATABASE['XItem::Cache::'.$classname.$idi] = $item;
	}
	private static function DeleteFromCache($classname,$idi){
		unset(self::$request_scope_item_cache[$classname][$idi]); //<-- this works!
    if (Oxygen::IsItemCacheEnabled())
			Scope::$DATABASE['XItem::Cache::'.$classname.$idi] = null;
	}

}



?>

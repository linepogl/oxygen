<?php

class DatabaseConnection {
	/** @var PDO|null */
	public $cn = null;
	public $server = null;
	public $schema = null;
	public $username = null;
	public $password = null;
	public $type = null;
	public $is_managed = false;
	public function __construct($server,$schema,$username,$password,$type,$is_managed){
		$this->server = $server;
		$this->schema = $schema;
		$this->username = $username;
		$this->password = $password;
		$this->type = $type;
		$this->is_managed = $is_managed;
	}
}


class Database {
	const MYSQL = 'mysql';
	const ORACLE = 'oracle';

	/** @var DatabaseConnection|null */
	private static $cx = null;
	private static $stack = array();

	private static $queries = array();
	private static $prepared = array();
	private static $prepared_stats = array();

	// duplicates, for speed:
	private static $cn = null;
	private static $server = null;
	private static $schema = null;
	private static $type = null;



	public static function GetUpgradeFiles() { return Oxygen::GetDatabaseUpgradeFiles(); }
	public static function AddUpgradeFile($filename) { Oxygen::AddDatabaseUpgradeFile($filename); }



	public static function Upgrade($force=false){
		if (is_null(self::$cx) || !self::$cx->is_managed) return;

		$needs_refresh = false;
		foreach (Oxygen::GetDatabaseUpgradeFiles() as $filename){
			$needs_upgrade = true;
			$key = 'Database::upgrade_time_of_'. $filename;
			$time = Scope::$DATABASE[$key];
			if (!is_null($time))
				$needs_upgrade = filemtime($filename) > $time;
			if ($needs_upgrade || $force){
				Database::RequireConnection();
				set_time_limit(0);
				Database::ClearPatchingSystem();
				require($filename);
				Scope::$DATABASE[$key] = time();
				if (Database::IsPatchingSystemDirty()) $needs_refresh = true;
			}
		}
		if ($needs_refresh){
			Debug::Write('Upgrade complete.<br/>Total queries: '.count(Database::GetQueries()).'.<br/><br/><br/>Please refresh.<br/><br/><br/><br/>');
			exit();
		}
	}



	public static function CreateSchema($server,$schema,$username,$password,$type=self::MYSQL){
		if ($type == self::MYSQL){
			self::PushConnection();
			self::SetConnection( new DatabaseConnection($server,$schema,$username,$password,$type,false) );
			try{
				$a = explode(':',$server);
				$charset = Oxygen::GetCharset();
				if ($charset == 'UTF-8') $charset = 'utf8'; elseif ($charset == 'ISO-8859-1') $charset = 'latin1';
				self::$cx->cn = new PDO('mysql:host='.$a[0].(count($a)>1?';port='.$a[1]:'').';charset='.$charset, $username, $password, array(PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) );
				self::$cn = self::$cx->cn;
			}
			catch (Exception $ex){
				self::PopConnection();
				throw new ApplicationException(Lemma::Pick('MsgCannotConnectToDatabase').'<br/><br/>'. $server. '<br/>'.$ex->getMessage());
			}
			try{
				Database::Execute('CREATE DATABASE '.new SqlName($schema).' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci');
			}
			catch (Exception $ex){
				self::PopConnection();
				throw new ApplicationException(Lemma::Pick('MsgCannotCreateDatabase').'<br/><br/>'. $server.'/'.$schema. '<br/>'.$ex->getMessage());
			}
			self::PopConnection();
		}
		else throw new NonImplementedException('CreateSchema is not implemented in for this database.');
	}

	private static function RequireConnection(){
		if (is_null(self::$cn)){
			if (is_null(self::$cx)) throw new ApplicationException(Lemma::Pick('MsgNoDatabaseConnectionSpecified'));
			try{
				switch (self::$cx->type){
					case self::MYSQL:
						$a = explode(':',self::$cx->server);
						$charset = Oxygen::GetCharset();
						if ($charset == 'UTF-8') $charset = 'utf8'; elseif ($charset == 'ISO-8859-1') $charset = 'latin1';
						self::$cx->cn = new PDO('mysql:host='.$a[0].(count($a)>1?';port='.$a[1]:'').';dbname='.self::$cx->schema.';charset='.$charset, self::$cx->username, self::$cx->password, array(PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) );
						self::$cn = self::$cx->cn;
						break;
					case self::ORACLE:
						$a = explode(':',self::$cx->server);
						self::$cx->cn = new PDO('oci:dbname=(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST='.$a[0].')(PORT='.(count($a)>1?$a[1]:'1521').')))(CONNECT_DATA=(SERVICE_NAME='.self::$cx->schema.')))',self::$cx->username,self::$cx->password, array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
						self::$cn = self::$cx->cn;
						self::$cn->exec('ALTER SESSION SET NLS_LANGUAGE=\'AMERICAN\' NLS_TERRITORY=\'AMERICA\' NLS_CURRENCY=\'$\' NLS_ISO_CURRENCY=\'AMERICA\' NLS_NUMERIC_CHARACTERS=\'.,\' NLS_CALENDAR=\'GREGORIAN\' NLS_DATE_FORMAT=\'YYYY-MM-DD HH24:MI:SS\' NLS_DATE_LANGUAGE=\'AMERICAN\' NLS_SORT=\'BINARY_CI\'');
						break;
				}
			}
			catch (Exception $ex){
				throw new ApplicationException(Lemma::Pick('MsgCannotConnectToDatabase').'<br/><br/>'. self::$cx->server.'/'.self::$cx->schema. '<br/>'.$ex->getMessage());
			}
			if (self::$cx->is_managed){
				self::Upgrade();
				//Lemma::LoadLocalDictionary();
			}
		}
	}



	/**
	 * @api Since 1.3
	 * @param $server string
	 * @param $schema string
	 * @param $username string
	 * @param $password string
	 * @param string $type int Possible values Database::MYSQL or Database::ORACLE
	 * @return void
	 */
	public static function ConnectManaged($server,$schema,$username,$password,$type=self::MYSQL){
		while(self::IsConnected()) self::Disconnect();
		self::SetConnection( new DatabaseConnection($server,$schema,$username,$password,$type,true) );
		try {
			self::RequireConnection();
		}
		catch (Exception $ex){
			self::PopConnection();
			throw $ex;
		}
		self::ResetCaches();
	}

	/**
	 * @api Since 1.3
	 * @param $server string
	 * @param $schema string
	 * @param $username string
	 * @param $password string
	 * @param string $type int Possible values Database::MYSQL or Database::ORACLE
	 * @return void
	 */
	public static function Connect($server,$schema,$username,$password,$type=self::MYSQL){
		self::PushConnection();
		self::SetConnection( new DatabaseConnection($server,$schema,$username,$password,$type,false) );
		try {
			self::RequireConnection();
		}
		catch (Exception $ex){
			self::PopConnection();
			throw $ex;
		}
		self::ResetCaches();
	}

	public static function ConnectLazily($server,$schema,$username,$password,$type=self::MYSQL){
		self::PushConnection();
		self::SetConnection( new DatabaseConnection($server,$schema,$username,$password,$type,false) );
		self::ResetCaches();
	}

	public static function ConnectLazilyManaged($server,$schema,$username,$password,$type=self::MYSQL){
		while(self::IsConnected()) self::Disconnect();
		self::PushConnection();
		self::SetConnection( new DatabaseConnection($server,$schema,$username,$password,$type,true) );
		self::ResetCaches();
	}



	/**
	 * @api Since 1.3
	 * @return void
	 */
	public static function Disconnect(){
		self::PopConnection();
		self::ResetCaches();
	}
	private static function SetConnection(DatabaseConnection $cx = null){
		if (is_null($cx)){
			self::$cx = null;
			self::$cn = null;
			self::$server = null;
			self::$schema = null;
			self::$type = null;
		}
		else {
			self::$cx = $cx;
			self::$cn = $cx->cn;
			self::$server = $cx->server;
			self::$schema = $cx->schema;
			self::$type = $cx->type;
		}
	}
	private static function PushConnection(){
		if (!is_null(self::$cx)){
			array_push(self::$stack,self::$cx);
			self::$queries = array();
			self::$prepared = array();
			self::$prepared_stats = array();
		}
	}
	private static function PopConnection(){
		self::$queries = array();
		self::$prepared = array();
		self::$prepared_stats = array();
		self::SetConnection( array_pop(self::$stack) );
	}
	private static function ResetCaches(){
		XMeta::SoftResetItemCaches();
		Scope::$DATABASE->SoftReset();
	}

	public static function IsConnected(){ return !is_null(self::$cx); }
	public static function GetServer(){ return self::$server; }
	public static function GetSchema(){ return self::$schema; }
	public static function GetType(){ return self::$type; }





	//
	//
	// Database queries
	//
	//
	public static function GetQueries(){ return self::$queries; }
	public static function GetQueriesAsText(){
		$r = '';
		$i = 0;
		arsort(self::$prepared_stats);
		foreach ( self::$prepared_stats as $q=>$v ) {
			$r .= sprintf('%5d',++$i).'. '. $v . ' -> ' .(false===strstr($q,'?')?'* ':''). $q . "\n";
		}
		if ($r != '') $r .= "\n\n";

		$i = 0;
		foreach ( self::$queries as $q ) {
			$r .=  sprintf('%5d',++$i) . '. ' . $q . "\n";
		}

		if ($r == '') $r .= '-';
		return $r;
	}


	/**
	 * @param string $sql
	 * @return PDOStatement
	 */
	private static function &Prepare(&$sql){
		if (self::$type == self::ORACLE) { $r = self::$cn->prepare($sql); return $r; } // Oracle handles the caching by itself.
		self::$queries[] =& $sql;
		if (!array_key_exists($sql,self::$prepared)) {
			self::$prepared[$sql] = self::$cn->prepare($sql);
			self::$prepared_stats[$sql] = 0;
		}
		self::$prepared_stats[$sql]++;
		return self::$prepared[$sql];
	}



	/**
	 * @param string $sql
	 * @param array $params
	 * @return DBReader
	 */
	public static function ExecuteX($sql,$params=array()){
		self::RequireConnection();
		$q = self::Prepare($sql);
		$z = count($params);
		if ($z > 0){ for($i = 0; $i < $z; $i++) $q->bindValue($i+1, XType::Of($params[$i])->ExportPdoValue( $params[$i] , self::$type ) ); }
		try {
			$q->execute();
		}
		catch (Exception $ex) {
			$m = $ex->getMessage().'<br/><br/>'.$sql;
			foreach ($params as $p) $m .= '<br/>&bull; '.Debug::GetVariableAsString(  XType::Of($p)->ExportPdoValue( $p , self::$type ) );
			throw new Exception($m);
		}
		if ( $q->errorCode() !== '00000' ) {
			$info = $q->errorInfo(); $m = $info[2].'<br/><br/>'.$sql;
			foreach ($params as $p) $m .= '<br/>&bull; '.Debug::GetVariableAsString( XType::Of($p)->ExportPdoValue( $p , self::$type ) );
			throw new Exception($m);
		}
		if ($q->columnCount() > 0) return new DBReader($q);
	}

	/**
	 * @api Since 1.3
	 * @param string $sql ... Pass the rest of the arguments after $sql
	 * @return DBReader
	 */
	public static function Execute($sql){
		self::RequireConnection();
		$q = self::Prepare($sql);
		$z = func_num_args(); if ($z > 1){ $a = func_get_args(); for($i = 1; $i < $z; $i++) $q->bindValue($i, XType::Of($a[$i])->ExportPdoValue($a[$i] , self::$type ) ); }
		try {
			$q->execute();
		}
		catch (Exception $ex) {
			$m = $ex->getMessage().'<br/><br/>'.$sql;
			$z = func_num_args(); $a = func_get_args(); for($i = 1; $i < $z; $i++) $m .= '<br/>&bull; '.Debug::GetVariableAsString( XType::Of($a[$i])->ExportPdoValue($a[$i] , self::$type ) );
			throw new Exception($m);
		}
		if ( $q->errorCode() !== '00000' ) {
			$info = $q->errorInfo(); $m = $info[2].'<br/><br/>'.$sql;
			$z = func_num_args(); $a = func_get_args(); for($i = 1; $i < $z; $i++) $m .= '<br/>&bull; '.Debug::GetVariableAsString( XType::Of($a[$i])->ExportPdoValue($a[$i] , self::$type ) );
			throw new Exception($m);
		}
		if ($q->columnCount() > 0) return new DBReader($q);
	}




	/**
	 * @deprecated Since 1.3
	 * @param XType $type
	 * @param string $sql ... Pass the rest of the arguments after $sql
	 * @return array
	 */
	public static function ExecuteListOf(XType $type,$sql){ return self::ExecuteListOfX($type,$sql,array_slice(func_get_args(),2)); }
	/**
	 * @deprecated Since 1.3
	 * @param string $sql
	 * @param XType $type
	 * @param array $params
	 * @return array
	 */
	public static function ExecuteListOfX(XType $type,$sql,$params=array()){
		$dr = self::ExecuteX($sql,$params);
		$r = array();
		while ($dr->Read())	$r[] = $dr[0]->CastTo($type);
		$dr->Close();
		return $r;
	}



	/**
	 * @api
	 * @param XType $type
	 * @param string $sql ... Pass the rest of the arguments after $sql
	 * @return array
	 */
	public static function ExecuteColumnOf(XType $type, $sql){ return self::ExecuteColumnOfX($type,$sql,array_slice(func_get_args(),1)); }
	/**
	 * @param string $sql
	 * @param XType $type
	 * @param array $params
	 * @return array
	 */
	public static function ExecuteColumnOfX(XType $type, $sql,$params=array()){
		$dr = self::ExecuteX($sql,$params);
		$r = array();
		while ($dr->Read())	$r[] = $dr[0]->CastTo($type);
		$dr->Close();
		return $r;
	}



	/**
	 * @api
	 * @param string $sql ... Pass the rest of the arguments after $sql
	 * @return DBValue
	 */
	public static function ExecuteScalar($sql){ return self::ExecuteScalarX($sql,array_slice(func_get_args(),1)); }
	/**
	 * @param string $sql
	 * @param array $params
	 * @return DBValue
	 */
	public static function ExecuteScalarX($sql,$params=array()){
		$dr = self::ExecuteX($sql,$params);
		$r = $dr->Read() ? $dr[0] : new DBValue(null);
		$dr->Close();
		return $r;
	}





	//
	//
	// Database patching system
	//
	//
	private static $patching_system_name = null;
	private static $patching_system_tablename = null;
	private static $patching_system_fieldnames = array();
	private static $patches = array();
	private static $patching_system_dirty = false;
	private static $patching_system_open_patcher = null;
	private static $patching_system_open_patch = null;
	public static function ClearPatchingSystem(){
		self::$patching_system_name = null;
		self::$patching_system_tablename = null;
		self::$patching_system_fieldnames = array();
		self::$patching_system_dirty = false;
		self::$patching_system_open_patcher = null;
		self::$patching_system_open_patch = null;
		self::$patches = array();
	}
	public static function IsPatchingSystemDirty(){
		return self::$patching_system_dirty;
	}
	public static function SetPatchingSystem($name,$tablename){
		self::ClearPatchingSystem();
		self::$patching_system_name = $name;
		self::$patching_system_tablename = $tablename;
	}
	public static function AddPatcher($patcher,$fieldname){
		self::$patching_system_fieldnames[$patcher] = $fieldname;
		self::$patches[$patcher] = null;
	}
	public static function GetPatch($patcher){
		$r = self::$patches[$patcher];
		if (is_null($r)){
			try{
				$r = self::ExecuteScalar('SELECT '.self::$patching_system_fieldnames[$patcher].' FROM '.self::$patching_system_tablename)->AsInteger();
				self::$patches[$patcher] = $r;
			}
			catch (Exception $ex){}
		}
		return $r;
	}
	public static function SetPatch($patcher,$patch){
		self::ExecuteUpdateAll(self::$patching_system_tablename,self::$patching_system_fieldnames[$patcher],$patch);
		self::$patches[$patcher] = $patch;
	}
	public static function BeginPatchingSystem(){
		try{
			$r = 1!=self::ExecuteScalar('SELECT COUNT(*) FROM '.self::$patching_system_tablename)->AsInteger();
		}
		catch (Exception $ex){
			$r = true;
		}
		if ($r){
			self::$patching_system_dirty = true;
			Debug::EnableImmediateFlushing();
			Debug::Write('<b>Installing module &lsaquo;'.self::$patching_system_name.'&rsaquo; in database '.Database::GetSchema().'@'.Database::GetServer().'.</b>');
		}
		return $r;
	}
	public static function BeginPatch($patcher,$patch,$description=null){
		$current = self::GetPatch($patcher);
		if (is_null($current) || $current < $patch) {
			if (!self::IsPatchingSystemDirty()){
				self::$patching_system_dirty = true;
				Debug::EnableImmediateFlushing();
				Debug::Write('<b>Upgrading module &lsaquo;'.self::$patching_system_name.'&rsaquo; in database '.Database::GetSchema().'@'.Database::GetServer().'.</b>');
			}
			if (is_null($description))
				Debug::Write('Applying patch {'.$patcher.':'.$patch.'}...');
			else
				Debug::Write('Applying patch {'.$patcher.':'.$patch.'}: '.$description.'...');
			self::$patching_system_open_patcher = $patcher;
			self::$patching_system_open_patch = $patch;
			return true;
		}
		return false;
	}
	public static function ApplyPatch(){
		self::SetPatch(self::$patching_system_open_patcher,self::$patching_system_open_patch);
		Debug::Write('Patch {'.self::$patching_system_open_patcher.':'.self::$patching_system_open_patch.'} applied.');
		self::$patching_system_open_patcher = null;
		self::$patching_system_open_patch = null;
	}





	//
	//
	// Advanced
	//
	//
	/**
	 * @api Since 1.3
	 * @param string $tablename ... Pass the rest of the parameters as strings in name-value pairs
	 * @return void
	 */
	public static function ExecuteInsert($tablename){
		$a = func_get_args();
		$z = func_num_args();
		$sql = 'INSERT INTO '.$tablename.' (';
		for($i=1;$i<$z;$i+=2){
			if ($i>1) $sql.=',';
			$sql.=$a[$i];
		}
		$sql.=') VALUES (';
		for($i=1;$i<$z;$i+=2){
			if ($i>1) $sql.=',';
			$sql.=new Sql($a[$i+1]);
		}
		$sql.=')';
		self::Execute($sql);
	}

	/**
	 * ExecuteInsertNext( 'table_name' [ , 'field_name_1' , $field_value_1 [ , ... ] ] )
	 * ExecuteInsertNext( 'table_name' , 'primary_key_name' [ , 'field_name_1' , $field_value_1 [ , ... ] ] )
	 * @param $tablename
	 * @return ID
	 */
	public static function ExecuteInsertNext($tablename){
		$a = func_get_args();
		$z = func_num_args();
		$primarykey = $z%2 == 1 ? 'id' : $a[1];
		$id = self::ExecuteGetNextID($tablename,$primarykey);
		$sql = 'INSERT INTO '.$tablename.' ('.$primarykey;
		for($i=2-$z%2;$i<$z;$i+=2)
			$sql.=','.$a[$i];
		$sql.=') VALUES ('.new Sql($id);
		for($i=2-$z%2;$i<$z;$i+=2){
			$sql.=','.new Sql($a[$i+1]);
		}
		$sql.=')';
		self::Execute($sql);
		return $id;
	}

	/**
	 * @api Since 1.3
	 * @param string $tablename ... Pass the rest of the parameters as strings in name-value pairs
	 * @return void
	 */
	public static function ExecuteUpdateAll($tablename){
		$a = func_get_args();
		$z = func_num_args();
		$sql = 'UPDATE '.$tablename.' SET ';
		for($i=1;$i<$z;$i+=2){
			if ($i>1) $sql.=',';
			$sql.=$a[$i] .'='. new Sql($a[$i+1]);
		}
		self::Execute($sql);
	}
	/**
	 * @api Since 1.3
	 * @param string $tablename
	 * @param string $where ... Pass the rest of the parameters as strings in name-value pairs
	 * @return void
	 */
	public static function ExecuteUpdate($tablename,$where){
		$a = func_get_args();
		$z = func_num_args();
		$sql = 'UPDATE '.new SqlName($tablename).' SET ';
		for($i=2;$i<$z;$i+=2){
			if ($i>2) $sql.=',';
			$sql.=$a[$i] .'='. new Sql($a[$i+1]);
		}
		if (!is_null($where)) $sql .=' WHERE '.$where;
		self::Execute($sql);
	}

	public static function ExecuteDropTable($tablename) {
		$sql = 'DROP TABLE IF EXISTS '.new SqlName($tablename);
		self::Execute($sql);
	}



	public static function ExecuteCreateTable($tablename){
		$a = func_get_args();
		$z = func_num_args();
		$sql = 'CREATE TABLE '.$tablename.' (';
		for($i=1;$i<$z;$i+=2){
			if ($i>1) $sql.=',';
			$sql.=$a[$i].' '.$a[$i+1];
		}
		$sql.=') ENGINE=INNODB';
		self::Execute($sql);
	}

	public static function ExecuteCreateStandardTable($tablename){
		$a = func_get_args();
		$z = func_num_args();
		$sql = 'CREATE TABLE '.new SqlName($tablename).' (id '.Sql::ID.' NOT NULL';
		for($i=1;$i<$z;$i+=2){
			$sql.=','.$a[$i].' '.$a[$i+1];
		}
		$sql .= ',PRIMARY KEY ( id )';
		$sql.=') ENGINE=INNODB';
		self::Execute($sql);
	}

	public static function ExecuteAddPrimaryKey($tablename){
		$a = func_get_args();
		$z = func_num_args();
		$sql = 'ALTER TABLE '.new SqlName($tablename).' ADD PRIMARY KEY(';
		for($i=1;$i<$z;$i+=2){
			if ($i>1) $sql .= ',';
			$sql.=new SqlName($a[$i]);
		}
		$sql.=')';
		self::Execute($sql);
	}
	public static function ExecuteAddIndices($tablename){
		$a = func_get_args();
		$z = func_num_args();
		for($i=1;$i<$z;$i+=2){
			$sql='ALTER TABLE '.new SqlName($tablename).' ADD INDEX ('.new SqlName($a[$i]).')';
			self::Execute($sql);
		}
	}

	public static function ExecuteDropFields($tablename){
		$a = func_get_args();
		$z = func_num_args();
		for($i=1;$i<$z;$i++){
			$sql = 'ALTER TABLE '.$tablename.' DROP COLUMN '.$a[$i];
			self::Execute($sql);
		}
	}
	public static function ExecuteAddFields($tablename){
		$a = func_get_args();
		$z = func_num_args();
		for($i=1;$i<$z;$i+=2){
			$sql = 'ALTER TABLE '.$tablename.' ADD COLUMN '.$a[$i].' '.$a[$i+1];
			self::Execute($sql);
		}
	}

	public static function ExecuteRenameFields($tablename){
		$a = func_get_args();
		$z = func_num_args();
		for($i=1;$i<$z;$i+=3){
			$sql = 'ALTER TABLE '.new SqlName($tablename).' CHANGE '.new SqlName($a[$i]).' '.new SqlName($a[$i+1]).' '.$a[$i+2];
			self::Execute($sql);
		}
	}
	public static function ExecuteRecastFields($tablename){
		$a = func_get_args();
		$z = func_num_args();
		for($i=1;$i<$z;$i+=2){
			$sql = 'ALTER TABLE '.new SqlName($tablename).' MODIFY COLUMN '.new SqlName($a[$i]).' '.$a[$i+1];
			self::Execute($sql);
		}
	}

	public static function ExecuteRenameTable($tablename, $newName){
		$sql = 'RENAME TABLE '.new SqlName($tablename).' TO '.new SqlName($newName);
		self::Execute($sql);
	}


	/**
	 * @api Since 1.3
	 * @param string $tablename
	 * @return void
	 */
	public static function ExecuteDeleteAll($tablename){
		$sql = 'DELETE FROM '.new SqlName($tablename);
		self::Execute($sql);
	}
	/**
	 * @api Since 1.3
	 * @param string $tablename
	 * @param string $where
	 * @return void
	 */
	public static function ExecuteDelete($tablename, $where){
		$sql = 'DELETE FROM '.new SqlName($tablename).' WHERE '.$where;
		self::Execute($sql);
	}

	/** @return ID */
	public static function ExecuteGetNextID($table_or_sequence_name,$primarykey='id') {
		switch (self::$type){
			case self::MYSQL:
				$tablename = $table_or_sequence_name;
				self::Execute('LOCK TABLES oxy_ids WRITE,'.$tablename.' WRITE');
				$id = self::ExecuteScalar('SELECT LastID FROM oxy_ids WHERE TableName=?',$tablename)->AsID();
				if (is_null($id)){
					$id = self::ExecuteScalar('SELECT MAX('.$primarykey.') FROM '.$tablename)->AsID();
					$id = is_null($id) ? new ID(0) : new ID($id->AsInt() + 1);
					self::Execute('INSERT INTO oxy_ids (TableName,LastID) VALUES (?,?)',$tablename,$id);
				}
				else {
					$id = new ID($id->AsInt() + 1);
					self::Execute('UPDATE oxy_ids SET LastID=? WHERE TableName=?',$id,$tablename);
				}
				self::Execute('UNLOCK TABLES');
				return $id;
			case self::ORACLE:
				$seq = $table_or_sequence_name;
				return self::ExecuteScalar('SELECT '.new SqlName($seq).'.NEXTVAL A FROM DUAL')->AsID();
		}
	}



	public static function ExecuteAddForeignKeys($tablename){
		$a = func_get_args();
		$z = func_num_args();
		for($i=1;$i<$z;$i+=2){
			$sql='ALTER TABLE '.new SqlName($tablename).' ADD INDEX ('.new SqlName($a[$i]).')';
			self::Execute($sql);
			$sql='ALTER TABLE '.new SqlName($tablename).' ADD FOREIGN KEY ('.new SqlName($a[$i]).') REFERENCES '.new SqlName($a[$i+1]).' (id)';
			self::Execute($sql);
		}
	}
	public static function ExecuteAddForeignKeysWithAltTarget($tablename){
		$a = func_get_args();
		$z = func_num_args();
		for($i=1;$i<$z;$i+=3){
			$sql='ALTER TABLE '.new SqlName($tablename).' ADD INDEX ('.new SqlName($a[$i]).')';
			self::Execute($sql);
			$sql='ALTER TABLE '.new SqlName($tablename).' ADD FOREIGN KEY ('.new SqlName($a[$i]).') REFERENCES '.new SqlName($a[$i+1]).' ('.new SqlName($a[$i+2]).')';
			self::Execute($sql);
		}
	}
	public static function ExecuteDropForeignKeys($tablename){
		$a = func_get_args();
		$z = func_num_args();
		for($i=1;$i<$z;$i++){
			self::Execute('ALTER TABLE '.new SqlName($tablename).' DROP FOREIGN KEY '.new SqlName($a[$i]));
		}
	}
	public static function ExecuteDropIndices($tablename){
		$a = func_get_args();
		$z = func_num_args();
		for($i=1;$i<$z;$i++){
			self::Execute('ALTER TABLE '.new SqlName($tablename).' DROP INDEX '.new SqlName($a[$i]));
		}
	}

	public static function ExecuteSqlFile($filename) {
		self::RequireConnection();
		$queries=array();
		$queries[0]='';
		$sql=file($filename); // on charge le fichier SQL
		$numRequete=0;
		$nb_cotes=0;
		foreach($sql as $l){ // on le lit
			if (substr(trim($l),0,2)!="--"){ // suppression des commentaires
				$queries[$numRequete] .= $l;
				$li=str_replace("'","", $l);
				$nb_cotes+=substr_count ($li, "'");
			}
			if (substr(trim($l), -1, 1)==";" && ($nb_cotes%2)==0) { // Fin de la requete
				$numRequete++;
				$queries[$numRequete]='';
			}
		}

		foreach($queries as $req){	// et on les �x�cute
			if (trim($req)!=""){
				self::$cn->exec($req);
				if ( self::$cn->errorCode() !== '00000' ) { $info = self::$cn->errorInfo(); throw new Exception($info[2] . '<br/><br/>'.$sql); }
			}
		}
	}


	public static function TransactionBegin(){
		self::RequireConnection();
		self::$cn->beginTransaction();
	}
	public static function TransactionCommit(){
		self::RequireConnection();
		self::$cn->commit();
	}
	public static function TransactionRollback(){
		self::RequireConnection();
		self::$cn->rollBack();
	}
}


<?php

class SqlName extends ExportConverter {
	private static function escape($value){
		switch (Database::GetType()) {
			default:
			case Database::MYSQL:   return str_replace(array( "`"  ,"/" ,"\\" ,"." ),array( "``" ,""  ,""   ,""  ),$value);
			case Database::ORACLE:  return str_replace('"','""',$value);
		}
	}

	private static function wrap($value){
		switch (Database::GetType()) {
			default:
			case Database::MYSQL:  return "`".$value."`";
      case Database::ORACLE: return '"'.$value.'"';
		}
	}


	public function Export(){

		if ($this->value instanceof XField)
			$r = $this->value->GetDBName();

		elseif ($this->value instanceof XWrapField)
			$r = $this->value->GetField()->GetDBName();

		elseif (is_string($this->value))
			$r = $this->value;

		else
			$r = strval($this->value);

		$r = self::escape($r);
		$r = self::wrap($r);
		return $r;
	}


}




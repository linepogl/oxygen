<?php

class Sql extends ExportConverter {
	private static function escape($value){
		switch (Database::GetType()) {
			default:
			case Database::MYSQL:   return str_replace('\'','\\\'',str_replace('\\','\\\\',$value));
			case Database::ORACLE:  return str_replace('\'','\'\'',$value);
		}
	}
	public function Export(){
		if ( is_null($this->value) ) {
			$r = 'NULL';
			return $r;
		}

		if ( is_string($this->value) ) {
				$r = "'".self::escape($this->value)."'";
				return $r;
			}

		if ( is_bool($this->value) ) {
			$r = $this->value ? '1' : '0';
			return $r;
		}

		if ( is_int($this->value) ) {
			$r = sprintf('%d',$this->value);
			return $r;
		}

		if ( is_float($this->value) ) {
			$r = sprintf('%F',$this->value);
			return $r;
		}

		if ( $this->value instanceof ID ) {
			$r = strval( $this->value->AsInt() );
			return $r;
		}


    if ($this->value instanceof DateTime)
    	$this->value = new XDateTime($this->value);
		if ( $this->value instanceof XDateTime ) {

			switch (Database::GetType()) {
				default:
				case Database::MYSQL: $r = "'" . $this->value->Format('Y-m-d H:i:s') . "'"; return $r;
				case Database::ORACLE: $r = "'" . $this->value->Format('Y-m-d H:i:s') . "'"; return $r;
			}
		}

//    if ($this->value instanceof DateInterval)
//    	$this->value = new XTimeSpan($this->value);
		if ( $this->value instanceof XTimeSpan ) {
			$r = strval($this->value->GetTotalMilliseconds());
			return $r;
		}



		if ( $this->value instanceof Lemma ) {
			$r = "'".self::escape($this->value->Encode())."'";
			return $r;
		}
		if ($this->value instanceof XItem) {
			$r = strval( $this->value->id->AsInt() );
			return $r;
		}

		if ($this->value instanceof XList){
			$r = '';
			foreach ($this->value->ToIDList() as $id) { if ($r!='') $r .= ','; $r .= strval( $id->AsInt() ); }
			$r = $r=='' ? '(-11111111)' : '('.$r.')';
			return $r;
		}
		if (is_array( $this->value ) || $this->value instanceof Traversable ){
			$r = '';
			foreach (from($this->value) as $s) { if ($r!='') $r .= ','; $r .= new Sql($s); }
			$r = $r=='' ? '(-11111111)' : '('.$r.')';
			return $r;
		}

		$r = "'".self::escape(strval($this->value))."'";
		return $r;
	}


	public static function GetPDOValueStatic(&$value){
		if (is_bool($value)) { $r = $value ? 1 : 0; return $r; }
		if ($value instanceof ID) { $r = $value->AsInt(); return $r; }
		if ($value instanceof XItem) { $r = $value->id->AsInt(); return $r; }
    if ($value instanceof DateTime) $value = new XDateTime($value);
		if ($value instanceof XDateTime) { $r = $value->Format('Y-m-d H:i:s'); return $r; }
    //if ($value instanceof DateInterval) $value = new XTimeSpan($value);
		if ($value instanceof XTimeSpan) { $r = $value->GetTotalMilliseconds(); return $r; }
		if ($value instanceof Lemma) { $r = $value->Encode(); return $r; }
		return $value;
	}
	public function GetPDOValue(){
		return self::GetPDOValueStatic($this->value);
	}



	const ID = 'INT';
	const Integer = 'INT';
	const Boolean = 'TINYINT';
	const DateTime = 'DATETIME';
	const Time = 'DATETIME';
	const TimeSpan = 'INT';
	const String20 = 'VARCHAR(20)';
	const String100 = 'VARCHAR(100)';
	const String255 = 'VARCHAR(255)';
	const Decimal_18_5 = 'DECIMAL(18,5)';
	const Text = 'TEXT';
}



?>

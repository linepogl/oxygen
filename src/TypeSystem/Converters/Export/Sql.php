<?php

class Sql extends ExportConverter {

	public function Export(){
		try{
			return $this->type->ExportSqlLiteral($this->value,Database::GetType());
		}
		catch (Exception $ex){
			return '';
		}
	}

	const Null = 'NULL';

	const ID           = 1;
	const Integer      = 2;
	const Decimal_18_5 = 3;
	const Boolean      = 4;
	const DateTime     = 5;
	const Time         = 6;
	const TimeSpan     = 7;
	const String20     = 8;
	const String100    = 9;
	const String255    = 10;
	const Text         = 11;

	private static $data_types = array(
		Database::MYSQL => array (
			Sql::ID => 'INT',
			Sql::Integer => 'INT',
			Sql::Boolean => 'TINYINT',
			Sql::DateTime => 'DATETIME',
			Sql::Time => 'DATETIME',
			Sql::TimeSpan => 'INT',
			Sql::String20 => 'VARCHAR(20)',
			Sql::String100 => 'VARCHAR(100)',
			Sql::String255 => 'VARCHAR(255)',
			Sql::Decimal_18_5 => 'DECIMAL(18,5)',
			Sql::Text => 'TEXT'
			),
		Database::ORACLE => array (
			Sql::ID => 'INT',
			Sql::Integer => 'INT',
			Sql::Boolean => 'NUMBER(3)',
			Sql::DateTime => 'DATE',
			Sql::Time => 'DATE',
			Sql::TimeSpan => 'INT',
			Sql::String20 => 'VARCHAR2(20)',
			Sql::String100 => 'VARCHAR2(100)',
			Sql::String255 => 'VARCHAR2(255)',
			Sql::Decimal_18_5 => 'DECIMAL(18,5)',
			Sql::Text => 'VARCHAR2(4000)'
			),
		);
	public static function GetDataType( $database_type , $sql_type_number ) {
		return self::$data_types[$database_type][$sql_type_number];
	}

}




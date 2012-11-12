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

	const ID            = 1;
	const Integer       = 2;
	const Decimal_18_5  = 3;
	const Decimal_38_5  = 4;
	const Decimal_38_20 = 5;
	const Boolean       = 6;
	const DateTime      = 7;
	const Time          = 8;
	const TimeSpan      = 9;
	const String20      = 10;
	const String100     = 11;
	const String255     = 12;
	const Text          = 13;

	private static $data_types = array(
		Database::MYSQL => array (
			Sql::ID => 'INT',
			Sql::Integer => 'INT',
			Sql::Boolean => 'TINYINT',
			Sql::DateTime => 'DATETIME',
			Sql::Time => 'DATETIME',
			Sql::TimeSpan => 'DECIMAL(15,6)',
			Sql::String20 => 'VARCHAR(20)',
			Sql::String100 => 'VARCHAR(100)',
			Sql::String255 => 'VARCHAR(255)',
			Sql::Decimal_18_5 => 'DECIMAL(18,5)',
			Sql::Decimal_38_5 => 'DECIMAL(38,5)',
			Sql::Decimal_38_20 => 'DECIMAL(38,20)',
			Sql::Text => 'TEXT'
			),
		Database::ORACLE => array (
			Sql::ID => 'INT',
			Sql::Integer => 'INT',
			Sql::Boolean => 'NUMBER(3)',
			Sql::DateTime => 'DATE',
			Sql::Time => 'DATE',
			Sql::TimeSpan => 'DECIMAL(15,6)',
			Sql::String20 => 'VARCHAR2(20)',
			Sql::String100 => 'VARCHAR2(100)',
			Sql::String255 => 'VARCHAR2(255)',
			Sql::Decimal_18_5 => 'DECIMAL(18,5)',
			Sql::Decimal_38_5 => 'DECIMAL(38,5)',
			Sql::Decimal_38_20 => 'DECIMAL(38,20)',
			Sql::Text => 'VARCHAR2(4000)'
			),
		);
	public static function GetDataType( $database_type , $sql_type_number ) {
		return self::$data_types[$database_type][$sql_type_number];
	}

}




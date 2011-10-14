<?php

class Sql extends ExportConverter {

	public function Export(){
		return $this->omnitype->ExportSqlLiteral($this->value,Database::GetType());
	}

	const Null = 'NULL';

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



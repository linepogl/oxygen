<?php

class SqlIden extends ExportConverter {

	public function Export(){
		return $this->type->ExportSqlIdentifier($this->value,Database::GetType());
	}


}




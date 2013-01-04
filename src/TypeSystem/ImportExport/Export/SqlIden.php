<?php

class SqlIden extends ExportValue {

	public function Export(){
		return $this->type->ExportSqlIdentifier($this->value,Database::GetType());
	}
	public function MetaType(){
		return MetaSqlIden::Type();
	}


}




<?php

class SqlName extends ExportConverter {

	public function Export(){
		return $this->omnitype->ExportSqlIdentifier($this->value,Database::GetType());
	}


}




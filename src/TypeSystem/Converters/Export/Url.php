<?php


final class Url extends ExportConverter {

	public function Export(){
		return $this->type->ExportUrlString($this->value);
	}



}





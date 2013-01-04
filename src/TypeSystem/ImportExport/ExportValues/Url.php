<?php


final class Url extends ExportValue {

	public function Export(){
		return $this->type->ExportUrlString($this->value);
	}

	public function MetaType(){
		return MetaUrl::Type();
	}

}





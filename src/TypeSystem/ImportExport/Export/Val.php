<?php


final class Val extends ExportValue {

	public function Export(){
		return $this->type->ExportValString($this->value);
	}

	public function MetaType(){
		return MetaVal::Type();
	}

}





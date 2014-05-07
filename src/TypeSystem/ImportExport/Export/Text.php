<?php


class Text extends ExportValue {

	public function Export(){
		return $this->type->ExportTextString($this->value);
	}

	public function MetaType(){
		return MetaText::Type();
	}


}





<?php


class Html extends ExportValue {

	public function Export(){
		return $this->type->ExportHtmlString($this->value);
	}

	public function MetaType(){
		return MetaHtml::Type();
	}
	const DOCTYPE = '<!DOCTYPE html>';


}





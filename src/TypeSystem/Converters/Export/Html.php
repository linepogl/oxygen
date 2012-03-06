<?php


final class Html extends ExportConverter {

	public function Export(){
		return $this->type->ExportHtmlString($this->value);
	}

}





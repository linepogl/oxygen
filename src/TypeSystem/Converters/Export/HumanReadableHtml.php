<?php


final class HumanReadableHtml extends ExportConverter {

	public function Export(){
		return $this->type->ExportHumanReadableHtmlString($this->value);
	}


}





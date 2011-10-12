<?php


final class Url extends ExportConverter {

	public function Export(){
		return $this->omnitype->ExportUrlString($this->value);
	}



}





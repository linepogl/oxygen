<?php


class XmlAttr extends ExportConverter {

	public function Export(){
		return str_replace(array("\n","\r","\t"),array('&#10;','&#13;','&#9;'),$this->type->ExportXmlString($this->value));
	}


}



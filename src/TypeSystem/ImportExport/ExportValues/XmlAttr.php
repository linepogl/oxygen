<?php


class XmlAttr extends Xml {

	public function Export(){
		return $this->type->ExportXmlString($this->value,true);
	}


}



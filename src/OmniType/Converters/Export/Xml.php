<?php


class Xml extends ExportConverter {

	public function Export(){
		return $this->omnitype->ExportXmlString($this->value);
	}


	const Attribute = 1;
	const Element = 2;

	const NS = 'http://www.w3.org/2000/xmlns/';
	const XS = 'http://www.w3.org/2001/XMLSchema';




}





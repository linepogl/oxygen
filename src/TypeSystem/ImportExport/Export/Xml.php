<?php


class Xml extends ExportValue {

	public function Export(){
		return $this->type->ExportXmlString($this->value);
	}

	public function MetaType(){
		return MetaXml::Type();
	}


	const Attribute = 1;
	const Element = 2;

	const HEADER = '<?xml version="1.0" encoding="UTF-8"?>';
	const NS = 'http://www.w3.org/2000/xmlns/';
	const XS = 'http://www.w3.org/2001/XMLSchema';




}



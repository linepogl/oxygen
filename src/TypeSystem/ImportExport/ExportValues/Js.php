<?php

final class Js extends ExportValue {

	public function Export(){
		return $this->type->ExportJsLiteral($this->value);
	}

	public function MetaType(){
		return MetaJs::Type();
	}

	const Null = 'null';

	const BEGIN = "<script type=\"text/javascript\">\n/*<![CDATA[*/\n";
	const END = "\n/*]]>*/\n</script>";

}





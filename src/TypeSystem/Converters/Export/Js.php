<?php

final class Js extends ExportConverter {

	public function Export(){
		return $this->type->ExportJsLiteral($this->value);
	}

	const Null = 'null';

	const BEGIN = "<script type=\"text/javascript\">\n/*<![CDATA[*/\n";
	const END = "\n/*]]>*/\n</script>";

}





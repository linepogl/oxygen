<?php


final class Url extends ExportValue {

	public function Export(){
		return $this->type->ExportUrlString($this->value);
	}

	public function MetaType(){
		return MetaUrl::Type();
	}

	public static function AppendParams($url,$params) {
		$r = $url;
		$i = 0;
		foreach ($params as $key => $value)
			$r .= ($i++===0 || strpos($url,'?')<0 ? '?' : '&') . new Url($key) . '=' . new Url($value);
		return $r;
	}
}





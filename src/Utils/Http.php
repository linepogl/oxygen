<?php

abstract class Http implements ArrayAccess, IteratorAggregate {
	/** @var HttpPost */ public static $POST;
	/** @var HttpGet  */ public static $GET;
	/** @var HttpAny  */ public static $ANY;
  public final function offsetSet($offset, $value) {	throw new Exception('Http arrays are readonly.'); }
	public final function offsetUnset($offset) { throw new Exception('Http arrays are readonly.'); }

	/** @return HttpValue */ public static function Read($nane){ return Http::$ANY[$nane]; }
}

final class HttpPost extends Http {
	public final function offsetExists($offset) { return isset($_POST[$offset]); }
	/** @return HttpValue */ public function offsetGet($offset) { return isset($_POST[$offset]) ? new HttpValue($this->url_encode($_POST[$offset])) : new HttpValue(null); }
	private function url_encode($post_value){
		if (is_array($post_value)){
			$a = array();
			foreach ($post_value as $x)
				$a[] = rawurlencode($x);
			return $a;
		}
		else
			return rawurlencode($post_value);
	}
	public function getIterator(){
		$r = array();
		foreach (array_keys($_POST) as $key)
			$r[$key] = $this[$key];
		return new ArrayIterator($r);
	}
}
final class HttpGet extends Http {
	public final function offsetExists($offset) { return isset($_GET[$offset]); }
	/** @return HttpValue */ public function offsetGet($offset) { return isset($_GET[$offset]) ? new HttpValue($_GET[$offset]) : new HttpValue(null); }
	public function getIterator(){
		$r = array();
		foreach (array_keys($_GET) as $key)
			$r[$key] = $this[$key];
		return new ArrayIterator($r);
	}
}
final class HttpAny extends Http {
	public final function offsetExists($offset) { return isset($_GET[$offset]) || isset($_POST[$offset]); }
	/** @return HttpValue */ public function offsetGet($offset) {
		$a = Http::$GET[$offset]->AsStringOrNull();
		$b = Http::$POST[$offset]->AsStringOrNull();
		$v = null; if (!is_null($a) && !is_null($b)) $v = $a.','.$b;	elseif (!is_null($a)) $v = $a; elseif (!is_null($b)) $v = $b;
		return new HttpValue($v);
	}
	public function getIterator(){
		$r = array();
		foreach (array_unique(array_merge(array_keys($_GET),array_keys($_POST))) as $key)
			$r[$key] = $this[$key];
		return new ArrayIterator($r);
	}
}
Http::$POST = new HttpPost();
Http::$GET = new HttpGet();
Http::$ANY = new HttpAny();

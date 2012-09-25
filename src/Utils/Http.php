<?php

abstract class Http implements ArrayAccess, IteratorAggregate {
	/** @var HttpPost */ public static $POST;
	/** @var HttpGet  */ public static $GET;
	/** @var HttpAny  */ public static $ANY;
  public final function OffsetSet($offset, $value) {	throw new Exception('Http arrays are readonly.'); }
	public final function OffsetUnset($offset) { throw new Exception('Http arrays are readonly.'); }

	/** @return HttpValue */ public static function Read($nane){ return Http::$ANY[$nane]; }



	public static function RequestAsync($url,$method='GET',$args = array()){
		$post_args = array();
    foreach ($args as $key => &$val) {
      $post_params[] = $key.'='.new Url($val);
    }
    $post_string = implode('&', $post_args);

		$method = strtoupper($method);

    $parts = parse_url($url);
		$host = $parts['host'];
		$port = isset($parts['port'])?$parts['port']:80;
		$path = $parts['path'];
    $length = strlen($post_string);
		$query = isset($parts['query'])?$parts['query']:'';

		if ($method == 'GET') {
			if (!empty($query)) $query .= '&';
			$query .= $post_string;
		}
		if (!empty($query)) {
			$path .= '?' . $query;
		}

		$fp = fsockopen($host,$port,$errno,$errstr,30);
    $out = "$method $path HTTP/1.1\r\n";
    $out.= "Host: $host\r\n";
    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
    $out.= "Content-Length: $length\r\n";
    $out.= "Connection: Close\r\n\r\n";

    if ($method == 'POST') $out.= $post_string;

    fwrite($fp, $out);
    fclose($fp);
  }
}

final class HttpPost extends Http {
	public final function OffsetExists($offset) { return isset($_POST[$offset]); }
	/** @return HttpValue */ public function OffsetGet($offset) { return isset($_POST[$offset]) ? new HttpValue($this->url_encode($_POST[$offset])) : new HttpValue(null); }
	private function url_encode($post_value){
		if (is_array($post_value)){
			$a = array();
			foreach ($post_value as $key=>$x)
				$a[$key] = rawurlencode($x);
			return $a;
		}
		else
			return rawurlencode($post_value);
	}
	public function GetIterator(){
		$r = array();
		foreach (array_keys($_POST) as $key)
			$r[$key] = $this[$key];
		return new ArrayIterator($r);
	}
	/** @return HttpValue */ public static function Read($nane){ return Http::$GET[$nane]; }
}
final class HttpGet extends Http {
	public final function OffsetExists($offset) { return isset($_GET[$offset]); }
	/** @return HttpValue */ public function OffsetGet($offset) { return isset($_GET[$offset]) ? new HttpValue($_GET[$offset]) : new HttpValue(null); }
	public function GetIterator(){
		$r = array();
		foreach (array_keys($_GET) as $key)
			$r[$key] = $this[$key];
		return new ArrayIterator($r);
	}
	/** @return HttpValue */ public static function Read($nane){ return Http::$GET[$nane]; }
}
final class HttpAny extends Http {
	public final function OffsetExists($offset) { return isset($_GET[$offset]) || isset($_POST[$offset]); }
	/** @return HttpValue */ public function OffsetGet($offset) {
		$a = Http::$GET[$offset]->AsStringOrNull();
		$b = Http::$POST[$offset]->AsStringOrNull();
		$v = null; if (!is_null($a) && !is_null($b)) $v = $a.','.$b;	elseif (!is_null($a)) $v = $a; elseif (!is_null($b)) $v = $b;
		return new HttpValue($v);
	}
	public function GetIterator(){
		$r = array();
		foreach (array_unique(array_merge(array_keys($_GET),array_keys($_POST))) as $key)
			$r[$key] = $this[$key];
		return new ArrayIterator($r);
	}
}
Http::$POST = new HttpPost();
Http::$GET = new HttpGet();
Http::$ANY = new HttpAny();

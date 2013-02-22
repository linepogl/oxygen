<?php

abstract class Http implements ArrayAccess, IteratorAggregate {
	/** @var HttpPost */ public static $POST;
	/** @var HttpGet  */ public static $GET;
	/** @var HttpAny  */ public static $ANY;
  public final function OffsetSet($offset, $value) {	throw new Exception('Http arrays are readonly.'); }
	public final function OffsetUnset($offset) { throw new Exception('Http arrays are readonly.'); }

	/** @return HttpValue */ public static function Read($nane){ return Http::$ANY[$nane]; }


	private static function prepare_request( &$url , &$method , $args){
		$method = strtoupper($method);
		$post_args = array();
    foreach ($args as $key => &$val) $post_args[] = new Url($key).'='.new Url($val);
    $extra_string = implode('&', $post_args);
		$parts = parse_url($url);
		$query_string = isset($parts['query'])?$parts['query']:'';
		if ($method == 'GET' && !empty($extra_string)) $url .= (empty($query_string) ? '?' : '&') . $extra_string;
		$options = array('http'=>array('method'=>$method
			,'protocol_version' => '1.1'
			,'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17'
			,'header' => "Cache-Control: max-age=0\r\n"
			));
		if ($method === 'POST') {
			$options['http']['header'] .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$options['http']['content'] = $extra_string;
		}
		return stream_context_create($options);
	}
	public static function Call($url,$method='GET',$args = array()){
		$ctx = self::prepare_request($url,$method,$args);
		return file_get_contents($url,false,$ctx);
  }
	public static function Download($url,$filename,$method='GET',$args = array()){
		$ctx = self::prepare_request($url,$method,$args);
		$f_src = fopen($url,'rb',false,$ctx);
		$f_dst = fopen($filename,'wb');
		while (!feof($f_src)) {
			$data = fread($f_src,1024*1024);
			if ($data === false) break;
			fwrite($f_dst,$data);
		}
		fclose($f_src);
		fclose($f_dst);
	}
	public static function Fire($url,$method='GET',$args = array()){
		$ctx = self::prepare_request($url,$method,$args);
		$f = fopen($url,'r',false,$ctx);
		fclose($f);
	}
}

final class HttpPost extends Http {
	public final function OffsetExists($offset) { return isset($_POST[$offset]); }
	/** @return HttpValue */ public function OffsetGet($offset) { return isset($_POST[$offset]) ? new HttpValue($_POST[$offset]) : new HttpValue(null); }
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

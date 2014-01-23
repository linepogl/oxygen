<?php

$dom = new DOMDocument();
$dom->load('../dictionary.xml');

$a = array();
$langs = array();

/** @var $e DOMElement */
foreach ($dom->getElementsByTagName('lemma') as $e) {
	$name = $e->getAttribute('name');
	foreach ($e->childNodes as $ee){
		if ($ee instanceof DOMElement){
			$a[$ee->tagName][$name] = $ee->nodeValue;
		}
	}
}


//print_r($langs);
//print_r($a);
$br = "\n";

//foreach ($a as $lang => $aa) {
//
//	$s = "\xEF\xBB\xBF";
//	$s .= 'msgid ""';
//	$s .= $br.'msgstr ""';
//	$s .= $br.'"Project-Id-Version: oxygen\\n"';
//	$s .= $br.'"POT-Creation-Date: \\n"';
//	$s .= $br.'"PO-Revision-Date: \\n"';
//	$s .= $br.'"Last-Translator: \\n"';
//	$s .= $br.'"Language-Team: \\n"';
//	$s .= $br.'"MIME-Version: 1.0\\n"';
//	$s .= $br.'"Content-Type: text/plain; charset=UTF-8\\n"';
//	$s .= $br.'"Content-Transfer-Encoding: 8bit\\n"';
//	$s .= $br.'"Language: el\\n"';
//	$s .= $br.'"X-Generator: Poedit 1.6.3\\n"';
//	$s .= $br;
//
//	foreach ($aa as $name => $value) {
//		$s .= $br.'msgid "'.str_replace(["\\","\"","\n"],["\\\\","\\\"","\\\n"],$name).'"';
//		$s .= $br.'msgstr "'.$value.'"';
//		$s .= $br;
//	}
//
//	file_put_contents('oxygen.'.$lang.'.po',$s);
//}






class TrieUInt16 implements ArrayAccess {
	public $value = null;
	public $children = null;
	public function SerializeBinary(){
		$count = $this->children === null ? 0 : count($this->children);
		$has_children = $count !== 0;
		$has_value = $this->value !== null;
		$type = ord('A') + ($has_value ? 1 : 0) + ($has_children ? 2 : 0);
		$r = chr($type);
		if ($has_value) {
			$B0 = $this->value % 0x100;
			$B1 = $this->value >> 8;
			$r .= chr( $B0 ) . chr( $B1 );
		}
		if ($has_children) {
			$r .= chr( $count - 1 );
			/** @var $trie TrieUInt16 */
			foreach ($this->children as $ord => $trie) {
				$r .= chr($ord);
				$r .= $trie->SerializeBinary();
			}
		}
		return $r;
	}
	public function UnserializeBinary($string,&$index = 0){
		$this->value = null;
		$this->children = null;

		$type = ord($string[$index++]) - ord('A');

		$has_value = ($type&1) === 1;
		$has_children = ($type&2) === 2;
		if ($has_value) {
			$B0 = ord($string[$index++]);
			$B1 = ord($string[$index++]);
			$this->value = ($B1 << 8) | $B0;
		}
		if ($has_children) {
			$this->children = array();
			$count = ord($string[$index++]) + 1;
			for ($i = 0; $i < $count; $i++){
				$ord = ord($string[$index++]);
				$trie = new TrieUInt16();
				$trie->UnserializeBinary($string,$index);
				$this->children[$ord] = $trie;
			}
		}
	}
	public function OffsetSet($key,$value) {
		if (strlen($key) === 0) {
			$this->value = $value;
		}
		else {
			if ($this->children === null) $this->children = array();
			$char = ord($key[0]);
			if (!isset($this->children[$char])) $this->children[$char] = new TrieUInt16();
			/** @var $v TrieUInt16 */
			$v = $this->children[$char];
			$next = substr($key,1);
			$v[$next] = $value;
		}
	}
	public function OffsetGet($key) {
		if (strlen($key) === 0) {
			return $this->value;
		}
		else {
			if ($this->children===null) return null;
			$char = ord($key[0]);
			if (!isset($this->children[$char])) return null;
			/** @var $v TrieUInt16 */
			$v = $this->children[$char];
			$next = substr($key,1);
			return $v[$next];
		}
	}
	public function OffsetExists($key) {
		if (strlen($key) === 0) {
			return $this->value !== null;
		}
		else {
			if ($this->children===null) return false;
			$char = ord($key[0]);
			if (!isset($this->children[$char])) return false;
			/** @var $v TrieUInt16 */
			$v = $this->children[$char];
			$next = substr($key,1);
			return $v->OffsetExists($next);
		}
	}
	public function OffsetUnset($key) {
		if (strlen($key) === 0) {
			$this->value = null;
		}
		else {
			if ($this->children===null) return false;
			$char = ord($key[0]);
			if (!isset($this->children[$char])) return false;
			/** @var $v TrieUInt16 */
			$v = $this->children[$char];
			$next = substr($key,1);
			$v->OffsetUnset($next);
		}
	}
}


$q1 = new TrieUInt16();
$q2 = new TrieUInt16();
$q3 = [];
foreach ($a as $lang => $aa) {
	foreach ($aa as $key => $value) {
		$x = rand(200,20000);
		$q1[$key.$lang] = $x;
		$q3[$key.$lang] = $x;
	}
}
$q2->UnserializeBinary($q1->SerializeBinary());



var_dump($q1->SerializeBinary());
var_dump($q2->SerializeBinary());
var_dump(serialize($q3) );
die;
$q1 = new TrieUInt16();
$q2 = new TrieUInt16();

$q1['Test'] = ord('X');
$q1['T'] = ord('X');

$s1 = $q1->SerializeBinary();
var_dump($s1);

$q2->UnserializeBinary($s1);
$s2 = $q2->SerializeBinary();
var_dump($s2);

die;


var_dump($q1['Cancelen']);
var_dump($q2['Cancelen']);
die;




ob_start();
echo $q1->SerializeBinary();
$m1 = md5(ob_get_clean());


ob_start();
echo $q2->SerializeBinary();
$m2 = md5(ob_get_clean());


var_dump($m1 === $m2);




//echo $q1->SerializeBinary();



//var_dump(serialize($q2));


//var_dump(json_encode($a));
//var_dump($a);












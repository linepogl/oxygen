<?php
define('BR',"\n");
function esc_txt($txt) {
	$txt = str_replace('"','\"',$txt);
	if (strpos($txt,"\n")) {
		$r = '""'; foreach (explode("\n",$txt) as $s) $r .= BR.'"'.$s.'\\n"';
		return $r;
	}
	return '"'.$txt.'"';
}
function esc_com($txt) {
	$txt = str_replace('"','\"',$txt);
	if (strpos($txt,"\n")) {
		$r = '""'; foreach (explode("\n",$txt) as $s) $r .= BR.'#. "'.$s.'\\n"';
		return $r;
	}
	return '"'.$txt.'"';
}
function export( $what ) {
	/** @var $e DOMElement */
	/** @var $ee DOMElement */
	$dom = new DOMDocument();
	$dom->load('../'.$what.'.xml');

	$err = '';
	$a = [];
	$langs = [];
	foreach ($dom->documentElement->getElementsByTagName('lemma') as $e) {
		$n = $e->getAttribute('name');
		if (array_key_exists($n,$a)) $err .= '* '.$n.BR;
		if (preg_match('/^[_a-zA-Z0-9]+$/',$n) !== 1) $err .= $n.BR;
		foreach ($e->childNodes as $ee) if ($ee instanceof DOMElement && strlen($ee->tagName) === 2)
			if (!array_key_exists($ee->tagName,$langs))
				$langs[$ee->tagName] = $ee->tagName;
		$a[$n] = true;
	}

	ob_start();
	echo "\xEF\xBB\xBF".BR;
	foreach ($dom->documentElement->getElementsByTagName('lemma') as $e) {
		$n = $e->getAttribute('name');
		$v = '';

		foreach ($e->childNodes as $ee) if ($ee instanceof DOMElement && strlen($ee->tagName) === 2) {
			echo '#. '.$ee->tagName.': '.esc_com($ee->nodeValue).BR;
			//if ($ee->tagName === $lang) $v = $ee->nodeValue;
		}

		echo 'msgid "'.$n.'"'.BR;
		echo 'msgstr '.esc_txt($v).BR;
		echo BR;
	}
	file_put_contents($what.'.pot',ob_get_clean());
	return $err;
}

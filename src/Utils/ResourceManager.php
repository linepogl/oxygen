<?php

abstract class ResourceManager {

	//protected static function _() { list(,$caller) = debug_backtrace(false); return new Lemma($caller); }
	///** @return Lemma */ protected static function __($x) { list(,$caller) = debug_backtrace(false); return forward_static_call([get_called_class(),$caller.'_'.$x]); }

	public static final function __callStatic($name,$args) {
		if ( strpos( $name , 'txt' )  === 0){
			$c = get_called_class();
			if (method_exists($c,$name))
				return call_user_func([$c,$name]);
			else
				return new Lemma($name);
		}
		Debug::RecordExceptionSilenced( new Exception('The static function '.get_called_class().'::'.$name.' does not exist.') );
		return '';
	}
	/** @return Lemma */ public static final function txt($n){
		$c = get_called_class();
		$n = 'txt'.$n;
		if (method_exists($c,$n))
			return call_user_func([$c,$n]);
		else
			return new Lemma($n);
	}
	/** @return Lemma */
	protected static final function _forward() {
		$c = get_called_class();
		list(,$n) = debug_backtrace(false);
		$n = $n['function'].implode('_',func_get_args());
		if (method_exists($c,$n))
			return call_user_func([$c,$n]);
		else
			return new Lemma($n);
	}
	public static final function _export_dictionary() {
		$esc_txt = function($txt){ $txt = str_replace('"','\"',$txt); if (strpos($txt,"\n")) { $r = '""'; foreach (explode("\n",$txt) as $s) $r .= "\n\"$s\\n\""; return $r; } return '"'.$txt.'"'; };
		$esc_com = function($txt){ $txt = str_replace('"','\"',$txt); if (strpos($txt,"\n")) { $r = '""'; foreach (explode("\n",$txt) as $s) $r .= "\n#. \"$s\\n\""; return $r; } return '"'.$txt.'"'; };
		$pot = "\xEF\xBB\xBF";
		$class_name = get_called_class();
		$c = new ReflectionClass($class_name);
		$f = dirname($c->getFileName());
		$ff = basename($c->getFileName(),'.php');
		/** @var $m ReflectionMethod */
		foreach ($c->getMethods(ReflectionMethod::IS_STATIC) as $m) {
			if ($class_name !== $m->getDeclaringClass()->getName()) continue;
			if ( strpos( $m->getName() , 'txt' ) !== 0) continue;
			if ( $m->getNumberOfParameters() !== 0) continue;
			$lemma = $m->invoke(null);
			if ($lemma instanceof Lemma) {
				$n = substr($m->getName(),3);
				$pot .= 'msgid '.$esc_txt($n)."\n";
				foreach ($lemma as $lang => $value) $pot .= '#. '.$lang.': '.$esc_com($value)."\n";
				$pot .= 'msgstr '.$esc_txt('')."\n\n";
			}
		}
		Fs::Ensure("$f/i18");
		file_put_contents("$f/i18/$ff.pot",$pot);
	}

}


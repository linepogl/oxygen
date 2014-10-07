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
	/** @return Lemma */ public static final function txt($name){
		$c = get_called_class();
		if (strpos($name,'txt')!==0) $name = 'txt'.$name;
		if (func_num_args()>1) {
			$ext = implode('_',array_slice(func_get_args(),1));
			if ($ext === '') { list(,$caller)=debug_backtrace(false); if ($caller===$name) return new Lemma($name); } // hack to avoid infinite loops.
			$name .= $ext;
		}
		if (method_exists($c,$name))
			return call_user_func([$c,$name]);
		else
			return new Lemma($name);
	}
	public static final function _export_dictionary() {
		$esc_txt = function($txt){ $txt = str_replace('"','\"',$txt); if (strpos($txt,"\n")) { $r = '""'; foreach (explode("\n",$txt) as $s) $r .= "\n\"$s\\n\""; return $r; } return '"'.$txt.'"'; };
		$esc_com = function($txt){ $txt = str_replace('"','\"',$txt); if (strpos($txt,"\n")) { $r = '""'; foreach (explode("\n",$txt) as $s) $r .= "\n#. \"$s\\n\""; return $r; } return '"'.$txt.'"'; };
		$class_name = get_called_class();
		$c = new ReflectionClass($class_name);
		$f = dirname($c->getFileName());
		$ff = basename($c->getFileName(),'.php');
		$langs = [];


		$pot = '';
		$pot .= 'msgid ""'."\n";
		$pot .= 'msgstr ""'."\n";
		$pot .= '"Project-Id-Version: '.$ff.'\n"'."\n";
		$pot .= '"MIME-Version: 1.0\n"'."\n";
		$pot .= '"Content-Type: text/plain; charset=utf-8\n"'."\n";
		$pot .= '"Content-Transfer-Encoding: 8bit\n"'."\n";
		$pot .= "\n";
		/** @var $m ReflectionMethod */
		foreach ($c->getMethods(ReflectionMethod::IS_STATIC) as $m) {
			if ($class_name !== $m->getDeclaringClass()->getName()) continue;
			if ( strpos( $m->getName() , 'txt' ) !== 0) continue;
			if ( $m->getNumberOfParameters() !== 0) continue;
			$lemma = $m->invoke(null);
			if ($lemma instanceof Lemma) {
				$n = substr($m->getName(),3);
				$v = '';
				foreach ($lemma as $l => $value) { $pot .= '#. '.$l.': '.$esc_com($value)."\n"; $langs[$l] = $l; }
				$pot .= 'msgid '.$esc_txt($n)."\n";
				$pot .= 'msgstr '.$esc_txt($v)."\n\n";
			}
		}

		Fs::Ensure("$f/i18");
		file_put_contents("$f/i18/$ff.pot",$pot);

		foreach ($langs as $lang) {
			$po = '';
			$po .= 'msgid ""'."\n";
			$po .= 'msgstr ""'."\n";
			$po .= '"Project-Id-Version: '.$ff.'\n"'."\n";
			$po .= '"MIME-Version: 1.0\n"'."\n";
			$po .= '"Content-Type: text/plain; charset=utf-8\n"'."\n";
			$po .= '"Content-Transfer-Encoding: 8bit\n"'."\n";
			$po .= '"Language: '.$lang.'\n"'."\n";
			$po .= "\n";
			/** @var $m ReflectionMethod */
			foreach ($c->getMethods(ReflectionMethod::IS_STATIC) as $m) {
				if ($class_name !== $m->getDeclaringClass()->getName()) continue;
				if ( strpos( $m->getName() , 'txt' ) !== 0) continue;
				if ( $m->getNumberOfParameters() !== 0) continue;
				$lemma = $m->invoke(null);
				if ($lemma instanceof Lemma) {
					$n = substr($m->getName(),3);
					$v = $lemma->HasLang($lang) ? $lemma->TranslateTo($lang) : '';
					foreach ($lemma as $l => $value) { $po .= '#. '.$l.': '.$esc_com($value)."\n"; }
					$po .= 'msgid '.$esc_txt($n)."\n";
					$po .= 'msgstr '.$esc_txt($v)."\n\n";
				}
			}
			file_put_contents("$f/i18/$ff.$lang.po",$po);
		}


	}

}


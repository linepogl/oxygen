<?php
define('en','en');
define('el','el');
define('fr','fr');
define('de','de');
define('es','es');
define('it','it');
define('pt','pt');
define('ru','ru');
define('zh','zh');
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
		$esc_com = function($txt){ $txt = str_replace("\n","\n#. ",$txt); return '"'.$txt.'"'; };
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
	public static final function _import_dictionary() {
		$to_php_str_literal = function($txt){ $txt = str_replace(["\\","\$","\""],["\\\\","\\\$","\\\""],$txt); return '"'.$txt.'"';};
		$unesc_txt = function($txt){ $txt = trim($txt); $txt = substr(substr($txt,0,strlen($txt)-1),1); $txt = str_replace('\"','"',$txt); return $txt; };
		$class_name = get_called_class();
		$c = new ReflectionClass($class_name);
		$f = dirname($c->getFileName());
		$ff = basename($c->getFileName(),'.php');

		// init
		$a = [];
		foreach ($c->getMethods(ReflectionMethod::IS_STATIC) as $m) {
			if ($class_name !== $m->getDeclaringClass()->getName()) continue;
			if ( strpos( $m->getName() , 'txt' ) !== 0) continue;
			if ( $m->getNumberOfParameters() !== 0) continue;
			$lemma = $m->invoke(null);
			if ($lemma instanceof Lemma) {
				$n = substr($m->getName(),3);
				$a[$n] = $lemma;
			}
		}

		foreach (Fs::Browse("$f/i18","_$ff.*.po") as $fff) {
			$lang = Str::TrimStart(basename($fff,".po"),"_$ff.");
			if (strlen($lang) !== 2) continue;

			// read
			$b = [];
			$fh = fopen("$f/i18/$fff",'r');
			$msgid = null;
			$msgstr = '';
			$multiline = false;
			while( ($s = fgets($fh)) !== false ) {
				if (Str::StartsWith($s,'msgid')) {
					if ($msgid !== null) $b[$msgid] = $msgstr;
					$msgid = $unesc_txt( Str::TrimStart($s,'msgid') );
					$msgstr = '';
				}
				elseif (Str::StartsWith($s,'msgstr')) {
					$msgstr = $unesc_txt( Str::TrimStart($s,'msgstr') );
					$multiline = ($msgstr === '');
				}
				elseif ($multiline && Str::StartsWith($s,'"')){
					$msgstr .= ($msgstr===''?'':"\n") . $unesc_txt($s);
				}
			}
			if ($msgid !== null) $b[$msgid] = $msgstr;

			// merge
			foreach ($b as $key => $str) {
				if (array_key_exists($key,$a)) {
					/** @var $lemma Lemma */
					$lemma = $a[$key];
					$lemma[$lang] = $str;
				}
			}
		}


		$r = file_get_contents($c->getFileName());
		foreach ($a as $key=>$lemma) {

			$s = "public static function txt$key(){ return Lemma::txt([__FUNCTION__";
			foreach ($lemma as $lang=>$str)
				$s .= "\n\t\t,$lang=>".$to_php_str_literal($str);
			$s .= "\n\t\t]);}";

			$p = '/public\s+static\s+function\s+txt'.$key.'\s*\(\s*\)\s*\{[^\}]*\]\)\;\}/';
			preg_match($p,$r,$matches);
			if (count($matches)>0) $r = str_replace( $matches[0] , $s , $r );
		}

		file_put_contents($c->getFileName(),$r);

	}
}


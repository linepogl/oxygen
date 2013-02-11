<?php
class Oxygen {

	public static function Init(){
		set_exception_handler('Oxygen::OnException');
		register_shutdown_function('Oxygen::OnShutdown');
		spl_autoload_register('Oxygen::OnAutoLoad');


		// init session scoping
		if (self::$session_scoping_enabled) {
			if (array_key_exists(Oxygen::GetSessionCookieName(),$_POST)){
				self::$session_hash = $_POST[Oxygen::GetSessionCookieName()];
			}
			elseif (array_key_exists(Oxygen::GetSessionCookieName(),$_COOKIE)){
				self::$session_hash = $_COOKIE[Oxygen::GetSessionCookieName()];
			}
			if (is_null(self::$session_hash)){
				self::$session_hash = Oxygen::HashRandom();
				setcookie(Oxygen::GetSessionCookieName(),self::$session_hash, time()+90*24*3600, __BASE__ ); // 90 days
			}
		}
		else {
			self::$session_hash = Oxygen::HashRandom();
		}

		if (DEBUG) { if ($_GET['debug']=='pin') Oxygen::SetUrlPin('debug','pin'); }
		if (PROFILE) { if ($_GET['profile']=='pin') Oxygen::SetUrlPin('profile','pin'); }
		Oxygen::EnsureTempFolder();
		Oxygen::EnsureSharedTempFolder();
		Oxygen::ClearTempFoldersFromOldFiles();
		Debug::Init();

		// init url handling
		self::$php_controller = substr( $_SERVER['SCRIPT_NAME'] , strlen(__BASE__) );
		if (is_null(self::$php_managed_controller)) self::$php_managed_controller = self::$php_controller;
		foreach (self::$url_pins as $key=>$value)
			self::$url_pins[$key] = Http::$GET[$key]->AsStringOrNull();

		// init window scoping
		if (self::$window_scoping_enabled) {
			self::$window_hash = Http::$GET['window']->AsStringOrNull();
			if (is_null(self::$window_hash)) {
				self::$window_hash = Oxygen::HashRandom32();
			}
			else {
				$old_window_hash = Http::$GET['old_window']->AsStringOrNull();
				if (!is_null($old_window_hash)){
					$new_window_hash = self::$window_hash;
					self::$window_hash = $old_window_hash;
					$hard = from(Scope::$WINDOW->HARD)->AsArray();
					$weak = from(Scope::$WINDOW->WEAK)->AsArray();
					self::$window_hash = $new_window_hash;
					foreach ($hard as $key=>$value) Scope::$WINDOW->HARD[$key] = $value;
					foreach ($weak as $key=>$value) Scope::$WINDOW->WEAK[$key] = $value;
					Oxygen::RedirectRaw( __BASE__ . Oxygen::MakeHrefPreservingValues(array('old_window'=>null)) );
				}
			}
			self::$url_pins['window'] = self::$window_hash;
		}
		else {
			self::$window_hash = Oxygen::Hash32(self::$session_hash);
		}

		// set the current language
		$lang = '';
		if (count(self::$langs)==0) self::$langs[] = 'en';
		if (count(self::$langs)==1) {
			$lang = self::$langs[0];
		}
		else {
			$found = false;
			if (isset($_GET['lang'])) {
				$lang = $_GET['lang'];
				foreach (self::$langs as $l) if ($l == $lang) { $found = true; break; }
			}
			if (!$found && isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) { // try to find the preferred user language
				$a = explode(';',$_SERVER["HTTP_ACCEPT_LANGUAGE"]);
				if (strlen($a[0]) >= 2) {
					$lang = substr($a[0],0,2);
					foreach (self::$langs as $l) if ($l == $lang) { $found = true; self::$lang_auto_selection = true; break; }
				}
				for ($i = 1; !$found && $i < count($a); $i++) {
					$b = explode(',',$a[$i]);
					if (count($b) > 1 && strlen($b[1]) >= 2) {
						$lang = substr($b[1],0,2);
						foreach (self::$langs as $l) if ($l == $lang) { $found = true; self::$lang_auto_selection = true; break; }
					}
				}
			}
			if (!$found) { $lang = self::$langs[0]; self::$lang_auto_selection = true; }
		}
		Oxygen::SetLang($lang);

		// set the action
		self::$actionmode = Http::$GET['mode']->AsIntegerOrNull();
		if (is_null(self::$actionmode)) self::$actionmode = self::$default_actionmode;
		self::$actionname = Http::$GET['action']->AsStringOrNull();
		if (is_null(self::$actionname)) self::$actionname = self::$default_actionname;


		Database::Upgrade();

	}



	public static function Go(){
		// retrieve the current action and GO!
		$classname = 'Action'.self::$actionname;

		try {
			new ReflectionClass($classname); // <-- this will throw a mere exception if the class is not found, which will prevent a nasty FATAL php error in the next line.
			self::$action = $classname::Make();
		}
		catch (ApplicationException $ex){
			self::$action = new ActionOxygenThrowException($ex);
		}
		catch (Exception $ex){
			Debug::RecordExceptionConverted($ex,'Action Initialisation Exception Handler');
			self::$action = new ActionOxygenThrowException(new PageNotFoundException(Lemma::Pick('MsgPageNotFound'),0,$ex));
		}

		self::$action->WithMode(self::$actionmode);
		Oxygen::SetContentType(self::$action->GetContentType());
		Oxygen::SetCharset(self::$action->GetCharset());
		Oxygen::ResetHttpHeaders();

		self::$content = self::$action->GetContent();


		if (Debug::IsImmediateFlushingEnabled()) exit();
		Oxygen::SendHttpHeaders();
		if (!self::IsActionModeContent()) { echo self::$content; exit(); }
	}



	public static function OnAutoLoad($class){
		$f = Oxygen::FindClassFile($class);
		if (is_null($f)) return;
		require($f);
	}
	public static function OnShutdown() {
		chdir(__ROOT__);
		Progress::Shutdown();
		if (PROFILE) Profiler::StopAndSave();
		if (DEBUG) Debug::StopAndSave();
		if (DEBUG) Debug::ShowConsole();
		if (PROFILE) Profiler::ShowConsole();
	}

	public static function OnException($ex) {
		/** @var $ex Exception */
		while ( ob_get_level() > 0 ) ob_end_clean();


		try {
			if (Oxygen::IsActionModeRaw()) {
				Oxygen::SetContentType('text/plain');
				Oxygen::ResetHttpHeaders();
				if ($ex instanceof SecurityException) {
					Oxygen::SetResponseCode(403); // forbidden
					$served_as = 'HTTP 403';
				}
				elseif ($ex instanceof PageNotFoundException) {
					Oxygen::SetResponseCode(404); // not found
					$served_as = 'HTTP 404';
				}
				elseif ($ex instanceof ApplicationException) {
					Oxygen::SetResponseCode(405); // not allowed
					$served_as = 'HTTP 405';
				}
				else {
					Oxygen::SetResponseCode(500); // internal server error
					$served_as = 'HTTP 500';
				}
				Oxygen::SendHttpHeaders();
				if ($ex instanceof SecurityException) {
					$msg = $ex->getMessage();
					echo empty($msg) ? Lemma::Pick('MsgAccessDenied') : $ex->getMessage();
				}
				if ($ex instanceof PageNotFoundException) {
					$msg = $ex->getMessage();
					echo empty($msg) ? Lemma::Pick('MsgPageNotFound') : $ex->getMessage();
				}
				elseif ($ex instanceof ApplicationException)
					echo $ex->getMessage();
				elseif (!Oxygen::IsDevelopment())
					echo Lemma::Pick('MsgAnErrorOccurred');
				else
					echo '['.Lemma::Pick('MsgDevelopmentEnvironment').']' . "\n" . Debug::GetExceptionReportAsText($ex) ;

				if ($ex instanceof ApplicationException || Oxygen::IsDevelopment())
					Debug::RecordExceptionServed($ex,'Global Exception Handler ('.$served_as.')');
				else
					Debug::RecordExceptionServedGeneric($ex,'Global Exception Handler ('.$served_as.')');
			}
			else {
				$Q = "<!--\n\n\n\n\n\nEXCEPTION\n-->";
				echo '</textarea></select></button></script></textarea></select></button></table></table></table></table></table></div></div></div></div></div></div></div></div>'; // <-- dirty HTML cleanup if content has already been sent.
				echo '<meta http-equiv="Content-type" content="'.Oxygen::GetContentType().';charset='.Oxygen::GetCharset().'" />';
				echo '<div style="position:fixed;top:0;bottom:0;left:0;right:0;z-index:999;background:#555577;">';
				echo '<div style="position:fixed;top:30px;bottom:30px;left:30px;right:30px;z-index:1000;background:#dddddd;">';
				echo '<div style="position:fixed;top:39px;bottom:39px;left:39px;right:39px;z-index:1000;border:1px solid #bbbbbb;background:#fafafa;overflow:auto;padding:30px;">';
				echo '<div style="font:bold 18px/22px Trebuchet MS,sans-serif;border-bottom:1px solid #bbbbbb;color:#555555;">Fatal error</div>';
				if ($ex instanceof ApplicationException) {
					echo '<div style="font:bold 13px/14px Trebuchet MS,sans-serif;margin:20px 0;">'.$Q.$ex->getMessage().$Q.'</div>';
				}
				else {
					if (Oxygen::IsDevelopment()) {
						$serial = Debug::RecordExceptionServed($ex,'Global Exception Handler');
						echo '<div style="font:normal italic 11px/12px Trebuchet MS,sans-serif;margin:20px 0 0 0;color:#bbbbbb;">'.Lemma::Pick('MsgDevelopmentEnvironment').'</div>';
						echo '<div style="font:normal 11px/12px Trebuchet MS,sans-serif;margin:10px 0 2px 0;color:#999999;">'.$Q.get_class($ex).' '.$serial.$Q.'</div>';
						echo '<div style="font:bold 13px/14px Trebuchet MS,sans-serif;margin:0 0 20px 0;color:#000000;">'.$Q.$ex->getMessage().$Q.'</div>';
						echo '<div style="font:11px/13px Courier New,monospace;border-left:1px solid #bbbbbb;margin-left:3px;padding:10px;white-space:pre;color:#999999;"><b>Exception stack trace</b><br/><br/>'.new Html(Debug::GetExceptionTraceAsText($ex)).'</div>';
						echo '<div style="font:11px/13px Courier New,monospace;border-left:1px solid #bbbbbb;margin-left:3px;margin-top:20px;padding:10px;white-space:pre;color:#999999;"><b>Oxygen info</b><br/><br/>'.new Html(Oxygen::GetInfoAsText()).'</div>';
						echo '<div style="font:11px/13px Courier New,monospace;border-left:1px solid #bbbbbb;margin-left:3px;margin-top:20px;padding:10px;white-space:pre;color:#999999;"><b>Debug entries</b><br/><br/>'.new Html(Debug::GetEntriesAsText()).'</div>';
						echo '<div style="font:11px/13px Courier New,monospace;border-left:1px solid #bbbbbb;margin-left:3px;margin-top:20px;padding:10px;white-space:pre;color:#999999;"><b>Database queries</b><br/><br/>'.new Html(Database::GetQueriesAsText()).'</div>';
					}
					else {
						$serial = Debug::RecordExceptionServedGeneric($ex,'Global Exception Handler');
						echo '<div style="font:bold 13px/14px Trebuchet MS,sans-serif;margin:20px 0;">'.Lemma::Pick('MsgAnErrorOccurred').'</div>';
						echo '<div style="font:normal 11px/12px Trebuchet MS,sans-serif;margin:10px 0 2px 0;color:#999999;">'.$Q.get_class($ex).' '.$serial.$Q.'</div>';
					}
				}
				echo '<div style="font:italic 11px/13px Trebuchet MS,sans-serif;color:#bbbbbb;margin-top:50px;">Oxygen</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
		}
		catch (Exception $ex2){
			//echo $Q.$ex2->getMessage().'<br/><br/>'.$Q.$ex2->getFile().'['.$ex2->getLine().']';
			try{ Debug::RecordExceptionServed($ex2,'FATAL: Exception inside Global Exception Handler.'); } catch(Exception $ex3){ }
		}
	}

	function user_shutdown_function() {
		chdir(__ROOT__);
		Progress::Shutdown();
		if (PROFILE) Profiler::StopAndSave();
		if (DEBUG) Debug::StopAndSave();
		if (DEBUG) Debug::ShowConsole();
		if (PROFILE) Profiler::ShowConsole();
	}



	//
	//
	// Languages
	//
	//
	public static $langs = array();
	public static $lang = null;
	public static $lang_auto_selection = false;
	public static function AddLang($lang) { if (!in_array($lang,self::$langs,true)) { self::$langs[] = $lang; if (count(self::$langs)==1) self::$lang = $lang; } }
	public static function SetLang($lang) { if (Oxygen::HasLang($lang)) { self::$lang = $lang; Oxygen::SetUrlPin('lang',$lang); setlocale(LC_ALL,Lemma::Pick('locale')); } }
	public static function HasLang($lang) { return in_array($lang,self::$langs,true); }
	public static function HasLangAutoSelection() { return self::$lang_auto_selection; }
	public static function GetLang(){ return self::$lang; }
	public static function GetLangs(){ return self::$langs; }



	//
	//
	// HTTP Headers
	//
	//
	private static $http_headers_sent = false;
	private static $http_headers = array();
	public static function ClearHttpHeaders(){
		self::$http_headers = array();
	}
	public static function GetHttpHeaders(){ return self::$http_headers; }
	public static function ResetHttpHeaders(){
		self::$http_headers = array();
		Oxygen::AddHttpHeader('HTTP/1.1 '.Oxygen::GetResponseCode());
		Oxygen::AddHttpHeader('Content-type: '.Oxygen::GetContentType().'; charset='.Oxygen::GetCharset());
		Oxygen::AddHttpHeader('Cache-Control: no-cache, must-revalidate');
		Oxygen::AddHttpHeader('Expires: 0');
		Oxygen::AddHttpHeader('Pragma: No-cache');
	}
	public static function AddHttpHeader($value){ self::$http_headers[] = $value; }
	public static function SendHttpHeaders(){
		if (self::$http_headers_sent) return;
		foreach (self::$http_headers as $h)
			header($h);
		self::$http_headers_sent = true;
	}



	//
	//
	// Charset
	//
	//
	private static $charset = 'UTF-8';
	public static function IsCharsetUnicode(){ return self::$charset == 'UTF-8'; }
	public static function SetCharset($value) { self::$charset = strtoupper($value); }
	public static function GetCharset(){ return self::$charset; }
	public static function ReadUnicode($value){
//		return Oxygen::IsCharsetUnicode() ? $value : iconv('UTF-8',self::$charset,$value);
		if (self::$charset == 'UTF-8') return $value;
		if (self::$charset == 'ISO-8859-1') return utf8_decode($value);
		throw new Exception('PHP versions before 6.0 do not support the converting of unicode to '.self::$charset.'.');
	}
	public static function ToUnicode($value){
//		return Oxygen::IsCharsetUnicode() ? $value : iconv('UTF-8',self::$charset,$value);
		if (self::$charset == 'UTF-8') return $value;
		if (self::$charset == 'ISO-8859-1') return utf8_encode($value);
		throw new Exception('PHP versions before 6.0 do not support the converting of '.self::$charset.' to unicode.');
	}
	private static $response_code = 200;
	public static function SetResponseCode($value){ self::$response_code = $value; }
	public static function GetResponseCode(){ return self::$response_code; }
	private static $content_type = null;
	public static function SetContentType($value){ self::$content_type = $value; }
	public static function GetContentType(){
		if (is_null(self::$content_type)) {
			if (Browser::IsIE())
				self::$content_type = 'text/html';
			else
				self::$content_type = 'text/html';
				//self::$content_type = 'application/xhtml+xml';
		}
		return self::$content_type;
	}





	//
	//
	// Dictionary
	//
	//
	private static $dictionary_files = array('oxy/dictionary.xml');
	public static function GetDictionaryFiles(){ return self::$dictionary_files; }
	public static function AddDictionaryFile($filename) { if (!in_array($filename,self::$dictionary_files)) self::$dictionary_files[] = $filename; }




	//
	//
	// Temp
	//
	//
	private static $temp_folder = 'tmp';
	private static $shared_temp_folder = 'tmp';
	public static function GetTempFolder($ensure = false){ if ($ensure) Oxygen::EnsureTempFolder(); return self::$temp_folder; }
	public static function GetSharedTempFolder($ensure = false){ if ($ensure) Oxygen::EnsureSharedTempFolder(); return self::$shared_temp_folder; }
	public static function SetTempFolder($local_temp_folder,$shared_temp_folder = null) { self::$temp_folder = $local_temp_folder; self::$shared_temp_folder = is_null($shared_temp_folder) ? $local_temp_folder : $shared_temp_folder; }
	public static function HasTempFolder(){ return is_dir(self::$temp_folder); }
	public static function HasSharedTempFolder(){ return is_dir(self::$shared_temp_folder); }
	public static function EnsureTempFolder(){ Fs::Ensure(self::$temp_folder); }
	public static function EnsureSharedTempFolder(){ Fs::Ensure(self::$shared_temp_folder); }
	public static function EnsureTempFolders(){ self::EnsureTempFolder(); self::EnsureSharedTempFolder(); }
	public static function MakeTempFolder(){ Fs::Ensure(self::$temp_folder); }
	public static function MakeSharedTempFolder(){ Fs::Ensure(self::$shared_temp_folder); }
	public static function ClearTempFolders(){
		$local_tmp = Oxygen::GetTempFolder();
		foreach (scandir($local_tmp) as $f){ if (is_dir($f)) continue; try{ unlink($local_tmp.'/'.$f); } catch(Exception $ex){} }
		$shared_tmp = Oxygen::GetSharedTempFolder();
		if ($shared_tmp != $local_tmp) { foreach (scandir($shared_tmp) as $f){ if (is_dir($f)) continue; try{ unlink($shared_tmp.'/'.$f); } catch(Exception $ex){} } }
	}
	public static function ClearTempFoldersFromOldFiles($force = false){
		$last_time = Scope::$APPLICATION['Oxygen::ClearTempFoldersFromOldFiles'];
		$now = time();
		if ($force || is_null($last_time) || $now - $last_time > 3600) {
			$one_day_time = 86400;
			$local_tmp = Oxygen::GetTempFolder();
			foreach (scandir($local_tmp) as $f){ if (is_dir($f)) continue; try{ $then = filemtime($local_tmp.'/'.$f); if ($now - $then > $one_day_time) unlink($local_tmp.'/'.$f); } catch(Exception $ex){} }
			$shared_tmp = Oxygen::GetSharedTempFolder();
			if ($shared_tmp != $local_tmp) { foreach (scandir($shared_tmp) as $f){ if (is_dir($f)) continue; try{ $then = filemtime($shared_tmp.'/'.$f); if ($now - $then > $one_day_time) unlink($shared_tmp.'/'.$f); } catch(Exception $ex){} } }
			Scope::$APPLICATION['Oxygen::ClearTempFoldersFromOldFiles'] = $now;
		}
	}





	//
	//
	// Application environment
	//
	//
	private static $developer_emails = array();
	public static function GetDeveloperEmails(){ return self::$developer_emails; }
	public static function AddDeveloperEmail($value) { self::$developer_emails[] = $value; }
	public static function SetDeveloperEmails($value=array()) { if (!is_array($value)) throw new InvalidArgumentException(); self::$developer_emails = $value; }
	private static $development = LOCALHOST;
	public static function SetDevelopment($value){ self::$development = $value; }
	public static function IsDevelopment(){ return self::$development; }



	//
	//
	// Data folder
	//
	//
	private static $data_folder = 'dat';
	public static function GetDataFolder($ensure = false){ if ($ensure) Oxygen::EnsureDataFolder(); return self::$data_folder; }
	public static function SetDataFolder($value){ self::$data_folder = $value; }
	public static function HasDataFolder(){ return is_dir(self::$data_folder); }
	public static function EnsureDataFolder(){ Fs::Ensure(self::$data_folder); }



	//
	//
	// Log folder
	//
	//
	private static $log_folder = 'log';
	public static function GetLogFolder($ensure = false){ if ($ensure) Oxygen::EnsureLogFolder(); return self::$log_folder; }
	public static function SetLogFolder($value) { self::$log_folder = $value; }
	public static function HasLogFolder(){ return is_dir(self::$log_folder); }
	public static function EnsureLogFolder(){ Fs::Ensure(self::$log_folder); }




	//
	//
	// Item cache
	//
	//
	private static $item_cache_enabled = true;
	public static function SetItemCacheEnabled($value){ self::$item_cache_enabled = $value;  }
	public static function IsItemCacheEnabled(){ return self::$item_cache_enabled; }



	//
	//
	// Code loaders
	//
	//
	private static $code_folders = array('oxy/src');
	public static function GetCodeFolders(){ return self::$code_folders; }
	public static function AddCodeFolder($folder) { if (!in_array($folder,self::$code_folders)) self::$code_folders[] = $folder; }
	private static $class_files = null;
	private static $class_files_reloaded = false;
	private static function ReloadClassFiles(){
		Scope::$APPLICATION['Oxygen::ClassFiles'] = null;
		Oxygen::LoadClassFiles();
	}
	private static function LoadClassFiles(){
		self::$class_files = Scope::$APPLICATION['Oxygen::ClassFiles'];
		if (is_null(self::$class_files)) {
			self::$class_files = array();
			foreach (self::$code_folders as $folder) {
				if (is_dir($folder)) { // important!
					Oxygen::LoadClassFilesRecursively($folder);
				}
			}
			Scope::$APPLICATION['Oxygen::ClassFiles'] = self::$class_files;
			self::$class_files_reloaded = true;
		}
	}
	private static function LoadClassFilesRecursively($folder){
		foreach (scandir($folder) as $x) if ($x!='.'&&$x!='..') {
			$ff = $folder.'/'.$x;
			if (is_dir($ff))
				Oxygen::LoadClassFilesRecursively($folder.'/'.$x);
			else {
				$l = strlen($x);
				if ($l > 4) {
					$ext = substr($x,$l-4);
					if ($ext == '.php') {
						self::$class_files[basename($x,$ext)] = $ff;
					}
				}
			}
		}
	}


	public static function FindClassFile($class){
		$r = null;
		if (is_null(self::$class_files)) Oxygen::LoadClassFiles();
		$b = isset(self::$class_files[$class]); if ($b) $r = self::$class_files[$class];
		if (!self::$class_files_reloaded) {
			if ($b) {
				if (!file_exists($r)) {
					Oxygen::ReloadClassFiles();
					if (isset(self::$class_files[$class])) $r = self::$class_files[$class];
				}
			}
			else {
				Oxygen::ReloadClassFiles();
				if (isset(self::$class_files[$class])) $r = self::$class_files[$class];
			}
		}
		return $r;
	}







	public static function ResetHard(){
		Scope::ResetAllWeak();
		Scope::ResetAllHard();
		Oxygen::ClearTempFolders();
	}
	public static function ResetSoft(){
		Scope::ResetAllWeak();
	}






	private static $session_hash;
	private static $session_scoping_enabled = true;
	public static function SetSessionScopingEnabled($value){ self::$session_scoping_enabled = $value; Scope::$SESSION->SetUseExternalStorage($value); Scope::$WINDOW->SetUseExternalStorage(self::$window_scoping_enabled || $value); }
	public static function IsSessionScopingEnabled(){ return self::$session_scoping_enabled; }
	public static function GetSessionHash(){ return self::$session_hash; }
	public static function GetSessionCookieName(){ return 'Oxygen::SessionHash'; }

	private static $window_hash;
	private static $window_scoping_enabled = true;
	public static function SetWindowScopingEnabled($value){ self::$window_scoping_enabled = $value; Scope::$WINDOW->SetUseExternalStorage(self::$session_scoping_enabled || $value); }
	public static function IsWindowScopingEnabled(){ return self::$window_scoping_enabled; }
	public static function GetWindowHash(){ return self::$window_hash; }






	//
	//
	// Http context
	//
	//
	private static $php_controller;
	private static $php_managed_controller = null;
	private static $url_pins = array('action'=>null,'lang'=>null,'window'=>null);
	public static function AddUrlPin($key) { self::$url_pins[$key] = null; }
	public static function GetUrlPin($key) { return self::$url_pins[$key]; }
	public static function GetUrlPins() { return self::$url_pins; }
	public static function SetUrlPin($key,$value) { self::$url_pins[$key] = $value; }
	public static function GetPhpController(){ return self::$php_controller; }
	public static function GetPhpManagedController(){ return self::$php_managed_controller; }
	public static function SetPhpManagedController($value){ self::$php_managed_controller = $value; }
	public static function MakeHrefPreservingValues(array $params = array()){
		return Oxygen::MakeHref( $params + $_GET );    // <-- array + operator is a better array_merge($b,$a)...
	}
	public static function MakeHref(array $url_args = array() , $use_managed_controller = false ){
		$s = '';
		foreach ( ($url_args
				+ self::$url_pins) as $key=>$value) { // <-- array + operator here again.
			if (is_null($value)) continue;
			$s .= ($s===''?'?':'&');
			$s .= rawurlencode( $key ); /// <-- huge savings by using this directly here... CORRECTION: this is not true, it was because of false info from XDebug
			$s .= '=';
			$s .= new Url( $value );  // <---- this one costs a lot!
		}
		if ($use_managed_controller)
			return self::$php_managed_controller . $s;
		else
			return self::$php_controller . $s;
	}
	public static function IsPostback(){
		return strtolower($_SERVER['REQUEST_METHOD'])=='post';
	}
	public static function RedirectRaw( $href ) {
		while (ob_get_level()>0) ob_end_clean();
		Oxygen::SendHttpHeaders();
		echo Js::BEGIN."window.location.href=".new Js($href).";".Js::END;
		exit();
	}
	public static function Redirect(Action $action) {
		while (ob_get_level()>0) ob_end_clean();
		Oxygen::SendHttpHeaders();
		echo Js::BEGIN."window.location.href=".new Js($action->GetHrefPlain()).";".Js::END;
		exit();
	}
	public static function RedirectBack(){
		while (ob_get_level()>0) ob_end_clean();
		Oxygen::SendHttpHeaders();
		echo Js::BEGIN."window.location.href=".new Js($_SERVER['HTTP_REFERER']).";".Js::END;
		exit();
	}
	public static function Refresh(){
		while (ob_get_level()>0) ob_end_clean();
		Oxygen::SendHttpHeaders();
		echo Js::BEGIN."window.location.href=window.location.href;".Js::END;
		exit();
	}
	public static function RefreshParent(){
		while (ob_get_level()>0) ob_end_clean();
		Oxygen::SendHttpHeaders();
		echo Js::BEGIN."parent.location.href=parent.location.href;".Js::END;
		exit();
	}
	public static function IsLocalhost(){
		return $_SERVER["SERVER_NAME"] == 'localhost';
	}
	public static function IsHttps(){
		return isset($_SERVER["HTTPS"]);
	}
	public static function GetApplicationName(){
		$r = $_SERVER["SERVER_NAME"];
		$s = $_SERVER['SCRIPT_NAME'];
		$r .= substr($s,0,strrpos($s,'/'));
		return $r;
	}
	public static function GetCurrentPhpScript(){
		$s = $_SERVER['SCRIPT_NAME'];
		return substr($s,strrpos($s,'/')+1);
	}
	public static function GetHref(){
		$s = $_SERVER['SCRIPT_NAME'];
		return substr($s,strrpos($s,'/')+1) . '?' . $_SERVER['QUERY_STRING'];
	}
	public static function GetProtocol(){
		return Oxygen::IsHttps() ? 'https' : 'http';
	}
	public static function GetPort(){
		return $_SERVER["SERVER_PORT"];
	}
	public static function GetHrefServer($new_protocol = null,$new_port = null){
		$old_protocol = Oxygen::GetProtocol();
		if (is_null($new_protocol)) $new_protocol = $old_protocol;
		$r = $new_protocol . '://' . $_SERVER["SERVER_NAME"];
		if ($new_port == null) {
			if ($new_protocol == 'http' && $_SERVER["SERVER_PORT"] != '80') $r .= ":".$_SERVER["SERVER_PORT"];
			if ($new_protocol == 'https' && $_SERVER["SERVER_PORT"] != '443') $r .= ":".$_SERVER["SERVER_PORT"];
		}
		return $r;
	}
	public static function GetHrefBaseFull($new_protocol = null,$new_port = null){
		return Oxygen::GetHrefServer($new_protocol,$new_port) . __BASE__;
	}
	public static function GetHrefBase(){
		return __BASE__;
	}

	










	//
	//
	// Database upgrade
	//
	//
	private static $database_upgrade_files = array('oxy/_upgrade.php');
	public static function GetDatabaseUpgradeFiles() { return self::$database_upgrade_files; }
	public static function AddDatabaseUpgradeFile($filename) { if (!in_array($filename,self::$database_upgrade_files)) self::$database_upgrade_files[] = $filename; }



	public static function SetDatabase($server,$schema,$username,$password,$type=Database::MYSQL) {
		Database::ConnectLazily($server,$schema,$username,$password,$type);
	}
	public static function SetDatabaseManaged($server,$schema,$username,$password,$type=Database::MYSQL) {
		Database::ConnectLazilyManaged($server,$schema,$username,$password,$type);
	}

	public static function SetMemcachedServer( $server ){
		Scope::SetMemcachedServer( $server );
	}
	public static function SetMemcachedServers( $servers ){
		Scope::SetMemcachedServers( $servers );
	}

	public static function SetScoping( $mode = Scope::APC ){
		Scope::$APPLICATION->SetMode($mode);
		Scope::$DATABASE->SetMode($mode);
		Scope::$SESSION->SetMode($mode);
		Scope::$WINDOW->SetMode($mode);
	}
	public static function SetApplicationScoping( $mode = Scope::APC ){
		Scope::$APPLICATION->SetMode($mode);
	}
	public static function SetDatabaseScoping( $mode = Scope::APC){
		Scope::$DATABASE->SetMode($mode);
	}
	public static function SetSessionScoping( $mode = Scope::APC , $enabled = true ){
		Scope::$SESSION->SetMode($mode);
		Oxygen::SetSessionScopingEnabled( $enabled );
	}
	public static function SetWindowScoping( $mode = Scope::APC , $enabled = true ){
		Scope::$WINDOW->SetMode($mode);
		Oxygen::SetWindowScopingEnabled( $enabled );
	}









	//
	//
	// Content
	//
	//
	private static $actionname = null;
	/** @var Action */
	private static $action = null;
	private static $content = '';
	private static $actionmode = 0;
	private static $default_actionname = 'Home';
	private static $default_actionmode = 0;
	/** @return void */ public static function SetDefaultActionName($actionname) { self::$default_actionname = $actionname; }
	/** @return void */ public static function SetDefaultActionMode($actionmode) { self::$default_actionmode = $actionmode; }
	/** @return string */ public static function GetDefaultActionName() { return self::$default_actionname; }
	/** @return int    */ public static function GetDefaultActionMode() { return self::$default_actionmode; }
	/** @return string */ public static function GetActionName(){ return self::$actionname; }
	/** @return Action */ public static function GetAction(){ return self::$action; }
	/** @return string */ public static function GetContent() { return self::$content; }
	/** @return string */ public static function GetBody(){ return self::$content; }
	/** @return int    */ public static function GetActionMode(){ return self::$actionmode; }

	public static function IsActionModeContent()      { return (self::$actionmode & Action::MASK_DEST) == Action::FLAG_DEST_CONTENT; }
	public static function IsActionModeBlank()        { return (self::$actionmode & Action::MASK_DEST) == Action::FLAG_DEST_BLANK; }
	public static function IsActionModeAjaxDialog()   { return (self::$actionmode & Action::MASK_DEST) == Action::FLAG_DEST_AJAX_DIALOG; }
	public static function IsActionModeIFrameDialog() { return (self::$actionmode & Action::MASK_DEST) == Action::FLAG_DEST_IFRAME_DIALOG; }
	public static function IsActionModeFragment()     { return (self::$actionmode & Action::MASK_DEST) == Action::FLAG_DEST_FRAGMENT; }

	public static function IsActionModeHtml()     { return (self::$actionmode & Action::MASK_MODE) == Action::FLAG_MODE_HTML; }
	public static function IsActionModeRaw()      { return (self::$actionmode & Action::MASK_MODE) == Action::FLAG_MODE_RAW; }
	public static function IsActionModeLong()     { return (self::$actionmode & Action::MASK_MODE) == Action::FLAG_MODE_LONG; }


	/** @return string */
	public static function GetHead(){

		ob_start();
		echo '<meta http-equiv="Content-type" content="'.Oxygen::GetContentType().';charset='.Oxygen::GetCharset().'" />';
		echo '<base href="'.new Html(Oxygen::GetHrefBaseFull()).'" />';

		echo Js::BEGIN;
		if (self::$window_scoping_enabled){
			echo "if(window.name!=".new Js(self::$window_hash)."){";
			echo "  var window_hash=".new Js(Oxygen::HashRandom32()).";";
			echo "  window.name=window_hash;";
			echo "  window.location.href=".new Js(__BASE__.Oxygen::MakeHrefPreservingValues(array('window'=>'X','old_window'=>Oxygen::$window_hash))) . ".replace('window=X','window='+window_hash);";
			echo "}";
		}

		// fix for Javascript for non unicode encodings
		if (!Oxygen::IsCharsetUnicode()){
			echo "encodeURIComponent=function(s){s=escape(s);while(s.indexOf('/')>= 0)s=s.replace('/','%2F');while(s.indexOf('+')>=0)s=s.replace('+','%2B');return s;};";
			echo "decodeURIComponent=function(s){while(s.indexOf('%2B')>=0)s=s.replace('%2B','+');while(s.indexOf('%2F')>=0)s=s.replace('%2F','/');return unescape(s);};";
		}

		echo "var oxygen_encoding = ".new Js(Oxygen::GetCharset()).";";
		echo "var oxygen_lang = ".new Js(Oxygen::GetLang()).";";
		echo "var oxygen_base = ".new Js(__BASE__).";";

		echo "var oxygen_exceptions = {};";
		echo "window.onerror = function(msg,url,line){ if (oxygen_exceptions[msg+url+line]===undefined) { new Ajax.Request(".new Js(new ActionOxygenRecordJavascriptException('XXX1','XXX2')).".replace('XXX1',encodeURIComponent(msg)).replace('XXX2',encodeURIComponent(line)),{method:'GET',encoding:oxygen_encoding}); oxygen_exceptions[msg+url+line]=1; } else { oxygen_exceptions[msg+url+line]++; } };";
		echo Js::END;

		echo '<script type="text/javascript" src="'.__BASE__.'oxy/jsc/jquery.js"></script>'.Js::BEGIN.'jQuery.noConflict();'.Js::END; // jQuery has to be loaded before prototype and set to no-conflict mode.
		echo '<script type="text/javascript" src="'.__BASE__.'oxy/jsc/jquery-ui.js"></script>';
		echo '<script type="text/javascript" src="'.__BASE__.'oxy/jsc/prototype.js"></script>';
		echo '<script type="text/javascript" src="'.__BASE__.'oxy/jsc/scriptaculous-effects.js"></script>';
		echo '<script type="text/javascript" src="'.__BASE__.'oxy/jsc/date.js"></script>';
		echo '<script type="text/javascript" src="'.__BASE__.'oxy/jsc/fix.js"></script>';


		echo '<script type="text/javascript" src="'.__BASE__.'oxy/jsc/oxygen.js"></script>';
		echo '<link href="'.__BASE__.'oxy/css/reset.css" rel="stylesheet" type="text/css" />';
		echo '<link href="'.__BASE__.'oxy/css/oxygen.css" rel="stylesheet" type="text/css" />';
		echo '<link href="'.__BASE__.'favicon.ico" rel="icon" type="image/x-icon" />';

		if (Browser::IsIOS()) {
			echo '<link href="'.__BASE__.'oxy/css/touchscroll.css" rel="stylesheet" type="text/css" />';
			echo '<script type="text/javascript" src="'.__BASE__.'oxy/jsc/touchscroll.js"></script>';
			echo '<link href="'.__BASE__.'favicon.png" rel="apple-touch-icon" type="image/png" />';
		}

		$r = ob_get_clean();
		return $r;
	}




	//
	//
	// LoginControl
	//
	//
	/** @var LoginControlBase */
	private static $login_control = null;
	/** @return LoginControlBase */
	public static function GetLoginControl(){
		if (is_null(self::$login_control)){
			try {
				new ReflectionClass('LoginControl'); // <-- this will throw a mere exception if the class is not found, which will prevent a nasty FATAL php error in the next line.
			}
			catch (Exception $ex){
				return null;
			}
			self::$login_control = new LoginControl();
		}
		return self::$login_control;
	}
	public static function SetLoginControl(LoginControlBase $value){ self::$login_control = $value; }




	//
	//
	// Misc
	//
	//
	public static function Hash($that){ return strtoupper(md5(str_rot13(md5(sha1($that))))); }
	public static function Hash32($value){ return strtoupper(substr(md5(strval($value)),0,8)); }
	public static function HashRandom(){ return ID::Random()->AsHex() . ID::Random()->AsHex() . ID::Random()->AsHex() . ID::Random()->AsHex(); }
	public static function HashRandom32(){ return ID::Random()->AsHex(); }

	public static function SplitSearchString($searchstring){
		return preg_split('/[\\s,]*\\"([^\\"]+)\\"[\\s,]*|[\\s,]*\'([^\']+)\'[\\s,]*|[\\s,]+/', $searchstring, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	}
	public static function IsID($that){
		return 1==preg_match('/^[a-fA-F0-9]{8}$/',$that);
	}
	public static function IsEmail($that){
		return 1==preg_match('/.+@.+$/',$that);
	}
	public static function IsIPV4Address($that){
		return 1==preg_match('/([1-2]?[0-9])?[0-9]\.([1-2]?[0-9])?[0-9]\.([1-2]?[0-9])?[0-9]\.([1-2]?[0-9])?[0-9]$/',$that);
	}
	public static function IsURL($that){
		return 1==preg_match('/(https?|ftp):\/\/.+/',$that);
	}
	public static function IsMacAddress($that){
		return mb_ereg("([[:xdigit:]]{2})-([[:xdigit:]]{2})-([[:xdigit:]]{2})-([[:xdigit:]]{2})-([[:xdigit:]]{2})-([[:xdigit:]]{2})", $that) && $that!="00-00-00-00-00-00";
	}
	public static function SendEmail($from_name,$from_email,$rcpt,$subject,$body){
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: '. $from_name . ' <'. $from_email .'>'."\r\n";
		$headers .= 'Sender: '. $from_email ."\r\n";
		$msg = '<html><head>';
		$msg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
		$msg .= '<title>'.$subject.'</title>';
		$msg .= '</head><body>';
		$msg .= str_replace( array('<','>') , array("\n<",">\n") ,$body );
		$msg .= '</body></html>';
		$subject = '=?UTF-8?B?'.base64_encode($subject).'?=';
		mail($rcpt, $subject, $msg, $headers);
	}

	public static function GetMemoryLimit(){
		$s = trim(strtoupper(ini_get('memory_limit')));
		$r = intval($s);
		switch (substr($s,strlen($s)-1,1)) {
			case 'K': return $r * 1024;
			case 'M': return $r * 1024 * 1024;
			case 'G': return $r * 1024 * 1024 * 1024;
		}
		return $r;
	}
	public static function GetMemoryUsage(){
		return memory_get_usage(true);
	}




	private static $default_icon_type = 'gif';
	public static function GetDefaultIconType(){ return self::$default_icon_type; }
	public static function SetDefaultIconType($value){ self::$default_icon_type = $value; }




	//
	//
	// Serialization
	//
	//
	private static $is_ig_active = false;
	public static function SerializeWithIgBinary($data){
		self::$is_ig_active = true;
		$r = igbinary_serialize( $data );
		self::$is_ig_active = false;
		return $r;
	}
	public static function UnserializeWithIgBinary($data){
		self::$is_ig_active = true;
		$r = igbinary_unserialize( $data );
		self::$is_ig_active = false;
		return $r;
	}
	public static function SerializeWithPhp($data){
		return serialize( $data );
	}
	public static function UnserializeWithPhp($data){
		return unserialize( $data );
	}
	public static function SerializeWithTheBestAvailableMethod($data){
		if (IS_IGBINARY_AVAILABLE) {
			self::$is_ig_active = true;
			$r = igbinary_serialize( $data );
			self::$is_ig_active = false;
			return $r;
		}
		else
			return serialize( $data );
	}
	public static function UnserializeWithTheBestAvailableMethod($data){
		if (IS_IGBINARY_AVAILABLE) {
			self::$is_ig_active = true;
			$r = igbinary_unserialize( $data );
			self::$is_ig_active = false;
			return $r;
		}
		else
			return unserialize( $data );
	}
	public static function SerializeWithTheCurrentMethod($data){
		if (self::$is_ig_active)
			return igbinary_serialize( $data );
		else
			return serialize( $data );
	}
	public static function UnserializeWithTheCurrentMethod($data){
		if (self::$is_ig_active)
			return igbinary_unserialize($data);
		else
			return unserialize( $data );
	}



	//
	//
	// Serve file
	//
	//
	public static function ServeData( $data , $save_as , $mime = null , $requires_caching = true ){
		$filename = Oxygen::GetTempFolder(true).Oxygen::HashRandom32().'.dat';
		file_put_contents($filename,$data);
		Oxygen::ServeFile($filename,$save_as,$mime,$requires_caching);
		try {unlink($filename);} catch(Exception $ex){}
	}
	public static function ServeFile( $filename , $save_as = null , $mime = null , $requires_caching = true ){
		if (!is_readable($filename)) throw new Exception('File not found: '. $filename);
		try {
			$size = filesize($filename);
			$mime = is_null($mime) ? Fs::GetMimeType($filename) : $mime;
			$save_as = is_null($save_as) ? basename($filename) : $save_as;
			$range = 0;
			$length = $size;

			while (ob_get_level()>0) ob_end_clean();
			if(ini_get('zlib.output_compression')) ini_set('zlib.output_compression', 'Off');
			Oxygen::ClearHttpHeaders();
			Oxygen::AddHttpHeader('Content-Type: '.$mime);
			Oxygen::AddHttpHeader('Content-Disposition: attachment; filename="'.$save_as.'"');
			Oxygen::AddHttpHeader("Content-Transfer-Encoding: binary");
			Oxygen::AddHttpHeader('Accept-Ranges: bytes');
			if ($requires_caching){
				Oxygen::AddHttpHeader("Cache-control: private");
				Oxygen::AddHttpHeader('Pragma: private');
				Oxygen::AddHttpHeader('Expires: ' . gmdate('D, d M Y H:i:s', time() + 60 * 60 * 24 * 100) . ' GMT'); // 100 days
			}

	    if (isset($_SERVER['HTTP_RANGE'])) {
				list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
				list($range) = explode(",",$range,2);
				list($range, $range_end) = explode("-", $range);
				$range = intval($range);
				if (!$range_end)
					$range_end = $size - 1;
				else
					$range_end = intval($range_end);
		    $length = $range_end - $range + 1;
		    Oxygen::AddHttpHeader("HTTP/1.1 206 Partial Content");
		    Oxygen::AddHttpHeader("Content-Length: $length");
		    Oxygen::AddHttpHeader("Content-Range: bytes $range-$range_end/$size");
	    }
	    else {
				Oxygen::AddHttpHeader("Content-Length: $length");
	    }
			Oxygen::SendHttpHeaders();

			set_time_limit(0);
			$chunksize = 1 * 1024 * 1024;
			$bytes_send = 0;
			$f = fopen($filename, 'r');
			if ($f === false) throw new Exception('Cannot open file: '.$filename);
			if ($range > 0) fseek($f, $range);
			while (!feof($f) && (!connection_aborted()) && ($bytes_send<$length)) {
				$buffer = fread($f, $chunksize);
				print($buffer);
				flush();
				$bytes_send += strlen($buffer);
			}
			fclose($f);
		}
		catch (Exception $ex){
			// we cannot send the exceptions along with the files...
			Debug::RecordExceptionAndDie($ex,'File Server Exception Handler ('.$filename.')');
		}
	}

	

	//
	//
	// Info
	//
	//
	/** @var closure */
	private static $application_info_generator = null;
	public static function GetApplicationInfoGenerator() { return self::$application_info_generator; }
	public static function SetApplicationInfoGenerator( $function ) { self::$application_info_generator = $function; }
	public static function GetApplicationInfo(){ if (is_null(self::$application_info_generator)) return null; $f = self::$application_info_generator; return $f(); }
	public static function GetInfo(){
		$rr = array();

		$r = array();
		$r['Date and time'] = Language::FormatDateTime(XDateTime::Now());
		$r['Current action'] = Oxygen::GetActionName();
		$r['Current mode'] = Oxygen::GetActionMode();
		$r['Current language'] = Oxygen::GetLang();
		$r['Content type'] = Oxygen::GetContentType();
		$r['Remote IP'] = array_key_exists('REMOTE_ADDR',$_SERVER)?$_SERVER['REMOTE_ADDR']:'';
		$r['HTTP headers'] = implode("\n",Oxygen::GetHttpHeaders());
		$rr[] = $r;


		$r = array();
		$r['Application name'] = Oxygen::GetApplicationName();
		$r['Entry PHP Script'] = Oxygen::GetCurrentPhpScript();
		$a = Oxygen::GetDeveloperEmails();
		$r['Developer e-mails'] = implode(', ',$a).(empty($a)?' *** NOT DEFINED ***':'');
		$r['Environment'] = (Oxygen::IsDevelopment()?'DEVELOPMENT':'PRODUCTION').(DEBUG?' DEBUG':'').(PROFILE?' PROFILE':'');
		$f = Oxygen::GetTempFolder();
		$s = $f; if (is_dir($f)) { try{ $ff = $f.'/'.ID::Random()->AsHex(); file_put_contents($ff,'test'); unlink($ff); } catch(Exception $ex){ $s .= ' *** NO WRITE PERMISSION ***'; } } else { $s .= ' *** NOT FOUND ***'; }
		$r['Temp folder (local)'] = $s;

		$f = Oxygen::GetSharedTempFolder();
		$s = $f; if (is_dir($f)) { try{ $ff = $f.'/'.ID::Random()->AsHex(); file_put_contents($ff,'test'); unlink($ff); } catch(Exception $ex){ $s .= ' *** NO WRITE PERMISSION ***'; } } else { $s .= ' *** NOT FOUND ***'; }
		$r['Temp folder (shared)'] = $s;

		$f = Oxygen::GetLogFolder();
		$s = $f; if (is_dir($f)) { try{ $ff = $f.'/'.ID::Random()->AsHex(); file_put_contents($ff,'test'); unlink($ff); } catch(Exception $ex){ $s .= ' *** NO WRITE PERMISSION ***'; } } else { $s .= ' *** NOT FOUND ***'; }
		$r['Log folder'] = $s;

		$f = Oxygen::GetDataFolder();
		$s = $f; if (is_dir($f)) { try{ $ff = $f.'/'.ID::Random()->AsHex(); file_put_contents($ff,'test'); unlink($ff); } catch(Exception $ex){ $s .= ' *** NO WRITE PERMISSION ***'; } } else { $s .= ' *** NOT FOUND ***'; }
		$r['Data folder'] = $s;
		$rr[] = $r;

		$r = array();
		$r['ORM caching'] = Oxygen::IsItemCacheEnabled() ? 'Enabled' : 'Disabled';
		$r['APC available'] = IS_APC_AVAILABLE ? 'Yes' : 'No';
		$r['MEMCACHED available'] = IS_MEMCACHED_AVAILABLE ? 'Yes' : 'No';
		$r['IGBINARY available'] = IS_IGBINARY_AVAILABLE ? 'Yes' : 'No';

		$r['Application scoping'] = Scope::$APPLICATION->GetModeTranslated() . (IS_IGBINARY_AVAILABLE?'+IGBINARY':'');
		$r['Database scoping'] = Scope::$DATABASE->GetModeTranslated() . (IS_IGBINARY_AVAILABLE?'+IGBINARY':'');
		$r['Session scoping'] = Scope::$SESSION->GetModeTranslated() . (IS_IGBINARY_AVAILABLE?'+IGBINARY':'') . ' - ' . Oxygen::GetSessionHash() . (Oxygen::IsSessionScopingEnabled() ? '' : ' *** Session scoping is disabled ***');
		$r['Window scoping'] = Scope::$WINDOW->GetModeTranslated() . (IS_IGBINARY_AVAILABLE?'+IGBINARY':'') . ' - ' . Oxygen::GetWindowHash() . (Oxygen::IsWindowScopingEnabled() ? '' : ' *** Window scoping is disabled ***');

		$rr[] = $r;

		$r = array();
		$r['Charset'] = Oxygen::GetCharset();
		$r['Languages'] = implode(', ',Oxygen::GetLangs());
		$r['Default action name'] = Oxygen::GetDefaultActionName();
		$r['Login control name'] = get_class(Oxygen::GetLoginControl());
		$r['Url pins'] = implode(', ',array_keys(Oxygen::GetUrlPins()));
		$r['Code folders'] = implode("\n",Oxygen::GetCodeFolders());
		$r['Dictionaries'] = implode("\n",Oxygen::GetDictionaryFiles());
		$r['Database upgrade scripts'] = implode("\n",Oxygen::GetDatabaseUpgradeFiles());
		$rr[] = $r;

		$r = Oxygen::GetApplicationInfo();
		if (!is_null($r))
			$rr[] = $r;

		// extra info:
		$r = array();
		$r['$_SERVER'] = var_export($_SERVER,true);
		$r['$_GET'] = var_export($_GET,true);
		$r['$_POST'] = var_export($_POST,true);
		$r['$_FILES'] = var_export($_FILES,true);
		$r['$_COOKIE'] = var_export($_COOKIE,true);
		$rr[] = $r;

		return $rr;
	}
	public static function GetInfoAsText($info = null){
		$r = '';
		if (is_null($info)) $info = Oxygen::GetInfo();
		foreach ($info as $a){
			foreach ($a as $label=>$value){
				$i = 0;
				foreach (explode("\n",$value) as $v){
					$r .= $i++ == 0 ? sprintf('%-26s',$label) : str_repeat(' ',26);
					$r .= ' | '.$v;
					$r .= "\n";
				}
			}
			$r .= "\n";
		}
		return $r;
	}
	public static function GetInfoAsHtml($info = null){
		$r = '';
		if (is_null($info)) $info = Oxygen::GetInfo();
		$r .= '<table cellspacing="0" cellpadding="0" border=0">';
		foreach ($info as $a){
			foreach ($a as $label=>$value){
				$r .= '<tr>';
				$r .= '<td style="font:11px/13px Courier New,monospace;white-space:pre;color:#888888;padding:3px 6px;width:180px;vertical-align:top;">'.new Html($label).'&nbsp;</td>';
				$r .= '<td style="font:11px/13px Courier New,monospace;white-space:pre;color:#222222;padding:3px 6px;border-left:1px solid #dddddd;">'.new Html($value).'&nbsp;</td>';
				$r .= '</tr>';
			}
			$r .= '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
		}
		$r .= '</table>';
		return $r;
	}
}






<?php

class Debug {
	private static $serial = null;
	private static $first = null;
	private static $entries = array();
	private static $immediate = false;

	public static function Render($entries = null){
		if (is_null($entries)) $entries = self::$entries;
		for ($i = 0; $i<count($entries); $i++)
			echo self::GetEntryAsHtml($i,$entries);
	}
	public static function GetEntriesAsText(){
		$r = '';
		for ($i = 0; $i<count(self::$entries); $i++)
			$r .= self::GetEntryAsText($i,self::$entries);
		return $r;
	}
	private static function GetEntryAsHtml($index=null,$entries = null){
		if (is_null($entries)) $entries = self::$entries;
		if (is_null($index)) $index = count($entries) - 1;
		$prev_time = $index == 0 ? 0 : $entries[$index-1][0];
		$r = '<pre>';
		$r .= self::format_timespan($entries[$index][0]) . ' <i>(+' . self::format_timespan($entries[$index][0] - $prev_time) . ')</i>: ' . $entries[$index][1] . "\n";
		$r .= '</pre>';
		$r .= "\n";
		return $r;
	}
	private static function GetEntryAsText($index=null,$entries = null){
		if (is_null($entries)) $entries = self::$entries;
		if (is_null($index)) $index = count($entries) - 1;
		$prev_time = $index == 0 ? 0 : $entries[$index-1][0];
		$r = self::format_timespan($entries[$index][0]) . ' (+' . self::format_timespan($entries[$index][0] - $prev_time) . '): ' . $entries[$index][1] . "\n";
		return $r;
	}

	public static function CountEntries(){ return count(self::$entries); }
	public static function HasEntries(){ return count(self::$entries) > 0; }
	public static function GetEntryText( $index ){ return $index < count(self::$entries) ? self::$entries[$index][1] : null; }
	public static function GetEntryDateTime( $index ){ return $index < count(self::$entries) ? new XDateTime(self::$entries[$index][0]) : null; }
	public static function GetEntryTimeSpan( $index ){ return $index < count(self::$entries) ? new XTimeSpan((self::$entries[$index][0] - self::$first)*1000) : null; }
	public static function GetEntryTimeSpanSincePreviousEntry( $index ){ return $index < count(self::$entries) ? ($index==0 ? new XTimeSpan(0) : new XTimeSpan((self::$entries[$index][0] - self::$entries[$index-1][0])*1000)) : null; }

	public static function IsImmediateFlushingEnabled(){
		return self::$immediate;
	}
	public static function EnableImmediateFlushing(){
		self::$entries = array();
		self::$immediate = true;
		while(ob_get_level()!=0) ob_end_clean();
		Oxygen::SendHttpHeaders();
		ob_start();
	}

	public static function GetDateTimeStart(){
		return new XDateTime( intval(self::$first) );
	}
	public static function GetSecondsElapsed(){
		return microtime(true) - self::$first;
	}
	public static function Init(){
		self::$entries = array();
		self::$first = microtime(true);
		if (DEBUG) self::Add('Start');
	}
  private static function Add($message) {
  	$time = microtime(true);
		if (is_null(self::$first)) {
  		self::$first = $time;
  		$e = array(0,$message);
		}
		else $e = array($time - self::$first,$message);

 		self::$entries[] = $e;
		if (self::$immediate){
			while(ob_get_level()!=0) ob_end_clean();
			if (CLI) {
				echo self::GetEntryAsText();
			}
			else {
				echo self::GetEntryAsHtml();
				echo "<script>window.scrollBy(0,50);</script>";
			}
			flush();
			ob_start();
		}
	}
	private static function format_timespan($timespan){
		$sec = intval( $timespan );
		$msec = intval ( ($timespan - $sec) * 1000 );
		$min = intval( $sec / 60 );
		$sec -= $min * 60;
		$r = '';
		if ($min < 10) $r .= '0';
		$r.=$min . '\'';
		if ($sec < 10) $r .= '0';
		$r.=$sec . '"';
		if ($msec < 10) $r .= '0';
		if ($msec < 100) $r .= '0';
		$r.=$msec;
		return $r;
	}





  public static function Write($message){ self::Add($message); }
	public static function Dump($var){ ob_start(); var_dump($var); $s = ob_get_clean(); self::Add($s); }
	public static function Tick(){ self::Write('&bull;'); }


	public static function StopAndSave(){
		if (empty(self::$entries)) return;
		Oxygen::EnsureLogFolder();
		$f = Oxygen::GetLogFolder();
		self::$serial = str_replace(',','.',sprintf('%0.3f',microtime(true)));
		file_put_contents( $f .'/'.self::$serial.'.log', serialize(array( 'head' => Oxygen::GetInfo() , 'body' => self::$entries )));
	}
	public static function ShowConsole(){
		Console::BeginPopup('oxy/img/console_tab_logs_active.png','Quick log','Quick log '.self::$serial);
		Console::RenderInfo( Oxygen::GetInfo() );
		self::Render();
		Console::EndPopup();
	}

	public static function GetVariableAsString($value,$detail=array(20,10,5),$level=0){
		if (is_null($value)) return '{null}';
		if (is_string($value)) return '{string:'.strlen($value).':\''.$value.'\'}';
		if (is_int($value)) return '{int:'.$value.'}';
		if (is_float($value)) return '{float:'.$value.'}';
		if (is_bool($value)) return '{bool:'.($value?'true':'false').'}';
		if ($value instanceof ID) return '{id:'.$value->AsHex().'|'.$value->AsInt().'}';
		if ($value instanceof XDate) return '{XDate:'.$value->Format('Y-m-d').'}';
		if ($value instanceof XTime) return '{XTime:'.$value->Format('H:i:s').'}';
		if ($value instanceof XDateTime) return '{XDateTime:'.$value->Format('Y-m-d H:i:s').'}';
		if ($value instanceof XTimeSpan) return '{XTimeSpan:'.$value->AsInt().'|'.Language::FormatTimeSpan($value,true,true).'}';
		if ($value instanceof XList) {
			$value->Evaluate();
			$r = '{XList:'.count($value).':';
			if ($detail!==null&&!isset($detail[$level])) { $r .= '...}'; return $r; }
			$i = 0;
			foreach ($value as $k=>$v) {
				$r .= "\n" . str_repeat(' ',($level+1)*2);
				if ($detail!==null&&$i++>=$detail[$level]) { $r .= '...}'; return $r; }
				$r .= '['.(is_string($k)?'\''.$k.'\'':$k).'] = ';
				$r .= self::GetVariableAsString($v,$detail,$level+1);
			}
			$r .= "\n" . str_repeat(' ',$level*2).'}';
			return $r;
		}
		if (is_array($value)) {
			$r = '{array:'.count($value).':';
			if ($detail!==null&&!isset($detail[$level])) { $r .= '...}'; return $r; }
			$i = 0;
			foreach ($value as $k=>$v) {
				$r .= "\n" . str_repeat(' ',($level+1)*2);
				if ($detail!==null&&$i++>=$detail[$level]) { $r .= '...}'; return $r; }
				$r .= '['.(is_string($k)?'\''.$k.'\'':$k).'] = ';
				$r .= self::GetVariableAsString($v,$detail,$level+1);
			}
			$r .= "\n" . str_repeat(' ',$level*2).'}';
			return $r;
		}
		if ($value instanceof Traversable) {
			$r = '{'.get_class($value).':';
			if ($detail!==null&&!isset($detail[$level])) { $r .= '...}'; return $r; }
			$i = 0;
			foreach ($value as $k=>$v) {
				$r .= "\n" . str_repeat(' ',($level+1)*2);
				if ($detail!==null&&$i++>=$detail[$level]) { $r .= '...}'; return $r; }
				$r .= '['.(is_string($k)?'\''.$k.'\'':$k).'] = ';
				$r .= self::GetVariableAsString($v,$detail,$level+1);
			}
			$r .= "\n" . str_repeat(' ',$level*2).'}';
			return $r;
		}
		if (is_object($value)) {
			$r = '{'.get_class($value).':';
			if ($detail!==null&&!isset($detail[$level])) { $r .= '...}'; return $r; }
			$i = 0;
			if ($value instanceof stdClass) {
				foreach ((array)$value as $p=>$v){
					$r .= "\n" . str_repeat(' ',($level+1)*2);
					$r .= '$'.$p.' = ';
					$r .= self::GetVariableAsString($v,$detail,$level+1);
				}
			}
			else {
				for ($c = new ReflectionClass(get_class($value)); $c !== false; $c = $c->getParentClass()){
					$filter = $i++==0
						? ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PUBLIC
						: ReflectionProperty::IS_PRIVATE
						;
					foreach ($c->getProperties( $filter ) as $p){
						if ($p->isStatic()) continue;
						$r .= "\n" . str_repeat(' ',($level+1)*2);
						$p->setAccessible(true);
						$v = $p->getValue($value);
						if ($p->isPublic()) $r .= 'public ';
						if ($p->isPrivate()) $r .= 'private ' . $c->getName() . '::';
						if ($p->isProtected()) $r .= 'protected ';
						$r .= '$'.$p->getName().' = ';
						$r .= self::GetVariableAsString($v,$detail,$level+1);
					}
				}
			}
			$r .= "\n" . str_repeat(' ',$level*2).'}';
			return $r;
		}
		if (is_resource($value)) return '{resource}';
		if (is_callable($value)) return '{callable}';
		return '{unknown type}';
	}

	private static $instuments = array();
	private static $instrument_timers = array();
	private static $instrument_durations = array();

	public static function InstrumentBegin( $instrument = null ){
		$a = debug_backtrace();
		$f = !is_null($instrument) ? $instrument : $a[1]['class'] . '::' . $a[1]['function'];
		//$level = count(self::$instuments);
		//self::Add( str_repeat('&rsaquo;',$level+1) . 'BEGIN ' . $f);
		array_push( self::$instuments , $f );
		array_push( self::$instrument_timers , microtime(true) );
	}
	public static function InstrumentEnd( $instrument = null ){
		$t = microtime(true);
		$a = debug_backtrace();
		$f = !is_null($instrument) ? $instrument : $a[1]['class'] . '::' . $a[1]['function'];
		$ff = null;
		$d = 0.0;
		while ($ff != $f){
			//$is_current = is_null($ff);
			$ff = array_pop( self::$instuments );
			$tt = array_pop( self::$instrument_timers );
			$d = $t - $tt;
			if (!array_key_exists($ff,self::$instrument_durations)) self::$instrument_durations[$ff] = 0;
			self::$instrument_durations[$ff] += $d;
			//$level = count(self::$instuments);
			//self::Add( str_repeat('&rsaquo;',$level+1) . 'END ' . $ff . ': [' .self::format_timespan($d) . '/' . self::format_timespan(self::$instrument_durations[$ff])  . '] ');
		}
		return $d;
	}
	public static function WriteInstruments(){
		arsort(self::$instrument_durations);
		$s = '<div style="color:#aaaa33;">';
		foreach (self::$instrument_durations as $key=>$value){
			$s .= '[ '.self::format_timespan($value).' ]: ' . $key . '<br/>';
		}
		$s .= '</div>';
		self::Add($s);
	}


	public static function GetActionLine(Exception $ex){
		$act = Oxygen::GetAction();
		if (is_null($act)) return null;
		$file = strtolower( Oxygen::FindClassFile( get_class($act) ) );
		foreach ($ex->getTrace() as $t){
			if (!array_key_exists('file',$t)) continue;
			$f = strtolower( str_replace("\\",'/',$t['file']) );
			if (1==substr_count( $f , $file )){
				$line = null;
				if (array_key_exists('line',$t))
					$line = intval($t['line']);
				return $line;
			}
		}
		return null;
	}

	public static function GetExceptionReportAsArray(Exception $ex) {
		$r = array();
		for ($exx = $ex; !is_null($exx); $exx = $exx->getPrevious()){
			$a = array();
			$a['class_name'] = get_class($exx);
			$a['message'] = $exx->getMessage();
			if (!($ex instanceof JavascriptException)) {
				$a['file'] = basename($exx->getFile());
				$a['line'] = $exx->getLine();
				$a['code'] = Debug::GetExceptionTraceAsText($exx);
			}
			$r['trace'][] = $a;
		}
		$r['oxygen_info'] = Oxygen::GetInfo();
		$r['debug_entries'] = self::$entries;
		$r['database_queries'] = Database::GetQueries();
		return $r;
	}
	public static function GetExceptionReportAsText(Exception $ex){
		$r = '';
		for ($exx = $ex; !is_null($exx); $exx = $exx->getPrevious()){
			$r .= get_class($exx);
			$r .= "\n".$exx->getMessage();
			if (!($ex instanceof JavascriptException)) {
				$r .= "\n\n". basename($exx->getFile()).'['.$exx->getLine().']';
				$r .= "\n".Oxygen::GetActionName() .'['. Debug::GetActionLine($exx) .']';
				$r .= "\n\n".Debug::GetExceptionTraceAsText($exx);
				$r .= "\n";
			}
		}
		$r .= "\n\n";
		$r .= "\nOxygen info";
		$r .= "\n-----------";
		$r .= "\n".Oxygen::GetInfoAsText();
		$r .= "\nDebug entries";
		$r .= "\n-----------";
		$r .= "\n".Debug::GetEntriesAsText();
		$r .= "\nDatabase queries";
		$r .= "\n----------------";
		$r .= "\n".Database::GetQueriesAsText();
		return $r;
	}
	public static function GetExceptionReportAsHtml(Exception $ex){
		$r = '';
		$Q = "<!--\n\n\n\n\n\nEXCEPTION\n-->";
		for ($exx = $ex; !is_null($exx); $exx = $exx->getPrevious()){
			$r .= '<div style="color:#aaaaaa;margin:0;">'.$Q.new Html(get_class($exx)).$Q.'</div>';
			$r .= '<div style="color:#333333;margin:0;margin-bottom:20px;">'.$Q.new Html($exx->getMessage()).$Q.'</div>';
			if (!($ex instanceof JavascriptException)) {
				$r .= '<div style="font-style:italic;color:#333333;margin:0;">'.$Q.new Html(basename($exx->getFile()).'['.$exx->getLine().']').$Q.'</div>';
				$r .= '<div style="font-style:italic;color:#999999;margin:0;">'.new Html(Oxygen::GetActionName() .'['. Debug::GetActionLine($exx) .']').'</div>';
				$r .= '<pre style="font:11px/13px Courier New,monospace;margin-top:20px;white-space:pre;color:#999999;margin-bottom:30px;">'.new Html(Debug::GetExceptionTraceAsText($exx)).'</pre>';
			}
		}
		$r .= '<pre style="font:11px/13px Courier New,monospace;margin-top:20px;white-space:pre;color:#999999;"><b>Oxygen info</b><br/><br/>'.new Html(Oxygen::GetInfoAsText()).'</pre>';
		$r .= '<pre style="font:11px/13px Courier New,monospace;margin-top:20px;white-space:pre;color:#999999;"><b>Debug entries</b><br/><br/>'.new Html(Debug::GetEntriesAsText()).'</pre>';
		$r .= '<pre style="font:11px/13px Courier New,monospace;margin-top:20px;white-space:pre;color:#999999;"><b>Database queries</b><br/><br/>'.new Html(Database::GetQueriesAsText()).'</pre>';
		return $r;
	}

	private static function GetFileLinesAroundLine( $filename , $line , $lines = 9){
		$r = '';
		$spaces = intval(log($line+$lines,10))+1;
		if (file_exists($filename)) {
			$f = fopen($filename,'r');
			for($i=0; $i<$line-$lines-1; $i++) fgets($f);
			for(; $i<$line+$lines; $i++) {
				$s = fgets($f);
				if ($s === false) break;
				$r .= "\n" . ($i==$line-1?'# >> ':'#    ').sprintf('%'.$spaces.'d',$i+1).' # '. str_replace(array("\n","\r","\t"),array('','','  '),$s);
			}
			fclose($f);
		}
		return $r;
	}
	public static function GetExceptionTraceAsText(Exception $ex){
		$s = '';
		$a = $ex->getTrace();
		$iii = count($a);
		$ex->getFile();
		$ex->getLine();

		$is_legacy_error = count($a)>0 && array_key_exists('function',$a[0]) && $a[0]['function']=='user_error_handler';
		if ($is_legacy_error) $iii--;

		$file = realpath($ex->getFile());
		$s .= str_replace("\\",'/',substr($file,strlen(__ROOT__)+1)).'['.$ex->getLine().'] (#'.$iii--.')';
		$s .= Debug::GetFileLinesAroundLine($ex->getFile(),$ex->getLine());
		$s .="\n";

		foreach ($a as $t){
			if (array_key_exists('function',$t) && $t['function']=='user_error_handler'){
//				$t = $t['args'];
//				foreach ($t[4] as $key=>$value){
//					$value = Debug::GetVariableAsString($value);
//					$s .= '# $' . $key . ' = ' . str_replace("\n","\n# ",$value) . "\n";
//				}
//				$s .= "\n";
			}
			else {
				$s .="\n";
				if (array_key_exists('file',$t)) $s .= str_replace("\\",'/',substr(realpath($t['file']),strlen(__ROOT__)+1));
				if (array_key_exists('line',$t)) $s .= '['.$t['line'].'] ';
				$s .= '(#'.$iii--.')'. "\n" ;
				$s .= '# ' ;
				if (array_key_exists('class',$t)) $s .= $t['class'];
				if (array_key_exists('type',$t)) $s .= $t['type'];
				if (array_key_exists('function',$t)) $s .= $t['function'].'(';
				if (array_key_exists('args',$t)) {
					if (count($t['args'])>0){
						foreach ($t['args'] as $value){
							$value = Debug::GetVariableAsString($value);
							$s .= "\n#   " . str_replace("\n","\n#   ",$value);
						}
					$s .= "\n# ";
					}
				}
				if (array_key_exists('function',$t)) $s .= ')';
				$s .= "\n";
			}
		}
		return $s;
	}




	public static function RecordExceptionSilenced      (Exception $ex,$extra_developer_message = null) { return Debug::RecordException($ex,1,$extra_developer_message); }
	public static function RecordExceptionConverted     (Exception $ex,$extra_developer_message = null) { return Debug::RecordException($ex,2,$extra_developer_message); }
	public static function RecordExceptionRethrown      (Exception $ex,$extra_developer_message = null) { return Debug::RecordException($ex,3,$extra_developer_message); }
	public static function RecordExceptionServed        (Exception $ex,$extra_developer_message = null) { return Debug::RecordException($ex,4,$extra_developer_message); }
	public static function RecordExceptionServedDebug   (Exception $ex,$extra_developer_message = null) { return Debug::RecordException($ex,7,$extra_developer_message); }
	public static function RecordExceptionServedGeneric (Exception $ex,$extra_developer_message = null) { return Debug::RecordException($ex,5,$extra_developer_message); }
	public static function RecordExceptionAndDie        (Exception $ex,$extra_developer_message = null) {        Debug::RecordException($ex,6,$extra_developer_message); exit(); }
	private static function RecordException(Exception $ex,$way_handled,$extra_developer_message=null){
		$way_handled_message = '';
		switch ($way_handled){
			case 1: $way_handled_message = 'Silenced'; break;
			case 2: $way_handled_message = 'Converted'; break;
			case 3: $way_handled_message = 'Rethrown'; break;
			case 4: $way_handled_message = 'Served as is'; break;
			case 5: $way_handled_message = 'Served with generic message'; break;
			case 6: $way_handled_message = 'Execution halted'; break;
		}
		$timestamp = microtime(true);
		$serial = str_replace(',','.',sprintf('%0.3f',$timestamp));
		$key = get_class($ex) . '_' . md5($ex->getFile() . $ex->getLine() . substr($ex->getMessage(),0,20));


		$subject = Oxygen::IsDevelopment()?'[DEV]':'';
		$subject .= '['.Oxygen::GetApplicationName().']';
		$subject .= ' '.get_class($ex);
		// $subject .= $hits<=1?'':' x'.$hits;
		$subject .= ' ('.$way_handled_message.')';
		if (!is_null($extra_developer_message)) $subject .= ' '.$extra_developer_message;
		$subject .= ' #'.$serial;


		// log to apache log directly
		try {
			$error_log_message = '';
			for ($exx = $ex; !is_null($exx); $exx = $exx->getPrevious()) {
				if ($ex instanceof JavascriptException)
					$error_log_message .= '   '.get_class($exx).': '.$exx->getMessage();
				else
					$error_log_message .= '   '.get_class($exx).': '.$exx->getMessage().' in '.$exx->getFile().'['.$exx->getLine().']';
			}
			error_log( $subject.': ' . $error_log_message );
		}
		catch (Exception $ex) {}



		// external logger, maybe
		$external_recorder = Oxygen::GetExceptionRecorder();
		if (is_callable($external_recorder)) {
			try {
				$continue = $external_recorder($ex,array('serial' => $serial
					,'way_handled_message' => $way_handled_message
					,'extra_developer_message' => $extra_developer_message
					,'report'=> self::GetExceptionReportAsText($ex)
				));
				if ($continue === false) return $serial.' (exception sent to external recorder)';
			}
			catch (Exception $exxxxxxxxx){}
		}





		$lck_filename = Oxygen::GetLogFolder().'/'.Fs::GetSafeFilename($key).'.lck';
		$acc_filename = Oxygen::GetLogFolder().'/'.Fs::GetSafeFilename($key).'.acc';
		$err_filename = Oxygen::GetLogFolder().'/'.Fs::GetSafeFilename($serial.'.'.get_class($ex).'.'.$way_handled_message).'.err';

		$must_record_immediately = true;
		$must_initiate_accumulator = true;

		try {
			// check if an accumulator is running
			$f = fopen($lck_filename,'a+');
			if (!flock($f,LOCK_EX | LOCK_NB)) {
				fclose($f);

				// we use deferred recording only if we know that an accumulator is running (therefore, we know that the creation of accumulators is supported and possible).
				file_put_contents( $acc_filename , $serial . "\n" , FILE_APPEND|LOCK_EX );
				$must_record_immediately = false;

				// check again if the accumulator has stopped running!
				$ff = fopen($lck_filename,'a+');
				if (!flock($ff,LOCK_EX | LOCK_NB)) {
					fclose($ff);
					$must_initiate_accumulator = false; // is is running
				}
				else {
					flock($ff,LOCK_UN);
					fclose($ff);
				}
			}
			else {
				flock($f,LOCK_UN);
				fclose($f);
			}
		}
		catch (Exception $ex) {
			$must_record_immediately = false;   // TODO: fallback to memcached or apc?
			$must_initiate_accumulator = false;
		}

		$exception_recorded = false;
		if ($must_record_immediately || $must_initiate_accumulator) {

			$head = Oxygen::GetInfo();

			$body = '<div style="font:italic 11px/13px Courier New,monospace;color:#999999;padding:5px 5px 4px 5px;border:1px solid #cccccc;">';
			$body .= '-- '.new Html($way_handled_message).' --';
			$body .= is_null($extra_developer_message)?'':"<br/>".new Html($extra_developer_message);
			$body .= '<br/>#'.$serial;
			$body .= '</div>';
			$body .= '<br/>';
			$body .= Debug::GetExceptionReportAsHtml($ex);


			if ($must_record_immediately) {
				// record to file
				try {
					Oxygen::EnsureLogFolder();
					file_put_contents( $err_filename, serialize(array( 'head' => $head , 'body' => $body )));
				}
				catch (Exception $ex) {}

				// send e-mail
				foreach (Oxygen::GetDeveloperEmails() as $email) {
					try {
						Oxygen::SendEmail( 'oxygen@'.Oxygen::GetApplicationName() , $email , $email , $subject , $body );
					}
					catch (Exception $ex) {}
				}
				$exception_recorded = true;
			}

			if ($must_initiate_accumulator) { // initiate the accumulator
				try {
					Http::Fire(Oxygen::GetHrefBaseFull('http',80).'oxy/record.php','POST',array( // TODO: this is troublesome! We should not change to http, but Fire has a problem with https...
						 'serial' => $serial
						,'exception_recorded' => $exception_recorded?'true':'false'
						,'acc_filename' => $acc_filename
						,'lck_filename' => $lck_filename
						,'err_filename' => $err_filename
						,'app_name' => Oxygen::GetApplicationName()
						,'emails' => serialize(Oxygen::GetDeveloperEmails())
						,'subject' => $subject
						,'head' => serialize($head)
						,'body' => $body
						));
				}
				catch (Exception $ex) {}
			}
		}


		return $serial.($exception_recorded?'':' (exception recording deferred)');
	}
}
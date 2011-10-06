<?php
if ($_SERVER["SERVER_NAME"] == 'localhost') {
	define('DEBUG',true);
	define('PROFILE',true); // for the time being
}
else {
	define('DEBUG',false);
	define('PROFILE',false);
}
if (PROFILE) { require('oxy/src/Utils/Profiler.php'); Profiler::Start(); }
require('oxy/src/OmniType/_OmniType.php');
require('oxy/src/OmniType/OmniType.php');
require('oxy/src/OmniType/OmniValue.php');
require('oxy/src/Types/ID.php');
require('oxy/src/Oxygen.php');
require('oxy/src/Utils/Scope.php');


function __autoload($class) {
	$f = Oxygen::FindClassFile($class);
	if (is_null($f)) return;
	require($f);
}


function user_error_handler($severity, $msg, $filename, $linenum, $content) {
	throw new ErrorException($msg, 0, $severity, $filename , $linenum);
}
set_error_handler("user_error_handler");

function user_exception_handler($ex) {
	while ( ob_get_level() > 0 ) ob_end_clean();
//	echo '<html><body>';
	echo '<meta http-equiv="Content-type" content="'.Oxygen::GetContentType().';charset='.Oxygen::GetCharset().'" />';
	echo '<div style="position:fixed;top:0;bottom:0;left:0;right:0;z-index:999;background:#555577;">';
	echo '<div style="position:fixed;top:30px;bottom:30px;left:30px;right:30px;z-index:1000;background:#dddddd;">';
	echo '<div style="position:fixed;top:39px;bottom:39px;left:39px;right:39px;z-index:1000;border:1px solid #bbbbbb;background:#fafafa;overflow:auto;padding:30px;">';
	echo '<div style="font:bold 18px/22px Trebuchet MS,sans-serif;border-bottom:1px solid #bbbbbb;color:#555555;">Fatal error</div>';
	echo '<div style="font:bold 13px/14px Trebuchet MS,sans-serif;margin:20px 0;">'.$ex->getMessage().'</div>';
	if (!($ex instanceof ApplicationException || $ex instanceof SecurityException)){
		echo '<div style="font:11px/13px Courier New,monospace;border-left:1px solid #bbbbbb;margin-left:3px;padding:10px;white-space:pre;color:#999999;">'.new Html(Log::GetTraceAsString($ex)).'</div>';
		echo '<div style="font:11px/13px Courier New,monospace;border-left:1px solid #bbbbbb;margin-left:3px;margin-top:20px;padding:10px;white-space:pre;color:#999999;">'.new Html(Database::GetQueriesAsString()).'</div>';
	}
	echo '<div style="font:italic 11px/13px Trebuchet MS,sans-serif;color:#bbbbbb;margin-top:50px;">Oxygen</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
	//	echo '</body></html>';
	// try{ Log::Record($ex); }catch(Exception $exx){}
}
set_exception_handler("user_exception_handler");


function user_shutdown_function() {
	chdir(dirname(__FILE__));
	chdir('..');
	Progress::Shutdown();
	if (PROFILE) Profiler::Stop();
}
register_shutdown_function('user_shutdown_function');


function dump($var){
	$root = realpath('.');
	list($callee) = debug_backtrace();
  echo '<div style="border:solid 1px #bbbbbb;">';
	echo '<div style="color:#333333;background:#e8e8e8;padding:4px;font:bold italic 11px/13px Trebuchet MS;">' . str_replace("\\",'/',substr($callee['file'],strlen($root)+1)).'['.$callee['line'].']</div>';
	echo '<div style="color:#777777;background:#f8f8f8;padding:9px 9px 0px 9px;font:11px/13px Courier New,monospace;white-space:pre;">'.new Html(Log::GetVariableAsString($var)).'</div>';
	echo '<div style="color:#aaaaaa;background:#f8f8f8;padding:0 2px 2px 0;font:italic 9px/10px Trebuchet MS;text-align:right;">Oxygen</div>';
  echo '</div>';
}

/** @return LinqIterator */
function from($whatever){
	$a = func_get_args();
	if (count($a)!=1) return new LinqIterator(new ArrayIterator($a));
	if ($whatever instanceof LinqIterator) return $whatever;
	if (is_array($whatever)) return new LinqIterator(new ArrayIterator($whatever));
	if ($whatever instanceof Traversable) return new LinqIterator(new IteratorIterator($whatever));
	return new LinqIterator(new ArrayIterator(array($whatever)));
}



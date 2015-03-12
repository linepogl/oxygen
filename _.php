<?php

$f = getcwd(); while(!is_dir("$f/oxy")) { $f.='/..'; if (!is_dir($f)) die("Cannot find directory oxy."); }
define('__ROOT__',realpath($f));
//define('__ROOT__',substr(__FILE__,0,-10));  // 10==strlen('/oxy/_.php')
define('__BASE__',substr($_SERVER['SCRIPT_NAME'],0,1-(strlen(realpath($_SERVER['SCRIPT_FILENAME']))-strlen(__ROOT__))));
define('__OFFSET__',substr($_SERVER['SCRIPT_NAME'],strlen(__BASE__),strrpos($_SERVER['SCRIPT_NAME'],'/')-strlen(__BASE__)+1));

chdir(__ROOT__);


define('DEBUG',array_key_exists('debug',$_GET));
define('PROFILE',array_key_exists('profile',$_GET));
define('RESET',array_key_exists('reset',$_GET) ? ($_GET['reset']==='hard'?'hard':'soft') : null);
define('LOCALHOST',!isset($_SERVER["SERVER_NAME"]) || $_SERVER["SERVER_NAME"] == 'localhost');

//define('IS_IGBINARY_AVAILABLE',function_exists('igbinary_serialize'));
define('IS_IGBINARY_AVAILABLE',false);
define('IS_APC_AVAILABLE',function_exists('apc_exists'));
define('IS_MEMCACHED_AVAILABLE',class_exists('Memcached'));


if (PROFILE) { require('oxy/src/Utils/Profiler.php'); Profiler::Start(); }
require('oxy/src/TypeSystem/XType.php');
require('oxy/src/TypeSystem/XValue.php');
require('oxy/src/Types/ID.php');
require('oxy/src/Actions/Action.php');
require('oxy/src/Oxygen.php');
require('oxy/src/Utils/Fs.php');
require('oxy/src/Utils/Scope.php');
require('oxy/src/Utils/Database.php');
require('oxy/src/Utils/ResourceManager.php');
require('oxy/src/Engine/XMeta.php');
require('oxy/oxy.php');

function user_error_handler($severity, $msg, $filename, $linenum, /** @noinspection PhpUnusedParameterInspection */ $content) {
	if (0 == (error_reporting() & $severity)) return;
	throw new ErrorException($msg, 0, $severity, $filename , $linenum);
}
set_error_handler('user_error_handler');

function user_shutdown_function(){
	try{
		chdir(__ROOT__);
		$a = error_get_last();
		if (!empty($a)){
			Debug::RecordExceptionAndDie(new ErrorException($a['message'],0,$a['type'],$a['file'],$a['line']),'Shutdown Exception Handler');
		}
	} catch(Exception $exx) {}
}
register_shutdown_function('user_shutdown_function');


function dump($var,$detail=array(50,10,10)){
	$root = realpath('.');
	list($callee) = debug_backtrace();
  echo '<div style="border:solid 1px #bbbbbb;">';
	echo '<div style="color:#333333;background:#e8e8e8;padding:4px;font:bold italic 11px/13px Trebuchet MS;">' . str_replace("\\",'/',substr($callee['file'],strlen($root)+1)).'['.$callee['line'].']</div>';
	echo '<div style="color:#777777;background:#f8f8f8;padding:9px 9px 0px 9px;font:11px/13px Courier New,monospace;white-space:pre;">'.new Html(Debug::GetVariableAsString($var,$detail)).'</div>';
	echo '<div style="color:#aaaaaa;background:#f8f8f8;padding:0 2px 2px 0;font:italic 9px/10px Trebuchet MS;text-align:right;">Oxygen</div>';
  echo '</div>';
}


/**
 * @param $whatever ...
 * @return LinqIterator
 */
function from($whatever){
	$a = func_get_args();
	if (count($a)!=1) return new LinqIterator(new ArrayIterator($a));
	if ($whatever instanceof LinqIterator) return $whatever;
	if (is_array($whatever)) return new LinqIterator(new ArrayIterator($whatever));
	if ($whatever instanceof Iterator) return new LinqIterator($whatever);
	if ($whatever instanceof Traversable) return new LinqIterator(new IteratorIterator($whatever));
	return new LinqIterator(new ArrayIterator(array($whatever)));
}


function id( $iid_or_siid_or_null ){
	if (is_null($iid_or_siid_or_null)) return null;
	return new ID($iid_or_siid_or_null);
}
function iid( $id_or_item_or_null ){
	if ($id_or_item_or_null instanceof ID) return $id_or_item_or_null->AsInt();
	if ($id_or_item_or_null instanceof XItem) return $id_or_item_or_null->id->AsInt();
	if (is_int($id_or_item_or_null)) return $id_or_item_or_null;
	return null;
}
function hex( $id_or_item_or_null ){
	if ($id_or_item_or_null instanceof ID) return $id_or_item_or_null->AsHex();
	if ($id_or_item_or_null instanceof XItem) return $id_or_item_or_null->id->AsHex();
	if (is_int($id_or_item_or_null)) { $id_or_item_or_null = new ID($id_or_item_or_null); return $id_or_item_or_null->AsHex(); }
	return null;
}


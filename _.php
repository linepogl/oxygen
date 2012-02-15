<?php
define('__ROOT__',substr(__DIR__,0,strrpos(__DIR__,'/')));
define('DEBUG',array_key_exists('debug',$_GET));
define('PROFILE',array_key_exists('profile',$_GET));
define('DEV',!isset($_SERVER["SERVER_NAME"]) || $_SERVER["SERVER_NAME"] == 'localhost');

if (PROFILE) { require('oxy/src/Utils/Profiler.php'); Profiler::Start(); }
require('oxy/src/OmniType/_OmniType.php');
require('oxy/src/OmniType/OmniType.php');
require('oxy/src/OmniType/OmniValue.php');
require('oxy/src/Types/ID.php');
require('oxy/src/Oxygen.php');
require('oxy/src/Utils/Scope.php');
require('oxy/src/Utils/Database.php');
require('oxy/src/Engine/XMeta.php');

function dump($var){
	$root = realpath('.');
	list($callee) = debug_backtrace();
  echo '<div style="border:solid 1px #bbbbbb;">';
	echo '<div style="color:#333333;background:#e8e8e8;padding:4px;font:bold italic 11px/13px Trebuchet MS;">' . str_replace("\\",'/',substr($callee['file'],strlen($root)+1)).'['.$callee['line'].']</div>';
	echo '<div style="color:#777777;background:#f8f8f8;padding:9px 9px 0px 9px;font:11px/13px Courier New,monospace;white-space:pre;">'.new Html(Debug::GetVariableAsString($var)).'</div>';
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

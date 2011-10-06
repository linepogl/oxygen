<?php

set_include_path('..');
chdir('..');
require('oxy/_.php');

Oxygen::Init();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<base href="<?php echo Oxygen::GetBaseHref(); ?>../" />
	<?php echo Oxygen::GetHead(); ?>
	<title>Oxygen</title>
	<style type="text/css">
		body { padding:10px; }
		body, td { font:12px/14px Trebuchet MS,sans-serif; }
		h2 { font:bold 14px/20px Trebuchet MS,sans-serif; margin:10px 0 2px 0; }
		.message { margin:5px 0; }
	</style>
</head>
<body class="<?php echo Browser::GetCssClasses(); ?>">


<?php
/** @var $f SplFileInfo  */
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator('oxy/tst')) as $f){
	if ($f->isDir()) continue;

	Test::Reset();
	include($f->getPathname());
	echo '<h2>'.$f->getPathname().'</h2>';
	Test::Render();
}



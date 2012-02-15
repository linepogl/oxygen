<?php

class Fs {


	/**
	 * @param $dir string the directory to be scanned
	 * @return array a flat array with all files of the tree
	 */
	public static function GetTreeFilesFlat($dir) {
		$path		= '';
		$stack[]	= $dir;
		while ($stack) {
			$thisdir = array_pop($stack);
			if ($dircont = scandir($thisdir)) {
				$i=0;
				while (isset($dircont[$i])) {
					if ($dircont[$i] !== '.' && $dircont[$i] !== '..') {

						$current_file = $thisdir.'/'.$dircont[$i];
						if (is_file($current_file)) {
							$path[] = $thisdir.'/'.$dircont[$i];
						}
						else if (is_dir($current_file)) {
							$path[] = $thisdir.'/'.$dircont[$i].'/';
							$stack[] = $current_file;
						}
					}
					$i++;
				}
			}
		}
		return $path;
	}

	public static function GetTreeSize($path){
		if (!is_dir($path))
			return filesize($path);
		$size=0;
		foreach (scandir($path) as $file){
			if ($file=='.' or $file=='..') continue;
			$size+=self::GetTreeSize($path.'/'.$file);
		}
		return $size;
	}

	public static function Destroy($path) {
		if (is_dir($path) && !is_link($path)) {
			if ($dh = opendir($path)) {
				while (($sf = readdir($dh)) !== false) {
					if ($sf == '.' || $sf == '..') continue;
					self::Destroy($path.'/'.$sf);
				}
				closedir($dh);
			}
			rmdir($path);
		}
		else {
			unlink($path);
		}
	}



}
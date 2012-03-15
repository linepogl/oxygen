<?php

class Fs {

	public static function GetSafeFilename($filename) {
		return str_replace(
			array(" ","&","+","/","\\","'",'"')
		 ,array("_","_","_","_","_","_","_")
		 ,$filename);
	}

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


	public static function Ensure($path) {
		if (!is_dir($path))
			return mkdir($path,0777,true);
		return true;
	}


	public static function GetMimeType($filename){
		if (!file_exists($filename)) {
			$mime = 'application/octet-stream';
		}
		else {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $filename);
			finfo_close($finfo);
		}
		if ($mime == 'application/octet-stream') { // fail-over
			$x = strrpos($filename,'.');
			if ($x !== false){
				$ext = substr($filename,$x+1);
				return self::GetMimeTypeByExtension($ext);
			}
		}
		return $mime;
	}

	public static function GetMimeTypeByExtension($ext) {
		switch (strtolower($ext)) {
			case 'jpg': return 'image/jpeg';
			case 'jpeg': return 'image/jpeg';
			case 'gif': return 'image/gif';
			case 'png': return 'image/png';
			case 'css': return 'text/css';
			case 'htm': return 'text/html';
			case 'html': return 'text/html';
			case 'flv': return 'video/x-flv';
			case 'txt': return 'text/plain';
			case 'bmp': return 'image/bmp';
			case 'tif': return 'image/tiff';
			case 'bz2': return 'application/x-bzip';
			case 'gz': return 'application/x-gzip';
			case 'tar': return 'application/x-tar';
			case 'zip': return 'application/zip';
			case 'aif': return 'audio/aiff';
			case 'aiff': return 'audio/aiff';
			case 'mid': return 'audio/mid';
			case 'midi': return 'audio/mid';
			case 'mp3': return 'audio/mpeg';
			case 'ogg': return 'audio/ogg';
			case 'wav': return 'audio/wav';
			case 'wma': return 'audio/x-ms-wma';
			case 'asf': return 'video/x-ms-asf';
			case 'asx': return 'video/x-ms-asf';
			case 'avi': return 'video/avi';
			case 'mp4': return 'video/mp4';
			case 'mpg': return 'video/mpeg';
			case 'mpeg': return 'video/mpeg';
			case 'wmv': return 'video/x-ms-wmv';
			case 'wmx': return 'video/x-ms-wmx';
			case 'xml': return 'text/xml';
			case 'xsl': return 'text/xsl';
			case 'doc': return 'application/msword';
			case 'rtf': return 'application/msword';
			case 'xls': return 'application/excel';
			case 'pps': return 'application/vnd.ms-powerpoint';
			case 'ppt': return 'application/vnd.ms-powerpoint';
			case 'pdf': return 'application/pdf';
			case 'ai': return 'application/postscript';
			case 'eps': return 'application/postscript';
			case 'psd': return 'image/psd';
			case 'swf': return 'application/x-shockwave-flash';
			case 'ra': return 'audio/vnd.rn-realaudio';
			case 'ram': return 'audio/x-pn-realaudio';
			case 'rm': return 'application/vnd.rn-realmedia';
			case 'rv': return 'video/vnd.rn-realvideo';
			case 'exe': return 'application/x-msdownload';
			case 'pls': return 'audio/scpls';
			case 'm3u': return 'audio/x-mpegurl';
		}
		return 'application/octet-stream';
	}
	
}
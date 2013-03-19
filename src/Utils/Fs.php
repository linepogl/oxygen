<?php

class Fs {


	public static function GetSafeFilename($filename) {
		return Str::Replace(
			array(" ","&","+","/","\\","'",'"')
		 ,array("_","_","_","_","_" ,"_","_")
		 ,$filename);
	}

	public static function GetAllFilePathsRecursively( $dir ) {
		$r = array();
		if (is_dir($dir)) {
			$stack = array($dir);
			while(!empty($stack)) {
				$f = array_pop($stack);
				$a = scandir($f);
				if (is_array($a)) foreach ($a as $ff) {
					if ($ff == '.' || $ff == '..') continue;
					$fff = "$f/$ff";
					if (is_dir($fff))
						array_push($stack,$fff);
					else
						$r[$fff] = $fff;
				}
			}
		}
		return $r;
	}

	/**
	 * @param $dir string the directory to be scanned
	 * @return array a flat array with all files of the tree
	 */
	public static function GetTreeFilesFlat($dir) {
		$path		= array();
		if (is_dir($dir)) {
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

	public static function Unlink($path) {
		if (file_exists($path)) {
			if (is_dir($path) && !is_link($path)) {
				if ($dh = opendir($path)) {
					while (($sf = readdir($dh)) !== false) {
						if ($sf == '.' || $sf == '..') continue;
						self::Unlink($path.'/'.$sf);
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


	public static function Ensure($path) {
		$r = true;
		if (!is_dir($path)) {
			$r = mkdir($path,0755,true);
			chmod($path,0755);
		}
		return $r;
	}

	public static function EnsureHardlink($original,$replica) {
		if (file_exists($original)) return;
		// There is a bug somewhere with link(), and sometimes it fails randomly.
		// We will make 10 attempts to create the hardlink.
		for ($i = 0; $i < 9; $i++) {
			try {
				link( $original , $replica );
				return;
			}
			catch (Exception $ex) {}
		}
		link( $original , $replica );  // the 10th time do it without try-catch.
	}

	public static function Browse($folder,$pattern='*'){
		$r = array();
		$regexp = $pattern == '*' ? null : '/^' . str_replace(array('\\*','\\?'),array('.*','.'),preg_quote($pattern)) . '$/';
		if (is_dir($folder)) {
			$a = scandir($folder);
			if (is_array($a)) {
				foreach ($a as $f) {
					if ($f == '.' || $f == '..') continue;
					if (is_null($regexp) || preg_match($regexp,$f))	$r[] = $f;
				}
			}
		}
		return $r;
	}
	public static function BrowseRecursively($folder,$pattern='*'){
		$r = array();
		$regexp = $pattern == '*' ? null : '/^' . str_replace(array('\\*','\\?'),array('.*','.'),preg_quote($pattern)) . '$/';
		if (is_dir($folder)) {
			$a = scandir($folder);
			if (is_array($a)) {
				foreach ($a as $f) {
					if ($f == '.' || $f == '..') continue;
					if (is_null($regexp) || preg_match($regexp,$f))	$r[] = $f;
					if (is_dir("$folder/$f")) foreach (self::BrowseRecursively("$folder/$f",$pattern) as $ff) $r[] = "$f/$ff";
				}
			}
		}
		return $r;
	}


	public static function GetMimeType($filename,$fail_over_virtual_filename=null){
		if (!file_exists($filename)) {
			$mime = 'application/octet-stream';
		}
		else {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $filename);
			finfo_close($finfo);
		}
		if ($mime == 'application/octet-stream') { // fail-over
			$s = is_null($fail_over_virtual_filename) ? $filename : $fail_over_virtual_filename;
			$x = strrpos($s,'.');
			if ($x !== false){
				$ext = substr($s,$x+1);
				return self::GetMimeTypeByExtension($ext);
			}
		}
		return $mime;
	}

	public static function GetExtension($filename) {
		return pathinfo($filename,PATHINFO_EXTENSION);
	}
	public static function GetExtensionByMimeType($mime) {
		switch (strtolower($mime)) {
			case 'image/jpeg'                        : return 'jpg';
			case 'image/gif'                         : return 'gif';
			case 'image/png'                         : return 'png';
			case 'text/css'                          : return 'css';
			case 'text/html'                         : return 'html';
			case 'video/x-flv'                       : return 'flv';
			case 'text/plain'                        : return 'txt';
			case 'image/bmp'                         : return 'bmp';
			case 'image/tiff'                        : return 'tif';
			case 'application/x-bzip'                : return 'bz2';
			case 'application/x-gzip'                : return 'gz';
			case 'application/x-tar'                 : return 'tar';
			case 'application/zip'                   : return 'zip';
			case 'audio/aiff'                        : return 'aif';
			case 'audio/mid'                         : return 'mid';
			case 'audio/mpeg'                        : return 'mp3';
			case 'audio/ogg'                         : return 'ogg';
			case 'audio/wav'                         : return 'wav';
			case 'audio/x-ms-wma'                    : return 'wma';
			case 'video/x-ms-asf'                    : return 'asf';
			case 'video/avi'                         : return 'avi';
			case 'video/mp4'                         : return 'mp4';
			case 'video/x-m4v'                       : return 'm4v';
			case 'video/mpeg'                        : return 'mpg';
			case 'video/x-ms-wmv'                    : return 'wmv';
			case 'video/x-ms-wmx'                    : return 'wmx';
			case 'text/xml'                          : return 'xml';
			case 'text/xsl'                          : return 'xsl';
			case 'application/msword'                : return 'doc';
			case 'application/excel'                 : return 'xls';
			case 'application/vnd.ms-powerpoint'     : return 'ppt';
			case 'application/pdf'                   : return 'pdf';
			case 'application/postscript'            : return 'eps';
			case 'image/psd'                         : return 'psd';
			case 'application/x-shockwave-flash'     : return 'swf';
			case 'audio/vnd.rn-realaudio'            : return 'ra';
			case 'audio/x-pn-realaudio'              : return 'ram';
			case 'application/vnd.rn-realmedia'      : return 'rm';
			case 'video/vnd.rn-realvideo'            : return 'rv';
			case 'application/x-msdownload'          : return 'exe';
			case 'audio/scpls'                       : return 'pls';
			case 'audio/x-mpegurl'                   : return 'm3u';
		}
		return '';
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
			case 'm4v': return 'video/x-m4v';
			case 'mpg': return 'video/mpeg';
			case 'mpeg': return 'video/mpeg';
			case 'wmv': return 'video/x-ms-wmv';
			case 'wmx': return 'video/x-ms-wmx';
			case 'xml': return 'text/xml';
			case 'xsd': return 'text/xml';
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


	public static function ConsumeFileFromUrl( $url , $destination_filename = null ){
		if (is_null($destination_filename)) $destination_filename = Oxygen::GetTempFolder().'/'.ID::Random()->AsHex().'.dat';
		try {
			set_time_limit(0);
			Http::Download($url,$destination_filename);
		}
		catch (Exception $ex){
			Debug::RecordExceptionConverted($ex);
			try{ unlink( $destination_filename ); } catch(Exception $ex){}
			throw new ApplicationException(Lemma::Pick('MsgErrorWhileDownloadingFile'));
		}
		return $destination_filename;
	}
	public static function ConsumePostedFile( $posted_file , $destination_filename = null){
		if (is_null($destination_filename)) $destination_filename = Oxygen::GetTempFolder().'/'.ID::Random()->AsHex().'.dat';
		try{
			if (!is_file($posted_file['tmp_name'])) throw new Exception('The $posted_file[\'tmp_name\'] is not a file.');
			$size = filesize($posted_file['tmp_name']);
			$test = move_uploaded_file( $posted_file['tmp_name'] , $destination_filename);
			if ($test === false) throw new Exception('The function move_uploaded_file has failed.');
			if (!file_exists($destination_filename)) throw new Exception('The function move_uploaded_file has failed.');
			if (filesize($destination_filename) != $size) throw new Exception('The function move_uploaded_file has failed.');
		}
		catch (Exception $ex){
			Debug::RecordExceptionConverted($ex);
			try{ unlink( $destination_filename ); } catch(Exception $ex){}
			throw new ApplicationException(Lemma::Pick('MsgErrorWhileUploadingFile'));
		}
		return $destination_filename;
	}
	public static function ConsumeRawData( $raw_data , $destination_filename = null ){
		if (is_null($destination_filename)) $destination_filename = Oxygen::GetTempFolder().'/'.ID::Random()->AsHex().'.dat';
		try {
			$file = fopen( $destination_filename , 'w' );
			fwrite( $file , $raw_data );
			fclose( $file );
		}
		catch (Exception $ex){
			Debug::RecordExceptionConverted($ex);
			try{ unlink( $destination_filename ); } catch(Exception $ex){}
			throw new ApplicationException(Lemma::Pick('MsgErrorWhileUploadingFile'));
		}
		return $destination_filename;
	}

	public static function GetImageDimensions($filename,&$width,&$height) {
		$a = @getimagesize($filename);
		if (is_array($a) && count($a) > 1)
			list($width,$height) = $a;
		else
			$width = $height = 0;
	}
	public static function FitImageDimensions($filename,$max_width,$max_height,&$width,&$height) {
		if ($max_width <= 0 || $max_height <= 0) { $width = $height = 0; return; }
		self::GetImageDimensions($filename,$width,$height);
		if ($width <= 0 || $height <= 0) { $width = $height = 0; return; }
		$width_ratio = $width / $max_width;
		$height_ratio = $height / $max_height;
		if ($width_ratio > $height_ratio) {
			$width = $max_width;
			$height = floor($height / $width_ratio);
		}
		else {
			$height = $max_height;
			$width = floor($width / $height_ratio);
		}
	}



}
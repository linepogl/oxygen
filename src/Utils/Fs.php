<?php

class Fs {


	public static function GetSafeFilename($filename) {
		return Str::Replace(
			array(" ","&","+","/","\\","'",'"')
		 ,array("_","_","_","_","_" ,"_","_")
		 ,$filename);
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
				$dircont = scandir($thisdir);
				if ($dircont !== false) {
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
		if (is_link($path)) {
			unlink($path);
		}
		elseif (file_exists($path)) {
			if (is_dir($path)) {
				$messages = array();
				$dh = opendir($path);
				if ($dh !== false) {
					while (($sf = readdir($dh)) !== false) {
						if ($sf == '.' || $sf == '..') continue;
						try {
							self::Unlink($path.'/'.$sf);
						}
						catch (Exception $ex) {
							$messages[] = $ex->getMessage();
						}
					}
					closedir($dh);
				}
				try {
					rmdir($path);
				}
				catch (Exception $ex) {
					$messages[] = $ex->getMessage();
				}
				if (!empty($messages)) {
					throw new Exception( implode('',$messages) );
				}
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

	public static function CreateHardlink($original,$replica) {
		if (!file_exists($original))
			throw new Exception('Cannot create hardlink: the original file ('.$original.') was not found.');
		if (file_exists($replica))
			throw new Exception('Cannot create hardlink: there is already a file ('.$replica.') with this name.');
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

	const BROWSE_ALL = 0x00;
	const BROWSE_NO_FILES = 0x01;
	const BROWSE_NO_FOLDERS = 0x02;
	public static function Browse($folder,$pattern='*',$flags = self::BROWSE_ALL){
		$r = array();
		$len = strlen($folder)+1;
		if (is_dir($folder)) {
			if($flags&self::BROWSE_NO_FOLDERS) {
				// Version 1: FILES ONLY
				$a=glob("$folder/$pattern");
				if(is_array($a)) foreach($a as $p) if(!is_dir($p)) $r[$p]=substr($p,$len);
				///.
			}
			elseif($flags&self::BROWSE_NO_FILES) {
				// Version 2: FOLDERS ONLY
				$a=glob("$folder/$pattern",GLOB_ONLYDIR);
				if(is_array($a)) foreach($a as $p) $r[$p]=substr($p,$len);
				///.
			}
			else {
				// Version 3: FILES & FOLDERS
				$a=glob("$folder/$pattern");
				if(is_array($a)) foreach($a as $p) $r[$p]=substr($p,$len);
				///.
			}
		}
		return $r;
	}

	public static function BrowseRecursively($folder,$pattern='*',$flags = self::BROWSE_ALL) {
		$r=array();
		$len=strlen($folder)+1;
		$stack=array();
		if(is_dir($folder)) $stack[]=$folder;

		if($flags&self::BROWSE_NO_FOLDERS) {
			if($pattern==='*') {
				// Version 1a: ONLY FILES, without pattern
				while(!empty($stack)) {
					$folder=array_pop($stack);
					$a=glob("$folder/*");
					if(is_array($a)) foreach($a as $p) {
						if(is_dir($p))
							$stack[]=$p;
						else
							$r[$p]=substr($p,$len);
					}
				} ///.
			}
			else {
				// Version 1b: ONLY FILES, with pattern
				while(!empty($stack)) {
					$folder=array_pop($stack);
					$a=glob("$folder/$pattern");
					if(is_array($a)) foreach($a as $p) if(!is_dir($p)) $r[$p]=substr($p,$len);
					$a=glob("$folder/*",GLOB_ONLYDIR);
					if(is_array($a)) foreach($a as $p) $stack[]=$p;
				} ///.
			}
		}
		elseif($flags&self::BROWSE_NO_FILES) {
			if($pattern==='*') {
				// Version 2a: FOLDERS ONLY, without pattern
				while(!empty($stack)) {
					$folder=array_pop($stack);
					$a=glob("$folder/*",GLOB_ONLYDIR);
					if(is_array($a)) foreach($a as $p) { $r[$p]=substr($p,$len); $stack[]=$p; }
				}
				///.
			}
			else {
				// Version 2b: FOLDERS ONLY, with pattern
				while(!empty($stack)) {
					$folder=array_pop($stack);
					$a=glob("$folder/$pattern",GLOB_ONLYDIR);
					if(is_array($a)) foreach($a as $p) $r[$p]=substr($p,$len);
					$a=glob("$folder/*",GLOB_ONLYDIR);
					if(is_array($a)) foreach($a as $p) $stack[]=$p;
				} ///.
			}
		}
		else {
			if($pattern==='*') {
				// Version 3a: FILES & FOLDERS, without pattern
				while(!empty($stack)) {
					$folder=array_pop($stack);
					$a=glob("$folder/*");
					if(is_array($a)) foreach($a as $p) { $r[$p]=substr($p,$len); if(is_dir($p)) $stack[]=$p; }
				} ///.
			}
			else {
				// Version 3b: FILES & FOLDERS, with pattern
				while(!empty($stack)) {
					$folder=array_pop($stack);
					$a=glob("$folder/$pattern");
					if(is_array($a)) foreach($a as $p) $r[$p]=substr($p,$len);
					$a=glob("$folder/*",GLOB_ONLYDIR);
					if(is_array($a)) foreach($a as $p) $stack[]=$p;
				} ///.
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
			$s = $fail_over_virtual_filename===null ? $filename : $fail_over_virtual_filename;
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
			case 'text/javascript'                   : return 'js';
			case 'application/json'                  : return 'json';
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
			case 'video/quicktime'                   : return 'mov';
			case 'video/x-m4v'                       : return 'm4v';
			case 'video/mpeg'                        : return 'mpg';
			case 'video/x-ms-wmv'                    : return 'wmv';
			case 'video/x-ms-wmx'                    : return 'wmx';
			case 'text/xml'                          : return 'xml';
			case 'text/xsl'                          : return 'xsl';
			case 'text/csv'                          : return 'csv';
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
			case 'js': return 'text/javascript';
			case 'json': return 'application/json';
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
			case 'mov': return 'video/quicktime';
			case 'm4v': return 'video/x-m4v';
			case 'mpg': return 'video/mpeg';
			case 'mpeg': return 'video/mpeg';
			case 'wmv': return 'video/x-ms-wmv';
			case 'wmx': return 'video/x-ms-wmx';
			case 'xml': return 'text/xml';
			case 'xsd': return 'text/xml';
			case 'xsl': return 'text/xsl';
			case 'csv': return 'text/csv';
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
		if ($destination_filename===null) $destination_filename = Oxygen::GetTempFolder().'/'.ID::Random()->AsHex().'.dat';
		try {
			set_time_limit(0);
			Http::Download($url,$destination_filename);
		}
		catch (Exception $ex){
			Debug::RecordExceptionConverted($ex);
			try{ unlink( $destination_filename ); } catch(Exception $ex){}
			throw new ApplicationException(oxy::txtMsgErrorWhileDownloadingFile());
		}
		return $destination_filename;
	}
	public static function ConsumePostedFile( $posted_file , $destination_filename = null){
		if ($destination_filename===null) $destination_filename = Oxygen::GetTempFolder().'/'.ID::Random()->AsHex().'.dat';
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
			throw new ApplicationException(oxy::txtMsgErrorWhileUploadingFile());
		}
		return $destination_filename;
	}
	public static function ConsumeRawData( $raw_data , $destination_filename = null ){
		if ($destination_filename===null) $destination_filename = Oxygen::GetTempFolder().'/'.ID::Random()->AsHex().'.dat';
		try {
			$file = fopen( $destination_filename , 'w' );
			fwrite( $file , $raw_data );
			fclose( $file );
		}
		catch (Exception $ex){
			Debug::RecordExceptionConverted($ex);
			try{ unlink( $destination_filename ); } catch(Exception $ex){}
			throw new ApplicationException(oxy::txtMsgErrorWhileUploadingFile());
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
	public static function FitImageDimensions($filename,$max_width,$max_height,&$new_width,&$new_height) {
		if ($max_width <= 0 || $max_height <= 0) { $new_width = $new_height = 0; return; }
		self::GetImageDimensions($filename,$new_width,$new_height);
		if ($new_width <= 0 || $new_height <= 0) { $new_width = $new_height = 0; return; }
		$width_ratio = $new_width / $max_width;
		$height_ratio = $new_height / $max_height;
		if ($width_ratio > $height_ratio) {
			$new_width = $max_width;
			$new_height = floor($new_height / $width_ratio);
		}
		else {
			$new_height = $max_height;
			$new_width = floor($new_width / $height_ratio);
		}
	}

	public static function FitImageIn($filename,$max_width,$max_height) {
		$img_info = getimagesize( $filename );
		if (is_null($img_info)) throw new Exception('Cannot read image.');
		$cur_width = $img_info[0];
		$cur_height = $img_info[1];
		$mime = $img_info["mime"];
		ini_set('memory_limit', '1024M');
		$src = null;
		switch($mime){
			case "image/jpeg": $src = imagecreatefromjpeg($filename); break;
			case "image/gif": $src = imagecreatefromgif($filename); break;
			case "image/png": $src = imagecreatefrompng($filename); break;
			default: throw new Exception('Unknown image mime type.');
		}

		if ($max_width <= 0 || $max_height <= 0)
			throw new Exception('Width and height error.');
		if ($cur_width <= 0 || $cur_height <= 0)
			throw new Exception('Width and height error.');

		$width_ratio = $cur_width / $max_width;
		$height_ratio = $cur_height / $max_height;
		if ($width_ratio > $height_ratio) {
			$new_width = $max_width;
			$new_height = floor($cur_height / $width_ratio);
		}
		else {
			$new_height = $max_height;
			$new_width = floor($cur_width / $height_ratio);
		}

		$dst = imagecreatetruecolor($new_width, $new_height);
		imagecopyresized($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $cur_width, $cur_height);
		switch($mime){
			case "image/jpeg": imagejpeg($dst,$filename); break;
			case "image/gif": imagegif($dst,$filename); break;
			case "image/png": imagepng($dst,$filename); break;
			default: throw new Exception('Unknown image mime type.');
		}
		imagedestroy($src);
		imagedestroy($dst);
	}

	public static function Copy($src,$dst) {
		if (!file_exists($src)) return;
		if (is_dir($src)) {
			Fs::Ensure($dst);
			foreach (Fs::BrowseRecursively($src) as $f) {
				if (is_dir("$src/$f"))
					Fs::Ensure("$dst/$f");
				else
					copy("$src/$f","$dst/$f");
			}
		}
		else {
			copy($src,$dst);
		}
	}


}
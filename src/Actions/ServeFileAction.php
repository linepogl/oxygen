<?php

abstract class ServeFileAction extends Action  {
	public function GetDefaultMode(){ return self::MODE_RAW; }

	protected abstract function GetFilename();
	protected function GetSaveAsName(){ return basename($this->GetFilename()); }
	protected function GetMimeType(){ return Fs::GetMimeType($this->GetFilename()); }
	protected function RequiresCaching(){ return true; }

	public function OnBeforeRender() {
//		if (Browser::IsIE8() || Browser::IsIE7() || Browser::IsIE6()){
//			if (isset($_SERVER['HTTPS'])){
//				$s = $_SERVER['SCRIPT_NAME'];
//				$base = 'http://' . $_SERVER["SERVER_NAME"] . substr($s,0,strrpos($s,'/')+1);
//				header('Location: ' . $base . $this->GetHrefPlain() );
//				exit();
//			}
//		}
	}

	public function OnBytesSent( $total_bytes_sent_so_far , $seconds_ellapsed ){}
	public function Render() {
		try {
			$self = $this;
			Oxygen::ServeFile($this->GetFilename(),$this->GetSaveAsName(),$this->GetMimeType(),$this->RequiresCaching(),function($bytes_sent,$seconds)use($self){$self->OnBytesSent($bytes_sent,$seconds);});
		}
		catch (Exception $ex){
			throw new PageNotFoundException(Lemma::Pick('MsgFileNotFound'));
		}
	}
	public function OnAfterRender(){
		if ($this->IsModeRaw()) exit();
	}

}
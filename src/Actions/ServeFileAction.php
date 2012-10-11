<?php

abstract class ServeFileAction extends Action  {
	public function GetDefaultMode(){ return self::MODE_RAW; }

	protected function RequiresCaching(){ return true; }
	protected function GetMimeType(){ return Fs::GetMimeType($this->GetFilename()); }
	protected abstract function GetFilename();
	protected abstract function GetSaveAsName();

	public function Render() {

		if (Browser::IsIE8() || Browser::IsIE7() || Browser::IsIE6()){
			if (isset($_SERVER['HTTPS'])){
				$s = $_SERVER['SCRIPT_NAME'];
				$base = 'http://' . $_SERVER["SERVER_NAME"] . substr($s,0,strrpos($s,'/')+1);
				header('Location: ' . $base . $this->GetHrefPlain() );
				exit();
			}
		}

		Oxygen::ServeFile($this->GetFilename(),$this->GetSaveAsName(),$this->GetMimeType(),$this->RequiresCaching());

	}
}
<?php

abstract class ServeDataAction extends Action  {
	public function GetDefaultMode(){ return self::MODE_RAW; }

	protected abstract function GetData();
	protected abstract function GetSaveAsName();
	protected function GetMimeType(){ return 'application/octet-stream'; }
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

	public function Render() {
		Oxygen::ServeData($this->GetData(),$this->GetSaveAsName(),$this->GetMimeType(),$this->RequiresCaching());
	}
	public function OnAfterRender(){
		if ($this->IsModeRaw()) exit();
	}
}
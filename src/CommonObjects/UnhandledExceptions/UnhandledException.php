<?php

class UnhandledException extends XItem {

	public $ActionName;
	public $ActionLine;

	public $ExceptionClassName;
	public $ExceptionMessage;
	public $ExceptionFilename;
	public $ExceptionLine;
	public $ExceptionTrace;

	public $DateOccured;
	//public $idUser;
	public $Href;
	public $IsPostback;

	public static function FillMeta(XMeta $m){
		parent::FillMeta($m);
		$m->SetDBTableName('oxy_unhandled_exceptions');
		$m->ActionName = XMeta::String();
		$m->ActionLine = XMeta::Integer();
		$m->ExceptionClassName = XMeta::String();
		$m->ExceptionMessage = XMeta::String();
		$m->ExceptionFilename = XMeta::String();
		$m->ExceptionLine = XMeta::Integer();
		$m->ExceptionTrace = XMeta::String();
		$m->DateOccured = XMeta::DateTime();
		//$m->idUser = XMeta::ID();
		$m->Href = XMeta::String();
		$m->IsPostback = XMeta::Boolean();
	}


	public static function Record(Exception $ex){
		$date = XDateTime::Now();
		$date = $date->AddMonths(-1);
		Database::ExecuteDelete(self::Meta()->GetDBTableName(),'DateOccured<'.new Sql($date));

		$x = UnhandledException::Create();
		$x->ActionName = Oxygen::GetActionName();
		$x->ActionLine = Log::GetActionLine($ex);

		$x->ExceptionClassName = get_class($ex);
		$x->ExceptionMessage = $ex->getMessage();
		$x->ExceptionFilename = basename($ex->getFile());
		$x->ExceptionLine = $ex->getLine();
		$x->ExceptionTrace = Log::GetTraceAsString($ex);

		$x->DateOccured = XDateTime::Now();
		//$x->idUser = User::GetCurrent()->id;
		$x->Href = Oxygen::GetHref();
		$x->IsPostback = Oxygen::IsPostback();
		$x->Save();
	}

}


<?php

Database::SetPatchingSystem('oxygen','oxy_settings');
Database::AddPatcher('v','Version');

if (Database::BeginPatchingSystem()) {
	Database::ExecuteCreateStandardTable('oxy_settings','Version',Sql::Integer);
	Database::ExecuteInsert('oxy_settings','id',new ID(0));
}

if (Database::BeginPatch('v',1,'Initial tables')) {
	Database::ExecuteCreateTable('oxy_ids','TableName',Sql::String100 ,'LastID',Sql::ID);
	Database::ExecuteAddPrimaryKey('oxy_ids','TableName');

	Database::ExecuteCreateStandardTable('oxy_emails'
			,'XFrom',Sql::String255
			,'Rcpt',Sql::Text
			,'Subject',Sql::String255
			,'Body',Sql::Text
			,'DateSent',Sql::DateTime
			);

	Database::ExecuteCreateStandardTable('oxy_local_lemmas'
			,'Name',Sql::String255
			,'Overlap',Sql::Text
			);

	Database::ExecuteCreateStandardTable('oxy_unhandled_exceptions'
		,'ActionName',Sql::String255
		,'ActionLine',Sql::Integer
		,'ExceptionClassName',Sql::String255
		,'ExceptionMessage',Sql::Text
		,'ExceptionFilename',Sql::String255
		,'ExceptionLine',Sql::Integer
		,'ExceptionTrace',Sql::Text
		,'DateOccured',Sql::DateTime
		,'Href',Sql::Text
		,'IsPostback',Sql::Boolean
		);
	Database::ApplyPatch();
}
if (Database::BeginPatch('v',10,'Oxygen 1.10')) {
	Database::ApplyPatch();
}

if (Database::BeginPatch('v',11,'E-mails')) {
	Database::ExecuteDropTable('oxy_emails');
	Database::ExecuteDelete('oxy_ids','TableName='.new Sql('oxy_emails'));
	Database::ApplyPatch();
}
if (Database::BeginPatch('v',12,'Remove unhandled exceptions')) {
	Database::ExecuteDropTable('oxy_unhandled_exceptions');
	Database::ApplyPatch();
}
if (Database::BeginPatch('v',13,'Remove local lemmata')) {
	Database::ExecuteDropTable('oxy_local_lemmas');
	Database::ApplyPatch();
}

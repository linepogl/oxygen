<?php

Database::SetPatchingSystem('oxygen','oxy');
Database::AddPatcher('v','Version');

if (Database::BeginPatchingSystem()) {
	try { Database::ExecuteDropTable('oxy_settings'); } catch (Exception $ex){}
	try { Database::ExecuteDropTable('oxy_ids'); } catch (Exception $ex){}
	try { Database::ExecuteDropTable('oxy_emails'); } catch (Exception $ex){}
	try { Database::ExecuteDropTable('oxy_local_lemmas'); } catch (Exception $ex){}
	try { Database::ExecuteDropTable('oxy_unhandled_exceptions'); } catch (Exception $ex){}
	Database::ExecuteCreateStandardTable('oxy','Version',Sql::Integer);
	Database::ExecuteInsert('oxy','id',new ID(0));
}
if (Database::BeginPatch('v',1,'Initial tables')) {
	Database::ExecuteCreateTable('oxy_ids','TableName',Sql::String100 ,'LastID',Sql::ID);
	Database::ExecuteAddPrimaryKey('oxy_ids','TableName');
	Database::ApplyPatch();
}

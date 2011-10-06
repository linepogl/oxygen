<?php

$t = XDateTime::Make(2010,10,20,11,12,13)->GetTimestamp();
$x1 = new XDateTime($t);
$x2 = new XDate($t);
$x3 = new XTime($t);
$x4 = new XTimeSpan(123456);


Test::Begin('Auto Omni XDateTime recognition');

Test::Assert( JustDateTime::Type() === OmniType::Of($x1) , 'XDateTime --> JustDateTime');
Test::Assert( JustDate::Type() === OmniType::Of($x2) , 'XDate --> JustDate');
Test::Assert( JustTime::Type() === OmniType::Of($x3) , 'XTime --> JustTime');

Test::Begin('Just --> SQL literal');

Test::AssertEqual( '\'2010-10-20 11:12:13\'' , JustDateTime::ExportSqlLiteral( $x1 , Database::MYSQL ) );
Test::AssertEqual( '\'2010-10-20 00:00:00\'' , JustDateTime::ExportSqlLiteral( $x2 , Database::MYSQL ) );
Test::AssertEqual( '\'2000-01-01 11:12:13\'' , JustDateTime::ExportSqlLiteral( $x3 , Database::MYSQL ) );
Test::AssertEqual( '\'2010-10-20 00:00:00\'' , JustDate::ExportSqlLiteral( $x2 , Database::MYSQL ) );
Test::AssertEqual( '\'2000-01-01 11:12:13\'' , JustTime::ExportSqlLiteral( $x3 , Database::MYSQL ) );

Test::Begin('Nullable --> SQL literal');

Test::AssertEqual( '\'2010-10-20 11:12:13\'' , NullableDateTime::ExportSqlLiteral( $x1 , Database::MYSQL ) );
Test::AssertEqual( '\'2010-10-20 00:00:00\'' , NullableDateTime::ExportSqlLiteral( $x2 , Database::MYSQL ) );
Test::AssertEqual( '\'2000-01-01 11:12:13\'' , NullableDateTime::ExportSqlLiteral( $x3 , Database::MYSQL ) );
Test::AssertEqual( '\'2010-10-20 00:00:00\'' , NullableDate::ExportSqlLiteral( $x2 , Database::MYSQL ) );
Test::AssertEqual( '\'2000-01-01 11:12:13\'' , NullableTime::ExportSqlLiteral( $x3 , Database::MYSQL ) );


Test::Begin('new Sql()');

Test::AssertEqual( '\'2010-10-20 11:12:13\'' , strval(new Sql( $x1 ) ) );
Test::AssertEqual( '\'2010-10-20 00:00:00\'' , strval(new Sql( $x2 ) ) );
Test::AssertEqual( '\'2000-01-01 11:12:13\'' , strval(new Sql( $x3 ) ) );


Test::Begin('XTimeSpan');
Test::Assert( JustTimeSpan::Type() === OmniType::Of($x4) , 'XTimeSpan --> JustTimeSpan');
Test::AssertEqual( '123456' , JustTimeSpan::ExportSqlLiteral( $x4 , Database::MYSQL ) );
Test::AssertEqual( '123456' , NullableTimeSpan::ExportSqlLiteral( $x4 , Database::MYSQL ) );
Test::AssertEqual( '123456' , strval(new Sql( $x4 ) ) );



Test::Begin('JustDateTime --> URL string');

Test::AssertEqual( '20101020111213' , JustDateTime::ExportUrlString( $x1 , Database::MYSQL ) );
Test::AssertEqual( '20101020000000' , JustDateTime::ExportUrlString( $x2 , Database::MYSQL ) );
Test::AssertEqual( '20000101111213' , JustDateTime::ExportUrlString( $x3 , Database::MYSQL ) );
Test::AssertEqual( '20101020000000' , JustDate::ExportUrlString( $x2 , Database::MYSQL ) );
Test::AssertEqual( '20000101111213' , JustTime::ExportUrlString( $x3 , Database::MYSQL ) );

Test::Begin('NullableDateTime --> SQL literal');

Test::AssertEqual( '20101020111213' , NullableDateTime::ExportUrlString( $x1 , Database::MYSQL ) );
Test::AssertEqual( '20101020000000' , NullableDateTime::ExportUrlString( $x2 , Database::MYSQL ) );
Test::AssertEqual( '20000101111213' , NullableDateTime::ExportUrlString( $x3 , Database::MYSQL ) );
Test::AssertEqual( '20101020000000' , NullableDate::ExportUrlString( $x2 , Database::MYSQL ) );
Test::AssertEqual( '20000101111213' , NullableTime::ExportUrlString( $x3 , Database::MYSQL ) );

Test::Begin('Auto Omni XDateTime recognition --> SQL literal');

Test::AssertEqual( '\'2010-10-20 11:12:13\'' , OmniType::Of($x1)->ExportSqlLiteral( $x1 , Database::MYSQL ) );
Test::AssertEqual( '\'2010-10-20 00:00:00\'' , OmniType::Of($x2)->ExportSqlLiteral( $x2 , Database::MYSQL ) );
Test::AssertEqual( '\'2000-01-01 11:12:13\'' , OmniType::Of($x3)->ExportSqlLiteral( $x3 , Database::MYSQL ) );

Test::AssertEqual( '\'2010-10-20 11:12:13\'' , strval(new Sql( new XDateTime($t) ) ) );
Test::AssertEqual( '\'2010-10-20 00:00:00\'' , strval(new Sql( new XDate($t) ) ) );
Test::AssertEqual( '\'2000-01-01 11:12:13\'' , strval(new Sql( new XTime($t) ) ) );





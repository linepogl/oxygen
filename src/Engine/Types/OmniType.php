<?php

abstract class OmniType {


	public abstract function ConvertPdoToPhp($value);
	public abstract function ConvertPhpToPdo($value);
	public abstract function ConvertPhpToSql($value);

	public abstract function GetPdoType();
	
}

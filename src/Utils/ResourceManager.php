<?php

class ResourceManager {
	/** @var static */ protected static $static;
	public static function __static(){ return self::$static; }
	protected function __construct(){}
	public static function __register(){
		$new = new static();
		if (self::$static !== null)
			if (!(new ReflectionObject(self::$static))->isInstance($new))
				throw new Exception('The resource manager "'.get_class($new).'" must inherit "'.get_class(self::$static).'".');
		self::$static = new static();
	}
}

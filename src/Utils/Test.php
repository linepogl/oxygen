<?php


class Test {

	private static $tests = array();

	public static function Reset(){
		self::$tests = array();
	}
	public static function Begin($title){
		self::$tests[] = array(new InfoMessage($title));
	}
	public static function Log(Message $message){
		self::$tests[count(self::$tests)-1][] = $message;
	}
	public static function Assert($condition,$message){
		if (!$condition)
			self::Log(new ErrorMessage($message));
		else
			self::Log(new SuccessMessage($message));
	}
	public static function AssertEqual($expected,$given){
		self::Assert( $expected === $given , 'Expected ('.gettype($expected).') '.$expected.', got ('.gettype($given).') '.$given );
	}


	public static function Render(){

		foreach (self::$tests as $test) {
			echo new MessageControl($test);
		}

	}

}
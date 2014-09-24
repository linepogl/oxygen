<?php


abstract class Message {
	protected $value;
	protected $icon;
	public function __construct($value,_Icon $icon=null){ $this->value = strval($value);$this->icon=$icon; }
	public function __toString(){ return $this->value; }
	public final function AsString(){ return $this->value; }

	const INFO = 0;
	const SUCCESS = 1;
	const WARNING = 2;
	const QUESTION = 3;
	const SECURITY = 4;
	const ERROR = 5;
	const BUG = 6;
	private static $EnumType = array(
		 self::INFO => 'info'
		,self::SUCCESS => 'success'
		,self::WARNING => 'warning'
		,self::QUESTION => 'question'
		,self::SECURITY => 'security'
		,self::ERROR => 'error'
		,self::BUG => 'bug'
		);
	public static function ConvertTypeToCode($type){ return Enum::FromMap(self::$EnumType)->AsString($type); }
	public static function ConvertCodeToType($code){ return Enum::FromMap(self::$EnumType)->AsNumber($code); }



	public static function Make($severity,$value,$icon_name=null){
		switch($severity){
			default:
			case self::INFO: return new InfoMessage($value,$icon_name);
			case self::SUCCESS: return new SuccessMessage($value,$icon_name);
			case self::WARNING: return new WarningMessage($value,$icon_name);
			case self::QUESTION: return new QuestionMessage($value,$icon_name);
			case self::SECURITY: return new SecurityMessage($value,$icon_name);
			case self::ERROR: return new ErrorMessage($value,$icon_name);
			case self::BUG: return new BugMessage($value,$icon_name);
		}
	}

	public function GetCode(){ return self::ConvertTypeToCode($this->GetSeverity()); }
	public function GetDefaultIcon(){ return null; }
	public abstract function GetSeverity();

	public function GetIcon() { return $this->icon===null?$this->GetDefaultIcon():$this->icon; }

	public static function Cast($value){
		if (is_null($value))
			return null;

		if ($value instanceof Message)
			return $value;

		if ($value instanceof ApplicationException)
			return $value->GetInnerMessage();

		if ($value instanceof Exception)
			//return new BugMessage( Oxygen::IsDevelopment() ? Debug::GetExceptionReportAsHtml($value) : oxy::txtMsgAnErrorOccurred() );
			return new BugMessage( Oxygen::IsDevelopment() ? $value->getMessage() : oxy::txtMsgAnErrorOccurred() );

		if (is_array($value))
			return new MultiMessage($value);

		return new ErrorMessage(strval($value));
	}

}



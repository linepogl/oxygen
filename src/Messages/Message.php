<?php


abstract class Message {
	protected $value;
	protected $icon_name;
	public function __construct($value,$icon_name=null){ $this->value = strval($value);$this->icon_name=$icon_name; }
	public function __toString(){ return $this->value; }
	public final function AsString(){ return $this->value; }

	const INFO = 0;
	const SUCCESS = 1;
	const WARNING = 2;
	const QUESTION = 3;
	const ERROR = 4;
	const BUG = 5;
	private static $EnumType = array(
		 self::INFO => 'info'
		,self::SUCCESS => 'success'
		,self::WARNING => 'warning'
		,self::QUESTION => 'question'
		,self::ERROR => 'error'
		,self::BUG => 'bug'
		);
	public static function ConvertTypeToCode($type){ return Enum::From(self::$EnumType)->AsString($type); }
	public static function ConvertCodeToType($code){ return Enum::From(self::$EnumType)->AsNumber($code); }



	public static function Make($severity,$value,$icon_name=null){
		switch($severity){
			case self::INFO: return new InfoMessage($value,$icon_name);
			case self::SUCCESS: return new SuccessMessage($value,$icon_name);
			case self::WARNING: return new WarningMessage($value,$icon_name);
			case self::QUESTION: return new QuestionMessage($value,$icon_name);
			case self::ERROR: return new ErrorMessage($value,$icon_name);
			case self::BUG: return new BugMessage($value,$icon_name);
		}
	}

	public function GetCode(){ return self::ConvertTypeToCode($this->GetSeverity()); }
	public abstract function GetDefaultIconName();
	public abstract function GetSeverity();
	public abstract function GetBackgroundColor();
	public abstract function GetBorderColor();

	public final function GetIconName(){ return is_null($this->icon_name) ? $this->GetDefaultIconName() : $this->icon_name; }
	public final function GetIconSrc($size){ return $this->GetIconName().$size.'.gif'; }
	public final function GetIcon($size) { return new Icon($this->GetIconName(),$size); }
	public final function GetIconScr16(){ return $this->GetIconSrc(16); }
	public final function GetIconScr32(){ return $this->GetIconSrc(32); }
	public final function GetIconScr48(){ return $this->GetIconSrc(48); }
	public final function GetIcon16() { return $this->GetIcon(16); }
	public final function GetIcon32() { return $this->GetIcon(32); }
	public final function GetIcon48() { return $this->GetIcon(48); }

	public static function Cast($value){
		if (is_null($value))
			return null;

		if ($value instanceof Message)
			return $value;

		if ($value instanceof ApplicationException)
			return $value->GetInnerMessage();

		if ($value instanceof Exception)
			return new BugMessage( DEV ? Debug::GetExceptionReportAsHtml($value) : Lemma::Pick('MsgAnErrorOccurred') );

		if (is_array($value))
			return new MultiMessage($value);

		return new ErrorMessage(strval($value));
	}

}



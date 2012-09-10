<?php

abstract class Action extends XValue {
	//protected $name = null;
	public function __construct(){
		$this->mode = $this->GetDefaultMode();
		//$this->name = 'a'.ID::Random()->AsHex();
	}
	public static function Make() { return new static(); }
	public final static function GetName() { return substr(get_called_class(),6); }
	public final static function GetClassName() { return get_called_class(); }
	public function IsActive(){ return Oxygen::GetActionName() == $this->GetName(); }



	public function IsEqualTo($x) {
		if ($x instanceof Action) return $this->GetName() == $x->GetName();
		if (is_string($x)) return $this->GetName() == $x;
		return parent::IsEqualTo($x);
	}
	public function CompareTo($x) {
		if ($x instanceof Action) return strcmp($this->GetName(),$x->GetName());
		if (is_string($x)) return strcmp($this->GetName(),$x);
		return parent::CompareTo($x);
	}


	public function MetaType(){ return MetaAction::Type(); }




	public function GetWidth(){ return 500; }
	public function GetHeight(){ return 50; }

	public function GetIconName() { return 'oxy/ico/Icon'; }
	public function GetIconType() { return 'gif'; }
	public function GetIconSrc($size=16){ return $this->GetIconName().$size.'.'.$this->GetIconType(); }
	public function GetIcon($size=16) { return '<img class="icon" src="'.$this->GetIconSrc($size).'" width="'.$size.'" height="'.$size.'" alt="" />'; }
	public final function GetIconScr16(){ return $this->GetIconSrc(16); }
	public final function GetIconScr32(){ return $this->GetIconSrc(32); }
	public final function GetIconScr48(){ return $this->GetIconSrc(48); }
	public final function GetIcon16() { return $this->GetIcon(16); }
	public final function GetIcon32() { return $this->GetIcon(32); }
	public final function GetIcon48() { return $this->GetIcon(48); }

	public final function GetLink($size=16){ return '<a'.($this->IsActive()?' class="active"':'').' href="'.new Html($this->GetHref()).'">'.$this->GetIcon($size).new Spacer(2).$this->GetTitle().'</a>'; }
	public final function GetLinkedTitle(){ return '<a'.($this->IsActive()?' class="active"':'').' href="'.new Html($this->GetHref()).'">'.$this->GetTitle().'</a>'; }
	public final function GetLinkedIcon($size=16){ return '<a'.($this->IsActive()?' class="active"':'').' href="'.new Html($this->GetHref()).'">'.$this->GetIcon($size).'</a>'; }


	public function GetContentType(){ return Oxygen::GetContentType(); }
	public function GetCharset(){ return Oxygen::GetCharset(); }
	public function GetTitle(){ return Lemma::Pick($this->GetName()); }
	public function GetPathTitle(){ return $this->GetTitle(); }
	public function GetDescription(){ return ''; }
	/** @return Action */ public function GetParentAction(){ return null; }
	public function GetPath() { $r = array(); for ($act = $this; !is_null($act); $act = $act->GetParentAction()) $r[] = $act; return array_reverse($r); }


	/**
	 * @deprecated
	 * @return Menu
	 */
	public function GetMenu(){ return new Menu(); }


	public function GetButtonTitle(){ return $this->GetTitle(); }
	public function GetButtonCssClass(){ return ''; }
	/** @return ButtonControl */
	public function GetButton($args=array()) { return ButtonControl::Make()->WithValue($this->GetButtonTitle())->WithOnClick($this->GetJSCommand($args))->WithCssClass($this->GetButtonCssClass()); }

	public abstract function IsPermitted();
	public function IsLogical(){ return true; }
	public function RequiresLogin(){ return true; }
	public function IsTitleHidden(){ return false; }

	public function IsMenu(){ return false; }
	public function IsMenuSeparator(){ return false; }

	public abstract function Render();
	public function OnBeforeRender() {}
	public function OnAfterRender() {}

	public function GetHead(){
		return Oxygen::GetHead();
	}

	private $content_compromised = false;
	public function ContentCompromised(){ return $this->content_compromised; }

	public final function GetContent(){
		ob_start();
		$this->content_compromised = false;
		try {
			if (!$this->IsPermitted()) throw new SecurityException();
			if (!$this->IsLogical()) throw new ApplicationException(Lemma::Pick('MsgInvalidAction'));
			$this->OnBeforeRender();
			if ($this->IsModeLong()) {
				ProgressControl::Make()->WithAction($this)->WithForwardRequest(true)->WithHeight( $this->GetHeight() < 180 ? 200 : $this->GetHeight()-150 )->Render();
			}
			else
				$this->Render();
			$this->OnAfterRender();
		}
		catch (SecurityException $ex){ // <-- this has to go before ApplicationException
			$this->content_compromised = true;
			if (ob_get_level()>0) ob_clean();

			if ($this->IsModeRaw()){
				Oxygen::SetResponseCode(403); // forbidden
				Oxygen::SetContentType('text/plain');
				Oxygen::ResetHttpHeaders();
				$msg = $ex->getMessage();
				echo empty($msg) ? Lemma::Pick('MsgAccessDenied') : $ex->getMessage();
			}
			else {
				Oxygen::SetContentType('text/html');
				Oxygen::ResetHttpHeaders();
				if (Debug::IsImmediateFlushingEnabled()) {
					Debug::Write($ex->getMessage());
				}
				else {
					$c = Oxygen::GetLoginControl();
					if (is_null($c)){
						echo $ex->getMessage();
					}
					else {
						$c = $c->WithMessage($ex->getMessage())->WithRedirectOnSuccess($this);
						if ($c->WrapAsException()){
							echo '<table class="center"><tr><td>';
							echo '<table cellspacing="20" cellpadding="0" border="0"><tr><td>';
							echo '<table cellspacing="0" cellpadding="0" border="0"><tr>';
							echo '<td style="text-align:right;vertical-align:top;padding:50px 15px 15px 15px;"><img src="oxy/ico/Warning32.gif" /></td>';
							echo '<td style="padding:15px;">'.new Spacer(1,150).'</td>';
							echo '<td style="padding:15px;border-left:1px solid #dddddd;text-align:left;">';
							echo new Spacer(350);
						}
						$c->Render();
						if ($c->WrapAsException()){
							echo new Spacer(350);
							echo '</td>';
							echo '</tr></table>';
							echo '</td></tr></table>';
							echo '</td></tr></table>';
						}
					}
				}
			}
		}
		catch (ApplicationException $ex){
			$this->content_compromised = true;
			if (ob_get_level()>0) ob_clean();

			if ($this->IsModeRaw()){
				Oxygen::SetResponseCode(405); // not allowed
				Oxygen::SetContentType('text/plain');
				Oxygen::ResetHttpHeaders();
				echo $ex->getMessage();
			}
			else {
				Oxygen::SetContentType('text/html');
				Oxygen::ResetHttpHeaders();
				if (Debug::IsImmediateFlushingEnabled()) {
					Debug::Write($ex->getMessage());
				}
				elseif ($this->IsAjaxDialog()){
					echo new MessageControl($ex);
					echo '<div class="buttons1"><div class="buttons3"><div class="buttons2">';
					echo ButtonControl::Make()->WithValue(Lemma::Pick('Close'))->WithOnClick('Oxygen.HideDialog();');
					echo '</div></div></div>';
				}
				else {
					echo '<table class="center"><tr><td>';
					echo '<table cellspacing="20" cellpadding="0" border="0"><tr><td>';
					echo '<table cellspacing="0" cellpadding="0" border="0"><tr>';
					echo '<td style="padding:15px;text-align:right;"><img src="oxy/ico/Warning32.gif" /></td>';
					echo '<td style="padding:15px;">'.new Spacer(1,150).'</td>';
					echo '<td style="padding:15px;border-left:1px solid #dddddd;text-align:left;">';
					echo new Spacer(350);
					echo new MessageControl($ex);
					echo new Spacer(350);
					//echo '<br/><br/><br/>' . ButtonControl::Make()->WithValue(Lemma::Pick('Back'))->WithOnClick('history.back();');
					echo '</td>';
					echo '</tr></table>';
					echo '</td></tr></table>';
					echo '</td></tr></table>';
				}
			}
		}
		catch (Exception $ex){
			$this->content_compromised = true;
			if (ob_get_level()>0) ob_clean();
			if ($this->IsModeRaw()){
				Oxygen::SetResponseCode(500); // internal server error
				Oxygen::SetContentType('text/plain');
				Oxygen::ResetHttpHeaders();
				if (DEV) {
					echo '['.Lemma::Pick('MsgDevelopmentEnvironment').']' . "\n" . Debug::GetExceptionReportAsText($ex) ;
				}
				else {
					echo Lemma::Pick('MsgAnErrorOccurred');
				}
				$exception_served_as = ' (HTTP 500)';
			}
			else {
				Oxygen::SetContentType('text/html');
				Oxygen::ResetHttpHeaders();
				if (Debug::IsImmediateFlushingEnabled()) {
					if (DEV) {
						Debug::Write( '['.Lemma::Pick('MsgDevelopmentEnvironment').']' . "\n" . Debug::GetExceptionReportAsText($ex) );
					}
					else {
						Debug::Write( Lemma::Pick('MsgAnErrorOccurred') );
					}
					$exception_served_as = ' (Debug Immediate Flushing)';
				}
				else {
					echo '<table class="center"><tr><td>';
					echo '<table cellspacing="20" cellpadding="0" border="0"><tr><td>';
					echo '<table cellspacing="0" cellpadding="0" border="0"><tr>';
					echo '<td class="vtop hright" style="padding:15px;">'.new Spacer(50,30).'<br/>'.new Icon('oxy/ico/Bug',32).'</td>';
					echo '<td style="padding:15px;">'.new Spacer(1,100).'</td>';
					echo '<td class="vtop" style="padding:15px;border-left:1px solid #dddddd;text-align:left;">';

					if (DEV) {
						echo new Spacer(350,12);
						echo '<div style="font-weight:normal;font-style:italic;color:#cccccc;font-size:90%;">'.Lemma::Pick('MsgDevelopmentEnvironment').'</div><br/>';
						echo Debug::GetExceptionReportAsHtml($ex);
						echo new Spacer(350);
					}
					else {
						echo new Spacer(350,33);
						echo new MessageControl( new ErrorMessage( Lemma::Pick('MsgAnErrorOccurred') ) );
						echo new Spacer(350);
					}

					echo '</td>';
					echo '</tr></table>';
					echo '</td></tr></table>';
					echo '</td></tr></table>';
					$exception_served_as = '';
				}
			}
			if (DEV)
				Debug::RecordExceptionServed($ex,'Action Exception Handler'.$exception_served_as.'.');
			else
				Debug::RecordExceptionServedGeneric($ex,'Action Exception Handler'.$exception_served_as.'.');
		}
		$result = ob_get_clean();
		return $result;
	}

	public function __toString() { return $this->GetHref();	}











	//
	//
	// Href creation
	//
	//
	const MASK_DEST                 = 0x0F;
	const MASK_MODE                 = 0xF0;

	const FLAG_DEST_CONTENT         = 0x00;
	const FLAG_DEST_BLANK           = 0x01;
	const FLAG_DEST_AJAX_DIALOG     = 0x02;
	const FLAG_DEST_IFRAME_DIALOG   = 0x03;
	const FLAG_DEST_FRAGMENT        = 0x04;

	const FLAG_MODE_HTML            = 0x00;
	const FLAG_MODE_RAW             = 0x10;
	const FLAG_MODE_LONG            = 0x20;

	const MODE_NORMAL                    = 0x00; // 0
	const MODE_HTML_DOCUMENT             = 0x01; // 1 (to be opened as a full frame)
	const MODE_AJAX_DIALOG               = 0x02; // 2
	const MODE_IFRAME_DIALOG             = 0x03; // 3
	const MODE_HTML_FRAGMENT             = 0x05; // 4 (to be inserted into an html document)

	//const MODE_RAW_NORMAL              = 0x10; // 16 (not possible: the template needs html)
	const MODE_RAW                       = 0x11; // 17
	//const MODE_RAW_AJAX_DIALOG         = 0x12; // 18 (not possible: the ajax dialog needs html)
	const MODE_RAW_IFRAME_DIALOG         = 0x13; // 19 (todo: how do you close the dialog?)
	const MODE_RAW_FRAGMENT              = 0x14; // 20

	const MODE_LONG_NORMAL               = 0x20; // 32
	// const MODE_LONG_BLANK             = 0x21; // 33 (not sure)
	const MODE_LONG_AJAX_DIALOG          = 0x22; // 34
	// const LONG_IFRAME_DIALOG     = 0x23; // 35 (not sure)
	// const LONG_FRAGMENT          = 0x24; // 36 (not sure)



	protected $mode = Action::MODE_NORMAL;

	public final function IsContent()      { return ($this->mode & self::MASK_DEST) == self::FLAG_DEST_CONTENT; }
	public final function IsBlank()        { return ($this->mode & self::MASK_DEST) == self::FLAG_DEST_BLANK; }
	public final function IsAjaxDialog()   { return ($this->mode & self::MASK_DEST) == self::FLAG_DEST_AJAX_DIALOG; }
	public final function IsIFrameDialog() { return ($this->mode & self::MASK_DEST) == self::FLAG_DEST_IFRAME_DIALOG; }
	public final function IsFragment()     { return ($this->mode & self::MASK_DEST) == self::FLAG_DEST_FRAGMENT; }

	public final function IsModeHtml()     { return ($this->mode & self::MASK_MODE) == self::FLAG_MODE_HTML; }
	public final function IsModeRaw()      { return ($this->mode & self::MASK_MODE) == self::FLAG_MODE_RAW; }
	public final function IsModeLong()     { return ($this->mode & self::MASK_MODE) == self::FLAG_MODE_LONG; }

	protected function GetDefaultMode(){ return Action::MODE_NORMAL; }
	public final function WithMode($value){ $this->mode = $value; return $this; }
	protected function UseJavascriptAsHref(){ return $this->IsAjaxDialog() || $this->IsIFrameDialog(); }
	public final function GetHref($args=array()){ return $this->UseJavascriptAsHref() ? $this->GetHrefJavascript($args) : $this->GetHrefPlain($args); }
	public final function GetHrefJavascript($args=array()){ return 'javascript:'.$this->GetJSCommand($args); }
	public function GetJSCommand($args=array()){
		if ($this->IsAjaxDialog())
			return 'Oxygen.ShowAjaxDialog('.new Js($this->GetIcon(32)).','.new Js($this->GetTitle()).','.new Js($this->GetHrefPlain($args)).','.new Js($this->GetWidth()).','.new Js($this->GetHeight()).');';
		elseif ($this->IsIFrameDialog())
			return 'Oxygen.ShowIFrameDialog('.new Js($this->GetIcon(32)).','.new Js($this->GetTitle()).','.new Js($this->GetHrefPlain($args)).','.new Js($this->GetWidth()).','.new Js($this->GetHeight()).');';
		else
			return 'window.location.href='.new Js($this->GetHrefPlain($args)).';';
	}
	protected function GetUrlArgs(){ $r = array(); return $r; }
	public final function GetHrefPlain($args=array()){
		return Oxygen::MakeHref(
			$args
			+ array('action'=>$this->GetName(),'mode'=> $this->mode==Action::MODE_NORMAL ? null : $this->mode)
			+ $this->GetUrlArgs()
			,true // <-- use managed controller always for actions
			);
	}
	public function GetForm($name=null){
		if ($this->IsAjaxDialog())
			return '<form'.(is_null($name)?'':' id="'.$name.'" name="'.$name.'"').' method="post" action="" onsubmit="Oxygen.SubmitAjaxDialog(this);return false;" onreset="Oxygen.HideDialog();"><div class="inline">'.new HiddenControl('AjaxDialogSubmition',true);
		elseif ($this->IsIFrameDialog())
			return '<form'.(is_null($name)?'':' id="'.$name.'" name="'.$name.'"').' method="post" action="" onreset="parent.Oxygen.HideDialog();" enctype="multipart/form-data"><div class="inline">';
		else
			return '<form'.(is_null($name)?'':' id="'.$name.'" name="'.$name.'"').' method="post" action="" enctype="multipart/form-data"><div class="inline">';
	}
	public function EndForm(){ return '</div></form>'; }
	public function GetFormButtons(){ return '<div class="buttons1"><div class="buttons3"><div class="buttons2">'; }
	public function EndFormButtons(){ return '</div></div></div>'; }
	protected function IsPostback() {
		if ($this->IsAjaxDialog())
			return Oxygen::IsPostback() && Http::$POST['AjaxDialogSubmition']->AsBoolean();
		else
			return Oxygen::IsPostback();
	}



	public function GetFilterForm($name) {
		$r = '<form'.(is_null($name)?'':' id="'.$name.'"').' method="get" action="'.new Html(Oxygen::GetCurrentPhpScript()).'"><div class="inline">';
		$a = func_get_args();
		$a = array_splice($a,1);
		foreach ($_GET as $key=>$value) if (!in_array($key,$a,true)) $r .= HiddenControl::Make($key,$value);
		return $r;
	}
	public function EndFilterForm(){ return '</div></form>'; }

}


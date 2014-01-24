<?php

abstract class Action extends XValue {
	protected $name = null;
	public function __construct(){
		$this->mode = $this->GetDefaultMode();
		$this->name = 'a'.Oxygen::Hash32(static::GetClassName());
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

	public function GetIconName() { return null; }
	public function GetIconType() { return Oxygen::GetDefaultIconType(); }
	public function GetIconSrc($size=16){ $name = $this->GetIconName(); return $name===null ? null : $name.$size.'.'.$this->GetIconType(); }
	public function GetImageIcon($size=16) { $name = $this->GetIconName(); return $name===null ? null : new Icon($this->GetIconName(),$size,$this->GetIconType()); }
	public function GetGlyph(){ return oxy::icoBlock(); }
	public function GetIcon($size=16) { $name = $this->GetIconName(); return $name===null ? $this->GetGlyph()->WithSize($size) : $this->GetImageIcon($size); }

	public final function GetIconScr16(){ return $this->GetIconSrc(16); }
	public final function GetIconScr32(){ return $this->GetIconSrc(32); }
	public final function GetIconScr48(){ return $this->GetIconSrc(48); }
	public final function GetIcon16() { return $this->GetIcon(16); }
	public final function GetIcon32() { return $this->GetIcon(32); }
	public final function GetIcon48() { return $this->GetIcon(48); }

	public final function GetLink($size=16){ return '<a'.($this->IsActive()?' class="active"':'').' href="'.new Html($this->GetHref()).'">'.$this->GetIcon($size).'<span class="text spacer2">'.$this->GetTitle().'</span></a>'; }
	public final function GetLinkedTitle(){ return '<a'.($this->IsActive()?' class="active"':'').' href="'.new Html($this->GetHref()).'"><span class="text">'.$this->GetTitle().'</span></a>'; }
	public final function GetLinkedIcon($size=16){ return '<a'.($this->IsActive()?' class="active"':'').' href="'.new Html($this->GetHref()).'">'.$this->GetIcon($size).'</a>'; }


	public function GetContentType(){ return Oxygen::GetContentType(); }
	public function GetCharset(){ return Oxygen::GetCharset(); }
	public function GetTitle(){ return Lemma::Pick($this->GetName()); }
	public function GetPathTitle(){ return $this->GetTitle(); }
	public function GetDescription(){ return ''; }
	/** @return Action */ public function GetParentAction(){ return null; }
	public function GetPath() { $r = array(); for ($act = $this; !is_null($act); $act = $act->GetParentAction()) $r[] = $act; return array_reverse($r); }


	/**
	 * @deprecated - use GetParentAction() instead
	 * @return Menu
	 */
	public function GetMenu(){ return new Menu(); }


	public function GetButtonTitle(){ return $this->GetTitle(); }
	public function GetButtonCssClass(){ return ''; }
	/** @return ButtonBox */
	public function GetButton($args=array(),$dynamic_args=array()) { return ButtonBox::Make()->WithValue($this->GetButtonTitle())->WithOnClick($this->GetJSCommand($args,$dynamic_args))->WithCssClass($this->GetButtonCssClass()); }

	public abstract function IsPermitted();
	public function IsLogical(){ return true; }
	public function RequiresLogin(){ return true; }
	public function IsTitleHidden(){ return false; }

	public function IsMenu(){ return false; }
	public function IsMenuSeparator(){ return false; }

	public abstract function Render();
	public function OnBeforeRender() {}
	public function OnAfterRender() {}
	public function PostProcess($content) { return $content; }

	private $content_compromised = false;
	public function ContentCompromised(){ return $this->content_compromised; }

	public final function GetContent(){
		ob_start();
		$this->content_compromised = false;
		try {
			if (!$this->IsPermitted()) throw new SecurityException('');
			if (!$this->IsLogical()) throw new PageNotFoundException();
			$this->OnBeforeRender();
			if ($this->IsModeLong()) {
				ProgressControl::Make()->WithAction($this)->WithForwardRequest(true)->WithHeight( $this->GetHeight() < 180 ? 200 : $this->GetHeight()-150 )->Render();
			}
			else
				$this->Render();
			$this->OnAfterRender();
			$content = ob_get_clean();
			$content = $this->PostProcess($content);
		}
		catch (SecurityException $ex){
			$this->content_compromised = true;
			$msg = $ex->getMessage();
			if (ob_get_level()>0) ob_clean();
			if ($this->IsModeRaw()){
				Oxygen::SetResponseCode(403); // forbidden
				Oxygen::SetContentType('text/plain');
				Oxygen::ResetHttpHeaders();
				echo empty($msg) ? Lemma::Pick('MsgAccessDenied') : $msg;
			}
			else {
				Oxygen::SetContentType('text/html');
				Oxygen::ResetHttpHeaders();
				if (Debug::IsImmediateFlushingEnabled()) {
					Debug::Write(empty($msg) ? Lemma::Pick('MsgAccessDenied') : $msg);
				}
				else {
					$z = is_null(Oxygen::GetLoginControl()) ? '' : Oxygen::GetLoginControl()->WithMessage($msg)->WithRedirectOnSuccess($this)->GetContent();
					if (!empty($z))
						echo $z;
					elseif ($this->IsAjaxDialog()){
						echo new MessageControl( empty($msg) ? new ErrorMessage(Lemma::Pick('MsgAccessDenied')) : $ex );
						echo $this->GetFormButtons();
						echo ButtonBox::Make()->WithValue(Lemma::Pick('Close'))->WithOnClick('Oxygen.HideDialog();');
						echo $this->EndFormButtons();
					}
					else {
						echo '<div class="exception">';
						echo new MessageControl( empty($msg) ? new ErrorMessage(Lemma::Pick('MsgAccessDenied')) : $ex );
						echo '</div>';
					}
				}
			}
			$content = ob_get_clean();
		}
		catch (PageNotFoundException $ex){
			$this->content_compromised = true;
			$msg = $ex->getMessage();
			if (ob_get_level()>0) ob_clean();
			if ($this->IsModeRaw()){
				Oxygen::SetResponseCode(404); // not found
				Oxygen::SetContentType('text/plain');
				Oxygen::ResetHttpHeaders();
				echo empty($msg) ? Lemma::Pick('MsgPageNotFound') : $msg;
			}
			else {
				Oxygen::SetContentType('text/html');
				Oxygen::ResetHttpHeaders();
				if (Debug::IsImmediateFlushingEnabled()) {
					Debug::Write(empty($msg) ? Lemma::Pick('MsgPageNotFound') : $msg);
				}
				elseif ($this->IsAjaxDialog()){
					echo new MessageControl( empty($msg) ? new ErrorMessage(Lemma::Pick('MsgPageNotFound')) : $ex );
					echo $this->GetFormButtons();
					echo ButtonBox::Make()->WithValue(Lemma::Pick('Close'))->WithOnClick('Oxygen.HideDialog();');
					echo $this->EndFormButtons();
				}
				else {
					echo '<div class="exception">';
					echo new MessageControl( empty($msg) ? new ErrorMessage(Lemma::Pick('MsgPageNotFound')) : $ex );
					echo '</div>';
				}
			}
			$content = ob_get_clean();
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
					echo $this->GetFormButtons();
					echo ButtonBox::Make()->WithValue(Lemma::Pick('Close'))->WithOnClick('Oxygen.HideDialog();');
					echo $this->EndFormButtons();
				}
				else {
					echo '<div class="exception">';
					echo new MessageControl($ex);
					echo '</div>';
				}
			}
			$content = ob_get_clean();
		}
		catch (Exception $ex){
			$this->content_compromised = true;
			if (ob_get_level()>0) ob_clean();
			if ($this->IsModeRaw()){
				Oxygen::SetResponseCode(500); // internal server error
				Oxygen::SetContentType('text/plain');
				Oxygen::ResetHttpHeaders();
				if (Oxygen::IsDevelopment()) {
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
					if (Oxygen::IsDevelopment()) {
						Debug::Write( '['.Lemma::Pick('MsgDevelopmentEnvironment').']' . "\n" . Debug::GetExceptionReportAsText($ex) );
					}
					else {
						Debug::Write( Lemma::Pick('MsgAnErrorOccurred') );
					}
					$exception_served_as = ' (Debug Immediate Flushing)';
				}
				else {
					if (Oxygen::IsDevelopment()) {
						echo '<table class="center"><tr><td>';
						echo '<table cellspacing="20" cellpadding="0" border="0"><tr><td>';
						echo '<table cellspacing="0" cellpadding="0" border="0"><tr>';
						echo '<td class="vtop hright" style="padding:15px;">'.new Spacer(50,30).'<br/>'.oxy::icoBug()->WithSize(32).'</td>';
						echo '<td style="padding:15px;">'.new Spacer(1,100).'</td>';
						echo '<td class="vtop" style="padding:15px;border-left:1px solid #dddddd;text-align:left;">';
						echo new Spacer(350,12);
						echo '<div style="font-weight:normal;font-style:italic;color:#cccccc;font-size:90%;">'.Lemma::Pick('MsgDevelopmentEnvironment').'</div><br/>';
						echo Debug::GetExceptionReportAsHtml($ex);
						echo new Spacer(350);
						echo '</td>';
						echo '</tr></table>';
						echo '</td></tr></table>';
						echo '</td></tr></table>';
					}
					elseif ($this->IsAjaxDialog()){
						echo new MessageControl( new ErrorMessage( Lemma::Pick('MsgAnErrorOccurred') ) );
						echo $this->GetFormButtons();
						echo ButtonBox::Make()->WithValue(Lemma::Pick('Close'))->WithOnClick('Oxygen.HideDialog();');
						echo $this->EndFormButtons();
					}
					else {
						echo '<div class="exception">';
						echo new MessageControl( new ErrorMessage( Lemma::Pick('MsgAnErrorOccurred') ) );
						echo '</div>';
					}
					$exception_served_as = '';
				}
			}
			if (Oxygen::IsDevelopment())
				Debug::RecordExceptionServed($ex,'Action Exception Handler'.$exception_served_as.'.');
			else
				Debug::RecordExceptionServedGeneric($ex,'Action Exception Handler'.$exception_served_as.'.');
			$content = ob_get_clean();
		}
		return $content;
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
	const MODE_HTML_FRAGMENT             = 0x04; // 4 (to be inserted into an html document)

	const MODE_RAW_CONTENT               = 0x10; // 16 (the template has to handle the raw content which might not be html)
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
	public final function GetHref($args=array(),$dynamic_args=array()){ return $this->UseJavascriptAsHref() ? $this->GetHrefJavascript($args,$dynamic_args) : $this->GetHrefPlain($args,$dynamic_args); }
	public final function GetHrefJavascript($args=array(),$dynamic_args=array()){ return 'javascript:'.$this->GetJSCommand($args,$dynamic_args); }
	public function GetJSCommand($args=array(),$dynamic_args=array()){
		$x = '';
		$i = 0;
		foreach ($dynamic_args as $value) $x .= ($i==0?'':',')."'XXX~".++$i."':$value";

		if ($this->IsAjaxDialog())
			$r = 'Oxygen.ShowAjaxDialog('.new Js($this->GetIconName()===null?$this->GetGlyph(null):$this->GetIcon(32)).','.new Js($this->GetTitle()).','.new Js($this->GetHrefPlain($args,$dynamic_args)).','.new Js($this->GetWidth()).','.new Js($this->GetHeight()).');';
		elseif ($this->IsIFrameDialog())
			$r = 'Oxygen.ShowIFrameDialog('.new Js($this->GetIconName()===null?$this->GetGlyph(null):$this->GetIcon(32)).','.new Js($this->GetTitle()).','.new Js($this->GetHrefPlain($args,$dynamic_args)).','.new Js($this->GetWidth()).','.new Js($this->GetHeight()).');';
		else
			$r = 'window.location.href='.new Js(__BASE__.$this->GetHrefPlain($args,$dynamic_args)).';';

		if ($x=='')
			return $r;
		else
			return "Oxygen.OpenDynamicAction(".new Js($r).",function(){return{ $x }; });";
	}
	protected function GetUrlArgs(){ $r = array(); return $r; }
	public final function GetHrefPlain($args=array(),$dynamic_args=array()){
		if (!empty($dynamic_args)) { $i=0; foreach ($dynamic_args as $key=>$value) $args[$key] = 'XXX~'.++$i; }
		return Oxygen::MakeHref(
			$args
			+ array('action'=>$this->GetName(),'mode'=> $this->mode == Oxygen::GetDefaultActionMode() ? null : $this->mode)
			+ $this->GetUrlArgs()
			,true // <-- use managed controller always for actions
			);
	}
	public function GetForm($name=null){
		if ($this->IsAjaxDialog())
			return '<form'.(is_null($name)?'':' id="'.$name.'" name="'.$name.'"').' method="post" action="" onsubmit="Oxygen.SubmitAjaxDialog(this);return false;" onreset="Oxygen.HideDialog();"><div class="inline">'.new HiddenBox('AjaxDialogSubmition',true);
		elseif ($this->IsIFrameDialog())
			return '<form'.(is_null($name)?'':' id="'.$name.'" name="'.$name.'"').' method="post" action="" onreset="parent.Oxygen.HideDialog();" enctype="multipart/form-data"><div class="inline">';
		else
			return '<form'.(is_null($name)?'':' id="'.$name.'" name="'.$name.'"').' method="post" action="" enctype="multipart/form-data"><div class="inline">';
	}
	public function EndForm(){ return '</div></form>'; }
	public function GetFormButtons(){ return '<div class="buttons"><div class="buttons1"><div class="buttons3"><div class="buttons2">'; }
	public function EndFormButtons(){ return '</div></div></div></div>'; }
	protected function IsPostback() {
		if ($this->IsAjaxDialog())
			return Oxygen::IsPostback() && Http::POST('AjaxDialogSubmition')->AsBoolean();
		else
			return Oxygen::IsPostback();
	}



	public function GetFilterForm($name) {
		$r = '<form'.(is_null($name)?'':' id="'.$name.'"').' method="get" action="'.new Html(Oxygen::GetCurrentPhpScript()).'"><div class="inline">';
		$a = func_get_args();
		$a = array_splice($a,1);
		foreach ($_GET as $key=>$value) if (!in_array($key,$a,true)) $r .= HiddenBox::Make($key,$value);
		return $r;
	}
	public function EndFilterForm(){ return '</div></form>'; }

}


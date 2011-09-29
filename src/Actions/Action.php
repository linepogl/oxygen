<?php

abstract class Action {
	//protected $name = null;
	public function __construct(){
		$this->mode = $this->GetDefaultMode();
		//$this->name = 'a'.ID::Random()->AsHex();
	}
	public static function Make() { return new static(); }
	public final static function GetName() { return substr(get_called_class(),6); }
	public function IsActive(){ return Oxygen::GetActionName() == $this->GetName(); }









	public function GetWidth(){ return 500; }
	public function GetHeight(){ return 375; }

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
	public function GetTitle(){ return Lemma::Retrieve($this->GetName()); }
	public function GetPathTitle(){ return $this->GetTitle(); }
	public function GetDescription(){ return ''; }
	public function GetParentAction(){ return null; }
	public function GetPath(){ $r = array(); for ($act = $this; !is_null($act); $act = $act->GetParentAction()) $r[] = $act; return array_reverse($r); }
	public function GetMenu() { return new Menu(); }


	public function GetButtonTitle(){ return $this->GetTitle(); }
	public function GetButtonCssClass(){ return ''; }
	/** @return ButtonControl */
	public function GetButton() { return ButtonControl::Make()->WithValue($this->GetButtonTitle())->WithOnClick($this->GetHrefJavascript())->WithCssClass($this->GetButtonCssClass()); }

	public abstract function IsPermitted();
	public function IsLogical(){ return true; }
	public function RequiresLogin(){ return true; }
	public function IsTitleHidden(){ return false; }

	public abstract function Render();
	public function OnBeforeRender() {}
	public function OnAfterRender() {}

	public function GetHead(){
		return '<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />'
					.'<script type="text/javascript" src="oxy/jsc/prototype.js"></script>'
					.'<script type="text/javascript" src="oxy/jsc/scriptaculous.js?load=effects"></script>'
					.'<link href="oxy/css/oxygen.css" rel="stylesheet" type="text/css" />';
	}

	private $content_compromised = false;
	public function ContentCompromised(){ return $this->content_compromised; }

	public final function GetContent(){
		ob_start();
		$this->content_compromised = false;
		try {
			if (!$this->IsPermitted()) throw new SecurityException();
			if (!$this->IsLogical()) throw new ApplicationException(Lemma::Retrieve('MsgInvalidAction'));
			$this->OnBeforeRender();
			if ($this->IsLong())
				ProgressControl::Make()->WithAction($this)->WithForwardRequest(true)->WithHeight($this->GetHeight()-150)->Render();
			else
				$this->Render();
			$this->OnAfterRender();
		}
		catch (SecurityException $ex){
			$this->content_compromised = true;
			if (ob_get_level()>0) ob_clean();

			if ($this->IsBlind()){
				Oxygen::SetResponseCode(403); // forbidden
				Oxygen::SetContentType('text/plain');
				Oxygen::ResetHttpHeaders();
				echo $ex->getMessage();
			}
			else {
				Oxygen::SetContentType('text/html');
				Oxygen::ResetHttpHeaders();
				if (Log::IsImmediateFlushingEnabled()) {
					Log::WriteException($ex);
				}
				else {
					$c = Oxygen::GetLoginControl()->WithMessage($ex->getMessage())->WithRedirectOnSuccess($this);
					if ($c->WrapAsException()){
						echo '<table class="center"><tr><td>';
						echo '<table cellspacing="20" cellpadding="0" border="0"><tr><td>';
						echo '<table cellspacing="0" cellpadding="15" border="0"><tr>';
						echo '<td style="text-align:right;vertical-align:top;padding-top:50px;"><img src="oxy/ico/Warning32.gif" /></td>';
						echo '<td>'.new Spacer(1,150).'</td>';
						echo '<td style="border-left:1px solid #dddddd;text-align:left;">';
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
		catch (ApplicationException $ex){
			$this->content_compromised = true;
			if (ob_get_level()>0) ob_clean();

			if ($this->IsBlind()){
				Oxygen::SetResponseCode(405); // not allowed
				Oxygen::SetContentType('text/plain');
				Oxygen::ResetHttpHeaders();
				echo $ex->getMessage();
			}
			else {
				Oxygen::SetContentType('text/html');
				Oxygen::ResetHttpHeaders();
				if (Log::IsImmediateFlushingEnabled()) {
					Log::WriteException($ex);
				}
				elseif ($this->IsAjax() && $this->IsDialog()){
					echo new MessageControl($ex);
					echo '<div class="buttons1"><div class="buttons3"><div class="buttons2">';
					echo ButtonControl::Make()->WithValue(Lemma::Retrieve('Close'))->WithOnClick('Oxygen.HideDialog();');
					echo '</div></div></div>';
				}
				else {
					echo '<table class="center"><tr><td>';
					echo '<table cellspacing="20" cellpadding="0" border="0"><tr><td>';
					echo '<table cellspacing="0" cellpadding="15" border="0"><tr>';
					echo '<td align="right"><img src="oxy/ico/Warning32.gif" /></td>';
					echo '<td>'.new Spacer(1,150).'</td>';
					echo '<td style="border-left:1px solid #dddddd;text-align:left;">';
					echo new Spacer(350);
					echo new MessageControl($ex);
					echo new Spacer(350);
					//echo '<br/><br/><br/>' . ButtonControl::Make()->WithValue(Lemma::Retrieve('Back'))->WithOnClick('history.back();');
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
			if ($this->IsBlind()){
				Oxygen::SetResponseCode(500); // internal server error
				Oxygen::SetContentType('text/plain');
				Oxygen::ResetHttpHeaders();
				echo Log::GetExceptionReportAsText($ex);
			}
			else {
				Oxygen::SetContentType('text/html');
				Oxygen::ResetHttpHeaders();
				if (Log::IsImmediateFlushingEnabled()) {
					Log::WriteException($ex);
				}
				else {
					echo '<table class="center"><tr><td>';
					echo '<table cellspacing="20" cellpadding="0" border="0"><tr><td>';
					echo '<table cellspacing="0" cellpadding="15" border="0"><tr>';
					echo '<td class="vtop hright">'.new Spacer(50,30).'<br/>'.new Icon('oxy/ico/Bug',32).'</td>';
					echo '<td>'.new Spacer(1,150).'</td>';
					echo '<td style="border-left:1px solid #dddddd;text-align:left;">'.new Spacer(350).'<br/><br/><br/>';
					echo Log::GetExceptionReportAsHtml($ex);
					echo '</td>';
					echo '</tr></table>';
					echo '</td></tr></table>';
					echo '</td></tr></table>';
				}
			}
			try{ if (!Oxygen::IsLocalhost()) UnhandledException::Record($ex); }catch(Exception $exx){}
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
	const NORMAL           = 0x0000;
	const DIALOG           = 0x0001;
	const BLIND            = 0x2000;
	const AJAX             = 0x0002;
	const AJAX_BLIND       = 0x2002;
	const AJAX_DIALOG      = 0x0003;
	const IFRAME           = 0x0004;
	const IFRAME_DIALOG    = 0x0005;
	const LONG             = 0x1000;
	const LONG_NORMAL      = 0x1000;
	const LONG_DIALOG      = 0x1001;
	const LONG_AJAX        = 0x1002;
	const LONG_AJAX_DIALOG = 0x1003;
	protected $mode = self::NORMAL;
	public final function IsAjax(){ return ($this->mode & self::AJAX) == self::AJAX; }
	public final function IsBlind(){ return ($this->mode & self::BLIND) == self::BLIND; }
	public final function IsIFrame(){ return ($this->mode & self::IFRAME) == self::IFRAME; }
	public final function IsLong(){ return ($this->mode & self::LONG) == self::LONG; }
	public final function IsDialog(){ return ($this->mode & self::DIALOG) == self::DIALOG; }
	public final function IsAjaxDialog(){ return ($this->mode & self::AJAX_DIALOG) == self::AJAX_DIALOG; }
	public final function IsIFrameDialog(){ return ($this->mode & self::IFRAME_DIALOG) == self::IFRAME_DIALOG; }
	protected function GetDefaultMode(){ return self::NORMAL; }
	public final function WithMode($value){ $this->mode = $value; return $this; }
	protected function UseJavascriptAsHref(){ return $this->IsDialog(); }
	public final function GetHref($args=array()){
		return $this->UseJavascriptAsHref() ? $this->GetHrefJavascript($args) : $this->GetHrefPlain($args);
	}
	public final function GetHrefJavascript($args=array()){
		return 'javascript:'.$this->GetJSCommand($args);
	}
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
			+ array('action'=>$this->GetName(),'mode'=> $this->mode==self::NORMAL ? null : $this->mode)
			+ $this->GetUrlArgs()
			);

//		$a = $this->GetUrlArgs();
//		$a['action'] = $this->GetName();         // <----------- this one also causes an array copy...
//		if ($this->mode != self::NORMAL) $a['mode'] = $this->mode;
//		foreach ($args as $key=>$value)
//			$a[$key] = $value;
//		return Oxygen::MakeHref($a);
	}
	public function GetForm($name=null){
		if ($this->IsAjaxDialog())
			return '<form'.(is_null($name)?'':' id="'.$name.'"').' method="post" action="" onsubmit="Oxygen.SubmitAjaxDialog(this);return false;" onreset="Oxygen.HideDialog();"><div class="inline">'.new HiddenControl('AjaxDialogSubmition',true);
		elseif ($this->IsIFrameDialog())
			return '<form'.(is_null($name)?'':' id="'.$name.'"').' method="post" action="" onreset="parent.Oxygen.HideDialog();" enctype="multipart/form-data"><div class="inline">';
		else
			return '<form'.(is_null($name)?'':' id="'.$name.'"').' method="post" action="" enctype="multipart/form-data"><div class="inline">';
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




}


<?php

abstract class SearchBoxAction extends Action{
	public function GetDefaultMode(){ return Action::MODE_HTML_FRAGMENT; }

	protected $search_string;
	private $namespace;
	public function __construct($namespace=null,$search_string=null){ parent::__construct(); $this->namespace = $namespace; $this->search_string = $search_string; }
	public function GetUrlArgs(){ return array('namespace'=>$this->namespace,'search_string'=>$this->search_string)+parent::GetUrlArgs(); }
	public static function Make(){ return new static(Http::GET('namespace')->AsString(),Http::GET('search_string')->AsString()); }


	public abstract function GetResults();
	public abstract function GetResultValue($result);
	public abstract function GetResultHtmlCaption($result);
	public function RenderResult($result){
		echo $this->GetResultHtmlCaption($result);
	}

	public final function Render(){
		$i = 0;
		foreach ($this->GetResults() as $result){
			$v = new Js(new Val($this->GetResultValue($result)));
			$c = new Js($this->GetResultHtmlCaption($result));
			echo '<a class="option" href="'.new Html("javascript:window.$this->namespace.SetValue($v,$c);").'">';
			$this->RenderResult($result);
			echo '</a>';
			if (++$i > 20) break;
		}
	}

}


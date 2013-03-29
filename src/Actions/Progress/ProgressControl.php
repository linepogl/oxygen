<?php


class ProgressControl extends Control {

	private $action = null;
	public function WithAction($value){ $this->action = $value; return $this; }

	private $height = 300;
	public function WithHeight($value){ $this->height = $value; return $this; }

	private $forward_request = false;
	public function WithForwardRequest($value){ $this->forward_request = $value; return $this; }

	public function Render(){
		//$window = ID::Random();
		Progress::Clear();
		$href = $this->action->GetHrefPlain(array('mode'=>Action::MODE_HTML_FRAGMENT));
		$act1 = new ActionUpdateProgress($this->name);
		$href1 = $act1->GetHrefPlain();
		$act2 = new ActionCancelProgress($this->name);
		$href2 = $act2->GetHrefPlain();

		echo '<div id="'.$this->name.'_log" class="overflow" style="height:'.$this->height.'px;border:1px solid #cccccc;padding:2px;margin-bottom:10px;"></div>';
		echo '<table id="'.$this->name.'_table" width="100%" cellspacing="0" cellpadding="0" border="0"><tr>';
		echo '<td class="notext nowrap">'.ButtonBox::Make()->WithValue(Lemma::Pick('Cancel'))->WithOnClick($this->name.'_Cancel();').new Spacer(3).'</td>';
		echo '<td class="nowrap hcenter" id="'.$this->name.'_clock">0:00</td>';
		echo '<td class="notext nowrap">'.new Spacer(3).'</td>';
		echo '<td class="expand notext"><div style="border:solid 1px #999999;"><div id="'.$this->name.'_progress_bar" class="notext" style="width:0%;background:#dddddd;">'.new Spacer(1,11).'</div></div></td>';
		echo '<td class="notext nowrap">'.new Spacer(6).'<img src="oxy/img/ajax.gif" width="12" height="12" />'.new Spacer(3).'</td>';
		echo '<td class="nowrap" id="'.$this->name.'_progress">0%</td>';
		echo '</tr></table>';

		echo '<div id="'.$this->name.'_cancelling" style="display:none;"><img src="oxy/img/ajax.gif" /> '.Lemma::Pick('MsgCancelling').'</div>';
		echo '<div id="'.$this->name.'_actual" style="display:none;"><img src="oxy/img/ajax.gif" /></div>';

		echo Js::BEGIN;
		echo "var params = {";
		if($this->forward_request && Oxygen::IsPostback()){
			$i=0;
			/** @var $v HttpValue */
			foreach(Http::$POST as $k=>$v){
				if ($i++>0) echo ',';
				echo new Js($k).':'.new Js($v->AsStringOrNull());
			}
		}
		echo "};";
		echo "new Ajax.Updater(".new Js($this->name.'_actual').",".new Js($href).",{method:".new Js($this->forward_request&&Oxygen::IsPostback()?'post':'get').",encoding:Oxygen.Encodinf,evalScripts:true,parameters:params});";
		echo "setTimeout(function(){new Ajax.Updater(".new Js($this->name.'_log').",".new Js($href1).",{method:'get',encoding:Oxygen.Encoding,evalScripts:true});},100);";
		echo $this->name. "_Cancel = function(){";
		echo "  new Ajax.Updater(".new Js($this->name.'_log').",".new Js($href2).",{method:'get',encoding:Oxygen.Encoding,evalScripts:true,insertion:'bottom'});";
		echo "};";



		echo "var ".$this->name."_clock_value = 0;";
		echo $this->name . "_UpdateClock = function(){";
		echo "  var clock = $(".new Js($this->name.'_clock').");";
		echo "  if (clock == null) return;";
		echo "  ".$this->name."_clock_value++;";
		echo "  var min = Math.floor( ".$this->name."_clock_value / 60 );";
		echo "  var sec = ".$this->name."_clock_value % 60;";
		echo "  clock.update(min + ':' + (sec<10?'0':'') + sec);";
		echo "  setTimeout('".$this->name."_UpdateClock();',1000);";
		echo "};";
		echo "setTimeout('".$this->name."_UpdateClock();',1000);";

		echo Js::END;
	}


}


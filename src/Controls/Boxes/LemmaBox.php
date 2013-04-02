<?php


class LemmaBox extends Box {

	private $width = '100%';
	public function WithWidth($value){ $this->width = $value; return $this; }

	private $langs = null;
	public function WithLangs($value){ $this->langs = $value; return $this; }

	public function Render(){
		$langs = is_null($this->langs) ? Oxygen::$langs : $this->langs;

		echo HiddenBox::Make($this->name,$this->value instanceof Lemma ? $this->value->Encode() : '');
		echo '<table class="formPane" style="width:'.$this->width.'" cellspacing="0" cellpadding="0" border="0"><tr>';
		echo '<td class="expand" class="formPane" style="border:0;border-right-width:1px;">';
		foreach ($langs as $lang){
			TextBox::Make($this->name.'_'.$lang,$this->value[$lang])
				->WithWidth('100%')
				->WithReadonly($this->readonly)
				->WithOnChange("window.$this->name.OnChange();")
				->WithCssStyle('border:0;'.($lang==Oxygen::$lang?'':'display:none;') )
				->Render();
		}
		echo '</td>';

		foreach ($langs as $lang){
			echo '<td class="nowrap">';
			echo '<a id="'.$this->name.'_'.$lang.'_anchor" href="javascript:'.$this->name.'.ChangeLang('.new Js($lang).');" style="display:block;background:'.($lang==Oxygen::$lang?'#dddddd':'#f4f4f4').';">';
			echo new Spacer(7,20);
			echo '<img id="'.$this->name.'_'.$lang.'_flag" src="oxy/lng/'.$lang.($lang==Oxygen::$lang?'':'-').'.gif" />';
			echo new Spacer(3,20);
			echo '<img id="'.$this->name.'_'.$lang.'_check" src="oxy/ico/'.(''==trim($this->value[$lang])?'Warning':'OK').'16.gif" width="8" height="8" />';
			echo new Spacer(6,20);
			echo '</a>';
			echo '</td>';
		}

		echo '</tr></table>';

		echo Js::BEGIN;
		echo "window.$this->name = {";
		echo "  OnChange : function(){";
		echo "    var s;";
		echo "    var ss = '';";
		foreach ($langs as $lang){
			echo "    s = \$F(".new Js($this->name.'_'.$lang).").trim();";
			echo "    \$(".new Js($this->name.'_'.$lang.'_check').").src = s=='' ? 'oxy/ico/Warning16.gif' : 'oxy/ico/OK16.gif';";
			echo "    if (s!='') { if (ss!='') ss+='~'; ss+=".new Js($lang)."+'~'+s; }";
		}
		echo "    $(".new Js($this->name).").value = ss;";
		echo $this->on_change;
		echo "  }";
		echo " ,ChangeLang : function(lang){";
		foreach ($langs as $lang){
			echo "    $(".new Js($this->name.'_'.$lang).").style.display = lang==".new Js($lang)." ? '' : 'none';";
			echo "    $(".new Js($this->name.'_'.$lang.'_anchor').").style.backgroundColor = lang==".new Js($lang)." ? '#dddddd' : '#f4f4f4';";
			echo "    $(".new Js($this->name.'_'.$lang.'_flag').").src = lang==".new Js($lang)." ? 'oxy/lng/".$lang.".gif' : 'oxy/lng/".$lang."-.gif';";
		}
		echo "  }";
		echo "};";
		echo Js::END;
	}
}




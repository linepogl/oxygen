<?php

/** @deprecated Use LemmaBox instead */
class LemmaControl extends ValueControl {

	private $width = '100%';
	public function WithWidth($value){ $this->width = $value; return $this;}

	private $readonly = false;
	public function WithReadonly($value){ $this->readonly = $value; return $this;}

	private $onchange = '';
	public function WithOnChange($value){ $this->onchange = $value; return $this;}

	public function Render(){


		echo new HiddenBox($this->name,$this->value instanceof Lemma ? $this->value->Encode() : '');
		echo '<table class="formPane" style="width:'.$this->width.'" cellspacing="0" cellpadding="0" border="0"><tr>';
		echo '<td class="expand" class="formPane" style="border:0;border-right-width:1px;">';
		foreach (Oxygen::$langs as $lang){
			TextBox::Make($this->name.'_'.$lang,$this->value[$lang])
				->WithWidth('100%')
				->WithReadonly($this->readonly)
				->WithOnChange($this->name.'_OnChange();')
				->WithCssStyle('border:0;'.($lang==Oxygen::$lang?'':'display:none;') )
				->Render();
		}
		echo '</td>';

		foreach (Oxygen::$langs as $lang){
			echo '<td class="nowrap">';
			echo '<a id="'.$this->name.'_'.$lang.'_anchor" href="javascript:'.$this->name.'_ChangeLang('.new Js($lang).');" style="display:block;background:'.($lang==Oxygen::$lang?'#dddddd':'#f4f4f4').';">';
			echo new Spacer(7,20);
			echo '<img id="'.$this->name.'_'.$lang.'_flag" src="oxy/lng/'.$lang.($lang==Oxygen::$lang?'':'-').'.gif" />';
			$ok = ''!=trim($this->value[$lang]);
			echo '<span id="'.$this->name.'_'.$lang.'_check_suc"'.($ok?'':' style="display:none;"').'>'.oxy::icoSuccess()->WithSize(8).'</span>';
			echo '<span id="'.$this->name.'_'.$lang.'_check_err"'.($ok?' style="display:none;"':'').'>'.oxy::icoWarning()->WithSize(8).'</span>';
			echo new Spacer(6,20);
			echo '</a>';
			echo '</td>';
		}

		echo '</tr></table>';

		echo Js::BEGIN;
		echo $this->name . "_OnChange = function(){";
		echo "var s;";
		echo "var ss = '';";
		foreach (Oxygen::$langs as $lang){
			echo "s = \$F(".new Js($this->name.'_'.$lang).").trim();";
			echo "var suc = \$(".new Js($this->name.'_'.$lang.'_check_suc').");";
			echo "var err = \$(".new Js($this->name.'_'.$lang.'_check_err').");";
			echo "if (s=='') {suc.hide();err.show();} else { suc.show();err.hide(); }";
			echo "if (s!='') { if (ss!='') ss+='~'; ss+=".new Js($lang)."+'~'+s; }";
		}
		echo "$(".new Js($this->name).").value = ss;";
		echo "};";
		echo $this->name . "_ChangeLang = function(lang){";
		foreach (Oxygen::$langs as $lang){
			echo "$(".new Js($this->name.'_'.$lang).").style.display = lang==".new Js($lang)." ? '' : 'none';";
			echo "$(".new Js($this->name.'_'.$lang.'_anchor').").style.backgroundColor = lang==".new Js($lang)." ? '#dddddd' : '#f4f4f4';";
			echo "$(".new Js($this->name.'_'.$lang.'_flag').").src = lang==".new Js($lang)." ? 'oxy/lng/".$lang.".gif' : 'oxy/lng/".$lang."-.gif';";
		}
		echo "};";
		echo Js::END;
	}
}




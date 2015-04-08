<?php


class LemmaBox extends Box {

	private $width = '100%';
	public function WithWidth($value){ $this->width = $value; return $this; }

	private $langs = null;
	public function WithLangs($value){ $this->langs = $value; return $this; }

	private $default_lang = null;
	public function WithDefaultLang($value){ $this->default_lang = $value; return $this; }

	private $rows = 1;
	public function WithRows($value){ $this->rows = $value; return $this; }

	private $new_line_for_flags = false;
	public function WithFlagsOnNewLine($value){ $this->new_line_for_flags = $value; return $this; }

	public function Render(){
		$default_lang = $this->default_lang === null ? Oxygen::$lang : $this->default_lang;
		$langs = is_null($this->langs) ? Oxygen::$langs : $this->langs;

		echo HiddenBox::Make($this->name,$this->value instanceof Lemma ? $this->value->Encode() : '');
		echo '<table class="formPane" style="width:'.$this->width.';padding:0!important;" cellspacing="0" cellpadding="0" border="0"><tr>';
		echo '<td class="expand" colspan="'.(count($langs)+1).'" class="formPane" style="border:0!important;padding:0!important;">';
		foreach ($langs as $lang){
			TextBox::Make($this->name.'_'.$lang,$this->value[$lang])
				->WithWidth('100%')
				->WithReadonly($this->readonly)
				->WithOnChange("window.$this->name.OnChange();")
				->WithRows($this->rows)
				->WithMode($this->mode)
				->WithCssStyle('border:0!important;'.($lang===$default_lang?'':'display:none;') )
				->Render();
		}
		echo '</td>';

		if ($this->new_line_for_flags) echo '</tr><tr>';

		foreach ($langs as $lang){
			echo '<td class="nowrap" style="border:0!important;padding:0!important;">';
			echo '<a id="'.$this->name.'_'.$lang.'_anchor" href="javascript:'.$this->name.'.ChangeLang('.new Js($lang).');" style="display:block;background:'.($lang===$default_lang?'#dddddd':'#f4f4f4').';">';
			echo new Spacer(7,20);
			echo '<img id="'.$this->name.'_'.$lang.'_flag" src="oxy/lng/'.$lang.($lang===$default_lang?'':'-').'.gif" />';
			echo new Spacer(3,20);
			$ok = ''!=trim($this->value[$lang]);
			echo '<span id="'.$this->name.'_'.$lang.'_check_suc"'.($ok?'':' style="display:none;"').'>'.oxy::icoSuccess()->WithSize(8).'</span>';
			echo '<span id="'.$this->name.'_'.$lang.'_check_err"'.($ok?' style="display:none;"':'').'>'.oxy::icoWarning()->WithSize(8).'</span>';
			echo new Spacer(6,20);
			echo '</a>';
			echo '</td>';
		}
		if ($this->new_line_for_flags) echo '<td class="expand" style="border:0!important;padding:0!important;background:#f4f4f4;"></td>';

		echo '</tr></table>';

		echo Js::BEGIN;
		echo "window.$this->name = {";
		echo "  OnChange : function(){";
		echo "    var s;";
		echo "    var ss = '';";
		foreach ($langs as $lang){
			echo "    s = \$F(".new Js($this->name.'_'.$lang).").trim();";
			echo "    var suc = \$(".new Js($this->name.'_'.$lang.'_check_suc').");";
			echo "    var err = \$(".new Js($this->name.'_'.$lang.'_check_err').");";
			echo "    if (s=='') {suc.hide();err.show();} else { suc.show();err.hide(); }";
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




<?php

class
DateControl extends ValueControl {

	private $allow_null = false;
	public function WithAllowNull($value){ $this->allow_null = $value; return $this; }

	private $null_caption = '&empty;';
	public function WithNullCaption($value){ $this->null_caption = $value; return $this; }

	private $on_change = '';
	public function WithOnChange($value){ $this->on_change = $value; return $this; }

	private $is_readonly;
	public function WithReadOnly($value){ $this->is_readonly = $value; return $this; }

	public function Render(){
		echo new HiddenControl($this->name,$this->value);

		echo '<span style="white-space:nowrap;"';
		if ($this->mode==UIMode::Edit && !$this->is_readonly)
			echo ' class="formPane"';
		else
			echo ' class="formLocked"';
		echo '>';
		echo '<input type="text" id="'.$this->name.'box" value="'.(is_null($this->value)?$this->null_caption:$this->value->GetDay().'/'.$this->value->GetMonth().'/'.$this->value->GetYear());
		if ($this->mode==UIMode::Edit && !$this->is_readonly)
			echo '" class="formPane" onclick="'.$this->name.'ToggleCalendar();"';
		else
			echo '" class="formLocked"';
		echo ' readonly="readonly" style="width:7em;padding:0;margin:0;text-align:center;border:0;" />';
		if ($this->mode==UIMode::Edit && !$this->is_readonly){
			echo '<a href="javascript:'.$this->name.'ToggleCalendar();">';
			echo '<img src="oxy/img/arrow_down.gif" alt="" style="vertical-align:middle;" />';
			echo '</a>';
		}
		echo '</span>';

//		echo '<div class="calendar" id="'.$this->name.'calendar" style="position:absolute;display:none;z-index:1000;"></div>';

		echo Js::BEGIN;
		echo "var ".$this->name."_date=".new Js($this->value).";";

		echo $this->name."ToggleCalendar = function(){";
		echo "var p = $('".$this->name."calendar');";
		echo "if (p == null) $(document.body).insert(". new Js('<div class="calendar" id="'.$this->name.'calendar" style="position:absolute;display:none;z-index:1000;"></div>').');';
		echo "var p = $('".$this->name."calendar');";
		echo "if (p.style.display!='none')";
		echo   "$('".$this->name."calendar').hide();";
		echo "else {";
		echo   "var d = ".$this->name."_date;";
		echo   $this->name.'ShowMonth(d);';
		echo   "p.show();";
		echo   "p.style.left=$('".$this->name."box').positionedOffset().left+'px';";
		echo   "p.style.top=($('".$this->name."box').positionedOffset().top+$('".$this->name."box').getHeight())+'px';";



		if (Browser::IsIE6()){
			echo   "for (var x = $('".$this->name."box').up(); x.style; x = x.up()){";
			echo   "  if (x.style.position == 'absolute') {";
			echo   "    p.style.left = (p.positionedOffset().left + x.positionedOffset().left) + 'px';";
			echo   "    p.style.top = (p.positionedOffset().top + x.positionedOffset().top) + 'px';";
			echo   "  }";
			echo   "}";
		}

		echo "}";
		echo "};";


		echo $this->name."ShowMonth = function(x){";
		echo "var s = '<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">';";

		echo "var d = ".$this->name."_date;";
		echo "var cm = x==null ? ".new Js(new XDateTime())." : x;";
		echo "cm = new Date(cm.getFullYear(),cm.getMonth(),1);";
		echo "var dp = new Date(cm.getFullYear(),cm.getMonth(),1).add({months:-1});";
		echo "var dn = new Date(cm.getFullYear(),cm.getMonth(),1).add({months:1});";
		echo "var dyp = new Date(cm.getFullYear(),cm.getMonth(),1).add({years:-1});";
		echo "var dyn = new Date(cm.getFullYear(),cm.getMonth(),1).add({years:1});";

		echo "var months=new Array(".new Js(Lemma::Retrieve('Jan.'))
														.",".new Js(Lemma::Retrieve('Feb.'))
														.",".new Js(Lemma::Retrieve('Mar.'))
														.",".new Js(Lemma::Retrieve('Apr.'))
														.",".new Js(Lemma::Retrieve('May.'))
														.",".new Js(Lemma::Retrieve('Jun.'))
														.",".new Js(Lemma::Retrieve('Jul.'))
														.",".new Js(Lemma::Retrieve('Aug.'))
														.",".new Js(Lemma::Retrieve('Sep.'))
														.",".new Js(Lemma::Retrieve('Oct.'))
														.",".new Js(Lemma::Retrieve('Nov.'))
														.",".new Js(Lemma::Retrieve('Dec.'))
														.");";
		echo "s+='<tr>';";
		echo "s+='<td class=\"monthx\"><a href=\"javascript:".$this->name."ShowMonth(new Date('+dyp.getFullYear()+','+dyp.getMonth()+','+dyp.getDate()+'));\">&laquo;</a></td>';";
		echo "s+='<td class=\"monthx\"><a href=\"javascript:".$this->name."ShowMonth(new Date('+dp.getFullYear()+','+dp.getMonth()+','+dp.getDate()+'));\">&lt;</a></td>';";
		echo "s+='<td class=\"month\" colspan=\"3\">'+months[cm.getMonth()]+' '+cm.getFullYear()+'</td>';";
		echo "s+='<td class=\"monthx\"><a href=\"javascript:".$this->name."ShowMonth(new Date('+dn.getFullYear()+','+dn.getMonth()+','+dn.getDate()+'));\">&gt;</a></td>';";
		echo "s+='<td class=\"monthx\"><a href=\"javascript:".$this->name."ShowMonth(new Date('+dyn.getFullYear()+','+dyn.getMonth()+','+dyn.getDate()+'));\">&raquo;</a></td>';";
		echo "s+='</tr>';";

		echo "var days=new Array(".new Js(substr(Lemma::Retrieve('Monday'),0,1))
													.",".new Js(substr(Lemma::Retrieve('Tuesday'),0,1))
													.",".new Js(substr(Lemma::Retrieve('Wednesday'),0,1))
													.",".new Js(substr(Lemma::Retrieve('Thursday'),0,1))
													.",".new Js(substr(Lemma::Retrieve('Friday'),0,1))
													.",".new Js(substr(Lemma::Retrieve('Saturday'),0,1))
													.",".new Js(substr(Lemma::Retrieve('Sunday'),0,1))
													.");";

		echo "s+='<tr>';";
		echo "for (i=0;i<days.length;i++)";
		echo "  s+='<td class=\"day\">'+days[i]+'</td>';";
		echo "s+='</tr>';";

		echo "var dd=cm.getDay();";
		echo "if (dd==0) { dd=7;};";
		echo "for (i=1; i<dd; i++){ if (i==0) s+='<tr>'; s+='<td class=\"empty\">&nbsp;</td>'; }";
		echo "var m = cm.getMonth();";
		echo "for (;m==cm.getMonth();cm.add({days:1})){";
		echo "b=false;";
		echo "if (d!=null) b=cm.getFullYear()==d.getFullYear()&&cm.getMonth()==d.getMonth()&&cm.getDate()==d.getDate();";
		echo "if (cm.getDay()==1) s+='<tr>';";
		echo "s+='<td align=\"center\" class=\"'+(b?'selectedday':(cm.getDay()==0||cm.getDay()==6?'weekend':'weekday'))+'\">';";
		echo "s+='<a href=\"javascript:".$this->name."SetDate(new Date('+cm.getFullYear()+','+cm.getMonth()+','+cm.getDate()+'));\">';";
		echo "s+=cm.getDate();";
		echo "s+='</a>';";
		echo "s+='</td>';";
		echo "if (cm.getDay()==0) s+='</tr>';";
		echo "}";
		echo "if (cm.getDay()!=0) for (i=cm.getDay();i<7;i++){ s+='<td class=\"empty\">&nbsp;</td>'; if (i==6) s+='</tr>'; }";

		if ($this->allow_null){
			echo "b=d==null;";
			echo "s+='<tr><td colspan=\"7\" align=\"center\" class=\"'+(b?'selectedday':'weekend')+'\">';";
			echo "s+='<a href=\"javascript:".$this->name."SetDate(null);\">';";
			echo "s+=".new Js($this->null_caption).";";
			echo "s+='</a>';";
			echo "s+='</td></tr>';";
		}
		echo "s+='</table>';";


		echo "$('".$this->name."calendar').update(s);";
		echo "};";

		echo $this->name."SetDate = function(x){";
		echo $this->name."_date=x;";
		echo 'if (x==null){';
		echo "$('".$this->name."box').value=".new Js($this->null_caption).";";
		echo "$('".$this->name."').value='';";
		echo '}';
		echo 'else{';
		echo "day=x.getDate(); if (x.getDate()<10) {day='0'+x.getDate();}";
		echo "month=x.getMonth()+1; if ((x.getMonth()+1)<10) {month='0'+(x.getMonth()+1);}";
		echo "year=x.getFullYear();";
		echo "$('".$this->name."box').value=day+'/'+month+'/'+year;";
		echo "$('".$this->name."').value=year+''+month+''+day+'000000';";
		echo '}';
		echo "$('".$this->name."calendar').hide();";
		echo $this->on_change;
		echo "};";


		echo $this->name."getDate = function(strDate){";
		echo "year = strDate.substring(0,4);";
		echo "month = strDate.substring(4,2);";
		echo "day = strDate.substring(6,2);";
		echo "d = new Date();";
		echo "d.setDate(day);";
		echo "d.setMonth(month);";
		echo "d.setFullYear(year);";
		echo "return d; ";
		echo "};";

		echo Js::END;

	}
}






var is_page_loaded = false;
IsPageLoaded = function(){ return is_page_loaded; };
Event.observe(window,'load',function(ev){is_page_loaded=true;});

// fix for ie <= 7
if(typeof String.prototype.trim !== 'function') { String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g, ''); } }

// fix for prototype 1.6
document.viewport.getWidth = function(){ return window.innerWidth ? window.innerWidth : document.documentElement.clientWidth; };
document.viewport.getHeight = function(){ return window.innerHeight ? window.innerHeight: document.documentElement.clientHeight; };
Prototype.Browser.IE6 = Prototype.Browser.IE && parseInt(navigator.userAgent.substring(navigator.userAgent.indexOf("MSIE")+5)) == 6;
Prototype.Browser.IE7 = Prototype.Browser.IE && parseInt(navigator.userAgent.substring(navigator.userAgent.indexOf("MSIE")+5)) == 7;
Prototype.Browser.IE8 = Prototype.Browser.IE && parseInt(navigator.userAgent.substring(navigator.userAgent.indexOf("MSIE")+5)) == 8;
Prototype.Browser.Safari = Prototype.Browser.WebKit;
Prototype.Browser.SafariIPad = Prototype.Browser.Safari && navigator.userAgent.indexOf('iPad')>-1;
Prototype.Browser.SafariIPod = Prototype.Browser.Safari && navigator.userAgent.indexOf('iPod')>-1;
Prototype.Browser.SafariIPhone = Prototype.Browser.Safari && navigator.userAgent.indexOf('iPhone')>-1;
Prototype.Browser.SafariIOS = Prototype.Browser.SafariIPad || Prototype.Browser.SafariIPod || Prototype.Browser.SafariIPhone;



var Html = function(value){
	this.value = value.isHtmlObject ? value.value : value;
	this.isHtmlObject = true;
	this.toString = function(){return this.value.toString().replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');};
};
var Js = function(value){
	this.value = value.isJsObject ? value.value : value;
	this.isJsObject = true;
	this.toString = function(){ if (typeof(this.value) == 'number') return this.value.toString(); else return '\'' + this.value.toString().replace(/'/g,'\\\'') + '\''; };
};
var Url = function(value){
	this.value = value.isUrlObject ? value.value : value;
	this.isUrlObject = true;
	this.toString = function(){return encodeURIComponent(this.value.toString()).replace(/%2C/g,',');};
};
var Lemma = function(){
	this.data = {};
	for (var i = 1; i < arguments.length; i += 2) this.data[ arguments[i-1] ] = arguments[i];
	this.toString = function(){ return this.data[Oxygen.lang]; };
};
var Oxygen = {
	 lang: oxygen_lang
	,Lang: oxygen_lang
	,Base: oxygen_base
	,Encoding: oxygen_encoding

	,EncodeTemplate:function(s) {
		return s.replace(/<\/(\**)script>/g,'</$1*script>').replace(/<!(\**)\[CDATA\[/g,'<!$1*[CDATA[').replace(/\]\](\**)>/g,']]$1*>');
	}
	,DecodeTemplate:function(s) {
		return s.replace(/<\/(\**)\*script>/g,'</$1script>').replace(/<!(\**)\*\[CDATA\[/g,'<!$1[CDATA[').replace(/\]\](\**)\*>/g,']]$1>');
	}
	,current_ajax_dialog_url: null
	,current_ajax_dialog_clock_timer: null
	,current_ajax_dialog_clock_value: 0

	,fog_appearing: false
	,fog_disapearing: false
	,fog_visible: false

	,ShowFog: function(){
		if (Prototype.Browser.IE6) return;
		var fog = $('OxygenDialogFog');
		if (fog==null) fog = $( document.body.appendChild(new Element('div',{'id':'OxygenDialogFog','class':'zdialogfog ajaxdialogfog','style':'position:fixed;top:0;left:0;width:100%;height:100%;display:none;'})) );
		if (this.fog_appearing) return;
		if (this.fog_disapearing) setTimeout( function(){Oxygen.ShowFog();} );
		if (this.fog_visible) return;
		this.fog_appearing = true;
		fog.appear({duration: 0.2, from: 0.0, to: 0.8, afterFinish:function(){ Oxygen.fog_appearing = false; Oxygen.fog_visible=true; } });
	}
	,HideFog: function(){
		var fog = $('OxygenDialogFog');
		if (fog==null) return;
		if (this.fog_disapearing) return;
		if (this.fog_appearing) setTimeout( function(){Oxygen.HideFog();} );
		if (!this.fog_visible) return;
		this.fog_dappearing = true;
		fog.fade({duration: 0.5, from: 0.8, to: 0.0, afterFinish:function(){ Oxygen.fog_disapearing = false; Oxygen.fog_visible=false;} });
	}

	,MakeDialog: function(icon,title,width,height){
		if (this.current_ajax_dialog_clock_timer != null) {
			clearTimeout(this.current_ajax_dialog_clock_timer);
			this.current_ajax_dialog_clock_timer = null;
		}
		if (this.dialog_watchdog != null){
			clearInterval(this.dialog_watchdog);
			this.dialog_watchdog = null;
		}
		this.dialog_width = null;
		this.dialog_min_height = null;
		jQuery('#OxygenDialogFrame').detach();
		if (Prototype.Browser.IE6) jQuery('body').append(''
			+'<div id="OxygenDialogFrame" class="zdialog overflow" style="position:absolute;top:0;left:0;display:none;">'
			+'<table id="OxygenDialogFrameX" cellspacing="20" cellpadding="0" border="0" style="width:100%;height:100%;"><tr><td style="vertical-align:middle;">'
			+'<div id="OxygenDialog" class="ajaxdialog" style="width:'+width+'px;height:'+height+'px;margin:0 auto;">'
			+'<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td id="OxygenDialogX">'
			+'<div class="ajaxdialog1"><div class="ajaxdialog3"><div class="ajaxdialog2"><h1>'+icon+'&nbsp;'+title+'</h1></div></div></div>'
			+'<div class="ajaxdialog4"><div class="ajaxdialog6"><div class="ajaxdialog5">'
			+'<div id="OxygenDialogInner" class="ajaxdialoginner">'
			+'<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td id="OxygenDialogInnerX"></td></tr></table>'
			+'</div>'
			+'</div></div></div>'
			+'<div class="ajaxdialog7"><div class="ajaxdialog9"><div class="ajaxdialog8"></div><div></div>'
			+'</td></tr></table>'
			+'</div>'
			+'</td></tr></table>'
			+'</div>'
			);
		else jQuery('body').append(''
			+'<div id="OxygenDialogFrame" class="zdialog overflow" style="position:fixed;top:0;left:0;width:100%;height:100%;display:none;">'
			+'<table id="OxygenDialogFrameX" cellspacing="20" cellpadding="0" border="0" style="width:100%;height:100%;"><tr><td style="vertical-align:middle;">'
			+'<div id="OxygenDialog" class="ajaxdialog" style="width:'+width+'px;height:'+height+'px;margin:0 auto;">'
			+'<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td id="OxygenDialogX">'
			+'<div class="ajaxdialog1"><div class="ajaxdialog3"><div class="ajaxdialog2"><h1>'+icon+'&nbsp;'+title+'</h1></div></div></div>'
			+'<div class="ajaxdialog4"><div class="ajaxdialog6"><div class="ajaxdialog5">'
			+'<div id="OxygenDialogInner" class="ajaxdialoginner">'
			+'<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td id="OxygenDialogInnerX"></td></tr></table>'
			+'</div>'
			+'</div></div></div>'
			+'<div class="ajaxdialog7"><div class="ajaxdialog9"><div class="ajaxdialog8"></div><div></div>'
			+'</td></tr></table>'
			+'</div>'
			+'</td></tr></table>'
			+'</div>'
			);
		this.dialog_min_width = width;
		this.dialog_min_height = height;
	}
	,ShowDialog: function(){
		var dialog_frame = $('OxygenDialogFrame');
		if (dialog_frame == null) return;
		dialog_frame.show();
		if (Prototype.Browser.IE6) {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
	}
	,WatchDialogSize: function(){
		this.ResizeDialog();
		Oxygen.dialog_watchdog = setInterval( function(){ Oxygen.ResizeDialog(); } , 250 );
	}
	,ShowSimpleDialog: function(icon,title,content,width,height){
		this.ShowFog();
		if (!width) width=500;
		if (!height) height=50;
		this.MakeDialog(icon,title,width,height);
		$('OxygenDialogInnerX').update(content);
		this.ShowDialog();
		this.WatchDialogSize();
	}
	,ShowIFrameDialog: function(icon,title,url,width,height){
		this.ShowFog();
		this.MakeDialog(icon,title,width,height);
		this.ShowDialog();
		var inner = jQuery('#OxygenDialogInner');
		var innerx = jQuery('#OxygenDialogInnerX');
		var dialogx = jQuery('#OxygenDialogX');
		var dialog_extra_height = dialogx.outerHeight(true) - innerx.height();
		var dialog_extra_width = dialogx.outerWidth(true) - inner.width();
		$('OxygenDialogInnerX').appendChild(new Element('iframe',{'src':url,'width':width-dialog_extra_width,'height':height-dialog_extra_height,'style':'border:0;'}));
		this.current_ajax_dialog_url = url;
		this.WatchDialogSize();
	}
	,ShowAjaxDialog: function(icon,title,url,width,height){
		this.ShowFog();
		var dialog = this.MakeDialog(icon,title,width,height);
		$('OxygenDialogInnerX').update('<div style="text-align:center;"><img src=\"oxy/img/ajax.gif\" align="absmiddle" hspace="10" vspace="10" /><br/><span id=\"OxygenDialogClock\">0:00</span></div>');
		this.current_ajax_dialog_clock_value = 0;
		this.current_ajax_dialog_clock_timer = setTimeout(function(){Oxygen.UpdateDialogClock();},1000);
		this.ShowDialog();
		this.WatchDialogSize();
		if (url != null){
			new Ajax.Request(url,{
				method:'get'
				,encoding:Oxygen.Encoding
				,onSuccess:function(transport){
					if (Oxygen.current_ajax_dialog_clock_timer != null) {
						clearTimeout(Oxygen.current_ajax_dialog_clock_timer);
						Oxygen.current_ajax_dialog_clock_timer = null;
					}
					$('OxygenDialogInnerX').update(transport.responseText);
					Oxygen.FocusDialog();
					Oxygen.ResizeDialog();
				}
			});
		}
		this.current_ajax_dialog_url = url;
	}
	,UpdateDialogClock: function(){
		clock = $('OxygenDialogClock');
		if (clock == null) return;
		this.current_ajax_dialog_clock_value++;
		min = Math.floor( this.current_ajax_dialog_clock_value / 60 );
		sec = this.current_ajax_dialog_clock_value % 60;
		clock.update(min + ':' + (sec<10?'0':'') + sec);
		this.current_ajax_dialog_clock_timer = setTimeout(function(){Oxygen.UpdateDialogClock();},1000);
	}
	,HideDialog: function(){
		if (this.current_ajax_dialog_clock_timer != null) {
			clearTimeout(this.current_ajax_dialog_clock_timer);
			this.current_ajax_dialog_clock_timer = null;
		}
		if (this.dialog_watchdog != null){
			clearInterval(this.dialog_watchdog);
			this.dialog_watchdog = null;
		}
		this.HideFog();
		jQuery('#OxygenDialogFrame').detach();
		this.current_ajax_dialog_url = null;
	}

	,RedirectAjaxDialog: function(url){
		var x = $('OxygenDialogInnerX');
		x.update('<div style="text-align:center"><img src=\"oxy/img/ajax.gif\" hspace=\"10\" vspace=\"1\" align="absmiddle"/><br/><span id=\"OxygenDialogClock\">0:00</span></div>');
		this.current_ajax_dialog_clock_value = 0;
		this.current_ajax_dialog_clock_timer = setTimeout(function(){Oxygen.UpdateDialogClock();},1000);
		this.ResizeDialog();
		new Ajax.Request(url,{
			method:'get'
			,encoding:Oxygen.Encoding
			,onSuccess:function(transport){
				if (Oxygen.current_ajax_dialog_clock_timer != null) {
					clearTimeout(Oxygen.current_ajax_dialog_clock_timer);
					Oxygen.current_ajax_dialog_clock_timer = null;
				}
				$('OxygenDialogInnerX').update(transport.responseText);
				Oxygen.ResizeDialog();
			}
		});
	}
	,SubmitAjaxDialog: function(form){
		var params = $(form).serialize(true);
		var x = $('OxygenDialogInnerX');
		x.update('<div style="text-align:center"><img src=\"oxy/img/ajax.gif\" hspace=\"10\" vspace=\"1\" align="absmiddle"/><br/><span id=\"OxygenDialogClock\">0:00</span></div>');
		this.current_ajax_dialog_clock_value = 0;
		this.current_ajax_dialog_clock_timer = setTimeout(function(){Oxygen.UpdateDialogClock();},1000);
		this.ResizeDialog();
		new Ajax.Request(this.current_ajax_dialog_url,{
			method:'post'
			,parameters:params
			,encoding:Oxygen.Encoding
			,onSuccess:function(transport){
				if (Oxygen.current_ajax_dialog_clock_timer != null) {
					clearTimeout(Oxygen.current_ajax_dialog_clock_timer);
					Oxygen.current_ajax_dialog_clock_timer = null;
				}
				$('OxygenDialogInnerX').update(transport.responseText);
				Oxygen.ResizeDialog();
			}
		});
	}
	,FocusDialog: function(){
		var dialog = $('OxygenDialog');
		var a = dialog.descendants();
		for(var i = 0; i<a.length; i++){
			if ( (a[i].tagName==='INPUT' && a[i].type!=='hidden' && a[i].readonly != 'readonly') || a[i].tagName==='SELECT' || a[i].tagName==='TEXTAREA' ) {
				try{
					a[i].focus(); // nasty explorer bug...
				}
				catch(ex){}
				break;
			}
		}
		dialog = jQuery('#OxygenDialog');
		dialog.scrollTop(0);
		dialog.scrollLeft(0);
	}
	,dialog_min_width : 1
	,dialog_min_height : 1
	,dialog_width : null
	,dialog_height : null
	,dialog_watchdog : null
	,ResizeDialog:function(){
		if (!this.IsDialogOpen()) return ;
		var dialog = jQuery('#OxygenDialog');
		var viewport = jQuery(window);
		var inner = jQuery('#OxygenDialogInner');
		var innerx = jQuery('#OxygenDialogInnerX');
		var dialogx = jQuery('#OxygenDialogX');
		var frame = jQuery('#OxygenDialogFrame');
		var framex = jQuery('#OxygenDialogFrameX');

		frame.height(viewport.height());
		frame.width(viewport.width());
		if (framex.height() < viewport.height()) framex.height(viewport.height());

		var h = null;
		var w = null;
		if (Prototype.Browser.IE6){

		}
		else {
			inner.height(innerx.outerHeight(true));
			inner.width(innerx.outerWidth(true));
			dialog.height( dialogx.outerHeight(true) );
			dialog.width( dialogx.outerWidth(true) );
			h = dialog.height();
			w = dialog.width();
		}
		if (this.dialog_height !== h || this.dialog_width !== w) {
			this.dialog_height = h;
			this.dialog_width = w;
			if (Prototype.Browser.SafariIOS){
				if (viewport.height() - h < 40)
					dialog.css({'margin-bottom':'100px'});
				else
					dialog.css({'margin-bottom':'0'});
			}
		}
	}
	,IsDialogOpen:function(){
		return $('OxygenDialog')!=null;
	}
	,Refresh:function(){
		window.location.href=window.location.href;
	}
	,OpenDynamicAction:function(js_command,mapper){
		var map=mapper();
		for(var xxx in map)js_command=js_command.replace(xxx,map[xxx]);
		eval(js_command);
	}
	,AjaxUpdater:function(e,act,opt) { var o={method:'get',encoding:Oxygen.Encoding,evalScripts:true}; if(opt)for(var key in opt)if(opt.hasOwnProperty(key))o[key]=opt[key]; return new Ajax.Updater(e,act,o); }
	,AjaxRequest:function(act,opt) { var o={method:'get',encoding:Oxygen.Encoding,evalScripts:true}; if(opt)for(var key in opt)if(opt.hasOwnProperty(key))o[key]=opt[key]; return new Ajax.Request(act,o); }

	,RequestNotificationPermission:function() {
		if (!("Notification" in window)) return;
		if (Notification.permission === 'denied') return;
		if (Notification.permission !== 'granted') Notification.requestPermission(function(){});
	}
	,Notify:function(icon,title,message) {
		if (!("Notification" in window)) return;
		if (Notification.permission === 'denied') return;
		if (Notification.permission !== 'granted') { Notification.requestPermission(function(){ Oxygen.Notify(icon,title,message); }); return; }
		var x = new Notification(title,{body:message,icon:icon});
		x.onclick = function(){ this.close(); };
  }
	,FitIn:function(max_width,max_height,img_width,img_height) {
	  return max_width/max_height < img_width/img_height
			? {width:max_width,height:Math.floor(img_height*(max_width/img_width))}
			: {width:Math.floor(img_width*(max_height/img_height)),height:max_height}
		  ;
	 }
	,RollerBox:function(opt){var ns=opt.ns;var r={ns:ns
		,is_readonly:false
		,values:[]
		,selected_index:0
		,on_change:function(){}
		,SetValue:function(value){var old=this.selected_index;for(var i=0;i<this.values.length;i++)if(this.values[i]===value){this.selected_index=i;break;}this.Update();if(this.selected_index!=old)this.OnChange();}
		,GetValue:function(){return jQuery('#'+ns).val();}
		,Update:function(){jQuery('#'+ns).val(this.values[this.selected_index]);for(var i=0;i<this.values.length;i++)jQuery('#'+ns+'-'+i).toggle(i===this.selected_index);}
		,Change:function(){if(++this.selected_index>=this.values.length)this.selected_index=0;this.Update();this.OnChange();}
		,OnChange:function(){this.on_change();jQuery('#'+ns).trigger('change');}
	};for(var key in opt)if(opt.hasOwnProperty(key))r[key]=opt[key];window[ns]=r;return r;}

	,CheckBox:function(opt){var ns=opt.ns;var r={ns:ns
		,ico_checked:'',ico_unchecked:'',ico_dirty:'',ico_checked_false:''
		,is_dirty:false
		,list_ns:[]
		,list_value:''
		,radio_ns:null
		,allow_null:false
		,on_change:function(){}
		,SetValue:function(value){var old = this.GetValue(); if(value!==true&&value!==false)value=this.allow_null?null:false; jQuery('#'+ns).val(value===true?'true':(value===false?'false':'')); this.Update(); if(old!==value)this.OnChange(); }
		,Check:function(){this.SetValue(true);}
		,GetValue:function(){ var s=jQuery('#'+ns).val(); if (s==='true') return true; if (s==='false') return false; return this.allow_null?null:false; }
		,GetListValue:function(){return this.list_value;}
		,Update:function(){ var v = this.GetValue(); jQuery('#'+ns+'-box').html(this.is_dirty ? this.ico_dirty : (this.allow_null ? (v===true?this.ico_checked:(v===false?this.ico_checked_false:this.ico_unchecked)) : (v?this.ico_checked:this.ico_unchecked) )); }
		,IsDirty:function(){return this.is_dirty;}
		,SetDirty:function(dirty){this.is_dirty=dirty;this.Update();}
		,Toggle:function(){ var v = this.GetValue(); this.SetValue( this.allow_null ? (v===true?false:(v===false?null:true)) : !v ); }
		,OnClick:function() {
			if(this.radio_ns!==null) { this.Check(); return; }
			if (this.list_ns.length > 0) {
				var ev = window.event || arguments.callee.caller.arguments[0];
				var ls = window[this.list_ns[0]];
				if (ev.shiftKey) if (ls.Cascade(ns)) return;
				ls.SetLastClicked(ns);
			}
			this.Toggle();
		}
		,OnChange:function(){ var i;
			for(i=0;i<this.list_ns.length;i++)window[this.list_ns[i]].OnChangeOne();
			if(this.radio_ns!==null && this.GetValue()===true) window[this.radio_ns].SetValue(this.list_value);
			this.on_change();jQuery('#'+ns).trigger('change');
		}};for(var key in opt)if(opt.hasOwnProperty(key))r[key]=opt[key];window[ns]=r;return r;
	}

	,DateBox:function(opt){var ns=opt.ns;var r={ns:ns
		,date : null
		,allow_null : false
		,show_value : true
		,month : null
		,is_open : false
		,pseudo_focus : 'd'
		,keep_focus : false
		,on_change:function(){}
		,OnChange:function(){this.on_change();jQuery('#'+ns).trigger('change');}
		,SetDate:function(x){this.SetD(x);this.HideDropDown();}
		,GetDate:function(){return this.date;}
		,SetD:function(x){
      this.date=x;
			if (x==null){
			  jQuery('#'+ns+'-box-null').show();
			  jQuery('#'+ns+'-box-date').hide();
			  jQuery('#'+ns+'').val('');
			  this.pseudo_focus = 'd';
			}
			else {
			  jQuery('#'+ns+'-box-null').hide();
			  jQuery('#'+ns+'-box-date').show();
			  var d = x.getDate(); d=(d<10?'0':'')+d;
			  var m = x.getMonth()+1; m=(m<10?'0':'')+m;
			  var y = x.getFullYear()+'';
			  jQuery('#'+ns+'-d').html(d);
			  jQuery('#'+ns+'-m').html(m);
			  jQuery('#'+ns+'-y').html(y);
			  jQuery('#'+ns+'').val(y+m+d+'000000');
			}
			this.ShowMonth(x);
			this.OnChange();
	  }
		,GetToday:function(){ var d = new Date(); return new Date(d.getFullYear(), d.getMonth(), d.getDate()); }
		,CloneDate:function(d){ return new Date(d.getFullYear(),d.getMonth(),d.getDate()); }
		,IncD : function(){this.SetD(this.date===null?this.GetToday():this.CloneDate(this.date).add({days:1}));}
		,DecD : function(){this.SetD(this.date===null?this.GetToday():this.CloneDate(this.date).add({days:-1}));}
		,IncM : function(){this.SetD(this.date===null?this.GetToday():this.CloneDate(this.date).add({months:1}));}
		,DecM : function(){this.SetD(this.date===null?this.GetToday():this.CloneDate(this.date).add({months:-1}));}
		,IncY : function(){this.SetD(this.date===null?this.GetToday():this.CloneDate(this.date).add({years:1}));}
		,DecY : function(){this.SetD(this.date===null?this.GetToday():this.CloneDate(this.date).add({years:-1}));}
		,ShowPrevMonth:function(){this.ShowMonth(this.CloneDate(this.month).add({months:-1}));}
		,ShowNextMonth:function(){this.ShowMonth(this.CloneDate(this.month).add({months:1}));}
		,ShowPrevYear:function(){this.ShowMonth(this.CloneDate(this.month).add({years:-1}));}
		,ShowNextYear:function(){this.ShowMonth(this.CloneDate(this.month).add({years:1}));}
		,ShowMonth : function(x){
		  var cm = x==null ? this.GetToday() : x;
		  this.month = new Date(cm.getFullYear(),cm.getMonth(),1);
		  this.Update();
		}
		,SetPseudoFocus:function(f){ this.pseudo_focus = f; this.Update(); }
		,OnKeyDown : function(ev){
		  switch(ev.which){
		    case 13:case 27:if(this.is_open){this.HideDropDown();ev.preventDefault();}break;
		    case 32:this.ToggleDropDown();break;
		    case 8:case 46:if(this.allow_null) { this.SetD(null);ev.preventDefault(); }break;
		    case 9:if(this.date===null)return;if(this.pseudo_focus==='d'&&!ev.shiftKey)this.SetPseudoFocus('m');else if(this.pseudo_focus==='m')this.SetPseudoFocus(ev.shiftKey?'d':'y');else if(this.pseudo_focus==='y'&&ev.shiftKey)this.SetPseudoFocus('m');else return;ev.preventDefault();break;
		    case 38:case 39:if(this.pseudo_focus==='d')this.IncD();if(this.pseudo_focus==='m')this.IncM();if(this.pseudo_focus==='y')this.IncY();ev.preventDefault();break;
		    case 40:case 37:if(this.pseudo_focus==='d')this.DecD();if(this.pseudo_focus==='m')this.DecM();if(this.pseudo_focus==='y')this.DecY();ev.preventDefault();break;
		    case 33:if(this.is_open){this.ShowPrevMonth();ev.preventDefault();}break;
		    case 34:if(this.is_open){this.ShowNextMonth();ev.preventDefault();}break;
		  }
		}
		,OnBlur : function(ev){ if (this.show_value) setTimeout(function(){if(!window[ns].keep_focus&&!jQuery('#'+ns+'-box').is(':focus')){ window[ns].HideDropDown();window[ns].HidePseudoFocus();}},200); }
		,KeepFocus : function(){ this.keep_focus = true; setTimeout(function(){ window[ns].Update(); },500); }
		,month_labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
		,day_labels:['Mon','Tue','Wed','Thu','Fri','Sat','Sun']
		,Update : function(){
		  this.ShowPseudoFocus();
		  if (!this.is_open) return;
		  var d = this.date;
		  var today = this.GetToday();
		  cm = this.CloneDate(this.month);
		  var dp = this.CloneDate(this.month).add({months:-1});
		  var dn = this.CloneDate(this.month).add({months:1});
		  var dyp = this.CloneDate(this.month).add({years:-1});
		  var dyn = this.CloneDate(this.month).add({years:1});
		  jQuery('#'+ns+'-month').html(this.month_labels[cm.getMonth()]+' '+cm.getFullYear());
		  var s = '';
		  s+='<table class=\"calendar\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">';
		  s+='<tr>';
		  for (i=0;i<this.day_labels.length;i++) s+='<th class=\"day\">'+this.day_labels[i]+'</th>';
		  s+='</tr>';
		  var dd;
		  dd=cm.getDay();if(dd==0)dd=7;
		  for (i=1; i<dd; i++){ if (i==0) s+='<tr>'; s+='<td class=\"empty\">&nbsp;</td>'; }
		  var m = cm.getMonth();
		  for (;m==cm.getMonth();cm.add({days:1})){
		    dd=cm.getDay();if(dd==0)dd=7;
		    var b=false;
		    if (d!=null) b=cm.getFullYear()==d.getFullYear()&&cm.getMonth()==d.getMonth()&&cm.getDate()==d.getDate();
		    if (dd==1) s+='<tr>';
		    s+='<td class=\"day'+(b?' selected':'')+(cm.compareTo(today)<0?' past':(cm.compareTo(today)==0?' today':' future'))+(cm.getDay()==0||cm.getDay()==6?' weekend':'')+'\">';
		    s+='<a href=\"javascript:window.'+ns+'.SetDate(new Date('+cm.getFullYear()+','+cm.getMonth()+','+cm.getDate()+'));\">';
		    s+=cm.getDate();
		    s+='</a>';
		    s+='</td>';
		    if (dd==7) s+='</tr>';
		  }
		  dd=cm.getDay();if(dd==0)dd=7;
		  if (dd!=1) for (i=dd;i<8;i++){ s+='<td class=\"empty\">&nbsp;</td>'; if (i==7) s+='</tr>'; }
		  s+='</table>';
		  jQuery('#'+ns+'-dropdown-body').html(s);
		  jQuery('#'+ns+'-box').focus();
		  this.keep_focus = false;
		}
		,Clicking : false
		,OnClick : function (){ if(this.Clicking) return; this.Clicking = true; this.ToggleDropDown(); setTimeout(function(){ window[ns].Clicking = false; },500); }
		,ToggleDropDown : function(){ if (jQuery('#'+ns+'-dropdown').is(':visible')) this.HideDropDown(); else this.ShowDropDown(); }
		,Showing : false
		,ShowDropDown : function(){
		  this.Showing = true;
		  var b = jQuery('#'+ns+(this.show_value?'-box':'-anchor'));
		  var d = jQuery('#'+ns+'-dropdown');
		  d.show();
		  var w = d.width();
		  var ww = b.outerWidth(false) - (d.outerWidth(false) - w);
		  if (ww > w) d.css({width:ww+'px'});
		  d.css({'margin-top':(1+b.outerHeight(false))+'px','margin-left':Math.floor((b.outerWidth(false)-d.outerWidth(false))/2)+'px'});
		  this.is_open = true;
		  this.ShowMonth(this.date);
		  jQuery('html').on('click.'+ns, function(e){ if (window[ns].Showing) { window[ns].Showing = false; return; } if(window[ns].Clicking)return; if (jQuery('#'+ns+'-dropdown').has(e.target).length === 0) window[ns].HideDropDown(); });
		}
		,HideDropDown : function(){
		  this.keep_focus = false;
		  this.is_open = false;
		  jQuery('#'+ns+'-dropdown').hide();
		  jQuery('html').off('click.'+ns);
		  this.ShowPseudoFocus();
		}
		,ShowPseudoFocus : function(){
		  jQuery('#'+ns+'-d').css({'text-decoration':this.pseudo_focus==='d'?'underline':'none'});
		  jQuery('#'+ns+'-m').css({'text-decoration':this.pseudo_focus==='m'?'underline':'none'});
		  jQuery('#'+ns+'-y').css({'text-decoration':this.pseudo_focus==='y'?'underline':'none'});
		}
		,HidePseudoFocus : function(){ jQuery('#'+ns+'-d,#'+ns+'-m,#'+ns+'-y').css({'text-decoration':'none'}); }
		};for(var key in opt)if(opt.hasOwnProperty(key))r[key]=opt[key];window[ns]=r;return r;
	}

	,TimeBox:function(opt){var ns=opt.ns;var r={ns:ns
		,pseudo_focus : 'h'
		,is_open : false
		,keep_focus : false
		,allow_null : false
		,show_seconds : false
		,h:null
		,m:null
		,s:null
		,on_change:function(){}
		,SetDate:function(d){if(d===null){this.h=this.m=this.s=null;this.pseudo_focus='h';}else{var x=d.getHours();this.h=x<10?'0'+x:''+x;var x=d.getMinutes();this.m=x<10?'0'+x:''+x;var x=d.getSeconds();this.s=x<10?'0'+x:''+x;} this.OnChange(); this.Update(); }
		,GetDate:function(){if(this.h===null||this.m===null||this.s===null)return null;return new Date(2000,1,1,parseInt(this.h,10),parseInt(this.m,10),parseInt(this.s,10));}
		,SetH : function(x){if(x===null){this.h=this.m=this.s=null;this.pseudo_focus='h';}else{ if(x<0)x+=24;x%=24;this.h=x<10?'0'+x:''+x;if(this.m===null)this.m='00';if(this.s===null)this.s='00';this.pseudo_focus='h'; } this.OnChange(); this.Update(); }
		,SetM : function(x){if(x===null){this.h=this.m=this.s=null;this.pseudo_focus='h';}else{ if(x<0)x+=60;x%=60;this.m=x<10?'0'+x:''+x;if(this.s===null)this.s='00';if(this.h===null)this.h='00';this.pseudo_focus='m'; } this.OnChange(); this.Update(); }
		,SetS : function(x){if(x===null){this.h=this.m=this.s=null;this.pseudo_focus='h';}else{ if(x<0)x+=60;x%=60;this.s=x<10?'0'+x:''+x;if(this.h===null)this.h='00';if(this.m===null)this.m='00';this.pseudo_focus='s'; } this.OnChange(); this.Update(); }
		,SetAM : function(){ this.SetH( this.h===null ? 0 : parseInt(this.h,10) % 12 ); }
		,SetPM : function(){ this.SetH( this.h===null ? 12 : parseInt(this.h,10) % 12 + 12 ); }
		,OnChange : function(){
			if(this.h===null){
			  jQuery('#'+ns+'-box-null').show();
			  jQuery('#'+ns+'-box-time').hide();
			  jQuery('#'+ns+'').val('');
			}
			else {
			  jQuery('#'+ns+'-box-null').hide();
			  jQuery('#'+ns+'-box-time').show();
			  jQuery('#'+ns+'-box-h').html(this.h);
			  jQuery('#'+ns+'-box-m').html(this.m);
			  jQuery('#'+ns+'-box-s').html(this.s);
			  jQuery('#'+ns+'').val('20000000'+this.h+this.m+this.s);
			}
			this.on_change();jQuery('#'+ns).trigger('change');
		}
		,OnKeyDown : function(ev){
			switch(ev.which){
				case 13:case 27:if(this.is_open){this.HideDropDown();ev.preventDefault();}break;
				case 32:this.ToggleDropDown();break;
				case 8:case 46:if(this.allow_null){this.SetH(null);ev.preventDefault();}break;
				case 9:
					if(this.h===null)return;
					if (this.show_seconds) {
			      if(this.pseudo_focus==='h'&&!ev.shiftKey)this.SetPseudoFocus('m');else if(this.pseudo_focus==='m')this.SetPseudoFocus(ev.shiftKey?'h':'s');else if(this.pseudo_focus==='s'&&ev.shiftKey)this.SetPseudoFocus('m');else return;
					}
					else {
		        if(this.pseudo_focus==='h'&&!ev.shiftKey)this.SetPseudoFocus('m');else if(this.pseudo_focus==='m'&&ev.shiftKey)this.SetPseudoFocus('h');else return;
					}
					ev.preventDefault();break;
	      case 38:case 39:if(this.pseudo_focus=='h')this.SetH(this.h===null?0:(parseInt(this.h,10)+1)); else if(this.pseudo_focus=='m')this.SetM(this.m===null?0:(parseInt(this.m,10)+1)); else if(this.pseudo_focus=='s')this.SetS(this.s===null?0:(parseInt(this.s,10)+1)); break;
	      case 40:case 37:if(this.pseudo_focus=='h')this.SetH(this.h===null?0:(parseInt(this.h,10)-1)); else if(this.pseudo_focus=='m')this.SetM(this.m===null?0:(parseInt(this.m,10)-1)); else if(this.pseudo_focus=='s')this.SetS(this.s===null?0:(parseInt(this.s,10)-1)); break;
	    }
	  }
		,OnBlur : function(ev){ setTimeout(function(){if(!window[ns].keep_focus&&!jQuery('#'+ns+'-box').is(':focus')){ window[ns].HideDropDown();window[ns].HidePseudoFocus(); }},200); }
		,SetPseudoFocus : function(f){ this.pseudo_focus=f; this.Update(); }
		,KeepFocus : function(){ this.keep_focus = true; setTimeout(function(){ window[ns].Update(); },500); }
		,Update : function(){
	    this.ShowPseudoFocus();
	    if (!this.is_open) return;
	    jQuery('#'+ns+'-h').html(this.h);
	    jQuery('#'+ns+'-m').html(this.m);
	    jQuery('#'+ns+'-s').html(this.s);
			if (this.pseudo_focus==='h') {
			  var xo=90,yo=90,R=75,r=6,s='',v=parseInt(this.h,10),o=v<12?0:12;
			  jQuery('#'+ns+'-clock a').detach();
			  for(var i = o; i < o+12; i++){
			    var x = Math.floor(xo - r - R * Math.cos((i-o) * Math.PI / 6));
			    var y = Math.floor(yo - r + R * Math.sin((i-o) * Math.PI / 6));
			    s += '<a id=\"'+ns+'-h-'+(i<10?'0':'')+i+'\" href=\"javascript:'+ns+'.SetH('+i+');\" class=\"'+(i==v?'selected':'')+'\" style=\"width:'+(2*r)+'px;height:'+(2*r)+'px;margin:'+x+'px 0 0 '+y+'px;\"><img src="oxy/img/spacer.gif" style="width:1px;height:1px;"/></a>'
			  }
			  jQuery('#'+ns+'-clock').prepend(s);
			  jQuery('#'+ns+'-clock span').removeClass('focus');
			  jQuery('#'+ns+'-h').addClass('focus');
			}
			else if (this.pseudo_focus==='m') {
			  var xo=90,yo=90,R=85,r1=5,r2=2,s='',v=parseInt(this.m,10);
			  jQuery('#'+ns+'-clock a').detach();
			  for(var i = 0; i < 60; i++){
			    var r = i%5==0 ? r1 : r2;
			    var x = Math.floor(xo - r - R * Math.cos(i * Math.PI / 30));
			    var y = Math.floor(yo - r + R * Math.sin(i * Math.PI / 30));
			    s += '<a id=\"'+ns+'-m-'+(i<10?'0':'')+i+'\" href=\"javascript:'+ns+'.SetM('+i+');\" class=\"'+(i==v?'selected':'')+'\" style=\"width:'+(2*r)+'px;height:'+(2*r)+'px;margin:'+x+'px 0 0 '+y+'px;\"><img src="oxy/img/spacer.gif" style="width:1px;height:1px;"/></a>'
			  }
			  jQuery('#'+ns+'-clock').prepend(s);
			  jQuery('#'+ns+'-clock span').removeClass('focus');
			  jQuery('#'+ns+'-m').addClass('focus');
			}
			else if (this.pseudo_focus==='s') {
			  var xo=90,yo=90,R=85,r1=5,r2=2,s='',v=parseInt(this.s,10);
			  jQuery('#'+ns+'-clock a').detach();
			  for(var i = 0; i < 60; i++){
			    var r = i%5==0 ? r1 : r2;
			    var x = Math.floor(xo - r - R * Math.cos(i * Math.PI / 30));
			    var y = Math.floor(yo - r + R * Math.sin(i * Math.PI / 30));
			    s += '<a id=\"'+ns+'-s-'+(i<10?'0':'')+i+'\" href=\"javascript:'+ns+'.SetS('+i+');\" class=\"'+(i==v?'selected':'')+'\" style=\"width:'+(2*r)+'px;height:'+(2*r)+'px;margin:'+x+'px 0 0 '+y+'px;\"><img src="oxy/img/spacer.gif" style="width:1px;height:1px;"/></a>'
			  }
			  jQuery('#'+ns+'-clock').prepend(s);
			  jQuery('#'+ns+'-clock span').removeClass('focus');
			  jQuery('#'+ns+'-s').addClass('focus');
			}
			jQuery('#'+ns+'-box').focus();
			this.keep_focus = false;
		}
		,Clicking : false
		,OnClick : function (){ if(this.Clicking) return; this.Clicking = true; this.ToggleDropDown(); setTimeout(function(){ window[ns].Clicking = false; },500); }
		,ToggleDropDown : function(){ if (jQuery('#'+ns+'-dropdown').is(':visible')) this.HideDropDown(); else this.ShowDropDown(); }
		,Showing : false
		,ShowDropDown : function(){
	    this.Showing = true;
	    var b = jQuery('#'+ns+'-box');
	    var d = jQuery('#'+ns+'-dropdown');
	    d.show();
	    var w = d.width();
	    var ww = b.outerWidth(false) - (d.outerWidth(false) - w);
	    if (ww > w) d.css({width:ww+'px'});
	    d.css({'margin-top':(1+b.outerHeight(false))+'px','margin-left':Math.floor((b.outerWidth(false)-d.outerWidth(false))/2)+'px'});
	    this.is_open = true;
	    this.Update();
	    jQuery('html').on('click.'+ns, function(e){ if (window[ns].Showing) { window[ns].Showing = false; return; } if(window[ns].Clicking)return; if (jQuery('#'+ns+'-dropdown').has(e.target).length === 0) window[ns].HideDropDown(); });
	  }
		,HideDropDown : function(){
	    this.keep_focus = false;
	    this.is_open = false;
	    jQuery('#'+ns+'-dropdown').hide();
	    jQuery('html').off('click.'+ns);
	    this.ShowPseudoFocus();
	  }
		,ShowPseudoFocus : function(){
	    jQuery('#'+ns+'-box-h').css({'text-decoration':this.pseudo_focus==='h'?'underline':'none'});
	    jQuery('#'+ns+'-box-m').css({'text-decoration':this.pseudo_focus==='m'?'underline':'none'});
	    jQuery('#'+ns+'-box-s').css({'text-decoration':this.pseudo_focus==='s'?'underline':'none'});
	  }
		,HidePseudoFocus : function(){
	    jQuery('#'+ns+'-box-h,#'+ns+'-box-m,#'+ns+'-box-s').css({'text-decoration':'none'});
	  }
		};for(var key in opt)if(opt.hasOwnProperty(key))r[key]=opt[key];window[ns]=r;return r;
	}

};
Oxygen.HideAjaxDialog=Oxygen.HideDialog;//BC

function dump(x){console.log(x);}

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
	this.toString = function(){
		return this.value.toString().replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
	};
};
var Js = function(value){
	this.value = value.isJsObject ? value.value : value;
	this.isJsObject = true;
	this.toString = function(){
		if (typeof(this.value) == 'number')
			return this.value.toString();
		else
			return '\'' + this.value.toString().replace(/'/g,'\\\'') + '\'';
	};
};
var Lemma = function(){
	this.data = {};
	for (var i = 1; i < arguments.length; i += 2) {
		this.data[ arguments[i-1] ] = arguments[i];
	}
	this.toString = function(){
		return this.data[Oxygen.lang];
	};
};
var Oxygen = {
	 lang: oxygen_lang
	,Lang: oxygen_lang
	,Base: oxygen_base
	,Encoding: oxygen_encoding

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

		if (Prototype.Browser.IE6){
			jQuery('body').append(''
				+ '<div id="OxygenDialogFrame" class="zdialog overflow" style="position:absolute;top:0;left:0;display:none;">'
				+ '<table id="OxygenDialogFrameX" cellspacing="20" cellpadding="0" border="0" style="width:100%;height:100%;"><tr><td style="vertical-align:middle;">'

					+ '<div id="OxygenDialog" class="ajaxdialog" style="width:'+width+'px;height:'+height+'px;margin:0 auto;">'

					+ '<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td id="OxygenDialogX">'
//						+ '<div id="OxygenDialogX">'
						+ '<div class="ajaxdialog1"><div class="ajaxdialog3"><div class="ajaxdialog2"><h1>'+icon+'&nbsp;'+title+'</h1></div></div></div>'
						+ '<div class="ajaxdialog4"><div class="ajaxdialog6"><div class="ajaxdialog5">'
							+ '<div id="OxygenDialogInner" class="ajaxdialoginner">'
							+	'<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td id="OxygenDialogInnerX"></td></tr></table>'
							+	'</div>'
						+ '</div></div></div>'
						+ '<div class="ajaxdialog7"><div class="ajaxdialog9"><div class="ajaxdialog8"></div><div></div>'
//						+ '</div>'
						+ '</td></tr></table>'

					+ '</div>'


				+ '</td></tr></table>'
				+ '</div>'
				);


		}
		else {
			jQuery('body').append(''
				+ '<div id="OxygenDialogFrame" class="zdialog overflow" style="position:fixed;top:0;left:0;width:100%;height:100%;display:none;">'
				+ '<table id="OxygenDialogFrameX" cellspacing="20" cellpadding="0" border="0" style="width:100%;height:100%;"><tr><td style="vertical-align:middle;">'

					+ '<div id="OxygenDialog" class="ajaxdialog" style="width:'+width+'px;height:'+height+'px;margin:0 auto;">'

						+ '<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td id="OxygenDialogX">'
//						+ '<div id="OxygenDialogX">'
						+ '<div class="ajaxdialog1"><div class="ajaxdialog3"><div class="ajaxdialog2"><h1>'+icon+'&nbsp;'+title+'</h1></div></div></div>'
						+ '<div class="ajaxdialog4"><div class="ajaxdialog6"><div class="ajaxdialog5">'
							+ '<div id="OxygenDialogInner" class="ajaxdialoginner">'
							+	'<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td id="OxygenDialogInnerX"></td></tr></table>'
							+	'</div>'
						+ '</div></div></div>'
						+ '<div class="ajaxdialog7"><div class="ajaxdialog9"><div class="ajaxdialog8"></div><div></div>'
//						+ '</div>'
						+ '</td></tr></table>'

					+ '</div>'

				+ '</td></tr></table>'
				+ '</div>'
				);

		}




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
//			dialog.height( Math.max( this.dialog_min_height , dialogx.outerHeight(true) ) );
//			dialog.width( Math.max( this.dialog_min_width , dialogx.outerWidth(true) ) );

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
		return $('OxygenDialog') != null;
	}
	,Refresh:function(){
		window.location.href=window.location.href;
	}
	,OpenDynamicAction:function(js_command,mapper){
		var map = mapper();
		for (var xxx in map) {
			js_command = js_command.replace(xxx,map[xxx]);
		}
		eval(js_command);
	}
};

// for backwards compatibility:
Oxygen.HideAjaxDialog = Oxygen.HideDialog;
//jQuery(window).resize(function(){ Oxygen.ResizeDialog(); });

function dump2(x,level){
	var s = typeof x;
	switch (typeof x){
		case 'string':
			s += ': "' + x + '"';
			break;
		case 'number':
			s += ': ' + x + '';
			break;
		case 'boolean':
			s += ': ' + (x?'true':'false') + '';
			break;
		case 'object':
			s += ':';
			for (var p in x) {
				s += '\n  ';
				for (var i = 0; i < level; i++) {
					s += '  ';
				}
				s += p + ': ' + dump2(x[p],level+1);
			}
			break;
	}
	return s;
}
function dump(x){
	alert(dump2(x,0));
}
var is_page_loaded = false;
IsPageLoaded = function(){ return is_page_loaded; };
Event.observe(window,'load',function(ev){is_page_loaded=true;});

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

var Oxygen = {
	 Lang: oxygen_lang
	,Encoding: oxygen_encoding

	,current_ajax_dialog_url: null
	,current_ajax_dialog_clock_timer: null
	,current_ajax_dialog_clock_value: 0

	,fog_appearing: false
	,fog_disapearing: false
	,ShowFog: function(){
		if (Prototype.Browser.IE6) return;
		var fog = $('OxygenDialogFog');
		if (fog==null) fog = $( document.body.appendChild(new Element('div',{'id':'OxygenDialogFog','class':'ajaxdialogfog','style':'position:fixed;top:0;left:0;width:100%;height:100%;z-index:90;display:none;'})) );
		if (this.fog_appearing) return;
		if (this.fog_disapearing) setTimeout( function(){Oxygen.ShowFog();} );
		this.fog_appearing = true;
		fog.appear({duration: 0.2, from: 0.0, to: 0.8, afterFinish:function(){ Oxygen.fog_appearing = false; } });
	}
	,HideFog: function(){
		var fog = $('OxygenDialogFog');
		if (fog==null) return;
		if (this.fog_disapearing) return;
		if (this.fog_appearing) setTimeout( function(){Oxygen.HideFog();} );
		this.fog_dappearing = true;
		fog.fade({duration: 0.5, from: 0.8, to: 0.0, afterFinish:function(){ Oxygen.fog_disapearing = false; } });
	}

	,MakeDialog: function(icon,title,width,height){
		var dialog = $('OxygenDialog');
		if (dialog==null) {
			if (Prototype.Browser.IE6){
				dialog = document.body.appendChild(new Element('div',{'id':'OxygenDialog','style':'z-index:100;position:absolute;display:none;overflow:visible;'}));
			}
			else {
				dialog = document.body.appendChild(new Element('div',{'id':'OxygenDialog','style':'z-index:100;position:fixed;width:50%;height:50%;top:25%;left:25%;display:none;'}));
			}
		}
		dialog.style.width = width + 'px';
		dialog.style.height = height + 'px';
		dialog.style.left = ((document.viewport.getWidth() - width) / 2) + 'px';
		dialog.style.top = ((document.viewport.getHeight() - height) / 2) + 'px';
		this.FillDialog(dialog,icon,title);
		return dialog;
	}
	,FillDialog: function(dialog,icon,title){
		dialog.update('<div class="ajaxdialog" id=\"OxygenDialogX\" >'
				+ '<div class="ajaxdialog1"><div class="ajaxdialog3"><div class="ajaxdialog2"><h1>'+icon+'&nbsp;'+title+'</h1></div></div></div>'
				+ '<div class="ajaxdialog4"><div class="ajaxdialog6"><div class="ajaxdialog5"><div id=\"OxygenDialogInner\" class=\"ajaxdialoginner\"></div></div></div></div>'
				+ '<div class="ajaxdialog7"><div class="ajaxdialog9"><div class="ajaxdialog8"></div><div></div>'
				+ '</div>');
	}



	,ShowSimpleDialog: function(icon,title,content,width,height){
		this.ShowFog();
		if (!width) width=500;
		if (!height) height=350;
		var dialog = this.MakeDialog(icon,title,width,height);
		$('OxygenDialogInner').update(content);
		dialog.show();
		this.ResizeDialog();
	}
	,ShowIFrameDialog: function(icon,title,url,width,height){
		this.ShowFog();
		var dialog = this.MakeDialog(icon,title,width,height);
		$('OxygenDialogInner').appendChild(new Element('iframe',{'src':url,'width':width-40,'height':height-80}));
		dialog.show();
		//this.ResizeDialog();
		this.current_ajax_dialog_url = url;
	}
	,ShowAjaxDialog: function(icon,title,url,width,height){
		this.ShowFog();
		var dialog = this.MakeDialog(icon,title,width,height);
		var x = $('OxygenDialogInner');
		x.update('<div style="text-align:center;"><img src=\"oxy/img/ajax.gif\" align="absmiddle" hspace="10" vspace="10" /><br/><span id=\"OxygenDialogClock\">0:00</span></div>');
		x.style.width = '';
		x.style.height = '';
		x.style.overflow = 'auto';
		this.current_ajax_dialog_clock_value = 0;
		this.current_ajax_dialog_clock_timer = setTimeout(function(){Oxygen.UpdateDialogClock();},1000);
		dialog.show();
		this.ResizeDialog();
		if (url != null){
			new Ajax.Request(url,{
				method:'get'
				,encoding:Oxygen.Encoding
				,onSuccess:function(transport){
					if (this.current_ajax_dialog_clock_timer != null) {
						clearTimeout(this.current_ajax_dialog_clock_timer);
						this.current_ajax_dialog_clock_timer = null;
					}
					$('OxygenDialogInner').update(transport.responseText);
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
		this.HideFog();
		var dialog = $('OxygenDialog'); if (dialog != null) dialog.hide();
		this.current_ajax_dialog_url = null;
	}

	,SubmitAjaxDialog: function(form){
		var params = $(form).serialize(true);
		var x = $('OxygenDialogInner');
		x.update('<div style="text-align:center"><img src=\"oxy/img/ajax.gif\" hspace=\"10\" vspace=\"1\" align="absmiddle"/><br/><span id=\"OxygenDialogClock\">0:00</span></div>');
		x.style.width = '';
		x.style.height = '';
		x.style.overflow = 'auto';
		this.current_ajax_dialog_clock_value = 0;
		this.current_ajax_dialog_clock_timer = setTimeout(function(){Oxygen.UpdateDialogClock();},1000);
		new Ajax.Request(this.current_ajax_dialog_url,{
			method:'post'
			,parameters:params
			,encoding:Oxygen.Encoding
			,onSuccess:function(transport){
				if (this.current_ajax_dialog_clock_timer != null) {
					clearTimeout(this.current_ajax_dialog_clock_timer);
					this.current_ajax_dialog_clock_timer = null;
				}
				$('OxygenDialogInner').update(transport.responseText);
				Oxygen.ResizeDialog();
			}
		});
	}
	,FocusDialog: function(){
		var dialog = $('OxygenDialog');
		var a = dialog.descendants();
		for(var i = 0; i<a.length; i++){
			if ( (a[i].tagName==='INPUT' && a[i].type!=='hidden') || a[i].tagName==='SELECT' || a[i].tagName==='TEXTAREA' ) {
				try{
					a[i].focus(); // nasty explorer bug...
				}
				catch(ex){}
				break;
			}
		}
	}
	,ResizeDialog:function(){
		var dialog = $('OxygenDialog');
		var dialogx = $('OxygenDialogX');
		var inner = $('OxygenDialogInner');
		var a = dialog.descendants();
		var w = 0;
		var h = 0;
		for(var i = 0; i<a.length; i++){
			var ww = a[i].getWidth();
			var hh = a[i].getHeight();
			if (ww > w) w = ww;
			if (hh > h) h = hh;
		}
		w = Math.min( w , document.viewport.getWidth() - 80 );
		h = Math.min( h , document.viewport.getHeight() - 80 );
		var x = Math.floor((document.viewport.getWidth() - w - 40) / 2);
		var y = Math.floor((document.viewport.getHeight() - h - 40) / 2);



		dialog.style.width = w + 'px';
		dialog.style.height = h + 'px';
		dialog.style.left = x + 'px';
		dialog.style.top = y + 'px';

		var gap1 = dialog.getHeight() - inner.getHeight();
		var gap2 = dialogx.getHeight() - inner.getHeight();
		if (gap1 < gap2) {
			inner.style.overflow = 'auto';
			inner.style.height = (h-gap2) + 'px';
		}
	}
	,IsDialogOpen:function(){
		var dialog = $('OxygenDialog');
		return dialog != null && dialog.style.display != 'none';
	}
};

// for backwards compatibility:
Oxygen.HideAjaxDialog = Oxygen.HideDialog;

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
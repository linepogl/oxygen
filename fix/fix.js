

// fix for ie <= 7
if(typeof String.prototype.trim !== 'function') {
  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, '');
  }
}

// fix for prototype 1.6
document.viewport.getWidth = function(){
	return window.innerWidth ? window.innerWidth : document.documentElement.clientWidth;
};
document.viewport.getHeight = function(){
	return window.innerHeight ? window.innerHeight: document.documentElement.clientHeight;
};

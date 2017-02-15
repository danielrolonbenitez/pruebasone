if(!jQuery.browser) {
	jQuery.browser = new Object();
	
	jQuery.browser.msie = navigator.userAgent.indexOf("MSIE") != -1;
	jQuery.browser.mozilla = navigator.userAgent.indexOf("Gecko") != -1 && navigator.userAgent.indexOf("like") != -1;
	jQuery.browser.webkit = navigator.userAgent.indexOf("AppleWebKit") != -1;
	jQuery.browser.opera = navigator.userAgent.indexOf("Presto/") != -1;

	if(jQuery.browser.webkit) navigator.userAgent.match(/AppleWebKit\/([0-9a-zA-Z\.]+)/)[1];
	else if(jQuery.browser.mozilla) jQuery.browser.version = navigator.userAgent.match(/rv:([0-9\.a-zA-Z]+)/)[1];
	else if(jQuery.browser.msie) jQuery.browser.version = navigator.userAgent.match(/MSIE ([0-9a-zA-Z\.]+)/)[1];
	else if(jQuery.browser.opera) jQuery.browser.version = navigator.userAgent.match(/Version\/([0-9a-zA-Z\.]+)/)[1];
}
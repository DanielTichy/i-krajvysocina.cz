/*

# ------------------------------------------------------------------------
# JA Raite template for Joomla 1.5
# ------------------------------------------------------------------------
# Copyright (C) 2004-2010 JoomlArt.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2. CSS / JS are Copyrighted Commercial,
# bound by Proprietary License of JoomlArt. For details on licensing, 
# Please Read Terms of Use at http://www.joomlart.com/terms_of_use.html.
# Author: JoomlArt.com
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# Redistribution, Modification or Re-licensing of this file in part of full, 
# is bound by the License applied. 
# ------------------------------------------------------------------------

*/

sfHover = function() {
	var sfEls = document.getElementById("ja-cssmenu").getElementsByTagName("li");
	for (var i=0; i<sfEls.length; ++i) {
		sfEls[i].onmouseover=function() {
			clearTimeout(this.timer);
			if(this.className.indexOf("sfhover") == -1)
				this.className+="sfhover";
			
			var a = this.getElementsByTagName("a")[0];
			if(a.className.indexOf("sfhover") == -1)
				a.className+=" sfhover";
			
		}
		sfEls[i].onmouseout=function() {
			this.timer = setTimeout(sfHoverOut.bind(this), 20);
		}
	}
}

function sfHoverOut() {
	clearTimeout(this.timer);
	this.className=this.className.replace(new RegExp("sfhover\\b"), "");
	var a = this.getElementsByTagName("a")[0];
	a.className=a.className.replace(new RegExp("sfhover\\b"), "");
}

if (window.attachEvent) window.attachEvent("onload", sfHover);

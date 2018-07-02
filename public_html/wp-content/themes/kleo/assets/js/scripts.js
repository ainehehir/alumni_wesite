/*! matchMedia() polyfill - Test a CSS media type/query in JS. Authors & copyright (c) 2012: Scott Jehl, Paul Irish, Nicholas Zakas. Dual MIT/BSD license */
/*! NOTE: If you're already including a window.matchMedia polyfill via Modernizr or otherwise, you don't need this part */
window.matchMedia=window.matchMedia||function(a){"use strict";var c,d=a.documentElement,e=d.firstElementChild||d.firstChild,f=a.createElement("body"),g=a.createElement("div");return g.id="mq-test-1",g.style.cssText="position:absolute;top:-100em",f.style.background="none",f.appendChild(g),function(a){return g.innerHTML='&shy;<style media="'+a+'"> #mq-test-1 { width: 42px; }</style>',d.insertBefore(f,e),c=42===g.offsetWidth,d.removeChild(f),{matches:c,media:a}}}(document);

/*! Respond.js v1.1.0: min/max-width media query polyfill. (c) Scott Jehl. MIT/GPLv2 Lic. j.mp/respondjs  */
(function(a){"use strict";function x(){u(!0)}var b={};if(a.respond=b,b.update=function(){},b.mediaQueriesSupported=a.matchMedia&&a.matchMedia("only all").matches,!b.mediaQueriesSupported){var q,r,t,c=a.document,d=c.documentElement,e=[],f=[],g=[],h={},i=30,j=c.getElementsByTagName("head")[0]||d,k=c.getElementsByTagName("base")[0],l=j.getElementsByTagName("link"),m=[],n=function(){for(var b=0;l.length>b;b++){var c=l[b],d=c.href,e=c.media,f=c.rel&&"stylesheet"===c.rel.toLowerCase();d&&f&&!h[d]&&(c.styleSheet&&c.styleSheet.rawCssText?(p(c.styleSheet.rawCssText,d,e),h[d]=!0):(!/^([a-zA-Z:]*\/\/)/.test(d)&&!k||d.replace(RegExp.$1,"").split("/")[0]===a.location.host)&&m.push({href:d,media:e}))}o()},o=function(){if(m.length){var b=m.shift();v(b.href,function(c){p(c,b.href,b.media),h[b.href]=!0,a.setTimeout(function(){o()},0)})}},p=function(a,b,c){var d=a.match(/@media[^\{]+\{([^\{\}]*\{[^\}\{]*\})+/gi),g=d&&d.length||0;b=b.substring(0,b.lastIndexOf("/"));var h=function(a){return a.replace(/(url\()['"]?([^\/\)'"][^:\)'"]+)['"]?(\))/g,"$1"+b+"$2$3")},i=!g&&c;b.length&&(b+="/"),i&&(g=1);for(var j=0;g>j;j++){var k,l,m,n;i?(k=c,f.push(h(a))):(k=d[j].match(/@media *([^\{]+)\{([\S\s]+?)$/)&&RegExp.$1,f.push(RegExp.$2&&h(RegExp.$2))),m=k.split(","),n=m.length;for(var o=0;n>o;o++)l=m[o],e.push({media:l.split("(")[0].match(/(only\s+)?([a-zA-Z]+)\s?/)&&RegExp.$2||"all",rules:f.length-1,hasquery:l.indexOf("(")>-1,minw:l.match(/\(\s*min\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/)&&parseFloat(RegExp.$1)+(RegExp.$2||""),maxw:l.match(/\(\s*max\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/)&&parseFloat(RegExp.$1)+(RegExp.$2||"")})}u()},s=function(){var a,b=c.createElement("div"),e=c.body,f=!1;return b.style.cssText="position:absolute;font-size:1em;width:1em",e||(e=f=c.createElement("body"),e.style.background="none"),e.appendChild(b),d.insertBefore(e,d.firstChild),a=b.offsetWidth,f?d.removeChild(e):e.removeChild(b),a=t=parseFloat(a)},u=function(b){var h="clientWidth",k=d[h],m="CSS1Compat"===c.compatMode&&k||c.body[h]||k,n={},o=l[l.length-1],p=(new Date).getTime();if(b&&q&&i>p-q)return a.clearTimeout(r),r=a.setTimeout(u,i),void 0;q=p;for(var v in e)if(e.hasOwnProperty(v)){var w=e[v],x=w.minw,y=w.maxw,z=null===x,A=null===y,B="em";x&&(x=parseFloat(x)*(x.indexOf(B)>-1?t||s():1)),y&&(y=parseFloat(y)*(y.indexOf(B)>-1?t||s():1)),w.hasquery&&(z&&A||!(z||m>=x)||!(A||y>=m))||(n[w.media]||(n[w.media]=[]),n[w.media].push(f[w.rules]))}for(var C in g)g.hasOwnProperty(C)&&g[C]&&g[C].parentNode===j&&j.removeChild(g[C]);for(var D in n)if(n.hasOwnProperty(D)){var E=c.createElement("style"),F=n[D].join("\n");E.type="text/css",E.media=D,j.insertBefore(E,o.nextSibling),E.styleSheet?E.styleSheet.cssText=F:E.appendChild(c.createTextNode(F)),g.push(E)}},v=function(a,b){var c=w();c&&(c.open("GET",a,!0),c.onreadystatechange=function(){4!==c.readyState||200!==c.status&&304!==c.status||b(c.responseText)},4!==c.readyState&&c.send(null))},w=function(){var b=!1;try{b=new a.XMLHttpRequest}catch(c){b=new a.ActiveXObject("Microsoft.XMLHTTP")}return function(){return b}}();n(),b.update=n,a.addEventListener?a.addEventListener("resize",x,!1):a.attachEvent&&a.attachEvent("onresize",x)}})(this);



/*
 * Project: Twitter Bootstrap Hover Dropdown
 * Author: Cameron Spear
 * Contributors: Mattia Larentis
 * Dependencies: Twitter Bootstrap's Dropdown plugin
 * A simple plugin to enable twitter bootstrap dropdowns to active on hover and provide a nice user experience.
 * No license, do what you want. I'd love credit or a shoutout, though.
 * http://cameronspear.com/blog/twitter-bootstrap-dropdown-on-hover-plugin/
 */
(function(b,a,c){var d=b();b.fn.dropdownHover=function(e){d=d.add(this.parent());return this.each(function(){var k=b(this),j=k.parent(),i={delay:200,instantlyCloseOthers:true},h={delay:b(this).data("delay"),instantlyCloseOthers:b(this).data("close-others")},f=b.extend(true,{},i,e,h),g;j.hover(function(l){if(!j.hasClass("open")&&!k.is(l.target)){return true}if(f.instantlyCloseOthers===true){d.removeClass("open")}a.clearTimeout(g);j.addClass("open")},function(){g=a.setTimeout(function(){j.removeClass("open")},f.delay)});k.hover(function(){if(f.instantlyCloseOthers===true){d.removeClass("open")}a.clearTimeout(g);j.addClass("open")});j.find(".dropdown-submenu").each(function(){var m=b(this);var l;m.hover(function(){a.clearTimeout(l);m.children(".dropdown-menu").show();m.siblings().children(".dropdown-menu").hide()},function(){var n=m.children(".dropdown-menu");l=a.setTimeout(function(){n.hide()},f.delay)})})})};})(jQuery,this);




/* =========================================================
 * bootstrap-tabdrop.js 
 * http://www.eyecon.ro/bootstrap-tabdrop
 * =========================================================
 * Copyright 2012 Stefan Petre
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */
 
!function(c){var b=(function(){var h=[];var d=false;var g;var e=function(i){clearTimeout(g);g=setTimeout(f,100)};var f=function(){for(var k=0,j=h.length;k<j;k++){h[k].apply()}};return{register:function(i){h.push(i);if(d===false){c(window).bind("resize",e);d=true}},unregister:function(l){for(var k=0,j=h.length;k<j;k++){if(h[k]==l){delete h[k];break}}}}}());var a=function(e,d){this.element=c(e);this.dropdown=c('<li class="dropdown hide pull-right tabdrop"><a class="dropdown-toggle" data-toggle="dropdown" href="#">'+d.text+'</a><ul class="dropdown-menu"></ul></li>').prependTo(this.element);if(this.element.parent().is(".tabs-below")){this.dropdown.addClass("dropup")}b.register(c.proxy(this.layout,this));this.layout()};a.prototype={constructor:a,layout:function(){var d=[];this.dropdown.removeClass("hide");this.element.append(this.dropdown.find("li")).find(">li").not(".tabdrop").each(function(){if(this.offsetTop>0){d.push(this)}});if(d.length>0){d=c(d);this.dropdown.find("ul").empty().append(d);if(this.dropdown.find(".active").length==1){this.dropdown.addClass("active")}else{this.dropdown.removeClass("active")}}else{this.dropdown.addClass("hide")}}};c.fn.tabdrop=function(d){return this.each(function(){var g=c(this),f=g.data("tabdrop"),e=typeof d==="object"&&d;if(!f){g.data("tabdrop",(f=new a(this,c.extend({},c.fn.tabdrop.defaults,e))))}if(typeof d=="string"){f[d]()}})};c.fn.tabdrop.defaults={text:"&nbsp;"};c.fn.tabdrop.Constructor=a}(window.jQuery);


// // // Sticky Plugin v1.0.0 for jQuery
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 2/14/2011
// Date: 2/12/2012
// Website: http://labs.anthonygarand.com/sticky
// Description: Makes an element on the page stick on the screen as you scroll
//       It will only set the 'top' and 'position' of your element, you
//       might need to adjust the width in some cases.
(function(f){var e={topSpacing:0,bottomSpacing:0,className:"is-sticky",wrapperClassName:"sticky-wrapper",center:false,getWidthFrom:""},b=f(window),d=f(document),i=[],a=b.height(),g=function(){var j=b.scrollTop(),q=d.height(),p=q-a,l=(j>p)?p-j:0;for(var m=0;m<i.length;m++){var r=i[m],k=r.stickyWrapper.offset().top,n=k-r.topSpacing-l;if(j<=n){if(r.currentTop!==null){r.stickyElement.css("position","").css("top","");r.stickyElement.parent().removeClass(r.className);r.currentTop=null}}else{var o=q-r.stickyElement.outerHeight()-r.topSpacing-r.bottomSpacing-j-l;if(o<0){o=o+r.topSpacing}else{o=r.topSpacing}if(r.currentTop!=o){r.stickyElement.css("position","fixed").css("top",o);if(typeof r.getWidthFrom!=="undefined"){r.stickyElement.css("width",f(r.getWidthFrom).width())}r.stickyElement.parent().addClass(r.className);r.currentTop=o}}}},h=function(){a=b.height()},c={init:function(j){var k=f.extend(e,j);return this.each(function(){var l=f(this);var m=l.attr("id");var o=f("<div></div>").attr("id",m+"-sticky-wrapper").addClass(k.wrapperClassName);l.wrapAll(o);if(k.center){l.parent().css({width:l.outerWidth(),marginLeft:"auto",marginRight:"auto"})}if(l.css("float")=="right"){l.css({"float":"none"}).parent().css({"float":"right"})}var n=l.parent();n.css("height",l.outerHeight());i.push({topSpacing:k.topSpacing,bottomSpacing:k.bottomSpacing,stickyElement:l,currentTop:null,stickyWrapper:n,className:k.className,getWidthFrom:k.getWidthFrom})})},update:g};if(window.addEventListener){window.addEventListener("scroll",g,false);window.addEventListener("resize",h,false)}else{if(window.attachEvent){window.attachEvent("onscroll",g);window.attachEvent("onresize",h)}}f.fn.sticky=function(j){if(c[j]){return c[j].apply(this,Array.prototype.slice.call(arguments,1))}else{if(typeof j==="object"||!j){return c.init.apply(this,arguments)}else{f.error("Method "+j+" does not exist on jQuery.sticky")}}};f(function(){setTimeout(g,0)})})(jQuery);



/*global jQuery */
/*jshint multistr:true browser:true */
/*!
* FitVids 1.0.3
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/
(function(a){a.fn.fitVids=function(b){var c={customSelector:null};if(!document.getElementById("fit-vids-style")){var f=document.createElement("div"),d=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0],e="&shy;<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>";f.className="fit-vids-style";f.id="fit-vids-style";f.style.display="none";f.innerHTML=e;d.parentNode.insertBefore(f,d)}if(b){a.extend(c,b)}return this.each(function(){var g=["iframe[src*='player.vimeo.com']","iframe[src*='youtube.com']","iframe[src*='youtube-nocookie.com']","iframe[src*='kickstarter.com'][src*='video.html']","iframe[src*='embed.spotify.com']","object","embed"];if(c.customSelector){g.push(c.customSelector)}var h=a(this).find(g.join(","));h=h.not("object object");h.each(function(){var m=a(this);if(this.tagName.toLowerCase()==="embed"&&m.parent("object").length||m.parent(".fluid-width-video-wrapper").length){return}var i=(this.tagName.toLowerCase()==="object"||(m.attr("height")&&!isNaN(parseInt(m.attr("height"),10))))?parseInt(m.attr("height"),10):m.height(),j=!isNaN(parseInt(m.attr("width"),10))?parseInt(m.attr("width"),10):m.width(),k=i/j;if(!m.attr("id")){var l="fitvid"+Math.floor(Math.random()*999999);m.attr("id",l)}m.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",(k*100)+"%");m.removeAttr("height").removeAttr("width")})})}})(window.jQuery);


/*
* debouncedresize: special jQuery event that happens once after a window resize
*
* latest version and complete README available on Github:
* https://github.com/louisremi/jquery-smartresize/blob/master/jquery.debouncedresize.js
*
* Copyright 2011 @louis_remi
* Licensed under the MIT license.
*/
(function(d){var b=d.event,a,c;a=b.special.debouncedresize={setup:function(){d(this).on("resize",a.handler)},teardown:function(){d(this).off("resize",a.handler)},handler:function(i,e){var h=this,g=arguments,f=function(){i.type="debouncedresize";b.dispatch.apply(h,g)};if(c){clearTimeout(c)}e?f():c=setTimeout(f,a.threshold)},threshold:150}})(jQuery);

// ======================= imagesLoaded Plugin ===============================
// https://github.com/desandro/imagesloaded

// $('#my-container').imagesLoaded(myFunction)
// execute a callback when all images have loaded.
// needed because .load() doesn't work on cached images

// callback function gets image collection as argument
//  this is the container

// original: MIT license. Paul Irish. 2010.
// contributors: Oren Solomianik, David DeSandro, Yiannis Chatzikonstantinou

(function(a){var b="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";a.fn.imagesLoaded=function(j){var g=this,l=a.isFunction(a.Deferred)?a.Deferred():0,k=a.isFunction(l.notify),d=g.find("img").add(g.filter("img")),e=[],i=[],f=[];if(a.isPlainObject(j)){a.each(j,function(m,n){if(m==="callback"){j=n}else{if(l){l[m](n)}}})}function h(){var m=a(i),n=a(f);if(l){if(f.length){l.reject(d,m,n)}else{l.resolve(d)}}if(a.isFunction(j)){j.call(g,d,m,n)}}function c(m,n){if(m.src===b||a.inArray(m,e)!==-1){return}e.push(m);if(n){f.push(m)}else{i.push(m)}a.data(m,"imagesLoaded",{isBroken:n,src:m.src});if(k){l.notifyWith(a(m),[n,d,a(i),a(f)])}if(d.length===e.length){setTimeout(h);d.unbind(".imagesLoaded")}}if(!d.length){h()}else{d.bind("load.imagesLoaded error.imagesLoaded",function(m){c(m.target,m.type==="error")}).each(function(m,o){var p=o.src;var n=a.data(o,"imagesLoaded");if(n&&n.src===p){c(o,n.isBroken);return}if(o.complete&&o.naturalWidth!==undefined){c(o,o.naturalWidth===0||o.naturalHeight===0);return}if(o.readyState||o.complete){o.src=b;o.src=p}})}return l?l.promise(g):g}})(jQuery);



/* v1.5 */
/*

Copyright (c) 2009 Dimas Begunoff, http://www.farinspace.com

https://github.com/farinspace/jquery.imgpreload

Licensed under the MIT license
http://en.wikipedia.org/wiki/MIT_License
*/
if ('undefined' != typeof jQuery)
{
(function($){

// extend jquery (because i love jQuery)
$.imgpreload = function (imgs,settings)
{
settings = $.extend({},$.fn.imgpreload.defaults,(settings instanceof Function)?{all:settings}:settings);

// use of typeof required
// https://developer.mozilla.org/En/Core_JavaScript_1.5_Reference/Operators/Special_Operators/Instanceof_Operator#Description
if ('string' == typeof imgs) { imgs = new Array(imgs); }

var loaded = new Array();

$.each(imgs,function(i,elem)
{
var img = new Image();

var url = elem;

var img_obj = img;

if ('string' != typeof elem)
{
url = $(elem).attr('src') || $(elem).css('background-image').replace(/^url\((?:"|')?(.*)(?:'|")?\)$/mg, "$1");

img_obj = elem;
}

$(img).bind('load error', function(e)
{
loaded.push(img_obj);

$.data(img_obj, 'loaded', ('error'==e.type)?false:true);

if (settings.each instanceof Function) { settings.each.call(img_obj); }

// http://jsperf.com/length-in-a-variable
if (loaded.length>=imgs.length && settings.all instanceof Function) { settings.all.call(loaded); }

$(this).unbind('load error');
});

img.src = url;
});
};

$.fn.imgpreload = function(settings)
{
$.imgpreload(this,settings);

return this;
};

$.fn.imgpreload.defaults =
{
each: null // callback invoked when each image in a group loads
, all: null // callback invoked when when the entire group of images has loaded
};

})(jQuery);
}
/*
0. [NULL]
1. [NULL]
2. Mobile menu
3. Accordion
4. Flickr
5. Instagram
6. fitVids
7. PlaceHolder
8. Tipsy
9. Scroll to top
*/

/** 2. Mobile Menu
================================================== **/
;(function($) {
	"use strict";

	$.fn.jMMenu = function() {
	 	var $this = $(this);
		$this.find('li').has('ul').prepend('<span class="nav-click"></span>');
		$this.find('ul').on('click', '.nav-click', function(){
			$(this).siblings('ul').slideToggle();
			$(this).toggleClass('nav-click-up');
			return false;
		});
	};
})(jQuery); 

/** 3. Accordion
================================================== **/
;(function($) {
	"use strict";

	$.fn.jAccordion = function() {
	 var $this = $(this);
	 
		$this.find("section").each(function(idx) {
			var section = $(this);
			if(idx === 0) section.addClass('active').find('div.acc-content').slideDown();
			section.find('a.head').on("click", function(){
				var handle = $(this);
					handle.parent().toggleClass('active');
					
					if(handle.parent().hasClass('active')){
						handle.next('div.acc-content').slideDown();
					}else{
						handle.next('div.acc-content').slideUp();	
					}
				
				return false;
			});
				
		});
	};
})(jQuery);

 
/** 4. jFlickrfeed
================================================== **/
(function($){$.fn.jflickrfeed=function(settings,callback){settings=$.extend(true,{flickrbase:'http://api.flickr.com/services/feeds/',feedapi:'photos_public.gne',limit:20,qstrings:{lang:'en-us',format:'json',jsoncallback:'?'},cleanDescription:true,useTemplate:true,itemTemplate:'',itemCallback:function(){}},settings);var url=settings.flickrbase+settings.feedapi+'?';var first=true;for(var key in settings.qstrings){if(!first)
url+='&';url+=key+'='+settings.qstrings[key];first=false;}
return $(this).each(function(){var $container=$(this);var container=this;$.getJSON(url,function(data){$.each(data.items,function(i,item){if(i<settings.limit){if(settings.cleanDescription){var regex=/<p>(.*?)<\/p>/g;var input=item.description;if(regex.test(input)){item.description=input.match(regex)[2]
if(item.description!=undefined)
item.description=item.description.replace('<p>','').replace('</p>','');}}
item['image_s']=item.media.m.replace('_m','_s');item['image_t']=item.media.m.replace('_m','_t');item['image_m']=item.media.m.replace('_m','_m');item['image']=item.media.m.replace('_m','');item['image_b']=item.media.m.replace('_m','_b');delete item.media;if(settings.useTemplate){var template=settings.itemTemplate;for(var key in item){var rgx=new RegExp('{{'+key+'}}','g');template=template.replace(rgx,item[key]);}
$container.append(template)}
settings.itemCallback.call(container,item);}});if($.isFunction(callback)){callback.call(container,data);}});});}})(jQuery);


/** 5. jQInstaPics
================================================== **/
;(function(a){a.fn.jqinstapics=function(b){var c={user_id:null,access_token:null,count:10};var d=a.extend(c,b);return this.each(function(){var b=a(this),c="https://api.instagram.com/v1/users/"+d.user_id+"/media/recent?access_token="+d.access_token+"&count="+d.count+"&callback=?";a.getJSON(c,function(c){a.each(c.data,function(c,d){var e=a("<a/>",{href:d.link,target:"_blank"}).appendTo(b),f=a("<img/>",{src:d.images.thumbnail.url}).appendTo(e);if(d.caption){f.attr("title",d.caption.text)}})});if(d.user_id==null||d.access_token==null){b.append("<li>Please specify a User ID and Access Token, as outlined in the docs.</li>")}})}})(jQuery);


/** 6. FitVids
================================================== **/
;(function(a){a.fn.fitVids=function(f){var b={customSelector:null};if(!document.getElementById("fit-vids-style")){var c=document.createElement("div"),e=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0],d="­<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>";c.className="fit-vids-style";c.id="fit-vids-style";c.style.display="none";c.innerHTML=d;e.parentNode.insertBefore(c,e)}if(f){a.extend(b,f)}return this.each(function(){var h=["iframe[src*='player.vimeo.com']","iframe[src*='youtube.com']","iframe[src*='youtube-nocookie.com']","iframe[src*='kickstarter.com'][src*='video.html']","object","embed"];if(b.customSelector){h.push(b.customSelector)}var g=a(this).find(h.join(","));g=g.not("object object");g.each(function(){var i=a(this);if(this.tagName.toLowerCase()==="embed"&&i.parent("object").length||i.parent(".fluid-width-video-wrapper").length){return}var l=(this.tagName.toLowerCase()==="object"||(i.attr("height")&&!isNaN(parseInt(i.attr("height"),10))))?parseInt(i.attr("height"),10):i.height(),k=!isNaN(parseInt(i.attr("width"),10))?parseInt(i.attr("width"),10):i.width(),j=l/k;if(!i.attr("id")){var m="fitvid"+Math.floor(Math.random()*999999);i.attr("id",m)}i.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",(j*100)+"%");i.removeAttr("height").removeAttr("width")})})}})(window.jQuery||window.Zepto);


/** 7. Placeholder
================================================== **/
;(function(d,i,l){var g="placeholder" in i.createElement("input");var a="placeholder" in i.createElement("textarea");var h=l.fn;var j=l.valHooks;var m=l.propHooks;var e;var n;if(g&&a){n=h.placeholder=function(){return this};n.input=n.textarea=true}else{n=h.placeholder=function(){var o=this;o.filter((g?"textarea":":input")+"[placeholder]").not(".placeholder").bind({"focus.placeholder":b,"blur.placeholder":k}).data("placeholder-enabled",true).trigger("blur.placeholder");return o};n.input=g;n.textarea=a;e={get:function(o){var p=l(o);var q=p.data("placeholder-password");if(q){return q[0].value}return p.data("placeholder-enabled")&&p.hasClass("placeholder")?"":o.value},set:function(o,r){var p=l(o);var q=p.data("placeholder-password");if(q){return q[0].value=r}if(!p.data("placeholder-enabled")){return o.value=r}if(r==""){o.value=r;if(o!=c()){k.call(o)}}else{if(p.hasClass("placeholder")){b.call(o,true,r)||(o.value=r)}else{o.value=r}}return p}};if(!g){j.input=e;m.value=e}if(!a){j.textarea=e;m.value=e}l(function(){l(i).delegate("form","submit.placeholder",function(){var o=l(".placeholder",this).each(b);setTimeout(function(){o.each(k)},10)})});l(d).bind("beforeunload.placeholder",function(){l(".placeholder").each(function(){this.value=""})})}function f(p){var o={};var q=/^jQuery\d+$/;l.each(p.attributes,function(r,s){if(s.specified&&!q.test(s.name)){o[s.name]=s.value}});return o}function b(p,r){var q=this;var o=l(q);if(q.value==o.attr("placeholder")&&o.hasClass("placeholder")){if(o.data("placeholder-password")){o=o.hide().next().show().attr("id",o.removeAttr("id").data("placeholder-id"));if(p===true){return o[0].value=r}o.focus()}else{q.value="";o.removeClass("placeholder");q==c()&&q.select()}}}function k(){var q;var s=this;var o=l(s);var r=this.id;if(s.value==""){if(s.type=="password"){if(!o.data("placeholder-textinput")){try{q=o.clone().attr({type:"text"})}catch(p){q=l("<input>").attr(l.extend(f(this),{type:"text"}))}q.removeAttr("name").data({"placeholder-password":o,"placeholder-id":r}).bind("focus.placeholder",b);o.data({"placeholder-textinput":q,"placeholder-id":r}).before(q)}o=o.removeAttr("id").hide().prev().attr("id",r).show()}o.addClass("placeholder");o[0].value=o.attr("placeholder")}else{o.removeClass("placeholder")}}function c(){try{return i.activeElement}catch(o){}}}(this,document,jQuery));


/** 8. Tooltip - tipsy 
================================================== **/
;(function(b){function d(e,f){return(typeof e=="function")?(e.call(f)):e}function c(e){while(e=e.parentNode){if(e==document){return true}}return false}function a(f,e){this.$element=b(f);this.options=e;this.enabled=true;this.fixTitle()}a.prototype={show:function(){var h=this.getTitle();if(h&&this.enabled){var i=this.tip();i.find(".tipsy-inner")[this.options.html?"html":"text"](h);i[0].className="tipsy";i.remove().css({top:0,left:0,visibility:"hidden",display:"block"}).prependTo(document.body);var k=b.extend({},this.$element.offset(),{width:this.$element[0].offsetWidth,height:this.$element[0].offsetHeight});var f=i[0].offsetWidth,g=i[0].offsetHeight,e=d(this.options.gravity,this.$element[0]);var j;switch(e.charAt(0)){case"n":j={top:k.top+k.height+this.options.offset,left:k.left+k.width/2-f/2};break;case"s":j={top:k.top-g-this.options.offset,left:k.left+k.width/2-f/2};break;case"e":j={top:k.top+k.height/2-g/2,left:k.left-f-this.options.offset};break;case"w":j={top:k.top+k.height/2-g/2,left:k.left+k.width+this.options.offset};break}if(e.length==2){if(e.charAt(1)=="w"){j.left=k.left+k.width/2-15}else{j.left=k.left+k.width/2-f+15}}i.css(j).addClass("tipsy-"+e);i.find(".tipsy-arrow")[0].className="tipsy-arrow tipsy-arrow-"+e.charAt(0);if(this.options.className){i.addClass(d(this.options.className,this.$element[0]))}if(this.options.fade){i.stop().css({opacity:0,display:"block",visibility:"visible"}).animate({opacity:this.options.opacity})}else{i.css({visibility:"visible",opacity:this.options.opacity})}}},hide:function(){if(this.options.fade){this.tip().stop().fadeOut(function(){b(this).remove()})}else{this.tip().remove()}},fixTitle:function(){var e=this.$element;if(e.attr("title")||typeof(e.attr("original-title"))!="string"){e.attr("original-title",e.attr("title")||"").removeAttr("title")}},getTitle:function(){var e,f=this.$element,g=this.options;this.fixTitle();var e,g=this.options;if(typeof g.title=="string"){e=f.attr(g.title=="title"?"original-title":g.title)}else{if(typeof g.title=="function"){e=g.title.call(f[0])}}e=(""+e).replace(/(^\s*|\s*$)/,"");return e||g.fallback},tip:function(){if(!this.$tip){this.$tip=b('<div class="tipsy"></div>').html('<div class="tipsy-arrow"></div><div class="tipsy-inner"></div>');this.$tip.data("tipsy-pointee",this.$element[0])}return this.$tip},validate:function(){if(!this.$element[0].parentNode){this.hide();this.$element=null;this.options=null}},enable:function(){this.enabled=true},disable:function(){this.enabled=false},toggleEnabled:function(){this.enabled=!this.enabled}};b.fn.tipsy=function(i){if(i===true){return this.data("tipsy")}else{if(typeof i=="string"){var j=this.data("tipsy");if(j){j[i]()}return this}}i=b.extend({},b.fn.tipsy.defaults,i);function h(n){var m=b.data(n,"tipsy");if(!m){m=new a(n,b.fn.tipsy.elementOptions(n,i));b.data(n,"tipsy",m)}return m}function g(){var m=h(this);m.hoverState="in";if(i.delayIn==0){m.show()}else{m.fixTitle();setTimeout(function(){if(m.hoverState=="in"){m.show()}},i.delayIn)}}function f(){var m=h(this);m.hoverState="out";if(i.delayOut==0){m.hide()}else{setTimeout(function(){if(m.hoverState=="out"){m.hide()}},i.delayOut)}}if(!i.live){this.each(function(){h(this)})}if(i.trigger!="manual"){var k=i.live?"live":"bind",l=i.trigger=="hover"?"mouseenter":"focus",e=i.trigger=="hover"?"mouseleave":"blur";this[k](l,g)[k](e,f)}return this};b.fn.tipsy.defaults={className:null,delayIn:0,delayOut:0,fade:false,fallback:"",gravity:"n",html:false,live:false,offset:0,opacity:0.8,title:"title",trigger:"hover"};b.fn.tipsy.revalidate=function(){b(".tipsy").each(function(){var e=b.data(this,"tipsy-pointee");if(!e||!c(e)){b(this).remove()}})};b.fn.tipsy.elementOptions=function(f,e){return b.metadata?b.extend({},e,b(f).metadata()):e};b.fn.tipsy.autoNS=function(){return b(this).offset().top>(b(document).scrollTop()+b(window).height()/2)?"s":"n"};b.fn.tipsy.autoWE=function(){return b(this).offset().left>(b(document).scrollLeft()+b(window).width()/2)?"e":"w"};b.fn.tipsy.autoBounds=function(e,f){return function(){var h={ns:f[0],ew:(f.length>1?f[1]:false)},j=b(document).scrollTop()+e,i=b(document).scrollLeft()+e,g=b(this);if(g.offset().top<j){h.ns="n"}if(g.offset().left<i){h.ew="w"}if(b(window).width()+b(document).scrollLeft()-g.offset().left<e){h.ew="e"}if(b(window).height()+b(document).scrollTop()-g.offset().top<e){h.ns="s"}return h.ns+(h.ew?h.ew:"")}}})(jQuery);

/** 9. Scroll to top
================================================== **/
;(function($) {
	"use strict";
	
	$.fn.jTotop = function() {
	 	
		var $this = $(this),
			scrolled = false,
			scrHeight = 300;
		$(window).scroll(function () {
			if (scrHeight < $(window).scrollTop() && !scrolled) {
				$this.fadeIn();
				scrolled = true;
			} else if (scrHeight > $(window).scrollTop() && scrolled) {
				$this.fadeOut();
				scrolled = false;    
			}
		});
		$this.click(function () {
			$('body,html').animate({scrollTop: 0}, 800);
			return false;
		});
	};
})(jQuery); 

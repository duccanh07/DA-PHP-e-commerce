!function(){"function"!=typeof Array.prototype.indexOf&&(Array.prototype.indexOf=function(t,e){for(var s=e||0,i=this.length;i>s;s+=1)if(void 0===t||null===t){if(this[s]===t)return s}else if(this[s]===t)return s;return-1})}(),function(t){var e={gettoaster:function(){var e=t("#"+i.toaster.id);return e.length<1&&(e=t(i.toaster.template).attr("id",i.toaster.id).css(i.toaster.css).addClass(i.toaster["class"]),i.stylesheet&&!t("link[href="+i.stylesheet+"]").length&&t("head").appendTo('<link rel="stylesheet" href="'+i.stylesheet+'">'),t(i.toaster.container).append(e)),e},notify:function(e,s,o){var a=this.gettoaster(),n=t(i.toast.template.replace("%priority%",o)).hide().css(i.toast.css).addClass(i.toast["class"]);if(t(".title",n).css(i.toast.csst).html(e),t(".message",n).css(i.toast.cssm).html(s),i.debug&&window.console&&console.log(toast),a.append(i.toast.display(n)),-1===i.donotdismiss.indexOf(o)){var r="number"==typeof i.timeout?i.timeout:"object"==typeof i.timeout&&o in i.timeout?i.timeout[o]:1500;setTimeout(function(){i.toast.remove(n,function(){n.remove()})},r)}}},s={toaster:{id:"toaster",container:"body",template:"<div></div>","class":"toaster",css:{position:"fixed",top:"10px",right:"10px",width:"300px",zIndex:5e4}},toast:{template:'<div class="alert alert-%priority% alert-dismissible alert-notification-cart" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><span class="message"></span></div>',defaults:{title:"Notice",priority:"success"},css:{},cssm:{},csst:{fontWeight:"bold"},fade:"slow",display:function(t){return t.fadeIn(i.toast.fade)},remove:function(t,e){return t.animate({opacity:"0",padding:"0px",margin:"0px",height:"0px"},{duration:i.toast.fade,complete:e})}},debug:!1,timeout:3e3,stylesheet:null,donotdismiss:[]},i={};t.extend(i,s),t.toaster=function(s){if("object"==typeof s)"settings"in s&&(i=t.extend(!0,i,s.settings));else{var o=Array.prototype.slice.call(arguments,0),a=["message","title","priority"];s={};for(var n=0,r=o.length;r>n;n+=1)s[a[n]]=o[n]}var l="title"in s&&"string"==typeof s.title?s.title:i.toast.defaults.title,d="message"in s?s.message:null,p="priority"in s&&"string"==typeof s.priority?s.priority:i.toast.defaults.priority;null!==d&&e.notify(l,d,p)},t.toaster.reset=function(){i={},t.extend(i,s)}}(jQuery);
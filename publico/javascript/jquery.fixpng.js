;(function($){$.ifixpng=function(customPixel){$.ifixpng.pixel=customPixel;};$.ifixpng.regexp={bg:/^url\(["']?(.*\.png([?].*)?)["']?\)$/i,img:/.*\.png([?].*)?$/i},$.ifixpng.getPixel=function(){return $.ifixpng.pixel||'images/pixel.gif';};var hack={base:$('base').attr('href'),ltie7:$.browser.msie&&$.browser.version<7,filter:function(src){return"progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,sizingMethod=crop,src='"+src+"')";}};$.fn.ifixpng=hack.ltie7?function(){function fixImage(image,source,width,height,hidden){image.css({filter:hack.filter(source),width:width,height:height}).attr({src:$.ifixpng.getPixel()}).positionFix();}
return this.each(function(){var $$=$(this);if($$.is('img')||$$.is('input')){var source,img;if(this.src&&this.src.match($.ifixpng.regexp.img)){source=(hack.base&&this.src.substring(0,1)!='/'&&this.src.indexOf(hack.base)===-1)?hack.base+this.src:this.src;if(!this.width||!this.height){$(new Image()).one('load',function(){fixImage($$,source,this.width,this.height);$(this).remove();}).attr('src',source);}else fixImage($$,source,this.width,this.height);}}else if(this.style){var imageSrc=$$.css('backgroundImage');if(imageSrc&&imageSrc.match($.ifixpng.regexp.bg)&&this.currentStyle.backgroundRepeat=='no-repeat'){imageSrc=RegExp.$1;var x=this.currentStyle.backgroundPositionX||0,y=this.currentStyle.backgroundPositionY||0;if(x||y){var css={},img;if(x=='left')css.left=0;else if(x=='right')css.right=$$.outerWidth()%2===1?-1:0;else if(x.indexOf('%')==-1||parseInt(x)<50)css.left=x;else css.right=(100-parseInt(x))+'%';if(y=='bottom')css.bottom=$$.outerHeight()%2===1?-1:0;else if(y=='top')css.top=0;else if(y.indexOf('%')==-1||parseInt(y)<50)css.top=y;else css.bottom=(100-parseInt(y))+'%';img=new Image();$(img).one('load',function(){if(css.top=='center')css.top=($$.outerHeight()-this.height)/2;if(css.left=='center')css.left=($$.outerWidth()-this.width)/2;$$.positionFix().css({backgroundImage:'none'}).prepend($('<div></div>').css(css).css({width:this.width,height:this.height,position:'absolute',filter:hack.filter(imageSrc)}));$(this).remove();});img.src=imageSrc;}else{$$.css({backgroundImage:'none',filter:hack.filter(imageSrc)});}}}});}:function(){return this;};$.fn.positionFix=function(){return this.each(function(){var $$=$(this);if($$.css('position')!='absolute')$$.css({position:'relative'});});};})(jQuery);
//jquery 延迟加载flash的效果
var threshold = 0;
$.belowthefold = function(element) {
	var fold = $(window).height() + $(window).scrollTop();
	return fold <= $(element).offset().top - threshold;
};

$.rightoffold = function(element) {
	var fold = $(window).width() + $(window).scrollLeft();
	return fold <= $(element).offset().left - threshold;
};

$.abovethetop = function(element) {
	var fold = $(window).scrollTop();
	return fold >= $(element).offset().top + threshold  + $(element).height();
};

$.leftofbegin = function(element) {
	var fold = $(window).scrollLeft();
	return fold >= $(element).offset().left + threshold + $(element).width();
};
$.appear = function(element) {
	basepath=$(element).attr('basepath');
	$(element).html("<img src='"+basepath+"images/load.gif' />");
	if($(element).attr('class')=='lazyload' && $(element).html().indexOf('object',0)==-1)
	{
		xml_source=$(element).attr('xml_source');
		chart_name=$(element).attr('chart_name');
		width=$(element).attr('w');
		height=$(element).attr('h');
		var outhtml = '<OBJECT classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,2,0" WIDTH="0" HEIGHT="0" id="'+chart_name+'" align="middle" />';
		outhtml+='<PARAM NAME="movie" VALUE="'+basepath+'library/charts/charts.swf" />';
		outhtml+='<PARAM NAME="quality" VALUE="high" />';
		outhtml+='<PARAM NAME="bgcolor" VALUE="#777788" />';
		outhtml+='<param name="allowScriptAccess" value="sameDomain" />';
		outhtml+='<param name="loop" value="false" />';
		outhtml+='<param name="scale" value="noscale" />';
		outhtml+='<param name="salign" value="TL" />';
		outhtml+='<param name="wmode" value="opaque" />';
		outhtml+='<param name="FlashVars" value="library_path='+basepath+'library/charts/charts_library&xml_source='+xml_source+'" />';
		outhtml+='<EMBED src="'+basepath+'library/charts/charts.swf" FlashVars="library_path='+basepath+'library/charts/charts_library&xml_source='+xml_source+'" quality="high" bgcolor="#777788" WIDTH="'+width+'" HEIGHT="'+height+'" NAME="'+chart_name+'" allowScriptAccess="sameDomain" swLiveConnect="true" loop="false" scale="noscale" salign="TL" align="middle" wmode="opaque" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">';
		outhtml+='</EMBED>';
		outhtml+='</OBJECT>';
		$(element).html(outhtml);
	}
};
jQuery(document).ready( function($){
	elements = $("span");
	$(window).scroll( function(){
		elements.each(function () {
			if ($.abovethetop(this) || $.leftofbegin(this)) 
			{
				/* Nothing. ie6下$.leftofbegin(this)始终为真 */
				var isIE=!!window.ActiveXObject;    
				var isIE6=isIE&&!window.XMLHttpRequest;    
				var isIE8=isIE&&!!document.documentMode;    
				var isIE7=isIE&&!isIE6&&!isIE8;    
				if (isIE)
				{    
					if (isIE6)
					{    
   						$.appear(this);
						this.loaded = true;
						var temp = $.grep(elements, function(element) {
							return !element.loaded;
						});
						elements = $(temp);
					}
					else if (isIE8)
					{    
   
					}
					else if (isIE7)
					{    
   
					}    
				}
			}
			else if (!$.belowthefold(this) && !$.rightoffold(this))
			{
				$.appear(this);
				this.loaded = true;
				var temp = $.grep(elements, function(element) {
					return !element.loaded;
				});
				elements = $(temp);
			}
			else
			{
				
			}
		});
	});
	$(window).trigger('scroll');
});
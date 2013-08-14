/** jquery  dialog插件  

*/

(function($){
$.dialog = function(width,height,content,hidden_div_id,title){
    //插入弹出层相关元素
    $("body",document).append("<div id=\"dialog_mask_bg\"></div><div id=\"dialog_box\"></div>");
    $("#dialog_box").append("<div id=\"dialog_box_title\"></div><div id=\"dialog_box_html\"></div><div id=\"dialog_box_bom\"></div>");

    var dialogWidth = (typeof(width)!= undefined && typeof(width)=="number" && width!="") ? width : 500 ;
    var dialogHeight = (typeof(height)!= undefined && typeof(height)=="number" && height!="") ? height : 400 ;
    var dialogContent = (typeof(content)!= undefined && $.trim(content)!="") ? content : "" ; 
	if(title===undefined)
	{
		title="";
	}
    $("#dialog_box_title").append("<span class=\"dialog_close\">×</span>"+title+"<span id=\"dialog_close\">×</span>");
    $(".dialog_close").click(dialogRemove);
	$("#dialog_close").click(dialogRemove);
    $("#dialog_box_html").append(dialogContent);
	
//    newBtn("btnOK"," 确定 ");
    newBtn("dialogRemove"," 关闭对话框 ");
    //取页面宽高度（兼容多浏览器及各种CSS渲染模式）
    var getSize = (function(){
        var check,obj,bodySize = [];
        var check = document.compatMode == "BackCompat" ?  false : true;
        var obj = check ? document.documentElement : document.body;
        with(obj){
            bodySize[0] = scrollWidth>clientWidth ? scrollWidth : clientWidth;
            bodySize[1] = scrollHeight>clientHeight ? scrollHeight : clientHeight;
            bodySize[2] = clientWidth;
            //bodySize[3] = clientHeight;
            bodySize[3] = scrollTop+80;
        }
        return bodySize;
    })();

    var bodyWidth = getSize[0];
    var bodyHeight = getSize[1];
    var dialogX = (getSize[2]-dialogWidth)/2 > 0 ? (getSize[2]-dialogWidth)/2 : 0;
    //alert('1'+getSize[3]+'|'+dialogHeight);
    //var dialogY = (getSize[3]-dialogHeight)/2 > 0 ? (getSize[3]-dialogHeight)/2 : 0;
    var dialogY = getSize[3];
    //alert('2'+getSize[3]+'|'+dialogHeight);
    //边框尺寸
    var dialogBorder = 1;

    //弹出层盒子显示
    $("#dialog_box").css({"background":"#A0B4DC","position":"absolute","border":dialogBorder+"px solid #A0B4DC","z-index":"102"})
    .css({"left":dialogX+"px","top":dialogY+"px","width":dialogWidth+"px","height":dialogHeight+"px"});
    //弹出层标题栏
    $("#dialog_box_title").css({"height":"24px","line-height":"24px","vertical-align":"middle","font-weight":"bold","width":dialogWidth+"px","height":"25px","color":"#000","cursor":"move","z-index":"104"})
  	.mousedown(function(e){ dialogDrag($(this).parent(),e); });

    $("#dialog_close").css({"float":"right","padding":"2px","cursor":"hand","cursor":"pointer"});
    

    //弹出层详细内容区
    $("#dialog_box_html").css({"font-weight":"normal","background":"#FFF","width":dialogWidth+"px","height":dialogHeight-50+"px","z-index":"106"});    

    //弹出层底部
    $("#dialog_box_bom").css({"background":"#EEE","width":dialogWidth+"px","height":"25px","z-index":"108"});


    //遮罩层背景显示
    $("#dialog_mask_bg").css({"background":"#000","position":"absolute","opacity":"0","z-index":"100"})
    .css({"top":"0px","left":"0px","width":bodyWidth+"px","height":bodyHeight+"px"})
    .animate({"opacity":"0.6"},"normal");
    bgiframe($("#dialog_mask_bg"));

    

    //遮罩层缩放自适应
    //$(window).resize(function(){
    //    $("#dialog_mask_bg").css({"width":"0px","height":"0px"});
    //    var reBodySize = getBodySize;
    //    $("#dialog_mask_bg").width(reBodySize[0])
    //    .height(reBodySize[1]);
    //});


    //弹出层移除
    function dialogRemove(){
		if(hidden_div_id!=undefined && hidden_div_id!="")
		{
			$("#"+hidden_div_id).html($("#dialog_box_html").html());
		}
        $("#dialog_mask_bg").fadeOut("fast",function(){ $(this).remove();});
        $("#dialog_box").remove();
    }

    // 创建底部按钮
    function newBtn(name,value,fn){ 
        var btnObj = "<input type=\"button\" name=\""+name+"\" id=\""+name+"\" value=\""+value+"\" />";    
        var f = $.isFunction(fn) ? fn : dialogRemove;
        $("#dialog_box_bom").append(btnObj)
        .css({"text-align":"center"});
        $("#"+name).click(f);
    }
    
    // 拖拽实现
    function dialogDrag(target,e) {
        var deltaX= e.clientX - target[0].offsetLeft;
        var deltaY= e.clientY - target[0].offsetTop;
        var drag = true;

        $(document).bind("mousemove",function(ev){ 
        if (drag) {
            var Y = ev.clientY-deltaY;
            var X = ev.clientX-deltaX;
            var H = bodyHeight-target[0].offsetHeight;
            var W = bodyWidth-target[0].offsetWidth;
            if(Y>0 || X>0){
                if (Y>=H){ target.css("top",H+"px"); }else{ target.css("top",Y+"px"); }
                if (X>=W){ target.css("left",W+"px"); }else{ target.css("left",X+"px"); }
            }
            if(Y<=0) target.css("top","0px");
            if(X<=0) target.css("left","0px");
        }
        })
        .bind("mouseup",function(){
            drag = false;
            $(this).unbind("mousemove")
            .unbind("mouseup");
        });
    }
    
    // 背景iframe，防select控件被遮罩无效，改自jqueryui
    function bgiframe(elm){
    if ( $.browser.msie && /6.0/.test(navigator.userAgent) ) {
        html = '<iframe class="bgiframe"frameborder="0"tabindex="-1"src="javascript:false;"'+
                       'style="display:block;position:absolute;z-index:-1;filter:Alpha(Opacity=\'0\');'+
                           'top:expression(((parseInt(this.parentNode.currentStyle.borderTopWidth)||0)*-1)+\'px\');'+
                           'left:expression(((parseInt(this.parentNode.currentStyle.borderLeftWidth)||0)*-1)+\'px\');'+
                           'width:expression(this.parentNode.offsetWidth+\'px\');'+
                           'height:expression(this.parentNode.offsetHeight+\'px\');"/>';
        return elm.each(function() {
            if ( $('> iframe.bgiframe', this).length == 0 )
                this.insertBefore( document.createElement(html), this.firstChild );
        });
    }
    return elm;
    }

}

})(jQuery);

///////////////////////////
// author ian.lee ianlee@fastmail.cn
// time 2007.9.25
//
/////////////////////////////

//-页面的导航(在你的位置段的程序设置)
//李林的菜单导航是基于对每个菜单按级次名命 如ian1 ian1_1 ian1_1_1这种方式来实现的，当点击一个菜单，将其父级菜单的id
//获取，并根据这个id取得父级菜单的中文文字。罗维　标注于2009-4-9

function toUrl(obj,ps){
	var return_pols;
	var ps;	
	var css="<span class='tp'>></span>"  //css style
	if(ps=="f"){
		return_pols=obj;
	}else{
		//数组值
		var gid=obj.id;

		//获取 img 下的id 值
		var imggetid=gid.split('_');
		if(ps=="a"){    //数组的不同形式
			return_pols=document.getElementById(gid).innerHTML;

			if(imggetid['0']=='menuimg'){ // 如果该值是从 menuimg 过来的
				return_pols=document.getElementById('ian'+imggetid['1']).innerHTML;
			}

		}else if(ps=="b"){
		      $(".leftmenuinfo td").css('background','#f2fcfe');
              $(".leftmenuinfo td img").remove();
		      $(obj).parent().css('background','#fff');
              $(obj).before("<img src='/views/images/title_arrow.gif' />");
			return_pols=document.getElementById(rep(gid,'a')).innerHTML+css+document.getElementById(gid).innerHTML;
		}else if(ps=="c"){
		  $(".leftmenuinfo td").css('background','#f2fcfe');
          $(".leftmenuinfo td img").remove();
		  $(obj).parent().css('background','#fff');
          $(obj).before("<img src='/views/images/title_arrow.gif' />");
			return_pols=document.getElementById(rep(gid,'a')).innerHTML+css+document.getElementById(rep(gid,'b')).innerHTML+css+document.getElementById(gid).innerHTML;	
		}
	}
	window.top.frames["right_top"].document.getElementById('url').innerHTML = return_pols;
	}

//-正则表达式(作用将页面导航分析成想要的数据，给toUrl()函数使用)
function rep(vp,ks){
	if(ks=="a"){
		var strson=/(_[0-9]+){1,}$/;  //-匹配表达式
		var Vstr=vp.replace(strson,"");  //-执行匹配
	}else if(ks=="b"){
		var strson=/(_[0-9]+){1,}$/;  //-匹配表达式
        var gey=vp.replace(strson,"");  //-执行匹配
		var strson3=/_[0-9]([0-9]+){0,}$/;
		Vstr=gey+vp.replace(gey,"").replace(strson3,"");  //-执行二次匹配
	}
    return  Vstr;
	}


//-病人姓名的显示  
function set_patient_name(name){
	//alert('d');
	window.top.frames["right_top"].document.getElementById("name").innerHTML = name;
	}

//-家庭评估页面的得分计算 -
function  count_family_value(){
	//获取各数据的值
	var fun1=document.getElementById("fun1").value;
	var fun2=document.getElementById("fun2").value;	
	var fun3=document.getElementById("fun3").value;
	var fun4=document.getElementById("fun4").value;
	var fun5=document.getElementById("fun5").value;
	
	var count_value=parseFloat(fun1)+parseFloat(fun2)+parseFloat(fun3)+parseFloat(fun4)+parseFloat(fun5);  //-计算评估总值
	
	color(count_value);	  //-调用评语函数
	document.getElementById('show').value=count_value;	  //-赋值评估得分

	}

//-得分知道评语
function color(count_value){
		//由评估值得到评语
	if(count_value<=3){
		 str="重度障碍";
		 document.getElementById('evaluate').style.color="#ff0000"//-样式
	}else if(4>=count_value || count_value<=5){
		 str="中度障碍";
		 document.getElementById('evaluate').style.color="#000000"//-样式
	}else if(count_value==6){
		 str="轻度障碍";
		 document.getElementById('evaluate').style.color="#000000"//-样式
	}else if(count_value>=7){
		 document.getElementById('evaluate').style.color="#009900"//-样式
		 str="家庭功能良好";
	}
		document.getElementById('evaluate').value=str;    //-赋值评估得出的结语	
	}

//-家庭评估页面针对没有输入数据的情况
function empty_evaluate(){
	if(!confirm('确定数据正确!')){
		return false;
	}
	count_family_value(); //-显示调用函数
	}

//-以下为js的cookie设置

function GetCookieVal(offset)

	//获得Cookie解码后的值
	{
	var endstr = document.cookie.indexOf (";", offset);
	if (endstr == -1)
	endstr = document.cookie.length;
	return unescape(document.cookie.substring(offset, endstr));
	}

//设定Cookie值
function SetCookie(name, value)
	{
	var expdate = new Date();
	var argv = SetCookie.arguments;
	var argc = SetCookie.arguments.length;
	var expires = (argc > 2) ? argv[2] : null;
	var path = (argc > 3) ? argv[3] : null;
	var domain = (argc > 4) ? argv[4] : null;
	var secure = (argc > 5) ? argv[5] : false;
	if(expires!=null) expdate.setTime(expdate.getTime() + ( expires * 1000 ));
	document.cookie = name + "=" + escape (value) +((expires == null) ? "" : ("; expires="+ expdate.toGMTString()))
	+((path == null) ? "" : ("; path=" + path)) +((domain == null) ? "" : ("; domain=" + domain))
	+((secure == true) ? "; secure" : "");
	}

function setcookie(cookieName, cookieValue, seconds, path, domain, secure) {
	var expires = new Date();
	expires.setTime(expires.getTime() + seconds);
	document.cookie = escape(cookieName) + '=' + escape(cookieValue)
		+ (expires ? '; expires=' + expires.toGMTString() : '')
		+ (path ? '; path=' + path : '/')
		+ (domain ? '; domain=' + domain : '')
		+ (secure ? '; secure' : '');
	}

//删除Cookie
function DelCookie(name)
	{
	var exp = new Date();
	exp.setTime (exp.getTime() - 1);
	var cval = GetCookie (name);
	document.cookie = name + "=" + cval + "; expires="+ exp.toGMTString();
	}

//获得Cookie的原始值
function GetCookie(name)
	{
	var arg = name + "=";
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
	while (i < clen)
	{
	var j = i + alen;
	if (document.cookie.substring(i, j) == arg)
	return GetCookieVal (j);
	i = document.cookie.indexOf(" ", i) + 1;
	if (i == 0) break;
	}
	return null;
	}

	
//设定右边的灰化效果  (参数 on -  开启灰化，即右边为灰化  off -- 关闭灰化 ， 即右边不灰化)
function right_window_cineration(on_off){
	
 if(on_off=='on'){  //添加该节点
  var sWidth,sHeight;    
	 sWidth=document.body.offsetWidth;
	 sHeight=document.body.offsetHeight;

  var bgObj=document.createElement("div");  
	bgObj.setAttribute("id","bgDiv");   
    bgObj.style.position="absolute";    
    bgObj.style.top="0";    
    bgObj.style.background="fff";    
	bgObj.style.left="0"; 
    bgObj.style.filter="progid:DXImageTransform.Microsoft.Alpha(startX=20,startY=20,finishX=100,finishY=100,style=1,opacity=17,finishOpacity=100);";
    bgObj.style.width=sWidth + "px";    
	bgObj.style.height=sHeight + "px";    
    bgObj.style.zIndex = "111";  
    window.top.frames["leftdh"].document.body.appendChild(bgObj);//在body内添加该div对象

	}else if(on_off=='off'){ //删除该节点
		var nownode=window.top.frames["leftdh"].document.getElementById('bgDiv');
		if(nownode !="" && nownode !=null){
			nownode.parentNode.removeChild(nownode);
		}
	}

}

window.onerror=function(){
	return true;
}

var regexEnum = 
{
	intege:"^-?[1-9]\\d*$",					//整数
	intege1:"^[1-9]\\d*$",					//正整数
	intege2:"^-[1-9]\\d*$",					//负整数
	num:"^([+-]?)\\d*\\.?\\d+$",			//数字
	num1:"^[1-9]\\d*|0$",					//正数（正整数 + 0）
	num2:"^-[1-9]\\d*|0$",					//负数（负整数 + 0）
	decmal:"^([+-]?)\\d*\\.\\d+$",			//浮点数
	decmal1:"^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*$",　　	//正浮点数
	decmal2:"^-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*)$",　 //负浮点数
	decmal3:"^-?([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0)$",　 //浮点数
	decmal4:"^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0$",　　 //非负浮点数（正浮点数 + 0）
	decmal5:"^(-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*))|0?.0+|0$",　　//非正浮点数（负浮点数 + 0）

	email:"^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$", //邮件
	color:"^[a-fA-F0-9]{6}$",				//颜色
	url:"^http[s]?:\\/\\/([\\w-]+\\.)+[\\w-]+([\\w-./?%&=]*)?$",	//url
	chinese:"^[\\u4E00-\\u9FA5\\uF900-\\uFA2D]+$",					//仅中文
	ascii:"^[\\x00-\\xFF]+$",				//仅ACSII字符
	zipcode:"^\\d{6}$",						//邮编
	mobile:"^(13|15)[0-9]{9}$",				//手机
	ip4:"^(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)$",	//ip地址
	notempty:"^\\S+$",						//非空
	picture:"(.*)\\.(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$",	//图片
	rar:"(.*)\\.(rar|zip|7zip|tgz)$",								//压缩文件
	date:"^\\d{4}(\\-|\\/|\.)\\d{1,2}\\1\\d{1,2}$",					//日期
	qq:"^[1-9]*[1-9][0-9]*$",				//QQ号码
	tel:"^(([0\\+]\\d{2,3}-)?(0\\d{2,3})-)?(\\d{7,8})(-(\\d{3,}))?$",	//电话号码的函数(包括验证国内区号,国际区号,分机号)
	username:"^\\w+$",						//用来用户注册。匹配由数字、26个英文字母或者下划线组成的字符串
	letter:"^[A-Za-z]+$",					//字母
	letter_u:"^[A-Z]+$",					//大写字母
	letter_l:"^[a-z]+$",					//小写字母
	idcard:"^[1-9]([0-9]{14}|[0-9]{17})$",	//身份证
	phone:"^(0?1[3,5,8](\\d){9}(-(\\d){1,6})?|0(\\d){3}-(\\d){6,8}(-(\\d){1,6})?|0(\\d){2}-(\\d){8}(-(\\d){1,6})?|00(\\d){11,20})$" //电话号码，包括手机号和座机
}

var aCity={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外"} 
//验证是否为空
function isEmpty(obj,inputname)
{
	var str=obj.val();
	var aa=eval("/"+regexEnum['notempty']+"/i");
	if (!aa.test(str)) {
		alert(inputname+"不能为空");
		obj.addClass("errortips");
		$("input[type='submit']").attr("disabled","disabled");
		return false;
	}
	else
	{
		obj.removeClass("errortips");
		$("input[type='submit']").attr("disabled","");
		return true;
	}
}
//验证只能是数字
function isInt(obj,inputname)
{
	if(inputname=='undefind')
	{
		inputname="";
	}
	var str=obj.val();
	if (str) {
		var aa = eval("/" + regexEnum['num1'] + "/i");
		if (!aa.test(str)) {
			alert(inputname+"只能是数字");
			obj.addClass("errortips");
			$("input[type='submit']").attr("disabled", "disabled");
			return false;
		}
	}
	obj.removeClass("errortips");
	$("input[type='submit']").attr("disabled","");
	return true;
}
//验证电话号码
function isPhone(obj){
	var str = obj.val();
	if (str) {
		var aa = eval("/" + regexEnum['phone'] + "/i");
		if (!aa.test(str)) {
			alert("电话号码只能是固定电话或者手机号码");
			obj.addClass("errortips");
			$("input[type='submit']").attr("disabled", "disabled");
			return false;
		}
	}
	obj.removeClass("errortips");
	$("input[type='submit']").attr("disabled", "");
	return true;
}
//验证身份证号码
function isCardID(obj){ 
	var sId=obj.val();
	var iSum=0 ;
	var info="" ;
	if (!/^\d{17}(\d|x)$/i.test(sId)) {
		alert("你输入的身份证长度或格式错误");
		obj.addClass("errortips");
		$("input[type='submit']").attr("disabled","disabled");
		return false;
	} 
	sId=sId.replace(/x$/i,"a"); 
	if (aCity[parseInt(sId.substr(0, 2))] == null) {
		alert("你的身份证地区非法");
		obj.addClass("errortips");
		$("input[type='submit']").attr("disabled","disabled");
		return false;
	}
	sBirthday=sId.substr(6,4)+"-"+Number(sId.substr(10,2))+"-"+Number(sId.substr(12,2)); 
	var d=new Date(sBirthday.replace(/-/g,"/")) ;
	if (sBirthday != (d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate())) {
		alert("身份证上的出生日期非法");
		obj.addClass("errortips");
		$("input[type='submit']").attr("disabled","disabled");
		return false;
	}
	for(var i = 17;i>=0;i --) iSum += (Math.pow(2,i) % 11) * parseInt(sId.charAt(17 - i),11) ;
	if (iSum % 11 != 1) {
		alert("你输入的身份证号非法");
		obj.addClass("errortips");
		$("input[type='submit']").attr("disabled","disabled");
		return false;
	}
	obj.removeClass("errortips");
	$("input[type='submit']").attr("disabled","");
	return true;//aCity[parseInt(sId.substr(0,2))]+","+sBirthday+","+(sId.substr(16,1)%2?"男":"女") 
} 

//验证长度 obj 带验证的对象 min 最小值 为0时 ，max  最大值
function checkLen(obj,min,max,inputname)
{
	var str=obj.val();
	if(min && str.length<min)
	{
		alert(inputname+"长度小于最小限度"+min+",当前长度"+str.length);
		obj.addClass("errortips");
		$("input[type='submit']").attr("disabled","disabled");
		return false;
	}
	if(max && str.length>max)
	{
		alert(inputname+"长度大于最大限度"+max+",当前长度"+str.length);
		obj.addClass("errortips");
		$("input[type='submit']").attr("disabled","disabled");
		return false;
	}
	obj.removeClass("errortips");
	$("input[type='submit']").attr("disabled","");
	return true;
}



//短时间，形如 (13:04:06)
function isTime(obj,str)
{
	var a = str.match(/^(\d{1,2})(:)?(\d{1,2})\2(\d{1,2})$/);
	if (a == null) {return false}
	if (a[1]>24 || a[3]>60 || a[4]>60)
	{
		obj.addClass("errortips");
		$("input[type='submit']").attr("disabled","disabled");
		return false;
	}
	obj.removeClass("errortips");
	$("input[type='submit']").attr("disabled","");
	return true;
}

//短日期，形如 (2003-12-05)
function isDate(obj)
{
	var str=obj.val();
	var r = str.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/); 
	if (r == null) {
		alert("输入的日期存在格式错误，允许的格式如：2010-08-08或者2010/08/08");
		obj.addClass("errortips");
		$("input[type='submit']").attr("disabled","disabled");
		return false;
	} 
	var d= new Date(r[1], r[3]-1, r[4]); 
	if(d.getFullYear()!=r[1]||(d.getMonth()+1)!=r[3]||d.getDate()!=r[4])
	{
		alert("输入的日期存在错误，允许的格式如：2010-08-08或者2010/08/08");
		obj.addClass("errortips");
		$("input[type='submit']").attr("disabled","disabled");
		return false;
	}
	obj.removeClass("errortips");
	$("input[type='submit']").attr("disabled","");
	return true;
}

//长时间，形如 (2003-12-05 13:04:06)
function isDateTime(str)
{
	var reg = /^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/; 
	var r = str.match(reg); 
	if(r==null) return false; 
	var d= new Date(r[1], r[3]-1,r[4],r[5],r[6],r[7]); 
	return (d.getFullYear()==r[1]&&(d.getMonth()+1)==r[3]&&d.getDate()==r[4]&&d.getHours()==r[5]&&d.getMinutes()==r[6]&&d.getSeconds()==r[7]);
}

//ajax get方式验证
function ajaxChk(obj,gurl,inputname)
{
	$.ajax({
		type:"GET",
		url:gurl,
		dataType:"html",
		data:"",
		success:function(data){
			var dd=$.trim(data);
			if(dd=="ok")
			{
				obj.removeClass("errortips");
				$("input[type='submit']").attr("disabled","");
				return true;
			}
			else
			{
				alert(inputname+"已存在,无法添加");
				obj.addClass("errortips");
				$("input[type='submit']").attr("disabled","disabled");
				return false;
			}
		},
		error:function(){
			alert("验证出错，请刷新页面重试");
			obj.addClass("errortips");
			$("input[type='submit']").attr("disabled","disabled");
			return false;
		}
	});
}

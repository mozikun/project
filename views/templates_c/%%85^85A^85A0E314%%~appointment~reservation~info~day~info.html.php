<?php /* Smarty version 2.6.14, created on 2013-08-14 11:38:57
         compiled from info.html */ ?>

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
#box{width:600px;text-align:left;margin:0 auto;padding-top:80px;}
 #suggest,#suggest2{width:340px;font-size:12px; font-weight:normal;}
 .gray{color:gray;}
 .ac_results {background:#fff;border:1px solid #7f9db9;position: absolute;z-index: 10000;display: none;}
 .ac_results ul{margin:0;padding:0;list-style:none;}
 .ac_results li a{white-space: nowrap;text-decoration:none;display:block;color:#05a;padding:1px 3px;}
.ac_results li{border:1px solid #fff;}
.ac_over,.ac_results li a:hover {background:#c8e3fc;}
.ac_results li a span{float:right;}
.ac_result_tip{border-bottom:1px dashed #666;padding:3px;}
</style>

<title>雅安市卫生局网上预约挂号平台</title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/allt.css" rel="stylesheet" type="text/css">
<script>
	function check(){
		var us="";
		if(us==''){
			alert('您还没有登陆,请先登录!');
		}
	}

  function refreshlog(obj){  
 //点击验证码图片时候刷新验证码
	var $obj = "code.php?id="+Math.random();
  			obj.src = $obj ;
 }


function isNumberString (InString,RefString)
{
if(InString.length==0) return (false);
for (Count=0; Count < InString.length; Count++)  
{
	TempChar= InString.substring (Count, Count+1);
	if (RefString.indexOf (TempChar, 0)==-1)  
	return (false);
}
return (true);
}


function checkForm()
{

if(document.form1.truename.value=="")
{
 document.form1.truename.focus();
 alert("真实姓名不能为空！");
 return false;
}

if(document.form1.sfzhm.value=="")
{
 document.form1.sfzhm.focus();
 alert("证件号不能为空！");
 return false;
}
/*
if    ( isNumberString(document.form1.sfzhm.value,"1234567890xX")!=1  ||  (document.form1.sfzhm.value.length  !=15  &&  document.form1.sfzhm.value.length !=18)   )
{
 document.form1.sfzhm.focus();
 alert("身份证号不正确！");
 return false;
}
*/
if(document.form1.yzm.value=="")
{
 document.form1.yzm.focus();
 alert("验证码不能为空！");
 return false;
}
/*
if(document.form1.yzm.value!=document.form1.syzm.value)
{
 document.form1.yzm.focus();
 alert("验证码不正确！");
 return false;
}
*/
} 
</script></head>

<body>
<!-- 头文件开始 -->
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0" class="top">
  <tbody><tr>
    <td><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/top.gif" width="980" height="81" alt="雅安市卫生局网上预约挂号平台"></td>
  </tr>
</tbody></table>
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0" class="menu">
  <tbody><tr>
    <td valign="top">
			<!-- 导航及搜索开始 -->
	<form action="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/index/add" method="post" name="formsh">
	<table width="930" border="0" align="center" cellpadding="0" cellspacing="0" class="marg">
      <tbody><tr>
        <td width="585" class="white"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/reservation/" class="white">首页</a>　|　<a href="#" class="white">预约指南</a>　|　<a href="#" class="white">最新公告</a>　|　<a href="#" class="white">常见问题</a>　|　<a href="#" class="white">常见病对应科室</a>　|　<a href="#" class="white">意见反馈</a></td>
        <td width="150">&nbsp;</td>
        
        <td width="140" align="center">&nbsp;</td>
        <td width="50" align="center">&nbsp;</td>
      </tr>
    </tbody></table>
	</form>
	<!-- 导航及搜索结束 -->	
	<!-- 登录开始 -->
	
	
	<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" class="marg15">
	
    </table>
	
	
		<!-- 登录结束 -->	
	</td>
  </tr>
</tbody></table>
<!-- 头文件结束 -->


<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody><tr>
    <td><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/liucheng.gif" width="980" height="91"></td>
  </tr>
</tbody></table>
<!-- 预约挂号流程结束 -->
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0" class="marg">
  <tbody><tr>
    <td width="770" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td width="26"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_01.gif" width="26" height="34"></td>
        <td align="center" class="lmmenu"><a href="#" target="_blank" class="white">挂号信息</a></td>
        <td align="right" valign="bottom" class="lmt_bg1"><a href="#" target="_blank" class="red"></a></td>
        <td width="10"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_03.gif" width="10" height="34"></td>
      </tr>
    </tbody></table>
	<form action="#" name="form1" id="form1" method="post">
      <table width="770" style="  border:1px #D2D2D2 solid;border-bottom:none; border-top: none;">
        <tr>
          <td  align="right" width="126">姓名：</td>
          <td width="632"><input  id="name"name="name"/></td>
        </tr>
        <tr>
          <td align="right">身份证号：</td>
          <td><input id="id_card"name="id_card"/></td>
        </tr>
		 <tr>
          <td align="right">手机号:</td>
          <td><input id="phone_number" name="phone_number"/></td>
        </tr>
        <tr>
          <td align="right">性别：</td>
          <td>
          <select name="sex" id="sex">
          <option>男</option>
          <option>女</option>
          </select>
          
          </td>
        </tr>
        <tr>
          <td align="right">年龄：</td>
          <td><input  id="age"name="age"/></td>
        </tr>
        <tr>
          <td></td>
          
          <td><input type="button" class="action" value="提交" size="30"/>  <input type="button" value="返回" onclick="back()"/></td>
		 <script type="text/javascript">
			function back(){
				history.go(-1);
			}
		 </script>
         <input name="org_id" type="hidden" value="<?php echo $this->_tpl_vars['org_id']; ?>
"/>
        <input name="doctor_id" type="hidden" value="<?php echo $this->_tpl_vars['doctor_id']; ?>
"/>
        <input name="user_name" type="hidden" value="<?php echo $this->_tpl_vars['user_name']; ?>
"/>
        <input name="register_time" type="hidden" value="<?php echo $this->_tpl_vars['register_time']; ?>
"/>
        <input name="day" type="hidden" value="<?php echo $this->_tpl_vars['day']; ?>
"/>
        <input name="uuid" type="hidden" value="<?php echo $this->_tpl_vars['uuid']; ?>
"/>
        </tr>
      </table>
      </form>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody><tr>
    <td width="6"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_06.gif" width="6" height="6"></td>
    <td height="6" class="lh"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_07.gif" width="1" height="6"></td>
    <td width="6"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_08.gif" width="6" height="6"></td>
  </tr>
</tbody></table>
</td>
    <td>&nbsp;</td>
    <td width="200" valign="top">
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
          <td width="26"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_01.gif" width="26" height="34"></td>
          <td align="center" class="lmmenu"><a href="www.yawsj.com/comm/newgg.php" target="_blank" class="white">公告栏</a></td>
          <td background="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_02.gif">&nbsp;</td>
          <td width="10"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_03.gif" width="10" height="34"></td>
        </tr>
      </tbody></table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="box">
          <tbody><tr>
            <td class="pad">
          
·<a href="#" target="_blank">预约挂号平台新增医院通知</a> <br>
·<a href="#" target="_blank" >301医院敬告患者</a><br>
·<a href="#" target="_blank">明卫生院恢复预约通知</a><br />
·<a href="#" target="_blank">雅安第一人民医院号源调整公告</a><br />
·<a href="#" target="_blank">预约挂号平台新增医院</a><br />
·<a href="#" target="_blank">关于用户未就诊处理通知</a><br />
·<a href="#" target="_blank">查询、取消预约注意事项<br /></a> </td>
          </tr>
        </tbody></table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody><tr>
            <td width="6"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_06.gif" width="6" height="6"></td>
            <td height="6" class="lh"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_07.gif" width="1" height="6"></td>
            <td width="6"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_08.gif" width="6" height="6"></td>
          </tr>
      </tbody></table>
	  </td>
  </tr>
</tbody></table>
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0" class="marg10">
  <tbody><tr>
    <td width="770" valign="top">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="cjwt">
      <tbody><tr>
        <td width="145" align="center" valign="top" class="pad20"><a href="#" target="_blank"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/cjwt.gif" alt="常见问题" width="65" height="17" border="0"></a></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody><tr>
    <td width="20"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon01.gif" alt="" vspace="3" align="absmiddle"></td>
    <td width="280"><a href="#" target="_blank" class="blue">电话预约或网上预约挂号需要付费吗？</a></td>
    <td width="20"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon01.gif" alt="" vspace="3" align="absmiddle"></td>
    <td width="281"><a href="#" target="_blank" class="blue">预约前需要注册吗？</a></td>
  </tr>
  <tr>
    <td valign="top"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon02.gif" alt="" vspace="3" align="absmiddle"></td>
    <td><a href="#" target="_blank">...</a></td>
    <td valign="top"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon02.gif" alt="" vspace="3" align="absmiddle"></td>
    <td><a href="#" target="_blank">无论通过何种方式预约，预约前都需要实名制注册...</a></td>
  </tr>
  <tr>
    <td><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon01.gif" alt="" vspace="3" align="absmiddle"></td>
    <td><a href="#" target="_blank" class="blue">能预约专家号吗？ </a></td>
    <td><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon01.gif" alt="" vspace="3" align="absmiddle"></td>
    <td><a href="#" target="_blank" class="blue">可以提前几天预约？</a></td>
  </tr>
  <tr>
    <td valign="top"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon02.gif" alt="" vspace="3" align="absmiddle"></td>
    <td><a href="#" target="_blank">根据雅安市卫生局医改新政策按医院、科室、职称...</a></td>
    <td valign="top"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon02.gif" alt="" vspace="3" align="absmiddle"></td>
    <td><a href="#" target="_blank">统一平台不提供当日预约服务，用户可预约接入统一平...</a></td>
  </tr>
</tbody></table></td>
        </tr>
    </tbody></table>	</td>
    <td>&nbsp;</td>
    <td width="200" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td height="77" align="center"><a href="http://www.bjhb.gov.cn/" target="_blank"></a></td>
      </tr>
      <tr>
        <td height="77" align="center">&nbsp;</td>
      </tr>

    </tbody></table>
      </td>
  </tr>
</tbody></table>
<!-- 尾文件开始 -->
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0" class="foot">
  <tbody><tr>
    <td align="center" class="f12px"> <a href="www.yawsj.com/comm/lxwm.php" target="_blank">联系我们</a> ┊ <a href="www.yawsj.com/comm/hzhb.php" target="_blank">合作伙伴</a> ┊ <a href="www.yawsj.com/comm/flsm.php" target="_blank">法律声明</a> ┊ <a href="www.yawsj.com/comm/vote/yjfk.php" target="_blank">意见反馈</a><br>
    
    </td>
  </tr>
</tbody></table>



<!-- 尾文件结束 -->

<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
 <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/j.dimensions.js"></script>
 <?php if (( $this->_tpl_vars['currentregion'] == '' )): ?>
 <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/organization.js"></script>
 <?php else: ?>
 <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/<?php echo $this->_tpl_vars['currentregion']; ?>
.js"></script>
 <?php endif; ?>
 <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/j.suggest.js"></script>
 <script type="text/javascript">
	 $(function(){
		 $("#organize").suggest(organizationArray,{hot_list:organizationArray,dataContainer:'#organize_code',onSelect:function(){$("#organize_passwd").focus();}, attachObject:'#suggest'});
	 	
		
		
		 //机构密码失去焦点
		 $("#organize_passwd").blur( function (){
				var organize_code  = $("#organize_code").val();//机构代码
				var organize_passwd= $("#organize_passwd").val();//机构密码
				
		 		//机构代码和机构密码不能为空验证表单
				var user=$("#user_id");//用户下拉框
		 		if(organize_code!=""  && organize_passwd!=""){
		 			if(organize_passwd.match(/[\u4e00-\u9fa5 0-9 a-z_]{1}/i)){
			   	  	    $("#Layer1").show();
		        		user.html('<option >载入中,请等待！</option>'); 
			   	    }else{
				   	  	alert("机构密码格式不对!");
				   	  	user.empty();//清空下拉选项
				   	  	return false;
			   	    }
					$.get("<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/chkoragnize/organize_code/"+organize_code+"/organize_passwd/"+organize_passwd, function(data){
					  

					  if(data.indexOf("~")==-1){
					  	 alert("网络不通！");
					  	 user.empty();//清空下拉选项
					  	 return false;
					  }
					  var msg_arr=data.split("~");
					  var msg_code=msg_arr[0];//信息代码
					  var msg_content=msg_arr[1];//信息提示
					  
					  //alert(data);
					  
					
					  user.empty();//清空下拉选项
					  if(msg_code!=1){
					  	  //alert(msg_content);
					  	  $("#Layer1").hide();
						  return false;
					  }else{
						  var user_array=msg_content.split("|");
						
						  for(i=0;i<user_array.length;i++){
						        //alert(user_array[i]);
						  		var user_arr= (user_array[i]).split(":");//得到用户id和登录名
								user.append('<option value="'+user_arr[0]+'">'+user_arr[1]+'</option>');   
						  }
						  user.focus();
						  $("#Layer1").hide();
					  }
				
				  	 
					  
					});
				}
		 
		 } );
		
		
		//提交表单
         $("#loginsubmit").click(function(){
         	   
		       var organize_code  = $("#organize_code").val();//机构代码
			   var organize_passwd= $("#organize_passwd").val();//机构密码
			   var user_code	  = $("#user_id").val();//用户代码
			   var user_passwd    = $("#user_passwd").val();//用户密码
			   
			   if(organize_code==""){
			    	alert("请输入机构名！");
			   		$("#organize").focus();
					return false;
			   }
			   if(organize_passwd==""){
			    	alert("请输入机构密码！");
			   		$("#organize_passwd").focus();
					return false;
			   }else{
			   	  if(organize_passwd.match(/[\u4e00-\u9fa5 0-9 a-z_]{1}/i)){
			   	  	 
			   	  }else{
			   	  	alert("机构密码格式不对!");
			   	  	return false;
			   	  }
			   	
			   }
			    if(user_code==""){
			    	alert("请选择用户名！");
			   		$("#user_id").focus();
					return false;
			   }
			   if(user_passwd==""){
			    	alert("请选择用户密码！");
			   		$("#user_passwd").focus();
					return false;
			   }else{
				      if(user_passwd.match(/[\u4e00-\u9fa5 0-9 a-z_]{1}/i)){
				   	  	 
				   	  }else{
				   	  	alert("用户密码格式不对!");
				   	  	return false;
				   	  }
			   	
			   }
			   
			   
			   $.get("<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/chkuser/organize_code/"+organize_code+"/user_code/"+user_code+"/user_passwd/"+user_passwd, function(data){
				  	
				    //alert(data);
				    var msg_arr = data.split("|");
				    if(msg_arr[0]==1){
				    	window.location="<?php echo $this->_tpl_vars['basePath']; ?>
doctor/index";
				  		return false;
				    }
				  	//document.write(data);
					
					alert(msg_arr[1]);
				    return false;
					
			   });
			   return false;
						 
		 });
	});
	
	
	
	function checkvalue()
	{    
		if(!$("#name").val())
		{
		    alert("名字不能为空");return false;
		}
		var id_card=$("#id_card").val();
		var partten = /^[\d]{6}((19[\d]{2})|(200[0-8]))((0[1-9])|(1[0-2]))((0[1-9])|([12][\d])|(3[01]))[\d]{3}[0-9xX]$/;
		if(!partten.test(id_card))
		{
		    alert("请输入正确的身份证号");return false;
		}
		var phone=/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/;
		if(!phone.test($("#phone_number").val())){
			alert("请输入正确的手机号码"); return false;
		}
		var age=$("#age").val();
		if(!(/^\d+$/.test(age)))
		{
		    alert("请输入正确的年龄");
			return false;
		}
		return 1;
	}
	
</script>
 
 <style type="text/css">
.overlay{position:fixed;top:0;right:0;bottom:0;left:0;z-index:998;width:100%;height:100%;_padding:0 20px 0 0;background:#f6f4f5;display:none;}
.showbox{position:fixed;top:0;left:50%;z-index:9999;opacity:0;filter:alpha(opacity=0);margin-left:-80px;}
*html,*html body{background-image:url(about:blank);background-attachment:fixed;}
*html .showbox,*html .overlay{position:absolute;top:expression(eval(document.documentElement.scrollTop));}
#AjaxLoading{border:1px solid rgb(33,107,195);color:#37a;font-size:12px;font-weight:bold; border-radius:2px;}
#AjaxLoading div.loadingWord{width:180px;height:50px;line-height:50px;border:2px solid #D6E7F2;background:#fff;text-align:center;}
#AjaxLoading img{margin:10px 15px;float:left;display:inline;}
</style>  <script type="text/javascript">
$(document).ready(function(){
	
	var h = $(document).height();
	$(".overlay").css({"height": h });	
	
	$(".action").click(function(){
	
		//验证表单
		if(!checkvalue()) return false;
		
		$(".overlay").css({'display':'block','opacity':'0.7'});
		
		$(".showbox").stop(true).animate({'margin-top':'300px','opacity':'1'},200);
		$.ajax({
			type:"POST",
			url:"<?php echo $this->_tpl_vars['basePath']; ?>
appointment/reservation/save",
			data:$("#form1").serialize(),
			beforeSend:function(){
				
			},
			success:function(msg){
				$(".loadingWord").html("<font color='green'>"+msg+"</font>");
				
				setTimeout(function(){
				$(".showbox").stop(true).animate({'margin-top':'250px','opacity':'0'},400);
			
				$(".overlay").css({'display':'none','opacity':'0'});
				
			    window.location="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/reservation/index";
				},3000); 
			}
		});
	
		
	
	});
	
});
</script>
<div class="overlay" style="height: 1321px;">&nbsp;</div>
<div class="showbox" id="AjaxLoading">
<div class="loadingWord"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/waiting.gif" alt=""><span id="tip">提交中，请稍候...</span></div>
</div>
 
 

</body></html>
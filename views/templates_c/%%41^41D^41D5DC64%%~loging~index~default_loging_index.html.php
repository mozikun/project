<?php /* Smarty version 2.6.14, created on 2013-08-28 09:58:04
         compiled from default_loging_index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>雅安市区域卫生信息平台</title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/new_index.css" type="text/css" rel="stylesheet" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.9.1.min.js"></script>
<script language="javascript">
function closed1(){
	document.getElementById("closeDiv1").style.display = "none";
	document.getElementById("closeDiv2").style.display ="";
	document.getElementById("closedDIVa").style.display = "";
    $(".bank_1,.bank_6,.bank_4").css("height","244px");
	}
function closed2(){
	document.getElementById("closeDiv1").style.display = "";
	document.getElementById("closeDiv2").style.display = "none";
	document.getElementById("closedDIVa").style.display = "none";
    $(".bank_1,.bank_6,.bank_4").css("height","444px");
	}
</script>
</head>
<body>
<div class="wap por">
	<h1 class="logo"><a href="###">logo</a></h1>
    <div class="bank_1" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/index'">
    	<h2 class="bank_tit1 mar_t_12">居民服务</h2>
        <p class="bank_p1">服务居民，服务你我</p>
    </div>
    <div class="bank_6" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/user'">
     	<h2 class="bank_tit6 mar_t_12">医疗业务</h2>
        <p class="bank_p6">为健康找想,为了更好<br />的明天</p>
     </div>
      <div class="bank_4" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/decision'">
     	<h2 class="bank_tit4 mar_t_12">决策支持</h2>
        <p class="bank_p4">决策支持系统<br />为了更好的明天</p>
     </div>
 <p id="closeDiv1" onclick="closed1()">更多入口点击这里↓</p>
 <div style="display:none" id="closedDIVa">
      <div class="bank_5" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
web/default/index'">
     	<h2 class="bank_tit5 mar_t_12">门户网站</h2>
        <p class="bank_p5">居民健康信息门户网站<br />欢迎您！</p>
     </div>
       <div class="bank_2" onclick="window.open('http://172.16.11.248:9292')">
     	<h2 class="bank_tit2 mar_t_12">OA办公</h2>
        <p class="bank_p2">自动化系统</p>
     </div>
      <div class="bank_3" onclick="window.open('http://172.16.12.231:9000')">
     	<h2 class="bank_tit3 mar_t_12">应急指挥<span class="bank_p3">雅安市紧急救援中心</span></h2>
     </div>
     
      <div class="bank_7" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/leadindex'">
     	<h2 class="bank_tit7 mar_t_12">县管平台</h2>
        <p class="bank_p7">县级监管平台</p>
     </div>
      <div class="bank_8">
     	<h2 class="bank_tit8a"><a href="###">药事管理</a></h2>
        <h2 class="bank_tit8b"><a href="###">妇幼管理</a></h2>
     </div>
 </div>      
<!--　版权　开始 -->
<p id="closeDiv2" onclick="closed2()" style="display:none">默认入口↑</p>
<div id="notice">
    <div id="scrollDiv">
            <ul>
                <li><marquee>平台当前建档总数：1562372份，慢病管理人数：288678人，慢病随访记录：898723人次，接口调用次数：88273次，纳入平台管理机构数：323家。</marquee></li>
            </ul>
    </div>
</div>
    <div class="foot wap"><p class="foot_p1">四川省雅安市卫生局  <a href="###">雅安区域卫生信息平台</a></p></div>
<!--　版权　结束 -->
</body>
</html>
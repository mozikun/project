<?php /* Smarty version 2.6.14, created on 2013-07-23 10:58:22
         compiled from login_search.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 2.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml2.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>雅安市公众健康信息平台</title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/search/user_login.css" type="text/css" rel="stylesheet" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta content="mshtml 6.00.6000.16674" name="generator" />
<script>
function chk()
{
    if($("#username").val()=="")
    {
        alert("请输入姓名");
        $("#username").focus();
        return false;
    }
    if($("#card").val()=="")
    {
        alert("请输入身份证号码");
        $("#card").focus();
        return false;
    }
    if($("#pic").val()=="")
    {
        alert("请输入验证码");
        $("#pic").focus();
        return false;
    }
}
</script>
</head>
<body id="userlogin_body">
<form method="post" action="<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/search" onsubmit="return chk()">
<div id="user_login">
<dl>
  <dd id="user_top">
  <ul>
    <li class="user_top_l"></li>
    <li class="user_top_c"></li>
    <li class="user_top_r"></li></ul>
  <dd id="user_main">
  <ul>
    <li class="user_main_l"></li>
    <li class="user_main_c">
    <div class="user_main_box">
    <ul>
      <li class="user_main_text">姓名： </li>
      <li class="user_main_input"><input class="txtusernamecssclass" id="username" name="username" /> </li></ul>
    <ul>
      <li class="user_main_text">身份证： </li>
      <li class="user_main_input"><input class="txtpiccssclass" id="card" type="text" name="card" /></li>
    </ul>
    <ul>
      <li class="user_main_text">密码： </li>
      <li class="user_main_input"><input class="txtpasswordcssclass" id="password" type="password" name="password" /></li>
    </ul>
    <ul>
      <li class="user_main_text">验证码： </li>
      <li class="user_main_input"><input class="txtvalidatecodecssclass" id="pic" type="text" name="pic" /><img src="<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/pic" id="image" align="absmiddle" style="cursor: pointer;"  onclick="document.getElementById('image').src = '<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/pic/sid/' + Math.random(); return false" /></li></ul></div></li>
    <li class="user_main_r">
    <input class="ibtnentercssclass" id="ibtnenter" style="border-top-width: 0px; border-left-width: 0px; border-bottom-width: 0px; border-right-width: 0px" type="image" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/search/user_botton.gif" name="ibtnenter" /> </li></ul>
  <dd id="user_bottom">
  <ul>
    <li class="user_bottom_l"></li>
    <li class="user_bottom_c" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mobile.gif" />点击发送短信验证码</li>
    <li class="user_bottom_r"></li>
    </ul>
  </dd>
</dl>
    </div>
    <span id="valrusername" style="display: none; color: red">sss</span>
<span id="valrpassword" style="display: none; color: red"></span>
<span id="valrvalidatecode" style="display: none; color: red"></span>
<div id="validationsummary1" style="display: none; color: red"></div>

<div></div>

</form>
</body>
</html>
<?php /* Smarty version 2.6.14, created on 2013-08-29 11:25:11
         compiled from doctorhome.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>消息列表</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<style>
	table
	{
		background:#ffffff;
	}
	.line
	{
		border-top:0px;
		border-left:0px;
		border-right:0px;
	}
</style>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" />
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>

</head>
<body>		
<table border="0" width="100%">
    <tr class="headbg">
    	<td colspan="3">
        	消息列表
        </td>
	</tr>
    <tr class="title">
    	<td>
        	发送者
        </td>
        <td>
        	未读信息条数
        </td>
		<td>
        	操作
        </td>
	</tr>
	<tbody id="info">
	<?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['r']):
?>
	 <tr id="">
	 	<td>
        	<?php echo $this->_tpl_vars['r']['name']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['r']['count']; ?>

        </td>
		<td>
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/chat/infoview/identity_number/<?php echo $this->_tpl_vars['r']['identity_number']; ?>
">与他交流</a>
        </td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	</tbody>
</table>
</body>
</html>
<script>
getuserinfo();
setInterval("getuserinfo()",5000)
//获取最新患者发来的消息
function getuserinfo(){
	$.ajax({
		type:"get",
		url:"<?php echo $this->_tpl_vars['basePath']; ?>
android/chat/getuserinfo",
		beforeSend:function(){
			$("#info").html("<tr><td colspan='3'>刷新中-<img src='<?php echo $this->_tpl_vars['basePath']; ?>
views/images/load.gif'/></td>");
		},
		dataType:"json",
		success:function(info){
			var obj="";
			for(var i=0;i<info.length;i++){
				obj+="<tr><td>"+info[i].name+"</td><td>"+info[i].count+"</td><td><a  target='new' href='<?php echo $this->_tpl_vars['basePath']; ?>
android/chat/chat/isdoctor/1/receiver_id/"+info[i].identity_number+"'>与他交流</a></td></tr>";
			}
			$("#info").html(obj);
		}
	});
}
</script>
	
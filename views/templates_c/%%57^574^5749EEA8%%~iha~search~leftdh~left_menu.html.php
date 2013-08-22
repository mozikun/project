<?php /* Smarty version 2.6.14, created on 2013-08-22 23:41:10
         compiled from left_menu.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
views/js/jquery-1.4.2.js"></script>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
views/styles/admincp.css" />
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
views/js/main.js" type="text/javascript"></script>

<script type="text/javascript">
function collapse_change(menucount)
{
	if($('#menu_' + menucount).is(":visible")) {
		$('#menu_' + menucount).hide();
		$('#menuimg_' + menucount).attr('src',"<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif");

	} else {
		$('#menu_' + menucount).show();
		$('#menuimg_' + menucount).attr('src',"<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_reduce.gif");
	}

}
function add_new_confirm(obj)
{
	if(confirm('是否确定增加新的记录？'))
	{
		toUrl(obj,'c');
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<style>
body,div{
    width: 100%;
    > width: 170px;
    font-size: 16px;
}
html, body {
    background-color: #f2fcfe;
}
td{
    font-size: 16px;
}
hr{
    border: 1px dotted #ccc;
}
</style>
</head>

<body>
<div id="iha" name="iha">
	<table border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		<tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian1" onclick="collapse_change(1)"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/group.png" border="0" style="height:20px;" />
		 健康档案信息</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_1" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(1);toUrl(this,'a');" /></a></span>
		 </td></tr>
		 <tbody id="menu_1" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="###" id="ian1_1" onclick="collapse_change(11);toUrl(this,'b');">基本信息</a></td></tr>
				 <tbody id="menu_11" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/main" id="ian1_1_1" target="mainFrame" onclick="toUrl(this,'c')">个人信息概况</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/family" id="ian1_1_2" target="mainFrame" onclick="toUrl(this,'c')">家庭信息概况</a></td></tr>

                     </table>
					 </td></tr>
				 </tbody>	
		 <tr><td><a href="###" id="ian1_2" onclick="collapse_change(12);toUrl(this,'b');">慢病自我监测</a></td></tr>
				 <tbody id="menu_12" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/blood" id="ian1_2_1" target="mainFrame" onclick="toUrl(this,'c')">血压监测</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/xt" id="ian1_2_2" target="mainFrame" onclick="toUrl(this,'c')">血糖监测</a></td></tr>
                     </table>
					 </td></tr>
				 </tbody>
        <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/tips" target="mainFrame" id="ian1_4" onclick="toUrl(this,'b');">近期提醒</a></td></tr>
        <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/tige" target="mainFrame" id="ian1_5" onclick="toUrl(this,'b');">体格检测</a></td></tr>
        <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/cd" target="mainFrame" id="ian1_6" onclick="toUrl(this,'b');">慢病情况</a></td></tr>
        <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/clinical" target="mainFrame" id="ian1_7" onclick="toUrl(this,'b');">疾病史</a></td></tr>
        <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/he" target="mainFrame" id="ian1_8" onclick="toUrl(this,'b');">健康教育</a></td></tr>
        <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/prescription" target="mainFrame" id="ian1_9" onclick="toUrl(this,'b');">健康教育处方</a></td></tr>
		 </table>
		 </td></tr>
		 </tbody>
	</table>
</div>

<div id="iha" name="iha">
	<table border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		<tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian2" onclick="collapse_change(2)"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/application_side_boxes.png" border="0" style="height:20px;" />
		 门诊住院信息</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_2" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(2);toUrl(this,'a');" /></a></span>
		 </td></tr>
		 <tbody id="menu_2" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
         <?php unset($this->_sections['mu']);
$this->_sections['mu']['name'] = 'mu';
$this->_sections['mu']['loop'] = is_array($_loop=$this->_tpl_vars['menu_url']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['mu']['show'] = true;
$this->_sections['mu']['max'] = $this->_sections['mu']['loop'];
$this->_sections['mu']['step'] = 1;
$this->_sections['mu']['start'] = $this->_sections['mu']['step'] > 0 ? 0 : $this->_sections['mu']['loop']-1;
if ($this->_sections['mu']['show']) {
    $this->_sections['mu']['total'] = $this->_sections['mu']['loop'];
    if ($this->_sections['mu']['total'] == 0)
        $this->_sections['mu']['show'] = false;
} else
    $this->_sections['mu']['total'] = 0;
if ($this->_sections['mu']['show']):

            for ($this->_sections['mu']['index'] = $this->_sections['mu']['start'], $this->_sections['mu']['iteration'] = 1;
                 $this->_sections['mu']['iteration'] <= $this->_sections['mu']['total'];
                 $this->_sections['mu']['index'] += $this->_sections['mu']['step'], $this->_sections['mu']['iteration']++):
$this->_sections['mu']['rownum'] = $this->_sections['mu']['iteration'];
$this->_sections['mu']['index_prev'] = $this->_sections['mu']['index'] - $this->_sections['mu']['step'];
$this->_sections['mu']['index_next'] = $this->_sections['mu']['index'] + $this->_sections['mu']['step'];
$this->_sections['mu']['first']      = ($this->_sections['mu']['iteration'] == 1);
$this->_sections['mu']['last']       = ($this->_sections['mu']['iteration'] == $this->_sections['mu']['total']);
?>
		 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/hislist/mid/<?php echo $this->_tpl_vars['menu_url'][$this->_sections['mu']['index']]['module_id']; ?>
" target="mainFrame" id="ian2_<?php echo $this->_sections['mu']['rownum']; ?>
" onclick="collapse_change(2<?php echo $this->_sections['mu']['rownum']; ?>
);toUrl(this,'b');"><?php echo $this->_tpl_vars['menu_url'][$this->_sections['mu']['index']]['module_name']; ?>
</a></td></tr>
         <?php endfor; endif; ?>
         <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/image/index" target="mainFrame" id="ian2_98" onclick="collapse_change(298);toUrl(this,'b');">影像资料</a></td></tr>
         <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/appointment" target="mainFrame" id="ian2_99" onclick="collapse_change(299);toUrl(this,'b');">预约挂号查询</a></td></tr>
		 </table>
		 </td></tr>
		 </tbody>
	</table>
</div>

<div id="iha_hd" name="iha_hd">
	<table border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		<tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian3" onclick="collapse_change(3)"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/order.png" border="0" style="height:20px;" />
		 互动交流</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_3" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(3);toUrl(this,'a');" /></a></span>
		 </td></tr>
		 <tbody id="menu_3" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
         <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/appointment" target="mainFrame" id="ian3_1" onclick="collapse_change(31);toUrl(this,'b');">预约挂号查询</a></td></tr>
         <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
web/ask/myquestion" target="mainFrame" id="ian3_2" onclick="collapse_change(32);toUrl(this,'b');">我的咨询</a></td></tr>
		 </table>
		 </td></tr>
		 </tbody>
	</table>
</div>

<div id="lougout">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian12" onclick="window.top.location.href='<?php echo $this->_tpl_vars['baseUrl']; ?>
loging/index/logout'"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/server_go.png" border="0" style="height:20px;" />
		 退出</a></span>
		 </td></tr>
	</table>
</div>
</body>
</html>
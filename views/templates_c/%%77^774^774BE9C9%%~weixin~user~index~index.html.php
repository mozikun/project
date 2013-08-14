<?php /* Smarty version 2.6.14, created on 2013-07-12 14:40:36
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>微信用户列表</title>
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
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>
</head>
<body>	
<table border="0" width="100%">
    <tr class="headbg">
    	<td colspan="8">
        	微信用户管理
        </td>
	</tr>
    <tr class="title">
    	<td>
        	顺序号
        </td>
        <td>
        	微信号
        </td>
        <td>
        	微信昵称
        </td>
        <td>
        	关注时间
        </td>
        <td>
        	角色
        </td>
		<td>
        	操作选项
        </td>
	</tr>
	<tbody id="user">
	<?php unset($this->_sections['user']);
$this->_sections['user']['name'] = 'user';
$this->_sections['user']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['user']['show'] = true;
$this->_sections['user']['max'] = $this->_sections['user']['loop'];
$this->_sections['user']['step'] = 1;
$this->_sections['user']['start'] = $this->_sections['user']['step'] > 0 ? 0 : $this->_sections['user']['loop']-1;
if ($this->_sections['user']['show']) {
    $this->_sections['user']['total'] = $this->_sections['user']['loop'];
    if ($this->_sections['user']['total'] == 0)
        $this->_sections['user']['show'] = false;
} else
    $this->_sections['user']['total'] = 0;
if ($this->_sections['user']['show']):

            for ($this->_sections['user']['index'] = $this->_sections['user']['start'], $this->_sections['user']['iteration'] = 1;
                 $this->_sections['user']['iteration'] <= $this->_sections['user']['total'];
                 $this->_sections['user']['index'] += $this->_sections['user']['step'], $this->_sections['user']['iteration']++):
$this->_sections['user']['rownum'] = $this->_sections['user']['iteration'];
$this->_sections['user']['index_prev'] = $this->_sections['user']['index'] - $this->_sections['user']['step'];
$this->_sections['user']['index_next'] = $this->_sections['user']['index'] + $this->_sections['user']['step'];
$this->_sections['user']['first']      = ($this->_sections['user']['iteration'] == 1);
$this->_sections['user']['last']       = ($this->_sections['user']['iteration'] == $this->_sections['user']['total']);
?>
	 <tr id="user_<?php echo $this->_tpl_vars['users'][$this->_sections['user']['index']]['js_uuid']; ?>
">
	 	<td>
        	<?php echo $this->_tpl_vars['users'][$this->_sections['user']['index']]['userid']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['users'][$this->_sections['user']['index']]['wx_username']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['users'][$this->_sections['user']['index']]['nickname']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['users'][$this->_sections['user']['index']]['add_time']; ?>

        </td>
        <td>
        	微信用户
        </td>
        
		<td>
       		 <?php if ($this->_tpl_vars['users'][$this->_sections['user']['index']]['fakeid']): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/user/send_single/id/<?php echo $this->_tpl_vars['users'][$this->_sections['user']['index']]['fakeid']; ?>
">发送信息</a><?php else: ?>&nbsp;<?php endif; ?>
		</td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="8">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="8">
        <a href="">+给选中用户发送信息</a>&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/user/send_all">+给所有用户群发信息</a>&nbsp;&nbsp;<?php echo $this->_tpl_vars['pager']; ?>

        </td>
	</tr>
	</tbody>
</table>
</body>
</html>
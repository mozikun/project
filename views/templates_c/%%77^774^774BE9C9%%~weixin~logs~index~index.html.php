<?php /* Smarty version 2.6.14, created on 2013-06-20 12:00:11
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>微信日志列表</title>
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
<form action="" id="search" method="post">
<table border="0" width="100%">
<tr><td>事件类型：<select name="event">
                          <option value="">请选择</option>
                          <?php $_from = $this->_tpl_vars['event']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                          <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['search']['wx_event'] == $this->_tpl_vars['k']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
                          <?php endforeach; endif; unset($_from); ?>
                          </select>&nbsp;&nbsp;<input type="submit" value="搜索" /></td></tr>
</table>
</form>		
<table border="0" width="100%">
    <tr class="headbg">
    	<td colspan="7">
        	微信日志管理
        </td>
	</tr>
    <tr class="title">
    	<td>
        	微信号
        </td>
        <td>
        	请求时间
        </td>
        <td>
        	响应
        </td>
        <td>
        	事件
        </td>
        <td>
        	消息内容
        </td>
		<td>
        	操作选项
        </td>
	</tr>
	<tbody id="log">
	<?php unset($this->_sections['log']);
$this->_sections['log']['name'] = 'log';
$this->_sections['log']['loop'] = is_array($_loop=$this->_tpl_vars['logs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['log']['show'] = true;
$this->_sections['log']['max'] = $this->_sections['log']['loop'];
$this->_sections['log']['step'] = 1;
$this->_sections['log']['start'] = $this->_sections['log']['step'] > 0 ? 0 : $this->_sections['log']['loop']-1;
if ($this->_sections['log']['show']) {
    $this->_sections['log']['total'] = $this->_sections['log']['loop'];
    if ($this->_sections['log']['total'] == 0)
        $this->_sections['log']['show'] = false;
} else
    $this->_sections['log']['total'] = 0;
if ($this->_sections['log']['show']):

            for ($this->_sections['log']['index'] = $this->_sections['log']['start'], $this->_sections['log']['iteration'] = 1;
                 $this->_sections['log']['iteration'] <= $this->_sections['log']['total'];
                 $this->_sections['log']['index'] += $this->_sections['log']['step'], $this->_sections['log']['iteration']++):
$this->_sections['log']['rownum'] = $this->_sections['log']['iteration'];
$this->_sections['log']['index_prev'] = $this->_sections['log']['index'] - $this->_sections['log']['step'];
$this->_sections['log']['index_next'] = $this->_sections['log']['index'] + $this->_sections['log']['step'];
$this->_sections['log']['first']      = ($this->_sections['log']['iteration'] == 1);
$this->_sections['log']['last']       = ($this->_sections['log']['iteration'] == $this->_sections['log']['total']);
?>
	 <tr id="log_<?php echo $this->_tpl_vars['logs'][$this->_sections['log']['index']]['js_uuid']; ?>
">
	 	<td>
        	<?php echo $this->_tpl_vars['logs'][$this->_sections['log']['index']]['weixin_id']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['logs'][$this->_sections['log']['index']]['add_time']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['logs'][$this->_sections['log']['index']]['reply']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['logs'][$this->_sections['log']['index']]['event']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['logs'][$this->_sections['log']['index']]['content']; ?>

        </td>
		<td>
       		 <a href="###" onclick="return del('<?php echo $this->_tpl_vars['logs'][$this->_sections['log']['index']]['uuid']; ?>
','<?php echo $this->_tpl_vars['logs'][$this->_sections['log']['index']]['js_uuid']; ?>
')">删除</a>
		</td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="6">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="6">
        	<?php echo $this->_tpl_vars['pager']; ?>

        </td>
	</tr>
	</tbody>
</table>
</body>
</html>
<script>
	function del(uuid,js_uuid)
	{
		if(confirm("确定要删除微信日志吗？"))
		{
			 $.ajax({
                    type: "get",
                    url: "<?php echo $this->_tpl_vars['basePath']; ?>
weixin/logs/delete/uuid/"+uuid,
                    dataType: "html",
                    data: "",
                    success: function(data){
                        if(data=="ok")
						{
							$("#log_"+js_uuid).hide();
							alert("删除微信日志成功");
						}
                        else
						{
							alert("删除失败，未知的错误");
						}
                        return false;
                    },
                    error: function(){
                        alert("服务器返回信息不完整，请重新点击删除");
                        return false;
                    }
                });
		}
		return false;
	}
</script>
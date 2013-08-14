<?php /* Smarty version 2.6.14, created on 2013-07-05 14:04:55
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>微信模块列表</title>
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
        	微信模块管理
        </td>
	</tr>
    <tr class="title">
        <td>
        	排序
        </td>
    	<td>
        	模块名称
        </td>
        <td>
        	模块代码
        </td>
        <td>
        	列表地址
        </td>
        <td>
        	处理地址
        </td>
        <td>
        	首页项
        </td>
		<td>
        	状态
        </td>
		<td>
        	操作选项
        </td>
	</tr>
	<tbody id="module">
	<?php unset($this->_sections['module']);
$this->_sections['module']['name'] = 'module';
$this->_sections['module']['loop'] = is_array($_loop=$this->_tpl_vars['modules']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['module']['show'] = true;
$this->_sections['module']['max'] = $this->_sections['module']['loop'];
$this->_sections['module']['step'] = 1;
$this->_sections['module']['start'] = $this->_sections['module']['step'] > 0 ? 0 : $this->_sections['module']['loop']-1;
if ($this->_sections['module']['show']) {
    $this->_sections['module']['total'] = $this->_sections['module']['loop'];
    if ($this->_sections['module']['total'] == 0)
        $this->_sections['module']['show'] = false;
} else
    $this->_sections['module']['total'] = 0;
if ($this->_sections['module']['show']):

            for ($this->_sections['module']['index'] = $this->_sections['module']['start'], $this->_sections['module']['iteration'] = 1;
                 $this->_sections['module']['iteration'] <= $this->_sections['module']['total'];
                 $this->_sections['module']['index'] += $this->_sections['module']['step'], $this->_sections['module']['iteration']++):
$this->_sections['module']['rownum'] = $this->_sections['module']['iteration'];
$this->_sections['module']['index_prev'] = $this->_sections['module']['index'] - $this->_sections['module']['step'];
$this->_sections['module']['index_next'] = $this->_sections['module']['index'] + $this->_sections['module']['step'];
$this->_sections['module']['first']      = ($this->_sections['module']['iteration'] == 1);
$this->_sections['module']['last']       = ($this->_sections['module']['iteration'] == $this->_sections['module']['total']);
?>
	 <tr id="module_<?php echo $this->_tpl_vars['modules'][$this->_sections['module']['index']]['js_uuid']; ?>
">
        <td>
        	<input type="text" name="ids[<?php echo $this->_tpl_vars['modules'][$this->_sections['module']['index']]['uuid']; ?>
][]" value="<?php echo $this->_tpl_vars['modules'][$this->_sections['module']['index']]['display']; ?>
" style="width: 50px;" />
        </td>
	 	<td>
        	<?php echo $this->_tpl_vars['modules'][$this->_sections['module']['index']]['module_name']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['modules'][$this->_sections['module']['index']]['module_code']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['modules'][$this->_sections['module']['index']]['list_url']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['modules'][$this->_sections['module']['index']]['api_url']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['modules'][$this->_sections['module']['index']]['is_index']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['modules'][$this->_sections['module']['index']]['status']; ?>

        </td>
		<td>
       		 <a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/module/edit/uuid/<?php echo $this->_tpl_vars['modules'][$this->_sections['module']['index']]['uuid']; ?>
">编辑</a>&nbsp;|&nbsp;<a href="###" onclick="return del('<?php echo $this->_tpl_vars['modules'][$this->_sections['module']['index']]['uuid']; ?>
','<?php echo $this->_tpl_vars['modules'][$this->_sections['module']['index']]['js_uuid']; ?>
')">删除</a>
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
        	&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/module/edit">+添加模块</a>&nbsp;&nbsp;<a href="###" onclick="save_display()">修改排序</a>&nbsp;&nbsp;<?php echo $this->_tpl_vars['pager']; ?>

        </td>
	</tr>
	</tbody>
</table>
</body>
</html>
<script>
	function del(uuid,js_uuid)
	{
		if(confirm("确定要删除微信模块吗？删除后，对应的请求将无法请求"))
		{
			 $.ajax({
                    type: "get",
                    url: "<?php echo $this->_tpl_vars['basePath']; ?>
weixin/module/delete/uuid/"+uuid,
                    dataType: "html",
                    data: "",
                    success: function(data){
                        if(data=="ok")
						{
							$("#module_"+js_uuid).hide();
							alert("删除微信模块成功");
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
    function save_display()
    {
        if(confirm("确定要保存当前排序吗?"))
		{
			 $.ajax({
                    type: "post",
                    url: "<?php echo $this->_tpl_vars['basePath']; ?>
weixin/module/display",
                    dataType: "html",
                    data: $("input[name^=ids]").serialize(),
                    success: function(data){
                        if(data=="ok")
						{
							alert("保存模块排序成功");
						}
                        else
						{
							alert("保存模块排序失败");
						}
                        return false;
                    },
                    error: function(){
                        alert("服务器返回信息不完整，请重新点击保存");
                        return false;
                    }
                });
		}
		return false;
    }
</script>
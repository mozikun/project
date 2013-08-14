<?php /* Smarty version 2.6.14, created on 2013-05-02 10:22:44
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>栏目列表</title>
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
    	<td colspan="3">
        	门户栏目管理(<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/sort/index">顶级栏目</a><?php unset($this->_sections['path']);
$this->_sections['path']['name'] = 'path';
$this->_sections['path']['loop'] = is_array($_loop=$this->_tpl_vars['path']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['path']['show'] = true;
$this->_sections['path']['max'] = $this->_sections['path']['loop'];
$this->_sections['path']['step'] = 1;
$this->_sections['path']['start'] = $this->_sections['path']['step'] > 0 ? 0 : $this->_sections['path']['loop']-1;
if ($this->_sections['path']['show']) {
    $this->_sections['path']['total'] = $this->_sections['path']['loop'];
    if ($this->_sections['path']['total'] == 0)
        $this->_sections['path']['show'] = false;
} else
    $this->_sections['path']['total'] = 0;
if ($this->_sections['path']['show']):

            for ($this->_sections['path']['index'] = $this->_sections['path']['start'], $this->_sections['path']['iteration'] = 1;
                 $this->_sections['path']['iteration'] <= $this->_sections['path']['total'];
                 $this->_sections['path']['index'] += $this->_sections['path']['step'], $this->_sections['path']['iteration']++):
$this->_sections['path']['rownum'] = $this->_sections['path']['iteration'];
$this->_sections['path']['index_prev'] = $this->_sections['path']['index'] - $this->_sections['path']['step'];
$this->_sections['path']['index_next'] = $this->_sections['path']['index'] + $this->_sections['path']['step'];
$this->_sections['path']['first']      = ($this->_sections['path']['iteration'] == 1);
$this->_sections['path']['last']       = ($this->_sections['path']['iteration'] == $this->_sections['path']['total']);
?>-><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/sort/index/uuid/<?php echo $this->_tpl_vars['path'][$this->_sections['path']['index']]['uuid']; ?>
"><?php echo $this->_tpl_vars['path'][$this->_sections['path']['index']]['sortname']; ?>
</a><?php endfor; endif; ?>)
        </td>
	</tr>
    <tr class="title">
    	<td>
        	栏目标题
        </td>
		<td>
        	栏目拼音
        </td>
		<td>
        	操作选项
        </td>
	</tr>
	<tbody id="sort">
	<?php unset($this->_sections['sort']);
$this->_sections['sort']['name'] = 'sort';
$this->_sections['sort']['loop'] = is_array($_loop=$this->_tpl_vars['sort']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sort']['show'] = true;
$this->_sections['sort']['max'] = $this->_sections['sort']['loop'];
$this->_sections['sort']['step'] = 1;
$this->_sections['sort']['start'] = $this->_sections['sort']['step'] > 0 ? 0 : $this->_sections['sort']['loop']-1;
if ($this->_sections['sort']['show']) {
    $this->_sections['sort']['total'] = $this->_sections['sort']['loop'];
    if ($this->_sections['sort']['total'] == 0)
        $this->_sections['sort']['show'] = false;
} else
    $this->_sections['sort']['total'] = 0;
if ($this->_sections['sort']['show']):

            for ($this->_sections['sort']['index'] = $this->_sections['sort']['start'], $this->_sections['sort']['iteration'] = 1;
                 $this->_sections['sort']['iteration'] <= $this->_sections['sort']['total'];
                 $this->_sections['sort']['index'] += $this->_sections['sort']['step'], $this->_sections['sort']['iteration']++):
$this->_sections['sort']['rownum'] = $this->_sections['sort']['iteration'];
$this->_sections['sort']['index_prev'] = $this->_sections['sort']['index'] - $this->_sections['sort']['step'];
$this->_sections['sort']['index_next'] = $this->_sections['sort']['index'] + $this->_sections['sort']['step'];
$this->_sections['sort']['first']      = ($this->_sections['sort']['iteration'] == 1);
$this->_sections['sort']['last']       = ($this->_sections['sort']['iteration'] == $this->_sections['sort']['total']);
?>
	 <tr id="sort_<?php echo $this->_tpl_vars['sort'][$this->_sections['sort']['index']]['js_uuid']; ?>
">
	 	<td>
        	<?php echo $this->_tpl_vars['sort'][$this->_sections['sort']['index']]['sortname']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['sort'][$this->_sections['sort']['index']]['sortname_py']; ?>

        </td>
		<td>
       		 <a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/sort/index/uuid/<?php echo $this->_tpl_vars['sort'][$this->_sections['sort']['index']]['uuid']; ?>
">查看下一级</a>&nbsp;|&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/sort/edit/uuid/<?php echo $this->_tpl_vars['sort'][$this->_sections['sort']['index']]['uuid']; ?>
">编辑</a>&nbsp;|&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/sort/edit/pid/<?php echo $this->_tpl_vars['sort'][$this->_sections['sort']['index']]['uuid']; ?>
">添加子分类</a>&nbsp;|&nbsp;<a href="###" onclick="return del('<?php echo $this->_tpl_vars['sort'][$this->_sections['sort']['index']]['uuid']; ?>
','<?php echo $this->_tpl_vars['sort'][$this->_sections['sort']['index']]['js_uuid']; ?>
')">删除</a>
		</td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="3">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="3">
        	&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/sort/edit/pid/<?php echo $this->_tpl_vars['current_id']; ?>
">+添加栏目</a>
        </td>
	</tr>
	</tbody>
</table>
</body>
</html>
<script>
	function del(uuid,js_uuid)
	{
		if(confirm("确定要删除本栏目吗？"))
		{
			 $.ajax({
                    type: "get",
                    url: "<?php echo $this->_tpl_vars['basePath']; ?>
web/sort/delete/uuid/"+uuid,
                    dataType: "html",
                    data: "",
                    success: function(data){
                        if(data=="ok")
						{
							$("#sort_"+js_uuid).hide();
							alert("删除栏目成功");
						}
						else if(data=='article')
                        {
                            alert("该栏目下已发布文章，不能被删除");
                        }
                        else if(data=='sort')
                        {
                            alert("该栏目存在子栏目，不能被删除");
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
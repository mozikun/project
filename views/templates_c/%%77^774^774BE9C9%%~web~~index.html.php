<?php /* Smarty version 2.6.14, created on 2013-07-23 17:04:43
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>文章列表</title>
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
<tr><td>标题：<input type="text" name="title" value="<?php echo $this->_tpl_vars['search']['title']; ?>
" class="line" size="25" />&nbsp;&nbsp;栏目：<select name="sort">
                          <option value="">请选择</option>
                          <?php unset($this->_sections['sorts']);
$this->_sections['sorts']['name'] = 'sorts';
$this->_sections['sorts']['loop'] = is_array($_loop=$this->_tpl_vars['sorts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sorts']['show'] = true;
$this->_sections['sorts']['max'] = $this->_sections['sorts']['loop'];
$this->_sections['sorts']['step'] = 1;
$this->_sections['sorts']['start'] = $this->_sections['sorts']['step'] > 0 ? 0 : $this->_sections['sorts']['loop']-1;
if ($this->_sections['sorts']['show']) {
    $this->_sections['sorts']['total'] = $this->_sections['sorts']['loop'];
    if ($this->_sections['sorts']['total'] == 0)
        $this->_sections['sorts']['show'] = false;
} else
    $this->_sections['sorts']['total'] = 0;
if ($this->_sections['sorts']['show']):

            for ($this->_sections['sorts']['index'] = $this->_sections['sorts']['start'], $this->_sections['sorts']['iteration'] = 1;
                 $this->_sections['sorts']['iteration'] <= $this->_sections['sorts']['total'];
                 $this->_sections['sorts']['index'] += $this->_sections['sorts']['step'], $this->_sections['sorts']['iteration']++):
$this->_sections['sorts']['rownum'] = $this->_sections['sorts']['iteration'];
$this->_sections['sorts']['index_prev'] = $this->_sections['sorts']['index'] - $this->_sections['sorts']['step'];
$this->_sections['sorts']['index_next'] = $this->_sections['sorts']['index'] + $this->_sections['sorts']['step'];
$this->_sections['sorts']['first']      = ($this->_sections['sorts']['iteration'] == 1);
$this->_sections['sorts']['last']       = ($this->_sections['sorts']['iteration'] == $this->_sections['sorts']['total']);
?>
                          <option value="<?php echo $this->_tpl_vars['sorts'][$this->_sections['sorts']['index']]['uuid']; ?>
" <?php if ($this->_tpl_vars['search']['sort_id'] == $this->_tpl_vars['sorts'][$this->_sections['sorts']['index']]['uuid']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['sorts'][$this->_sections['sorts']['index']]['sortname']; ?>
</option>
                          <?php endfor; endif; ?>
                          </select>&nbsp;&nbsp;<input type="submit" value="搜索" /></td></tr>
</table>
</form>		
<table border="0" width="100%">
    <tr class="headbg">
    	<td colspan="7">
        	文章管理
        </td>
	</tr>
    <tr class="title">
    	<td>
        	标题
        </td>
        <td>
        	栏目
        </td>
		<td>
        	发布人
        </td>
        <td>
        	发布机构
        </td>
        <td>
        	修改时间
        </td>
        <td>
        	查看次数
        </td>
		<td>
        	操作选项
        </td>
	</tr>
	<tbody id="article">
	<?php unset($this->_sections['article']);
$this->_sections['article']['name'] = 'article';
$this->_sections['article']['loop'] = is_array($_loop=$this->_tpl_vars['articles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['article']['show'] = true;
$this->_sections['article']['max'] = $this->_sections['article']['loop'];
$this->_sections['article']['step'] = 1;
$this->_sections['article']['start'] = $this->_sections['article']['step'] > 0 ? 0 : $this->_sections['article']['loop']-1;
if ($this->_sections['article']['show']) {
    $this->_sections['article']['total'] = $this->_sections['article']['loop'];
    if ($this->_sections['article']['total'] == 0)
        $this->_sections['article']['show'] = false;
} else
    $this->_sections['article']['total'] = 0;
if ($this->_sections['article']['show']):

            for ($this->_sections['article']['index'] = $this->_sections['article']['start'], $this->_sections['article']['iteration'] = 1;
                 $this->_sections['article']['iteration'] <= $this->_sections['article']['total'];
                 $this->_sections['article']['index'] += $this->_sections['article']['step'], $this->_sections['article']['iteration']++):
$this->_sections['article']['rownum'] = $this->_sections['article']['iteration'];
$this->_sections['article']['index_prev'] = $this->_sections['article']['index'] - $this->_sections['article']['step'];
$this->_sections['article']['index_next'] = $this->_sections['article']['index'] + $this->_sections['article']['step'];
$this->_sections['article']['first']      = ($this->_sections['article']['iteration'] == 1);
$this->_sections['article']['last']       = ($this->_sections['article']['iteration'] == $this->_sections['article']['total']);
?>
	 <tr id="article_<?php echo $this->_tpl_vars['article'][$this->_sections['article']['index']]['js_uuid']; ?>
">
	 	<td>
        	<?php echo $this->_tpl_vars['articles'][$this->_sections['article']['index']]['title_cutstr']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['articles'][$this->_sections['article']['index']]['sortname']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['articles'][$this->_sections['article']['index']]['staff_id']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['articles'][$this->_sections['article']['index']]['org_id']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['articles'][$this->_sections['article']['index']]['updated']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['articles'][$this->_sections['article']['index']]['views']; ?>

        </td>
		<td>
       		 <a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/index/view/uuid/<?php echo $this->_tpl_vars['articles'][$this->_sections['article']['index']]['uuid']; ?>
">预览</a>&nbsp;|&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/index/edit/uuid/<?php echo $this->_tpl_vars['articles'][$this->_sections['article']['index']]['uuid']; ?>
">编辑</a>&nbsp;|&nbsp;<a href="###" onclick="return del('<?php echo $this->_tpl_vars['articles'][$this->_sections['article']['index']]['uuid']; ?>
','<?php echo $this->_tpl_vars['articles'][$this->_sections['article']['index']]['js_uuid']; ?>
')">删除</a>
		</td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="7">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="7">
        	&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/index/edit">+添加文章</a>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['pager']; ?>

        </td>
	</tr>
	</tbody>
</table>
</body>
</html>
<script>
	function del(uuid,js_uuid)
	{
		if(confirm("确定要删除本篇文章吗？"))
		{
			 $.ajax({
                    type: "get",
                    url: "<?php echo $this->_tpl_vars['basePath']; ?>
web/index/delete/uuid/"+uuid,
                    dataType: "html",
                    data: "",
                    success: function(data){
                        if(data=="ok")
						{
							$("#article_"+js_uuid).hide();
							alert("删除文章成功");
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
<?php /* Smarty version 2.6.14, created on 2013-11-04 11:31:55
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<title>接口模块列表</title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" media="all" type="text/css" rel="stylesheet"/>
<style>
table
	{
		background:#ffffff;
	}
.table_mouseover{
	background:#cccccc;
}
.table_mouseout{
	background:#ffffff;
}
.bigfont{
    background:#DAE6F3;
}
a{
	text-decoration:none;
}
</style>
</head>
<body>
<table width="100%" align="center">
   <tr class="headbg">
    <td width="14%"><strong>模块代码</strong></td>
	<td><strong>模块名称</strong></td>
	<td><strong>创建者</strong></td>
	<td><strong>创建时间</strong></td>
	<td><strong>排序号</strong></td>
	<td><strong>模板路径</strong></td>
	<td width="14%"><strong>操作</strong></td>
   </tr>
   <?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['r']):
?>
   <tr>
    <td width="14%"><?php echo $this->_tpl_vars['r']['module_id']; ?>
</td>
	<td><?php echo $this->_tpl_vars['r']['module_name']; ?>
</td>
	<td><?php echo $this->_tpl_vars['r']['staff']; ?>
</td>
	<td><?php echo $this->_tpl_vars['r']['created']; ?>
</td>
	<td><?php echo $this->_tpl_vars['r']['order_by']; ?>
</td>
	<td><?php echo $this->_tpl_vars['r']['xml']; ?>
</td>
	
	<td width="14%"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/manage/edit/uuid/<?php echo $this->_tpl_vars['r']['uuid']; ?>
/currentpage/<?php echo $this->_tpl_vars['pageCurrent']; ?>
/module_search/<?php echo $this->_tpl_vars['module_id']; ?>
/table_search/<?php echo $this->_tpl_vars['table_name']; ?>
">[编辑]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="#" onclick="del('<?php echo $this->_tpl_vars['r']['uuid']; ?>
')">[删除]</a></td>
   </tr>
   
   <?php endforeach; endif; unset($_from); ?>
	<tr>
	 <td colspan="7" align="left" width="100%">
		<a href="<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/manage/add">[添加]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['page']; ?>

	 </td>
	</tr>
	<script  language="javascript">
           function del(id)
		   {   
		      if(confirm('您确定删除吗?请谨慎操作')){
			   $.get("<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/manage/del/id/"+id,function(data){
				   alert(data);

				   window.location='<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/manage/index';
			   });
			  }
			   }
        </script>
</table>
</body>
<?php /* Smarty version 2.6.14, created on 2013-07-05 14:05:22
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>微信智能问题列表</title>
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
        .title1 td{
            font-weight: bold;
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

<div>
	<form method="post" action="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/ask/list" >
	按关键字查找:<input type='text' name='s_keywords' value="<?php echo $this->_tpl_vars['s_keywords']; ?>
" >&nbsp;
	按问题查找:<input type='text' name='s_question' value="<?php echo $this->_tpl_vars['s_question']; ?>
"  size="30">
	<input type="submit" value="搜索"   />
	</form>
</div>
	
<table border="0" width="100%">
    <tr class="headbg">
    	<td colspan="6">
        	微信问答管理
        </td>
	</tr>
    <tr class="title1">
    	<td style="width:300px;">
        	问题
        </td>
        <td style="width:400px;">
        	答案
        </td>
        <td style="width:60px;">
        	关键字
        </td>
          <td style="width:60px;">
        	是否启用
          </td>      
         <td style="width:60px;">
       
        	是否公开
         </td>       
          <td style="width:60px;">
        	操作选项
        </td>
	</tr>
	<tbody id="ask">
	<?php if ($this->_tpl_vars['result']): ?>
	<?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ask']):
?>
	 <tr id="tr_<?php echo $this->_tpl_vars['ask']['id']; ?>
">
	 	<td>
        	<?php echo $this->_tpl_vars['ask']['question']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['ask']['answer']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['ask']['keywords']; ?>

        </td>
        <td>
        	<?php if ($this->_tpl_vars['ask']['isactive'] == 1): ?>是<?php else: ?>否<?php endif; ?>
        </td>
        <td>
        	<?php if ($this->_tpl_vars['ask']['ispublic'] == 1): ?>是<?php else: ?>否<?php endif; ?>
        </td>
       
		<td>
       		 <a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/ask/edit/id/<?php echo $this->_tpl_vars['ask']['id']; ?>
">编辑</a>&nbsp;|&nbsp;<a href="###" onclick="return del('<?php echo $this->_tpl_vars['ask']['id']; ?>
')">删除</a>
		</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<?php else: ?>
	<tr>
		<td colspan="6">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="6">
        	&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/ask/edit">+添加问题</a>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['page']; ?>

        </td>
	</tr>
	</tbody>
</table>
</body>
</html>
<script>
	function del(id)
	{	
	     
		if(confirm("确定要删除该问题吗？"))
		{
			 $.ajax({
                    type: "get",
                    url: "<?php echo $this->_tpl_vars['basePath']; ?>
weixin/ask/delete/id/"+id,
                    dataType: "html",
                    data: "",
                    success: function(data){ 
                        if(data=="ok")
						{
							$("#tr_"+id).hide();
							alert("删除问题成功");
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
<?php /* Smarty version 2.6.14, created on 2013-05-02 09:52:57
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>接口概要列表</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<style type="text/css">
table
{
	background:#ffffff;
}
.table_mouseover{
	background:#cccccc;
}
.table_mouseout{
	background:#ffffff;
	text-align:center;
}
.inputbutton{
border: 1px solid blue;
width:80px;
background:#FFFFFF;
}
</style>
</head>
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
		<th title="姓名" >
			姓名
        </th>
        <th title="性别">
      	    性别
        </th>            
          <th title="身份证号">
      	    身份证号
        </th>        
        <th title="文档时间">
      	    文档时间
        </th>
        <th title="详细">
			详细
        </th>
		
	</tr>
	</thead>
	<tbody >
	 <?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
	 <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'" class="lista">
		<td>
        	<?php echo $this->_tpl_vars['i']['name']; ?>

        </td>   
		<td>
            <?php echo $this->_tpl_vars['i']['sex']; ?>

        </td>		
        <td>
            <?php echo $this->_tpl_vars['i']['identity_card']; ?>

        </td>		
        <td>
            <?php echo $this->_tpl_vars['i']['document_time']; ?>

        </td>       
         <td>
            <a  target="new " href="<?php echo $this->_tpl_vars['basePath']; ?>
his/apisummary/detail/uuid/<?php echo $this->_tpl_vars['i']['uuid']; ?>
">查看详细</>
        </td>

	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<?php if (! $this->_tpl_vars['rows']): ?>
	<tr><td colspan='5' style="color:red">暂无信息!</td></tr>
	<?php endif; ?>
	  <tr>
	  <td colspan="5" align="center"> 
        <?php echo $this->_tpl_vars['page']; ?>
<button  onclick="history.go(-1);">返回</button>
	 </td>
	</tr>
	</tbody>
</table>

</body>
</html>
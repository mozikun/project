<?php /* Smarty version 2.6.14, created on 2013-05-02 09:40:23
         compiled from index.html */ ?>
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
td,th{
text-align:left;
}
</style>
</head>
<table border="0" width="100%">
    <tr><th colspan='2' align='left'>
		<?php $_from = $this->_tpl_vars['path_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
			<a href="<?php if ($this->_tpl_vars['p']['show'] == 1):  echo $this->_tpl_vars['basePath']; ?>
his/apisummary/index/p_id/<?php echo $this->_tpl_vars['p']['path_id']; ?>
/mid/<?php echo $this->_tpl_vars['mid'];  else: ?>#<?php endif; ?>"><span <?php if ($this->_tpl_vars['current_path_id'] == $this->_tpl_vars['p']['path_id']): ?>style="color:red" <?php endif; ?>><?php echo $this->_tpl_vars['p']['path_name']; ?>
></span></a>
		<?php endforeach; endif; unset($_from); ?>	
	</th></tr>
	<?php if ($this->_tpl_vars['region_arr']): ?>
    <tr class="headbg">
	
		<th  >
			地区名称
        </th>
		
        <th >
      	  下级地区 
        </th>            
          
	</tr>
	<?php endif; ?>
	<tbody >
	<?php if ($this->_tpl_vars['region_arr']): ?>
	 <?php $_from = $this->_tpl_vars['region_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
	 <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'" class="lista">
		<td>
        	<?php echo $this->_tpl_vars['i']['region_name']; ?>

        </td>         
         <td>
            <a   href="<?php echo $this->_tpl_vars['basePath']; ?>
his/apisummary/index/p_id/<?php echo $this->_tpl_vars['i']['region_id']; ?>
/mid/<?php echo $this->_tpl_vars['mid']; ?>
">[进入下级地区]</>
        </td>       
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	
	<?php endif; ?>
	<?php if ($this->_tpl_vars['org_arr']): ?>
	<tr class="headbg">
		<th  >
			当前地区下的机构
        </th>
        <th >
      	  电子病历
        </th>            
          
	</tr>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['org_arr']): ?>
	 <?php $_from = $this->_tpl_vars['org_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
	 <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'" class="lista">
		<td>
        	<?php echo $this->_tpl_vars['i']['org_name']; ?>

        </td>         
         <td>
            <a   href="<?php echo $this->_tpl_vars['basePath']; ?>
his/apisummary/list/mid/<?php echo $this->_tpl_vars['mid']; ?>
/org_id/<?php echo $this->_tpl_vars['i']['org_id']; ?>
">[查看电子病历]</>
        </td>       
	</tr>
	<?php endforeach; endif; unset($_from); ?>	
	 <?php endif; ?>
	</tbody>
</table>

</body>
</html>
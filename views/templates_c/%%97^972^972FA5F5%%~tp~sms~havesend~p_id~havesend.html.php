<?php /* Smarty version 2.6.14, created on 2013-08-08 09:28:32
         compiled from havesend.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en" />
<meta name="GENERATOR" content="Zend Studio" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/popup.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
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
</style> 
<title>地区列表</title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" media="all" type="text/css" rel="stylesheet"/>
</head>
<body>
<table border="1px" align="center" width="100%" >
     <tr class="bigfont">
     	<td colspan='<?php if ($this->_tpl_vars['hide'] == 1):  echo $this->_tpl_vars['type_num']+1;  else:  echo $this->_tpl_vars['type_num']+2;  endif; ?>'></td>
     </tr>
     <tr class="bigfont">
    <td colspan='<?php if ($this->_tpl_vars['hide'] == 1):  echo $this->_tpl_vars['type_num']+1;  else:  echo $this->_tpl_vars['type_num']+2;  endif; ?>'>
         <form action="" method="POST">
            时间：<input type="text" onClick="WdatePicker({firstDayOfWeek:1})" class="" name="start_time" value="<?php echo $this->_tpl_vars['start_time']; ?>
"/> -
            <input type="text" onClick="WdatePicker({firstDayOfWeek:1})" class="" name="end_time" value="<?php echo $this->_tpl_vars['end_time']; ?>
"/>          <input type="submit" value="搜索" value="okok" />
         </form>
       </td>
     </tr>
	 <!-- 面包屑导航 -->
     <tr class="headbg">
		<td colspan='<?php if ($this->_tpl_vars['hide'] == 1):  echo $this->_tpl_vars['type_num']+1;  else:  echo $this->_tpl_vars['type_num']+2;  endif; ?>'><?php $_from = $this->_tpl_vars['path']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?><b><a href="<?php echo $this->_tpl_vars['basePath']; ?>
tp/sms/havesend/p_id/<?php echo $this->_tpl_vars['p']['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
"<?php if ($this->_tpl_vars['p']['region_id'] == $this->_tpl_vars['current_id']): ?>style="color:red"<?php endif; ?>><?php echo $this->_tpl_vars['p']['zh_name']; ?>
></a></b><?php endforeach; endif; unset($_from); ?></td>
     </tr>
     <tr class="bigfont">
        <td width="8%"><strong>地区名称</strong></td>
	    <?php $_from = $this->_tpl_vars['tips_type_names']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['names']):
?>
		<td><?php echo $this->_tpl_vars['names']; ?>
</td>
	    <?php endforeach; endif; unset($_from); ?>
       <?php if ($this->_tpl_vars['hide'] != 1): ?><td >查看下级地区</td><?php endif; ?>
     </tr>
       <?php echo $this->_tpl_vars['msg']; ?>

     <?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['res']):
?>
        <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
           <td><?php echo $this->_tpl_vars['res']['region_name']; ?>
</td>
		   <?php $_from = $this->_tpl_vars['res']['num']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['num']):
?>
		   <td><?php echo $this->_tpl_vars['num']; ?>
</td>
		   <?php endforeach; endif; unset($_from); ?>
           <?php if ($this->_tpl_vars['hide'] != 1): ?><td ><a href="<?php echo $this->_tpl_vars['basePath']; ?>
tp/sms/havesend/p_id/<?php echo $this->_tpl_vars['res']['region_id']; ?>
/url_start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/url_end_time/<?php echo $this->_tpl_vars['end_time']; ?>
">[进入子地区]</a>
           </td><?php endif; ?>
        </tr>
     <?php endforeach; endif; unset($_from); ?>
       
      
</table>
     <div id="errorMessage" style="display:none"><?php echo $this->_tpl_vars['errorMessage']; ?>
</div>
</body>
</html>


<script type="text/javascript">
function myOpenWindow(id){
	var url="<?php echo $this->_tpl_vars['basePath']; ?>
region/region/display/id/"+id+'/sid/'+Math.random();
	//alert(url);
	window.showModalDialog(url,window,'DialogTop:250px;DialogLeft:250px;DialogWidth:650px;DialogHeight:250px;help:no;status:no');
}
function mysubmit(){
	if($('#region_name').val()==''){
		alert('请输入地区名称');
		return;
	}
	if($('#standard_code').val()==''){
		alert('请输入标准码');
		return;
	}	
	$('#ok').attr('disabled',true);
	$('#popup')[0].submit();
	return true;
}
if($('#errorMessage').html()!=''){
	alert($('#errorMessage').html());
}
</script>

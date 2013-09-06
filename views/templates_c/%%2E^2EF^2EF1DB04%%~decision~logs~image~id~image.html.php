<?php /* Smarty version 2.6.14, created on 2013-09-03 14:14:14
         compiled from image.html */ ?>
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
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js"></script>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<script language="javascript">AC_FL_RunContent = 0;</script>
		<script language="javascript"> DetectFlashVer = 0; </script>
		<script src="<?php echo $this->_tpl_vars['basePath']; ?>
library/charts/AC_RunActiveContent.js" language="javascript"></script>
		<script language="JavaScript" type="text/javascript">
		<!--
		var requiredMajorVersion = 10;
		var requiredMinorVersion = 0;
		var requiredRevision = 45;
		-->
		</script>
		<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/xml_charts.js" type="text/javascript"></script>
		<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/decision_list.js" type="text/javascript"></script>
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
<title>接口日志综合统计</title>
</head>
<body>
     <table border="1px" align="center" width="100%">
     <tr class="bigfont" >
       <td colspan="2" style="text-align:center;"><strong>接口日志统计<?php echo $this->_tpl_vars['start_time']; ?>
至<?php echo $this->_tpl_vars['end_time']; ?>
</strong></td>
     </tr>
     <tr class="bigfont">     
        <td  colspan="2">
        <form name='form1' method="POST" action="<?php echo $this->_tpl_vars['basePath']; ?>
decision/logs/image">
        <input type='text' name='start_time' id='start_time' value='<?php echo $this->_tpl_vars['start_time']; ?>
' length='' onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',maxDate:'#F{$dp.$D(\'end_time\')}'})"   class="Wdate" />
        至<input type='text' name='end_time' id='end_time' value='<?php echo $this->_tpl_vars['end_time']; ?>
' length='' onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'#F{$dp.$D(\'start_time\')}'})"   class="Wdate" />
        <input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
        <input type="hidden" id="model" name="model" value="<?php echo $this->_tpl_vars['model']; ?>
" />
        <input type="hidden" id="type" name="type" value="<?php echo $this->_tpl_vars['type']; ?>
" />
        <input type="submit" value="查询"><input type="button" class="inputbutton" onclick="javascript:window.location='<?php echo $this->_tpl_vars['basePath']; ?>
decision/logs/index/parent_id/<?php echo $this->_tpl_vars['p_id']; ?>
/model/<?php echo $this->_tpl_vars['model']; ?>
/type/<?php echo $this->_tpl_vars['type']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['end_time']; ?>
'" value="返回"/>
        </form>
        </td>
     </tr>
     <tr class="columnbg">     
        <td width="10%" ><strong></strong></td>
        <td width="90%" style="text-align:center"><strong>地区：<?php echo $this->_tpl_vars['region_name']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;模块：<?php $_from = $this->_tpl_vars['model_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
 if ($this->_tpl_vars['model'] == $this->_tpl_vars['k']):  echo $this->_tpl_vars['v'];  endif;  endforeach; endif; unset($_from); ?></strong></td>
     </tr>
      <?php if ($this->_tpl_vars['nuNumber'] == ""): ?>
      <tr align="center"><td colspan="2">当前没有任何数据!</a></td></tr>
      <?php else: ?>    
        <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">          
           <td >
           饼状图
           </td>
           <td >
           <script language="JavaScript" type="text/javascript">
				show_chart("<?php echo $this->_tpl_vars['basePath']; ?>
decision/logs/imagedata/id/<?php echo $this->_tpl_vars['id']; ?>
/model/<?php echo $this->_tpl_vars['model']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
","<?php echo $this->_tpl_vars['basePath']; ?>
",800,300,"chart_bar");
			</script>
			</td>
            </td>
        </tr>
        <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">         
           <td >
           柱状图
           </td>
           <td >
          <script language="JavaScript" type="text/javascript">
				show_chart("<?php echo $this->_tpl_vars['basePath']; ?>
decision/logs/imagedata/id/<?php echo $this->_tpl_vars['id']; ?>
/model/<?php echo $this->_tpl_vars['model']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
/token/1","<?php echo $this->_tpl_vars['basePath']; ?>
",800,300,"chart_line");
			</script>
			</td>
            </td>
        </tr>       
     <?php endif; ?>
     <tr align="center">
       <td colspan="2" ><input type="button" class="inputbutton" onclick="javascript:window.location='<?php echo $this->_tpl_vars['basePath']; ?>
decision/logs/index/parent_id/<?php echo $this->_tpl_vars['p_id']; ?>
/model/<?php echo $this->_tpl_vars['model']; ?>
/type/<?php echo $this->_tpl_vars['type']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['end_time']; ?>
'" value="返回"/></td>
     </tr>
     </table>
</body>
</html>
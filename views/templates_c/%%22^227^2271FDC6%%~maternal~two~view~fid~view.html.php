<?php /* Smarty version 2.6.14, created on 2013-05-06 10:32:25
         compiled from view.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/health.css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/experience_table.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>
<script>
	function rt()
	{
		window.location="<?php echo $this->_tpl_vars['basePath']; ?>
maternal/two/list/id/<?php echo $this->_tpl_vars['userid']; ?>
";
	}
	function del(url)
	{
		if(confirm("确定要删除本条记录吗？本操作删除的数据将无法恢复！"))
		{
			window.location=url;
		}
	}
	$(document).ready(function(){$("input[type='text']").attr("disabled",true);});
</script> 
<title>第2~5次产前随访服务记录表</title>
<style>
.STYLE1 {font-weight: bold}
.STYLE2 {font-weight: bold}
label
{
	cursor:hand;
	cursor: pointer;
}
</style>
</head>
<body > 
   <div class="STYLE1" style="background:#FFFFFF; text-align:center; width:100%;font-size: 16px;
	font-weight: bold;">第2~5次产前随访服务记录表</div>
   <div  style=" text-align:center; width:100%; "><input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
"/>
      <div  style=" width:80%; text-align:left; float:left;background:#FFFFFF;"><strong>姓名</strong>：<?php echo $this->_tpl_vars['user_name']; ?>
</div>
	  <div style=" width:20%; text-align:left; float:left;background:#FFFFFF;"><strong>编号</strong>：<?php echo $this->_tpl_vars['standard_code']; ?>
</div>
   </div>
<table width="100%"  align="center" cellpadding="" cellspacing="">
    <tr>
		<td colspan="2">随访次数(第2-5次)</td>
		<?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
	    <td>

			第<?php echo $this->_tpl_vars['k']; ?>
次产前随访
		</td>
		<?php endforeach; endif; unset($_from); ?>
   	</tr>
   	<tr>
		<td colspan="2">随访日期</td>
	    <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?><td><?php echo $this->_tpl_vars['v']['follow_time']; ?>
</td><?php endforeach; endif; unset($_from); ?>
   	</tr>
   	<tr>
		<td colspan="2">孕周(周)</td>
	    <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?><td><?php echo $this->_tpl_vars['v']['gestational_weeks']; ?>
</td><?php endforeach; endif; unset($_from); ?>
   	</tr>
   	<tr>
		<td colspan="2">主诉</td>
		<?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
	    <td>
		  <?php echo $this->_tpl_vars['v']['subject_description']; ?>

		</td>
		<?php endforeach; endif; unset($_from); ?>
   	</tr>
   	<tr>
		<td colspan="2">体重(kg)</td>
		<?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
	    <td>
		  <?php echo $this->_tpl_vars['v']['weight']; ?>

		</td>
		<?php endforeach; endif; unset($_from); ?>
   	</tr>
   	<tr>
   	  <td rowspan="4">产科检查</td>
   	  <td>宫底高度(cm)</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
   	  <td><?php echo $this->_tpl_vars['v']['fundal_height']; ?>
</td>
	  <?php endforeach; endif; unset($_from); ?>
   	</tr>
   	<tr>
   	  <td>腹围(cm)</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
   	  <td><?php echo $this->_tpl_vars['v']['abdomen_circumference']; ?>
</td>
   	 <?php endforeach; endif; unset($_from); ?>
	</tr>
    <tr>
   	  <td>胎位</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
   	  <td><?php echo $this->_tpl_vars['v']['fetal_position']; ?>
</td>
   	 <?php endforeach; endif; unset($_from); ?>
	</tr>
   	<tr>
   	  <td>胎心率(次/分钟)</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
   	  <td><?php echo $this->_tpl_vars['v']['heart_rate']; ?>
</td>
   	<?php endforeach; endif; unset($_from); ?>
	</tr>
    <tr>
   	  <td colspan="2">血压(mmHg)</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
   	  <td><?php echo $this->_tpl_vars['v']['systolic_blood_pressure']; ?>
/<?php echo $this->_tpl_vars['v']['diastolic_blood_pressure']; ?>
</td>
   	<?php endforeach; endif; unset($_from); ?>
	</tr>
   	<tr>
   	  <td colspan="2">血红蛋白值(g/L)</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
   	  <td><?php echo $this->_tpl_vars['v']['hemoglobin']; ?>
</td>
   	<?php endforeach; endif; unset($_from); ?>
	</tr>
   	<tr>
   	  <td colspan="2">尿蛋白*</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
   	  <td><?php echo $this->_tpl_vars['v']['azoturia']; ?>
</td>
   	<?php endforeach; endif; unset($_from); ?>
	</tr>
   	<tr>
   	  <td colspan="2">其他辅助检查*</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
   	  <td>
   	  	<?php echo $this->_tpl_vars['v']['other_check']; ?>

	  </td>
	  <?php endforeach; endif; unset($_from); ?>
   	</tr>
   	<tr>
   	  <td colspan="2">分类</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
   	  <td>
   	  	<?php $_from = $this->_tpl_vars['ma_comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['m'] => $this->_tpl_vars['n']):
?>
			<label><?php echo $this->_tpl_vars['m']; ?>
、<?php echo $this->_tpl_vars['n'][1]; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
   	  <input type="text" name="pregnant_sort_info" value="<?php echo $this->_tpl_vars['v']['pregnant_sort_info']; ?>
" class="inputbottom"/>
   	  <input type="text" name="pregnant_sort" value="<?php echo $this->_tpl_vars['v']['pregnant_sort']; ?>
" class="inputnew"/>
   	  </td>
	  <?php endforeach; endif; unset($_from); ?>
   	</tr>
   	<tr>
   	  <td colspan="2">指导</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
   	  <td>
		<?php echo $this->_tpl_vars['v']['medical_advice']; ?>
<br /><?php if ($this->_tpl_vars['v']['medical_advice']):  echo $this->_tpl_vars['v']['medical_advice_info'];  endif; ?>
   	  </td>
	  <?php endforeach; endif; unset($_from); ?>
      
   	</tr>
   	<tr>
   	  <td colspan="2">转诊</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
   	  <td>
   	  转诊  &nbsp;&nbsp;&nbsp;&nbsp;   
		<?php $_from = $this->_tpl_vars['fksss_dic']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['m'] => $this->_tpl_vars['n']):
?>
			<label><?php echo $this->_tpl_vars['m']; ?>
、<?php echo $this->_tpl_vars['v'][$this->_sections['n']['index']]; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>&nbsp;<input type="text" name="referral" value="<?php echo $this->_tpl_vars['v']['referral']; ?>
"  class="inputnew"/></br>
	              原因  ： <input type="text" name="referral_reason" value="<?php echo $this->_tpl_vars['v']['referral_reason']; ?>
" class="inputbottom"/></br>
	             机构及科室   ：<input type="text" name="referral_org" value="<?php echo $this->_tpl_vars['v']['referral_org']; ?>
" class="inputbottom"/> 
   	  </td>
	  <?php endforeach; endif; unset($_from); ?>
   	</tr>
    <tr>
   	  <td colspan="2">下次随访日期</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
	  <td><?php echo $this->_tpl_vars['v']['follow_next_time']; ?>
</td>
   	<?php endforeach; endif; unset($_from); ?>
	</tr>
   	<tr>
   	  <td colspan="2">随访医生签名</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
	  <td>
	  	<?php echo $this->_tpl_vars['v']['follow_staff']; ?>

		</td>
		<?php endforeach; endif; unset($_from); ?>
   	</tr>
	<tr>
   	  <td colspan="2">操作</td>
	  <?php $_from = $this->_tpl_vars['prenatal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
	  <td>
	  	<?php if ($this->_tpl_vars['v']['created']): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
maternal/two/addlist/fid/<?php echo $this->_tpl_vars['v']['fid']; ?>
/follow_count/<?php echo $this->_tpl_vars['v']['follow_count']; ?>
">编辑</a>&nbsp;|&nbsp;<a href="###" onclick="del('<?php echo $this->_tpl_vars['basePath']; ?>
maternal/two/del/fid/<?php echo $this->_tpl_vars['fid']; ?>
/uuid/<?php echo $this->_tpl_vars['v']['uuid']; ?>
')">删除<?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
maternal/two/addlist/fid/<?php echo $this->_tpl_vars['fid']; ?>
/follow_count/<?php echo $this->_tpl_vars['k']; ?>
">添加</a><?php endif; ?>
		</td>
		<?php endforeach; endif; unset($_from); ?>
   	</tr>
   	<!--此处的colspan要动态变化-->
   	<tr>
		<td colspan="6" align="center"><input name="submit" type="submit" value="返回前页" onclick="rt()" class="inputbutton"/>
    <input type="button" name="print" id="print" value="打印" class="inputbutton" onclick="javascript:window.print();" />
    </td>
   	</tr>
   </table> 
</body>
</html>
<?php /* Smarty version 2.6.14, created on 2013-09-02 09:52:21
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>个人健康档案综合统计</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
views/styles/tabs.css">
<style>
	table
	{
		background:#ffffff;
	}
</style>
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>   <!--时间控件的加载!-->
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" />
<script>
	$(document).ready(function(){
		checkForm('<?php echo $this->_tpl_vars['basePath']; ?>
statistics/iha/total');
	});
	
	function getImgdata(curl){
		var dd=$("form[name='searchform']").serialize().replace(/=/g,"/");
		var furl=curl+"/"+dd.replace(/&/g,"/");
		$("#totaldata").html("<img src='"+furl+"' />");
	}

	function checkForm(curl)
	{
		$.ajax({
		type:"POST",
		url:curl,
		dataType:"html",
		data:$("form[name='searchform']").serialize(),
		beforeSend:function(){
				$("#totaldata").html("<img src=\"<?php echo $this->_tpl_vars['basePath']; ?>
images/load.gif\" />数据查询中，综合统计可能会耗费较长时间，请耐心等待...");
				},
		success:function(data){
			$("#totaldata").html(data);
			return false;
		},
		error:function(){
			$("#totaldata").html("<font color=red>服务器返回信息不完整，请重新查询...</font>");
			return false;
		}
	});
	return false;
	}
</script>
</head>
<body>
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
        <th colspan="6">
        	健康档案综合统计报表
        </th>
	</tr>
	</thead>
	<tbody id="iha">
		<tr>
		<td style="vertical-align:top;" id="totaldata">
			<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/load.gif" />数据查询中，综合统计可能会耗费较长时间，请耐心等待...
		</td>
		<td style="width:200px;text-align:center;vertical-align:top;">
		<form  name="searchform" method="post">
         <input type="radio" name="serach_type" value="day"  <?php if ($this->_tpl_vars['serach_type'] == day): ?>checked="checked"<?php endif; ?> />根据日查询<br/>
		 <input type="radio" name="serach_type" value="week"  <?php if ($this->_tpl_vars['serach_type'] == week): ?>checked="checked"<?php endif; ?> />根据周查询<br/>
         <input type="radio" name="serach_type" value="month"  <?php if ($this->_tpl_vars['serach_type'] == month): ?>checked="checked"<?php endif; ?> />根据月查询<br/>
		 <input type="radio" name="serach_type" value="quarter"  <?php if ($this->_tpl_vars['serach_type'] == quarter): ?>checked="checked"<?php endif; ?> />根据季度查询<br/>
         <input type="radio" name="serach_type" value="year"  <?php if ($this->_tpl_vars['serach_type'] == year): ?>checked="checked"<?php endif; ?> />根据年查询<br/>
         
         <input type="text" class="Wdate" style="margin-top:20px; width:100px;" value="<?php echo $this->_tpl_vars['startDate']; ?>
" onfocus="WdatePicker({firstDayOfWeek:1})"  MINDATE="2000-1-1" MAXDATE="2099-12-31" name="startDate"/><br/>
         <input type="text" class="Wdate"  style="width:100px; margin-top:20px;" value="<?php echo $this->_tpl_vars['endDate']; ?>
" onfocus="WdatePicker({firstDayOfWeek:1})"  MINDATE="2000-1-1" MAXDATE="2099-12-31" name="endDate"/><br/>
         
         <input type="button" style="margin-top:20px" value="查询" onclick="return checkForm('<?php echo $this->_tpl_vars['basePath']; ?>
statistics/iha/total');" /><br />
		 <input type="button" style="margin-top:20px" value="统计图" onclick="return getImgdata('<?php echo $this->_tpl_vars['basePath']; ?>
statistics/iha/totalimg');" /><br />
         <input type="button" style="margin-top:20px" name="print" id="print" value="打印" class="inputbutton" onclick="javascript:window.print();" />
        </form></td>
		</tr>
	</tbody>
</table>
</body>
</html>
<?php /* Smarty version 2.6.14, created on 2013-08-14 11:25:23
         compiled from left_menu.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
views/js/jquery-1.4.2.js"></script>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
views/styles/admincp.css" />
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
views/js/main.js" type="text/javascript"></script>

<script type="text/javascript">
function collapse_change(menucount) {
    
	if($('#menu_' + menucount).is(":visible")) {
		$('#menu_' + menucount).hide();
		$('#menuimg_' + menucount).attr('src',"<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif");

	} else {
		$('#menu_' + menucount).show();
		$('#menuimg_' + menucount).attr('src',"<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_reduce.gif");
	}

}
function add_new_confirm(obj)
{
	if(confirm('是否确定增加新的记录？'))
	{
		toUrl(obj,'c');
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<style>
body,div{
    width: 100%;
    > width: 170px;
    font-size: 16px;
}
html, body {
    background-color: #f2fcfe;
}
td{
    font-size: 16px;
}
hr{
    border: 1px dotted #ccc;
}
</style>
</head>

<body>
<div id="iha" name="iha"  style="display:<?php echo $this->_tpl_vars['iha_index']; ?>
">
	<table border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		<tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian1" onclick="collapse_change(1),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/group.png" border="0" style="height:20px;" />
		 健康档案</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_1" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(1),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_1" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr style="display:<?php echo $this->_tpl_vars['iha_index']; ?>
"><td><a href="###" id="ian1_1" onclick="toUrl(this,'b'),collapse_change(11)">个人档案</a></td></tr>
				 <tbody id="menu_11" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <!--iha/index/add-->
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/family/index" id="ian1_1_1" target="mainFrame" onclick="toUrl(this,'c')">家庭档案列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/index/index" id="ian1_1_3" target="mainFrame" onclick="toUrl(this,'c')">个人档案列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/cover/add/action/add" id="ian1_1_5" target="mainFrame" onclick="return add_new_confirm(this);toUrl(this,'c')">新增档案封面</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/index/add" id="ian1_1_7" target="mainFrame" onclick="toUrl(this,'c')">个人基本信息表</a></td></tr>
                     <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/index/refresh" id="ian1_1_8" target="mainFrame" onclick="toUrl(this,'c')">刷新完整率</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/index/card" id="ian1_1_9" target="mainFrame" onclick="toUrl(this,'c')">居民健康档案信息卡</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/index/today" id="ian1_1_2" target="mainFrame" onclick="toUrl(this,'c')">今日建档统计</a></td></tr>	
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
statistics/iha/index" id="ian1_1_4" target="mainFrame" onclick="toUrl(this,'c')">医生建档综合统计</a></td></tr>
                     <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
statistics/iha/composite" id="ian1_1_6" target="mainFrame" onclick="toUrl(this,'c')">档案信息综合统计</a></td></tr>
                     <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
statistics/iha/cd" id="ian1_1_11" target="mainFrame" onclick="toUrl(this,'c')">慢病确诊人数统计</a></td></tr>
                     <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
statistics/iha/iha" id="ian1_1_12" target="mainFrame" onclick="toUrl(this,'c')">建档人数分段统计</a></td></tr>
                     <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
statistics/iha/maternal" id="ian1_1_13" target="mainFrame" onclick="toUrl(this,'c')">孕产妇人数统计</a></td></tr>
                     <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/index/import" id="ian1_1_10" target="mainFrame" onclick="toUrl(this,'c')">导出个人档案excel</a></td></tr>
                     <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/family/import" id="ian1_1_16" target="mainFrame" onclick="toUrl(this,'c')">导出家庭档案excel</a></td></tr>
					 <tr  style="display:<?php echo $this->_tpl_vars['iha_repeat']; ?>
"><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/repeat/index" id="ian1_1_14" target="mainFrame" onclick="toUrl(this,'c')">个人档案查重</a></td></tr>
					 <tr  style="display:<?php echo $this->_tpl_vars['iha_blank']; ?>
"><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/blank/index" id="ian1_1_15" target="mainFrame" onclick="toUrl(this,'c')">身份证号为空</a></td></tr>

                     </table>
					 </td></tr>
				 </tbody>	
		 
		 </table>
		 
		 </td></tr>
		 </tbody>
	</table>
</div>


<div id="et_index" name="et_index"  style="display:<?php echo $this->_tpl_vars['et_index']; ?>
">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		<tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian3" onclick="collapse_change(3),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/report_user.png" border="0" style="height:20px;" />
		 健康体检</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_3" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(3),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_3" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
et/index/index" target="mainFrame" id="ian3_1" onclick="toUrl(this,'b'),collapse_change(31)">健康体检表列表</a></td></tr>		
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
et/index/add" target="mainFrame" id="ian3_2" onclick="toUrl(this,'b'),collapse_change(32)">添加健康体检表</a></td></tr>	
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
et/import/noexamine" target="mainFrame" id="ian3_3" onclick="toUrl(this,'b'),collapse_change(32)">导出未体检档案</a></td></tr>	
         
		 </table>
		 
		 </td>
         </tr>
		 </tbody>
	</table>
</div>


<div id="api_list"  style="display:<?php echo $this->_tpl_vars['api_list']; ?>
">

	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		  <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian7" onclick="collapse_change(7),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/folder_page.png" border="0" style="height:20px;" />
		 诊疗信息共享</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_7" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(7),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_7" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
api/list/patienthistory" target="mainFrame" id="ian7_1" onclick="toUrl(this,'b'),collapse_change(71)">门诊病历</a></td></tr>		
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
api/list/hosdc" target="mainFrame" id="ian7_2" onclick="toUrl(this,'b'),collapse_change(72)">出院证明</a></td></tr>	
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
zaojiaemr/index/index" target="mainFrame" id="ian7_3" onclick="toUrl(this,'b'),collapse_change(73)">病历记录</a></td></tr>		
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
detection/index/index" target="mainFrame" id="ian7_4" onclick="toUrl(this,'b'),collapse_change(74)">实验室检查</a></td></tr>	
		 </table>
		 
		 </td>
         </tr>
		 </tbody>
	</table>
</div>

<div id="gp_physical"  style="display:<?php echo $this->_tpl_vars['gp_physical']; ?>
">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian35" onclick="collapse_change(35),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/building.png" border="0" style="height:20px;" />
		 基本医疗</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_35" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(35),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_35" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><span><img id="menuimg_351" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(351),toUrl(this,'b')" /></span><a href="###" id="ian35_1" onclick="collapse_change(351),toUrl(this,'b')">体格检查</a></td></tr>
			 <tbody id="menu_351" style="display:none">
			 <tr ><td>
			 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
			 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
gp/physical/index" id="ian35_1_1" target="mainFrame" onclick="toUrl(this,'c')">基本检查列表</a></td></tr>
			 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
gp/physical/add" id="ian35_1_2" target="mainFrame" onclick="toUrl(this,'c')">添加基本检查</a></td></tr>
			 </table>
			 </td></tr>
			 </tbody>
		 </table>
		 </td>
         </tr>
		 </tbody>
	</table>
</div>

<div id="gp_diagnosis"  style="display:<?php echo $this->_tpl_vars['gp_diagnosis']; ?>
">

	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian8" onclick="collapse_change(8),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/timeline_marker.png" border="0" style="height:20px;" />其它医疗服务</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_8" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(8),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_8" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><span><img id="menuimg_81" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(81),toUrl(this,'b')" /></span><a href="###" id="ian8_1" onclick="collapse_change(81),toUrl(this,'b')">接诊记录表</a></td></tr>
         			<tbody id="menu_81" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
gp/diagnosis/listdiagnosis" id="ian8_1_1" target="mainFrame" onclick="toUrl(this,'c')">接诊列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
gp/diagnosis/index" id="ian8_1_2" target="mainFrame" onclick="toUrl(this,'c')">添加接诊</a></td></tr>					
					  </table>
					 </td></tr>
				    </tbody>
         
         <tr><td><span><img id="menuimg_82" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(82),toUrl(this,'b')" /></span><a href="###" id="ian8_2" onclick="collapse_change(82),toUrl(this,'b')">会诊记录表</a></td></tr>
         			<tbody id="menu_82" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
gp/consultation/list" id="ian8_2_1" target="mainFrame" onclick="toUrl(this,'c')">会诊列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
gp/consultation/index" id="ian8_2_2" target="mainFrame" onclick="toUrl(this,'c')">添加会诊</a></td></tr>					
					  </table>
					 </td></tr>
				    </tbody>
         <tr><td><span><img id="menuimg_83" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(83),toUrl(this,'b')" /></span><a href="###" id="ian8_3" onclick="collapse_change(83),toUrl(this,'b')">双向转诊单</a></td></tr>
         			<tbody id="menu_83" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
gp/transout/index" id="ian8_3_1" target="mainFrame" onclick="toUrl(this,'c')">转诊(转出)单列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
gp/transout/add" id="ian8_3_2" target="mainFrame" onclick="toUrl(this,'c')">添加转诊(转出)单</a></td></tr>		
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
gp/transin/index" id="ian8_3_3" target="mainFrame" onclick="toUrl(this,'c')">转诊(回转)单列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
gp/transin/add" id="ian8_3_4" target="mainFrame" onclick="toUrl(this,'c')">添加转诊(回转)单</a></td></tr>			
					  </table>
					 </td></tr>
				    </tbody>
		 </table>
		 
		 </td>
         </tr>
		 </tbody>
	</table>
</div>

<div id="his_patientmai"  style="display:<?php echo $this->_tpl_vars['his']; ?>
">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian37" onclick="collapse_change(37),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/application_side_boxes.png" border="0" style="height:20px;" />医疗业务</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_37" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(37),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_37" style="display:none">
			 <tr class="leftmenutd"><td>
				 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
				 <!--
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/patientmain/list" id="ian37_1" onclick="toUrl(this,'b')" target="mainFrame">患者一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/prescription/list" id="ian37_2" onclick="toUrl(this,'b')" target="mainFrame">处方一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/mzjz/list" id="ian37_3" target="mainFrame" onclick="toUrl(this,'b')">门诊就诊信息一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/fee/list" id="ian37_4" target="mainFrame" onclick="toUrl(this,'b')">门诊收费明细表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/zyxx/list" id="ian37_5" target="mainFrame" onclick="toUrl(this,'b')">住院信息一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/operation/list" id="ian37_6" onclick="toUrl(this,'b')" target="mainFrame">手术信息一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/zyba/list" id="ian37_7" target="mainFrame" onclick="toUrl(this,'b')">住院病案首页</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/zyyzmx/list" id="ian37_8" target="mainFrame" onclick="toUrl(this,'b')">住院医嘱明细</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/zysfmx/list" id="ian37_9" target="mainFrame" onclick="toUrl(this,'b')">住院收费明细</a></td></tr>
					 
					 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/department/list" id="ian37_10" target="mainFrame" onclick="toUrl(this,'b')">科室字典表</a></td></tr>
				 	 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/practitioner/list" id="ian37_11" target="mainFrame" onclick="toUrl(this,'b')">医护人员字典表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/comparison/list" id="ian37_12" target="mainFrame" onclick="toUrl(this,'b')">诊疗项目字典表</a></td></tr>
				 	 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/disease/list" id="ian37_13" target="mainFrame" onclick="toUrl(this,'b')">诊断字典表</a></td></tr>
				  	 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/specimen/list" id="ian37_14" target="mainFrame" onclick="toUrl(this,'b')">标本字典表</a></td></tr>		 
				  	 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/instrument/list" id="ian37_15" target="mainFrame" onclick="toUrl(this,'b')">仪器设备字典表</a></td></tr> 
				  	 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/medicine/list" id="ian37_16" target="mainFrame" onclick="toUrl(this,'b')">药品字典表</a></td></tr>					  	 
				  	 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/bacteria/list" id="ian37_17" target="mainFrame" onclick="toUrl(this,'b')">细菌结果</a></td></tr>	 
				  	 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/allergy/list" id="ian37_18" target="mainFrame" onclick="toUrl(this,'b')">药敏结果</a></td></tr>	
				  	 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/sysjybg/list" id="ian37_19" target="mainFrame" onclick="toUrl(this,'b')">实验室检验报告</a></td></tr>	
				  	 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/jyjgzb/list" id="ian37_20" target="mainFrame" onclick="toUrl(this,'b')">检验结果指标</a></td></tr>	
				  		 
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/mzreg/list" id="ian37_21" onclick="toUrl(this,'b')" target="mainFrame">挂号一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/mzcharge/list" id="ian37_22" onclick="toUrl(this,'b')" target="mainFrame">诊疗收费一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/zydis/list" id="ian37_23" onclick="toUrl(this,'b')" target="mainFrame">出院登记一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/jzcharge/list" id="ian37_24" onclick="toUrl(this,'b')" target="mainFrame">在/出院结算一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/oprrec/list" id="ian37_25" onclick="toUrl(this,'b')" target="mainFrame">手术记录一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/cismain/list" id="ian37_26" onclick="toUrl(this,'b')" target="mainFrame">住院病案首页一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/operation/list" id="ian37_27" onclick="toUrl(this,'b')" target="mainFrame">手术明细一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/ihdiagnosis/list" id="ian37_28" onclick="toUrl(this,'b')" target="mainFrame">诊断明细一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/cisleavehospital/list" id="ian37_29" onclick="toUrl(this,'b')" target="mainFrame">出院小结一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/zyadm/list" id="ian37_30" onclick="toUrl(this,'b')" target="mainFrame">入院登记一览表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/risreport/list" id="ian37_31" onclick="toUrl(this,'b')" target="mainFrame">医学影像检查报告表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/yltjbgsy/list" id="ian37_32" onclick="toUrl(this,'b')" target="mainFrame">体检报告表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/blood/list" id="ian37_33" onclick="toUrl(this,'b')" target="mainFrame">用血明细表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/ywltj/list" id="ian37_34" onclick="toUrl(this,'b')" target="mainFrame">业务量统计表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/ywsrtj/list" id="ian37_35" onclick="toUrl(this,'b')" target="mainFrame">业务收入统计表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/cwsyl/list" id="ian37_36" onclick="toUrl(this,'b')" target="mainFrame">床位使用表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/medstore/list" id="ian37_37" onclick="toUrl(this,'b')" target="mainFrame">药品库存表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/medicalwaste/list" id="ian37_38" onclick="toUrl(this,'b')" target="mainFrame">医疗废物转移记录表</a></td></tr>
					 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
his/apisummary/index" id="ian37_38" onclick="toUrl(this,'b')" target="mainFrame">接口概要</a></td></tr>
                     -->
                     <?php unset($this->_sections['mu']);
$this->_sections['mu']['name'] = 'mu';
$this->_sections['mu']['loop'] = is_array($_loop=$this->_tpl_vars['menu_url']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['mu']['show'] = true;
$this->_sections['mu']['max'] = $this->_sections['mu']['loop'];
$this->_sections['mu']['step'] = 1;
$this->_sections['mu']['start'] = $this->_sections['mu']['step'] > 0 ? 0 : $this->_sections['mu']['loop']-1;
if ($this->_sections['mu']['show']) {
    $this->_sections['mu']['total'] = $this->_sections['mu']['loop'];
    if ($this->_sections['mu']['total'] == 0)
        $this->_sections['mu']['show'] = false;
} else
    $this->_sections['mu']['total'] = 0;
if ($this->_sections['mu']['show']):

            for ($this->_sections['mu']['index'] = $this->_sections['mu']['start'], $this->_sections['mu']['iteration'] = 1;
                 $this->_sections['mu']['iteration'] <= $this->_sections['mu']['total'];
                 $this->_sections['mu']['index'] += $this->_sections['mu']['step'], $this->_sections['mu']['iteration']++):
$this->_sections['mu']['rownum'] = $this->_sections['mu']['iteration'];
$this->_sections['mu']['index_prev'] = $this->_sections['mu']['index'] - $this->_sections['mu']['step'];
$this->_sections['mu']['index_next'] = $this->_sections['mu']['index'] + $this->_sections['mu']['step'];
$this->_sections['mu']['first']      = ($this->_sections['mu']['iteration'] == 1);
$this->_sections['mu']['last']       = ($this->_sections['mu']['iteration'] == $this->_sections['mu']['total']);
?>
		 <tr><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
his/apisummary/index/mid/<?php echo $this->_tpl_vars['menu_url'][$this->_sections['mu']['index']]['module_id']; ?>
" target="mainFrame" id="ian37_<?php echo $this->_sections['mu']['rownum']; ?>
" onclick="collapse_change(37<?php echo $this->_sections['mu']['rownum']; ?>
);toUrl(this,'b');"><?php echo $this->_tpl_vars['menu_url'][$this->_sections['mu']['index']]['module_name']; ?>
</a></td></tr>
         <?php endfor; endif; ?>
				 </table>
			 </td>
	         </tr>
		 </tbody>
	</table>
	<hr />
</div>

<div id="he_index"  style="display:<?php echo $this->_tpl_vars['he_index']; ?>
">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian13" onclick="collapse_change(13),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/map.png" border="0" style="height:20px;" />
		 健康教育</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_13" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(13),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_13" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
he/index/index" target="mainFrame" id="ian13_1" onclick="toUrl(this,'b'),collapse_change(131)">健康教育活动列表</a></td></tr>
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
he/index/add" target="mainFrame" id="ian13_2" onclick="toUrl(this,'b'),collapse_change(132)">添加健康教育活动</a></td></tr>
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
he/prescription/index" target="mainFrame" id="ian13_3" onclick="toUrl(this,'b'),collapse_change(133)">健康教育处方列表</a></td></tr>
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
he/prescription/edit" target="mainFrame" id="ian13_4" onclick="toUrl(this,'b'),collapse_change(134)">添加健康教育处方</a></td></tr>
		 </table>
		 </td>
         </tr>
		 </tbody>
	</table>
	<hr />
</div>


<!--金石妇幼开始-->
<div id="jinshi_fuyou" name="jinshi_fuyou" style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
" >
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian45" onclick="collapse_change(45),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/presentation.png" border="0" style="height:20px;" />专业孕产妇保健</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_45" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(45),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_45" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
				 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_jbzl_cx.aspx?website=ycfbj&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian45_1" target="mainFrame" onclick="toUrl(this,'b')">孕产妇基本资料</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_sz_cx.aspx?website=ycfbj&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian45_2" target="mainFrame" onclick="toUrl(this,'b')">产前首诊记录</a></td></tr>
				 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_yqfz_cx.aspx?website=ycfbj&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian45_3" target="mainFrame" onclick="toUrl(this,'b')">产前复诊检查</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_gwgl_cx.aspx?website=ycfbj&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian45_4" target="mainFrame" onclick="toUrl(this,'b')">高危孕产妇管理</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_fmjl_cx.aspx?website=ycfbj&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian45_5" target="mainFrame" onclick="toUrl(this,'b')">产时分娩情况</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_chfs_cx.aspx?website=ycfbj&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian45_6" target="mainFrame" onclick="toUrl(this,'b')">产妇产后访视</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_cszm_cx.aspx?website=ycfbj&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian45_7" target="mainFrame" onclick="toUrl(this,'b')">新生儿出生证明</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_xsechfs_cx.aspx?website=ycfbj&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian45_8" target="mainFrame" onclick="toUrl(this,'b')">新生儿产后访视</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_ch42jc_cx.aspx?website=ycfbj&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian45_9" target="mainFrame" onclick="toUrl(this,'b')">产后42天检查</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_xse42jc_cx.aspx?website=ycfbj&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian45_10" target="mainFrame" onclick="toUrl(this,'b')">新生儿42天检查</a></td></tr>
                 <!--tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_yygl_cx.aspx?website=ycfbj&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian45_11" target="mainFrame" onclick="toUrl(this,'b')">预约管理</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_lcyf_cx.aspx?website=ycfbj&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian45_12" target="mainFrame" onclick="toUrl(this,'b')">临产孕妇</a></td></tr-->
		 </table>     
		 </td></tr>
		 </tbody>
		 
	</table>
	  
</div>


<div id="jinshi_fuyou" name="jinshi_fuyou" style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
" >
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian46" onclick="collapse_change(46),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/presentation.png" border="0" style="height:20px;" />专业儿童保健</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_46" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(46),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_46" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
				 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_jbzl_cx.aspx?website=etbj&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian46_1" target="mainFrame" onclick="toUrl(this,'b')">儿童基本资料</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_tjzl_cx.aspx?website=etbj&yhlb=&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian46_2" target="mainFrame" onclick="toUrl(this,'b')">儿童体检资料</a></td></tr>
				 <!--tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_zagl_cx.aspx?website=fpza&zafl=fpe&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian46_3" target="mainFrame" onclick="toUrl(this,'b')">肥胖症专案</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_zagl_cx.aspx?website=yyblza&zafl=yybl&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian46_4" target="mainFrame" onclick="toUrl(this,'b')">营养不良专案</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_zagl_cx.aspx?website=glbza&zafl=glb&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian46_5" target="mainFrame" onclick="toUrl(this,'b')">佝偻病现专案</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_zagl_cx.aspx?website=pxza&zafl=px&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian46_6" target="mainFrame" onclick="toUrl(this,'b')">贫血专案</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_zagl_cx.aspx?website=jbeza&zafl=jbe&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian46_7" target="mainFrame" onclick="toUrl(this,'b')">疾病儿专案</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_zagl_cx.aspx?website=qdeza&zafl=qde&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian46_8" target="mainFrame" onclick="toUrl(this,'b')">缺点儿专案</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_zagl_cx.aspx?website=nteza&zafl=nte&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian46_9" target="mainFrame" onclick="toUrl(this,'b')">脑瘫儿儿专案</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_zagl_cx.aspx?website=gdxzza&zafl=gdxze&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian46_10" target="mainFrame" onclick="toUrl(this,'b')">高胆红素专案</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_zagl_cx.aspx?website=treza&zafl=tre&rhin=ehrplat&dwdm=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian46_11" target="mainFrame" onclick="toUrl(this,'b')">其他体弱儿专案</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_yyzhgl_cx.aspx?website=etbj&rhin=ehrplat&region=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian46_12" target="mainFrame" onclick="toUrl(this,'b')">预约管理</a></td></tr>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_zfdj_cx.aspx?website=etbj&rhin=ehrplat&region=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian46_13" target="mainFrame" onclick="toUrl(this,'b')">追访登记</a></td></tr-->
		 </table>     
		 </td></tr>
		 </tbody>
		 
	</table>
	  
</div>
<!--金石妇幼业务模块结束-->

<!--此部分将作为内部使用开始-->
<div id="children_index"  style="display:<?php echo $this->_tpl_vars['children']; ?>
">

	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian15" onclick="collapse_change(15),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/vcard.png" border="0" style="height:20px;" />
		 儿童健康管理</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_15" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(15),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_15" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><span><img id="menuimg_151" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(151),toUrl(this,'b')" /></span><a href="###" id="ian15_1" onclick="collapse_change(151),toUrl(this,'b')">新生儿家庭访视</a></td></tr>
         			<tbody id="menu_151" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
children/newborn/list" id="ian15_1_1" target="mainFrame" onclick="toUrl(this,'c')">新生儿访视列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
children/newborn/index" id="ian15_1_2" target="mainFrame" onclick="toUrl(this,'c')">添加新生儿访视</a></td></tr>					
					  </table>
					 </td></tr>
				    </tbody>
         
         <tr><td><span><img id="menuimg_152" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(152),toUrl(this,'b')" /></span><a href="###" id="ian15_2" onclick="collapse_change(152),toUrl(this,'b')">1岁以内健康检查</a></td></tr>
         			<tbody id="menu_152" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
children/children/index" id="ian15_2_1" target="mainFrame" onclick="toUrl(this,'c')">1岁以内检查列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
children/children/add" id="ian15_2_2" target="mainFrame" onclick="toUrl(this,'c')">添加1岁以内检查</a></td></tr>
                     <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/import/age_start/0/age_end/1/excel_name/%E5%84%BF%E7%AB%A5%E5%88%97%E8%A1%A8" target="mainFrame" id="ian15_2_3" onclick="toUrl(this,'c')">导出1岁以内儿童列表</a></td></tr>					
					  </table>
					 </td></tr>
				    </tbody>
		 <tr><td><span><img id="menuimg_153" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(153),toUrl(this,'b')" /></span><a href="###" id="ian15_3" onclick="collapse_change(153),toUrl(this,'b')">1～2岁以内健康检查</a></td></tr>
         			<tbody id="menu_153" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
children/childrentwo/index" id="ian15_3_1" target="mainFrame" onclick="toUrl(this,'c')">1～2岁检查列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
children/childrentwo/add" id="ian15_3_2" target="mainFrame" onclick="toUrl(this,'c')">添加1～2岁检查</a></td></tr>
                      <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/import/age_start/1/age_end/2/excel_name/%E5%84%BF%E7%AB%A5%E5%88%97%E8%A1%A8" target="mainFrame" id="ian15_3_3" onclick="toUrl(this,'c')">导出1~2岁以内儿童列表</a></td></tr>					
					  </table>
					 </td></tr>
				    </tbody>
         <tr><td><span><img id="menuimg_154" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(154),toUrl(this,'b')" /></span><a href="###" id="ian15_4" onclick="collapse_change(154),toUrl(this,'b')">3～6岁儿童健康检查</a></td></tr>
         			<tbody id="menu_154" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
children/threeold/index" id="ian15_4_1" target="mainFrame" onclick="toUrl(this,'c')">3～6岁健康检查列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
children/threeold/add" id="ian15_4_2" target="mainFrame" onclick="toUrl(this,'c')">添加3～6岁健康检查</a></td></tr>
                      <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/import/age_start/3/age_end/6/excel_name/%E5%84%BF%E7%AB%A5%E5%88%97%E8%A1%A8" target="mainFrame" id="ian15_4_3" onclick="toUrl(this,'c')">导出3~6岁以内儿童列表</a></td></tr>		
					 </table>
					 </td>
				    </tbody>
		 <tr><td><span><img id="menuimg_155" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(155),toUrl(this,'b')" /></span><a href="###" id="ian15_5" onclick="collapse_change(155),toUrl(this,'b')">儿童生长曲线</a></td></tr>
         			<tbody id="menu_155" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
children/line/index" id="ian15_5_1" target="mainFrame" onclick="toUrl(this,'c')">儿童生长曲线</a></td></tr>
				    </tbody>
		 </table>
		 
		 </td>
         </tr>
         
		 </tbody>
		 
		 
		
		
		 </table>
		 
		 </td>
         </tr>
         
		 </tbody>
	</table>
</div>


<div id="maternal_index"  style="display:<?php echo $this->_tpl_vars['maternal']; ?>
">

	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian14" onclick="collapse_change(14),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/group.png" border="0" style="height:20px;" />
		 孕产妇健康管理</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_14" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(14),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_14" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><span><img id="menuimg_141" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(141),toUrl(this,'b')" /><a href="###" id="ian14_1" onclick="collapse_change(141),toUrl(this,'b')">&nbsp;第1次产前随访</a></span></td></tr>
         			<tbody id="menu_141" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
maternal/index/list" id="ian14_1_1" target="mainFrame" onclick="toUrl(this,'c')">随访人员列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
maternal/index/index" id="ian14_1_2" target="mainFrame" onclick="toUrl(this,'c')">随访记录列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
maternal/index/add" id="ian14_1_3" target="mainFrame" onclick="toUrl(this,'c')">添加第1次随访</a></td></tr>					
					  </table>
					 </td></tr>
				    </tbody>
         
         <tr><td><span><img id="menuimg_142" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(142),toUrl(this,'b')" /><a href="###" id="ian14_2" onclick="collapse_change(142),toUrl(this,'b')">第2-5次产前随访</a></span></td></tr>
         			<tbody id="menu_142" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
maternal/two/index" id="ian14_2_1" target="mainFrame" onclick="toUrl(this,'c')">随访人员列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
maternal/two/list" id="ian14_2_2" target="mainFrame" onclick="toUrl(this,'c')">随访记录列表</a></td></tr>					
					  <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
maternal/two/add" id="ian14_2_3" target="mainFrame" onclick="toUrl(this,'c')">添加第2-5次随访</a></td></tr>
					  </table>
					 </td></tr>
				    </tbody>
         <tr><td><span><img id="menuimg_143" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(143),toUrl(this,'b')" /></span><a href="###" id="ian14_3" onclick="collapse_change(143),toUrl(this,'b')">产后随访记录</a></td></tr>
         			<tbody id="menu_143" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
maternal/postnatal/index" id="ian14_3_1" target="mainFrame" onclick="toUrl(this,'c')">随访人员列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
maternal/postnatal/list" id="ian14_3_2" target="mainFrame" onclick="toUrl(this,'c')">随访记录列表</a></td></tr>					
					  <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
maternal/postnatal/add" id="ian14_3_3" target="mainFrame" onclick="toUrl(this,'c')">添加产后随访</a></td></tr>
					  </table>
					 </td></tr>
				    </tbody>
		<tr><td><span><img id="menuimg_144" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(144),toUrl(this,'b')" /></span><a href="###" id="ian14_4" onclick="collapse_change(144),toUrl(this,'b')">产后42天检查</a></td></tr>
         			<tbody id="menu_144" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
maternal/heathcheck/index" id="ian14_4_1" target="mainFrame" onclick="toUrl(this,'c')">检查人员列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
maternal/heathcheck/list" id="ian14_4_2" target="mainFrame" onclick="toUrl(this,'c')">检查记录列表</a></td></tr>					
					  <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
maternal/heathcheck/add" id="ian14_4_3" target="mainFrame" onclick="toUrl(this,'c')">添加产后42天检查</a></td></tr>
					  </table>
					 </td></tr>
				    </tbody>
		 </table>
		 
		 </td>
         </tr>
		 </tbody>
	</table>
</div>
<!--内部使用结束-->
<div id="elder" style="display:<?php echo $this->_tpl_vars['elder']; ?>
">

	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian38" onclick="collapse_change(38),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/images.png" border="0" style="height:20px;" />
		 老年人健康服务</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_38" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(38),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_38" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
elder/elder/index" target="mainFrame" id="ian38_1" onclick="toUrl(this,'b'),collapse_change(381)">老年人服务列表</a></td></tr>
		 <tr><td><a href="###" id="ian38_2" onclick="toUrl(this,'b'),collapse_change(382)">老年人生活自理能力</a></td></tr>
         			<tbody id="menu_382" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
elder/elder/scorelist" id="ian38_2_1" target="mainFrame" onclick="toUrl(this,'c')">老年人生活自理能力评估列表</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
elder/elder/add" id="ian38_2_2" target="mainFrame" onclick="toUrl(this,'c')">添加老年人生活自理能力评估</a></td></tr>
					 </table> 
                     </td></tr>
                     </tbody>
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/import/age_start/65/excel_name/%E8%80%81%E5%B9%B4%E4%BA%BA" target="mainFrame" id="ian38_3" onclick="toUrl(this,'b'),collapse_change(383)">导出老年人列表</a></td></tr>  
		 </table>
		 </td>
         </tr>
         
		 </tbody>
	</table>
	<hr />
</div>
<div id="vaccinate"  style="display:<?php echo $this->_tpl_vars['vaccinate']; ?>
">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian10" onclick="collapse_change(10),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/shading.png" border="0" style="height:20px;" />
		 预防接种</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_10" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(10),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_10" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
vaccinate/index/index" target="mainFrame" id="ian10_1" onclick="toUrl(this,'b'),collapse_change(91)">预防接种卡记录</a></td></tr>
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
vaccinate/index/add" target="mainFrame" id="ian10_1" onclick="toUrl(this,'b'),collapse_change(91)">添加预防接种卡</a></td></tr>
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
vaccinate/index/display"  target="mainFrame"    id="ian10_1" onclick="toUrl(this,'b'),collapse_change(91)">预防接种CSV</a></td></tr>
		 </table>
		 </td>
         </tr>
		 </tbody>
	</table>
</div>


<div id="premarital_index" style="display:<?php echo $this->_tpl_vars['premarital_index']; ?>
">

	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian6" onclick="collapse_change(6),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/application_view_gallery.png" border="0" style="height:20px;" />
		 婚前检查</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_6" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(6),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_6" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
premarital/index/index" target="mainFrame" id="ian6_1" onclick="toUrl(this,'b'),collapse_change(61)">医学婚检证明列表</a></td></tr>		
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
premarital/index/prove" target="mainFrame" id="ian6_2" onclick="toUrl(this,'b'),collapse_change(62)">添加医学婚检证明</a></td></tr>		
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
premarital/premarital/list" target="mainFrame" id="ian6_3" onclick="toUrl(this,'b'),collapse_change(63)">婚前医学检查列表</a></td></tr>		
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
premarital/premarital/add" target="mainFrame" id="ian6_4" onclick="toUrl(this,'b'),collapse_change(64)">新增婚前检查信息</a></td></tr>		
         
		 </table>
		 
		 </td>
         </tr>
		 </tbody>
	</table>
	<hr />
</div>



<div id="cd"  style="display:<?php echo $this->_tpl_vars['cd']; ?>
">

	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian4" onclick="collapse_change(4),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/shape_ungroup.png" border="0" style="height:20px;" />
		 高血压随访</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_4" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(4),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_4" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/index" target="mainFrame" id="ian4_1" onclick="toUrl(this,'b')">高血压随访列表</a></td></tr>		
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/add" target="mainFrame" id="ian4_2" onclick="toUrl(this,'b')">添加高血压随访表</a></td></tr>	
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
statistics/hy/today" target="mainFrame" id="ian4_3" onclick="toUrl(this,'b')">今日统计</a></td></tr>
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/import/import/clinical_type/2" target="mainFrame" id="ian4_5" onclick="toUrl(this,'b')">高血压患者导出</a></td></tr>
         <!--tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
statistics/hy/comm" target="mainFrame" id="ian4_4" onclick="toUrl(this,'b')">综合统计</a></td></tr-->
		 </table>
		 
		 </td>
         </tr>
		 </tbody>
	</table>
</div>


<div id="dia" style="display:<?php echo $this->_tpl_vars['cd_diabetes']; ?>
">

	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian5" onclick="collapse_change(5),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/rainbow.png" border="0" style="height:20px;" />
		 Ⅱ型糖尿病随访</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_5" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(5),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_5" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/list" target="mainFrame" id="ian5_1" onclick="toUrl(this,'b'),collapse_change(51)">Ⅱ型糖尿病随访列表</a></td></tr>		
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/add" target="mainFrame" id="ian5_2" onclick="toUrl(this,'b'),collapse_change(52)">添加Ⅱ型糖尿病随访表</a></td></tr>	
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/import/import/clinical_type/3" target="mainFrame" id="ian5_3" onclick="toUrl(this,'b')">糖尿病患者导出</a></td></tr>
		 </table>
		 
		 </td>
         </tr>
		 </tbody>
	</table>
</div>

<div id="cd_schizophrenia" style="display:<?php echo $this->_tpl_vars['cd_schizophrenia']; ?>
">
  
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian12" onclick="collapse_change(12),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/joystick.png" border="0" style="height:20px;" />重性精神疾病随访</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_12" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(12),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_12" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/schizophrenia/index" target="mainFrame" id="ian12_1" onclick="toUrl(this,'b'),collapse_change(121)">重性精神疾病随访列表</a></td></tr>		
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/schizophrenia/add" target="mainFrame" id="ian12_2" onclick="toUrl(this,'b'),collapse_change(122)">添加重性精神疾病随访</a></td></tr>	
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/import/import/clinical_type/8" target="mainFrame" id="ian12_3" onclick="toUrl(this,'b')">重性精神疾病患者导出</a></td></tr>
		 </table>
		 
		 </td>
         </tr>
		 </tbody>
	</table>
	<hr />
    </div>
    <div style="display:<?php echo $this->_tpl_vars['appointment_index']; ?>
">
    <table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px; ">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian120" onclick="collapse_change(120),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/appiontment.png" border="0" style="height:20px;" />预约挂号</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_120" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(120),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_120" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		
          <tr style="display:<?php echo $this->_tpl_vars['admin_users']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/dictionary/list/region_id/<?php echo $this->_tpl_vars['user']['region_id']; ?>
/org_id/<?php echo $this->_tpl_vars['user']['org_id']; ?>
/go_back/true" target="mainFrame" id="ian120_1" onclick="toUrl(this,'b'),collapse_change(1201)">坐诊字典</a></td></tr> 	
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/zuozhen/list" target="mainFrame" id="ian120_2" onclick="toUrl(this,'b'),collapse_change(1202)">坐诊列表</a></td></tr> 
         <tr ><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/department/index" target="mainFrame" id="ian120_30" onclick="toUrl(this,'b'),collapse_change(12030)">科室管理</a></td></tr>
         <tr ><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/clinic/index" target="mainFrame" id="ian120_3" onclick="toUrl(this,'b'),collapse_change(1203)">诊室管理</a></td></tr>
         <tr ><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/number_species/index/region_id/<?php echo $this->_tpl_vars['user']['region_id']; ?>
/org_id/<?php echo $this->_tpl_vars['user']['org_id']; ?>
/go_back/true" target="mainFrame" id="ian120_4" onclick="toUrl(this,'b'),collapse_change(1204)">号种维护</a></td></tr>
         <tr style="display:none" ><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/preferential/index/region_id/<?php echo $this->_tpl_vars['user']['region_id']; ?>
/org_id/<?php echo $this->_tpl_vars['user']['org_id']; ?>
/go_back/true" target="mainFrame" id="ian120_5" onclick="toUrl(this,'b'),collapse_change(1205)">优惠管理</a></td></tr>
          <tr>
            <td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/register/list" target="mainFrame" id="ian120_6" onclick="toUrl(this,'b'),collapse_change(1206)">挂号列表</a></td></tr>		
           
		 </table>
		 
		 </td>
         </tr>
		 </tbody>
	</table>
    <hr/>
 
</div>

<div id="decision" name="mdecision" style="display:<?php echo $this->_tpl_vars['admindecision_index']; ?>
" >
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian146" onclick="collapse_change(146),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/layers.png" border="0" style="height:20px;" />决策综合统计面板</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_146" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(146),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_146" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr ><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
admindecision/index/index" id="ian146_8" target="_blank" onclick="toUrl(this,'b'),collapse_change(146)">决策综合统计面板</a></td></tr>		
		<tr ><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
admindecision/index/index/action/base" id="ian146_9" target="_blank" onclick="toUrl(this,'b')">基本情况</a></td></tr>
		<tr ><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
admindecision/index/index/action/public" id="ian146_10" target="_blank" onclick="toUrl(this,'b')">公共卫生</a></td></tr>
		<tr ><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
admindecision/index/index/action/his" id="ian146_11" target="_blank" onclick="toUrl(this,'b')">医疗业务</a></td></tr>
		 </table>     
		 </td></tr>
		 </tbody>
		 
	</table>
	  
</div>

<div id="decision" name="mdecision" style="display:<?php echo $this->_tpl_vars['mdecision']; ?>
" >
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian29" onclick="collapse_change(29),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/database_table.png" border="0" style="height:20px;" />医疗业务决策支持</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_29" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(29),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_29" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
mdecision/index/index" id="ian29_8" target="mainFrame" onclick="toUrl(this,'b'),collapse_change(298)">医疗业务分析</a></td></tr>
		 <tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
mdecision/ywsrtj/index" id="ian29_4" target="mainFrame" onclick="toUrl(this,'b')">业务收入分析</a></td></tr>
		<tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
mdecision/berth/index" id="ian29_5" target="mainFrame" onclick="toUrl(this,'b'),collapse_change(295)">床位使用情况分析</a></td></tr>
		<tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
mdecision/drug/index" id="ian29_6" onclick="toUrl(this,'b')" target="mainFrame">药品分析</a></td></tr>
				 <tbody id="menu_296" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">

					 </table>
					 </td></tr>
				 </tbody>
		<tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/orgbase/index" id="ian29_7" target="mainFrame" onclick="toUrl(this,'b')">医疗卫生资源分析</a></td></tr>
        <tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
mdecision/his/index" id="ian29_9" target="mainFrame" onclick="toUrl(this,'b')">入住院人数分析</a></td></tr>
        <tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
mdecision/jb/index" id="ian29_10" target="mainFrame" onclick="toUrl(this,'b')">疾病顺位分析</a></td></tr>
        <tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
mdecision/fee/index" id="ian29_11" target="mainFrame" onclick="toUrl(this,'b')">费用分类统计</a></td></tr>
        <tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
mdecision/drug/drug" id="ian29_12" target="mainFrame" onclick="toUrl(this,'b')">用药统计</a></td></tr>
		 </table>     
		 </td></tr>
		 </tbody>
		 
	</table>
	  
</div>

<div id="decision" name="decision" style="display:<?php echo $this->_tpl_vars['decision']; ?>
" >
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian2" onclick="collapse_change(2),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/chart_line.png" border="0" style="height:20px;" />公卫业务决策支持</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_2" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(2),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_2" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="###" id="ian2_1" onclick="toUrl(this,'b'),collapse_change(21)">基本档案</a></td></tr>
				 <tbody id="menu_21" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <!--iha/index/add-->
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/base/list" id="ian2_1_1" target="mainFrame" onclick="toUrl(this,'c')">建档率</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/rate/index" id="ian2_1_2" target="mainFrame" onclick="toUrl(this,'c')">平均档案完整率</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/fullrate/index/" id="ian2_1_3" target="mainFrame" onclick="toUrl(this,'c')">档案完整率分段统计</a></td></tr>
					 </table>
					 </td></tr>
				 </tbody>
		 <tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="###" id="ian2_4" onclick="toUrl(this,'b'),collapse_change(24)">健康体检</a></td></tr>
				 <tbody id="menu_24" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <!--iha/index/add-->
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/et/list" id="ian2_4_1" target="mainFrame" onclick="toUrl(this,'c')">建档率</a></td></tr>
					 </table>
					 </td></tr>
				 </tbody>
		<tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="###" id="ian2_3" onclick="toUrl(this,'b'),collapse_change(222)">慢病体检统计</a></td></tr>
				<tbody id="menu_222" style="display:none">
					<tr><td>
						<table border="0" cellpadding="0" cellspacing="0" class="leftmenuinfo2">
							<!--iha/index/add-->
							<tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/healthyet/index/type/t1" id="ian2_3_1" target="mainFrame" onclick="toUrl(this,'c')">高血压</a></td></tr>
							<tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/healthyet/index/type/t2" id="ian2_3_2" target="mainFrame" onclick="toUrl(this,'c')">糖尿病</a></td></tr>
							<tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/healthyet/index/type/t3" id="ian2_3_3" target="mainFrame" onclick="toUrl(this,'c')">重性精神疾病</a></td></tr>
						</table>
					</td></tr>
				</tbody> 
		<tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="###" id="ian2_5" onclick="toUrl(this,'b'),collapse_change(25)">健康教育活动</a></td></tr>
				 <tbody id="menu_25" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <!--iha/index/add-->
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/he/index" id="ian2_5_1" target="mainFrame" onclick="toUrl(this,'c')">综合统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/he/index/model/m1" id="ian2_5_2" target="mainFrame" onclick="toUrl(this,'c')">发放印刷资料</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/he/index/model/m2" id="ian2_5_3" target="mainFrame" onclick="toUrl(this,'c')">播放音像资料</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/he/index/model/m3" id="ian2_5_4" target="mainFrame" onclick="toUrl(this,'c')">咨询活动</a></td></tr>	
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/he/index/model/m4" id="ian2_5_5" target="mainFrame" onclick="toUrl(this,'c')">健康讲座</a></td></tr>
					 </table>
					 </td></tr>
				 </tbody>
		<tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="###" id="ian2_10" onclick="toUrl(this,'b'),collapse_change(210)">机构统计信息</a></td></tr>
				 <tbody id="menu_210" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/orgbase/index" id="ian2_10_1" target="mainFrame" onclick="toUrl(this,'c')">基本信息统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/orguser/index" id="ian2_10_2" target="mainFrame" onclick="toUrl(this,'c')">机构人员统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/orgbed/index"  id="ian2_10_3" target="mainFrame" onclick="toUrl(this,'c')">床位信息统计</a></td></tr> 
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/orgbuild/index"  id="ian2_10_4" target="mainFrame" onclick="toUrl(this,'c')">建筑信息统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/orgequipment/index"  id="ian2_10_5" target="mainFrame" onclick="toUrl(this,'c')">设备信息统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/orginout/index"  id="ian2_10_6" target="mainFrame" onclick="toUrl(this,'c')">收入支出统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/orgassets/index"  id="ian2_10_7" target="mainFrame" onclick="toUrl(this,'c')">资产负债统计</a></td></tr>
					  <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/orginfo/index"  id="ian2_10_8" target="mainFrame" onclick="toUrl(this,'c')">医疗服务统计</a></td></tr>
					  <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/orggeneral/index"  id="ian2_10_9" target="mainFrame" onclick="toUrl(this,'c')">基本信息概述</a></td></tr>	
					  <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/bedpie/index"  id="ian2_10_10" target="mainFrame" onclick="toUrl(this,'c')">床位信息折线统计图</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/building/index"  id="ian2_10_11" target="mainFrame" onclick="toUrl(this,'c')">建筑信息折线统计图</a></td></tr>		  
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/equipment/index"  id="ian2_10_12" target="mainFrame" onclick="toUrl(this,'c')">设备信息折线统计图</a></td></tr>		  
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/persons/index"  id="ian2_10_12" target="mainFrame" onclick="toUrl(this,'c')">人员信息折线统计图</a></td></tr>		  
					 </table>
					 </td></tr>
				 </tbody>
		  <tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="###" id="ian2_2" onclick="toUrl(this,'b'),collapse_change(22)">慢病考核指标</a></td></tr>
				 <tbody id="menu_22" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <!--iha/index/add-->

					 <tr><td><span><img id="menuimg_2311" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(2311),toUrl(this,'b')" /></span><a href="###" id="ian2_3_1"  onclick="toUrl(this,'b'),collapse_change(2311)">高血压</a></td></tr>
					 <tbody id="menu_2311" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/hypertension/index" id="ian2_3_1_1" target="mainFrame" onclick="toUrl(this,'c')">综合统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/hypertension/index/model/m1" id="ian2_3_1_2" target="mainFrame" onclick="toUrl(this,'c')">健康管理率</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/hypertension/index/model/m2" id="ian2_3_1_3" target="mainFrame" onclick="toUrl(this,'c')">规范管理率</a></td></tr>
					  <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/hypertension/index/model/m3" id="ian2_3_1_4" target="mainFrame" onclick="toUrl(this,'c')">血压控制率</a></td></tr>
					  </table>
					 </td></tr>
				 </tbody>
					 <tr><td><span><img id="menuimg_2321" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(2321),toUrl(this,'b')" /></span><a href="###" id="ian2_3_2"  onclick="toUrl(this,'b'),collapse_change(2321)">糖尿病</a></td></tr>
					 <tbody id="menu_2321" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/diabetes/index" id="ian2_3_2_1" target="mainFrame" onclick="toUrl(this,'c')">综合统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/diabetes/index/model/m1" id="ian2_3_2_2" target="mainFrame" onclick="toUrl(this,'c')">健康管理率</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/diabetes/index/model/m2" id="ian2_3_2_3" target="mainFrame" onclick="toUrl(this,'c')">规范管理率</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/diabetes/index/model/m3" id="ian2_3_2_4" target="mainFrame" onclick="toUrl(this,'c')">血糖控制率</a></td></tr>
					  </table>
					 </td></tr>
				 </tbody>
				 	 <tr><td><span><img id="menuimg_2331" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(2331),toUrl(this,'b')" /></span><a href="###" id="ian2_3_3" onclick="toUrl(this,'b'),collapse_change(2331)">重性精神疾病</a></td></tr>
					 <tbody id="menu_2331" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/schizophrenia/index" id="ian2_3_3_1" target="mainFrame" onclick="toUrl(this,'c')">综合统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/schizophrenia/mentalillness" id="ian2_3_3_2" target="mainFrame" onclick="toUrl(this,'c')">患者管理率</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/schizophrenia/standadmin" id="ian2_3_3_4" target="mainFrame" onclick="toUrl(this,'c')">规范管理率</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/schizophrenia/goodrate" id="ian2_3_3_3" target="mainFrame" onclick="toUrl(this,'c')">患者稳定率</a></td></tr>
					 
					  </table>
					 </td></tr>
				 </tbody>
					 </table>
					 </td></tr>
				 </tbody>
                 
                 <tr style="display:<?php echo $this->_tpl_vars['decision_base']; ?>
"><td><a href="###" id="ian2_13" onclick="toUrl(this,'b'),collapse_change(213)">慢病综合统计</a></td></tr>
				 <tbody id="menu_213" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <!--iha/index/add-->

					 <tr><td><span><img id="menuimg_21311" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(21311),toUrl(this,'b')" /></span><a href="###" id="ian2_13_1"  onclick="toUrl(this,'b'),collapse_change(21311)">高血压</a></td></tr>
					 <tbody id="menu_21311" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/clinical/index/model/hy/type/sex" id="ian2_13_1_1" target="mainFrame" onclick="toUrl(this,'c')">按性别统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/clinical/index/model/hy/type/age" id="ian2_13_1_2" target="mainFrame" onclick="toUrl(this,'c')">按年龄段统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/clinical/index/model/hy/type/occupation" id="ian2_13_1_3" target="mainFrame" onclick="toUrl(this,'c')">按职业统计</a></td></tr>
                     <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/clinical/map/model/hy" id="ian2_13_1_4" target="mainFrame" onclick="toUrl(this,'c')">地区分布统计</a></td></tr>
					  </table>
					 </td></tr>
				 </tbody>
					 <tr><td><span><img id="menuimg_21321" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(21321),toUrl(this,'b')" /></span><a href="###" id="ian2_13_2"  onclick="toUrl(this,'b'),collapse_change(21321)">糖尿病</a></td></tr>
					 <tbody id="menu_21321" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/clinical/index/model/di/type/sex" id="ian2_13_2_1" target="mainFrame" onclick="toUrl(this,'c')">按性别统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/clinical/index/model/di/type/age" id="ian2_13_2_2" target="mainFrame" onclick="toUrl(this,'c')">按年龄段统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/clinical/index/model/di/type/occupation" id="ian2_13_2_3" target="mainFrame" onclick="toUrl(this,'c')">按职业统计</a></td></tr>
                     <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/clinical/map/model/di" id="ian2_13_2_4" target="mainFrame" onclick="toUrl(this,'c')">地区分布统计</a></td></tr>
					  </table>
					 </td></tr>
				 </tbody>
				 	 <tr><td><span><img id="menuimg_21331" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(21331),toUrl(this,'b')" /></span><a href="###" id="ian2_13_3" onclick="toUrl(this,'b'),collapse_change(21331)">重性精神疾病</a></td></tr>
					 <tbody id="menu_21331" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/clinical/index/model/sc/type/sex" id="ian2_13_3_1" target="mainFrame" onclick="toUrl(this,'c')">按性别统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/clinical/index/model/sc/type/age" id="ian2_13_3_2" target="mainFrame" onclick="toUrl(this,'c')">按年龄段统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/clinical/index/model/sc/type/occupation" id="ian2_13_3_3" target="mainFrame" onclick="toUrl(this,'c')">按职业统计</a></td></tr>
                     <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/clinical/map/model/sc" id="ian2_13_3_4" target="mainFrame" onclick="toUrl(this,'c')">地区分布统计</a></td></tr>
					  </table>
					 </td></tr>
				 </tbody>
					 </table>
					 </td></tr>
				 </tbody>
                 
				 <tr style="display:<?php echo $this->_tpl_vars['elder_index']; ?>
"><td><a href="###" id="ian2_6" onclick="toUrl(this,'b'),collapse_change(26)">老年人服务管理</a></td></tr>
				 <tbody id="menu_26" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/statistics/list" id="ian2_6_1" target="mainFrame" onclick="toUrl(this,'c')">老年人考核统计</a></td></tr>
					 </table>
					 </td></tr>
				 </tbody>
				 <tr style="display:<?php echo $this->_tpl_vars['decision_children']; ?>
"><td><a href="###" id="ian2_7" onclick="toUrl(this,'b'),collapse_change(27)">儿童健康管理</a></td></tr>
				 <tbody id="menu_27" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/children/index" id="ian2_7_1" target="mainFrame" onclick="toUrl(this,'c')">儿童健康管理率统计</a></td></tr>
					 </table>
					 </td></tr>
				 </tbody>
				 <tr style="display:<?php echo $this->_tpl_vars['decision_maternal']; ?>
"><td><a href="###" id="ian2_8" onclick="toUrl(this,'b'),collapse_change(28)">孕产妇健康管理</a></td></tr>
				 <tbody id="menu_28" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/maternal/index" id="ian2_8_1" target="mainFrame" onclick="toUrl(this,'c')">综合统计</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/maternal/index/model/m1" id="ian2_8_2" target="mainFrame" onclick="toUrl(this,'c')">产前随访</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/maternal/index/model/m2" id="ian2_8_3" target="mainFrame" onclick="toUrl(this,'c')">产后访视</a></td></tr>
					 <tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/maternal/index/model/m3" id="ian2_8_4" target="mainFrame" onclick="toUrl(this,'c')">产后体检</a></td></tr>
					 </table>
					 </td></tr>
				 </tbody>
				 <tr style="display:<?php echo $this->_tpl_vars['decision_logs']; ?>
"><td><a href="###" id="ian2_9" onclick="toUrl(this,'b'),collapse_change(77)">接口日志管理</a></td></tr>
				 <tbody id="menu_77" style="display:none">
				   	<tr><td>
				  		<table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
				  		<tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/logs/index/type/day" id="ian2_9_1" target="mainFrame" onclick="toUrl(this,'c')">接口日报统计</a></td></tr>
				  		<tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/logs/index/type/month" id="ian2_9_2" target="mainFrame" onclick="toUrl(this,'c')">接口月报统计</a></td></tr>
				  		<tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/logs/index/type/year" id="ian2_9_3" target="mainFrame" onclick="toUrl(this,'c')">接口年报统计</a></td></tr>
				  		</table>
				  	</td></tr>
				 </tbody>
				 <tr style="display:<?php echo $this->_tpl_vars['decision_target']; ?>
"><td><a href="###" id="ian2_11" onclick="toUrl(this,'b'),collapse_change(211)">业务指标监管</a></td></tr>
				 <tbody id="menu_211" style="display:none">
				   	<tr><td>
				  		<table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
				  		<tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/target/index" id="ian2_11_1" target="mainFrame" onclick="toUrl(this,'c')">综合监管</a></td></tr>
				  		<tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/target/index/type/workload" id="ian21_1_2" target="mainFrame" onclick="toUrl(this,'c')">工作量指标监管</a></td></tr>
				  		<tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/target/index/type/efficiency" id="ian2_11_3" target="mainFrame" onclick="toUrl(this,'c')">效率指标监管</a></td></tr>
				  		<tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/target/index/type/quality" id="ian2_11_4" target="mainFrame" onclick="toUrl(this,'c')">质量指标监管</a></td></tr>
				  		<tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/target/index/type/cost" id="ian2_11_5" target="mainFrame" onclick="toUrl(this,'c')">费用指标监管</a></td></tr>
				  		<tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/target/index/type/medicine" id="ian2_11_6" target="mainFrame" onclick="toUrl(this,'c')">用药情况指标监管</a></td></tr>
				  		<tr><td><span>●</span><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
decision/target/index/type/dispute" id="ian2_11_7" target="mainFrame" onclick="toUrl(this,'c')">医疗纠纷指标监管</a></td></tr>
				  		</table>
				  	</td></tr>
				 </tbody>
		 </table>     
		 </td></tr>
		 </tbody>
		 
	</table>
	  
</div>

<div id="jinshi_fuyou" name="jinshi_fuyou" style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
" >
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian44" onclick="collapse_change(44),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/presentation.png" border="0" style="height:20px;" />妇幼业务决策支持</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_44" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(44),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_44" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
				 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="###" id="ian44_1" onclick="toUrl(this,'b'),collapse_change(441)">孕产妇保健</a></td></tr>
				 <tbody id="menu_441" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_fxjc_jbqk.aspx?website=ycfbj&rhin=ehrplat&region=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian44_1_1" target="mainFrame" onclick="toUrl(this,'c')">基本情况</a></td></tr>
					 <tr><td><span>●</span><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_fxjc_gwjbqk.aspx?website=ycfbj&rhin=ehrplat&region=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian44_1_2" target="mainFrame" onclick="toUrl(this,'c')">高危孕产妇</a></td></tr>
					 <tr><td><span>●</span><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_chfsdfp_cx.aspx?website=ycfbj&rhin=ehrplat&region=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian44_1_3" target="mainFrame" onclick="toUrl(this,'c')">产后访视安排</a></td></tr>
					 <tr><td><span>●</span><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_bbtj_tjfx.aspx?website=ycfbj&rhin=ehrplat&region=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian44_1_4" target="mainFrame" onclick="toUrl(this,'c')">统计分析</a></td></tr>
                     <tr><td><span>●</span><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/ycfbj/ycfbj_jxgl_tjfx.aspx?website=ycfbj&rhin=ehrplat&region=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian44_1_5" target="mainFrame" onclick="toUrl(this,'c')">绩效管理</a></td></tr>
					 </table>
					 </td></tr>
				 </tbody>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="###" id="ian44_2" onclick="toUrl(this,'b'),collapse_change(442)">出生医学证明</a></td></tr>
				 <tbody id="menu_442" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/cszm/cszm_fxjc_jbqk1.aspx?website=cszm&rhin=ehrplat&region=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian44_2_1" target="mainFrame" onclick="toUrl(this,'c')">证明签发</a></td></tr>
					 <tr><td><span>●</span><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/cszm/cszm_bbtj_tjfx.aspx?website=cszm&rhin=ehrplat&region=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian44_2_2" target="mainFrame" onclick="toUrl(this,'c')">统计分析</a></td></tr>
					 </table>
					 </td></tr>
				 </tbody>
                 <tr style="display:<?php echo $this->_tpl_vars['jinshi_fuyou']; ?>
"><td><a href="###" id="ian44_3" onclick="toUrl(this,'b'),collapse_change(443)">儿童保健</a></td></tr>
				 <tbody id="menu_443" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					 <tr><td><span>●</span><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_fxjc_jbqk.aspx?website=etbj&rhin=ehrplat&region=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian44_3_1" target="mainFrame" onclick="toUrl(this,'c')">基本情况</a></td></tr>
					 <tr><td><span>●</span><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_fxjc_trejbqk.aspx?website=etbj&rhin=ehrplat&region=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian44_3_2" target="mainFrame" onclick="toUrl(this,'c')">体弱儿专案</a></td></tr>
					 <tr><td><span>●</span><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_bbtj_tjfx.aspx?website=etbj&rhin=ehrplat&region=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian44_3_3" target="mainFrame" onclick="toUrl(this,'c')">统计分析</a></td></tr>
					 <tr><td><span>●</span><a href="http://<?php echo $this->_tpl_vars['jinshiip']; ?>
/etbj/etbj_jxgl_tjfx.aspx?website=etbj&rhin=ehrplat&region=<?php echo $this->_tpl_vars['standard_code']; ?>
" id="ian44_3_4" target="mainFrame" onclick="toUrl(this,'c')">绩效管理</a></td></tr>
					 </table>
					 </td></tr>
				 </tbody>
		 </table>     
		 </td></tr>
		 </tbody>
		 
	</table>
	  
</div>

<!--突发公共卫生事件-->
<div id="he_index"  style="display:<?php echo $this->_tpl_vars['phe_index']; ?>
">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian513" onclick="collapse_change(513),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/map.png" border="0" style="height:20px;" />突发公共卫生事件</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_513" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(513),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_513" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
phe/index/index" target="mainFrame" id="ian513_1" onclick="toUrl(this,'b'),collapse_change(5131)">事件报告列表</a></td></tr>
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
phe/index/edit" target="mainFrame" id="ian513_2" onclick="toUrl(this,'b'),collapse_change(5132)">添加突发事件</a></td></tr>
		 </table>
		 </td>
         </tr>
		 </tbody>
	</table>
	<hr />
</div>

<div id="director_index"  style="display:<?php echo $this->_tpl_vars['director_index']; ?>
">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian17" onclick="collapse_change(17),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/newspaper.png" border="0" style="height:20px;" />
		 院长查询</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_17" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(17),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_17" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
director/index/index" target="mainFrame" id="ian17_1" onclick="toUrl(this,'b'),collapse_change(91)">院长日报</a></td></tr>
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
director/listusers/index" target="mainFrame" id="ian17_2" onclick="toUrl(this,'b'),collapse_change(91)">人员类别一览</a></td></tr>
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
director/calwork/index" target="mainFrame" id="ian17_3" onclick="toUrl(this,'b'),collapse_change(91)">工作量统计</a></td></tr>
		 </table>
		 </td>
         </tr>
		 </tbody>
	</table>
</div>

<div id="rate_index"  style="display:<?php echo $this->_tpl_vars['rate_index']; ?>
">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian9" onclick="collapse_change(9),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/chart_organisation.png" border="0" style="height:20px;" />
		 评价指标体系</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_9" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(9),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_9" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
rate/index/index" target="mainFrame" id="ian9_1" onclick="toUrl(this,'b'),collapse_change(91)">档案完整率</a></td></tr>
		 </table>
		 </td>
         </tr>
		 </tbody>
	</table>
	<hr />
</div>



<div id="document_doc"  style="display:<?php echo $this->_tpl_vars['document_doc']; ?>
">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian33" onclick="collapse_change(33),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/note.png" border="0" style="height:20px;" />
		 公文收发</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_33" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(33),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_33" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
document/doc/sendlist" target="mainFrame" id="ian33_1" onclick="toUrl(this,'b'),collapse_change(331)">发件箱</a></td></tr>
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
document/doc/inbox" target="mainFrame" id="ian33_2" onclick="toUrl(this,'b'),collapse_change(332)">收件箱</a></td></tr>
		 </table>
		 </td>
         </tr>
		 </tbody>
	</table>
</div>

<div id="api_list"  style="display:<?php echo $this->_tpl_vars['api_list']; ?>
">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian34" onclick="collapse_change(34),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/connect.png" border="0" style="height:20px;" />
		 数据总线接口</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_34" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(34),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_34" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="###"  id="ian34_1" onclick="toUrl(this,'b'),collapse_change(341)">基本档案接口</a></td></tr>
		 <tr><td><a href="###"  id="ian34_2" onclick="toUrl(this,'b'),collapse_change(342)">健康体检表口</a></td></tr>
		 <tr><td><a href="###"  id="ian34_3" onclick="toUrl(this,'b'),collapse_change(343)">慢病接口</a></td></tr>
		 <tr><td><a href="###"  id="ian34_4" onclick="toUrl(this,'b'),collapse_change(344)">LIS接口</a></td></tr>
		 <tr><td><a href="###"  id="ian34_5" onclick="toUrl(this,'b'),collapse_change(345)">PACS接口</a></td></tr>
		 <tr><td><a href="###"  id="ian34_6" onclick="toUrl(this,'b'),collapse_change(346)">CDA测试接口</a></td></tr>
		 

		 </table>
		 </td>
         </tr>
		 </tbody>
	</table>
</div>
<div id="tp_index"  style="display:<?php echo $this->_tpl_vars['tp_list']; ?>
">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian36" onclick="collapse_change(36),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/calendar_view_day.png" border="0" style="height:20px;" />
		 每日提醒</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_36" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(36),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_36" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
tp/index/index/day/today" target="mainFrame"  id="ian36_1" onclick="toUrl(this,'b')">每日提醒</a></td></tr>
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
tp/index" target="mainFrame"  id="ian36_2" onclick="toUrl(this,'b')">工作计划</a></td></tr>
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
planmenu/planmenu/list" target="mainFrame" id="ian36_3" onclick="toUrl(this,'b')">计划类型维护</a></td></tr>
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
tp/sms/havesend" target="mainFrame" id="ian36_3" onclick="toUrl(this,'b')">已发短信统计</a></td></tr>
		

		 </table>
		 </td>
         </tr>
		 </tbody>
	</table>
</div>

<div id="admin" name="admin"   >
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian99" onclick="collapse_change(99),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/computer.png" border="0" style="height:20px;" />
		 系统管理</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_99" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(99),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_99" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr style="display:<?php echo $this->_tpl_vars['admin_roles']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
admin/roles/display" target="mainFrame" id="ian99_1" onclick="toUrl(this,'b'),collapse_change(991)">角色管理</a></td></tr>		
         <tr style="display:<?php echo $this->_tpl_vars['admin_resource']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
admin/resource/display" target="mainFrame" id="ian99_2" onclick="toUrl(this,'b'),collapse_change(992)">资源管理</a></td></tr>	
         <tr style="display:<?php echo $this->_tpl_vars['admin_grant']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
admin/grant/index" target="mainFrame"  id="ian99_3" onclick="toUrl(this,'b'),collapse_change(993)">角色授权管理</a></td></tr>	
         <tr style="display:<?php echo $this->_tpl_vars['region_region']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
region/region/index"  target="mainFrame" id="ian99_4" onclick="toUrl(this,'b'),collapse_change(994)">地区管理</a></td></tr>	
         <tr style="display:<?php echo $this->_tpl_vars['organization_region']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
organization/region/index"  target="mainFrame" id="ian99_5" onclick="toUrl(this,'b'),collapse_change(995)">机构管理</a></td></tr>	
         <tr style="display:<?php echo $this->_tpl_vars['dictionary_dictionary']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
dictionary/dictionary/index" target="mainFrame" id="ian99_6" onclick="toUrl(this,'b'),collapse_change(996)">数据字典</a></td></tr>	
         <tr style="display:<?php echo $this->_tpl_vars['admin_users']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
admin/users/index/region_id/<?php echo $this->_tpl_vars['user']['region_id']; ?>
/org_id/<?php echo $this->_tpl_vars['user']['org_id']; ?>
/go_back/true" target="mainFrame" id="ian99_7" onclick="toUrl(this,'b'),collapse_change(997)">用户管理</a></td></tr>
         <tr style="display:<?php echo $this->_tpl_vars['admin_users']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
admin/users/export/region_id/<?php echo $this->_tpl_vars['user']['region_id']; ?>
/org_id/<?php echo $this->_tpl_vars['user']['org_id']; ?>
/go_back/true" target="mainFrame" id="ian99_7" onclick="toUrl(this,'b'),collapse_change(997)">导出用户</a></td></tr>
         <tr style="display:<?php echo $this->_tpl_vars['organization_orgext']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
organization/orgext/list" target="mainFrame" id="ian99_8" onclick="toUrl(this,'b')">机构信息</a></td></tr>	
         <tr style="display:<?php echo $this->_tpl_vars['organization_chart']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
organization/chart/index"  id="ian99_999" onclick="toUrl(this,'b')" target="_top">机构资源曲线统计</a></td></tr>	
         <tr style="display:<?php echo $this->_tpl_vars['wsmodule_wsmanage']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
wsmodule/wsmanage/index" target="mainFrame" id="ian99_1_4" onclick="toUrl(this,'b')">标准模块维护</a></td></tr>
         <tr style="display:<?php echo $this->_tpl_vars['wsmodule_wsmanage']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/infmanage/index" target="mainFrame" id="ian99_1_5" onclick="toUrl(this,'b')">标准代码维护</a></td></tr>
         <tr style="display:<?php echo $this->_tpl_vars['wsmodule_wsmanage']; ?>
" ><td>
         <a href="###" id="ian15_3" onclick="collapse_change(250),toUrl(this,'b')">接口模块管理</a></td></tr>
         			<tbody id="menu_250" style="display:none">
					 <tr ><td>
					 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo2">
					<tr ><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/manage/index" target="mainFrame" id="ian99_1_6" onclick="toUrl(this,'b')"><span>●</span>接口模块维护</a></td></tr>
					<!--
					<tr ><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/interface/index" target="mainFrame" id="ian99_1_6" onclick="toUrl(this,'b')"><span>●</span>接口模块维护</a></td></tr>
          <tr ><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/moduleinfo/index" target="mainFrame" id="ian99_1_6" onclick="toUrl(this,'b')"><span>●</span>接口模块详细</a></td></tr>
                      -->		  
					  </table>
					 </td></tr>
				    </tbody>
		 <tr style="display:<?php echo $this->_tpl_vars['rate_manage']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
rate/manage/index" target="mainFrame" id="ian99_9" onclick="toUrl(this,'b')">完整率初始化</a></td></tr>
		 <tr style="display:<?php echo $this->_tpl_vars['rate_manage']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
rate/manage/list" target="mainFrame" id="ian99_1_0" onclick="toUrl(this,'b')">完整率管理</a></td></tr>	
         <tr style="display:<?php echo $this->_tpl_vars['admin_users']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/cover/loglist" target="mainFrame" id="ian99_1_1" onclick="toUrl(this,'b')">日志管理</a></td></tr>	
         <tr style="display:<?php echo $this->_tpl_vars['admin_resetpasswd']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
admin/resetpasswd" target="mainFrame" id="ian99_1_2" onclick="toUrl(this,'b')">修改密码</a></td></tr>
         <tr style="display:<?php echo $this->_tpl_vars['loging_log']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
loging/log" target="mainFrame" id="ian99_13" onclick="toUrl(this,'b')">登录日志</a></td></tr>
         <tr style="display:<?php echo $this->_tpl_vars['coding_index']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
coding/index" target="mainFrame" id="ian99_14" onclick="toUrl(this,'b')">药品分类维护</a></td></tr>
         <tr style="display:<?php echo $this->_tpl_vars['coding_medicine']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
coding/medicine/index" target="mainFrame" id="ian99_15" onclick="toUrl(this,'b')">药品维护列表</a></td></tr>
         <tr style="display:<?php echo $this->_tpl_vars['coding_measure']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
coding/measure/index" target="mainFrame" id="ian99_16" onclick="toUrl(this,'b')">药品单位管理</a></td></tr>
         <tr style="display:<?php echo $this->_tpl_vars['coding_formulations']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
coding/formulations/index" target="mainFrame" id="ian99_17" onclick="toUrl(this,'b')">药品剂型管理</a></td></tr>
         <tr style="display:<?php echo $this->_tpl_vars['coding_specification']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
coding/specification/index" target="mainFrame" id="ian99_18" onclick="toUrl(this,'b')">药品规格管理</a></td></tr>
          <tr style="display:<?php echo $this->_tpl_vars['coding_disease']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
coding/disease/index" target="mainFrame" id="ian99_19" onclick="toUrl(this,'b')">疾病分类维护</a></td></tr>
          <tr style="display:<?php echo $this->_tpl_vars['coding_disease']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
coding/diseasename/index" target="mainFrame" id="ian99_20" onclick="toUrl(this,'b')">疾病名称管理</a></td></tr>
          <tr style="display:<?php echo $this->_tpl_vars['coding_consumables']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
coding/consumables/index" target="mainFrame" id="ian99_21" onclick="toUrl(this,'b')">卫生耗材分类管理</a></td></tr>
          <tr style="display:<?php echo $this->_tpl_vars['coding_conmeasure']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
coding/conmeasure/index" target="mainFrame" id="ian99_22" onclick="toUrl(this,'b')">卫生耗材单位管理</a></td></tr>
          <tr style="display:<?php echo $this->_tpl_vars['coding_conspecification']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
coding/conspecification/index" target="mainFrame" id="ian99_23" onclick="toUrl(this,'b')">卫生耗材规格管理</a></td></tr>
          <tr style="display:<?php echo $this->_tpl_vars['coding_materials']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
coding/materials/index" target="mainFrame" id="ian99_24" onclick="toUrl(this,'b')">卫生耗材编码管理</a></td></tr>
          <tr style="display:<?php echo $this->_tpl_vars['coding_clinic']; ?>
"><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
coding/clinic/index" target="mainFrame" id="ian99_25" onclick="toUrl(this,'b')">诊疗项目编码管理</a></td></tr>
		 </table>
		 </td>
         </tr>
		 </tbody>
	</table>
</div>
<div id="tp_index"  style="display:<?php echo $this->_tpl_vars['web_index']; ?>
">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian98" onclick="collapse_change(98),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/calendar_view_day.png" border="0" style="height:20px;" />
		 门户管理</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_98" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(98),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_98" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/sort/index" target="mainFrame"  id="ian98_1" onclick="toUrl(this,'b')">栏目管理</a></td></tr>
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/index/index" target="mainFrame"  id="ian98_2" onclick="toUrl(this,'b')">文章管理</a></td></tr>
		 </table>
		 </td>
         </tr>
		 </tbody>
	</table>
</div>

<div id="weixin_index"  style="display:<?php echo $this->_tpl_vars['web_index']; ?>
">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian97" onclick="collapse_change(97),toUrl(this,'a')"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/calendar_view_day.png" border="0" style="height:20px;" />
		 微门户管理</a></span>
		 <span style="float:right;padding-top:5px;padding-right:8px;"><a href="###"><img id="menuimg_97" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_add.gif" border="0" onclick="collapse_change(97),toUrl(this,'a')" /></a></span>
		 </td></tr>
		 <tbody id="menu_97" style="display:none">
		 <tr class="leftmenutd"><td>
		 <table border="0" cellspacing="0" cellpadding="0" class="leftmenuinfo">
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/setorg/index" target="mainFrame"  id="ian97_1" onclick="toUrl(this,'b')">微门户系统设置</a></td></tr>
		 <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/module/index" target="mainFrame"  id="ian97_2" onclick="toUrl(this,'b')">模块管理</a></td></tr>
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/user/index" target="mainFrame"  id="ian97_3" onclick="toUrl(this,'b')">微用户管理</a></td></tr>
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/notice/index" target="mainFrame"  id="ian97_4" onclick="toUrl(this,'b')">机构通知管理</a></td></tr>
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/ask/list" target="mainFrame"  id="ian97_5" onclick="toUrl(this,'b')">智能问答管理</a></td></tr>
         <tr><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/logs/index" target="mainFrame"  id="ian97_8" onclick="toUrl(this,'b')">微信日志管理</a></td></tr>
		 </table>
		 </td>
         </tr>
		 </tbody>
	</table>
</div>

<div id="lougout">
	<table  border="0" cellspacing="0" align="center" cellpadding="0" class="leftmenulist" style="margin-bottom: 5px;">
		 <tr class="leftmenutext">
		<td>
		 <span style="float:left;"><a href="###" id="ian12" onclick="window.top.location.href='<?php echo $this->_tpl_vars['baseUrl']; ?>
loging/index/logout'"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/server_go.png" border="0" style="height:20px;" />
		 退出</a></span>
		 </td></tr>
	</table>
</div>

<!--div  style="width:146;margin:3px 0 0 0;padding:1px 0 0 4px;">
    <div style="background-color:#FFFFCE;padding:2px">
        内部版本号:<?php echo $this->_tpl_vars['version_svn']; ?>

    </div>
</div-->

</body>
</html>
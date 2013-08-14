<?php /* Smarty version 2.6.14, created on 2013-05-21 10:49:15
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script type="text/javascript"  src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/objectSwap.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>
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
views/js/jquery.lazyload.flash.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/decision_list.js" type="text/javascript"></script>
<script type="text/javascript">
  function mymap(n){
  	window.location="<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/index/index/region_id/"+n+"/action/<?php echo $this->_tpl_vars['action']; ?>
";
  }
</script>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css" />
    <link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<title>决策综合统计面板<?php if (( $this->_tpl_vars['action'] == 'base' )): ?>-基本情况<?php elseif (( $this->_tpl_vars['action'] == 'public' )): ?>-公共卫生<?php elseif (( $this->_tpl_vars['action'] == 'his' )): ?>-医疗业务<?php endif; ?></title>
</head>
 
<body>
<?php if (( $this->_tpl_vars['action'] == 'base' ) || $this->_tpl_vars['action'] == ''): ?>
<table width="100%" border= "0"  cellspacing= "0"  cellpadding= "0">
  <tr>
    <td rowspan="4" style="width: 120px;vertical-align: top;">
     <script type="text/javascript">
	             writeFlashHTML("_swf=<?php echo $this->_tpl_vars['basePath']; ?>
views/images/images_index/map.swf", "_width=309px", "_height=414px","_wmode=transparent");
          </script>
    </td>
    <td id="hospital" colspan="3">
    <script language="JavaScript" type="text/javascript">
			//alert($("td").html());
			//showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/orgresource/list/region_id/<?php echo $this->_tpl_vars['reginid']; ?>
/type/<?php echo $this->_tpl_vars['k']; ?>
",$('#hospital'));        	
	 </script>
	   <table width="100%">
			   <tr class="headbg">
			     <td colspan="6">卫生机构资源</td>
			   </tr>
			   <tr class="columnbg">
			     <td>地区</td>
			     <td>行政机构</td>
			     <td>执法机构</td>
			     <td>医院</td>
			     <td>社区</td>
			     <td>卫生院</td>
			   </tr>
			   <tr>
			     <td>名山</td>
			     <td>4</td>
			     <td>1</td>
			     <td>3</td>
			     <td>0</td>
			     <td>20</td>
			   </tr>
			   <tr>
			     <td>汉源</td>
			     <td>4</td>
			     <td>1</td>
			     <td>4</td>
			     <td>0</td>
			     <td>40</td>
			   </tr>
			   <tr>
			     <td>石棉</td>
			     <td>4</td>
			     <td>1</td>
			     <td>3</td>
			     <td>0</td>
			     <td>25</td>
			   </tr>
			   <tr>
			     <td>雨城</td>
			     <td>3</td>
			     <td>2</td>
			     <td>3</td>
			     <td>3</td>
			     <td>32</td>
			   </tr>
			   <tr>
			     <td>荥经</td>
			     <td>4</td>
			     <td>2</td>
			     <td>3</td>
			     <td>0</td>
			     <td>28</td>
			   </tr>
			   <tr>
			     <td>天全</td>
			     <td>3</td>
			     <td>1</td>
			     <td>4</td>
			     <td>0</td>
			     <td>29</td>
			   </tr>
			   <tr>
			     <td>芦山</td>
			     <td>4</td>
			     <td>1</td>
			     <td>3</td>
			     <td>0</td>
			     <td>20</td>
			   </tr>
			   <tr>
			     <td>宝兴</td>
			     <td>3</td>
			     <td>1</td>
			     <td>3</td>
			     <td>0</td>
			     <td>28</td>
			   </tr>
			   <tr class="title">
			     <td>合计</td>
			     <td>29</td>
			     <td>10</td>
			     <td>28</td>
			     <td>3</td>
			     <td>157</td>
			   </tr>
			</table>
    </td>
  </tr>
   <tr>
    <td id='userresource' colspan="3" style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			//alert($("td").html());
			//showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/orguser/list/region_id/<?php echo $this->_tpl_vars['reginid']; ?>
",$('#userresource'));
			</script>
			<table width="100%">
			   <tr class="headbg">
			     <td colspan="5">卫生人力资源</td>
			   </tr>
			   <tr class="columnbg">
			     <td>地区</td>
			     <td>执业医师</td>
			     <td>注册护士</td>
			     <td>药师</td>
			     <td>技师</td>
			   </tr>
			   <tr>
			     <td>名山</td>
			     <td>289</td>
			     <td>216</td>
			     <td>0</td>
			     <td>0</td>
			   </tr>
			   <tr>
			     <td>汉源</td>
			     <td>312</td>
			     <td>324</td>
			     <td>0</td>
			     <td>0</td>
			   </tr>
			   <tr>
			     <td>石棉</td>
			     <td>302</td>
			     <td>250</td>
			     <td>0</td>
			     <td>0</td>
			   </tr>
			   <tr>
			     <td>雨城</td>
			     <td>314</td>
			     <td>246</td>
			     <td>0</td>
			     <td>0</td>
			   </tr>
			   <tr>
			     <td>荥经</td>
			     <td>306</td>
			     <td>233</td>
			     <td>0</td>
			     <td>0</td>
			   </tr>
			   <tr>
			     <td>天全</td>
			     <td>320</td>
			     <td>234</td>
			     <td>0</td>
			     <td>0</td>
			   </tr>
			   <tr>
			     <td>芦山</td>
			     <td>314</td>
			     <td>237</td>
			     <td>0</td>
			     <td>0</td>
			   </tr>
			   <tr>
			     <td>宝兴</td>
			     <td>268</td>
			     <td>256</td>
			     <td>0</td>
			     <td>0</td>
			   </tr>
			   <tr class="title">
			     <td>合计</td>
			     <td>2425</td>
			     <td>1971</td>
			     <td>0</td>
			     <td>0</td>
			   </tr>
			</table>
		</td>
        </tr>
   <tr>
		<td id='equipment' colspan="3" style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			//alert($("td").html());
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/orgequipment/list/region_id/<?php echo $this->_tpl_vars['reginid']; ?>
",$('#equipment'));
			</script>
		</td>
  </tr>
  <tr>
		<td id='building' colspan="3" style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			//alert($("td").html());
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/building/list/region_id/<?php echo $this->_tpl_vars['reginid']; ?>
",$('#building'));
			</script>
		</td>
  </tr>
</table>
<br />
<table width="100%">
<tr class="headbg">
<td colspan="5">信息统计图</td>
</tr>
     <tr align="center">
      <?php $_from = $this->_tpl_vars['myarray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		<td>
		<span class='lazyload' w='200' h='150' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_pie2' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/orgresource/bar<?php echo $this->_tpl_vars['k']; ?>
/region_id/<?php echo $this->_tpl_vars['reginid']; ?>
/type/<?php echo $this->_tpl_vars['k']; ?>
'></span>
		</td>
	<?php endforeach; endif; unset($_from); ?>
	   <td>
		<span class='lazyload' w='200' h='150' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_bar' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/orguser/bar/region_id/<?php echo $this->_tpl_vars['reginid']; ?>
/type/11","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		</td>
		<td>
		<span class='lazyload' w='200' h='150' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_pie' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/orgequipment/pie/region_id/<?php echo $this->_tpl_vars['reginid']; ?>
","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		</td>
  </tr>
</table>
<?php endif; ?>

<?php if (( $this->_tpl_vars['action'] == 'public' ) || $this->_tpl_vars['action'] == ''): ?>
<table border="1">
	<tr>
		<td id='list_iha_archive_number' style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			//alert($("td").html());
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/iha/list/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
",$('#list_iha_archive_number'));
			</script>
		</td>
		<td id="chart_line">
			<span class='lazyload' w='341' h='230' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_line' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/iha/line/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		</td>
		<td>
		<span class='lazyload' w='341' h='230' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_pie' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/iha/pie/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		</td>
		<td>
		<span class='lazyload' w='341' h='230' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_bar' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/iha/bar/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		</td>
	</tr>
	<tr align="center">
	   <td id="list_cm_pielist" style="vertical-align: top;"><!--健康体检列表-->
		<script language="JavaScript" type="text/javascript">
			//alert($("td").html());
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/cm/pielist/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
",$("#list_cm_pielist"));
		</script>
		</td>
	   <td>
		<!--健康体检饼图-->
		<span class='lazyload' w='341' h='184' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_bar' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/cm/pie/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		</td>
	  <td id='list_cm_hy' style="vertical-align: top;">
		    <!--高血压列表-->
			<script language="JavaScript" type="text/javascript">
			//alert($("td").html());
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/cm/listhy/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
",$('#list_cm_hy'));
			</script>
		</td>
	   <td>
		<!--高血压图-->
		<span class='lazyload' w='341' h='184' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_bar' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/cm/barhy/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		</td>
	</tr>
	<tr align="center">
	  <td id="list_cm_di" style="vertical-align: top;">
		     <!--糖尿病列表-->
			<script language="JavaScript" type="text/javascript">
			//alert($("td").html());
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/cm/listdi/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
",$("#list_cm_di"));
			</script>
		</td>
		<td>
		<!--糖尿病图-->
		<span class='lazyload' w='341' h='212' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_bar' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/cm/bardi/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		</td>
		<td id="list_cm_sc" style="vertical-align: top;">
		<!--重性精神分裂列表-->
		<script language="JavaScript" type="text/javascript">
			//alert($("td").html());
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/cm/listsc/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
",$('#list_cm_sc'));
		</script>
		</td>
		<td>
		<!--重性精神分裂图-->
		<span class='lazyload' w='341' h='212' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_bar' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/cm/barsc/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		</td>
	</tr>
	<tr align="center">
	   <td id="list_special" style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/special/list/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
",$('#list_special'));
			</script>
        </td>
       <td>
		<span class='lazyload' w='341' h='229' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='special_bar' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/special/bar","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
       </td>
       <td>
	    
		<span class='lazyload' w='341' h='229' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='special_older_pie' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/special/pie/type/older","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		
		</td>
		<td>
		
		<span class='lazyload' w='341' h='229' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='special_child_pie' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/special/pie/type/child","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		
		</td>
	</tr>
</table>
<?php endif;  if (( $this->_tpl_vars['action'] == 'his' ) || $this->_tpl_vars['action'] == ''): ?>
<table  width="100%">
   <tr align="center">
       <td>

		<span class='lazyload' w='330' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='special_maternal_pie' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/special/pie/type/maternal/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		

	</td>
	<td id="list_vacc" style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/vacc/list/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
",$('#list_vacc'));
			</script>
    </td>
    <td>
		<span class='lazyload' w='341' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='vacc_bar' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/vacc/bar/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
	</td>
	<td>
	   
		<span class='lazyload' w='330' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='special_vaccination_pie' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/vacc/pie/type/vaccination/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		
		
		
	</td>
   </tr>
   <tr align="center">
     <td>
	   
		<span class='lazyload' w='330' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='special_pre_marital_pie' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/vacc/pie/type/pre_marital/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		
	</td>
	<!--编制床位-->
	<td id='list_berth_archive_numberedcw' style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			//showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/berth/list/region/511028/field/edcw",$('#list_berth_archive_numberedcw'));
			</script>
			<table width="100%">
			   <tr class="headbg">
			     <td colspan="5">编制床位</td>
			   </tr>
			   <tr class="columnbg">
			     <td>地区</td>
			     <td>床位数</td>
			   </tr>
			   <tr>
			     <td>名山</td>
			     <td>857</td>
			   </tr>
			   <tr>
			     <td>汉源</td>
			     <td>858</td>
			   </tr>
			   <tr>
			     <td>石棉</td>
			     <td>789</td>
			   </tr>
			   <tr>
			     <td>雨城</td>
			     <td>877</td>
			   </tr>
			   <tr>
			     <td>荥经</td>
			     <td>856</td>
			   </tr>
			   <tr>
			     <td>天全</td>
			     <td>852</td>
			   </tr>
			   <tr>
			     <td>芦山</td>
			     <td>857</td>
			   </tr>
			   <tr>
			     <td>宝兴</td>
			     <td>861</td>
			   </tr>
			   <tr class="title">
			     <td align="center">合计</td>
			     <td align="center">6857 </td>
			   </tr>
			</table>
	</td>
	<td>
		<span class='lazyload' w='341' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_bar' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/berth/bar/field/edcw","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
	</td>
	   <td id='list_berth_archive_numberzyrs' style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/berth/list/region/511028/field/zyrs",$('#list_berth_archive_numberzyrs'));
			</script>
	</td>
   </tr>
</table>
<table width="100%">
  <tr class="headbg" align="center">
    <td colspan="9">2011年上半年 医疗卫生机构门诊和住院病人人均医药费用</td>
  </tr>
  <tr class="columnbg">
    <td rowspan="2">机构分类</td>
    <td rowspan="2">平均每诊疗人次医疗费(元)</td>
    <td></td>
    <td rowspan="2">平均每出院者住院医疗费（元）</td>
    <td></td>
    <td rowspan="2">出院者平均每日住院医疗费（元）</td>
    <td rowspan="2">门诊和住院药品收入(万元)</td>
    <td></td>
    <td rowspan="2">药品支出(万元)</td>
  </tr>
  <tr class="columnbg">
    <td>药费</td>
    <td>药费</td>
    <td>基本药物收入</td>
  </tr>
  <tr>
    <td>总  计</td>
    <td>123.01</td>
    <td>52.03 </td>
    <td>3838.07</td>
    <td>1412.26</td>
    <td>458.04</td>
    <td>243667</td>
    <td>67763</td>
    <td>247239</td>
  </tr>
  <tr>
    <td>一、医院</td>
    <td>95.16</td>
    <td>37.43</td>
    <td>3896.21</td>
    <td>1435.18</td>
    <td>379.13</td>
    <td>153718</td>
    <td>4363</td>
    <td>156110</td>
  </tr>
  <tr>
    <td>综合医院</td>
    <td>113.41</td>
    <td>47.29</td>
    <td>4184.39</td>
    <td>1659.35</td>
    <td>414.21</td>
    <td>121819</td>
    <td>3697</td>
    <td>122844</td>
  </tr>
  <tr>
    <td>中医医院</td>
    <td>64.72</td>
    <td>19.34</td>
    <td>2610.51</td>
    <td>829.48</td>
    <td>254.26</td>
    <td>25219</td>
    <td>666</td>
    <td>26554</td>
  </tr>
  <tr>
    <td>中西医结合医院</td>
    <td>94.85</td>
    <td>46.58</td>
    <td>3521.8</td>
    <td>1413.28</td>
    <td>256.84</td>
    <td>5140</td>
    <td>0</td>
    <td>5171</td>
  </tr>
  <tr>
    <td>民族医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td> 专科医院</td>
    <td>102.48</td>
    <td>87.85</td>
    <td>30766.19</td>
    <td>2480.38</td>
    <td>1864.48</td>
    <td>1541</td>
    <td>0</td>
    <td>1541</td>
  </tr>
  <tr>
    <td>口腔医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>眼科医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
    <tr>
    <td>耳鼻喉科医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
    <tr>
    <td> 肿瘤医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
    <tr>
    <td>心血管病医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
    <tr>
    <td> 胸科医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
    <tr>
    <td> 血液病医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
    <tr>
    <td> 妇产(科)医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
    <tr>
    <td>儿童医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
    <tr>
    <td>精神病医院</td>
    <td>102.48</td>
    <td>87.85</td>
    <td>30766.19</td>
    <td>2480.38</td>
    <td>1864.48</td>
    <td>1541</td>
    <td>0</td>
    <td>1541</td>
  </tr>
    <tr>
    <td>传染病医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
    <tr>
    <td>皮肤病医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
      <tr>
    <td>结核病医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
      <tr>
    <td>麻风病医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
      <tr>
    <td> 职业病医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
      <tr>
    <td>骨科医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
      <tr>
    <td> 康复医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
      <tr>
    <td>整形外科医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
      <tr>
    <td> 美容医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
      <tr>
    <td>其他专科医院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
   <tr>
    <td>护理院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
   <tr>
    <td>二.基层医疗卫生机构</td>
    <td>37.62</td>
    <td>24.44</td>
    <td>494.41</td>
    <td>296.50</td>
    <td>135.86</td>
    <td>23322</td>
    <td>2177</td>
    <td>25740</td>
  </tr>   <tr>
    <td>社区卫生服务中心(站)</td>
    <td>35.39</td>
    <td>13.60</td>
    <td>1288.87</td>
    <td>730.00</td>
    <td>179.25</td>
    <td>845</td>
    <td>49</td>
    <td>1073</td>
  </tr>   <tr>
    <td>社区卫生服务中心</td>
    <td>35.39</td>
    <td>13.60</td>
    <td>1288.87</td>
    <td>730.00</td>
    <td>179.25</td>
    <td>845</td>
    <td>49</td>
    <td>1073</td>
  </tr>   <tr>
    <td>社区卫生服务站</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>   <tr>
    <td> 卫生院</td>
    <td>37.70</td>
    <td>24.96</td>
    <td>477.35</td>
    <td>287.19</td>
    <td>133.98</td>
    <td>22456</td>
    <td>2128</td>
    <td>24667</td>
  </tr>   <tr>
    <td>街道卫生院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>   <tr>
    <td>乡镇卫生院</td>
    <td>37.70</td>
    <td>24.96</td>
    <td>477.35</td>
    <td>287.19</td>
    <td>133.98</td>
    <td>22456</td>
    <td>2128</td>
    <td>24667</td>
  </tr>   <tr>
    <td>中心卫生院</td>
    <td>41.16</td>
    <td>24.78</td>
    <td>591.81</td>
    <td>313.32</td>
    <td>140.23</td>
    <td>9070</td>
    <td>962</td>
    <td>10510</td>
  </tr>   <tr>
    <td>乡卫生院</td>
    <td>35.36</td>
    <td>25.08</td>
    <td>408.57</td>
    <td>271.50</td>
    <td>128.97</td>
    <td>13386</td>
    <td>1166</td>
    <td>14157</td>
  </tr>   <tr>
    <td>村卫生室</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>   <tr>
    <td>门诊部</td>
    <td>256.18</td>
    <td>229.21</td>
    <td>∞</td>
    <td>∞</td>
    <td>∞</td>
    <td>20</td>
    <td>0</td>
    <td>0</td>
  </tr>   <tr>
    <td>诊所.卫生所.医务室</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>   <tr>
    <td>护理站</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>   <tr>
    <td>诊所（医务室）</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>   <tr>
    <td>三.专业公共卫生机构</td>
    <td>22152.77</td>
    <td>8968.73</td>
    <td>257259.41</td>
    <td>85270.97</td>
    <td>63377.81</td>
    <td>66627</td>
    <td>61223</td>
    <td>65389</td>
  </tr>  
   <tr>
    <td>专科疾病防治院(所、站)</td>
    <td>28.57</td>
    <td>2.38</td>
    <td>∞</td>
    <td>∞</td>
    <td>∞</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
  </tr> 
    <tr>
    <td>专科疾病防治院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>  
    <tr>
    <td>专科疾病防治所(中心)</td>
    <td>28.57</td>
    <td>2.38</td>
    <td>∞</td>
    <td>∞</td>
    <td>∞</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
  </tr>  
  <tr>
    <td>妇幼保健院(所、站)</td>
    <td>22394.13</td>
    <td>9066.55</td>
    <td>257256.45</td>
    <td>85270.97</td>
    <td>63377.09</td>
    <td>66627</td>
    <td>61223</td>
    <td>65389</td>
  </tr>  
<tr>
    <td> 内: 妇幼保健院</td>
    <td>22394.13</td>
    <td>9066.55</td>
    <td>257256.45</td>
    <td>85270.97</td>
    <td>63377.09</td>
    <td>66627</td>
    <td>61223</td>
    <td>65389</td>
  </tr>   
   <tr>
    <td>妇幼保健所(站)</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>   <tr>
    <td>四.其他机构</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>   <tr>
    <td> 疗养院</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<table width="100%">
    <tr align="center">
       <td>
		<span class='lazyload' w='341' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_bar' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ylyw/bar/field/mzrc","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
	</td>
   	
		<td>
			<span class='lazyload' w='341' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_line' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ylyw/bar/field/ryrc","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		</td>
		<td id='list_ylyw_archive_numberzyrs' style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ylyw/list/region/511028/field/zyrs",$('#list_ylyw_archive_numberzyrs'));
			</script>
		</td>  
	<td>
			<span class='lazyload' w='341' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_line' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ylyw/bar/field/zyrs","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
		</td>
   </tr>  
</table>
<table align="center">
   <tr>
   <!--mjzylfy-->
    <td>
		<span class='lazyload' w='309' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_line' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ywsrtj/bar/field/mjzylfy","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
  </td>
	 <!--zyylfy-->
    <td colspan="2">
		<span class='lazyload' w='309' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_line' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ywsrtj/bar/field/zyylfy","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
  </td>
   <!--mjzypfy-->
    <td colspan="2">
		<span class='lazyload' w='309' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_line' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ywsrtj/bar/field/mjzypfy","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
  </td>
  <!--zyypfy-->
    <td colspan="2">
		<span class='lazyload' w='309' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='chart_line' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ywsrtj/bar/field/zyypfy","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
  </td>
   </tr>
   <tr>
	 <td id='other_ywsrtj_archive_numberzyylfy' style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ywsrtj/list/region/511028/field/zyylfy",$('#other_ywsrtj_archive_numberzyylfy'));
			</script>
	</td>
	 <td id='other_ywsrtj_archive_numbermjzypfy' style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ywsrtj/list/region/511028/field/mjzypfy",$('#other_ywsrtj_archive_numbermjzypfy'));
			</script>
	</td>
	 <td id='other_ywsrtj_archive_numberzyypfy' style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ywsrtj/list/region/511028/field/zyypfy",$('#other_ywsrtj_archive_numberzyypfy'));
			</script>
	</td>
	 <td id='other_ywsrtj_archive_numbermjzybylfy' style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ywsrtj/list/region/511028/field/mjzybylfy",$('#other_ywsrtj_archive_numbermjzybylfy'));
			</script>
	</td>
	 <td id='other_ywsrtj_archive_numberzyybylfy' style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ywsrtj/list/region/511028/field/zyybylfy",$('#other_ywsrtj_archive_numberzyybylfy'));
			</script>
	</td>
	 <td id='other_ywsrtj_archive_numbermjzybypfy' style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ywsrtj/list/region/511028/field/mjzybypfy",$('#other_ywsrtj_archive_numbermjzybypfy'));
			</script>
	</td>
	 <td id='other_ywsrtj_archive_numberzyybypfy' style="vertical-align: top;">
			<script language="JavaScript" type="text/javascript">
			showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/ywsrtj/list/region/511028/field/zyybypfy",$('#other_ywsrtj_archive_numberzyybypfy'));
			</script>
	</td>
   </tr>
</table>
<table align="center" width="100%">
   <tr>
      <td  id='list_drug_number' style="vertical-align: top;">
		<script language="JavaScript" type="text/javascript">
		showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/drug/list/region_id/5105005",$('#list_drug_number'));
		</script>
      </td>
      <td>
	<span class='lazyload' w='800' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='drug_bar' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/drug/bar","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
	</td>
   </tr>
</table>
<table align="center" width="100%">
   <tr>
      <td  id='list_mz_number' style="vertical-align: top;">
		<script language="JavaScript" type="text/javascript">
		showList("<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/mz/list/region_id/5105005",$('#list_mz_number'));
		</script>
      </td>
      <td>
	<span class='lazyload' w='800' h='220' basepath='<?php echo $this->_tpl_vars['basePath']; ?>
' chart_name='drug_bar' xml_source='<?php echo $this->_tpl_vars['basePath']; ?>
admindecision/mz/bar","<?php echo $this->_tpl_vars['basePath']; ?>
'></span>
	</td>
   </tr>
</table>
<?php endif; ?>
</body>
</html>
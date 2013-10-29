<?php /* Smarty version 2.6.14, created on 2013-09-26 14:55:09
         compiled from scorelist.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>老年人生活自理能力评估列表</title>
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basepath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basepath']; ?>
views/styles/tabs.css">
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basepath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<!--引入人员列表JS-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/search_list.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/ajax_select_region.js"  type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
    $("#search_listpic").toggle(function(){do_search("<?php echo $this->_tpl_vars['basePath']; ?>
","individual_core||et_lifecase_assessment","老年人已评估||未评估(添加年龄条件)","","");},function(){undo_search("<?php echo $this->_tpl_vars['basePath']; ?>
");}); 
     //下拉地区
     get_region_select_html('<?php echo $this->_tpl_vars['basePath']; ?>
','region_p_id_','menuDropDownBox_address');


	
	if("<?php echo $this->_tpl_vars['display']; ?>
"=="on"){
		$("#tbody_search").show();
		$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_out.png");
	}else{
		$("#tbody_search").hide();
		$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png");
	}
	$("#search_lable").toggle(function(){
		$("#tbody_search").show();
		$("#search").attr("action","<?php echo $this->_tpl_vars['basepath']; ?>
elder/elder/scorelist/display/on");
		$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_out.png");},function(){$("#tbody_search").hide();
		$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png");
		$("#search").attr("action","<?php echo $this->_tpl_vars['basepath']; ?>
elder/elder/scorelist/display/off");
		});
});
</script>
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
.inputbutton{
border: 1px solid blue;
width:80px;
background:#FFFFFF;
}
table th{
	text-align:center;
}
</style>
</head>
<body>
<div id="search_list"></div>
<div class="Left_top" id="left_top"><img id="search_listpic" alt="" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/search_list.gif" /></div>
<table border="0" width="100%">
    <tr class="headbg">
      <td>
		<strong>老年人生活自理能力评估列表</strong>
	  </td>
	</tr>
		<form action="<?php echo $this->_tpl_vars['basepath']; ?>
elder/elder/scorelist" id="search" method="post">
			<tr><td>
				姓名：<input type="text" name="realname" size="18" value=""/>&nbsp;
				身份证号:<input type="text" name="identitynumber" value=""/>&nbsp;
				评估分数:<input type="text" name="score" size="8" value=""/>&nbsp;
				<input type="submit" value="搜索" class="inputbutton"/>
				<label id="search_lable" style="cursor:pointer;"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png" />高级搜索</label><img title="请尽量使用普通搜索，并且限制搜索条件详细一些，否则会耗费过长的时间" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />
				</td>
			</tr>
			<tr id="tbody_search"><td>
				时间:<input type="text" name="created_start_time" value="<?php echo $this->_tpl_vars['created_start_time']; ?>
"  class="inputnone2" onClick="WdatePicker({firstDayOfWeek:1})" >
						  --<input type="text" name="created_end_time" value="<?php echo $this->_tpl_vars['created_end_time']; ?>
"  class="inputnone2" onClick="WdatePicker({firstDayOfWeek:1})" >
				地区:<span id="menuDropDownBox_address"></span>	
					<input type="hidden" name="region_p_id" id="region_p_id_" value="<?php echo $this->_tpl_vars['region_p_id']; ?>
" />
				</td>
			</tr>
		</form>
</table>	
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
    	<th>&nbsp;    	
        </th>
        <th title="身份证号" style="width:140px">
        	身份证号
        </th>
		<th title="姓名" >
        	姓名
        </th>
        <th title="地址" >
        	地址
        </th>
        <th title="年龄">
        	年龄
        </th>
        <th title="填表时间">
        	填表时间
        </th>
        <th>
        	高血压<img title="“可以从中查看到该老年人是否患有高血压，并且可以单击编辑确认是否患病。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip"/>
        </th>
        <th>
        	糖尿病<img title="“可以从中查看到该老年人是否患有糖尿病，并且可以单击编辑确认是否患病。””" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip"/>
        </th>
        <th>
        	精神病<img title="“可以从中查看到该老年人是否患有精神病，并且可以单击编辑确认是否患病。””" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip"/>
        </th>
		<th title="评估分数">
        	评估分数
        </th>
		<th titel="操作">
        	操作
        </th>
	</tr>
	</thead>
	<tbody >
     <?php unset($this->_sections['scoreList']);
$this->_sections['scoreList']['loop'] = is_array($_loop=$this->_tpl_vars['scoreList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['scoreList']['name'] = 'scoreList';
$this->_sections['scoreList']['show'] = true;
$this->_sections['scoreList']['max'] = $this->_sections['scoreList']['loop'];
$this->_sections['scoreList']['step'] = 1;
$this->_sections['scoreList']['start'] = $this->_sections['scoreList']['step'] > 0 ? 0 : $this->_sections['scoreList']['loop']-1;
if ($this->_sections['scoreList']['show']) {
    $this->_sections['scoreList']['total'] = $this->_sections['scoreList']['loop'];
    if ($this->_sections['scoreList']['total'] == 0)
        $this->_sections['scoreList']['show'] = false;
} else
    $this->_sections['scoreList']['total'] = 0;
if ($this->_sections['scoreList']['show']):

            for ($this->_sections['scoreList']['index'] = $this->_sections['scoreList']['start'], $this->_sections['scoreList']['iteration'] = 1;
                 $this->_sections['scoreList']['iteration'] <= $this->_sections['scoreList']['total'];
                 $this->_sections['scoreList']['index'] += $this->_sections['scoreList']['step'], $this->_sections['scoreList']['iteration']++):
$this->_sections['scoreList']['rownum'] = $this->_sections['scoreList']['iteration'];
$this->_sections['scoreList']['index_prev'] = $this->_sections['scoreList']['index'] - $this->_sections['scoreList']['step'];
$this->_sections['scoreList']['index_next'] = $this->_sections['scoreList']['index'] + $this->_sections['scoreList']['step'];
$this->_sections['scoreList']['first']      = ($this->_sections['scoreList']['iteration'] == 1);
$this->_sections['scoreList']['last']       = ($this->_sections['scoreList']['iteration'] == $this->_sections['scoreList']['total']);
?>
	 <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
	  <form action="<?php echo $this->_tpl_vars['basepath']; ?>
elder/elder/del/actionname/delall" method="post">
	 	<td>
	 		<input type="checkbox" value="<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['uuid']; ?>
" name="selectFlag[]" id="selectFlag"/>
	 	</td>
        <td>
           <?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['identitynumber']; ?>
 
        </td>
		<td >
        	<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['name']; ?>

        </td>
        <td >
        	<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['address']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['age']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['created']; ?>

        </td>
        <td style="width:80px">	
			<?php if ($this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['gxy']): ?>
				<a href="<?php echo $this->_tpl_vars['basepath']; ?>
iha/index/add/uuid/<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['id']; ?>
"><span style="color:red">是</span></a>
			<?php else: ?>
				<a href="<?php echo $this->_tpl_vars['basepath']; ?>
iha/index/add/uuid/<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['id']; ?>
"><span>不是</span></a>
			<?php endif; ?>
        </td>
        <td style="width:80px">
			<?php if ($this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['tnb']): ?>
				<a href="<?php echo $this->_tpl_vars['basepath']; ?>
iha/index/add/uuid/<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['id']; ?>
"><span style="color:red">是</span></a>
			<?php else: ?>
				<a href="<?php echo $this->_tpl_vars['basepath']; ?>
iha/index/add/uuid/<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['id']; ?>
"><span>不是</span></a>
			<?php endif; ?>     	
        </td>
        <td style="width:80px">
			<?php if ($this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['jsb']): ?>
				<a href="<?php echo $this->_tpl_vars['basepath']; ?>
iha/index/add/uuid/<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['id']; ?>
"><span style="color:red">是</span></a>
			<?php else: ?>
				<a href="<?php echo $this->_tpl_vars['basepath']; ?>
iha/index/add/uuid/<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['id']; ?>
"><span>不是</span></a>
			<?php endif; ?>      	
        </td>
                       
		<td>
        	<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['totalscore']; ?>

        </td>
		<td >
        	<a href="<?php echo $this->_tpl_vars['basepath']; ?>
elder/elder/add/uuid/<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['uuid']; ?>
">[编辑]</a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo $this->_tpl_vars['basepath']; ?>
elder/elder/del/actionname/dellone/uuid/<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['uuid']; ?>
" onClick="return confirm('您确定删除吗?确定');">[删除]</a>&nbsp;&nbsp;&nbsp; 
        	<a href="<?php echo $this->_tpl_vars['basepath']; ?>
elder/elder/print/uuid/<?php echo $this->_tpl_vars['scoreList'][$this->_sections['scoreList']['index']]['uuid']; ?>
" target="_blank">[打印]</a>
        </td>
	</tr>
	  <?php endfor; endif; ?>
	  <?php echo $this->_tpl_vars['str']; ?>

	  <tr>
	  <td colspan="11" align="center">
	   <input type="checkbox" value="" name="ifAll" id="ifAll" onClick="return checkselect();"/>全选      &nbsp;&nbsp;<?php echo $this->_tpl_vars['page']; ?>
&nbsp;&nbsp;<input type="submit" name="delAll" value="全部删除" class="inputbutton" onClick="	if(confirm('确定要删除这些内容吗？')){return true;}else{return false;}
"/>
	</td>
	</tr>
	</form> 
	</tbody>
</table>
</body>
</html>
<script type="text/javascript">
function checkselect()
{
	for(var i=0;i<document.getElementsByName('selectFlag[]').length; i++)
	{
		document.getElementsByName('selectFlag[]')[i].checked=document.getElementById('ifAll').checked;
	}
}
</script>
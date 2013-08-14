<?php /* Smarty version 2.6.14, created on 2013-06-25 17:22:20
         compiled from diabetes_list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>2型糖尿病随访记录列表</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" /> <script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/popup.js" type="text/javascript"></script> 
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/search_list.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/ajax_select_region.js" type="text/javascript"></script>                                                 
<script>

$(document).ready(function(){
	$("#search_listpic").toggle(function(){do_search("<?php echo $this->_tpl_vars['basePath']; ?>
","clinical_history||diabetes_core","确诊并随访过患者||确诊未随访过患者||未确诊随访过居民||未确诊未随访居民||所有已确诊糖尿病","disease_code||disease_state","3||1");},function(){undo_search("<?php echo $this->_tpl_vars['basePath']; ?>
");});
    //处理地区下拉
    get_region_select_html('<?php echo $this->_tpl_vars['basePath']; ?>
','org_id','menuDropDownBox');
});
function view_blood_pic(url)
{
    //$("#blood_pic_load").attr("src",url);
    $.dialog(1024, 268+60, $('#blood_popup').html(),"blood_popup","近期患者空腹血糖走势图(含自我监测空腹血糖)");
    $('#dialog_box_html').addClass('background:url(<?php echo $this->_tpl_vars['basePath']; ?>
images/load.gif) no-repeat center center;');
    $('#dialog_box_html').empty();//先清空，因为多次载入图片
    var img = new Image();
    $(img).load(function() {
        $(this).hide();
        $('#dialog_box_html').append(this);
        $(this).fadeIn();
        }).error(function(){
            $('#dialog_box_html').html("没有查询到有相关数据，无法绘出相关图形");
            // notify the user that the image could not be loaded
        }).attr('src', url);
}
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
.line
	{
		border-top:0px;
		border-left:0px;
		border-right:0px;
	}
.inputbutton{
border: 1px solid blue;
width:80px;
background:#FFFFFF;
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
		<strong>2型糖尿病随访记录列表</strong>
	  </td>
	</tr>
		<form action="<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/list" id="search" method="post">
			<tr><td>
				姓名<img title="“可以输入汉字也可以输入姓名拼音的首字母，比如要查找'王高兴',那么可以输入姓名的三个汉字中的任意一个，也可以输入‘wxm’几个字母进行搜索查找”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />：<input type="text" name="username" size="10" class="line" value="<?php echo $this->_tpl_vars['realname']; ?>
"/>&nbsp;
				档案号<img title="“输入标准档案号里的全部或者部分数字”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="standard_code" size="14" class="line" value="<?php echo $this->_tpl_vars['serialnumber']; ?>
"/>&nbsp;
				身份证号<img title="“可以输入完整或者部分身份证号”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="identity_number" size="14" class="line" value="<?php echo $this->_tpl_vars['nowdate']; ?>
"/>&nbsp;
				档案状态<select name="status_flag">
				  <?php unset($this->_sections['status_flag']);
$this->_sections['status_flag']['loop'] = is_array($_loop=$this->_tpl_vars['status_flag']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['status_flag']['name'] = 'status_flag';
$this->_sections['status_flag']['show'] = true;
$this->_sections['status_flag']['max'] = $this->_sections['status_flag']['loop'];
$this->_sections['status_flag']['step'] = 1;
$this->_sections['status_flag']['start'] = $this->_sections['status_flag']['step'] > 0 ? 0 : $this->_sections['status_flag']['loop']-1;
if ($this->_sections['status_flag']['show']) {
    $this->_sections['status_flag']['total'] = $this->_sections['status_flag']['loop'];
    if ($this->_sections['status_flag']['total'] == 0)
        $this->_sections['status_flag']['show'] = false;
} else
    $this->_sections['status_flag']['total'] = 0;
if ($this->_sections['status_flag']['show']):

            for ($this->_sections['status_flag']['index'] = $this->_sections['status_flag']['start'], $this->_sections['status_flag']['iteration'] = 1;
                 $this->_sections['status_flag']['iteration'] <= $this->_sections['status_flag']['total'];
                 $this->_sections['status_flag']['index'] += $this->_sections['status_flag']['step'], $this->_sections['status_flag']['iteration']++):
$this->_sections['status_flag']['rownum'] = $this->_sections['status_flag']['iteration'];
$this->_sections['status_flag']['index_prev'] = $this->_sections['status_flag']['index'] - $this->_sections['status_flag']['step'];
$this->_sections['status_flag']['index_next'] = $this->_sections['status_flag']['index'] + $this->_sections['status_flag']['step'];
$this->_sections['status_flag']['first']      = ($this->_sections['status_flag']['iteration'] == 1);
$this->_sections['status_flag']['last']       = ($this->_sections['status_flag']['iteration'] == $this->_sections['status_flag']['total']);
?>
				  <option value="<?php echo $this->_tpl_vars['status_flag'][$this->_sections['status_flag']['index']]['key']; ?>
" <?php echo $this->_tpl_vars['status_flag'][$this->_sections['status_flag']['index']]['selected']; ?>
><?php echo $this->_tpl_vars['status_flag'][$this->_sections['status_flag']['index']]['value']; ?>
</option>
				  <?php endfor; endif; ?>
				</select>
				责任医生:<select name="staff_id" id="staff_id">
			<?php unset($this->_sections['response_doctor']);
$this->_sections['response_doctor']['name'] = 'response_doctor';
$this->_sections['response_doctor']['loop'] = is_array($_loop=$this->_tpl_vars['response_doctor']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['response_doctor']['show'] = true;
$this->_sections['response_doctor']['max'] = $this->_sections['response_doctor']['loop'];
$this->_sections['response_doctor']['step'] = 1;
$this->_sections['response_doctor']['start'] = $this->_sections['response_doctor']['step'] > 0 ? 0 : $this->_sections['response_doctor']['loop']-1;
if ($this->_sections['response_doctor']['show']) {
    $this->_sections['response_doctor']['total'] = $this->_sections['response_doctor']['loop'];
    if ($this->_sections['response_doctor']['total'] == 0)
        $this->_sections['response_doctor']['show'] = false;
} else
    $this->_sections['response_doctor']['total'] = 0;
if ($this->_sections['response_doctor']['show']):

            for ($this->_sections['response_doctor']['index'] = $this->_sections['response_doctor']['start'], $this->_sections['response_doctor']['iteration'] = 1;
                 $this->_sections['response_doctor']['iteration'] <= $this->_sections['response_doctor']['total'];
                 $this->_sections['response_doctor']['index'] += $this->_sections['response_doctor']['step'], $this->_sections['response_doctor']['iteration']++):
$this->_sections['response_doctor']['rownum'] = $this->_sections['response_doctor']['iteration'];
$this->_sections['response_doctor']['index_prev'] = $this->_sections['response_doctor']['index'] - $this->_sections['response_doctor']['step'];
$this->_sections['response_doctor']['index_next'] = $this->_sections['response_doctor']['index'] + $this->_sections['response_doctor']['step'];
$this->_sections['response_doctor']['first']      = ($this->_sections['response_doctor']['iteration'] == 1);
$this->_sections['response_doctor']['last']       = ($this->_sections['response_doctor']['iteration'] == $this->_sections['response_doctor']['total']);
?>
			<option value="<?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['id']; ?>
" <?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['selected']; ?>
 ><?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['zh_name']; ?>
</option>
			<?php endfor; endif; ?>
			</select>
				<input type="submit" value="搜索"  name="submit"/>
                <label id="search_tr" style="cursor:pointer;"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png" />高级搜索</label>
                 <?php if (! empty ( $this->_tpl_vars['db'] )): ?>
                【<font color="Red"><?php echo $this->_tpl_vars['name']; ?>
</font>】本年度随访:
				<?php unset($this->_sections['diabetes_core']);
$this->_sections['diabetes_core']['name'] = 'diabetes_core';
$this->_sections['diabetes_core']['loop'] = is_array($_loop=$this->_tpl_vars['db']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes_core']['show'] = true;
$this->_sections['diabetes_core']['max'] = $this->_sections['diabetes_core']['loop'];
$this->_sections['diabetes_core']['step'] = 1;
$this->_sections['diabetes_core']['start'] = $this->_sections['diabetes_core']['step'] > 0 ? 0 : $this->_sections['diabetes_core']['loop']-1;
if ($this->_sections['diabetes_core']['show']) {
    $this->_sections['diabetes_core']['total'] = $this->_sections['diabetes_core']['loop'];
    if ($this->_sections['diabetes_core']['total'] == 0)
        $this->_sections['diabetes_core']['show'] = false;
} else
    $this->_sections['diabetes_core']['total'] = 0;
if ($this->_sections['diabetes_core']['show']):

            for ($this->_sections['diabetes_core']['index'] = $this->_sections['diabetes_core']['start'], $this->_sections['diabetes_core']['iteration'] = 1;
                 $this->_sections['diabetes_core']['iteration'] <= $this->_sections['diabetes_core']['total'];
                 $this->_sections['diabetes_core']['index'] += $this->_sections['diabetes_core']['step'], $this->_sections['diabetes_core']['iteration']++):
$this->_sections['diabetes_core']['rownum'] = $this->_sections['diabetes_core']['iteration'];
$this->_sections['diabetes_core']['index_prev'] = $this->_sections['diabetes_core']['index'] - $this->_sections['diabetes_core']['step'];
$this->_sections['diabetes_core']['index_next'] = $this->_sections['diabetes_core']['index'] + $this->_sections['diabetes_core']['step'];
$this->_sections['diabetes_core']['first']      = ($this->_sections['diabetes_core']['iteration'] == 1);
$this->_sections['diabetes_core']['last']       = ($this->_sections['diabetes_core']['iteration'] == $this->_sections['diabetes_core']['total']);
?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/add/editid/<?php echo $this->_tpl_vars['db'][$this->_sections['diabetes_core']['index']]['uuid']; ?>
/id/<?php echo $this->_tpl_vars['db'][$this->_sections['diabetes_core']['index']]['id']; ?>
">第<?php echo $this->_tpl_vars['db'][$this->_sections['diabetes_core']['index']]['num']; ?>
次&nbsp;</a><?php endfor; endif; ?>
				<?php endif; ?>
				</td>
			</tr>
            <tr id="body_tr" style="display:<?php echo $this->_tpl_vars['display']; ?>
;"><td>随访日期:<input class="Wdate" type="text" name="startdate" size="18" onClick="WdatePicker({firstDayOfWeek:1})" value="<?php echo $this->_tpl_vars['startdate']; ?>
"/>-<input class="Wdate" type="text" name="enddate" size="18" onClick="WdatePicker({firstDayOfWeek:1})" value="<?php echo $this->_tpl_vars['enddate']; ?>
"/>
              所属地区:<span id="menuDropDownBox"></span>    
                  <input  type="hidden" name="org_id" id="org_id" value="<?php echo $this->_tpl_vars['org_id']; ?>
" /> 
              </td></tr>
		</form>
</table>	
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
        <th>状态</th>
        <th title="编号">
   	        姓名</th>
			<th>
        	地址
        </th>
		<th>
        	联系电话
        </th>
		<th title="姓名" >
        	上次随访时间        </th>
		<th title="体检日期">随访医生</th>
		<th title="责任医生">随访总数</th>
		<th>
        	操作        </th>
	</tr>
	</thead>
	<tbody >
	 <?php unset($this->_sections['custom']);
$this->_sections['custom']['name'] = 'custom';
$this->_sections['custom']['loop'] = is_array($_loop=$this->_tpl_vars['diabetes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['show'] = true;
$this->_sections['custom']['max'] = $this->_sections['custom']['loop'];
$this->_sections['custom']['step'] = 1;
$this->_sections['custom']['start'] = $this->_sections['custom']['step'] > 0 ? 0 : $this->_sections['custom']['loop']-1;
if ($this->_sections['custom']['show']) {
    $this->_sections['custom']['total'] = $this->_sections['custom']['loop'];
    if ($this->_sections['custom']['total'] == 0)
        $this->_sections['custom']['show'] = false;
} else
    $this->_sections['custom']['total'] = 0;
if ($this->_sections['custom']['show']):

            for ($this->_sections['custom']['index'] = $this->_sections['custom']['start'], $this->_sections['custom']['iteration'] = 1;
                 $this->_sections['custom']['iteration'] <= $this->_sections['custom']['total'];
                 $this->_sections['custom']['index'] += $this->_sections['custom']['step'], $this->_sections['custom']['iteration']++):
$this->_sections['custom']['rownum'] = $this->_sections['custom']['iteration'];
$this->_sections['custom']['index_prev'] = $this->_sections['custom']['index'] - $this->_sections['custom']['step'];
$this->_sections['custom']['index_next'] = $this->_sections['custom']['index'] + $this->_sections['custom']['step'];
$this->_sections['custom']['first']      = ($this->_sections['custom']['iteration'] == 1);
$this->_sections['custom']['last']       = ($this->_sections['custom']['iteration'] == $this->_sections['custom']['total']);
?>
	 <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
                                        <td><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/<?php echo $this->_tpl_vars['diabetes'][$this->_sections['custom']['index']]['pic_name']; ?>
"</td>
                                       <td><?php echo $this->_tpl_vars['diabetes'][$this->_sections['custom']['index']]['ssname']; ?>
</td>
		<td><?php echo $this->_tpl_vars['diabetes'][$this->_sections['custom']['index']]['name']->address; ?>
</td>
		<td><?php echo $this->_tpl_vars['diabetes'][$this->_sections['custom']['index']]['name']->phone_number; ?>
</td>
		<td><?php echo $this->_tpl_vars['diabetes'][$this->_sections['custom']['index']]['follow_time']; ?>
</td>
		<td><?php echo $this->_tpl_vars['diabetes'][$this->_sections['custom']['index']]['doctor_name']; ?>
</td>
		<td><?php echo $this->_tpl_vars['diabetes'][$this->_sections['custom']['index']]['snums']; ?>
</td>
		<td >
        	<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/chart_bar.png" onclick="view_blood_pic('<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/xtpic/uuid/<?php echo $this->_tpl_vars['diabetes'][$this->_sections['custom']['index']]['id']; ?>
')" alt="空腹血糖走势图" style="cursor: hand; height: 20px;" />&nbsp;|&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/index/id/<?php echo $this->_tpl_vars['diabetes'][$this->_sections['custom']['index']]['id']; ?>
">进入查阅</a></td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="7">对不起，未找到您要查询的内容！</td>
	</tr>
	 <?php endif; ?>
	  <?php echo $this->_tpl_vars['str']; ?>

	  <tr>
	  <td colspan="7" align="center">
	   <?php echo $this->_tpl_vars['pager']; ?>
</td>
	</tr>
	<?php if ($this->_tpl_vars['error_string']): ?>
	<tr>
		<td colspan="7"><?php echo $this->_tpl_vars['error_string']; ?>
</td>
	</tr>
	<?php endif; ?>
	</tbody>
</table>
</body>
</html>
<script type="text/javascript">
$("#search_tr").toggle(function(){$("#body_tr").show();$("#search_tr>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_out.png");},function(){$("#body_tr").hide();$("#search_tr>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png");});
</script>
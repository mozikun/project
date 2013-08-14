<?php /* Smarty version 2.6.14, created on 2013-06-24 15:15:48
         compiled from cd_index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>慢病管理-高血压随访人员列表</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" />                                                                                                                             

<style>
	table
	{
		background:#ffffff;
	}
	.line
	{
		border-top:0px;
		border-left:0px;
		border-right:0px;
	}
</style>
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
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
","clinical_history||hypertension_follow_up","确诊并随访过患者||确诊未随访过患者||未确诊随访过居民||未确诊未随访居民||所有已确诊高血压","disease_code||disease_state","2||1");},function(){undo_search("<?php echo $this->_tpl_vars['basePath']; ?>
");});
    //处理地区下拉
    get_region_select_html('<?php echo $this->_tpl_vars['basePath']; ?>
','org_id','menuDropDownBox');
    //处理高级搜索
    if("<?php echo $this->_tpl_vars['gj_show']; ?>
")
    {
        $("#body_tr").show();
        $("#search_tr>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_out.png");
        $("#gj_show").val('1');
    }
});

function view_blood_pic(url)
{
    //$("#blood_pic_load").attr("src",url);
    $.dialog(1024, 268+60, $('#blood_popup').html(),"blood_popup","近期患者血压走势图(含自我监测血压)");
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
</head>
<body>
<div id="search_list"></div>
<div class="Left_top" id="left_top"><img id="search_listpic" alt="" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/search_list.gif" /></div>
	<table border="0" width="100%">
		<form action="<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/index" id="hy_search" method="POST">
			<tr><td>
				姓名<img title="“可以输入汉字也可以输入姓名拼音的首字母，比如要查找'王高兴',那么可以输入姓名的三个汉字中的任意一个，也可以输入‘wxm’几个字母进行搜索查找”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />：<input type="text" name="username" value="<?php echo $this->_tpl_vars['search']['username']; ?>
" class="line" size="10">&nbsp;
				档案号<img title="“输入标准档案号里的全部或者部分数字”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="standard_code" value="<?php echo $this->_tpl_vars['search']['standard_code']; ?>
" class="line" size="10">&nbsp;
				身份证号<img title="“可以输入完整或者部分身份证号”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="identity_number" value="<?php echo $this->_tpl_vars['search']['identity_number']; ?>
" class="line" size="12">&nbsp;
                档案状态：
				<select name="status_flag" id="status_flag" onchange="sf=this.value">
					<?php unset($this->_sections['status_flag']);
$this->_sections['status_flag']['name'] = 'status_flag';
$this->_sections['status_flag']['loop'] = is_array($_loop=$this->_tpl_vars['status_flag']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 > <?php echo $this->_tpl_vars['status_flag'][$this->_sections['status_flag']['index']]['value']; ?>
</option>
					<?php endfor; endif; ?>
				</select>&nbsp;
				随访医生:<select name="staff_id" id="staff_id">
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
		&nbsp;
				
				<input type="submit" value="搜索" name="submit">
                <label id="search_tr" style="cursor:pointer;"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png" />高级搜索</label>
                <?php if (! empty ( $this->_tpl_vars['hy'] )): ?>
                【<font color="Red"><?php echo $this->_tpl_vars['name']; ?>
</font>】本年度随访:
				<?php unset($this->_sections['hy_follow_up']);
$this->_sections['hy_follow_up']['name'] = 'hy_follow_up';
$this->_sections['hy_follow_up']['loop'] = is_array($_loop=$this->_tpl_vars['hy']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['hy_follow_up']['show'] = true;
$this->_sections['hy_follow_up']['max'] = $this->_sections['hy_follow_up']['loop'];
$this->_sections['hy_follow_up']['step'] = 1;
$this->_sections['hy_follow_up']['start'] = $this->_sections['hy_follow_up']['step'] > 0 ? 0 : $this->_sections['hy_follow_up']['loop']-1;
if ($this->_sections['hy_follow_up']['show']) {
    $this->_sections['hy_follow_up']['total'] = $this->_sections['hy_follow_up']['loop'];
    if ($this->_sections['hy_follow_up']['total'] == 0)
        $this->_sections['hy_follow_up']['show'] = false;
} else
    $this->_sections['hy_follow_up']['total'] = 0;
if ($this->_sections['hy_follow_up']['show']):

            for ($this->_sections['hy_follow_up']['index'] = $this->_sections['hy_follow_up']['start'], $this->_sections['hy_follow_up']['iteration'] = 1;
                 $this->_sections['hy_follow_up']['iteration'] <= $this->_sections['hy_follow_up']['total'];
                 $this->_sections['hy_follow_up']['index'] += $this->_sections['hy_follow_up']['step'], $this->_sections['hy_follow_up']['iteration']++):
$this->_sections['hy_follow_up']['rownum'] = $this->_sections['hy_follow_up']['iteration'];
$this->_sections['hy_follow_up']['index_prev'] = $this->_sections['hy_follow_up']['index'] - $this->_sections['hy_follow_up']['step'];
$this->_sections['hy_follow_up']['index_next'] = $this->_sections['hy_follow_up']['index'] + $this->_sections['hy_follow_up']['step'];
$this->_sections['hy_follow_up']['first']      = ($this->_sections['hy_follow_up']['iteration'] == 1);
$this->_sections['hy_follow_up']['last']       = ($this->_sections['hy_follow_up']['iteration'] == $this->_sections['hy_follow_up']['total']);
?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/edit/uuid/<?php echo $this->_tpl_vars['hy'][$this->_sections['hy_follow_up']['index']]['uuid']; ?>
">第<?php echo $this->_tpl_vars['hy'][$this->_sections['hy_follow_up']['index']]['num']; ?>
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
" />&nbsp;&nbsp;<input type="checkbox" name="is_gf" value="1" <?php if ($this->_tpl_vars['search']['is_gf'] == 1): ?> checked="checked"<?php endif; ?> />&nbsp;未达到规范管理(以随访时间段计算)<input type="hidden" name="gj_show_post" id="gj_show" value="<?php echo $this->_tpl_vars['gj_show']; ?>
" />
              </td></tr>
            </form>
</table>	
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
    	<th style="width: 20px;">
        	状态
        </th>
		<th style="width: 40px;">
        	姓名
        </th>
		<th style="width: 180px;">
        	地址
        </th>
		<th style="width: 60px;">
        	联系电话
        </th>
		<th style="width: 50px;">
        	上次随访时间
        </th>
        <th>
        	上次随访结果
        </th>
        <th style="width: 50px;">
        	计划随访时间
        </th>
		<th style="width: 40px;">
        	上次随访医生
        </th>
		<th style="width: 10px;">
        	随访总次数
        </th>
		<th style="width: 100px;">
        	操作
        </th>
	</tr>
	</thead>
	<tbody id="hy">
	<?php unset($this->_sections['hypertension']);
$this->_sections['hypertension']['name'] = 'hypertension';
$this->_sections['hypertension']['loop'] = is_array($_loop=$this->_tpl_vars['hypertension']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['hypertension']['show'] = true;
$this->_sections['hypertension']['max'] = $this->_sections['hypertension']['loop'];
$this->_sections['hypertension']['step'] = 1;
$this->_sections['hypertension']['start'] = $this->_sections['hypertension']['step'] > 0 ? 0 : $this->_sections['hypertension']['loop']-1;
if ($this->_sections['hypertension']['show']) {
    $this->_sections['hypertension']['total'] = $this->_sections['hypertension']['loop'];
    if ($this->_sections['hypertension']['total'] == 0)
        $this->_sections['hypertension']['show'] = false;
} else
    $this->_sections['hypertension']['total'] = 0;
if ($this->_sections['hypertension']['show']):

            for ($this->_sections['hypertension']['index'] = $this->_sections['hypertension']['start'], $this->_sections['hypertension']['iteration'] = 1;
                 $this->_sections['hypertension']['iteration'] <= $this->_sections['hypertension']['total'];
                 $this->_sections['hypertension']['index'] += $this->_sections['hypertension']['step'], $this->_sections['hypertension']['iteration']++):
$this->_sections['hypertension']['rownum'] = $this->_sections['hypertension']['iteration'];
$this->_sections['hypertension']['index_prev'] = $this->_sections['hypertension']['index'] - $this->_sections['hypertension']['step'];
$this->_sections['hypertension']['index_next'] = $this->_sections['hypertension']['index'] + $this->_sections['hypertension']['step'];
$this->_sections['hypertension']['first']      = ($this->_sections['hypertension']['iteration'] == 1);
$this->_sections['hypertension']['last']       = ($this->_sections['hypertension']['iteration'] == $this->_sections['hypertension']['total']);
?>
	 <tr id="hy_<?php echo $this->_tpl_vars['hypertension'][$this->_sections['hypertension']['index']]['uuid']; ?>
">
	 	<td>
         <img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/<?php echo $this->_tpl_vars['hypertension'][$this->_sections['hypertension']['index']]['image']; ?>
.png" />
        </td>
		<td>
        	<?php echo $this->_tpl_vars['hypertension'][$this->_sections['hypertension']['index']]['ssname']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['hypertension'][$this->_sections['hypertension']['index']]['name']->address; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['hypertension'][$this->_sections['hypertension']['index']]['name']->phone_number; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['hypertension'][$this->_sections['hypertension']['index']]['moreinfo']->follow_time; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['hypertension'][$this->_sections['hypertension']['index']]['moreinfo']->follow_result; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['hypertension'][$this->_sections['hypertension']['index']]['moreinfo']->follow_next_time; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['hypertension'][$this->_sections['hypertension']['index']]['moreinfo']->staff_id; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['hypertension'][$this->_sections['hypertension']['index']]['snums']; ?>

        </td>
		<td>
        	<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/chart_bar.png" onclick="view_blood_pic('<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/showpic/uuid/<?php echo $this->_tpl_vars['hypertension'][$this->_sections['hypertension']['index']]['id']; ?>
')" alt="血压走势图" style="cursor: hand; height: 20px;" />&nbsp;|&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/list/id/<?php echo $this->_tpl_vars['hypertension'][$this->_sections['hypertension']['index']]['id']; ?>
">进入查看</a>
        </td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="10">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="10">
        	<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/hz.png" />已确诊高血压患者
		&nbsp;
		<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/no_person.png" />未确诊&nbsp;&nbsp;<?php echo $this->_tpl_vars['pager']; ?>
&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/import" target="_blank">【打印/导出随访列表】</a>&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/import_patient" target="_blank">【导出患者列表】</a>
        </td>
	</tr>
    <?php if ($this->_tpl_vars['error_string']): ?>
    <tr>
		<td colspan="10">
        	<?php echo $this->_tpl_vars['error_string']; ?>

        </td>
	</tr>
    <?php endif; ?>
	</tbody>
</table>
<input type="hidden" id="error_message" name="error_message" value="<?php echo $this->_tpl_vars['error_message']; ?>
" />
<div id="blood_popup" style="display:none;">
</div>
</body>
</html>
<script type="text/javascript">
$("#search_tr").toggle(function(){$("#body_tr").show();$("#search_tr>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_out.png");$("#gj_show").val('1');},function(){$("#body_tr").hide();$("#search_tr>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png");$("#gj_show").val('')});
</script>
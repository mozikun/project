<?php /* Smarty version 2.6.14, created on 2013-09-26 14:41:37
         compiled from he_index.html */ ?>
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
<table border="1px" align="center" width="100%">
     <tr class="bigfont">
     	<?php if ($this->_tpl_vars['model'] == ''): ?>
       <td colspan="8" align="center"><center><strong>健康教育活动考核指标统计表(<?php echo $this->_tpl_vars['start_time']; ?>
~<?php echo $this->_tpl_vars['decision_time']; ?>
)</strong></center></td>
	   <?php elseif ($this->_tpl_vars['model'] == 'm3' || $this->_tpl_vars['model'] == 'm4'): ?>
	   <td colspan="4" align="center"><center><strong>健康教育活动考核指标统计表(<?php echo $this->_tpl_vars['start_time']; ?>
~<?php echo $this->_tpl_vars['decision_time']; ?>
)</strong></center></td>
	   <?php else: ?>
	   <td colspan="3" align="center"><center><strong>健康教育活动考核指标统计表(<?php echo $this->_tpl_vars['start_time']; ?>
~<?php echo $this->_tpl_vars['decision_time']; ?>
)</strong></center></td>
	   <?php endif; ?>
     </tr>
     <tr class="bigfont">
       <?php if ($this->_tpl_vars['model'] == ''): ?>
       <td colspan="8">
       <?php elseif ($this->_tpl_vars['model'] == 'm3' || $this->_tpl_vars['model'] == 'm4'): ?>
		<td colspan="4">
       	<?php else: ?>
		<td colspan="3">
		<?php endif; ?>
         <form action="" method="POST">
            时间：<input type="text" onClick="WdatePicker({firstDayOfWeek:1})" class="" name="start_time" value="<?php echo $this->_tpl_vars['start_time']; ?>
"/> -
            <input type="text" onClick="WdatePicker({firstDayOfWeek:1})" class="" name="search_time" value="<?php echo $this->_tpl_vars['decision_time']; ?>
"/>          <input type="submit" value="搜索" value="okok" />
         </form>
       </td>
     </tr>
     <tr class="headbg">
     	<?php if ($this->_tpl_vars['model'] == ''): ?>
       <td colspan="8">
       	<?php elseif ($this->_tpl_vars['model'] == 'm3' || $this->_tpl_vars['model'] == 'm4'): ?>
		<td colspan="4">
       	<?php else: ?>
		<td colspan="3">
		<?php endif; ?>
		<?php unset($this->_sections['rs']);
$this->_sections['rs']['loop'] = is_array($_loop=$this->_tpl_vars['rs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rs']['name'] = 'rs';
$this->_sections['rs']['show'] = true;
$this->_sections['rs']['max'] = $this->_sections['rs']['loop'];
$this->_sections['rs']['step'] = 1;
$this->_sections['rs']['start'] = $this->_sections['rs']['step'] > 0 ? 0 : $this->_sections['rs']['loop']-1;
if ($this->_sections['rs']['show']) {
    $this->_sections['rs']['total'] = $this->_sections['rs']['loop'];
    if ($this->_sections['rs']['total'] == 0)
        $this->_sections['rs']['show'] = false;
} else
    $this->_sections['rs']['total'] = 0;
if ($this->_sections['rs']['show']):

            for ($this->_sections['rs']['index'] = $this->_sections['rs']['start'], $this->_sections['rs']['iteration'] = 1;
                 $this->_sections['rs']['iteration'] <= $this->_sections['rs']['total'];
                 $this->_sections['rs']['index'] += $this->_sections['rs']['step'], $this->_sections['rs']['iteration']++):
$this->_sections['rs']['rownum'] = $this->_sections['rs']['iteration'];
$this->_sections['rs']['index_prev'] = $this->_sections['rs']['index'] - $this->_sections['rs']['step'];
$this->_sections['rs']['index_next'] = $this->_sections['rs']['index'] + $this->_sections['rs']['step'];
$this->_sections['rs']['first']      = ($this->_sections['rs']['iteration'] == 1);
$this->_sections['rs']['last']       = ($this->_sections['rs']['iteration'] == $this->_sections['rs']['total']);
?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/he/index/model/<?php echo $this->_tpl_vars['model']; ?>
/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
"><?php if ($this->_tpl_vars['add_need_id'] == $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']): ?><font color="Red"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a></font><?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/he/index/model/<?php echo $this->_tpl_vars['model']; ?>
/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a><?php endif; ?>&nbsp;&nbsp;->&nbsp;&nbsp;<?php endfor; endif; ?></td>
     </tr>
     <tr class="bigfont">
        <td width="8%"><strong>地区名称</strong></td>
		<?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm1'): ?>
		<td width="12%"><strong>发放印刷资料数量</strong></td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm2'): ?>
		<td width="12%"><strong>播放音像资料次数</strong></td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm3'): ?>
		<td width="12%"><strong>咨询活动次数</strong></td>
		<td width="12%"><strong>咨询活动人数</strong></td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm4'): ?>
		<td width="12%"><strong>健康讲座次数</strong></td>
		<td width="12%"><strong>健康讲座人数</strong></td>
		<?php endif; ?>
        <td width="16%"><strong><?php if ($this->_tpl_vars['td_title'] == 1): ?>查看下级地区<?php endif;  if ($this->_tpl_vars['td_title'] == 2): ?>建档机构<?php endif; ?></strong></td>
     </tr>
       <?php echo $this->_tpl_vars['msg']; ?>

     <?php unset($this->_sections['row']);
$this->_sections['row']['loop'] = is_array($_loop=$this->_tpl_vars['row']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['row']['name'] = 'row';
$this->_sections['row']['show'] = true;
$this->_sections['row']['max'] = $this->_sections['row']['loop'];
$this->_sections['row']['step'] = 1;
$this->_sections['row']['start'] = $this->_sections['row']['step'] > 0 ? 0 : $this->_sections['row']['loop']-1;
if ($this->_sections['row']['show']) {
    $this->_sections['row']['total'] = $this->_sections['row']['loop'];
    if ($this->_sections['row']['total'] == 0)
        $this->_sections['row']['show'] = false;
} else
    $this->_sections['row']['total'] = 0;
if ($this->_sections['row']['show']):

            for ($this->_sections['row']['index'] = $this->_sections['row']['start'], $this->_sections['row']['iteration'] = 1;
                 $this->_sections['row']['iteration'] <= $this->_sections['row']['total'];
                 $this->_sections['row']['index'] += $this->_sections['row']['step'], $this->_sections['row']['iteration']++):
$this->_sections['row']['rownum'] = $this->_sections['row']['iteration'];
$this->_sections['row']['index_prev'] = $this->_sections['row']['index'] - $this->_sections['row']['step'];
$this->_sections['row']['index_next'] = $this->_sections['row']['index'] + $this->_sections['row']['step'];
$this->_sections['row']['first']      = ($this->_sections['row']['iteration'] == 1);
$this->_sections['row']['last']       = ($this->_sections['row']['iteration'] == $this->_sections['row']['total']);
?>
        <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['zh_name']; ?>
</td>
		   <?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm1'): ?>
		   <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_txt']; ?>
</td>
		   <?php endif; ?>
		   <?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm2'): ?>
		   <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_video']; ?>
</td>
		   <?php endif; ?>
		   <?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm3'): ?>
		   <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_ask']; ?>
</td>
		   <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_ask_person']; ?>
</td>
		   <?php endif; ?>
		   <?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm4'): ?>
		   <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_lecture']; ?>
</td>
		   <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_lecture_person']; ?>
</td>
		   <?php endif; ?>
           <td>
           <?php if ($this->_tpl_vars['td_title'] == 1): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/he/index/model/<?php echo $this->_tpl_vars['model']; ?>
/parent_id/<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
">[进入子地区]</a><?php endif; ?>
           <?php if ($this->_tpl_vars['td_title'] == 2):  echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['org_zh_name'];  endif; ?>
           
           </td>
        </tr>
     <?php endfor; endif; ?>
        <tr class="headbg">
           <td>小计</td>
		   <?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm1'): ?>
		   <td><?php echo $this->_tpl_vars['sum_txt_total']; ?>
</td>
		   <?php endif; ?>
		   <?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm2'): ?>
		   <td><?php echo $this->_tpl_vars['sum_video_total']; ?>
</td>
		   <?php endif; ?>
		   <?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm3'): ?>
		   <td><?php echo $this->_tpl_vars['sum_ask_total']; ?>
</td>
		   <td><?php echo $this->_tpl_vars['sum_ask_person_total']; ?>
</td>
		   <?php endif; ?>
		   <?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm4'): ?>
		   <td><?php echo $this->_tpl_vars['sum_lecture_total']; ?>
</td>
		   <td><?php echo $this->_tpl_vars['sum_lecture_person_total']; ?>
</td>
		   <?php endif; ?>
           <td>&nbsp;</td>
        </tr>
        <tr>
        <?php if ($this->_tpl_vars['model'] == ''): ?>
       <td colspan="8">
       	<?php elseif ($this->_tpl_vars['model'] == 'm3' || $this->_tpl_vars['model'] == 'm4'): ?>
		<td colspan="4">
       	<?php else: ?>
		<td colspan="3">
		<?php endif; ?>
        （一）发放健康教育印刷资料的数量（统计时间段内）。<br />
        （二）播放健康教育音像资料的次数（统计时间段内）。<br />
        （三）讲座的次数和参加人数（统计时间段内）。<br />
        （四）健康教育咨询活动的次数和参加人数（统计时间段内）。<br />
        <font color="red">&nbsp; &nbsp;<b>注:</b>&nbsp;</font> <b>统计时间段内：</b>表示该统计指标在所选择的统计时间段内，如选择2012-09-27，则本统计指标统计的数据为2012-01-01至2012-09-27的结果。<br/>

            &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<b>至统计时间：</b>表示该统计指标所统计数据至所选择的统计时间为止的之前的所有数据，如选择2012-09-26，则统计截止于2012-09-27之前的所有数据<br/>

            &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<b>与时间无关：</b>表示该统计指标与所选择的统计时间完全无关，将统计数据库内的所有数据（满足其他条件）
       
        </td>
        </tr>

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

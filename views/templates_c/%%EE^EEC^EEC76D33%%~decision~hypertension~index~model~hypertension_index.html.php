<?php /* Smarty version 2.6.14, created on 2013-09-26 14:42:51
         compiled from hypertension_index.html */ ?>
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
       <td colspan="14" align="center"><center><strong>高血压考核指标统计表(<?php echo $this->_tpl_vars['start_time']; ?>
~<?php echo $this->_tpl_vars['decision_time']; ?>
)</strong></center></td>
	   <?php else: ?>
	   <td colspan="12" align="center"><center><strong>高血压考核指标统计表(<?php echo $this->_tpl_vars['start_time']; ?>
~<?php echo $this->_tpl_vars['decision_time']; ?>
)</strong></center></td>
	   <?php endif; ?>
     </tr>
     <tr class="bigfont">
       <?php if ($this->_tpl_vars['model'] == ''): ?>
       <td colspan="14">
       	<?php else: ?>
		<td colspan="12">
		<?php endif; ?>
         <form action="" method="POST">
            时间⑧：开始时间：<input type="text" onClick="WdatePicker({firstDayOfWeek:1})" class="" name="start_time" value="<?php echo $this->_tpl_vars['start_time']; ?>
"/>&nbsp;&nbsp;结束时间：<input type="text" onClick="WdatePicker({firstDayOfWeek:1})" class="" name="end_time" value="<?php echo $this->_tpl_vars['decision_time']; ?>
"/>          <input type="submit" value="搜索" value="okok" />
         </form>
       </td>
     </tr>
     <tr class="headbg">
     	<?php if ($this->_tpl_vars['model'] == ''): ?>
       <td colspan="14">
       	<?php else: ?>
		<td colspan="12">
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
decision/hypertension/index/model/<?php echo $this->_tpl_vars['model']; ?>
/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
/url_start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
"><?php if ($this->_tpl_vars['add_need_id'] == $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']): ?><font color="Red"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a></font><?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/hypertension/index/model/<?php echo $this->_tpl_vars['model']; ?>
/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
/url_start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a><?php endif; ?>&nbsp;&nbsp;->&nbsp;&nbsp;<?php endfor; endif; ?></td>
     </tr>
     <tr class="bigfont">
        <td width="8%"><strong>地区名称</strong></td>
		<?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm1'): ?>
		<td width="4%"><strong>高血压患者健康管理率<br />(100%)</strong></td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm2'): ?>
		<td width="4%"><strong>高血压患者规范管理率<br />(100%)</strong></td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm3'): ?>
		<td width="4%"><strong>高血压患者血压控制率<br />(100%)</strong></td>
		<?php endif; ?>
		<td width="4%"><strong>成年人高血压患病率<br />(100%)</strong></td>
        <td width="4%"><strong>已建档确诊高血压患者数</strong></td>
        <td width="4%"><strong>新建档确诊高血压患者数</strong></td>
        <td width="4%"><strong>辖区内常住成年人口数</strong></td>
        <td width="4%"><strong>辖区高血压患病总人数(估算)</strong></td>
        <td width="4%"><strong>年内已管理高血压人数</strong></td>
        <td width="4%"><strong>已管理高血压人数</strong></td>
        <td width="4%"><strong>按照要求进行高血压患者管理的人数</strong></td>
        <td width="4%"><strong>最近一次血压达标人数</strong></td>
        <td width="8%"><strong><?php if ($this->_tpl_vars['td_title'] == 1): ?>查看下级地区<?php endif;  if ($this->_tpl_vars['td_title'] == 2): ?>建档机构<?php endif; ?></strong></td>
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
		   <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_hyper_percent']; ?>
</td>
		   <?php endif; ?>
		   <?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm2'): ?>
		   <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_hyper_rule_percent']; ?>
</td>
		   <?php endif; ?>
		   <?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm3'): ?>
		   <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_archive_last_year_percent']; ?>
</td>
		   <?php endif; ?>
		   <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['adult_rate']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_population']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_population_new']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_adults']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_archive_gusuan']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_archive']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_archive_all']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_hyper_ask']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['archive_last_year']; ?>
</td>
           <td>
           <?php if ($this->_tpl_vars['td_title'] == 1): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/hypertension/index/model/<?php echo $this->_tpl_vars['model']; ?>
/parent_id/<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
/url_start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
">[进入子地区]</a><?php endif; ?>
           <?php if ($this->_tpl_vars['td_title'] == 2):  echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['org_zh_name'];  endif; ?>
           
           </td>
        </tr>
     <?php endfor; endif; ?>
        <tr class="headbg">
           <td>小计</td>
		   <?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm1'): ?>
		   <td><?php echo $this->_tpl_vars['sum_hyper_percent_total']; ?>
</td>
		   <?php endif; ?>
		   <?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm2'): ?>
		   <td><?php echo $this->_tpl_vars['sum_hyper_rule_percent_total']; ?>
</td>
		   <?php endif; ?>
		   <?php if ($this->_tpl_vars['model'] == '' || $this->_tpl_vars['model'] == 'm3'): ?>
		   <td><?php echo $this->_tpl_vars['sum_archive_last_year_percent_total']; ?>
</td>
		   <?php endif; ?>
           <td><?php echo $this->_tpl_vars['adult_rate']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_population_total']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_population_new_total']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_adults_total']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_archive_gusuan_total']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_archive_total']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_archive_all_total']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_hyper_ask_total']; ?>
</td>
		   <td><?php echo $this->_tpl_vars['sum_archive_last_year_total']; ?>
</td>
           <td>&nbsp;</td>
        </tr>
        <tr>
        <?php if ($this->_tpl_vars['model'] == ''): ?>
       <td colspan="14">
       	<?php else: ?>
		<td colspan="12">
		<?php endif; ?>
        1、高血压患者健康管理率 = 年内已管理高血压人数（统计时间段内）/年内辖区内高血压患病总人数（至统计时间）×100％。辖区高血压患病总人数估算：辖区常住成年人口总数（截至统计时间）×成年人高血压患病率（通过当地流行病学调查、社区卫生诊断获得或是选用本省（全国）近期高血压患病率指标，此值可由系统管理员在数据字典中设置）。<br />
2、高血压患者规范管理率 = 按照要求进行高血压患者管理的人数（统计时间段内）/年内管理高血压患者人数（统计时间段内）×100％。<br />
3、管理人群血压控制率 = 最近一次随访血压达标人数（至统计时间）/已管理的高血压患者人数（至统计时间）×100％。<br />
4、辖区常住成年人口总数 = 系统内已建档并且年龄大于18岁的人口总数，本值由系统统计（截至统计时间）<br />
5、已建档确诊高血压患者数（至统计时间）<br />
6、新建档确诊高血压患者数（统计时间段内）<br />
7、按照要求进行高血压患者管理的人数 = 确诊高血压患者在统计时间段内随访次数（统计时间段内）≥（取整函数（（“查询日期开始时间”-“查询日期结束时间”）/90））<br />
8、最近一次随访血压达标人数 = 高血压患者并且最后一次随访血压同时满足“收缩压<140 且 舒张压<90mmHg” （至统计时间）<br />
9、年内已管理高血压人数 = 确诊高血压患者且过去一年内有至少一条随访记录（统计时间段内）<br />

10、<strong>统计时间段内</strong>：表示该统计指标在所选择的统计时间段内，如选择2012-09-27，则本统计指标统计的数据为2012-01-01至2012-09-27的结果。<br />
11、<strong>至统计时间</strong>：表示该统计指标所统计数据至所选择的统计时间为止的之前的所有数据，如选择2012-09-26，则统计截止于2012-09-27之前的所有数据<br />
12、<strong>与时间无关</strong>：表示该统计指标与所选择的统计时间完全无关，将统计数据库内的所有数据（满足其他条件）<br />
13、受目前服务器运算能力限制，综合平衡指标的准确性与运算时间的关系，上述指标的统计暂不区分下述情况：<br />
&nbsp;&nbsp;&nbsp;1)统计时段内从居民确诊为患者<br />
&nbsp;&nbsp;&nbsp;2)统计时段内的患者死亡<br />
&nbsp;&nbsp;&nbsp;3)统计时段内的患者迁出<br />
&nbsp;&nbsp;&nbsp;强烈建议统计的时间范围不宜超过2年。时间范围越大，与规范管理的实际情况出入越大。<br />
</td></tr>

</table>
     <div id="errorMessage" style="display:none"><?php echo $this->_tpl_vars['errorMessage']; ?>
</div>
</body>
</html>

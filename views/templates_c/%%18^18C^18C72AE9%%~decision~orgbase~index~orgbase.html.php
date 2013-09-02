<?php /* Smarty version 2.6.14, created on 2013-09-02 09:51:00
         compiled from orgbase.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>基本情况</title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/site.css" />
</head>
<body>
<table width="100%" border="0">
	<tr class="headbg">
		<td colspan="8">基本情况</td>
	</tr>
</table>
<table width="100%" border="0">
	<tr class="headbg">
	    <td rowspan="2">地区</td>
	    <td align="center" rowspan="2">机构名称</td>
		<td align="center" rowspan="2">年&nbsp;&nbsp;&nbsp;&nbsp;份</td>
		<td align="center" colspan="<?php echo $this->_tpl_vars['org_type_nu']; ?>
">设置/主办单位</td>
		<td align="center" colspan="<?php echo $this->_tpl_vars['org_under_typearr_nu']; ?>
">政府办机构隶属关系</td>
	</tr>
	<tr class="headbg">
	   <?php $_from = $this->_tpl_vars['org_typearr_get']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		<td><?php echo $this->_tpl_vars['v']; ?>
</td>
	   <?php endforeach; endif; unset($_from); ?>
	   <?php $_from = $this->_tpl_vars['org_under_typearr_get']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		<td><?php echo $this->_tpl_vars['v']; ?>
</td>
	   <?php endforeach; endif; unset($_from); ?>
	</tr>
		<?php unset($this->_sections['region_array']);
$this->_sections['region_array']['loop'] = is_array($_loop=$this->_tpl_vars['region_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['region_array']['name'] = 'region_array';
$this->_sections['region_array']['show'] = true;
$this->_sections['region_array']['max'] = $this->_sections['region_array']['loop'];
$this->_sections['region_array']['step'] = 1;
$this->_sections['region_array']['start'] = $this->_sections['region_array']['step'] > 0 ? 0 : $this->_sections['region_array']['loop']-1;
if ($this->_sections['region_array']['show']) {
    $this->_sections['region_array']['total'] = $this->_sections['region_array']['loop'];
    if ($this->_sections['region_array']['total'] == 0)
        $this->_sections['region_array']['show'] = false;
} else
    $this->_sections['region_array']['total'] = 0;
if ($this->_sections['region_array']['show']):

            for ($this->_sections['region_array']['index'] = $this->_sections['region_array']['start'], $this->_sections['region_array']['iteration'] = 1;
                 $this->_sections['region_array']['iteration'] <= $this->_sections['region_array']['total'];
                 $this->_sections['region_array']['index'] += $this->_sections['region_array']['step'], $this->_sections['region_array']['iteration']++):
$this->_sections['region_array']['rownum'] = $this->_sections['region_array']['iteration'];
$this->_sections['region_array']['index_prev'] = $this->_sections['region_array']['index'] - $this->_sections['region_array']['step'];
$this->_sections['region_array']['index_next'] = $this->_sections['region_array']['index'] + $this->_sections['region_array']['step'];
$this->_sections['region_array']['first']      = ($this->_sections['region_array']['iteration'] == 1);
$this->_sections['region_array']['last']       = ($this->_sections['region_array']['iteration'] == $this->_sections['region_array']['total']);
?>   
	   <tr align="center" style="cursor:pointer">
	    <td rowspan="<?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['rowspan']; ?>
"><?php if ($this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['region_level'] < 6): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/orgbase/index/region_id/<?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['zh_name']; ?>
</a><?php else:  echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['zh_name'];  endif; ?></td>
	    <?php unset($this->_sections['c']);
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
	    <?php if ($this->_sections['c']['index'] > 0): ?>
	    <tr>
	    <?php endif; ?>
	    <td rowspan="<?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['org_ext']; ?>
"><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['zh_name']; ?>
</td>
	   <?php unset($this->_sections['d']);
$this->_sections['d']['loop'] = is_array($_loop=$this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['d']['name'] = 'd';
$this->_sections['d']['show'] = true;
$this->_sections['d']['max'] = $this->_sections['d']['loop'];
$this->_sections['d']['step'] = 1;
$this->_sections['d']['start'] = $this->_sections['d']['step'] > 0 ? 0 : $this->_sections['d']['loop']-1;
if ($this->_sections['d']['show']) {
    $this->_sections['d']['total'] = $this->_sections['d']['loop'];
    if ($this->_sections['d']['total'] == 0)
        $this->_sections['d']['show'] = false;
} else
    $this->_sections['d']['total'] = 0;
if ($this->_sections['d']['show']):

            for ($this->_sections['d']['index'] = $this->_sections['d']['start'], $this->_sections['d']['iteration'] = 1;
                 $this->_sections['d']['iteration'] <= $this->_sections['d']['total'];
                 $this->_sections['d']['index'] += $this->_sections['d']['step'], $this->_sections['d']['iteration']++):
$this->_sections['d']['rownum'] = $this->_sections['d']['iteration'];
$this->_sections['d']['index_prev'] = $this->_sections['d']['index'] - $this->_sections['d']['step'];
$this->_sections['d']['index_next'] = $this->_sections['d']['index'] + $this->_sections['d']['step'];
$this->_sections['d']['first']      = ($this->_sections['d']['iteration'] == 1);
$this->_sections['d']['last']       = ($this->_sections['d']['iteration'] == $this->_sections['d']['total']);
?>
	   <?php if ($this->_sections['d']['index'] > 0): ?>
	    <tr>
	    <?php endif; ?>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['year']; ?>
年</td>
	   <?php $_from = $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['org_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<td  ><?php echo $this->_tpl_vars['v']; ?>
</td>
			<?php endforeach; endif; unset($_from); ?>
			<?php $_from = $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['org_under_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<td  ><?php echo $this->_tpl_vars['v']; ?>
</td>
			<?php endforeach; endif; unset($_from); ?>
	  </tr>
	  <?php endfor; else: ?>
	    <td colspan="<?php echo $this->_tpl_vars['rows_org_ext']; ?>
" align="left">无机构基本信息数据</td>
	  </tr>
	 <?php endif; ?>
	 <?php endfor; else: ?>
	  <td colspan="<?php echo $this->_tpl_vars['rows_org']; ?>
" align="left">无机构数据</td>
	  </tr>
	 <?php endif; ?>
     <?php endfor; endif; ?>
</table>
<hr style="color:red;height:3px;" />
<table width="100%" border="0">
	<tr class="headbg">
		<td rowspan="2">地区</td>
	    <td align="center" rowspan="2">机构名称</td>
		<td align="center" rowspan="2">年&nbsp;&nbsp;&nbsp;&nbsp;份</td>
		<td align="center" colspan="2">机构所在地是否民族自治地方</td>
		<td align="center" colspan="2">是否公费医疗/医疗保险定点医院</td>
		<td align="center" colspan="2">是否新型农村合作医疗定点医院</td>
		<td align="center" colspan="2">是否直报疫情及突发公共卫生事件</td>
		<td align="center" colspan="1">计算机台数</td>
		<td align="center" colspan="2">是否配置健康教育录(放)像设备</td>
		<td align="center" colspan="1">下设直属分站(院、所)个数</td>
	</tr>
	<tr class="headbg">
		<td>是</td>
		<td>否</td>
		
		<td>是</td>
		<td>否</td>
		
		<td>是</td>
		<td>否</td>

		<td>是</td>
		<td>否</td>
		
		<td>总数</td>
		
		<td>是</td>
		<td>否</td>
		
		<td>总数</td>
	</tr>
		<?php unset($this->_sections['region_array']);
$this->_sections['region_array']['loop'] = is_array($_loop=$this->_tpl_vars['region_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['region_array']['name'] = 'region_array';
$this->_sections['region_array']['show'] = true;
$this->_sections['region_array']['max'] = $this->_sections['region_array']['loop'];
$this->_sections['region_array']['step'] = 1;
$this->_sections['region_array']['start'] = $this->_sections['region_array']['step'] > 0 ? 0 : $this->_sections['region_array']['loop']-1;
if ($this->_sections['region_array']['show']) {
    $this->_sections['region_array']['total'] = $this->_sections['region_array']['loop'];
    if ($this->_sections['region_array']['total'] == 0)
        $this->_sections['region_array']['show'] = false;
} else
    $this->_sections['region_array']['total'] = 0;
if ($this->_sections['region_array']['show']):

            for ($this->_sections['region_array']['index'] = $this->_sections['region_array']['start'], $this->_sections['region_array']['iteration'] = 1;
                 $this->_sections['region_array']['iteration'] <= $this->_sections['region_array']['total'];
                 $this->_sections['region_array']['index'] += $this->_sections['region_array']['step'], $this->_sections['region_array']['iteration']++):
$this->_sections['region_array']['rownum'] = $this->_sections['region_array']['iteration'];
$this->_sections['region_array']['index_prev'] = $this->_sections['region_array']['index'] - $this->_sections['region_array']['step'];
$this->_sections['region_array']['index_next'] = $this->_sections['region_array']['index'] + $this->_sections['region_array']['step'];
$this->_sections['region_array']['first']      = ($this->_sections['region_array']['iteration'] == 1);
$this->_sections['region_array']['last']       = ($this->_sections['region_array']['iteration'] == $this->_sections['region_array']['total']);
?>   
	   <tr align="center" style="cursor:pointer">
	    <td rowspan="<?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['rowspan']; ?>
"><?php if ($this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['region_level'] < 6): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/orgbase/index/region_id/<?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['zh_name']; ?>
</a><?php else:  echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['zh_name'];  endif; ?></td>
	    <?php unset($this->_sections['c']);
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
	    <?php if ($this->_sections['c']['index'] > 0): ?>
	    <tr>
	    <?php endif; ?>
	    <td rowspan="<?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['org_ext']; ?>
"><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['zh_name']; ?>
</td>
	   <?php unset($this->_sections['d']);
$this->_sections['d']['loop'] = is_array($_loop=$this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['d']['name'] = 'd';
$this->_sections['d']['show'] = true;
$this->_sections['d']['max'] = $this->_sections['d']['loop'];
$this->_sections['d']['step'] = 1;
$this->_sections['d']['start'] = $this->_sections['d']['step'] > 0 ? 0 : $this->_sections['d']['loop']-1;
if ($this->_sections['d']['show']) {
    $this->_sections['d']['total'] = $this->_sections['d']['loop'];
    if ($this->_sections['d']['total'] == 0)
        $this->_sections['d']['show'] = false;
} else
    $this->_sections['d']['total'] = 0;
if ($this->_sections['d']['show']):

            for ($this->_sections['d']['index'] = $this->_sections['d']['start'], $this->_sections['d']['iteration'] = 1;
                 $this->_sections['d']['iteration'] <= $this->_sections['d']['total'];
                 $this->_sections['d']['index'] += $this->_sections['d']['step'], $this->_sections['d']['iteration']++):
$this->_sections['d']['rownum'] = $this->_sections['d']['iteration'];
$this->_sections['d']['index_prev'] = $this->_sections['d']['index'] - $this->_sections['d']['step'];
$this->_sections['d']['index_next'] = $this->_sections['d']['index'] + $this->_sections['d']['step'];
$this->_sections['d']['first']      = ($this->_sections['d']['iteration'] == 1);
$this->_sections['d']['last']       = ($this->_sections['d']['iteration'] == $this->_sections['d']['total']);
?>
	   <?php if ($this->_sections['d']['index'] > 0): ?>
	    <tr>
	    <?php endif; ?>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['year']; ?>
年</td>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['is_nation_autonomy_y']; ?>
</td>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['is_nation_autonomy_n']; ?>
</td>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['is_medicare_point_hospital_y']; ?>
</td>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['is_medicare_point_hospital_n']; ?>
</td>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['is_new_point_hospital_y']; ?>
</td>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['is_new_point_hospital_n']; ?>
</td>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['is_common_event_report_y']; ?>
</td>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['is_common_event_report_n']; ?>
</td>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['computer_count']; ?>
</td>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['has_health_edu_equipment_y']; ?>
</td>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['has_health_edu_equipment_n']; ?>
</td>
	    <td><?php echo $this->_tpl_vars['region_array'][$this->_sections['region_array']['index']]['org'][$this->_sections['c']['index']]['ext'][$this->_sections['d']['index']]['child_chss_count']; ?>
</td>
	  </tr>
	  <?php endfor; else: ?>
	    <td colspan="15" align="left">无机构基本信息数据</td>
	  </tr>
	 <?php endif; ?>
	 <?php endfor; else: ?>
	  <td colspan="16" align="left">无机构数据</td>
	  </tr>
	 <?php endif; ?>
     <?php endfor; endif; ?>
</table>
</body>
</html>
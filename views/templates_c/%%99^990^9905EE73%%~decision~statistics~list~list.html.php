<?php /* Smarty version 2.6.14, created on 2013-09-26 14:41:37
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en" />
<meta name="GENERATOR" content="Zend Studio" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
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
<title>地区老年人统计表</title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" media="all" type="text/css" rel="stylesheet"/>
</head>
<body>
<table border="1px" align="center" width="100%">
     <tr class="bigfont">
       <td colspan="11" align="center"><center><strong>地区老年人统计表<?php echo $this->_tpl_vars['year_start']; ?>
至<?php echo $this->_tpl_vars['end_time']; ?>
</strong></center></td>
     </tr>
          <tr class="bigfont">
              <td colspan="12">  <form action="" method="POST">
            时间：<input type="text" onClick="WdatePicker({firstDayOfWeek:1})"  name="time_start" value="<?php echo $this->_tpl_vars['year_start']; ?>
"/> 
            <input type="text" onClick="WdatePicker({firstDayOfWeek:1})"  name="time_end" value="<?php echo $this->_tpl_vars['end_time']; ?>
"/>    
            <input type="hidden" name="check_time" value="<?php echo $this->_tpl_vars['time1']; ?>
|<?php echo $this->_tpl_vars['time2']; ?>
">
            <input type="submit" value="搜索" value="okok" />
         </form></td>
          </tr>
     <tr class="headbg">
       <td colspan="11"><?php unset($this->_sections['rs']);
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
decision/statistics/list/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
"><?php if ($this->_tpl_vars['add_need_id'] == $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']): ?><font color="Red"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a></font><?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/statistics/list/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a><?php endif; ?>&nbsp;&nbsp;->&nbsp;&nbsp;<?php endfor; endif; ?></td>
     </tr>
     <tr class="bigfont">
        <td ><strong>地区名称</strong></td>
         <td ><strong>年内辖区内65岁及以上常住居民数</strong></td>   
           <td ><strong>接受健康管理人数</strong></td>  
              <td ><strong>生活自理能力评估人数</strong></td>  
                 <td ><strong>生活方式评估人数</strong></td>  
                    <td ><strong>健康状况评估人数</strong></td>  
                       <td ><strong>健康体检人数</strong></td>  
                          <td ><strong>辅助检查人数</strong></td> 
                           <td ><strong>健康指导人数</strong></td>  
                          
          
        <td ><strong>老年居民健康管理率(%)</strong></td>
        <!--<td width="15%"><strong>健康体检表完整率(%)</strong></td>-->
        <td ><strong>查看下级地区</strong></td>
     </tr>
    <?php if ($this->_tpl_vars['row']): ?>
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
            <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['allPerson']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['lonePerson']; ?>
</td>
             <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['et_lifecase_assessment']; ?>
</td>    
              <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['et_lifestyle']; ?>
</td>    
               <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['et_health_assessment']; ?>
</td>
                <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['examination_table']; ?>
</td>   
                 <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['examination_table']; ?>
</td>   
                   <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['et_health_guidance']; ?>
</td>   
                   
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['percent']; ?>
</td>     
           <!--<td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['archive']; ?>
</td>-->
           <td>
           <a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/statistics/list/parent_id/<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
">[进入子地区]</a>
           </td>
        </tr>
     <?php endfor; endif; ?> 
    <?php else: ?>
    <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
        <td colspan="11" ><font color="red" >无信息!</font></td>
    </tr>
    <?php endif; ?>
     <tr><td colspan="11">1、考核指标:
老年人健康管理率＝接受健康管理人数（年内辖区内65岁及以上常住居民、统计时间段内）/年内辖区内65岁及以上常住居民数（统计时间段内）×100％.<br/>

<b>接受健康管理人数（统计时间段内）为:</b><br/>
1)老年人（年内辖区内65岁及以上常住居民）生活自理能力评估人数（统计时间段内）。<br/>
2)老年人（年内辖区内65岁及以上常住居民）生活方式评估人数（统计时间段内）。<br/>
3)老年人（年内辖区内65岁及以上常住居民）健康状况评估人数（统计时间段内）。<br/>
4)老年人（年内辖区内65岁及以上常住居民）健康体检人数（统计时间段内）。<br/>
5)老年人（年内辖区内65岁及以上常住居民）辅助检查人数（统计时间段内）。<br/>
6)老年人（年内辖区内65岁及以上常住居民）健康指导人数（统计时间段内）。<br/>

</td></tr>
</table>
</body>
</html>
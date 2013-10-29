<?php /* Smarty version 2.6.14, created on 2013-09-26 14:41:26
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body{
	font-size:14px;
	padding:0px;
	margin-top:2px; 
	background-color:#ecf6ff
}    
body table,tr,td,th{
	height:26px;
	font-size:13px;  /*表格*/
	border-collapse:collapse;
	border:#CCCCCC 1px solid；
}
table,tr,td a{
  color: #000;
}
*{padding:0;margin:0;} 
table{ border-collapse:collapse;border:1px #525152 solid;width:100%;margin:0 auto;} 
th,td{border:1px #525152 solid;text-align:center;font-size:12px;line-height:30px;background:#fff;} /*表格内部样式*/
th{background:#D6D3D6;} /*标题背景*/ 
/*表格斜线*/ 
.out{ 
   border-top:60px #4e9ddf solid;/*上边框宽度等于表格第一行行高*/ 
   width:0px;/*让容器宽度为0*/ 
   height:0px;/*让容器高度为0*/ 
   border-left:80px #fff solid;/*左边框宽度等于表格第一行第一格宽度,姓名部分的背景颜色*/     
   position:relative;/*让里面的两个子容器绝对定位*/ 
} 
b{font-style:normal;display:block;position:absolute;top:-60px;left:-40px;width:35px;} 
em{font-style:normal;display:block;position:absolute;top:-25px;left:-70px;width:55x;} 
.t1{background:#fff;font-weight:bold;} 
 .headbg{  /*头部*/
	font-weight:bold;
	color:#FFFFFF;
	background-color:#4e9ddf;
}
.topbg{
background:#bad5f0;
font-weight:bold;
}
</style>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>
<title>辖区内糖尿病统计表</title>
</head>
<body>
<form method="post" action="<?php echo $this->_tpl_vars['basePath']; ?>
decision/clinical/index/model/<?php echo $this->_tpl_vars['model']; ?>
/type/<?php echo $this->_tpl_vars['type']; ?>
">
<table>
<tr>
       <td style="text-align: left;padding-left:8px" >
		开始时间：<input type="text" name="start_time" id="start_time" class="Wdate" onfocus="WdatePicker({isShowWeek:true,maxDate:'#F{$dp.$D(\'end_time\')||\'2020-10-01\'}'})" value="<?php echo $this->_tpl_vars['start_time']; ?>
" />&nbsp;&nbsp;结束时间：<input type="text" name="end_time" id="end_time" class="Wdate" onfocus="WdatePicker({isShowWeek:true,minDate:'#F{$dp.$D(\'start_time\')}'})" value="<?php echo $this->_tpl_vars['end_time']; ?>
" />*此时间为确诊时间，未填写确诊时间的将不会在统计结果中出现</td>
     </tr>
<tr>
       <td style="text-align: left;padding-left:8px" >
		当前统计区域：<?php unset($this->_sections['rs']);
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
decision/clinical/index/model/<?php echo $this->_tpl_vars['model']; ?>
/type/<?php echo $this->_tpl_vars['type']; ?>
/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
"><?php if ($this->_tpl_vars['add_need_id'] == $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']): ?><font color="Red"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a></font><?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/clinical/index/model/<?php echo $this->_tpl_vars['model']; ?>
/type/<?php echo $this->_tpl_vars['type']; ?>
/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['end_time']; ?>
"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a><?php endif; ?>&nbsp;&nbsp;->&nbsp;&nbsp;<?php endfor; endif; ?></td>
     </tr>
  <tr><td style="text-align: left;padding-left:8px"><input type="hidden" value="<?php echo $this->_tpl_vars['p_id']; ?>
" name="parent_id" /><input type="submit" name="submit" value="统计结果"  style="width: 75px; height:28px;"/></td></tr>
</table>
</form>
<br />
<table style="width: <?php echo $this->_tpl_vars['table_width']; ?>
;"> 
<tr> 
    <th style="width:80px;" rowspan="2"> 
        <div class="out"> 
            <b>性别</b> 
            <em>地区</em> 
        </div> 
    </th> 
  <?php echo $this->_tpl_vars['table_title']; ?>

</tr>
<?php echo $this->_tpl_vars['table_body']; ?>

</table> 
</body>
</html>
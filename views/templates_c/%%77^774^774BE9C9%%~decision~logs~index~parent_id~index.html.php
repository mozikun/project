<?php /* Smarty version 2.6.14, created on 2013-09-03 14:13:41
         compiled from index.html */ ?>
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
<title>接口日志统计</title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" media="all" type="text/css" rel="stylesheet"/>
</head>
<body>
<table border="1px" align="center" width="100%">
     <tr class="bigfont">
     	<td colspan="6" align="center">
     	<center><strong>
     	 <?php $_from = $this->_tpl_vars['model_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
 if ($this->_tpl_vars['model'] == $this->_tpl_vars['k']): ?>[<?php echo $this->_tpl_vars['v']; ?>
]<?php endif;  endforeach; endif; unset($_from); ?>接口日志综合统计(<?php echo $this->_tpl_vars['start_time']; ?>
~<?php echo $this->_tpl_vars['decision_time']; ?>
)
     	</strong></center>
     	</td>   	
     </tr>
     <tr class="bigfont">
     	<td colspan="6">
     	<form action="" method="POST">
            开始时间：<input type="text" onClick="WdatePicker({firstDayOfWeek:1,maxDate:'#F{$dp.$D(\'search_time\')||\'2030-12-31\'}'})" class="" id="form_start_time" name="form_start_time" value="<?php echo $this->_tpl_vars['start_time']; ?>
"/> -
            结束时间：<input type="text" onClick="WdatePicker({firstDayOfWeek:1,minDate:'#F{$dp.$D(\'form_start_time\')}',maxDate:'2030-12-31'})" class="" id="search_time" name="search_time" value="<?php echo $this->_tpl_vars['decision_time']; ?>
"/> 
            模块：<select name="form_model">
            	<option value="99">请选择</option>
            	 <?php $_from = $this->_tpl_vars['model_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            	    <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['model'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
            	 <?php endforeach; endif; unset($_from); ?>
                 </select>
            <input type="submit" value="搜索" value="ok" />
         </form>
       </td>
     </tr>
     <tr class="headbg">
     	<td colspan="6"><?php unset($this->_sections['rs']);
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
decision/logs/index/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
/model/<?php echo $this->_tpl_vars['model']; ?>
/type/<?php echo $this->_tpl_vars['type']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
"><?php if ($this->_tpl_vars['add_need_id'] == $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']): ?><font color="Red"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></font></a><?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/logs/index/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
/model/<?php echo $this->_tpl_vars['model']; ?>
/type/<?php echo $this->_tpl_vars['type']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a><?php endif; ?>&nbsp;&nbsp;->&nbsp;&nbsp;<?php endfor; endif; ?></td>
     </tr>
     <tr class="bigfont">
     	<td  width="16%"><strong>地区名称</strong></td>
     	<td  width="16%"><strong>添加条数</strong></td>
     	<td  width="16%"><strong>修改条数</strong></td>
     	<td  width="16%"><strong>删除条数</strong></td>
     	<td  width="18%"><strong><?php if ($this->_tpl_vars['td_title'] == 1): ?>查看下级地区<?php else: ?>建档机构<?php endif; ?></strong></td>
     	<td  width="18%">统计图</td>
     </tr>
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
     <tr onmousemove="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
     	<td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['zh_name']; ?>
</td>
     	<td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_logs_1']; ?>
</td>
     	<td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_logs_2']; ?>
</td>
     	<td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sum_logs_3']; ?>
</td>
     	<td>
           <?php if ($this->_tpl_vars['td_title'] == 1): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/logs/index/parent_id/<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
/model/<?php echo $this->_tpl_vars['model']; ?>
/type/<?php echo $this->_tpl_vars['type']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
">[进入子地区]</a><?php endif; ?>
           <?php if ($this->_tpl_vars['td_title'] == 2):  echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['org_zh_name'];  endif; ?>    
        </td>
        <td>&nbsp<a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/logs/image/id/<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
/model/<?php echo $this->_tpl_vars['model']; ?>
/type/<?php echo $this->_tpl_vars['type']; ?>
/start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/end_time/<?php echo $this->_tpl_vars['decision_time']; ?>
">查看统计图</a></td>
     </tr>
     <?php endfor; endif; ?>
     <tr class="headbg">
     	<td><strong>小计</strong></td>
     	<td><?php echo $this->_tpl_vars['sum_total_1']; ?>
</td>
     	<td><?php echo $this->_tpl_vars['sum_total_2']; ?>
</td>    
     	<td><?php echo $this->_tpl_vars['sum_total_3']; ?>
</td>    
     	<td>&nbsp;</td>
     	<td>&nbsp;</td>
     </tr>
     <tr>
     <td colspan="6">选择时间时，开始时间不能大于结束时间，结束时间也不能小于开始时间。</td>
     </tr>
</body>
</html>
<?php /* Smarty version 2.6.14, created on 2013-06-18 09:54:13
         compiled from list.html */ ?>
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
<script type="text/javascript">
$(function(){
    $("#btn1").click(function(){
        $.dialog(300,150,'<form id="popup" action="<?php echo $this->_tpl_vars['basePath']; ?>
region/region/addregion/need_add_id/<?php echo $this->_tpl_vars['add_need_id']; ?>
" method="POST"><div  align="center" style="width:300px;margin-top:0px;"><div style="float:left; width:298px;margin-top:5px;">地区名称:<input type="text" name="region_name" id="region_name"/></div><div style="float:left; width:298px;margin-top:5px;">地区编码:<input type="text" name="standard_code" id="standard_code"  size="<?php echo $this->_tpl_vars['standard_code_size']; ?>
" maxlength="<?php echo $this->_tpl_vars['standard_code_size']; ?>
" /></div><div style="float:left; width:298px;margin-top:5px;"><input type="button" value="添加" name="ok" id="ok" onclick="mysubmit();" /></div></div></form>','','添加地区');
    });

})
</script>
<title>地区列表</title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" media="all" type="text/css" rel="stylesheet"/>
</head>
<body>
<table border="1px" align="center" width="100%">
     <tr class="bigfont">
       <td colspan="11" align="center"><center><strong>地区基本建档率统计表(<?php echo $this->_tpl_vars['start_time']; ?>
~<?php echo $this->_tpl_vars['decision_time']; ?>
)</strong></center></td>
     </tr>
     <tr class="bigfont">
       <td colspan="11">
         <form action="" method="POST">
            时间㈣：开始时间：<input type="text" onClick="WdatePicker({firstDayOfWeek:1})" class="" name="start_time" value="<?php echo $this->_tpl_vars['start_time']; ?>
"/>&nbsp;&nbsp;结束时间：<input type="text" onClick="WdatePicker({firstDayOfWeek:1})" class="" name="end_time" value="<?php echo $this->_tpl_vars['decision_time']; ?>
"/>          <input type="submit" value="搜索" value="okok" />
         </form>
       </td>
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
decision/base/list/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
/url_start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
"><?php if ($this->_tpl_vars['add_need_id'] == $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']): ?><font color="Red"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a></font><?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/base/list/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
/url_start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a><?php endif; ?>&nbsp;&nbsp;->&nbsp;&nbsp;<?php endfor; endif; ?></td>
     </tr>
     <tr class="bigfont">
        <td width="10%" rowspan="2"><strong>地区名称</strong></td>
        <td width="10%" rowspan="2"><strong>地区人口数</strong></td>
        <td width="35%" colspan="5"><strong>建档数</strong></td>
        <td width="10%" rowspan="2"><strong>总建档率<br />(100%)</strong></td>
        <td width="12%" rowspan="2"><strong>一年内<br />新建档数</strong></td>
        <td width="12%" rowspan="2"><strong>一年内<br />新建档率<br />(100%)</strong></td>
        <td width="10%" rowspan="2"><strong><?php if ($this->_tpl_vars['td_title'] == 1): ?>查看下级地区<?php endif;  if ($this->_tpl_vars['td_title'] == 2): ?>建档机构<?php endif; ?></strong></td>
     </tr>
     <tr class="bigfont">
        <td>城镇人口</td><td>农村人口</td><td>暂住人口</td><td>未说明</td><td>已建档数</td>
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
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['population']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['archive_urban']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['archive_rural']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['archive_transient']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['archive_undefine']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['archive']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['archive_rate']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['archive_last_year']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['archive_rate_last_year']; ?>
</td>
           <td>
           <?php if ($this->_tpl_vars['td_title'] == 1): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/base/list/parent_id/<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
/url_start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
">[进入子地区]</a><?php endif; ?>
           <?php if ($this->_tpl_vars['td_title'] == 2):  echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['org_zh_name'];  endif; ?>
           
           </td>
        </tr>
     <?php endfor; endif; ?>
        <tr class="headbg">
           <td>小计</td>
           <td><?php echo $this->_tpl_vars['sum_population']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_archive_urban']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_archive_rural']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_archive_transient']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_archive_undefine']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_archive']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_archive_rate']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_archive_last_year']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_archive_rate_last_year']; ?>
</td>
           <td>&nbsp;</td>
        </tr>
     <tr>
       <td colspan="11">
        （一）地区人口数为各机构填报数字，非统计数字。（与时间无关）<br />
        （二）已建档数为（至统计时间）所有已建档人数。<br />
        （三）总建档率=已建档数（至统计时间）/地区人口数<br />
        （四）一年内新建档数（统计时间段内）<br />
        （五）一年内新建档率=一年内新建档数/地区人口数（统计时间段内）<br />
        （六）<strong>统计时间段内</strong>：表示该统计指标在所选择的统计时间段内，如选择2012-09-27，则本统计指标统计的数据为2012-01-01至2012-09-27的结果。<br />
        （七）<strong>至统计时间</strong>：表示该统计指标所统计数据至所选择的统计时间为止的之前的所有数据，如选择2012-09-26，则统计截止于2012-09-27之前的所有数据<br />
        （八）<strong>与时间无关</strong>：表示该统计指标与所选择的统计时间完全无关，将统计数据库内的所有数据（满足其他条件）
<br />
（九）、受目前服务器运算能力限制，综合平衡指标的准确性与运算时间的关系，上述指标的统计暂不区分下述情况：<br />
     &nbsp;&nbsp;&nbsp;1)统计时段内从居民确诊为患者<br />
     &nbsp;&nbsp;&nbsp;2)统计时段内的患者死亡<br />
     &nbsp;&nbsp;&nbsp;3)统计时段内的患者迁出<br />
     &nbsp;&nbsp;&nbsp;强烈建议统计的时间范围不宜超过2年。时间范围越大，与规范管理的实际情况出入越大。<br />
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

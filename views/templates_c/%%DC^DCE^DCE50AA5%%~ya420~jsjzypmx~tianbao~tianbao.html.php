<?php /* Smarty version 2.6.14, created on 2013-04-27 20:15:52
         compiled from tianbao.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>四川雅安“4.20”地震接受捐赠药品明细表</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
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
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" />
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/ajax_select_region.js" type="text/javascript"></script>
</head>
<body>
<form name="do_all" id="do_all" method="post" action="<?php echo $this->_tpl_vars['basePath']; ?>
ya420/jsjzypmx/tianbaoin">
<table border="0" width="100%">
    <tr class="headbg">
    	<td colspan="11">
        	四川雅安“4.20”地震接受捐赠药品明细表
        </td>
	</tr>
    <tr><td colspan="11">区县:<span id="menuDropDownBox"></span><input type="hidden" name="org_id" id="org_id" value="<?php echo $this->_tpl_vars['org_id']; ?>
" />填报日期：<input type="text" name="start_time" value="<?php echo $this->_tpl_vars['search']['start_time']; ?>
" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd H:m:s'})" class="Wdate" size="25" />至<input type="text" name="end_time" value="<?php echo $this->_tpl_vars['search']['end_time']; ?>
" class="Wdate" size="25" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd H:m:s'})" /></td></tr>
    <tr class="columnbg">
			        <td colspan="2">口服药品</td>
                    <td colspan="2">注射剂</td>
                    <td colspan="2">抗生素</td>
                    <td colspan="2">毒麻药品</td>
                    <td colspan="2">外用药品</td>
  <td rowspan="2">
       		 录入时间
		</td>
    </tr>
    <tr class="title">
                <td>品种</td><td>金额</td>
                <td>品种</td><td>金额</td>
                <td>品种</td><td>金额</td>
                <td>品种</td><td>金额</td>
                <td>品种</td><td>金额</td>
     </tr>
	<?php unset($this->_sections['jsjzypmxs']);
$this->_sections['jsjzypmxs']['name'] = 'jsjzypmxs';
$this->_sections['jsjzypmxs']['loop'] = is_array($_loop=$this->_tpl_vars['jsjzypmxs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['jsjzypmxs']['show'] = true;
$this->_sections['jsjzypmxs']['max'] = $this->_sections['jsjzypmxs']['loop'];
$this->_sections['jsjzypmxs']['step'] = 1;
$this->_sections['jsjzypmxs']['start'] = $this->_sections['jsjzypmxs']['step'] > 0 ? 0 : $this->_sections['jsjzypmxs']['loop']-1;
if ($this->_sections['jsjzypmxs']['show']) {
    $this->_sections['jsjzypmxs']['total'] = $this->_sections['jsjzypmxs']['loop'];
    if ($this->_sections['jsjzypmxs']['total'] == 0)
        $this->_sections['jsjzypmxs']['show'] = false;
} else
    $this->_sections['jsjzypmxs']['total'] = 0;
if ($this->_sections['jsjzypmxs']['show']):

            for ($this->_sections['jsjzypmxs']['index'] = $this->_sections['jsjzypmxs']['start'], $this->_sections['jsjzypmxs']['iteration'] = 1;
                 $this->_sections['jsjzypmxs']['iteration'] <= $this->_sections['jsjzypmxs']['total'];
                 $this->_sections['jsjzypmxs']['index'] += $this->_sections['jsjzypmxs']['step'], $this->_sections['jsjzypmxs']['iteration']++):
$this->_sections['jsjzypmxs']['rownum'] = $this->_sections['jsjzypmxs']['iteration'];
$this->_sections['jsjzypmxs']['index_prev'] = $this->_sections['jsjzypmxs']['index'] - $this->_sections['jsjzypmxs']['step'];
$this->_sections['jsjzypmxs']['index_next'] = $this->_sections['jsjzypmxs']['index'] + $this->_sections['jsjzypmxs']['step'];
$this->_sections['jsjzypmxs']['first']      = ($this->_sections['jsjzypmxs']['iteration'] == 1);
$this->_sections['jsjzypmxs']['last']       = ($this->_sections['jsjzypmxs']['iteration'] == $this->_sections['jsjzypmxs']['total']);
?>
	 <tr>
	 	<td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['kfyppz']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['kfypje']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['zsyppz']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['zsypje']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['ksyppz']; ?>

        </td><td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['ksypje']; ?>

        </td><td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['dmyppz']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['dmypje']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['yyyppz']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['yyypje']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['created']; ?>

        </td>
	</tr>
	<?php endfor; endif; ?>
	<tr>
		<td colspan="11">
        	&nbsp;联系电话：<input type="text" name="lxdh" class="input" />审核人：<select name="staff_id" id="staff_id">
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
        </td>
	</tr>
    <tr>
		<td style="text-align:center;" colspan="11">
        	<input type="submit" value="上报内容" class="input" style="height: 28px;font-size:14px;"  />
	</tr>
	</tbody>
</table>
</form>
</body>
</html>
<script>
$(document).ready(function(){
    //处理地区下拉
    get_region_select_html('<?php echo $this->_tpl_vars['basePath']; ?>
','org_id','menuDropDownBox');
});
</script>
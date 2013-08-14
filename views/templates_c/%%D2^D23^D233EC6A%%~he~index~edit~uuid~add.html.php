<?php /* Smarty version 2.6.14, created on 2013-06-17 16:10:48
         compiled from add.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>健康教育活动记录表</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<style>
	table
	{
		background:#ffffff;
	}
	.nobg table,td,tr
	{
		border:0px;
	}
	.line_table td
	{
		border:1px solid #ccc;
		margin:2px 0px 2px 0px;
	}
	.none
	{
	    border:1px solid #FFF;
		border-bottom:1px solid #ccc;
	}
    .input{
	margin-right:6px;
    border:1px solid #ccc;
    }
</style>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" />
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>   <!--时间控件的加载!-->
<script>
$(document).ready(function(){
    $("input[name='promo_type']").blur(function(){
        if($("input[name='promo_type']").val()!="" && parseInt($("input[name='promo_type']").val())!=$("input[name='promo_type']").val())
        {
            alert("健康教育资料发放种类只能为数值");
            $("input[name='promo_type']").focus();
            return false;
        }
        return false;
    })
    $("input[name='person_num']").blur(function(){
        if($("input[name='person_num']").val()!="" && parseInt($("input[name='person_num']").val())!=$("input[name='person_num']").val())
        {
            alert("接受健康教育人数只能为数值");
            $("input[name='person_num']").focus();
            return false;
        }
        return false;
    })
    $("input[name='promo_num']").blur(function(){
        if($("input[name='promo_num']").val()!="" && parseInt($("input[name='promo_num']").val())!=$("input[name='promo_num']").val())
        {
            alert("健康教育资料发放数量只能为数值");
            $("input[name='promo_num']").focus();
            return false;
        }
        return false;
    })
});
function checkForm()
{
	if($("#activity_time").val()=="")
    {
    	alert("活动时间不能为空！");
    	$("#activity_time").focus();
    	return false;
    }
    if($("#activity_address").val()=="")
    {
    	alert("活动地点不能为空！");
    	$("#activity_address").focus();
    	return false;
    }
     if($("#activity_theme").val()=="")
    {
    	alert("活动主题不能为空！");
    	$("#activity_theme").focus();
    	return false;
    }
    if($("#sponsor").val()=="")
    {
    	alert("组织者不能为空！");
    	$("#sponsor").focus();
    	return false;
    } 
    if($("#active_summary").val()=="")
    {
    	alert("活动内容不能为空！");
    	$("#active_summary").focus();
    	return false;
    }
}
  
</script>
</head>
<body>
<table border="0" width="100%" class="nobg">
	<form method="post" action="<?php echo $this->_tpl_vars['basePath']; ?>
he/index/save" onsubmit="return checkForm();">
    <tr style="border:0px ">
        <td>
        	附件
        </td>
	</tr>
	<tr>
		<td style="font-size:14px;font-weight:bold;text-align:center;line-height:68px;">
        	健康教育活动记录表
        </td>
	</tr>
	<tr>
		<td style="text-align:center;">
        	<table border="0" width="100%" class="line_table">
			    <tr>
			        <td style="width:50%;">
			        	活动时间:&nbsp;
						<input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['health_education']->uuid; ?>
" />
						<input type="text" name="activity_time" id="activity_time" value="<?php echo $this->_tpl_vars['health_education']->activity_time; ?>
" class="Wdate" size="20" onClick="WdatePicker({firstDayOfWeek:1})" />
			        </td>			
					<td style="width:50%;">
			        	活动地点:&nbsp;<input type="text" id="activity_address" name="activity_address" value="<?php echo $this->_tpl_vars['health_education']->activity_address; ?>
" class="none" size="35" />
			        </td>
				</tr>
				<tr>
			        <td colspan="2">
			        	活动形式:&nbsp;
						<span>
						<?php $_from = $this->_tpl_vars['he_active_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
						&nbsp;<label style="padding-left: 28px;cursor: pointer;"><input type="checkbox" value="<?php echo $this->_tpl_vars['k']; ?>
" <?php echo $this->_tpl_vars['v']['check']; ?>
 name="activity_type[]" /><?php echo $this->_tpl_vars['v'][1]; ?>
</label>
						<?php endforeach; endif; unset($_from); ?>
						</span>
			        </td>			
					
				</tr>
                <tr>
			        <td colspan="2" style="height:100px;">
			        	<span style="float: left;line-height: 100px;">活&nbsp;动&nbsp;主&nbsp;题&nbsp;:&nbsp;&nbsp;</span>
						<textarea name="activity_theme" id="activity_theme" class="input" cols="60" rows="6"><?php echo $this->_tpl_vars['health_education']->activity_theme; ?>
</textarea>
			        </td>			
				</tr>
                <tr>
                <td colspan="2">
			        	组织者:&nbsp;<input type="text" name="sponsor" id="sponsor" value="<?php echo $this->_tpl_vars['health_education']->sponsor; ?>
" class="none" size="35" />
			        </td>
                </tr>
				<tr>
			        <td style="width:50%;">
			        	接受健康教育人员类别:&nbsp;<input type="text" name="person_category" value="<?php echo $this->_tpl_vars['health_education']->person_category; ?>
" class="none" size="35" />
			        </td>			
					<td style="width:50%;">
			        	接受健康教育人数:&nbsp;<input type="text" name="person_num" value="<?php echo $this->_tpl_vars['health_education']->person_num; ?>
" class="none" size="15" />
			        </td>
				</tr>
				<tr>
			        <td style="width:50%;">
			        	健康教育资料发放种类:&nbsp;<input type="text" name="promo_type" value="<?php echo $this->_tpl_vars['health_education']->promo_type; ?>
" class="none" size="15" />
			        </td>			
					<td style="width:50%;">
			        	健康教育资料发放数量:&nbsp;<input type="text" name="promo_num" value="<?php echo $this->_tpl_vars['health_education']->promo_num; ?>
" class="none" size="15" />
			        </td>
				</tr>
				<tr>
			        <td colspan="2" style="height:100px;">
			        	<span style="float: left;line-height: 100px;">活&nbsp;动&nbsp;内&nbsp;容&nbsp;:&nbsp;&nbsp;</span>
						<textarea name="active_summary" id="active_summary" class="input" cols="60" rows="6"><?php echo $this->_tpl_vars['health_education']->active_summary; ?>
</textarea>
			        </td>			
				</tr>
				<tr>
			        <td colspan="2" style="height:100px;">
			        	<span style="float: left;line-height: 100px;">活动总结评价:</span><textarea name="activity_juggde" class="input" cols="60" rows="6"><?php echo $this->_tpl_vars['health_education']->activity_juggde; ?>
</textarea>
			        </td>			
				</tr>
				<tr>
			        <td colspan="2">
			        	存档材料请附后：
						<?php $_from = $this->_tpl_vars['health_more_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
						<input type="checkbox" value="<?php echo $this->_tpl_vars['k']; ?>
" <?php echo $this->_tpl_vars['v']['check']; ?>
 name="more_info[]" /><?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
						<?php endforeach; endif; unset($_from); ?>
			        </td>			
				</tr>
				
			</table>
        </td>
	</tr>
	<tr>
		<td>
        	<span style="float: left;">填表人（签字）:
			<select name="people_fillin_form" id="people_fillin_form">
							<?php unset($this->_sections['people_fillin_form']);
$this->_sections['people_fillin_form']['name'] = 'people_fillin_form';
$this->_sections['people_fillin_form']['loop'] = is_array($_loop=$this->_tpl_vars['people_fillin_form']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['people_fillin_form']['show'] = true;
$this->_sections['people_fillin_form']['max'] = $this->_sections['people_fillin_form']['loop'];
$this->_sections['people_fillin_form']['step'] = 1;
$this->_sections['people_fillin_form']['start'] = $this->_sections['people_fillin_form']['step'] > 0 ? 0 : $this->_sections['people_fillin_form']['loop']-1;
if ($this->_sections['people_fillin_form']['show']) {
    $this->_sections['people_fillin_form']['total'] = $this->_sections['people_fillin_form']['loop'];
    if ($this->_sections['people_fillin_form']['total'] == 0)
        $this->_sections['people_fillin_form']['show'] = false;
} else
    $this->_sections['people_fillin_form']['total'] = 0;
if ($this->_sections['people_fillin_form']['show']):

            for ($this->_sections['people_fillin_form']['index'] = $this->_sections['people_fillin_form']['start'], $this->_sections['people_fillin_form']['iteration'] = 1;
                 $this->_sections['people_fillin_form']['iteration'] <= $this->_sections['people_fillin_form']['total'];
                 $this->_sections['people_fillin_form']['index'] += $this->_sections['people_fillin_form']['step'], $this->_sections['people_fillin_form']['iteration']++):
$this->_sections['people_fillin_form']['rownum'] = $this->_sections['people_fillin_form']['iteration'];
$this->_sections['people_fillin_form']['index_prev'] = $this->_sections['people_fillin_form']['index'] - $this->_sections['people_fillin_form']['step'];
$this->_sections['people_fillin_form']['index_next'] = $this->_sections['people_fillin_form']['index'] + $this->_sections['people_fillin_form']['step'];
$this->_sections['people_fillin_form']['first']      = ($this->_sections['people_fillin_form']['iteration'] == 1);
$this->_sections['people_fillin_form']['last']       = ($this->_sections['people_fillin_form']['iteration'] == $this->_sections['people_fillin_form']['total']);
?>
							<option value="<?php echo $this->_tpl_vars['people_fillin_form'][$this->_sections['people_fillin_form']['index']]['id']; ?>
" <?php echo $this->_tpl_vars['people_fillin_form'][$this->_sections['people_fillin_form']['index']]['selected']; ?>
 ><?php echo $this->_tpl_vars['people_fillin_form'][$this->_sections['people_fillin_form']['index']]['zh_name']; ?>
</option>
							<?php endfor; endif; ?>
			</select>
            </span>
            <span style="float: right;">负责人（签字）:
			<select name="person_in_charge" id="person_in_charge">
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
            </span>
        </td>
	</tr>
	<tr>
		<td style="text-align:right;">
        	填表时间：&nbsp;<input type="text" name="updated" value="<?php if ($this->_tpl_vars['health_education']->updated):  echo $this->_tpl_vars['health_education']->updated;  else:  echo $this->_tpl_vars['updated'];  endif; ?>" class="Wdate" size="20" onClick="WdatePicker({firstDayOfWeek:1})" />
        </td>
	</tr>
	<tr>
		<td style="text-align:center;">
        <input type="hidden" id="refer" name="refer" value="<?php echo $this->_tpl_vars['refer']; ?>
" />
        	<input type="submit" value="保存活动记录表" class="input" style="height: 28px;font-size:14px;"  /><?php if ($this->_tpl_vars['health_education']->uuid): ?>
    &nbsp;&nbsp;<input type="button" name="print" id="print" value="打印" class="input" onclick="javascript:window.print();"  style="height: 28px;font-size:14px;" />
    <?php endif; ?>
        </td>
	</tr>
	</form>
</table>
</body>
</html>
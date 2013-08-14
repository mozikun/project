<?php /* Smarty version 2.6.14, created on 2013-06-17 15:22:50
         compiled from edit.html */ ?>
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
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/editor/kindeditor-min.js" type="text/javascript"></script>
<script>
var editor;
KindEditor.ready(function(K) {
    editor = K.create('textarea[name="content"]', {
    resizeType : 1,
    width : "99%",
    height :"500px",
    allowPreviewEmoticons : false,
    allowImageUpload : false,
    items : [
    'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
    'insertunorderedlist', '|', 'emoticons', 'image', 'link']
    });
});
</script>
</head>
<body>
<table border="0" width="100%" class="nobg">
	<form method="post" action="<?php echo $this->_tpl_vars['basePath']; ?>
he/prescription/editin" onsubmit="editor.sync()">
	<tr>
		<td style="font-size:14px;font-weight:bold;text-align:center;line-height:68px;">
        	健康教育处方
        </td>
	</tr>
	<tr>
		<td style="text-align:center;">
        	<table border="0" width="100%" class="line_table">
			    <tr>
			        <td>处方标题:&nbsp;</td>
                    <td>
						<input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['health_education']->uuid; ?>
" />
						<input type="text" name="title" value="<?php echo $this->_tpl_vars['health_education']->title; ?>
" size="45" />
			        </td>
                </tr>
                <tr>
                    <td>处方内容:&nbsp;</td>
                    <td>
                          <textarea name="content" cols="60" rows="8"><?php echo $this->_tpl_vars['health_education']->content; ?>
</textarea>
			        </td>			
				</tr>
				<tr>
                    <td>处方权限:&nbsp;</td>
                    <td>
                          <input type="radio" name="status_type" value="1" <?php if ($this->_tpl_vars['health_education']->status_type == 1): ?>checked="checked"<?php endif; ?> />&nbsp;仅本机构使用&nbsp;<input type="radio" name="status_type" value="2" <?php if ($this->_tpl_vars['health_education']->status_type == 2 || $this->_tpl_vars['health_education']->status_type != 1): ?>checked="checked"<?php endif; ?> />&nbsp;开放所有机构使用&nbsp;
			        </td>			
				</tr>
			</table>
        </td>
	</tr>
	<tr>
		<td>
        	<span style="float: left;">填表人:
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
        </td>
	</tr>
	<tr>
		<td style="text-align:right;">
        	填表时间：&nbsp;<input type="text" name="updated" value="<?php if ($this->_tpl_vars['health_education']->edit_time):  echo $this->_tpl_vars['health_education']->edit_time;  else:  echo $this->_tpl_vars['updated'];  endif; ?>" class="Wdate" size="20" onClick="WdatePicker({firstDayOfWeek:1})" />
        </td>
	</tr>
	<tr>
		<td style="text-align:center;">
        <input type="hidden" id="refer" name="refer" value="<?php echo $this->_tpl_vars['refer']; ?>
" />
        	<input type="submit" value="保存健康教育处方" class="input" style="height: 28px;font-size:14px;"  /><?php if ($this->_tpl_vars['health_education']->uuid): ?>
    &nbsp;&nbsp;<input type="button" name="print" id="print" value="打印" class="input" onclick="javascript:window.location='<?php echo $this->_tpl_vars['basePath']; ?>
he/prescription/print/uuid/<?php echo $this->_tpl_vars['health_education']->uuid; ?>
';"  style="height: 28px;font-size:14px;" />
    <?php endif; ?>
        </td>
	</tr>
	</form>
</table>
</body>
</html>
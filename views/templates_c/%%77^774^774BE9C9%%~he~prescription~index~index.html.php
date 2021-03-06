<?php /* Smarty version 2.6.14, created on 2013-06-17 15:22:44
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>健康教育处方列表</title>
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
<script>
	function del(uuid,js_uuid)
	{
		if(confirm("确定要删除本条健康教育处方吗？"))
		{
			 $.ajax({
                    type: "get",
                    url: "<?php echo $this->_tpl_vars['basePath']; ?>
he/prescription/del/uuid/"+uuid,
                    dataType: "html",
                    data: "",
                    success: function(data){
                        if(data=="ok")
						{
							$("#he_"+js_uuid).hide();
							alert("删除处方成功");
						}
						else
						{
							alert("删除失败，未知的错误");
						}
                        return false;
                    },
                    error: function(){
                        alert("服务器返回信息不完整，请重新点击删除");
                        return false;
                    }
                });
		}
		return false;
	}
</script>
</head>
<body>
	<table border="0" width="100%">
			<tr><td>
				<form name="search" method="POST" action="<?php echo $this->_tpl_vars['basePath']; ?>
he/prescription/index">
				&nbsp;处方标题：&nbsp;<input type="text" name="address" size="30" value="<?php echo $this->_tpl_vars['search_array']['address']; ?>
" />
				&nbsp;处方权限：&nbsp;
				<select name="status_type">
                            <option value="" <?php if ($this->_tpl_vars['search_array']['status_typeaccesskey'] == ''): ?> selected="selected"<?php endif; ?> >请选择</option>
							<option value="1" <?php if ($this->_tpl_vars['search_array']['status_typeaccesskey'] == 1): ?> selected="selected"<?php endif; ?> >仅本机构使用</option>
                            <option value="2"  <?php if ($this->_tpl_vars['search_array']['status_typeaccesskey'] == 2): ?> selected="selected"<?php endif; ?> >开放所有机构使用</option>
				</select>
                &nbsp;创建人：&nbsp;
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
				&nbsp;<input type="submit" value="搜索" />
				</form>
				</td>
			</tr>
</table>		
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
    	<th>
        	&nbsp;
        </th>
		<th>
        	处方标题
        </th>
        <th>
        	更新时间
        </th>
		<th>
        	查看次数
        </th>
		<th>
        	处方权限
        </th>
		<th>
        	创建人
        </th>
		<th>
        	操作选项
        </th>
	</tr>
	</thead>
	<tbody id="he">
	<?php unset($this->_sections['he']);
$this->_sections['he']['name'] = 'he';
$this->_sections['he']['loop'] = is_array($_loop=$this->_tpl_vars['he']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['he']['show'] = true;
$this->_sections['he']['max'] = $this->_sections['he']['loop'];
$this->_sections['he']['step'] = 1;
$this->_sections['he']['start'] = $this->_sections['he']['step'] > 0 ? 0 : $this->_sections['he']['loop']-1;
if ($this->_sections['he']['show']) {
    $this->_sections['he']['total'] = $this->_sections['he']['loop'];
    if ($this->_sections['he']['total'] == 0)
        $this->_sections['he']['show'] = false;
} else
    $this->_sections['he']['total'] = 0;
if ($this->_sections['he']['show']):

            for ($this->_sections['he']['index'] = $this->_sections['he']['start'], $this->_sections['he']['iteration'] = 1;
                 $this->_sections['he']['iteration'] <= $this->_sections['he']['total'];
                 $this->_sections['he']['index'] += $this->_sections['he']['step'], $this->_sections['he']['iteration']++):
$this->_sections['he']['rownum'] = $this->_sections['he']['iteration'];
$this->_sections['he']['index_prev'] = $this->_sections['he']['index'] - $this->_sections['he']['step'];
$this->_sections['he']['index_next'] = $this->_sections['he']['index'] + $this->_sections['he']['step'];
$this->_sections['he']['first']      = ($this->_sections['he']['iteration'] == 1);
$this->_sections['he']['last']       = ($this->_sections['he']['iteration'] == $this->_sections['he']['total']);
?>
	 <tr id="he_<?php echo $this->_tpl_vars['he'][$this->_sections['he']['index']]['js_uuid']; ?>
">
	 	<td>
        	&nbsp;
        </td>
		<td>
        	<?php echo $this->_tpl_vars['he'][$this->_sections['he']['index']]['title']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['he'][$this->_sections['he']['index']]['edit_time']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['he'][$this->_sections['he']['index']]['views']; ?>

        </td>
		<td>
 			<?php echo $this->_tpl_vars['he'][$this->_sections['he']['index']]['status_type']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['he'][$this->_sections['he']['index']]['doctor_id']; ?>

        </td>
		<td>
       		 <a href="<?php echo $this->_tpl_vars['basePath']; ?>
he/prescription/edit/uuid/<?php echo $this->_tpl_vars['he'][$this->_sections['he']['index']]['uuid']; ?>
" />编辑</a>&nbsp;|&nbsp;<a href="###" onclick="return del('<?php echo $this->_tpl_vars['he'][$this->_sections['he']['index']]['uuid']; ?>
','<?php echo $this->_tpl_vars['he'][$this->_sections['he']['index']]['js_uuid']; ?>
')">删除</a>
		</td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="7">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="7">
        	&nbsp;<?php echo $this->_tpl_vars['pager']; ?>

        </td>
	</tr>
	</tbody>
</table>
</body>
</html>
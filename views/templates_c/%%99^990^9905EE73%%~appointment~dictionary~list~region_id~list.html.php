<?php /* Smarty version 2.6.14, created on 2013-05-02 11:16:25
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/site.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<link rel="stylesheet" type="text/css"  href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/default/datepicker.css"/>

<title><?php echo $this->_tpl_vars['title']; ?>
</title>

</head>
<body>

	<table cellspacing="0" width="100%">
    <thead>
    <tr >
	<th  colspan="4" align="left">当前机构:<font color="Red"><?php echo $this->_tpl_vars['org_name']; ?>
</font>&nbsp;&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['go_back'] == ""): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
organization/listorg/listorg/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
">返回</a><?php endif; ?></th>
	</tr>
	</thead>
    <tr  class="headbg">
	<th style="width:40%" colspan="4">坐诊字典</th>
	</tr>
    <?php if ($this->_tpl_vars['record_count'] != 0): ?>
	<tr class="columnbg">
	<th style="width:25%">国家标准代码</th><th style="width:25%">角色</th><th style="width:25%">登录名</th><th style="width:25%">操作</th>
	</tr>	
	<tbody id=''>
      <?php unset($this->_sections['k']);
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['row']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
      <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
			<td ><?php echo $this->_tpl_vars['row'][$this->_sections['k']['index']]['standard_code']; ?>
</td>
            <td ><?php echo $this->_tpl_vars['row'][$this->_sections['k']['index']]['role_name']; ?>
</td>
			<td ><?php echo $this->_tpl_vars['row'][$this->_sections['k']['index']]['name_login']; ?>
</td>	
			<td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/dictionary/add/org_id/<?php echo $this->_tpl_vars['org_id']; ?>
/org_name/<?php echo $this->_tpl_vars['url_org_name']; ?>
/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/uuid/<?php echo $this->_tpl_vars['row'][$this->_sections['k']['index']]['id']; ?>
/user_id/<?php echo $this->_tpl_vars['row'][$this->_sections['k']['index']]['id']; ?>
/region_path/<?php echo $this->_tpl_vars['region_path']; ?>
/action/add/">[添加/修改坐诊字典]</a></td>
		</tr>
	    <?php endfor; endif; ?>	
	</tbody>
	
    <?php endif; ?>
    <tr  class="columnbg">
		<td style="width:40%" colspan="5"><div style=" float:left"></div><div style="float:right"><?php echo $this->_tpl_vars['out']; ?>
</div></td>
	</tr>
	</table>

		<br />
	</body>
</html>
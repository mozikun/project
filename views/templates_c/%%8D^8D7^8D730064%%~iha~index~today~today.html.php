<?php /* Smarty version 2.6.14, created on 2013-09-02 09:52:13
         compiled from today.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>个人健康档案今日统计</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<style>
	table
	{
		background:#ffffff;
	}
</style>
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
</head>
<body>
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
        <th colspan="6">
        	健康档案<?php echo $this->_tpl_vars['today']; ?>
统计报表
        </th>
	</tr>
	</thead>
	<tbody id="iha">
		<tr>
		<td rowspan="<?php echo $this->_tpl_vars['sex_count']; ?>
" style="width:120px;">建档人数(人)</td><td rowspan="<?php echo $this->_tpl_vars['sex_count']; ?>
"><?php echo $this->_tpl_vars['total']; ?>
</td>
		<?php $_from = $this->_tpl_vars['sexa']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sexx'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sexx']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['sex']):
        $this->_foreach['sexx']['iteration']++;
?>
		<td style="width:120px;"><?php echo $this->_tpl_vars['sex'][1]; ?>
</td><td colspan="3">
			<?php echo $this->_tpl_vars['sexd'][$this->_tpl_vars['key']]['nums']; ?>

			</td>
		<?php if ($this->_foreach['sexx']['iteration'] == $this->_tpl_vars['sex_count']): ?>
		</tr>
		<?php else: ?>
		</tr><tr>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</tr>
		<tr>
		<td rowspan="<?php echo $this->_tpl_vars['his_count']+3; ?>
">既往史(人)</td><td rowspan="<?php echo $this->_tpl_vars['his_count']+3; ?>
"><?php echo $this->_tpl_vars['history_total']; ?>
</td>
		<td rowspan="<?php echo $this->_tpl_vars['his_count']; ?>
">疾病史(人)</td><td rowspan="<?php echo $this->_tpl_vars['his_count']; ?>
"><?php echo $this->_tpl_vars['clinical_history_count']; ?>
</td>
		<?php $_from = $this->_tpl_vars['disease_history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['disease'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['disease']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['disease']):
        $this->_foreach['disease']['iteration']++;
?>
		<td style="width:120px;"><?php echo $this->_tpl_vars['disease'][1]; ?>
</td><td><?php if ($this->_tpl_vars['disease'][1] == '无'):  echo $this->_tpl_vars['no_history'];  else:  echo $this->_tpl_vars['clinical_history'][$this->_tpl_vars['key']];  endif; ?></td>
		<?php if ($this->_foreach['disease']['iteration'] == $this->_tpl_vars['his_count']): ?>
		</tr>
		<?php else: ?>
		</tr><tr>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</tr>
		<tr>
		<td>手术史(人)</td><td colspan="3"><?php echo $this->_tpl_vars['surgical_history_count']; ?>
</td>
		</tr>
		<tr>
		<td>输血史(人)</td><td colspan="3"><?php echo $this->_tpl_vars['transfusion_count']; ?>
</td>
		</tr>
		<tr>
		<td>外伤史(人)</td><td colspan="3"><?php echo $this->_tpl_vars['trauma_count']; ?>
</td>
		</tr>
		<tr>
		<td>遗传病史(人)</td><td colspan="5"><?php echo $this->_tpl_vars['genetic_count']; ?>
</td>
		</tr>
		<tr>
		<td>残疾人数(人)</td><td colspan="5"><?php echo $this->_tpl_vars['deformity_count']; ?>
</td>
		</tr>
	</tbody>
</table>
<div class="STYLE1" style="background:#FFFFFF; text-align:center; width:100%;font-size: 16px;">
   <input type="button" name="print" id="print" value="打印" class="inputbutton" onclick="javascript:window.print();" />
</div>
</body>
</html>
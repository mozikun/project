<?php /* Smarty version 2.6.14, created on 2013-08-20 14:02:04
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
</style>
<title>数据类型列表</title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" media="all" type="text/css" rel="stylesheet"/>
</head>
<body>
     <table border="1px" align="center" width="100%">
     <tr class="headbg">
       <td colspan="3"><strong>数据类型列表</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="" value="生成所有数据" style="line-height:20px;" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
dictionary/dictionary/createall'"/></td>
     </tr>
     <tr>
       <td colspan="3">
          <form action="" method="post">
                                  数组名称：<input name="arrname" type="text" size="45"/>
                                  中文含义: <input name="zhname"  type="text" size="30"/>
                      <input type="submit" name="ok" value="搜索" />
          </form>
       </td>
     </tr>
     <tr class="headbg">
        <td width="40%"><strong>数组名称</strong></td>
        <td width="40%"><strong>中文含义</strong></td>
        <td width="20%"><strong>编辑</strong></td>
     </tr>
      <?php if ($this->_tpl_vars['nuNumber'] == '0'): ?>
      <tr align="center"><td colspan="3">当前没有任何数据!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
dictionary/dictionary/index">[点击返回]</a></td></tr>
      <?php else: ?>
     <?php unset($this->_sections['dicArr']);
$this->_sections['dicArr']['loop'] = is_array($_loop=$this->_tpl_vars['dicArr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['dicArr']['name'] = 'dicArr';
$this->_sections['dicArr']['show'] = true;
$this->_sections['dicArr']['max'] = $this->_sections['dicArr']['loop'];
$this->_sections['dicArr']['step'] = 1;
$this->_sections['dicArr']['start'] = $this->_sections['dicArr']['step'] > 0 ? 0 : $this->_sections['dicArr']['loop']-1;
if ($this->_sections['dicArr']['show']) {
    $this->_sections['dicArr']['total'] = $this->_sections['dicArr']['loop'];
    if ($this->_sections['dicArr']['total'] == 0)
        $this->_sections['dicArr']['show'] = false;
} else
    $this->_sections['dicArr']['total'] = 0;
if ($this->_sections['dicArr']['show']):

            for ($this->_sections['dicArr']['index'] = $this->_sections['dicArr']['start'], $this->_sections['dicArr']['iteration'] = 1;
                 $this->_sections['dicArr']['iteration'] <= $this->_sections['dicArr']['total'];
                 $this->_sections['dicArr']['index'] += $this->_sections['dicArr']['step'], $this->_sections['dicArr']['iteration']++):
$this->_sections['dicArr']['rownum'] = $this->_sections['dicArr']['iteration'];
$this->_sections['dicArr']['index_prev'] = $this->_sections['dicArr']['index'] - $this->_sections['dicArr']['step'];
$this->_sections['dicArr']['index_next'] = $this->_sections['dicArr']['index'] + $this->_sections['dicArr']['step'];
$this->_sections['dicArr']['first']      = ($this->_sections['dicArr']['iteration'] == 1);
$this->_sections['dicArr']['last']       = ($this->_sections['dicArr']['iteration'] == $this->_sections['dicArr']['total']);
?>
        <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
           <td width="40%"><?php echo $this->_tpl_vars['dicArr'][$this->_sections['dicArr']['index']]['category']; ?>
</td>
           <td width="40%"><?php echo $this->_tpl_vars['dicArr'][$this->_sections['dicArr']['index']]['category_name']; ?>
</td>
           <td width="20%"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
dictionary/dictionary/add/arrname/<?php echo $this->_tpl_vars['dicArr'][$this->_sections['dicArr']['index']]['category']; ?>
/statusnow/<?php echo $this->_tpl_vars['dicArr'][$this->_sections['dicArr']['index']]['status']; ?>
/zhname/<?php echo $this->_tpl_vars['dicArr'][$this->_sections['dicArr']['index']]['scode_name']; ?>
">[编辑]</a>
            </td>
        </tr>
     <?php endfor; endif; ?>
     <?php endif; ?>
     <tr>
       <td colspan="3"><a id="btn" href="<?php echo $this->_tpl_vars['basePath']; ?>
dictionary/dictionary/add"><strong>[添加数据类型]</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['page']; ?>
</td>
     </tr>
     </table>
</body>
</html>
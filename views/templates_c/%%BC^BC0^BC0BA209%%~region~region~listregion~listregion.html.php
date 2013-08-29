<?php /* Smarty version 2.6.14, created on 2013-08-29 15:16:06
         compiled from listregion.html */ ?>
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
     <table border="1px" align="center">
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
region/region/listregion/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
"><?php if ($this->_tpl_vars['add_need_id'] == $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']): ?><font color="Red"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a></font><?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
region/region/listregion/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a><?php endif; ?>&nbsp;&nbsp;->&nbsp;&nbsp;<?php endfor; endif; ?></td>
     </tr>
     <tr class="bigfont">
        <td><strong>ID</strong></td>
        <td width="20%"><strong>地区名称</strong></td>
<!--        <td width="10%"><strong>地区路径</strong></td>
-->
        <td width="10%"><strong>标准代码</strong></td>
        <td width="20%"><strong>进入下级地区</strong></td>
        <td width="<?php echo $this->_tpl_vars['firstcu']; ?>
"><strong>编辑</strong></td>
        <td width="<?php echo $this->_tpl_vars['secondcu']; ?>
"><strong>删除</strong></td>
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
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['zh_name']; ?>
</td>
<!--           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['region_path']; ?>
</td>
-->           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['standard_code']; ?>
</td>
           <td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
region/region/listregion/parent_id/<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
">[进入子地区]</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="##" onclick="mymeregedit('<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
');">[合并地区]</a></td>
           <td>
           <?php if ($this->_tpl_vars['row'][$this->_sections['row']['index']]['region_core_edit'] == 1): ?>
           <a id="btn_<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
" href="##" onclick="myOpenWindow('<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
')">[地区核心信息]</a>&nbsp;&nbsp;&nbsp;&nbsp;
           <?php endif; ?>
           <a href="<?php echo $this->_tpl_vars['basePath']; ?>
region/regionext/index/nowid/<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
/pagecurrent/<?php echo $this->_tpl_vars['nowpage']; ?>
"><?php echo $this->_tpl_vars['str']; ?>
</a>
           </td>
           <td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
region/region/delregion/current_id/<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
" onclick="return confirm('您确定删除吗?确定');">[删除地区]</a></td>
        </tr>
     <?php endfor; endif; ?>
     <tr>
       <td colspan="6"><a id="btn1" href="javascript:"><strong>[添加地区]</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['page']; ?>
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
function mymeregedit(id){
	var url="<?php echo $this->_tpl_vars['basePath']; ?>
region/region/meregedit/id/"+id+'/sid/'+Math.random();
	window.showModalDialog(url,window,'DialogTop:250px;DialogLeft:250px;DialogWidth:650px;DialogHeight:250px;help:no;status:no');
	location.reload();
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

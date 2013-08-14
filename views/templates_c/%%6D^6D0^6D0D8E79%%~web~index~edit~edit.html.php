<?php /* Smarty version 2.6.14, created on 2013-05-02 10:23:41
         compiled from edit.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>添加/编辑文章</title>
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
<table border="0" width="100%" class="line_table">
	<form method="post" action="<?php echo $this->_tpl_vars['basePath']; ?>
web/index/editin" onsubmit="editor.sync()">
	<tr class="headbg">
		<td colspan="2">
        	文章<?php if (! $this->_tpl_vars['article']->uuid): ?>添加<?php else: ?>编辑<?php endif; ?>
        </td>
	</tr>
			    <tr>
			        <td>标题:&nbsp;</td>
                    <td>
						<input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['article']->uuid; ?>
" />
						<input type="text" name="title" value="<?php echo $this->_tpl_vars['article']->title; ?>
" size="45" />
			        </td>
                </tr>
                <tr>
                    <td>栏目:&nbsp;</td>
                    <td>
                          <select name="sort">
                          <option value="">请选择</option>
                          <?php unset($this->_sections['sorts']);
$this->_sections['sorts']['name'] = 'sorts';
$this->_sections['sorts']['loop'] = is_array($_loop=$this->_tpl_vars['sorts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sorts']['show'] = true;
$this->_sections['sorts']['max'] = $this->_sections['sorts']['loop'];
$this->_sections['sorts']['step'] = 1;
$this->_sections['sorts']['start'] = $this->_sections['sorts']['step'] > 0 ? 0 : $this->_sections['sorts']['loop']-1;
if ($this->_sections['sorts']['show']) {
    $this->_sections['sorts']['total'] = $this->_sections['sorts']['loop'];
    if ($this->_sections['sorts']['total'] == 0)
        $this->_sections['sorts']['show'] = false;
} else
    $this->_sections['sorts']['total'] = 0;
if ($this->_sections['sorts']['show']):

            for ($this->_sections['sorts']['index'] = $this->_sections['sorts']['start'], $this->_sections['sorts']['iteration'] = 1;
                 $this->_sections['sorts']['iteration'] <= $this->_sections['sorts']['total'];
                 $this->_sections['sorts']['index'] += $this->_sections['sorts']['step'], $this->_sections['sorts']['iteration']++):
$this->_sections['sorts']['rownum'] = $this->_sections['sorts']['iteration'];
$this->_sections['sorts']['index_prev'] = $this->_sections['sorts']['index'] - $this->_sections['sorts']['step'];
$this->_sections['sorts']['index_next'] = $this->_sections['sorts']['index'] + $this->_sections['sorts']['step'];
$this->_sections['sorts']['first']      = ($this->_sections['sorts']['iteration'] == 1);
$this->_sections['sorts']['last']       = ($this->_sections['sorts']['iteration'] == $this->_sections['sorts']['total']);
?>
                          <option value="<?php echo $this->_tpl_vars['sorts'][$this->_sections['sorts']['index']]['uuid']; ?>
" <?php if ($this->_tpl_vars['article']->sort_id == $this->_tpl_vars['sorts'][$this->_sections['sorts']['index']]['uuid']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['sorts'][$this->_sections['sorts']['index']]['sortname']; ?>
</option>
                          <?php endfor; endif; ?>
                          </select>
			        </td>			
				</tr>
                <tr>
                    <td>内容:&nbsp;</td>
                    <td>
                          <textarea name="content" cols="60" rows="8"><?php echo $this->_tpl_vars['article_content']->content; ?>
</textarea>
			        </td>			
				</tr>
                <tr>
                    <td>介绍:&nbsp;</td>
                    <td>
						<textarea name="info" rows="6" cols="60"><?php echo $this->_tpl_vars['article']->info; ?>
</textarea>
			        </td>
                </tr>
				<tr>
                    <td>来源:&nbsp;</td>
                    <td>
                          <input type="text" name="source" value="<?php echo $this->_tpl_vars['article']->source; ?>
" size="45" />
			        </td>			
				</tr>
	<tr>
		<td style="text-align:center;" colspan="2">
        	<input type="submit" value="保存内容" class="input" style="height: 28px;font-size:14px;"  />
	</tr>
	</form>
</table>
</body>
</html>
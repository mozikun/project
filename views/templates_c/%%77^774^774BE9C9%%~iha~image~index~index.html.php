<?php /* Smarty version 2.6.14, created on 2013-07-23 11:04:59
         compiled from index.html */ ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="yaachis" />
    <link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css" />
    <link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
    <script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/kandytabs.pack.js"></script>
    <script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/popup.js" type="text/javascript"></script> 
    <link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/kandytabs.css" />
	<title>区域卫生信息公众平台-【雅安】-[<?php echo $this->_tpl_vars['core']->name; ?>
]个人信息预览</title>
    <style type="text/css">
    body,div,table{
        margin: 0;
        padding:0;
    }
    #header{
    	margin:0px;
    	background-image:url('<?php echo $this->_tpl_vars['basePath']; ?>
views/images/ips.gif');
        background-repeat: no-repeat;
        height: 67px;
    }
    table
	{
		background:#ffffff;
	}
    #right
    {
        overflow:hidden;
        float: right; /*浮动居右*/
        clear: right; /*不允许右侧存在浮动*/

    }
    #content
    {
        width: 100%;
    }
    input.line{border:0px;border-bottom: 1px solid #ccc;}
    .red,.red a{color: red;}
    </style>
<script>
function show_image(obj)
{
    if($("#image_dd").html())
    {
        //加载
        $("#image_dd").html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/load.gif' />");
        $.get('<?php echo $this->_tpl_vars['basePath']; ?>
iha/image/index/card/<?php echo $this->_tpl_vars['card']; ?>
',function(data){
            $("#image_dd").html(data);
        });
    }
    else
    {
        
    }
}
</script>
</head>

<body>
  <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;clear: left;">
    <tr class="headbg">
    <td colspan="10"><b>影像记录</b></td>
    </tr>
    <tr class="columnbg"><td>姓名</td><td>性别</td><td>申请单号</td><td>检查科室</td><td>检查医生</td><td>报告人</td><td>检查名称</td><td>检查部位</td><td>检查时间</td><td>选项</td></tr>
    <?php unset($this->_sections['yx']);
$this->_sections['yx']['loop'] = is_array($_loop=$this->_tpl_vars['imgs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['yx']['name'] = 'yx';
$this->_sections['yx']['show'] = true;
$this->_sections['yx']['max'] = $this->_sections['yx']['loop'];
$this->_sections['yx']['step'] = 1;
$this->_sections['yx']['start'] = $this->_sections['yx']['step'] > 0 ? 0 : $this->_sections['yx']['loop']-1;
if ($this->_sections['yx']['show']) {
    $this->_sections['yx']['total'] = $this->_sections['yx']['loop'];
    if ($this->_sections['yx']['total'] == 0)
        $this->_sections['yx']['show'] = false;
} else
    $this->_sections['yx']['total'] = 0;
if ($this->_sections['yx']['show']):

            for ($this->_sections['yx']['index'] = $this->_sections['yx']['start'], $this->_sections['yx']['iteration'] = 1;
                 $this->_sections['yx']['iteration'] <= $this->_sections['yx']['total'];
                 $this->_sections['yx']['index'] += $this->_sections['yx']['step'], $this->_sections['yx']['iteration']++):
$this->_sections['yx']['rownum'] = $this->_sections['yx']['iteration'];
$this->_sections['yx']['index_prev'] = $this->_sections['yx']['index'] - $this->_sections['yx']['step'];
$this->_sections['yx']['index_next'] = $this->_sections['yx']['index'] + $this->_sections['yx']['step'];
$this->_sections['yx']['first']      = ($this->_sections['yx']['iteration'] == 1);
$this->_sections['yx']['last']       = ($this->_sections['yx']['iteration'] == $this->_sections['yx']['total']);
?>
    <tr><td><?php echo $this->_tpl_vars['imgs'][$this->_sections['yx']['index']]['xm']; ?>
</td><td><?php echo $this->_tpl_vars['imgs'][$this->_sections['yx']['index']]['xb']; ?>
</td><td><?php echo $this->_tpl_vars['imgs'][$this->_sections['yx']['index']]['sqdh']; ?>
</td><td><?php echo $this->_tpl_vars['imgs'][$this->_sections['yx']['index']]['jcksmc']; ?>
</td><td><?php echo $this->_tpl_vars['imgs'][$this->_sections['yx']['index']]['jcys']; ?>
</td><td><?php echo $this->_tpl_vars['imgs'][$this->_sections['yx']['index']]['bgrxm']; ?>
</td><td><?php echo $this->_tpl_vars['imgs'][$this->_sections['yx']['index']]['jcmc']; ?>
</td><td><?php echo $this->_tpl_vars['imgs'][$this->_sections['yx']['index']]['jcbw']; ?>
</td><td><?php echo $this->_tpl_vars['imgs'][$this->_sections['yx']['index']]['jysj']; ?>
</td><td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/image/view/uid/<?php echo $this->_tpl_vars['imgs'][$this->_sections['yx']['index']]['uid']; ?>
" target="_blank">查看详细</a></td></tr>
    <?php endfor; else: ?>
    <tr><td colspan="10">近期没有影像记录</td></tr>
    <?php endif; ?>
  </table>
</body>
</html>
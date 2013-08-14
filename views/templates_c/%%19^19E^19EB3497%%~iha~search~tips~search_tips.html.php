<?php /* Smarty version 2.6.14, created on 2013-07-23 11:04:25
         compiled from search_tips.html */ ?>
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
    .red{color: red;}
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
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;float: left;margin: 0;">
    <tr class="headbg">
    <td colspan="2"><b>近期提醒</b></td>
    </tr>
    <tr class="columnbg"><td>日期</td><td>事件</td></tr>
    <?php unset($this->_sections['tips']);
$this->_sections['tips']['name'] = 'tips';
$this->_sections['tips']['loop'] = is_array($_loop=$this->_tpl_vars['tips_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tips']['show'] = true;
$this->_sections['tips']['max'] = $this->_sections['tips']['loop'];
$this->_sections['tips']['step'] = 1;
$this->_sections['tips']['start'] = $this->_sections['tips']['step'] > 0 ? 0 : $this->_sections['tips']['loop']-1;
if ($this->_sections['tips']['show']) {
    $this->_sections['tips']['total'] = $this->_sections['tips']['loop'];
    if ($this->_sections['tips']['total'] == 0)
        $this->_sections['tips']['show'] = false;
} else
    $this->_sections['tips']['total'] = 0;
if ($this->_sections['tips']['show']):

            for ($this->_sections['tips']['index'] = $this->_sections['tips']['start'], $this->_sections['tips']['iteration'] = 1;
                 $this->_sections['tips']['iteration'] <= $this->_sections['tips']['total'];
                 $this->_sections['tips']['index'] += $this->_sections['tips']['step'], $this->_sections['tips']['iteration']++):
$this->_sections['tips']['rownum'] = $this->_sections['tips']['iteration'];
$this->_sections['tips']['index_prev'] = $this->_sections['tips']['index'] - $this->_sections['tips']['step'];
$this->_sections['tips']['index_next'] = $this->_sections['tips']['index'] + $this->_sections['tips']['step'];
$this->_sections['tips']['first']      = ($this->_sections['tips']['iteration'] == 1);
$this->_sections['tips']['last']       = ($this->_sections['tips']['iteration'] == $this->_sections['tips']['total']);
?>
    <tr><td><?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['tips_time']; ?>
</td><td><?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['tips_type']; ?>
</td></tr>
    <?php endfor; else: ?>
    <tr><td colspan="2">近期还没有提醒记录</td></tr>
    <?php endif; ?>
</table>
</body>
</html>
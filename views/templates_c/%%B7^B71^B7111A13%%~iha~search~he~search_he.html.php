<?php /* Smarty version 2.6.14, created on 2013-07-23 11:04:29
         compiled from search_he.html */ ?>
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
  <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tr class="headbg">
    <td colspan="5"><b>健康教育</b></td>
    </tr>
    <tr class="columnbg"><td>时间</td><td>地点</td><td>教育形式</td><td>发放资料</td><td>医生</td></tr>
    <?php unset($this->_sections['health']);
$this->_sections['health']['name'] = 'health';
$this->_sections['health']['loop'] = is_array($_loop=$this->_tpl_vars['health']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['health']['show'] = true;
$this->_sections['health']['max'] = $this->_sections['health']['loop'];
$this->_sections['health']['step'] = 1;
$this->_sections['health']['start'] = $this->_sections['health']['step'] > 0 ? 0 : $this->_sections['health']['loop']-1;
if ($this->_sections['health']['show']) {
    $this->_sections['health']['total'] = $this->_sections['health']['loop'];
    if ($this->_sections['health']['total'] == 0)
        $this->_sections['health']['show'] = false;
} else
    $this->_sections['health']['total'] = 0;
if ($this->_sections['health']['show']):

            for ($this->_sections['health']['index'] = $this->_sections['health']['start'], $this->_sections['health']['iteration'] = 1;
                 $this->_sections['health']['iteration'] <= $this->_sections['health']['total'];
                 $this->_sections['health']['index'] += $this->_sections['health']['step'], $this->_sections['health']['iteration']++):
$this->_sections['health']['rownum'] = $this->_sections['health']['iteration'];
$this->_sections['health']['index_prev'] = $this->_sections['health']['index'] - $this->_sections['health']['step'];
$this->_sections['health']['index_next'] = $this->_sections['health']['index'] + $this->_sections['health']['step'];
$this->_sections['health']['first']      = ($this->_sections['health']['iteration'] == 1);
$this->_sections['health']['last']       = ($this->_sections['health']['iteration'] == $this->_sections['health']['total']);
?>
    <tr><td><?php echo $this->_tpl_vars['health'][$this->_sections['health']['index']]['time']; ?>
</td><td><?php echo $this->_tpl_vars['health'][$this->_sections['health']['index']]['address']; ?>
</td><td><?php echo $this->_tpl_vars['health'][$this->_sections['health']['index']]['xingshi']; ?>
</td><td><?php echo $this->_tpl_vars['health'][$this->_sections['health']['index']]['ziliao']; ?>
</td><td><?php echo $this->_tpl_vars['health'][$this->_sections['health']['index']]['doctor']; ?>
</td></tr>
    <?php endfor; else: ?>
    <tr><td colspan="5">您没有健康教育记录</td></tr>
    <?php endif; ?>
  </table>
</body>
</html>
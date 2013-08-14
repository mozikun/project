<?php /* Smarty version 2.6.14, created on 2013-07-23 11:04:06
         compiled from search_family.html */ ?>
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
    <td colspan="4"><b>家庭成员</b></td>
    </tr>
    <tr class="columnbg">
    <td>姓名</td><td>关系</td><td>联系电话</td><td>住址</td>
    </tr>
    <?php unset($this->_sections['family']);
$this->_sections['family']['name'] = 'family';
$this->_sections['family']['loop'] = is_array($_loop=$this->_tpl_vars['family']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['family']['show'] = true;
$this->_sections['family']['max'] = $this->_sections['family']['loop'];
$this->_sections['family']['step'] = 1;
$this->_sections['family']['start'] = $this->_sections['family']['step'] > 0 ? 0 : $this->_sections['family']['loop']-1;
if ($this->_sections['family']['show']) {
    $this->_sections['family']['total'] = $this->_sections['family']['loop'];
    if ($this->_sections['family']['total'] == 0)
        $this->_sections['family']['show'] = false;
} else
    $this->_sections['family']['total'] = 0;
if ($this->_sections['family']['show']):

            for ($this->_sections['family']['index'] = $this->_sections['family']['start'], $this->_sections['family']['iteration'] = 1;
                 $this->_sections['family']['iteration'] <= $this->_sections['family']['total'];
                 $this->_sections['family']['index'] += $this->_sections['family']['step'], $this->_sections['family']['iteration']++):
$this->_sections['family']['rownum'] = $this->_sections['family']['iteration'];
$this->_sections['family']['index_prev'] = $this->_sections['family']['index'] - $this->_sections['family']['step'];
$this->_sections['family']['index_next'] = $this->_sections['family']['index'] + $this->_sections['family']['step'];
$this->_sections['family']['first']      = ($this->_sections['family']['iteration'] == 1);
$this->_sections['family']['last']       = ($this->_sections['family']['iteration'] == $this->_sections['family']['total']);
?>
    <tr><td><?php echo $this->_tpl_vars['family'][$this->_sections['family']['index']]['name']; ?>
</td><td><?php echo $this->_tpl_vars['family'][$this->_sections['family']['index']]['realation']; ?>
</td><td><?php echo $this->_tpl_vars['family'][$this->_sections['family']['index']]['phone_number']; ?>
</td><td><?php echo $this->_tpl_vars['family'][$this->_sections['family']['index']]['address']; ?>
</td></tr>
    <?php endfor; else: ?>
    <tr><td colspan="4">您没有家庭成员记录</td></tr>
    <?php endif; ?>
</table>
</body>
</html>
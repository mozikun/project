<?php /* Smarty version 2.6.14, created on 2013-07-23 11:04:26
         compiled from search_tige.html */ ?>
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
    <td colspan="5"><b><b>体格检查</b></b></td>
    </tr>
    <tr class="columnbg">
    <td>身高(cm)</td><td>体重(kg)</td><td>收缩压(mmHg)</td><td>舒张压(mmHg)</td><td>空腹血糖(mmol/L)</td>
    </tr>
    <?php unset($this->_sections['physical']);
$this->_sections['physical']['name'] = 'physical';
$this->_sections['physical']['loop'] = is_array($_loop=$this->_tpl_vars['physical']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['physical']['show'] = true;
$this->_sections['physical']['max'] = $this->_sections['physical']['loop'];
$this->_sections['physical']['step'] = 1;
$this->_sections['physical']['start'] = $this->_sections['physical']['step'] > 0 ? 0 : $this->_sections['physical']['loop']-1;
if ($this->_sections['physical']['show']) {
    $this->_sections['physical']['total'] = $this->_sections['physical']['loop'];
    if ($this->_sections['physical']['total'] == 0)
        $this->_sections['physical']['show'] = false;
} else
    $this->_sections['physical']['total'] = 0;
if ($this->_sections['physical']['show']):

            for ($this->_sections['physical']['index'] = $this->_sections['physical']['start'], $this->_sections['physical']['iteration'] = 1;
                 $this->_sections['physical']['iteration'] <= $this->_sections['physical']['total'];
                 $this->_sections['physical']['index'] += $this->_sections['physical']['step'], $this->_sections['physical']['iteration']++):
$this->_sections['physical']['rownum'] = $this->_sections['physical']['iteration'];
$this->_sections['physical']['index_prev'] = $this->_sections['physical']['index'] - $this->_sections['physical']['step'];
$this->_sections['physical']['index_next'] = $this->_sections['physical']['index'] + $this->_sections['physical']['step'];
$this->_sections['physical']['first']      = ($this->_sections['physical']['iteration'] == 1);
$this->_sections['physical']['last']       = ($this->_sections['physical']['iteration'] == $this->_sections['physical']['total']);
?>
    <tr><td><?php echo $this->_tpl_vars['physical'][$this->_sections['physical']['index']]['height']; ?>
</td><td><?php echo $this->_tpl_vars['physical'][$this->_sections['physical']['index']]['weight']; ?>
</td><td><?php echo $this->_tpl_vars['physical'][$this->_sections['physical']['index']]['s_blood_pressure']; ?>
</td><td><?php echo $this->_tpl_vars['physical'][$this->_sections['physical']['index']]['p_blood_pressure']; ?>
</td><td><?php echo $this->_tpl_vars['physical'][$this->_sections['physical']['index']]['blood_sugar']; ?>
</td></tr>
    <?php endfor; else: ?>
    <tr><td colspan="5">近期还没有体格检查记录</td></tr>
    <?php endif; ?>
    <tr><td colspan="5"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/tijian" id="tige_img" /></td></tr>
</table>
</body>
</html>
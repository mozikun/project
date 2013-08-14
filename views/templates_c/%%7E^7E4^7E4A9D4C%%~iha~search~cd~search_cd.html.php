<?php /* Smarty version 2.6.14, created on 2013-07-23 11:03:52
         compiled from search_cd.html */ ?>
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
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;clear: left;">
    <tr class="headbg">
    <td colspan="8"><b>慢病及随访情况</b></td>
    </tr>
    <tr class="columnbg">
    <td>慢病管理类型</td><td>总随访次数</td><td>最后随访时间</td><td>最后随访结局</td><td>下次随访日期</td><td>&nbsp;</td>
    </tr>
    <tr><td>高血压</td><td><?php echo $this->_tpl_vars['hy_count']; ?>
</td><td><?php echo $this->_tpl_vars['hy']->follow_time; ?>
</td><td><?php echo $this->_tpl_vars['hy']->follow_result; ?>
</td><td><?php echo $this->_tpl_vars['hy']->follow_next_time; ?>
</td><td><?php if ($this->_tpl_vars['hy']->id): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/list/id/<?php echo $this->_tpl_vars['hy']->id; ?>
">进入查看</a><?php endif; ?></td>
    </tr>
    <tr><td>糖尿病</td><td><?php echo $this->_tpl_vars['di_count']; ?>
</td><td><?php echo $this->_tpl_vars['di']->followup_time; ?>
</td><td><?php echo $this->_tpl_vars['di']->followup_result; ?>
</td><td><?php echo $this->_tpl_vars['di']->time_of_next_followup; ?>
</td><td><?php if ($this->_tpl_vars['di']->id): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/index/id/<?php echo $this->_tpl_vars['di']->id; ?>
">进入查看</a><?php endif; ?></td>
    </tr>
    <tr><td>重性精神分裂</td><td><?php echo $this->_tpl_vars['sc_count']; ?>
</td><td><?php echo $this->_tpl_vars['sc']->fllowup_time; ?>
</td><td><?php echo $this->_tpl_vars['sc']->followup_content; ?>
</td><td><?php echo $this->_tpl_vars['sc']->next_followup_time; ?>
</td><td><?php if ($this->_tpl_vars['sc']->id): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/schizophrenia/list/id/<?php echo $this->_tpl_vars['sc']->id; ?>
">进入查看</a><?php endif; ?></td>
    </tr>
</table>
</body>
</html>
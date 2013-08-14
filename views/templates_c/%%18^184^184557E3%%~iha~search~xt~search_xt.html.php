<?php /* Smarty version 2.6.14, created on 2013-07-23 11:04:22
         compiled from search_xt.html */ ?>
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
function xt_post()
{
    if(confirm('确定要添加今日空腹血糖监测记录吗?'))
    {
        $.ajax({
			type:"post",
			url:"<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/xtin",
			dataType:"html",
			data:$("#xt").serialize(),
            beforeSend:function(){
                $("#button").val('添加中');
                $("#button").attr('disabled',true);
            },
			success:function(data)
			{
			     $("#button").val('添加空腹血糖监测记录');
                 $("#button").attr('disabled',false);
			     if(data=='ok')
                 {
                    alert("空腹血糖信息已成功保存");
                    $("input[type='text']").val('');
                 }
				//重载图片
                $("#xt_img").attr('src','<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/xtpic/uuid/<?php echo $this->_tpl_vars['uuid']; ?>
/'+Math.random());
			}
        });
    }	
}
</script>
</head>

<body>
<form id="xt">
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;clear: left;">
    <tr class="headbg">
    <td><b>空腹血糖变化图</b></td>
    </tr>
    <tr><td><img src="<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/xtpic/uuid/<?php echo $this->_tpl_vars['uuid']; ?>
" id="xt_img" /></td></tr>
    <tr><td style="line-height: 36px;height: 36px;">今日空腹血糖：<input type="text" name="xt" value="" />mmol/L&nbsp;<input type="button" id="button" name="button" value="添加空腹血糖监测记录" onclick="xt_post()" /></td></tr>
</table>
</form>
</body>
</html>
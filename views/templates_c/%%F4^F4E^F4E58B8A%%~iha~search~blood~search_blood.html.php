<?php /* Smarty version 2.6.14, created on 2013-07-23 11:04:20
         compiled from search_blood.html */ ?>
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
    .green{color: green;}
    label{
        font-weight: bold;
    }
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
function blood_post()
{
    if(confirm('确定要添加今日血压监测记录吗?'))
    {
        $.ajax({
			type:"post",
			url:"<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/bloodin",
			dataType:"html",
			data:$("#blood").serialize(),
            beforeSend:function(){
                $("#button").val('添加中');
                $("#button").attr('disabled',true);
            },
			success:function(data)
			{
			     $("#button").val('添加血压监测记录');
                 $("#button").attr('disabled',false);
			     if(data=='ok')
                 {
                    alert("血压信息已成功保存");
                    $("input[type='text']").val('');
                    $("#chk").remove();
                    $("label").remove();
                    $("span").html('');
                 }
				//重载图片
                $("#blood_img").attr('src','<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/showpic/uuid/<?php echo $this->_tpl_vars['uuid']; ?>
/'+Math.random());
			}
        });
    }	
}
function chk_blood()
{
    var s_blood=$("input[name='s_blood']").val();
    var s_blood=parseInt(s_blood);
    var p_blood=$("input[name='p_blood']").val();
    var p_blood=parseInt(p_blood);
    if(s_blood<120 && p_blood<80)
    {
        //正常
        $("span").removeClass('red');
        $("span").addClass('green');
        $("#chk").remove();
        $("label").remove();
        $("span").html('你的血压正常');
    }
    if((s_blood>=120 && s_blood<=139) || (p_blood>=80 && p_blood<=89))
    {
        //正常高值
        $("span").removeClass('red');
        $("span").addClass('green');
        $("#chk").remove();
        $("label").remove();
        $("span").html('你的血压是正常高值，建议坚持测试血压');
    }
    if(s_blood>=140 || p_blood>=90)
    {
        //高血压
        if((s_blood>=140 && s_blood<=159) || (p_blood>=90 && p_blood<=99))
        {
            //I级高血压
            $("span").removeClass('green');
            $("span").addClass('red');
            $("#chk").remove();
            $("label").remove();
            $("#button").before("<input type='checkbox' name='chk' id='chk' value='1' checked='checked' /><label for='chk'>发送短信至责任医生</label>");
            $("span").html('你的血压有I级高血压特征，请及时到医院进行规范的血压测量，并询问责任医生');
            $("#msg").val('血压有I级高血压特征');
        }
        if((s_blood>=160 && s_blood<=179) || (p_blood>=100 && p_blood<=109))
        {
            //II级高血压
            $("span").removeClass('green');
            $("span").addClass('red');
            $("#chk").remove();
            $("label").remove();
            $("#button").before("<input type='checkbox' name='chk' id='chk' value='1' checked='checked' /><label for='chk'>发送短信至责任医生</label>");
            $("span").html('你的血压有II级高血压特征，请及时到医院进行规范的血压测量，并询问责任医生');
            $("#msg").val('血压有II级高血压特征');
        }
        if((s_blood>=180) || (p_blood>=110))
        {
            //III级高血压
            $("span").removeClass('green');
            $("span").addClass('red');
            $("#chk").remove();
            $("label").remove();
            $("#button").before("<input type='checkbox' name='chk' id='chk' value='1' checked='checked' /><label for='chk'>发送短信至责任医生</label>");
            $("span").html('你的血压有III级高血压特征，请及时到医院进行规范的血压测量，并询问责任医生');
            $("#msg").val('血压有III级高血压特征');
        }
        if((s_blood>=140) && (p_blood<90))
        {
            //单纯收缩期高血压
            $("span").removeClass('green');
            $("span").addClass('red');
            $("#chk").remove();
            $("label").remove();
            $("#button").before("<input type='checkbox' name='chk' id='chk' value='1' checked='checked' /><label for='chk'>发送短信至责任医生</label>");
            $("span").html('你的血压有高血压特征，请及时到医院进行规范的血压测量，并询问责任医生');
            $("#msg").val('血压有高血压特征');
        }
    }
}
</script>
</head>

<body>
<form id="blood">
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;clear: left;">
    <tr class="headbg">
    <td><b>血压变化图</b></td>
    </tr>
    <tr><td><img src="<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/showpic/uuid/<?php echo $this->_tpl_vars['uuid']; ?>
" id="blood_img" /></td></tr>
    <tr><td style="line-height: 36px;height: 36px;">今日收缩压：<input type="text" name="s_blood" value="" onblur="chk_blood()" />mmHg&nbsp;今日舒张压：<input type="text" name="p_blood" value="" onblur="chk_blood()" />mmHg&nbsp;<input type="button" id="button" name="button" value="添加血压监测记录" onclick="blood_post()" /><br /><span class="red"></span><input type="hidden" name="msg" id="msg" /></td></tr>
</table>
</form>
</body>
</html>
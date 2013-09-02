<?php /* Smarty version 2.6.14, created on 2013-08-30 14:59:40
         compiled from search_base.html */ ?>
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
$(document).ready(function(){
   function get_card_status()
   {
       $("#jz_zt").html('');
       $.get('<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/getcardstatus/identity_number/<?php echo $this->_tpl_vars['identity_number']; ?>
',function(data){
             $("#jz_zt").html(data);
       });
       setTimeout(get_card_status,5000);
   }
   get_card_status();
});
</script>
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tr class="headbg">
    <td colspan="4"><b>基本信息</b></td>
    </tr>
    <tr><td style="width: 180px;"><img <?php if ($this->_tpl_vars['headpic']): ?>src="<?php echo $this->_tpl_vars['headpic']; ?>
"<?php else: ?>src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/nopic.gif"<?php endif; ?> id="headpic" style="width:95px;height: 128px;margin: 8px auto;" /></td><td style="font-size: 24px;font-weight: bold;" colspan="3"><?php echo $this->_tpl_vars['core']->name; ?>
</td></tr>
    <tr><td>性别</td><td><?php echo $this->_tpl_vars['core']->sex; ?>
</td><td>年龄</td><td><?php echo $this->_tpl_vars['core']->age; ?>
</td></tr>
    <tr><td>电话</td><td><?php echo $this->_tpl_vars['core']->phone_number; ?>
</td><td>生日</td><td><?php echo $this->_tpl_vars['core']->date_of_birth; ?>
</td></tr>
    <tr><td>血型</td><td><?php echo $this->_tpl_vars['blood']->abo_bloodtype; ?>
</td><td>住址</td><td><?php echo $this->_tpl_vars['core']->address; ?>
</td></tr>
    <tr><td>建档日期</td><td colspan="3"><?php echo $this->_tpl_vars['core']->filing_time; ?>
</td></tr>
    <tr><td>健康卡</td><td colspan="3"><?php echo $this->_tpl_vars['core']->card; ?>
</td></tr>
    </table>
    <br />
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tr class="headbg">
    <td colspan="3"><b>管理医生</b></td>
    </tr>
    <tr class="columnbg">
    <td>姓名</td><td>机构</td><td>联系电话</td>
    </tr>
    <?php if ($this->_tpl_vars['staff_array']['name']): ?>
    <td><?php echo $this->_tpl_vars['staff_array']['name']; ?>
</td><td><?php echo $this->_tpl_vars['staff_array']['org']; ?>
</td><td><?php echo $this->_tpl_vars['staff_array']['phone']; ?>
</td>
    <?php endif; ?>
    </table>
    <br />
    <div id="jz_zt">   
    </div>
    <br />
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tr class="headbg">
    <td><b>信息提醒</b></td>
    </tr>
    <?php $_from = $this->_tpl_vars['tips_code']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
    <?php if ($this->_tpl_vars['v'] == 2): ?><tr><td>您是<span class="red">高血压</span>患者，您需要定期随访(<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/cd">我的随访情况</a>)，并监测血压，了解近期血压变化趋势...</td></tr><?php endif; ?>
    <?php if ($this->_tpl_vars['v'] == 3): ?><tr><td>您是<span class="red">糖尿病</span>患者，您需要定期随访(<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/cd">我的随访情况</a>)，并监测空腹血糖，了解近期空腹血糖变化趋势...</td></tr><?php endif; ?>
    <?php if ($this->_tpl_vars['v'] == 8): ?><tr><td>您是<span class="red">重性精神分裂</span>患者，您需要定期随访，并进行相关治疗...</td></tr><?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if ($this->_tpl_vars['tips_count']): ?><tr><td>您当前共有<span class="red"><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/tips"><?php echo $this->_tpl_vars['tips_count']; ?>
</a></span>个待完成事项。</td></tr><?php endif; ?>
    </table>
</body>
</html>
<?php /* Smarty version 2.6.14, created on 2013-08-28 11:29:28
         compiled from data_index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tree.css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/highcharts/highcharts.js"></script>
<style>
li{
    list-style: none;
}
td{
    height: 30px;
}
#left{
    width: 70%;
    height: 100%;
    margin-right: 10px;
    padding: 2px;
    float: left;
}
#right{
    width: 25%;
    height: 100%;
    padding: 2px;
    float: left;
}
.title_tjb
{
    background: no-repeat 2px 50%;
    background-image: url('<?php echo $this->_tpl_vars['basePath']; ?>
images/tjz.png');
    font-size:14px;
    font-weight:bold;
    padding-left:36px;
    color: #60ad45;
}
.title_tjz
{
    background: no-repeat 2px 50%;
    background-image: url('<?php echo $this->_tpl_vars['basePath']; ?>
images/tjb.png');
    font-size:14px;
    font-weight:bold;
    padding-left:36px;
    color: #60ad45;
}
#mytable {
 width: 100%;
 padding: 0;
 margin: 0;
}
#mytable th {
 font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
 color: #4f6b72;
 border-right: 1px solid #C1DAD7;
 border-bottom: 1px solid #C1DAD7;
 border-top: 1px solid #C1DAD7;
 letter-spacing: 2px;
 text-transform: uppercase;
 text-align: left;
 padding: 6px 6px 6px 12px;
 background: #CAE8EA no-repeat;
}
#mytable th.nobg {
 border-top: 0;
 border-left: 0;
 border-right: 1px solid #C1DAD7;
 background: none;
}
#mytable td {
 border-right: 1px solid #C1DAD7;
 border-bottom: 1px solid #C1DAD7;
 background: #fff;
 font-size:11px;
 padding: 2px 2px 2px 8px;
 color: #4f6b72;
}

#mytable td.alt {
 background: #F5FAFA;
 color: #797268;
}
#mytable th.spec {
 border-left: 1px solid #C1DAD7;
 border-top: 0;
 background: #fff no-repeat;
 font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
}
#mytable th.specalt {
 border-left: 1px solid #C1DAD7;
 border-top: 0;
 background: #f5fafa no-repeat;
 font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
 color: #797268;
}
.overtime{
    background: no-repeat 2px 50%;
    background-image: url('<?php echo $this->_tpl_vars['basePath']; ?>
images/check.png');
    padding-left:28px;
}
.plantime{
    background: no-repeat 2px 50%;
    background-image: url('<?php echo $this->_tpl_vars['basePath']; ?>
images/process.png');
    padding-left:28px;
}
</style>
<script>
$(document).ready(function(){
   $("#data_logs").html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/loading_small.gif' />");
   $("#data_logs").load("<?php echo $this->_tpl_vars['basePath']; ?>
decision/data/data");
   $("#data_logs_img").html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/loading_small.gif' />");
   $("#data_logs_img").load("<?php echo $this->_tpl_vars['basePath']; ?>
decision/data/data/ac/pic");
   $("#org_logs").html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/loading_small.gif' />");
   $("#org_logs").load("<?php echo $this->_tpl_vars['basePath']; ?>
decision/data/org");
   $("#org_logs_img").html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/loading_small.gif' />");
   $("#org_logs_img").load("<?php echo $this->_tpl_vars['basePath']; ?>
decision/data/org/ac/pic");
   //计划任务
   $("#data_plan").html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/loading_small.gif' />");
   $("#data_plan").load("<?php echo $this->_tpl_vars['basePath']; ?>
decision/data/bak");
   //平台档案
   $("#data_archive").html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/loading_small.gif' />");
   $("#data_archive").load("<?php echo $this->_tpl_vars['basePath']; ?>
decision/data/archive");
   //慢病档案
   $("#data_clinical").html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/loading_small.gif' />");
   $("#data_clinical").load("<?php echo $this->_tpl_vars['basePath']; ?>
decision/data/clinical");
   //就诊信息
   $("#data_status").html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/loading_small.gif' />");
   $("#data_status").load("<?php echo $this->_tpl_vars['basePath']; ?>
decision/data/status");
});
function show_next_region(rid)
{
    $("#org_logs").html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/loading_small.gif' />");
    $("#org_logs").load("<?php echo $this->_tpl_vars['basePath']; ?>
decision/data/org/region/"+rid);
    $("#org_logs_img").html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/loading_small.gif' />");
    $("#org_logs_img").load("<?php echo $this->_tpl_vars['basePath']; ?>
decision/data/org/ac/pic/region/"+rid);
}
</script>
</head>
<body>
<div id="content">
    <div id="left">
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;">
        <tr class="headbg">
        <td colspan="2" class="title_tjb" style="padding-left: 36px;">数据交换信息</td></tr>
        <tr style="background: #fff;"><td style="width: 60%;vertical-align: top;" id="data_logs_img">
        </td><td style="padding: 4px 8px 0px 0px;vertical-align: top;" id="data_logs"></td></tr>
        <tr><td colspan="2" style="text-align: right;padding-right: 8px;"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/logs/index/type/day">>>更多数据交换信息</a></td></tr>
        </table>
        <br />
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;">
        <tr class="headbg">
        <td colspan="2" class="title_tjz" style="padding-left: 36px;cursor: pointer;" onclick="show_next_region('')">机构资源信息</td></tr>
        <tr style="background: #fff;"><td style="width: 60%;vertical-align: top;" id="org_logs_img"></td><td style="padding: 4px 8px 0px 0px;vertical-align: top;" id="org_logs">
        </td></tr>
        <tr><td colspan="2" style="text-align: right;padding-right: 8px;"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/orgbase/index">>>更多机构信息</a></td></tr>
        </tr>
        </table>
    </div>
    
    <div id="right">
    <span id="data_archive"></span>
    <br />
    <span id="data_status"></span>
    <br />
    <span id="data_clinical"></span>
    <br />
    <span id="data_plan"></span>
    </div>
</div>
</body>
</html>
<?php /* Smarty version 2.6.14, created on 2013-08-19 17:04:44
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
views/js/jquery-1.4.2.js"></script>
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
</style>
</head>
<body>
<div id="content">
    <div id="left">
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;">
        <tr class="headbg">
        <td colspan="2" class="title_tjb" style="padding-left: 36px;">数据交换信息</td></tr>
        <tr style="background: #fff;"><td style="width: 60%;"></td><td style="padding: 4px 8px 0px 0px;">
                    <table id="mytable" cellspacing="0">
                      <tr>
                        <th scope="col">地区</th>
                        <th scope="col">行政机构</th>
                        <th scope="col">执法机构</th>
                        <th scope="col">医院</th>
                        <th scope="col">社区</th>
                        <th scope="col">卫生院</th>
                      </tr>
                      <tr>
                        <th scope="row" class="spec">名山</th>
                        <td>4</td>
                        <td>1</td>
                        <td>3</td>
                        <td>0</td>
                        <td>20</td>
                      </tr>
                      <tr>
                        <th scope="row" class="specalt">汉源</th>
                        <td class="alt">4</td>
                        <td class="alt">1</td>
                        <td class="alt">4</td>
                        <td class="alt">0</td>
                        <td class="alt">40</td>
                      </tr>
                      <tr>
                        <th scope="row" class="specalt">石棉</th>
                        <td class="alt">4</td>
                        <td class="alt">1</td>
                        <td class="alt">3</td>
                        <td class="alt">0</td>
                        <td class="alt">25</td>
                      </tr>
                      <tr>
                        <th scope="row" class="spec">雨城</th>
                        <td>3</td>
                        <td>2</td>
                        <td>3</td>
                        <td>3</td>
                        <td>32</td>
                      </tr>
                      <tr>
                        <th scope="row" class="specalt">荥经</th>
                        <td class="alt">4</td>
                        <td class="alt">2</td>
                        <td class="alt">3</td>
                        <td class="alt">0</td>
                        <td class="alt">38</td>
                      </tr>
                      <tr>
                        <th scope="row" class="spec">天全</th>
                        <td>3</td>
                        <td>1</td>
                        <td>4</td>
                        <td>0</td>
                        <td>29</td>
                      </tr>
                      <tr>
                        <th scope="row" class="specalt">总计</th>
                        <td class="alt total">29</td>
                        <td class="alt total">10</td>
                        <td class="alt total">28</td>
                        <td class="alt total">3</td>
                        <td class="alt total">157</td>
                      </tr>
                    </table>
</td></tr>
        <tr><td colspan="2" style="text-align: right;padding-right: 8px;">更多数据交换信息</td></tr>
        </table>
        <br />
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;">
        <tr class="headbg">
        <td colspan="2" class="title_tjz" style="padding-left: 36px;">机构资源信息</td></tr>
        <tr style="background: #fff;"><td style="width: 60%;"></td><td style="padding: 4px 8px 0px 0px;">
                    <table id="mytable" cellspacing="0">
                      <tr>
                        <th scope="col">地区</th>
                        <th scope="col">行政机构</th>
                        <th scope="col">执法机构</th>
                        <th scope="col">医院</th>
                        <th scope="col">社区</th>
                        <th scope="col">卫生院</th>
                      </tr>
                      <tr>
                        <th scope="row" class="spec">名山</th>
                        <td>4</td>
                        <td>1</td>
                        <td>3</td>
                        <td>0</td>
                        <td>20</td>
                      </tr>
                      <tr>
                        <th scope="row" class="specalt">汉源</th>
                        <td class="alt">4</td>
                        <td class="alt">1</td>
                        <td class="alt">4</td>
                        <td class="alt">0</td>
                        <td class="alt">40</td>
                      </tr>
                      <tr>
                        <th scope="row" class="specalt">石棉</th>
                        <td class="alt">4</td>
                        <td class="alt">1</td>
                        <td class="alt">3</td>
                        <td class="alt">0</td>
                        <td class="alt">25</td>
                      </tr>
                      <tr>
                        <th scope="row" class="spec">雨城</th>
                        <td>3</td>
                        <td>2</td>
                        <td>3</td>
                        <td>3</td>
                        <td>32</td>
                      </tr>
                      <tr>
                        <th scope="row" class="specalt">荥经</th>
                        <td class="alt">4</td>
                        <td class="alt">2</td>
                        <td class="alt">3</td>
                        <td class="alt">0</td>
                        <td class="alt">38</td>
                      </tr>
                      <tr>
                        <th scope="row" class="spec">天全</th>
                        <td>3</td>
                        <td>1</td>
                        <td>4</td>
                        <td>0</td>
                        <td>29</td>
                      </tr>
                      <tr>
                        <th scope="row" class="specalt">总计</th>
                        <td class="alt total">29</td>
                        <td class="alt total">10</td>
                        <td class="alt total">28</td>
                        <td class="alt total">3</td>
                        <td class="alt total">157</td>
                      </tr>
                    </table>
</td></tr>
        <tr><td colspan="2" style="text-align: right;padding-right: 8px;">更多机构信息</td></tr>
        </tr>
        </table>
    </div>
    
    <div id="right">
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;">
        <tr class="headbg">
        <td colspan="2" class="title_tjb" style="padding-left: 36px;background: no-repeat 2px 50%;
    background-image: url('<?php echo $this->_tpl_vars['basePath']; ?>
images/library.png');">机构建档信息</td>
        </tr>
        <tr><td style="width: 88px;">高血压</td><td>2343</td></tr>
        <tr><td>II型糖尿病</td><td>5323</td></tr>
        <tr><td>重型精神分裂</td><td>23</td></tr>
    </table>
    <br />
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;">
        <tr class="headbg">
        <td colspan="2" class="title_tjb" style="padding-left: 36px;background: no-repeat 2px 50%;
    background-image: url('<?php echo $this->_tpl_vars['basePath']; ?>
images/hire-me.png');">患者就诊信息</td>
        </tr>
        <tr><td style="width: 88px;">高血压</td><td>2343</td></tr>
        <tr><td>II型糖尿病</td><td>5323</td></tr>
        <tr><td>重型精神分裂</td><td>23</td></tr>
    </table>
    <br />
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;">
        <tr class="headbg">
        <td colspan="2" class="title_tjb" style="padding-left: 36px;background: no-repeat 2px 50%;
    background-image: url('<?php echo $this->_tpl_vars['basePath']; ?>
images/suppliers.png');color: #ff6e00;">健康档案信息</td>
        </tr>
        <tr><td style="width: 88px;">高血压</td><td>2343</td></tr>
        <tr><td>II型糖尿病</td><td>5323</td></tr>
        <tr><td>重型精神分裂</td><td>23</td></tr>
    </table>
    <br />
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;">
        <tr class="headbg">
        <td colspan="2" class="title_tjb" style="padding-left: 36px;background: no-repeat 2px 50%;
    background-image: url('<?php echo $this->_tpl_vars['basePath']; ?>
images/heart.png');color: #ff6e00;">慢病信息</td>
        </tr>
        <tr><td style="width: 88px;">高血压</td><td>2343</td></tr>
        <tr><td>II型糖尿病</td><td>5323</td></tr>
        <tr><td>重型精神分裂</td><td>23</td></tr>
    </table>
    <br />
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;">
        <tr class="headbg">
        <td class="title_tjb" style="padding-left: 36px;background: no-repeat 2px 50%;
    background-image: url('<?php echo $this->_tpl_vars['basePath']; ?>
images/future-projects.png');color: #ff6e00;">平台计划任务</td>
        </tr>
        <tr><td>2013-08-15 12:00:00 数据备份</td></tr>
        <tr><td>2013-08-16 12:00:00 数据备份</td></tr>
        <tr><td>2013-08-17 12:00:00 数据备份</td></tr>
        <tr><td>2013-08-18 12:00:00 数据备份</td></tr>
        <tr><td>2013-08-19 12:00:00 数据备份</td></tr>
        <tr><td>2013-08-20 12:00:00 数据备份</td></tr>
    </table>
    </div>
</div>
</body>
</html>
<?php /* Smarty version 2.6.14, created on 2013-06-18 09:53:27
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" />
<title><?php echo $this->_tpl_vars['time']; ?>
统计信息</title>
<style>
/* CSS Document */
body {
 font: normal 11px auto "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
 color: #4f6b72;
 background: #E6EAE9;
 text-align: center;
}
a {
 color: #c75f3e;
}
#mytable {
 width: 100%;
 padding: 0;
 margin: 0;
}
th {
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
th.nobg {
 border-top: 0;
 border-left: 0;
 border-right: 1px solid #C1DAD7;
 background: none;
}
td {
 border-right: 1px solid #C1DAD7;
 border-bottom: 1px solid #C1DAD7;
 background: #fff;
 font-size:11px;
 padding: 6px 6px 6px 12px;
 color: #4f6b72;
}

td.alt {
 background: #F5FAFA;
 color: #797268;
}
th.spec {
 border-left: 1px solid #C1DAD7;
 border-top: 0;
 background: #fff no-repeat;
 font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
}
th.specalt {
 border-left: 1px solid #C1DAD7;
 border-top: 0;
 background: #f5fafa no-repeat;
 font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
 color: #797268;
}
.total{font-weight: bold;}
h1{
    border-bottom: 1px solid #ccc;
    font-size: 14px;
}
img{cursor: pointer;}
/*---------for IE 5.x bug*/
html>body td{ font-size:11px;}</style>
</head>
<body>
<h1>卫生机构资源&nbsp;<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/chart_line.png" style="height: 14px;width: 14px;" /></h1>
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
    <th scope="row" class="specalt">芦山</th>
    <td class="alt">4</td>
    <td class="alt">1</td>
    <td class="alt">3</td>
    <td class="alt">0</td>
    <td class="alt">20</td>
  </tr>
  <tr>
    <th scope="row" class="spec">宝兴</th>
    <td>3</td>
    <td>1</td>
    <td>3</td>
    <td>0</td>
    <td>28</td>
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

<h1>卫生人力资源&nbsp;<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/chart_line.png" style="height: 14px;width: 14px;" /></h1>
<table id="mytable" cellspacing="0">
  <tr>
    <th scope="col">地区</th>
    <th scope="col">执业医师</th>
    <th scope="col">注册护士</th>
    <th scope="col">药师</th>
    <th scope="col">技师</th>
  </tr>
  <tr>
    <th scope="row" class="spec">名山</th>
    <td>289</td>
    <td>216</td>
    <td>0</td>
    <td>0</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">汉源</th>
    <td class="alt">312</td>
    <td class="alt">324</td>
    <td class="alt">0</td>
    <td class="alt">0</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">石棉</th>
    <td class="alt">302</td>
    <td class="alt">250</td>
    <td class="alt">0</td>
    <td class="alt">0</td>
  </tr>
  <tr>
    <th scope="row" class="spec">雨城</th>
    <td>314</td>
    <td>246</td>
    <td>0</td>
    <td>0</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">荥经</th>
    <td class="alt">306</td>
    <td class="alt">233</td>
    <td class="alt">0</td>
    <td class="alt">0</td>
  </tr>
  <tr>
    <th scope="row" class="spec">天全</th>
    <td>320</td>
    <td>234</td>
    <td>0</td>
    <td>0</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">芦山</th>
    <td class="alt">314</td>
    <td class="alt">237</td>
    <td class="alt">0</td>
    <td class="alt">0</td>
  </tr>
  <tr>
    <th scope="row" class="spec">宝兴</th>
    <td>268</td>
    <td>256</td>
    <td>0</td>
    <td>0</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">总计</th>
    <td class="alt total">2425</td>
    <td class="alt total">1971</td>
    <td class="alt total">0</td>
    <td class="alt total">0</td>
  </tr>
</table>
<h1>设备资源&nbsp;<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/chart_line.png" style="height: 14px;width: 14px;" /></h1>
<table id="mytable" cellspacing="0">
  <tr>
    <th scope="col">地区</th>
    <th scope="col">万元以上设备</th>
  </tr>
  <tr>
    <th scope="row" class="spec">名山</th>
    <td>49</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">汉源</th>
    <td class="alt">23</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">石棉</th>
    <td class="alt">20</td>
  </tr>
  <tr>
    <th scope="row" class="spec">雨城</th>
    <td>15</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">荥经</th>
    <td class="alt">3</td>
  </tr>
  <tr>
    <th scope="row" class="spec">天全</th>
    <td>0</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">芦山</th>
    <td class="alt">6</td>
  </tr>
  <tr>
    <th scope="row" class="spec">宝兴</th>
    <td>0</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">总计</th>
    <td class="alt total">116</td>
  </tr>
</table>
<h1>房屋资源&nbsp;<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/chart_line.png" style="height: 14px;width: 14px;" /></h1>
<table id="mytable" cellspacing="0">
  <tr>
    <th scope="col">地区</th>
    <th scope="col">业务用房面积</th>
  </tr>
  <tr>
    <th scope="row" class="spec">名山</th>
    <td>11356</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">汉源</th>
    <td class="alt">3818</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">石棉</th>
    <td class="alt">8995</td>
  </tr>
  <tr>
    <th scope="row" class="spec">雨城</th>
    <td>2807</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">荥经</th>
    <td class="alt">1279</td>
  </tr>
  <tr>
    <th scope="row" class="spec">天全</th>
    <td>0</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">芦山</th>
    <td class="alt">1850</td>
  </tr>
  <tr>
    <th scope="row" class="spec">宝兴</th>
    <td>0</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">总计</th>
    <td class="alt total">30105</td>
  </tr>
</table>
<h1>高血压统计表&nbsp;<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/chart_line.png" style="height: 14px;width: 14px;" /></h1>
<table id="mytable" cellspacing="0">
  <tr>
    <th scope="col">地区</th>
    <th scope="col">管理人数</th>
    <th scope="col">规范管理率(%)</th>
  </tr>
  <tr>
    <th scope="row" class="spec">名山</th>
    <td>2864</td>
    <td>59</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">汉源</th>
    <td class="alt">5294</td>
    <td>64</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">石棉</th>
    <td class="alt">3495</td>
    <td>9</td>
  </tr>
  <tr>
    <th scope="row" class="spec">雨城</th>
    <td>5936</td>
    <td>59</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">荥经</th>
    <td class="alt">3256</td>
    <td>12</td>
  </tr>
  <tr>
    <th scope="row" class="spec">天全</th>
    <td>3100</td>
    <td>64</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">芦山</th>
    <td class="alt">1957</td>
    <td>62</td>
  </tr>
  <tr>
    <th scope="row" class="spec">宝兴</th>
    <td>1513</td>
    <td>25</td>
  </tr>
  <tr>
    <th scope="row" class="specalt">总计</th>
    <td class="alt total">27415</td>
    <td>47</td>
  </tr>
</table>
<h1>加载更多&nbsp;<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/menu_add.gif" style="height: 14px;width: 14px;" /></h1>
</body>
</html>
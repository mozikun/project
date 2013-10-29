<?php /* Smarty version 2.6.14, created on 2013-09-26 14:41:31
         compiled from map.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body{
	font-size:14px;
	padding:0px;
	margin-top:2px; 
	background-color:#ecf6ff
}    
body table,tr,td,th{
	height:26px;
	font-size:13px;  /*表格*/
	border-collapse:collapse;
	border:#CCCCCC 1px solid；
}
table,tr,td a{
  color: #000;
}
*{padding:0;margin:0;} 
table{ border-collapse:collapse;border:1px #525152 solid;width:100%;margin:0 auto;} 
th,td{border:1px #525152 solid;text-align:center;font-size:12px;line-height:30px;background:#fff;} /*表格内部样式*/
th{background:#D6D3D6;} /*标题背景*/ 
/*表格斜线*/ 
.out{ 
   border-top:60px #4e9ddf solid;/*上边框宽度等于表格第一行行高*/ 
   width:0px;/*让容器宽度为0*/ 
   height:0px;/*让容器高度为0*/ 
   border-left:80px #fff solid;/*左边框宽度等于表格第一行第一格宽度,姓名部分的背景颜色*/     
   position:relative;/*让里面的两个子容器绝对定位*/ 
} 
b{font-style:normal;display:block;position:absolute;top:-60px;left:-40px;width:35px;} 
em{font-style:normal;display:block;position:absolute;top:-25px;left:-70px;width:55x;} 
.t1{background:#fff;font-weight:bold;} 
 .headbg{  /*头部*/
	font-weight:bold;
	color:#FFFFFF;
	background-color:#4e9ddf;
}
.topbg{
background:#bad5f0;
font-weight:bold;
}
#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;}
#l-map{height:100%;height:450px;width:100%;float:left;border-right:2px solid #bcbcbc;}
#r-result{height:100%;width:20%;float:left;}
</style>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/SearchInfoWindow_min.css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.4/src/SearchInfoWindow_min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/TextIconOverlay/1.2/src/TextIconOverlay_min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/MarkerClusterer/1.2/src/MarkerClusterer_min.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>
<title>慢病综合统计地理密度分布</title>
</head>
<body>
<form method="post" action="<?php echo $this->_tpl_vars['basePath']; ?>
decision/clinical/map/model/<?php echo $this->_tpl_vars['model']; ?>
">
<table>
<tr>
       <td style="text-align: left;padding-left:8px" >
		开始时间：<input type="text" name="start_time" id="start_time" class="Wdate" onfocus="WdatePicker({isShowWeek:true,maxDate:'#F{$dp.$D(\'end_time\')||\'2020-10-01\'}'})" value="<?php echo $this->_tpl_vars['start_time']; ?>
" />&nbsp;&nbsp;结束时间：<input type="text" name="end_time" id="end_time" class="Wdate" onfocus="WdatePicker({isShowWeek:true,minDate:'#F{$dp.$D(\'start_time\')}'})" value="<?php echo $this->_tpl_vars['decision_time']; ?>
" />*此时间为确诊时间，未填写确诊时间的将不会在统计结果中出现</td>
     </tr>
<tr>
       <td style="text-align: left;padding-left:8px" >
		当前统计区域：<?php unset($this->_sections['rs']);
$this->_sections['rs']['loop'] = is_array($_loop=$this->_tpl_vars['rs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rs']['name'] = 'rs';
$this->_sections['rs']['show'] = true;
$this->_sections['rs']['max'] = $this->_sections['rs']['loop'];
$this->_sections['rs']['step'] = 1;
$this->_sections['rs']['start'] = $this->_sections['rs']['step'] > 0 ? 0 : $this->_sections['rs']['loop']-1;
if ($this->_sections['rs']['show']) {
    $this->_sections['rs']['total'] = $this->_sections['rs']['loop'];
    if ($this->_sections['rs']['total'] == 0)
        $this->_sections['rs']['show'] = false;
} else
    $this->_sections['rs']['total'] = 0;
if ($this->_sections['rs']['show']):

            for ($this->_sections['rs']['index'] = $this->_sections['rs']['start'], $this->_sections['rs']['iteration'] = 1;
                 $this->_sections['rs']['iteration'] <= $this->_sections['rs']['total'];
                 $this->_sections['rs']['index'] += $this->_sections['rs']['step'], $this->_sections['rs']['iteration']++):
$this->_sections['rs']['rownum'] = $this->_sections['rs']['iteration'];
$this->_sections['rs']['index_prev'] = $this->_sections['rs']['index'] - $this->_sections['rs']['step'];
$this->_sections['rs']['index_next'] = $this->_sections['rs']['index'] + $this->_sections['rs']['step'];
$this->_sections['rs']['first']      = ($this->_sections['rs']['iteration'] == 1);
$this->_sections['rs']['last']       = ($this->_sections['rs']['iteration'] == $this->_sections['rs']['total']);
?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/clinical/map/model/<?php echo $this->_tpl_vars['model']; ?>
/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
/url_start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
"><?php if ($this->_tpl_vars['add_need_id'] == $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']): ?><font color="Red"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a></font><?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/clinical/map/model/<?php echo $this->_tpl_vars['model']; ?>
/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
/url_start_time/<?php echo $this->_tpl_vars['start_time']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a><?php endif; ?>&nbsp;&nbsp;->&nbsp;&nbsp;<?php endfor; endif; ?></td>
     </tr>
  <tr><td style="text-align: left;padding-left:8px"><input type="hidden" value="<?php echo $this->_tpl_vars['p_id']; ?>
" name="parent_id" /><input type="submit" name="submit" value="统计结果"  style="width: 75px; height:28px;"/></td></tr>
</table>
</form>
<br />
<table style="width: <?php echo $this->_tpl_vars['table_width']; ?>
;"> 
<tr> 
    <th style="width:80px;" rowspan="2"> 
        <div class="out"> 
            <b>人数</b> 
            <em>地区</em> 
        </div> 
    </th> 
  <?php echo $this->_tpl_vars['table_title']; ?>

</tr>
<tr><td colspan="4"><div id="l-map"></div></td></tr>
<?php echo $this->_tpl_vars['table_body']; ?>

<tr><td colspan="4" style="text-align: left;padding-left: 4px;">说明：<img  src="<?php echo $this->_tpl_vars['basePath']; ?>
images/location.png"/>标注机构所在地理位置<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;地图统计数据为患者的坐标点数，如果患者坐标在同一点，只标注一次。
</td></tr>
</table> 
</body>
</html>
<script>
//转换过来只是JSON字符串，需要解析一次
var position_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['position']; ?>
');
var map = new BMap.Map("l-map");
var gc = new BMap.Geocoder();
var markers=[];
map.centerAndZoom("<?php echo $this->_tpl_vars['city']; ?>
",13);                   // 初始化地图,设置城市和地图级别。
map.enableScrollWheelZoom();                            //启用滚轮放大缩小
map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
for (var i = 0; i < position_array.length; i++)
{
  var point = new BMap.Point(position_array[i][0], position_array[i][1]);
  addMarker(point);
}
// 编写自定义函数,创建标注
function addMarker(point){
  var marker = new BMap.Marker(point);
  markers.push(marker);
  map.addOverlay(marker);
}
function getBoundary(){       
    var bdary = new BMap.Boundary();
    bdary.get("<?php echo $this->_tpl_vars['city']; ?>
", function(rs){       //获取行政区域
        //map.clearOverlays();        //清除地图覆盖物       
        var count = rs.boundaries.length; //行政区域的点有多少个
        for(var i = 0; i < count; i++){
            var ply = new BMap.Polygon(rs.boundaries[i], {strokeWeight: 2, strokeColor: "#ff0000"}); //建立多边形覆盖物
            map.addOverlay(ply);  //添加覆盖物
            map.setViewport(ply.getPath());    //调整视野         
        }                
    });   
}
//创建其他机构的标注
var position_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['position_org']; ?>
');
for (var i = 0; i < position_array.length; i++)
{
    addMarkerOrg(position_array[i]['x'], position_array[i]['y'],position_array[i]['name'],position_array[i]['info'],i);
}
// 编写自定义函数,创建标注
function addMarkerOrg(lat,lng,org_name,org_info,x)
{
    var si=new Array();
    si[x] = new BMapLib.SearchInfoWindow(map,org_info, {
        title  : org_name,      //标题
        width  : 290,             //宽度
        height : 105,              //高度
        panel  : "panel",         //检索结果面板
        enableAutoPan : true,     //自动平移
        searchTypes   :[]
    });
    var myIcon = new BMap.Icon("<?php echo $this->_tpl_vars['basePath']; ?>
images/location.png", new BMap.Size(32,32));
    var marker_t=new Array();
    marker_t[x] = new BMap.Marker(new BMap.Point(lat, lng),{icon:myIcon});
    marker_t[x].addEventListener("click", function(e){
	    si[x].open(marker_t[x]);
    })
    map.addOverlay(marker_t[x]); //在地图中添加marker
}
setTimeout(function(){
    getBoundary();
}, 2000);
//最简单的用法，生成一个marker数组，然后调用markerClusterer类即可。
var markerClusterer = new BMapLib.MarkerClusterer(map, {markers:markers});
</script>
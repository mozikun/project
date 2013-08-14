<?php /* Smarty version 2.6.14, created on 2013-05-06 10:32:39
         compiled from list_experience.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>健康体检列表</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basepath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basepath']; ?>
views/styles/tabs.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basepath']; ?>
views/styles/vtip.css" />
<script src="<?php echo $this->_tpl_vars['basepath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/choice.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/ajax_select_region.js"></script>
<style>
	table
	{
		background:#ffffff;
	}
.table_mouseover{
	background:#cccccc;
}
.table_mouseout{
	background:#ffffff;
}
.inputbutton{
border: 1px solid blue;
width:80px;
background:#FFFFFF;
}
#search_list
{
  margin:0 auto;
  text-align:center;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$("#search_listpic").toggle(function(){my_chioce("<?php echo $this->_tpl_vars['basePath']; ?>
","examination_table","健康体检");},function(){undo_chioce("<?php echo $this->_tpl_vars['basePath']; ?>
");});
	get_region_select_html('<?php echo $this->_tpl_vars['basePath']; ?>
','region_p_id_search','region_area')
	    $("#search_tr").click(
function(){
    if($("#body_tr").is(":hidden"))
    {
    $("#body_tr").show();
    $("#search_tr>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_out.png");
    $("#display_sign").val('block');
    }
    else
    {
    $("#body_tr").hide();
    $("#search_tr>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png");
    $("#display_sign").val('none');
    }
    }
);
    //处理搜索图标
    if($("#body_tr").is(":hidden"))
    {
        $("#search_tr>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png");
    }
    else
    {
        $("#search_tr>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_out.png");
    }
});
function ajaxsearch(gurl)
{
	$.ajax({
		type:"POST",
		url:gurl,
		dataType:"html",
		data:$("#search").serialize(),
		beforeSend:function(){$("#search_list").html("<tr><td>数据查询中，请稍候...</td></tr>")},
		success:function(data){
			//alert(data);
			//document.write(data);
			$("#search_list").html(data);
			return false;
		},
		error:function(){
			$("#search_list").html("<tr><td>数据查询失败，请刷新页面重试...</td></tr>");
			return false;
		}
	});
}
function ajaxpage(gurl)
	{
		//alert(gurl);
		//alert($("#search").serialize());
		$.ajax({
			type:"POST",
			url:gurl,
			dataType:"html",
			data:$("#search").serialize(),
			beforeSend:function(){$("#search_list").html("<tr><td colspan='11'>数据查询中，请稍候...</td></tr>")},
			success:function(data){
				//alert(gurl);
				$("#search_list").html(data);
			},
			error:function(){
				$("#search_list").html("<tr><td colspan='11'>数据查询失败，请刷新页面重试...</td></tr>")
			}
		});
	}
	function set_session(uid)
	{
		$.ajax({
			type:"get",
			url:"<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/setsession/uuid/"+uid,
			dataType:"html",
			data:"",
			success:function(data){
				//alert(data);
				if($.trim(data)=="ok")
				{
					//设置图标
					//移除已经标志为选中状态的数据
					$(".online").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/status_offline.png");
					//将选中用户置为在线状态
					//alert(uid);
					//var obj1=document.getElementById("iha_"+uid);
					//var obj2=obj1.getElementByTagname('img');
					//document.getElementById('')
					var id='img_'+uid;
					$("img[id='"+id+"']").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/status_online.png");
					//设置顶部医生提示
					id=uid+"_name";
					$(window.top.frames["right_top"].document).find('#patient').html($("td[id='"+id+"']").text());
					//alert('111111111111111111111111111111');
				}
				//return false;
			}
		});
		//return true;
	}
</script>

</head>
<body>
<div id="searchtop" style="display:none;">
<table width="100%" border="0">
  <tr>
     <td>
		<form id="search">
			   <input type="hidden" name="region_id" value="<?php echo $this->_tpl_vars['region_id']; ?>
" id="region_id" />
			   <input type="hidden" name="region_p_id" value="<?php echo $this->_tpl_vars['region_p_id']; ?>
" id="region_p_id" />
			   <input type="hidden" name="chiocetable" value="<?php echo $this->_tpl_vars['searchtable']; ?>
" id="searchtable" />
			   地区:<span id="menuDropDownBox"></span>
			    &nbsp;年龄:<input type="text" name="age_start" class="line" style="width:28px" size="6" />
				~<input type="text" name="age_end" class="line" style="width:28px" size="6" />
				&nbsp;
				性别:&nbsp;<select name="sex">
				<option value="">请选择</option>
		        <?php $_from = $this->_tpl_vars['sex']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<option value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
		        </select>
		       
		        <input type="button" value="搜索" class="inputbutton" onclick="ajaxsearch('<?php echo $this->_tpl_vars['basePath']; ?>
et/choice/index')"/>
		   </form>
	 </td>
   </tr>
</table>	
</div>
<div id="search_list">
</div>
<div class="Left_top" id="left_top"><img id="search_listpic" alt="" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/search_list.gif" /></div>
<table border="0" width="100%">
    <tr class="headbg">
      <td>
		<strong>健康体检表列表</strong>
	  </td>
	</tr>
		<form action="<?php echo $this->_tpl_vars['basepath']; ?>
et/index" id="search" method="post">
		      <tr>
		        <td>
		           姓名：<input type="text" name="realname" size="18" value="<?php echo $this->_tpl_vars['realname']; ?>
"/>&nbsp;
				   身份证：<input type="text" name="indentity_card_number" size="18" value="<?php echo $this->_tpl_vars['indentity_card_number']; ?>
"/>&nbsp;	
				   年龄：<input type="text" name="begin_age" class="line" style="width:28px" size="6" />	
				   ~<input type="text" name="end_age" class="line" style="width:28px" size="6" />&nbsp;           
		           	医生:
					<select name="doctor">
					   <option value="99">全部</option>
					<?php unset($this->_sections['staff_array']);
$this->_sections['staff_array']['loop'] = is_array($_loop=$this->_tpl_vars['staff_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['staff_array']['name'] = 'staff_array';
$this->_sections['staff_array']['show'] = true;
$this->_sections['staff_array']['max'] = $this->_sections['staff_array']['loop'];
$this->_sections['staff_array']['step'] = 1;
$this->_sections['staff_array']['start'] = $this->_sections['staff_array']['step'] > 0 ? 0 : $this->_sections['staff_array']['loop']-1;
if ($this->_sections['staff_array']['show']) {
    $this->_sections['staff_array']['total'] = $this->_sections['staff_array']['loop'];
    if ($this->_sections['staff_array']['total'] == 0)
        $this->_sections['staff_array']['show'] = false;
} else
    $this->_sections['staff_array']['total'] = 0;
if ($this->_sections['staff_array']['show']):

            for ($this->_sections['staff_array']['index'] = $this->_sections['staff_array']['start'], $this->_sections['staff_array']['iteration'] = 1;
                 $this->_sections['staff_array']['iteration'] <= $this->_sections['staff_array']['total'];
                 $this->_sections['staff_array']['index'] += $this->_sections['staff_array']['step'], $this->_sections['staff_array']['iteration']++):
$this->_sections['staff_array']['rownum'] = $this->_sections['staff_array']['iteration'];
$this->_sections['staff_array']['index_prev'] = $this->_sections['staff_array']['index'] - $this->_sections['staff_array']['step'];
$this->_sections['staff_array']['index_next'] = $this->_sections['staff_array']['index'] + $this->_sections['staff_array']['step'];
$this->_sections['staff_array']['first']      = ($this->_sections['staff_array']['iteration'] == 1);
$this->_sections['staff_array']['last']       = ($this->_sections['staff_array']['iteration'] == $this->_sections['staff_array']['total']);
?>
					   <option value="<?php echo $this->_tpl_vars['staff_array'][$this->_sections['staff_array']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['current_doctor'] == $this->_tpl_vars['staff_array'][$this->_sections['staff_array']['index']]['id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['staff_array'][$this->_sections['staff_array']['index']]['zh_name']; ?>
</option>
					<?php endfor; endif; ?>
	                </select>
		           <input type="submit" value="搜索" class="inputbutton" id="mysubmit"/>&nbsp;&nbsp;
				   <label id="search_tr" style="cursor:pointer;" ><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png" />高级搜索</label>&nbsp;&nbsp;<?php if ($this->_tpl_vars['num'] != 0): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
et/index/add/uuid/<?php echo $this->_tpl_vars['et_id']; ?>
">查看当前选中【<b><?php echo $this->_tpl_vars['et_name']; ?>
</b>】体检信息</a><?php endif; ?>
		        </td>
		      </tr>
			<tr id="body_tr" style="display:<?php echo $this->_tpl_vars['display_sign']; ?>
;"><td>
				地区：<span id="region_area"></span>&nbsp;&nbsp;&nbsp;&nbsp;
			    体检日期：<input type="text" name="start_time" size="18" onClick="WdatePicker({firstDayOfWeek:1})"  value=""  id="start_time"/>-<input type="text" name="end_time" size="18" onClick="WdatePicker({firstDayOfWeek:1})" value=""  id="end_time"/>&nbsp;
				<input type="hidden" name="display_sign" id="display_sign" value="<?php echo $this->_tpl_vars['display_sign']; ?>
" />
			    <input type="hidden" name="region_p_id_search" value="<?php echo $this->_tpl_vars['region_p_id_search']; ?>
" id="region_p_id_search" />
				</td>
			</tr>
		</form>
</table>	
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
    	<th>&nbsp;
        	
        </th>
        <th title="编号">
        	编号
        </th>
		<th title="姓名" >
        	姓名
        </th>
        <th title="身份证号" >
        	身份证号
        </th>
        <th title="家庭地址" >
        	家庭地址
        </th>
        <th title="年龄" >
        	年龄
        </th>
		<th title="体检日期">
        	体检日期
        </th>
		<th title="责任医生">
        	责任医生
        </th>
		<th>
        	操作
        </th>
	</tr>
	</thead>
	<tbody >
     <?php unset($this->_sections['experience']);
$this->_sections['experience']['loop'] = is_array($_loop=$this->_tpl_vars['experience']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['experience']['name'] = 'experience';
$this->_sections['experience']['show'] = true;
$this->_sections['experience']['max'] = $this->_sections['experience']['loop'];
$this->_sections['experience']['step'] = 1;
$this->_sections['experience']['start'] = $this->_sections['experience']['step'] > 0 ? 0 : $this->_sections['experience']['loop']-1;
if ($this->_sections['experience']['show']) {
    $this->_sections['experience']['total'] = $this->_sections['experience']['loop'];
    if ($this->_sections['experience']['total'] == 0)
        $this->_sections['experience']['show'] = false;
} else
    $this->_sections['experience']['total'] = 0;
if ($this->_sections['experience']['show']):

            for ($this->_sections['experience']['index'] = $this->_sections['experience']['start'], $this->_sections['experience']['iteration'] = 1;
                 $this->_sections['experience']['iteration'] <= $this->_sections['experience']['total'];
                 $this->_sections['experience']['index'] += $this->_sections['experience']['step'], $this->_sections['experience']['iteration']++):
$this->_sections['experience']['rownum'] = $this->_sections['experience']['iteration'];
$this->_sections['experience']['index_prev'] = $this->_sections['experience']['index'] - $this->_sections['experience']['step'];
$this->_sections['experience']['index_next'] = $this->_sections['experience']['index'] + $this->_sections['experience']['step'];
$this->_sections['experience']['first']      = ($this->_sections['experience']['iteration'] == 1);
$this->_sections['experience']['last']       = ($this->_sections['experience']['iteration'] == $this->_sections['experience']['total']);
?>
	 <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
	  <form action="<?php echo $this->_tpl_vars['basepath']; ?>
et/index/del/actionname/delall" method="post">
	 	<td>
	 		<input type="checkbox" value="<?php echo $this->_tpl_vars['experience'][$this->_sections['experience']['index']]['uuid']; ?>
" name="selectFlag[]" id="selectFlag"/>
	 	</td>
        <td>
           <?php echo $this->_tpl_vars['experience'][$this->_sections['experience']['index']]['serial_number']; ?>
 
        </td>
		<td >
        	<?php echo $this->_tpl_vars['experience'][$this->_sections['experience']['index']]['name']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['experience'][$this->_sections['experience']['index']]['identity_number']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['experience'][$this->_sections['experience']['index']]['address']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['experience'][$this->_sections['experience']['index']]['date_of_birth']; ?>
岁
        </td>
		<td>
        	<?php echo $this->_tpl_vars['experience'][$this->_sections['experience']['index']]['examination']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['experience'][$this->_sections['experience']['index']]['name_real']; ?>

        </td>
		<td >
        	<a href="<?php echo $this->_tpl_vars['basepath']; ?>
et/index/add/uuid/<?php echo $this->_tpl_vars['experience'][$this->_sections['experience']['index']]['uuid']; ?>
">[编辑]</a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo $this->_tpl_vars['basepath']; ?>
et/index/del/actionname/dellone/uuid/<?php echo $this->_tpl_vars['experience'][$this->_sections['experience']['index']]['uuid']; ?>
/realname/<?php echo $this->_tpl_vars['realnamenew']; ?>
/serialnumber/<?php echo $this->_tpl_vars['serialnumber']; ?>
/nowdate/<?php echo $this->_tpl_vars['nowdate']; ?>
/doctor/<?php echo $this->_tpl_vars['doctornew']; ?>
." onClick="return confirm('您确定删除吗?确定');">[删除]</a>
        </td>
	</tr>
	  <?php endfor; endif; ?>
	  <?php echo $this->_tpl_vars['str']; ?>

	  <tr>
	  <td colspan="9" align="center">
	   <input type="checkbox" value="" name="ifAll" id="ifAll" onClick="return checkselect();"/>全选      &nbsp;&nbsp;<?php echo $this->_tpl_vars['page']; ?>
&nbsp;&nbsp;<input type="submit" name="delAll" value="全部删除"  onClick="	if(confirm('确定要删除这些内容吗？')){return true;}else{return false;}
" />&nbsp;&nbsp;<?php if ($this->_tpl_vars['mytag'] == 1): ?><br/><span style="color: red; font-size: 28px;">请在09:00之前,16:30之后使用导出数据功能</span><?php else: ?><input type="button" value="excel数据导出"   onclick="window.location='<?php echo $this->_tpl_vars['basepath']; ?>
et/import/import/module_import_name/etimport'"/><?php endif; ?>
	</td>
	</tr>
	</form> 
	</tbody>
</table>
</body>
</html>
<script type="text/javascript">
function checkselect() {
	  for (var i = 0; i < document.getElementsByName("selectFlag[]").length; i++) {
	   document.getElementsByName("selectFlag[]")[i].checked = document.getElementById("ifAll").checked;
	  }
	 }
var region_id=document.getElementById('region_id').value;
var region_p_id=document.getElementById('region_p_id').value;
var xmlHttp;
getDropDownBox();
function getDropDownBox(){
	//alert(parentId+id);
	if(region_p_id=='-9'){
		alert('请选择一项分类');
		return;
	}
	xmlHttp=getXmlHttpObject();
	//url='/management/menu/menuDropDownBox/parentId/'+parentId+'/id/'+id+'/sid/'+Math.random();
	var url='<?php echo $this->_tpl_vars['basePath']; ?>
region/region/menuDropDownBoxIha/p_id/'+region_p_id+'/sid/'+Math.random();
	//alert(url);
	xmlHttp.onreadystatechange=processDropDownBox;
	xmlHttp.open('GET',url,true);
	xmlHttp.send(null);

}
function checkValue(){
	//alert(parentId);
	if(document.getElementById('region_p_id').value=='-9'||document.getElementById('region_p_id_search').value=='-9'){
		alert('请选择一项分类');
		return false;
	}else{
		return true;
	}
}
function processDropDownBox(){
	//alert(xmlHttp.readyState);
	if(xmlHttp.readyState==4 && xmlHttp.status==200){
		//alert(xmlHttp.readyState);
		//注：firefox不支持innerText
		var objDiv=document.getElementById('menuDropDownBox');
		//alert('1');
		//alert(xmlHttp.responseText);
		objDiv.innerHTML=xmlHttp.responseText;
		//objDiv.style.display='inline';
		//alert('yes');
	}
}
function changeValue(obj,oldValue,currentValue){
	var tempValue=currentValue.split("|")
	if(tempValue[0]=='-9'){
		//如果选择了　请选择，则把此级的父级作为当前选定的项目
		region_p_id=tempValue[1];
		document.getElementById('region_p_id').value=tempValue[1];
	}else{
		region_p_id=tempValue[0];
		document.getElementById('region_p_id').value=tempValue[0];
	}
	getDropDownBox();
}
//objDiv=$('categoryDropDownBox');
//objDiv.innerHTML="<select><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";
function getXmlHttpObject()
{
	var xmlHttp;
	try{
		xmlHttp=new ActiveXObject('MSXML2.XMLHTTP.3.0');//IE
	}catch(e){
		try{
			xmlHttp=new XMLHttpRequest();//firefox
		}catch(e){
			alert('不能正常创建xmlhttp对象');
		}
	}
	return xmlHttp;
}
</script>
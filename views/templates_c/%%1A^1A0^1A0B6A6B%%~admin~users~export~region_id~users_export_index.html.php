<?php /* Smarty version 2.6.14, created on 2013-07-26 14:45:48
         compiled from users_export_index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>个人健康档案列表</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<style>
	table
	{
		background:#ffffff;
	}
	.line
	{
		border-top:0px;
		border-left:0px;
		border-right:0px;
	}
</style>
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/search_list.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/popup.js" type="text/javascript"></script> 
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>
<script>
//导出数据导Excel
function import_excel()
{
    $("#excel").val("do");
    $("#search").submit();
    //清除掉导出状态
    $("#excel").val("");
}
</script>
</head>
<body>
	<table border="0" width="100%" id="print_hidden">
		<form action="<?php echo $this->_tpl_vars['basePath']; ?>
admin/users/export" id="search" method="POST">
			<tr><td>
				所属地区:&nbsp;<span id="menuDropDownBox"></span>	
					<input type="hidden" name="region_id" id="region_id" value="<?php echo $this->_tpl_vars['region_id']; ?>
" />
					<input type="hidden" name="region_p_id" id="region_p_id" value="<?php echo $this->_tpl_vars['region_p_id']; ?>
" />
                    
	
				<input type="hidden" name="excel" id="excel" value="" />
                <input type="hidden" name="excel_name" value="<?php echo $this->_tpl_vars['excel_name']; ?>
" />
				</td>
			</tr>
			</form>
</table>	
<table border="0" width="100%">
    <tr>
		<td colspan="8" class="endbg">
        	&nbsp;&nbsp;<?php if ($this->_tpl_vars['hours'] >= 900 && $this->_tpl_vars['hours'] <= 1630): ?><span style="color: red; font-size: 28px;">请09:00之前，16:30之后使用导出数据功能</span><?php else: ?><input type="button" name="import_excel" value="导出到Excel" onclick="import_excel()" />*导出较多数据时页面响应时间较长，请不要关闭页面。<?php endif; ?>
        </td>
	</tr>
</table>
</body>
</html>
<script type="text/javascript">
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
	if(document.getElementById('region_p_id').value=='-9'){
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
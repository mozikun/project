<?php /* Smarty version 2.6.14, created on 2013-06-25 16:57:34
         compiled from noexamine.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->_tpl_vars['module_dicreption']; ?>
</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
<script type="text/javascript">
</script>
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
</style>
</head>
<body>
<table border="0" width="100%">
    <tr class="headbg">
      <td>
		<strong><?php echo $this->_tpl_vars['module_dicreption']; ?>
</strong>
	  </td>
	</tr>
		<form action="<?php echo $this->_tpl_vars['basePath']; ?>
et/import/noexamine" id="search" method="post">
			<tr>
				<td>
				地区：<span id="menuDropDownBox"></span>	
			    <input type="hidden" name="region_id" id="region_id" value="<?php echo $this->_tpl_vars['region_id']; ?>
" />
			    <input type="hidden" name="region_p_id" id="region_p_id" value="<?php echo $this->_tpl_vars['region_p_id']; ?>
" />
			    
				 &nbsp;年龄:<input type="text" name="age_start" class="line" style="width:28px" size="6" />
				~<input type="text" name="age_end" class="line" style="width:28px" size="6" />
				&nbsp;
				时间段:<input type="text" name="created_start_time" value="<?php echo $this->_tpl_vars['created_start_time']; ?>
"  class="inputnone2" onClick="WdatePicker({firstDayOfWeek:1})" >
						  --<input type="text" name="created_end_time" value="<?php echo $this->_tpl_vars['created_end_time']; ?>
"  class="inputnone2" onClick="WdatePicker({firstDayOfWeek:1})" >
				性别:&nbsp;<select name="sex">
				<option value="">请选择</option>
                <?php $_from = $this->_tpl_vars['sex_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<option value="<?php echo $this->_tpl_vars['v'][0]; ?>
" <?php if ($this->_tpl_vars['v'][0] == $this->_tpl_vars['sex']): ?> selected='selected' <?php endif; ?>><?php echo $this->_tpl_vars['v'][1]; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
                </select>
				<input type="submit" value="搜索" class="inputbutton"/>
				</td>
			</tr>
		</form>
</table>	
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
    	<th title="姓名">
    	  姓名
        </th>
        <th title="性别">
    	  性别
        </th>
        <th title="身份证号">
        	身份证号
        </th>
        <th title="年龄">
    	  年龄
        </th>
        <th title="地址">
        	地址
        </th>
		<th title="联系电话" >
        	联系电话
        </th>
		<th title="体检医生">
        	体检医生
        </th>
	</tr>
	</thead>
	<form action="<?php echo $this->_tpl_vars['basePath']; ?>
et/import/noexamine" method="post">
	<input type="hidden" name="region_p_id" id="region_new_id" value="<?php echo $this->_tpl_vars['region_p_id']; ?>
" />
	<input type="hidden" name="sex"  value="<?php echo $this->_tpl_vars['sex']; ?>
" />
	<input type="hidden" name="age_start"  value="<?php echo $this->_tpl_vars['age_start']; ?>
" />
	<input type="hidden" name="age_end"  value="<?php echo $this->_tpl_vars['age_end']; ?>
" />
	<tbody >
     <?php unset($this->_sections['et_array']);
$this->_sections['et_array']['loop'] = is_array($_loop=$this->_tpl_vars['et_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['et_array']['name'] = 'et_array';
$this->_sections['et_array']['show'] = true;
$this->_sections['et_array']['max'] = $this->_sections['et_array']['loop'];
$this->_sections['et_array']['step'] = 1;
$this->_sections['et_array']['start'] = $this->_sections['et_array']['step'] > 0 ? 0 : $this->_sections['et_array']['loop']-1;
if ($this->_sections['et_array']['show']) {
    $this->_sections['et_array']['total'] = $this->_sections['et_array']['loop'];
    if ($this->_sections['et_array']['total'] == 0)
        $this->_sections['et_array']['show'] = false;
} else
    $this->_sections['et_array']['total'] = 0;
if ($this->_sections['et_array']['show']):

            for ($this->_sections['et_array']['index'] = $this->_sections['et_array']['start'], $this->_sections['et_array']['iteration'] = 1;
                 $this->_sections['et_array']['iteration'] <= $this->_sections['et_array']['total'];
                 $this->_sections['et_array']['index'] += $this->_sections['et_array']['step'], $this->_sections['et_array']['iteration']++):
$this->_sections['et_array']['rownum'] = $this->_sections['et_array']['iteration'];
$this->_sections['et_array']['index_prev'] = $this->_sections['et_array']['index'] - $this->_sections['et_array']['step'];
$this->_sections['et_array']['index_next'] = $this->_sections['et_array']['index'] + $this->_sections['et_array']['step'];
$this->_sections['et_array']['first']      = ($this->_sections['et_array']['iteration'] == 1);
$this->_sections['et_array']['last']       = ($this->_sections['et_array']['iteration'] == $this->_sections['et_array']['total']);
?>
	 <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
        <td>
           <?php echo $this->_tpl_vars['et_array'][$this->_sections['et_array']['index']]['name']; ?>
 
        </td>
        <td>
           <?php echo $this->_tpl_vars['et_array'][$this->_sections['et_array']['index']]['sex']; ?>
 
        </td>
        <td>
        	<?php echo $this->_tpl_vars['et_array'][$this->_sections['et_array']['index']]['identity_number']; ?>

        </td>
        <td>
           <?php echo $this->_tpl_vars['et_array'][$this->_sections['et_array']['index']]['date_of_birth']; ?>
 
        </td>
		<td >
           <?php echo $this->_tpl_vars['et_array'][$this->_sections['et_array']['index']]['address']; ?>

        </td>
		<td>
           <?php echo $this->_tpl_vars['et_array'][$this->_sections['et_array']['index']]['phone_number']; ?>

        </td>	
        <td>
        	<?php echo $this->_tpl_vars['et_array'][$this->_sections['et_array']['index']]['name_login']; ?>

        </td>
	</tr>
	<?php endfor; else: ?>
	<tr align="center">
	  <td colspan="7">没有相关数据</td>
	</tr>
	 <?php endif; ?>
	  <tr>
	  <td colspan="7" align="center">
	  <?php echo $this->_tpl_vars['page']; ?>
&nbsp;&nbsp;<?php if ($this->_tpl_vars['mytag'] == 1): ?><br/><span style="color: red; font-size: 28px;">请在09:00之前,16:30之后使用导出数据功能</span><?php else: ?><input type="submit" name="import_do" value="导出" class="inputbutton" /><?php endif; ?>
	</td>
	</tr>
	</tbody>
	</form> 
</table>
</body>
</html>
<?php echo $this->_tpl_vars['mywarning']; ?>

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
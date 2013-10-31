<?php /* Smarty version 2.6.14, created on 2013-10-29 17:14:26
         compiled from add.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>添加数据类别属性</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<style>
	table
	{
		background:#ffffff;
	}
</style>
</head>
<script language="javascript" type="text/javascript">
function createInput(parentID,currentID){  
  var parent=$(parentID);
  var div=document.createElement("div");
  var x=parseInt(Math.random()*(1000000-1))+1;
  var divName=currentID+x.toString();
  div.name=divName;
  div.id=divName;
 //创建第一个输入框
  var  aElement=document.createElement("input"); 
  aElement.name=currentID;
  aElement.id=currentID;
  aElement.type="text";
  aElement.style.width="60px";
//创建第二个输入框
  var  aElement_1=document.createElement("input"); 
  aElement_1.name=currentID;
  aElement_1.id=currentID;
  aElement_1.type="text";
  aElement_1.style.width="60px";
//创建第三个输入框
  var  aElement_2=document.createElement("input"); 
  aElement_2.name=currentID;
  aElement_2.id=currentID;
  aElement_2.type="text";
  aElement_2.style.width="100px";  
  var delBtn=document.createElement("input");
  delBtn.type="button";
  delBtn.value="删除输入框";
  delBtn.onclick=function(){ 
  removeInput(parentID,divName)};
  div.appendChild(aElement);
  div.appendChild(aElement_1);
  div.appendChild(aElement_2);
  div.appendChild(delBtn);
  parent.appendChild(div);
  var divs = document.getElementsByTagName("div");
 // window.alert(divs.length);
}
function removeInput(parentID,DelDivID){
 var parent=$(parentID);
 parent.removeChild($(DelDivID));
}
function $(v){return document.getElementById(v);}
function checksub(){
	var category = document.getElementById('category');
	var category_name = document.getElementById('category_name');
	var scode = document.getElementsByName('scode[]');
	if(category.value==""){
		window.alert("请输入类别名称！");
		category.focus();
		return false;
		}
	if(category_name.value==""){
		window.alert("请输入类别含义！");
		category_name.focus();
		return false;
		}
	//判断输入框为空否
	for(var i=0;i<scode.length;i++){
		 if(scode[i].value==""){
			 window.alert("不能为空，请重新输入！");
			 scode[i].focus();
			 return false; 
		}
		}
}
</script>
<body>
<form action="" method="post" onsubmit="return checksub();">
<table align="center" width="100%" >
  <tr class="headbg">
  <td colspan="2"><strong>添加数据类别属性</strong></td>
  </tr>
  <tr>
  <td width="30%">类别名称:</td>
  <td width="70%"><input name="category" type="text" id="category" value="<?php echo $this->_tpl_vars['editArrName']; ?>
" <?php echo $this->_tpl_vars['tagName']; ?>
/>(请使用英文)</td>
  </tr>
  <tr>
  <td width="30%">类别含义:</td>
  <td width="70%">
  <input name="category_name" type="text" id="category_name" value="<?php echo $this->_tpl_vars['zhName']; ?>
"/>
  <input name="currentname" id="currentname" type="hidden" value="<?php echo $this->_tpl_vars['arrname']; ?>
"/>
  </td>
  </tr>
  <tr>
  <td width="30%">使用状态:</td>
  <td width="70%">
  <input name="status" type="radio" id="status" value="s" <?php echo $this->_tpl_vars['statusAdd']; ?>
 <?php echo $this->_tpl_vars['statusTag']; ?>
/>启用
  <input name="status" type="radio" id="status" value="*" <?php echo $this->_tpl_vars['statusTag']; ?>
/>停用
  </td>
  </tr>
  <tr>
  <td width="30%">对应编码:</td>
  <td width="70%">
     <div align="left" id="editcode" style="display:none;width:254px;">
     <?php unset($this->_sections['editArr']);
$this->_sections['editArr']['loop'] = is_array($_loop=$this->_tpl_vars['editArr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['editArr']['name'] = 'editArr';
$this->_sections['editArr']['show'] = true;
$this->_sections['editArr']['max'] = $this->_sections['editArr']['loop'];
$this->_sections['editArr']['step'] = 1;
$this->_sections['editArr']['start'] = $this->_sections['editArr']['step'] > 0 ? 0 : $this->_sections['editArr']['loop']-1;
if ($this->_sections['editArr']['show']) {
    $this->_sections['editArr']['total'] = $this->_sections['editArr']['loop'];
    if ($this->_sections['editArr']['total'] == 0)
        $this->_sections['editArr']['show'] = false;
} else
    $this->_sections['editArr']['total'] = 0;
if ($this->_sections['editArr']['show']):

            for ($this->_sections['editArr']['index'] = $this->_sections['editArr']['start'], $this->_sections['editArr']['iteration'] = 1;
                 $this->_sections['editArr']['iteration'] <= $this->_sections['editArr']['total'];
                 $this->_sections['editArr']['index'] += $this->_sections['editArr']['step'], $this->_sections['editArr']['iteration']++):
$this->_sections['editArr']['rownum'] = $this->_sections['editArr']['iteration'];
$this->_sections['editArr']['index_prev'] = $this->_sections['editArr']['index'] - $this->_sections['editArr']['step'];
$this->_sections['editArr']['index_next'] = $this->_sections['editArr']['index'] + $this->_sections['editArr']['step'];
$this->_sections['editArr']['first']      = ($this->_sections['editArr']['iteration'] == 1);
$this->_sections['editArr']['last']       = ($this->_sections['editArr']['iteration'] == $this->_sections['editArr']['total']);
?>
      <div style="width:280px;float:left;">
      <input type="text" name="editcode[]" style="width:60px;" value="<?php echo $this->_tpl_vars['editArr'][$this->_sections['editArr']['index']]['id']; ?>
"/><input type="text" name="editcode[]" style="width:60px;" value="<?php echo $this->_tpl_vars['editArr'][$this->_sections['editArr']['index']]['standard_code']; ?>
"/><input type="text" name="editcode[]" style="width:100px;" value="<?php echo $this->_tpl_vars['editArr'][$this->_sections['editArr']['index']]['c_name']; ?>
"/>
      <input type="hidden" name="editcode[]"  value="<?php echo $this->_tpl_vars['editArr'][$this->_sections['editArr']['index']]['inner_order']; ?>
"/>&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
dictionary/dictionary/del/delid/<?php echo $this->_tpl_vars['editArr'][$this->_sections['editArr']['index']]['inner_order']; ?>
/delname/<?php echo $this->_tpl_vars['editArr'][$this->_sections['editArr']['index']]['category']; ?>
/zhname/<?php echo $this->_tpl_vars['editArr'][$this->_sections['editArr']['index']]['category_name']; ?>
" onclick="return confirm('您确定删除吗?确定');">删除</a> 
      </div>
     <?php endfor; endif; ?>
      </div>
     <div style="width:800px;">
     <div id="div_scode" style="width:700px;float:left;">
     </div>
     <div style="width:700px;float:left;">
     <input type="button" onClick="createInput('div_scode','scode[]')" name="button" id="button" value="+ 添加 输入框">
     </div>
     </div>
  </td>
  </tr>
  <tr align="center"><td colspan="2"><input type="submit" name="ok" value="保存"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="ok" value="退出" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
dictionary/dictionary/index'"/></td></tr>
</table>
</form>
</body>
</html>
<script type="text/javascript">
  var editdiv     = document.getElementById('editcode');
  var currentname = document.getElementById('currentname');
  if(currentname.value!==""){
	  editdiv.style.display="block";
	}
</script>
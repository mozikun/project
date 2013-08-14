<?php /* Smarty version 2.6.14, created on 2013-08-13 14:08:43
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>个人档案查重</title>
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
	.table_mouseover{
		background:#cccccc;
	}
	.table_mouseout{
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
views/js/jquery-1.4.2.js"  type="text/javascript"></script>
</head>
<body>
<form action="<?php echo $this->_tpl_vars['basePath']; ?>
iha/repeat/index" id="search" method="post">
	<table border="0" width="100%">
		<tr><td>身份证号<img title="“可以依次输入完整或者部分身份证号”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />:
		<input type="text" id="identity" name="standard_code" />&nbsp;&nbsp;
		 管辖地区内重复档案：<input  name="token" value="1" type="checkbox" <?php if ($this->_tpl_vars['token'] == 1): ?>checked="checked"<?php endif; ?>>
		<input type="submit" value="搜索"  />&nbsp;&nbsp;<input type="button" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
iha/repeat/index/token/<?php echo $this->_tpl_vars['token']; ?>
'" value="返回" /> 
		&nbsp;<input type="button" value="管辖地区与其他地区重复档案" onclick="window.location.href='<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/repeat/list'" /></td></tr>
	</table>
</form>    
	<table border="0" width="100%">
	<thead>
	    <tr class="headbg">
	        <th>
	        	编号
	        </th>
	        <th>
	        	身份证号
	        </th>
			<th>
	        	姓名
	        </th>
	        <th>
	        	性别
	        </th>
	        <th>
	        	建档时间
	        </th>
	        <th>
	        	户主姓名
	        </th>
	        <th>
	        	责任医生
	        </th>
	        <th>
	        	档案完整率
	        </th>
	        <th>
	        	其他关联数据
	        </th>
	        <th>
        	    家庭地址
            </th>
			<th>
	        	操作
	        </th>	
		</tr>
	</thead>
	<tbody id="iha">
  <form action="" id='form1'>
	<?php unset($this->_sections['individual']);
$this->_sections['individual']['name'] = 'individual';
$this->_sections['individual']['loop'] = is_array($_loop=$this->_tpl_vars['individual']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['individual']['show'] = true;
$this->_sections['individual']['max'] = $this->_sections['individual']['loop'];
$this->_sections['individual']['step'] = 1;
$this->_sections['individual']['start'] = $this->_sections['individual']['step'] > 0 ? 0 : $this->_sections['individual']['loop']-1;
if ($this->_sections['individual']['show']) {
    $this->_sections['individual']['total'] = $this->_sections['individual']['loop'];
    if ($this->_sections['individual']['total'] == 0)
        $this->_sections['individual']['show'] = false;
} else
    $this->_sections['individual']['total'] = 0;
if ($this->_sections['individual']['show']):

            for ($this->_sections['individual']['index'] = $this->_sections['individual']['start'], $this->_sections['individual']['iteration'] = 1;
                 $this->_sections['individual']['iteration'] <= $this->_sections['individual']['total'];
                 $this->_sections['individual']['index'] += $this->_sections['individual']['step'], $this->_sections['individual']['iteration']++):
$this->_sections['individual']['rownum'] = $this->_sections['individual']['iteration'];
$this->_sections['individual']['index_prev'] = $this->_sections['individual']['index'] - $this->_sections['individual']['step'];
$this->_sections['individual']['index_next'] = $this->_sections['individual']['index'] + $this->_sections['individual']['step'];
$this->_sections['individual']['first']      = ($this->_sections['individual']['iteration'] == 1);
$this->_sections['individual']['last']       = ($this->_sections['individual']['iteration'] == $this->_sections['individual']['total']);
?>
	 <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
	    <td>
	    		<?php if ($this->_tpl_vars['individual'][$this->_sections['individual']['index']]['display'] == 1): ?>
	        	<input type="checkbox" value="<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['uuid']; ?>
" name="selectFlag[]" id="selectFlag" />
	        	<?php endif; ?>

	    </td>
        <td>
        <?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['identity_number']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['name']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['sex']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['created']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['householder_name']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['staff_name']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['criteria_rate']; ?>

        </td>
        <td>
           健康体检<font color="Red"><?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['examination_count']; ?>
</font>次<br />
           高血压随访<font color="Red"><?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['hypertension_count']; ?>
</font>次<br />
           糖尿病随访<font color="Red"><?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['diabetes_count']; ?>
</font>次<br />
           重性精神病随访<font color="Red"><?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['schizophrenia_count']; ?>
</font>次<br />
           <strong>共有数据<font color="Red"><?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['all_number']; ?>
</font>条</strong>
        </td>
        <td>
        	<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['address']; ?>

        </td>
		<td>
		    <?php if ($this->_tpl_vars['individual'][$this->_sections['individual']['index']]['display'] == 1): ?>
		    <a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/cover/add/action/edit/uuid/<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['uuid']; ?>
/opener/index">档案封面</a> &nbsp;&nbsp;
		    <a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/add/uuid/<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['uuid']; ?>
/opener/index">编辑档案</a> &nbsp;&nbsp;

        	<?php endif; ?>
        </td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="11">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	<tr>
	   <td colspan="11" align="center">
	     <div style="float:left"><label><input type="checkbox" value="" name="ifAll" id="ifAll" onClick="return checkselect();"/>全选 </label>   
	     &nbsp;&nbsp;<input type="submit" onClick="return checkselected('<?php echo $this->_tpl_vars['uuid']; ?>
');"  name="delAll" value="删除" class="inputbutton"/>&nbsp;&nbsp;<?php echo $this->_tpl_vars['pager']; ?>
</div>
	   </td>
	</tr>
  </form> 
 </tbody>
</table>
</body>
</html>
<script type="text/javascript">
//全选、反选
function checkselect() {
	  for (var i = 0; i < document.getElementsByName("selectFlag[]").length; i++) {
	   document.getElementsByName("selectFlag[]")[i].checked = document.getElementById("ifAll").checked;
	  }
	 }
//选中与否，有选中项才执行删除	 
function checkselected(uuid){
	var token=0;//标志
	$("input[name='selectFlag[]']").each(function(){
		//alert($(this).attr('checked'));
		
		if($(this).attr('checked')==true){
			token=1;//有选中项
		}	
	});
	if(token==1)
	{
		if(confirm('你真的要删除选中项么？删除后将不能恢复！请耐心等待，执行时间稍微长点！'))
		{
			//执行删除操作
			  $.post("<?php echo $this->_tpl_vars['basePath']; ?>
iha/repeat/delall",$("#form1").serialize(),function (msg) {
//			  	 alert(uuid);
			     alert(msg);
			     window.location='<?php echo $this->_tpl_vars['basePath']; ?>
iha/repeat/list/uuid/'+uuid;	///更新删除后页面
		      });
		         return false;
		}else{
			//取消删除
			return false;
		}
		//return false;
	}else{
		alert('没有选中要删除的项！');
		return false;
	}
}
</script>
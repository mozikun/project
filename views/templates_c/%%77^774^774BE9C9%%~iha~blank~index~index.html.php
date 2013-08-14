<?php /* Smarty version 2.6.14, created on 2013-08-13 13:58:14
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>身份证为空</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/search_list.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/ajax_select_region.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
    //处理地区下拉
    get_region_select_html('<?php echo $this->_tpl_vars['basePath']; ?>
','org_id','menuDropDownBox');
});
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
	.line
	{
		border-top:0px;
		border-left:0px;
		border-right:0px;
	}
</style>
</head>
<body>
<form action="<?php echo $this->_tpl_vars['basePath']; ?>
iha/blank/index" id="search" method="post">
	<table border="0" width="100%">
		<tr><td>姓名<img title="“输入居民姓名，查看身份证为空的重复数”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />:<input type="text" id="user" name="username" />&nbsp;&nbsp;
		  所属地区:<span id="menuDropDownBox"></span>    
                  <input  type="hidden" name="org_id" id="org_id" value="<?php echo $this->_tpl_vars['org_id']; ?>
" /> &nbsp;<input type="submit" value="搜索"  />&nbsp;&nbsp;</td></tr>
	</table>
</form>    
	<table border="0" width="100%">
	<thead id="title">
	    <tr class="headbg">
	    	<th width="6%">
	        	编号
	        </th>
	        <th width="10%">
	        	姓名
	        </th>
			<th width="10%">
	        	性别
	        </th>
	        <th>
	        	建档时间
	        </th> 
	        <th>
	        	完整率
	        </th>
	        <th>
	        	户主姓名
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
	        	<input type="checkbox" value="<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['uuid']; ?>
" name="selectFlag[]" id="selectFlag" />
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
        	<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['criteria_rate']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['householder_name']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['address']; ?>

        </td>
		<td>
		    <a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/cover/add/action/edit/uuid/<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['uuid']; ?>
/opener/index" target="_blank">档案封面</a> &nbsp;&nbsp;
		    <a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/add/uuid/<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['uuid']; ?>
/opener/index" target="_blank">编辑档案</a> &nbsp;&nbsp;
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/blank/del/uuid/<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['uuid']; ?>
" onclick="return confirm('是否确定删除此记录,删除后不能恢复！')" >删除</a>
        </td>
	</tr>
	
	<?php endfor; else: ?>
	<tr>
		<td colspan="8">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="8"> <div style="float:left"><label><input type="checkbox" value="" name="ifAll" id="ifAll" onClick="return checkselect();"/>全选 </label>   
	     &nbsp;&nbsp;<input type="submit" onClick="return checkselected('<?php echo $this->_tpl_vars['uuid']; ?>
');"  name="delAll" value="删除" class="inputbutton"/>&nbsp;&nbsp;
        	<?php echo $this->_tpl_vars['pager']; ?>

        </td>
	</tr>
	 </form> 
	</tbody>
</table>
</body>
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
iha/blank/delall",$("#form1").serialize(),function (msg) {
//			  	 alert(uuid);
			     alert(msg);
			     window.location='<?php echo $this->_tpl_vars['basePath']; ?>
iha/blank/index/uuid/'+uuid;	///更新删除后页面
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
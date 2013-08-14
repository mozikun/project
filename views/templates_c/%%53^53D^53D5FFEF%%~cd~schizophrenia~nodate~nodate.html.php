<?php /* Smarty version 2.6.14, created on 2013-06-24 10:56:06
         compiled from nodate.html */ ?>
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
views/js/popup.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/ajax_select_region.js" type="text/javascript"></script>
<script>	
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
				}
				//return false;
			}
		});
		return true;
	}
</script>
</head>
<body>
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
    	<th>&nbsp;
        	
        </th>
        <th>档案号
        </th>
		<th>
        	姓名
        </th>
		<th>
        	性别
        </th>
		<th>
        	家庭地址
        </th>
		<th>
        	年龄
        </th>
		<th>
        	联系电话
        </th>
		<th>
        	户主姓名
        </th>
		<th>
        	建档医生
        </th>
		<th>
        	操作
        </th>
	</tr>
	</thead>
	<tbody id="iha">
	<?php unset($this->_sections['iha']);
$this->_sections['iha']['name'] = 'iha';
$this->_sections['iha']['loop'] = is_array($_loop=$this->_tpl_vars['iha']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iha']['show'] = true;
$this->_sections['iha']['max'] = $this->_sections['iha']['loop'];
$this->_sections['iha']['step'] = 1;
$this->_sections['iha']['start'] = $this->_sections['iha']['step'] > 0 ? 0 : $this->_sections['iha']['loop']-1;
if ($this->_sections['iha']['show']) {
    $this->_sections['iha']['total'] = $this->_sections['iha']['loop'];
    if ($this->_sections['iha']['total'] == 0)
        $this->_sections['iha']['show'] = false;
} else
    $this->_sections['iha']['total'] = 0;
if ($this->_sections['iha']['show']):

            for ($this->_sections['iha']['index'] = $this->_sections['iha']['start'], $this->_sections['iha']['iteration'] = 1;
                 $this->_sections['iha']['iteration'] <= $this->_sections['iha']['total'];
                 $this->_sections['iha']['index'] += $this->_sections['iha']['step'], $this->_sections['iha']['iteration']++):
$this->_sections['iha']['rownum'] = $this->_sections['iha']['iteration'];
$this->_sections['iha']['index_prev'] = $this->_sections['iha']['index'] - $this->_sections['iha']['step'];
$this->_sections['iha']['index_next'] = $this->_sections['iha']['index'] + $this->_sections['iha']['step'];
$this->_sections['iha']['first']      = ($this->_sections['iha']['iteration'] == 1);
$this->_sections['iha']['last']       = ($this->_sections['iha']['iteration'] == $this->_sections['iha']['total']);
?>
	 <tr id="iha_<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
" ondblclick="set_session('<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
')">
	 	<td>
	 		<?php if ($this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid'] == $this->_tpl_vars['individual_current']->uuid): ?>
			<img id="img_<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/status_online.png" class="online" />
			<?php else: ?>
			<img id="img_<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/status_offline.png" class="online" />
			<?php endif; ?> 
	 	</td>
        <td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['standard_code']; ?>

        </td>
		<td id="<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
_name">
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['name']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['sex']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['address']; ?>

        </td>
		<td title="生日：<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['date_of_birth']; ?>
">
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['age']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['contact_number']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['householder_name']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['staff_name']; ?>

        </td>
		<td>
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/add/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
/para_page/<?php echo $this->_tpl_vars['para_page']; ?>
/opener/index"  onclick="set_session('<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
');" target="_blank">编辑档案</a>
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/delete/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
" onclick="return confirm('是否确定')">删除</a>
        </td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="10">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="10">
        	<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/status_online.png" />选中状态
			&nbsp;
			<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/status_offline.png" />未选中状态&nbsp;<?php echo $this->_tpl_vars['pager']; ?>

        </td>
	</tr>
	</tbody>
</table>
<div id="rate_popup" style="display:none;">
</div>
<input type="hidden" id="error_message" name="error_message" value="<?php echo $this->_tpl_vars['error_message']; ?>
" />
</body>
</html>
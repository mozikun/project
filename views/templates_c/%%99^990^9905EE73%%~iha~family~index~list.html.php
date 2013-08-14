<?php /* Smarty version 2.6.14, created on 2013-05-07 10:31:08
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>家庭档案列表</title>
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
<script>
	$(document).ready(function(){
		//定义鼠标经过样式
		//定义搜索样式
		//$("#search_lable").toggle(function(){$("#tbody_search").show();$("#tbody_search input").attr("disabled",false);$("#tbody_search select").attr("disabled",false);$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_out.png");},function(){$("#tbody_search").hide();$("#tbody_search input").attr("disabled",true);$("#tbody_search select").attr("disabled",true);$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png");});
		$("#search_lable").toggle(function(){$("#tbody_search").show();$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_out.png");},function(){$("#tbody_search").hide();$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png");});
		//当选择全选的时候，把与其名字一样的所有字段全部选中
		$(".all").bind("click",function(){
			var input_name=$(this).attr("name");
			$("input[name='"+input_name+"']").attr("checked",$(this).attr("checked"));
		});
	});
	function ajaxload(gurl,obj,tp)
	{
		//移除原来的img标签
		$("th>img").remove();
		$("th").unbind();
		var order=$(obj).attr("class");
		//alert(order);
		if(tp=='undefind')
		{
			tp="POST";
		}
		tp="POST";
		var searchv=$("#searchinput").val();
		$.ajax({
			type:tp,
			url:gurl+order+searchv,
			dataType:"html",
			data:$("#search").serialize(),
			beforeSend:function(){
				$("#iha").html("<tr><td colspan='11'>数据查询中，请耐心等待...</td></tr>");
				},
			success:function(data){
				//document.write(data);
				if(order=="asc")
				{
					$(obj).attr("class","desc");
				}
				else
				{
					$(obj).attr("class","asc");
				}
				$(obj).html("<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/"+order+".png' />"+$(obj).text());
				$("#iha").html(data);
				//增加鼠标移动样式
				$("th").bind("mouseover mouseout",function(){
				var sr=$(this).find("img").attr("src");
				if(sr=="<?php echo $this->_tpl_vars['basePath']; ?>
images/asc.png")
				{
					$(this).find("img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/desc.png");
				}
				else
				{
					$(this).find("img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/asc.png");
				}
				});
			},
			error:function(){
				$("#iha").html("<tr><td colspan='11'>数据查询失败，请刷新页面重试...</td></tr>")
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
			beforeSend:function(){$("#iha").html("<tr><td colspan='11'>数据查询中，请耐心等待...</td></tr>")},
			success:function(data){
				//alert(data);
				//document.write(data);
				$("#iha").html(data);
			},
			error:function(){
				$("#iha").html("<tr><td colspan='11'>数据查询失败，请刷新页面重试...</td></tr>")
			}
		});
	}
	function ajaxsearch(gurl)
	{
		$.ajax({
			type:"POST",
			url:gurl,
			dataType:"html",
			data:$("#search").serialize(),
			beforeSend:function(){$("#iha").html("<tr><td colspan='11'>数据查询中，请耐心等待...</td></tr>")},
			success:function(data){
				//alert(data);
				//document.write(data);
				$("#iha").html(data);
				return false;
			},
			error:function(){
				$("#iha").html("<tr><td colspan='11'>数据查询失败，请刷新页面重试...</td></tr>");
				return false;
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
				}
				//return false;
			}
		});
		return true;
	}
	//alert($('#i_4c4ba61e71cc14.67049524_name').text());
</script>
</head>
<body>
<table border="0" width="100%">
		<form action="" id="search" method="post">
			<tr><td>
				姓名<img title="“可以输入汉字也可以输入姓名拼音的首字母，比如要查找'王高兴',那么可以输入姓名汉字中的“王”，“王高”或者“王高兴”均可，也可以依次输入‘wgx’几个字母进行搜索查找，比如“w”,“wg”，或者“wgx””" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />：<input type="text" name="username" class="line" size="10">&nbsp;
				档案号<img title="“依次输入标准档案号里的全部或者部分数字,比如档案号为“510100-888-888-88-8888-88”，则可以录入“5加任意数字的格式进行查找””" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />:<input type="text" name="standard_code" class="line" size="10">&nbsp;
				身份证号<img title="“可以依次输入完整或者部分身份证号”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />:<input type="text" name="identity_number" class="line" size="12">&nbsp;
				年龄:<input type="text" name="age_start" class="line" style="width:28px" size="6">
				~<input type="text" name="age_end" class="line" style="width:28px" size="6">&nbsp;
				无身份证号<input type="checkbox" name="nocard" value='1' />&nbsp;
<!--				<input type="button" value="搜索" onclick="return ajaxsearch('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/list');">
-->				<input type="button" value="搜索" onclick="return ajaxsearch('<?php echo $this->_tpl_vars['basePath']; ?>
iha/family/list');">
				
				<label id="search_lable" style="cursor:pointer;"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png" />高级搜索<img title="请尽量使用普通搜索，并且限制搜索条件详细一些，否则会耗费过长的时间" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" /></label>
				</td>
			</tr>
		<tbody id="tbody_search" style="display:none;">
			<tr>
				<td>
					所属地区:<br /><span id="menuDropDownBox"></span>	
					<input type="hidden" name="region_id" id="region_id" value="<?php echo $this->_tpl_vars['region_id']; ?>
" />
					<input type="hidden" name="region_p_id" id="region_p_id" value="<?php echo $this->_tpl_vars['region_p_id']; ?>
" />
					
					</td>
			</tr>
		<tr>
				<td>
				建档医生：
		<select name="staff_id" id="staff_id">
			<?php unset($this->_sections['response_doctor']);
$this->_sections['response_doctor']['name'] = 'response_doctor';
$this->_sections['response_doctor']['loop'] = is_array($_loop=$this->_tpl_vars['response_doctor']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['response_doctor']['show'] = true;
$this->_sections['response_doctor']['max'] = $this->_sections['response_doctor']['loop'];
$this->_sections['response_doctor']['step'] = 1;
$this->_sections['response_doctor']['start'] = $this->_sections['response_doctor']['step'] > 0 ? 0 : $this->_sections['response_doctor']['loop']-1;
if ($this->_sections['response_doctor']['show']) {
    $this->_sections['response_doctor']['total'] = $this->_sections['response_doctor']['loop'];
    if ($this->_sections['response_doctor']['total'] == 0)
        $this->_sections['response_doctor']['show'] = false;
} else
    $this->_sections['response_doctor']['total'] = 0;
if ($this->_sections['response_doctor']['show']):

            for ($this->_sections['response_doctor']['index'] = $this->_sections['response_doctor']['start'], $this->_sections['response_doctor']['iteration'] = 1;
                 $this->_sections['response_doctor']['iteration'] <= $this->_sections['response_doctor']['total'];
                 $this->_sections['response_doctor']['index'] += $this->_sections['response_doctor']['step'], $this->_sections['response_doctor']['iteration']++):
$this->_sections['response_doctor']['rownum'] = $this->_sections['response_doctor']['iteration'];
$this->_sections['response_doctor']['index_prev'] = $this->_sections['response_doctor']['index'] - $this->_sections['response_doctor']['step'];
$this->_sections['response_doctor']['index_next'] = $this->_sections['response_doctor']['index'] + $this->_sections['response_doctor']['step'];
$this->_sections['response_doctor']['first']      = ($this->_sections['response_doctor']['iteration'] == 1);
$this->_sections['response_doctor']['last']       = ($this->_sections['response_doctor']['iteration'] == $this->_sections['response_doctor']['total']);
?>
			<option value="<?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['id']; ?>
" <?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['selected']; ?>
 ><?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['zh_name']; ?>
</option>
			<?php endfor; endif; ?>
		</select>&nbsp;联系电话:<input type="text" name="phone_number" class="line" size="10">&nbsp;工作单位：<input type="text" name="unit_name" class="line" size="30">&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				常住类型:<input type="checkbox" class="all" name="residence[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['registered_permanent_residence']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="residence[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				性别:<input type="checkbox" class="all" name="sex[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['sex']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="sex[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				文化程度:<input type="checkbox" class="all" name="school_type[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['school_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="school_type[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				职业:<input type="checkbox" class="all" name="occupation[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['occupation']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="occupation[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				婚姻状况:<input type="checkbox" class="all" name="marriage[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['marriage']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="marriage[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				药物过敏史:<input type="checkbox" class="all" name="allergy_history[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="allergy_history[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				疾病史:<input type="checkbox" class="all" name="disease_history[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="disease_history[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				手术史:<input type="checkbox" class="all" name="surgery_history[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="surgery_history[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				外伤史:<input type="checkbox" class="all" name="trauma_history[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="trauma_history[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				输血史:<input type="checkbox" class="all" name="blood_history[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="blood_history[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				遗传病史:<input type="checkbox" class="all" name="genetic_diseases_history[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="genetic_diseases_history[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				残疾状况:<input type="checkbox" class="all" name="disability[]" value="all">&nbsp;全部&nbsp;
				<?php $_from = $this->_tpl_vars['comm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="disability[]" value="<?php echo $this->_tpl_vars['v'][0]; ?>
"><?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
				<?php endforeach; endif; unset($_from); ?>&nbsp;
				</td>
			</tr>
			</tbody>
			</form>
</table>	
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
    	<th>
        	&nbsp;
        </th>
        <th>家庭档案号</th>
<!--        <th title="按档案号排序" style="cursor:pointer;" class="asc" onclick="ajaxload('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/list/page/<?php echo $this->_tpl_vars['page']; ?>
/order/standard_code/turn/',this)">
        	<img src='<?php echo $this->_tpl_vars['basePath']; ?>
images/asc.png' />档案号
        </th>
-->		<th title="按姓名排序" style="cursor:pointer;" class="asc" onclick="ajaxload('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/list/page/<?php echo $this->_tpl_vars['page']; ?>
/order/name_pinyin/turn/',this)">
        	户主姓名
        </th>
		<th>
        	性别
        </th>
		<th>
        	家庭地址
        </th>
		<th>
        	联系电话
        </th>
		<th>
        	建档医生
        </th>
<!--		<th>
        	操作
        </th>-->
	   <th>
	   		家庭成员
	   </th>
       <th>
        	选项
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
">
	 	<td>
	 		<input type="checkbox" name="uuids[]" value="<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['family_number_edit']; ?>
" /> 
	 	</td>
        <td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['family_number']; ?>

        </td>
	 	
<!--        <td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['standard_code']; ?>

        </td>-->
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
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['contact_number']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['staff_name']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['family_member_list']; ?>

        </td>
        <td>
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/family/edit/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['family_number_edit']; ?>
">编辑</a> | <a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/family/move/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['family_number_edit']; ?>
">转出家庭</a>
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
		<td colspan="11">
        	<input type="checkbox" onclick="select_all(this)" />全选 &nbsp;&nbsp;<a href="###" onclick="do_select('<?php echo $this->_tpl_vars['basePath']; ?>
iha/family/move')">转出选中家庭</a>&nbsp;<?php echo $this->_tpl_vars['pager']; ?>

        </td>
	</tr>
    <tr>
		<td colspan="11">
        	<span class="red">* 转出家庭，会将家庭所有成员转出到新的地区和机构，家庭内部关系不做变更，请谨慎操作</span>
        </td>
	</tr>
	</tbody>
</table>
<input type="hidden" id="error_message" name="error_message" value="<?php echo $this->_tpl_vars['error_message']; ?>
" />
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
region/region/menuDropDownBox/p_id/'+region_p_id+'/sid/'+Math.random();
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
if(document.getElementById('error_message').value!=''){
	alert(document.getElementById('error_message').value);
}
function select_all(frm) {
	$("#iha td").find("input").each(function(){
		if(this.type) {
			if(this.type=="checkbox") {
				if(frm.checked) {
					$(this).attr("checked","checked");
				}else{
					$(this).removeAttr("checked");
				}
			}
		}
	});
}
function do_select(furl)
{
    if($("input[type='checkbox']:checked").length<1)
    {
        alert("请选择要转出的家庭");
        return false;
    }
	$.ajax({
     		type:"post",
     		url:"<?php echo $this->_tpl_vars['basePath']; ?>
iha/family/moveselect",
     		dataType:"html",
     		data:$("input[name='uuids[]']:checked").serialize(),
     		success:function(data)
            {
				//alert(data);
	            window.location=furl;
	     	},
	        error:function()
	        {
	            alert('连接服务器错误');
	        }
      });
}
</script>
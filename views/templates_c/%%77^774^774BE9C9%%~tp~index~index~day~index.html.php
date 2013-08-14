<?php /* Smarty version 2.6.14, created on 2013-08-08 09:27:57
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>工作计划</title>
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


label
{
	cursor:hand;
	cursor: pointer;

}
#box{  display:none; } 

	/*左上角*/
.Left_top {right:0;top:0;position:fixed;+position:absolute;top:expression(parseInt(document.body.scrollTop));}
</style>
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery.blockUI.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/search_list.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/popup.js" type="text/javascript"></script> 

<script>
$(document).ready(function(){
	$("#search_listpic").toggle(function(){do_search("<?php echo $this->_tpl_vars['basePath']; ?>
","","","","");},function(){undo_search("<?php echo $this->_tpl_vars['basePath']; ?>
");});
	
	//全选、取消
	$("#checkall1").click(
   function(){
    if(this.checked){
        $("input[name='tips_ids[]']").each(function(){this.checked=true;});
    }else{
        $("input[name='tips_ids[]']").each(function(){this.checked=false;});
    }
}
);
	
});
//完成工作计划页面
function display_execution(uuid,current_date){
	//alert('a');
	$.dialog(400, 150, $('#action_popup').html(),"action_popup","执行工作计划");
    $('#dialog_box_html').addClass('background:url(<?php echo $this->_tpl_vars['basePath']; ?>
images/load.gif) no-repeat center center;');
    $('#dialog_box_html').empty();//先清空，因为多次载入图片
    var html_info="<div style='text-align:center;padding-top:20px;'><input type=\"text\" name=\"tips_complete_time\" id=\"tips_complete_time\"  class=\"Wdate\"  value='"+current_date+"' onfocus=\"WdatePicker({firstDayOfWeek:1})\"  MINDATE=\"1930-1-1\" MAXDATE=\"2015-12-31\" readonly=\"readonly\" />";
    html_info+="&nbsp;<input type='button' value='完成' id='execution' onclick=\"do_execution('"+uuid+"','1');\"/></div>"
    $('#dialog_box_html').html(html_info);
    
}
//更新工作计划状态
function do_execution(uuid,state){
	var execution_date=$("#tips_complete_time").val();
	if(execution_date==""){
		alert("工作计划完成时间不能为空！");
		return false;
	}
	$.get("<?php echo $this->_tpl_vars['basePath']; ?>
tp/index/doexecution/uuid/"+uuid+"/state/"+state+"/execution_date/"+execution_date, function(data){
	  	alert(data);
	  	//刷新工作计划完成时间和状态
	  	if(data=="更改成功！"){
	  		 var uuid_= uuid.replace(".","_");
	  		 var complete_time_uuid = "complete_time_"+uuid_;
	  		 var state_uuid="state_"+uuid_;
	  	     $("#"+complete_time_uuid).html(execution_date);//
	  	     if(state==1){
	  	     	$("#"+state_uuid).html('完成');
	  	     	$("#execution_"+uuid_).html('');
	  	     	$("#cancel_"+uuid_).html('');;
	  	     	$("#cancel_"+uuid_).html('取消');;
	  	     }
	  	     if(state==2){
	  	     	$("#"+state_uuid).html('取消');
	  	     	$("#execution_"+uuid_).html('');
	  	     	$("#cancel_"+uuid_).html('');
	  	     	$("#execution_"+uuid_).html('完成');;
	  	     }

	  	}
	});
}
//取消工作计划弹出页
function display_cancel(uuid,current_date){
	//alert('b');
	$.dialog(400, 150, $('#action_popup').html(),"action_popup","取消工作计划");
    $('#dialog_box_html').addClass('background:url(<?php echo $this->_tpl_vars['basePath']; ?>
images/load.gif) no-repeat center center;');
    $('#dialog_box_html').empty();//先清空，因为多次载入图片
    var html_info="<div style='text-align:center;padding-top:20px;'><input type=\"text\" name=\"tips_complete_time\" id=\"tips_complete_time\"  class=\"Wdate\"  value='"+current_date+"' onfocus=\"WdatePicker({firstDayOfWeek:1})\"  MINDATE=\"1930-1-1\" MAXDATE=\"2015-12-31\" readonly=\"readonly\" />";
    html_info+="&nbsp;<input type='button' value='取消' id='execution' onclick=\"do_execution('"+uuid+"','2');\"/></div>"
    $('#dialog_box_html').html(html_info);
}
</script>
</head>
<body>
<div id="search_list"></div>
	<table border="0" width="100%">
		<form action="<?php echo $this->_tpl_vars['basePath']; ?>
tp/index/index" id="search" method="POST">
			<tr><td>
			    <div>
				姓名<img title="“可以输入汉字也可以输入姓名拼音的首字母，比如要查找'王高兴',那么可以输入姓名的三个汉字中的任意一个，也可以输入‘wxm’几个字母进行搜索查找”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="username" value="<?php echo $this->_tpl_vars['search']['username']; ?>
" class="line" size="10">&nbsp;
				档案号<img title="“输入标准档案号里的全部或者部分数字”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="standard_code" value="<?php echo $this->_tpl_vars['search']['standard_code']; ?>
" class="line" size="10">&nbsp;
				身份证号<img title="“可以输入完整或者部分身份证号”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="identity_number" value="<?php echo $this->_tpl_vars['search']['identity_number']; ?>
" class="line" size="12">&nbsp;
				随访医生:<select name="staff_id" id="staff_id">
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
				</select>
					&nbsp;
				<br/>
				标题<img title="“输入工作计划标题”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="title" value="<?php echo $this->_tpl_vars['search']['title']; ?>
" class="line" size="10"/>&nbsp;
				制定时间<img title="“输入工作计划制定时间”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="created"  class="line"  size="11" value='<?php echo $this->_tpl_vars['search']['created']; ?>
' onfocus="WdatePicker({firstDayOfWeek:1})"  MINDATE="1930-1-1" MAXDATE="2015-12-31" readonly="readonly" />&nbsp;
				预定执行时间<img title="“输入工作计划预定执行时间”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="tips_time"  class="line"  size="11" value="<?php echo $this->_tpl_vars['search']['tips_time']; ?>
" onfocus="WdatePicker({firstDayOfWeek:1})"  MINDATE="1930-1-1" MAXDATE="2015-12-31" readonly="readonly"/>&nbsp;
				实际执行时间<img title="“输入工作计划实际执行时间”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="tips_complete_time"  class="line"  size="11" value="<?php echo $this->_tpl_vars['search']['tips_complete_time']; ?>
" onfocus="WdatePicker({firstDayOfWeek:1})"  MINDATE="1930-1-1" MAXDATE="2015-12-31" readonly="readonly"/>&nbsp;
				&nbsp;&nbsp;<input type="submit" value="搜索"/>
				<br/>
				状态<img title="“工作计划状态分为 未执行 执行 和 取消三种状态”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:
				<select name="state" id="state">
				<option value=""></option>
			
				<?php $_from = $this->_tpl_vars['state_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['search']['state'] == $this->_tpl_vars['k'] && $this->_tpl_vars['search']['state'] != null): ?> selected <?php endif; ?>/><?php echo $this->_tpl_vars['v']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				
				</div>
				
				
				
				</td>
			</tr>
			</form>
</table>	
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
    	<th>&nbsp;
        	
        </th>
		<th>
        	姓名
        </th>
		<th>
        	详细地址
        </th>
        <th>
        	标题
        </th>
		<th>
        	类型
        </th>
		<th>
        	制定时间
        </th>
        <th>
        	预定执行时间
        </th>
        <th>
        	制定者 
        </th>
        <th>
        	实际执行时间
        </th>
        <th>
        	状态
        </th>
		<th>
        	操作
        </th>
	</tr>
	</thead>
	<tbody id="hy">
	<form id="ids" name='ids'>
	
	<?php unset($this->_sections['tips']);
$this->_sections['tips']['name'] = 'tips';
$this->_sections['tips']['loop'] = is_array($_loop=$this->_tpl_vars['tips_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tips']['show'] = true;
$this->_sections['tips']['max'] = $this->_sections['tips']['loop'];
$this->_sections['tips']['step'] = 1;
$this->_sections['tips']['start'] = $this->_sections['tips']['step'] > 0 ? 0 : $this->_sections['tips']['loop']-1;
if ($this->_sections['tips']['show']) {
    $this->_sections['tips']['total'] = $this->_sections['tips']['loop'];
    if ($this->_sections['tips']['total'] == 0)
        $this->_sections['tips']['show'] = false;
} else
    $this->_sections['tips']['total'] = 0;
if ($this->_sections['tips']['show']):

            for ($this->_sections['tips']['index'] = $this->_sections['tips']['start'], $this->_sections['tips']['iteration'] = 1;
                 $this->_sections['tips']['iteration'] <= $this->_sections['tips']['total'];
                 $this->_sections['tips']['index'] += $this->_sections['tips']['step'], $this->_sections['tips']['iteration']++):
$this->_sections['tips']['rownum'] = $this->_sections['tips']['iteration'];
$this->_sections['tips']['index_prev'] = $this->_sections['tips']['index'] - $this->_sections['tips']['step'];
$this->_sections['tips']['index_next'] = $this->_sections['tips']['index'] + $this->_sections['tips']['step'];
$this->_sections['tips']['first']      = ($this->_sections['tips']['iteration'] == 1);
$this->_sections['tips']['last']       = ($this->_sections['tips']['iteration'] == $this->_sections['tips']['total']);
?>
	 <tr>
	 	<td>&nbsp;
        <?php if ($this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['status'] == '0' && $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['phone_number'] != ''): ?>
	        <?php if ($this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['ssname'] != ''): ?>
				<img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/message1.jpg" id='img_<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid_']; ?>
'/>
				<input type="checkbox" name="tips_ids[]"  id="uuid_<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid_']; ?>
" value="<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid']; ?>
"/>
			<?php endif; ?>
		 <?php else: ?>	
		 <?php if ($this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['status'] == 'send'): ?>
		 <img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/message2.jpg"/>
		
        <?php endif; ?>	
		<?php endif; ?>		
        </td>
		<td>
        	<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['ssname']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['address']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['title']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['tips_type']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['created']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['tips_time']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['tips_serial']; ?>

        </td>
        <td >
        	<span id="complete_time_<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid_']; ?>
"><?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['tips_complete_time']; ?>
</span>
        </td>
		<td >
		    <?php if ($this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['state_code'] == "" || $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['state_code'] == 0): ?>
        	<font color="Red"><span id="state_<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid_']; ?>
"><?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['state']; ?>
</span></font>
        	<?php else: ?>
        	<span id="state_<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid_']; ?>
"><?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['state']; ?>
</span>
        	<?php endif; ?>
        </td>
		
		<td>
		    <label id="execution_<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid_']; ?>
" name="<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid']; ?>
" onclick="display_execution('<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid']; ?>
','<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['tips_time']; ?>
');"><?php if ($this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['state_code'] != 1): ?>完成<?php endif; ?></label>&nbsp;
		    <label id="cancel_<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid_']; ?>
"  name="<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid']; ?>
" onclick="display_cancel('<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid']; ?>
','<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['tips_time']; ?>
');"><?php if ($this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['state_code'] != 2): ?>取消<?php endif; ?></label>&nbsp;
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
tp/index/add/uuid/<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid']; ?>
/<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['token']; ?>
">编辑</a>
            <a href="<?php echo $this->_tpl_vars['basePath']; ?>
tp/index/del/uuid/<?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['uuid']; ?>
" onClick="javascript:if(confirm('确定要删除 <?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['ssname']; ?>
 工作计划信息吗？')){return true;}else{return false;}">删除</a>
        </td>
	</tr>
	
	<?php endfor; else: ?>
	
	<tr>
		<td colspan="11">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	</form>
	<tr>
	    <td colspan='2'>&nbsp;&nbsp;<input type="checkbox" id="checkall1"/> 全选 &nbsp;&nbsp;<button onclick="send();">发送</button></td>
		<td colspan="9">
			<div style="float:left;color:red">
			<a href="<?php echo $this->_tpl_vars['basePath']; ?>
tp/index/add">[<font color='red'>添加个人工作计划</font>]</a> 
			<a href="<?php echo $this->_tpl_vars['basePath']; ?>
tp/index/add/user/all">[<font color='red'>添加群体工作计划</font>]</a>
			<a href="<?php echo $this->_tpl_vars['basePath']; ?>
tp/message/list/">[<font color='red'>已发送短信列表</font>]</a>
			</div><div style="float:right"><?php echo $this->_tpl_vars['pager']; ?>
</div>
        </td>
	</tr>
	<tr>
		<td colspan='11'>
		图例：<img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/message1.jpg"/>->没有发送过短信
		<img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/message2.jpg"/>->已经发送过短信<br/>
		说明：1.已经发送过短信的工作计划可以重复发送短息。
			   2.已完成和取消的了的工作计划不能发送短息。
		</td>
	</tr>
	</tbody>
</table>
<input type="hidden" id="error_message" name="error_message" value="<?php echo $this->_tpl_vars['error_message']; ?>
" />
<div class="Left_top" id="left_top"><img id="search_listpic" alt="" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/search_list.gif" /></div>
<div id="action_popup" style="display:none;"></div>
<div id="box"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/loading_small.gif" border="0"/> 短信发送中，请耐心等待...</div>
<script type="text/javascript">
	function send(){
		
	     $.blockUI({ 
	     	message: $('#box'), 
	     	css: { 
	         border: 'none', 
	         padding: '15px', 
	         backgroundColor: '#000', 
	         '-webkit-border-radius': '10px', 
	         '-moz-border-radius': '10px', 
	         opacity: .5, 
	         color: '#fff' 
	        }});
			//$('.blockOverlay').attr('title','单击关闭').click($.unblockUI); 
		
		//return;
	    var data=$("#ids").serialize(); 
		$.post("<?php echo $this->_tpl_vars['basePath']; ?>
tp/message/send",data,function(info){			
            $.unblockUI();
   			$(".blockUI").fadeOut("slow");
			//alert(info);
			var info_arr=info.split("|");
			var info_uuids=info_arr[1];//返回发送成功所有uuid以-分隔
			//alert(info_uuids);
			var info_uuids_array=info_uuids.split("-");
			
			for(var k=0;k<info_uuids_array.length;k++){
		        var v=info_uuids_array[k];
		        //alert(v);
		        if(k!=''){
		       	 	$("#img_"+v).attr('src','<?php echo $this->_tpl_vars['basePath']; ?>
views/images/message2.jpg');//图标
		        	$("#uuid_"+v).attr('checked',false);//选择框不选择
		        	$("#uuid_"+v).hide();//选择框隐藏            
		        }
    		}
			
			alert('发送成功'+info_arr[0]+'条！');
			//window.location.reload();
			

		});
	}
	

</script>


</body>
</html>
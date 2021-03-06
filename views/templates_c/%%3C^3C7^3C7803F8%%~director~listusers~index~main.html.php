<?php /* Smarty version 2.6.14, created on 2013-08-14 11:44:32
         compiled from main.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>院长查询-全院人员类别一览</title>
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
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>   <!--时间控件的加载!-->
<script type="text/javascript">
$(document).ready(function(){
    var region_id=$("#region_id").val();
    var region_p_id=$("#region_p_id").val();
    getDropDownBox(region_p_id);
});
//@author 我好笨
//用于院长统计列表区域及机构，其中列表区域改自罗老师个人档案部分，使用Jquery改写
function checkValue(){
	//alert(parentId);
	if($('#region_p_id').val()=='-9'){
		alert('请选择一项分类');
		return false;
	}else{
		return true;
	}
}
function changeValue(obj,oldValue,currentValue){
	var tempValue=currentValue.split("|");
	var region_p_id;
	if(tempValue[0]=='-9'){
		//如果选择了　请选择，则把此级的父级作为当前选定的项目
		region_p_id=tempValue[1];
		$('#region_p_id').val(tempValue[1]);

	}else{
		region_p_id=tempValue[0];
		$('#region_p_id').val(tempValue[0]);

	}
	getDropDownBox(region_p_id);
}
function getDropDownBox(region_p_id){
	//alert(parentId+id);
	if(region_p_id=='-9'){
		alert('请选择一项分类');
		return;
	}
	var turl='<?php echo $this->_tpl_vars['basePath']; ?>
region/region/directorDropDownBox/p_id/'+region_p_id+'/sid/'+Math.random();
	$.ajax({
		type:"GET",
		url:turl,
		dataType:"html",
		data:"",
		beforeSend:function(){
                $("#totaldata").html("<img src=\"<?php echo $this->_tpl_vars['basePath']; ?>
images/load.gif\" />正在获取区域信息...");
                $("#menuDropDownBox").html($("#menuDropDownBox").html()+"<img src=\"<?php echo $this->_tpl_vars['basePath']; ?>
images/loading_small.gif\" /><br />");
                $("input[type='submit']").attr("disabled","disabled");
				},
		success:function(data){
			$("#menuDropDownBox").html(data);
            //取机构
            var rurl="<?php echo $this->_tpl_vars['basePath']; ?>
director/index/agency/region/"+region_p_id+"/sid/"+Math.random();
            $.ajax({
    		type:"GET",
    		url:rurl,
    		dataType:"html",
    		data:"",
    		beforeSend:function(){
                    $("#totaldata").html("<img src=\"<?php echo $this->_tpl_vars['basePath']; ?>
images/load.gif\" />正在获取机构信息...");
                    $("#org_id").before("<img src=\"<?php echo $this->_tpl_vars['basePath']; ?>
images/loading_small.gif\" />");
                    $("input[type='submit']").attr("disabled","disabled");
    				},
    		success:function(data){
    			$("#org_id").empty();
                $("#org_id").html(data);
                $("#org_id").siblings("img").remove();
                $("input[type='submit']").attr("disabled","");
                var org_id=$("#org_id").val();

                $("#totaldata").html("<img src=\"<?php echo $this->_tpl_vars['basePath']; ?>
images/load.gif\" />正在查询数据...");
                $("#totaldata").load("<?php echo $this->_tpl_vars['basePath']; ?>
director/listusers/total/region/"+region_p_id+"/org_id/"+org_id+"/sid/"+Math.random())

    			return false;
    		},
    		error:function(){
    			alert("数据通讯错误");
                $("input[type='submit']").attr("disabled","");
                $("#org_id").siblings("img").remove();
    			return false;
    		}
        });
            $("input[type='submit']").attr("disabled","");
			return false;
		},
		error:function(){
			alert("数据通讯错误");
            $("input[type='submit']").attr("disabled","");
			return false;
		}
    });
}


function checkForm()
{
   
        var region_p_id=$("#region_p_id").val();
        var org_id=$("#org_id").val();
        var statistics_time=$("#statistics_time").val();
        $("#totaldata").html("<img src=\"<?php echo $this->_tpl_vars['basePath']; ?>
images/load.gif\" />查询中");
        $("#totaldata").load("<?php echo $this->_tpl_vars['basePath']; ?>
director/listusers/total/region/"+region_p_id+"/org_id/"+org_id+"/sid/"+Math.random());
       
  
}

</script>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
        <th colspan="6">

        	全院人员类别一览

        </th>
	</tr>
	</thead>
	<tbody id="iha">
		<tr>
		<td style="vertical-align:top;padding:0px;" id="totaldata">

<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/load.gif" />

		</td>
		<td style="width:200px;text-align:left;padding-left:8px;vertical-align:top;">
        区域:<br />
        <span id="menuDropDownBox"></span>	
		<input type="hidden" name="region_id" id="region_id" value="<?php echo $this->_tpl_vars['region_id']; ?>
" />
		<input type="hidden" name="region_p_id" id="region_p_id" value="<?php echo $this->_tpl_vars['region_p_id']; ?>
" />
        机构:<br />
        <select name="org_id" id="org_id">
        <option value="">-查询中-</option>
        </select>
        <br />      

         <input type="button" style="margin-top:20px;border: 1px solid #ccc;" value="查询" onclick="return checkForm();" /><br />

		 <input type="button" style="margin-top:20px;border: 1px solid #ccc;" name="print" id="print" value="打印" class="inputbutton" onclick="javascript:window.print();" />
        </form></td>
		</tr>
	</tbody>
</table>
</body>
</html>
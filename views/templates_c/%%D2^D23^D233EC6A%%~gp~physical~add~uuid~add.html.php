<?php /* Smarty version 2.6.14, created on 2013-11-05 14:21:54
         compiled from add.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>体格检查-基本检查</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/j.dimensions.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/organization.js"></script>
<style>
table
{

	background:#ffffff;
	border-color:#FF0000;
}
td{
	border:none;
	border-collapse:collapse;
}

hr{
    border-color:#000000;
	border:solid dotted;
   
}
.input_bottom_line{
	border-left-style:none;
	border-right-style:none;
	border-top-style:none;
	border-bottom:1px solid #000000;
	background:#FFFFFF;
	width:120px;
}
.input_none_line{
	border-left-style:none;
	border-right-style:none;
	border-top-style:none;
	border-bottom-style:none;
	background:#FFFFFF;
	width:120px;
}
.inputbutton{
	border: 1px solid blue;
	width:80px;
	background:#FFFFFF;
}
.text_title{
	text-align:center; 
	font-size:16px;
	 padding:6px;
	 font-weight:bold;
}
.text_align_center{
	text-align:center;
}
.text_align_right{
	text-align:right;	
}
.text_padding_left{
	 padding-left:60px;
}
.intable,.intable tr,.intable tr td{ border:0}

</style>
<script type="text/javascript">
	 $(function(){
		var bmi_height_obj=$("#height");//身高
		var bmi_weight_obj=$("#weight");//体重
		///身高失去光标
		bmi_height_obj.blur(function(){
		   var height_val= bmi_height_obj.val();//身高值
		   var weight_val= bmi_weight_obj.val();//体重值
		   if(height_val!="" && weight_val!=""){
		       if(isNaN(height_val) && isNaN(weight_val)){
			  		 
			   }else{
			   		var bmi=weight_val/(height_val*height_val*0.01*0.01);
			   		$("#bmi").val(bmi.toFixed(2));
			   }
		   }
		
		});
		//体重失去光标
		bmi_weight_obj.blur(function(){
		   var height_val= bmi_height_obj.val();//身高值
		   var weight_val= bmi_weight_obj.val();//体重值
		   if(height_val!="" && weight_val!=""){
		   	   if(isNaN(height_val) && isNaN(weight_val)){
			  		
			   }else{
			        var bmi=weight_val/(height_val*height_val*0.01*0.01);
			   		$("#bmi").val(bmi.toFixed(2));
			   }
		   }
		});
		
	});
	
</script>	
</head>
<body>
<div style=" text-align:center; background-color:#FFFFFF; margin-left:auto; margin-right:auto;">
  <form method="POST" action="<?php echo $this->_tpl_vars['basePath']; ?>
gp/physical/update">
  <input  type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
"/>
  <table class="intable" style="width:800px;">
  <tr><td  class="text_title">体格检查</td></tr>
  <tr><td><hr></td></tr>  
  <tr><td  class="text_title">基本检查</td></tr>
  <tr>
  	<td class="text_align_center">
 		患者姓名<input type="text"  class="input_bottom_line"   value="<?php echo $this->_tpl_vars['name']; ?>
" disabled="disabled"/>
 		性别<input type="text"  class="input_bottom_line"  style="width:51px;"  value="<?php echo $this->_tpl_vars['sex']; ?>
" disabled="disabled"/> 
  		年龄<input type="text" class="input_bottom_line" name="age" style="width:51px;"   value="<?php echo $this->_tpl_vars['age']; ?>
"/> 
 		档案编号<input type="text"  class="input_bottom_line"  style="width:260px;"  value="<?php echo $this->_tpl_vars['serial_num']; ?>
" disabled="disabled"/>  	</td>
  </tr>
  <tr>
  	<td  class="text_align_center">
  		家庭地址<input type="text"  class="input_bottom_line"  style="width:420px;"  value="<?php echo $this->_tpl_vars['faminy_add']; ?>
" disabled="disabled"/> 联系电话
  		<input type="text"  class="input_bottom_line"   value="<?php echo $this->_tpl_vars['telphone']; ?>
" disabled="disabled"/>  	</td>
  </tr>  
  <tr>
  	<td  class="text_align_center"><br/><br/>
        身高(cm)<input type="text"  class="input_bottom_line" style="width:180px;"    value="<?php echo $this->_tpl_vars['height']; ?>
"  name="height" id="height"/>
        体重(kg)<input type="text"  class="input_bottom_line" style="width:180px;"   value="<?php echo $this->_tpl_vars['weight']; ?>
" name="weight" id="weight"/>
        体重指数<input type="text"  class="input_none_line"  style="width:130px;"  value="<?php echo $this->_tpl_vars['bmi']; ?>
" name="bmi" id="bmi" readonly="readonly"/>
        
  	</td>
  </tr>  
  <tr>
 	 <td  class="text_align_center"><br/><br/>
       
        收缩压(mmHg)<input type="text"  class="input_bottom_line" style="width:240px;"    value="<?php echo $this->_tpl_vars['s_blood_pressure']; ?>
"  name="s_blood_pressure" id="s_blood_pressure"/>
        舒张压(mmHg)<input type="text"  class="input_bottom_line" style="width:240px;"   value="<?php echo $this->_tpl_vars['p_blood_pressure']; ?>
" name="p_blood_pressure" id="p_blood_pressure"/>
        <br/><br/>
 	 </td>
  </tr> 
   <tr>
 	 <td  class="text_align_left"><br/><br/>
       
        <span style=" padding-left:60px">空腹血糖(mmol/L)<input type="text"  class="input_bottom_line" style="width:240px;"    value="<?php echo $this->_tpl_vars['blood_sugar']; ?>
"  name="blood_sugar" id="blood_sugar"/></span>
        <br/><br/>
 	 </td>
  </tr> 
  <tr><td class="text_align_right">
  	医生（签字）:
 	<select name="doctors_signature" >
    <?php unset($this->_sections['experience']);
$this->_sections['experience']['loop'] = is_array($_loop=$this->_tpl_vars['region_users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <option value="<?php echo $this->_tpl_vars['region_users'][$this->_sections['experience']['index']]['user_id']; ?>
" <?php if ($this->_tpl_vars['doctors_signature'] == $this->_tpl_vars['region_users'][$this->_sections['experience']['index']]['user_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['region_users'][$this->_sections['experience']['index']]['name_real']; ?>
</option>
    <?php endfor; endif; ?>
    </select> 
  	</td></tr>
  <tr>
  	<td  class="text_align_right">
    检查时间:
    <input type="text"  class="input_bottom_line"    onfocus="WdatePicker({firstDayOfWeek:1})"  name="experience_time" value="<?php echo $this->_tpl_vars['experience_time']; ?>
"/>
    </td></tr>
   	<tr><td><hr/></td></tr>
    
    <tr><td  style="text-align:center"><input type="submit" id="submit" value=" 提交 " name="submit" class="inputbutton"/><?php if ($this->_tpl_vars['uuid'] != ""): ?>&nbsp;&nbsp;<input type="button" name="print" id="print" value="打印" onclick="javascript:window.print();" class="inputbutton"/><?php endif; ?></td></tr>
    </table>
    </form>
</div>


</body>
</html>
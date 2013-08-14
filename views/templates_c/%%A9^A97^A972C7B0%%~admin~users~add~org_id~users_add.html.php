<?php /* Smarty version 2.6.14, created on 2013-07-26 14:45:34
         compiled from users_add.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'users_add.html', 120, false),array('function', 'html_radios', 'users_add.html', 126, false),array('function', 'html_checkboxes', 'users_add.html', 144, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
 $(function(){
 	 //提交按钮单击事件
	 $("input[type='submit']").click( function () {
	 
	 	if($("#region_id").val()=="" && $("#org_id").val()==""){
		  alert("非法进入");
		  return false;
		}
	 	if($("#standard_code").val()==""){
			alert("国家标准档案号不能为空!");
			$("#standard_code").focus();
			return false;
		}
		if($("#name_login").val()==""){
			alert("工作人员登录名不能为空!");
			$("#name_login").focus();
			return false;
		
		}else{
						
		}
	 
	 
		if($("#passwd").val()!=$("#passwd_two").val()){
			alert("两次密码不一致!");
			$("#passwd").focus();
			return false;
		
		}
		//
		if($("#name_real").val()==""){
			alert("工作人员真实名字不能为空!");
			$("#name_real").focus();
			return false;
		
		}
		//角色
		if($("#role_id").val()==""){
			alert("工作人员角色不能为空将不能登录系统!");
			$("#role_id").focus();
			return false;
		
		}
		//验证身份证
		if($("#identity_card_number").val()!=""){
			var identity_card_number = $("#identity_card_number").val();//身份证号内容
			if(identity_card_number.match(/^[0-9]{14}(x|\d|[0-9]{4}|[0-9]{3}x)$/i)){
				
			}else{
				alert("身份证格式不对！");
				$("#identity_card_number").focus();
				return false;
			}
			
		
		}
		//出国留学月份
		if($("#study_abroad").val()!=""){
			if(IsNumber($("#study_abroad").val())===true){
				alert("出国留学月份只能是数字！");
				$("#study_abroad").focus();
				return false;
			}
			
		
		}
		
 	      //提交表单
 	     $("input[type='submit']").attr("disabled",true);
         $.post("<?php echo $this->_tpl_vars['basePath']; ?>
admin/users/update",$("#form1").serialize(),function (data) {
		 		//alert(data);	
				var msg=data.split("|");
				alert(msg[0]);
				$("#id").val(msg[1]);
			
				$("input[type='submit']").attr("disabled",false);
			});
		  return false;	
	 });		
	
 });

 //验证数字
 function IsNumber(num){
   if(num!=""){
		if(isNaN(num)){
			
		    return  true;
		}
   }
   return false;
 }

</script>
	<form name="form1" id="form1" method="post"/>
	<table cellspacing="0" style="100%">
    <thead>
    <tr >
	<th style="width:40%" colspan="3" align="left">当前机构:<font color="Red"><?php echo $this->_tpl_vars['org_name']; ?>
</font>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript::" onclick="javascript:history.go(-1);">返回</a></th>
	</tr>
	</thead>
    <tr  class="headbg">
	<th colspan="2">用户管理</th>
	</tr>
    
	<tr class="columnbg">
	<th ></th><input type="hidden" value="<?php echo $this->_tpl_vars['region_id']; ?>
" name="region_id" id="region_id"/><input type="hidden" value="<?php echo $this->_tpl_vars['org_id']; ?>
"  name="org_id" id="org_id"/><input type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" id='id' name='id'/><input type="hidden" value="<?php echo $this->_tpl_vars['user_type']; ?>
"  id="user_type" name="user_type"/><input type="hidden" name="region_path" value="<?php echo $this->_tpl_vars['region_path']; ?>
" id="region_path"/><th></th>
	</tr>	
	<tbody id=''>
      
      <tr><td  style="width:30%">国家标准档案号</td><td  style="width:70%"><input type="text" name="standard_code" id="standard_code" value="<?php echo $this->_tpl_vars['standard_code']; ?>
"/>*</td></tr>
	  <tr><td >工作人员登录名</td><td ><input type="text" name="name_login" id="name_login"  value="<?php echo $this->_tpl_vars['name_login']; ?>
"/>*</td></tr>
      <tr><td >工作人员密码</td><td ><input type="password" name="passwd" id="passwd"/>*</td></tr>
      <tr><td >再次输入密码</td><td ><input type="password" name="passwd_two" id="passwd_two"/>*</td></tr>
      <tr><td >真实姓名</td><td ><input type='text' name='name_real' id='name_real'   value="<?php echo $this->_tpl_vars['name_real']; ?>
" />*</td></tr>
      <tr><td>角色</td><td><select name='role_id' id='role_id' _note=''>
      <option></option>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['roles'],'selected' => $this->_tpl_vars['role_id']), $this);?>
 
</select>*</td></tr>
      <tr><td >科室ID</td><td ><select name='section_office_id' id='section_office_id' _note='科室ID|select|1=>预防保健科,2=>全科医疗科,3=>药房,4=>检验室,5=>X光室,6=>B超室,7=>心电图室,8=>消毒供应室,9=>信息资料室,10=>其它'>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['section_office_id_options'],'selected' => $this->_tpl_vars['section_office_id_current']), $this);?>
 
</select></td></tr>
      <tr><td >身份证号</td><td ><input type='text' name='identity_card_number' id='identity_card_number' value='<?php echo $this->_tpl_vars['identity_card_number']; ?>
' length='' _note='身份证号|text'/></td></tr>
      <tr><td >性别</td><td ><?php echo smarty_function_html_radios(array('name' => 'sex','options' => $this->_tpl_vars['sex_options'],'checked' => $this->_tpl_vars['sex_current'],'separator' => '','_note' => '性别|radio|1=>男,2=>女'), $this);?>
</td></tr>
      <tr><td >出生日期</td><td ><input type='text' name='date_of_birth' id='date_of_birth' value='<?php echo $this->_tpl_vars['date_of_birth']; ?>
' onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"   class="Wdate" /></td></tr>
      <tr><td >职称</td><td ><select name='title' id='title' _note='职称|select|1=>正高,2=>副高,3=>中级,4=>助理（师级）,5=>员（士）,6=>待聘'>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['title_options'],'selected' => $this->_tpl_vars['title_current']), $this);?>
 
</select></td></tr>
      <tr><td >职务</td><td ><input type='text' name='duty' id='duty' value='<?php echo $this->_tpl_vars['duty']; ?>
' length='' _note='职务|text'/></td></tr>
      <tr><td >学历</td><td ><select name='study_history' id='study_history' _note='学历|select|1=>无学历,2=>小学,3=>初中,4=>高中,5=>技校,6=>中专,7=>大专,8=>大学,9=>研究生'>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['study_history_options'],'selected' => $this->_tpl_vars['study_history_current']), $this);?>
 
</select></td></tr>
      <tr><td >学位</td><td ><select name='degrees' id='degrees' _note='学位|select|0=>无学位,1=>学士,2=>硕士,3=>博士'>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['degrees_options'],'selected' => $this->_tpl_vars['degrees_current']), $this);?>
 
</select></td></tr>
      <tr><td >毕业时间</td><td ><input type='text' name='graduate_date' id='graduate_date' value='<?php echo $this->_tpl_vars['graduate_date']; ?>
' length='' _note='毕业时间|text' onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"   class="Wdate" /></td></tr>
      <tr><td >毕业学校</td><td ><input type='text' name='graduate_school' id='graduate_school' value='<?php echo $this->_tpl_vars['graduate_school']; ?>
' length='' _note='毕业学校|text'/></td></tr>
      <tr><td >联系电话</td><td ><input type='text' name='telephone_number' id='telephone_number' value='<?php echo $this->_tpl_vars['telephone_number']; ?>
' length='' _note='联系电话|text'/></td></tr>
      <tr><td >居委会名称</td><td ><input type='text' name='family_address' id='family_address' value='<?php echo $this->_tpl_vars['family_address']; ?>
' length='' _note='居委会名称|text'/></td></tr>
      <tr><td >紧急联系人姓名</td><td ><input type='text' name='urgency_name' id='urgency_name' value='<?php echo $this->_tpl_vars['urgency_name']; ?>
' length='' _note='紧急联系人姓名|text'/></td></tr>
      <tr><td >紧急联系人电话</td><td ><input type='text' name='urgency_telephone_number' id='urgency_telephone_number' value='<?php echo $this->_tpl_vars['urgency_telephone_number']; ?>
' length='' _note='紧急联系人电话|text'/></td></tr>
      <tr><td >年内接受培训情况_可多选</td><td ><?php echo smarty_function_html_checkboxes(array('name' => 'continue_education','options' => $this->_tpl_vars['continue_education_options'],'checked' => $this->_tpl_vars['continue_education_current'],'separator' => '','_note' => '年内接受培训情况_可多选|checkbox|11=>住院医师培训已合格,12=>正接受住院医师培训,13=>接受继续医学教育≥25学分,14=>接受继续医学教育<25学分,15=>全科医学培训,20=>护理知识培,30=>疾病预防知识培训,40=>卫生监督知识培训,50=>院前急救培训,60=>管理知识培训,70=>计算机培训,80=>其他岗位培训,90=>进修半年以上'), $this);?>
 </td></tr>
      <tr><td >所学专业名称</td><td ><select name='specialty_name' id='specialty_name' _note='所学专业名称|select|101=>基础医学,102=>预防医学,1031=>临床医学,1032=>医学技术,104=>口腔医学,105=>中医学,106=>法医学,107=>护理学,108=>药学,109=>卫生管理,01=>哲学,02=>经济学,03=>法学,04=>教育学,05=>文学,6=>历史学,07=>理学,08=>工学,09=>农学'>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['specialty_name_options'],'selected' => $this->_tpl_vars['specialty_name_current']), $this);?>
 
</select></td></tr>
      <tr><td >出国留学学习时间（月数）</td><td ><input type='text' name='study_abroad' id='study_abroad' value='<?php echo $this->_tpl_vars['study_abroad']; ?>
' length='' _note='出国留学学习时间（月数）|text'  onblur="IsNumber(this.value);"/></td></tr>
      <tr><td >人员流动情况</td><td ><select name='mobility' id='mobility' _note='本月人员流动情况流入|select|11=>高中等院校毕业生,12=>其他卫生机构调入,13=>非卫生机构调入,14=>军转人员,19=>其他,21=>流出:调往其他卫生机构,22=>考取研究生,23=>出国留学,24=>退休,25=>辞职(辞退),26=>自然减员,29=>其他'>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['mobility_options'],'selected' => $this->_tpl_vars['mobility_current']), $this);?>
 
</select>时间<input type='text' name='mobility_date' id='join_job_data' value='<?php echo $this->_tpl_vars['mobility_date']; ?>
' length='' _note='参加工作日期|text' onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"   class="Wdate" /></td></tr>
      <tr><td >是否本单位返聘人员</td><td ><?php echo smarty_function_html_radios(array('name' => 'reengage','options' => $this->_tpl_vars['reengage_options'],'checked' => $this->_tpl_vars['reengage_current'],'separator' => '','_note' => '是否本单位返聘人员|radio|Y=>是,N=>否'), $this);?>
</td></tr>
      <tr><td >编制</td><td ><select name='organizer' id='organizer' _note='编制|select|1=>在编,2=>非在编'>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['organizer_options'],'selected' => $this->_tpl_vars['organizer_current']), $this);?>
 
</select></td></tr>
      <tr><td >工种</td><td ><select name='type_of_work' id='type_of_work' _note='工种|select|1=>卫生技术人员,2=>其他技术人员,3=>管理人员,4=>工勤技能人员'>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['type_of_work_options'],'selected' => $this->_tpl_vars['type_of_work_current']), $this);?>
 
</select></td></tr>
      <tr><td >行政/业务管理职务代码 (要求科室副主任及以上人员填写)</td><td ><select name='manage_rank' id='manage_rank' _note='行政/业务管理职务代码 (要求科室副主任及以上人员填写)|select|1=>党委(副)书记,2=>院(所.站)长,3=>副院(所.站)长,4=>科室主任,5=>科室副主任'>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['manage_rank_options'],'selected' => $this->_tpl_vars['manage_rank_current']), $this);?>
 
</select></td></tr>
      <tr><td >从事专业类别代码</td><td ><select name='specialty_code' id='specialty_code' _note='从事专业类别代码|select|11=>执业医师,12=>执业助理医师,13=>见习医师,21=>注册护士,22=>助产士,31=>西药师(士),32=>中药师(士),41=>检验技师(士),42=>影像技师(士),50=>卫生监督员,69=>其他卫生技术人员,70=>其他技术人员,80=>管理人员,90=>工勤及技能人员'>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['specialty_code_options'],'selected' => $this->_tpl_vars['specialty_code_current']), $this);?>
 
</select></td></tr>
      <tr><td >医师执业类别代码</td><td ><select name='physician_certified_type' id='physician_certified_type' _note='医师执业类别代码|select|1=>临床,2=>口腔,3=>公共卫生,4=>中医'>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['physician_certified_type_options'],'selected' => $this->_tpl_vars['physician_certified_type_current']), $this);?>
 
</select></td></tr>
      <tr><td >医师执业范围代码</td><td ><select name='physician_certified_rang' id='physician_certified_rang' _note='医师执业范围代码|select|11=>内科专业,12=>外科专业,13=>妇产科专业,14=>儿科专业,15=>眼耳鼻咽喉科专业,16=>皮肤病与性病专业,17=>精神卫生专业,18=>职业病专业,19=>医学影像和放射治疗专业,20=>医学检验..病理专业,21=>全科医学专业,22=>急救医学专业,23=>康复医学专业,24=>预防保健专业,25=>特种医学与军事医学专业,26=>计划生育技术服务专业,31=>口腔科专业,41=>公共卫生类别专业,51=>中医专业,52=>中西医结合专业,53=>蒙医专业,54=>藏医专业,55=>维医专业,56=>傣医专业,57=>省级卫生行政部门规定的其他专业'>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['physician_certified_rang_options'],'selected' => $this->_tpl_vars['physician_certified_rang_current']), $this);?>
 
</select></td></tr>
      <tr><td >是否中医见习医师</td><td ><?php echo smarty_function_html_options(array('name' => 'herbalist_noviciate_doctor','options' => $this->_tpl_vars['herbalist_noviciate_doctor_options'],'checked' => $this->_tpl_vars['herbalist_noviciate_doctor_current'],'separator' => '<br />','_note' => '是否中医见习医师|radio|1=>是,2=>否'), $this);?>
</td></tr>
      <tr><td >参加工作日期</td><td ><input type='text' name='join_job_data' id='join_job_data' value='<?php echo $this->_tpl_vars['join_job_data']; ?>
' length='' _note='参加工作日期|text' onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"   class="Wdate" /></td></tr>
      <tr><td >办公室电话号码</td><td ><input type='text' name='office_telephone_number' id='office_telephone_number' value='<?php echo $this->_tpl_vars['office_telephone_number']; ?>
' length='' _note='办公室电话号码|text'/></td></tr>
      <tr><td >手机号码(机构负责人及应急救治专家填写)</td><td ><input type='text' name='mobile_telephone_number' id='mobile_telephone_number' value='<?php echo $this->_tpl_vars['mobile_telephone_number']; ?>
' length='' _note='手机号码(机构负责人及应急救治专家填写)|text'/></td></tr>
	</tbody>
 
    <tr  class="columnbg">
		<td  colspan="2" style=" text-align:center;"><input type="submit" value=" 提交 "/> <input type="reset" value=" 重填 "/><input type="button"  onclick="javascript:history.go(-1);" value=" 返回 "/></td>
	</tr>
	</table>
	</form>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
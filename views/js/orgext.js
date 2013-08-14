//床位信息表单检测
function  checksubbed(){
	var bednumber            = document.getElementById('bednumber');
	var bed_allnumber        = document.getElementById('bed_allnumber');
	var poverty_beds         = document.getElementById('poverty_beds');
	var totalbed_days        = document.getElementById('totalbed_days');
	var occupied_bed         = document.getElementById('occupied_bed');
	var poverty_occupiedbed  = document.getElementById('poverty_occupiedbed');
	var tbo_total            = document.getElementById('tbo_total');
	var observation_bed      = document.getElementById('observation_bed');
	var family_beds          = document.getElementById('family_beds');
	if(isNaN(bednumber.value)){
		window.alert("请输入数字");
		bednumber.value = "";
		bednumber.focus();
		return false;
	}
	if(isNaN(bed_allnumber.value)){
		window.alert("请输入数字");
		bed_allnumber.value = "";
		bed_allnumber.focus();
		return false;
	}
	if(isNaN(poverty_beds.value)){
		window.alert("请输入数字");
		poverty_beds.value = "";
		poverty_beds.focus();
		return false;
	}
	if(totalbed_days.value==""){
		window.alert("请输入实际开放总床日 数");
		totalbed_days.focus();
		return false;
	}
	if(isNaN(totalbed_days.value)){
		window.alert("请输入数字");
		totalbed_days.value = "";
		totalbed_days.focus();
		return false;
	}
	if(occupied_bed.value==""){
		window.alert("请输入实际占用床日数的总数");
		occupied_bed.value = "";
		occupied_bed.focus();
		return false;
	}
	if(isNaN(occupied_bed.value)){
		window.alert("请输入内容");
		occupied_bed.value = "";
		occupied_bed.focus();
		return false;
	}
	if(isNaN(poverty_occupiedbed.value)){
		window.alert("请输入数字");
		poverty_occupiedbed.value = "";
		poverty_occupiedbed.focus();
		return false;
	}
	if(isNaN(tbo_total.value)){
		window.alert("请输入数字");
		tbo_total.value = "";
		tbo_total.focus();
		return false;
	}
	if(isNaN(observation_bed.value)){
		window.alert("请输入数字");
		observation_bed.value = "";
		observation_bed.focus();
		return false;
	}
	if(isNaN(family_beds.value)){
		window.alert("请输入数字");
		family_beds.value = "";
		family_beds.focus();
		return false;
	}
} 
//控制床位信息中的输入和百分比
function getjsup(){
	var totalbed_days        = document.getElementById('totalbed_days');
	var occupied_bed         = document.getElementById('occupied_bed');
	var zhuzi                = document.getElementById('zhuzi');
	var zhuzi1               = document.getElementById('zhuzi1');
	var poverty_occupiedbed  = document.getElementById('poverty_occupiedbed');
	var percentage           = document.getElementById('percentage');
	if(occupied_bed.value!==""&&totalbed_days.value!==""){
		if(parseInt(totalbed_days.value,10)>parseInt(occupied_bed.value,10)){
			window.alert("实际开放总床日数 不应该大于实际占用床日数的总数！");
			totalbed_days.value = "";
			totalbed_days.focus();
			return false;
		}
		zhuzi.style.width = "300px";
		zhuzi.style.border = "2px solid blue";
		zhuzi.style.height = "18px";
		zhuzi1.style.width = (300*totalbed_days.value)/occupied_bed.value+"px";
		zhuzi1.style.height = "18px";
		zhuzi1.style.background = "#3366cc";
		zhuzi1.align="center";
		zhuzi1.innerHTML = (parseInt(totalbed_days.value,10)/parseInt(occupied_bed.value,10)*100).toFixed(2)+"%";
		percentage.value = (parseInt(totalbed_days.value,10)/parseInt(occupied_bed.value,10)*100).toFixed(2)+"%";
	}
	}
function getjs(){
	var totalbed_days        = document.getElementById('totalbed_days');
	var occupied_bed         = document.getElementById('occupied_bed');
	var zhuzi                = document.getElementById('zhuzi');
	var zhuzi1               = document.getElementById('zhuzi1');
	var poverty_occupiedbed  = document.getElementById('poverty_occupiedbed');
	var percentage           = document.getElementById('percentage');
	if(occupied_bed.value!==""&&totalbed_days.value!==""){
		if(parseInt(totalbed_days.value,10)>parseInt(occupied_bed.value,10)){
			window.alert("实际开放总床日数 不应该大于实际占用床日数的总数！");
			totalbed_days.value = "";
			totalbed_days.focus();
			return false;
		}
		zhuzi.style.width   = "300px";
		zhuzi.style.border  = "2px solid blue";
		zhuzi.style.height  = "18px";
		zhuzi1.style.width  = (300*totalbed_days.value)/occupied_bed.value+"px";
		zhuzi1.style.height = "18px";
		zhuzi1.style.background = "#3366cc";
		zhuzi1.align="center";
		zhuzi1.innerHTML    = (parseInt(totalbed_days.value,10)/parseInt(occupied_bed.value,10)*100).toFixed(2)+"%";
		percentage.value    = (parseInt(totalbed_days.value,10)/parseInt(occupied_bed.value,10)*100).toFixed(2)+"%";
	}
	var total_income               = document.getElementById('total_income');//总共的收入合计
	var total_income_text          = document.getElementById('total_income_text');//总共的收入合计显示
	var finance_income             = document.getElementById('finance_income');//财政补助收入
	var superior_income            = document.getElementById('superior_income');//上级补助收入
	var medical_income_text        = document.getElementById('medical_income_text');//医疗收入合计显示
	var medical_income             = document.getElementById('medical_income');//医疗收入合计
	var medical_outpatient_income  = document.getElementById('medical_outpatient_income');//医疗门诊收入
	var medical_hospital_income    = document.getElementById('medical_hospital_income');//医疗住院收入
	var drug_income_text           = document.getElementById('drug_income_text');//药品收入合计显示
	var drug_income                = document.getElementById('drug_income');//药品收入合计
	var drug_outpatient_income     = document.getElementById('drug_outpatient_income');//药品门诊收入
	var drug_hospital_income       = document.getElementById('drug_hospital_income');//医疗住院收入
	var drug_other_income          = document.getElementById('drug_other_income');//其他收入
	var fval  = parseInt(finance_income.value);
	var sval  = parseInt(superior_income.value);
	var mval  = parseInt(medical_outpatient_income.value);
	var mhval = parseInt(medical_hospital_income.value);
	var dval  = parseInt(drug_outpatient_income.value);
	var dhval = parseInt(drug_hospital_income.value);
	var doval = parseInt(drug_other_income.value);
	if(isNaN(fval)){
		fval = 0;
		finance_income.value = 0;
	}
	if(isNaN(sval)){
		sval = 0;
		superior_income.value = 0;
	}
	if(isNaN(mval)){
		mval = 0;
		medical_outpatient_income.value = 0;
	}
	if(isNaN(mhval)){
		mhval = 0;
		medical_hospital_income.value =0;
	}
	if(isNaN(dval)){
		dval = 0;
		drug_outpatient_income.value = 0;
	}
	if(isNaN(dhval)){
		dhval = 0;
		drug_hospital_income.value = 0;
	}
	if(isNaN(doval)){
		doval = 0;
		drug_other_income.value = 0;
	}
	//alert(fval);
	total_income_text.innerHTML= fval+sval+mval+mhval+dval+dhval+doval;
	medical_income_text.innerHTML = mval+mhval;
	drug_income_text.innerHTML    = dval+dhval;
	total_income.value            = fval+sval+mval+mhval+dval+dhval+doval;
	medical_income.value          = mval+mhval;
	drug_income.value             = dval+dhval;
	//支出
	var total_payout_text = document.getElementById('total_payout_text');//支出合计显示
	var total_payout      = document.getElementById('total_payout');//支出合计
	var medical_payout    = document.getElementById('medical_payout');//医疗支出
	var drug_payout       = document.getElementById('drug_payout');//药品支出
	var drug_fee_payout   = document.getElementById('drug_fee_payout');//药品费
	var finance_payout    = document.getElementById('finance_payout');//财政专项支出
	var other_payout      = document.getElementById('other_payout');//其他支出
	var hr_payout         = document.getElementById('hr_payout');//总支出中：人员支出
	var retire_payout     = document.getElementById('retire_payout');//总支出中：离退休费
	var mpayval           = parseInt(medical_payout.value);
	var dpayval           = parseInt(drug_payout.value);
	var dfeeval           = parseInt(drug_fee_payout.value);
	var finval            = parseInt(finance_payout.value);
	var opayval           = parseInt(other_payout.value);
	var hrval             = parseInt(hr_payout.value);
	var reval             = parseInt(retire_payout.value);
	if(isNaN(mpayval)){
		mpayval = 0;
		medical_payout.value = 0;
	}
	if(isNaN(dpayval)){
		dpayval = 0;
		drug_payout.value = 0;
	}
	if(isNaN(dfeeval)){
		dfeeval = 0;
		drug_fee_payout.value = 0;
	}
	if(isNaN(finval)){
		finval = 0;
		finance_payout.value = 0;
	}
	if(isNaN(opayval)){
		opayval = 0;
		other_payout.value = 0;
	}
	if(isNaN(hrval)){
		hrval = 0;
		hr_payout.value =0 ;
	}
	if(isNaN(reval)){
		reval = 0;
		retire_payout.value = 0;
	}
	total_payout_text.innerHTML=mpayval+dpayval+dfeeval+finval+opayval+hrval+reval;
	total_payout.value = mpayval+dpayval+dfeeval+finval+opayval+hrval+reval;
	var total_assets_text    = document.getElementById('total_assets_text');
	var total_assets         = document.getElementById('total_assets');
	var current_assets       = document.getElementById('current_assets');
	var investnew            = document.getElementById('invests');
	var capital_asserts      = document.getElementById('capital_asserts');
	var immateriality_assets = document.getElementById('immateriality_assets');
	var caa                  = parseInt(current_assets.value);
	var inva                 = parseInt(investnew.value);
	var caav                 = parseInt(capital_asserts.value);
	var ima                  = parseInt(immateriality_assets.value);
	if(isNaN(inva)){
		inva = 0;
		current_assets.value = 0;
	}
	if(isNaN(caa)){
		caa = 0;
		investnew.value = 0;
	}
	if(isNaN(caav)){
		caav = 0;
		capital_asserts.value = 0;
	}
	if(isNaN(ima)){
		ima = 0;
		immateriality_assets.value =0 ;
	}
	total_assets_text.innerHTML = caa+inva+caav+ima;
	total_assets.value          = caa+inva+caav+ima;
}
function checkbednum(){
	var bed_allnumber = document.getElementById('bed_allnumber');
	var poverty_beds  = document.getElementById('poverty_beds');
	if(parseInt(poverty_beds.value)>parseInt(bed_allnumber.value)){
		window.alert("实有床位数的扶贫床位不应该大于实有床位数的总数!");
		poverty_beds.value="";
		poverty_beds.focus();
		return false;
	}
}
function checkbedrealnu(){
	var occupied_bed         = document.getElementById('occupied_bed');
	var poverty_occupiedbed  = document.getElementById('poverty_occupiedbed');
	if(parseInt(poverty_occupiedbed.value)>parseInt(occupied_bed.value)){
		window.alert("实际扶贫床位占用床日数不应该大于实际占用床日数的总数!");
		poverty_occupiedbed.value="";
		poverty_occupiedbed.focus();
		return false;
	}
}
//房屋与建筑信息表单 输入内容的控制
function checkhire(){
	var hire_area           = document.getElementById('hire_area');
	var hire_operation_area = document.getElementById('hire_operation_area');
	var hire                = document.getElementById('hire');
	var area	            = document.getElementById('area'); //房屋建筑面积
	var operation_area	    = document.getElementById('operation_area'); //业务用房面积
	var peril	            = document.getElementById('peril_area'); //危房面积
	var actual_invest	= document.getElementById('actual_invest'); //本年实际完成投资额
	var finance_invest	= document.getElementById('finance_invest'); //财政性投资
	var self_invest	    = document.getElementById('self_invest'); //单位自有资金
	var bank_invest	    = document.getElementById('bank_invest'); //银行贷款
	var buildsave	        = document.getElementById('buildsave'); //保存按钮
	var msg	= document.getElementById('msg'); //消息显示框
	var invest          = document.getElementById('invest');
	if(parseInt(area.value)<parseInt(operation_area.value)||parseInt(area.value)<parseInt(peril.value)||parseInt(area.value)<parseInt(hire_area.value))
	{
		msg.innerHTML='<font color="red">房屋建筑面积必须大于等于业务用房面积、危房面积、租房面积</font>';
		buildsave.disabled = true;
		return false;
	 }else if(parseInt(hire_area.value)<parseInt(hire_operation_area.value)){
		hire.innerHTML='<font color="red">租房总面积必须大于等于租房业务用房面积</font>';
		buildsave.disabled = true;
		return false;
	}else if(parseInt(actual_invest.value)<(parseInt(finance_invest.value)+parseInt(self_invest.value)+parseInt(bank_invest.value)))
		{
			invest.innerHTML='<font color="red">本年实际完成投资总额必须>财政性投资+单位自由资金+银行贷款,数据才有效</font>';
			buildsave.disabled = true;
			return false;
		}
	 else{
		hire.innerHTML='';
		msg.innerHTML='';
		invest.innerHTML='';
		buildsave.disabled = false;
		return true;
	}
}
//设备信息
function checkequipment(){
	var equipment_total_number           = document.getElementById('equipment_total_number');
	var total_50_to_100_equipment_number = document.getElementById('total_50_to_100_equipment_number');
	var total_over_100_equipment_number  = document.getElementById('total_over_100_equipment_number');
	var equipmentsave	                 = document.getElementById('equipmentsave'); //保存按钮
	var equipmentmsg                     = document.getElementById('equipmentmsg');//信息显示
	if(parseInt(equipment_total_number.value)<parseInt(total_50_to_100_equipment_number.value)+parseInt(total_over_100_equipment_number.value)){
		equipmentmsg.innerHTML='<font color="red">万元以上设备总台数必须>=50-100万元设备数+100万元以上设备数</font>';
		equipmentsave.disabled = true;
        this.focus();
		return false;
	}else{
		equipmentmsg.innerHTML='';
		equipmentsave.disabled = false;
		return true;
	}
}
//收入和支出
function checkin(){
	var total_income               = document.getElementById('total_income');//总共的收入合计
	var total_income_text          = document.getElementById('total_income_text');//总共的收入合计显示
	var finance_income             = document.getElementById('finance_income');//财政补助收入
	var superior_income            = document.getElementById('superior_income');//上级补助收入
	var medical_income_text        = document.getElementById('medical_income_text');//医疗收入合计显示
	var medical_income             = document.getElementById('medical_income');//医疗收入合计
	var medical_outpatient_income  = document.getElementById('medical_outpatient_income');//医疗门诊收入
	var medical_hospital_income    = document.getElementById('medical_hospital_income');//医疗住院收入
	var drug_income_text           = document.getElementById('drug_income_text');//药品收入合计显示
	var drug_income                = document.getElementById('drug_income');//药品收入合计
	var drug_outpatient_income     = document.getElementById('drug_outpatient_income');//药品门诊收入
	var drug_hospital_income       = document.getElementById('drug_hospital_income');//医疗住院收入
	var drug_other_income          = document.getElementById('drug_other_income');//其他收入
	var fval  = parseInt(finance_income.value);
	var sval  = parseInt(superior_income.value);
	var mval  = parseInt(medical_outpatient_income.value);
	var mhval = parseInt(medical_hospital_income.value);
	var dval  = parseInt(drug_outpatient_income.value);
	var dhval = parseInt(drug_hospital_income.value);
	var doval = parseInt(drug_other_income.value);
	if(isNaN(fval)){
		fval = 0;
	}
	if(isNaN(sval)){
		sval = 0;
	}
	if(isNaN(mval)){
		mval = 0;
	}
	if(isNaN(mhval)){
		mhval = 0;
	}
	if(isNaN(dval)){
		dval = 0;
	}
	if(isNaN(dhval)){
		dhval = 0;
	}
	if(isNaN(doval)){
		doval = 0;
	}
	//alert(fval);
	total_income_text.innerHTML   = fval+sval+mval+mhval+dval+dhval+doval;
	medical_income_text.innerHTML = mval+mhval;
	drug_income_text.innerHTML    = dval+dhval;
	total_income.value            = fval+sval+mval+mhval+dval+dhval+doval;
	medical_income.value          = mval+mhval;
	drug_income.value             = dval+dhval;
}
function checkout(){
	var total_payout_text = document.getElementById('total_payout_text');//支出合计显示
	var total_payout      = document.getElementById('total_payout');//支出合计
	var medical_payout    = document.getElementById('medical_payout');//医疗支出
	var drug_payout       = document.getElementById('drug_payout');//药品支出
	var drug_fee_payout   = document.getElementById('drug_fee_payout');//药品费
	var finance_payout    = document.getElementById('finance_payout');//财政专项支出
	var other_payout      = document.getElementById('other_payout');//其他支出
	var hr_payout         = document.getElementById('hr_payout');//总支出中：人员支出
	var retire_payout     = document.getElementById('retire_payout');//总支出中：离退休费
	var mpayval           = parseInt(medical_payout.value);
	var dpayval           = parseInt(drug_payout.value);
	var dfeeval           = parseInt(drug_fee_payout.value);
	var finval            = parseInt(finance_payout.value);
	var opayval           = parseInt(other_payout.value);
	var hrval             = parseInt(hr_payout.value);
	var reval             = parseInt(retire_payout.value);
	if(isNaN(mpayval)){
		mpayval = 0;
	}
	if(isNaN(dpayval)){
		dpayval = 0;
	}
	if(isNaN(dfeeval)){
		dfeeval = 0;
	}
	if(isNaN(finval)){
		finval = 0;
	}
	if(isNaN(opayval)){
		opayval = 0;
	}
	if(isNaN(hrval)){
		hrval = 0;
	}
	if(isNaN(reval)){
		reval = 0;
	}
	total_payout_text.innerHTML=mpayval+dpayval+dfeeval+finval+opayval+hrval+reval;
	total_payout.value = mpayval+dpayval+dfeeval+finval+opayval+hrval+reval;
}
//资产与负债
function checkassets(){
	var total_assets_text    = document.getElementById('total_assets_text');
	var total_assets         = document.getElementById('total_assets');
	var current_assets       = document.getElementById('current_assets');
	var investnew            = document.getElementById('invests');
	var capital_asserts      = document.getElementById('capital_asserts');
	var immateriality_assets = document.getElementById('immateriality_assets');
	var caa                  = parseInt(current_assets.value);
	var inva                 = parseInt(investnew.value);
	var caav                 = parseInt(capital_asserts.value);
	var ima                  = parseInt(immateriality_assets.value);
	if(isNaN(inva)){
		inva = 0;
	}
	if(isNaN(caa)){
		caa = 0;
	}
	if(isNaN(caav)){
		caav = 0;
	}
	if(isNaN(ima)){
		ima = 0;
	}
	total_assets_text.innerHTML = caa+inva+caav+ima;
	total_assets.value          = caa+inva+caav+ima;
}
function checkcashnow(){
	var owes_assets = document.getElementById('owes_assets');
	var long_standing_assets = document.getElementById('long_standing_assets');
	var owes_assets_msg = document.getElementById('owes_assets_msg');
	var assetsave = document.getElementById('assetsave');
	var net_assets = document.getElementById('net_assets');
	var project_assets = document.getElementById('project_assets');
	var fixed_assets  = document.getElementById('fixed_assets');
	var special_assets = document.getElementById('special_assets');
	var msgnew      = document.getElementById('msgshow');
	var pa = parseInt(project_assets.value);
	var na = parseInt(net_assets.value);
	var fa = parseInt(fixed_assets.value);
	var sa = parseInt(special_assets.value);
	if(isNaN(pa)){
		pa = 0;
	}
	if(isNaN(na)){
		na = 0;
	}
	if(isNaN(fa)){
		fa = 0;
	}
	if(isNaN(sa)){
		sa = 0;
	}
	if(parseInt(long_standing_assets.value)<parseInt(owes_assets.value)){
		owes_assets_msg.innerHTML='<font color="red">负债合计必须>=长期负债</font>';
		assetsave.disabled = true;
		return false;
	}else if(na<pa+fa+sa){
		msgnew.innerHTML = '<font color="red">净资产合计必须>=事业基金+固定基金+专用基金</font>';
		assetsave.disabled = true;
		return false;
	}else{
		owes_assets_msg.innerHTML='';
		msgnew.innerHTML = '';
		assetsave.disabled = false;
		return true;
	}
}
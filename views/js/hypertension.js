//计算bmi值
function cal_bmi()
{
    var height=$("input[name='height']").val();
    var weight=$("input[name='weight_begin']").val();
    height=parseInt(height)/100;
    weight=parseInt(weight);
    if(!isNaN(height) && !isNaN(weight) && height!=0)
    {
        var bmi=weight/(height*height);
        bmi=bmi.toFixed(3);
        $("input[name='body_mass_index']").val(bmi);
    }
    else
    {
        $("input[name='body_mass_index']").val('0');
    }
}

//计算双侧血压相差值

function cal_blood()
{
    var blood_pressure;//收缩压
    var diastolic_blood_pressure;//舒张压
    blood_pressure=parseInt($("input[name='blood_pressure']").val()?$("input[name='blood_pressure']").val():0);
    diastolic_blood_pressure=parseInt($("input[name='diastolic_blood_pressure']").val()?$("input[name='diastolic_blood_pressure']").val():0);
    if(!isNaN(blood_pressure) && !isNaN(blood_pressure))
    {
        var result;
        result=blood_pressure-diastolic_blood_pressure;
        result=isNaN(result)?0:Math.abs(result);
        $("#blood").html(result);
        if(result>=20)
        {
            $("#blood").css("color","red");
        }
        else
        {
            $("#blood").css("color","green");
        }
    }
}
//点击血压标签给血压赋初始值
function blood_press(obj)
{
    if($(obj).html()!="")
    {
        var temp;
        temp=$(obj).html().split("/");
        $("input[name='blood_pressure']").val(temp[0]);
        $("input[name='diastolic_blood_pressure']").val(temp[1]);
        cal_blood();//触发计算血压差值函数
    }
}
//给身高、体重赋值
function lable_press(obj,inputname)
{
    if($(obj).html()!="")
    {
        var temp;
        temp=$(obj).html();
        $("input[name='"+inputname+"']").val(temp);
        cal_bmi();//触发bmi计算
    }
}
//根据指定的天数计算日期
function getDate(days,show_type,nowtime)
{
	var now=new Date(nowtime*1000);
	if(days>=1)
	{
		now=new Date(now.getTime()+86400000*days);
	}
	var yyyy=now.getFullYear(),mm=(now.getMonth()+1).toString(),dd=now.getDate().toString();
	if(mm.length==1)
	{
		mm='0'+mm;
	}
	if(dd.length==1)
	{
		dd='0'+dd;
	}
	var week;
	if(now.getDay()==0)
	{
		week="星期日";
	}
	if(now.getDay()==1)
	{
		week="星期一";
	}
	if(now.getDay()==2)
	{
		week="星期二";
	}
	if(now.getDay()==3)
	{
		week="星期三";
	}
	if(now.getDay()==4)
	{
		week="星期四";
	}
	if(now.getDay()==5)
	{
		week="星期五";
	}
	if(now.getDay()==6)
	{
		week="星期六";
	}
    if(show_type==1)
    {
       return (yyyy+'年'+mm+'月'+dd+'日'+week); 
    }
	else
    {
        return (yyyy+'-'+mm+'-'+dd);
    }
}
//取得随访逻辑
function get_follow_result(turl)
{
    $.ajax({
		type:"POST",
		url:turl,
		dataType:"html",
		data:$("form[name='frm']").serialize(),
		beforeSend:function(){
                $("input[type='submit']").attr("disabled","disabled");
				},
		success:function(data){
			var res=String($.trim(data));
            var res_array=res.split('|');
            var result_content;
            switch(res_array[0])
            {
                case "nothing":
                {
                    $("input[type='button']").attr("disabled","");
                    $("input[type='submit']").attr("disabled","");
                    return false; 
                }
                case "1":
                {
                    result_content="您存在可疑危险因素，需要立即转诊，1周内随访";
                    $("textarea[name='follow_result']").html(result_content);
                    $("input[name='follow_next_time']").val(getDate(7,0,res_array[1]));
                    $("#week").html(getDate(7,1,res_array[1]));
                    $("input[type='submit']").val("保存->健康教育->转诊");
                    $("input[type='submit']").css("width","150px");
                    $("input[type='submit']").attr("disabled","");
                    $("#refer").val("he/index/add|gp/transout/add");
                    return false; 
                }
                case "2":
                {
                    result_content="既往无高血压。近期首次出现血压高于正常值，3天后复查";
                    $("textarea[name='follow_result']").html(result_content);
                    $("input[name='follow_next_time']").val(getDate(3,0,res_array[1]));
                    $("#week").html(getDate(3,1,res_array[1]));
                    $("input[type='submit']").val("保存->健康教育");
                    $("input[type='submit']").css("width","120px");
                    $("input[type='submit']").attr("disabled","");
                    $("#refer").val("he/index/add");
                    return false; 
                }
                case "3":
                {
                    result_content="既往无高血压。之前三天内连续第2次血压高于正常，转诊至上级医院，2周内随访";
                    $("textarea[name='follow_result']").html(result_content);
                    $("input[name='follow_next_time']").val(getDate(14,0,res_array[1]));
                    $("#week").html(getDate(14,1,res_array[1]));
                    $("input[type='submit']").val("保存->健康教育->转诊");
                    $("input[type='submit']").css("width","150px");
                    $("input[type='submit']").attr("disabled","");
                    $("#refer").val("he/index/add|gp/transout/add");
                    return false; 
                }
                case "4":
                {
                    result_content="既往无高血压。血压控制满意，3个月后随访";
                    $("textarea[name='follow_result']").html(result_content);
                    $("input[name='follow_next_time']").val(getDate(90,0,res_array[1]));
                    $("#week").html(getDate(90,1,res_array[1]));
                    $("input[type='submit']").val("保存->健康教育");
                    $("input[type='submit']").css("width","120px");
                    $("input[type='submit']").attr("disabled","");
                    $("#refer").val("he/index/add");
                    return false; 
                }
                case "5":
                {
                    result_content="既往无高血压。血压控制满意，1年后随访";
                    $("textarea[name='follow_result']").html(result_content);
                    $("input[name='follow_next_time']").val(getDate(365,0,res_array[1]));
                    $("#week").html(getDate(365,1,res_array[1]));
                    $("input[type='submit']").val("保存->健康教育");
                    $("input[type='submit']").css("width","120px");
                    $("input[type='submit']").attr("disabled","");
                    $("#refer").val("he/index/add");
                    return false; 
                }
                case "6":
                {
                    result_content="既往无高血压。血压控制很好，1年后随访";
                    $("textarea[name='follow_result']").html(result_content);
                    $("input[name='follow_next_time']").val(getDate(365,0,res_array[1]));
                    $("#week").html(getDate(365,1,res_array[1]));
                    $("input[type='submit']").val("保存->健康教育");
                    $("input[type='submit']").css("width","120px");
                    $("input[type='submit']").attr("disabled","");
                    $("#refer").val("he/index/add");
                    return false; 
                }
                case "7":
                {
                    result_content="有高血压病史。血压控制满意，无其他异常。维持目前治疗，3个月后随访";
                    $("textarea[name='follow_result']").html(result_content);
                    $("input[name='follow_next_time']").val(getDate(90,0,res_array[1]));
                    $("#week").html(getDate(90,1,res_array[1]));
                    $("input[type='submit']").val("保存->健康教育");
                    $("input[type='submit']").css("width","120px");
                    $("input[type='submit']").attr("disabled","");
                    $("#refer").val("he/index/add");
                    return false; 
                }
                case "8":
                {
                    result_content="有高血压病史。血压控制满意，有药物不良反应。建议维持目前治疗，2周后随访";
                    $("textarea[name='follow_result']").html(result_content);
                    $("input[name='follow_next_time']").val(getDate(14,0,res_array[1]));
                    $("#week").html(getDate(14,1,res_array[1]));
                    $("input[type='submit']").val("保存->健康教育");
                    $("input[type='submit']").css("width","120px");
                    $("input[type='submit']").attr("disabled","");
                    $("#refer").val("he/index/add");
                    return false; 
                }
                case "9":
                {
                    result_content="有高血压病史。本次血压控制不满意，无其他异常。查找原因，2周后随访。";
                    $("textarea[name='follow_result']").html(result_content);
                    $("input[name='follow_next_time']").val(getDate(14,0,res_array[1]));
                    $("#week").html(getDate(14,1,res_array[1]));
                    $("input[type='submit']").val("保存->健康教育");
                    $("input[type='submit']").css("width","120px");
                    $("input[type='submit']").attr("disabled","");
                    $("#refer").val("he/index/add");
                    return false; 
                }
                case "10":
                {
                    result_content="有高血压病史。本次血压控制不满意，有药物不良反应。建议查找原因，调整用药，2周后随访。";
                    $("textarea[name='follow_result']").html(result_content);
                    $("input[name='follow_next_time']").val(getDate(14,0,res_array[1]));
                    $("#week").html(getDate(14,1,res_array[1]));
                    $("input[type='submit']").val("保存->健康教育");
                    $("input[type='submit']").css("width","120px");
                    $("input[type='submit']").attr("disabled","");
                    $("#refer").val("he/index/add");
                    return false; 
                }
                default:
                {
                    $("input[type='button']").attr("disabled","");
                    $("input[type='submit']").attr("disabled","");
                    return false;
                }
            }
			return false;
		},
		error:function(){
			alert("数据通讯错误，无法自动获取随访结局及下次随访日期");
            $("input[type='submit']").attr("disabled","");
			return false;
		}
    });
}
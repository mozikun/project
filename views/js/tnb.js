//根据指定的天数计算日期
function getDate(days,show_type,date_time)
{
                 if(date_time=='')
                  {
	      var now=new Date();
                  }
                  else
                   {
                        var now = new Date(date_time*1000);
                   }
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
//获取结果状态
function get_result(currenturl,is_diabetes,date_time)
	{
		 $.ajax({
				type:"POST",
				url:currenturl,
				dataType:"html",
				data:$("form[name='frm']").serialize(),
				beforeSend:function(){
		                $("input[type='submit']").attr("disabled","disabled");
						},
				success:function(data){
					var mycondition = String($.trim(data));
		            var mymessage;
		            //alert(mycondition);
		            switch(mycondition){
                                 
		            //有危险因素
		            case "1":
		            	//alert("2");
		            	mymessage='您存在可疑危险因素,需要立即转诊,2周后随访。';
		            	$("textarea[id='resultnow']").html(mymessage);
		            	$("input[name='time_of_next_followup']").val(getDate(14,0,date_time));
		            	$("span[id='myweek']").html(getDate(14,1,date_time));
		            	$("input[type='submit']").val('保存随访->转诊');
		            	$("input[type='submit']").css("width","120px");
		            	$("input[type='submit']").attr("disabled","");
		            	$("input[id='nexturl']").val('gp/transout/add');
		            	break;
		            //血糖控制满意无药物不良史
		            case "2":
                                                        if(is_diabetes>0)
                                                        {
                                                                mymessage='确诊是糖尿病患者：血糖控制满意,无药物不良史,3个月后进行随访。';
                                                               $("input[name='time_of_next_followup']").val(getDate(90,0,date_time));
                                                         }
                                                         else
                                                         {
                                                             mymessage='血糖控制满意,无药物不良史,1年后进行随访。';
                                                             $("input[name='time_of_next_followup']").val(getDate(365,0,date_time));
                                                         }
		            	$("textarea[id='resultnow']").html(mymessage);
		            	
		            	$("span[id='myweek']").html(getDate(365,1,date_time));
		            	$("input[type='submit']").val('保存随访');
		            	$("input[type='submit']").css("width","120px");
		            	$("input[type='submit']").attr("disabled","");
		            	break;
		            //初次出现血糖控制不满意或有药物不良反映
		            case "3":
		            	mymessage='血糖控制不满意或出现药物不良反映,2周后进行随访。';
		            	$("textarea[id='resultnow']").html(mymessage);
		            	$("input[name='time_of_next_followup']").val(getDate(14,0,date_time));
		            	$("span[id='myweek']").html(getDate(14,1,date_time));
		            	$("input[type='submit']").val('保存随访');
		            	$("input[type='submit']").css("width","120px");
		            	$("input[type='submit']").attr("disabled","");
		            	break;
		            case "4":
		            	mymessage='连续2次血糖控制不满意或者两次随访药物不良没有改善或者有新的并发症出现,2周后进行随访转诊。';
		            	$("textarea[id='resultnow']").html(mymessage);
		            	$("input[name='time_of_next_followup']").val(getDate(14,0,date_time));
		            	$("span[id='myweek']").html(getDate(14,1,date_time));
		            	$("input[type='submit']").val('保存随访->转诊');
		            	$("input[type='submit']").css("width","120px");
		            	$("input[type='submit']").attr("disabled","");
		            	$("input[id='nexturl']").val('gp/transout/add');
		            	break;
		            default:
	                {
                                                       if(is_diabetes>0)
                                                        {
                                                              mymessage='确诊是糖尿病患者：您的血糖控制很好,3个月内后进行随访。';
                                                               $("input[name='time_of_next_followup']").val(getDate(90,0,date_time));
                                                        }
                                                        else
                                                        {
		            	mymessage='您的血糖控制很好,1年后进行随访。';        	
		            	$("input[name='time_of_next_followup']").val(getDate(365,0,date_time));
                                                        }
                                                         $("textarea[id='resultnow']").html(mymessage);
		            	$("span[id='myweek']").html(getDate(365,1,date_time));
		            	$("input[type='submit']").attr("disabled","");
	                }
		             }
					},
		    		error:function(){
		    			alert("数据通讯错误，无法自动获取随访结局及下次随访日期");
		                $("input[type='submit']").attr("disabled","");
		    			return false;
		    		}
		        });
	}
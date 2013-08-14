	$(document).ready(
	function()
	{
		$(document).keydown(
		function(){
			//将回车或者向下键替换为tab键
			if(event.keyCode=='13')
			{
				event.keyCode='9';
			}
		}
		);
		
	//为所有表单绑定聚焦样式
	$("input").focus(function(){
		$(this).addClass("alert");
	}).blur(function(){$(this).removeClass("alert");});
	//表单校验
//	$("#name").blur(function(){isEmpty($(this),"姓名")});
//	$("#standard_code").blur(
//	function(){
//		if($(this).val()!="" && checkLen($(this),16,16,"档案号"))
//		{
//			ajaxChk($(this),"<!--{$baseUrl}-->iha/index/validator/code/"+$(this).val(),"档案号");
//		}
//	});
//	$("#card").blur(function(){isCardID($(this))});
	//$("#telephone_number").blur(function(){isPhone($(this))});
	//$("#contact_number").blur(function(){isPhone($(this))});
	//$("#date_of_birth").blur(function(){isDate($(this))});
	//所有的短输入框只能输入数字
	//$("input[class='short']").blur(function(){isInt($(this));checkLen($(this),0,2)});
	//表单提交绑定检测事件
	$("input[type='submit']").click(function(){
		$("input[type!='submit']").triggerHandler('blur');
		var numerr=$(".errortips").length;
		if(numerr)
		{
			return false;
		}
		});
	
	//处理疾病史弹出对话框
	$('#disease_popup_button').click(function(){
		$.dialog(500, $('#disease_popup').height()+60, $('#disease_popup').html(),"disease_popup","更多疾病确诊");
	});
	//处理手术史弹出对话框
	$('#surgery_popup_button').click(function(){
		$.dialog(500, $('#surgery_popup').height()+60, $('#surgery_popup').html(),"surgery_popup","更多手术史");
		$('#surgery_popup div').remove();
		//给内部的input绑定提示时间
		$("#dialog_box_html input[name='surgery_history[]']").each(function(i){
			$(this).suggest(operation_pinyin,{hot_list:operation_eight,attachObject:"#suggest_"+(i+3)});
			})
	});
	//外伤史弹出对话框
	$('#trauma_popup_button').click(function(){
		$.dialog(500, $('#trauma_popup').height()+60, $('#trauma_popup').html(),"trauma_popup","更多外伤史");
	});
	//处理输血史弹出对话框
	$('#trans_popup_button').click(function(){
		$.dialog(500, $('#trans_popup').height()+60, $('#trans_popup').html(),"trans_popup","更多输血史史");
	});
	
	}
	);
	//处理当选择少数民族时激活下拉选项框
	function chkrace(obj)
	{
		if($(obj).val()=="2")
		{
			$("select[name='races']").attr("disabled",false);
			$("select[name='races']").focus();//聚焦到下拉框
		}
		else
		{
			$("select[name='races']").attr("disabled",true);
		}
	}
	//处理手术史
	function surgery_history(obj)
	{
		if($(obj).val()=="2")
		{
			//控制按钮
			$("#surgery_popup_button").attr("disabled",false);
			$("input[name='surgery_history[]']").attr("disabled",false);
			$("input[name='stime[]']").attr("disabled",false);
			$("input[name='s_time[]']").bind("foucus");
			if ($("input[name='surgery_history[]']").eq(0).val() == "") 
			{
				$("input[name='surgery_history[]']").eq(0).focus();//聚焦到下拉框
			}
		}
		else
		{
			$("#surgery_popup_button").attr("disabled",true);
			$("input[name='stime[]']").unbind("foucus");
			$("input[name='surgery_history[]']").attr("disabled",true);
			$("input[name='stime[]']").attr("disabled",true);
		}
	}
	//处理外伤和输血史
	function chktrauma(obj,span_id)
	{
		if($(obj).val()=="2")
		{
			//控制按钮
			$("#"+span_id + "_popup_button").attr("disabled",false);
			$("input[name='"+span_id + "_name[]']").attr("disabled",false);
			$("input[name='"+span_id + "_time[]']").attr("disabled",false);
			$("input[name='"+span_id + "_time[]']").bind("foucus");
			if ($("input[name='"+span_id + "_name[]']").eq(0).val() == "") 
			{
				$("input[name='"+span_id + "_name[]']").eq(0).focus();//聚焦到下拉框
			}
		}
		else
		{
			$("#"+span_id + "_popup_button").attr("disabled",true);
			$("input[name='"+span_id + "_time[]']").unbind("foucus");
			$("input[name='"+span_id + "_name[]']").attr("disabled",true);
			$("input[name='"+span_id + "_time[]']").attr("disabled",true);
		}
	}
	//点击前面的选项设置文本框的值
	function set_input_value(ipvalue,inputname)
	{
		$("input[name='"+inputname+"']").val(ipvalue);
		//触发输入框的blur事件，给逻辑判定增加实现
		$("input[name='"+inputname+"']").trigger("blur");
		return false;
	}
    //多选点击填充值
    function set_input_values(ipvalue,inputname)
	{
	    var flag=0;
		$("input[name='"+inputname+"']").each(function(){
		  if(($(this).val()!="" && $(this).val()==ipvalue) || $(this).val()=="")
          {
                //给input赋值
                $(this).val(ipvalue);
                if($(this).next("input[name='"+inputname+"']").val()=="" || $(this).next("input[name='"+inputname+"']").val()==undefined)
                {
                    set_input_order(inputname);
                    flag=1;
                    //触发失去焦点事件，因为有些输入框的其他项绑定过事件
                    $(this).trigger("blur");
                    return false;
                }
          }
		});
        if(flag==0)
        {
            $("input[name='"+inputname+"']").trigger("blur");
            set_input_order(inputname);
            flag=1;
        }
		return false;
	}
    //重新给多选框赋值
    function set_input_order(inputname)
    {
        var a=new Array();
        var b=new Array();
        var i=0;
        //取最新的结果数组(第二种，手工修改后再点击)
        $("input[name='"+inputname+"']").each(function(){
            if($(this).val()!="" && $.inArray(parseInt($(this).val()),a)=="-1")
            {
                a[i]=parseInt($(this).val());
                i++;
            }
            else
            {
                //保证循环次数同时为比数字大的值
               a[i]=999999999;
               i++; 
            }
        });
        //排序
        b=set_order(a);
        //重新赋值
        var n=0;
        $("input[name='"+inputname+"']").each(function(){
        if(n<=b.length && a[n]!=999999999)
        {
            $(this).val("");//清除原始内容
            $(this).val(a[n]);
            n++;  
        }
        else
        {
            $(this).val("");//清除原始内容
        }
		});
    }
    //js冒泡排序
    function set_order(tm)
    {
        var ct;
        ct=tm.length-1;
        for(var i=0;i<ct;i++)
        {
            for(var j=ct;j>=i;j--)
            {
                var temp;
                if(tm[j+1]<tm[j])
                {
                    temp=tm[j+1];
                    tm[j+1]=tm[j];
                    tm[j]=temp;
                }
            }
        }
        return tm;
    }
	//当点击添加项的时候添加更多项
	function pop_add_item(divid)
	{
		//定位到div下的tbody里的tr,获取其html内容用来添加时使用
		var td_html=$("#"+divid+" tbody tr").last().prev().html();
		$("#dialog_box_html tbody tr").last().before("<tr>"+td_html+"</tr>");
		//设置对话框新的高度--插入的元素在table中，因此求取table的高度
		$("#dialog_box_html").height($("#dialog_box_html table").height());
		$("#dialog_box").height($("#dialog_box_html").height() + 40);
		return false;
	}
	//当点击移除项的时候移除一项
	function pop_del_item(divid){
		if ($("#dialog_box_html tbody tr").length > 2) //验证tr个数，如果个数太少会导致程序错误
		{
			//匹配指定DIV下的tbody里的tr元素的最后一个元素之前的元素，因为移除是移除倒数第一个
			$("#dialog_box_html tbody tr").last().prev().remove();
			//设置对话框新的高度
			$("#dialog_box_html").height($("#dialog_box_html table").height());
			$("#dialog_box").height($("#dialog_box_html").height() + 40);
		}
		else
		{
			alert("已经只剩一项了，请勿删除");
		}
		return false;
	}
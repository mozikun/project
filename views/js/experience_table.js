// JavaScript Document
$(document).ready(function(){
	   //禁止按回车提交 回车跳到下一个form元素				   
       $("input,select").each(
            function(){
                $(this).keypress( function(e) {
                        var key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
                        if(key.toString() == "13"){
									var i;
									for (i = 0; i < this.form.elements.length; i++)
										if (this == this.form.elements[i])
										break;
									i = (i + 1) % this.form.elements.length;
									this.form.elements[i].focus();
									//alert("next");

									return false;

                        }
                });
            });
	   
	//处理住院史弹出对话框
	$('#hh_popup_button').click(function(){
		$.dialog(600, 270, $('#hh_popup').html(),"hh_popup","更多住院史");
	});	     
	//处理家庭病床史弹出对话框
	$('#oh_popup_button').click(function(){
		$.dialog(600, 270, $('#oh_popup').html(),"oh_popup","更多家庭病床史");
	});
	//处理用药情况弹出对话框
	$('#drug_popup_button').click(function(){
		$.dialog(600, $('#drug_popup').height()+60, $('#drug_popup').html(),"drug_popup","更多用药情况");
	});
	//处理预防接种史弹出对话框
	$('#vacc_popup_button').click(function(){
		$.dialog(600, $('#vacc_popup').height()+60, $('#vacc_popup').html(),"vacc_popup","更多预防接种史");
	});
		   
   }) ;

//点击前面的选项设置文本框的值
    function set_input_value(ipvalue,inputname)
	{
		$("input[name='"+inputname+"']").val(ipvalue);
		//触发输入框的blur事件，给逻辑判定增加实现
		$("input[name='"+inputname+"']").trigger("blur");
		return false;
	}
	//中医生体质，设置值
    function set_value(ipvalue,id_name)
	{
		$("#"+id_name).val(ipvalue);
		//触发输入框的blur事件，给逻辑判定增加实现
		$("#"+id_name).trigger("blur");
		return false;
	}  
	/**
	*  current_id的值为token_num时。控制id对像disabled
	*/
	function control_enable(id,current_id,token_num){
		var obj=$("#"+id);
		var current_obj=$("#"+current_id);
		//alert(current_obj.val());
		if(current_obj.val()!=token_num){
			obj.attr("disabled",true);
			obj.val('');
		}else{
			obj.attr("disabled",false);
		}
	}
	/**
	 * 处理单个输入框的 disable
	 */
	function control_enable_lone(id,current_id,json_data){
		var obj=$("#"+id);
		var current_obj=$("#"+current_id);
		var current_obj_val = current_obj.val();
		var json_array = jQuery.parseJSON(json_data);
		if(current_obj_val==''){
			return false;
		}
		if(json_array[current_obj_val][0]!=="-99"){
			obj.attr("disabled",true);
			obj.val('');
		}else{
			obj.attr("disabled",false);
		}
	}
	//职业暴露初始化
	function control_enable_new(firstid,endid,inputid,currentval){
		var obj=$("#"+firstid);
		var current_obj=$("#"+endid);
		var inputnew = $("#"+inputid);
		if(inputnew.val()==''){
			return false;
		}
		//alert(inputnew.val());
		if(inputnew.val()==''||inputnew.val()!==currentval){
			obj.attr("disabled",true);
			obj.val('');
			current_obj.attr("disabled",true);
			current_obj.val('');
		}else{
			current_obj.attr("disabled",false);
			obj.attr("disabled",false);
		}
	}
	
	//设置bmi
	function set_bmi(weight_id,height_id,bmi_id){
		
	   
	   var weight =parseFloat($("#"+weight_id).val());//体重	    
	   var height =parseFloat($("#"+height_id).val())*0.01;//身高
	   if(isNaN(height)) {
			  $("#"+height_id).val('');
			  $("#"+bmi_id).val('');
			  return false;
	   }
	   if(isNaN(weight)) {
			  $("#"+weight_id).val('');
			  $("#"+bmi_id).val('');
			  return false;
	   }
	  
	   var bmi;
	   if(height==0){
		    bmi=0;
	   }else{
	   		bmi=weight/(height*height);
	   }
	   //alert(bmi);
	 
	   if(isNaN(bmi)) {
			 $("#"+weight_id).val('');
			 $("#"+height_id).val('');
			 $("#"+bmi_id).val('');
			 return false;	
		}
	   
	   $("#"+bmi_id).val(bmi.toFixed(2));
	   
    }
	//腰臀围比值
	function set_whi(waistline_id,hipcircumference_id,whi_id){
		
		var waistline= $("#"+waistline_id);
		var hipcircumference= $("#"+hipcircumference_id);
		var whi= $("#"+whi_id);
		var waistline_val=waistline.val();
		var hipcircumference_val=hipcircumference.val();
		var whi_val;
		 if(waistline_val==""){
			 waistline.val('');
			 whi.val('');
			return false;	 
	     }
		  if( hipcircumference_val==""){
			hipcircumference.val('');
			whi.val('');
			return false;	 
	     }
		 if(isNaN(waistline_val) || isNaN(hipcircumference_val)) {
		   waistline.val('');
		   hipcircumference.val('');
		   whi.val('');
		   return false;	
		}
		if(hipcircumference_val==0){
			whi_val=0;
		}else{
		    whi_val=waistline_val/hipcircumference_val;
		}
		
		whi.val(whi_val.toFixed(2));
		
    }
    /**
    * id对像的值为id_value时 id_array数组里的所有对像的disabled=true 否则为false
    */
    function obj_enable_true(id,id_value,id_array){
    	if($("#"+id).val()==id_value){
    		$.each(id_array,function(n,value){
    			$('#'+value).attr('disabled',true);
    			//$('#'+value).val('');
    			//alert('--');
    		});
    	}else{
    		$.each(id_array,function(n,value){
    			$('#'+value).attr('disabled',false);
    			//alert('++');
    		});
    	}
    	
    }
    /**
    * id对像的值为id_value时 id_array数组里的所有对像的disabled=false true
    */
    function obj_enable_false(id,id_value,id_array){
    	if($("#"+id).val()==id_value){
    		$.each(id_array,function(n,value){
    			$('#'+value).attr('disabled',false);
    			//$('#'+value).val('');
    			//alert('--');
    		});
    	}else{
    		$.each(id_array,function(n,value){
    			$('#'+value).attr('disabled',true);
    			//alert('++');
    		});
    	}
    	
    }	
    
    
    
  //多选点击填充值
    function set_input_many(ipvalue,inputname)
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
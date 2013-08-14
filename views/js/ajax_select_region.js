//input_id输入表单的ID
//span_id，待显示html的span的ID
function get_region_select_html(base_path,input_id,span_id)
{
    var org_id=$("#"+input_id).val();//隐藏表单字段的值
    var url=base_path+'region/region/menuDropDownBoxNew/p_id/'+org_id+'/input_id/'+input_id+'/span_id/'+span_id+'/sid/'+Math.random();//待请求的地址
    $.get(url,function(select_html){
        //处理地址
        $("#"+span_id).html(select_html);
    });
}
//input_id输入表单的ID
//span_id，待显示html的span的ID
function change_org(input_id,span_id,currentValue,base_path){
	var tempValue=currentValue.split("|")
	if(tempValue[0]=='-9')
    {
		//如果选择了　请选择，则把此级的父级作为当前选定的项目
		$("#"+input_id).val(tempValue[1]);
	}
    else
    {
		$("#"+input_id).val(tempValue[0]);
	}
    get_region_select_html(base_path,input_id,span_id);
}
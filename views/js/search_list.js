/**
 * 显示个人档案列表
 * @author 我好笨
 * @param basePath 基路径
 * @param searchtable 关联的表名--2011-10-25根据新规则，修改为：待查询主表||随访主表的形式
 * @param table_comment 表中文注释，即页面下拉菜单的显示值--2011-10-25根据新规则，修改为：选项一||选项二||选项三的形式
 * @param colum 要查询的字段，多个字段以||隔开
 * @param value 对应上面字段的值，多个字段对应的多个字以||隔开
 */
function do_search(basePath,searchtable,table_comment,colum,value)
{
	$("#search_listpic").attr("src",basePath+"images/search_list_1.gif");
	$("#search_list").show();
	if($("#search_list").html()=="")
		{
			$("#search_list").ajaxStart(function(){
				   $(this).html("<img src=\""+basePath+"images/load.gif\" />");
			 });
		}
	$.ajax({
			type:"get",
			url:encodeURI(basePath+"iha/index/index/searchtable/"+searchtable+"/table_comment/"+table_comment+"/colum/"+colum+"/value/"+value+""),
			dataType:"html",
			data:"",
			success:function(data)
			{
				$("#search_list").html(data);
			}
		});	
}
/**
 * 隐藏列表
 */
function undo_search(basePath)
{
	$("#search_listpic").attr("src",basePath+"images/search_list.gif");
	$("#search_list").hide();
}
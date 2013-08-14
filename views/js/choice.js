/**
 * 
 */
function my_chioce(basePath,chiocetable,table_comment)
{
	//alert('22222');
	$("#search_listpic").attr("src",basePath+"images/search_list_1.gif");
	$("#search_list").show();
	$("#searchtop").show();
	$.ajax({
			type:"get",
			url:encodeURI(basePath+"et/choice/index/chiocetable/"+chiocetable),
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
function undo_chioce(basePath)
{
	$("#search_listpic").attr("src",basePath+"images/search_list.gif");
	$("#search_list").hide();
	$("#searchtop").hide();
}
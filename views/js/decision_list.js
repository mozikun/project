function showList(url,obj){
	//alert(obj.html());
	$.ajax({
		type: "GET",
		url: url,
		async:false,
		success:function(msg){
			//alert(msg);
			obj.html(msg);
		}
	});
		
}
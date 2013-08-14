//高级搜索
var myobj;
function getDrop(mypath){
	var region_p_id_search=document.getElementById('region_p_id_search').value;
    var region_id_search=document.getElementById('region_id_search').value;
	//alert(parentId+id);
	if(region_p_id_search=='-9'){
		alert('请选择一项分类');
		return;
	}
	//alert(region_p_id_search);
	myobj=getXmlHttp();
	//url='/management/menu/menuDropDownBox/parentId/'+parentId+'/id/'+id+'/sid/'+Math.random();
	var url=mypath+'region/region/menuDropDownBoxIha/p_id/'+region_p_id_search+'/sid/'+Math.random();
	//alert(url);
	myobj.onreadystatechange=processDrop;
	myobj.open('GET',url,true);
	myobj.send(null);
}
function processDrop(){
	//alert(xmlHttp.readyState);
	if(myobj.readyState==4 && myobj.status==200){
		//alert(xmlHttp.readyState);
		//注：firefox不支持innerText
		var objDiv=document.getElementById('region_area');
		//alert(objDiv);
		//alert(myobj.responseText);
		objDiv.innerHTML=myobj.responseText;
		//objDiv.style.display='inline';
		//alert('yes');
	}
}
//objDiv=$('categoryDropDownBox');
//objDiv.innerHTML="<select><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";
function getXmlHttp()
{
	var xmlHttp;
	try{
		xmlHttp=new ActiveXObject('MSXML2.XMLHTTP.3.0');//IE
	}catch(e){
		try{
			xmlHttp=new XMLHttpRequest();//firefox
		}catch(e){
			alert('不能正常创建xmlhttp对象');
		}
	}
	return xmlHttp;
}

function search_high(search_id,mypath)
{
	if($("#"+search_id).css("display")=="none")
	{
		$("#search_img").attr("src",mypath+"images/zoom_out.png");
		$("#"+search_id).show("fast",function(){
          getDrop(mypath);
 		});
	}
	else
	{
		$("#search_img").attr("src",mypath+"images/zoom_in.png");
		$("#"+search_id).hide();
	}
}

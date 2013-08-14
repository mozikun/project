function getCategoryDropDownBox(){
	if(parentId=='-9'){
		alert('请选择一项分类');
		return;
	}
	xmlHttp=getXmlHttpObject();
	url='/goods/category/categoryDropDownBox/parentId/'+parentId+'/categoryId/'+categoryId+'/sid/'+Math.random();
	//url='aaa.php?parentId='+parentId;
	xmlHttp.onreadystatechange=handleStateChange;
	xmlHttp.open('GET',url,true);
	xmlHttp.send(null);

}
function checkValue(){
	//alert(parentId);
	if($('parentId').value=='-9'){
		alert('请选择一项分类');
		return false;
	}else{
		return true;
	}
}
function handleStateChange(){
	if(xmlHttp.readyState==4 && xmlHttp.status==200){
		//注：firefox不支持innerText
		var objDiv=$('categoryDropDownBox');
		objDiv.innerHTML=xmlHttp.responseText;
		//objDiv.style.display='inline';
		//alert('yes');
	}
}
function changeValue(theValue){
	parentId=theValue;
	$('parentId').value=theValue;
	getCategoryDropDownBox();
}


//objDiv=$('categoryDropDownBox');
//objDiv.innerHTML="<select><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";
function getXmlHttpObject()
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
function $(id){
	return document.getElementById(id);
}
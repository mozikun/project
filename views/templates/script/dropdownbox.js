function getCategoryDropDownBox(){
	if(parentId=='-9'){
		alert('请选择一项分类');
		return;
	}
	xmlHttp=getXmlHttpObject();
	url='/goods/goods/goodsDropDownBox/parentId/'+parentId+'/categoryId/'+categoryId+'/goodsId/'+goodsId+'/sid/'+Math.random();
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
		//alert(xmlHttp.responseText);
		objDiv.innerHTML=xmlHttp.responseText;
		//objDiv.style.display='inline';
		//alert('yes');
		//alert(parentId+"|"+goodsId);
	}
}
function changeValue(theValue){
	parentId=theValue;
	$('parentId').value=theValue;
	goodsId='';
	$('goodsId').value='';
	getCategoryDropDownBox();
	
}
function setGoodsValue(theValue){
	if(theValue=='-9'){
		alert('请选择一个商品');
	}
	goodsId=theValue;
	$('goodsId').vaule=theValue;
	//alert(parentId+"|"+goodsId);
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
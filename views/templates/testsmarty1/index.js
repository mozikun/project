//处理下拉菜单
showSubMenu();
//处理选项卡
processTab('tab1');
processTab('tab2');
processTab('tab3');

//显示与处理下拉菜单
function showSubMenu(){
	var objMainMenuDiv=document.getElementById('topMenuUl');
	var aObj=objMainMenuDiv.getElementsByTagName("a");
	for(var i=0;i<aObj.length;i++){
		//不能直接用class 因为class是控件的内置属性，而ie与firefox取值时不兼容，因此自定义menuClass
		if(aObj[i].getAttribute("menuClass")=="subMenu"){
			//以a为中心,取a的外层div，通过外层div，取得a下面的内层div
			//alert(i);
			var outerLiObj=aObj[i].parentNode;
			var innerUlObj=outerLiObj.getElementsByTagName("ul");
			if(innerUlObj.length<1){
				continue;
			}
			outerLiObj.onmouseover=function(){
				var innerUlObj=this.getElementsByTagName("ul");
				innerUlObj[0].style.display="block";
			}
			outerLiObj.onmouseout=function(){
				var innerUlObj=this.getElementsByTagName("ul");
				innerUlObj[0].style.display="none";
			}
		}
	}
}



/*处理选项卡 */
function processTab(tabID){
	var tab=document.getElementById(tabID);
	var tabElements=tab.getElementsByTagName('div');

	var tabMenus=new Array();
	var tabBodys=new Array();
	//遍历时，把tabDiv下所有的div都取出来了，即把选项卡标签与选项卡所属的div都取出来了，要分别处理
	//处理选项卡标签 注意，都是从0开始编号，所以用j来作为计数器
	for(var i=0,j=0;i<tabElements.length;i++){
		//alert(j);
		if(tabElements[i].getAttribute('divType')=='tabMenu'){
			tabMenus[j]=tabElements[i];
			tabMenus[j].onmouseover=showTabBody;
			tabMenus[j].id=tabID+'_menu_'+j;
			j++;
			//alert(j);
		}
	}
	//处理选项卡
	for(var i=0,j=0;i<tabElements.length;i++){
		if(tabElements[i].getAttribute('divType')=='tabBody'){
			//tabMenus[i].onmouseover=showtabBody;
			tabBodys[j]=tabElements[i];
			tabBodys[j].id=tabID+'_body_'+j;
			j++;
		}
	}
	//初始化第一选项卡及标签
	tabMenus[0].style.backgroundColor='#FFFFFF';
	tabBodys[0].style.display='block';
	//处理下划线
	addUnderLine(tabMenus[0]);
}

function showTabBody(){
	//alert(this.parentNode.id);
	//取父
	var tab=this.parentNode;//parentElement
	//处理选项卡标签
	var tabElements=tab.getElementsByTagName('div');
	//给所有的标签加上底色
	for(var i=0;i<tabElements.length;i++){
		if(tabElements[i].getAttribute('divType')=='tabMenu'){
			tabElements[i].style.backgroundColor='#EBF3FB';
			//alert(tabMenu.style.backgroundColor);
		}
	}

	//处理选项卡,先隐藏所有的tabBody
	var tabElements=tab.getElementsByTagName('div');
	//显示当前选项卡
	for(var i=0;i<tabElements.length;i++){
		if(tabElements[i].getAttribute('divType')=='tabBody'){
			tabElements[i].style.display='none';
		}
	}
	var tempId=this.id.split('_');

	var tabMenuId=tempId[0]+'_menu_'+tempId[2];
	var tabMenu=document.getElementById(tabMenuId);
	tabMenu.style.backgroundColor='#ffffff';
	//alert(tabMenu.style.backgroundColor);

	var tabBodyId=tempId[0]+'_body_'+tempId[2];
	var tabBody=document.getElementById(tabBodyId);
	tabBody.style.display='block';

	addUnderLine(this);
}

//用于选不同的选项卡时，把卡与标签在视觉上连为一体的下边框
function addUnderLine(obj){
	var tab=obj.parentNode;//parentElement
	//加一个临时的div将标签与选项卡连接起来
	obj.style.borderBottom="solid 1px #FFFFFF";
	//由选项卡标签的id取得选项卡的id
	//实现原理，每个tab有一个动态添加的底线，位置在当前选中的div下面
	//但此时父层必须要定义其position不能不写，即使就是relative也必须定义，否则位置出错
	if(document.getElementById(tab.id+'_borderBottom')){
		var objBorderBottom=document.getElementById(tab.id+'_borderBottom');
		objBorderBottom.style.position='absolute';
		objBorderBottom.style.display='block';
		objBorderBottom.style.left=(obj.offsetLeft+1)+'px';
	}else{
		var objBorderBottom=document.createElement('div');
		objBorderBottom.id=tab.id+'_borderBottom';
		objBorderBottom.style.position='absolute';
		objBorderBottom.style.display='block';
		objBorderBottom.style.top=obj.offsetHeight+'px';
		objBorderBottom.style.left=(obj.offsetLeft+1)+'px';
		objBorderBottom.style.width=(obj.offsetWidth-2)+'px';
		//alert(obj.offsetTop+"|"+obj.offsetLeft+"|"+obj.offsetHeight+"|"+obj.offsetWidth);
		//alert(obj.scrollTop+"|"+obj.scrollLeft+"|"+obj.scrollHeight+"|"+obj.scrollWidth);
		objBorderBottom.style.height='0px';
		objBorderBottom.style.margin='0px';
		objBorderBottom.style.padding='0px';
		objBorderBottom.style.borderTop='solid 1px #FFFFFF';
		//alert(obj.style.zIndex);
		objBorderBottom.style.zIndex=obj.style.zIndex+1;
		tab.appendChild(objBorderBottom);
	}

}

//给以列表方式显示的图片，在其底部加新闻标题
function imageListAddTitle(){
	//获取所有的图片列表
	var allDivObj=document.getElementsByTagName('div');
	var objDiv=new Array();
	//取为图片列表的div
	for(var i=0,j=0;i<allDivObj.length;i++){
		if(allDivObj[i].className=='imageList'){
			objDiv[j]=allDivObj[i];
			j++;
		}
	}
	//alert(j);

	for(var i=0;i<objDiv.length;i++){
		var objImages=objDiv[i].getElementsByTagName('img');
		//取每一个图片
		for(var j=0;j<objImages.length;j++){
			//补id
			if(objImages[j].id==''){
				//objImages[j].id='imageList'+'_'+i+'_'+j;
				objImages[j].id='i'+'_'+i+'_'+j;
			}
			imageAddTitle(objDiv[i],objImages[j]);
		}
	}
}
imageListAddTitle();
//给图片加文字标签
function imageAddTitle(objDiv,objImg){

	var tipTextDivId=objImg.id+'_tipTextDiv';

	if(document.getElementById(tipTextDivId)){
		var objTipTextDiv=document.getElementById(tipTextDivId);
	}else{
		var objTipTextDiv=document.createElement('div');
		var objTipTextDivdimension=16;
		var objImgHeight=objImg.offsetHeight;
		var objImgWidth=objImg.offsetWidth;
		var objImgTop=objImg.offsetTop;
		var objImgLeft=objImg.offsetLeft;

		objTipTextDiv.id=tipTextDivId;
		objTipTextDiv.style.position='absolute';
		objTipTextDiv.style.top=(objImgHeight-2)+'px';
		objTipTextDiv.style.left=objImgLeft+'px';
		objTipTextDiv.style.width=(objImgWidth-30)+"px";
		objTipTextDiv.style.height=objTipTextDivdimension;
		objTipTextDiv.innerHTML=objImg.getAttribute("alt");
		//alert(offsetTop+"|"+offsetLeft);
		objTipTextDiv.zIndex=objImg.zIndex+1;
		//alert(objTipTextDiv.id);
		//改变透明度
		//objTipTextDiv.style.filter="alpha(opacity=40)";
		//折腾了半天，原来搞成了向图片里添加div了
		objDiv.appendChild(objTipTextDiv);
		//alert(objTipTextDiv.innerHTML);
	}
}





//图片轮换1
var div='topLeft';
var objAlterDiv=document.getElementById(div);
objAlterDiv.myfunc=function(){
	alterImage(objAlterDiv);
	window.setTimeout(objAlterDiv.myfunc,2000);
}
objAlterDiv.myfunc();
//图片轮换2
var div='topRight';
var objAlterDiv1=document.getElementById(div);
objAlterDiv1.myfunc=function(){
	alterImage(objAlterDiv1);
	window.setTimeout(objAlterDiv1.myfunc,8000);
}
objAlterDiv1.myfunc();
//图片轮换3
/*
经过实验无法在display为none里在进行图片轮换的操作了
var div='categoryImage';
var objAlterDiv2=document.getElementById(div);
objAlterDiv2.myfunc=function(){
alterImage(objAlterDiv2);
window.setTimeout(objAlterDiv2.myfunc,2000);
}
objAlterDiv2.myfunc();
*/


//控制指定div中的图片幻灯片效果
function alterImage(objDiv){
	var nextImage=0;
	var objId=objDiv.id
	var aObj=objDiv.getElementsByTagName("img");
	var objDivHeight=objDiv.offsetHeight;
	var objDivWidth=objDiv.offsetWidth;
	//alert(objDivWidth+"|"+objDivHeight);
	for(var i=0;i<aObj.length;i++){
		if(aObj[i].style.display=='block'){
			//找到下一个应该被显示出来的图片
			nextImage=i+1;
			if(nextImage>=aObj.length){
				nextImage=0;
			}
			break;
		}
	}
	//将全部的图片设为不可见
	for(var i=0;i<aObj.length;i++){
		aObj[i].style.display='none'
	}

	//图片自适应div的大小
	for(var i=0;i<aObj.length;i++){
		aObj[i].style.heigth=(objDivHeight-30)+"px";
		aObj[i].style.width=(objDivWidth-30)+"px";
	}
	//显示当前图片
	aObj[nextImage].style.display='block';
	//文字标签
	try{
		var tipTextDivId=objId+'tipTextDiv';
		if(document.getElementById(tipTextDivId)){
			var objTipTextDiv=document.getElementById(tipTextDivId);
		}else{
			var objTipTextDiv=document.createElement('div');
			var objTipTextDivdimension=16;
			objTipTextDiv.id=tipTextDivId;
			objTipTextDiv.style.position='absolute';
			objTipTextDiv.style.top=objTipTextDivdimension+'px';
			objTipTextDiv.style.left=objTipTextDivdimension+'px';
			objTipTextDiv.style.width=(objDivWidth-30)+"px";
			objTipTextDiv.style.height=objTipTextDivdimension;
			//objTipTextDiv.style.border='solid 1px';
			//objTipDiv.style.marginLeft='1px';
			//objTipDiv.onMouseOverColor='#FFFFFF';
			//objTipDiv.onMouseOutColor='#CCCCCC';
			//objTipDiv.onmouseover=tipDivOnMouseOver;
			//objTipDiv.onmouseout=tipDivOnMouseOut;
			
			objTipTextDiv.style.backgroundColor='#CCCCCC';
			//objTipDiv.innerText=i+1;
			objTipTextDiv.zIndex=objDiv.zIndex+1;
			//改变透明度
			objTipTextDiv.style.filter="alpha(opacity=40)";
			objDiv.appendChild(objTipTextDiv);
		}
	}catch(e){
	}



	//显示相对应的tipImage
	for(var i=0;i<aObj.length;i++){
		try{
			//数字提示符
			var tipDivId=objId+'tipDiv'+i;
			if(document.getElementById(tipDivId)){
				var objTipDiv=document.getElementById(tipDivId);
				objTipDiv.style.backgroundColor=objTipDiv.onMouseOutColor;
				objTipDiv.style.filter="alpha(opacity=40)";
			}else{
				var objTipDiv=document.createElement('div');
				var objTipDivdimension=16;
				objTipDiv.id=div+'tipDiv'+i;
				objTipDiv.current=i;
				objTipDiv.style.position='absolute';
				//objTipDiv.style.top=objDivHeight/4*3+'px';
				objTipDiv.style.top=(objDivHeight-3*objTipDivdimension)+'px';
				objTipDiv.style.left=(objDivWidth-aObj.length*objTipDivdimension)/2+(i*objTipDivdimension)+i*4+'px';
				objTipDiv.style.width=objTipDivdimension+'px';
				objTipDiv.style.height=objTipDivdimension+'px';;
				objTipDiv.style.border='solid 1px';
				//objTipDiv.style.marginLeft='1px';
				objTipDiv.onMouseOverColor='#FFFFFF';
				objTipDiv.onMouseOutColor='#CCCCCC';
				objTipDiv.onmouseover=tipDivOnMouseOver;
				objTipDiv.onmouseout=tipDivOnMouseOut;
				objTipDiv.style.backgroundColor=objTipDiv.onMouseOutColor;
				//objTipDiv.innerText=i+1;
				objTipDiv.innerHTML=i+1;
				objTipDiv.zIndex=objDiv.zIndex+1;
				//改变透明度
				objTipDiv.style.filter="alpha(opacity=40)";
				objDiv.appendChild(objTipDiv);


				//objTipDiv.filters.alpha.opacity=5;
				//alert(objTipDiv.filters.alpha.opacity);
			}
		}catch(e){
		}
		if(i==nextImage){
			//当前tipImage的背景为白色
			objTipDiv.style.backgroundColor=objTipDiv.onMouseOverColor;
			objTipDiv.style.filter="alpha(opacity=90)";
			objTipTextDiv.innerHTML=aObj[i].getAttribute("alt");
			//objTipTextDiv.innerHTML=aObj[i].id;
		}




	}

}
function tipDivOnMouseOut(){
	this.style.backgroundColor=this.onMouseOutColor;
	this.style.filter="alpha(opacity=40)";
	this.style.cursor="default";
	//aObj[this.current].filter="alpha(opacity=40)";
}
function tipDivOnMouseOver(){
	this.style.cursor="pointer";
	var objDiv=this.parentNode;
	var aObj=objDiv.getElementsByTagName("img");
	var objDivHeight=objDiv.offsetHeight;
	var objDivWidth=objDiv.offsetWidth;
	//alert(objDivWidth+"|"+objDivHeight);
	for(var i=0;i<aObj.length;i++){
		aObj[i].style.display='none';
	}
	aObj[this.current].style.display='block';//这个是tipDiv对应的图片

	this.style.backgroundColor=this.onMouseOverColor;
	this.style.filter="alpha(opacity=90)";
}
//var objtemp=document.getElementById("bodyRightDiv");
//alert(objtemp.clientWidth+'|'+objtemp.scrollWidth+'|'+objtemp.offsetWidth);

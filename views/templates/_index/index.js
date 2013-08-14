//显示与处理下拉菜单-div版
function showSubMenu(){
	//取菜单所在的div
	var objMainMenuDiv=document.getElementById('menuDiv');
	//在取得的div中取所有的超链接
	var aObj=objMainMenuDiv.getElementsByTagName("div");
	for(var i=0;i<aObj.length;i++){
		if(aObj[i].getAttribute("extraClass")=="mainMenu"){
			var objSubMenu=aObj[i].getElementsByTagName("div");
			if(objSubMenu[0]==undefined){
				continue;
			}
			aObj[i].onmouseover=function(){
				var objSubMenu=this.getElementsByTagName("div");
				objSubMenu[0].style.display="block";
			}
			aObj[i].onmouseout=function(){
				var objSubMenu=this.getElementsByTagName("div");
				objSubMenu[0].style.display="none";
			}
		}
	}
}

//显示与处理下拉菜单-ul li版
function showSubMenu_old(){
	//取菜单所在的div
	var objMainMenuDiv=document.getElementById('topMenuUl');
	//在取得的div中取所有的超链接
	var aObj=objMainMenuDiv.getElementsByTagName("a");
	for(var i=0;i<aObj.length;i++){
		//不能直接用class 因为class是控件的内置属性，而ie与firefox取值时不兼容，因此自定义menuClass
		if(aObj[i].getAttribute("menuClass")=="subMenu"){
			//以a为中心,取a的外层li，通过外层li，取得与a平级的ul
			var objOuterLi=aObj[i].parentNode;
			var objInnerUl=objOuterLi.getElementsByTagName("ul");
			//如果没有子菜单
			if(objInnerUl.length<1){
				continue;
			}
			objOuterLi.onmouseover=function(){
				//注意，这里的var objInnerUl与上面的var objInnerUl=objOuterLi.getElementsByTagName("ul");
				//里的完全是两回事，这里是事件函数的定义，相当于写在此函数外面，与上面的objInnerUl根本没有什么关系，不要理解错了。
				var objInnerUl=this.getElementsByTagName("ul");
				objInnerUl[0].style.display="block";
			}
			objOuterLi.onmouseout=function(){
				var objInnerUl=this.getElementsByTagName("ul");
				objInnerUl[0].style.display="none";
				//alert(objInnerUl[0].style.display);
			}
		}
	}
}
/*处理选项卡 */
/**
选项卡实现原理分析：
一个名为tabX的容器div
tabMenu为选项卡标签所在的div
tabBody为选项卡所在的div，它们在数量上要对称
第一次进入时，每个tabX的容器里的第一个选项卡被显示，别的暂为display:none
tabMenu的onmouseover事件被重构来显示对应的tabBody
**/
function processTab(tabID){
	//形参tabID是对应的tabX的容器div的id
	var tab=document.getElementById(tabID);
	var tabElements=tab.getElementsByTagName('div');

	var tabMenus=new Array();
	var tabBodys=new Array();
	//遍历时，把tabDiv下所有的div都取出来了，即把选项卡标签与选项卡所属的div都取出来了，因此要分别处理，对于选项卡所属的div
	//用tableMenus[j]来识别。
	//处理选项卡标签 注意，都是从0开始编号，所以用j来作为计数器
	for(var i=0,j=0;i<tabElements.length;i++){
		//alert(j);
		if(tabElements[i].getAttribute('divType')=='tabMenu'){
			tabMenus[j]=tabElements[i];
			//当鼠标移动到选项卡标签上时，就显示对应的选项卡
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

			tabBodys[j].style.backgroundColor='#F0FFFF';
			tabBodys[j].style.backgroundColor='#FFFFFF';
			j++;
		}
	}
	//初始化第一选项卡及标签
	//白色底色与下面的tabBody的底色一致，形成连通效果 如果修改了此处的颜色，则对应的tabBody与UnderLine的颜色都要修改
	//tabMenus[0].style.backgroundColor='#F0FFFF';
	tabMenus[0].style.backgroundColor='#FFFFFF';
	tabBodys[0].style.display='block';
	//处理下划线
	addUnderLine(tabMenus[0]);
}
//当鼠标移过时显示对应的选项卡
function showTabBody(){
	//alert(this.parentNode.id);
	//取tab容器
	var tab=this.parentNode;//parentElement
	//处理选项卡标签
	var tabElements=tab.getElementsByTagName('div');
	//给所有的选项卡标签加上同样的底色
	for(var i=0;i<tabElements.length;i++){
		if(tabElements[i].getAttribute('divType')=='tabMenu'){
			tabElements[i].style.backgroundColor='#EBF3FB';
			tabElements[i].style.backgroundColor='#FFFFFF';
		}
	}

	//
	var tabElements=tab.getElementsByTagName('div');
	//取当前选项卡的id，用于重构tabMenu与tabBody的id this.id就是形如 tab1_menu_1 这样的，
	//由processTab给每个块中的选项卡及选项卡标签所动态加的上id(制作页面时，可不用定义这样复杂的id，由程序自动加上)
	var tempId=this.id.split('_');
	var tabMenuId=tempId[0]+'_menu_'+tempId[2];//它实际上就是this.id,这所以这样处理一次是为了让程序看起来更对称
	//alert(this.id+"|"+tabMenuId);
	var tabBodyId=tempId[0]+'_body_'+tempId[2];
	//处理选项卡,隐藏除当前选项卡外的所有的tabBody

	for(var i=0;i<tabElements.length;i++){
		if(tabElements[i].getAttribute('divType')=='tabBody' && tabElements[i].id!=tabBodyId){
			//在ie下，若div被隐藏后又显示，其内部的图片的左边距会发生改变，产生的现象就是图形向左轻微的移动
			//因此，包含有图片列表的选项卡在第一次显示整体页面时处于显示状态，就不隐藏，这样就不会变形了。而当选中了别的
			//选项卡在返回此选项卡时，因为只有轻微的移动，用户感觉不出来
			//alert(window.getComputedStyle?window.getComputedStyle(tabBody,null).padding:tabBody.currentStyle["padding"]);
			tabElements[i].style.display='none';
		}
	}
	//改变当前显示当前选项卡标签的颜色
	var tabMenu=document.getElementById(tabMenuId);
	tabMenu.style.backgroundColor='#F0FFFF';
	tabMenu.style.backgroundColor='#FFFFFF';
	//显示当前选项卡
	var tabBody=document.getElementById(tabBodyId);
	tabBody.style.display='block';
	//把选项卡标签与选项卡连成一体
	addUnderLine(this);
	//对于有图片的栏目，给图片加标题
	imageListAddTitle();
}

//用于选不同的选项卡时，把卡与标签在视觉上连为一体的下边框
function addUnderLine(obj){
	var tab=obj.parentNode;//parentElement
	//加一个临时的div将标签与选项卡连接起来
	obj.style.borderBottom="solid 1px #F0FFFF";
	//由选项卡标签的id取得选项卡的id
	//实现原理，每个tab有一个动态添加的底线，位置在当前选中的div下面
	//但此时父层div的css中必须要定义其position,不能不写，即使就是默认的relative也必须定义，否则位置出错
	//可能有同学会问，为什么不这样处理：当鼠标移过时，将tabMenu的下框显示为白色，而将上下连为一体。其原因
	//在于tabMenu与tabBody都是相对定位，并且都在同一个父div里，因此他们的z-index是一样的，而tabBody后
	//定义，因此一定是tabBody在tabMenu上面， 因此无法直接实现，只能通过加下划线的方法解决
	if(document.getElementById(tab.id+'_borderBottom')){
		var objBorderBottom=document.getElementById(tab.id+'_borderBottom');
		objBorderBottom.style.position='absolute';
		objBorderBottom.style.display='block';
		//加的下划线的位置为 选项卡标签 所在位置向右偏移一个象素 正好在 选项卡标签 正下方
		objBorderBottom.style.left=(obj.offsetLeft+1)+'px';
	}else{
		var objBorderBottom=document.createElement('div');
		objBorderBottom.id=tab.id+'_borderBottom';
		objBorderBottom.style.position='absolute';
		objBorderBottom.style.display='block';
		objBorderBottom.style.top=obj.offsetHeight+'px';
		//加的下划线的位置为 选项卡标签 所在位置向右偏移一个象素 正好在 选项卡标签 正下方
		objBorderBottom.style.left=(obj.offsetLeft+1)+'px';
		//加的下划线的宽度为 选项卡标签 宽度－2 正好是除出左右边线的内部宽度
		objBorderBottom.style.width=(obj.offsetWidth-2)+'px';
		//alert(obj.offsetTop+"|"+obj.offsetLeft+"|"+obj.offsetHeight+"|"+obj.offsetWidth);
		//alert(obj.scrollTop+"|"+obj.scrollLeft+"|"+obj.scrollHeight+"|"+obj.scrollWidth);
		objBorderBottom.style.height='0px';
		objBorderBottom.style.margin='0px';
		objBorderBottom.style.padding='0px';
		objBorderBottom.style.borderTop='solid 1px #F0FFFF';
		//alert(obj.style.zIndex);
		objBorderBottom.style.zIndex=obj.style.zIndex+1;
		tab.appendChild(objBorderBottom);
	}

}

//给以列表方式显示的图片，在其底部加新闻标题 fielddset不行，在fielddset中显示的图片用这种方法加不起标题
function imageListAddTitle(){
	//获取所有div
	var allDivObj=document.getElementsByTagName('div');
	var objDiv=new Array();
	//取为图片列表的div
	for(var i=0,j=0;i<allDivObj.length;i++){
		var temp;
		//浏览器兼容
		if(window.getComputedStyle){
			temp=window.getComputedStyle(allDivObj[i],null).display;
		}else{
			temp=allDivObj[i].currentStyle["display"];
		}
		//var temp=window.getComputedStyle?window.getComputedStyle(allDivObj[i],null).display:allDivObj[i].currentStyle["display"];
		//仅取是图片列表div且为可见的div
		if(allDivObj[i].getAttribute('extraType')=='imageList' && temp=='block'){
			objDiv[j]=allDivObj[i];
			j++;
		}
	}
	for(var i=0;i<objDiv.length;i++){
		var objImages=objDiv[i].getElementsByTagName('img');
		//取每一个图片
		for(var j=0;j<objImages.length;j++){
			//补id
			if(objImages[j].id==''){
				objImages[j].id=objDiv[i].id+'_'+i+'_'+j;
			}
			//alert(objDiv[i].id+'|'+objImages[j].id);
			//加标题 一个图片列表div中可能有多个图片，因此把此div与包含的每分图片分别调用imageAddTitle进行加标题的处理
			imageAddTitle(objDiv[i],objImages[j]);
		}
	}
}
//给图片加文字标签
function imageAddTitle(objDiv,objImg){
	var tipTextDivId=objImg.id+'_tipTextDiv';
	if(document.getElementById(tipTextDivId)){
		var objTipTextDiv=document.getElementById(tipTextDivId);
	}else{
		//创建对应于每个图片的显示标题的div，此div的位置要根据所对应的图片的位置来动态生成
		var objTipTextDiv=document.createElement('div');
		var objTipTextDivdimension=16;
		//标签对应的图片的高度
		var objImgHeight=objImg.offsetHeight;
		//标签对应的图片的宽度
		var objImgWidth=objImg.offsetWidth;
		//标签对应的图片的坐标
		var objImgTop=objImg.offsetTop;
		//标签对应的图片的坐标
		var objImgLeft=objImg.offsetLeft;
		//alert(objImgHeight+'|'+objImgWidth+'|'+objImgTop+'|'+objImgLeft+'|');

		objTipTextDiv.id=tipTextDivId;
		objTipTextDiv.style.position='absolute';
		objTipTextDiv.style.top=(objImgHeight-10)+'px';
		objTipTextDiv.style.left=objImgLeft+'px';
		objTipTextDiv.style.width=objImgWidth+"px";
		objTipTextDiv.style.height=objTipTextDivdimension+'px';
		objTipTextDiv.style.textAlign='center';
		//用于调试，不要删除
		//objTipTextDiv.style.backgroundColor='#FF0000';
		//取标题 用innerHTML而不用innerText是为了浏览器兼容
		objTipTextDiv.innerHTML=objImg.getAttribute("alt");
		//alert(offsetTop+"|"+offsetLeft);
		objTipTextDiv.zIndex=objImg.zIndex+1;
		//alert(objTipTextDiv.id);
		//改变透明度
		//objTipTextDiv.style.filter="alpha(opacity=40)";
		//刚写这段程序是地，在些折腾了半天，原来搞成了向图片里添加div了。只有div可以实现此功能
		objDiv.appendChild(objTipTextDiv);
		//alert(objTipTextDiv.innerHTML);
	}
}


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


//幻灯片图片自适应所在div的大小
function adjustAlterImage(objDiv){
	var nextImage=0;
	var objDivId=objDiv.id
	//图片所在div的大小与偏移量
	var objDivHeight=objDiv.offsetHeight;
	var objDivWidth=objDiv.offsetWidth;
	var objDivTop=objDiv.offsetTop;
	var objDivLeft=objDiv.offsetLeft;
	//图片自适应所在div的大小
	var aImageObj=objDiv.getElementsByTagName("img");
	for(var i=0;i<aImageObj.length;i++){
		aImageObj[i].style.height=(objDivHeight-15)+"px";
		aImageObj[i].style.width=(objDivWidth-15)+"px";
	}
}

//控制指定div中的图片幻灯片效果
function alterImage(objDiv){
	//如果是第一次进入，或是已超过了预定的换图片的间隔时间，就进入流程，并间timeElapse设为0。否则直接返回，不进行轮换
	if(objDiv.timeElapse!=-1 && objDiv.timeElapse<objDiv.interval){
		objDiv.timeElapse=objDiv.timeElapse+1000;
		return;
	}else{
		objDiv.timeElapse=0;
	}
	//alert(objDiv.timeElapse+"|"+objDiv.interval);
	//第一次显示页面时，让幻灯片组的第一张为可显示状态
	var nextImage=0;
	//注意，如果多个幻灯片组的div是一样的，则会出问题。因此要给不同的幻灯片组的div加不同的id
	var objDivId=objDiv.id
	//alert(objDivId);
	//alert(objDiv.getAttribute('userDefineClass'));
	//图片所在div的大小与偏移量
/*	var objDivHeight=objDiv.offsetHeight;
	var objDivWidth=objDiv.offsetWidth;
	var objDivTop=objDiv.offsetTop;
	var objDivLeft=objDiv.offsetLeft;*/
	
	var objDivHeight=getContainerDimension(objDiv).height;
	var objDivWidth=getContainerDimension(objDiv).width;
	var objDivTop=getContainerDimension(objDiv).top;
	var objDivLeft=getContainerDimension(objDiv).left;
	
	

	var aImageObj=objDiv.getElementsByTagName("img");
	//如果还没有图片，就退出，否则出错
	if(aImageObj.length<=0){
		return;
	}
	//alert(objDivWidth+"|"+objDivHeight);
	for(var i=0;i<aImageObj.length;i++){
		if(aImageObj[i].style.display=='block'){
			//找到下一个应该被显示出来的图片
			nextImage=i+1;
			//如果已到最后一张，则重新让第一张呈可显示状态
			if(nextImage>=aImageObj.length){
				nextImage=0;
			}
			break;
		}
	}
	//alert(nextImage);
	//将全部的图片设为不可见
	for(var i=0;i<aImageObj.length;i++){
		aImageObj[i].style.display='none';
	}
	//显示当前图片
	aImageObj[nextImage].style.display='block';
	//图片的高度
	var objImgHeight=aImageObj[nextImage].offsetHeight;
	//图片的宽度
	var objImgWidth=aImageObj[nextImage].offsetWidth;
	//图片的y坐标
	var objImgTop=aImageObj[nextImage].offsetTop;
	//图片的x坐标
	var objImgLeft=aImageObj[nextImage].offsetLeft;
	//alert(objImgHeight+'|'+objImgWidth+'|'+objImgTop+'|'+objImgLeft)
	//文字标签,就是新闻标题
	try{
		var tipTextDivId=objDivId+'tipTextDiv';
		if(document.getElementById(tipTextDivId)){
			var objTipTextDiv=document.getElementById(tipTextDivId);
			//alert(objTipTextDiv);
		}else{
			var objTipTextDiv=document.createElement('div');
			var objTipTextDivdimension=16;
			objTipTextDiv.id=tipTextDivId;
			objTipTextDiv.style.position='absolute';
			objTipTextDiv.style.top=objTipTextDivdimension+'px';
			//提示文本的所在DIV的top坐标为所对应的图片的top位置向下偏移5个象素
			objTipTextDiv.style.top=objImgTop+5+'px';
			//div与图片对齐，文字居中，则效果出来了
			objTipTextDiv.style.left=objImgLeft+'px';
			objTipTextDiv.style.width=objImgWidth+"px";
			objTipTextDiv.style.height=objTipTextDivdimension+'px';
			objTipTextDiv.style.textAlign='center';
			//objTipTextDiv.style.backgroundColor='#CCCCCC';
			//objTipDiv.innerText=i+1;
			objTipTextDiv.zIndex=objDiv.zIndex+1;
			//改变透明度
			objTipTextDiv.style.filter="alpha(opacity=40)";
			objDiv.appendChild(objTipTextDiv);
		}
	}catch(e){
	}
	//显示相对应的tipImage 就是幻灯片的编号
	//alert(aImageObj.length)
	for(var i=0;i<aImageObj.length;i++){
		try{
			//数字提示符
			var tipDivId=objDivId+'tipDiv'+i;
			//alert(document.getElementById(tipDivId));
			if(document.getElementById(tipDivId)){
				var objTipDiv=document.getElementById(tipDivId);
				objTipDiv.style.backgroundColor=objTipDiv.onMouseOutColor;
				objTipDiv.style.filter="alpha(opacity=40)";
			}else{
				var objTipDiv=document.createElement('div');
				var objTipDivdimension=16;
				objTipDiv.id=objDivId+'tipDiv'+i;
				objTipDiv.current=i;
				objTipDiv.style.position='absolute';
				//objTipDiv.style.top=objDivHeight/4*3+'px';
				objTipDiv.style.top=(objDivHeight-3*objTipDivdimension)+'px';
				//alert(objImgTop+'|'+objImgHeight+'|'+objTipDivdimension);
				objTipDiv.style.top=(objImgHeight-objTipDivdimension-4)+'px';
				//alert(objTipDiv.id)
				objTipDiv.style.left=(objDivWidth-aImageObj.length*objTipDivdimension)/2+(i*objTipDivdimension)+i*4+'px';
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
				//改变透明度 firefox下不起作用
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
			objTipTextDiv.innerHTML=aImageObj[i].getAttribute("alt");
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
	//当鼠标移动到某张幻灯片所对应的编号上时，先隐藏所有的图片，在把对应的这张显示出来
	for(var i=0;i<aObj.length;i++){
		aObj[i].style.display='none';
	}
	//alert(this.current);
	//current为自定义属性，存储了每个 数字提示所对应的编号（值为编号－1，因为是从0开始的）相当于每张图片对象数组的下标
	aObj[this.current].style.display='block';//这个是tipDiv对应的图片
	this.style.backgroundColor=this.onMouseOverColor;
	this.style.filter="alpha(opacity=90)";
}

function showAlterImages(){
	var objDiv=document.getElementsByTagName("div");
	//此处不能加var，表示定义的是全局变量
	try{
		if(objAlterImageDiv){
			for(var i=0,j=0;i<objDiv.length;i++){
				//如果是用于显示幻灯片的div
				if(objDiv[i].getAttribute('userDefineClass')=='alterImage'){
					objAlterImageDiv[j]=objDiv[i];
					alterImage(objAlterImageDiv[j]);
					j++;
				}
			}
		}
	}
	catch(e){
		//第一次进入时，初始化图片对象数组及相关属性
		objAlterImageDiv=new Array();
		for(var i=0,j=0;i<objDiv.length;i++){
			//如果是用于显示幻灯片的div
			if(objDiv[i].getAttribute('userDefineClass')=='alterImage'){
				objAlterImageDiv[j]=objDiv[i];
				//取得在html里定义的图片轮换时间
				objAlterImageDiv[j].interval=objAlterImageDiv[j].getAttribute('interval');
				//存储时间的流逝，用于判断是否该换下一张图片来显示,第一次进入时用-1(在alterImage里可以处理-1)，这样才能把图片直接显示出来，否则要等上一段时间才显示
				objAlterImageDiv[j].timeElapse=-1;
				//调整div内的图片大小
				adjustAlterImage(objAlterImageDiv[j]);
				alterImage(objAlterImageDiv[j]);
				j++;
			}
		}
	}
	//原理说明见下面的testInterval()。无法给每一组幻灯片组加上独立的setTimeout处理事件。主要原因是这些幻灯片组对象是动态
	//生成的，无法绑定定时器。
	window.setTimeout(showAlterImages,1000);
}
function getContainerDimension(obj){
	//容器的高度
	var height=obj.offsetHeight;
	//容器的宽度
	var width=obj.offsetWidth;
	//容器的y坐标
	var top=obj.offsetTop;
	//容器的x坐标
	var left=obj.offsetLeft;
	return {height:height,width:width,top:top,left:left};
}
//objContainerDiv=$('bodyLeftDiv');
//var a=getContainerDimension(objContainerDiv);
//alert(a.height+'|'+a.width+'|'+a.top+'|'+a.left);
function showMovableDiv(){
	var objDivContiner=$('bodyLeftDiv');
	var objDivMovable=objDivContiner.getElementsByTagName("div");
	var objDivContinerDimension=getContainerDimension(objDivContiner);
	for(var i=0;i<objDivMovable.length;i++){
		//alert(objDivMovable[i].offsetHeight);
		objDivMovable[i].style.top=objDivContinerDimension.top+i*(objDivMovable[i].offsetHeight+10)+'px';
		objDivMovable[i].style.left=objDivContinerDimension.left+'px';
		objDivMovable[i].onmousemove=function(){
			//alert(this.id);
			this.style.cursor="move";
		}
	}
}
function getMousePosition(){
	var x=window.event.x;
	var y=window.event.y;
	return {x:x,y:y}
}
//处理滑动窗口
function showSlideDiv(){
	var objSlide=$('slide');
	//浏览器兼容
	if(window.getComputedStyle){
		var bottom=window.getComputedStyle(objSlide,null).bottom;
	}else{
		var bottom=objSlide.currentStyle["bottom"];
	}
	bottom=parseInt(bottom);
	if(bottom>0){
		return;
	}
	objSlide.style.bottom=bottom+1+'px';
	objSlide.style.display='block';
	objSlide.style.backgroundColor='#FFFFFF';
	window.setTimeout('showSlideDiv()',10);
	//alert(objSlide.style.width);
}
function closeSlideDiv(){
	var objSlide=$('slide');
	//浏览器兼容
	if(window.getComputedStyle){
		var bottom=window.getComputedStyle(objSlide,null).bottom;
	}else{
		var bottom=objSlide.currentStyle["bottom"];
	}
	bottom=parseInt(bottom);

	if(bottom<-150){
		objSlide.style.display='none';
		return;
	}
	objSlide.style.bottom=bottom-1+'px';
	objSlide.style.display='block';
	objSlide.style.backgroundColor='#FFFFFF';
	window.setTimeout('closeSlideDiv()',10);
	//alert(objSlide.style.width);
}
var xmlHttp;
function getHitTimes(){
	xmlHttp=getXmlHttpObject();
	url='/default/index/addhittimes/sid/'+Math.random();
	xmlHttp.onreadystatechange=handleStateChange;
	xmlHttp.open('GET',url,true);
	xmlHttp.send(null);

}
function handleStateChange(){
	if(xmlHttp.readyState==4 && xmlHttp.status==200){
		//注：firefox不支持innerText
		var objDiv=$('hit_times');
		//alert(xmlHttp.responseText);
		objDiv.innerHTML=xmlHttp.responseText;
	}
}


function testInterval(){
	var aObj=new Array();
	for(var i=0;i<2;i++){
		aObj[i]=new Object();
		aObj[i].id=i;
		alert(aObj[i].id);
	}
	//JS里无法实现这样的动态指定重复操作。因为在第一次执行时this的确指向了一个有效的aObj，但当第二次时，this
	//指向了window本身，而不是aObj,因为setTimeout是window。
	window.setTimeout(this.testInterval,2000);
}
//testInterval();
function $(id){
	return document.getElementById(id);
}
function getXmlHttpObject(){
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
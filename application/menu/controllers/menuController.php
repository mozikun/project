<?php
/**
 * 本模块演示5dMVC menu
 * 
 * @author www.phpchengdu.com 罗维
 *
 */
class menu_menuController extends controller {
	public function testAction(){
		//引入本页面中用到的表对象定义文件
		require_once(__SITEROOT.'library/models/menu.php');
	
		
	}
	public function listAction(){
		//echo "in list action";
		require_once(__SITEROOT.'library/models/menu.php');
		
		//用变量$id而不用menuId是因为所有的分类程序写法都一样的，方便代码复制
		$id=$this->_request->getParam('id','1');
		//echo $id;
		//处理导航　此代码等同于分类列表中的导航
		require_once('menu_navigation.php');

		//取当前节点的所有下级节点
		$menu=new Tmenu();
		//$organization->_parent_id 这种写法是取加了表名的字段名　用于表名与字段名都很复杂的场所
		$menu->whereAdd("parent_id='$id' and id!='1'");
		$menu->orderby('inner_order desc');
		//$menu->debugLevel(9);
		$menu->select();
		$menuList=array();
		$counter=0;
		//频道1,分类2,栏目3
		$propertyArray=array('1'=>'频道','2'=>'分类','3'=>'栏目');
		while ($menu->fetch()){
			$menuList[$counter]['id']=$menu->id;
			$menuList[$counter]['description']=$menu->description;
			//$menuList[$counter]['property']=$propertyArray[$menu->property];
			$counter++;
		}
		//var_dump($organizationList);
		//用于列表
		$smartyTag="menuList";
		$this->view->assign($smartyTag,$menuList);
		//用于编辑与新增时
		$smartyTag="id";
		$this->view->assign($smartyTag,$id);
		//当无记录时显示提示信息
		$smartyTag='noRecordMessage';
		$this->view->assign($smartyTag,$counter==0?'当前无满足条件的数据':'');
		//获取当前节点的父节点
		if($id=='1'){
			$parent_id='1';
		}else{
			$menu=new Tmenu();
			$menu->whereAdd("id='$id'");
			$menu->debugLevel(9);
			$menu->select();
			$menu->fetch();
			//var_dump($menu->parent_id);
			$parent_id=$menu->parent_id;
			//echo $parent_id;
		}
		//用于返回到上一次
		$smartyTag="parent_id";
		$this->view->assign($smartyTag,$parent_id);
		//echo $url;
		$this->view->assign('message',isset($_GET['message'])?$_GET['message']:'');
		$this->view->assign('__BASEPATH',__BASEPATH);
		$this->view->display('list.html');
	}
	public function addAction(){
		//$organizationId=$_GET['organizationId'];
		//获取父节点编码。新增时，传过来的实际上父节点的id
		$parentId=$_GET['id'];
		//检查此$parentId
		$menu=new Tmenu();
		$menu->whereAdd("id='$parentId'");
		$menu->select();
		$menu->fetch();
		if($menu->id==''){
			echo "编码错";
			exit();
		}
		//获取父节点的path
		$path=$menu->path;
		//取最后的编号
		/*		$organization=new Torganization();
		$organization->orderby('organization_id desc');
		$organization->limit(0,1);
		//$organization->debug(1);
		$organization->select();
		$organization->fetch();*/
		//采用顺序号的方式
		//$neworganizationId=intval($organization->id)+1;
		//采用随机号的方式
		$newMenuId=uniqid();
		$menu=new Tmenu();
		$menu->uuid=$newMenuId;
		$menu->id=$newMenuId;
		$menu->parentId=$parentId;
		$menu->description='新栏目';
		//新增加的栏目的默认属性为内容栏目，代码为3
		$menu->property='3';
		//新增加的栏目的默认动作为1 显示列表 如果一级菜单，则只有动作2是有效的，表示直接打开内容  二级菜单可为1 或是 2
		$menu->action='1';
		$menu->index=1;
		$menu->path=$path.",".$newMenuId;
		$menu->insert();
		header("location:".__BASEPATH."management/menu/display/id/$newMenuId/message/");
	}
	/**
	 * 显示数据
	 *
	 */
	public function displayAction(){
		require_once(__SITEROOT."config/smarty_config.php");
		$id=$_GET['id'];
		$message=$_GET['message'];
		//检查此$menuId的有效性
		$menu=new Tmenu();
		$menu->whereAdd("id='$id'");
		$menu->select();
		$menu->fetch();
		if($menu->id==''){
			echo "编码错";
			exit();
		}
		$view->assign('id',$menu->id);
		$view->assign('parentId',$menu->parentId);
		$view->assign('description',$menu->description);
		$view->assign('index',$menu->index);
		$view->assign('message',$message);
		//频道1,分类2,栏目3
		$propertyArray=array('1'=>'频道','2'=>'分类','3'=>'栏目');
		foreach ($propertyArray as $key=>$value){
			$smartyTag='checkProperty_'.$key;
			//echo $smartyTag;
			if($key==$menu->property){
				$tempString='checked';
			}else{
				$tempString='';
			}
			$view->assign($smartyTag,$tempString);
		}
		//1列表,2内容
		$actionArray=array('1'=>'列表','2'=>'内容');
		foreach ($actionArray as $key=>$value){
			$smartyTag='checkAction_'.$key;
			//echo $smartyTag;
			if($key==$menu->action){
				$tempString='checked';
			}else{
				$tempString='';
			}
			$view->assign($smartyTag,$tempString);
		}
		$view->assign('__BASEPATH',__BASEPATH);
		$view->display('menu/display.html');
	}
	public function editAction(){
		$id=$_POST['id'];
		$parentId=$_POST['parentId'];
		//echo $menuId."|".$parentId;
		//检查是否把当前分类放到了自身及以下
		$currentMenu=new Tmenu();
		$currentMenu->whereAdd("id='$id'");
		$currentMenu->select();
		$currentMenu->fetch();
		//修改前该节点的path,用于修改该节点所有下级子节点path时用
		$currentMenuOldPath=$currentMenu->path;
		$parentMenu=new Tmenu();
		$parentMenu->whereAdd("id='$parentId'");
		$parentMenu->select();
		$parentMenu->fetch();
		//$pos = strpos('1,2,3', '1,2,3,5');false
		//$pos = strpos('1,5,7', '1,2,3,5');false
		//$pos = strpos('1,2,3,5', '1,2,3,5');true
		//$pos = strpos('1,2,3,5', '1,2,3');true
		//判断是否修改了path，与新的parent节点的path进行比较。（注，就算是没有移动，也是根据parentId重新获取当前parent的path）
		$pos = strpos($parentMenu->path, $currentMenu->path);
		//用节点的path与新的parent的path进行比较。
		//如果新的parent的path不是自身及以下（可能的情况就是用户并没有修改所属父类，或是修改到了一个合法的父类下,在这些情况下，其path与parent的path比较时总是返回false）则可以修改
		//如果移动到了新节点下，并且新节点不是自身及以下，则修改当前节点的parent_id及所有下级节点的path
		if($pos===false){
			$description=$_POST['description'];
			$index=$_POST['index']!=''?intval($_POST['index']):1;
			$property=$_POST['property'];
			$action=$_POST['action'];
			$currentMenu=new Tmenu();
			$currentMenu->whereAdd("id='$id'");
			//这里的$parentId来自提交上来的隐藏控件中的值，其值当分类下拉框被操作时会同步做修改。因此总是存储着最后一次选定的父节点的id
			$currentMenu->parentId=$parentId;
			$currentMenu->description=$description;
			$currentMenu->property=$property;
			$currentMenu->action=$action;
			$currentMenu->index=$index;
			//$path=$parentMenu->path.",".$menuId;
			$currentMenu->path=$parentMenu->path.",".$id;
			//$menu->debug(1);
			if($currentMenu->update()){
				$message='修改成功';
			}else{
				$message='修改失败';
			}
			//如果修改了path，则同时修改该节点所有下级节点的path
			//$newPath=$menu->path;
			if($currentMenuOldPath!=$currentMenu->path){
				$childrenMenu=new Tmenu();
				$childrenMenu->whereAdd("id!='$id'");//不处理自身
				$childrenMenu->whereAdd("path like '$currentMenuOldPath%'");//必须用path来处理所有下级
				//$childrenMenu->debug(1);
				$childrenMenu->select();
				//取出除自身外的所有下级节点
				while ($childrenMenu->fetch()){
					$childMenu=new Tmenu();
					$childMenu->whereAdd("id='$childrenMenu->id'");
					//注意这里比较特殊，要先fetch，取得$childMenu->path后，在update
					$childMenu->select();
					$childMenu->fetch();
					//$currentMenu->path：该节点的新path
					//substr($childMenu->path,strlen($currentMenuOldPath)+1)：属于该节点的子节点从path中删除原来该节点旧的path的部分
					$childMenu->path=$currentMenu->path.",".substr($childMenu->path,strlen($currentMenuOldPath)+1);

					$childMenu->update();
				}
			}else{
			}
		}else{
			$message='不能把分类项目移动到自身及其以下分类';
		}
		//echo $message;
		$url=__BASEPATH."management/menu/display/id/$id/message/$message";
		//echo $url;
		header("location:$url");


	}
	public function deleteAction(){
		$id=$_GET['id'];
		$menu=new Tmenu();
		$menu->whereAdd("id='$id'");
		$menu->select();
		$menu->fetch();
		$path=$menu->path;
		//取$parentId的目的在于删除该类后返回其父类的列表。
		$parentId=$menu->parentId;
		//根据path统计该类是否有子类
		$menu=new Tmenu();
		$menu->whereAdd("path like '$path%'");
		$allowDelete=true;
		//这里必须是大于１，因为自身的path也满足条件
		if($menu->count('uuid')>1){
			$message=urlencode("该分类已有子类，不能删除");
			//$url="/management/menu/list/id/$parentId/message/$message";
			$allowDelete=false;
		}
		//如果测试时要强行删除所有的下级，可把这个注释去掉
		//$allowDelete=true;

		if($allowDelete){
			$menu=new Tmenu();
			$menu->whereAdd("id='$id'");
			$menu->delete();
			$message=urlencode("删除成功");
			//$url="/management/menu/list/id/$parentId/message/$message";
		}
		//删除一个分类时，将其下属所有分类全部删除的代码
		//$menu->whereAdd("path like '$path%'");
		//$menu->delete();


		$url=__BASEPATH."management/menu/list/id/$parentId/message/$message";
		header("location:$url");

	}


	/**
	 * 生成分类下拉框
	 * 原理：
	 * 页面上通过ajax提交上来的一个分类id
	 * 通过这个id，把此id获取所有的父id　通过path获取，避免递归
	 * 将获取的所有父id生成一个数组
	 * 循环此数组
	 * 生成每一次的下拉框
	 */
	public function menuDropDownBoxAction(){
		$id=$_GET['parentId'];
		//echo $menuId;
		//$action=$_GET['action'];//选择，有menu 与goods 默认是menu 。用于控制下拉框是否仅显示分类，如果有goods则还要显示最末一下级面的商品
		$menu=new Tmenu();
		$menu->whereAdd("id='$id'");
		$menu->select();
		$menu->fetch();
		$path=$menu->path;
		$pathArray=explode(',',$path);
		//var_dump($pathArray);
		$dropDownBox='';
		//有了path就不用递归，path里有每一级的id，通过这些id就能把每一级的下一级取出来形成下拉框
		for($i=0;$i<count($pathArray);$i++){
			$menu1=new Tmenu();
			$menu1->whereAdd("parentId='$pathArray[$i]'");
			//如果没有下级分类就continue
			if($menu1->count('*')<=0){
				continue;
			}else{

			}
			$menu1=new Tmenu();
			$menu1->whereAdd("parentId='$pathArray[$i]'");
			$menu1->select();
			$dropDownBox=$dropDownBox."<select onchange='changeValue(this.value)'>";
			//除第一次下拉框外，都提供一个'请选择'的选项
			if($menu1->id!='1'){
				$dropDownBox=$dropDownBox."<option value='-9'>请选择</option>";
			}
			while ($menu1->fetch()){
				if(in_array($menu1->id,$pathArray)){
					$dropDownBox=$dropDownBox."<option value='$menu1->id' selected>$menu1->description</option>";
				}else{
					$dropDownBox=$dropDownBox."<option value='$menu1->id'>$menu1->description</option>";
				}
			}
			$dropDownBox=$dropDownBox."</select>";
		}
		echo $dropDownBox;
		exit();
	}		
	
}

<?php
class region_regionController extends controller {
	public function testAction(){
		require_once __SITEROOT."library/Models/test1.php";
		//require_once __SITEROOT."library/Models/test2.php";
		$test1=new Ttest1();
		$test1->startTransaction();
		$test1->id='1';
		if($test1->insert()){
			echo 'ok';
			$test1->commit();
		}else{
			echo 'failure';
			$test1->rollBack();
		}
	}
	public function init(){
		//用户认证与权限
		if( $this->getActionName()=='menuDropDownBoxIha' or $this->getActionName()=='menuDropDownBox' or
		$this->getActionName()=='menuDropDownBox1' or
		$this->getActionName()=='directorDropDownBox' or
		$this->getActionName()=='refresh' or
		$this->getActionName()=='c1' or
		$this->getActionName()=='cr' or
		$this->getActionName()=='c'  or
		$this->getActionName()=='menuDropDownBoxNew'
		){
			$this->haveWritePrivilege='';
			
		}
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/individual_core.php');
		require_once(__SITEROOT.'library/Models/staff_core.php');
		require_once(__SITEROOT.'library/Models/family_archive.php');
		require_once(__SITEROOT.'library/Models/tips.php');
		require_once(__SITEROOT.'library/Models/tips_type.php');
		require_once(__SITEROOT.'library/Models/standard_archive_rate.php');
		$this->view->basePath=__BASEPATH;

		// echo __SITEROOT;
	}
	public function displayAction(){
		$id = $this->_request->getParam('id');
		$region = new Tregion();
		$region->whereAdd("id='$id'");
		// $listRegion->debugLevel(9);
		$region->find(true);
		$this->view->zh_name=$region->zh_name;
		$this->view->standard_code=$region->standard_code;
		$this->view->id=$region->id;
		$this->view->p_id=$region->p_id;
		$this->view->basePath=__BASEPATH;
		$length=count(explode(',',$region->region_path));
		if($length<=5){
			$this->view->standard_code_size=6;
		}else{
			$this->view->standard_code_size=3;
		}
		$this->view->display('display.html');
	}
	public function indexAction(){
		//获取当前数据表如果没有任何数据就首先创建一个根节点
		$category = new Tregion();
		$nuNumber = $category->count();
		//echo $nuNumber;
		if($nuNumber=='0'){
			$id = '0';
			$category->id = $id;
			$category->p_id = $id;
			$category->region_path = $id;
			$category->zh_name = '全部地区';
			$category->uuid = $id;
			$category->insert();
		}else{
			//否则就列表显示除根目录外的第一级目录
			$this->redirect('listregion');
		}
	}
	public function listregionAction(){
		if($this->acl->isAllowed($this->role_en_name,'region_core','w')){
			//显示列表
			$region_core_edit=1;
		}else{
			//不显示列表
			$region_core_edit=2;
		}
		//echo $this->role_en_name."|".$region_core_edit;
		//分页调用
		require_once __SITEROOT."/library/custom/pager.php";
		//获取需要添加类别的当前父ID
		$p_id = $this->_request->getParam('parent_id','');
		$errorMessage = $this->_request->getParam('errorMessage','');
		//var_dump($this->user);
		$regionDomain = $this->user['region_id'];
		//echo $$regionDomain;
		$p_id = empty($p_id)?$regionDomain:$p_id;
		//echo 'pid'.$parentId;
		// exit();
		//$listRegion = new Tregion();
		//$listRegion->whereAdd("id='0'");
		// $listRegion->debugLevel(9);
		//$listRegion->find(true);
		//$p_id = empty($parentId)?0:$parentId;
		//列表显示父ID等于1但是ID不等于1的所有数据(不显示根)
		$this->view->basePath = $this->_request->getBasePath();
		//获取分页参数
		$currentPage = intval($this->_request->getParam('page'));
		$realPage    = empty($currentPage)?1:$currentPage;
		//获取总的记录数
		$allNumber = new Tregion();
		$allNumber->whereAdd("id<>0");
		$allNumber->whereAdd("p_id='$p_id'");
		$numNumber = $allNumber->count();
		$arrArg = array();
		$links = new SubPages(__ROWSOFPAGE,$numNumber,$realPage,__goodsListRowOfPage,__BASEPATH.'region/region/listregion/parent_id/'.$p_id.'/page/',3,$arrArg);
		$pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		if($numNumber>0){
			$menuClass = new Tregion();
			$menuClass->whereAdd("id<>'0'");
			$menuClass->whereAdd("p_id='$p_id'");
			$menuClass->orderby('id asc');
			$menuClass->limit($startnum,__ROWSOFPAGE);
			// $menuClass->debugLevel(9);
			$menuClass->find();
			$row = array();
			$rowCount = 0;
			while($menuClass->fetch()){
				$row[$rowCount]['id'] = trim($menuClass->id);
				$row[$rowCount]['zh_name'] = $menuClass->zh_name;
				$row[$rowCount]['region_path'] = $menuClass->region_path;
				$row[$rowCount]['standard_code'] = $menuClass->standard_code;
				$row[$rowCount]['p_id'] = trim($menuClass->p_id);
				$row[$rowCount]['standard_code'] = trim($menuClass->standard_code);
				$row[$rowCount]['region_core_edit'] = $region_core_edit;
				$currentLength = count(explode(',',$menuClass->region_path));
				$row[$rowCount]['current_length'] = $currentLength;
				if($currentLength=="6"){
					$this->view->firstcu = "30%";
					$this->view->secondcu = "20%";
					$str = '[地区扩展信息]';
					$this->view->str = $str;
				}else{
					$this->view->firstcu = "25%";
					$this->view->secondcu = "25%";
				}
				$rowCount++;
			}
			//var_dump($row);
			$this->view->assign('row',$row);
		}else{
			$msg = '<tr><td colspan="7" align="center"><strong>当前没有任何地区!</strong></td></tr>';
			$this->view->msg = $msg;
			$this->view->firstcu = "25%";
			$this->view->secondcu = "25%";
		}
		$this->view->nowpage = $realPage;
		$pageNew = $links->subPageCss2();
		$this->view->assign('add_need_id',$p_id);
		$this->view->assign('basePath',__BASEPATH);
		$this->view->page = $pageNew;
		//获取所有path 根据登录者的地区id，限制导航条只能在该用户所在的区域内
		$pathSel = new Tregion();
		$pathSel->whereAdd("id='$p_id'");
		$pathSel->find(true);
		$currentPath = $pathSel->region_path;//处理path
		$nuNumber = strpos($currentPath,$regionDomain);
		$strNumber = intval(strlen($currentPath)-$nuNumber);
		$newCurrentPath = substr($currentPath,$nuNumber,$strNumber);
		$realPath = explode(',',$newCurrentPath);
		$realCount = count($realPath);
		$rs = array();
		$rsCount = 0 ;
		foreach ($realPath as $k=>$v){
			$realMenu = new Tregion();
			$realMenu->whereAdd("id='$v'");
			$realMenu->find(true);
			$rs[$rsCount]['zh_name'] = $realMenu->zh_name;
			$rs[$rsCount]['id'] = trim($realMenu->id);
			$rs[$rsCount]['p_id'] = trim($realMenu->p_id);
			$rsCount++;
		}
		$this->view->assign('rs',$rs);
		//获取当前表中所有栏目内容(除去根)
		$length=count(explode(',',$pathSel->region_path));
		//echo $length;
		if($length<=4){
			$this->view->standard_code_size=6;
		}else{
			$this->view->standard_code_size=3;
		}
		$this->view->errorMessage=$errorMessage;
		$this->view->display('listregion.html');
	}
	public function addregionAction(){
		//echo __LINE__;
		//查找数据库中当前最大的ID以便进行添加新的记录
		$addNeedId = $this->_request->getParam('need_add_id');
		$zh_name = trim($this->_request->getParam('region_name'));
		$standard_code = trim($this->_request->getParam('standard_code'));
		$region = new Tregion();
		$region->orderby("id DESC");
		$region->limit(0,1);
		$region->find(true);
		$newRegionId = intval($region->id+1);
		/*		$menu = new Tregion();
		$menuNewid = $newMenuId;
		//取出当前地区所属上级地区的PATH
		$menu->whereAdd("id='$addNeedId'");
		//$menu->debugLevel(9);
		$menu->find(true);*/
		$region = new Tregion();
		//取出当前地区所属上级地区的PATH
		$region->whereAdd("id='$addNeedId'");
		$region->find(true);
		$parent_region_path=$region->region_path;
		$newPath = $parent_region_path.','.$newRegionId;
		if($this->_request->getParam('need_add_id')){
			if(!empty($zh_name) and !empty($standard_code)){
				//判断内部码是否重复
				//$regionCode = new Tregion();
				//$regionCode->whereAdd("standard_code='$codeName'");
				/*				if($regionCode->count()>0){
				//echo '<script typr="javascript">window.alert("内部码重复?请返回重新添加!");history.go(-1);</script>';
				}else{
				$menu->id = $menuNewid;
				$menu->uuid = $menuNewid;
				$menu->zh_name = $menuName;
				$menu->p_id = $addNeedId;
				$menu->region_path = $newPath;
				$menu->standard_code = $codeName;
				//$menu->debugLevel(9);
				if($menu->insert()){
				$this->redirect(__BASEPATH.'region/region/listregion/parent_id/'.$addNeedId);
				}
				}
				*/
				$region = new Tregion();
				$region->id = $newRegionId;
				$region->uuid = uniqid('r_',true);
				$region->zh_name = $zh_name;
				$region->p_id = $addNeedId;
				$region->region_path = $newPath;
				$region->standard_code = $standard_code;
				//增加生成standard_code_path的代码
				require_once(__SITEROOT.'library/custom/region_array.php');
				$region_path_array=explode(',',$parent_region_path);
				$standard_code_path='';
				foreach ($region_path_array as $value){
					$standard_code_path=$standard_code_path.$regionInfo[$value][1].',';
				}
				$standard_code_path=$standard_code_path.$regionInfo[$newRegionId][1];
				$region->standard_code_path = $standard_code_path;


				//$region->debugLevel(9);
				if($region->insert($this->user['uuid'])){
					$this->createRegionArray();
					//echo __LINE__;
					$this->redirect(__BASEPATH.'region/region/listregion/parent_id/'.$addNeedId);
				}
			}else{
				echo '<script type="text/javascript">window.alert("请输入您的地区名称和地区编码");history.go(-1);</script>';
			}
		}
		//$this->view->display('add_category.html');
	}

	public function delregionAction(){
		$currentId = $this->_request->getParam('current_id');
		$delMenu = new Tregion();
		$delMenu->whereAdd("id='$currentId'");
		$delMenu->find(true);
		$parentId = $delMenu->p_id;
		$oldPath  = $delMenu->region_path;

		$region=new Tregion();
		$region->whereAdd("region_path like '$oldPath%'");
		$number=$region->count();
		if($number>1){
			//echo '<script type="text/javascript">window.alert("该地区下已经有子地区，不能删除！");history.go(-1);</script>';
			$errorMessage="该地区下已经有下级地区，不能删除!";
			$url=__BASEPATH."region/region/listregion/parent_id/".$parentId."/errorMessage/".$errorMessage;
			//echo $url;
			$this->redirect($url);
			exit();
		}
		$organization=new Torganization();
		$organization->whereAdd("region_path like '$oldPath%'");
		$organization->count();
		$number=$organization->count();
		if($number>0){
			//echo '<script type="text/javascript">window.alert("该地区下已建立机构，不能删除！");history.go(-1);</script>';
			$errorMessage="该地区下已建立机构，不能删除!";
			$url=__BASEPATH."region/region/listregion/parent_id/".$parentId."/errorMessage/".$errorMessage;
			//echo $url;
			$this->redirect($url);
			exit();
		}
		$individual=new Tindividual_core();
		$individual->whereAdd("region_path like '$oldPath%'");
		$number=$individual->count();
		if($number>0){
			//echo '<script type="text/javascript">window.alert("该地区下已建立档案，不能删除！");history.go(-1);</script>';
			$errorMessage="该地区下已建立档案，不能删除!";
			$url=__BASEPATH."region/region/listregion/parent_id/".$parentId."/errorMessage/".$errorMessage;
			//echo $url;
			$this->redirect($url);
			exit();
		}

		$region=new Tregion();
		$region->whereAdd("id='$currentId'");
		$region->delete($this->user['uuid']);
		$errorMessage="该地区已删除!";
		$this->redirect(__BASEPATH."region/region/listregion/parent_id/".$parentId."/errorMessage/".$errorMessage);
		exit();
	}
	public function editregionAction(){
		//require_once(__SITEROOT.'library/Models/organization.php');
		//		$getNewId = $this->_request->getParam('current_id');
		//		// echo $getNewId;
		//		$menuNameEdit = $this->_request->getParam('menu_name_edit');
		//		$lastName  = $this->_request->getParam('last_name');
		//		$editCode  = trim($this->_request->getParam('edit_code'));
		//		$ok2  = $this->_request->getParam('ok2');
		//echo $getNewId;
		//echo $menuNameEdit;
		$p_id  = $this->_request->getParam('p_id');
		$id  = $this->_request->getParam('id');
		$zh_name  = $this->_request->getParam('zh_name');
		$method=$this->_request->getParam('method','move');
                                      $org_name = $this->_request->getParam('org_name');//地区移动后指定的机构号
                                      $doctor  = $this->_request->getParam('doctor');//转移地区后指定的医生列表
		//echo 'zh_name'.$zh_name;
		$standard_code  = $this->_request->getParam('standard_code');
                                      
		//检查是否把当前分类放到了自身及以下
		$currentRegion=new Tregion();
		$currentRegion->whereAdd("id='$id'");
		$currentRegion->select();
		$currentRegion->fetch();
		//修改前该节点的path,用于修改该节点所有下级子节点path时用
		$currentRegionOldPath=$currentRegion->region_path;
		//注意是新的p_id而不是原来的p_id
		$parentRegion=new Tregion();
		$parentRegion->whereAdd("id='$p_id'");
		$parentRegion->select();
		$parentRegion->fetch();
		$moveRegion=false;
		//不能直接用parent 的region_path + id 与当前的region_path比较
		//判断是否修改了path，与新的parent节点的path进行比较。（注，就算是没有移动，也是根据parentId重新获取当前parent的path）
		$pos = strpos($parentRegion->region_path, $currentRegion->region_path);
		if($pos===false){
			//$description=$_POST['description'];
			//$index=$_POST['index']!=''?intval($_POST['index']):1;
			//$property=$_POST['property'];
			//$action=$_POST['action'];
			$currentRegion=new Tregion();
			$currentRegion->whereAdd("id='$id'");
			$currentRegion->p_id=$p_id;
			$currentRegion->zh_name=$zh_name;
			$currentRegion->standard_code=$standard_code;
			$currentRegion->region_path=$parentRegion->region_path.",".$id;
					//echo "<br /> currentRegion->region_path:".$currentRegion->region_path."---------------------------<br />";
			
			$temp=explode(',',$currentRegion->region_path);
			$currentRegion->region_level=count($temp);
			//$currentRegion->debugLevel(9);
			//if($currentRegion->update(array($this->user['uuid']))){
			if($currentRegion->update()){
				$message='修改成功';
			}else{
				$message='修改失败';
			}
			//如果修改了path，则同时修改该节点所有下级节点的path
			//$newPath=$menu->path;
			$moveRegion=false;
			//修改前后的path比较，已确定是否移动了地区
			//echo '$currentRegionOldPath|$currentRegion->region_path'.$currentRegionOldPath.'|'.$currentRegion->region_path;
			if($currentRegionOldPath!=$currentRegion->region_path){

				$childrenRegion=new Tregion();
				$childRegion=new Tregion();
/*				echo "-------------------------------<br />";
				var_dump($childRegion);
				echo "-------------------------------<br />";*/
				$childrenRegion->whereAdd("id!='$id'");//不处理自身
				$childrenRegion->whereAdd("region_path like '$currentRegionOldPath%'");//必须用path来处理所有下级
				//$childrenMenu->debug(1);
				$childrenRegion->select();
				//取出除自身外的所有下级节点
				$counter=0;
				while ($childrenRegion->fetch()){
					//echo "<br />loop".$counter++."---------------------------<br />";
					//注意这里比较特殊，要先fetch，取得$childMenu->path后，在update
					//$childRegion->select();
					//$childRegion->fetch();
					//$currentMenu->path：该节点的新path
					//substr($childMenu->path,strlen($currentMenuOldPath)+1)：属于该节点的子节点从path中删除原来该节点旧的path的部分
					//echo "<br />in loop currentRegion->region_path:".$currentRegion->region_path."---------------------------<br />";
					$childRegion->region_path=$currentRegion->region_path.",".substr($childrenRegion->region_path,strlen($currentRegionOldPath)+1);
					//echo $childRegion->region_path;
					$temp=explode(',',$childRegion->region_path);
					$childRegion->region_level=count($temp);
					//只能是where方法，不能用whereadd
					$childRegion->where("id='$childrenRegion->id'");
					//$childRegion->debugLevel(9);
					//$childRegion->update(array($this->user['uuid']));
					//这里不能加日志
					//$childRegion->debugLevel(9);
					$childRegion->update();
				}
				
				$moveRegion=true;
			}else{
				//echo 'bb';
			}
		}else{
			$message='不能把分类项目移动到自身及其以下分类';
		}
		//处理由于地区节点移动导致机构表中相关path的修改
		if($moveRegion){
                                                      if(!empty($doctor))
                                                      {
                                                          $doctor  = rtrim($doctor, '|');
                                                          $doctor_array = explode('|', $doctor);
                                                          //使用随机数给多个医生分配要管理的人
                                                          $array_count = count($doctor_array)-1;           
                                                      }
                                                         /* foreach($doctor_array as $k=>$v)
                                                          {
                                                                //先记录未转档案之前的path将其写入old_region_path中
                                                                $old_individual_rows =  new Tindividual_core();
                                                                $old_individual_rows->whereAdd("region_path like '$currentRegionOldPath%'");
                                                                $old_individual_rows->find();
                                                                while ($old_individual_rows->fetch())
                                                                {
                                                                        $update_individual = new Tindividual_core();
                                                                        $update_individual->whereAdd("uuid='$old_individual_rows->uuid'");
                                                                        //之前因为移动村组的时候  村组不存在机构因此需要找当前转过去机构的机构ID
                                                                        $update_individual->org_id = $org_name;
                                                                        $update_individual->old_region_path = $old_individual_rows->region_path;
                                                                        $update_individual->update();
                                                                        $update_individual->free_statement();
                                                                }
                                                                $old_individual_rows->free_statement();
                                                          }
                                                          */
			$newRegionPath=$currentRegion->region_path;
			//处理机构表
			$organization = new Torganization();
			//把有所此地区下的机构都取出来
			$organization->whereAdd("region_path like '$currentRegionOldPath%'");
			$organization->find();
			while ($organization->fetch()){                 
				//取旧的region_path
				$oldOrganizationRegionPath=$organization->region_path;
				$newOrganizationRegionPath=str_replace($currentRegionOldPath,$newRegionPath,$oldOrganizationRegionPath);
				$organizationUpdate->region_path=$newOrganizationRegionPath;                
				//取旧的region_path_domain
				$oldOrganizationRegionPathDomain=$organization->region_path_domain;
				$newOrganizationRegionPathDomain=str_replace($currentRegionOldPath,$newRegionPath,$oldOrganizationRegionPathDomain);            
				$organizationUpdate=new Torganization();
				$organizationUpdate->region_path_domain=$newOrganizationRegionPathDomain;
				//仅能用where
				$organizationUpdate->whereAdd("id='$organization->id'");
				//echo "org";
				//$organizationUpdate->debugLevel(9);

				//$organizationUpdate->update(array($this->user['uuid']));
				//这里不能加日志
				$organizationUpdate->update();
				$organizationUpdate->free_statement();
			}
			//处理职员表
			$staff=new Tstaff_core();
			$staff->whereAdd("region_path like '$currentRegionOldPath%'");
			$staff->find();
			while ($staff->fetch()){
				//取旧的region_path
				$oldStaffRegionPath=$staff->region_path;
				$newStaffRegionPath=str_replace($currentRegionOldPath,$newRegionPath,$oldStaffRegionPath);
				$staffUpdate=new Tstaff_core();
				$staffUpdate->region_path=$newStaffRegionPath;
				//$staffUpdate->debugLevel(9);;
				//echo $newIndividualRegionPath;
				//仅能用where
				$staffUpdate->whereAdd("id='$staff->id'");
				//这里不能加日志
				$staffUpdate->update();
				$staffUpdate->free_statement();
			}


			//处理个人基本信息中
			$individual=new Tindividual_core();
			$individual->whereAdd("region_path like '$currentRegionOldPath%'");
                                                          $individual->find();
			//$counter=0;
			while ($individual->fetch()){
                                                                        if(!empty($doctor))
                                                                        {
                                                                            $array_tag = mt_rand(0, $array_count);//取得医生的随机数
                                                                            //即将转换的医生id
                                                                            $new_staff_id = $doctor_array[$array_tag];//取得医生id
                                                                        }
				//取旧的region_path
				$oldIndividualRegionPath=$individual->region_path;
				$newIndividualRegionPath=str_replace($currentRegionOldPath,$newRegionPath,$oldIndividualRegionPath);
				//$individualUpdate->debugLevel(9);;
				//echo $currentRegionOldPath.'|'.$newIndividualRegionPath;
				$individualUpdate=new Tindividual_core();
				$individualUpdate->region_path=$newIndividualRegionPath;
                                                                            if(!empty($org_name))
                                                                            {
                                                                              $individualUpdate->org_id = $org_name;         
                                                                            }
                                                                            if(!empty($doctor))
                                                                            {
                                                                                $individualUpdate->staff_id = $doctor_array[$array_tag];
                                                                                $individualUpdate->response_doctor = $doctor_array[$array_tag];
                                                                            }
                                                                             $new_region_path_array = explode(',', $newIndividualRegionPath);
                                                                             unset($new_region_path_array[0]);//不要第0维
                                                                             unset($new_region_path_array[1]);//不要第一维
                                                                             $new_address = '';
                                                                             foreach($new_region_path_array as $k=>$v)
                                                                             {
                                                                                 $real_path  = new Tregion();
                                                                                 $real_path->whereAdd("id=$v");
                                                                                 $real_path->find(true);
                                                                                 $new_address.=$real_path->zh_name;
                                                                                 $real_path->free_statement();
                                                                             }
                                                                             $individualUpdate->address = $new_address;//户籍地址
                                                                             $individualUpdate->residence_address = $new_address;
				$individualUpdate->whereAdd("uuid='$individual->uuid'");
				//这里不能加日志
				$individualUpdate->update();
				$individualUpdate->free_statement();
				//echo "\n";
				//echo $counter++;
			}
			//处理家庭基本信息中
			$family=new Tfamily_archive();
			$family->whereAdd("region_path like '$currentRegionOldPath%'");
			$family->find();
			while ($family->fetch()){
				//取旧的region_path
				$oldIndividualRegionPath=$family->region_path;
				$newIndividualRegionPath=str_replace($currentRegionOldPath,$newRegionPath,$oldIndividualRegionPath);
				$familyUpdate=new Tfamily_archive();
				$familyUpdate->region_path=$newIndividualRegionPath;
				//$individualUpdate->debugLevel(9);;
				//echo $newIndividualRegionPath;
				//仅能用where
				$familyUpdate->whereAdd("uuid='$family->uuid'");
				//这里不能加日志
				$familyUpdate->update();
				$familyUpdate->free_statement();
			}
			//更新工作计划表
			  $tips = new Ttips();
			  $tips->whereAdd("region_path like '$currentRegionOldPath%'");
			  $tips->find();
			  while($tips->fetch())
			  {
			  	$tipsuuid             =  $tips->uuid;
			  	$tipsregionpath       =  $tips->region_path;
			  	$tipsregion           =  str_replace($currentRegionOldPath,$newRegionPath,$tipsregionpath);
			  	$tipsupdate           = new Ttips();
			  	$tipsupdate->region_path = $tipsregion;
			  	$tipsupdate->whereAdd("uuid='$tipsuuid'");
			  	$tipsupdate->update();
			  	$tipsupdate->free_statement();
			  }
			  $tips->free_statement();
			  //更新工作计划类型表
			  $tipstype  = new Ttips_type();
			  $tipstype->whereAdd("region_path like '$currentRegionOldPath%'");
			  $tipstype->find();
			  while($tipstype->fetch())
			  {
			  	$tipstypeuuid        =  $tipstype->uuid;
			  	$tipstyperegionpath  =  $tipstype->region_path;
			  	$tipstyperegion      =  str_replace($currentRegionOldPath,$newRegionPath,$tipstyperegionpath);
			  	$tipstypeupdate      = new Ttips_type();
			  	$tipstypeupdate->region_path   = $tipstyperegionpath;
			  	$tipstypeupdate->whereAdd("uuid='$tipstypeuuid'");
			  	$tipstypeupdate->update();
			  	$tipstypeupdate->free_statement();
			  }
			  $tipstype->free_statement();
			  //更新标准档案规范化完整率表
			  $standard_archive_rate   = new Tstandard_archive_rate();
			  $standard_archive_rate->whereAdd("region_path like '$currentRegionOldPath%'");
			  $standard_archive_rate->find();
			  while($standard_archive_rate->fetch())
			  {
			  	$standard_rate_uuid       = $standard_archive_rate->uuid;
			  	$standard_rate_regionpath = $standard_archive_rate->region_path;
			  	$standard_rate_region     =  str_replace($currentRegionOldPath,$newRegionPath,$standard_rate_regionpath);
			  	$standard_archive_rate_update = new Tstandard_archive_rate();
			  	$standard_archive_rate_update->region_path     =  $standard_rate_region;
			  	$standard_archive_rate_update->whereAdd("uuid='$standard_rate_uuid'");
			  	$standard_archive_rate_update->update();
			  	$standard_archive_rate_update->free_statement();
			  }
			  $standard_archive_rate->free_statement();
		}
		$this->createRegionArray();
		$message = "地区移动或者修改完成!";
		echo $message;
		exit();
	}
	/**
	 * 思路：增加一个选择项合并，让将要合并的二个或多个地区中，选固定一个地区，然后把其它待合并的地区合并到这个地区中，再根据实际情况修改这个合并后地区的名称或是在做地区移动等。
	 *
	 */
	public function meregeditAction(){
         $region_id = $this->_request->getParam('id');
         if(!empty($region_id)){
	         $region =  new Tregion();
	         $region->whereAdd("id=$region_id");
	         $region->find(true);
	         $this->view->zh_name    = $region->zh_name;
	         $parentid = $region->p_id;
	         //找目前这级的其他项目
	         $region_array = array();
	         $count = 0 ;
	         $regionChecked =  new Tregion();
	         $regionChecked->whereAdd("p_id='$parentid'");
	         $regionChecked->whereAdd("id<>$region_id");
	         $regionChecked->find();
	         while ($regionChecked->fetch()){
	         	$region_array[$count]['id']      = $regionChecked->id;
	         	$region_array[$count]['zh_name'] = $regionChecked->zh_name;
	         	$count++;
	         }  
         $this->view->region_array = $region_array;
         $this->view->p_id         = $parentid;
         $this->view->id           = $region_id;
         }
         $this->view->display('meregedit.html');
	}
	public function meregsaveAction(){
		$strall = $this->_request->getParam('strall');
		$id     = $this->_request->getParam('id');
		if($strall&$id)
		{   
			$region = new Tregion();
			$region->whereAdd("id=$id");
			$region->find(true);
			$region_path = $region->region_path;//目标地区
			$realstr =  rtrim($strall,'|');
			$region_array = explode('|',$realstr);//所有需要合并的地区
			foreach ($region_array as $k=>$v)
			{
				$regionlone = new Tregion();
				$regionlone->whereAdd("id='$v'");
				$regionlone->find(true);
				$message = '';
				$needregionpath = $regionlone->region_path;//需要替换的path
				$needid         = $regionlone->id;//需要用到的ID
				//将需要合并地区的直接下一级的PID换成合并到的地区的id
				$regionupdate = new Tregion();
				$regionupdate->whereAdd("p_id='$v'");
				$regionupdate->find();
				while ($regionupdate->fetch())
				{
					$regionupdateid  = $regionupdate->id;
					$regionupdatenew = new Tregion();
					$regionupdatenew->whereAdd("id=$regionupdateid");
					$regionupdatenew->p_id      =      $id;
					$regionupdatenew->update();
					$regionupdatenew->free_statement();
				}
				$regionupdate->free_statement();
				//更新需要合并地区的下级的region_path
				$updateregion =  new Tregion();
				$updateregion->whereAdd("region_path like '$needregionpath%'");
				$updateregion->whereAdd("id<>$v");
				$updateregion->find();
				while($updateregion->fetch())
				{
					$updateid      = $updateregion->id;
					$currentregion = $updateregion->region_path;
					$changestr = str_replace($needregionpath,$region_path,$currentregion);
					$changepath = new Tregion();
					$changepath->whereAdd("id='$updateid'");
					$changepath->region_path  = $changestr;
					$changepath->update();
					$changepath->free_statement();
				}
				//更新机构表中得reginpath
				$organization = new Torganization();
				$organization->whereAdd("region_path like '$needregionpath%'");
				$organization->find();
				while($organization->fetch())
				{
					$orgregionpath = $organization->region_path;
					$orgid         = $organization->id;
					$orgstr = str_replace($needregionpath,$region_path,$orgregionpath);
					$orgupdate = new Torganization();
					$orgupdate->whereAdd("id=$orgid");
					$orgupdate->region_path        = $orgstr;
					$orgupdate->region_path_domain = $orgstr;
					$orgupdate->update();
					$orgupdate->free_statement();
				}
				$organization->free_statement();	
			  //更新职员表的内容
			  $staff_core = new Tstaff_core();
			  $staff_core->whereAdd("region_path like '$needregionpath%'");
			  $staff_core->find();
			  while ($staff_core->fetch())
			  {
			  	$staff_core_id     =  $staff_core->id;
			  	$staff_region_path =  $staff_core->region_path;
			  	$staffregion       =  str_replace($needregionpath,$region_path,$staff_region_path);
			  	$staff_core_update = new Tstaff_core();
			  	$staff_core_update->whereAdd("id='$staff_core_id'");
			  	$staff_core_update->region_path  = $staffregion;
			  	$staff_core_update->update();
			  	$staff_core_update->free_statement();
			  }
			  $staff_core->free_statement();	 
			  //更新个人档案表
			  $invidualcore = new Tindividual_core();
			  $invidualcore->whereAdd("region_path like '$needregionpath%'");
			  $invidualcore->find();
			  while($invidualcore->fetch())
			  {
			  	$invidualuuid       = $invidualcore->uuid;
			  	$invidualcoreregion = $invidualcore->region_path;
			  	$invidualregion     =  str_replace($needregionpath,$region_path,$invidualcoreregion);
                                                                            //完成刷新后的新地区地址
                                                                           $region_new_array = explode(',', $invidualregion);
                                                                            unset($region_new_array[0]);
                                                                            unset($region_new_array[1]);                     
                                                                            $lone_region_str = '';
                                                                            foreach($region_new_array as $valall)
                                                                            {
                                                                                $my_region = new Tregion();
                                                                                $my_region->whereAdd("id=$valall");
                                                                                $my_region->find(true);
                                                                                $lone_region_str.=$my_region->zh_name;
                                                                                $my_region->free_statement();
                                                                            }          
			  	$invidualupdate     = new Tindividual_core();
			  	$invidualupdate->whereAdd("uuid='$invidualuuid'");
			  	$invidualupdate->region_path = $invidualregion;
                                                                             $invidualupdate->address = $lone_region_str;
                                                                             $invidualupdate->residence_address = $lone_region_str;
			  	$invidualupdate->update();
			  	$invidualupdate->free_statement();
			  }
			  $invidualcore->free_statement();
			  //更新家庭档案表
			  $family = new Tfamily_archive();
			  $family->whereAdd("region_path like '$needregionpath%'");
			  $family->find();
			  while ($family->fetch())
			  {
			  	$familyuuid          =  $family->uuid;
			  	$familyregionpath    =  $family->region_path;
			  	$familyregion        =  str_replace($needregionpath,$region_path,$familyregionpath);
			  	$familyupdate        =  new Tfamily_archive();
			  	$familyupdate->whereAdd("uuid='$familyuuid'");
			  	$familyupdate->region_path = $familyregion;
			  	$familyupdate->update();
			  	$familyupdate->free_statement();
			  }
			  $family->free_statement();
			  //更新工作计划表
			  $tips = new Ttips();
			  $tips->whereAdd("region_path like '$needregionpath%'");
			  $tips->find();	  
			  while($tips->fetch())
			  {
			  	$tipsuuid             =  $tips->uuid;
			  	$tipsregionpath       =  $tips->region_path;
			  	$tipsregion           =  str_replace($needregionpath,$region_path,$tipsregionpath);
			  	$tipsupdate           = new Ttips();
			  	$tipsupdate->whereAdd("uuid='$tipsuuid'");
			  	$tipsupdate->region_path = $tipsregion;
			  	$tipsupdate->update();
			  	$tipsupdate->free_statement();
			  }
			  $tips->free_statement();	   
			  //更新工作计划类型表
			  $tipstype  = new Ttips_type();
			  $tipstype->whereAdd("region_path like '$needregionpath%'");
			  $tipstype->find();
			  while($tipstype->fetch())
			  {
			  	$tipstypeuuid        =  $tipstype->uuid;
			  	$tipstyperegionpath  =  $tipstype->region_path;
			  	$tipstyperegion      =  str_replace($needregionpath,$region_path,$tipstyperegionpath);
			  	$tipstypeupdate      = new Ttips_type();
			  	$tipstypeupdate->whereAdd("uuid='$tipstypeuuid'");
			  	$tipstypeupdate->region_path   = $tipstyperegion;
			  	$tipstypeupdate->update();
			  	$tipstypeupdate->free_statement();
			  }
			  $tipstype->free_statement();
			  //更新标准档案规范化完整率表
			  $standard_archive_rate   = new Tstandard_archive_rate();
			  $standard_archive_rate->whereAdd("region_path like '$needregionpath%'");
			  $standard_archive_rate->find();
			  while($standard_archive_rate->fetch())
			  {
			  	$standard_rate_uuid       = $standard_archive_rate->uuid;
			  	$standard_rate_regionpath = $standard_archive_rate->region_path;
			  	$standard_rate_region     =  str_replace($needregionpath,$region_path,$standard_rate_regionpath);
			  	$standard_archive_rate_update = new Tstandard_archive_rate();
			  	$standard_archive_rate_update->whereAdd("uuid='$standard_rate_uuid'");
			  	$standard_archive_rate_update->region_path     =  $standard_rate_region;
			  	$standard_archive_rate_update->update();
			  	$standard_archive_rate_update->free_statement();
			  }
			  $standard_archive_rate->free_statement();
			  //删除需要合并的地区
			  $delregion = new Tregion();
			  $delregion->whereAdd("id='$v'");
			  $delregion->delete();
			  $delregion->free_statement();
			}
			$region->free_statement();
			$this->createRegionArray();
			echo "地区合并成功";
	    }
	    else
	   {
	  	 echo "您没有选择需要合并的地区,请选择需要合并的地区!"; 
	   }
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
		require_once(__SITEROOT.'library/custom/region_array.php');
		$id=$this->_request->getParam('p_id');
		$currenUserRegion=$this->user['region_id'];
		$region=new Tregion();
		$region->whereAdd("id='$id'");
		//$region->debugLevel(9);
		$region->find(true);
		$path=$region->region_path;
		$pathArray=explode(',',$path);
		$dropDownBox='';
		//var_dump($pathArray);
		//有了path就不用递归，path里有每一级的id，通过这些id就能把每一级的下一级取出来形成下拉框
		for($i=0;$i<count($pathArray);$i++){
			$region=new Tregion();
			$region->whereAdd("p_id='$pathArray[$i]' and id!='0'");
			//如果没有下级分类就continue
			//echo $i."<br />";
			if($region->count('*')<=0){
				continue;
			}else{

			}
			$region->select();
			//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";
			//echo $regionDomain.'|'.$pathArray[$i].'----';

			//if(intval($regionDomain)<=intval($pathArray[$i])){
			//echo $currenUserRegion."<br />";
			//echo $currenUserRegion."<br />";
			if($regionInfo[$currenUserRegion][2]<=$regionInfo[$pathArray[$i]][2]){
				//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' style='width:45%;'>";
				$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";
			}else{
				//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' style='width:45%;' disabled>";
				$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'  disabled>";
			}

			//除第一级下拉框外，都提供一个'请选择'的选项
			if($region->id!='1'){
				//注意这里　由-9|x 构成 很巧妙的解决了当某级选择了请选择时，用其父级作为选中值的算法
				$dropDownBox=$dropDownBox."<option value='-9|".$pathArray[$i]."'>请选择</option>";
			}
			while ($region->fetch()){
				if(in_array($region->id,$pathArray)){
					$dropDownBox=$dropDownBox."<option value='$region->id' selected>$region->zh_name</option>";
				}else{
					$dropDownBox=$dropDownBox."<option value='$region->id'>$region->zh_name</option>";
				}
			}
			$dropDownBox=$dropDownBox."</select>";
		}
		echo $dropDownBox;
		exit();
	}

	/**
	 * 生成分类下拉框
	 * 原理：
	 * 页面上通过ajax提交上来的一个分类id
	 * 通过这个id，把此id获取所有的父id　通过path获取，避免递归
	 * 将获取的所有父id生成一个数组
	 * 循环此数组
	 * 生成每一次的下拉框
     * 2011-06-03修改罗老师的，加入权限
	 */
	public function menuDropDownBoxIhaAction(){
		require_once(__SITEROOT.'library/custom/region_array.php');
		$id=$this->_request->getParam('p_id');
		$currenUserRegion=$this->user['region_id'];
		$org_region=$this->user['current_region_path'];
		$org_region_domain=$this->user['current_region_path_domain'];
		$search_doamin=@explode("|",$org_region_domain);
		//echo $regionDomain;
		$region=new Tregion();
		$region->whereAdd("id='$id'");
		//$region->debugLevel(9);
		$region->find(true);
		$path=$region->region_path;
		$pathArray=explode(',',$path);
		$dropDownBox='';
		//var_dump($pathArray);
		//有了path就不用递归，path里有每一级的id，通过这些id就能把每一级的下一级取出来形成下拉框
		for($i=0;$i<count($pathArray);$i++){
			$region=new Tregion();
			$region->whereAdd("p_id='$pathArray[$i]' and id!='0'");
			//如果没有下级分类就continue
			//echo $i."<br />";
			if($region->count('*')<=0){
				continue;
			}else{

			}
			$region->select();
			//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";
			//echo $regionDomain.'|'.$pathArray[$i].'----';

			//if(intval($regionDomain)<=intval($pathArray[$i])){
			//echo $currenUserRegion."<br />";
			//echo $currenUserRegion."<br />";
			if($regionInfo[$currenUserRegion][2]<=$regionInfo[$pathArray[$i]][2]){
				//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' style='width:45%;'>";
				$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";
			}else{
				//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' style='width:45%;' disabled>";
				$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'  disabled>";
			}

			//除第一级下拉框外，都提供一个'请选择'的选项
			if($region->id!='1'){
				//注意这里　由-9|x 构成 很巧妙的解决了当某级选择了请选择时，用其父级作为选中值的算法
				$dropDownBox=$dropDownBox."<option value='-9|".$pathArray[$i]."'>请选择</option>";
			}
			while ($region->fetch()){
				if($i==(count(explode(",",$regionInfo[$currenUserRegion][2]))-1) && $org_region!=$org_region_domain)
				{

					if(in_array($region->region_path,$search_doamin)){
						if(in_array($region->id,$pathArray)){
							$dropDownBox=$dropDownBox."<option value='$region->id' selected>$region->zh_name</option>";
						}else{
							$dropDownBox=$dropDownBox."<option value='$region->id'>$region->zh_name</option>";
						}
					}
				}
				else
				{
					if(in_array($region->id,$pathArray)){
						$dropDownBox=$dropDownBox."<option value='$region->id' selected>$region->zh_name</option>";
					}else{
						$dropDownBox=$dropDownBox."<option value='$region->id'>$region->zh_name</option>";
					}
				}
			}
			$dropDownBox=$dropDownBox."</select>";
		}
		echo $dropDownBox;
		exit();
	}
    
    /**
     * region_regionController::menuDropDownBoxNewAction()
     * 完成和上面这个控制器一样的动作，只是可以自定义select的onchange事件的控制的span_id和Input_id
     * @author 我好笨
     * @return void
     */
    public function menuDropDownBoxNewAction()
    {
        require_once(__SITEROOT.'library/custom/region_array.php');
		$id=$this->_request->getParam('p_id');
        $span_id=$this->_request->getParam('span_id');
        $input_id=$this->_request->getParam('input_id');
		$currenUserRegion=$this->user['region_id'];
		$org_region=$this->user['current_region_path'];
		$org_region_domain=$this->user['current_region_path_domain'];
		$search_doamin=@explode("|",$org_region_domain);
		$region=new Tregion();
		$region->whereAdd("id='$id'");
		//$region->debugLevel(9);
		$region->find(true);
		$path=$region->region_path;
		$pathArray=explode(',',$path);
		$dropDownBox='';
		//有了path就不用递归，path里有每一级的id，通过这些id就能把每一级的下一级取出来形成下拉框
		for($i=0;$i<count($pathArray);$i++){
			$region=new Tregion();
			$region->whereAdd("p_id='$pathArray[$i]' and id!='0'");
			//如果没有下级分类就continue
			if($region->count('*')<=0){
				continue;
			}else{

			}
			$region->select();
			if($regionInfo[$currenUserRegion][2]<=$regionInfo[$pathArray[$i]][2]){
				$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='change_org(\"".$input_id."\",\"".$span_id."\",this.value,\"".__BASEPATH."\")'>";
			}else{
				$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='change_org(\"".$input_id."\",\"".$span_id."\",this.value,\"".__BASEPATH."\")'  disabled>";
			}

			//除第一级下拉框外，都提供一个'请选择'的选项
			if($region->id!='1'){
				//注意这里　由-9|x 构成 很巧妙的解决了当某级选择了请选择时，用其父级作为选中值的算法
				$dropDownBox=$dropDownBox."<option value='-9|".$pathArray[$i]."'>请选择</option>";
			}
			while ($region->fetch()){
				if($i==(count(explode(",",$regionInfo[$currenUserRegion][2]))-1) && $org_region!=$org_region_domain)
				{

					if(in_array($region->region_path,$search_doamin)){
						if(in_array($region->id,$pathArray)){
							$dropDownBox=$dropDownBox."<option value='$region->id' selected>$region->zh_name</option>";
						}else{
							$dropDownBox=$dropDownBox."<option value='$region->id'>$region->zh_name</option>";
						}
					}
				}
				else
				{
					if(in_array($region->id,$pathArray)){
						$dropDownBox=$dropDownBox."<option value='$region->id' selected>$region->zh_name</option>";
					}else{
						$dropDownBox=$dropDownBox."<option value='$region->id'>$region->zh_name</option>";
					}
				}
			}
			$dropDownBox=$dropDownBox."</select>";
		}
		echo $dropDownBox;
		exit();
    }
	/**
	 * 生成院长查询右边的地区及机构的下拉框，使用罗老师上面这个地区修改，最后一级取地区
	 */
	public function directorDropDownBoxAction(){
		require_once(__SITEROOT.'library/custom/region_array.php');
		$id=$this->_request->getParam('p_id');
		$currenUserRegion=$this->user['region_id'];
		$region=new Tregion();
		$region->whereAdd("id='$id'");
		$region->find(true);
		$path=$region->region_path;
		$pathArray=explode(',',$path);
		$dropDownBox='';
		//有了path就不用递归，path里有每一级的id，通过这些id就能把每一级的下一级取出来形成下拉框
		$xunhuan=0;
		$xunhuan=(count($pathArray)<=5)?count($pathArray):5;
		for($i=0;$i<$xunhuan;$i++)
		{
			$region=new Tregion();
			$region->whereAdd("p_id='$pathArray[$i]' and id!='0'");
			//如果没有下级分类就continue
			//echo $i."<br />";
			if($region->count('*')<=0)
			{
				continue;
			}
			$region->select();
			if($regionInfo[$currenUserRegion][2]<=$regionInfo[$pathArray[$i]][2])
			{
				$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";
			}
			else
			{
				$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'  disabled>";
			}
			//除第一级下拉框外，都提供一个'请选择'的选项
			if($region->id!='1')
			{
				//注意这里　由-9|x 构成 很巧妙的解决了当某级选择了请选择时，用其父级作为选中值的算法
				$dropDownBox=$dropDownBox."<option value='-9|".$pathArray[$i]."'>请选择</option>";
			}
			while ($region->fetch())
			{
				if(in_array($region->id,$pathArray))
				{
					$dropDownBox=$dropDownBox."<option value='$region->id' selected>$region->zh_name</option>";
				}
				else
				{
					$dropDownBox=$dropDownBox."<option value='$region->id'>$region->zh_name</option>";
				}
			}
			$dropDownBox=$dropDownBox."</select><br />";
		}
		echo $dropDownBox;

		exit();
	}

	/**
	 * 操作数组版
	 * 
	 *
	 */
	public function menuDropDownBox1Action(){
		require_once(__SITEROOT.'library/custom/region_array.php');
		$id=$this->_request->getParam('p_id');
		$currenUserRegion=$this->user['region_id'];
        $org_region=$this->user['current_region_path'];
		$org_region_domain=$this->user['current_region_path_domain'];
		$search_doamin=@explode("|",$org_region_domain);
		$region=new Tregion();
		$region->whereAdd("id='$id'");
		$region->find(true);
		$path=$region->region_path;
		$pathArray=explode(',',$path);
		$counter=count($pathArray);
		$dropDownBox='';
		for($i=0;$i<$counter;$i++)
        {
            $region=new Tregion();
			$region->whereAdd("p_id='$pathArray[$i]' and id!='0'");
			//如果没有下级分类就continue
			if($region->count('*')<=0)
            {
				continue;
			}
			$region->select();
			$the_region=$pathArray[$i];
			$temp1=explode(',',$regionInfo[$the_region][2]);
			$temp2=count($temp1);

			$region_temp_name=array(2=>'省(直辖市)名称：',3=>'所属市(州)名称：',4=>'所属县(区)名称：',5=>'乡镇(街道)名称：',6=>'村(居委会)名称：',7=>'小组(小区)名称：');
			if($regionInfo[$the_region][2]<$regionInfo[$currenUserRegion][2])
            {
				if($temp2<5)
                {
					$dropDownBox=$dropDownBox."<select myclass='region_dropdown_box' onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' disabled>";
				}
                else
                {
					$dropDownBox=$dropDownBox."<br />".$region_temp_name[$temp2]."<select myclass='region_dropdown_box' onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' disabled>";

				}
			}
			if($regionInfo[$the_region][2]>=$regionInfo[$currenUserRegion][2])
            {
				$dropDownBox=$dropDownBox."<br />".$region_temp_name[$temp2]."<select myclass='region_dropdown_box' onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";
			}
			//除第一级下拉框外，都提供一个'请选择'的选项
			if($region->id!='1')
            {
				//注意这里　由-9|x 构成 很巧妙的解决了当某级选择了请选择时，用其父级作为选中值的算法
				$dropDownBox=$dropDownBox."<option value='-9|".$the_region."'>请选择</option>";
			}
			$selected=false;
			//while ($region->fetch()){
            while ($region->fetch()){
				if($i==(count(explode(",",$regionInfo[$currenUserRegion][2]))-1) && $org_region!=$org_region_domain)
				{

					if(in_array($region->region_path,$search_doamin)){
						if(in_array($region->id,$pathArray))
                        {
							$selected=true;
                            $dropDownBox=$dropDownBox."<option value='$region->id' selected>$region->zh_name</option>";
						}
                        else
                        {
							$dropDownBox=$dropDownBox."<option value='$region->id'>$region->zh_name</option>";
						}
					}
				}
				else
				{
					if(in_array($region->id,$pathArray))
                    {
						$selected=true;
                        $dropDownBox=$dropDownBox."<option value='$region->id' selected>$region->zh_name</option>";
					}
                    else
                    {
						$dropDownBox=$dropDownBox."<option value='$region->id'>$region->zh_name</option>";
					}
				}
			}
			$dropDownBox=$dropDownBox."</select>";

			if($temp2==7 and $selected)
            {
				$dropDownBox=$dropDownBox."<input type='hidden' id='region_last_id' name='region_last_id' value='$id' />";
			}


		}

		echo $dropDownBox;
		exit();


		//$relation_of_householder_disabled=$this->_request->getParam('relation_of_householder_disabled');
		//echo $regionDomain;
		$region=new Tregion();
		$region->whereAdd("id='$id'");
		//$region->debugLevel(9);
		$region->find(true);
		$path=$region->region_path;
		$pathArray=explode(',',$path);
		$dropDownBox='';
		//var_dump($pathArray);
		//有了path就不用递归，path里有每一级的id，通过这些id就能把每一级的下一级取出来形成下拉框
		for($i=0;$i<count($pathArray);$i++){
			$region=new Tregion();
			$region->whereAdd("p_id='$pathArray[$i]' and id!='0'");
			//如果没有下级分类就continue
			//echo $i."<br />";
			if($region->count('*')<=0){
				continue;
			}else{

			}
			$region->select();
			//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";
			//echo $regionDomain.'|'.$pathArray[$i].'----';

			//if(intval($regionDomain)<=intval($pathArray[$i])){
			//echo $currenUserRegion."<br />";
			//echo $currenUserRegion."<br />";
			/*

			if($regionInfo[$currenUserRegion][2]<=$regionInfo[$pathArray[$i]][2]){
			//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' style='width:45%;'>";
			$dropDownBox=$dropDownBox."<br /><select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";
			}else{
			//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' style='width:45%;' disabled>";
			$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'  disabled>";
			}

			*/
			$temp1=explode(',',$regionInfo[$pathArray[$i]][2]);
			$temp2=count($temp1);
			$region_temp_name=array(2=>'省(直辖市)名称：',3=>'所属市(州)名称：',4=>'所属县(区)名称：',5=>'乡镇(街道)名称：',6=>'村(居委会)名称：',7=>'小组(小区)名称：');
			if($regionInfo[$pathArray[$i]][2]<$regionInfo[$currenUserRegion][2]){
				if($temp2<5){
					$dropDownBox=$dropDownBox."<select myclass='region_dropdown_box' onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' disabled>";

				}else{
					$dropDownBox=$dropDownBox."<br />".$region_temp_name[$temp2]."<select myclass='region_dropdown_box' onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' disabled>";

				}
			}
			if($regionInfo[$pathArray[$i]][2]>=$regionInfo[$currenUserRegion][2]){
				$dropDownBox=$dropDownBox."<br />".$region_temp_name[$temp2]."<select myclass='region_dropdown_box' onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";
			}



			/*

			if($temp2<=4){
			//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' style='width:45%;'>";
			$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'   disabled>";
			}




			if($temp2==5){
			//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' style='width:45%;' disabled>";
			if(($regionInfo[$currenUserRegion][2]<=$regionInfo[$pathArray[$i]][2])){
			$dropDownBox=$dropDownBox."<br />乡镇（街道）名称：<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";

			}else{
			$dropDownBox=$dropDownBox."<br />乡镇（街道）名称：<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' disabled>";
			}
			}
			if($temp2==6){
			//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' style='width:45%;' disabled>";
			if(($regionInfo[$currenUserRegion][2]<=$regionInfo[$pathArray[$i]][2])){
			$dropDownBox=$dropDownBox."<br />村（居委会）名称：<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";

			}else{
			$dropDownBox=$dropDownBox."<br />村（居委会）名称：<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' disabled>";
			}
			}
			if($temp2==7){
			//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' style='width:45%;' disabled>";
			if(($regionInfo[$currenUserRegion][2]<=$regionInfo[$pathArray[$i]][2])){
			$dropDownBox=$dropDownBox."<br />组（小区）名称：<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";

			}else{
			$dropDownBox=$dropDownBox."<br />组（小区）名称：<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' disabled>";
			}
			}

			*/
			//除第一级下拉框外，都提供一个'请选择'的选项
			if($region->id!='1'){
				//注意这里　由-9|x 构成 很巧妙的解决了当某级选择了请选择时，用其父级作为选中值的算法
				$dropDownBox=$dropDownBox."<option value='-9|".$pathArray[$i]."'>请选择</option>";
			}
			$selected=false;
			while ($region->fetch()){
				if(in_array($region->id,$pathArray)){
					$selected=true;
					$dropDownBox=$dropDownBox."<option value='$region->id' selected>$region->zh_name</option>";
				}else{
					$dropDownBox=$dropDownBox."<option value='$region->id'>$region->zh_name</option>";
				}
			}
			//echo $regionInfo[$pathArray[$i]][2].'|'.$regionInfo[$currenUserRegion][2].'<br />';

			//$temp1=explode(',',$regionInfo[$pathArray[$i]][2]);
			//echo count($temp1);
			//echo "<br />";
			/*			if($regionInfo[$pathArray[$i]][2]<$regionInfo[$currenUserRegion][2]){
			$dropDownBox=$dropDownBox."</select>";

			}else{
			$dropDownBox=$dropDownBox."</select><br />";
			}*/
			$dropDownBox=$dropDownBox."</select>";

			if($temp2==7 and $selected){
				$dropDownBox=$dropDownBox."<input type='hidden' id='region_last_id' name='region_last_id' value='$id' />";
			}


		}

		echo $dropDownBox;
		exit();
	}
	/**
	 * 操作数据库版
	 *
	 */
	public function menuDropDownBox1_sqlAction(){
		require_once(__SITEROOT.'library/custom/region_array.php');
		$id=$this->_request->getParam('p_id');
		$currenUserRegion=$this->user['region_id'];
		//$relation_of_householder_disabled=$this->_request->getParam('relation_of_householder_disabled');
		//echo $regionDomain;
		$region=new Tregion();
		$region->whereAdd("id='$id'");
		//$region->debugLevel(9);
		$region->find(true);
		$path=$region->region_path;
		$pathArray=explode(',',$path);
		$dropDownBox='';
		//var_dump($pathArray);
		//有了path就不用递归，path里有每一级的id，通过这些id就能把每一级的下一级取出来形成下拉框
		for($i=0;$i<count($pathArray);$i++){
			$region=new Tregion();
			$region->whereAdd("p_id='$pathArray[$i]' and id!='0'");
			//如果没有下级分类就continue
			//echo $i."<br />";
			if($region->count('*')<=0){
				continue;
			}else{

			}
			$region->select();
			//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";
			//echo $regionDomain.'|'.$pathArray[$i].'----';

			//if(intval($regionDomain)<=intval($pathArray[$i])){
			//echo $currenUserRegion."<br />";
			//echo $currenUserRegion."<br />";
			/*

			if($regionInfo[$currenUserRegion][2]<=$regionInfo[$pathArray[$i]][2]){
			//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' style='width:45%;'>";
			$dropDownBox=$dropDownBox."<br /><select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";
			}else{
			//$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' style='width:45%;' disabled>";
			$dropDownBox=$dropDownBox."<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'  disabled>";
			}

			*/
			$temp1=explode(',',$regionInfo[$pathArray[$i]][2]);
			$temp2=count($temp1);
			$region_temp_name=array(2=>'省（直辖市）名称：',3=>'所属市（州）名称：',4=>'所属县（区）名称：',5=>'乡镇（街道）名称：',6=>'村（居委会）名称：',7=>'小组（小区）名称：');
			if($regionInfo[$pathArray[$i]][2]<$regionInfo[$currenUserRegion][2]){
				if($temp2<5){
					$dropDownBox=$dropDownBox."<select myclass='region_dropdown_box' onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' disabled>";

				}else{
					$dropDownBox=$dropDownBox."<br />".$region_temp_name[$temp2]."<select myclass='region_dropdown_box' onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' disabled>";

				}
			}
			if($regionInfo[$pathArray[$i]][2]>=$regionInfo[$currenUserRegion][2]){
				$dropDownBox=$dropDownBox."<br />".$region_temp_name[$temp2]."<select myclass='region_dropdown_box' onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";
			}
			//除第一级下拉框外，都提供一个'请选择'的选项
			if($region->id!='1'){
				//注意这里　由-9|x 构成 很巧妙的解决了当某级选择了请选择时，用其父级作为选中值的算法
				$dropDownBox=$dropDownBox."<option value='-9|".$pathArray[$i]."'>请选择</option>";
			}
			$selected=false;
			while ($region->fetch()){
				if(in_array($region->id,$pathArray)){
					$selected=true;
					$dropDownBox=$dropDownBox."<option value='$region->id' selected>$region->zh_name</option>";
				}else{
					$dropDownBox=$dropDownBox."<option value='$region->id'>$region->zh_name</option>";
				}
			}
			$dropDownBox=$dropDownBox."</select>";

			if($temp2==7 and $selected){
				$dropDownBox=$dropDownBox."<input type='hidden' id='region_last_id' name='region_last_id' value='$id' />";
			}


		}

		echo $dropDownBox;
		exit();
	}
	public function treeviewsaveAction(){
		$region_string=$this->_request->getParam("region_string","");
		$org_string=$this->_request->getParam("org_string","");
		$region_string=rtrim($region_string,"|");
		$region_array=explode('|',$region_string);
		//var_dump($region_array);
		$region_result=array();
		$counter=count($region_array);
		for($i=0;$i<$counter;$i++){
			for($j=0;$j<$counter;$j++){
				if($region_array[$i]==''){
					continue;
				}
				if($region_array[$i]==$region_array[$j]){
					continue;
				}
				if(strpos($region_array[$i],$region_array[$j])!==false){
					$region_array[$i]='';
				}
			}

		}
		for($i=0;$i<$counter;$i++){
			if($region_array[$i]==''){
				continue;
			}

			$region_result[]=$region_array[$i];
		}
		//echo '$org_string'.$org_string;
		//$org_string=rtrim($org_string,"|");
		//echo '$org_string'.$org_string;
		$org_array=explode('|',$org_string);
		//var_dump($org_array);
		//echo '$org_string'.$org_string;
		$org_result=array();
		$counter=count($org_array);
		//echo $counter;
		for($i=0;$i<$counter;$i++){
			$temp_array=explode(',',$org_array[$i]);
			$org_id=$temp_array[0];
			if($org_id==''){
				continue;
			}
			$temp_counter=count($temp_array);
			$org_region_path='';
			for($j=1;$j<$temp_counter;$j++){
				$org_region_path=$org_region_path.$temp_array[$j].',';
			}
			$org_region_path=rtrim($org_region_path,",");
			$temp_counter=count($region_result);
			$in_region=false;
			for($k=0;$k<$temp_counter;$k++){
				if(strpos($org_region_path,$region_result[$k])!==false){
					$in_region=true;

				}
			}
			if(!$in_region){
				$org_result[]=$org_id;
			}
		}

		//var_dump($this->_request->getParam('_FILE'));

		//var_dump($_FILES);
		$uuid=uniqid("u_".true);


		return ;
	}


	public function treeview2Action(){
		//$string=$this->treeview('5','0,1,2,5');
		$string=$this->treeview('2','0,1,2');
		//echo $string;
		$this->view->treeview=$string;
		$this->view->display("treeview.html");
	}
	private function treeview($p_id,$region_path){
		static $string='';
		//$string=$string."<div id='' style='border-left:solid 1px #FFF000;margin-left:15px;'>";

		//先处理本地区的直属机构
		if($string!=''){
			$org=new Torganization();
			$org->whereAdd("region_path='$region_path'");
			$org->find();
			//$temp=count(explode(',',$region_path));
			$div_name='div_'.$p_id;
			if(count(explode(',',$region_path))!=5){
				$string=$string."<div id='$div_name' style='border:solid 1px #CCC;margin-left:15px;'>";
			}else{
				$string=$string."<div id='$div_name' style='border:solid 1px #CCC;margin-left:15px;display:none'>";
			}

			while ($org->fetch()){
				//$temp1=str_repeat('&nbsp;&nbsp;',$temp);
				//$string=$string."<div id='' style='margin-left:10px;'>";
				$org_name='org_'.$org->id;
				$string=$string."<input type='checkbox' id='$org_name' name='$org_name' value='".$org->id.','.$org->region_path."' >".$org->zh_name.'<br />';
			}
		}else{
			$div_name='div_'.$p_id;
			if(count(explode(',',$region_path))!=5){
				$string=$string."<div id='$div_name' style='border:solid 1px #CCC;margin-left:15px;'>";
			}else{
				$string=$string."<div id='$div_name' style='border:solid 1px #CCC;margin-left:15px;display:none'>";
			}

		}
		//处理本地区的子地区
		$region=new Tregion();
		$region->whereAdd("p_id='$p_id'");
		$region->whereAdd("region_level<=6");
		if($region->count()<=0){
			$string=$string."</div>";
			return;
		}
		$region->orderby("id asc");
		$region->find();
		while ($region->fetch()){
			if($region->region_level<=5){
				//$string=$string."<a href='##' id='".$region->id."' onclick='expend(\'$region->id\')'>+</a>";
				$plus_name='plus_'.$region->id;

				$string=$string."<a class='treeview_a' href='##' id='".$plus_name."' onclick=\"expand('".$region->id."')\">－</a>";
				$region_name='region_'.$region->id;
				$string=$string."<input type='checkbox' id='$region_name' name='$region_name' value='".$region->region_path."' >".$region->zh_name.'<br />';
			}
			//$this->treeview($region->id,$region->region_path);
			if($region->region_level<=6){
				$this->treeview($region->id,$region->region_path);
			}

		}
		$string=$string."</div>";
		return $string;
	}
	private function treeview1($p_id,$region_path){
		static $string='';
		//先处理本地区的直属机构
		$org=new Torganization();
		$org->whereAdd("region_path='$region_path'");
		$org->find();
		$temp=count(explode(',',$region_path));
		while ($org->fetch()){
			$temp1=str_repeat('&nbsp;&nbsp;',$temp);
			$string=$string.$temp1.$temp1.$temp1."<input type='checkbox' id='' name='' value='' >".$org->zh_name.'<br />';
		}
		//处理本地区的子地区
		$region=new Tregion();
		$region->whereAdd("p_id='$p_id'");
		$region->whereAdd("region_level<7");
		if($region->count()<=0){
			return;
		}
		$region->orderby("id asc");
		$region->find();
		while ($region->fetch()){
			if($region->region_level<6){
				$temp1=str_repeat('&nbsp;&nbsp;',$region->region_level);
				$string=$string.$temp1.$temp1."+<input type='checkbox' id='' name='' value='' >".$region->zh_name.'<br />';
			}
			if($region->region_level<7){
				$this->treeview($region->id,$region->region_path);
			}
		}
		return $string;
	}
	public function treeview1Action(){
		set_time_limit(0);
		$region=new Tregion();
		$region->whereAdd("region_path like '0,1,2,5%'");
		$region->whereAdd("region_level<7");
		//$region->whereAdd("id>0");
		$region->orderby("region_path asc");
		//$region->debugLevel(9);
		$region->find();
		$string="";
		while ($region->fetch()){

			$temp1=str_repeat('&nbsp;',$region->region_level);

			$string=$string.$temp1."<input type='checkbox' id='' name='' value='' >".$region->zh_name.'<br />';
			/*			//开始显示机构
			$org=new Torganization();
			$org->whereAdd("region_path='$region->region_path'");
			$org->find();
			while ($org->fetch()){
			$string=$string.$temp1.$temp1."<input type='checkbox' id='' name='' value='' >".$org->zh_name.'<br />';
			}*/
		}
		$this->view->treeview=$string;
		$this->view->display("treeview.html");

	}
	public function addlevelAction(){
		set_time_limit(0);
		$region=new Tregion();
		$region->orderby("id asc");
		$region->whereAdd("id>=0");
		$region->find();
		while ($region->fetch()){
			$temp=explode(',',$region->region_path);
			$level=count($temp);
			$id=$region->id;
			$region1=new Tregion();
			$region1->whereAdd("id='$id'");
			$region1->region_level=$level;
			$region1->update();
			echo $region->zh_name;
			echo "<br />";
		}

	}

	/**
	 * 读入数组来遍历，速度与直接操作数据库差别不大
	 *
	 */
	public function cAction(){
		global $s;
		set_time_limit(0);
		$region1=new Tregion();
		$region1->where("region.id>=0");
		$region1->orderby("id asc");
		$region1->debugLevel(9);
		$region1->find();
		$region1_array=array();
		echo "<br>数据组填充开始执行时间";
		$e=microtime(true);
		echo round(($e-$s),4);

		while ($region1->fetch()){
			$counter=explode(',',$region1->region_path);
			//$counter=1;
			if(count($counter)==8){
				continue;
			}
			$region1_array[$region1->p_id][]=array('id'=>$region1->id,'p_id'=>$region1->p_id,'zh_name'=>$region1->zh_name,'standard_code'=>$region1->standard_code,'region_path'=>$region1->region_path);

			/*			$region1_array[$region1->p_id][$region1->id]['id']=$region1->id;
			$region1_array[$region1->p_id][$region1->id]['p_id']=$region1->p_id;
			$region1_array[$region1->p_id][$region1->id]['zh_name']=$region1->zh_name;
			$region1_array[$region1->p_id][$region1->id]['standard_code']=$region1->standard_code;
			$region1_array[$region1->p_id][$region1->id]['region_path']=$region1->region_path;*/
		}
		echo "<br>数据组填充完成程序执行时间";
		$e=microtime(true);
		echo round(($e-$s),4);

		$region=new Tregion();


		$region->orderby("id asc");
		$region->limit(0,2000);
		$region->find();
		$resultJS="var region=new Array();\r\n";//必须双引号
		$resultPHP_1='<?php'."\r\n".'$regionDomain=array();'."\r\n";
		$resultPHP_2='$regionInfo=array();'."\r\n";
		//$resultPHP_3='$std_region_path=array();'."\r\n";
		while($region->fetch()){

			//$resultPHP_2=$resultPHP_2.'$regionInfo['."'".$region->id."']=array('".$region->zh_name."','".$region->standard_code."','".$region->region_path."');\r\n";


			//*$resultPHP_3=$resultPHP_3.'$std_region_path['."'".$region->id."']=array('".$region->zh_name."','".$region->standard_code."','".$region->region_path."');\r\n";


			$counter=explode(',',$region->region_path);

			if(count($counter)==8){
				continue;
			}
			$p_id=$region->id;
			/*
			$region1->where("p_id='$p_id'");
			$region1->orderby("id asc");
			$region1->find();*/
			//$counter=0;
			$resultJS=$resultJS."region['".$p_id."']=new Array(";
			$resultPHP_1=$resultPHP_1.'$regionDomain["'.$p_id.'"]=array(';
			$tempJS='';
			$tempPHP='';
			//$region1_array
			/*			$region1_array[$region1->p_id][$region1->id]['id']=$region1->id;
			$region1_array[$region1->p_id][$region1->id]['p_id']=$region1->p_id;
			$region1_array[$region1->p_id][$region1->id]['zh_name']=$region1->zh_name;
			$region1_array[$region1->p_id][$region1->id]['standard_code']=$region1->standard_code;
			$region1_array[$region1->p_id][$region1->id]['region_path']=$region1->region_path;*/


			//$region1_array1=$region1_array1[$region->p_id];
			/*			$tempJS=$tempJS."new Array('".$region1_array[$region->p_id][$region->id]['id']."','".
			$region1_array[$region->p_id][$region->id]['zh_name']."','".
			$region1_array[$region->p_id][$region->id]['standard_code']."','".
			$region1_array[$region->p_id][$region->id]['region_path']."'),";

			$tempPHP=$tempPHP."array('".$region1_array[$region->p_id][$region->id]['id']."','".
			$region1_array[$region->p_id][$region->id]['zh_name']."','".
			$region1_array[$region->p_id][$region->id]['standard_code']."'),";*/


			$max=count($region1_array[$region->id]);
			for($i=0;$i<$max;$i++){
				$tempJS=$tempJS."new Array('".$region1_array[$region->id][$i]['id']."','".
				$region1_array[$region->id][$i]['zh_name']."','".
				$region1_array[$region->id][$i]['standard_code']."','".
				$region1_array[$region->id][$i]['region_path']."'),";

				$tempPHP=$tempPHP."array('".$region1_array[$region->id][$i]['id']."','".
				$region1_array[$region->id][$i]['zh_name']."','".
				$region1_array[$region->id][$i]['standard_code']."'),";

			}




			/*			foreach ($region1_array[$region->p_id] as $region1_array1){


			$tempJS=$tempJS."new Array('".$region1_array1[$region->id]['id']."','".
			$region1_array1[$region->id]['zh_name']."','".
			$region1_array1[$region->id]['standard_code']."','".
			$region1_array1[$region->id]['region_path']."'),";

			$tempPHP=$tempPHP."array('".$region1_array1[$region->id]['id']."','".
			$region1_array1[$region->id]['zh_name']."','".
			$region1_array1[$region->id]['standard_code']."'),";

			}*/
			/*
			while ($region1->fetch()){
			$tempJS=$tempJS."new Array('".$region1->id."','".$region1->zh_name."','".$region1->standard_code."','".$region1->region_path."'),";
			$tempPHP=$tempPHP."array('".$region1->id."','".$region1->zh_name."','".$region1->standard_code."'),";
			//$resultJS=$resultJS."region[".$p_id."][".$counter."]=new Array('".$region1->id."','".$region1->zh_name."');\r\n";
			//$counter++;
			}

			*/
			$tempJS=rtrim($tempJS,',');
			$tempPHP=rtrim($tempPHP,',');
			$resultJS=$resultJS.$tempJS.");\r\n";
			$resultPHP_1=$resultPHP_1.$tempPHP.");\r\n";
			echo "<br>循环中程序执行时间";
			$e=microtime(true);
			echo round(($e-$s),4);
		}

		//echo $resultJS;
		$path=__SITEROOT."/views/js";
		$fileName='region.js';
		$handel = fopen($path.'/'.$fileName,'w+');
		//$writeStr = "var region=new Array();\r\n".$resultJS;
		fwrite($handel,$resultJS);
		fclose($handel);
		$path=__SITEROOT."/library/custom";
		$fileName='region_array.php';
		$handel = fopen($path.'/'.$fileName,'w+');
		//$writeStr = "var region=new Array();\r\n".$resultJS;
		fwrite($handel,$resultPHP_1.$resultPHP_2);
		fclose($handel);


		/**the code below is for xlh date change
		$fileName='region_array.php';
		require_once($path.'/'.$fileName);
		$fileName='std_path.php';
		$handel = fopen($path.'/'.$fileName,'w+');
		$resultPHP_3='<?php'."\r\n".'$std_path=array();'."\r\n";
		//$regionInfo['1726']=array('十四组','14','0,1,2,5,71,126,1712,1726');
		count($regionInfo);
		$org_docor_temp=array();
		foreach ($regionInfo as $key=>$value){
		$temp=explode(',',$value[2]);
		//是最下一级
		if(count($temp)==8){
		//$std_path[]
		//std_2
		$temp1=$regionInfo[$temp[4]][1].
		$regionInfo[$temp[5]][1].
		$regionInfo[$temp[6]][1].
		$regionInfo[$temp[7]][1];
		//address
		$temp2=$regionInfo[$temp[4]][0].
		$regionInfo[$temp[5]][0].
		$regionInfo[$temp[6]][0].
		$regionInfo[$temp[7]][0];
		//path
		$temp_path=$value[2];

		$temp3=$regionInfo[$temp[4]][1].
		$regionInfo[$temp[5]][1];
		$temp4=$temp[0].','.$temp[1].','.$temp[2].','.$temp[3].','.$temp[4].','.$temp[5];
		$org_doctor_temp[$temp4]=$temp3;

		$resultPHP_3=$resultPHP_3.'$std_path['."'".$temp1."']=";
		$resultPHP_3=$resultPHP_3."array('".$temp2."','".$temp_path."');\r\n";
		}
		}


		//生成机构与医生
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/staff_core.php');
		//$org_doctor=array();
		//var_dump($org_doctor_temp);
		$org=new Torganization();
		$doctor=new Tstaff_core();
		$doctor->joinAdd('left',$doctor,$org,'org_id','id');
		$doctor->find();
		$resultPHP_4='$org_doctor=array();'."\r\n";
		while ($doctor->fetch()){
		$temp=explode(',',$doctor->region_path);
		if(count($temp)==6){

		//通过path获取标准代码
		$std_code=$org_doctor_temp[$doctor->region_path];
		$resultPHP_4=$resultPHP_4.'$org_doctor['."'".$std_code."']=";
		$resultPHP_4=$resultPHP_4."array('".$org->id."','".$doctor->id."');\r\n";
		}
		}






		fwrite($handel,$resultPHP_3.$resultPHP_4);
		fclose($handel);
		*/
	}
	//public function c1Action(){
	//本代码用于刷新生成所有的standard_code_path，2011－09－08
	public function refreshAction(){

		set_time_limit(0);
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/custom/region_array.php');

		$region=new Tregion();
		$region->find();
		while($region->fetch()){
			$region_uuid=$region->uuid;
			$region_path=$region->region_path;
			//增加生成standard_code_path的代码 
			$region_path_array=explode(',',$region_path);//这里与正常代码中不一样，注意，前面是 $parent_region_path
			$standard_code_path='';
			foreach ($region_path_array as $value){
				$standard_code_path=$standard_code_path.$regionInfo[$value][1].',';
			}
			$standard_code_path=rtrim($standard_code_path,',');
			echo $standard_code_path.'|<br />';
			$region1=new Tregion();
			$region1->where("uuid='$region_uuid'");
			$region1->standard_code_path=$standard_code_path;
			$region1->update();
			echo $region1->showSQL()."<br />";
			
		}
		exit();
	}

	public function createRegionArray(){
		set_time_limit(0);
		$region=new Tregion();
		$region1=new Tregion();
		$region->orderby("id asc");
		$region->find();
		$resultJS="var region=new Array();\r\n";//必须双引号
		$resultPHP_1='<?php'."\r\n".'$regionDomain=array();'."\r\n";
		$resultPHP_2='$regionInfo=array();'."\r\n";
		//$resultPHP_3='$std_region_path=array();'."\r\n";
		while($region->fetch()){
			$resultPHP_2=$resultPHP_2.'$regionInfo['."'".$region->id."']=array('".$region->zh_name."','".$region->standard_code."','".$region->region_path."');\r\n";
			//$resultPHP_3=$resultPHP_3.'$std_region_path['."'".$region->id."']=array('".$region->zh_name."','".$region->standard_code."','".$region->region_path."');\r\n";
			$counter=explode(',',$region->region_path);
			//组这一级没有下级了，不生成$regionDomain
			if(count($counter)==8){
				continue;
			}
			$p_id=$region->id;
			$region1->where("p_id='$p_id'");
			$region1->orderby("id asc");
			$region1->find();
			//$counter=0;
			$resultJS=$resultJS."region['".$p_id."']=new Array(";
			$resultPHP_1=$resultPHP_1.'$regionDomain["'.$p_id.'"]=array(';
			$tempJS='';
			$tempPHP='';
			while ($region1->fetch()){
				$tempJS=$tempJS."new Array('".$region1->id."','".$region1->zh_name."','".$region1->standard_code."','".$region1->region_path."'),";
				$tempPHP=$tempPHP."array('".$region1->id."','".$region1->zh_name."','".$region1->standard_code."'),";
				//$resultJS=$resultJS."region[".$p_id."][".$counter."]=new Array('".$region1->id."','".$region1->zh_name."');\r\n";
				//$counter++;
			}
			$tempJS=rtrim($tempJS,',');
			$tempPHP=rtrim($tempPHP,',');
			$resultJS=$resultJS.$tempJS.");\r\n";
			$resultPHP_1=$resultPHP_1.$tempPHP.");\r\n";
			//echo "<br>循环中程序执行时间";
			//$e=microtime(true);
			//echo round(($e-$s),4);

		}
		//echo $resultJS;
		$path=__SITEROOT."/views/js";
		$fileName='region.js';
		$handel = fopen($path.'/'.$fileName,'w+');
		//$writeStr = "var region=new Array();\r\n".$resultJS;
		fwrite($handel,$resultJS);
		fclose($handel);
		$path=__SITEROOT."/library/custom";
		$fileName='region_array.php';
		$handel = fopen($path.'/'.$fileName,'w+');
		//$writeStr = "var region=new Array();\r\n".$resultJS;
		fwrite($handel,$resultPHP_1.$resultPHP_2);
		fclose($handel);


		/**the code below is for xlh date change
		$fileName='region_array.php';
		require_once($path.'/'.$fileName);
		$fileName='std_path.php';
		$handel = fopen($path.'/'.$fileName,'w+');
		$resultPHP_3='<?php'."\r\n".'$std_path=array();'."\r\n";
		//$regionInfo['1726']=array('十四组','14','0,1,2,5,71,126,1712,1726');
		count($regionInfo);
		$org_docor_temp=array();
		foreach ($regionInfo as $key=>$value){
		$temp=explode(',',$value[2]);
		//是最下一级
		if(count($temp)==8){
		//$std_path[]
		//std_2
		$temp1=$regionInfo[$temp[4]][1].
		$regionInfo[$temp[5]][1].
		$regionInfo[$temp[6]][1].
		$regionInfo[$temp[7]][1];
		//address
		$temp2=$regionInfo[$temp[4]][0].
		$regionInfo[$temp[5]][0].
		$regionInfo[$temp[6]][0].
		$regionInfo[$temp[7]][0];
		//path
		$temp_path=$value[2];

		$temp3=$regionInfo[$temp[4]][1].
		$regionInfo[$temp[5]][1];
		$temp4=$temp[0].','.$temp[1].','.$temp[2].','.$temp[3].','.$temp[4].','.$temp[5];
		$org_doctor_temp[$temp4]=$temp3;

		$resultPHP_3=$resultPHP_3.'$std_path['."'".$temp1."']=";
		$resultPHP_3=$resultPHP_3."array('".$temp2."','".$temp_path."');\r\n";
		}
		}


		//生成机构与医生
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/staff_core.php');
		//$org_doctor=array();
		//var_dump($org_doctor_temp);
		$org=new Torganization();
		$doctor=new Tstaff_core();
		$doctor->joinAdd('left',$doctor,$org,'org_id','id');
		$doctor->find();
		$resultPHP_4='$org_doctor=array();'."\r\n";
		while ($doctor->fetch()){
		$temp=explode(',',$doctor->region_path);
		if(count($temp)==6){

		//通过path获取标准代码
		$std_code=$org_doctor_temp[$doctor->region_path];
		$resultPHP_4=$resultPHP_4.'$org_doctor['."'".$std_code."']=";
		$resultPHP_4=$resultPHP_4."array('".$org->id."','".$doctor->id."');\r\n";
		}
		}






		fwrite($handel,$resultPHP_3.$resultPHP_4);
		fclose($handel);
		*/
	}
	public function crAction(){
		set_time_limit(0);
		$region=new Tregion();
		$region1=new Tregion();
		$region->orderby("id asc");
		$region->find();
		$resultJS="var region=new Array();\r\n";//必须双引号
		$resultPHP_1='<?php'."\r\n".'$regionDomain=array();'."\r\n";
		$resultPHP_2='$regionInfo=array();'."\r\n";
		//$resultPHP_3='$std_region_path=array();'."\r\n";
		while($region->fetch()){
			$resultPHP_2=$resultPHP_2.'$regionInfo['."'".$region->id."']=array('".$region->zh_name."','".$region->standard_code."','".$region->region_path."');\r\n";
			//$resultPHP_3=$resultPHP_3.'$std_region_path['."'".$region->id."']=array('".$region->zh_name."','".$region->standard_code."','".$region->region_path."');\r\n";
			$counter=explode(',',$region->region_path);
			//组这一级没有下级了，不生成$regionDomain
			if(count($counter)==8){
				continue;
			}
			$p_id=$region->id;
			$region1->where("p_id='$p_id'");
			$region1->orderby("id asc");
			$region1->find();
			//$counter=0;
			$resultJS=$resultJS."region['".$p_id."']=new Array(";
			$resultPHP_1=$resultPHP_1.'$regionDomain["'.$p_id.'"]=array(';
			$tempJS='';
			$tempPHP='';
			while ($region1->fetch()){
				$tempJS=$tempJS."new Array('".$region1->id."','".$region1->zh_name."','".$region1->standard_code."','".$region1->region_path."'),";
				$tempPHP=$tempPHP."array('".$region1->id."','".$region1->zh_name."','".$region1->standard_code."'),";
				//$resultJS=$resultJS."region[".$p_id."][".$counter."]=new Array('".$region1->id."','".$region1->zh_name."');\r\n";
				//$counter++;
			}
			$tempJS=rtrim($tempJS,',');
			$tempPHP=rtrim($tempPHP,',');
			$resultJS=$resultJS.$tempJS.");\r\n";
			$resultPHP_1=$resultPHP_1.$tempPHP.");\r\n";
			//echo "<br>循环中程序执行时间";
			//$e=microtime(true);
			//echo round(($e-$s),4);

		}
		//echo $resultJS;
		$path=__SITEROOT."/views/js";
		$fileName='region.js';
		$handel = fopen($path.'/'.$fileName,'w+');
		//$writeStr = "var region=new Array();\r\n".$resultJS;
		fwrite($handel,$resultJS);
		fclose($handel);
		$path=__SITEROOT."/library/custom";
		$fileName='region_array.php';
		$handel = fopen($path.'/'.$fileName,'w+');
		//$writeStr = "var region=new Array();\r\n".$resultJS;
		fwrite($handel,$resultPHP_1.$resultPHP_2);
		fclose($handel);
		echo "刷新生成";
		exit();


		/**the code below is for xlh date change
		$fileName='region_array.php';
		require_once($path.'/'.$fileName);
		$fileName='std_path.php';
		$handel = fopen($path.'/'.$fileName,'w+');
		$resultPHP_3='<?php'."\r\n".'$std_path=array();'."\r\n";
		//$regionInfo['1726']=array('十四组','14','0,1,2,5,71,126,1712,1726');
		count($regionInfo);
		$org_docor_temp=array();
		foreach ($regionInfo as $key=>$value){
		$temp=explode(',',$value[2]);
		//是最下一级
		if(count($temp)==8){
		//$std_path[]
		//std_2
		$temp1=$regionInfo[$temp[4]][1].
		$regionInfo[$temp[5]][1].
		$regionInfo[$temp[6]][1].
		$regionInfo[$temp[7]][1];
		//address
		$temp2=$regionInfo[$temp[4]][0].
		$regionInfo[$temp[5]][0].
		$regionInfo[$temp[6]][0].
		$regionInfo[$temp[7]][0];
		//path
		$temp_path=$value[2];

		$temp3=$regionInfo[$temp[4]][1].
		$regionInfo[$temp[5]][1];
		$temp4=$temp[0].','.$temp[1].','.$temp[2].','.$temp[3].','.$temp[4].','.$temp[5];
		$org_doctor_temp[$temp4]=$temp3;

		$resultPHP_3=$resultPHP_3.'$std_path['."'".$temp1."']=";
		$resultPHP_3=$resultPHP_3."array('".$temp2."','".$temp_path."');\r\n";
		}
		}


		//生成机构与医生
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/staff_core.php');
		//$org_doctor=array();
		//var_dump($org_doctor_temp);
		$org=new Torganization();
		$doctor=new Tstaff_core();
		$doctor->joinAdd('left',$doctor,$org,'org_id','id');
		$doctor->find();
		$resultPHP_4='$org_doctor=array();'."\r\n";
		while ($doctor->fetch()){
		$temp=explode(',',$doctor->region_path);
		if(count($temp)==6){

		//通过path获取标准代码
		$std_code=$org_doctor_temp[$doctor->region_path];
		$resultPHP_4=$resultPHP_4.'$org_doctor['."'".$std_code."']=";
		$resultPHP_4=$resultPHP_4."array('".$org->id."','".$doctor->id."');\r\n";
		}
		}






		fwrite($handel,$resultPHP_3.$resultPHP_4);
		fclose($handel);
		*/
	}
   /**
    * 转移地区后的目标地区下的org列表
    */
        public function getorgAction()
        {
            $region_id = $this->_request->getParam('region_id');
            if(!empty($region_id))
            {
                //取得目标地区的region_path
                $region = new Tregion();
                $region->whereAdd("id=$region_id");
                $region->find(true);
                $region_path = $region->region_path;
                $region_array = explode(',', $region_path);
                $region_length = count($region_array);
                if($region_length>6)
                {
                    //此时的待转地区在村或者组下面 因此取镇或者乡这级的地区id
                    $new_region_id = $region_array[5];
                    if(!empty($new_region_id))
                    {
                        $new_region =  new Tregion();
                        $new_region->whereAdd("id=$new_region_id");
                        $new_region->find(true);
                        $new_region_path = $new_region->region_path;
                        $new_organization = new Torganization();
                        $new_organization->whereAdd("region_path like '$new_region_path'");
                        $new_organization->find();
                        $str = '<select name="org_name" onchange="getdoctorlist(this.value)">';
                        $str.='<option value="-9">请选择...</option>';
                        while($new_organization->fetch())
                        {
                            $str.='<option value="'.$new_organization->id.'">'.$new_organization->zh_name.'</option>';
                        }
                        $str.='</select>';
                        echo $str;
                    }
                    else
                    {
                        echo "内部错误";
                    }
                }
                else
                {
                    $organization =  new Torganization();
                    $organization->whereAdd("region_path like '$region_path%'");
                    $organization->find();
                    $str = '<select name="org_name" onchange="getdoctorlist(this.value)">';
                    $str.='<option value="-9">请选择...</option>';
                    while($organization->fetch())
                    {
                        $str.='<option value="'.$organization->id.'">'.$organization->zh_name.'</option>';
                    }
                    $str.='</select>';
                    echo $str;
                }
            }
          }
            /**
             * 取得目标机构的所有医生
             */
            public function getdoctorAction()
            {
                $org_id = $this->_request->getParam('org_id');
                if(!empty($org_id))
                {
                    $staff_core = new Tstaff_core();
                    $staff_core->whereAdd("org_id =$org_id ");
                    $staff_core->find();
                    $str = '';
                    while($staff_core->fetch())
                    {
                        $str.='<input type="checkbox" name="doctor[]" value="'.$staff_core->id.'" /> '.$staff_core->name_login.'';
                    }
                    echo $str;
                }
            }
}
<?php
class organization_listorgController extends controller {
	public function init(){
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'application/organization/models/createjs.php');
	}
	/**
	 * 列表显示机构
	 *
	 */
	public function listorgAction(){
		$this->view->basePath = $this->_request->getBasePath();
		//$current_id = trim($this->_request->getParam('region_id'));
		$regionId = trim($this->_request->getParam('region_id'));
		//echo $regionId;
		if(!empty($regionId)){
			//分页调用
			require_once __SITEROOT."/library/custom/pager.php";
			//获取分页参数
			$currentPage = intval($this->_request->getParam('page'));
			$realPage    = empty($currentPage)?1:$currentPage;
			//所有机构类型
			$orgType = array(1=>"行政机构",2=>"执法机构",3=>"医院",4=>"社区",5=>"乡镇卫生院");
			$this->view->orgType = $orgType;
			//获取当前地区ID的信息
			$region = new Tregion();
			$region->whereAdd("id='$regionId'");
			$region->find(true);
			$regionPath = trim($region->region_path);
			$regionName = trim($region->zh_name);
			$regionParentId = trim($region->p_id);
			$oldPathNu = count(explode(',',$regionPath));
			//echo $oldPathNu;
			$orgNumber = new Torganization();
			$orgNumber->whereAdd("region_path = '$regionPath'");
			$nuNumber = $orgNumber->count();
			$arrArg = array();
			$links = new SubPages(__ROWSOFPAGE,$nuNumber,$realPage,__goodsListRowOfPage,__BASEPATH.'organization/listorg/listorg/region_id/'.$regionId.'/page/',3,$arrArg);
			$pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
			$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
			// 列表查找当前地区所有的机构信息
			if($nuNumber>0){
				$organization = new Torganization();
				$organization->whereAdd("region_path = '$regionPath'");
				//$organization->debugLevel(9);
				$orgNumber=$organization->count('*');
				//echo $orgNumber;
				$organization->count('');
				$organization->orderby("id ASC");
				$organization->limit($startnum,__ROWSOFPAGE);
				$organization->find();
				$listArry=array();
				$count = 0;
				while ($organization->fetch()){
					$listArry[$count]['zh_name'] = $organization->zh_name;
					$listArry[$count]['id'] = trim($organization->id);
					$listArry[$count]['standard_code'] = trim($organization->standard_code);
					$listArry[$count]['region_path'] = $organization->region_path;
					$listArry[$count]['type'] = $organization->type;
					$listArry[$count]['region_id'] = $regionId;
					$count++;
				}
				$this->view->orgArr  = $listArry;
			}else{
				$msg = '<tr><td colspan="5" align="center"><strong>当前地区没有任机构！</strong></td></tr>';
				$this->view->msg = $msg;
			}
			$page = $links->subPageCss2();
			$this->view->page = $page;
		}
		//var_dump($listArry);
		$this->view->basePath=__BASEPATH;
		//echo $regionName;
		$this->view->zh_name = $regionName;
		$this->view->regionParentId  = $regionParentId;
		$this->view->nuNumber  = $orgNumber;
		$this->view->region_id = $regionId;
		//获取当前区域
		$this->view->display('listorg.html');
	}
	/**
	 * 显示一个机构的信息
	 */
	public function displayAction(){
		$this->view->basePath = __BASEPATH;
		//该机构所属的地区
		$regionId = $this->_request->getParam('region_id');
		$organizationId = $this->_request->getParam('organization_id');
		//echo $organizationId;
		//echo $regionId;

		//exit();
		if(!empty($regionId) and !empty($organizationId)){
			//获取当前地区ID的信息
			$region = new Tregion();
			$region->whereAdd("id='$regionId'");
			//$region->debugLevel(9);
			$region->find(true);
			$regionPath = trim($region->region_path);
			$this->view->region_name=trim($region->zh_name);
			//$regionParentId = trim($region->p_id);
			//echo $regionPath;
			//exit();
			//$regionCode = trim($listRegion->standard_code);
			//regionDeepth用于判断级次 国家1 省2 市县3 街道4......
			$regionDeepth = count(explode(',',$regionPath));
			//所有机构类型
			$orgType = array(1=>"卫生行政机构",2=>"卫生执法机构",3=>"医院",4=>"社区卫生服务中心",5=>"乡镇卫生院");
			$this->view->orgType = $orgType;
			$organization = new Torganization();
			//$newOrg->debugLevel(9);
			$organization->whereAdd("id='$organizationId'");
			$organization->find(true);
			//$standardCode = trim($organization->standard_code);
			//详见设计文档
			//echo $organization->region_path_domain;
			$orgRegionDomain = explode('|',$organization->region_path_domain);

			$region = new Tregion();
			$region->whereAdd("region_path like '$regionPath%'");
			$region->orderby("id ASC");
			$region->find();
			$regionArray = array();
			$counter = 0;
			$column_counter=1;
			while($region->fetch()){
				$deepth = count(explode(',',$region->region_path));
				//当前地区及当前地区的直接下一级地区
				if($deepth==$regionDeepth or $deepth==($regionDeepth+1)){
					$regionArray[$counter]['zh_name'] = $region->zh_name;
					$regionArray[$counter]['region_path'] = trim($region->region_path);
					$regionArray[$counter]['standard_code'] = trim($region->standard_code);
					//echo $region->region_path."<br />";
					if(in_array($region->region_path,$orgRegionDomain)){
						//echo 'ok';
						//$pathArr[$counter]['ck'] = "checked='checked'";
						$regionArray[$counter]['ck'] = "checked";
					}else{
						//echo 'no';
						$regionArray[$counter]['ck']='';
					}
					if($deepth==$regionDeepth){
						$regionArray[$counter]['current']=1;
						$column_counter=0;
					}else{
						$regionArray[$counter]['current']=2;
					}
					$regionArray[$counter]['column_counter']=$column_counter;
					if($column_counter>=4){
						$column_counter=1;
					}else{
						$column_counter++;
					}
					$counter++;
				}
			}
			$this->view->pathArr = $regionArray;
            $region_path=explode(',',$regionPath);
            $city='';
            $region=new Tregion();
            $region->whereAdd("id='".$region_path[3]."'");
            $region->find(true);
            $region->free_statement();
            $city=$region->zh_name?$region->zh_name:'雅安市';
            $this->view->city=$city;
		}
		$this->view->regionName = $region->zh_name;
		//$this->view->rootpath = __BASEPATH;
		$this->view->zh_name = trim($organization->zh_name);
        $this->view->position_x=$organization->longitude;
        $this->view->position_y=$organization->latitude;
        $this->view->address=$organization->address;
        $this->view->phone=$organization->phone;
        $this->view->org_info=$organization->org_info;
		$this->view->standard_code = trim($organization->standard_code);
		$this->view->password = trim($organization->password);
		$this->view->region_id = $regionId;
		$this->view->organization_id = $organizationId;
		$this->view->type = $organization->type;
		//echo $regionName;
		//exit();
		//var_dump($this->view);
		$this->view->display('display.html');
	}
	/**
	 * 添加机构
	 *
	 */
	public function addorgAction(){
		$regionId = trim($this->_request->getParam('region_id'));
		$zh_name = trim($this->_request->getParam('zh_name'));
		$orgType = trim($this->_request->getParam('orgtype'));
		$standard_code = trim($this->_request->getParam('standard_code'));
		$password  =  trim($this->_request->getParam('pwd'));
		$password1  =  trim($this->_request->getParam('pwd1'));
		$subOk = $this->_request->getParam('ok');
		if($subOk){
			if(empty($zh_name)||empty($password)||empty($password1)){
				echo '<script type="text/javascript">window.alert("请输入您的机构名称和机构密码！");history.go(-1);</script>';
				//$this->redirect(__BASEPATH.'organization/org/index/parent_id/'.$newRegion->p_id);
				exit();
			}
			if($password!==$password1){
				echo '<script type="text/javascript">window.alert("您输入的机构名称和机构密码不一致！");history.go(-1);</script>';
				exit();
			}


			//判断内部码是否重复
			$organization = new Torganization();
			$organization->whereAdd("standard_code='$standard_code'");
			//			if($organization->count()>0){
			//				echo '<script type="text/javascript">window.alert("机构内部码重复?添加失败！");history.go(-1);</script>';
			//			}else{
			//echo "ddddddddddddddddd";
			//查找当前地区的path
			$region = new Tregion();
			$region->whereAdd("id='$regionId'");
			$region->find(true);
			$regionPath = $region->region_path;
			//写入数据表(判断当前数据表有无记录)
			$organization = new Torganization();
			if($organization->count('*')=='0'){
				$id ='1';
			}else{
				//有记录的时候
				//$selOrg = new Torganization();
				$organization->count('');
				$organization->orderby("id DESC");
				$organization->limit(0,1);
				$organization->find(true);
				$id=intval($organization->id+1);
			}
			$organization = new Torganization();
			$organization->id = $id;
			$organization->region_path = $regionPath;
			$organization->region_path_domain = $regionPath;
			$organization->type = $orgType;
			$organization->zh_name = $zh_name;
			$organization->standard_code = $standard_code;
			$organization->password=md5($password);
			//$organization->debugLevel(9);
			if($organization->insert()){
				//生成一个js数组文件
				createjs(__SITEROOT.'views/js','organization.js','Torganization','organizationArray');
				//新增单个JS文件的生成用于首页flash点击
		        createlonejs(__SITEROOT.'views/js','5','organizationArray');
				$this->redirect(__BASEPATH.'organization/listorg/listorg/region_id/'.$regionId);
				//echo __BASEPATH.'organization/listorg/listorg/region_id/'.$regionId;
			}
			//			}

		}
	}
	/**
	 * 更新机构
	 *
	 */
	public function editAction(){
		$region_id = $this->_request->getParam('region_id');
		$organization_id = $this->_request->getParam('organization_id');
		$zh_name = $this->_request->getParam('zh_name');
		$standard_code = $this->_request->getParam('standard_code');
		$type = $this->_request->getParam('type');
		$regionDomain = $this->_request->getParam('regionDomain');
		$password = $this->_request->getParam('password');
		$change_password = $this->_request->getParam('change_password');
        $address = $this->_request->getParam('address');
        $phone = $this->_request->getParam('phone');
        $org_info = $this->_request->getParam('org_info');
        $lat = $this->_request->getParam('lat');
        $lng = $this->_request->getParam('lng');
        
		$organization=new Torganization();
		$organization->whereAdd("id='$organization_id'");
		$organization->zh_name=$zh_name;
		$organization->standard_code=$standard_code;
		$organization->type=$type;
		$organization->region_path_domain=$regionDomain;
        $organization->address=$address;
        $organization->phone=$phone;
        $organization->org_info=$org_info;
        $organization->latitude=$lat;
        $organization->longitude=$lng;
		if($change_password=='yes'){
			$organization->password=md5($password);
		}
		//$organization->debugLevel(9);
		$organization->update();
		$organization->oracle_error();
		@createjs(__SITEROOT.'views/js','organization.js','Torganization','organizationArray');
		//新增单个JS文件的生成用于首页flash点击
		createlonejs(__SITEROOT.'views/js','5','organizationArray');
		echo '机构更新成功!';

	}
	/**
	 * 删除机构
	 *
	 */
	public function delorgAction(){
		require_once __SITEROOT.'library/Models/staff_core.php';
		$delId = $this->_request->getParam('del_id');
		if(!empty($delId)){
			$staffCore = new Tstaff_core();
			$realOrg   = new Torganization();
			$realOrg->joinAdd('inner',$realOrg,$staffCore,'id','org_id');
			$realOrg->whereAdd("organization.id='$delId'");
			if($realOrg->count()==0){
				if($realOrg->delete()){
					echo '<script type="text/javascript">window.alert("该机构删除成功!");history.go(-1);</script>';

				}
			}else{
				echo '<script type="text/javascript">window.alert("该机构已经有了工作人员，不能删除!");history.go(-1);</script>';
				exit();
			}
			$delOrg = new Torganization();
			$delOrg->whereAdd("id='$delId'");
			$delOrg->find(true);
			$regionPathDomain = $delOrg->region_path_domain;
			//			$str = '1,2,3|2,5,8|2,5,6';
			//			$strArr = count(explode('|',$str));
			//			echo $strArr;
			$splitCount = count(explode('|',$regionPathDomain));
			$realDelOrg = new Torganization();
			$realDelOrg->whereAdd("id='$delId'");

			if($splitCount=='1'){
				if($delOrg->region_path==$delOrg->region_path_domain){
					if($realDelOrg->delete()){
						//生成一个js数组文件
						createjs(__SITEROOT.'views/js','organization.js','Torganization','organizationArray');
						//新增单个JS文件的生成用于首页flash点击
		                createlonejs(__SITEROOT.'views/js','5','organizationArray');
						echo '<script type="text/javascript">window.alert("该机构删除成功!");history.go(-1);</script>';
					}
				}else{
					echo '<script type="text/javascript">window.alert("该机构管辖有下属机构，不能删除!");history.go(-1);</script>';
				}
			}else{
				echo '<script type="text/javascript">window.alert("该机构管辖有下属机构，不能删除!");history.go(-1);</script>';
			}
		}
	}
}
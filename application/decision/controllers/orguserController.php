<?php
class decision_orguserController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'library/Models/organization.php';
		require_once __SITEROOT.'library/Models/staff_core.php';
		require_once __SITEROOT.'library/Models/staff_archive.php';
	}
	public function indexAction(){
		require_once(__SITEROOT.'application/decision/models/countrows.php');
		$this->view->basePath = __BASEPATH;
		//获取当前登录的机构信息
		$currentId = $this->user['org_id'];
		$organization = new Torganization();
		$organization->whereAdd("id='$currentId'");
		$organization->find(true);
		$this->view->basePath = __BASEPATH;
		$this->view->orgname  =  $organization->zh_name;
		$this->view->orgtype  =  $organization->type;
		$region = $this->user['current_region_path'];
		//将当前region给传过去
		$this->view->regionpath            = $region;
		$regionname = $this->_request->getParam('regionname');
		$orgid      = $this->_request->getParam('parentid');
		$this->view->currentid             = $currentId;
		$this->view->caching		=__CACHING;//开启缓存
		$this->view->cache_lifetime	=__CACHING_LEFTTIME;//缓存时间

		if(!$this->view->is_cached('orguser.html',$orgid)){
			//获取上一级的path
			$oldorg = new Torganization();
			$oldorg->whereAdd("id='$orgid'");
			$oldorg->find(true);
			$parentpath = $oldorg->region_path;
			//查询当前机构对应的下边的所有机构
			$orgnew   = new Torganization();
			$orgnew->whereAdd("region_path like '$regionname%'");
			$orgnew->whereAdd("id<>'$orgid'");
			$orgnew->find();
			$orgnewarr       = array();
			$orgnewarrcount  = 0;
			//在编人员的合计初始化
			$organizercountall  = 0;
			//卫生技术人员合计初始化
			$typeofworkcountall = 0;
			//其他技术人员初始化
			$typeofworkcountall2 = 0;
			//管理人员初始化
			$typeofworkcountall3 = 0;
			//工勤技能人员初始化
			$typeofworkcountall4 = 0;
			//职业医师初始化
			$physiciancountallzy = 0;
			$physiciancountallqt = 0;
			//执业助理医师初始化
			$physiciancountallzyzy = 0;
			$physiciancountallzyqt = 0;
			//注册护士初始化
			$protectcountall  = 0;
			//西药师
			$fdoctorcountall  = 0;
			//中药师
			$zdoctorcountall = 0;
			//检验技师(士)
			$checkcountall = 0;
			//影像技师(士)
			$photocountall = 0;
			//退休人员
			$mobilitycountall = 0;
			//年内退休
			$mobilitydatecountall = 0;
			while($orgnew->fetch()){
				//取当前级别的直接下一级的所有统计信息
				if(count(explode(',',$orgnew->region_path))-count(explode(',',$parentpath))==1){
					//在编人员初始化
					$organizercount  = 0;
					//卫生技术人员
					$typeofworkcount = 0;
					//其他技术人员
					$typeofworkcount2 = 0;
					//管理人员
					$typeofworkcount3 = 0;
					//工勤技能人员
					$typeofworkcount4 = 0;
					//执业医师
					$physiciancountzy = 0;
					$physiciancountqt = 0;
					//执业助理医师
					$physiciancountzyzy = 0;
					$physiciancountzyqt = 0;
					//注册护士
					$protectcount    = 0;
					//西药师
					$fdoctorcount = 0;
					//中药师
					$zdoctorcount = 0;
					//检验技师(士)
					$checkcount = 0;
					//影像技师(士)
					$photocount = 0;
					//退休人员
					$mobilitycount = 0;
					//年内退休人
					$mobilitydatecount = 0;
					$staffcore    = new Tstaff_core();
					$staffarchive = new Tstaff_archive();
					$staffcore->joinAdd('inner',$staffcore,$staffarchive,'id','user_id');
					$staffcore->whereAdd("org_id='$orgnew->id'");
					$staffcore->find();
					while($staffcore->fetch()){
						//在编人员
						if($staffarchive->organizer=="1"){
							$organizercount = $organizercount+1;
						}
						//卫生技术人员
						if($staffarchive->type_of_work=="1"){
							$typeofworkcount = $typeofworkcount+1;
						}
						//其他技术人员
						if($staffarchive->type_of_work=="2"){
							$typeofworkcount2 = $typeofworkcount2+1;
						}
						//管理人员
						if($staffarchive->type_of_work=="3"){
							$typeofworkcount3 = $typeofworkcount3+1;
						}
						//工勤技能人员
						if($staffarchive->type_of_work=="4"){
							$typeofworkcount4 = $typeofworkcount4+1;
						}
						//执业医师
						if($staffarchive->specialty_code=="11"){
							if($staffarchive->physician_certified_type=="4"){
								//中医
								$physiciancountzy = $physiciancountzy+1;
							}else{
								//其他
								$physiciancountqt = $physiciancountqt+1;
							}
						}
						//执业助理医师
						if($staffarchive->specialty_code=="12"){
							if($staffarchive->physician_certified_type=="4"){
								//中医
								$physiciancountzyzy = $physiciancountzyzy+1;
							}else{
								//其他
								$physiciancountzyqt = $physiciancountzyqt+1;
							}
						}
						//注册护士
						if($staffarchive->specialty_code=="21"){
							$protectcount = $protectcount+1;
						}
						//西药师
						if($staffarchive->specialty_code=="31"){
							$fdoctorcount = $fdoctorcount+1;
						}
						//中药师
						if($staffarchive->specialty_code=="32"){
							$zdoctorcount = $zdoctorcount+1;
						}
						//检验技师(士)
						if($staffarchive->specialty_code=="41"){
							$checkcount = $checkcount+1;
						}
						//影像技师(士)
						if($staffarchive->specialty_code=="42"){
							$photocount = $photocount+1;
						}
						//退休人员
						if($staffarchive->mobility=="24"){
							$mobilitycount = $mobilitycount +1;
						}
						//年内退休人员
						if($staffarchive->mobility_date==""){
							$mobilitydatecount = $mobilitydatecount + 0;
						}else{
							//判断是不是在当年内
							$nowtime = date('Y',time());
							$oldtime = date('Y',$staffarchive->mobility_date);
							if($nowtime==$oldtime){
								$mobilitydatecount = $mobilitydatecount+1;
							}else{
								$mobilitydatecount = $mobilitydatecount + 0;
							}
						}
					}
					//每个机构在编人员合计
					$orgnewarr[$orgnewarrcount]['organizercount']        = $organizercount;
					//每个机构卫生技术人员合计
					$orgnewarr[$orgnewarrcount]['typeofworkcount']       = $typeofworkcount;
					//每个机构其他技术人员合计
					$orgnewarr[$orgnewarrcount]['typeofworkcount2']      = $typeofworkcount2;
					//每个机构管理人员合计
					$orgnewarr[$orgnewarrcount]['typeofworkcount3']      = $typeofworkcount3;
					//每个机构工勤技能人员合计
					$orgnewarr[$orgnewarrcount]['typeofworkcount4']      = $typeofworkcount4;
					//职业医师
					$orgnewarr[$orgnewarrcount]['physiciancountzy']      = $physiciancountzy;
					$orgnewarr[$orgnewarrcount]['physiciancountqt']      = $physiciancountqt;
					//执业助理医师
					$orgnewarr[$orgnewarrcount]['physiciancountzyzy']    = $physiciancountzyzy;
					$orgnewarr[$orgnewarrcount]['physiciancountzyqt']    = $physiciancountzyqt;
					//注册护士
					$orgnewarr[$orgnewarrcount]['protectcount']          = $protectcount;
					//西药师
					$orgnewarr[$orgnewarrcount]['fdoctorcount']          = $fdoctorcount;
					//中药师
					$orgnewarr[$orgnewarrcount]['zdoctorcount']          = $zdoctorcount;
					//检验技师(士)
					$orgnewarr[$orgnewarrcount]['checkcount']            = $checkcount;
					//影像技师(士)
					$orgnewarr[$orgnewarrcount]['photocount']            = $photocount;
					//退休人员
					$orgnewarr[$orgnewarrcount]['mobilitycount']         = $mobilitycount;
					//年内退休
					$orgnewarr[$orgnewarrcount]['mobilitydatecount']     = $mobilitydatecount;
					//在编人员合计
					$organizercountall = $organizercountall + intval($organizercount);
					//卫生技术人员合计
					$typeofworkcountall= $typeofworkcountall + intval($typeofworkcount);
					//其他技术人员合计
					$typeofworkcountall2= $typeofworkcountall2 + intval($typeofworkcount2);
					//管理人员合计
					$typeofworkcountall3= $typeofworkcountall3 + intval($typeofworkcount3);
					//工勤技能人员合计
					$typeofworkcountall4= $typeofworkcountall4 + intval($typeofworkcount4);
					//职业医师合计
					$physiciancountallzy= $physiciancountallzy+intval($physiciancountzy);
					$physiciancountallqt= $physiciancountallqt+intval($physiciancountqt);
					//执业助理医师合计
					$physiciancountallzyzy = $physiciancountallzyzy + intval($physiciancountzyzy);
					$physiciancountallzyqt = $physiciancountallzyqt + intval($physiciancountzyqt);
					//注册护士合计
					$protectcountall   = $protectcountall + intval($protectcount);
					//西药师合计
					$fdoctorcountall   = $fdoctorcountall + intval($fdoctorcount);
					//中药师合计
					$zdoctorcountall   = $zdoctorcountall + intval($zdoctorcount);
					//检验技师(士)合计
					$checkcountall     = $checkcountall + intval($checkcount);
					//影像技师(士)合计
					$photocountall     = $photocountall + intval($photocount);
					//退休人员合计
					$mobilitycountall  = $mobilitycountall + intval($mobilitycount);
					//年内退休人员合计
					$mobilitydatecountall  = $mobilitydatecountall + intval($mobilitydatecount);
					$orgnewarr[$orgnewarrcount]['zh_name']              = $orgnew->zh_name;
					$orgnewarr[$orgnewarrcount]['region_path']          = $orgnew->region_path;
					$orgnewarr[$orgnewarrcount]['id']                   = $orgnew->id;
					$orgnewarrcount++;
				}
			}
			//在编人员合计
			$this->view->organizercountall   = $organizercountall;
			//卫生技术人员合计
			$this->view->typeofworkcountall  = $typeofworkcountall;
			//其他技术人员合计
			$this->view->typeofworkcountall2 = $typeofworkcountall2;
			//管理人员合计
			$this->view->typeofworkcountall3 = $typeofworkcountall3;
			//工勤技能人员合计
			$this->view->typeofworkcountall4 = $typeofworkcountall4;
			//职业医师合计
			$this->view->physiciancountallzy = $physiciancountallzy;//中医
			$this->view->physiciancountallqt = $physiciancountallqt;//其他
			//执业助理医师合计
			$this->view->physiciancountallzyzy = $physiciancountallzyzy;//中医
			$this->view->physiciancountallzyqt = $physiciancountallzyqt;//其他
			//注册护士合计
			$this->view->protectcountall   = $protectcountall;
			//西药师
			$this->view->fdoctorcountall   = $fdoctorcountall;
			//中药师
			$this->view->zdoctorcountall   = $zdoctorcountall;
			//检验技师(士)
			$this->view->checkcountall     = $checkcountall;
			//影像技师(士)
			$this->view->photocountall     = $photocountall;
			//退休人员
			$this->view->mobilitycountall  = $mobilitycountall;
			//年内退休人员
			$this->view->mobilitydatecountall  = $mobilitydatecountall;
			$this->view->orgnewarr        = $orgnewarr;
			// 	     }
		}else{
			//当前机构的信息
			$organizercountlone   = 0;
			$typeofworkcountlone  = 0;
			$typeofworkcount2lone = 0;
			$typeofworkcount3lone = 0;
			$typeofworkcount4lone = 0;
			$physiciancountzylone = 0;
			$physiciancountqtlone = 0;
			$physiciancountzyzylone = 0;
			$physiciancountzyqtlone = 0;
			$protectcountlone = 0;
			$fdoctorcountlone = 0;
			$zdoctorcountlone = 0;
			$checkcountlone   = 0;
			$photocountlone   = 0;
			$mobilitycountlone = 0;
			$mobilitydatecountlone = 0;
			$staffcore    = new Tstaff_core();
			$staffarchive = new Tstaff_archive();
			$staffcore->joinAdd('inner',$staffcore,$staffarchive,'id','user_id');
			$staffcore->whereAdd("org_id='$currentId'");
			$staffcore->find();
			while($staffcore->fetch()){
				if($staffarchive->organizer=="1"){
					$organizercountlone = $organizercountlone+1;
				}
				//卫生技术人员
				if($staffarchive->type_of_work=="1"){
					$typeofworkcountlone = $typeofworkcountlone+1;
				}
				//其他技术人员
				if($staffarchive->type_of_work=="2"){
					$typeofworkcount2lone = $typeofworkcount2lone+1;
				}
				//管理人员
				if($staffarchive->type_of_work=="3"){
					$typeofworkcount3lone = $typeofworkcount3lone+1;
				}
				//工勤技能人员
				if($staffarchive->type_of_work=="4"){
					$typeofworkcount4lone = $typeofworkcount4lone+1;
				}
				//执业医师
				if($staffarchive->specialty_code=="11"){
					if($staffarchive->physician_certified_type=="4"){
						//中医
						$physiciancountzylone = $physiciancountzylone+1;
					}else{
						//其他
						$physiciancountqtlone = $physiciancountqtlone+1;
					}
				}
				//执业助理医师
				if($staffarchive->specialty_code=="12"){
					if($staffarchive->physician_certified_type=="4"){
						//中医
						$physiciancountzyzylone = $physiciancountzyzylone+1;
					}else{
						//其他
						$physiciancountzyqtlone = $physiciancountzyqtlone+1;
					}
				}
				//注册护士
				if($staffarchive->specialty_code=="21"){
					$protectcountlone = $protectcountlone+1;
				}
				//西药师
				if($staffarchive->specialty_code=="31"){
					$fdoctorcountlone = $fdoctorcountlone+1;
				}
				//中药师
				if($staffarchive->specialty_code=="32"){
					$zdoctorcountlone = $zdoctorcountlone+1;
				}
				//检验技师(士)
				if($staffarchive->specialty_code=="41"){
					$checkcountlone = $checkcountlone+1;
				}
				//影像技师(士)
				if($staffarchive->specialty_code=="42"){
					$photocountlone = $photocountlone+1;
				}
				//退休人员
				if($staffarchive->mobility=="24"){
					$mobilitycountlone = $mobilitycountlone +1;
				}
				//年内退休人员
				if($staffarchive->mobility_date==""){
					$mobilitydatecountlone = $mobilitydatecountlone + 0;
				}else{
					//判断是不是在当年内
					$nowtime = date('Y',time());
					$oldtime = date('Y',$staffarchive->mobility_date);
					if($nowtime==$oldtime){
						$mobilitydatecountlone = $mobilitydatecountlone+1;
					}else{
						$mobilitydatecountlone = $mobilitydatecountlone + 0;
					}
				}
			}
			$this->view->organizercountlone    = $organizercountlone;
			$this->view->typeofworkcountlone   = $typeofworkcountlone;
			$this->view->typeofworkcount2lone  = $typeofworkcount2lone;
			$this->view->typeofworkcount3lone  = $typeofworkcount3lone;
			$this->view->typeofworkcount4lone  = $typeofworkcount4lone;
			$this->view->physiciancountzylone  = $physiciancountzylone;
			$this->view->physiciancountqtlone  = $physiciancountqtlone;
			$this->view->physiciancountzyzylone  = $physiciancountzyzylone;
			$this->view->physiciancountzyqtlone  = $physiciancountzyqtlone;
			$this->view->protectcountlone        = $protectcountlone;
			$this->view->fdoctorcountlone        = $fdoctorcountlone;
			$this->view->zdoctorcountlone        = $zdoctorcountlone;
			$this->view->checkcountlone          = $checkcountlone;
			$this->view->photocountlone          = $photocountlone;
			$this->view->mobilitycountlone       = $mobilitycountlone;
			$this->view->mobilitydatecountlone   = $mobilitydatecountlone;
		}
		$this->view->orgnewid  = $orgid;
		$this->view->display('orguser.html',$orgid);
	}
}
?>
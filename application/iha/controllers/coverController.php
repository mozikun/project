<?php

/**
 * @author：
 * @filename: coverController.php
 * @package：用于完成个人档案首页的建立
 * @email：
 * @create：
 */
class iha_coverController extends controller {

    private $mask_char = '******';

    /**
     * 等同于构造函数
     */
    public function init() {
        //error_reporting(0);
        $this->haveWritePrivilege = '';
        require_once(__SITEROOT . 'library/privilege.php');
        require_once __SITEROOT . "library/Models/individual_archive.php";
        require_once __SITEROOT . "library/Models/individual_core.php";
        require_once __SITEROOT . "library/Models/individual_status.php";
        require_once __SITEROOT . "library/Models/family_archive.php";
        require_once __SITEROOT . "library/Models/organization.php";
        require_once __SITEROOT . "library/Models/staff_core.php";
        require_once __SITEROOT . "library/Models/region.php";
        require_once __SITEROOT . "library/Models/logs.php";
        require_once __SITEROOT . 'library/MyAuth.php';
        require_once __SITEROOT . 'library/pinyin/pinyin.php';
        $this->view->assign("basePath", __BASEPATH);
        /* 		$this->auth=Zend_Auth::getInstance();
          $this->identity = $this->auth->getIdentity();
          //var_dump($this->identity);
          //echo $this->identity['org_id'];
          if (!$this->auth->hasIdentity())
          {
          $this->redirect(__BASEPATH."loging/index/index");
          } */
        //print_r($this->identity);
    }

    public function ws_iha_coverAction() {
        require_once(__SITEROOT . "application/api/models/api_phs_iha_cover.php");
    }

    public function test_wsAction() {
        $client = new SoapClient("http://localhost:9004/wsdl/api_phs_iha_cover.wsdl");
        var_dump($client->__getFunctions());
        //var_dump($client);
        echo $client->ws_insert('luowei');
    }

    public function logListAction() {
    	require_once (__SITEROOT."/library/custom/pager.php");
    	//获取表名
    	$log_table=new Tlogs();
    	$log_table->selectAdd("distinct table_name");
    	$log_table->orderby("table_name ASC");
    	$log_table->find();
    	$arr=array();
    	$i=0;
    	while ($log_table->fetch()){
    		$arr[$i]['table_name']=$log_table->table_name;
    		$i++;
    	}
    	$this->view->arr=$arr;
    	//获取机构名称
    	$org_name=new Torganization();
    	$org_name->orderby("zh_name ASC");
    	$org_name->find();
    	$orgArray=array();
    	$n=0;
    	while ($org_name->fetch()){
    		$orgArray[$n]['id']=$org_name->id;
    		$orgArray[$n]['zh_name']=$org_name->zh_name;
    		$n++;
    	}
    	$this->view->org_name=$orgArray;
        //error_reporting(0);
        $search['start_time']=$this->_request->getParam('start_time');
        $search['end_time']=$this->_request->getParam('end_time');
        $search['action']=$this->_request->getParam('action');
        $search['table_name']=$this->_request->getParam('table_name');
        $search['org']=$this->_request->getParam('org');
        $search['staff_id']=$this->_request->getParam('staff_id');
        $log = new Tlogs();
        $staff = new Tstaff_core();
        $org = new Torganization();
        if(!empty($search['start_time']))
        {
        	$start_time=strtotime($search['start_time']);
        	$log->whereAdd("update_time>='$start_time'");
        }
        if(!empty($search['end_time']))
        {
        	$end_time=strtotime($search['end_time']);
        	$log->whereAdd("update_time<='$end_time'");
        }
        if(!empty($search['action']))
        {
        	$action=$search['action'];
        	$log->whereAdd("action='$action'");
        }
        if(!empty($search['table_name']))
        {
        	$table_name=$search['table_name'];
        	$log->whereAdd("table_name='$table_name'");
        }
        if(!empty($search['org']))
        {
        	$org_id=$search['org'];
        	$log->whereAdd("organization.id=$org_id");
        } 
        if(!empty($search['staff_id']))
        {
        	$staff_id=$search['staff_id'];
        	$log->whereAdd("logs.staff_id='$staff_id'");
        }
        $log->joinAdd('left', $log, $staff, 'staff_id', 'id');
        $log->joinAdd('left', $staff, $org, 'org_id', 'id');
        $log->orderby("update_time desc");
        $nuNumber=$log->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'iha/cover/logList/page/',3,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
        $log->limit($startnum,__ROWSOFPAGE);				
//        $log->limit(0, 100);
//        $log->debugLevel(9);
        $log->find();
        $logArray = array();
        $counter = 0;
        $actionArray = array("update" => "更新", "insert" => "新增", "delete" => "删除");
        while ($log->fetch()) {

            $logArray[$counter]['update_time'] = date("Y-m-d H:i:s", $log->update_time);
            $logArray[$counter]['action'] = $actionArray[$log->action];
            $logArray[$counter]['table_name'] = $log->table_name;
            $logArray[$counter]['column_name'] = $log->column_name;
            $logArray[$counter]['org_description'] = $org->zh_name;
            $logArray[$counter]['name_login'] = $staff->name_login;
            $logArray[$counter]['new_value'] = $log->new_value;
            $logArray[$counter]['old_value'] = $log->old_value;
            $logArray[$counter]['new_value_abstract'] = mb_substr($log->new_value, 0, 10);
            $logArray[$counter]['old_value_abstract'] = mb_substr($log->old_value, 0, 10);
            $counter++;
        }
        $this->view->row = $logArray;
        $pager = $links->subPageCss2();
		$this->view->pager = $pager;
        $this->view->action=$search['action'];
        $this->view->table_name=$search['table_name'];
        $this->view->org=$search['org'];
        $this->view->staff_id=$search['staff_id'];
        //$this->view->display('log.html');
        $this->view->display("log.html");
    }
    //通过机构id获取医生
    public function getStaffAction()
    {
    	$org_id=$this->_request->getParam('org_id');
    	$staff_id=$this->_request->getParam('staff_id');
    	$str="<option value=''>请选择</option>";
    	if($org_id){
    		$staff_core=new Tstaff_core();
    		$staff_core->whereAdd("org_id='$org_id'");
    		$staff_core->orderby("name_login ASC");
    		$staff_core->find();
    		$arr=array();
    		$count=0;
    		while($staff_core->fetch())
    		{
    			$arr[$count]['id']=$staff_core->id;
    			$arr[$count]['name_login']=$staff_core->name_login;
    			
    			$count++;
    		}    		
    		foreach ($arr as $k=>$v)
    		{
    			if($v['id']==$staff_id)
    			{
    				$string="selected='selected'";
    			}
    			else 
    			{
    				$string='';
    			}
//    			$str.="<option value='".$v['id']."'>".$v['name_login']."</option>";
    			$str.="<option value='".$v['id']."'". $string. ">".$v['name_login']."</option>";
    		}
    	}
    	echo $str;
    }

    public function checkDoubleAction() {
        //查重。判断标准　姓名，身份证,如果一致，则提示档案重
        $name = $this->_request->getParam('name');
        $identity_number = trim($this->_request->getParam('identity_number'));
        $identity_number = trim($identity_number);

        $action = $this->_request->getParam('action');
        $uuid = $this->_request->getParam('uuid');
        $individual = new Tindividual_core();
        //2012-04-09 我好笨添加
        if ($action == 'edit') {
            $individual->whereAdd("uuid!='$uuid'");
        }
        //$individual->whereAdd("name='$name'");
        //仅对身份证是否重复进行判断 2010-12-2 全体通过此方案
        $individual->whereAdd("identity_number='$identity_number'");
        //$individual->debugLevel(9);
        $number = $individual->count('*');
        if ($action == 'add' and $number > 0) {
            echo "double";
            exit();
        }
        //这个检测有问题，当编辑时，第一次未保存时的检测，重复号都只有1.
        if ($action == 'edit' and $number >= 1) {
            echo "double";
            exit();
        }
        echo "ok";
        exit();
    }

    public function addsaveAction() {
        /* 		echo $this->_request->getParam('name');
          echo $this->_request->getParam('address');
          echo $this->_request->getParam('residence_address');
          echo $this->_request->getParam('phone_number');
          echo $this->_request->getParam('staff_id');
          echo $this->_request->getParam('org_id');
          echo $this->_request->getParam('region_id_1');
          echo $this->_request->getParam('region_id_2');
          echo $this->_request->getParam('region_id_3');
          echo $this->_request->getParam('region_id_4');
          echo $this->_request->getParam('relation_of_householder');
          echo $this->_request->getParam('family_number');
          echo $this->_request->getParam('response_doctor');
          echo $this->_request->getParam('updated'); */
        require_once(__SITEROOT . 'library/custom/region_array.php');
        //如果传了待删除家庭档案号上来，则先删除家庭
        //如果是新增
        $action = $this->_request->getParam('action');
        if ($action == 'add') {
            //产生新的个人档案号
            $uuid = uniqid('i_', true);
        }
        if ($action == 'edit') {
            $uuid = $this->_request->getParam('uuid');
        }

        $name = $this->_request->getParam('name');
        //$name=trim($name);//框架里已处理了前后空格了

        $namePinyin = @getPinyin($name);
        //身份证号
        $identity_number = $this->_request->getParam('identity_number');
        $identity_number = trim($identity_number);

        //检测身份证重号
        //查重。判断标准　姓名，身份证,如果一致，则提示档案重
        $individual_identity = new Tindividual_core();
        //2012-04-09 我好笨添加
        if ($action == 'edit') {
            $individual_identity->whereAdd("uuid!='$uuid'");
        }
        //$individual->whereAdd("name='$name'");
        //仅对身份证是否重复进行判断 2010-12-2 全体通过此方案
        $individual_identity->whereAdd("identity_number='$identity_number'");
        //$individual->debugLevel(9);
        $number = $individual_identity->count('*');
        if ($action == 'add' and $number > 0) {
            echo "double";
            exit();
        }
        if ($action == 'edit' and $number > 1) {
            echo "double";
            exit();
        }
        $individual_identity->free_statement();

        $data_of_birth = strlen($identity_number) == 18 ? substr($identity_number, 6, 8) : '19' . substr($identity_number, 6, 6);
        //下一个阶段在这里加上对身份证的有效性的验证
        $data_of_birth = strtotime($data_of_birth);
        //$uuid=$this->_request->getParam('identity_number');
        //获取家庭档案及二个内部流水号,如果是新增，后面的代码会重新处理这几个数据
        $individualInnerId = $this->_request->getParam('individual_inner_id');
        //补零
        $individualInnerId = str_repeat('0', 2 - strlen($individualInnerId)) . $individualInnerId;
        $family_number = $this->_request->getParam('family_number');
        $familyInnerId = $this->_request->getParam('family_inner_id');
        //补零
        $familyInnerId = str_repeat('0', 4 - strlen($familyInnerId)) . $familyInnerId;

        $family_number_old = $this->_request->getParam('family_number_old');
        $familyInnerId_old = $this->_request->getParam('family_inner_id_old');
        //档案状态
       // $status_flag = $this->_request->getParam('status_flag');
        $status_array = rtrim($this->_request->getParam('status_array'),'|');//档案状态
        $status_array_time = rtrim($this->_request->getParam('status_array_time'),'|');//档案时间
        //档案备注
        $mark = $this->_request->getParam('mark_array');
        $mark_array = rtrim($this->_request->getParam('mark_array'),'|');
        $mark_array_php = explode('|',$mark_array);//档案备注数组
        $status_array_php =  explode('|',$status_array);//档案状态数组
        $status_array_time_php = explode('|',$status_array_time);//档案时间数组
        $address = $this->_request->getParam('address');
        $residence_address = $this->_request->getParam('residence_address');
        $phone_number = $this->_request->getParam('phone_number');
        $staff_id = $this->_request->getParam('staff_id');
        $org_id = $this->_request->getParam('org_id');
        $new_org_id = $this->_request->getParam('new_org_id');
        //自定义编号
        $standard_code = $this->_request->getParam('standard_code');

        //$regionPath=$region_id_1.','.$region_id_2.','.$region_id_3.','.$region_id_4;
        //$regionPath=$regionInfo[$region_id_1]['2'].",".$regionInfo[$region_id_2]['2'].",".$regionInfo[$region_id_3]['2'].",".$regionInfo[$region_id_4]['2'];
        //仅根据最低一级的行政区域获取该居民所在行政区域的path 用于省标
        //$regionPath=$regionInfo[$region_id_4]['2'];
        //$regionPath1=$regionInfo[$region_id_3]['2'];
        //region_last_id 地区的编码 就是region_path里的最后一位
        $region_last_id = $this->_request->getParam('region_last_id', '');
        $region_last_id_old = $this->_request->getParam('region_last_id_old', '');
        if ($region_last_id != $region_last_id_old) {
            $change_region = true;
        } else {
            $change_region = false;
        }
        $regionPath = $regionInfo[$region_last_id]['2'];
        $temp = explode(',', $regionPath);

        //获取从县级到街道，居委会，小区的编码
        $region_id_1 = $temp[4];
        $region_id_2 = $temp[5];
        $region_id_3 = $temp[6];
        $region_id_4 = $temp[7];
        //$regionPath1是用于生成国标档案号的
        $regionPath1 = $regionInfo[$region_id_3]['2'];
        $relation_of_householder = $this->_request->getParam('relation_of_householder');
        $relation_of_householder_old = $this->_request->getParam('relation_of_householder_old');
        //$family_number=$this->_request->getParam('family_number');
        $response_doctor = $this->_request->getParam('response_doctor');
        $archive_doctor = $this->_request->getParam('archive_doctor');
        $new_response_doctor = $this->_request->getParam('new_response_doctor');
        $new_archive_doctor = $this->_request->getParam('new_archive_doctor');
        //建档时间
        $filing_time = $this->_request->getParam('updated');
        //$individualInnerId=$this->_request->getParam('individual_inner_id');
        //echo $this->_request->getParam('family_inner_id');
        //$familyInnerId=$this->_request->getParam('family_inner_id');
        //如果是新增户主，则获取家庭档案号流水号 这里进一步考虑如果生成家庭档案号，是按小区为范围还是按机构所在地为范围还是按街道为范围
        //如果没有家庭档案号，则也重新生成。可能的原因就在于把一个户主改成了非户主，又改回来的情况
        //户主改成了非户主，又改回来，要生成新的家庭档案号，无法保留原来的档案号
        //黄艳丽  10:50:17 确认
        /* 		新增加时　family_number='' family_number_old='';
          选户主时  family_number='' family_number_old='';
          保存时　family_number＝family_number_old='000y' 同时增加家庭档案记录

          选其它关系时  family_number='000x' family_number_old='';
          保存时　family_number＝family_number_old='000x';

          将户主修改为非户主时
          保存时　family_number！＝family_number_old

          保存时　删除原来的家庭档案，设置新的家庭档案
         */   
        //如果关系是非户主，并且$family_number_old!='';说明此人已被设置为非户主，删除其家庭档案数据

/*        if ($relation_of_householder_old == '1' and $family_number != $family_number_old and $family_number_old != '') {
            $family = new Tfamily_archive();
            $family->whereAdd("family_number='$family_number_old'");
            $family->delete($this->user['uuid']);
        }*/
		if($relation_of_householder_old=='1' and $family_number!=$family_number_old and $family_number_old!=''){
			$family=new Tfamily_archive();
			$family->whereAdd("family_number='$family_number_old'");
			$family->delete($this->user['uuid']);
			//file_put_contents('aaaa.txt','akg48_change'.'|'.microtime(true).'|'.$relation_of_householder_old.'|'.$family_number.'|'.$family_number_old);
		}else{
			//file_put_contents('aaaa.txt','akg48_nochange'.'|'.microtime(true).'|'.$relation_of_householder_old.'|'.$family_number.'|'.$family_number_old);
		}        
        
        $change_family_inner_id = false;
        if ($family_number != $family_number_old and $family_number_old != '') {
            //当发生家庭关系变化时，要重新生成其在家庭内的顺序号
            $change_family_inner_id = true;
        }
        //户主，且新增或是没有家庭档案号或是改变了区域，都重新生成家庭档案流水号
        if ($relation_of_householder == '1' and ($action == 'add' or $family_number == '')) {
            $family = new Tfamily_archive();
            $family->selectAdd('max(inner_id) as inner_id');
            //按省标，是到最后一级区域的流水号
            $family->whereAdd("region_path='$regionPath'");
            //$family->orderby('inner_id desc');
            //$family->limit(0,1);
            $family->find(true);
            $familyInnerId = $family->inner_id + 1;
            /* 			echo "---";
              echo $family->inner_id;
              echo "---";
              echo $familyInnerId; */
            //echo strlen($newInnerId);
            $familyInnerId = str_repeat('0', 4 - strlen($familyInnerId)) . $familyInnerId;
            //$newInnerId=
            //echo '$newInnerId'.$newInnerId;
            //保存数据 家庭档案数据
            $family = new Tfamily_archive();
            $family_number = $family->family_number = $family->uuid = uniqid('f_', true);
            $family->inner_id = $familyInnerId;
            $family->org_id = $org_id;
            $family->inner_id = $familyInnerId;
            $family->householder_id = $uuid;
            $family->householder_name = $name;
            $family->region_path = $regionPath;
            $family->staff_id = $archive_doctor;
            $family->created = time();
            //$family->updated=$updated;
            $family->updated = time();
            //$family->debugLevel(9);
            $family->insert($this->user['uuid']);
        }
        //改变了区域，重新生成家庭档案流水号
        if ($relation_of_householder == '1' and $action == 'edit' and $change_region and $family_number != '') {
            $family = new Tfamily_archive();
            $family->selectAdd('max(inner_id) as inner_id');
            $family->whereAdd("region_path='$regionPath'");
            //$family->orderby('inner_id desc');
            //$family->limit(0,1);
            $family->find(true);
            $familyInnerId = $family->inner_id + 1;
            /* 			echo "---";
              echo $family->inner_id;
              echo "---";
              echo $familyInnerId; */
            //echo strlen($newInnerId);
            $familyInnerId = str_repeat('0', 4 - strlen($familyInnerId)) . $familyInnerId;
            //$newInnerId=
            //echo '$newInnerId'.$newInnerId;
            //保存数据 家庭档案数据
            $family = new Tfamily_archive();
            $family->inner_id = $familyInnerId;
            $family->region_path = $regionPath;
            $family->whereAdd("family_number='$family_number'");
            $family->update(array($this->user['uuid'], 'updated'));
            $individualInnerId = '01';
        }


        //修改家庭档案中户主姓名，此数据冗余，主要原因是在查询家庭档案的时候，就不去联查个人档案了。
        if ($relation_of_householder == '1' and $action == 'edit') {

            $family = new Tfamily_archive();
            $family->whereAdd("family_number='$family_number'");
            $family->householder_name = $name;

            $family->updated = time();
            //$family->debugLevel(9);
            $family->update(array($this->user['uuid'], 'updated'));
        }
        //如果是非户主，先测试当前的户主是否存在，因为可能存在户主在这一瞬间被删除的情况
        //获取人个档案号流水号 户主
        if ($relation_of_householder == '1' and $action == 'add') {
            $individualInnerId = '01';
        }
        //获取人个档案号流水号 非户主
        if (($relation_of_householder != '1' and $action == 'add') or $change_family_inner_id) {
            $individual = new Tindividual_core();
            $individual->whereAdd("family_number='$family_number'");
            $individual->orderby('inner_id desc');
            $individual->limit(0, 1);
            //$individual->debugLevel(9);
            $individual->find(true);
            //echo $individual->inner_id."|";
            $individualInnerId = $individual->inner_id + 1;
            //echo $individualInnerId."|";
            $individualInnerId = str_repeat('0', 2 - strlen($individualInnerId)) . $individualInnerId;
        }
        //获取国标档案编码流水号
        $region_path_inner_id = $this->_request->getParam('region_path_inner_id', '');
        if ($action == 'add' or $change_region) {
            $individual = new Tindividual_core();
            $individual->selectAdd('max(region_path_inner_id) as region_path_inner_id');
            //注意这是里是$regionPath1
            $individual->whereAdd("region_path like '$regionPath1%'");
            //$individual->debugLevel(9);
            $individual->find(true);
            //echo $individual->region_path_inner_id;
            if ($individual->region_path_inner_id != '') {
                $region_path_inner_id = $individual->region_path_inner_id + 1;
            } else {
                $region_path_inner_id = 1;
            }
            $region_path_inner_id = str_repeat('0', 5 - strlen($region_path_inner_id)) . $region_path_inner_id;
        }

        //国标档案号
        //$std1=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.$regionInfo[$region_id_3]['1'].'-'.$regionInfo[$region_id_4]['1'].'-'.$familyInnerId.'-'.$individualInnerId;
        //$tempId=intval($familyInnerId)+intval($individualInnerId);
        //$tempId=str_repeat('0',5-strlen($tempId)).$tempId;
        //if($action=='add'){ //如果不允许修改地区，则打开此项
        //echo $regionInfo[$region_id_1]['1'];
        if (1) {
            //国标档案号 2011－1－27号出现的档案号重的问题就出在这里

            $std1 = $regionInfo[$region_id_1]['1'] . '-' . $regionInfo[$region_id_2]['1'] . '-' . substr($regionInfo[$region_id_3]['1'], 0, 3) . '-' . $region_path_inner_id;
            //省标档案号
            $std2 = $regionInfo[$region_id_1]['1'] . '-' . $regionInfo[$region_id_2]['1'] . '-' . $regionInfo[$region_id_3]['1'] . '-' . $regionInfo[$region_id_4]['1'] . '-' . $familyInnerId . '-' . $individualInnerId; //这个不是与户主的关系，而是家庭内部顺序号
        }


        //插入个人档案数据
		$insert_array=array();//插入第三方数据库（银海，暂为172.16.11.249）参数，参数格式array('field=value'..)
        $individual = new Tindividual_core();
        $individual->uuid = $uuid;
        $insert_array[]="uuid='$uuid'";
        $individual->inner_id = $individualInnerId;
        $individual->region_path = $regionPath;
        $individual->census=$this->_request->getParam('census');
        $individual->name = $name;
        $insert_array[]="name='$name'";
        $individual->name_pinyin = $namePinyin;
        $individual->identity_number = $identity_number;
        $insert_array[]="identity_number='$identity_number'";
        $individual->date_of_birth = $data_of_birth;
        $insert_array[]="date_of_birth=$data_of_birth";
        if ($this->_request->getParam('confirm_change_org') == '1') {
            $individual->org_id = $new_org_id;
            $insert_array[]="org_id='$new_org_id'";
            $individual->staff_id = $new_archive_doctor;
            $insert_array[]="staff_id='$new_archive_doctor'";
            $individual->response_doctor = $new_response_doctor;
            $insert_array[]="response_doctor='$new_response_doctor'";
        } else {
            $individual->org_id = $org_id;
            $insert_array[]="org_id='$org_id'";
            $individual->staff_id = $archive_doctor;
            $insert_array[]="staff_id='$archive_doctor'";
            $individual->response_doctor = $response_doctor;
            $insert_array[]="response_doctor='$response_doctor'";
        }
        $individual->address = $address;
        $insert_array[]="address='$address'";
        $individual->residence_address = $residence_address;
        $insert_array[]="residence_address='$residence_address'";
        $individual->family_number = $family_number;
        $individual->family_inner_id = $familyInnerId;
        $individual->region_path_inner_id = $region_path_inner_id;
        $individual->relation_holder = $relation_of_householder;
        //处理档案的状态
        if ($action == 'add')
        {
        	//判断在同一天是否有档案状态出现
        	$now_time = date("Y-m-d",time());
        	$status_array_count = count($status_array_php);
        	$max_xb = $status_array_count-1;
        	$max_time = $status_array_time_php[$max_xb];//最近的一次时间
        	$year = ((int)substr($max_time,0,4));//取得年份
            $month = ((int)substr($max_time,5,2));//取得月份
            $day = ((int)substr($max_time,8,2));//取得几号
            $number_time = mktime(0,0,0,$month,$day,$year);//取得时间戳
    		$individual->status_flag = $status_array_php[$max_xb];
    		$result_array = array_count_values($status_array_time_php);//取得有多少同样的值
    		if($result_array[$now_time]>1)
    		{
    			$myerror = true;	
    		}
    		else 
    		{
    			$myerror = false;
	    		//当同一天内如果没有档案存在对其进行添加
	    		foreach ($status_array_php as $k=>$v)
		        {	
		        	$individual_status_add = new Tindividual_status();	
		        	$individual_status_add->uuid = uniqid('sta_',true);
		        	if ($this->_request->getParam('confirm_change_org') == '1') 
		        	{
		    			$individual_status_add->staff_id = $new_archive_doctor;
		        	}
		    		else 
		    		{
		    			$individual_status_add->staff_id = $archive_doctor;
		    		}
		    		$individual_status_add->created = mktime(0,0,0,date("m",time()),date("d",time()),date("Y",time()));
		    		$individual_status_add->updated = mktime(0,0,0,date("m",time()),date("d",time()),date("Y",time()));
		    		//档案状态时间
		    		$year_status = ((int)substr($status_array_time_php[$k],0,4));//取得年份
	                $month_status = ((int)substr($status_array_time_php[$k],5,2));//取得月份
	                $day_status = ((int)substr($status_array_time_php[$k],8,2));//取得几号
	                $number_time_status = mktime(0,0,0,$month_status,$day_status,$year_status);//取得时间戳
		    		$individual_status_add->status_time = $number_time_status;
		    		$individual_status_add->status_flag = $v;
		    		$individual_status_add->mark = $mark_array_php[$k];
		    		$individual_status_add->id = $uuid;
		    		$individual_status_add->insert();
		        }
    		}
        }
        if($action=='edit')
        {
        	$created_time = $this->_request->getParam('created_time');//因为要执行先删除再添加完成编辑操作为了把前边的创建时间保留下来，由页面将以前的创建时间保留住
        	$created_array_time = rtrim($created_time,'|');//档案创建时间
            $created_array_time_php =  explode('|',$created_array_time);//档案创建时间数组
        	$status_array_count = count($status_array_php);//档案状态的数量
        	$created_array_time_php_count = count($created_array_time_php);//档案创建时间修改的数量
        	$max_xb = $status_array_count-1;
        	$max_time = $status_array_time_php[$max_xb];//最近的一次时间
        	$year = ((int)substr($max_time,0,4));//取得年份
            $month = ((int)substr($max_time,5,2));//取得月份
            $day = ((int)substr($max_time,8,2));//取得几号
            $number_time = mktime(0,0,0,$month,$day,$year);//取得时间戳
            //个人档案的状态
            $individual->status_flag = $status_array_php[$max_xb];
//            echo $max_xb.'========================'.$status_array_php[$max_xb];
//            exit();
            //先删除再添加(编辑时)
            $del_status = new Tindividual_status();
            $del_status->whereAdd("id='$uuid'");
            $del_status->delete();
            //添加数据
            foreach ($created_array_time_php as $k=>$v)
	        {
		        	$individual_status_add = new Tindividual_status();	
		        	$individual_status_add->uuid = uniqid('sta_',true);
		        	if ($this->_request->getParam('confirm_change_org') == '1') 
		        	{
		    			$individual_status_add->staff_id = $new_archive_doctor;
		        	}
		    		else 
		    		{
		    			$individual_status_add->staff_id = $archive_doctor;
		    		}
		    		$individual_status_add->updated = mktime(0,0,0,date("m",time()),date("d",time()),date("Y",time()));
		    		$individual_status_add->created = $v?$v:mktime(0,0,0,date("m",time()),date("d",time()),date("Y",time()));
		    		//档案状态时间
		    		$year_status = ((int)substr($status_array_time_php[$k],0,4));//取得年份
                    $month_status = ((int)substr($status_array_time_php[$k],5,2));//取得月份
                    $day_status = ((int)substr($status_array_time_php[$k],8,2));//取得几号
                    $number_time_status = mktime(0,0,0,$month_status,$day_status,$year_status);//取得时间戳
		    		$individual_status_add->status_time = $number_time_status;
		    		$individual_status_add->status_flag = $status_array_php[$k];
		    		$individual_status_add->mark = $mark_array_php[$k];
		    		$individual_status_add->id = $uuid;
		    		$individual_status_add->insert();
	        }
	        //当有删除要重新添加的数据
	        if($max_xb>=$created_array_time_php_count)//有了新的数据的时候
	        {
		        for($i=$created_array_time_php_count;$i<=$max_xb;$i++)
		        {
		        	$individual_status_another = new Tindividual_status();	
		        	$individual_status_another->uuid = uniqid('sta_',true);
		        	if ($this->_request->getParam('confirm_change_org') == '1') 
		        	{
		    			$individual_status_another->staff_id = $new_archive_doctor;
		        	}
		    		else 
		    		{
		    			$individual_status_another->staff_id = $archive_doctor;
		    		}
		    		$individual_status_another->updated = mktime(0,0,0,date("m",time()),date("d",time()),date("Y",time()));
		    		$individual_status_another->created = mktime(0,0,0,date("m",time()),date("d",time()),date("Y",time()));;
		    		//档案状态时间
		    		$year_status = ((int)substr($status_array_time_php[$i],0,4));//取得年份
                    $month_status = ((int)substr($status_array_time_php[$i],5,2));//取得月份
                    $day_status = ((int)substr($status_array_time_php[$i],8,2));//取得几号
                    $number_time_status = mktime(0,0,0,$month_status,$day_status,$year_status);//取得时间戳
		    		$individual_status_another->status_time = $number_time_status;
		    		$individual_status_another->status_flag = $status_array_php[$i];
		    		$individual_status_another->mark = $mark_array_php[$k];
		    		$individual_status_another->id = $uuid;
		    		$individual_status_another->insert();
		        }
	        }
        }
        $individual->inner_id = $individualInnerId;
        //$individual->updated=$updated;
        //$individual->created=strtotime($updated);

        $individual->filing_time = strtotime($this->_request->getParam("updated"));
       	$insert_array[]="filing_time=".strtotime($this->_request->getParam("updated"));
        if ($action == 'add') {
            $individual->created = $individual->updated = time();
            $insert_array[]="created=".time();
            $insert_array[]="updated=".time();
        } else {
            $individual->updated = time();
            $insert_array[]="updated=".time();
        }

        $individual->phone_number = $phone_number;
        $insert_array[]="phone_number='$phone_number'";
        $individual->standard_code = $standard_code; //手工
        $insert_array[]="standard_code='$standard_code'";
        //if($action=='add'){
        if (1) {
            $individual->standard_code_1 = $std1; //国标
            $insert_array[]="standard_code_1='$std1'";
            $individual->standard_code_2 = $std2; //省标
            $insert_array[]="standard_code_2='$std2'";
        }
        //$individual->debugLevel(9);
        $errorMessage = '';
        if ($action == 'add') {
        	if($myerror)
        	{
        		$errorMessage = 'tt';
        	}
        	else 
        	{
	            if ($individual->insert($this->user['uuid'])) {
	                //同时给扩展表插入一条记录
	                //$individual_
	                //echo $individual->showSqlErrorMessage();
	                $errorMessage = 'ok';
	                $insert_array[]="sex='9'";
	                require_once(__SITEROOT . 'library/third_party.php');//
	                $third_sql= third_party('individual_core',$insert_array,1);//插入银海数据库
	                require_once __SITEROOT . "library/Models/t_jk_card.php";//银海健康卡
		            $t_jk_card=new Tt_jk_card(3);
		            $t_jk_card->query($third_sql);
	            } else {
	                $errorMessage = 'bad-1';
	            }
        	}
        }
        if ($action == 'edit') {
            $individual->whereAdd("uuid='$uuid'");
            //$individual->debug(2);
            if ($individual->update(array($this->user['uuid'], 'updated|uuid|name_pinyin'))) {
                $errorMessage = 'ok';
               require_once(__SITEROOT . 'library/third_party.php');
	           $third_sql = third_party('individual_core',$insert_array,2,$uuid);//更新银海数据库
	           require_once __SITEROOT . "library/Models/t_jk_card.php";//银海健康卡
	           $t_jk_card=new Tt_jk_card(3);
	           $t_jk_card->query($third_sql);
	           
            } else {
                $errorMessage = 'bad';
            }
        }
        //计算档案完整率
        require_once __SITEROOT . "/library/Models/standard_archive_rate.php";
        $region_path_array = @explode(",", $this->user['current_region_path'], 5);
        //取到市级path
        $region_path = $region_path_array['0'] . "," . $region_path_array['1'] . "," . $region_path_array['2'] . "," . $region_path_array['3'];
        //取所有表名
        $standard_archive_rate = new Tstandard_archive_rate();
        $standard_archive_rate->whereAdd("module_name = 'individual_core'"); //个人档案模块
        $standard_archive_rate->whereAdd("region_path='$region_path'");
        //$standard_archive_rate->whereAdd("criteria='1'");
        $standard_archive_rate->selectAdd("table_name as table_name");
        //$standard_archive_rate->debugLevel(5);
        $standard_archive_rate->groupBy("table_name");
        $standard_archive_rate->find();
        while ($standard_archive_rate->fetch()) {
            //排除自己
            if ($standard_archive_rate->table_name != "individual_core") {
                require_once __SITEROOT . "/library/Models/" . $standard_archive_rate->table_name . ".php";
                $temp = $standard_archive_rate->table_name;
                $t = "T$temp";
                $$temp = new $t;
                $$temp->whereAdd("id='$uuid'");
                $$temp->find(true);
            } else {
                require_once __SITEROOT . "/library/Models/" . $standard_archive_rate->table_name . ".php";
                $temp = $standard_archive_rate->table_name;
                $t = "T$temp";
                $$temp = new $t;
                $$temp->whereAdd("uuid='$uuid'");
                $$temp->find(true);
            }
        }

        $standard_archive_rate = new Tstandard_archive_rate();
        //取本模块的所有必填字段数组
        $standard_archive_rate->whereAdd("module_name = 'individual_core'"); //个人档案模块
        $standard_archive_rate->whereAdd("region_path='$region_path'");
        $standard_archive_rate->whereAdd("criteria='1'");
        $nums_rate = 0;
        $nums_rate = $standard_archive_rate->count(); //所有字段
        $standard_archive_rate->find();
        $nums_rate_true = 0; //已填写字段数
        while ($standard_archive_rate->fetch()) {
            $table_name = $standard_archive_rate->table_name;
            $column_name = $standard_archive_rate->column_name;
            if (@isset($$table_name->$column_name) && $$table_name->$column_name) {
                $nums_rate_true++;
            }
        }
        $rate = @round($nums_rate_true / $nums_rate, 4);
        $core = new Tindividual_core();
        $core->criteria_rate = $rate;
        $core->whereAdd("uuid='$uuid'");
        $core->updated = time();
        $core->update();
        //fopen(__BASEPATH."iha/index/setsession/uuid/".$uuid);
        //注意参数的顺序位置一定不能随便改
        echo $errorMessage . '|' . $uuid . '|' . $individualInnerId . '|' . $family_number . '|' . $familyInnerId . '|' . $region_path_inner_id . '|' . $std1 . '|' . $std2 . '|' . $regionPath;
    }

    public function addAction() 
    {
        
        //处理完整率特征字段样式
        $archive_rate_css='';
        if(file_exists(__SITEROOT . 'cache/standard_archive_rate_cache.php'))
        {
            require_once __SITEROOT . 'cache/standard_archive_rate_cache.php';
            $region_path_array = @explode(",", $this->user['current_region_path'], 5);
            //取到市级path
            @$region_path = $region_path_array['0'] . "," . $region_path_array['1'] . "," . $region_path_array['2'] . "," . $region_path_array['3'];
            $css_name='';
            if(isset($rate[$region_path]))
            {
               foreach($rate[$region_path] as $m=>$n)
                {
                    foreach($n as $k=>$v)
                    {
                        if($k=='individual_core')
                        {
                            $tmp_keys=array_keys($v);
                            $css_name.='.core_'.@implode(',.core_',$tmp_keys);
                        }
                        if($k=='individual_archive')
                        {
                            $tmp_keys=array_keys($v);
                            $css_name.='.archive_'.@implode(',.archive_',$tmp_keys);
                        }
                    }
                } 
            }
            if($css_name)
            {
                $archive_rate_css=$css_name.'{font-weight:bold;color:green;}';
            }
        }
        $this->view->archive_rate_css=$archive_rate_css;
        require_once __SITEROOT . 'library/custom/region_array.php';
        require_once __SITEROOT . '/library/custom/iha_comm.php';
        //require_once __SITEROOT.'library/custom/region_array.php';
        //$organizationSession=new Zend_Session_Namespace("organization_core");
        //var_dump($this->user);
        //$region_id=$this->user->org_id;
        //$standard_code=$organizationSession->region_standard_code;
        //$organization_zh_name=$organizationSession->zh_name;
        //$staff_id=$this->user['uuid'];
        $action = $this->_request->getParam("action");
        $this->view->action = $action;
        $this->view->sessionid = session_id();
        //取得当前时间
    	$current_time = date("Y-m-d",time());
    	$this->view->current_time = $current_time;
        if ($action == 'add') {  	
            //获取组织机构相关信息 以后换成下面的代码
            /* 			$org_id=$organizationSession->organization_id;
              $region_id=$organizationSession->region_id;
              $region_standard_code=$organizationSession->region_standard_code;
              $organization_zh_name=$organizationSession->zh_name; */
            $org_id = $this->user['org_id'];
            $region_id = $this->user['region_id'];
            $region_standard_code = $regionInfo[$region_id]['1'];
            ;
            //echo $region_standard_code;
            $organization_zh_name = $this->user['org_zh_name'];
            $region_last_id_old = '';
            $this->view->new_org_switch = 'none';
        }
        if ($action == 'edit') {

            $uuid = $this->_request->getParam("uuid"); 
            //显示照片
            if (file_exists(__SITEROOT . "upload/" . $uuid . ".gif")) {
                $this->view->assign("headpic", __BASEPATH . "upload/" . $uuid . ".gif");
            } else {
                $this->view->assign("headpic", "");
            }
            //取得档案状态
            //echo $uuid;
            $individual = new Tindividual_core();
            //2012-05-18我好笨将第581行的内连接改为左连接，因为内连接影响当某个人家庭档案号不存在时，无法重新编辑其首页，重新选择家庭
            $family = new Tfamily_archive();
            $org = new Torganization();
            $individual->joinAdd('left', $individual, $family, 'family_number', 'family_number');
            $individual->joinAdd('inner', $individual, $org, 'org_id', 'id');
            //$family->selectAdd("family_number as family_number,householder_id as householder_id,family_number as family_number,inner_id as inner_id");
            $individual->whereAdd("individual_core.uuid='$uuid'");
            //$individual->debugLevel(9);
            $individual->find(true);
            //编辑时赋初值
            $this->view->census_index=$individual->census;
            //获取组织机构相关信息
            $org_id = $org->id;
            $region_path = $org->region_path;
            $temp = explode(',', $region_path);
            $region_id = $temp[count($temp) - 1];

            //echo $region_path;
            //echo '$region_id'.$region_id;
            //$temp=$individual->region_path;
            $temp = explode(',', $individual->region_path);
            $region_id = $temp[count($temp) - 1];
            $region_last_id_old = $region_id;
            
            $region_standard_code = $regionInfo[$region_id]['1'];

            //echo $region_standard_code;
            $organization_zh_name = $org->zh_name;
            //echo $org_id."|".$this->user['org_id'];
            if ($org_id == $this->user['org_id']) {
                $this->view->new_org_switch = 'none';
           } else {
                $this->view->new_org_switch = '';
                $this->view->new_org_id = $this->user['org_id'];
                $this->view->new_organization_zh_name = $this->user['org_zh_name'];
            }
        }
        //exit();


        //户籍类型
        require __SITEROOT.'/library/data_arr/arrdata.php';
        $this->view->census=$census;
        $this->view->org_id = $org_id;
        $this->view->region_id_1 = $region_id;
        $this->view->region_last_id_old = $region_last_id_old;
        $this->view->region_id_1_standard_code = $region_standard_code; //县级代码
        $this->view->organization_zh_name = $organization_zh_name;

        /* 		$org=new Torganization();
          $org->whereAdd("id='$org_id'");
          $org->find(true);
          $temp=explode("|",$org->region_path_domain);
         */
        $temp = explode("|", $this->user['current_region_path_domain']);
        $org_region_domain = '';
        foreach ($temp as $k1 => $v1) {
            $org_region_domain = $org_region_domain . "'" . $v1 . "',";
        }
        $org_region_domain = rtrim($org_region_domain, ",");
        $this->view->org_region_domain = $org_region_domain;

        //$relationOfHouseholderArray=array('0'=>'户主','1'=>'配偶','2'=>'子女','3'=>'孙子女','4'=>'父母','5'=>'祖父母','6'=>'兄弟姐妹','10'=>'其他','19'=>'待删除','20'=>'请选择');
        $relationOfHouseholderArray = array('-9' => array('-9', '请选择'),
            '1' => array('0', '户主'),
            '2' => array('1', '配偶'),
            '3' => array('2', '子女'),
            '4' => array('3', '孙子女'),
            '5' => array('4', '父母'),
            '6' => array('5', '祖父母'),
            '7' => array('6', '兄弟姐妹'),
            '8' => array('7', '其他'));
        $relation = array();
        $counter = 0;
        foreach ($relationOfHouseholderArray as $key => $value) {
            $relation[$counter]['key'] = $key;
            $relation[$counter]['value'] = $value['1'];
            if ($action == 'edit') {
                if ($individual->relation_holder == $key) {
                    $relation[$counter]['selected'] = 'selected';
                } else {
                    $relation[$counter]['selected'] = '';
                }
            }
            if ($action == 'add') {
                $relation[$counter]['selected'] = '';
            }
            $counter++;
        }
        //此数据应该来源于数据字典
        $status_flagArray = array(
            '-9' => array('0', '请选择'),
            '1' => array('1', '正常档案'),
            '4' => array('2', '临时档案'),
            '6' => array('3', '死亡档案'),
            '8' => array('4', '转出档案'));
        if($action=='edit')
        {
        	    //判断有无死亡档案 如果有不让其再删除
        	    $status_die = new Tindividual_status();
        	    $status_die->whereAdd("id='$uuid'");
        	    $status_die->whereAdd("status_flag='6'");
        	    if($status_die->count()>0)
        	    {
        	    	$this->view->die_status = 1;//有死亡状态
        	    	$this->view->disabled_status = 'disabled="disabled"';
        	    }
        	    else 
        	    {
        	    	$this->view->die_status = 0;//无死亡状态
        	    	$this->view->disabled_status = '';
        	    }
        	    //取得以往的所有档案状态信息
	            $individual_status =  new Tindividual_status();
	            $individual_status->whereAdd("id='$uuid'");
	            $individual_status->orderby("status_time ASC");
	            $individual_status->find();
	            $individual_status_array = array();
	            $status_count = 0;
	            while ($individual_status->fetch())
	            {
	            	$individual_status_array[$status_count]['status_edit'] = $individual_status->status_flag;//档案状态
	            	$individual_status_array[$status_count]['uuid']        = str_replace('.','',$individual_status->uuid);
	            	$individual_status_array[$status_count]['status_name'] = $status_flagArray[$individual_status->status_flag][1];//档案状态的中文描述
	            	$individual_status_array[$status_count]['status_time'] = date("Y-m-d",$individual_status->status_time);
	            	$individual_status_array[$status_count]['created'] = $individual_status->created;
	            	$individual_status_array[$status_count]['mark'] = $individual_status->mark;
	            	$status_count++;
	            }
	            $this->view->individual_status_array = $individual_status_array;
        }
        $status_flag = array();
        $x = 0;
        foreach ($status_flagArray as $key => $value) {
            $status_flag[$x]['key'] = $key;
            $status_flag[$x]['value'] = $value['1'];
            if ($action == 'edit') { 	
                if ($individual->status_flag == $key) {
                    $status_flag[$x]['selected'] = 'selected';
                } else {
                    $status_flag[$x]['selected'] = '';
                }
            }
            if ($action == 'add') {
                $status_flag[$x]['selected'] = '';
            }
            $x++;
        }
        $this->view->status_flag = $status_flag;
        $this->view->relation = $relation;



        if ($action == 'edit') {
            //获取path
            //$path=$individual->region_path;
            //这里数组索引的下标有很重大不稳定的问题，待修正 luowei 2010-7-23
            $pathArray = explode(',', $individual->region_path);
            $this->view->init_region_id_2 = $pathArray['5'];
            $this->view->init_region_id_3 = @$pathArray['6'];
            $this->view->init_region_id_4 = @$pathArray['7'];
        }

        //原建档医生
        //原责任医生
        $staff_core = new Tstaff_core();
        $staff_archive = new Tstaff_archive();
        $staff_core->joinAdd('inner', $staff_core, $staff_archive, 'id', 'user_id');
        //echo $organizationSession->org_id;
        $staff_core->whereAdd("org_id='{$org_id}'");
        $staff_core->find();
        $responseDoctorArray = array();
        $archiveDoctorArray = array();

        $responseDoctorArray[0]['zh_name'] = '请选择';
        $responseDoctorArray[0]['id'] = '-9';

        $archiveDoctorArray[0]['zh_name'] = '请选择';
        $archiveDoctorArray[0]['id'] = '-9';

        $counter = 1;
        while ($staff_core->fetch()) {
            //生成责任医生下拉框
            $responseDoctorArray[$counter]['zh_name'] = $staff_archive->name_real;
            $responseDoctorArray[$counter]['id'] = $staff_core->id;
            $archiveDoctorArray[$counter]['zh_name'] = $staff_archive->name_real;
            $archiveDoctorArray[$counter]['id'] = $staff_core->id;
            if ($action == 'edit') {
                if ($individual->response_doctor == $staff_core->id) {
                    $responseDoctorArray[$counter]['selected'] = 'selected';
                } else {
                    $responseDoctorArray[$counter]['selected'] = '';
                }
                if ($individual->staff_id == $staff_core->id) {
                    $archiveDoctorArray[$counter]['selected'] = 'selected';
                } else {
                    $archiveDoctorArray[$counter]['selected'] = '';
                }
            }
            if ($action == 'add') {
                //$this->view->archiveDoctor=$this->user['name_real'];
                //$this->view->staff_id=$this->user['uuid'];
                if ($this->user['uuid'] == $staff_core->id) {
                    $archiveDoctorArray[$counter]['selected'] = 'selected';
                    $responseDoctorArray[$counter]['selected'] = 'selected';
                } else {
                    $archiveDoctorArray[$counter]['selected'] = '';
                    $responseDoctorArray[$counter]['selected'] = '';
                }
            }


            $counter++;
        }
        $this->view->response_doctor = $responseDoctorArray;
        $this->view->archive_doctor = $archiveDoctorArray;


        //现建档医生与现责任医生
        if ($org_id != $this->user['org_id'] and $action == 'edit') {
            $staff_core = new Tstaff_core();
            $staff_archive = new Tstaff_archive();
            $staff_core->joinAdd('inner', $staff_core, $staff_archive, 'id', 'user_id');
            //echo $organizationSession->org_id;
            $staff_core->whereAdd("org_id='{$this->user['org_id']}'");
            $staff_core->find();
            $new_responseDoctorArray = array();
            $new_archiveDoctorArray = array();

            $new_responseDoctorArray[0]['zh_name'] = '请选择';
            $new_responseDoctorArray[0]['id'] = '-9';

            $new_archiveDoctorArray[0]['zh_name'] = '请选择';
            $new_archiveDoctorArray[0]['id'] = '-9';

            $counter = 1;
            while ($staff_core->fetch()) {
                //生成责任医生下拉框
                $new_responseDoctorArray[$counter]['zh_name'] = $staff_archive->name_real;
                $new_responseDoctorArray[$counter]['id'] = $staff_core->id;
                $new_archiveDoctorArray[$counter]['zh_name'] = $staff_archive->name_real;
                $new_archiveDoctorArray[$counter]['id'] = $staff_core->id;
                if ($this->user['uuid'] == $staff_core->id) {
                    $new_archiveDoctorArray[$counter]['selected'] = 'selected';
                    $new_responseDoctorArray[$counter]['selected'] = 'selected';
                } else {
                    $new_archiveDoctorArray[$counter]['selected'] = '';
                    $new_responseDoctorArray[$counter]['selected'] = '';
                }
                $counter++;
            }
            $this->view->new_response_doctor = $new_responseDoctorArray;
            $this->view->new_archive_doctor = $new_archiveDoctorArray;
        }



        //居民其它信息
        $relation_of_householder_disabled = false;
        if ($action == 'edit') {
            //如果是户主
            $string = '';
            if ($individual->relation_holder == 1) {
                $temp_individual = new Tindividual_core();
                $temp_individual->selectAdd("uuid as uuid,name as name");
                $temp_individual->whereAdd("family_number='" . $individual->family_number . "'");
                $temp_individual->whereAdd("uuid!='" . $individual->uuid . "'");
                //$temp_individual->debugLevel(9);
                $temp_individual->find();

                while ($temp_individual->fetch()) {
                    $string = $string . "<a href='" . __BASEPATH . "iha/cover/add/action/edit/uuid/" . $temp_individual->uuid . "'>" . $temp_individual->name . "</a>&nbsp;";
                }
            }
            $this->view->relation_of_householder_old = $individual->relation_holder;
            $this->view->uuid = $individual->uuid;

            $this->view->name = $individual->name;
            //if($this->user['role_en_name']!='doctor'){
            if ($this->haveWritePrivilege) {
                $this->view->name = $individual->name;
                $this->view->identity_number = $individual->identity_number;
                $this->view->householder_name = $family->householder_name;
                if ($string != '') {
                    $this->view->family_member_list = $string;
                    $this->view->householder_member_list_display = 'block';
                } else {
                    $this->view->family_member_list = '';
                    $this->view->householder_member_list_display = 'none';
                }
                $this->view->phone_number = $individual->phone_number;
            } else {
                $this->view->name = $this->mask_char;
                $this->view->identity_number = $this->mask_char;
                $this->view->householder_name = $this->mask_char;
                $this->view->phone_number = $this->mask_char;
            }

            $this->view->address = $individual->address;
            $this->view->residence_address = $individual->residence_address;

            $this->view->standard_code = $individual->standard_code;
            $this->view->standard_code_1 = $individual->standard_code_1;
            $this->view->standard_code_2 = $individual->standard_code_2;
            $this->view->family_number = $individual->family_number;
            $family_member_number = $this->checkHouseHolderAction($individual->family_number);
            //echo $relationOfHouseholderState;

            if ($action == 'edit' and $family_member_number > 1 and $individual->relation_holder == 1) {
                $relation_of_householder_disabled = true;
            }
            if ($relation_of_householder_disabled) {
                $this->view->relation_of_householder_disabled = 'disabled';
            } else {
                $this->view->relation_of_householder_disabled = '';
            }


            $this->view->family_inner_id = $family->inner_id;
            if ($individual->relation_holder == '1') {
                $this->view->family_number_old = $individual->family_number;
                $this->view->family_inner_id_old = $family->inner_id;
            }
            //不仅仅是户主，所有的人都记录其原来的家庭档案号，用于家庭关系异动时
            $this->view->family_number_old = $individual->family_number;

            $this->view->individual_inner_id = $individual->inner_id;
            $region_path_inner_id = str_repeat('0', 5 - strlen($individual->region_path_inner_id)) . $individual->region_path_inner_id;

            $this->view->region_path_inner_id = $region_path_inner_id;
            $this->view->updated = $individual->filing_time;
        }
        if ($action == 'add') {
            $this->view->name = '';
            $this->view->identity_number = '';
            $this->view->address = '';
            $this->view->standard_code_1 = '新增档案保存后自动生成';
            $this->view->standard_code_2 = '新增档案保存后自动生成';

            $this->view->residence_address = '';
            $this->view->phone_number = '';
            $this->view->family_number_old = '';
            $this->view->family_inner_id_old = '';
        }
        if ($action == 'add') {
            $this->view->disabled = "disabled";
        }
        if ($action == 'edit') {
            $this->view->disabled = "";
        }
        if ($this->haveWritePrivilege) {
            $this->view->ajax_save_disabled = "";
        } else {
            $this->view->ajax_save_disabled = "disabled";
            $this->view->new_org_switch = 'none';
        }
        $this->view->page = $this->_request->getParam('para_page');
        $this->view->opener = $this->_request->getParam('opener');
        //echo $this->view->opener.$this->_request->getParam('opener');
//		$this->view->status_flag=$this->_request->getParam('statu_f');
        $this->view->display('add.html');
        //var_dump($organizationSession->region_id);
    }

    /*
     * 打印个人档案封面
     */

    public function printAction() {
        $uuid = $this->_request->getParam("uuid");
        $core = new Tindividual_core();
        $org = new Torganization();
        $staff_creat = new Tstaff_core();
        $staff_zeren = new tstaff_core();
        $core->whereAdd("uuid='{$uuid}'");
        $core->find(true);
        $org->where("id='{$core->org_id}'"); //机构
        $org->find(true);
        $staff_creat->where("id='{$core->staff_id}'"); //建档医生
        $staff_creat->find(true);
        $staff_zeren->where("id='{$core->response_doctor}'"); //责任医生
        $staff_zeren->find(true);
        $region_path = explode(',', $core->region_path); //分割区域路径
        $region = new Tregion();
        $path1 = ""; //乡镇街道
        $path2 = ""; //村委会
        $region->where("id='{$region_path[4]}'or id='{$region_path[5]}'"); //查询乡镇街道名称
        $region->orderby("id asc");
        $region->find();
        while ($region->fetch()) {
            $path1.=$region->zh_name;
        }
		if(isset($region_path[6])){
			$region=new Tregion();
			$region->whereAdd("id='{$region_path[6]}'"); //查询村委会名称
			$region->find(true);
			$path2 = $region->zh_name;
		}
        $stand_code = $core->standard_code_1 ? $core->standard_code_1 : $core->standard_code_2;
        $stand_code = chunk_split($stand_code, 1, ".");
        $stand_code = explode('.', $stand_code);
        $code = "";
		
        foreach ($stand_code as $k => $v) {  //编号处理
           if($v===""){
                
            }
			else{
				if ($v != "-") {
						$code.="<div class='standrd'>{$v}</div>"; //生成方框
					} else {
                    $code.=$v;
					}
				}
        }
		
        $this->view->path1 = $path1;
        $this->view->path2 = $path2;
        $this->view->staff_zeren = $staff_zeren->toArray();
        $this->view->staff_creat = $staff_creat->toArray();
        $this->view->org = $org->toArray();
        $this->view->row = $core->toArray();
        $this->view->stand_code = $code;
        $this->view->display("print.html");
    }
    /**
     * 检查户主是否已拥有家庭成员
     *
     */
    public function checkHouseHolderAction($paraFamilyNumber = '') {
        if ($paraFamilyNumber != '') {
            $familyNumber = $paraFamilyNumber;
        } else {
            $familyNumber = $this->_request->getParam('familyNumber');
        }
        $individual = new Tindividual_core();
        $individual->whereAdd("family_number='$familyNumber'");
        //echo $individual->debugLevel(9);
        $counter = $individual->count('*');
//		echo $individual->debugLevel(9);
        //不能在此删除，否则会出现用户没有真正保存，而家庭档案丢失的现象
        /* 		if($counter<=1){
          $family=new Tfamily_archive();
          $family->whereAdd("family_number='$familyNumber'");
          $family->delete();
          } */

        if ($paraFamilyNumber == '') {
            echo $counter;
        }
        if ($paraFamilyNumber != '') {
            return $counter;
        }
    }

    public function searchAction() {
        $this->view->display('search.html');
    }

    /**
     * 实际的查询功能
     *
     */
    public function startsearchAction() {
        //var_dump($this->user);
        $orgId = $this->user['org_id'];
        //echo 'ok';
        $searchString = $this->_request->getParam('search_string');
        $individual = new Tindividual_core();
        $family = new Tfamily_archive();

        $individual->joinAdd('inner', $individual, $family, 'uuid', 'householder_id');
        $individual->selectAdd("individual_core.name as name,
		individual_core.address as address,
		individual_core.identity_number as identity_number,
		individual_core.family_number as family_number
		");
        $family->selectAdd("
		family_archive.householder_id as householder_id,
		family_archive.inner_id as inner_id
		");
        //更多的查询条件在这里增加

        if (strlen($searchString) > 10) {
            $individual->whereAdd(
                    "individual_core.name like  '%$searchString%' or
			individual_core.name_pinyin like '%$searchString%' or 
			individual_core.phone_number like '%$searchString%'"
            );
        } else {
            $individual->whereAdd(
                    "individual_core.name like  '%$searchString%' or
			individual_core.name_pinyin like '%$searchString%'"
            );
        }
        $org_id = $this->user['org_id'];
        //$org_id=$this->user['org_id'];
        $org_id = $this->user['org_id'];
        $org = new Torganization();
        $org->whereAdd("id='$org_id'");
        $org->find(true);
        $temp = explode("|", $org->region_path_domain);
        $region_path_domain = '';
        foreach ($temp as $k1 => $v1) {
            $region_path_domain = $region_path_domain . "individual_core.region_path like '" . $v1 . "%' or ";
        }
        $region_path_domain = rtrim($region_path_domain, ' or ');


        //$individual->whereAdd("individual_core.org_id='$orgId'");
        //$individual->debugLevel(9);
        $individual->whereAdd($region_path_domain);
        $individual->whereAdd("individual_core.relation_holder='1'");
        if ($individual->count('*') <= 0) {
            echo 'no_data';
            exit();
        }
        $individual->select();
        /* 		echo "<table>";
          echo "<tr><td>姓名</td><td>住址</td><td>身份证号</td></tr>";
          while ($individual->fetch()){
          echo "<tr>";
          echo "<td>".$individual->name."</td>";
          echo "<td>".$individual->address."</td>";
          echo "<td>".$individual->identity_number."</td>";
          echo "</tr>";
          }
          echo "</table>"; */
        $rows = array();
        $counter = 0;
        while ($individual->fetch()) {
            $rows[$counter]['name'] = $individual->name;
            $rows[$counter]['address'] = $individual->address;
            $rows[$counter]['identity_number'] = $individual->identity_number;
            $rows[$counter]['family_number'] = $individual->family_number;
            $rows[$counter]['family_inner_id'] = $family->inner_id;
            $counter++;
        }
        //var_dump($rows);
        $this->view->rows = $rows;
        $this->view->display('list.html');
        //echo json_encode($rows);
    }

    /**
     * 用于上传头像
     * 
     */
    public function uploadAction() {
        
    }

    /**
     * 用于设置session
     */
    public function setsessionAction() {
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/custom/comm_function.php';
        $uuid = $this->_request->getParam('uuid');
        if ($uuid) {
            $core = new Tindividual_core();
            $core->whereAdd("uuid='$uuid'");
            $core->find(true);
            if ($core->standard_code) {
                $individual_session = new Zend_Session_Namespace("individual_core");
                $individual_session->uuid = $uuid; //设置个人UUID
                $individual_session->standard_code = $core->standard_code; //设置标准档案号
                $individual_session->name = $core->name; //设置姓名
                $individual_session->sex = $core->sex; //设置性别
                $individual_session->age = getBirthday($core->date_of_birth, time());
                ; //设置年龄
                $individual_session->date_of_birth = $core->date_of_birth; //设置生日
                $individual_session->address = $core->address; //设置现在住址
                $individual_session->residence_address = $core->residence_address; //设置户籍地址
                $individual_session->phone_number = $core->phone_number; //设置本人联系电话
                $individual_session->staff_id = $core->staff_id; //设置建档医生
                $individual_session->filing_time = $core->filing_time; //设置建档时间
                echo "ok";
                exit;
            } else {
                echo "error_no_person";
                exit;
            }
        } else {
            echo "error_uuid_no_null";
            exit;
        }
    }

    public function refreshCode1Action() {
        //echo "此功能仅开发人员能使用";

        require_once(__SITEROOT . 'library/custom/region_array.php');
        require_once __SITEROOT . '/library/custom/iha_comm.php';
        if ($this->_request->getParam('pass') != 'luo') {
            echo "此功能仅开发人员能使用";
            exit();
        }
        $org_id = $this->user['org_id'];
        $individual = new Tindividual_core();
        $individualUpdate = new Tindividual_core();
        $family = new Tfamily_archive();
        $individual->joinAdd('left', $individual, $family, 'family_number', 'uuid');
        //$individual->whereAdd("individual_core.org_id='$org_id'");
        $individual->find();
        $i = 0;
        while ($individual->fetch()) {
            $pathArray = explode(',', $individual->region_path);
            $region_id_1 = $pathArray['4'];
            $region_id_2 = $pathArray['5'];
            $region_id_3 = '0' . $pathArray['6'];
            $region_id_4 = $pathArray['7'];
            //echo $region_id_1.'-'.$region_id_2.'-'.$region_id_3.'-'.$region_id_4;
            //echo '<br />';
            //echo $regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.$regionInfo[$region_id_3]['1'].'-'.$regionInfo[$region_id_4]['1'];
            //echo '<br />';
            //$std_1=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.
            $region_path_inner_id = str_repeat('0', 5 - strlen($individual->region_path_inner_id)) . $individual->region_path_inner_id;

            $std_1 = $regionInfo[$region_id_1]['1'] . '-' . $regionInfo[$region_id_2]['1'] . '-' . substr($regionInfo[$region_id_3]['1'], 0, 3) . '-' . $region_path_inner_id;
            $family_inner_id = str_repeat('0', 4 - strlen($family->inner_id)) . $family->inner_id;
            $individual_inner_id = str_repeat('0', 2 - strlen($individual->inner_id)) . $individual->inner_id;
            $std_2 = $regionInfo[$region_id_1]['1'] . '-' . $regionInfo[$region_id_2]['1'] . '-' . $regionInfo[$region_id_3]['1'] . '-' . $regionInfo[$region_id_4]['1'] . '-' . $family_inner_id . '-' . $individual_inner_id;
            echo '<br />';
            echo $std_1 . '|' . $individual->name . '|' . $individual->standard_code_1;
            echo $std_2 . '|' . $individual->name . '|' . $individual->standard_code_2;
            echo '<br />';
            $uuid = $individual->uuid;
            $individualUpdate->where("uuid='$uuid'");
            $individualUpdate->standard_code_1 = $std_1;
            $individualUpdate->standard_code_2 = $std_2;
            $individualUpdate->update();
            $i++;
            echo $i;
            echo '<br />';
        }
    }

    //导数据自动生成国标流水号
    public function batgenstd1Action() {
        //echo "此功能仅开发人员能使用";

        require_once(__SITEROOT . 'library/custom/region_array.php');
        require_once __SITEROOT . '/library/custom/iha_comm.php';
        if ($this->_request->getParam('pass') != 'luo') {
            echo "此功能仅开发人员能使用";
            exit();
        }
        //$org_id=$this->user['org_id'];
        $individual = new Tindividual_core();
        $individualUpdate = new Tindividual_core();
        //$family=new Tfamily_archive();
        //$individual->joinAdd('left',$individual,$family,'family_number','uuid');
        $individual->whereAdd("standard_code_1 like '%---00001'");
        //$individual->whereAdd("individual_core.standard_code_1!=individual_core.standard_code_2");
        $individual->find();
        $i = 0;
        while ($individual->fetch()) {
            $pathArray = explode(',', $individual->region_path);
            $region_id_1 = $pathArray['4'];
            $region_id_2 = $pathArray['5'];
            $region_id_3 = $pathArray['6'];
            $region_id_4 = $pathArray['7'];
            //echo $region_id_1.'-'.$region_id_2.'-'.$region_id_3.'-'.$region_id_4;
            //echo '<br />';
            //echo $regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.$regionInfo[$region_id_3]['1'].'-'.$regionInfo[$region_id_4]['1'];
            //echo '<br />';
            //$std_1=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.

            $regionPath1 = $regionInfo[$region_id_3]['2'];

            //获取国标档案编码流水号
            //$individual_1=new Tindividual_core();
            //$individual_1->selectAdd('max(region_path_inner_id) as region_path_inner_id');
            //注意这是里是$regionPath1
            //$individual_1->whereAdd("region_path like '$regionPath1%'");
            //$individual_1->debugLevel(9);
            //$individual_1->find(true);
            //echo $individual_1->region_path_inner_id;
            /* if($individual_1->region_path_inner_id!=''){
              $region_path_inner_id=$individual_1->region_path_inner_id+1;
              }else{
              $region_path_inner_id=1;
              } */

            $region = new Tregion();
            $region->whereAdd("region_path='$regionPath1'");

            $region->find(true);
            if ($region->actually_population != '') {
                $region_path_inner_id = $region->actually_population + 1;
            } else {
                $region_path_inner_id = 1;
            }


            echo '<br />';

            $individualUpdate->region_path_inner_id = $region_path_inner_id;
            $region_path_inner_id = str_repeat('0', 5 - strlen($region_path_inner_id)) . $region_path_inner_id;
            $std_1 = $regionInfo[$region_id_1]['1'] . '-' . $regionInfo[$region_id_2]['1'] . '-' . substr($regionInfo[$region_id_3]['1'], 0, 3) . '-' . $region_path_inner_id;




            echo '<br />';
            echo $std_1 . '|' . $individual->name . '|' . $individual->standard_code_1;
            echo '<br />';
            $uuid = $individual->uuid;
            $individualUpdate->where("uuid='$uuid'");

            $individualUpdate->standard_code_1 = $std_1;
            $individualUpdate->update();
            echo $individualUpdate->oracle_error();
            $i++;
            echo $i;
            echo '<br />';
            $region = new Tregion();
            $region->whereAdd("region_path='$regionPath1'");
            $region->actually_population = $region_path_inner_id;
            $region->update();
        }
    }

    //在此在增加一个刷各地建档数的功能
    public function gen_populationAction() {
        
    }

    //导数据自动生成国标流水号
    public function batgenstd1_bakAction() {
        //echo "此功能仅开发人员能使用";
        require_once(__SITEROOT . 'library/custom/region_array.php');
        require_once __SITEROOT . '/library/custom/iha_comm.php';
        if ($this->_request->getParam('pass') != 'luo') {
            echo "此功能仅开发人员能使用";
            exit();
        }
        //$org_id=$this->user['org_id'];
        $individual = new Tindividual_core();
        $individualUpdate = new Tindividual_core();
        //$family=new Tfamily_archive();
        //$individual->joinAdd('left',$individual,$family,'family_number','uuid');
        //$individual->whereAdd("individual_core.org_id='$org_id'");
        //$individual->whereAdd("individual_core.standard_code_1!=individual_core.standard_code_2");
        $individual->find();
        $i = 0;
        while ($individual->fetch()) {
            $pathArray = explode(',', $individual->region_path);
            $region_id_1 = $pathArray['4'];
            $region_id_2 = $pathArray['5'];
            $region_id_3 = $pathArray['6'];
            $region_id_4 = $pathArray['7'];
            //echo $region_id_1.'-'.$region_id_2.'-'.$region_id_3.'-'.$region_id_4;
            //echo '<br />';
            //echo $regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.$regionInfo[$region_id_3]['1'].'-'.$regionInfo[$region_id_4]['1'];
            //echo '<br />';
            //$std_1=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.

            $regionPath1 = $regionInfo[$region_id_3]['2'];

            //获取国标档案编码流水号

            $individual_1 = new Tindividual_core();
            $individual_1->selectAdd('max(region_path_inner_id) as region_path_inner_id');
            //注意这是里是$regionPath1
            $individual_1->whereAdd("region_path like '$regionPath1%'");
            //$individual_1->debugLevel(9);
            $individual_1->find(true);
            echo $individual_1->region_path_inner_id;
            echo '<br />';

            if ($individual_1->region_path_inner_id != '') {
                $region_path_inner_id = $individual_1->region_path_inner_id + 1;
            } else {
                $region_path_inner_id = 1;
            }
            $individualUpdate->region_path_inner_id = $region_path_inner_id;
            $region_path_inner_id = str_repeat('0', 5 - strlen($region_path_inner_id)) . $region_path_inner_id;
            $std_1 = $regionInfo[$region_id_1]['1'] . '-' . $regionInfo[$region_id_2]['1'] . '-' . substr($regionInfo[$region_id_3]['1'], 0, 3) . '-' . $region_path_inner_id;




            echo '<br />';
            echo $std_1 . '|' . $individual->name . '|' . $individual->standard_code_1;
            echo '<br />';
            $uuid = $individual->uuid;
            $individualUpdate->where("uuid='$uuid'");

            $individualUpdate->standard_code_1 = $std_1;
            $individualUpdate->update();
            echo $individualUpdate->oracle_error();
            $i++;
            echo $i;
            echo '<br />';
        }
    }

    public function drsAction() {
        $individual_core = new Tindividual_core();
        $individual_core->limit(0, 1000);
        $individual_core->find();
        while ($individual_core->fetch()) {
            echo $individual_core->region_path;
            echo "&nbsp;&nbsp;&nbsp;";
            echo $individual_core->standard_code_1;
            echo "&nbsp;&nbsp;&nbsp;";
            echo $individual_core->standard_code_2;
            echo "<br />";
        }
    }

    //因为村级或是社区仅取后二位，因此在自定义编码时，后二位必须做到唯一，否则健康档案号重
    //通过其region_path重新生成其std_code1 与 std_code2 但仅处理区域自定义编号部分，并不对流水号进行重新生成
    public function refreshstdAction() {
        require_once(__SITEROOT . 'library/custom/region_array.php');
        $individual_core = new Tindividual_core();
        $individual_core->limit(0, 100);
        $individual_core->find();

        while ($individual_core->fetch()) {
            $temp_region_path = explode(',', $individual_core->region_path);
            //var_dump($temp_region_path);
            $temp_std_code1 = explode('-', $individual_core->standard_code_1);
            $temp_std_code2 = explode('-', $individual_core->standard_code_2);

            $new_std_code1 = $regionInfo[$temp_region_path[4]][1] . '-' .
                    $regionInfo[$temp_region_path[5]][1] . '-' .
                    substr($regionInfo[$temp_region_path[6]][1], 0, 3) . '-' .
                    $temp_std_code1[3];
            echo 'standard_code_1:' . $individual_core->standard_code_1;
            echo "<br />";
            echo '$new_std_code1:' . $new_std_code1;
            echo "<br />";


            if (0) {
                //获取从县级到街道，居委会，小区的编码
                $region_id_1 = $temp[4];
                $region_id_2 = $temp[5];
                $region_id_3 = $temp[6];
                $region_id_4 = $temp[7];

                //国标档案号 2011－1－27号出现的档案号重的问题就出在这里
                $std1 = $regionInfo[$region_id_1]['1'] . '-' . $regionInfo[$region_id_2]['1'] . '-' . substr($regionInfo[$region_id_3]['1'], 0, 3) . '-' . $region_path_inner_id;
                //省标档案号
                $std2 = $regionInfo[$region_id_1]['1'] . '-' . $regionInfo[$region_id_2]['1'] . '-' . $regionInfo[$region_id_3]['1'] . '-' . $regionInfo[$region_id_4]['1'] . '-' . $familyInnerId . '-' . $individualInnerId;
            }



            /* 			echo $individual_core->region_path;
              echo "&nbsp;&nbsp;&nbsp;";
              echo $individual_core->standard_code_1;
              echo "&nbsp;&nbsp;&nbsp;";
              echo $individual_core->standard_code_2;
              echo "<br />"; */
        }
    }

    //查询各级区域管理中，自定义编号重号的数据
    public function checkregionid1Action() {
        $region = new Tregion();

        $region->find();
        while ($region->fetch()) {
            if ($region->region_level <= 6) {
                $temp = $region->region_path;
                $temp1 = intval($region->region_level) + 1;
                $region1 = new Tregion();
                //$region1->groupby_columns_define('standard_code');
                $region1->selectAdd("count(standard_code) as counter,standard_code");
                $region1->where("region.region_path like '$temp%' and region_level='$temp1'");
                //$region1->where("region.region_path like '$temp%' ");

                $region1->groupby('standard_code');
                $region1->having("count(standard_code)>1");
                $region1->debugLevel(9);
                $region1->find();
                while ($region1->fetch()) {
                    echo $region1->standard_code;
                    echo $region1->counter;
                    echo "<br />";
                }
            }
            /* 			echo $region->zh_name;
              echo $region->region_path;
              echo "<br />"; */
        }
    }

    //删除错误的数据－用身份证号删除
    public function innerdeleteAction() {
        exit();
        set_time_limit(0);
        require_once __SITEROOT . "library/Models/ss.php";
        $ss = new Tss();
        $ss->find();
        while ($ss->fetch()) {
            echo $ss->id;
            $id = strtolower($ss->id);
            $individual_core = new Tindividual_core();
            $individual_core->whereAdd("IDENTITY_NUMBER='$id'");
            $individual_core->find();
            $individual_core->fetch();
            echo '|' . $individual_core->name;
            $uuid = $individual_core->uuid;
            $individual_archive = new Tindividual_archive();
            $individual_archive->whereAdd("id='$uuid'");
            $individual_archive->find();
            $individual_archive->fetch();
            echo $individual_archive->occupation;
            echo "<br />";
        }
    }

    //删除错误的数据－用身份证号删除 错误数据来自于数组
    public function innerdelete3Action() {
        //exit();
        set_time_limit(0);

        for ($i = 0; $i < count($this->data); $i++) {
            echo $this->data[$i];
            $id = strtolower($this->data[$i]);
            $individual_core = new Tindividual_core();
            $individual_core->whereAdd("IDENTITY_NUMBER='$id'");
            $individual_core->find();
            $individual_core->fetch();
            echo '|' . $individual_core->name;
            $uuid = $individual_core->uuid;
            $individual_archive = new Tindividual_archive();
            $individual_archive->whereAdd("id='$uuid'");
            $individual_archive->find();
            $individual_archive->fetch();
            echo $individual_archive->occupation;
            echo "<br />";
        }
    }

    /**
     * 数组删除  正式用
     *
     */
    public function innerdelete4Action() {
        exit();
        set_time_limit(0);

        for ($i = 0; $i < count($this->data); $i++) {
            echo $this->data[$i];
            $id = strtolower($this->data[$i]);
            $individual_core = new Tindividual_core();
            $individual_core->whereAdd("IDENTITY_NUMBER='$id'");

            $individual_core->find();
            $individual_core->fetch();
            //$individual_core->debugLevel(9);
            //echo '|'.$individual_core->name;
            $uuid = $individual_core->uuid;
            $individual_core = new Tindividual_core();
            $individual_core->whereAdd("IDENTITY_NUMBER='$id'");
            $individual_core->find();
            $individual_core->delete();


            $individual_archive = new Tindividual_archive();
            $individual_archive->whereAdd("id='$uuid'");
            $individual_archive->delete();
            //$individual_archive->find();
            //$individual_archive->fetch();
            //echo $individual_archive->occupation;
            echo "<br />";
        }
    }

    public function innerdelete1Action() {
        exit();
        set_time_limit(0);
        require_once __SITEROOT . "library/Models/ss.php";
        $ss = new Tss();
        $ss->find();
        /* 		while ($ss->fetch()){
          echo $ss->id;
          $id=$ss->id;
          $individual_core=new Tindividual_core();
          $individual_core->whereAdd("IDENTITY_NUMBER='$id'");
          $individual_core->find();
          $individual_core->fetch();
          echo '|'.$individual_core->name;
          $uuid=$individual_core->uuid;
          $individual_archive=new Tindividual_archive();
          $individual_archive->whereAdd("id='$uuid'");
          $individual_archive->find();
          $individual_archive->fetch();
          echo $individual_archive->occupation;
          echo "<br />";
          } */
        while ($ss->fetch()) {
            echo $ss->id;
            $id = $ss->id;
            $individual_core = new Tindividual_core();
            $individual_core->whereAdd("IDENTITY_NUMBER='$id'");
            $individual_core->find();
            $individual_core->fetch();
            //echo '|'.$individual_core->name;
            $uuid = $individual_core->uuid;
            $individual_core = new Tindividual_core();
            $individual_core->whereAdd("IDENTITY_NUMBER='$id'");
            $individual_core->find();
            $individual_core->delete();
            //$individual_core->address

            $individual_archive = new Tindividual_archive();
            $individual_archive->whereAdd("id='$uuid'");
            $individual_archive->delete();
            //$individual_archive->find();
            //$individual_archive->fetch();
            //echo $individual_archive->occupation;
            echo "<br />";
        }
    }

    /**
     * 删除除指定地区以外的所有数据
     *
     */
    public function innerdelete5Action() {
        set_time_limit(0);
        $individual_core = new Tindividual_core();
        //$individual_core->whereAdd("region_path not like '0,1,2,5,75%'");
        $individual_core->whereAdd("region_path like '0,1,2,5,72,11197%'");
        $individual_core->find();
        while ($individual_core->fetch()) {
            $uuid = $individual_core->uuid;
            //echo $individual_core->name;
            //echo "<br />";
            //删除扩展信息表
            $individual_archive = new Tindividual_archive();
            $individual_archive->whereAdd("id='$uuid'");
            $individual_archive->delete();
            //删除个人基本信息表
            $individual_core1 = new Tindividual_core();
            $individual_core1->whereAdd("uuid='$uuid'");
            $individual_core1->delete();
            //echo $individual_core1->oracle_error();
            //删除其它表中的相关数据
            require_once __SITEROOT . "library/Models/$xxxxx.php";
            $xxxxx = new Txxxxxx();
            $xxxxx->whereAdd("id='$uuid'");
            $xxxxx->delete();
        }
        echo "<br />";
    }

    public $data = array("513128194706142119",
        "513128195307212129",
        "513128197211172117",
        "513128199501152113",
        "513128199206292113",
        "513128200106262123",
        "511023197308034168",
        "513128196710212115",
        "51312819410912211X",
        "513128195208092125",
        "513128197802062120",
        "513128199908012112",
        "513128200307152123",
        "513128198906102128",
        "513128199501072113",
        "513128196908062124",
        "513128197502172117",
        "513128199608082119",
        "513128200002022117",
        "513128192512102128",
        "513128196401112137",
        "511827200001214811",
        "513128195210122119",
        "513128197812282143",
        "513128195910122128",
        "513128198211012118",
        "511827200602172127",
        "513128193802172110",
        "513128193604282124",
        "513128196904142119",
        "511827200809172124",
        "513128197204036029",
        "513128197108192128",
        "513128198806032126",
        "513128199303032129",
        "513128200204022115",
        "511827200806244815",
        "51312819630317211X",
        "513128196609082125",
        "513128198912082127",
        "513128198503152112",
        "51312819420213211X",
        "513128197304082110",
        "513128200204202116",
        "513128199406272117",
        "513128720702212",
        "513128196903172121",
        "513128197912042120",
        "513128200001302125",
        "513128199407122129",
        "513128199106022124",
        "513128196804262816",
        "511827200806102112",
        "513128194004242115",
        "513128196412032116",
        "513128199401022127",
        "513128196604042865",
        "513128194305052112",
        "513128194104032123",
        "513128199603032112",
        "513128199908022126",
        "51312819930102212X",
        "513128196910102113",
        "513128196709292128",
        "513128197303242127",
        "511022196911125530",
        "51312819721212212X",
        "513128199304242128",
        "513128197104192120",
        "513128199601012126");
    /**
     * 选择机构后触发一个ajax取得这个机构的医生
     * 
     */
    public function getdoctorAction()
    {
         $org_id =  $this->_request->getParam('org_id');
         $status =  $this->_request->getParam('status');
         $org_id = empty($org_id)?$this->user['org_id']:$org_id;
         $str = '';
         if($status)
         {
             $str.= '<select name="new_archive_doctor" id="new_archive_doctor">';
         }
         else
         {
             $str.= '<select name="new_response_doctor" id="new_response_doctor">';
         }
         //取机构下的医生
         $staff_core = new Tstaff_core();
         $staff_core->whereAdd("org_id=$org_id");
         $staff_core->find();
          while($staff_core->fetch())
         {
             $str.='<option value="'.$staff_core->id.'">'.$staff_core->name_login.'</option>';
         }
         $str.='</select>';
         echo $str;
    }
}

?>
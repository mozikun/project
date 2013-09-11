<?php
/**
 * 导入原来的数据
 */
class iha_importController extends controller {
	/**
	 * The default action - show the home page
	 */
	public function init() {
		set_time_limit(0);
		//error_reporting(0);
		$this->view->assign( "baseUrl", __BASEPATH );
		$this->view->assign( "basePath", __BASEPATH );
		require_once __SITEROOT . "library/Models/family_archive.php";
		require_once __SITEROOT . "library/Models/individual_archive.php";
		require_once __SITEROOT . "library/Models/individual_core.php";
		require_once __SITEROOT . "library/Models/organization.php";
		require_once __SITEROOT . "library/Models/region.php";
		require_once __SITEROOT . "library/custom/pager.php";
		require_once __SITEROOT . "library/adodb/adodb.inc.php";
		//require_once __SITEROOT . 'library/custom/adodb-time.inc.php'; //引入时间处理
		require_once __SITEROOT . 'library/custom/comm_function.php';
		//require_once(__SITEROOT.'library/Myauth.php');
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/pinyin/pinyin.php');
        require_once(__SITEROOT.'library/MyAuth.php');
	}
	public function indexAction()
	{
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$area_code="511802";
		$array_code_relation=array("0"=>"1","1"=>"2","2"=>"3","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","9"=>"-99");
		$array_code_occupation=array("51"=>"5","52"=>"5","53"=>"5","54"=>"5","59"=>"-99");
	    $db_person =ADONewConnection('access');
	    $db_family =ADONewConnection('access');
	    $dsn_person = "Driver={Microsoft Access Driver (*.mdb)};Dbq=".realpath(__SITEROOT ."personinfo_$area_code.mdb").";Uid=;Pwd=;";
	    $dsn_family = "Driver={Microsoft Access Driver (*.mdb)};Dbq=".realpath(__SITEROOT ."nhfamily.mdb").";Uid=;Pwd=;";
	    $db_person->Connect($dsn_person);//连接个人档案
	    $db_family->Connect($dsn_family);//连接家庭档案
	    $ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
	    //测试生成一个家庭
	    //从家庭档案中读取一个记录
	    $rs = $db_family->Execute("select * from nhfamily where familycode like '$area_code%'");
	    //print $db_family->ErrorMsg();
	    while (!$rs->EOF)
	    {
	        //可以获取家庭档案号、电话号码
	        //生成家庭档案号
	        $family_code=$rs->fields['FAMILYCODE'];
	        $family_uuid=uniqid("f_",true);//家庭档案UUID
	       	$inner_id="1";// 家庭内部序号inner_id
	        $org_id="1";//机构IDorg_id
	        //$householder_name=$this->get_householder_name($family_code."01",$area_code);//户主姓名householder_name
	        $region_path="0,1,2,5,71,80,85,92";//区域路径region_path
	        $staff_id="4c47e3305a70c";//医生ID（建立虚拟医生后自动分配）staff_id
	        //生成该家庭的其他成员信息
	        if ($family_code!="")
	        {
	        	 $householder_id="";
	        	 $householder_code="";
		        $person=$db_person->Execute("select * from personinfo where PERSONCODE like '$family_code%' order by PERSONCODE asc");
		         while (!$person->EOF)
		    	{
		    		//根据结果一次生成信息
		    		$person_uuid=uniqid("i_",true);//个人档案表中的UUID
		    		$inner_id=substr($person->fields['PERSONCODE'],-2,2);//家庭内部流水号inner_id
		    		$region_path="0,1,2,5,71,80,85,92";//行政区域路径region_path
		    		$name=str_replace(" ","",iconv("gb2312","utf-8//IGNORE",$person->fields['PERSONNAME']));//姓名name
		    		$name_pinyin=getPinyin($name);//姓名拼音name_pinyin
		    		$identity_number=$person->fields['CERTID'];//身份证号identity_number
		    		$date_of_birth=mkunixstamp($person->fields['OBD']);//生日date_of_birth
		    		$staff_id="4c47e3305a70c";//医生ID（建立虚拟医生后自动分配）staff_id
		    		$response_doctor="4c47e3305a70c";//责任医生（同医生ID）response_doctor
		    		$address="";//现住址（access中无此字段，需生成）address
		    		$residence_address_id=$address;//residence_address_id
		    		$family_number=$family_uuid;//家庭档案号（家庭档案中的UUID）family_number
		    		$family_inner_id=substr($person->fields['PERSONCODE'],-6,4);//家庭内部序号family_inner_id
		    		$region_path_inner_id="";//标档案中的流水号region_path_inner_id
		    		$relation_holder=$array_code_relation[$person->fields['RELATION']];//与户主关系relation_holder
		    		$phone_number=$rs->fields['TEL'];//本人联系电话phone_number
		    		$standard_code_1="";//国家标准档案号standard_code_1
		    		$standard_code_2=$person->fields['PERSONCODE'];//省标准档案号standard_code_2
		    		$standard_code_2=substr($standard_code_2,0,6)."-".substr($standard_code_2,6,3)."-".substr($standard_code_2,9,3)."-".substr($standard_code_2,12,2)."-".substr($standard_code_2,14,4)."-".substr($standard_code_2,-2,2);
		    		if ($person->fields['RELATION']=='0' && $person->fields['PERSONCODE']==$family_code."01")
		    		{
		    			$householder_id=$person_uuid;//初始化户主的个人档案号
		    			$householder_code=$person->fields['PERSONCODE'];
		    		}
		    		//户主的个人档案号（根据所读取到的家庭档案记录加01生成个人档案号）householder_id
		    		$householder_name=$this->get_householder_name($householder_code,$area_code);//户主姓名（个人表中读取
		    		$race="1";//民族
		    		$sexs=array_code_change($person->fields['SEX'],$sex);//性别
		    		$occupation=$array_code_occupation[$person->fields['OCCUPATION']];//职业
		    		//文化程度
		    		$marriage=$person->fields['MARRIAGESTATUS'];//婚姻状况
		    		if ($person->fields['RELATION']=='0' && $person->fields['PERSONCODE']==$family_code."01")
		    		{
			    		//开始写入家庭档案
			    		$family=new Tfamily_archive();
						$family->uuid=$family_uuid;
						$family->inner_id=$family_inner_id;
						$family->org_id=$org_id;
						$family->family_number=$family_number;
						$family->householder_id=$householder_id;
						$family->householder_name=$householder_name;
						$family->region_path=$region_path;
						$family->staff_id=$staff_id;
						$family->created=time();
						$family->updated=time();
						$family->insert();
		    		}
		    		//开始写入个人档案
		    		$individual=new Tindividual_core();
					$individual->uuid=$person_uuid;
					$individual->org_id=$org_id;
					$individual->inner_id=$inner_id;
					$individual->region_path=$region_path;
					$individual->name=$name;
					$individual->name_pinyin=$name_pinyin;
					$individual->identity_number=$identity_number;
					$individual->date_of_birth=$date_of_birth;
					$individual->staff_id=$staff_id;
					$individual->response_doctor=$staff_id;
					$individual->address=$address;
					$individual->residence_address=$residence_address_id;
					$individual->family_number=$family_uuid;
					$individual->family_inner_id=$family_inner_id;
					$individual->region_path_inner_id=$region_path_inner_id;
					$individual->relation_holder=$relation_holder;
					$individual->updated=time();
					$individual->phone_number=$phone_number;
					$individual->standard_code_1=$standard_code_2;
					$individual->standard_code_2=$standard_code_2;//手工
					$individual->sex=$sexs;
					$individual->race=$race;
					$individual->created=time();
					//$individual->debugLevel(5);
					$individual->insert();
					//开始写个人记录扩展表
		    		$person->MoveNext();
		    	}
	        }
	        $rs->MoveNext();
		}
	}
	public function refreshAction()
	{
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$area_code="511802";
		$array_code_relation=array("0"=>"1","1"=>"2","2"=>"3","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","9"=>"-99");
		$array_code_occupation=array("51"=>"5","52"=>"5","53"=>"5","54"=>"5","59"=>"-99");
	    $db_person =ADONewConnection('access');
	    $dsn_person = "Driver={Microsoft Access Driver (*.mdb)};Dbq=".realpath(__SITEROOT ."personinfo_$area_code.mdb").";Uid=;Pwd=;";
	    $db_person->Connect($dsn_person);//连接个人档案
	    $ADODB_FETCH_MODE = ADODB_FETCH_BOTH;

	    if (!file_exists("./cache_import.php"))
	    {
			$db_family =ADONewConnection('access');
			$dsn_family = "Driver={Microsoft Access Driver (*.mdb)};Dbq=".realpath(__SITEROOT ."nhfamily.mdb").";Uid=;Pwd=;";
			$db_family->Connect($dsn_family);//连接家庭档案
		    //测试生成一个家庭
		    //从家庭档案中读取一个记录
		    $rs = $db_family->Execute("select * from nhfamily where familycode like '$area_code%'");
		    //print $db_family->ErrorMsg();
		    $i=1;
		    $family_code=array();
		    while (!$rs->EOF)
		    {
		        //可以获取家庭档案号、电话号码
		        //生成家庭档案号
		        $family_code[$i]=$rs->fields['FAMILYCODE'];
		        $i++;
		        $rs->MoveNext();
			}
			$this->create_cache("./cache_import.php",$family_code);
	    }
	    else 
	    {
	    	require_once './cache_import.php';
	    }
	    //获取当前家庭档案号
	    $now_record=$this->_request->getParam('record')?$this->_request->getParam('record'):1;
	    if (isset($a[$now_record]))
	    {
	    	$family_code=$a[$now_record];
	    	$family_uuid=uniqid("f_",true);//家庭档案UUID
	       	$inner_id="1";// 家庭内部序号inner_id
	        $org_id="1";//机构IDorg_id
	        //$householder_name=$this->get_householder_name($family_code."01",$area_code);//户主姓名householder_name
	        $region_path="0,1,2,5,71,80,85,92";//区域路径region_path
	        $staff_id="4c47e3305a70c";//医生ID（建立虚拟医生后自动分配）staff_id
	        //生成该家庭的其他成员信息
	        if ($family_code!="")
	        {
	        	 $householder_id="";
	        	 $householder_code="";
				 $householder_names="";
				 $person=$db_person->Execute("select * from personinfo where PERSONCODE like '$family_code%' order by PERSONCODE asc");
		         while (!$person->EOF)
		    		{
		    		//根据结果一次生成信息
		    		$person_uuid=uniqid("i_",true);//个人档案表中的UUID
		    		$inner_id=substr($person->fields['PERSONCODE'],-2,2);//家庭内部流水号inner_id
		    		$region_path="0,1,2,5,71,80,85,92";//行政区域路径region_path
		    		$name=str_replace(" ","",iconv("gb2312","utf-8//IGNORE",$person->fields['PERSONNAME']));//姓名name
		    		$name_pinyin=getPinyin($name);//姓名拼音name_pinyin
		    		$identity_number=$person->fields['CERTID'];//身份证号identity_number
		    		$date_of_birth=mkunixstamp($person->fields['OBD']);//生日date_of_birth
		    		$staff_id="4c47e3305a70c";//医生ID（建立虚拟医生后自动分配）staff_id
		    		$response_doctor="4c47e3305a70c";//责任医生（同医生ID）response_doctor
		    		$address="";//现住址（access中无此字段，需生成）address
		    		$residence_address_id=$address;//residence_address_id
		    		$family_number=$family_uuid;//家庭档案号（家庭档案中的UUID）family_number
		    		$family_inner_id=substr($person->fields['PERSONCODE'],-6,4);//家庭内部序号family_inner_id
		    		$region_path_inner_id="";//标档案中的流水号region_path_inner_id
		    		$relation_holder=$array_code_relation[$person->fields['RELATION']];//与户主关系relation_holder
		    		$phone_number=$rs->fields['TEL'];//本人联系电话phone_number
		    		$standard_code_1="";//国家标准档案号standard_code_1
		    		$standard_code_2=$person->fields['PERSONCODE'];//省标准档案号standard_code_2
		    		$standard_code_2=substr($standard_code_2,0,6)."-".substr($standard_code_2,6,3)."-".substr($standard_code_2,9,3)."-".substr($standard_code_2,12,2)."-".substr($standard_code_2,14,4)."-".substr($standard_code_2,-2,2);
		    		if ($person->fields['RELATION']=='0' && $person->fields['PERSONCODE']==$family_code."01")
		    		{
		    			$householder_id=$person_uuid;//初始化户主的个人档案号
		    			$householder_code=$person->fields['PERSONCODE'];
						$householder_names=str_replace(" ","",iconv("gb2312","utf-8//IGNORE",$person->fields['PERSONNAME']));
		    		}
		    		//户主的个人档案号（根据所读取到的家庭档案记录加01生成个人档案号）householder_id
		    		//$householder_name=$this->get_householder_name($householder_code,$area_code);//户主姓名（个人表中读取
					$householder_name=$householder_names;//户主姓名（个人表中读取
		    		$race="1";//民族
		    		$sexs=array_code_change($person->fields['SEX'],$sex);//性别
		    		$occupation=$array_code_occupation[$person->fields['OCCUPATION']];//职业
		    		//文化程度
		    		$marriage=$person->fields['MARRIAGESTATUS'];//婚姻状况
		    		if ($person->fields['RELATION']=='0' && $person->fields['PERSONCODE']==$family_code."01")
		    		{
			    		//开始写入家庭档案
			    		$family=new Tfamily_archive();
						$family->uuid=$family_uuid;
						$family->inner_id=$family_inner_id;
						$family->org_id=$org_id;
						$family->family_number=$family_number;
						$family->householder_id=$householder_id;
						$family->householder_name=$householder_name;
						$family->region_path=$region_path;
						$family->staff_id=$staff_id;
						$family->created=time();
						$family->updated=time();
						$family->insert();
		    		}
		    		//开始写入个人档案
		    		$individual=new Tindividual_core();
					$individual->uuid=$person_uuid;
					$individual->org_id=$org_id;
					$individual->inner_id=$inner_id;
					$individual->region_path=$region_path;
					$individual->name=$name;
					$individual->name_pinyin=$name_pinyin;
					$individual->identity_number=$identity_number;
					$individual->date_of_birth=$date_of_birth;
					$individual->staff_id=$staff_id;
					$individual->response_doctor=$staff_id;
					$individual->address=$address;
					$individual->residence_address=$residence_address_id;
					$individual->family_number=$family_uuid;
					$individual->family_inner_id=$family_inner_id;
					$individual->region_path_inner_id=$region_path_inner_id;
					$individual->relation_holder=$relation_holder;
					$individual->updated=time();
					$individual->phone_number=$phone_number;
					$individual->standard_code_1=$standard_code_2;
					$individual->standard_code_2=$standard_code_2;//手工
					$individual->sex=$sexs;
					$individual->race=$race;
					$individual->created=time();
					//$individual->debugLevel(5);
					$individual->insert();
					//开始写个人记录扩展表
		    		$person->MoveNext();
		    	}
	        }
		    $all_family=count($a);
		    $next_record=$now_record+1;
		    echo "<font color=red>正在导入第{$now_record}个家庭，共{$all_family}个家庭</font>";
	    	echo "<script>

				var pgo=0;

      			function JumpUrl(){

        		if(pgo==0){ location='/iha/import/refresh/record/{$next_record}'; pgo=1; }

      			}

				setTimeout('JumpUrl()',0);

				</script>";
	    	exit;
	    }
	    else 
	    {
	    	$next_record=$now_record+1;
	    	echo "<font color=red>数据错误</font>";
	    	echo "<script>

				var pgo=0;

      			function JumpUrl(){

        		if(pgo==0){ location='/iha/import/refresh/record/{$next_record}'; pgo=1; }

      			}

				setTimeout('JumpUrl()',0);

				</script>";
	    	exit;
	    }
	}
	public function makesqlAction()
	{
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		require_once __SITEROOT.'/library/custom/std_path.php';
		$area_code_array=array("511802","511821","511822","511823","511824","511825","511826","511827");
		foreach ($area_code_array as $v)
		{
			$area_code=$v;
			$array_code_relation=array("0"=>"1","1"=>"2","2"=>"3","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","9"=>"-99");
			$array_code_occupation=array("51"=>"5","52"=>"5","53"=>"5","54"=>"5","59"=>"-99");
			$array_code_marriage=array("1"=>"2","2"=>"1","3"=>"3","4"=>"4","9"=>"-99");
		    $db_person =ADONewConnection('access');
		    $db_family =ADONewConnection('access');
		    $dsn_person = "Driver={Microsoft Access Driver (*.mdb)};Dbq=".realpath(__SITEROOT ."personinfo_$area_code.mdb").";Uid=;Pwd=;";
		    $dsn_family = "Driver={Microsoft Access Driver (*.mdb)};Dbq=".realpath(__SITEROOT ."nhfamily.mdb").";Uid=;Pwd=;";
		    $db_person->Connect($dsn_person);//连接个人档案
		    $db_family->Connect($dsn_family);//连接家庭档案
		    $ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		    //测试生成一个家庭
		    //从家庭档案中读取一个记录
		    $rs = $db_family->Execute("select * from nhfamily where familycode like '$area_code%'");
		    //print $db_family->ErrorMsg();
		    //文件序号
		    $filenum_family=$this->_request->getParam('fnum')?$this->_request->getParam('fnum'):1;
		    $filenum_person=$this->_request->getParam('pnum')?$this->_request->getParam('pnum'):1;
		    $family_file="./sql_family_".$filenum_family."_".$area_code.".sql";
		    $person_file="./sql_person_".$filenum_person."_".$area_code.".sql";
		    //用于存储家庭档案
		    if (!file_exists($family_file))
		    {
		    	$e=fopen($family_file,"wb");
				fputs($e,$ar);
				fclose($e);
				unset($e);
		    }
		    //用于存储个人档案
			if (!file_exists($person_file))
		    {
		    	$e=fopen($person_file,"wb");
				fputs($e,$ar);
				fclose($e);
				unset($e);
		    }
		    //存储SQL
		    $sql_family_content="";//家庭SQL
		    $sql_person_content="";//个人SQL
		    while (!$rs->EOF)
		    {
		        //可以获取家庭档案号、电话号码
		        //生成家庭档案号
		        $family_code=$rs->fields['FAMILYCODE'];
		        $family_uuid=uniqid("f_",true);//家庭档案UUID
		       	$inner_id="1";// 家庭内部序号inner_id
		        $org_id="1";//机构IDorg_id
		        $org_id=$org_doctor[substr($family_code,0,9)]['0'];
		        //$householder_name=$this->get_householder_name($family_code."01",$area_code);//户主姓名householder_name
		        //$region_path="0,1,2,5,71,80,85,92";//区域路径region_path
		        //$staff_id="4c47e3305a70c";//医生ID（建立虚拟医生后自动分配）staff_id
		        //生成该家庭的其他成员信息
		        if ($family_code!="")
		        {
		        	 $householder_id="";
		        	 $householder_code="";
			         $person=$db_person->Execute("select * from personinfo where PERSONCODE like '$family_code%' order by PERSONCODE asc");
			         while (!$person->EOF)
			    	{
			    		//根据结果一次生成信息
			    		$org_id=$org_doctor[substr($person->fields['PERSONCODE'],0,9)]['0'];
			    		$person_uuid=uniqid("i_",true);//个人档案表中的UUID
			    		$inner_id=substr($person->fields['PERSONCODE'],-2,2);//家庭内部流水号inner_id
			    		$region_path=$std_path[substr($person->fields['PERSONCODE'],0,14)]['1'];//行政区域路径region_path
			    		$name=str_replace(" ","",iconv("gb2312","utf-8//IGNORE",$person->fields['PERSONNAME']));//姓名name
			    		$name_pinyin=getPinyin($name);//姓名拼音name_pinyin
			    		$identity_number=$person->fields['CERTID'];//身份证号identity_number
			    		$date_of_birth=mkunixstamp($person->fields['OBD']);//生日date_of_birth
			    		$staff_id=$org_doctor[substr($person->fields['PERSONCODE'],0,9)]['1'];//医生ID（建立虚拟医生后自动分配）staff_id
			    		$response_doctor=$staff_id;//责任医生（同医生ID）response_doctor
			    		$address=$std_path[substr($person->fields['PERSONCODE'],0,14)]['0'];//现住址（access中无此字段，需生成）address
			    		$residence_address_id=$address;//residence_address_id
			    		$family_number=$family_uuid;//家庭档案号（家庭档案中的UUID）family_number
			    		$family_inner_id=substr($person->fields['PERSONCODE'],-6,4);//家庭内部序号family_inner_id
			    		$region_path_inner_id="";//标档案中的流水号region_path_inner_id
			    		$relation_holder=$array_code_relation[$person->fields['RELATION']];//与户主关系relation_holder
			    		$phone_number=$rs->fields['TEL'];//本人联系电话phone_number
			    		$standard_code_1="";//国家标准档案号standard_code_1
			    		$standard_code_2=$person->fields['PERSONCODE'];//省标准档案号standard_code_2
			    		$standard_code_2=substr($standard_code_2,0,6)."-".substr($standard_code_2,6,3)."-".substr($standard_code_2,9,3)."-".substr($standard_code_2,12,2)."-".substr($standard_code_2,14,4)."-".substr($standard_code_2,-2,2);
			    		if ($person->fields['RELATION']=='0' && $person->fields['PERSONCODE']==$family_code."01")
			    		{
			    			$householder_id=$person_uuid;//初始化户主的个人档案号
			    			$householder_code=$person->fields['PERSONCODE'];
							$householder_names=str_replace(" ","",iconv("gb2312","utf-8//IGNORE",$person->fields['PERSONNAME']));
			    		}
			    		//户主的个人档案号（根据所读取到的家庭档案记录加01生成个人档案号）householder_id
			    		//$householder_name=$this->get_householder_name($householder_code,$area_code);//户主姓名（个人表中读取
						$householder_name=$householder_names;//户主姓名（个人表中读取
			    		$race="1";//民族
			    		$sexs=array_code_change($person->fields['SEX'],$sex);//性别
			    		$occupation=$array_code_occupation[$person->fields['OCCUPATION']];//职业
			    		//文化程度
			    		$marriage=$array_code_marriage[$person->fields['MARRIAGESTATUS']];//婚姻状况
			    		if ($person->fields['RELATION']=='0' && $person->fields['PERSONCODE']==$family_code."01")
			    		{
							if (strlen($sql_family_content)>=1024*50000)
							{
								$sql_family_content=substr($sql_family_content,0,-1);
								//写入文件
								file_put_contents($family_file,$sql_family_content);
								//大于1M创建新文件
								$filenum_family=$filenum_family+1;
								$family_file="./sql_family_".$filenum_family."_".$area_code.".sql";
								$e=fopen($family_file,"wb");
								fputs($e,$ar);
								fclose($e);
								unset($e);
								$sql_family_content="";//家庭SQL
							}
							else 
							{
	//							if (strpos($sql_family_content,"insert")!==false)
	//							{
	//								//存在insert则不加insert
	//								$sql_family_content.=" ('$family_uuid','$family_inner_id','$org_id','$family_number','$householder_id','$householder_name','$region_path','$staff_id','".time()."','".time()."');"."\r\n";
	//							}
	//							else 
	//							{
									$sql_family_content.="insert into family_archive (uuid,inner_id,org_id,family_number,householder_id,householder_name,region_path,staff_id,created,updated) values ";
									$sql_family_content.=" ('$family_uuid','$family_inner_id','$org_id','$family_number','$householder_id','$householder_name','$region_path','$staff_id','".time()."','".time()."');"."\r\n";
								//}
							}
							
			    		}
			    		//开始写入个人档案
			    		if (strlen($sql_person_content)>=1024*50000)
							{
								//写入文件
								$sql_person_content=substr($sql_person_content,0,-1);
								file_put_contents($person_file,$sql_person_content);
								//大于1M创建新文件
								$filenum_person=$filenum_person+1;
		    					$person_file="./sql_person_".$filenum_person."_".$area_code.".sql";
								$e=fopen($person_file,"wb");
								fputs($e,$ar);
								fclose($e);
								unset($e);
								//刷新页面
								$sql_person_content="";//个人SQL
							}
							else 
							{
	//							if (strpos($sql_person_content,"insert")!==false)
	//							{
	//								//存在insert则不加insert
	//								$sql_person_content.=" ('$person_uuid','$org_id','$inner_id','$region_path','$name','$name_pinyin','$identity_number','$date_of_birth','$staff_id','$staff_id','$address','$residence_address_id','$family_uuid','$family_inner_id','$region_path_inner_id','$relation_holder','".time()."','$phone_number','$standard_code_2','$standard_code_2','$sexs','$race','".time()."');"."\r\n";
	//							}
	//							else 
	//							{
									$sql_person_content.="insert into individual_core (uuid,org_id,inner_id,region_path,name,name_pinyin,identity_number,date_of_birth,staff_id,response_doctor,address,residence_address,family_number,family_inner_id,region_path_inner_id,relation_holder,updated,phone_number,standard_code_1,standard_code_2,sex,race,created) values ";
									$sql_person_content.=" ('$person_uuid','$org_id','$inner_id','$region_path','$name','$name_pinyin','$identity_number','$date_of_birth','$staff_id','$staff_id','$address','$residence_address_id','$family_uuid','$family_inner_id','$region_path_inner_id','$relation_holder','".time()."','$phone_number','$standard_code_2','$standard_code_2','$sexs','$race','".time()."');"."\r\n";
									$sql_person_content.="insert into individual_archive (uuid,org_id,id,staff_id,created,updated,marriage,occupation) values ";
									$sql_person_content.="('".uniqid("i_",true)."','$org_id','$person_uuid','$staff_id','".time()."','".time()."','$marriage','$occupation');"."\r\n";
								//}
							}
						//开始写个人记录扩展表
			    		$person->MoveNext();
			    	}
		        }
		        $rs->MoveNext();
		    }
			//将小于规定的数据即遗留数据写入文件
		    if ($sql_person_content!="")
				{
					//写入文件
					$sql_person_content=substr($sql_person_content,0,-1);
					file_put_contents($person_file,$sql_person_content);
					$sql_person_content="";
				}
		    if ($sql_family_content!="")
				{
					$sql_family_content=substr($sql_family_content,0,-1);
					//写入文件
					file_put_contents($family_file,$sql_family_content);
					$sql_family_content="";
				}
		}
	}
	/**
	 * 处理庐山龙门的数据
	 */
	public function doforlushanAction()
	{
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/family_archive.php";
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		require_once __SITEROOT.'/library/custom/std_path.php';
		//取庐山龙门的数据，包含个人档案号，家庭档案号，省标
		$core=new Tindividual_core();
		$core->whereAdd("standard_code_2 like '511826%'");
		$core->whereAdd("region_path is null");
		$core->find();
		//$archive=array();
		//$i=0;
		while ($core->fetch())
		{
			//取出不完整档案数组
			//$archive[$i]['uuid']=$core->uuid;
			//$archive[$i]['family_number']=$core->family_number;
			//$archive[$i]['standard_code']=$core->standard_code_2;
			//$i++;
			//还原region_path
			$path_code=str_replace("-","",substr($core->standard_code_2,0,17));
			$individual_core=new Tindividual_core();
			$individual_core->region_path=$std_path[$path_code]['1'];
			$individual_core->address=$std_path[$path_code]['0'];;
			$individual_core->residence_address=$std_path[$path_code]['0'];;
			$individual_core->whereAdd("uuid = '".$core->uuid."'");
			if (isset($std_path[$path_code]['1']) && $std_path[$path_code]['1']!="")
			{
				$individual_core->update();
				//更新家庭档案
				$family_archive=new Tfamily_archive();
				$family_archive->region_path=$std_path[$path_code]['1'];
				$family_archive->whereAdd("family_number = '".$core->family_number."'");
				$family_archive->update();
			}
		}
		
	}
	/**
	 * 刷新所有的档案完整率
	 */
	public function rateAction()
	{
		require_once __SITEROOT."library/Models/standard_archive_rate.php";
		//取所有个人档案
		$core=new Tindividual_core();
		//$core->whereAdd("criteria_rate is null");
		$core->whereAdd("standard_code_1 like '511802%'");
//		$core->whereAdd("standard_code_1 like '511821%'");
//		$core->whereAdd("standard_code_1 like '511822%'");
//		$core->whereAdd("standard_code_1 like '511823%'");
//		$core->whereAdd("standard_code_1 like '511824%'");
//		$core->whereAdd("standard_code_1 like '511825%'");
//		$core->whereAdd("standard_code_1 like '511826%'");
//		$core->whereAdd("standard_code_1 like '511827%'");
		$core->find();
		while ($core->fetch())
		{
			$uuid=$core->uuid;
			//计算档案完整率
			$region_path_array=explode(",",$core->region_path,5);
			//取到市级path
			$region_path=$region_path_array['0'].",".$region_path_array['1'].",".$region_path_array['2'].",".$region_path_array['3'];
			//取所有表名
			$standard_archive_rate=new Tstandard_archive_rate();
			$standard_archive_rate->whereAdd("module_name = 'individual_core'");//个人档案模块
			$standard_archive_rate->whereAdd("region_path='$region_path'");
			//$standard_archive_rate->whereAdd("criteria='1'");
			$standard_archive_rate->selectAdd("table_name as table_name");
			//$standard_archive_rate->debugLevel(5);
			$standard_archive_rate->groupBy("table_name");
			$standard_archive_rate->find();
			while ($standard_archive_rate->fetch())
				{
					//排除自己
					if($standard_archive_rate->table_name!="individual_core")
					{
						require_once __SITEROOT."/library/Models/".$standard_archive_rate->table_name.".php";
						$temp=$standard_archive_rate->table_name;
						$t="T$temp";
						$$temp=new $t;
						$$temp->whereAdd("id='$uuid'");
						$$temp->find(true);
					}
					else 
					{
						require_once __SITEROOT."/library/Models/".$standard_archive_rate->table_name.".php";
						$temp=$standard_archive_rate->table_name;
						$t="T$temp";
						$$temp=new $t;
						$$temp->whereAdd("uuid='$uuid'");
						$$temp->find(true);
					}
				}
					
			$standard_archive_rate=new Tstandard_archive_rate();
			//取本模块的所有必填字段数组
			$standard_archive_rate->whereAdd("module_name = 'individual_core'");//个人档案模块
			$standard_archive_rate->whereAdd("region_path='$region_path'");
			$standard_archive_rate->whereAdd("criteria='1'");
			$nums_rate=0;
			$nums_rate=$standard_archive_rate->count();//所有字段
			$standard_archive_rate->find();
			$nums_rate_true=0;//已填写字段数
			while ($standard_archive_rate->fetch())
			{
				$table_name=$standard_archive_rate->table_name;
				$column_name=$standard_archive_rate->column_name;
				if (@isset($$table_name->$column_name) && $$table_name->$column_name)
				{
					$nums_rate_true++;
				}
			}
			$rate=@round($nums_rate_true/$nums_rate,4);
			$core_all=new Tindividual_core();
			$core_all->criteria_rate=$rate;
			$core_all->whereAdd("uuid='$uuid'");
			$core_all->update();
		}
	}
	/**
	 * 导入天全城厢镇和向阳和正西
	 */
	public function exporttqAction()
	{
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		require_once __SITEROOT.'/library/custom/std_path.php';
		$area_code_array=array("511825");
		foreach ($area_code_array as $v)
		{
			$area_code=$v;
		    //文件序号
		    $filenum_family=$this->_request->getParam('fnum')?$this->_request->getParam('fnum'):1;
		    $filenum_person=$this->_request->getParam('pnum')?$this->_request->getParam('pnum'):1;
		    $family_file="./sql_family_".$filenum_family."_".$area_code.".sql";
		    $person_file="./sql_person_".$filenum_person."_".$area_code.".sql";
		    //用于存储家庭档案
		    if (!file_exists($family_file))
		    {
		    	$e=fopen($family_file,"wb");
				fputs($e,$ar);
				fclose($e);
				unset($e);
		    }
		    //用于存储个人档案
			if (!file_exists($person_file))
		    {
		    	$e=fopen($person_file,"wb");
				fputs($e,$ar);
				fclose($e);
				unset($e);
		    }
			//取向阳下所有街道数组
			$region=new Tregion();
			$region->whereAdd("p_id='17885' or (p_id='17888' and (zh_name='小黄铜街' or zh_name='大黄铜街'))");
			$region->find();
			$region_array=array();
			while ($region->fetch())
			{
				$region_array[$region->zh_name]['standard_code']=$region->standard_code;
				$region_array[$region->zh_name]['region_path']=$region->region_path;
				$region_array[$region->zh_name]['family_number']=1;//用于该地区下的家庭计数
			}
		    //存储SQL
		    $sql_family_content="";//家庭SQL
		    $sql_person_content="";//个人SQL
		    $handle = fopen("./xy.csv","r");
		    $town="城厢镇";
		    $people=array();
		    $i=0;
			while ($data = fgetcsv($handle, 1000, ",")) {
				if ($i>0)
				{
				    $people[$i]['name']=$data[0];
				    $people[$i]['card']=$data[1];
				    $people[$i]['street']=str_replace($town,"",$data[3]);
				    $people[$i]['door']=$this->trans($data[4]);
				    $people[$i]['door_bak']=$this->trans($data[5]);
				    $people[$i]['sex']=$data[8];
				    $people[$i]['race']=$data[9];
				    $people[$i]['birthday']=$data[10];
				    $region_path=$region_array[$people[$i]['street']]['region_path'];//行政区域路径region_path--根据名字取地址
				    if ($region_path)
				    {
					    $region_array[$people[$i]['street']]['family_number']++;
					    //一人一个家庭
					    $family_number=$area_code."301100".$region_array[$people[$i]['street']]['standard_code'].sprintf("%04d", $region_array[$people[$i]['street']]['family_number']);
					    $inner_id="01";// 家庭内部序号inner_id
			       	 	$org_id="95";//机构IDorg_id
			       	 	$family_uuid=uniqid("f_",true);//家庭档案UUID
				    	$householder_id="";
				       	$householder_code="";
					    //根据结果一次生成信息
					    $person_uuid=uniqid("i_",true);//个人档案表中的UUID
					    $inner_id="01";//家庭内部流水号inner_id,全部为户主所以家庭内部全部为01
					    $name=$people[$i]['name'];//姓名name
					    $name_pinyin=getPinyin($name);//姓名拼音name_pinyin
					    $identity_number=$people[$i]['card'];//身份证号identity_number
					    $date_of_birth=mkunixstamp(substr($people[$i]['birthday'],0,4)."-".substr($people[$i]['birthday'],4,2)."-".substr($people[$i]['birthday'],6,2));//生日date_of_birth
					    $staff_id='4c7334185d294';//医生ID（建立虚拟医生后自动分配）staff_id  周冬梅
					    $response_doctor=$staff_id;//责任医生（同医生ID）response_doctor
					    $address=$town.$people[$i]['street'].$people[$i]['door'].$people[$i]['door_bak'];//现住址（access中无此字段，需生成）address
					    $residence_address_id=$address;//residence_address_id
					    $family_number=$family_uuid;//家庭档案号（家庭档案中的UUID）family_number
					    $family_inner_id=$inner_id;//家庭内部序号family_inner_id
					    $region_path_inner_id="";//标档案中的流水号region_path_inner_id
					    $relation_holder="1";//与户主关系relation_holder
					    $phone_number="";//本人联系电话phone_number
					    $standard_code_1="";//国家标准档案号standard_code_1
					    $standard_code_2=$area_code."301100".$region_array[$people[$i]['street']]['standard_code'].sprintf("%04d", $region_array[$people[$i]['street']]['family_number'])."01";//省标准档案号standard_code_2
					    $standard_code_2=substr($standard_code_2,0,6)."-".substr($standard_code_2,6,3)."-".substr($standard_code_2,9,3)."-".substr($standard_code_2,12,2)."-".substr($standard_code_2,14,4)."-".substr($standard_code_2,-2,2);
					    $householder_id=$person_uuid;//初始化户主的个人档案号
				    	$householder_code=$area_code."301100".$region_array[$people[$i]['street']]['standard_code'].sprintf("%04d", $region_array[$people[$i]['street']]['family_number'])."01";
						$householder_names=$name;
						$householder_name=$householder_names;//户主姓名（个人表中读取
					    $race="1";//民族
					    $sex=array('未知的性别'=>'1','男'=>'2','女'=>'3','未说明的性别'=>'4');
					    $sexs=$sex[$people[$i]['sex']];//性别
					    $occupation="";//职业
					    //文化程度
					    $marriage="";//婚姻状况
						if (strlen($sql_family_content)>=1024*50000)
						{
							$sql_family_content=substr($sql_family_content,0,-1);
							//写入文件
							file_put_contents($family_file,$sql_family_content);
							//大于1M创建新文件
							$filenum_family=$filenum_family+1;
							$family_file="./sql_family_".$filenum_family."_".$area_code.".sql";
							$e=fopen($family_file,"wb");
							fputs($e,$ar);
							fclose($e);
							unset($e);
							$sql_family_content="";//家庭SQL
						}
						else 
						{
//							if (strpos($sql_family_content,"insert")!==false)
//							{
//								//存在insert则不加insert
//								$sql_family_content.=" ('$family_uuid','$family_inner_id','$org_id','$family_number','$householder_id','$householder_name','$region_path','$staff_id','1111','".time()."'),"."\r\n";
//							}
//							else 
//							{
								$sql_family_content.="insert into family_archive (uuid,inner_id,org_id,family_number,householder_id,householder_name,region_path,staff_id,created,updated) values ";
								$sql_family_content.=" ('$family_uuid','$family_inner_id','$org_id','$family_number','$householder_id','$householder_name','$region_path','$staff_id','1111','".time()."');"."\r\n";
//							}
						}
					    //开始写入个人档案
					    if (strlen($sql_person_content)>=1024*50000)
						{
							//写入文件
							$sql_person_content=substr($sql_person_content,0,-1);
							file_put_contents($person_file,$sql_person_content);
							//大于1M创建新文件
							$filenum_person=$filenum_person+1;
				    		$person_file="./sql_person_".$filenum_person."_".$area_code.".sql";
							$e=fopen($person_file,"wb");
							fputs($e,$ar);
							fclose($e);
							unset($e);
							//刷新页面
							$sql_person_content="";//个人SQL
						}
						else 
						{
							$sql_person_content.="insert into individual_core (uuid,org_id,inner_id,region_path,name,name_pinyin,identity_number,date_of_birth,staff_id,response_doctor,address,residence_address,family_number,family_inner_id,region_path_inner_id,relation_holder,updated,phone_number,standard_code_1,standard_code_2,sex,race,created) values ";
							$sql_person_content.=" ('$person_uuid','$org_id','$inner_id','$region_path','$name','$name_pinyin','$identity_number','$date_of_birth','$staff_id','$staff_id','$address','$residence_address_id','$family_uuid','$family_inner_id','$region_path_inner_id','$relation_holder','".time()."','$phone_number','$standard_code_2','$standard_code_2','$sexs','$race','1111');"."\r\n";
							$sql_person_content.="insert into individual_archive (uuid,org_id,id,staff_id,created,updated,marriage,occupation) values ";
							$sql_person_content.="('".uniqid("i_",true)."','$org_id','$person_uuid','$staff_id','1111','".time()."','$marriage','$occupation');"."\r\n";
					    }
				    }
				}
				$i++;			         
			}
			fclose($handle);
			//生成家庭档案号
		    //城厢镇 100
		    //向阳301
			//将小于规定的数据即遗留数据写入文件
		    if ($sql_person_content!="")
				{
					//写入文件
					$sql_person_content=substr($sql_person_content,0,-1);
					file_put_contents($person_file,$sql_person_content);
					$sql_person_content="";
				}
		    if ($sql_family_content!="")
				{
					$sql_family_content=substr($sql_family_content,0,-1);
					//写入文件
					file_put_contents($family_file,$sql_family_content);
					$sql_family_content="";
				}
		}
		print_r($region_array);
	}
    public function raceAction()
    {
        $races=array('2'=>array('2','蒙古族'),'3'=>array('3','回族'),'4'=>array('4','藏族'),'5'=>array('5','维吾尔族'),'6'=>array('6','苗族'),'7'=>array('7','彝族'),'8'=>array('8','壮族'),'9'=>array('9','布依族'),'10'=>array('10','朝鲜族'),'11'=>array('11','满族'),'12'=>array('12','侗族'),'13'=>array('13','瑶族'),'14'=>array('14','白族'),'15'=>array('15','土家族'),'16'=>array('16','哈尼族'),'17'=>array('17','哈萨克族'),'18'=>array('18','傣族'),'19'=>array('19','黎族'),'20'=>array('20','傈傈族'),'21'=>array('21','佤族'),'22'=>array('22','畲族'),'23'=>array('23','高山族'),'24'=>array('24','拉祜族'),'25'=>array('25','水族'),'26'=>array('26','东乡族'),'27'=>array('27','纳西族'),'28'=>array('28','景颇族'),'29'=>array('29','柯尔克孜族'),'30'=>array('30','土族'),'31'=>array('31','达斡尔族'),'32'=>array('32','仫佬族'),'33'=>array('33','羌族'),'34'=>array('34','布朗族'),'35'=>array('35','撒拉族'),'36'=>array('36','毛难族'),'37'=>array('37','仡佬族'),'38'=>array('38','锡伯族'),'39'=>array('39','阿昌族'),'40'=>array('40','普米族'),'41'=>array('41','塔吉克族'),'42'=>array('42','怒族'),'43'=>array('43','乌孜别克族'),'44'=>array('44','俄罗斯族'),'45'=>array('45','鄂温克族'),'46'=>array('46','德昂族'),'47'=>array('47','保安族'),'48'=>array('48','裕固族'),'49'=>array('49','京族'),'50'=>array('50','塔塔尔族'),'51'=>array('51','独龙族'),'52'=>array('52','鄂伦春族'),'53'=>array('53','赫哲族'),'54'=>array('54','门巴族'),'55'=>array('55','珞巴族'),'56'=>array('56','基诺族'));
    require_once __SITEROOT . "library/Models/standard_code.php";
    }
	private function trans($tags)
	{
		$tags = iconv('utf-8', 'gbk', $tags);
		$tags = preg_replace('/\xa3([\xa1-\xfe])/e', 'chr(ord(\1)-0x80)', $tags);
		$tags = iconv('gbk','utf-8', $tags);
		return $tags;
	}
	public function get_householder_name($uuid,$area_code)
	{
		$db_person =ADONewConnection('access');
	    $dsn_person = "Driver={Microsoft Access Driver (*.mdb)};Dbq=".realpath(__SITEROOT ."personinfo_$area_code.mdb").";Uid=;Pwd=;";
	    $db_person->Connect($dsn_person);//连接个人档案
	    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	    //测试生成一个家庭
	    //从家庭档案中读取一个记录
	    $rs = $db_person->Execute("select * from personinfo where personcode='$uuid'");
	    //print $db_family->ErrorMsg();
	    while (!$rs->EOF)
	    {
	    	return str_replace(" ","",iconv("gb2312","utf-8//IGNORE",$rs->fields['PERSONNAME']));
	    }
	}
    
    //导入社区系统数据开始
    
    public function importsqAction()
    {
        $this->view->assign('region_id',$this->user['region_id']);
		$this->view->assign('region_p_id',$this->user['region_id']);
        $this->view->display("importsq.html");
    }
    //获取机构
    public function getsqAction()
    {
        $dbhost=$this->_request->getParam("dbhost");
        $dbname=$this->_request->getParam("dbname");
        $dbuser=$this->_request->getParam("dbuser");
        $dbpassword=$this->_request->getParam("dbpassword");
        if($dbhost && $dbname && $dbuser && $dbpassword)
        {
            $db=mysql_connect($dbhost,$dbuser,$dbpassword);
            if($db)
            {
                if(mysql_select_db($dbname,$db))
                {
                    mysql_query("set names utf8");
                    $result=mysql_query("select `chsc_id`,`chsc_name` from `chs_center`");
                    $st="<select name='sqnamelist' id='sqnamelist' onchange='changesqid(this.value)'><option>请选择</option>";
                    while($rd=mysql_fetch_array($result))
                    {
                        $st.="<option value='".$rd['chsc_id']."'>".$rd['chsc_name']."</option>";
                    }
                    $st.="</select>";
                    echo "ok|".$st;
                }
                else
                {
                    echo "select_db_error";
                    exit;
                }
                
            }
            else
            {
                echo "db_error";
                exit;
            }
        }
        else
        {
            echo "no_space";
            exit;
        }
    }
    //验证机构
    public function verfysqAction()
    {
        $dbhost=$this->_request->getParam("dbhost");
        $dbname=$this->_request->getParam("dbname");
        $dbuser=$this->_request->getParam("dbuser");
        $dbpassword=$this->_request->getParam("dbpassword");
        $chsc_id=$this->_request->getParam("chsc_id");
        if($dbhost && $dbname && $dbuser && $dbpassword && $chsc_id)
        {
            $db=mysql_connect($dbhost,$dbuser,$dbpassword);
            if($db)
            {
                if(mysql_select_db($dbname,$db))
                {
                    mysql_query("set names utf8");
                    $result=mysql_query("select `chsc_id`,`chsc_name` from `chs_center` where `uuid`='$chsc_id' limit 1");
                    $rd=mysql_fetch_array($result);
                    echo "ok|您即将导入的社区名称为：【".$rd['chsc_name']."】,请点击下一步之前，确认。";
                    exit;
                }
                else
                {
                    echo "select_db_error";
                    exit;
                }
                
            }
            else
            {
                echo "db_error";
                exit;
            }
        }
        else
        {
            echo "no_space";
            exit;
        }
    }
    //导入数据，每次导入500条,这种只能导入身份证符合规范的
    public function importsqoldAction()
    {
        $dbhost=$this->_request->getParam("dbhost");
        $dbname=$this->_request->getParam("dbname");
        $dbuser=$this->_request->getParam("dbuser");
        $dbpassword=$this->_request->getParam("dbpassword");
        $chsc_id=$this->_request->getParam("chsc_id");
        $region_id=$this->_request->getParam("region_id");
        $region_p_id=$this->_request->getParam("region_p_id");
        $house_status=$this->_request->getParam("house_status");
        $nums=intval($this->_request->getParam("nums"));//序号，每次叠加100
        $config=array();
        if($nums && file_exists(__SITEROOT."cache/importsq.php"))
        {
            require_once __SITEROOT."cache/importsq.php";
            $dbhost=$a['dbhost'];
            $dbname=$a['dbname'];
            $dbuser=$a['dbuser'];
            $dbpassword=$a['dbpassword'];
            $chsc_id=$a['chsc_id'];
            $region_id=$a['region_id'];
            $region_p_id=$a['region_p_id'];
        }
        else
        {
            $config['dbhost']=$dbhost;
            $config['dbname']=$dbname;
            $config['dbuser']=$dbuser;
            $config['dbpassword']=$dbpassword;
            $config['chsc_id']=$chsc_id;
            $config['region_id']=$region_id;
            $config['region_p_id']=$region_p_id;
            $this->create_cache(__SITEROOT."cache/importsq.php",$config);
        }
        
        if($house_status)
        {
            $tmp_house=" and `relation_of_householder`='0' and `status_flag`='1'";
        }
        else
        {
            $tmp_house=" and `relation_of_householder`!='0' and `relation_of_householder`!='20' and `status_flag`='1'";
        }
        if($region_id==$region_p_id)
        {
            echo "选择的初始地区错误，请正确选择初始地区，否则导入数据将不可用";
            exit;
        }
        
        require_once(__SITEROOT.'library/custom/region_array.php');
        if($dbhost && $dbname && $dbuser && $dbpassword && $chsc_id && $region_p_id)
        {
            $db=mysql_connect($dbhost,$dbuser,$dbpassword);
            if($db)
            {
                if(mysql_select_db($dbname,$db))
                {
                    mysql_query("set names utf8");
                    //取总记录数
                    if($house_status)
                    {
                        $rn=mysql_query("select * from `ha_individual_info` where `relation_of_householder`='0' and `status_flag`='1'");
                    }
                    else
                    {
                        $rn=mysql_query("select * from `ha_individual_info` where `relation_of_householder`!='0' and `relation_of_householder`!='20' and `status_flag`='1'");
                    }
                    $total=mysql_num_rows($rn);
                    //从mysql去500条记录出来
                    $result=mysql_query("select * from `ha_individual_info` where `chsc_id`='$chsc_id' and `relation_of_householder`!='20' ".$tmp_house." limit ".$nums.",100");
                    while($rd=mysql_fetch_array($result))
                    {
                        //取到身份证号，对比系统中，是否有此人,不存在此人则新增加
                        $identity_number=$rd['identity_card_number'];
                        $core=new Tindividual_core();
                        $core->whereAdd("identity_number='$identity_number'");
                        if(!$core->count('uuid') && strlen($identity_number)>=15)
                        {
                             $core->free_statement();
                             //产生新的个人档案号
    			             $uuid=uniqid('i_',true);
                             $name=$rd['name'];
                             $namePinyin=$rd['name_pinyin']?$rd['name_pinyin']:@getPinyin($name);
                             $data_of_birth=strlen($identity_number)==18?substr($identity_number,6,8):'19'.substr($identity_number,6,6);
                    		 $data_of_birth=$rd['date_of_birth']?$rd['date_of_birth']:($data_of_birth);
                             $address=str_replace("--","",$rd['family_address']);
                    		 $residence_address=str_replace("--","",$rd['family_address']);
                    		 $phone_number=str_replace("--","",$rd['telephone_number']);
                    		 $staff_id=$this->user['uuid'];
                    		 $org_id=$this->user['org_id'];
                    		 //自定义编号
                    		 $standard_code=$rd['sn_self_define'];
                             $region_last_id=$region_p_id;
                             $regionPath=$regionInfo[$region_last_id]['2'];
                    		 $temp=explode(',',$regionPath);
                    		 //获取从县级到街道，居委会，小区的编码
                    		 $region_id_1=$temp[4];
                    		 $region_id_2=$temp[5];
                    		 $region_id_3=$temp[6];
                    		 $region_id_4=$temp[7];
                    		 //$regionPath1是用于生成国标档案号的
                    		 $regionPath1=$regionInfo[$region_id_3]['2'];
                    		 $relation_of_householder=$rd['relation_of_householder'];
                    		 $response_doctor=$this->user['uuid'];
                    		 $archive_doctor=$this->user['uuid'];
                    		 //建档时间
                    		 $filing_time=$rd['created']?$rd['created']:time();
                             $relation=array(0=>"1",1=>"2",2=>"3",3=>"4",4=>"5",5=>"6",6=>"7",7=>"8",8=>"8",9=>"8",10=>"8","0308"=>"3","0208"=>"2","0408"=>"4");
                             //家庭档案
                             //户主，新建家庭
                            $family=new Tfamily_archive();
                			$family->selectAdd('max(inner_id) as inner_id');
                			//按省标，是到最后一级区域的流水号
                			$family->whereAdd("region_path='$regionPath'");
                			$family->find(true);
                			$familyInnerId=$family->inner_id+1;
                			$familyInnerId=@str_repeat('0',4-strlen($familyInnerId)).$familyInnerId;
                            $family_address=$family->family_address;
                            $family->free_statement();
                             if($rd['relation_of_householder']=="0")
                             {
                    			//保存数据 家庭档案数据
                    			$family=new Tfamily_archive();
                    			$family_number=$family->family_number=$family->uuid=uniqid('f_',true);
                    			$family->inner_id=$familyInnerId;
                    			$family->org_id=$org_id;
                    			$family->inner_id=$familyInnerId;
                                $family->family_address=$family_address;
                                $family->telephone_number=$phone_number;
                    			$family->householder_id=$uuid;
                    			$family->householder_name=$name;
                    			$family->region_path=$regionPath;
                    			$family->staff_id=$archive_doctor;
                                $family->deleted=0;
                                $family->status_flag=1;
                    			$family->created=time();
                    			$family->updated=time();
                    			$family->insert();
                                $family->free_statement();
                             }
                             else
                             {
                                //查询自己的family_number,根据户主ID查询
                                $family_number="";
                                $fr=mysql_query("select `identity_card_number` from `ha_individual_info` where `family_number`='".$rd['family_number']."' and `relation_of_householder`='0' limit 1");
                                $fd=mysql_fetch_array($fr);
                                if($fd['identity_card_number'] && strlen($identity_number)>=15)
                                {
                                    $individual=new Tindividual_core();
                        			$individual->whereAdd("identity_number='".$fd['identity_card_number']."'");
                        			$individual->find(true);
                                    $family_number=$individual->family_number;
                                    $individual->free_statement();
                                }
                                else
                                {
                                    //无身份证数据
                                }
                             }
                             //个人档案核心表
                             if($rd['relation_of_householder']=="0")
                             {
                    			$individualInnerId='01';
              		         }
                    		//获取人个档案号流水号 非户主
                    		if($rd['relation_of_householder']!="0" && $family_number)
                            {
                    			$individual=new Tindividual_core();
                    			$individual->whereAdd("family_number='$family_number'");
                    			$individual->orderby('inner_id desc');
                    			$individual->limit(0,1);
                    			//$individual->debugLevel(9);
                    			$individual->find(true);
                    			//echo $individual->inner_id."|";
                    			$individualInnerId=$individual->inner_id+1;
                    			//echo $individualInnerId."|";
                    			$individualInnerId=str_repeat('0',2-strlen($individualInnerId)).$individualInnerId;
                                $individual->free_statement();
                    		}
                            //获取到家庭号，出入数据，否则排除
                            if($family_number)
                            {
                               //获取国标档案编码流水号
                        		$region_path_inner_id=$this->_request->getParam('region_path_inner_id','');
                    			$individual=new Tindividual_core();
                    			$individual->selectAdd('max(region_path_inner_id) as region_path_inner_id');
                    			//注意这是里是$regionPath1
                    			$individual->whereAdd("region_path like '$regionPath1%'");
                    			$individual->find(true);
                    			if($individual->region_path_inner_id!=''){
                    				$region_path_inner_id=$individual->region_path_inner_id+1;
                    			}else{
                    				$region_path_inner_id=1;
                    			}
                    			$region_path_inner_id=str_repeat('0',5-strlen($region_path_inner_id)).$region_path_inner_id;
                    			//国标档案号 2011－1－27号出现的档案号重的问题就出在这里
                    			$std1=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.substr($regionInfo[$region_id_3]['1'],1,2).'-'.$region_path_inner_id;
                    			//省标档案号
                    			$std2=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.$regionInfo[$region_id_3]['1'].'-'.$regionInfo[$region_id_4]['1'].'-'.$familyInnerId.'-'.$individualInnerId;
                                $individual->free_statement();
                        		//插入个人档案数据
                        		$individual=new Tindividual_core();
                        		$individual->uuid=$uuid;
                                $individual->sex=$rd['sex'];
                        		$individual->inner_id=$individualInnerId;
                        		$individual->region_path=$regionPath;
                        		$individual->name=$name;
                        		$individual->name_pinyin=$namePinyin;
                        		$individual->identity_number=$identity_number;
                        		$individual->date_of_birth=intval($data_of_birth);
                       			$individual->org_id=$org_id;
                       			$individual->staff_id=$archive_doctor;
                       			$individual->response_doctor=$response_doctor;
                        		$individual->address=$address;
                        		$individual->residence_address=$address;
                        		$individual->family_number=$family_number;
                        		$individual->family_inner_id=intval($familyInnerId);
                        		$individual->region_path_inner_id=intval($region_path_inner_id);
                        		$individual->relation_holder=$relation[$relation_of_householder];
                        		$individual->inner_id=$individualInnerId;
                        		$individual->filing_time=$filing_time;
                       			$individual->created=$individual->updated=time();
                        		$individual->phone_number=str_replace("--","",$phone_number);
                        		$individual->standard_code=$standard_code;//手工
                        		$individual->standard_code_1=$std1;//国标
                       			$individual->standard_code_2=$std2;//省标
                    			if($family_number && !$individual->insert())
                                {
                                    $individual->free_statement;
                    				exit("写入个人表失败".$name);
                    			}
                                else
                                {
                                    $individual->free_statement();
                                    //个人档案扩展表
                                    $individual_archive=new Tindividual_archive();
                                    $individual_archive->nationality=$rd['nationality'];//国籍
                                    $individual_archive->native_place=$rd['native_place'];//籍贯
                                    $individual_archive->reside_place=$rd['reside_place'];//居住地区
                                    $individual_archive->reside_time=intval($rd['reside_time']);//居住年限
                                    $individual_archive->contact="";
                                    $individual_archive->contact_number=str_replace("--","",$rd['telephone_number']);
                                    $individual_archive->family_address=str_replace("--","",$rd['family_address']);
                                    $individual_archive->uuid=uniqid("i_",true);
                                    $individual_archive->id=$uuid;
                                    $individual_archive->org_id=$org_id;
         			                $individual_archive->staff_id=$archive_doctor;
                                    $individual_archive->insert();
                                    $individual_archive->free_statement();
                                } 
                            }
                    		
                        }
                        
                    }
                    //导入完成调整页面
                    if($nums<$total)
                    {
                        $tmp_url=__BASEPATH."iha/import/importsqstepone/nums/".($nums+100)."/house_status/".$house_status;
                        $url=array("快速导入下一组"=>$tmp_url);
				        message("已导入".($nums+100)."条数据，请不要关闭浏览器,页面将自动跳转",$url,$tmp_url); 
                    }
                    else
                    {
                        if(is_file(__SITEROOT."cache/importsq.php") && file_exists(__SITEROOT."cache/importsq.php"))
                        {
                            unlink(__SITEROOT."cache/importsq.php");
                        }
                        exit("导入完成");
                    }
                    
                }
                else
                {
                    echo "选择数据库时发生错误，请检查数据库名称是否填写正确";
                    exit;
                }
                
            }
            else
            {
                echo "连接数据库错误，请检查填写的数据库信息";
                exit;
            }
        }
        else
        {
            echo "存在未填写的字段，请返回填写";
            exit;
        }
    }
    //导入社区系统结束
    //导入社区系统数据，此方法将导入所有人员，包括无身份证人员，但不包含档案状态不为1的档案，无身份证或者身份证不合法的将会将身份证重置为空,导入流程参见基本流程图
    public function importsqsteponeAction()
    {
        $dbhost=$this->_request->getParam("dbhost");
        $dbname=$this->_request->getParam("dbname");
        $dbuser=$this->_request->getParam("dbuser");
        $dbpassword=$this->_request->getParam("dbpassword");
        $chsc_id=$this->_request->getParam("chsc_id");
        $region_id=$this->_request->getParam("region_id");
        $region_p_id=$this->_request->getParam("region_p_id");
        $nums=intval($this->_request->getParam("nums",0));//序号，每次叠加30
        $current=intval($this->_request->getParam("current",0));//已导入人数
        $config=array();
        require_once __SITEROOT . "library/Models/clinical_history.php";//疾病史
        require_once __SITEROOT . "library/Models/region.php";
        require_once __SITEROOT.'/library/data_arr/arrdata.php';//数据字典
        require_once __SITEROOT."application/iha/models/importforshequ.hyper.function.php";//高血压随访
        require_once __SITEROOT."application/iha/models/importforshequ.diabetes.function.php";//糖尿病随访
        require_once __SITEROOT."application/iha/models/import.schiz.function.php";//精神分裂随访
        require_once __SITEROOT."application/iha/models/importforshequ.examination.function.php";//健康体检
        if($nums && file_exists(__SITEROOT."cache/importsq.php"))
        {
            require_once __SITEROOT."cache/importsq.php";
            $dbhost=$a['dbhost'];
            $dbname=$a['dbname'];
            $dbuser=$a['dbuser'];
            $dbpassword=$a['dbpassword'];
            $chsc_id=$a['chsc_id'];
            $region_id=$a['region_id'];
            $region_p_id=$a['region_p_id'];
        }
        else
        {
            $config['dbhost']=$dbhost;
            $config['dbname']=$dbname;
            $config['dbuser']=$dbuser;
            $config['dbpassword']=$dbpassword;
            $config['chsc_id']=$chsc_id;
            $config['region_id']=$region_id;
            $config['region_p_id']=$region_p_id;
            $this->create_cache(__SITEROOT."cache/importsq.php",$config);
            //首次，清空原来的日志文件
            if(is_file(__SITEROOT."cache/import_errorlog.log") && file_exists(__SITEROOT."cache/import_errorlog.log"))
            {
                unlink(__SITEROOT."cache/import_errorlog.log");
            }
        }
        
        if($region_id==$region_p_id)
        {
            echo "选择的初始地区错误，请正确选择初始地区，否则导入数据将不可用";
            exit;
        }
        require_once(__SITEROOT.'library/custom/region_array.php');
        if($dbhost && $dbname && $dbuser && $dbpassword && $chsc_id && $region_p_id)
        {
            $db=mysql_connect($dbhost,$dbuser,$dbpassword);
            if($db)
            {
                if(mysql_select_db($dbname,$db))
                {
                    mysql_query("set names utf8");
                    //取总记录数，此处仅取所有户主信息，并且档案状态必须为1
                    $rn=mysql_query("select * from `ha_individual_info` where `relation_of_householder`='0' and `status_flag`='1'");
                    $total=mysql_num_rows($rn);
                    //从mysql去30条记录出来
                    $result=mysql_query("select * from `ha_individual_info` where `chsc_id`='$chsc_id' and `relation_of_householder`='0' and `status_flag`='1' limit ".$nums.",30");
                    while($rd=mysql_fetch_array($result))
                    {
                        //取到身份证号，对比系统中，是否有此人,不存在此人则新增加，如果存在此户主，则直接查询其家庭成员信息
                        $identity_number=$this->q2b($rd['identity_card_number']);
                        //取此人的居委会id
                        $juweihui_uuid=$rd['community'];//原老系统编码
                        $juweihui_code=$rd['juweihui_code'];//后来新系统编码
                        //从原社区系统中取居委会名称，并去掉居委会名字
                        $j_sql="select * from juweihui where uuid='$juweihui_uuid' or juweihui_code='$juweihui_code'";
                        $j_result=mysql_query($j_sql);
                        $j_rd=mysql_fetch_array($j_result);
                        $j_rd['juweihui_name']=isset($j_rd['juweihui_name'])?$j_rd['juweihui_name']:"";
                        $juweihui_zh=str_replace("居委会","",$j_rd['juweihui_name']);
                        //查询此居委会在雅安平台下的机构id
                        $region=new Tregion();
						$region->whereAdd("zh_name = '$juweihui_zh'");
						$region->whereAdd("region_level > 7");
						$region->whereAdd("region_path like '0,1,2,5,72,11198%'");//范围限制在雨城区的东城和西城办事处
						$region->find(true);
						$region_p_id=$region->id?$region->id:$region_p_id;
						$org_id=$this->user['org_id'];
						//取医生
						require_once __SITEROOT . "library/Models/staff_core.php";
				        $staff_core		=	new Tstaff_core();
				        $staff_core->whereAdd("org_id='$org_id'");
				        $staff_core->whereAdd("role_id='14c29a32c28c09'");//只取医生
				        $staff_core->find();
				        $i=0;
				        $staff=array();
				        while ($staff_core->fetch())
				        {
							$staff[$i]=$staff_core->id;//id
							$i++;
				        }
				        $staff_rand=0;
                        $staff_rand=rand(0,(count($staff)-1));
                        $staff_id=$staff[$staff_rand];
                    	$staff_id=$staff_id?$staff_id:$this->user['uuid'];
                        $core=new Tindividual_core();
                        $core->whereAdd("org_id='$org_id'");//2011-11-14增加判定区域
                        $core->whereAdd("identity_number='$identity_number'");
                        $core->whereAdd("identity_number!=''");
                        //当身份证不合法时，也新建此用户家庭
                        if(strlen($identity_number)<15 || !$core->count('uuid'))
                        {
                             $core->free_statement();
                             //身份证不合法，重置为空
                             $identity_number=strlen($identity_number)<15?"":$identity_number;
                             //产生新的个人档案号
    			             $uuid=uniqid('i_',true);
                             $name=$rd['name'];
                             $namePinyin=$rd['name_pinyin']?$rd['name_pinyin']:@getPinyin($name);
                             $data_of_birth=strlen($identity_number)==18?substr($identity_number,6,8):'19'.substr($identity_number,6,6);
                    		 $data_of_birth=$rd['date_of_birth']?$rd['date_of_birth']:($data_of_birth);
                             $address=str_replace("--","",$this->q2b($rd['family_address']));
                    		 $residence_address=str_replace("--","",$this->q2b($rd['family_address']));
                    		 $phone_number=substr(str_replace("--","",$this->q2b($rd['telephone_number'])),0,20);
                             $f_number=$rd['family_number'];
                    		 $org_id=$this->user['org_id'];
                    		 //自定义编号
                    		 $standard_code=$rd['sn_self_define'];
                             $region_last_id=$region_p_id;
                             $regionPath=isset($regionInfo[$region_last_id]['2'])?$regionInfo[$region_last_id]['2']:"";
                    		 $temp=explode(',',$regionPath);
                    		 //获取从县级到街道，居委会，小区的编码
                    		 $region_id_1=isset($temp[4])?$temp[4]:"";
                    		 $region_id_2=isset($temp[5])?$temp[5]:"";
                    		 $region_id_3=isset($temp[6])?$temp[6]:"";
                    		 $region_id_4=isset($temp[7])?$temp[7]:"";
                    		 //$regionPath1是用于生成国标档案号的
                    		 $regionPath1=isset($regionInfo[$region_id_3]['2'])?$regionInfo[$region_id_3]['2']:"";
                    		 $relation_of_householder=$rd['relation_of_householder'];
                    		 $response_doctor=$staff_id?$staff_id:$this->user['uuid'];
                    		 $archive_doctor=$staff_id?$staff_id:$this->user['uuid'];
                    		 //建档时间
                    		 $filing_time=$rd['created']?$rd['created']:time();
                             $relation=array(0=>"1",1=>"2",2=>"3",3=>"4",4=>"5",5=>"6",6=>"7",7=>"8",8=>"8",9=>"8",10=>"8","0308"=>"3","0208"=>"2","0408"=>"4");
                             //家庭档案
                             //户主，新建家庭
                            $family=new Tfamily_archive();
                			$family->selectAdd('max(inner_id) as inner_id');
                			//按省标，是到最后一级区域的流水号
                			$family->whereAdd("region_path='$regionPath'");
                			$family->find(true);
                			$familyInnerId=$family->inner_id+1;
                			$familyInnerId=@str_repeat('0',4-strlen($familyInnerId)).$familyInnerId;
                            $family_address=$this->q2b($family->family_address);
                            $family->free_statement();
                			//保存数据 家庭档案数据
                			$family=new Tfamily_archive();
                			$family_number=$family->family_number=$family->uuid=uniqid('f_',true);
                			$family->inner_id=$familyInnerId;
                			$family->org_id=$org_id;
                			$family->inner_id=$familyInnerId;
                            $family->family_address=$family_address;
                            $family->telephone_number=$phone_number;
                			$family->householder_id=$uuid;
                			$family->householder_name=$name;
                			$family->region_path=$regionPath;
                			$family->staff_id=$archive_doctor;
                            $family->deleted=0;
                            $family->status_flag=1;
                			$family->created=time();
                			$family->updated=time();
                			$family->insert();
                            $family->free_statement();
                             //个人档案核心表
                             $individualInnerId='01';
                    		//获取人个档案号流水号 非户主
                    		if($rd['relation_of_householder']!="0" && $family_number)
                            {
                    			$individual=new Tindividual_core();
                    			$individual->whereAdd("family_number='$family_number'");
                    			$individual->orderby('inner_id desc');
                    			$individual->limit(0,1);
                    			//$individual->debugLevel(9);
                    			$individual->find(true);
                    			//echo $individual->inner_id."|";
                    			$individualInnerId=$individual->inner_id+1;
                    			//echo $individualInnerId."|";
                    			$individualInnerId=str_repeat('0',2-strlen($individualInnerId)).$individualInnerId;
                                $individual->free_statement();
                    		}
                            //获取到家庭号，出入数据，否则排除
                            if($family_number)
                            {
                               //获取国标档案编码流水号
                        		$region_path_inner_id=$this->_request->getParam('region_path_inner_id','');
                    			$individual=new Tindividual_core();
                    			$individual->selectAdd('max(region_path_inner_id) as region_path_inner_id');
                    			//注意这是里是$regionPath1
                    			$individual->whereAdd("region_path like '$regionPath1%'");
                    			$individual->find(true);
                    			if($individual->region_path_inner_id!=''){
                    				$region_path_inner_id=$individual->region_path_inner_id+1;
                    			}else{
                    				$region_path_inner_id=1;
                    			}
                    			$region_path_inner_id=str_repeat('0',5-strlen($region_path_inner_id)).$region_path_inner_id;
                    			//国标档案号 2011－1－27号出现的档案号重的问题就出在这里
                    			$std1=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.substr($regionInfo[$region_id_3]['1'],1,2).'-'.$region_path_inner_id;
                    			//省标档案号
                    			$std2=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.$regionInfo[$region_id_3]['1'].'-'.$regionInfo[$region_id_4]['1'].'-'.$familyInnerId.'-'.$individualInnerId;
                                $individual->free_statement();
                        		//插入个人档案数据
                        		$individual=new Tindividual_core();
                        		$individual->uuid=$uuid;
                                $individual->sex=array_code_change(intval($rd['sex']),$sex);
                        		$individual->inner_id=$individualInnerId;
                        		$individual->region_path=$regionPath;
                        		$individual->name=$name;
                        		$individual->name_pinyin=$namePinyin;
                        		$individual->identity_number=$identity_number;
                        		$individual->date_of_birth=intval($data_of_birth);
                       			$individual->org_id=$org_id;
                       			$individual->staff_id=$archive_doctor;
                       			$individual->response_doctor=$response_doctor;
                        		$individual->address=$address;
                        		$individual->residence_address=$address;
                        		$individual->family_number=$family_number;
                        		$individual->family_inner_id=intval($familyInnerId);
                        		$individual->region_path_inner_id=intval($region_path_inner_id);
                        		$individual->relation_holder=$relation["$relation_of_householder"];
                        		$individual->inner_id=$individualInnerId;
                        		$individual->filing_time=$filing_time;
                       			$individual->created=$individual->updated=time();
                        		$individual->phone_number=str_replace("--","",$phone_number);
                        		$individual->standard_code=$standard_code;//手工
                        		$individual->race=$rd['race'];//民族
                        		$individual->standard_code_1=$std1;//国标
                       			$individual->standard_code_2=$std2;//省标
                       			$individual->status_flag=1;
                       			$individual->syn_flag=9;
                       			$individual->debugLevel(5);
                    			if($family_number && !$individual->insert())
                                {
                                    $individual->free_statement;
                    				echo("写入个人表失败".$name);
                    			}
                                else
                                {
                                    $individual->free_statement();
                                    //个人档案扩展表
                                    $individual_archive=new Tindividual_archive();
                                    $individual_archive->nationality=$rd['nationality'];//国籍
                                    $individual_archive->native_place=$this->q2b($rd['native_place']);//籍贯
                                    $individual_archive->reside_place=$this->q2b($rd['reside_place']);//居住地区
                                    $individual_archive->reside_time=$rd['reside_time'];//居住年限
                                    $individual_archive->unit_name=$this->q2b($rd['unit_name']);
                                    $temp_array=array();
									$temp_array=$this->shequtoquyu($rd['occupation']);
                                    $individual_archive->occupation=array_code_change($temp_array[0],$occupation);
                                    $individual_archive->unit_address=$this->q2b($rd['unit_address']);
                                    $temp_array=array();
									$temp_array=$this->shequtoquyu($rd['marriage']);
                                    $individual_archive->marriage=array_code_change($temp_array[0],$marriage);
                                    $individual_archive->contact=$this->q2b($rd['contact_name']);//联系人
                                    $temp_array=array();
									$temp_array=$this->shequtoquyu($rd['registered_permanent_residence']);
                                    $individual_archive->residence=array_code_change($temp_array[0],$registered_permanent_residence);//户籍类别
                                    $individual_archive->contact_number=substr(str_replace("--","",$this->q2b($rd['telephone_number'])),0,20);//联系电话
                                    $temp_array=array();
									$temp_array=$this->shequtoquyu($rd['education_background']);
                                    $individual_archive->study_history=array_code_change($temp_array[0],$school_type);//学历
                                    $individual_archive->family_address=str_replace("--","",$this->q2b($rd['family_address']));
                                    $individual_archive->uuid=uniqid("i_",true);
                                    $individual_archive->id=$uuid;
                                    $individual_archive->org_id=$org_id;
         			                $individual_archive->staff_id=$archive_doctor;
         			                include __SITEROOT."application/iha/models/importforshequ.base.php";//新增的要求导入全部数据的代码，太长了，只好放其他文件里
                                    $sql="select * from ch_clinical_history where `serial_number`='".$rd['uuid']."' and status_flag='1' and disease_state='1'";
                                    $cl=mysql_query($sql);
                                    while($cd=mysql_fetch_array($cl))
                                    {
                                        //取出本人的疾病状态
                                        if($cd['disease_name']=="高血压")
                                        {
                                            diagnose_disease($uuid,2,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                            $individual_archive->disease_history=2;
                                        }
                                        elseif($cd['disease_name']=="糖尿病")
                                        {
                                            diagnose_disease($uuid,3,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                            $individual_archive->disease_history=2;
                                        }
                                        elseif($cd['disease_name']=="精神分裂症")
                                        {
                                            diagnose_disease($uuid,8,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                            $individual_archive->disease_history=2;
                                        }
                                        elseif($cd['disease_name']=="冠心病")
                                        {
                                            diagnose_disease($uuid,4,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                            $individual_archive->disease_history=2;
                                        }
                                        elseif($cd['disease_name']=="COPD")
                                        {
                                            diagnose_disease($uuid,5,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                            $individual_archive->disease_history=2;
                                        }
                                        elseif($cd['disease_name']=="脑卒中")
                                        {
                                            diagnose_disease($uuid,7,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                            $individual_archive->disease_history=2;
                                        }
                                        elseif($cd['disease_name']=="结核病")
                                        {
                                            diagnose_disease($uuid,9,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                            $individual_archive->disease_history=2;
                                        }
                                        else
                                        {
                                            $individual_archive->disease_history=1;
                                        }
                                    }
                                    $individual_archive->status_flag=1;
                                    $individual_archive->insert();
                                    $individual_archive->free_statement();
                                    //导入高血压
                                    import_hyper($rd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
                                    //导入糖尿病
                                    import_diabetes($rd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
                                    //导入精神分裂
                                    import_schizophrenia($rd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
                                    //导入健康体检表
                                    import_examination($rd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
                                    $current++;
                                } 
                            }
                            //查询家庭成员并导入
                            if($f_number)
                            {
                                $sql="select * from ha_individual_info where `family_number`='$f_number' and `status_flag`='1' and `relation_of_householder`!='0'";
                                $pr=mysql_query($sql);
                                while($pd=mysql_fetch_array($pr))
                                {
                                    //查询此用户是否建档
                                    $identity_number=$pd['identity_card_number'];
                                    $core->whereAdd("identity_number='$identity_number'");
                        			$core->whereAdd("identity_number!=''");
                        			$core->whereAdd("org_id='$org_id'");
                                    //当身份证不合法时，重置其身份证号码
                                    if(!$core->count('uuid') || strlen($identity_number)<15)
                                    {
                                        //重复上面步骤，导入数据
                                        $identity_number=strlen($identity_number)<15?"":$identity_number;
                                        //产生新的个人档案号
                			             $uuid=uniqid('i_',true);
                                         $name=$pd['name'];
                                         $namePinyin=$pd['name_pinyin']?$pd['name_pinyin']:@getPinyin($name);
                                         $data_of_birth=strlen($identity_number)==18?substr($identity_number,6,8):'19'.substr($identity_number,6,6);
                                		 $data_of_birth=$pd['date_of_birth']?$pd['date_of_birth']:($data_of_birth);
                                         $address=str_replace("--","",$this->q2b($pd['family_address']));
                                		 $residence_address=str_replace("--","",$this->q2b($pd['family_address']));
                                		 $phone_number=substr(str_replace("--","",$this->q2b($rd['telephone_number'])),0,20);
                                		 $staff_id=$staff_id?$staff_id:$this->user['uuid'];
                                		 $org_id=$this->user['org_id'];
                                		 //自定义编号
                                		 $standard_code=$pd['sn_self_define'];
                                		 $relation_of_householder=$pd['relation_of_householder'];
                                		 //建档时间
                                		 $filing_time=$pd['created']?$pd['created']:time();
                                         $relation=array(0=>"1",1=>"2",2=>"3",3=>"4",4=>"5",5=>"6",6=>"7",7=>"8",8=>"8",9=>"8",10=>"8","0308"=>"3","0208"=>"2","0408"=>"4");
                                		//获取人个档案号流水号 非户主
                                		$individual=new Tindividual_core();
                            			$individual->whereAdd("family_number='$family_number'");
                            			$individual->orderby('inner_id desc');
                            			$individual->limit(0,1);
                            			$individual->find(true);
                            			$individualInnerId=$individual->inner_id+1;
                            			$individualInnerId=str_repeat('0',2-strlen($individualInnerId)).$individualInnerId;
                                        $individual->free_statement();
                                       //获取国标档案编码流水号
                                		$region_path_inner_id=$this->_request->getParam('region_path_inner_id','');
                            			$individual=new Tindividual_core();
                            			$individual->selectAdd('max(region_path_inner_id) as region_path_inner_id');
                            			//注意这是里是$regionPath1
                            			$individual->whereAdd("region_path like '$regionPath1%'");
                            			$individual->find(true);
                            			if($individual->region_path_inner_id!=''){
                            				$region_path_inner_id=$individual->region_path_inner_id+1;
                            			}else{
                            				$region_path_inner_id=1;
                            			}
                            			$region_path_inner_id=str_repeat('0',5-strlen($region_path_inner_id)).$region_path_inner_id;
                            			//国标档案号 2011－1－27号出现的档案号重的问题就出在这里
                            			$std1=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.substr($regionInfo[$region_id_3]['1'],1,2).'-'.$region_path_inner_id;
                            			//省标档案号
                            			$std2=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.$regionInfo[$region_id_3]['1'].'-'.$regionInfo[$region_id_4]['1'].'-'.$familyInnerId.'-'.$individualInnerId;
                                        $individual->free_statement();
                                		//插入个人档案数据
                                		$individual=new Tindividual_core();
                                		$individual->uuid=$uuid;
                                        $individual->sex=array_code_change(intval($pd['sex']),$sex);
                                		$individual->inner_id=$individualInnerId;
                                		$individual->region_path=$regionPath;
                                		$individual->name=$name;
                                		$individual->name_pinyin=$namePinyin;
                                		$individual->identity_number=$identity_number;
                                		$individual->date_of_birth=intval($data_of_birth);
                               			$individual->org_id=$org_id;
                               			$individual->staff_id=$archive_doctor;
                               			$individual->response_doctor=$response_doctor;
                                		$individual->address=$address;
                                		$individual->residence_address=$address;
                                		$individual->family_number=$family_number;
                                		$individual->family_inner_id=intval($familyInnerId);
                                		$individual->region_path_inner_id=intval($region_path_inner_id);
                                		$individual->relation_holder=$relation["$relation_of_householder"];
                                		$individual->inner_id=$individualInnerId;
                                		$individual->filing_time=$filing_time;
                               			$individual->created=$individual->updated=time();
                                		$individual->phone_number=str_replace("--","",$phone_number);
                                		$individual->standard_code=$standard_code;//手工
                                		$individual->standard_code_1=$std1;//国标
                               			$individual->standard_code_2=$std2;//省标
                               			$individual->race=$pd['race'];//民族
                               			$individual->status_flag=1;
                               			$individual->syn_flag=9;
                               			//$individual->debugLevel(5);
                               			//echo "<br />",$family_number;
                            			if($family_number && !$individual->insert())
                                        {
                                            $individual->free_statement;
                            				//exit("写入个人表失败".$name);
                            			}
                                        else
                                        {
                                            $individual->free_statement();
                                            //个人档案扩展表
                                            $individual_archive=new Tindividual_archive();
		                                    $individual_archive->nationality=$pd['nationality'];//国籍
		                                    $individual_archive->native_place=$this->q2b($pd['native_place']);//籍贯
		                                    $individual_archive->reside_place=$this->q2b($pd['reside_place']);//居住地区
		                                    $individual_archive->reside_time=$pd['reside_time'];//居住年限
		                                    $individual_archive->unit_name=$this->q2b($pd['unit_name']);
		                                    $temp_array=array();
											$temp_array=$this->shequtoquyu($pd['occupation']);
		                                    $individual_archive->occupation=array_code_change($temp_array[0],$occupation);
		                                    $individual_archive->unit_address=$this->q2b($pd['unit_address']);
		                                    $temp_array=array();
											$temp_array=$this->shequtoquyu($pd['marriage']);
		                                    $individual_archive->marriage=array_code_change($temp_array[0],$marriage);
		                                    $individual_archive->contact=$this->q2b($pd['contact_name']);//联系人
		                                    $temp_array=array();
											$temp_array=$this->shequtoquyu($pd['registered_permanent_residence']);
		                                    $individual_archive->residence=array_code_change($temp_array[0],$registered_permanent_residence);//户籍类别
		                                    $individual_archive->contact_number=substr(str_replace("--","",$this->q2b($pd['telephone_number'])),0,20);//联系电话
		                                    $temp_array=array();
											$temp_array=$this->shequtoquyu($pd['education_background']);
		                                    $individual_archive->study_history=array_code_change($temp_array[0],$school_type);//学历
                                            $individual_archive->family_address=str_replace("--","",$this->q2b($pd['family_address']));
                                            $individual_archive->uuid=uniqid("i_",true);
                                            $individual_archive->id=$uuid;
                                            $individual_archive->org_id=$org_id;
                 			                $individual_archive->staff_id=$archive_doctor;
                 			                include __SITEROOT."application/iha/models/importforshequ.base.php";//新增的要求导入全部数据的代码，太长了，只好放其他文件里
                                            //处理疾病史
                                            $sql="select * from ch_clinical_history where `serial_number`='".$pd['uuid']."' and status_flag='1' and disease_state='1'";
                                            $cl=mysql_query($sql);
                                            while($cd=mysql_fetch_array($cl))
                                            {
                                                //取出本人的疾病状态
                                                if($cd['disease_name']=="高血压")
                                                {
                                                    diagnose_disease($uuid,2,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                elseif($cd['disease_name']=="糖尿病")
                                                {
                                                    diagnose_disease($uuid,3,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                elseif($cd['disease_name']=="精神分裂症")
                                                {
                                                    diagnose_disease($uuid,8,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                elseif($cd['disease_name']=="冠心病")
                                                {
                                                    diagnose_disease($uuid,4,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                elseif($cd['disease_name']=="COPD")
                                                {
                                                    diagnose_disease($uuid,5,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                elseif($cd['disease_name']=="脑卒中")
                                                {
                                                    diagnose_disease($uuid,7,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                elseif($cd['disease_name']=="结核病")
                                                {
                                                    diagnose_disease($uuid,9,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                else
                                                {
                                                    $individual_archive->disease_history=1;
                                                }
                                            }
                                            $individual_archive->status_flag=1;
                                            $individual_archive->insert();
                                            $individual_archive->free_statement();
                                            //导入高血压
		                                    import_hyper($pd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
		                                    //导入糖尿病
		                                    import_diabetes($pd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
		                                    //导入精神分裂
		                                    import_schizophrenia($pd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
		                                    //导入健康体检表
                                    		import_examination($pd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
                                            $current++;
                                        }
                                    }
                                    else
                                    {
                                        //存在此用户，不导入，写入错误日志
                                        $fp=fopen(__SITEROOT."cache/import_errorlog.log","a+");
                                        fputs($fp,"$name--$identity_number--".$pd['uuid']."--已存在用户\n");
                                        fclose($fp);
                                    }
                                }
                            }
                            else
                            {
                                //无家庭档案号，错误档案，不处理，写入错误日志
                                $fp=fopen(__SITEROOT."cache/import_errorlog.log","a+");
                                fputs($fp,"$name--$identity_number--".$rd['uuid']."--无家庭档案号\n");
                                fclose($fp);
                            }
                    		
                        }
                        else
                        {
                            //存在户主，需要验证其家庭成员是否存在，Mysql中查询此家庭档案号
                            $sql="select * from ha_individual_info where `identity_card_number`='$identity_number' and `relation_of_householder`='0' limit 1";
                            $rs=mysql_query($sql);
                            $sd=mysql_fetch_array($rs);
                            $s_number=$sd['identity_card_number'];
                            //查询家庭成员并导入
                            if($s_number)
                            {
                                $sql="select * from ha_individual_info where `family_number`='$s_number' and `status_flag`='1' and `relation_of_householder`!='0'";
                                $pr=mysql_query($sql);
                                while($pd=mysql_fetch_array($pr))
                                {
                                    //查询此用户是否建档
                                    $identity_number=$pd['identity_card_number'];
                                    $core=new Tindividual_core();
                                    $core->whereAdd("identity_number='$identity_number'");
                        			$core->whereAdd("identity_number!=''");
                        			$core->whereAdd("org_id='$org_id'");
                                    //当身份证不合法时，重置其身份证号码
                                    if(!$core->count('uuid') || strlen($identity_number)<15)
                                    {
                                        //重复上面步骤，导入数据
                                        $identity_number=strlen($identity_number)<15?"":$identity_number;
                                        //产生新的个人档案号
                			             $uuid=uniqid('i_',true);
                                         $name=$pd['name'];
                                         $namePinyin=$pd['name_pinyin']?$pd['name_pinyin']:@getPinyin($name);
                                         $data_of_birth=strlen($identity_number)==18?substr($identity_number,6,8):'19'.substr($identity_number,6,6);
                                		 $data_of_birth=$pd['date_of_birth']?$pd['date_of_birth']:($data_of_birth);
                                         $address=str_replace("--","",$this->q2b($pd['family_address']));
                                		 $residence_address=str_replace("--","",$this->q2b($pd['family_address']));
                                		 $phone_number=substr(str_replace("--","",$this->q2b($pd['telephone_number'])),0,20);
                                		 $staff_id=$staff_id?$staff_id:$this->user['uuid'];
                                		 $org_id=$this->user['org_id'];
                                		 //自定义编号
                                		 $standard_code=$pd['sn_self_define'];
                                		 $relation_of_householder=$pd['relation_of_householder'];
                                		 //建档时间
                                		 $filing_time=$pd['created']?$pd['created']:time();
                                         $relation=array(0=>"1",1=>"2",2=>"3",3=>"4",4=>"5",5=>"6",6=>"7",7=>"8",8=>"8",9=>"8",10=>"8","0308"=>"3","0208"=>"2","0408"=>"4");
                                		//获取人个档案号流水号 非户主
                                		$individual=new Tindividual_core();
                            			$individual->whereAdd("family_number='$family_number'");
                            			$individual->orderby('inner_id desc');
                            			$individual->limit(0,1);
                            			$individual->find(true);
                            			$individualInnerId=$individual->inner_id+1;
                            			$individualInnerId=str_repeat('0',2-strlen($individualInnerId)).$individualInnerId;
                                        $individual->free_statement();
                                       //获取国标档案编码流水号
                                		$region_path_inner_id=$this->_request->getParam('region_path_inner_id','');
                            			$individual=new Tindividual_core();
                            			$individual->selectAdd('max(region_path_inner_id) as region_path_inner_id');
                            			//注意这是里是$regionPath1
                            			$individual->whereAdd("region_path like '$regionPath1%'");
                            			$individual->find(true);
                            			if($individual->region_path_inner_id!=''){
                            				$region_path_inner_id=$individual->region_path_inner_id+1;
                            			}else{
                            				$region_path_inner_id=1;
                            			}
                            			$region_path_inner_id=str_repeat('0',5-strlen($region_path_inner_id)).$region_path_inner_id;
                            			//国标档案号 2011－1－27号出现的档案号重的问题就出在这里
                            			$std1=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.substr($regionInfo[$region_id_3]['1'],1,2).'-'.$region_path_inner_id;
                            			//省标档案号
                            			$std2=$regionInfo[$region_id_1]['1'].'-'.$regionInfo[$region_id_2]['1'].'-'.$regionInfo[$region_id_3]['1'].'-'.$regionInfo[$region_id_4]['1'].'-'.$familyInnerId.'-'.$individualInnerId;
                                        $individual->free_statement();
                                		//插入个人档案数据
                                		$individual=new Tindividual_core();
                                		$individual->uuid=$uuid;
                                        $individual->sex=array_code_change(intval($pd['sex']),$sex);
                                		$individual->inner_id=$individualInnerId;
                                		$individual->region_path=$regionPath;
                                		$individual->name=$name;
                                		$individual->name_pinyin=$namePinyin;
                                		$individual->identity_number=$identity_number;
                                		$individual->date_of_birth=intval($data_of_birth);
                               			$individual->org_id=$org_id;
                               			$individual->staff_id=$archive_doctor;
                               			$individual->response_doctor=$response_doctor;
                                		$individual->address=$address;
                                		$individual->residence_address=$address;
                                		$individual->family_number=$family_number;
                                		$individual->family_inner_id=intval($familyInnerId);
                                		$individual->region_path_inner_id=intval($region_path_inner_id);
                                		$individual->relation_holder=$relation[$relation_of_householder];
                                		$individual->inner_id=$individualInnerId;
                                		$individual->filing_time=$filing_time;
                               			$individual->created=$individual->updated=time();
                                		$individual->phone_number=$phone_number;
                                		$individual->standard_code=$standard_code;//手工
                                		$individual->standard_code_1=$std1;//国标
                               			$individual->standard_code_2=$std2;//省标
                               			$individual->race=$pd['race'];//民族
                               			$individual->status_flag=1;
                               			$individual->syn_flag=9;
                            			if($family_number && !$individual->insert())
                                        {
                                            $individual->free_statement;
                            				//exit("写入个人表失败".$name);
                            			}
                                        else
                                        {
                                            $individual->free_statement();
                                            //个人档案扩展表
                                            $individual_archive->nationality=$pd['nationality'];//国籍
		                                    $individual_archive->native_place=$this->q2b($pd['native_place']);//籍贯
		                                    $individual_archive->reside_place=$this->q2b($pd['reside_place']);//居住地区
		                                    $individual_archive->reside_time=$pd['reside_time'];//居住年限
		                                    $individual_archive->unit_name=$this->q2b($pd['unit_name']);
		                                    $temp_array=array();
											$temp_array=$this->shequtoquyu($pd['occupation']);
		                                    $individual_archive->occupation=array_code_change($temp_array[0],$occupation);
		                                    $individual_archive->unit_address=$this->q2b($pd['unit_address']);
		                                    $temp_array=array();
											$temp_array=$this->shequtoquyu($pd['marriage']);
		                                    $individual_archive->marriage=array_code_change($temp_array[0],$marriage);
		                                    $individual_archive->contact=$this->q2b($pd['contact_name']);//联系人
		                                    $temp_array=array();
											$temp_array=$this->shequtoquyu($pd['registered_permanent_residence']);
		                                    $individual_archive->residence=array_code_change($temp_array[0],$registered_permanent_residence);//户籍类别
		                                    $individual_archive->contact_number=substr(str_replace("--","",$this->q2b($pd['telephone_number'])),0,20);//联系电话
		                                    $temp_array=array();
											$temp_array=$this->shequtoquyu($pd['education_background']);
		                                    $individual_archive->study_history=array_code_change($temp_array[0],$school_type);//学历
                                            $individual_archive->family_address=str_replace("--","",$this->q2b($pd['family_address']));
                                            $individual_archive->uuid=uniqid("i_",true);
                                            $individual_archive->id=$uuid;
                                            $individual_archive->org_id=$org_id;
                 			                $individual_archive->staff_id=$archive_doctor;
                 			                include __SITEROOT."application/iha/models/importforshequ.base.php";//新增的要求导入全部数据的代码，太长了，只好放其他文件里
                                            //处理疾病史
                                            $sql="select * from ch_clinical_history where `serial_number`='".$pd['uuid']."' and status_flag='1' and disease_state='1'";
                                            $cl=mysql_query($sql);
                                            while($cd=mysql_fetch_array($cl))
                                            {
                                                $staff_id=$staff_id?$staff_id:$this->user['uuid'];
                                                $org_id=$this->user['org_id'];
                                                //取出本人的疾病状态
                                                if($cd['disease_name']=="高血压")
                                                {
                                                    diagnose_disease($uuid,2,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                elseif($cd['disease_name']=="糖尿病")
                                                {
                                                    diagnose_disease($uuid,3,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                elseif($cd['disease_name']=="精神分裂症")
                                                {
                                                    diagnose_disease($uuid,8,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                elseif($cd['disease_name']=="冠心病")
                                                {
                                                    diagnose_disease($uuid,4,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                elseif($cd['disease_name']=="COPD")
                                                {
                                                    diagnose_disease($uuid,5,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                elseif($cd['disease_name']=="脑卒中")
                                                {
                                                    diagnose_disease($uuid,7,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                elseif($cd['disease_name']=="结核病")
                                                {
                                                    diagnose_disease($uuid,9,isset($cd['disease_date'])?$cd['disease_date']:"",$disease_history,$staff_id,$org_id);
                                                    $individual_archive->disease_history=2;
                                                }
                                                else
                                                {
                                                    $individual_archive->disease_history=10;
                                                }
                                            }
                                            $individual_archive->status_flag=1;
                                            $individual_archive->insert();
                                            $individual_archive->free_statement();
                                            //导入高血压
		                                    import_hyper($pd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
		                                    //导入糖尿病
		                                    import_diabetes($pd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
		                                    //导入精神分裂
		                                    import_schizophrenia($pd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
		                                    //导入健康体检表
                                    		import_examination($pd['uuid'],$uuid,$staff_id,$org_id,$db,$dbname);
                                            $current++;
                                        }
                                    }
                                    else
                                    {
                                        //存在此用户，不导入，写入错误日志
                                        $fp=fopen(__SITEROOT."cache/import_errorlog.log","a+");
                                        fputs($fp,"$name--$identity_number--".$pd['uuid']."--已存在用户.\n");
                                        fclose($fp);
                                    }
                                }
                            }
                            else
                            {
                                //无家庭档案号，错误档案，不处理，写入错误日志
                                $fp=fopen(__SITEROOT."cache/import_errorlog.log","a+");
                                fputs($fp,"$name--$identity_number--".$rd['uuid']."--已有家庭，查询家庭档案号错误\n");
                                fclose($fp);
                            }
                        }
                        
                    }
                    //导入完成调整页面
                    if($nums<$total)
                    {
                        $tmp_url=__BASEPATH."iha/import/importsqstepone/nums/".($nums+30)."/current/".$current;
                        $url=array("快速导入下一组"=>$tmp_url);
				        message("已导入".($nums+30)."个家庭，".$current."个人档案，请不要关闭浏览器,页面将自动跳转",$url,$tmp_url); 
                    }
                    else
                    {
                        if(is_file(__SITEROOT."cache/importsq.php") && file_exists(__SITEROOT."cache/importsq.php"))
                        {
                            unlink(__SITEROOT."cache/importsq.php");
                        }
                        //导入没有家庭的档案信息
                        require_once __SITEROOT."application/iha/models/importforshequ.nofamily.function.php";
                        import_nofamily($chsc_id,$staff_id,$org_id,$db,$dbname);
                        $url=array("个人健康档案"=>__BASEPATH."iha/index/index");
                        message("已导入".($nums+30)."个家庭，".$current."个人档案，导入已完成",$url);
                    }
                    
                }
                else
                {
                    echo "选择数据库时发生错误，请检查数据库名称是否填写正确";
                    exit;
                }
                
            }
            else
            {
                echo "连接数据库错误，请检查填写的数据库信息";
                exit;
            }
        }
        else
        {
            echo "存在未填写的字段，请返回填写";
            exit;
        }
    }
    /**
     * 删除导入的错误记录
     *
     */
    public function delerrAction()
    {
    	$time_start=adodb_mktime(0,0,0,date("n"),date("j")-3,date("Y"));
		$time_end=adodb_mktime(0,0,0,date("n"),date("j")+1,date("Y"));
    	require_once __SITEROOT . "library/Models/clinical_history.php";//疾病史
    	$individual=new Tindividual_core();
    	$individual->whereAdd("syn_flag=9");
    	$individual->find();
    	while ($individual->fetch())
    	{
    		$uuid="";
    		$uuid=$individual->uuid;
    		if ($uuid)
    		{
    			//删除个人档案扩展表
	    		$individual_archive=new Tindividual_archive();
	    		$individual_archive->whereAdd("id='$uuid'");
	    		$individual_archive->delete();
	    		$individual_archive->free_statement();
	    		//删除疾病史
	    		$clin=new Tclinical_history();
	    		$clin->whereAdd("id='$uuid'");
	    		$clin->delete();
	    		$clin->free_statement();
	    		//删除家庭档案
	    		if ($individual->family_number)
	    		{
	    			$family=new Tfamily_archive();
	    			$family->whereAdd("uuid='$individual->family_number'");
	    			$family->delete();
	    			$family->free_statement();
	    		}
	    		
				//删除药品表--仅需要删除一次，删除id等于这个人的就行，一次删除所有模块的用药记录
				require_once __SITEROOT."library/Models/follow_up_drugs.php";
				//删除症状表
				require_once __SITEROOT."library/Models/hypertension_symptom.php";
				//删除高血压随访表
	    		//删除糖尿病随访相关表
	    		require_once __SITEROOT."library/Models/diabetes_core.php";
				require_once __SITEROOT."library/Models/diabetes_physical_sign.php";
				require_once __SITEROOT."library/Models/diabetes_lifestyle_guide.php";
				require_once __SITEROOT."library/Models/diabetes_accessory_examine.php";
				require_once __SITEROOT."library/Models/diabetes_patient_referral.php";
	    		//删除精神分裂随访表
	    		require_once __SITEROOT."library/Models/schizophrenia.php";
	    		//删除健康体检表
	    		require_once __SITEROOT."library/Models/examination_table.php";
	    		require_once __SITEROOT."library/Models/et_health_assessment.php";
	    		require_once __SITEROOT."library/Models/et_health_guidance.php";
	    		require_once __SITEROOT."library/Models/et_examination.php";
	    		require_once __SITEROOT."library/Models/et_symptom.php";
	    		require_once __SITEROOT."library/Models/et_general_condition.php";
	    		require_once __SITEROOT."library/Models/et_lifestyle.php";
	    		require_once __SITEROOT."library/Models/et_hospitalization_history.php";
	    		require_once __SITEROOT."library/Models/et_main_drug_use.php";
	    		require_once __SITEROOT."library/Models/et_mhealth.php";
	    		require_once __SITEROOT."library/Models/et_nonepi_vaccination.php";
	    		require_once __SITEROOT."library/Models/et_organ.php";
	    		//删除后面修正添加的表
	    		require_once __SITEROOT.'/library/Models/blood_type.php';
	    		require_once __SITEROOT.'/library/Models/charge_style.php';
	    		require_once __SITEROOT.'/library/Models/exposure_history.php';
	    		require_once __SITEROOT.'/library/Models/allergy.php';
	    		require_once __SITEROOT.'/library/Models/surgical_history.php';
	    		require_once __SITEROOT.'/library/Models/trauma.php';
	    		require_once __SITEROOT.'/library/Models/transfusion.php';
	    		require_once __SITEROOT.'/library/Models/genetic_diseases.php';
	    		require_once __SITEROOT.'/library/Models/family_history.php';
	    		require_once __SITEROOT.'/library/Models/deformity.php';
	    		
	    		$del_table_array=array('follow_up_drugs','hypertension_symptom','diabetes_core','diabetes_physical_sign','diabetes_lifestyle_guide','diabetes_accessory_examine','diabetes_patient_referral','schizophrenia','examination_table','et_health_assessment','et_health_guidance','et_examination','et_symptom','et_general_condition','et_lifestyle','et_hospitalization_history','et_main_drug_use','et_mhealth','et_nonepi_vaccination','et_organ','blood_type','charge_style','exposure_history','allergy','surgical_history','trauma','transfusion','genetic_diseases','family_history','deformity');
	    		foreach ($del_table_array as $k=>$v)
	    		{
	    			$obj='';
	    			$obj_name='T'.$v;
	    			$obj=new $obj_name();
					$obj->whereAdd("id='".$uuid."'");
					$obj->delete();
					$obj->free_statement();
	    		}
	    		//删除核心表
	    		$idivi=new Tindividual_core();
	    		$idivi->whereAdd("uuid='$uuid'");
	    		$idivi->delete();
	    		$idivi->free_statement();
    		}
    	}
    	echo "删除完成";
    }
    /**
     * 全角字符转半角字符
     * 2011-10-21导入华兴街社区遇到该社区联系信息里存储有全角字符
     * @param string $str
     * @param string $coding
     * @return string
     */
    private function q2b($str,$coding='UTF-8')
    {
    	if($coding!='UTF-8')
    	{
    		$str=mb_convert_encoding($str,'UTF-8',$coding);
    	}
    	$ret='';
    	for($i=0;$i<strlen($str);$i++)
    	{
    		$s1=$str[$i];
    		if(($c=ord($s1))&0x80)
    		{
    			$s2=$str[++$i];
    			$s3=$str[++$i];
    			$c=(($c&0xF)<<12)|((ord($s2)&0x3F)<<6)|(ord($s3)&0x3F);
    			if($c==12288)
    			{
    				$ret.=' ';
    			}
    			elseif($c>65280&&$c<65375&&$c!=65374)
    			{
    				$c-=65248;
    				$ret.=chr($c);
    			}
    			else
    			{
    				$ret.=$s1.$s2.$s3;
    			}
    		}
    		else
    		{
    			$ret.=$str[$i];
    		}
    	}
    	if($coding!='UTF-8')
    	{
    		return mb_convert_encoding($ret,$coding,'UTF-8');
    	}
    	else
    	{
    		return $ret;
    	}
    }
	private function create_cache($file,$array)
		{
		
			$ar="<?php\n";
		
			foreach ($array as $k=>$v)
		
			{
		
				$ar.="\n".'$a["'.$k.'"]="'.$v.'";';
		
			}
		
			$ar.="\n?>";
		
			$e=fopen($file,"wb");
		
			fputs($e,$ar);
		
			fclose($e);
		
			unset($e);
		
			return 1;
		
		}
	/**
	 * 将社区存储的编码转换为区域平台的编码
	 * 将任意整数转换为2的n次方的和
	 * @param unknown_type $num
	 * @return unknown
	 */
	private function shequtoquyu($num)
	{
		$re=array();
	    $bit = decbin($num);
	    $pow = array_reverse(str_split($bit));
	    foreach($pow as $k=>$v) 
	    {
	        if($v==1) $re[] = $k+1;
	    }
	    return $re;
	}
}
<?php
/**
*接口概要
*/
class his_apisummaryController extends controller
{
    public function init()
	{
	   $this->view->assign("baseUrl",__BASEPATH);
	   $this->view->assign( "basePath", __BASEPATH );
       require_once __SITEROOT."library/Models/individual_archive.php";
	   require_once __SITEROOT."library/Models/individual_core.php";
	   require_once __SITEROOT."library/Models/api_summary.php";
	   require_once __SITEROOT."library/Models/organization.php";
	   require_once(__SITEROOT.'library/privilege.php');
	   require_once __SITEROOT."library/Models/region.php";
       require_once __SITEROOT . '/library/custom/comm_function.php';
	   require_once(__SITEROOT."/library/custom/pager.php");//引入分页处理文件
	   
	  	
    }
	
	//接口概要列表
    public function indexAction()
    {   
		$module_id=$this->_request->getParam("mid");
		$this->view->mid=$module_id;
		$p_id=$this->_request->getparam("p_id");
		//获取当前机构的路径
		$organization =new Torganization();
		$region=new Tregion();
		$org_id=$this->user['org_id'];
		$organization->whereAdd("organization.id='$org_id'");
		$region->joinAdd("inner",$region,$organization,"region_path","region_path");
		$region->find(true);
		$org_path=$organization->region_path;
		$p_id=$p_id?$p_id:$region->id;
		$region=new Tregion();
	    $region->whereAdd("id='$p_id'");
		$region->find(true);
		$p_region_path=$region->region_path;
		
		//面包屑导航
		$region=new Tregion();
		$region->whereAdd("id in ($p_region_path)");
		//$region->debug(1);
		$region->find();
		$path_arr=array();
		$path_arr_index=0;
		while($region->fetch()){
			$path_arr[$path_arr_index]['path_name']=$region->zh_name;
			$path_arr[$path_arr_index]['path_id']=$region->id;
			//查找当前机构的region_path是否在当前路径之中，如果机构的路径在当前路径当中，说明此机构为上级机构，给以路径权限，反之则禁用这一级的路径权限
			$pos=strpos($region->region_path,$org_path);
			if($pos===0){
				$path_arr[$path_arr_index]['show']=1;
			}
			$path_arr_index++;
			
		}
		//print_r($path_arr);
		$this->view->path_arr=$path_arr;
		$this->view->current_path_id=$p_id;
		//查找该地区下的机构信息
		$organization =new Torganization();
		$organization->whereAdd("region_path = '".$p_region_path."'");
		$organization->find();
		$org_arr=array();
		$org_index=0;
		while($organization->fetch()){
			$org_arr[$org_index]['org_name']=$organization->zh_name;
			$org_arr[$org_index]['org_id']=$organization->id;
			$org_index++;
		}
		$this->view->org_arr=$org_arr;
		
		//查找地区
		$region=new Tregion();
		$organization =new Torganization();
		$region->whereAdd("p_id='$p_id'");
		$region->whereAdd("region_level<=6");
		$region->find();
		$region_arr=array();
		$index=0;
		//子地区遍历开始
		while($region->fetch()){
			$organization =new Torganization();
			$organization->whereAdd("region_path like '".$p_region_path.",%'");
			$region_arr[$index]['region_name']=$region->zh_name;
			$region_arr[$index]['region_id']=$region->id;
			
			$index++;
			}
			
			$this->view->region_arr=$region_arr;
		    $this->view->display("index.html");
			
    }
	//电子病历列表
	public function listAction(){
	
		$module_id=$this->_request->getparam("mid");
		$org_id=$this->_request->getParam("org_id");
		$api_summary = new Tapi_summary();
		if($module_id){
			$api_summary->whereAdd("module_id='$module_id'");
		}else{
			message("module_id获取失败!");
		}
		
		if($org_id){
			$api_summary->whereAdd("org_id='$org_id'");
		}
		
		$count=$api_summary->count();
		$currentPage = intval($this->_request->getParam('page'));
        $realPage    = empty($currentPage)?1:$currentPage;
		$arrArg=array();
		$links = new SubPages(__ROWSOFPAGE,$count,$realPage,__goodsListRowOfPage,__BASEPATH.'wsinfo/manage/index/module_search/'.'/table_search/'.'/page/',3,$arrArg);
        $pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
        $startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
        $api_summary->limit($startnum,__ROWSOFPAGE);
		$api_summary->find();
		$result=array();
		$index=0;
		
		
		while($api_summary->fetch()){
			$result[$index]['name']=$api_summary->patient_name;
			$result[$index]['sex']=($api_summary->patient_sex==1)? "男":"女";
			$result[$index]['identity_card']=$api_summary->patient_identity_card;
			$result[$index]['document_time']=date("Y-m-d",$api_summary->document_time);
			$result[$index]['uuid']=$api_summary->uuid;
			$index++;
			
		}
		
		$page = $links->subPageCss2();
        $this->view->page        = $page;
        $this->view->pageCurrent = $pageCurrent;
		$this->view->rows=$result;
        $this->view->display("list.html");
	}
	
	
	//接口概要详细
	public function detailAction(){
	
		$uuid=$this->_request->getparam("uuid");
		$api_summary=new Tapi_summary();
		$api_summary->whereAdd("uuid='$uuid'");
		if($api_summary->count()<1){
			echo "未找到信息";
			exit();
		}
		$api_summary->find(true);
		$document_id=$api_summary->document_id; 
        //$module_id=preg_replace('/[< >]/','',$api_summary->document_id);
        $module_id=$api_summary->module_id;
        if($document_id && $module_id)
        {   
            //$module_id=base64_decode($module_id);
            //取模块名称
            require_once __SITEROOT."library/Models/api_module.php";
            $api_module=new Tapi_module();
            $api_module->whereAdd("module_id='$module_id'");
            $api_module->find(true);
            header('Content-Type: text/xml');
            require_once __SITEROOT."library/Models/api_xml.php";
		
            require __SITEROOT."config/oracleConfig.php";
            $conn = oci_connect($databaseConfig[1]['user'],$databaseConfig[1]['password'],$databaseConfig[1]['host']);
            $query = "select xml_content from api_xml where document_id='$document_id'";
            $stmt = oci_parse($conn,$query);
            oci_execute($stmt);
            while($result=oci_fetch_array($stmt, OCI_RETURN_LOBS))
            {   
                 //$xml_content =base64_decode($result[0]); 
                  $xml_content =iconv('gbk','utf-8//IGNORE',base64_decode($result[0]));
            }
			if(empty($xml_content))
			message("对不起，没找到相关信息");
			/*
			$api_xml=new Tapi_xml();
			$api_xml->whereAdd("document_id='$document_id'");
			$api_xml->find(true);
			$xml_content=$api_xml->xml_content;
			*/
            echo '<?xml-stylesheet type="text/xsl" href="/'.$api_module->xml_template.'/'.urlencode($api_module->module_name).'.xsl"?>'.$xml_content;
        }
        else
        {
            $url=array("个人信息概况"=>__BASEPATH.'iha/search/main');
			message("对不起，信息获取错误，请联系管理员",$url);
        }
	}
   
}
?>
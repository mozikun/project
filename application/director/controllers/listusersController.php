<?php
/**
*@author：我好笨
*@filename: indexController.php
*@package：院长查询
*@email：4049054@qq.com
*@create：2011-1-20
*/
class director_listusersController extends controller
{
	/*
	 *等同于构造函数 
	 */
	public function init()
	{
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';	
		require_once __SITEROOT."library/Models/staff_core.php";//医生主表
		require_once __SITEROOT."library/Models/staff_archive.php";//医生扩展表
		require_once __SITEROOT."library/Models/organization.php";//机构
		require_once __SITEROOT."library/Models/region.php";//区域

		$this->view->basePath = $this->_request->getBasePath();
	}
	/*
	 * 院长查询
	 */
	public function  indexAction()
	{


        $this->view->assign('region_id',$this->user['region_id']);
		$this->view->assign('region_p_id',$this->user['region_id']);
		$this->view->display("main.html");
	}
    //统计数据
    public function totalAction()
    {
        //取当前区域ID
        $region_id=$this->_request->getParam('region',$this->user['region_id']);
        //取选择的机构
        $org_id=$this->_request->getParam('org_id');
        
        //人员类别
        $specialty_code=array(''=>'未设置','11'=>'执业医师','12'=>'执业助理医师','13'=>'见习医师','21'=>'注册护士','22'=>'助产士','31'=>'西药师(士)','32'=>'中药师(士)','41'=>'检验技师(士)','42'=>'影像技师(士)','50'=>'卫生监督员','69'=>'其他卫生技术人员','70'=>'其他技术人员','80'=>'管理人员','90'=>'工勤及技能人员');
		
        if($region_id)
        {
            //有区域ID
            $region_path='';//定义region_path
            if($org_id)
            {
                //选择了具体的机构
                $organization=new Torganization();
                $organization->whereAdd("id = '$org_id'");
                $organization->find(true);
                $region_path=$organization->region_path;
                
            }
            else
            {
                //统计所属机构(管辖的所有机构)
                $region=new Tregion();
                $region->whereAdd("id='$region_id'");
                $region->find(true);
                $region_path=$region->region_path;
                
              
            }
            
            //开始取数据
            $staff_core		= new Tstaff_core();
            $staff_archive  = new Tstaff_archive();
            $staff_core->selectAdd("specialty_code");
            $staff_core->selectAdd("count(*) As counter");
            //$staff_archive->selectAdd('');
            $staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');          
            //var_dump($region_path);
            if(!empty($region_path))
            {
                $staff_core->whereAdd("staff_core.region_path like '$region_path%'");
            }else{
            	$staff_core->whereAdd("staff_core.region_path=''");
            }
            $staff_core->groupby("specialty_code");
            //$staff_core->debugLevel(3);
            $staff_core->find();
            $specialty_code_array=array();
            while ($staff_core->fetch()) {
            	$specialty_code_array[$staff_core->specialty_code]=$staff_core->counter;
            }
            
            //print_r($specialty_code_array);
            $this->view->staff_type_arr=$specialty_code_array;
        }
        else
        {
            //未选择区域错误
        }
        $this->view->specialty_code=$specialty_code;//人员类别
        $this->view->display("total.html");
    }
    //取指定区域下的ID
    public function agencyAction()
    {
        //取当前区域ID
        $region_id=$this->_request->getParam('region',$this->user['region_id']);
        $org_id=$this->user['org_id'];
        $region=new Tregion();
        $region->whereAdd("id='$region_id'");
        $region->find(true);
        $region_path=$region->region_path;
        $org="<option value=''>-所属机构-</option>";
        if($region_path)
        {
            $organization=new Torganization();
            $organization->whereAdd("region_path like '$region_path%'");
            $organization->find();
            while($organization->fetch())
            {
                if($org_id==$organization->id)
                {
                    $org.="<option value='".$organization->id."' selected='selected'>";
                }
                else
                {
                    $org.="<option value='".$organization->id."'>";
                }
                $org.=$organization->zh_name."</option>";
            }
        }
        echo $org;
        exit;
    }

}
?>
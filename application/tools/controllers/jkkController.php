<?php
/**
 * tools_jkkController
 * 
 * 完成健康卡平台数据的刷入
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class tools_jkkController extends controller
{
    public function init()
    {
        require_once __SITEROOT . "library/Models/individual_core.php";
        require_once __SITEROOT . "library/Models/individual_archive.php";
        require_once __SITEROOT . "library/Models/charge_style.php";
        require_once __SITEROOT . "library/Models/blood_type.php";
        require_once __SITEROOT . "library/Models/allergy.php";
        require_once __SITEROOT . "library/Models/vac_info.php";        
        require_once __SITEROOT . "library/Models/clinical_history.php";
        require_once __SITEROOT . "library/Models/organization.php";
        require_once __SITEROOT . "library/Models/t_jk_card.php";
    }
    public function indexAction()
    {
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        require_once __SITEROOT . '/library/custom/comm_function.php';
        //每次刷新多少条
        $limit=100;
        $current=$this->_request->getParam('page');
        $current=$current?$current:1;
        $total=intval($this->_request->getParam('t'));
        if(!$total)
        {
            $individual_core = new Tindividual_core();
            $total=$individual_core->count();
            $individual_core->free_statement();
        }
        $individual_core = new Tindividual_core();
        $start_num=$limit*($current-1);
        $individual_core->limit($start_num,$limit);
        $individual_core->find();
        while($individual_core->fetch())
        {
            //写入封面数据
            $individual_core_jkk=new Tt_jk_card(3);
            $individual_core_jkk->jkdah=$individual_core->standard_code_1;
            $individual_core_jkk->aac001=$individual_core->uuid;
            $individual_core_jkk->aac003=$individual_core->name;
            $individual_core_jkk->aac006=$individual_core->date_of_birth;
            $individual_core_jkk->aac004=array_search_for_other($individual_core->sex, $sex);
            $individual_core_jkk->aac002=$individual_core->identity_number;
            $individual_core_jkk->aac005=array_search_for_other($individual_core->race, $race);
            if($individual_core_jkk->aac005 && $individual_core_jkk->aac005!=1)
            {
                $individual_core_jkk->aac005=array_search_for_other($individual_core->race_detail, $races);
            }
            $individual_core_jkk->gkgxdt=$individual_core->updated;
            $individual_core_jkk->zjlb=$individual_core->identity_type;
            $individual_core_jkk->zjhm=$individual_core->identity_number;
            $individual_core_jkk->brdh_1=$individual_core->phone_number;
            $individual_core_jkk->dz_1=$individual_core->residence_address;
            $individual_core_jkk->dz_2=$individual_core->address;
            //写入基本档案数据
            $individual_archive=new Tindividual_archive();
            $individual_archive->whereAdd("id='".$individual_core->uuid."'");
            $individual_archive->find(true);
            $individual_core_jkk->aac017=array_search_for_other($individual_archive->marriage, $marriage);
            $individual_core_jkk->zydm=array_search_for_other($individual_archive->occupation, $occupation);
            $individual_core_jkk->aac011=array_search_for_other($individual_archive->study_history,$school_type);
            $individual_core_jkk->lxrxm_1=$individual_archive->contact;
            $individual_core_jkk->lxrdh_1=$individual_archive->contact_number;
            //取医疗支付方式
            $charge_style= new Tcharge_style();
            $charge_style->whereAdd("id='".$individual_core->uuid."'");
            $charge_style->find();
            $i=1;
            while($charge_style->fetch() && $i<4)
            {
                $params='ylzffs_'.$i;
                $individual_core_jkk->$params=array_search_for_other($charge_style->charge_style, $charge_style);
                $i++;
            }
            $charge_style->free_statement();
            //判断照片
            if (file_exists(__SITEROOT . "upload/" . $individual_core->uuid . ".gif"))
            {
                $individual_core_jkk->zpdz=$individual_core->uuid . ".gif";
                $individual_core_jkk->zpgxdt=$individual_core->updated;
            }
            $individual_core_jkk->sjgxdt=$individual_core->updated;
            $individual_core_jkk->xzqw_id=$individual_core->standard_code_1;
            //机构信息
            //$individual_core_jkk->yljg_id=$this->set_org_id($individual_core->org_id);
            $individual_core_jkk->yljg_id=$individual_core->org_id;
            //血型
            $blood_type=new Tblood_type();
            $blood_type->whereAdd("id='".$individual_core->uuid."'");
            $blood_type->find(true);
            if($blood_type->abo_bloodtype)
            {
                $individual_core_jkk->aboxxdm=array_search_for_other($blood_type->abo_bloodtype, $ABO_bloodtype);
            }
            if($blood_type->rh_bloodtype)
            {
                $individual_core_jkk->rhxxdm=array_search_for_other($blood_type->rh_bloodtype, $RH_bloodtype);
            }
            $blood_type->free_statement();
            //过敏史
            $allergy=new Tallergy();
            $allergy->whereAdd("id='".$individual_core->uuid."'");
            $allergy->find();
            $i=1;
            while($allergy->fetch() && $i<5)
            {
                $params='gmwmc_'.$i;
                $individual_core_jkk->$params=@$allergy_history[array_search_for_other($allergy->allergy_code, $allergy_history)][1];
                $i++;
            }
            $allergy->free_statement();
            //疾病史
            $clinical_history=new Tclinical_history();
            $clinical_history->whereAdd("id='".$individual_core->uuid."'");
            $clinical_history->whereAdd("disease_state='1'");
            $clinical_history->find();
            while($clinical_history->fetch())
            {
                if($clinical_history->disease_code=='2')
                {
                    //高血压
                }
                if($clinical_history->disease_code=='3')
                {
                    //糖尿病
                    $individual_core_jkk->tlbbz=1;
                }
                if($clinical_history->disease_code=='8')
                {
                    //精神分裂
                    $individual_core_jkk->jsbbz=1;
                }
            }
            $clinical_history->free_statement();
            //预防接种
            
            $individual_core_jkk->insert();
            $individual_core_jkk->free_statement();
        }
        $individual_core->free_statement();
        $current++;
        if($total>$start_num)
        {
            echo "<font color=red>正在操作，共有{$total}待写入档案，当前第".$start_num."条，剩余".($total-$start_num)."条...</font>";
       	    echo "<script>
    
    				var pgo=0;
    
          			function JumpUrl(){
    
            		if(pgo==0){ location='/tools/jkk/index/page/{$current}/t/{$total}'; pgo=1; }
    
          			}
    
    				setTimeout('JumpUrl()',0);
    
    				</script>";
       	    exit;
        }
        else
        {
            exit('已完成任务');
        }
    }
    /**
	 * 根据内部机构号获取机构代码
	 *
	 * @param string $org_id
	 * @return string
	 */
	protected function set_org_id($org_id)
	{
		$organization = new Torganization();
		$organization->whereAdd("id='$org_id'");
		$organization->find(true);
        $organization->free_statement();
		return $organization->standard_code;
	}
}
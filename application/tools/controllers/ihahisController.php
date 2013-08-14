<?php
/**
 * tools_ihahisController
 * 
 * 完成从中联传递的数据中，将手术史、疾病史、输血史记录合并写入我们的个人基本档案扩展表中
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class tools_ihahisController extends controller
{
    public function init()
    {
        require_once __SITEROOT . '/library/Models/individual_core.php';
        require_once __SITEROOT."library/Models/his_patinf_v.php";
        require_once __SITEROOT.'/library/custom/comm_function.php';
        $this->view->basePath = __BASEPATH;   
    }
    /**
     * tools_ihahisController::sssAction()
     * 
     * 导入手术史
     * 
     * 手术明细表(TB_Operation_Detail)中导入数据
     * 
     * @return void
     */
    public function sssAction()
    {
        require_once __SITEROOT . '/library/Models/surgical_history.php';
        require_once __SITEROOT . '/library/Models/Operation_Detail_v.php';
        $his_patinf = new This_patinf_v(2);
        $operation_detail = new Toperation_detail_v(2);
        $operation_detail->joinAdd('inner',$operation_detail,$his_patinf,'kh','kh');
        $operation_detail->joinAdd('inner',$operation_detail,$his_patinf,'klx','klx');
        //$operation_detail->whereAdd("his_patinf_v.identity_number!='' or his_patinf_v.identity_number is not null");
        //$operation_detail->debugLevel(5);
        $operation_detail->find();
        //无身份证号码人
        $no_identity=0;
        //更新条数
        $update=0;
        //插入条数
        $insert=0;
        //平台不存在的人
        $no_individual=0;
        $time=time();
        while($operation_detail->fetch())
        {
            if($his_patinf->identity_number)
            {
                //判断手术史记录对应身份证号码是否存在个人档案中
                $individual_core=new Tindividual_core();
                $individual_core->whereAdd("identity_number='".$his_patinf->identity_number."'");
                $individual_core->find(true);
                $iha_uuid=$individual_core->uuid;
                $individual_core->free_statement();
                if($iha_uuid)
                {
                    //读取并写入手术史记录
                    $surgical_history = new Tsurgical_history();
                    $surgical_history->whereAdd("ext_uuid='".$operation_detail->ssmxlsh."'");
                    //处理手术时间
                    $sssj=$operation_detail->sskssj?$operation_detail->sskssj:($operation_detail->ssjssj?$operation_detail->ssjssj:'');
                    if($sssj)
                    {
                        preg_match('/(?<d>\d{2})-(?<m>\d{1,2})月\s*-(?<y>\d{2})/',$sssj,$m);
                        $sssj=strtotime($m['y'].'-'.$m['m'].'-'.$m['d']);
                    }
                    if($surgical_history->count())
                    {
                        //存在则更新
                        $surgical_history->id = $iha_uuid;
                        $surgical_history->created = $time;
                        $surgical_history->updated = $time;
                        $surgical_history->operation_id = $operation_detail->ssczmc;
                        $surgical_history->operation_date = $sssj;
                        $surgical_history->whereAdd("ext_uuid='".$operation_detail->ssmxlsh."'");
                        $surgical_history->update();
                        $update++;
                    }
                    else
                    {
                        //不存在则插入
                        $surgical_history->id = $iha_uuid;
                        $surgical_history->created = $time;
                        $surgical_history->updated = $time;
                        $surgical_history->status_flag = 1;
                        $surgical_history->uuid = uniqid("S_");
                        $surgical_history->life_cycle = $time;
                        $surgical_history->operation_id = $operation_detail->ssczmc;
                        $surgical_history->ext_uuid=$operation_detail->ssmxlsh;
                        $surgical_history->operation_date = $sssj;
                        $surgical_history->insert();
                        $insert++;
                    }
                    $surgical_history->free_statement();
                }
                else
                {
                    $no_individual++;
                }
            }
            else
            {
                $no_identity++;
            }
        }
        //写文件日志
        $fp=fopen(__SITEROOT.'cache/sss_logs.log','a+');
        fwrite($fp,date('Y-m-d H:i:s').'刷新手术史记录，其中插入'.$insert.'条，更新'.$update.'条，无身份证错误数据'.$no_identity.'条，平台不存在档案数'.$no_individual.'条'."\n");
        fclose($fp);
        echo date('Y-m-d H:i:s').'刷新手术史记录，其中插入'.$insert.'条，更新'.$update.'条，无身份证错误数据'.$no_identity.'条，平台不存在档案数'.$no_individual.'条';
    }
    /**
     * tools_ihahisController::sxsAction()
     * 
     * 导入输血史
     * 
     * 用血明细表(TB_XZ_Used_Blood_Detail)此表中导入数据
     * 
     * @return void
     */
    public function sxsAction()
    {
        require_once __SITEROOT . '/library/Models/transfusion.php';
        require_once __SITEROOT . '/library/Models/XZ_Used_Blood_Detail_v.php';
        $blood_detail = new TXZ_Used_Blood_Detail_v(2);
        $blood_detail->find();
        //无身份证号码人
        $no_identity=0;
        //更新条数
        $update=0;
        //插入条数
        $insert=0;
        //平台不存在的人
        $no_individual=0;
        $time=time();
        while($blood_detail->fetch())
        {
            if($blood_detail->id)
            {
                //判断输血史记录对应身份证号码是否存在个人档案中
                $individual_core=new Tindividual_core();
                $individual_core->whereAdd("identity_number='".$blood_detail->id."'");
                $individual_core->find(true);
                $iha_uuid=$individual_core->uuid;
                $individual_core->free_statement();
                if($iha_uuid)
                {
                    //读取并写入输血史记录
                    $transfusion = new Ttransfusion();
                    $transfusion->whereAdd("ext_uuid='".$blood_detail->ext_uuid."'");
                    //处理输血时间
                    $sxsj=$blood_detail->tbrq?$blood_detail->tbrq:'';
                    if($sxsj)
                    {
                        preg_match('/(?<d>\d{2})-(?<m>\d{1,2})月\s*-(?<y>\d{2})/',$sxsj,$m);
                        $sxsj=strtotime($m['y'].'-'.$m['m'].'-'.$m['d']);
                    }
                    if($transfusion->count())
                    {
                        //存在则更新
                        $transfusion->id = $iha_uuid;
                        $transfusion->created = $time;
                        $transfusion->updated = $time;
                        $transfusion->quantity = $blood_detail->yxl.$blood_detail->yxjldw;
                        $transfusion->transfusion_date = $sxsj;
                        $transfusion->whereAdd("ext_uuid='".$blood_detail->ext_uuid."'");
                        $transfusion->update();
                        $update++;
                    }
                    else
                    {
                        //不存在则插入
                        $transfusion->id = $iha_uuid;
                        $transfusion->created = $time;
                        $transfusion->updated = $time;
                        $transfusion->status_flag = 1;
                        $transfusion->uuid = uniqid("T_");
                        $transfusion->life_cycle = $time;
                        $transfusion->quantity = $blood_detail->yxl.$blood_detail->yxjldw;
                        $transfusion->ext_uuid=$blood_detail->id;
                        $transfusion->transfusion_date = $sxsj;
                        $transfusion->insert();
                        $insert++;
                    }
                    $transfusion->free_statement();
                }
                else
                {
                    $no_individual++;
                }
            }
            else
            {
                $no_identity++;
            }
        }
        //写文件日志
        $fp=fopen(__SITEROOT.'cache/sxs_logs.log','a+');
        fwrite($fp,date('Y-m-d H:i:s').'刷新输血史记录，其中插入'.$insert.'条，更新'.$update.'条，无身份证错误数据'.$no_identity.'条，平台不存在档案数'.$no_individual.'条'."\n");
        fclose($fp);
        echo date('Y-m-d H:i:s').'刷新输血史记录，其中插入'.$insert.'条，更新'.$update.'条，无身份证错误数据'.$no_identity.'条，平台不存在档案数'.$no_individual.'条';
    }
    /**
     * tools_ihahisController::jbsAction()
     * 
     * 导入疾病史
     * 
     * 诊断明细表(TB_IH_Diagnosis_Detail)中取数据
     * 
     * @return void
     */
    public function jbsAction()
    {
        set_time_limit(0);
        require_once __SITEROOT . '/library/Models/clinical_history.php';
        require_once __SITEROOT . '/library/Models/IH_Diagnosis_Detail_v.php';
        //定义一个疾病数组
        $disease_c=array('I10xx','E11','F09','I49.811','J44.901','I64xx04','16.901');
        //无身份证号码人
        $no_identity=0;
        //更新条数
        $update=0;
        //插入条数
        $insert=0;
        //平台不存在的人
        $no_individual=0;
        $time=time();
        foreach($disease_c as $k=>$v)
        {
            $his_patinf = new This_patinf_v(2);
            $jbs_detail = new Tih_diagnosis_detail_v(2);
            $jbs_detail->joinAdd('inner',$jbs_detail,$his_patinf,'kh','kh');
            $jbs_detail->joinAdd('inner',$jbs_detail,$his_patinf,'klx','klx');
            $jbs_detail->whereAdd("ih_diagnosis_detail_v.zdbm like '$v%'");
            $jbs_detail->find();
            while($jbs_detail->fetch())
            {
                if($his_patinf->identity_number)
                {
                    //判断疾病史记录对应身份证号码是否存在个人档案中
                    $individual_core=new Tindividual_core();
                    $individual_core->whereAdd("identity_number='".$his_patinf->identity_number."'");
                    $individual_core->find(true);
                    $iha_uuid=$individual_core->uuid;
                    $individual_core->free_statement();
                    if($iha_uuid)
                    {
                        //读取并写入疾病史记录
                        $clinical_history = new Tclinical_history();
                        $clinical_history->whereAdd("ext_uuid='".$jbs_detail->zyzdlsh."'");
                        //处理疾病确诊时间
                        $qzsj=$jbs_detail->zdsj?$jbs_detail->zdsj:'';
                        if($qzsj)
                        {
                            preg_match('/(?<d>\d{2})-(?<m>\d{1,2})月\s*-(?<y>\d{2})/',$qzsj,$m);
                            $qzsj=strtotime($m['y'].'-'.$m['m'].'-'.$m['d']);
                        }
                        if(substr($jbs_detail->zdbm,0,5)=='I10xx')
                        {
                            //高血压
                            $disease_code=2;
                            $disease_name='高血压';
                        }
                        elseif(substr($jbs_detail->zdbm,0,3)=='E11')
                        {
                            //II型糖尿病 E11.901
                            $disease_code=3;
                            $disease_name='糖尿病';
                        }
                        elseif(substr($jbs_detail->zdbm,0,3)=='F09')
                        {
                            //重性精神病
                            $disease_code=8;
                            $disease_name='重性精神病';
                        }
                        elseif($jbs_detail->zdbm=='I49.811')
                        {
                            //冠心病 I49.811
                            $disease_code=4;
                            $disease_name='冠心病';
                        }
                        elseif($jbs_detail->zdbm=='J44.901')
                        {
                            //慢性阻塞性肺疾病 J44.901
                            $disease_code=5;
                            $disease_name='慢性阻塞性肺疾病';
                        }
                        elseif(strpos($jbs_detail->zdmc,'恶性肿瘤')!==false)
                        {
                            //恶性肿瘤 这个太多，只能找名字
                            $disease_code=6;
                            $disease_name='恶性肿瘤';
                        }
                        elseif($jbs_detail->zdbm=='I64xx04')
                        {
                            //脑卒中 I64xx04
                            $disease_code=7;
                            $disease_name='脑卒中';
                        }
                        elseif($jbs_detail->zdbm=='A16.901')
                        {
                            //结核病 A16.901
                            $disease_code=5;
                            $disease_name='结核病';
                        }
                        else
                        {
                            $clinical_history->free_statement();
                            continue;
                        }
                        $clinical_history->whereAdd("id='$iha_uuid' and disease_code='$disease_code'");
                        if($clinical_history->count())
                        {
                            //存在则更新
                            $clinical_history->id = $iha_uuid;
                            $clinical_history->created = $time;
                            $clinical_history->updated = $time;
                            $clinical_history->disease_name = $disease_name;
                            $clinical_history->disease_code = $disease_code;
                            $clinical_history->disease_state = 1;
                            $clinical_history->disease_date = $qzsj;
                            $clinical_history->whereAdd("id='$iha_uuid' and disease_code='$disease_code'");
                            $clinical_history->update();
                            $update++;
                        }
                        else
                        {
                            //不存在则插入
                            $clinical_history->id = $iha_uuid;
                            $clinical_history->created = $time;
                            $clinical_history->updated = $time;
                            $clinical_history->status_flag = 1;
                            $clinical_history->uuid = uniqid("G_");
                            $clinical_history->life_cycle = $time;
                            $clinical_history->groupid=uniqid("G_");
                            $clinical_history->disease_name = $disease_name;
                            $clinical_history->disease_code = $disease_code;
                            $clinical_history->ext_uuid=$jbs_detail->ssmxlsh;
                            $clinical_history->disease_state = 1;
                            $clinical_history->disease_date = $qzsj;
                            $clinical_history->ext_uuid=$jbs_detail->zyzdlsh;
                            $clinical_history->insert();
                            $insert++;
                        }
                        $clinical_history->free_statement();
                    }
                    else
                    {
                        $no_individual++;
                    }
                }
                else
                {
                    $no_identity++;
                }
            }
            $jbs_detail->free_statement();
        }
        //写文件日志
        $fp=fopen(__SITEROOT.'cache/jbs_logs.log','a+');
        fwrite($fp,date('Y-m-d H:i:s').'刷新疾病史记录，其中插入'.$insert.'条，更新'.$update.'条，无身份证错误数据'.$no_identity.'条，平台不存在档案数'.$no_individual.'条'."\n");
        fclose($fp);
        echo date('Y-m-d H:i:s').'刷新疾病史记录，其中插入'.$insert.'条，更新'.$update.'条，无身份证错误数据'.$no_identity.'条，平台不存在档案数'.$no_individual.'条';
    }
}
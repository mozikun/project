<?php

/*
 * 2013.8.14  写患者就诊状态实时监管接口 
 * author：ct
 * created：2013.8.14
 * 
 */
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";
class api_phs_iha_card_status extends api_phs_comm
{
	/**
	 * 验证是否登录
	 *
	 * @param unknown_type $org_id
	 * @param unknown_type $password
	 * @return unknowna
	 */
	function ws_login($org_id,$password)
                   {
	       return login($org_id,$password);
	}
                  /**
                   * 用于搜集病人就诊时的卡状态
                   */
                  function  ws_update($token,$xml_string)
                  {
                       require_once __SITEROOT.'/library/custom/comm_function.php';
                       require_once __SITEROOT.'/library/Models/iha_card_status.php';
                       require_once __SITEROOT.'/library/Models/individual_core.php';
                       $xmlhead = "<?xml version='1.0' encoding='UTF-8'?><message>";
                       $xmlend  = "</message>";
                       $successsstring ='';
                       $errorstring = '';
                       $returnstring = '';
                       $error =1;
                       $error_number = 0;
                       $success_number = 0;                   
                       if(empty($xml_string))
                       {
                           return $xmlhead.'您没有传入xml请检查'.$xmlend;
                       }
                       else
                       {
                           //传入xml后解析xml
                           $xml =  new SimpleXMLElement($xml_string);
                           $table_name = $xml['name'];
                           foreach($xml as $k=>$element)
                           {   
                               //var_dump($element);
                               $api_phs_comm = new api_phs_comm;
                               //取得机构代码
                               $org_id = $api_phs_comm->get_org_id($element->org_id);
                               if(empty($org_id))
                               {
                                   $error = 2;
                                   $errorstring.=  '<row>身份证为'.$element->identity_number.'的病人就诊的机构为空或者不存在</row>';
                                   $error_number++;
                                   continue;
                               }
                               else
                               {
                                   if(empty($element->identity_number))
                                   {
                                        $error = 2;
                                        $errorstring.= '<row>身份证为空</row>';
                                        $error_number++;
                                        continue;
                                   }
                                   else
                                   {
                                        //判断这个人在平台基本档案是否存在
                                        $individual_core = new Tindividual_core();
                                        $individual_core->whereAdd("identity_number='$element->identity_number'");
                                        if($individual_core->count()<1)
                                        {
                                             $error = 2;
                                             $errorstring.= '<row>身份证为'.$element->identity_number.'的病人不存在</row>';
                                             $error_number++;
                                             continue;
                                        }
                                        else
                                        {
                                            //该病人存在  业务号不能为空
                                            if(empty($element->ext_uuid))
                                            {
                                                $error = 2;
                                                $errorstring.= '<row>身份证为'.$element->identity_number.'的患者业务号不能为空</row>';
                                                $error_number++;
                                                continue;
                                            }
                                            else
                                            {
                                                //判断科室名称或者患者状态是否为空
                                                if(empty($element->status)||empty($element->department_name))
                                                {
                                                    $error = 2;
                                                    $errorstring.= '<row>身份证为'.$element->identity_number.'的患者状态或者科室名称不能为空</row>';
                                                    $error_number++;
                                                    continue;
                                                }
                                                else
                                                {
                                                    //处理医生身份证号
                                                   $staff_id =  $api_phs_comm->set_doctor_number($element->staff_id);
                                                   //判断这条记录在表中是否存在 来判断是添加还是更新
                                                   $iha_card_status = new Tiha_card_status();
                                                   $iha_card_status->whereAdd("identity_number='$element->identity_number'");
                                                   $iha_card_status->whereAdd("ext_uuid='$element->ext_uuid'");
                                                   if($iha_card_status->count()!=1)
                                                   {
                                                       $add = true;
                                                   }
                                                   else
                                                   {
                                                       $add = false;
                                                   }
                                                   $iha_card_status->free_statement();
                                                   //向表中做更新或者添加操作
                                                   $created_time = time();
                                                   $update_time  = time();
                                                   $opration_card =  new Tiha_card_status();
                                                   $opration_card->org_id = $org_id;
                                                   $opration_card->identity_number = $element->identity_number;
                                                   $opration_card->staff_id = $staff_id;
                                                   $opration_card->department_id = $element->department_id;
                                                   $opration_card->department_name = $element->department_name;
                                                   $opration_card->actions = $element->actions;
                                                   $opration_card->status = $element->status;
                                                   $opration_card->ext_uuid = $element->ext_uuid;
                                                   $opration_card->serial_number = $element->serial_number;
                                                   if($add)
                                                   {
                                                       //添加部分
                                                       $opration_card->uuid = uniqid('card_',true);
                                                       $opration_card->created = $created_time;
                                                       $opration_card->updated = $update_time;
                                                      // $opration_card->debugLevel(9);
                                                       if($opration_card->insert())
                                                       {
                                                           $error =1;
                                                           $successsstring.= '<row>'.$element->identity_number.'</row>';
                                                           $success_number++;
                                                       }
                                                       else
                                                       {
                                                           $error=2;
                                                           $errorstring.= '<row>'.$element->identity_number.'</row>';
                                                           $error_number++;
                                                           continue;
                                                       }
                                                   }
                                                   else
                                                   {
                                                       //更新部分
                                                       $opration_card->whereAdd("identity_number='$element->identity_number'");
                                                       $opration_card->whereAdd("ext_uuid='$element->ext_uuid'");
                                                       $opration_card->updated = $update_time;
                                                       if($opration_card->update())
                                                       {
                                                           $error =1;
                                                           $successsstring.= '<row>'.$element->identity_number.'</row>';
                                                           $success_number++;
                                                       }
                                                       else
                                                       {
                                                           $error=2;
                                                           $errorstring.= '<row>'.$element->identity_number.'</row>';
                                                           $error_number++;
                                                           continue;
                                                       }
                                                   }
                                                   $opration_card->free_statement();
                                                }
                                            }
                                        }
                                        $individual_core->free_statement();
                                   }
                               }
                           }
                       }
                       //输出文档处理的结果
                       return  $xmlhead.'<success_transaction>'.$successsstring.'</success_transaction><error_transaction>'.$errorstring.'</error_transaction><return_string>数据插入或者更新成功'.$success_number.'条,数据插入或更新失败'.$error_number.'条</return_string>'.$xmlend;
                  }
}
?>

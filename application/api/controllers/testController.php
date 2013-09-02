<?php
class api_testController extends controller
{
    public function indexAction()
    {
        $client=new SoapClient("http://zl.yawsw.com/wsdl/api_phs_iha_cover.wsdl");
        $xml_string="<?xml version='1.0' encoding='UTF-8'?>
<tables>
<table name='individual_core'>
  <row>
    <org_id>45256439-2</org_id>
    <identity_number>513321198312205441</identity_number>
    <ext_uuid>5118242110006_271945554015</ext_uuid>
    <staff_id>513101198204020021</staff_id>
    <response_doctor>513101198204020021</response_doctor>
    <created>1339459200</created>
    <updated>1339459200</updated>
    <standard_code />
    <region_path_inner_id />
    <status_flag>1</status_flag>
    <name>张杨美</name>
    <identity_extra />
    <phone_number>13551562845</phone_number>
    <address>四川省雅安市石棉县新民藏族彝族乡太坪村村委会一组</address>
    <residence_address>四川省雅安市石棉县新民藏族彝族乡太坪村村委会一组</residence_address>
    <householder_identity_number>513321198312205441</householder_identity_number>
    <householder_name>张杨美</householder_name>
    <family_number />
    <relation_holder>1</relation_holder>
    <inner_id>1</inner_id>
    <family_inner_id />
    <region_path>0,100000,510000,511800,511824,211</region_path>
  </row>
</table>
</tables>";
        echo $client->ws_update('aaa',$xml_string);
    }
}
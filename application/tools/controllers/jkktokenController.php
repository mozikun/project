<?php
/**
 * tools_jkktokenController
 * 
 * 将与银海中间数据库中已发卡的数据更新个人档案标致。
 * 为应付检查做的刷数据
 *
 */
class tools_jkktokenController extends controller
{
    public function init()
    {
        require_once __SITEROOT . "library/Models/individual_core.php";       
        require_once __SITEROOT . "library/Models/t_jk_card.php";
    }
    public function indexAction()
    {
      $t_jk_card=new Tt_jk_card(3);
      $t_jk_card->selectAdd('zjhm');
      $t_jk_card->whereAdd("card_atr is not null ");
      //$t_jk_card->debug(2);
      $t_jk_card->find();
      $i=0;
      while ($t_jk_card->fetch()) {
      	 $zjhm=$t_jk_card->zjhm;//身份证号
      	 $zjhm_length=strlen($zjhm);//身份证号长度
      	 if($zjhm_length==15 or $zjhm_length==18 ){
      	 	$individual_core=new Tindividual_core();
      	 	$individual_core->whereAdd("identity_number='$zjhm'");
      	 	$individual_core->card_status='1';
      	 	if($individual_core->update()){
      	 		$i++;
      	 	}
      	 	$individual_core->free_statement();
      	 	
      	 	
      	 }
      }
      echo "更新".$i."条";
       
      $t_jk_card->free_statement();
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
<?php
/**
 * @author lsm
 * @copyright 2013
 * @deprecated 用于转档案没有转机构id
 * 
 */
class tools_orgidController extends controller 
{
	public function init()
	{
		require_once(__SITEROOT . '/library/custom/comm_function.php');
		require_once(__SITEROOT . '/library/Models/individual_core.php');
		require_once(__SITEROOT . '/library/Models/region.php');
		require_once(__SITEROOT . '/library/Models/organization.php');
        $this->view->basePath = $this->_request->getBasePath();
	}
	public function indexAction()
	{
		$individual_core= new Tindividual_core();
		$individual_core->query("select individual_core.uuid,SUBSTR(individual_core.region_path,0, INSTR(individual_core.region_path, ',',1,6)-1) as region_path from individual_core left join organization on individual_core.org_id=organization.id where SUBSTR(individual_core.region_path,0, INSTR(individual_core.region_path, ',',1,6)-1)!=organization.region_path and organization.region_path_domain=organization.region_path");
		$i=0;
		$j=0;
		while ($individual_core->fetch())
		{
			$organization= new Torganization();
            $organization->whereAdd("region_path = '".$individual_core->region_path."'");
			$organization->find(true);
			if ($organization->id)
			{
				$individual= new Tindividual_core();
				$individual->whereAdd("uuid='".$individual_core->uuid."'");
				$individual->org_id=$organization->id;
                $individual->syn_flag='99';
				if($individual->update())
				{
				    $i++;
				}
                else
                {
				    $j++;
				}
			}
		}
        echo '成功更新'.$i.'条记录';

	}
}
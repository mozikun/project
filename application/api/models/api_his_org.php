<?php
/****
 * @author whx
 * @todo 机构信息查询
 * @time 2013-05-15
 * *********** */
require_once __SITEROOT . "application/api/models/api_phs_iha_comm.php";

class hisorg extends api_phs_comm
{

    private $_error_message_start;
    private $_error_message_end;
    private $role_id;

    public function __construct()
    {

        require_once __SITEROOT . '/library/custom/comm_function.php'; //公有函数
        require_once __SITEROOT . "library/Models/organization.php"; //机构表
        require_once __SITEROOT . "application/api/models/api_phs_common.php";
        
        $this->_error_message_start = "<?xml version='1.0' encoding='UTF-8'?><message>";
        $this->_error_message_end = "</message>";
    }
	 
		
	/* ******************
     * 机构查询
     * ****************** */
	public function ws_select($token, $xml_request){
		$xml = new SimpleXMLElement($xml_request);
		
		$organization=new Torganization();
		
		$organization->find();
		$xml_return = "<?xml version='1.0' encoding='UTF-8'?><table name='organization'>";
		while($organization->fetch()){
			$xml_return.="<row>";
            $xml_return.="<org_id>".$organization->standard_code."</org_id>"."<org_name>".$organization->zh_name."</org_name>";
            $xml_return.="</row>";
		}
		$xml_return.="</table>";
		return $xml_return;
	 }
	
	

}

?>
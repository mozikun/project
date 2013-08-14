<?php
/**
 * positionController
 * 
 * 用于完成获取用户的经纬度
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class positionController extends controller
{
    public function init()
    {
        
    }
    /**
     * positionController::indexAction()
     * 
     * //从地址获取经纬度
     * http://api.map.baidu.com/geocoder?address=%E4%B8%8A%E5%9C%B0%E5%8D%81%E8%A1%9710%E5%8F%B7&output=xml&key=37492c0ee6f924cb5e934fa08c6b1676根据“上地十街十号”返回坐标“lng:116.307175, lat:40.057098”，以xml格式输出      
     * 
     * @return void
     */
    public function indexAction()
    {
        $key="e559931e51e2a55bafdff098d046bb65";
        require_once __SITEROOT . "library/Models/individual_core.php";
        require_once __SITEROOT . "library/Models/region.php";
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
            //取省和市
            $region_path=@explode(',',$individual_core->region_path);
            $address='';
            for($i=2;$i<count($region_path);$i++)
            {
                $region=new Tregion();
                $region->whereAdd("id='".$region_path[$i]."'");
                $region->find(true);
                $address.=$region->zh_name;
            }
            $url="http://api.map.baidu.com/geocoder?address=".urlencode($address)."&output=xml&key=".$key;
            $xml_content=file_get_contents($url);
            $position_obj = simplexml_load_string($xml_content, 'SimpleXMLElement', LIBXML_NOCDATA);
            $position_x=$position_obj->result[0]->location[0]->lat;
            $position_y=$position_obj->result[0]->location[0]->lng;
            //写入基本档案数据
            $individual_core_update=new Tindividual_core();
            $individual_core_update->whereAdd("uuid='".$individual_core->uuid."'");
            $individual_core_update->position_x=$position_x;
            $individual_core_update->position_y=$position_y;
            $individual_core_update->update();
            $individual_core_update->free_statement();
        }
        $individual_core->free_statement();
        $current++;
        if($total>$start_num)
        {
            echo "<font color=red>正在操作，共有{$total}待写入档案，当前第".$start_num."条，剩余".($total-$start_num)."条...</font>";
       	    echo "<script>
    
    				var pgo=0;
    
          			function JumpUrl(){
    
            		if(pgo==0){ location='/tools/position/index/page/{$current}/t/{$total}'; pgo=1; }
    
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
}
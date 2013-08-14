<?php
/**
 * web_hospitalController
 * 
 * 处理医院列表
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class web_hospitalController extends controller
{
    public function init()
    {
        require_once __SITEROOT."library/Models/organization.php";
        require_once __SITEROOT."library/Models/appointment_register.php";
        require_once __SITEROOT."library/Models/staff_core.php";
        require_once __SITEROOT."library/Models/web_sort.php";
        require_once __SITEROOT."library/Models/individual_core.php";
        require_once __SITEROOT."library/Models/web_article_content.php";
        require_once __SITEROOT."library/custom/comm_function.php";
        //取公共顶部内容
        $this->view->basePath = $this->_request->getBasePath();
        //取首页栏目
        $web_sort=new Tweb_sort();
        $web_sort->whereAdd("parent_uuid='0'");
        $web_sort->limit(0,20);
        $web_sort->find();
        $i=0;
        $sorts=array();
        while($web_sort->fetch())
        {
            $sorts[$i]['uuid']=$web_sort->uuid;
            $sorts[$i]['py']=$web_sort->sortname_py;
            $sorts[$i]['name']=$web_sort->sortname;
            $i++;
        }
        $this->view->sorts=$sorts;
        $arr=array("天","一","二","三","四","五","六");
        $this->view->timer=date("Y年m月d日 ").' 星期'.$arr[date('w')];
    }
    /**
     * web_hospitalController::indexAction()
     * 
     * 如果是登陆后，则显示此人附近的医院
     * 
     * 列表方式显示医院
     * 
     * 算法参考：http://digdeeply.org/archives/06152067.html
     * 
     * @return void
     */
    public function indexAction()
    {
        require_once __SITEROOT."/library/custom/pager.php";
        $search=array();
        $search['display']=$this->_request->getParam('display');
        $search_session=new Zend_Session_Namespace("iha_search");
        $card=$search_session->identity_number;//身份证号码
        $org=new Torganization();
        $org->whereAdd("type=5");
        $tips='';
        $position_x='';
        $position_y='';
        if($card)
        {
            //已登陆，取个人的GPS信息
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("identity_number='$card'");
            $individual_core->find(true);
            $position_x=$individual_core->position_x;
            $position_y=$individual_core->position_y;
            if($individual_core->position_x && $individual_core->position_y && $search['display']!='all')
            {
                //使用此函数计算得到结果后，带入sql查询。
                $squares = $this->returnSquarePoint($individual_core->position_y, $individual_core->position_x,50);
                $org->whereAdd("latitude<>0 and latitude>{$squares['right-bottom']['lat']} and latitude<{$squares['left-top']['lat']} and longitude>{$squares['left-top']['lng']} and longitude<{$squares['right-bottom']['lng']}");
                $tips=$individual_core->name.'您好，我们将根据您的位置列出您附近50千米以内的医院信息';
            }
            else
            {
                $tips=$individual_core->name.',对不起，未能确定您的位置，无法标示您附近的医院。';
            }
        }
        else
        {
            //未登陆
            $tips='你没有登陆，我们不能确定您的位置，无法标示您附近的医院。';
        }
        $nums=$org->count();
  		$pageCurrent = intval($this->_request->getParam('page'));
  		$pageCurrent = $pageCurrent?$pageCurrent:1;
  		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        $links = new SubPages(8,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'web/hospital/index/page/',2,$search);
        $pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
        $startnum = 8*($pageCurrent-1);  //计算开始记录数
        $org->limit($startnum,8);
        $org->find();
        $org_all=array();
        $i=0;
        while($org->fetch())
        {
            $org_all[$i]['id']=$org->id;
            $org_all[$i]['zh_name']=$org->zh_name;
            $org_all[$i]['address']=$org->address;
            $org_all[$i]['phone']=$org->phone;
            if($position_x && $position_y && $org->latitude && $org->longitude)
            {
                $org_all[$i]['juli']=round($this->getdistance($position_y,$position_x,$org->longitude,$org->latitude)/1000,2);
            }
            $i++;
        }
        $this->view->org_all=$org_all;
        $out = $links->subPageCss2();
        $this->view->assign("pager",$out);
        $this->view->tips=$tips;
        $this->view->card=$card;
        $this->view->search=$search;
        $this->view->display("index.html");
    }
    /**
     * web_hospitalController::mapAction()
     * 
     * 如果是登陆后，以登陆人坐标为地图中心点
     * 
     * 地图方式显示医院
     * 
     * @return void
     */
    public function mapAction()
    {
        
    }
    /**
     * web_hospitalController::detailAction()
     * 
     * 查看详细
     * 
     * @return void
     */
    public function detailAction()
    {
        $id=$this->_request->getParam('id');
        if($id)
        {
            $org=new Torganization();
            $org->whereAdd("type=5");
            $org->whereAdd("id='$id'");
            $org->find(true);
            if($org->id)
            {
                $this->view->org=$org;
                //取医院
                $org=new Torganization();
                $org->whereAdd("type=5");
                $org->limit(0,4);
                $org->find();
                $orgs=array();
                $i=0;
                while($org->fetch())
                {
                    $orgs[$i]['id']=$org->id;
                    $orgs[$i]['zh_name']=$org->zh_name;
                    $i++;
                }
                $this->view->orgs=$orgs;
                $this->view->display("detail.html");
            }
            else
            {
                $url=array("机构列表"=>__BASEPATH.'web/hospital/index');
                message("对不起，该机构不存在",$url);
            }
        }
        else
        {
            $url=array("机构列表"=>__BASEPATH.'web/hospital/index');
            message("对不起，机构代码错误",$url);
        }
    }
    /**
    *计算某个经纬度的周围某段距离的正方形的四个点
    *
    *@param lng float 经度
    *@param lat float 纬度
    *@param distance float 该点所在圆的半径，该圆与此正方形内切，默认值为0.5千米
    *@return array 正方形的四个点的经纬度坐标
    */
    private function returnSquarePoint($lng,$lat,$distance=0.5)
    {
        //define(EARTH_RADIUS,6371);//地球半径，平均半径为6371km
        $dlng=2*asin(sin($distance/(2*6371))/cos(deg2rad($lat)));
        $dlng=rad2deg($dlng);
        $dlat=$distance/6371;
        $dlat=rad2deg($dlat);
        return array('left-top'=>array('lat'=>$lat+$dlat,'lng'=>$lng-$dlng),'right-top'=>array('lat'=>$lat+$dlat, 'lng'=>$lng+$dlng),'left-bottom'=>array('lat'=>$lat-$dlat, 'lng'=>$lng-$dlng),'right-bottom'=>array('lat'=>$lat-$dlat, 'lng'=>$lng+$dlng));
    }
    /**
    *求两个已知经纬度之间的距离,单位为米
    *@param lng1,lng2 经度
    *@param lat1,lat2 纬度
    *@return float 距离，单位米
    **/
    private function getdistance($lng1,$lat1,$lng2,$lat2)//根据经纬度计算距离
    {
        //将角度转为狐度
        $radLat1=deg2rad($lat1);
        $radLat2=deg2rad($lat2);
        $radLng1=deg2rad($lng1);
        $radLng2=deg2rad($lng2);
        $a=$radLat1-$radLat2;//两纬度之差,纬度<90
        $b=$radLng1-$radLng2;//两经度之差纬度<180
        $s=2*asin(sqrt(pow(sin($a/2),2)+cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)))*6378.137*1000;
        return $s;
    }
}
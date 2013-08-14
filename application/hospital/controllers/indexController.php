<?php
 class hospital_indexController extends controller 
 {
 	public function init()
 	{
 		require_once __SITEROOT."library/Models/organization.php";
 		$this->view->basePath = __BASEPATH;
 	}
 	public function listAction()
 	{
 		$lng_lat = $this->_request->getParam('lng_lat');
 		$device_id = $this->_request->getParam('device_id');
 		if(!empty($lng_lat))
 		{
 			$lng_lat_array = explode('|',$lng_lat);
	 		$lat = $lng_lat_array[0];
	 		$lng = $lng_lat_array[1];
			$squares =  $this->returnSquarePoint($lng,$lat,$distance = 1);
			$right_bottom_lat = $squares['right-bottom']['lat'];
			$right_bottom_lng = $squares['right-bottom']['lng'];
			$left_top_lat = $squares['left-top']['lat'];
			$left_top_lng = $squares['left-top']['lng'];
		    $organization = new Torganization();
		    $organization->whereAdd("latitude!=0 and latitude>$right_bottom_lat and latitude<$left_top_lat and longitude>$left_top_lng and longitude<$right_bottom_lng "); 
		    //$organization->debugLevel(9);
		    $number = $organization->count(); 
		    $organization->find();
		    $i = 0;
		    $orgarray = array();
		    while ($organization->fetch())
		    {
		    	$orgarray[$i]['zh_name'] =  $organization->zh_name;
		    	$orgarray[$i]['id'] =  $organization->id;
		    	$orgarray[$i]['lat_lng'] =  $organization->latitude.'~'.$organization->longitude;
		    	$orgarray[$i]['lat_lng_url'] =  $organization->latitude.'|'.$organization->longitude;
		    	$i++;  	
		    }
 		}
	    $this->view->orgarray = @$orgarray;
	    $this->view->device_id = $device_id;
 		$this->view->number = empty($number)?0:$number;
 		//echo implode('~',$lng_lat_array);
 		
 		$this->view->display('list.html');
 	}
   
 /**
 *计算某个经纬度的周围某段距离的正方形的四个点
 *
 *@param lng float 经度
 *@param lat float 纬度
 *@param distance float 该点所在圆的半径，该圆与此正方形内切，默认值为0.5千米
 *@return array 正方形的四个点的经纬度坐标
 */
	 function returnSquarePoint($lng, $lat,$distance = 0.5)
	 {
	    //define(EARTH_RADIUS, 6371);//地球半径，平均半径为6371km
		$dlng =  2 * asin(sin($distance / (2 * 6371))/cos(deg2rad($lat)));
		$dlng = rad2deg($dlng);
		$dlat = $distance/6371;
		$dlat = rad2deg($dlat);
		return array(
					'left-top'=>array('lat'=>$lat + $dlat,'lng'=>$lng-$dlng),
					'right-top'=>array('lat'=>$lat + $dlat, 'lng'=>$lng + $dlng),
					'left-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng - $dlng),
					'right-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng + $dlng)
					);
	 }
 }
?>
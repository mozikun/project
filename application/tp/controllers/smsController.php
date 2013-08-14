<?php
/*
 *已发送短信统计
 *whx
 *2013-4-12
 */
class tp_smsController extends controller{

	public function init(){
		require_once(__SITEROOT."library/Models/tips_message.php");
		require_once(__SITEROOT."library/Models/organization.php");
		require_once(__SITEROOT."library/Models/region.php");
		require_once(__SITEROOT."library/Models/tips_type.php");
		$this->view->basePath = $this->_request->getBasePath();
		
	}
	
	/**************
	 *已发送短信列表
	 **************/
	public function havesendAction(){
		
		$p_id=$this->_request->getParam("p_id");
		/* 搜索时间很有必要做下面的处理，要将action里面的时间和url里面的时间分开，要不
		   会造成时间混淆导致页面中无法修改时间
		*/
		//开始时间
		$start_time=$this->_request->getParam("start_time")?$this->_request->getParam("start_time"):$this->_request->getParam("url_start_time");
		//结束时间
		$end_time=$this->_request->getParam("end_time")?$this->_request->getParam("end_time"):$this->_request->getParam("url_end_time");
		$end_time=strtotime($end_time);
		$start_time =empty($start_time)? mktime(0, 0, 0, 1, 1, date('Y', time())):  strtotime($start_time);		
		$end_time = $end_time ? mktime(23, 59, 59, date("m", $end_time), date("d", $end_time), date("Y", $end_time)) : mktime(23, 59, 59, date("m", time()), date("d", time()), date("Y", time()));	

		$this->view->start_time=date("Y-m-d",$start_time);
		$this->view->end_time=date("Y-m-d",$end_time);
		$p_id=$p_id?$p_id:1;
		/*找出父路径,根据父路径找出改地区下的所有短信类型（tips_type)
		  然后根据每个子地区都遍历这些类型，寻找有没有该类型的数据
		  这样做主要是为了在前端表格能整齐显示。（有点绕,不过没办法，不可能每个tips_type类型都去查找）
		 */
		$region=new Tregion();
	    $region->whereAdd("id='$p_id'");
		$region->find(true);
		//取得父路径
		$p_region_path=$region->region_path;
		//title获取路径
		
		$region=new Tregion();
	    $region->whereAdd("id in($p_region_path)");
	    $region->orderby("id asc");
		//$region->debug(1);
		$region->find();
		$path=array();
		$path_index=0;
		
		$hide=0;
		while($region->fetch()){
			$path[$path_index]['zh_name']=$region->zh_name;
			$path[$path_index]['region_id']=$region->id;
			$path_index++;
		}
		$this->view->current_id=$p_id;
		//取得父地区下的所有短信类型,用于表格标题
			$tips_type=new Ttips_message();
			$type=new Ttips_type();
			$org=new Torganization();
			$tips_type->whereAdd("tips_type is not null and tips_message.org_id is not null");
			$org->whereAdd("region_path like '$p_region_path%'");
			$tips_type->joinAdd("inner",$tips_type,$org,"org_id","id");
			$tips_type->joinAdd("inner",$tips_type,$type,"tips_type","id");
			$tips_type->selectAdd("tips_message.tips_type as ");
			$tips_type->groupby("tips_message.tips_type");
			//$tips_type->debug(1);
			$tips_type->find();
		//找出短信类型的名字
		$tips_type_names=array();
		while($tips_type->fetch()){
			$type=new Ttips_type();
			$type->whereAdd("id='$tips_type->tips_type'");
			$type->find(true);
			//echo $type->tipszh_name;
			$tips_type_names[]=$type->tipszh_name;
		}
		//种类的个数，用于控制表格的宽度
		$type_num=count($tips_type_names); 
		$this->view->type_num=$type_num;
		//print_r($tips_type_names);
		//查找子地区
		$region=new Tregion();
		$region->whereAdd("p_id='$p_id'");
		$region->find();
		$result=array();
		$index=0;
		//子地区遍历开始
		while($region->fetch()){
			//类型遍历开始
			$i=0;
			//取得父地区下的所有短信类型
			$tips_type=new Ttips_message();
			$type=new Ttips_type();
			$org=new Torganization();
			$tips_type->whereAdd("tips_type is not null and tips_message.org_id is not null");
			$org->whereAdd("region_path like '$p_region_path%'");
			$tips_type->joinAdd("inner",$tips_type,$org,"org_id","id");
			$tips_type->joinAdd("inner",$tips_type,$type,"tips_type","id");
			$tips_type->selectAdd("tips_message.tips_type as ");
			$tips_type->groupby("tips_message.tips_type");
			//$tips_type->debug(1);
			$tips_type->find();
			while($tips_type->fetch()){
				//看看该地区下有没有这个类型的短信呢
				$tips_message=new Ttips_message();
				$organization=new Torganization();
				$organization->whereAdd("region_path like '$region->region_path%'");
				$tips_message->joinAdd("inner",$tips_message,$organization,"org_id","id");
				$tips_message->whereAdd("tips_message.tips_type='$tips_type->tips_type'");
				$tips_message->whereAdd("tips_message.created>='$start_time'");
				$tips_message->whereAdd("tips_message.created<='$end_time'");
				$num=$tips_message->count()==0?"0":$tips_message->count();
				$result[$index]['num'][$i]=$num;
				$i++;
			}
			//结果中地区值是肯定有的
			//如果region的path和organization的path相同，则禁止下级
			$organization=new Torganization();
			$organization->whereAdd("region_path='$region->region_path'");
			$organization->find(true);
			//如果是最底层机构，则禁止下级连接
			if($organization->type==5){
				$hide=1;
				$result[$index]['show_name']=$organization->zh_name;
			}
			$result[$index]['region_name']=$region->zh_name;
			$result[$index]['region_id']=$region->id;
			$index++;
				
		}
	    $this->view->path=$path;
		$this->view->hide=$hide;
		$this->view->tips_type_names=$tips_type_names;
		$this->view->result=$result;
		$this->view->display("havesend.html");
	} 
}
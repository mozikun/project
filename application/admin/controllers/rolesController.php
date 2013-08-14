<?php
/**
 * 角色管理/添加/修改/删除
 *
 */

class admin_rolesController extends controller {

	public function init()
	{
		$this->view->basePath = $this->_request->getBasePath();
		//用户认证与权限
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/role_table.php');
		require_once(__SITEROOT."application/admin/models/delRoleResource.php");//删除权限表
		

	}
	public function indexAction(){





	}
	/**
	 * 列表内容
	 *
	 */
	public  function listAction(){


		$role_table=new Trole_table();
		$role_table->orderby("role_en_name ASC");
		$role_table->find();
		$row=array();//存储中角色表中数据
		$i=0;
		while ($role_table->fetch()){
			$row[$i]['role_id']		= $role_table->role_id;
			$row[$i]['role_en_name']= $role_table->role_en_name;
			$row[$i]['role_zh_name']= $role_table->role_zh_name;
			$row[$i]['width_option']= $role_table->width_option;
			$i++;
		}

		$this->view->row=$row;
		$this->view->display("list.html");


	}
	/**
	 * 显示
	 *
	 */
	public function displayAction(){

		$role_table=new Trole_table();
		$role_table->orderby("role_en_name ASC");
		$role_table->find();
		$row=array();//存储中角色表中数据
		$i=0;
		while ($role_table->fetch()){
			$row[$i]['role_id']		= $role_table->role_id;
			$row[$i]['role_en_name']= $role_table->role_en_name;
			$row[$i]['role_zh_name']= $role_table->role_zh_name;
			$row[$i]['width_option']= $role_table->width_option;
			$i++;
		}

		$this->view->row=$row;
		$this->view->display("display.html");
	}
	/**
	 * 添加/更新
	 *
	 */
	public function updateAction(){

		$role_id=$this->_request->getParam('role_id');//角色Id
		$role_en_name=$this->_request->getParam('role_en_name');//角色Id
		$role_zh_name=$this->_request->getParam('role_zh_name');//角色Id
		$width_option=$this->_request->getParam('width_option');//有管理权限
		//验证英文名
		if(preg_match("~^[a-z0-9_\-]{2,60}$~i",$role_en_name)===FALSE){
			echo "|false|角色英文名由字母，数字，下划线，减号构成！";
			exit();
		}

		$role_table=new Trole_table();

		$role_table->role_en_name=$role_en_name;
		$role_table->role_zh_name=$role_zh_name;
		$role_table->width_option=$width_option;
		//$role_table->debugLevel(5);
		if(strlen($role_id)>12){
			//更新操作
			$role_table->whereAdd("role_id='$role_id'");
			if($role_table->update()){
				echo "|true|记录更新成功！";
				$this->delete_role_cache_file();//删除角色缓存文件
			}else {
				echo "|false|记录更新失败！";
			}
		}else{
			
			//检查重复的角色名
			$role_table_chk=new Trole_table();
			$role_table_chk->whereAdd("role_en_name='$role_en_name'");
			if($role_table_chk->count()>0){
				echo "|false|角色名重复！";
				exit();
			}
			
			//插入记录
			$role_table->role_id=uniqid(true);

			if($role_table->insert()){

				echo "|true|记录插入成功！";
				$this->delete_role_cache_file();//删除角色缓存文件
			}else {

				echo "|false|记录插入失败！";
			}
		}



	}
	/**
	 * 删除操作
	 *
	 */
	public function deleteAction(){
		
		$role_id=$this->_request->getParam('role_id');//角色Id
		if(strlen($role_id)>12){
			//判断角色是否在用户表中已经使用
			if($this->roleid_in_user($role_id)){
				exit("|false|该角色已经使用,不能删除！");
			}else{


				$role_table=new Trole_table();
				$role_table->whereAdd("role_id='$role_id'");
				if($role_table->delete()){
					//echo $role_table->oracle_error();
					delRoleResource("role_id","$role_id");//删除权限表中role_id =$role_id
					echo "|true|删除成功！";
					$this->delete_role_cache_file();//删除角色缓存文件
				}else{
					echo "|false|删除失败！";
				}
			}
		}else{
			echo "|false|非法进入！";
		}
	}


	/**
	 * 检查用户表中是否存在角色id
	 * $role_id string 角色id
	 * @return bool
	 */
	private function roleid_in_user($role_id=''){
		if(!empty($role_id)){
			$staff_core=new Tstaff_core();

			$staff_core->whereAdd("role_id='{$role_id}'");

			//$staff_core->debugLevel(2);
			$count=$staff_core->count("*");
			if($count>0){
				return true;
			}else{
				return false;
			}
		}else{
			throw new Exception("role_id不能为空！");
		}

	}
	//删除角色缓存文件
	private function delete_role_cache_file(){
		$file=__SITEROOT.'cache/role_cache_file.php';
		if(file_exists($file)){
			unlink($file);
			$acl_file=__SITEROOT.'cache/acl_cache_file.php';//授权文件缓存
			if(file_exists($acl_file)){
				unlink($acl_file);
			}
		}
	}
	

}
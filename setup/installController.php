<?php
//require_once(__SITEROOT."library/db.php");
//require_once(__SITEROOT."library/controller.php");//相对于index.php的文件位置
class installController extends controller {
	//public $database;
	public function __construct1($action){
		//session_start();
		if($action=='install_action'){
			//安装完成后请将此处打开
			//return;
		}
		//$this->acl();
	}
	public function installAction(){
		$db_instance=db_connect::getInstance();
		//mysql_query("set names utf8");
		mysql_query("create database $db_instance->database");
		
		//新版5DCMS相关表

		/**
		 * 设计思路
		 * 用无级栏目与栏目属性进行控制，可以方便的设计出较为复杂的栏目管理系统。
		 * 在实际操作时：
		 * 前台主菜单：如果采用一级项目模式，则仅定义一级菜单。如果采用二级菜单模式，则第一级为分类栏目，二级为内容栏目。如果是三级以上或是混杂模式菜单，另行处理
		 * 前台页面：由于是通过后台“布局管理”功能中的位置与末级栏目映射来实现的，因此不受菜单级数的影响
		 * 后台信息列表：可用多级下拉框来实按不同的栏目对信息进行分类显示。
		 * 在所有生成url的代码中，仅根据property来判断是是进入list页面还是进入display页面
		 * 对于复杂系统，可生用频道，分类栏目，信息栏目这样的方式来现实更为复杂的内容管理系统。
		 */
		//无级分类栏目表
		mysql_query("CREATE TABLE `menu`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='无级分类栏目表'");
		//echo mysql_error();
		mysql_query("ALTER TABLE `menu` ADD `id`  char(13) comment '栏目代码|text' ");
		mysql_query("ALTER TABLE `menu` ADD `index`  int  comment '内部顺序号|text' ");
		mysql_query("ALTER TABLE `menu` ADD `parentId`  char(13) comment '父ID|text' ");
		mysql_query("ALTER TABLE `menu` ADD `description` char(100) comment '描述|text' ");
		mysql_query("ALTER TABLE `menu` ADD `property` char(10) comment '栏目属性:1频道,2分类,3栏目|text' ");
		mysql_query("ALTER TABLE `menu` ADD `action` char(10) comment '动作属性:1无特殊动作,2列表,3内容|text' ");
		mysql_query("ALTER TABLE `menu` ADD `path`  char(255)  comment '全路径|text' ");
		mysql_query("create index `id` on `menu`(id) ");
		$rs=mysql_query("select count(*) as counter from `menu` ");
		$row=mysql_fetch_array($rs);
		//如果没有数据，则插入测试数据
		if($row['counter']<=0){
			//根
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('1','1','1','全部栏目','1','1','1')");
			echo mysql_error();
			//一级栏目
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('2','2','1','学院概况','2','1,2','1')");
			echo mysql_error();
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('4','4','1','最新公告','2','1,4','1')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('6','6','1','校院风采','2','1,6','1')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('8','8','1','党群工作','2','1,8','1')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('10','10','1','学科建设','2','1,10','1')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('12','12','1','科学研究','2','1,12','1')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('14','14','1','师资队伍','2','1,14','1')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('16','16','1','教育培养','2','1,16','1')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('18','18','1','招生就业','2','1,18','1')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('20','20','1','学生工作','2','1,20','1')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('22','22','1','精品课程','2','1,22','1')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('24','24','1','实验室建设','2','1,24','1')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('26','26','1','成人教育','2','1,26','1')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('28','28','1','资源下载','2','1,28','1')");
			//二级栏目
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('50','50','4','最新公告a','3','1,4,50','2')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('52','52','4','最新公告b','3','1,4,52','2')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('54','54','4','最新公告c','3','1,4,54','2')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('60','60','6','校院风采a','3','1,6,60','2')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('62','62','6','校院风采b','3','1,6,62','2')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('64','64','6','校院风采c','3','1,6,64','2')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('80','80','8','党群工作a','3','1,8,80','2')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('82','82','8','党群工作b','3','1,8,82','2')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('84','84','8','党群工作c','3','1,8,84','2')");
			mysql_query("insert into `menu`(uuid,id,parentId,description,property,path,action) values('86','86','8','党群工作d','3','1,8,86','2')");
			
		}
		//无级分类部门表
		mysql_query("CREATE TABLE `organization`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='机构表'");
		mysql_query("ALTER TABLE `organization` ADD `id`  char(13) comment '部门代码|text' ");
		mysql_query("ALTER TABLE `organization` ADD `index`  int  comment '内部顺序号|text' ");
		mysql_query("ALTER TABLE `organization` ADD `parentId`  char(13) comment '父ID|text' ");
		mysql_query("ALTER TABLE `organization` ADD `description` char(100) comment '部门名称描述|text' ");
		mysql_query("ALTER TABLE `organization` ADD `path`  char(255)  comment '全路径|text' ");
		mysql_query("create index `id` on `organization`(id) ");
		$rs=mysql_query("select count(*) as counter from `organization` ");
		$row=mysql_fetch_array($rs);
		//如果没有数据，则插入测试数据
		if($row['counter']<=0){
			mysql_query("insert into `organization`(uuid,id,parentId,description,path,`index`) values('1','1','1','本机构','1','1')");
			mysql_query("insert into `organization`(uuid,id,parentId,description,path,`index`) values('2','2','1','总经理办公室','1,2','1')");
			mysql_query("insert into `organization`(uuid,id,parentId,description,path,`index`) values('3','3','1','销售分公司','1,3','1')");
			mysql_query("insert into `organization`(uuid,id,parentId,description,path,`index`) values('4','4','1','采购分公司','1,4','1')");
			mysql_query("insert into `organization`(uuid,id,parentId,description,path,`index`) values('5','5','2','销售一部','1,2,5','1')");
			mysql_query("insert into `organization`(uuid,id,parentId,description,path,`index`) values('6','6','2','销售二部','1,2,6','1')");
			mysql_query("insert into `organization`(uuid,id,parentId,description,path,`index`) values('7','7','5','销售一科','1,2,5,7','1')");
			mysql_query("insert into `organization`(uuid,id,parentId,description,path,`index`) values('8','8','5','销售二科','1,2,5,8','1')");
			mysql_query("insert into `organization`(uuid,id,parentId,description,path,`index`) values('9','9','6','销售一科','1,2,6,9','1')");
			mysql_query("insert into `organization`(uuid,id,parentId,description,path,`index`) values('10','10','6','销售二科','1,2,6,10','1')");
			mysql_query("insert into `organization`(uuid,id,parentId,description,path,`index`) values('11','11','4','采购一部','1,4,11','1')");
			mysql_query("insert into `organization`(uuid,id,parentId,description,path,`index`) values('12','12','4','采购二部','1,4,12','1')");
		}			
		//建立职员表
		mysql_query("CREATE TABLE `staff`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='基本信息表'");
		mysql_query("ALTER TABLE `staff` ADD `organizationId`  char(13) comment '部门代码|text' ");
		mysql_query("ALTER TABLE `staff` ADD `id`  char(13) comment '用户代码|text' ");
		mysql_query("ALTER TABLE `staff` ADD `index`  int comment '内部序号|text' ");
		mysql_query("ALTER TABLE `staff` ADD `name` char(14) comment '用户名|text' ");
		mysql_query("ALTER TABLE `staff` ADD `roleId` char(13) comment '角色代码|text' ");
		mysql_query("ALTER TABLE `staff` ADD `phone1` char(15) comment '电话1|text' ");
		mysql_query("ALTER TABLE `staff` ADD `phone2` char(15) comment '电话2|text' ");
		mysql_query("ALTER TABLE `staff` ADD `email` char(20) comment '邮箱|text' ");//不能用e-mail 要出错
		mysql_query("ALTER TABLE `staff` ADD `password` char(10) comment '密码|text' ");	
		mysql_query("create index `id` on `staff`(id) ");
		$rs=mysql_query("select count(*) as counter from `staff` ");
		$row=mysql_fetch_array($rs);
		//如果没有数据，则插入测试数据
		if($row['counter']<=0){
			mysql_query("insert into `staff`(uuid,id,`index`,name,organizationId,roleId,password) values('1','1','1','系统管理员','1','1','1')");
			mysql_query("insert into `staff`(uuid,id,`index`,name,organizationId,roleId,password) values('2','2','2','王厅长','2','2','1')");
			mysql_query("insert into `staff`(uuid,id,`index`,name,organizationId,roleId,password) values('3','3','3','李处长','3','3','1')");
			mysql_query("insert into `staff`(uuid,id,`index`,name,organizationId,roleId,password) values('4','4','4','赵科长','9','4','1')");
			mysql_query("insert into `staff`(uuid,id,`index`,name,organizationId,roleId,password) values('5','5','5','刘科员','10','5','1')");
		}
			
		//建立角色表
		mysql_query("CREATE TABLE `role`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色表'");
		mysql_query("ALTER TABLE `role` ADD `id`  char(13) comment '角色代码|text' ");
		mysql_query("ALTER TABLE `role` ADD `index`  int comment '内部序号|text' ");
		mysql_query("ALTER TABLE `role` ADD `description` char(100) comment '角色名称|text' ");
		$rs=mysql_query("select count(*) as counter from `role` ");
		$row=mysql_fetch_array($rs);
		//如果没有数据，则插入测试数据
		if($row['counter']<=0){
			mysql_query("insert into `role`(uuid,id,`index`,description) values('1','1','1','系统管理员')");
			mysql_query("insert into `role`(uuid,id,`index`,description) values('2','2','2','厅长')");
			mysql_query("insert into `role`(uuid,id,`index`,description) values('3','3','3','处长')");
			mysql_query("insert into `role`(uuid,id,`index`,description) values('4','4','4','科长')");
			mysql_query("insert into `role`(uuid,id,`index`,description) values('5','5','5','科员')");
		}
		
		//建立访问控制表 此访问控制表用于角色－资源型访问控制方式
		mysql_query("CREATE TABLE `acl_role_resource`  (`uuid` char(13) comment '唯一标识符') ;ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='基本信息表'");
		mysql_query("ALTER TABLE `acl_role_resource` ADD `roleId`  char(13) comment '角色代码|text' ");
		mysql_query("ALTER TABLE `acl_role_resource` ADD `resourceId`  char(13) comment '资源代码|text' ");
		mysql_query("ALTER TABLE `acl_role_resource` ADD `resourceType`  char(30) comment '资源类型,指明资源来源什么表|text' ");
		mysql_query("ALTER TABLE `acl_role_resource` ADD `privilege`  char(100) comment '权限动作|text' ");
		$rs=mysql_query("select count(*) as counter from `acl_role_resource` ");
		$row=mysql_fetch_array($rs);
		//如果没有数据，则插入测试数据
		if($row['counter']<=0){
			mysql_query("insert into `acl_role_resource`(uuid,roleId,resourceId,resourceType,privilege) values('1','1','50','menu','1,2,3')");
			mysql_query("insert into `acl_role_resource`(uuid,roleId,resourceId,resourceType,privilege) values('2','2','52','menu','1,2,3')");
		}			
		//建立访问控制表 此访问控制表用于职员－资源型访问控制方式
		mysql_query("CREATE TABLE `acl_staff_resource`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='基本信息表'");
		mysql_query("ALTER TABLE `acl_staff_resource` ADD `roleId`  char(13) comment '角色代码|text' ");
		//其大小为100,因为资源不一定是id，有可能是menuController这样的字符串
		mysql_query("ALTER TABLE `acl_staff_resource` ADD `resourceId`  char(100) comment '资源代码|text' ");
		mysql_query("ALTER TABLE `acl_staff_resource` ADD `resourceType`  char(30) comment '资源类型,指明资源来源什么表|text' ");
		mysql_query("ALTER TABLE `acl_staff_resource` ADD `privilege`  char(100) comment '权限动作|text' ");
		$rs=mysql_query("select count(*) as counter from `acl_staff_resource` ");
		$row=mysql_fetch_array($rs);
		//如果没有数据，则插入测试数据
		if($row['counter']<=0){
			mysql_query("insert into `acl_staff_resource`(uuid,roleId,resourceId,resourceType,privilege) values('1','1','50','menu','1,2,3')");
			mysql_query("insert into `acl_staff_resource`(uuid,roleId,resourceId,resourceType,privilege) values('2','2','52','menu','1,2,3')");
		}			

		//建立留言表
		mysql_query("CREATE TABLE `message_board`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='基本信息表'");
		mysql_query("ALTER TABLE `message_board` ADD `message_id`  char(13) comment '代码|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `messager_name` char(30) comment '发表人|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `messager_add` char(30) comment '广告|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `messager_ip` char(30) comment '发表人ip|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `date_update` char(30) comment '发表时间|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `have_read` char(1) comment '已阅标志|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `message_title` char(30) comment '标题|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `message_content` text comment '内容|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `reply_content` text comment '评语|text' ");
		

		//建立普通用户表
		mysql_query("CREATE TABLE `user`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='基本信息表'");
		mysql_query("ALTER TABLE `user` ADD `user_id`  char(13) comment '用户代码|text' ");
		mysql_query("ALTER TABLE `user` ADD `inner_id`  int comment '内部序号|text' ");
		mysql_query("ALTER TABLE `user` ADD `user_name` char(14) comment '用户名|text' ");
		mysql_query("ALTER TABLE `user` ADD `org_id` char(13) comment '所属教研室|text' ");
		mysql_query("ALTER TABLE `user` ADD `user_phone1` char(15) comment '电话1|text' ");
		mysql_query("ALTER TABLE `user` ADD `user_phone2` char(15) comment '电话2|text' ");
		mysql_query("ALTER TABLE `user` ADD `user_e_mail` char(20) comment '邮箱|text' ");
		mysql_query("ALTER TABLE `user` ADD `user_qq` char(10) comment 'qq|text' ");
		mysql_query("ALTER TABLE `user` ADD `password` char(10) comment '密码|text' ");
		$rs=mysql_query("select count(*) as counter from `user` ");
		$row=mysql_fetch_array($rs);
		$user_id='9999999999999';
		if($row['counter']<=0){
			$query_string="insert into `user`(`uuid`,`user_id`,`inner_id`,`user_name`,`org_id`,`user_phone1`,`user_phone2`,`user_e_mail`,`user_qq`,`password`) values('9999999999999','9999999999999','999999','管理员','".$org_id."','010-00000000','010-00000000','luo@163.com','12345','9527')";
			//echo $query_string;
			mysql_query($query_string);
		}
		
		//建立基本信息表
		mysql_query("CREATE TABLE `base_info`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='基本信息表'");
		mysql_query("ALTER TABLE `base_info` ADD `org_name`  char(30) comment '单位名称|text' ");
		mysql_query("ALTER TABLE `base_info` ADD `address` char(30) comment '地址|text' ");
		mysql_query("ALTER TABLE `base_info` ADD `postalcode` char(6) comment '邮编|text' ");
		mysql_query("ALTER TABLE `base_info` ADD `phone1` char(30) comment '电话1|text' ");
		mysql_query("ALTER TABLE `base_info` ADD `phone2` char(30) comment '电话2|text' ");
		mysql_query("ALTER TABLE `base_info` ADD `e_mail` char(30) comment '电子邮箱|text' ");
		mysql_query("ALTER TABLE `base_info` ADD `password` char(10) comment '管理密码|text' ");
		mysql_query("ALTER TABLE `base_info` ADD `hit_times` int comment '访问次数|text' ");
		$rs=mysql_query("select count(*) as counter from `base_info` ");
		$row=mysql_fetch_array($rs);
		if($row['counter']<=0){
			mysql_query("insert into `base_info` values('".uniqid()."','新单位','新地址','100000','010-00000000','010-00000000','unit@aaa.com','9527','10')");
		}

		//建立信息主表
		mysql_query("CREATE TABLE `news`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='信息表'");
		mysql_query("ALTER TABLE `news` ADD `menuId`  char(13) comment '栏目代码|text' ");
		mysql_query("ALTER TABLE `news` ADD `id`  char(13) comment '信息代码|text' ");
		mysql_query("ALTER TABLE `news` ADD `authorStaffId`  char(13) comment '作者|text' ");
		mysql_query("ALTER TABLE `news` ADD `dateCreate`  int comment '创建时间|int' ");
		mysql_query("ALTER TABLE `news` ADD `dateUpdate`  int comment '修改时间|int' ");
		mysql_query("ALTER TABLE `news` ADD `title` char(128)  comment '标题|text' ");
		mysql_query("ALTER TABLE `news` ADD `url` char(128)  comment 'url地址,用于友情链接|text' ");
		mysql_query("ALTER TABLE `news` ADD `auditorStaffId` char(13) comment '审核人|text' ");
		mysql_query("ALTER TABLE `news` ADD `target` char(1) comment '只对注册用户|text' ");
		mysql_query("ALTER TABLE `news` ADD `attachment` char(2) comment '附件类型|text|无,图,文' ");
		mysql_query("ALTER TABLE `news` ADD `hitTimes` int comment '访问次数|text' ");
		mysql_query("create index `id` on `news`(id) ");
		mysql_query("create index `id` on `news`(menuId,id) ");
		//建立信息内容表
		mysql_query("CREATE TABLE `news_content`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='信息表'");
		mysql_query("ALTER TABLE `news_content` ADD `newsId`  char(13)  comment '信息代码|text' ");
		mysql_query("ALTER TABLE `news_content` ADD `content` text  comment '内容|text' ");
		mysql_query("create index `newsId` on `news_content`(newsId) ");

		//		$s="insert into `news`(uuid,sub_menu_id,news_id,data_create,data_update,title,content,visible) values('".uniqid()."','4731e71838e0d','".uniqid()."','".time()."','".time()."','学院大事1','学院大事1content','1')";
//		echo $s;
//		mysql_query($s);
//		mysql_query("insert into `news`(uuid,sub_menu_id,news_id,data_create,data_update,title,content,visible) values('".uniqid()."','4731e71838e0d','".uniqid()."','".time()."','".time()."','学院大事2','学院大事2content','1')");
//		mysql_query("insert into `news`(uuid,sub_menu_id,news_id,data_create,data_update,title,content,visible) values('".uniqid()."','4731e7183d7af','".uniqid()."','".time()."','".time()."','公告活动1','公告活动1content','1')");
//		mysql_query("insert into `news`(uuid,sub_menu_id,news_id,data_create,data_update,title,content,visible) values('".uniqid()."','4731e7183d7af','".uniqid()."','".time()."','".time()."','公告活动2','公告活动2content','1')");
		//建立附件表
		mysql_query("CREATE TABLE `news_attachment`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表'");
		mysql_query("ALTER TABLE `news_attachment` ADD `id`  char(13) comment '信息代码|text' ");
		mysql_query("ALTER TABLE `news_attachment` ADD `newsId`  char(13)  comment '信息代码|text' ");
		mysql_query("ALTER TABLE `news_attachment` ADD `type`  char(5)  comment '附件类型|text' ");
		mysql_query("ALTER TABLE `news_attachment` ADD `fileName`  char(254)  comment '文件名|text' ");
		mysql_query("ALTER TABLE `news_attachment` ADD `fileRealName`  char(254)  comment '文件真名|text' ");
		mysql_query("create index `newsId` on `news_attachment` (newsId) ");
		//建立布局位置表
		//未指定栏目的位置 其栏目代码为-9
		mysql_query("CREATE TABLE `layout`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='布局'");
		mysql_query("ALTER TABLE `layout` ADD `position` int comment '位置代码|text' ");
		mysql_query("ALTER TABLE `layout` ADD `menuId`  char(13) comment '栏目代码|text' ");
		//mysql_query("ALTER TABLE `layout` ADD `sub_menu_id`  char(13) comment '子栏目代码|text' ");
		mysql_query("ALTER TABLE `layout` ADD `type`  char(6) comment '类型|text' ");
		mysql_query("create index `position` on `layout`(position) ");
		$rs=mysql_query("select count(*) as counter from `layout` ");
		$row=mysql_fetch_array($rs);
		if($row['counter']<=0){
			
			
			
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('01','1','2','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('02','2','4','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('03','3','6','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('04','4','8','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('05','5','10','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('06','6','12','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('07','7','14','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('08','8','16','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('09','9','18','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('10','10','20','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('11','11','-9','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('12','12','-9','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('13','13','-9','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('14','14','-9','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('15','15','-9','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('16','16','-9','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('17','17','-9','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('18','18','-9','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('19','19','-9','menu')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('20','20','-9','menu')");

			mysql_query("insert into `layout`(uuid,position,menuId,type) values('21','1','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('22','2','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('23','3','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('24','4','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('25','5','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('26','6','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('27','7','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('28','8','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('29','9','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('30','10','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('31','11','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('32','12','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('33','13','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('34','14','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('35','15','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('36','16','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('37','17','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('38','18','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('39','19','50','body')");
			mysql_query("insert into `layout`(uuid,position,menuId,type) values('40','20','50','body')");			
			

		}
		//建立配置参数表
		mysql_query("CREATE TABLE `config`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='配置参数表'");
		mysql_query("ALTER TABLE `config` ADD `cache1`  char(1)  comment '是否静态化|text' ");
		mysql_query("ALTER TABLE `config` ADD `debug1`  char(1)  comment '是否显示调试信息|text' ");
		mysql_query("ALTER TABLE `config` ADD `compatible_zf`  char(1)  comment '是否与zf兼容|text' ");
		mysql_query("ALTER TABLE `config` ADD `compatible_pear`  char(1)  comment '是否与pear兼容|text' ");
		
		
		
		//建立商品分类表
		mysql_query("CREATE TABLE `category`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品分类表'");
		mysql_query("ALTER TABLE `category` ADD `category_id`  char(13)  comment '商品分类代码|text' ");
		mysql_query("ALTER TABLE `category` ADD `index`  int  comment '内部顺序号|text' ");
		mysql_query("ALTER TABLE `category` ADD `parent_id`  char(13)  comment '父代码|text' ");
		mysql_query("ALTER TABLE `category` ADD `description` char(100) comment '商品分类描述|text' ");
		mysql_query("ALTER TABLE `category` ADD `path`  char(255)  comment '全路径|text' ");
		mysql_query("ALTER TABLE `category` ADD `level`  int  comment '伪无级分类时记录级次|text' ");
		mysql_query("create index `category_id` on `category`(category_id) ");
		mysql_query("create index `parent_id` on `category`(parent_id) ");
		mysql_query("create index `path` on `category`(path) ");
		mysql_query("create index `description` on `category`(description) ");
		$rs=mysql_query("select count(*) as counter from `category` ");
		$row=mysql_fetch_array($rs);
		if($row['counter']<=0){
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('1','1','1','全部分类','1','1')");
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('2','2','1','电器','1,2','2')");
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('3','3','1','服装','1,3','2')");
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('4','4','1','食品','1,4','2')");
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('5','5','2','家用电器','1,2,5','3')");
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('6','6','2','计算机','1,2,6','3')");
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('7','7','5','电视','1,2,5,7','4')");
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('8','8','5','洗衣机','1,2,5,8','4')");
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('9','9','6','台式机','1,2,6,9','4')");
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('10','10','6','笔记本','1,2,6,10','4')");
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('11','11','10','联想笔记本','1,2,6,10,11','5')");
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('12','12','10','神舟笔记本','1,2,6,10,12','5')");
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('13','13','3','男装','1,3,13','3')");
			mysql_query("insert into `category`(uuid,category_id,parent_id,description,path,level) values('14','14','3','女装','1,3,14','3')");
		}			
		//建立商品属性表 用于定义某类商品的属性
		mysql_query("CREATE TABLE `property`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品分类属性表'");
		mysql_query("ALTER TABLE `property` ADD `category_id`  char(13)  comment '商品分类代码|text' ");
		mysql_query("ALTER TABLE `property` ADD `property_id`  char(13)  comment '商品属性代码|text' ");
		mysql_query("ALTER TABLE `property` ADD `index`  int  comment '内部顺序号|text' ");
		mysql_query("ALTER TABLE `property` ADD `description` char(100) comment '商品属性描述|text' ");
		mysql_query("create index `category_id` on `property`(category_id) ");
		mysql_query("create index `property_id` on `property`(property_id) ");
		mysql_query("create index `description` on `property`(description) ");
		$rs=mysql_query("select count(*) as counter from `property` ");
		$row=mysql_fetch_array($rs);
		if($row['counter']<=0){
			mysql_query("insert into `property`(uuid,category_id,property_id,description,`index`) values('1','6','1','cpu','1')");
			mysql_query("insert into `property`(uuid,category_id,property_id,description,`index`) values('2','6','2','主板','2')");
		}
		//建立商品表
		mysql_query("CREATE TABLE `goods`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品表'");
		mysql_query("ALTER TABLE `goods` ADD `category_id`  char(13)  comment '商品分类代码|text' ");
		mysql_query("ALTER TABLE `goods` ADD `path`  char(255)  comment '全路径|text' ");
		mysql_query("ALTER TABLE `goods` ADD `goods_id`  char(13)  comment '商品代码|text' ");
		mysql_query("ALTER TABLE `goods` ADD `index`  int  comment '内部顺序号|text' ");
		
		mysql_query("ALTER TABLE `goods` ADD `price`  int  comment '当前价格|text' ");
		mysql_query("ALTER TABLE `goods` ADD `discount`  int  comment '当前折扣|text' ");
		
		mysql_query("ALTER TABLE `goods` ADD `storage_real`  int  comment '实际存量|text' ");
		mysql_query("ALTER TABLE `goods` ADD `storage_reserve`  int  comment '预订存量|text' ");

		mysql_query("ALTER TABLE `goods` ADD `description` char(100) comment '商品名称|text' ");
		mysql_query("ALTER TABLE `goods` ADD `description` char(100) comment '商品别名|text' ");
		mysql_query("create index `category_id` on `goods`(category_id) ");
		mysql_query("create index `goods_id` on `goods`(goods_id) ");
		mysql_query("create index `path` on `goods`(path) ");
		mysql_query("create index `description` on `goods`(description) ");
		/*
		INSERT INTO `goods` (`uuid`, `category_id`, `goods_id`, `index`, `price`, `discount`, `storage_real`, `storage_reserve`, `description`, `path`) VALUES
('1', 11, '1', 1, 2300, 0, 22, 20, '旭日１号', '1,2,6,10,11'),
('2', 11, '2', 2, 3456, 0, 34, 34, '上网本', '1,2,6,10,11'),
('3', 13, '3', 3, 45, 0, 345, 234, '男上衣', '1,3,13'),
('4', 13, '4', 4, 234, 0, 12, 11, '西服', '1,3,13');
*/
		//商品图片表
		mysql_query("CREATE TABLE `goodsPicture`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品图片表'");
		mysql_query("ALTER TABLE `goodsPicture` ADD `category_id`  char(13)  comment '商品分类代码|text' ");
		mysql_query("ALTER TABLE `goodsPicture` ADD `goods_id`  char(13)  comment '商品代码|text' ");
		mysql_query("ALTER TABLE `goodsPicture` ADD `index`  int  comment '内部顺序号|text' ");
		mysql_query("ALTER TABLE `goodsPicture` ADD `picture_description` text comment '图片文字描述|text' ");
		mysql_query("ALTER TABLE `goodsPicture` ADD `picture_name` char(100) comment '图片存储位置与名称|text' ");
		mysql_query("ALTER TABLE `goodsPicture` ADD `picture_dimension` char(20) comment '图片长宽|text' ");
		mysql_query("create index `category_id` on `goodsPicture`(category_id) ");
		mysql_query("create index `goods_id` on `goodsPicture`(goods_id) ");
		
		
		//建立商品属性表
		//商品属性表与分类属性表之间的关系为　分类属性表定义属性项目，商品属性表定义值。且分类属性中的项目并不全部使用在商品属性中，用户可选用
		mysql_query("CREATE TABLE `goodsProperty`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品属性表'");
		mysql_query("ALTER TABLE `goodsProperty` ADD `category_id`  char(13)  comment '商品分类代码|text' ");
		mysql_query("ALTER TABLE `goodsProperty` ADD `goods_id`  char(13)  comment '商品代码|text' ");
		mysql_query("ALTER TABLE `goodsProperty` ADD `property_id`  char(13)  comment '商品属性代码|text' ");
		mysql_query("ALTER TABLE `goodsProperty` ADD `index`  int  comment '内部顺序号|text' ");
		mysql_query("ALTER TABLE `goodsProperty` ADD `value` char(100) comment '属性值|text' ");
		mysql_query("ALTER TABLE `goodsProperty` ADD `checked` char(1) comment '是否启用|text' ");
		mysql_query("create index `category_id` on `goodsProperty`(category_id) ");
		mysql_query("create index `property_id` on `goodsProperty`(property_id) ");
		mysql_query("create index `goods_id` on `goodsProperty`(goods_id) ");
		mysql_query("create index `value` on `goodsProperty`(value) ");
		//建立商品分类计量单位表
		//基本单位　只能有一个　　台
		//扩展单位　可有多个　但必须指明与基本单位之间的关系　1件=10台　1包=20台等
		mysql_query("CREATE TABLE `measurement`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='建立商品分类计量单位表'");
		mysql_query("ALTER TABLE `measurement` ADD `category_id`  char(13)  comment '商品分类代码|text' ");
		mysql_query("ALTER TABLE `measurement` ADD `measurement_id`  char(13)  comment '记量单位代码|text' ");
		mysql_query("ALTER TABLE `measurement` ADD `description`  char(13)  comment '记量单位名称|text' ");
		mysql_query("ALTER TABLE `measurement` ADD `measurement_type`  char(1)  comment '记量单位类型|1:基本单位|2:扩展单位|text' ");//，只能有一个基本单位，可有多个扩展单位 
		mysql_query("ALTER TABLE `measurement` ADD `rate`  int  comment '基本单位与扩展单位之间的比率|text' ");//如　1件＝20台
		mysql_query("ALTER TABLE `measurement` ADD `index`  int  comment '内部顺序号|text' ");
		mysql_query("create index `category_id` on `measurement`(category_id) ");
		mysql_query("create index `goods_id` on `measurement`(goods_id) ");
		mysql_query("create index `description` on `measurement`(description) ");
		//商品计量单位表
		mysql_query("CREATE TABLE `goodsMeasurement`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品计量单位表'");
		mysql_query("ALTER TABLE `goodsMeasurement` ADD `category_id`  char(13)  comment '商品分类代码|text' ");
		mysql_query("ALTER TABLE `goodsMeasurement` ADD `goods_id`  char(13)  comment '商品代码|text' ");
		mysql_query("ALTER TABLE `goodsMeasurement` ADD `goods_measurement_id`  char(13)  comment '记量单位代码|text' ");//等同于uuid
		//此字段里存储的是该商品的可能的计量单位组合　如　箱　包　件　或是　箱　包　等组合方案
		//实际存储时是存储的measurement_id的组合字符串　如
		//001,003,007或001,007这种形式。 
		mysql_query("ALTER TABLE `goodsMeasurement` ADD `goods_measurement`  char(255)  comment '选用的计量单位|text' ");
		mysql_query("ALTER TABLE `goodsMeasurement` ADD `index`  int  comment '内部顺序号|text' ");
		mysql_query("create index `category_id` on `measurement`(category_id) ");
		mysql_query("create index `goods_id` on `measurement`(goods_id) ");

		/*
		购进时　	分批次　单独计算进价与总价　并记录批次号　可以看到进价曲线 进货时按批次记录供应商
		出售时　	或是用户选购时　按商家自定义的　售价（售价在商品表中记录与修改，本表中本次销售的实际售价与打折后的实际收入）　
				显示并根据打折率计算实际价格。也就是说　如果要提价或是降价，只影响到
				此次修改后的销售，以前的销售还是按以前的记算。这样还能很好的看到价格的变动曲线。
				对于当前库存的处理，有二种方法
				方法一：
				在商品表中建立二个反映库存量的字段　storage_real storage_current 
				当购进时，同时增加	storage_real storage_current的值　（此值仅存储基本单位度量下的存量　比如基本单位是台　，则购时时按件，也要通过单位定义中的关系换算成多少台）
				当用户选定一定数量的商品后（购物车），就减少storage_current的值，当用户真正付钱后，就减少storage_real的值
				优点：可即时反映出真实存量与订单存量
				缺点：这种方法有可能出现虚假库存为0的现象，通过程序的方法也不一定能很好的改善，特别是在多用户的网络环境中
				方法二：
				在商品表中建立一个反映库存量的字段　storage_real  
				当购进时，增加storage_real的值
				仅在支付货款后才减少storage_real的值
				优点：程序设计简单
				缺点：可能出现虚假库存量，即　当用户看到还有商品并下订单，但到真正付钱时，可能没有存库可提供了。
		盘存时
		*/
		//建立进销存表
		
		//本表是建立在批次基本之上的。也就是说，购进是按批次记录，出售也是按次记录
		//比如　商家购买了衣服与计算机二种产品，就要分二笔输入，但可在备注栏中写明情况，等以后完成了进货管理系统后在重新设计
		mysql_query("CREATE TABLE `stock`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='进销存表'");
		mysql_query("ALTER TABLE `stock` ADD `category_id`  char(13)  comment '商品分类代码|text' ");
		mysql_query("ALTER TABLE `stock` ADD `path`  char(255)  comment '全路径|text' ");
		mysql_query("ALTER TABLE `stock` ADD `goods_id`  char(13)  comment '商品代码|text' ");
		mysql_query("ALTER TABLE `stock` ADD `stock_id`  char(13)  comment '进货批次代码(内部用)|text' ");
		mysql_query("ALTER TABLE `stock` ADD `stock_note_id`  char(13)  comment '进货单代码(内部用)|text' ");
		mysql_query("ALTER TABLE `stock` ADD `udf_stock_note_id`  char(13)  comment '用户自定义单据号|text' ");//udf=user define

		mysql_query("ALTER TABLE `stock` ADD `sale_id`  char(13)  comment '销货批次代码(内部用)|text' ");//此编码是唯一的，一个或多个此编码组成一笔售货单sale_note_id
		mysql_query("ALTER TABLE `stock` ADD `sale_note_id`  char(13)  comment '售货单代码(内部用)|text' ");
		mysql_query("ALTER TABLE `stock` ADD `udf_sale_note_id`  char(13)  comment '用户自定义单据号|text' ");//udf=user define
		/*
			进货与出货都涉及三个代码
			进货单代码　用户自定义进货单代码　进货批次代码
			售货单代码　用户自定义售货单代码　售货批次代码
			
			进货单代码是内部用的代码，与用户自定义进货单代码　是一一对应的。进货单代码可由一个或多个进货批次代码代码组成。
			由于以前考虑欠妥，现在先把售货单完成，在回头修改进货单
			
		*/
		mysql_query("ALTER TABLE `stock` ADD `date`  datetime comment '日期|text' ");
		mysql_query("ALTER TABLE `stock` ADD `stock_date`  datetime comment '日期|text' ");
		mysql_query("ALTER TABLE `stock` ADD `factory_id`  char(13)  comment '供货商id|text' ");
		mysql_query("ALTER TABLE `stock` ADD `factory`  char(20)  comment '供货商|text' ");//当实现了供货商管理系统后，就不用这个字段了
		mysql_query("ALTER TABLE `stock` ADD `action`  char(13)  comment '动作|text' ");//１购进２卖出３商家退货４用户退货

		/*
		每次出货时，要首先查看进货列表，即查看购货批次与与所剩余的存货量，然后选定出货，有可能只涉及一个批次，也有可能涉及多个批次
		
		现在比较麻烦的是　如何定义商品的显示售价与实际售价
		用户在查看商品时，应该获取该商品的价格，但由于存在不同的计量体系，因此报价有点麻烦
		
		增加一个报价功能？
		
		商品分类　商品　厂家　批次
		
		在定义商品的增加一个计量模式
		计量模式１　箱　包　件
		计量模式２　箱　件
		list 
		display 中用多个下拉框来实现选定
		
		
		并按不同的计量模式　提供参考售价
		
		在购进时，选择一种计量模式　并同时出现按此种计量模式的输入框，输入当前采购的商品的计量比率。只所以要这样处理，是因为
		不同的商家有不同的包装与计量方式
		
		在表现层，把每种可能的模式的输入界面都生成，但只有当用户选定了一种模式时，才显示该种模式的输入界面。这样比用ajax加载要简单一些
		
		
		这与商品分类，商品两个模块中的计量单位定义是相关的，他们之间的关系如下
		商品分类模块中定义的是每类商用可能要用到的计量单位　如　箱　包　件　盒等
		商品模块中定义的计量单位是该种商品可能有的计量模式　如　箱包件　或是箱件盒
		而库存商品模块中定义的是当批商品实际的计量模式　如　用　箱包件　这种计量模式，并且要定义它们之间的比例　如1箱=10包 1包=10件
		这样就能最大限度的提高系统的灵活程序，但也带来操作上的复杂性，可通过程序的方法做一些简化，如相同的商品与供货商，自动使用上一次
		的计量模式等。
		存储时用这样的方式　
		假设选用的是　箱包件　计量模式，而箱包件的代码分别是(01,02,03)则　1箱=20包 1包=20件 存储的值是1-01=20-02,1-02=20-03 
		假设选用的是　箱件盒　计量模式，而箱包件的代码分别是(01,03,04)则　1箱=20件 1件=20盒 存储的值是1-01=20-03,1-03=20-04 
		2009-7-30重新设计思路
		在程序设计的过程中发现，没有必要再存储计量单位比率，进货数量，进货单价时，在按1-01=20-02　0-01,10-03,10-04　这种
		带有计量单位后缀的存储形式，而直接用
		1=20　10,10,10 这种形式存储　因此在stock表中goods_measurement存储了该批次使用的计量方式
		计量单位比率　10,10,1 要按最小单位折算时算法如下 10*10*1   10*1  1*1
		进货数量　　　10,5,5   要按最小单位折算时算法如下　10*(10*10*1)+5*(10*1)+5*(1*1)
		进货单价　　1000,100,10 要计算最小单位总价时，按　1000*10+100*5+10*5 
		但这存在一个问题，就是如果用户按箱购进，却是按台输入的单价等情况下如何处理？
		如

		情况1 标准情况
		进货数量 10,5,5
		进货单价 200000,20000,2000
		情况2 
		进货数量 10,0,0
		进货单价 0,0,2000
		情况3 
		进货数量 10,0,0
		进货单价 0,20000,0
		情况4 
		进货数量 10,5,0
		进货单价 0,20000,0
		情况4 
		进货数量 10,5,0
		进货单价 200000,20000,0
		
		
		遇到小数进位错误如何处理？
		
		
		解决方法
		如果没有按标准输入该计量单位下的进货单价，则提示用户该问题的存在，告诉用户系统可自动按下一级有效单价计算出总价来显示（注，仅是显示）
		具体程序实现时可这样处理　如　输入了进货5箱，但仅输入了最小单位台的单价2000元,则这样计算总价
		首先判断箱有没有对应的单价，如果没有，取其下一级的单价，如果也没有则
		折算成按最小单位计量时　要先将计量单位比率转换成
		
		
		2009-7-31
		进货时，无论按什么计量单位进的货，都必须输入该进货单位的单价
		情况1 标准情况
		进货数量 10,5,5
		进货单价 200000,20000,2000　此种情况无须单独处理
		
		情况2
		进货数量 10,0,0
		进货单价 0,0,2000　这种情况下，虽然是按每台2000元的标准来支持的，但不能直接输入到没有进货量的这一级，要折算出箱这一级的单价
		按
		进货数量 10,0,0
		进货单价 20000,0,0 登记入库　在备注中写明实际情况	
		情况3 
		进货数量 10,0,0
		进货单价 0,20000,0 此种情况的处理方式等同于情况2
		
		出货时，出货时，根据货物的条码在具体减某一批次的库存　如
		情况1 标准情况
		该批存量 10,5,4
		出货数量 5,2,1
		进货单价 220000,25000,3000　此种情况无须单独处理
		
		情况2
		该批存量 10,5,4
		出货数量 2,8,6
		进货单价 220000,25000,3000　
		则在提交后，要首先处理最小单位，如不够减，则向上一级借。然后处理第二级，如果不够减，则又向更高一级借。依此类推
		实际写代码时，先都换算成最小单位，判断库存是否足够。如果够才按上述方式进行处理，否则给出错误信息
		
		如果同样的商品存在多批次的情况，也可按如下的方式出货
		批1存量 10,5,4 则第一批出2,5,2
		批2存量 10,8,9 第二批出0,3,4
		
　　　　小结
　　　　假设　采用 箱　件　台　方式进行计量
　　　　批次计量标准:stock_mensument
　　　　存储方式:1箱=10件　1件=10台 则存储　10,10,1
　　　　进货量：amount_buy 
　　　　假设购进　10箱　5件　5台
　　　　存储方式:10,5,5
　　　　进货单价：price_buy
　　　　存储方式：1000,100,10　
　　　　
　　　　假设购进　10箱　0件　5台
　　　　存储方式:10,0,5
　　　　进货单价：price_buy
　　　　存储方式：1000,0,10　

　　　　假设购进　0箱　3件　0台
　　　　存储方式:0,3,0
　　　　进货单价：price_buy
　　　　存储方式：0,100,0　
       
　　　　这样可以很方便的算出进货总价，与实际支付的进货总价相对应
      统计进货量也很方便。
      出货
      列表显示该种商品不同批次的数量及存货情况（包括进价）
      选定一个批次后，点出货，弹出对话框，显示出货单
      出货时
      按进货方式一样，按不同的计量标准显示多个输入框，分二种情况处理
		情况1 标准情况
		该批存量 10,5,4
		出货数量 5,2,1　都小于该批次的实际存量　(用一个专门的字段来反映存量)
		
		情况2
		该批存量 10,5,4
		出货数量 2,8,6
		则在提交后，实际写代码时，先都换算成最小单位，判断库存是否足够。如果够才按上述方式进行处理，否则给出错误信息
		要首先处理最小单位，如不够减，则向上一级借。然后处理第二级，如果不够减，则又向更高一级借。依此类推
		
		情况3
		如果同样的商品存在多批次的情况，也可按如下的方式出货
		出货数量 2,8,6
		批1存量 10,5,4 则第一批出2,5,2
		批2存量 10,8,9 则第二批出0,3,4
		出货单价用另一个字段存储
		当出现多批次出货的情况时，要显示出货的总量及总价给用户（列表）
		
		*/
		mysql_query("ALTER TABLE `stock` ADD `goods_measurement`  char(255)  comment '选用的计量单位|text' ");

		mysql_query("ALTER TABLE `stock` ADD `measurement_rate`  char(100)  comment '度量单位设置|text' ");
		/*存储用于显示的该批次的购货数量
		如按　箱件盒　计量模式　的商品进货时可能有如下几种情况
		1.买入10箱，则存储　10-01,0-03,0-04
		2.买入10箱10件，则存储　10-01,10-03,0-04
		3.买入10箱10件10盒，则存储　10-01,10-03,10-04
		4.买入10箱另10盒，则存储　10-01,0-03,10-04
		5.买入10件10盒，则存储　0-01,10-03,10-04
		
		这与计量模式就对等起来，则在整个记录中
		如何计算库存量：
		可按如下方式来统计进货量
		1.同一商品　同一批次　同一计量模式（此种情况下记录仅有一条）
		2.同一商品　同一厂家　不同批次　同一计量模式
		3.同一商品　不同厂家　同一计量模式
		实际实现的时候，只能按条件把满足的记录找出来放进数组，在用php对数组进行遍历操作，分解进货量，求出总的出货量
		对上述的进货进行计算时，要注意进位的问题
		应该有二个统计量，一个是实际的　箱　件　盒　另一个是按进位规则换算后的　箱 件 盒
		先算出所有的‘盒’的数量，再按　1件=20盒　进位成　多少　件另多少盒　在统计所有的件，然后换算成有多少箱　
		
		
		*/
		mysql_query("ALTER TABLE `stock` ADD `amount_buy`  char(100)  comment '购货数量|text' ");//
		mysql_query("ALTER TABLE `stock` ADD `amount_stock`  char(100)  comment '当前批次库存余额|text' ");//

		/*
		对应于购货数量的存储方式 假设上家是按1000元箱来计算，则商家按以下方式录入
		1.买入10箱，则存储　10-01,0-03,0-04　这是数量
		1.买入10箱，则存储　1000-01,0-03,0-04　这是每种计量单位的单价　可按计量单位之间的比例辅助计算，也能手工输入　辅助计算的前提是至少输入了一个单价
		
		3.买入10箱10件10盒，则存储　10-01,10-03,10-04 这是数量
		3.买入10箱10件10盒，则存储　1000-01,50-03,2.5-04 这是每种计量单位的单价
		
		4.买入10箱另10盒，则存储　10-01,0-03,10-04 这是数量
		4.买入10箱另10盒，则存储　1000-01,0-03,2.5-04 这是数量
		
		
		*/
		mysql_query("ALTER TABLE `stock` ADD `price_buy`  char(100)  comment '购货单价|text' ");//仅用于显示的数量
		mysql_query("ALTER TABLE `stock` ADD `price_total_buy`  int  comment '购货总价|text' ");//可手工输入也可通过辅助计算输入
		/*
			到此可计算出库存商品的平均进价　提供给商家来生成　给买家的参考售价　可按不同的计量模式提供不同的参考售价
			如
			箱包件　计量模式　则　按(400-01,40-03,4-04)（这个按当前还有库存的商品计算出来）　可提供　500-01,50-03,5-04(500一箱　５０一件　５元一盒)的参考售价
			箱件盒　计量模式
			
		*/
		
		/*
		对应于购货数量的存储方式　销货数量的存储方式
		1.卖出整20箱，则存储　20-01,0-03,0-04　这是数量
		1.卖出整20箱，则存储　500-01,0-03,0-04　这是每种计量单位的单价　可按计量单位之间的比例辅助计算，也能手工输入　辅助计算的前提是至少输入了一个单价
		
		3.卖出18箱5件3盒，则存储　18-01,5-03,3-04 这是数量
		3.卖出18箱5件3盒，则存储　500-01,50-03,5-04 这是每种计量单位的单价
		
		4.卖出18箱另3盒，则存储　18-01,0-03,3-04
		4.卖出18箱另3盒，则存储　18-01,0-03,3-04
		
		*/

		/*
		１显示已售商品列表 按售货单号排列
		２增加新售货单　一个售货单可有不同批次与类型商品　
			具体实现时，用上中下三栏方式显示操作界面　上方用列表方式显示已输入的该出货单的每条商品信息。中部显示输入数量与价格的
			的编辑界面，下方显示商品列表
			进入该界面后，上与中的界面应该为空，在下方选中一种商品后，出现中部的编辑界面，输入数据后保存，上方出现该商品的列表。
			上方有一个录入自定义售货单编号的文本框与确定按键，只有当输入了编号并按了确定后，这些出货才实际生效。
			点上方的每条出货记录的编辑功能，可修改每个出货记录。修改出货记录时，要同时修改库存
			
			修改库存的操作的非常小心　
			2009-8-03 23.29修改如下
			进入frameset界面时，就生成出货单的ＩＤ，并存储在session中，这样就能解决 售货单代码的问题了
			
		３出现该种商品有库存的进货批次列表
		４按列表，在不同的批次或是同一批次存货中出货
		５减少库存
		*/
		mysql_query("ALTER TABLE `stock` ADD `amount_sell`  char(100)  comment '售货数量|text' ");//仅用于显示的数量
		mysql_query("ALTER TABLE `stock` ADD `price_sell`  char(100)  comment '售货单价|text' ");//仅用于显示的数量
		mysql_query("ALTER TABLE `stock` ADD `price_total_sell`  int  comment '售货总价|text' ");//可手工输入也可通过辅助计算输入
		mysql_query("ALTER TABLE `stock` ADD `edit_lock`  char(1)  comment '锁|text' ");//０进货正常编辑状态１进货编辑锁定５出货新增状态６出货保存状态
		//新入库时为０，如果发生销售，则为１，如果销售结束或别的原因停止销售则为２
		//新增出货时为５，此时如果用户放弃，则此记录在超过一点时间后自动删除。保存后为６ 已出货为７则禁止修改
		
		
		/*
			

		mysql_query("ALTER TABLE `stock` ADD `amount`  char(100)  comment '数量|text' ");//用于显示的数量
		
		mysql_query("ALTER TABLE `stock` ADD `atom_amount`  int  comment '原子数量|text' ");//用于实际的数量
		
		mysql_query("ALTER TABLE `stock` ADD `amount_price`  int  comment '总价|text' ");//用于显示价款

		mysql_query("ALTER TABLE `stock` ADD `amount_price`  int  comment '原子总价|text' ");//用于统计的价款
		
		
		mysql_query("ALTER TABLE `stock` ADD `atom_price`  int  comment '原子单价|text' ");//通过计算得出的最小单位的单价
		*/		

		//mysql_query("ALTER TABLE `stock` ADD `atom_measurement`  char(13)  comment '原子单位|text' ");//
		
		//出了个重要的问题
		//如果基本单位变了，如何处理
		//商品原来的计量单位是　　箱　包　件　现在变为　箱　件　或是　箱　包　时，如何统计与做相关处理
		
		
		//关键在于原子单位要作为统计的最后依据　
		
		mysql_query("ALTER TABLE `goods` ADD `index`  int  comment '内部顺序号|text' ");
		
		mysql_query("ALTER TABLE `goods` ADD `price`  int  comment '当前价格|text' ");
		mysql_query("ALTER TABLE `goods` ADD `discount`  int  comment '当前折扣|text' ");
		
		mysql_query("ALTER TABLE `goods` ADD `storage_real`  int  comment '实际存量|text' ");
		mysql_query("ALTER TABLE `goods` ADD `storage_reserve`  int  comment '预订存量|text' ");

		mysql_query("ALTER TABLE `goods` ADD `description` char(100) comment '商品名称|text' ");
		mysql_query("ALTER TABLE `goods` ADD `description` char(100) comment '商品别名|text' ");
		mysql_query("create index `category_id` on `goods`(category_id) ");
		mysql_query("create index `goods_id` on `goods`(goods_id) ");
		mysql_query("create index `path` on `goods`(path) ");
		mysql_query("create index `description` on `goods`(description) ");		
		

		
		//以下表用于测试与学习orm中的多表关联


		//学生基本信息表
		mysql_query("CREATE TABLE `student`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='学生基本信息表'");
		mysql_query("ALTER TABLE `student` ADD `create_time`  int(11)  comment '创建时间|text' ");
		mysql_query("ALTER TABLE `student` ADD `update_time`  int(11)  comment '创建时间|text' ");
		mysql_query("ALTER TABLE `student` ADD `id`  char(30) comment '学号|text' ");
		mysql_query("ALTER TABLE `student` ADD `name`  char(10)  comment '姓名|text' ");
		mysql_query("ALTER TABLE `student` ADD `gender`  char(2)  comment '性别|text' ");
		mysql_query("ALTER TABLE `student` ADD `birthday`  int(11)  comment '出生日期|text' ");
		mysql_query("ALTER TABLE `student` ADD `class`  char(10)  comment '班级|text' ");
		mysql_query("ALTER TABLE `student` ADD `address`  char(10)  comment '地址|text' ");
		mysql_query("ALTER TABLE `student` ADD `password`  char(10)  comment '密码|text' ");
		mysql_query("ALTER TABLE `student` ADD `hometown`  char(10)  comment '家乡|text' ");
		mysql_query("ALTER TABLE `student` ADD `preference`  char(10)  comment '爱好|text' ");
		mysql_query("create index `id` on `student`(id) ");
		$rs=mysql_query("select count(*) as counter from `student` ");
		$row=mysql_fetch_array($rs);
		//如果没有数据，则插入测试数据
		if($row['counter']<=0){
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('1','1','李1','男','407635200','一班','东大街','成都')");
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('2','2','李2','男','348105600','一班','西大街','成都')");
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('3','3','李3','女','67564800','二班','南大街','重庆')");
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('4','4','李4','男','262224000','二班','北大街','成都')");
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('5','5','李5','女','550886400','三班','中大街','德阳')");
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('6','6','李6','男','716169600','四班','步行街','南充')");
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('7','7','李7','女','484272000','四班','小南街','自贡')");
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('8','8','李8','男','407635200','一班','东大街','成都')");
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('9','9','李9','男','348105600','一班','西大街','成都')");
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('10','10','李10','女','67564800','二班','南大街','重庆')");
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('11','11','李11','男','262224000','二班','北大街','成都')");
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('12','12','李12','女','550886400','三班','中大街','德阳')");
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('13','13','李13','男','716169600','四班','步行街','南充')");
			mysql_query("insert into student(uuid,id,name,gender,birthday,class,address,hometown)values('14','14','李14','女','484272000','四班','小南街','自贡')");

		}
		//一对一成绩表
		mysql_query("CREATE TABLE `score1`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='一对一成绩表'");
		mysql_query("ALTER TABLE `score1` ADD `create_time`  int(11)  comment '创建时间|text' ");
		mysql_query("ALTER TABLE `score1` ADD `update_time`  int(11)  comment '创建时间|text' ");
		mysql_query("ALTER TABLE `score1` ADD `id`  char(30) comment '学号|text' ");
		mysql_query("ALTER TABLE `score1` ADD `english`  char(30) comment '英语|text' ");
		mysql_query("ALTER TABLE `score1` ADD `chinese`  char(30) comment '语文|text' ");
		mysql_query("ALTER TABLE `score1` ADD `computer`  char(30) comment '计算机|text' ");
		mysql_query("ALTER TABLE `score1` ADD `sum`  char(30) comment '总分|text' ");
		mysql_query("create index `id` on `score1`(id) ");
		$rs=mysql_query("select count(*) as counter from `score1` ");
		$row=mysql_fetch_array($rs);
		//如果没有数据，则插入测试数据
		if($row['counter']<=0){
			mysql_query("insert into score1(uuid,id,english,chinese,computer)values('1','1','34','78','45')");
			mysql_query("insert into score1(uuid,id,english,chinese,computer)values('2','2','71','718','96')");
			mysql_query("insert into score1(uuid,id,english,chinese,computer)values('3','3','65','91','87')");
			mysql_query("insert into score1(uuid,id,english,chinese,computer)values('4','4','76','66','45')");
			mysql_query("insert into score1(uuid,id,english,chinese,computer)values('5','5','23','78','88')");
			mysql_query("insert into score1(uuid,id,english,chinese,computer)values('6','6','77','55','77')");
			mysql_query("insert into score1(uuid,id,english,chinese,computer)values('7','7','55','78','56')");		
		}
		
		//一对多成绩表
		mysql_query("CREATE TABLE `score2`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='一对多成绩表'");
		mysql_query("ALTER TABLE `score2` ADD `create_time`  int(11)  comment '创建时间|text' ");
		mysql_query("ALTER TABLE `score2` ADD `update_time`  int(11)  comment '创建时间|text' ");
		mysql_query("ALTER TABLE `score2` ADD `id`  char(30) comment '学号|text' ");
		mysql_query("ALTER TABLE `score2` ADD `course`  char(10) comment '课程名称|text' ");
		mysql_query("ALTER TABLE `score2` ADD `score`  int comment '成绩|text' ");
		mysql_query("create index `id` on `score2`(id) ");
		$rs=mysql_query("select count(*) as counter from `score2` ");
		$row=mysql_fetch_array($rs);
		//如果没有数据，则插入测试数据
		if($row['counter']<=0){
			
			mysql_query("insert into score2(uuid,id,course,score) values('1','1','english','78')");
			mysql_query("insert into score2(uuid,id,course,score) values('2','1','chinese','48')");
			mysql_query("insert into score2(uuid,id,course,score) values('3','1','computer','98')");
			
			mysql_query("insert into score2(uuid,id,course,score) values('4','2','english','38')");
			mysql_query("insert into score2(uuid,id,course,score) values('5','2','chinese','88')");
			mysql_query("insert into score2(uuid,id,course,score) values('6','2','computer','68')");
			
			mysql_query("insert into score2(uuid,id,course,score) values('7','3','english','38')");
			mysql_query("insert into score2(uuid,id,course,score) values('8','3','chinese','58')");
			mysql_query("insert into score2(uuid,id,course,score) values('9','3','computer','68')");
			
			mysql_query("insert into score2(uuid,id,course,score) values('10','4','english','76')");
			mysql_query("insert into score2(uuid,id,course,score) values('11','4','chinese','71')");
			mysql_query("insert into score2(uuid,id,course,score) values('12','4','computer','78')");
			
			mysql_query("insert into score2(uuid,id,course,score) values('13','5','english','98')");
			mysql_query("insert into score2(uuid,id,course,score) values('14','5','chinese','92')");
			mysql_query("insert into score2(uuid,id,course,score) values('15','5','computer','98')");
			
			
			mysql_query("insert into score2(uuid,id,course,score) values('16','6','english','88')");
			mysql_query("insert into score2(uuid,id,course,score) values('17','6','chinese','82')");
			mysql_query("insert into score2(uuid,id,course,score) values('18','6','computer','88')");
			
			
			mysql_query("insert into score2(uuid,id,course,score) values('19','7','english','45')");
			mysql_query("insert into score2(uuid,id,course,score) values('20','7','chinese','71')");
			mysql_query("insert into score2(uuid,id,course,score) values('21','7','computer','83')");		
				
		}
		//以下表定义属于OA系统
		//开始ORM
		$this->redirect(__BASEPATH."setup/orm/start_mapping");
	}
	/**
	 * 数据表数据备份程序:罗维
	 *
	 * @param unknown_type $table
	 * @param unknown_type $fp
	 * @return unknown
	 */
	function backupAction(){
		header("Content-type: text/html; charset=utf-8");
		$this->acl();
		//define('CR',"\r\n");\n
		define('CR',"\n");
		define('BLANK'," ");
		//两种path，一种用于服务器上的文件函数，另一种用于下载
		$backup_path=__SITEROOT."upload/backup/";
		$backup_path1=__BASEPATH."upload/backup/";
		$file_name="backup_".date("Y-m-d",time()).".txt";
		$backup_file=$backup_path.$file_name;
		$fp=fopen($backup_file,"w+");
		if(!$fp)
		{
			echo "创建备份文件出错 ".$table;
			exit();
		}
		
		$db_instance=db_connect::getInstance();
		mysql_query("set names utf8");
		//var_dump($db_instance);
		$sql = "SHOW TABLES FROM $db_instance->database";
		//echo $sql;
		$result = mysql_query($sql);
		//var_dump($result);
		while ($row = mysql_fetch_array($result)) {
			$this->create_insert_sql($row['0'],$fp);
			echo "table: {$row['0']} 生成结束<br>";
		}
		fclose($fp);
//		$url="/download/download/download/news_id/".$news_id."/uuid/".$news_attachement->uuid;
		echo "<font color='red'>备份数据生成完毕</font><br>请下载(右键点击后选另存为)";
		echo "<a href='".$backup_path1.$file_name."' target='_blank'>".$file_name."</a><br>";
		return ;
	}
	function create_insert_sql($table,$fp){
		$rs=mysql_query("select * from $table");
		$line='';
		$line1="insert into $table(";
		$i = 0;
		while ($i<mysql_num_fields($rs)){
			$field_name = mysql_field_name($rs, $i);
			$line1=$line1."`".$field_name."`,";
			$i++;
		}
		
		$line1=rtrim($line1,',');
		$line1=$line1.") values(";
		while ($row=mysql_fetch_array($rs)){
			$i = 0;
			$line2='';
			while ($i<mysql_num_fields($rs)){
				$field_name = mysql_field_name($rs, $i);
				
				$value=addslashes($row[$field_name]);
 		        $search       = array("\x00", "\x0a", "\x0d", "\x1a"); //\x08\\x09, not required
		        $replace      = array('\0', '\n', '\r', '\Z');
				$value=str_replace($search,$replace,$value);
				$line2=$line2."'".$value."',";
				$i++;
			}
			$line2=rtrim($line2,',').");".CR;
			
			$line=$line.$line1.$line2;

		}

		/*		$line=$line."/**".CR;
		$line=$line." * 表中文名 : ".$table_name['1'].CR;
		$line=$line." * 表英文名 : ".$table.CR;
		*/
		fwrite($fp,$line);

	}
	public function restore_file_upload_action(){
		$this->acl();
		require_once(__SITEROOT."config/smarty_config.php");
		$view->assign('__BASEPATH',__BASEPATH);
		$view->assign('message',$_GET['message']);
		$view->display('backup/restore.html');
	}


	public function restoreAction(){
		header("Content-type: text/html; charset=utf-8");
		$this->acl();
/*		if(!in_array($extension_name,$extension_name_array))
		{
			$message="不是备份文件，无法恢复数据! ";
			$allow_upload=0;
		}
*/
		$db_instance=db_connect::getInstance();
		//mysql_query("set names utf8");
		$sql = "SHOW TABLES FROM $db_instance->database";
		//echo $sql;
		$result = mysql_query($sql);
		//var_dump($result);
		while ($row = mysql_fetch_array($result)) {
			mysql_query("delete from ".$row['0']);//清空数据
		}
		$restore_file=__SITEROOT.'upload/backup/restore.sql';
		
		$allow_upload=1;
		//echo $restore_file;
		if($allow_upload and move_uploaded_file($_FILES['file']['tmp_name'],$restore_file))
		{
			$fp=fopen($restore_file,'r');
			while (!feof($fp)) {
				$buffer = trim(fgets($fp, 120000));
				if(empty($buffer)){
					continue;
				}
				if(mysql_query($buffer)){
					
				}
				else {
					
					//如果导不进去，看看是不是因为有了bom (.)
					echo "<br><hr>".$buffer;
					echo "<br>".mysql_error();
					echo "<br>";
				}
			}
			fclose($fp);
			$message="[备份数据成功恢复,操作已完成。]";
		}else{
			$message=$message."备份文件:".$_FILES['file']['name']." 上传失败,可能是文件太大或是文件正被别的程序打开了";
		}
		//echo "文件:".$_FILES['file']['name']." 成功上传";
		$url=__BASEPATH."setup/install/restore_file_upload/message/".urlencode($message);
		$this->redirect($url);
		return;
	}	
	
}
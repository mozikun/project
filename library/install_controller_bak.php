<?php
//此文件不在使用，放到了setup目录下了
require_once(__SITEROOT."library/db.php");
require_once(__SITEROOT."library/controller.php");//相对于index.php的文件位置
class install_controller extends controller  
{
	//public $database;
	public function __construct()
	{
		session_start();
	}
	public function install_action()
	{
		$db_instance=db_connect::getInstance();
		mysql_query("set names utf8");

		mysql_query("create database $db_instance->database");

		//建立留言表
		mysql_query("CREATE TABLE `message_board`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='基本信息表'");
		mysql_query("ALTER TABLE `message_board` ADD `message_id`  char(13) comment '代码|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `messager_name` char(30) comment '发表人|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `messager_ip` char(30) comment '发表人ip|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `date_update` char(30) comment '发表时间|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `have_read` char(1) comment '已阅标志|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `message_title` char(30) comment '标题|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `message_content` text comment '内容|text' ");
		mysql_query("ALTER TABLE `message_board` ADD `reply_content` text comment '评语|text' ");
		mysql_query("create index `message_id` on `message_board`(message_id)");
		//建立部门表
		mysql_query("CREATE TABLE `org`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='基本信息表'");
		mysql_query("ALTER TABLE `org` ADD `org_id`  char(13) comment '部门代码|text' ");
		mysql_query("ALTER TABLE `org` ADD `inner_id`  int comment '内部序号|text' ");
		mysql_query("ALTER TABLE `org` ADD `org_name` char(30) comment '部门名|text' ");
		$rs=mysql_query("select count(*) as counter from `org` ");
		$row=mysql_fetch_array($rs);
		$org_id='9999999999999';
		if($row['counter']<=0)
		{
			mysql_query("insert into `org` values('".uniqid()."','".$org_id."','1','信息部')");//此部门不能删除与重命名
		}

		//建立职员表
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
		mysql_query("create index `user_id` on `user`(user_id)");
		$rs=mysql_query("select count(*) as counter from `user` ");
		$row=mysql_fetch_array($rs);
		if($row['counter']<=0)
		{
			$query_string="insert into `user`(`uuid`,`user_id`,`inner_id`,`user_name`,`org_id`,`user_phone1`,`user_phone2`,`user_e_mail`,`user_qq`,`password`) values('".uniqid()."','9999999999999','20','管理员','".$org_id."','010-00000000','010-00000000','luo@163.com','12345','9527')";
			//echo $query_string;
			mysql_query($query_string);
		}
		//建立主栏目表

		
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
		if($row['counter']<=0)
		{
			mysql_query("insert into `base_info` values('".uniqid()."','新单位','新地址','100000','010-00000000','010-00000000','unit@aaa.com','9527','10')");
		}
		//建立主栏目表
		mysql_query("CREATE TABLE `menu`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目表'");
		mysql_query("ALTER TABLE `menu` ADD `menu_id`  char(13) NOT NULL comment '栏目代码|text' ");
		mysql_query("ALTER TABLE `menu` ADD `description` char(30) NOT NULL   comment '栏目名称|text' ");
		mysql_query("create index `menu` on `menu`(menu_id) ");
		$rs=mysql_query("select count(*) as counter from `menu` ");
		$row=mysql_fetch_array($rs);
		if($row['counter']<=0)
		{
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111111','学院概况')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111121','最新公告')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111131','校院风采')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111141','学院动态')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111151','党群工作')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111161','学科建设')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111171','科学研究')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111181','师资队伍')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111191','教育培养')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111211','招生就业')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111311','学生工作')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111411','实验室建设')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111511','精品课程')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111611','成人教育')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111711','友情连接')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111811','资源下载')");
			mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','1111111111911','医药快讯')");
		}

//		mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','".uniqid()."','教学通知')");
//		mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','".uniqid()."','学院大事')");
//		mysql_query("insert into `menu`(uuid,menu_id,description) values('".uniqid()."','".uniqid()."','公告活动')");

		//建立子栏目表
		mysql_query("CREATE TABLE `sub_menu`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='子栏目表'");
		mysql_query("ALTER TABLE `sub_menu` ADD `menu_id`  char(13) NOT NULL comment '栏目代码|text' ");
		mysql_query("ALTER TABLE `sub_menu` ADD `sub_menu_id`  char(13) NOT NULL comment '子栏目代码|text' ");
		mysql_query("ALTER TABLE `sub_menu` ADD `description` char(30) NOT NULL   comment '子栏目名称|text' ");
		mysql_query("ALTER TABLE `sub_menu` ADD `action` char(10) NOT NULL   comment '点击后动作|text' ");
		mysql_query("create index `menu` on `menu`(menu_id) ");
		$rs=mysql_query("select count(*) as counter from `sub_menu` ");
		$row=mysql_fetch_array($rs);
		if($row['counter']<=0)
		{
			$query_string="select * from menu";
			$rs=mysql_query($query_string);
			while ($row=mysql_fetch_array($rs)) {
				for($counter=1;$counter<5;$counter++)
				{
					$sub_menu_description=$row['description'].'_'.$counter;
					$menu_id=$row['menu_id'];
					mysql_query("insert into `sub_menu`(uuid,menu_id,sub_menu_id,description,action) values('".uniqid()."','".$menu_id."','".uniqid()."','".$sub_menu_description."','1')");
				}
			}
		}

		//		$query_string="insert into `sub_menu`(uuid,menu_id,sub_menu_id,description,action) values('".uniqid()."','473015e6d63ac','".uniqid()."','学院大事1','content')";
//		//echo $query_string;
//		mysql_query($query_string);
//		mysql_query("insert into `sub_menu`(uuid,menu_id,sub_menu_id,description,action) values('".uniqid()."','473015e6d63ac','".uniqid()."','学院大事2','list')");
//		mysql_query("insert into `sub_menu`(uuid,menu_id,sub_menu_id,description,action) values('".uniqid()."','473015e6d63ac','".uniqid()."','学院大事3','list')");
//		mysql_query("insert into `sub_menu`(uuid,menu_id,sub_menu_id,description,action) values('".uniqid()."','473015e6d829d','".uniqid()."','公告活动1','list')");
//		mysql_query("insert into `sub_menu`(uuid,menu_id,sub_menu_id,description,action) values('".uniqid()."','473015e6d829d','".uniqid()."','公告活动2','list')");
//		mysql_query("insert into `sub_menu`(uuid,menu_id,sub_menu_id,description,action) values('".uniqid()."','473015e6d829d','".uniqid()."','公告活动3','list')");
		//建立信息表
		mysql_query("CREATE TABLE `news`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='信息表'");
		mysql_query("ALTER TABLE `news` ADD `sub_menu_id`  char(13) NOT NULL comment '子栏目代码|text' ");
		mysql_query("ALTER TABLE `news` ADD `news_id`  char(13) NOT NULL comment '信息代码|text' ");
		mysql_query("ALTER TABLE `news` ADD `user_id`  char(13) NOT NULL comment '作者|text' ");
		mysql_query("ALTER TABLE `news` ADD `date_create`  int comment '创建时间|int' ");
		mysql_query("ALTER TABLE `news` ADD `date_update`  int comment '修改时间|int' ");
		mysql_query("ALTER TABLE `news` ADD `title` char(254)  comment '标题|text' ");
		mysql_query("ALTER TABLE `news` ADD `visible` char(1) comment '是否可见|text' ");
		mysql_query("ALTER TABLE `news` ADD `target` char(1) comment '只对注册用户|text' ");
		mysql_query("ALTER TABLE `news` ADD `attachment` char(2) comment '附件类型|text|无,图,文' ");
		mysql_query("ALTER TABLE `news` ADD `hit_times` int comment '访问次数|text' ");
		mysql_query("create index `news` on `news`(sub_menu_id,news_id) ");
		//建立信息内容表
		mysql_query("CREATE TABLE `news_content`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='信息表'");
		mysql_query("ALTER TABLE `news_content` ADD `news_id`  char(13) NOT NULL comment '信息代码|text' ");
		mysql_query("ALTER TABLE `news_content` ADD `content` text  comment '内容|text' ");
		mysql_query("create index `news` on `news_content`(news_id) ");

		//		$s="insert into `news`(uuid,sub_menu_id,news_id,data_create,data_update,title,content,visible) values('".uniqid()."','4731e71838e0d','".uniqid()."','".time()."','".time()."','学院大事1','学院大事1content','1')";
//		echo $s;
//		mysql_query($s);
//		mysql_query("insert into `news`(uuid,sub_menu_id,news_id,data_create,data_update,title,content,visible) values('".uniqid()."','4731e71838e0d','".uniqid()."','".time()."','".time()."','学院大事2','学院大事2content','1')");
//		mysql_query("insert into `news`(uuid,sub_menu_id,news_id,data_create,data_update,title,content,visible) values('".uniqid()."','4731e7183d7af','".uniqid()."','".time()."','".time()."','公告活动1','公告活动1content','1')");
//		mysql_query("insert into `news`(uuid,sub_menu_id,news_id,data_create,data_update,title,content,visible) values('".uniqid()."','4731e7183d7af','".uniqid()."','".time()."','".time()."','公告活动2','公告活动2content','1')");
		//建立上传文件表
		mysql_query("CREATE TABLE `news_attachment`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表'");
		mysql_query("ALTER TABLE `news_attachment` ADD `news_id`  char(13) NOT NULL comment '信息代码|text' ");
		mysql_query("ALTER TABLE `news_attachment` ADD `type`  char(5) NOT NULL comment '附件类型|text' ");
		mysql_query("ALTER TABLE `news_attachment` ADD `file_name`  char(254) NOT NULL comment '文件名|text' ");
		mysql_query("ALTER TABLE `news_attachment` ADD `file_real_name`  char(254) NOT NULL comment '文件真名|text' ");
		mysql_query("create index `menu` on `menu` (news_id) ");
		//建立位置表
		mysql_query("CREATE TABLE `layout`  (`uuid` char(13) comment '唯一标识符') ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='布局'");
		mysql_query("ALTER TABLE `layout` ADD `position` char(2) NOT NULL   comment '位置|text' ");
		mysql_query("ALTER TABLE `layout` ADD `menu_id`  char(13) comment '栏目代码|text' ");
		mysql_query("ALTER TABLE `layout` ADD `sub_menu_id`  char(13) comment '子栏目代码|text' ");
		mysql_query("ALTER TABLE `layout` ADD `type`  char(6) comment '分类|text' ");
		mysql_query("create index `position` on `layout`(position) ");
		$rs=mysql_query("select count(*) as counter from `layout` ");
		$row=mysql_fetch_array($rs);
		if($row['counter']<=0)
		{
			mysql_query("insert into `layout`(uuid,position,menu_id,type) values('".uniqid()."','1','1111111111111','menu')");
			mysql_query("insert into `layout`(uuid,position,menu_id,type) values('".uniqid()."','2','1111111111121','menu')");
			mysql_query("insert into `layout`(uuid,position,menu_id,type) values('".uniqid()."','3','1111111111131','menu')");
			mysql_query("insert into `layout`(uuid,position,menu_id,type) values('".uniqid()."','4','1111111111141','menu')");
			mysql_query("insert into `layout`(uuid,position,menu_id,type) values('".uniqid()."','5','1111111111151','menu')");
			mysql_query("insert into `layout`(uuid,position,menu_id,type) values('".uniqid()."','6','1111111111161','menu')");
			mysql_query("insert into `layout`(uuid,position,menu_id,type) values('".uniqid()."','7','1111111111171','menu')");
			mysql_query("insert into `layout`(uuid,position,menu_id,type) values('".uniqid()."','8','1111111111181','menu')");
			mysql_query("insert into `layout`(uuid,position,menu_id,type) values('".uniqid()."','9','1111111111191','menu')");
			mysql_query("insert into `layout`(uuid,position,menu_id,type) values('".uniqid()."','10','1111111111211','menu')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','11','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','12','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','13','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','14','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','15','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','16','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','17','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','18','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','19','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','20','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','21','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','22','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','23','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','24','0','body')");
			mysql_query("insert into `layout`(uuid,position,sub_menu_id,type) values('".uniqid()."','25','0','body')");
		}
		//开始ORM
		$this->redirect("/lib/orm/start_mapping");
	}
	/**
	 * 数据表数据备份程序:罗维
	 *
	 * @param unknown_type $table
	 * @param unknown_type $fp
	 * @return unknown
	 */
	function backup_action()
	{
		header("Content-type: text/html; charset=utf-8");
		$this->acl();
		define('CR',"\r\n");
		define('BLANK'," ");
		$backup_path=$_SERVER['DOCUMENT_ROOT']."/upload/backup/";
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
		echo "<a href='".$backup_file."' target='_blank'>".$file_name."</a><br>";
		return ;
	}
	function create_insert_sql($table,$fp)
	{
		
		
		$rs=mysql_query("select * from $table");
		$line='';
		$line1="insert into $table(";
		$i = 0;
		while ($i<mysql_num_fields($rs))
		{
			$field_name = mysql_field_name($rs, $i);
			$line1=$line1.$field_name.",";
			$i++;
		}
		
		$line1=rtrim($line1,',');
		$line1=$line1.") values(";
		while ($row=mysql_fetch_array($rs))
		{
			$i = 0;
			$line2='';
			while ($i<mysql_num_fields($rs)) 
			{
				$field_name = mysql_field_name($rs, $i);
				$line2=$line2."'".$row[$field_name]."',";
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
	
	
}
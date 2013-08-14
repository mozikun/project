<?php
//从网上下载instantclient_11_1
//解压后把.dll文件复制到system32下
//java
//phpinfo();
//$conn=oci_connect('sys','123456','ORCL');
//echo "ddd";
$s=microtime(true);
header("Content-type: text/html; charset=utf-8");
global $conn;
//$conn=oci_connect('chis','chis','orcclove','UTF8');
$conn=oci_connect('yaanchis','yaanchis','192.168.0.20:1521/yaanchis','UTF8');
exit();

//删除表
$queryString="drop table student";
oracl_query($queryString);

$queryString="drop table score1";
oracl_query($queryString);
//COMMENT ON TABLE ctable_name IS '对表注释的内容'

echo "测试创建新表<br />";
$queryString="create table student(uuid char(30))";
oracl_query($queryString);
$queryString="alter table student add id char(10)";
oracl_query($queryString);
$queryString="alter table student add name char(10)";
oracl_query($queryString);
$queryString="alter table \"student\" add \"userName\" char(10)";
oracl_query($queryString);
$queryString="alter table student add gender char(2)";
oracl_query($queryString);
$queryString="alter table student add birthday int";
oracl_query($queryString);
$queryString="alter table student add class char(10)";
oracl_query($queryString);
$queryString="alter table student add address char(20)";
oracl_query($queryString);
$queryString="alter table student add hometown char(10)";
oracl_query($queryString);

//对student表插入数据
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('1','1','李1','男','407635200','一班','东大街','成都')";
oracl_query($queryString);
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('2','2','李2','男','348105600','一班','西大街','成都')";
oracl_query($queryString);
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('3','3','李3','女','67564800','二班','南大街','重庆')";
oracl_query($queryString);
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('4','4','李4','男','262224000','二班','北大街','成都')";
oracl_query($queryString);
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('5','5','李5','女','550886400','三班','中大街','德阳')";
oracl_query($queryString);
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('6','6','李6','男','716169600','四班','步行街','南充')";
oracl_query($queryString);
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('7','7','李7','女','484272000','四班','小南街','自贡')";
oracl_query($queryString);
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('8','8','李8','男','407635200','一班','东大街','成都')";
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('9','9','李9','男','348105600','一班','西大街','成都')";
oracl_query($queryString);
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('10','10','李10','女','67564800','二班','南大街','重庆')";
oracl_query($queryString);
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('11','11','李11','男','262224000','二班','北大街','成都')";
oracl_query($queryString);
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('12','12','李12','女','550886400','三班','中大街','德阳')";
oracl_query($queryString);
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('13','13','李13','男','716169600','四班','步行街','南充')";
oracl_query($queryString);
$queryString="insert into student(uuid,id,name,gender,birthday,class,address,hometown)
values('14','14','李14','女','484272000','四班','小南街','自贡')";
oracl_query($queryString);
$queryString="comment on table student IS '学生基本信息表'";
oracl_query($queryString);

//COMMENT ON COLUMN ctable_name.field1 IS '对field1列注释的内容';/*给列添加注释内容的方式，有多少个列应该写多少个*/
$queryString="comment on column student.name IS '学生姓名'";
oracl_query($queryString);
$queryString="comment on column student.address IS '地址'";
oracl_query($queryString);

$queryString="create table score1(uuid char(30))";
oracl_query($queryString);
$queryString="alter table score1 add id char(10)";
oracl_query($queryString);
$queryString="alter table score1 add english int";
oracl_query($queryString);
$queryString="alter table score1 add chinese int";
oracl_query($queryString);
$queryString="alter table score1 add computer int";
oracl_query($queryString);
$queryString="comment on table score1 IS '学生成绩表'";
oracl_query($queryString);

$queryString="insert into score1(uuid,id,english,chinese,computer)
values('1','1','34','78','45')";
oracl_query($queryString);
$queryString="insert into score1(uuid,id,english,chinese,computer)
values('2','2','71','718','96')";
oracl_query($queryString);
$queryString="insert into score1(uuid,id,english,chinese,computer)
values('3','3','65','91','87')";
oracl_query($queryString);
$queryString="insert into score1(uuid,id,english,chinese,computer)
values('4','4','76','66','45')";
oracl_query($queryString);
$queryString="insert into score1(uuid,id,english,chinese,computer)
values('5','5','23','78','88')";
oracl_query($queryString);
$queryString="insert into score1(uuid,id,english,chinese,computer)
values('6','6','77','55','77')";
oracl_query($queryString);
$queryString="insert into score1(uuid,id,english,chinese,computer)
values('7','7','55','78','56')";
oracl_query($queryString);

$queryString="create table teacher(uuid char(30))";
oracl_query($queryString);
$queryString="alter table teacher add id char(10)";
oracl_query($queryString);
$queryString="alter table teacher add name char(10)";
oracl_query($queryString);
$queryString="comment on table teacher IS '教师表'";
oracl_query($queryString);

$queryString="insert into teacher(uuid,id,name) values('1','1','张老师')";
oracl_query($queryString);
$queryString="insert into teacher(uuid,id,name) values('2','2','王老师')";
oracl_query($queryString);
$queryString="insert into teacher(uuid,id,name) values('3','3','李老师')";
oracl_query($queryString);

$queryString="create table score2(uuid char(30))";
oracl_query($queryString);
$queryString="alter table score2 add id char(10)";
oracl_query($queryString);
$queryString="alter table score2 add course char(10)";
oracl_query($queryString);
$queryString="alter table score2 add score int";
oracl_query($queryString);
$queryString="alter table score2 add teacher_id char(10)";
oracl_query($queryString);

$queryString="comment on table score2 IS '学生成绩表2'";
oracl_query($queryString);

$queryString="insert into score2(uuid,id,course,score,teacher_id) values('1','1','english','78','1')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('2','1','chinese','48','2')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('3','1','computer','98','3')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('4','2','english','38','1')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('5','2','chinese','88','2')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('6','2','computer','68','3')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('7','3','english','38','1')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('8','3','chinese','58','2')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('9','3','computer','68','3')";
oracl_query($queryString);

$queryString="insert into score2(uuid,id,course,score,teacher_id) values('10','4','english','76','1')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('11','4','chinese','71','2')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('12','4','computer','78','3')";
oracl_query($queryString);

$queryString="insert into score2(uuid,id,course,score,teacher_id) values('13','5','english','98','1')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('14','5','chinese','92','2')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('15','5','computer','98','3')";
oracl_query($queryString);


$queryString="insert into score2(uuid,id,course,score,teacher_id) values('16','6','english','88','1')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('17','6','chinese','82','2')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('18','6','computer','88','3')";
oracl_query($queryString);


$queryString="insert into score2(uuid,id,course,score,teacher_id) values('19','7','english','45','1')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('20','7','chinese','71','2')";
oracl_query($queryString);
$queryString="insert into score2(uuid,id,course,score,teacher_id) values('21','7','computer','83','3')";
oracl_query($queryString);




echo "测试数据列表 student<br />";
$queryString='select * from student';
$stid = oracl_query($queryString);
echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
	//var_dump($row);
	echo "<tr>\n";
	foreach ($row as $item) {
		//echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
		//echo "<td>".iconv('','utf8',$item)."</td>\n";
		echo "<td>$item</td>\n";
	}
	echo "</tr>\n";
}
echo "</table>\n";

echo "测试数据列表 分组<br />";
$queryString='select class,count(*) from student group by class having count(*)>2';
$stid = oracl_query($queryString);
echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
	//var_dump($row);
	echo "<tr>\n";
	foreach ($row as $item) {
		//echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
		//echo "<td>".iconv('','utf8',$item)."</td>\n";
		echo "<td>$item</td>\n";
	}
	echo "</tr>\n";
}
echo "</table>\n";


echo "测试数据列表 排序 score1 order by <br />";
$queryString='select * from score1 order by computer desc';
$stid = oracl_query($queryString);
echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
	//var_dump($row);
	echo "<tr>\n";
	foreach ($row as $item) {
		//echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
		echo "    <td>$item</td>\n";
	}
	echo "</tr>\n";
}
echo "</table>\n";

echo "两表关联 <br />";
$queryString='select * from student inner join score1 on student.id=score1.id order by score1.computer desc';
$stid = oracl_query($queryString);
echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
	//var_dump($row);
	echo "<tr>\n";
	foreach ($row as $item) {
		//echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
		echo "    <td>$item</td>\n";
	}
	echo "</tr>\n";
}
echo "</table>\n";


echo "测试取表名<br />";
//取表名
$queryString="select * from tabs where table_name='STUDENT' or table_name='SCORE1'";
$stid = oracl_query($queryString);
echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
	//var_dump($row);
	echo "<tr>\n";
	foreach ($row as $key=>$item) {
		//echo "    <td>$key-" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
		echo "    <td>$key-$item</td>\n";
	}
	echo "</tr>\n";
}
echo "</table>\n";
echo "测试取备注名称<br />";
//取备注名称
$queryString="select * from USER_TAB_COMMENTS where table_name='STUDENT' or table_name='SCORE1'";
$stid = oci_parse($conn, $queryString);
oci_execute($stid);
echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
	//var_dump($row);
	echo "<tr>\n";
	foreach ($row as $key=>$item) {
		echo "    <td>$key-$item</td>\n";
	}
	echo "</tr>\n";
}
echo "</table>\n";
echo "测试取字段信息<br />";
//取字段信息
$queryString="select
A.column_name 字段名,A.data_type 数据类型,A.data_length 长度,A.data_precision 整数位,
A.Data_Scale 小数位,A.nullable 允许空值,A.Data_default 缺省值,B.comments 备注
from
user_tab_columns A,user_col_comments B
where
A.Table_Name = B.Table_Name
and A.Column_Name = B.Column_Name
and A.Table_Name = 'STUDENT'";
$stid = oci_parse($conn, $queryString);
oci_execute($stid);
echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
	//var_dump($row);
	echo "<tr>\n";
	foreach ($row as $key=>$item) {
		echo "    <td>$key-$item</td>\n";
	}
	echo "</tr>\n";
}
echo "</table>\n";
$e=microtime(true);
echo $e-$s;
function oracl_query($queryString){
	global $conn;
	$stid = oci_parse($conn, $queryString);
	oci_execute($stid);
	return $stid;
}
//取所有表
//SELECT * FROM TABS
//取表信息
//SELECT * FROM USER_TAB_COMMENTS WHERE TABLE_NAME='大写的表名';
//取字段信息 查看字段的详细信息
/*
select
A.column_name 字段名,A.data_type 数据类型,A.data_length 长度,A.data_precision 整数位,
A.Data_Scale 小数位,A.nullable 允许空值,A.Data_default 缺省值,B.comments 备注
from
user_tab_columns A,user_col_comments B
where
A.Table_Name = B.Table_Name
and A.Column_Name = B.Column_Name
and A.Table_Name = 'LANDSELLMEND'
表备注　
//COMMENT ON TABLE ctable_name IS '对表注释的内容';/*给表添加注释的方式*/
//SELECT * FROM USER_TAB_COMMENTS WHERE TABLE_NAME = 'CTABLE_NAME';/*查询某表的注释*/
//字段备注
//COMMENT ON COLUMN ctable_name.field1 IS '对field1列注释的内容';/*给列添加注释内容的方式，有多少个列应该写多少个*/
//SELECT * FROM USER_COL_COMMENTS WHERE TABLE_NAME = 'CTABLE_NAME' AND COLUMN_NAME = 'FIELD1';/*查询某表下某列的注释*/

//create
//查看字符集
//select * from nls_database_parameters

//客户端字符集环境select * from nls_instance_parameters

//分页
//select * from (select job_id,job_title,rownum r from (select * from jobs order by job_id DESC) where rownum<=8) where r>=2;
/*
SELECT * FROM
(
SELECT student.id, ROWNUM RN
FROM  student
WHERE ROWNUM <= 8 AND ID=7
)
WHERE RN >=7
棉花糖(79269786)  17:23:35
SELECT * FROM
(
SELECT student.id, ROWNUM RN
FROM  student
WHERE ROWNUM <= 8
)
WHERE RN >=7


建一个表空间.以后所有的雅安项目指定这个表空间.
CREATE SMALLFILE TABLESPACE "YAANCHIS_TS" DATAFILE 'G:\APP\ADMINISTRATOR\ORADATA\ORCL\yaanchis_ts' SIZE 100M AUTOEXTEND ON NEXT 5000K MAXSIZE UNLIMITED LOGGING EXTENT MANAGEMENT LOCAL SEGMENT SPACE MANAGEMENT AUTO DEFAULT NOCOMPRESS 
建立一个用户并且指定默认表空间+设密码
CREATE USER "yaanchis" IDENTIFIED BY "yaanchis" DEFAULT TABLESPACE "YAANCHIS_TS" ;

连接权限
GRANT "CONNECT" TO "yaanchis";
resource 权限 
GRANT "RESOURCE" TO "yaanchis";
所有的参数不加""号，则系统转为大写，加了引号按引号里的数据处理。但在sqlplus中，不加引号的参数还是写成小写
CREATE SMALLFILE TABLESPACE "mytest" DATAFILE 'D:\APP1\ADMINISTRATOR\ORADATA\ORCL\mytest' SIZE 100M AUTOEXTEND ON NEXT 5000K MAXSIZE UNLIMITED LOGGING EXTENT MANAGEMENT LOCAL SEGMENT SPACE MANAGEMENT AUTO DEFAULT NOCOMPRESS ;
CREATE USER luowei IDENTIFIED BY luowei DEFAULT TABLESPACE mytest;
GRANT connect,resource,dba TO luowei;

如果建立用户的时候是用　"user",则删除的时候也要加 "user"
drop user "user"
在user 表中，user是小写的
如果建立用户的时候是用　user,则删除的时候时候直接"
drop user user
在user表中,user 是大写的

select * from user_indexes

select * from user_ind_columns
drop index inx_name 注意用户

*/

<?php


$config=200;
$config="localhost";

if($config=='localhost'){
	$databaseConfig[1]['charset']='UTF8';
	$databaseConfig[1]['engine']='oracle';
	$databaseConfig[1]['connectType']=1;	
	$databaseConfig[1]['host']='';//
	$databaseConfig[1]['user']='yaanchis';
	$databaseConfig[1]['password']='root';
	
	$databaseConfig[4]['charset']='UTF8';
	$databaseConfig[4]['engine']='mysql';
	$databaseConfig[4]['connectType']=1;	
	$databaseConfig[4]['host']='183.221.216.141';//
	$databaseConfig[4]['database']='dbadapter';//
	$databaseConfig[4]['user']='masdb';
	$databaseConfig[4]['password']='12345678';	

}

if($config==200){
	
	$databaseConfig[1]['charset']='UTF8';
	$databaseConfig[1]['engine']='oracle';
	$databaseConfig[1]['connectType']=1;	
	$databaseConfig[1]['host']='192.168.0.200:1521/orcl';//
	$databaseConfig[1]['user']='yaanchis';
	$databaseConfig[1]['password']='yaanchis';
	
	$databaseConfig[2]['charset']='UTF8';
	$databaseConfig[2]['engine']='oracle';
	$databaseConfig[2]['connectType']=1;	
	$databaseConfig[2]['host']='172.16.11.245:1521/orcl';//
	$databaseConfig[2]['user']='yaanhis';
	$databaseConfig[2]['password']='YAANHIS';
	//一卡通
	$databaseConfig[3]['charset']='UTF8';
	$databaseConfig[3]['engine']='oracle';
	$databaseConfig[3]['connectType']=1;	
	$databaseConfig[3]['host']='172.16.11.249:1521/yaanchis';//
	$databaseConfig[3]['user']='yaanchis';
	$databaseConfig[3]['password']='yaanchis';	
	//mas
	$databaseConfig[4]['charset']='UTF8';
	$databaseConfig[4]['engine']='mysql';
	$databaseConfig[4]['connectType']=1;	
	$databaseConfig[4]['host']='183.221.216.141';//
	$databaseConfig[4]['database']='dbadapter';//
	$databaseConfig[4]['user']='masdb';
	$databaseConfig[4]['password']='12345678';	
}

if($config===251){
$databaseConfig[1]['charset']='UTF8';
	$databaseConfig[1]['engine']='oracle';
	$databaseConfig[1]['connectType']=1;	
	$databaseConfig[1]['host']='172.16.11.251/orcl';//
	$databaseConfig[1]['user']='yaanchis';
	$databaseConfig[1]['password']='yaanchis';
	
	

}

?>

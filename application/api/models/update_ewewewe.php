<?php
/**
weweweweweweew
* @param string $ws_id 
* @return boolean
*/
function update_ws_wewewewe($ws_id){
require_once(__SITEROOT.'library/Models/ws_wewewewe.php');
$table_obj=Tws_wewewewe;
$ws_wewewewe=new $table_obj();
if($ws_wewewewe ->insert()){
	return true;
}else{
	return false;
}
$ws_wewewewe ->free_statement();
}

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 //可以自动加载数据库类
    function __autoload($class_name)
     {      
        $real_class = mb_substr($class_name,1,  strlen($class_name));
        $class_path = __SITEROOT.'library/Models/'.$real_class.'.php'; 
        if(file_exists($class_path))
        {   //判断类文件是否存在  
              require_once($class_path);//动态包含类文件  
        }
       else  
        {
              exit($real_class. '类路径错误。');  
         }  
    }
?>

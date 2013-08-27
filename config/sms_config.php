<?php
/**
 * 短信发送配置程序
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
 //企业ID
 define('SMS_COMID','1211');
 //平台账号
 define('SMS_USER','ud114com');
 //平台密码
 define('SMS_PWD','ud114');
 //平台流水号
 define('SMS_NUMBER','10690');
 //api地址
 define('SMS_API_URL',"http://jiekou.56dxw.com/sms/HttpInterface.aspx?comid=".SMS_COMID."&username=".SMS_USER."&userpwd=".SMS_PWD."&sendtime=".time()."&smsnumber=".SMS_NUMBER);
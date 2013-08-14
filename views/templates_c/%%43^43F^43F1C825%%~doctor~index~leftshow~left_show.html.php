<?php /* Smarty version 2.6.14, created on 2013-04-27 17:40:53
         compiled from left_show.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<style type="text/css">
/*初始环境*/
body{margin:0px;padding:0px;width: 7px;}
</style>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
</head>

<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0">
<table class=hiddentable width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <TBODY>
  <TR>
      <td valign="middle" style="text-align: left;margin-left: -2px;" class="bootstro">
		  <a  href="#" onClick = "middle_onclick()" data-step="1" data-intro="Hello all! :) This project's called Intro.js.">
		 	 <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/arrow-l.gif" id="switchs" border="0" />
		  </a>
	  </td>
  </tr>
</TBODY>
</table>
<script type="text/javascript">
	function middle_onclick()
    {
	     if(window.top.document.getElementById("content").cols=="188,8,*")
	     {
	     	window.top.document.getElementById("content").cols="0,8,*";
		    document.getElementById("switchs").src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/arrow-r.gif"
	     }
	     else
	     {
		    window.top.document.getElementById("content").cols="188,8,*"
		    document.getElementById("switchs").src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/arrow-l.gif"
	     }
     }
//stop -->none error
function noerror(){
return true;
}
window.onerror=noerror;
$(document).ready(function(){
    $("img").css('margin-top',$(document).height()/2);
});
</script>
</body>
</html>

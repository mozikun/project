<?php /* Smarty version 2.6.14, created on 2013-07-23 11:03:24
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
</title>

<style type="text/css">
body{
	margin:0px;padding:0px
}
</style>
<script type="text/javascript">
//stop -->none error
function noerror(){
return true;
}
window.onerror=noerror;
</script>
</head>
<frameset rows="64,*" cols="*" frameborder="yes" border="1" framespacing="0">
  <!--bananer--> 
  <frame src="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/top" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
	  <frameset cols="188,8,*" frameborder="no" border="1" framespacing="0" name="content" id="content">
	  <!--左边-->  
		<frame src="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/leftdh" name="leftdh" scrolling="auto" noresize="noresize" id="" title="leftFrame" /> 
		<frame src="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/leftshow" name="" scrolling="no" noresize="noresize" id="leftFrame" title="leftFrame" /> 
	
	  <!--右边部分-->  
			<frameset rows="33,*" frameborder="no" framespacing="0">			
			<frame src="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/righttop" name="right_top" scrolling="no" noresize="noresize" id="right_top" title="right_top" />
			<frame src="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/search/main/username/<?php echo $this->_tpl_vars['params']['u']; ?>
/card/<?php echo $this->_tpl_vars['params']['c']; ?>
" name="mainFrame"  scrolling="yes" id="_mainFrame" title="mainFrame" />
		    </frameset>
	  </frameset>	  
</frameset>
<noframes>
<body>
</body>
</noframes>
</html>
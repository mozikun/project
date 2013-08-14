<?php /* Smarty version 2.6.14, created on 2013-08-06 10:18:33
         compiled from display.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<style type="text/css">
table
	{
		background:#ffffff;
	}
	input
	{
		border:1px solid blue;
	}
</style>
<title>预防接种CSV接口</title>

<script>
$(document).ready(function(){

  $("#upload").click( function () { 
  	//alert("a");
    if($("#upload_name").val()==""){
   		alert("上传文件不能为空！");
   		return false;
  
    }else {
    
        var pattern=/\.csv$/i;
    	if(($("#upload_name").val()).match(pattern)){
    		return true;
    	}else{
    		alert("上传文件格式不对");
    		return false;
    	}
    }
    	
  });   
   
});

</script>
</head>
<body>
<form  enctype="multipart/form-data"  method="post" action="<?php echo $this->_tpl_vars['basePath']; ?>
vaccinate/index/process">
<table border="0" width="100%">
	<thead>
	<tr>
		<th  style="font-size:16px;text-align:center;">预防接种CSV接口</th>
    </tr>
    </thead>
		<tr>
        <td  style="text-align:center;">
        	 <input type="file" id="upload_name" name="upload_name"/>
			 <input type="submit" id="upload" value="上传"/>
        </td>
        
    </tr>
    <tr>
         <td style="color:red">
           *注 预防接种excel先导成CSV;再上传CSV文件。
         </td>
    </tr>
  
</table>
</form>
</body>
</html>
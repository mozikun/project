<?php /* Smarty version 2.6.14, created on 2013-09-16 00:12:45
         compiled from edit.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/site.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
        <link rel="stylesheet" type="text/css"  href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/default/datepicker.css"/>

        <title><?php echo $this->_tpl_vars['title']; ?>
</title>

    </head>
<body>


        <form method="post" action="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/doctordepartment/save" id="editdepartment" >
            <table cellspacing="0" width="100%">
             
                <tr  class="headbg">
                    <th style="width:40%" colspan="2">编辑医生所属科室</th>
                </tr>
               
                <tr class="columnbg">
                    
                  
                    <th style="width:50px;" >医生姓名</th>
                    <th  >选择所属科室</th>
                </tr>	
                <tbody id='1'>
                <?php if ($this->_tpl_vars['result']): ?>
			
                    <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
                       
                        <td  ><?php echo $this->_tpl_vars['doctor']->name_login; ?>
</td>
						
                        <td >
						<?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
							<input type="checkbox" name="department" <?php if ($this->_tpl_vars['v']['flag'] == 1): ?> checked <?php endif; ?>value="<?php echo $this->_tpl_vars['v']['id']; ?>
"/><?php echo $this->_tpl_vars['v']['name']; ?>
<br/>
						<?php endforeach; endif; unset($_from); ?>	
						</td>
                       
                    </tr>
                    <?php endif; ?>
					 <tr  class="columnbg">
                
						<td  align="center" colspan="2"><input  type="button"  onclick="javascript:window.location='<?php echo $this->_tpl_vars['basePath']; ?>
appointment/doctordepartment/doctors';"value="返回"/> <span  id='back'></span></td>
					</tr>
                </tbody>
            </table>
    </form>
     

</body>
<script type="text/javascript">

$(function(){
	

	$("input[name='department']").each(function(){
		$(this).change(function(){
			if($(this).attr("checked")){
				var todo=1;
			}
			else{
				var todo=2;
			}
			$.ajax({
				url:"<?php echo $this->_tpl_vars['basePath']; ?>
appointment/doctordepartment/save/doctor_id/<?php echo $this->_tpl_vars['doctor']->id; ?>
/department_id/"+$(this).val()+"/todo/"+todo,
				type:"get",
				beforeSend:function(){
					$("#back").html("保存中...");
				},
				success:function(info){
					$("#back").html("保存成功");
					setTimeout(function(){$("#back").html("");},1000);
				}
			})
		});
		
	}); 

	function checkState()
	{
		var flag = false;
		$("input[name='department']").each(function(){
			var isCheck = $(this).attr("checked");	  
			if(isCheck != null && isCheck == "checked")
			{
				flag = true;
			}
		});
		
		if(flag)
		{
			alert(1);
		}
		else
		{
			alert(2);
		}
	}	
});
</script>
</html>
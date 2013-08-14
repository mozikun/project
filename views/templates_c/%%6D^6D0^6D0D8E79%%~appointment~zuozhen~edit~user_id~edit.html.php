<?php /* Smarty version 2.6.14, created on 2013-05-02 11:18:27
         compiled from edit.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/site.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
      

        <title><?php echo $this->_tpl_vars['title']; ?>
</title>

    </head>
    <body>

        <script language="javascript">
            function savedata(){ 
			    
                data=$("form").serialize(); 
                $.post("<?php echo $this->_tpl_vars['basePath']; ?>
appointment/zuozhen/edit",data, function(e){
					flag=e.split("|");
					if(flag==1)
                    alert(e);
                    window.location.reload()
              
                });
            }
          
        </script>
        <form method="post" name="form">
        <input type="hidden" name="action" value="save"/>
        <input type="hidden" name="user_id" value="<?php echo $this->_tpl_vars['user_id']; ?>
"/>
            <table  cellspacing="0">
                <tr  class="headbg">
                    <th colspan="2">修改坐诊表</th>
                </tr>	
                <tbody id='tbody'>
                    <tr >
                        <td width="3%" align="left"  >医务人员:</td>
                        <td    > <?php echo $this->_tpl_vars['name']; ?>
</td>
                        
                    </tr>
                    <tr >
                        <td  rowspan="8" align="left"  >坐诊时间:</td>
                        <td ><font color="red">以下为从当天开始近7天的坐诊表</font></td>
                      
                            <?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                            <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'" ><td>
                            <font color="green">日期:</font><?php echo $this->_tpl_vars['v']['date']; ?>
   <input type="checkbox"  name="datas[<?php echo $this->_tpl_vars['v']['consulting_time']; ?>
][flag]" value="2" 
                            <?php if ($this->_tpl_vars['v']['flag'] == 2): ?>
                            checked<?php endif; ?> 
                            >
                          
                            <font  color="blue"> 时间:</font>
                                 <label>
                                   <input type="radio" name="datas[<?php echo $this->_tpl_vars['v']['consulting_time']; ?>
][time]" value="1" id="time_0" 
                            <?php if ($this->_tpl_vars['v']['flag'] == 2): ?>     
                            <?php if ($this->_tpl_vars['v']['day'] == 1): ?>
                            checked<?php endif; ?> 
                            <?php endif; ?> 
                          
                           
                                   />
                                   上午</label>

                                 <label>
                                   <input type="radio" name="datas[<?php echo $this->_tpl_vars['v']['consulting_time']; ?>
][time]" value="2" id="time_1" 
                            
                            <?php if ($this->_tpl_vars['v']['flag'] == 2): ?>       
                            <?php if ($this->_tpl_vars['v']['day'] == 2): ?>
                            checked<?php endif; ?> 
                            <?php endif; ?> 
                          
                           
                                   />
                                   下午</label>
                               
                                 <label>
                                   <input type="radio" name="datas[<?php echo $this->_tpl_vars['v']['consulting_time']; ?>
][time]" value="3" id="time_2" 
                                   
                          <?php if ($this->_tpl_vars['v']['flag'] == 2): ?>
                            <?php if ($this->_tpl_vars['v']['day'] == 3): ?>
                            checked<?php endif; ?> 
                            <?php endif; ?> 
                          
                             
                                   />
                                   全天
                                   
              &nbsp;&nbsp;科室：                     
            <select name="datas[<?php echo $this->_tpl_vars['v']['consulting_time']; ?>
][department]"id="department">
            <?php $_from = $this->_tpl_vars['department']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dp']):
?>
            <option value="<?php echo $this->_tpl_vars['dp']['uuid']; ?>
"<?php if ($this->_tpl_vars['dp']['uuid'] == $this->_tpl_vars['v']['department'] && $this->_tpl_vars['v']['flag'] == 2): ?>selected<?php endif; ?>>    <?php echo $this->_tpl_vars['dp']['department_name']; ?>
 </option>
            <?php endforeach; endif; unset($_from); ?>
            </select>  
            诊室：
            <select name="datas[<?php echo $this->_tpl_vars['v']['consulting_time']; ?>
][clinic]" id="clinic">
            <?php $_from = $this->_tpl_vars['clinic']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cl']):
?>
            <option value="<?php echo $this->_tpl_vars['cl']['uuid']; ?>
" <?php if ($this->_tpl_vars['cl']['uuid'] == $this->_tpl_vars['v']['clinic'] && $this->_tpl_vars['v']['flag'] == 2): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['cl']['clinic_name']; ?>
 </option>
            <?php endforeach; endif; unset($_from); ?>
            </select>
            号种：
             <select name="datas[<?php echo $this->_tpl_vars['v']['consulting_time']; ?>
][number_species]" id="number_species">
            <?php $_from = $this->_tpl_vars['number_species']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['number']):
?>
            <option value="<?php echo $this->_tpl_vars['number']['uuid']; ?>
" <?php if ($this->_tpl_vars['number']['uuid'] == $this->_tpl_vars['v']['number_species'] && $this->_tpl_vars['v']['flag'] == 2): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['number']['no_species_name']; ?>
 </option>
            <?php endforeach; endif; unset($_from); ?>
            </select>
                         </label>          
                                   
                                </td>
                            </tr>
                                   
            <?php endforeach; endif; unset($_from); ?>
                             
                     
                         

                    </tr>

                </tbody>
                <tr  class="columnbg">
                
                    <td height="167" colspan="5"  align="center" ><input type="button" onclick="savedata();" name="save"  value="保存"/><input type="button"  onclick="javascript:window.location='<?php echo $this->_tpl_vars['basePath']; ?>
appointment/zuozhen/list';"value="返回"/> </td>
                </tr>
            </table>
        </form>


    </body>

</html>
<?php /* Smarty version 2.6.14, created on 2013-09-16 11:26:01
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <script src="<?php echo $this->_tpl_vars['basePath']; ?>
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

        <table cellspacing="0" width="100%">
            <thead>
            </thead>
            <tr  class="headbg">
                <th  colspan="16">坐诊列表</th>
            </tr>

            <tbody id=''>
                <tr>
                    <td width="5%" rowspan="2">坐诊表</td>

                    <?php $_from = $this->_tpl_vars['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>

                    <td align="center" colspan="2"><strong><?php echo $this->_tpl_vars['v']['day']; ?>
<br/><?php echo $this->_tpl_vars['v']['week']; ?>
 <?php if ($this->_tpl_vars['k'] == 0): ?>
                          <?php endif; ?></strong></td>

                    <?php endforeach; endif; unset($_from); ?>
                    <td></td>
                </tr>
                <tr>
                    <td width="5%" align="center" style="background-color:#E0EEEE; ">上午</td>
                    <td width="5%" align="center" style=" background-color:#E6E6FA">下午</td>
                    <td width="5%" align="center" style="background-color:#E0EEEE; ">上午</td>
                    <td width="5%" align="center" style="background-color:#E6E6FA; ">下午</td>
                    <td width="5%" align="center" style="background-color:#E0EEEE;">上午</td>
                    <td width="5%" align="center" style="background-color:#E6E6FA; ">下午</td>
                    <td width="5%"align="center"style="background-color:#E0EEEE;">上午</td>
                    <td width="5%" align="center" style="background-color:#E6E6FA; ">下午</td>
                    <td width="5%"align="center"  style="background-color:#E0EEEE;">上午</td>
                    <td width="5%" align="center"style="background-color:#E6E6FA;">下午</td>
                    <td width="5%"align="center" style="background-color:#E0EEEE;">上午</td>
                    <td width="5%"align="center"  style="background-color:#E6E6FA;">下午</td>
                    <td width="5%"align="center" style="background-color:#E0EEEE;">上午</td>
                    <td width="5%"align="center"  style="background-color:#E6E6FA; ">下午</td> 


                    <td width="10%" align="center"> <b>操作</b></td>

                </tr>

                <?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
                <tr>
                    <td align="center" height="29"><b class="red12"><?php echo $this->_tpl_vars['value']['name']; ?>
</b> </td>
                    <?php $_from = $this->_tpl_vars['value']['cols']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a'] => $this->_tpl_vars['v']):
?>
                    <td onmousemove="style.backgroundColor='#d1eeee'" onmouseout="style.backgroundColor='#ffffff'" bgcolor="#ffffff"   align="center"valign="middle">
                        <?php if ($this->_tpl_vars['v']['day'] == 1 || $this->_tpl_vars['v']['day'] == 3): ?>
                        <?php if ($this->_tpl_vars['v']['flag'] == 2): ?>
                        <?php if ($this->_tpl_vars['v']['register_num_net'] > 0): ?>
                        <img onmouseover="displayin(event,<?php echo $this->_tpl_vars['key']; ?>
,<?php echo $this->_tpl_vars['v']['date']; ?>
,<?php echo $this->_tpl_vars['v']['day']; ?>
)" onmouseout="displayout(event,<?php echo $this->_tpl_vars['key']; ?>
,<?php echo $this->_tpl_vars['v']['date']; ?>
,<?php echo $this->_tpl_vars['v']['day']; ?>
)" width="20" height="20"  src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/yes.png"/>                    
                        <div id="<?php echo $this->_tpl_vars['key']; ?>
-<?php echo $this->_tpl_vars['v']['date']; ?>
-<?php echo $this->_tpl_vars['v']['day']; ?>
" style="display: none">
                            <table name="info" class="info" >
                                <tr>
                                    <td style="background-color: #79CDCD">科室</td><td><?php echo $this->_tpl_vars['v']['department_name']; ?>
</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #79CDCD">诊室</td><td><?php echo $this->_tpl_vars['v']['clinic_name']; ?>
</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #79CDCD">号种</td><td><?php echo $this->_tpl_vars['v']['number_species_name']; ?>
</td>
                                </tr>
                            </table>
                        </div>
                        <?php else: ?> 
                        <img  src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/full.jpg" />   
                        <?php endif; ?> 
                        <?php endif; ?> 
                        <?php endif; ?>
                    </td>
                    <td onmousemove="style.backgroundColor='#d1eeee'" onmouseout="style.backgroundColor='#ffffff'" bgcolor="#ffffff"   align="center"valign="middle">
                        <?php if ($this->_tpl_vars['v']['day'] == 2 || $this->_tpl_vars['v']['day'] == 3): ?>
                        <?php if ($this->_tpl_vars['v']['flag'] == 2): ?>
                        <?php if ($this->_tpl_vars['v']['register_num_net'] > 0): ?>
                     <img onmouseover="displayin(event,<?php echo $this->_tpl_vars['key']; ?>
,<?php echo $this->_tpl_vars['v']['date']; ?>
,<?php echo $this->_tpl_vars['v']['day']; ?>
)" onmouseout="displayout(event,<?php echo $this->_tpl_vars['key']; ?>
,<?php echo $this->_tpl_vars['v']['date']; ?>
,<?php echo $this->_tpl_vars['v']['day']; ?>
)" width="20" height="20"  src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/yes.png"/> 
                      <div id="<?php echo $this->_tpl_vars['key']; ?>
-<?php echo $this->_tpl_vars['v']['date']; ?>
-<?php echo $this->_tpl_vars['v']['day']; ?>
" style="display: none">
                            <table name="info" class="info" >
                                <tr>
                                    <td style="background-color: #79CDCD">科室</td><td><?php echo $this->_tpl_vars['v']['department_name']; ?>
</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #79CDCD">诊室</td><td><?php echo $this->_tpl_vars['v']['clinic_name']; ?>
</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #79CDCD">号种</td><td><?php echo $this->_tpl_vars['v']['number_species_name']; ?>
</td>
                                </tr>
                            </table>
                        </div>
                        <?php else: ?> 
                        <img  src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/full.jpg" />   
                        <?php endif; ?> 
                        <?php endif; ?> 
                        <?php endif; ?>
                    </td>

                    <?php endforeach; endif; unset($_from); ?> 



                    <td  align="center"> <a  href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/zuozhen/edit/user_id/<?php echo $this->_tpl_vars['value']['id']; ?>
/name/<?php echo $this->_tpl_vars['value']['name']; ?>
/action/edit">编辑</a></td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>

            </tbody>


            <tr  class="columnbg">
                <td  colspan="16"><div style=" float:left"></div><div style="float:right"><?php echo $this->_tpl_vars['page']; ?>
</div></td>
            </tr>
        </table>

        <br />


    </body>
</html>
<script type="text/javascript">
    function displayin(e,key,date,day){
        var obj= $("#"+key+"-"+date+"-"+day);
        obj.css({left:e.clientX+'px'})
        .css({position:'absolute'});
        if(obj.is(":animated")){stop;}
        else{
            obj.fadeIn("slow");
        }
    }
    function displayout(e,key,date,day){
        var obj= $("#"+key+"-"+date+"-"+day);
        obj.fadeOut();
    }      
</script>
<?php /* Smarty version 2.6.14, created on 2013-09-15 22:20:17
         compiled from doctors.html */ ?>
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


        <form method="post">
            <table cellspacing="0" width="100%">
             
                <tr  class="headbg">
                    <th style="width:40%" colspan="3">医生列表</th>
                </tr>
               
                <tr class="columnbg">
                    
                    <th width="20%" >编号</th>
                    <th width="20%" >姓名</th>
                    <th width="24%" >操作</th>
                </tr>	
                <tbody id='1'>
                <?php if ($this->_tpl_vars['result']): ?>
                    <?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                    <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
                       
                        <td  ><?php echo $this->_tpl_vars['v']['standard_code']; ?>
</td>
                        <td > <?php echo $this->_tpl_vars['v']['name']; ?>
</td>
                        <td> <a name="edit" href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/doctordepartment/editdepartment/doctor_id/<?php echo $this->_tpl_vars['v']['id']; ?>
">[管理所在科室]</a></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                    
                    <?php else: ?>
                    <td colspan="4">暂时没有信息!</td>
                    <?php endif; ?>	
                </tbody>
            </table>
    </form>
     

</body>

</html>
<?php /* Smarty version 2.6.14, created on 2013-05-02 11:42:35
         compiled from add.html */ ?>
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

        <script language="javascript">
            function savedata(){
         
                       if($("#name").val()==""){
                      alert("号种名称不能为空");return false;
                                }
                          if($("#sort_number").val()==""){
                                  alert("请输入排序号");return false;
                              }  if(!(/^(\+|-)?\d+$/.test($("#sort_number").val())))  
                                  {
                                      alert("排序号只能为数字") 
                                   return false;    
                              }
         
                              if(!$("input[name='status']:checked").val())
                                  {
                                      alert("请选择状态");return false;
                                  }
                             
                data=$("form").serialize(); 
                $.post("<?php echo $this->_tpl_vars['basePath']; ?>
appointment/number_species/add",data, function(a){
                    alert(a);
                    window.location="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/number_species/index";
              
                });
            }
          
        </script>
        <form method="post" name="form">
            <input type="hidden" name="action" value="save"/>
            <input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['rows']['uuid']; ?>
"/>

            <table  cellspacing="0" width="100%">
                <thead>

                </thead>
                <tr  class="headbg">
                    <th style="width:40%" colspan="4">添加号种</th>
                </tr>	
                <tbody id='1'>

                    <tr >
                        <td  align="right"width="29%"  >号种名称:</td>
                        <td width="71%"  > <input type="text" value="<?php echo $this->_tpl_vars['rows']['no_species_name']; ?>
" name="no_species_name" id="name"/>
                        </td>

                    </tr>
                   
                     <tr >
                        <td  align="right"width="29%"  >排序号:</td>
                        <td width="71%"  ><input id='sort_number' name="sort_number" type="text" value="<?php echo $this->_tpl_vars['rows']['sort_number']; ?>
"/>注：序号越大，排序越靠后
                        </td>


                    </tr>
                    
                     <tr >
                        <td  align="right"width="29%"  >状态:</td>
                        <td width="71%"  ><input type="radio" name="status" value="1"<?php if ($this->_tpl_vars['rows']['status_flag'] == 1): ?>checked<?php endif; ?>/>启用<input type="radio" name="status" value="0" <?php if ($this->_tpl_vars['rows']['status_flag'] == '0'): ?>checked<?php endif; ?>/>禁用
                        </td>


                    </tr>

                </tbody>
                <tr  class="columnbg">

                    <td  align="center"style="width:40%" colspan="4"><input type="button" onclick="savedata();" name="save"  value="保存"/><input onclick="javascript:window.location='<?php echo $this->_tpl_vars['basePath']; ?>
appointment/number_species/index';" type="button" value="返回"/> </td>
                </tr>
            </table>
        </form>


    </body>

</html>
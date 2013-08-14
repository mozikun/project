<?php /* Smarty version 2.6.14, created on 2013-05-02 11:16:03
         compiled from index.html */ ?>
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
<script  type="text/javascript" language="javascript">
            function load_xml(x,y,id){ 
                $.get("<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/interface/load_xml/module_id/"+id+"/random/"+Math.random(), function(data){
                    $("#xml").css("left",x);
                    $("#xml").css("top",y); 
                    $("#xml").html(data);
                    $("#xml").show();
                });
            }
            function tohide(){
                $("#xml").hide();
            }
        </script>

        <form method="post">
            <table cellspacing="0" width="100%">
                <thead>

                </thead>
                <tr  class="headbg">
                    <th style="width:40%" colspan="4">诊室列表</th>
                </tr>
               
                <tr class="columnbg">
                    
                    <th width="20%" >诊室名称</th>
                    <th width="20%" >排序号</th>
                    <th width="20%" >状态</th>
                    <th width="24%" >操作</th>
                </tr>	
                <tbody id='1'>
                <?php if ($this->_tpl_vars['rows']): ?>
                    <?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                    <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
                       
                        <td  ><?php echo $this->_tpl_vars['v']['clinic_name']; ?>
</td>
                        <td > <?php echo $this->_tpl_vars['v']['sort_number']; ?>
</td>
                         <td > <?php echo $this->_tpl_vars['v']['status']; ?>
</td>
                     
                        <td> <a name="edit" href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/clinic/add/action/edit/uuid/<?php echo $this->_tpl_vars['v']['uuid']; ?>
">[编辑]</a> | <a href="#" onclick="del('<?php echo $this->_tpl_vars['v']['uuid']; ?>
')">[删除]</a></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                    
                    <?php else: ?>
                    <td colspan="4">暂时没有信息!</td>
                    <?php endif; ?>	
                </tbody>
 

                <tr  class="columnbg">
                    <td style="width:40%" colspan="4"><div style=" float:left">[<a name="add" href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/clinic/add/action/add">添加诊室</a>]</div><div style="float:right"><?php echo $this->_tpl_vars['page']; ?>
</div></td>
                </tr>
            </table>
    </form>
        <br />
<script  language="javascript">
           function del(id)
		   {   
		      if(confirm('您确定删除吗?请谨慎操作')){
			   $.get("<?php echo $this->_tpl_vars['basePath']; ?>
appointment/clinic/del/uuid/"+id,function(data){
				   alert(data);

				   window.location='/appointment/clinic/index';
			   });
			  }
			   }
        </script>

</body>

</html>
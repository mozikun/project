<?php /* Smarty version 2.6.14, created on 2013-08-22 15:59:56
         compiled from total.html */ ?>
<table border="0" width="100%">

    <tr class="columnbg">

        <?php $_from = $this->_tpl_vars['specialty_code']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
        <td><?php echo $this->_tpl_vars['v']; ?>
</td>
        <?php endforeach; endif; unset($_from); ?>
	</tr>
    <tr>
    	<?php $_from = $this->_tpl_vars['specialty_code']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
        <td ><?php $_from = $this->_tpl_vars['staff_type_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sk'] => $this->_tpl_vars['sv']):
 if ($this->_tpl_vars['k'] == $this->_tpl_vars['sk']):  echo $this->_tpl_vars['sv'];  endif;  endforeach; endif; unset($_from); ?></td>
        <?php endforeach; endif; unset($_from); ?>
	</tr>

  
</table>
<?php /* Smarty version 2.6.14, created on 2013-04-27 23:39:22
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
	<style>
	td{
		padding:0px;
		margin:0px;
	}
	input{
		width:60px;
		margin:0px;
		padding:0px;
		
	}
	</style>
    </head>
    <body>

        <form method="post" name="form" action="<?php echo $this->_tpl_vars['basePath']; ?>
ya420/jzsyyljzxx/editin">
        <input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['rows']['uuid']; ?>
"/>
            <table  cellspacing="0" width="100%">
                <thead>

                </thead>
                <tr  class="headbg">
                    <th  colspan="22">门（急）诊伤员医疗救治信息</th>
                </tr>
				<form name="form1" method="post">	
                <tbody id='1'>

                    <tr >
                        <td rowspan= '2'  >患者姓名</td>
                        <td  rowspan='2' >性别</td>
                        <td  rowspan='2' >年龄</td>
                        <td  rowspan='2' >患者来源</td>
                        <td  rowspan='2' >联系电话</td>
                        <td  rowspan='2' >地震伤疾病名称</td>
                        <td  rowspan='2' >请注明受伤原因</td>
                        <td  rowspan='2' >非地震伤病员疾病名称</td>
                        <td  rowspan='2' >外伤请注明受伤原因</td>
                        <td  rowspan='2' >是否急诊(是填1)</td>
                        <td  colspan='4'>门诊伤员救治效果</td>
                        <td  rowspan='2'>是否手术(是填1)</td>
                        <td  rowspan='2'>手术名称</td>
                    </tr>
					
					<tr >
                        <td  >转住院(是填1) </td>
                        <td  >转住院医院名称</td>
                        <td  >处理后离开(是填1)</td>
                        <td  >死亡(是填1)</td>
                       
                    </tr>
                    <tr>
						<td><input type='text' name="items[xm       ]" style="width: 40px"/></td>
						<td><input type='text' name="items[xb       ]" style="width: 15px]"/></td>
						<td><input type='text' name="items[age      ]"/></td>
						<td><input type='text' name="items[hzly     ]" style="width: 120px]"/></td>
						<td><input type='text' name="items[lxdh     ]" style="width: 120px]"/></td>
						<td><input type='text' name="items[dzsjbymc ]" style="width: 120px]"/></td>
						<td><input type='text' name="items[ssyy     ]" style="width: 120px]]"/></td>
						<td><input type='text' name="items[fdzssbymc]" style="width: 120px]dddd"/></td>
						<td><input type='text' name="items[fdzssyy  ]" style="width: 120px]dddd]"/></td>
						<td><input type='text' name="items[sfjz     ]" style="width: 15px"/></td>
						<td><input type='text' name="items[jz_zzy   ]" style="width: 15px"/></td>
						<td><input type='text' name="items[jz_zzymc ]" style="width: 120px"/></td>
						<td><input type='text' name="items[jz_clhlk ]" style="width: 15px"/></td>
						<td><input type='text' name="items[jz_sw    ]" style="width: 15px"/></td>
						<td><input type='text' name="items[sfss     ]" style="width: 15px"/></td>
						<td><input type='text' name="items[ssmc     ]" style="width: 120px"/></td>
					</tr> 
					<tr>
						<td colspan='16' align='center'><input type="submit" value="保存内容" class="input" style="height: 28px;font-size:14px;"></td>
					</tr>
				</form>
            </table>
       


    </body>

</html>
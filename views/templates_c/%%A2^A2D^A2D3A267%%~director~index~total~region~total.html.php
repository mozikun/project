<?php /* Smarty version 2.6.14, created on 2013-08-22 15:58:52
         compiled from total.html */ ?>
<table border="0" width="100%">

    <tr class="columnbg">
        <td colspan="4">
        	健康档案
        </td>
	</tr>
    <tr>
        <td style="width: 25%;">建档人数</td><td style="width: 25%;"><?php echo $this->_tpl_vars['individual_nums']; ?>
</td><td style="width: 25%;">建档家庭数</td><td style="width: 25%;"><?php echo $this->_tpl_vars['family_nums']; ?>
</td>
	</tr>
    <tr class="columnbg">
        <td colspan="6">
        	健康体检
        </td>
	</tr>
    <tr>
        <td>体检人数</td><td><?php echo $this->_tpl_vars['examination_p_nums']; ?>
</td><td>体检次数</td><td><?php echo $this->_tpl_vars['examination_nums']; ?>
</td>
	</tr>
    <tr class="columnbg">
        <td colspan="6">
        	诊疗记录
        </td>
	</tr>
    <tr>
        <td>门诊病历数</td><td><?php echo $this->_tpl_vars['patient_nums']; ?>
</td><td>入院证明数</td><td><?php echo $this->_tpl_vars['hos_discharge_certificate_admission_nums']; ?>
</td>
	</tr>
    <tr>
        <td>出院证明数</td><td colspan="3"><?php echo $this->_tpl_vars['hos_discharge_certificate_nums']; ?>
</td>
	</tr>
    <tr class="columnbg">
        <td colspan="6">
        	健康教育
        </td>
	</tr>
    <tr>
        <td>健康教育次数</td><td colspan="3"><?php echo $this->_tpl_vars['health_education_nums']; ?>
</td>
	</tr>
    <tr class="columnbg">
        <td colspan="6">
        	保健
        </td>
	</tr>
    <tr>
        <td style="font-weight: bold;">儿童保健次数</td><td colspan="3"><?php echo $this->_tpl_vars['child_total']; ?>
</td>
	</tr>
    <tr>
        <td>新生儿家庭访视人数</td><td><?php echo $this->_tpl_vars['child_visits_p_nums']; ?>
</td><td>新生儿家庭访视次数</td><td><?php echo $this->_tpl_vars['child_visits_nums']; ?>
</td>
	</tr>
    <tr>
        <td>3岁以内健康检查次数</td><td><?php echo $this->_tpl_vars['child_physical_nums']; ?>
</td><td>3岁儿童健康检查次数</td><td><?php echo $this->_tpl_vars['child_physical_age_three_nums']; ?>
</td>
	</tr>
    <tr>
        <td style="font-weight: bold;">孕产妇健康管理次数</td><td colspan="3"><?php echo $this->_tpl_vars['prenatal_total']; ?>
</td>
	</tr>
    <tr>
        <td>第1次产前随访次数</td><td><?php echo $this->_tpl_vars['prenatal_visit_first_nums']; ?>
</td><td>第2-5次产前随访次数</td><td><?php echo $this->_tpl_vars['prenatal_visit_two_nums']; ?>
</td>
	</tr>
    <tr>
        <td>产后随访次数</td><td><?php echo $this->_tpl_vars['postpartum_visit_nums']; ?>
</td><td>产后42天检查次数</td><td><?php echo $this->_tpl_vars['postpartum_heathcheck_nums']; ?>
</td>
	</tr>
    <tr>
        <td style="font-weight: bold;">婚前保健</td><td colspan="3"><?php echo $this->_tpl_vars['certificate_premartial_exam_total']; ?>
</td>
	</tr>
    <tr>
        <td>医学婚检证明次数</td><td><?php echo $this->_tpl_vars['certificate_premartial_exam_nums']; ?>
</td><td>婚前医学检查次数</td><td><?php echo $this->_tpl_vars['premarital_examination_nums']; ?>
</td>
	</tr>
    <tr class="columnbg">
        <td colspan="6">
        	预防
        </td>
	</tr>
    <tr>
        <td>预防接种次数</td><td colspan="3"><?php echo $this->_tpl_vars['vac_card_nums']; ?>
</td>
	</tr>
    <tr class="columnbg">
        <td colspan="6">
        	慢病管理
        </td>
	</tr>
    <tr>
        <td style="font-weight: bold;" colspan="4">高血压</td>
	</tr>
    <tr>
        <td>确诊人数</td><td><?php echo $this->_tpl_vars['clinical_history_hy_nums']; ?>
</td><td>管理人数</td><td><?php echo $this->_tpl_vars['hypertension_follow_up_p_nums']; ?>
</td>
	</tr>
    <tr>
        <td>随访次数</td><td colspan="3"><?php echo $this->_tpl_vars['hypertension_follow_up_nums']; ?>
</td>
	</tr>
    <tr>
        <td style="font-weight: bold;" colspan="4">糖尿病</td>
	</tr>
    <tr>
        <td>确诊人数</td><td><?php echo $this->_tpl_vars['clinical_history_cd_nums']; ?>
</td><td>管理人数</td><td><?php echo $this->_tpl_vars['diabetes_core_p_nums']; ?>
</td>
	</tr>
    <tr>
        <td>随访次数</td><td colspan="3"><?php echo $this->_tpl_vars['diabetes_core_nums']; ?>
</td>
	</tr>
    <tr>
        <td style="font-weight: bold;" colspan="4">精神分裂</td>
	</tr>
    <tr>
        <td>确诊人数</td><td><?php echo $this->_tpl_vars['clinical_history_schizophrenia_nums']; ?>
</td><td>管理人数</td><td><?php echo $this->_tpl_vars['schizophrenia_p_nums']; ?>
</td>
	</tr>
    <tr>
        <td>随访次数</td><td colspan="3"><?php echo $this->_tpl_vars['schizophrenia_nums']; ?>
</td>
	</tr>
    <tr>
        <td style="font-weight: bold;" colspan="4">其他</td>
	</tr>
    <tr>
        <td>确诊人数</td><td colspan="3"><?php echo $this->_tpl_vars['clinical_history_other_nums']; ?>
</td>
	</tr>
    <tr class="columnbg">
        <td colspan="6">
        	其它医疗服务
        </td>
	</tr>
    <tr>
        <td>接诊记录数</td><td><?php echo $this->_tpl_vars['diagnosis_table_nums']; ?>
</td><td>会诊记录数</td><td><?php echo $this->_tpl_vars['consultation_table_nums']; ?>
</td>
	</tr>
    <tr>
        <td>双向转诊转入数</td><td><?php echo $this->_tpl_vars['patient_referral_in_nums']; ?>
</td><td>双向转诊转出数</td><td><?php echo $this->_tpl_vars['patient_referral_out_nums']; ?>
</td>
	</tr>
</table>
<?php
require_once ('db_oracle.php');
/**
 *注释:脏器功能
 *
 *
 **/
class Tet_organ extends dao_oracle{
	 public $__table = 'et_organ';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:医生档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:个人档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:添加记录时间
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $created;
	 public $_created_type='varchar2';
	/**
 	 * 注释:健康体检id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $examination_id;
	 public $_examination_id_type='varchar2';
	/**
 	 * 注释:口腔 口唇|radio|1=>红润,2=>苍白,3=>发干,4=>皲裂,5=>疱疹
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $lips;
	 public $_lips_type='varchar2';
	/**
 	 * 注释:口腔 齿列正常|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $dentition;
	 public $_dentition_type='varchar2';
	/**
 	 * 注释:口腔 齿列缺齿|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $dentition_missing_teeth;
	 public $_dentition_missing_teeth_type='varchar2';
	/**
 	 * 注释:口腔齿列龋齿|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $dentition_decayed_tooth;
	 public $_dentition_decayed_tooth_type='varchar2';
	/**
 	 * 注释:口腔齿列义齿(假牙)|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $dentition_false_tooth;
	 public $_dentition_false_tooth_type='varchar2';
	/**
 	 * 注释:口腔咽部|radio|1=>无充血,2=>充血,3=>淋巴滤泡增生
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $pharyngeal_portion;
	 public $_pharyngeal_portion_type='varchar2';
	/**
 	 * 注释:视力左眼|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $left_eye;
	 public $_left_eye_type='varchar2';
	/**
 	 * 注释:视力左眼矫正视力|text
	 * 
	 * 
	 * @var VARCHAR2(17)
	 **/
 	 public $left_eye_corrected_vision;
	 public $_left_eye_corrected_vision_type='varchar2';
	/**
 	 * 注释:视力右眼|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $right_eye;
	 public $_right_eye_type='varchar2';
	/**
 	 * 注释:视力右眼矫正视力|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $right_eye_corrected_vision;
	 public $_right_eye_corrected_vision_type='varchar2';
	/**
 	 * 注释:听力|radio|1=>听见,2=>听不清或无法听见
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hearing;
	 public $_hearing_type='varchar2';
	/**
 	 * 注释:运用功能|radio|1=>可顺利完成,2=>无法独立完成其中任何一个动作
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $energizing_function;
	 public $_energizing_function_type='varchar2';
	/**
 	 * 注释:皮肤|radio|1=>正常,2=>潮红,3=>苍白,4=>发绀,5=>黄染,6=>色素沉着,7=>其他
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $skin;
	 public $_skin_type='varchar2';
	/**
 	 * 注释:皮肤其它|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $skin_other;
	 public $_skin_other_type='varchar2';
	/**
 	 * 注释:巩膜|radio|1=>正常,2=>黄染,3=>充血,4=>其他
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sclera;
	 public $_sclera_type='varchar2';
	/**
 	 * 注释:巩膜其它|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $sclera_other;
	 public $_sclera_other_type='varchar2';
	/**
 	 * 注释:淋巴结|radio|1=>未触及,2=>锁骨上,3=>腋窝,4=>其他
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $lymph_node;
	 public $_lymph_node_type='varchar2';
	/**
 	 * 注释:淋巴结其它|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $lymph_node_other;
	 public $_lymph_node_other_type='varchar2';
	/**
 	 * 注释:肺桶状胸|radio|1=>否,2=>是
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $lung_barrel_chest;
	 public $_lung_barrel_chest_type='varchar2';
	/**
 	 * 注释:肺呼吸音|radio|1=>正常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $lung_sounds;
	 public $_lung_sounds_type='varchar2';
	/**
 	 * 注释:肺呼吸音异常|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $lung_sounds_exception;
	 public $_lung_sounds_exception_type='varchar2';
	/**
 	 * 注释:肺罗音|radio|1=>无,2=>干罗音,3=>湿罗音,4=>其他
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $lung_rale;
	 public $_lung_rale_type='varchar2';
	/**
 	 * 注释:肺罗音其它|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $lung_rale_other;
	 public $_lung_rale_other_type='varchar2';
	/**
 	 * 注释:心率(次/分钟)|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $heart_rate;
	 public $_heart_rate_type='varchar2';
	/**
 	 * 注释:心律|radio|1=>齐,2=>不齐,3=>绝对不齐
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $heart_rhythm;
	 public $_heart_rhythm_type='varchar2';
	/**
 	 * 注释:心脏杂音|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $heart_noise;
	 public $_heart_noise_type='varchar2';
	/**
 	 * 注释:心脏杂音|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $heart_noise_info;
	 public $_heart_noise_info_type='varchar2';
	/**
 	 * 注释:腹部压痛|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $abdominal_tenderness;
	 public $_abdominal_tenderness_type='varchar2';
	/**
 	 * 注释:腹部压痛|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $abdominal_tenderness_info;
	 public $_abdominal_tenderness_info_type='varchar2';
	/**
 	 * 注释:腹部包块|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $abdominal_mass;
	 public $_abdominal_mass_type='varchar2';
	/**
 	 * 注释:腹部包块|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $abdominal_mass_info;
	 public $_abdominal_mass_info_type='varchar2';
	/**
 	 * 注释:腹部肝大|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $abdominal_hepatomegaly;
	 public $_abdominal_hepatomegaly_type='varchar2';
	/**
 	 * 注释:腹部肝大|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $abdominal_hepatomegaly_info;
	 public $_abdominal_hepatomegaly_info_type='varchar2';
	/**
 	 * 注释:腹部脾大|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $abdominal_splenomegaly;
	 public $_abdominal_splenomegaly_type='varchar2';
	/**
 	 * 注释:腹部脾大|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $abdominal_splenomegaly_info;
	 public $_abdominal_splenomegaly_info_type='varchar2';
	/**
 	 * 注释:腹部移动性浊音|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $shifting_dullness;
	 public $_shifting_dullness_type='varchar2';
	/**
 	 * 注释:腹部移动性浊音|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $shifting_dullness_info;
	 public $_shifting_dullness_info_type='varchar2';
	/**
 	 * 注释:下肢水肿|radio|1=>无,2=>单侧,3=>双侧不对称,4=>双侧对称
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ramus_inferior_edema;
	 public $_ramus_inferior_edema_type='varchar2';
	/**
 	 * 注释:足背动脉搏动|radio|1=>未触及,2=>触及双侧对称,3=>触及左侧弱或消失,4=>触及右侧弱或消失
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $foot_arterial_pulse;
	 public $_foot_arterial_pulse_type='varchar2';
	/**
 	 * 注释:肛门指诊|radio|1=>未及异常,2=>触痛,3=>包块,4=>前列腺异常,5=>其他
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $rectal_touch;
	 public $_rectal_touch_type='varchar2';
	/**
 	 * 注释:肛门指诊其它|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $rectal_touch_other;
	 public $_rectal_touch_other_type='varchar2';
	/**
 	 * 注释:乳腺|radio|1=>未见异常,2=>乳房切除,3=>异常泌乳,4=>乳腺包块,5=>其他
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $mammary_gland;
	 public $_mammary_gland_type='varchar2';
	/**
 	 * 注释:乳腺其它|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $mammary_gland_other;
	 public $_mammary_gland_other_type='varchar2';
	/**
 	 * 注释:妇科外阴|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $gynae_vulva;
	 public $_gynae_vulva_type='varchar2';
	/**
 	 * 注释:妇科外阴异常|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $gynae_vulva_exception;
	 public $_gynae_vulva_exception_type='varchar2';
	/**
 	 * 注释:妇科阴道|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $gynae_cunt;
	 public $_gynae_cunt_type='varchar2';
	/**
 	 * 注释:妇科阴道异常|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $gynae_cunt_exception;
	 public $_gynae_cunt_exception_type='varchar2';
	/**
 	 * 注释:妇科宫颈|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $gynae_cervix;
	 public $_gynae_cervix_type='varchar2';
	/**
 	 * 注释:妇科宫颈异常|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $gynae_cervix_exception;
	 public $_gynae_cervix_exception_type='varchar2';
	/**
 	 * 注释:妇科宫体|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $gynae_uterus;
	 public $_gynae_uterus_type='varchar2';
	/**
 	 * 注释:妇科宫体异常|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $gynae_uterus_exception;
	 public $_gynae_uterus_exception_type='varchar2';
	/**
 	 * 注释:妇科附件|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $gynae_appendix;
	 public $_gynae_appendix_type='varchar2';
	/**
 	 * 注释:妇科附件异常|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $gynae_appendix_exception;
	 public $_gynae_appendix_exception_type='varchar2';
	/**
 	 * 注释:其它|text
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $others;
	 public $_others_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
}

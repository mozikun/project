<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tws_hrb03_08 extends dao_oracle{
	 public $__table = 'ws_hrb03_08';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ws_id;
	 public $_ws_id_type='number';
	/**
 	 * 注释:主键
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:创建时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $doctor_id;
	 public $_doctor_id_type='varchar2';
	/**
 	 * 注释:动作
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $action;
	 public $_action_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:身份证号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $identity_number;
	 public $_identity_number_type='varchar2';
	/**
 	 * 注释:精液检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_218;
	 public $_hrb03_08_218_type='varchar2';
	/**
 	 * 注释:全身计数器检查结果（Bq）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_219;
	 public $_hrb03_08_219_type='number';
	/**
 	 * 注释:膝反射检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_154;
	 public $_hrb03_08_154_type='varchar2';
	/**
 	 * 注释:嗅觉检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_155;
	 public $_hrb03_08_155_type='varchar2';
	/**
 	 * 注释:咽部检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_156;
	 public $_hrb03_08_156_type='varchar2';
	/**
 	 * 注释:肾脏检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_157;
	 public $_hrb03_08_157_type='varchar2';
	/**
 	 * 注释:皮疹部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_158;
	 public $_hrb03_08_158_type='varchar2';
	/**
 	 * 注释:皮肤萎缩部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_159;
	 public $_hrb03_08_159_type='varchar2';
	/**
 	 * 注释:皲裂部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_160;
	 public $_hrb03_08_160_type='varchar2';
	/**
 	 * 注释:疣状物部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_161;
	 public $_hrb03_08_161_type='varchar2';
	/**
 	 * 注释:色素沉着部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_162;
	 public $_hrb03_08_162_type='varchar2';
	/**
 	 * 注释:色素减退部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_163;
	 public $_hrb03_08_163_type='varchar2';
	/**
 	 * 注释:溃疡部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_164;
	 public $_hrb03_08_164_type='varchar2';
	/**
 	 * 注释:紫癜部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_165;
	 public $_hrb03_08_165_type='varchar2';
	/**
 	 * 注释:脱发部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_166;
	 public $_hrb03_08_166_type='varchar2';
	/**
 	 * 注释:脱毛部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_167;
	 public $_hrb03_08_167_type='varchar2';
	/**
 	 * 注释:脱屑部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_168;
	 public $_hrb03_08_168_type='varchar2';
	/**
 	 * 注释:左侧听力检测结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_169;
	 public $_hrb03_08_169_type='varchar2';
	/**
 	 * 注释:右侧听力检测结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_170;
	 public $_hrb03_08_170_type='varchar2';
	/**
 	 * 注释:视野检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_171;
	 public $_hrb03_08_171_type='varchar2';
	/**
 	 * 注释:眼底检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_172;
	 public $_hrb03_08_172_type='varchar2';
	/**
 	 * 注释:右眼矫正近视力值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_173;
	 public $_hrb03_08_173_type='number';
	/**
 	 * 注释:右眼矫正远视力值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_174;
	 public $_hrb03_08_174_type='number';
	/**
 	 * 注释:右眼裸眼近视力值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_175;
	 public $_hrb03_08_175_type='number';
	/**
 	 * 注释:右眼裸眼远视力值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_176;
	 public $_hrb03_08_176_type='number';
	/**
 	 * 注释:左眼矫正近视力值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_177;
	 public $_hrb03_08_177_type='number';
	/**
 	 * 注释:左眼矫正远视力值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_178;
	 public $_hrb03_08_178_type='number';
	/**
 	 * 注释:左眼裸眼近视力值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_179;
	 public $_hrb03_08_179_type='number';
	/**
 	 * 注释:左眼裸眼远视力值
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_180;
	 public $_hrb03_08_180_type='number';
	/**
 	 * 注释:白细胞计数值(G/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_181;
	 public $_hrb03_08_181_type='number';
	/**
 	 * 注释:红细胞计数值（G/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_182;
	 public $_hrb03_08_182_type='number';
	/**
 	 * 注释:淋巴细胞百分率（％）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_183;
	 public $_hrb03_08_183_type='number';
	/**
 	 * 注释:嗜碱性粒细胞百分率（％）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_184;
	 public $_hrb03_08_184_type='number';
	/**
 	 * 注释:嗜酸性粒细胞百分率（％）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_185;
	 public $_hrb03_08_185_type='number';
	/**
 	 * 注释:中性分叶核粒细胞百分率（％）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_186;
	 public $_hrb03_08_186_type='number';
	/**
 	 * 注释:中性杆状核粒细胞百分率（％）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_187;
	 public $_hrb03_08_187_type='number';
	/**
 	 * 注释:血胆碱酯酶活性（％）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_188;
	 public $_hrb03_08_188_type='number';
	/**
 	 * 注释:血红蛋白值（g/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_189;
	 public $_hrb03_08_189_type='number';
	/**
 	 * 注释:血尿素氮检测值(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_190;
	 public $_hrb03_08_190_type='number';
	/**
 	 * 注释:血铅检测值（nmol/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_191;
	 public $_hrb03_08_191_type='number';
	/**
 	 * 注释:血清肌酐检测值（μmol/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_192;
	 public $_hrb03_08_192_type='number';
	/**
 	 * 注释:血清总胆红素检测值（μmol/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_193;
	 public $_hrb03_08_193_type='number';
	/**
 	 * 注释:血糖检测值（mmol/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_194;
	 public $_hrb03_08_194_type='number';
	/**
 	 * 注释:血小板计数值(G/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_195;
	 public $_hrb03_08_195_type='number';
	/**
 	 * 注释:血锌原卟啉检测值（μmol/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_196;
	 public $_hrb03_08_196_type='number';
	/**
 	 * 注释:丙氨酸氨基转移酶检测值(U/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_197;
	 public $_hrb03_08_197_type='number';
	/**
 	 * 注释:促甲状腺激素检测值(mU/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_198;
	 public $_hrb03_08_198_type='number';
	/**
 	 * 注释:单核细胞检测值（G/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_199;
	 public $_hrb03_08_199_type='number';
	/**
 	 * 注释:睾丸酮检测值（nmol/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_200;
	 public $_hrb03_08_200_type='number';
	/**
 	 * 注释:甲状腺素检测值（nmol/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_201;
	 public $_hrb03_08_201_type='number';
	/**
 	 * 注释:尿白细胞计数值（个/H）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_202;
	 public $_hrb03_08_202_type='number';
	/**
 	 * 注释:游离三碘甲状腺原氨酸检测结果（pmol/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_203;
	 public $_hrb03_08_203_type='number';
	/**
 	 * 注释:尿常规镜检结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_204;
	 public $_hrb03_08_204_type='varchar2';
	/**
 	 * 注释:尿蛋白定量检测值（mg/24h）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_205;
	 public $_hrb03_08_205_type='number';
	/**
 	 * 注释:尿液外观
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_206;
	 public $_hrb03_08_206_type='varchar2';
	/**
 	 * 注释:尿管型检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_207;
	 public $_hrb03_08_207_type='varchar2';
	/**
 	 * 注释:尿糖定量检测(mmol/L)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_208;
	 public $_hrb03_08_208_type='number';
	/**
 	 * 注释:尿氟检测值（mg/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_209;
	 public $_hrb03_08_209_type='number';
	/**
 	 * 注释:尿镉检测值（μg/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_210;
	 public $_hrb03_08_210_type='number';
	/**
 	 * 注释:尿红细胞计数值（个/H）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_211;
	 public $_hrb03_08_211_type='number';
	/**
 	 * 注释:尿锰检测值（mg/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_212;
	 public $_hrb03_08_212_type='number';
	/**
 	 * 注释:尿铅检测值（μmol/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_213;
	 public $_hrb03_08_213_type='number';
	/**
 	 * 注释:尿砷检测值（mg/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_214;
	 public $_hrb03_08_214_type='number';
	/**
 	 * 注释:尿β２-微球蛋白值（mg/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_215;
	 public $_hrb03_08_215_type='number';
	/**
 	 * 注释:尿δ-氨基乙酰丙酸值（mg/L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_216;
	 public $_hrb03_08_216_type='number';
	/**
 	 * 注释:痰细胞学检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_217;
	 public $_hrb03_08_217_type='varchar2';
	/**
 	 * 注释:染色体畸变-类型
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_220;
	 public $_hrb03_08_220_type='varchar2';
	/**
 	 * 注释:染色体畸变-百分率（％）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_221;
	 public $_hrb03_08_221_type='number';
	/**
 	 * 注释:染色体畸变-数量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_222;
	 public $_hrb03_08_222_type='number';
	/**
 	 * 注释:染色体中期分裂细胞数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_223;
	 public $_hrb03_08_223_type='number';
	/**
 	 * 注释:微核淋巴细胞千分比（‰）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_224;
	 public $_hrb03_08_224_type='number';
	/**
 	 * 注释:淋巴细胞微核千分比（‰）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_225;
	 public $_hrb03_08_225_type='number';
	/**
 	 * 注释:乙型肝炎病毒e抗体检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_226;
	 public $_hrb03_08_226_type='varchar2';
	/**
 	 * 注释:乙型肝炎病毒e抗原检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_227;
	 public $_hrb03_08_227_type='varchar2';
	/**
 	 * 注释:乙型肝炎病毒e抗原检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_228;
	 public $_hrb03_08_228_type='varchar2';
	/**
 	 * 注释:乙型肝炎病毒表面抗体检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_229;
	 public $_hrb03_08_229_type='varchar2';
	/**
 	 * 注释:乙型肝炎病毒表面抗原检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_230;
	 public $_hrb03_08_230_type='varchar2';
	/**
 	 * 注释:乙型肝炎病毒核心抗体检测结果代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_231;
	 public $_hrb03_08_231_type='varchar2';
	/**
 	 * 注释:最大肺活量（L）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_232;
	 public $_hrb03_08_232_type='number';
	/**
 	 * 注释:一秒钟用力呼气量（ml）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_233;
	 public $_hrb03_08_233_type='number';
	/**
 	 * 注释:一秒钟用力呼气量/最大肺活量百分比（%）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_234;
	 public $_hrb03_08_234_type='number';
	/**
 	 * 注释:腹部B超检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_235;
	 public $_hrb03_08_235_type='varchar2';
	/**
 	 * 注释:脑电图检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_236;
	 public $_hrb03_08_236_type='varchar2';
	/**
 	 * 注释:听觉诱发电位检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_237;
	 public $_hrb03_08_237_type='varchar2';
	/**
 	 * 注释:视觉诱发电位检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_238;
	 public $_hrb03_08_238_type='varchar2';
	/**
 	 * 注释:神经肌电图检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_239;
	 public $_hrb03_08_239_type='varchar2';
	/**
 	 * 注释:心电图检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_240;
	 public $_hrb03_08_240_type='varchar2';
	/**
 	 * 注释:心功能检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_241;
	 public $_hrb03_08_241_type='varchar2';
	/**
 	 * 注释:胸部X线检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_242;
	 public $_hrb03_08_242_type='varchar2';
	/**
 	 * 注释:受照剂量（Gy）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_243;
	 public $_hrb03_08_243_type='number';
	/**
 	 * 注释:职业健康检查结论代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_244;
	 public $_hrb03_08_244_type='varchar2';
	/**
 	 * 注释:职业病名称代码
	 * 
	 * 
	 * @var VARCHAR2(21)
	 **/
 	 public $hrb03_08_245;
	 public $_hrb03_08_245_type='varchar2';
	/**
 	 * 注释:检查（测）人员姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_08_246;
	 public $_hrb03_08_246_type='varchar2';
	/**
 	 * 注释:检查（测）机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_08_247;
	 public $_hrb03_08_247_type='varchar2';
	/**
 	 * 注释:诊断机构名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_08_248;
	 public $_hrb03_08_248_type='varchar2';
	/**
 	 * 注释:检查（测）日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_08_249;
	 public $_hrb03_08_249_type='date';
	/**
 	 * 注释:诊断日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_08_250;
	 public $_hrb03_08_250_type='date';
	/**
 	 * 注释:记录表单编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_08_001;
	 public $_hrb03_08_001_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_08_002;
	 public $_hrb03_08_002_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_003;
	 public $_hrb03_08_003_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_08_004;
	 public $_hrb03_08_004_type='date';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_005;
	 public $_hrb03_08_005_type='varchar2';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(54)
	 **/
 	 public $hrb03_08_006;
	 public $_hrb03_08_006_type='varchar2';
	/**
 	 * 注释:文化程度代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_08_007;
	 public $_hrb03_08_007_type='varchar2';
	/**
 	 * 注释:民族代码
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $hrb03_08_008;
	 public $_hrb03_08_008_type='varchar2';
	/**
 	 * 注释:婚姻状况类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_009;
	 public $_hrb03_08_009_type='varchar2';
	/**
 	 * 注释:结婚日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_08_010;
	 public $_hrb03_08_010_type='date';
	/**
 	 * 注释:联系电话-类别
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_08_011;
	 public $_hrb03_08_011_type='varchar2';
	/**
 	 * 注释:联系电话-类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_012;
	 public $_hrb03_08_012_type='varchar2';
	/**
 	 * 注释:联系电话-号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_08_013;
	 public $_hrb03_08_013_type='varchar2';
	/**
 	 * 注释:工作单位名称
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $hrb03_08_014;
	 public $_hrb03_08_014_type='varchar2';
	/**
 	 * 注释:配偶职业类别代码(国标)
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $hrb03_08_015;
	 public $_hrb03_08_015_type='varchar2';
	/**
 	 * 注释:地址类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_016;
	 public $_hrb03_08_016_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb03_08_017;
	 public $_hrb03_08_017_type='varchar2';
	/**
 	 * 注释:地址-省（自治区、直辖市）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_08_018;
	 public $_hrb03_08_018_type='varchar2';
	/**
 	 * 注释:地址-市（地区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_08_019;
	 public $_hrb03_08_019_type='varchar2';
	/**
 	 * 注释:地址-县（区）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_08_020;
	 public $_hrb03_08_020_type='varchar2';
	/**
 	 * 注释:地址-村（街、路、弄等）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_08_022;
	 public $_hrb03_08_022_type='varchar2';
	/**
 	 * 注释:地址-门牌号码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hrb03_08_023;
	 public $_hrb03_08_023_type='varchar2';
	/**
 	 * 注释:邮政编码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $hrb03_08_024;
	 public $_hrb03_08_024_type='varchar2';
	/**
 	 * 注释:体检类别代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_025;
	 public $_hrb03_08_025_type='varchar2';
	/**
 	 * 注释:初潮年龄（岁）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_026;
	 public $_hrb03_08_026_type='number';
	/**
 	 * 注释:绝经年龄（岁）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_027;
	 public $_hrb03_08_027_type='number';
	/**
 	 * 注释:月经周期（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_028;
	 public $_hrb03_08_028_type='number';
	/**
 	 * 注释:月经持续时间（d）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_029;
	 public $_hrb03_08_029_type='number';
	/**
 	 * 注释:月经异常标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_030;
	 public $_hrb03_08_030_type='number';
	/**
 	 * 注释:早产次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_031;
	 public $_hrb03_08_031_type='number';
	/**
 	 * 注释:异常胎次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_032;
	 public $_hrb03_08_032_type='number';
	/**
 	 * 注释:流产总次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_033;
	 public $_hrb03_08_033_type='number';
	/**
 	 * 注释:现有子女数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_034;
	 public $_hrb03_08_034_type='number';
	/**
 	 * 注释:过量照射史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_035;
	 public $_hrb03_08_035_type='varchar2';
	/**
 	 * 注释:既往疾病史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_036;
	 public $_hrb03_08_036_type='varchar2';
	/**
 	 * 注释:家族遗传性疾病史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_037;
	 public $_hrb03_08_037_type='varchar2';
	/**
 	 * 注释:非放射工作职业史
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_038;
	 public $_hrb03_08_038_type='varchar2';
	/**
 	 * 注释:吸烟标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_039;
	 public $_hrb03_08_039_type='number';
	/**
 	 * 注释:日吸烟量(支)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_040;
	 public $_hrb03_08_040_type='number';
	/**
 	 * 注释:吸烟时长（年）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_041;
	 public $_hrb03_08_041_type='number';
	/**
 	 * 注释:饮酒标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_042;
	 public $_hrb03_08_042_type='number';
	/**
 	 * 注释:日饮酒量(两)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_043;
	 public $_hrb03_08_043_type='number';
	/**
 	 * 注释:饮酒时长（年）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_044;
	 public $_hrb03_08_044_type='number';
	/**
 	 * 注释:从事毒害职业开始日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_08_045;
	 public $_hrb03_08_045_type='date';
	/**
 	 * 注释:从事毒害职业终止日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $hrb03_08_046;
	 public $_hrb03_08_046_type='date';
	/**
 	 * 注释:每日工作时长（h）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_047;
	 public $_hrb03_08_047_type='number';
	/**
 	 * 注释:射线装置种类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_048;
	 public $_hrb03_08_048_type='varchar2';
	/**
 	 * 注释:配偶健康状况
	 * 
	 * 
	 * @var VARCHAR2(90)
	 **/
 	 public $hrb03_08_049;
	 public $_hrb03_08_049_type='varchar2';
	/**
 	 * 注释:鼻堵标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_050;
	 public $_hrb03_08_050_type='number';
	/**
 	 * 注释:便秘标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_051;
	 public $_hrb03_08_051_type='number';
	/**
 	 * 注释:盗汗标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_052;
	 public $_hrb03_08_052_type='number';
	/**
 	 * 注释:动作不灵活标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_053;
	 public $_hrb03_08_053_type='number';
	/**
 	 * 注释:多汗-标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_054;
	 public $_hrb03_08_054_type='number';
	/**
 	 * 注释:多汗-部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_055;
	 public $_hrb03_08_055_type='varchar2';
	/**
 	 * 注释:多梦标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_056;
	 public $_hrb03_08_056_type='number';
	/**
 	 * 注释:恶心标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_057;
	 public $_hrb03_08_057_type='number';
	/**
 	 * 注释:耳鸣标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_058;
	 public $_hrb03_08_058_type='number';
	/**
 	 * 注释:腹痛标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_059;
	 public $_hrb03_08_059_type='number';
	/**
 	 * 注释:腹泻标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_060;
	 public $_hrb03_08_060_type='number';
	/**
 	 * 注释:腹胀标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_061;
	 public $_hrb03_08_061_type='number';
	/**
 	 * 注释:咯血标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_062;
	 public $_hrb03_08_062_type='number';
	/**
 	 * 注释:关节痛标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_063;
	 public $_hrb03_08_063_type='number';
	/**
 	 * 注释:记忆力减退标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_064;
	 public $_hrb03_08_064_type='number';
	/**
 	 * 注释:咳嗽标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_065;
	 public $_hrb03_08_065_type='number';
	/**
 	 * 注释:咳痰标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_066;
	 public $_hrb03_08_066_type='number';
	/**
 	 * 注释:口渴标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_067;
	 public $_hrb03_08_067_type='number';
	/**
 	 * 注释:流泪标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_068;
	 public $_hrb03_08_068_type='number';
	/**
 	 * 注释:流涕标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_069;
	 public $_hrb03_08_069_type='number';
	/**
 	 * 注释:流涎标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_070;
	 public $_hrb03_08_070_type='number';
	/**
 	 * 注释:尿急标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_071;
	 public $_hrb03_08_071_type='number';
	/**
 	 * 注释:尿频标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_072;
	 public $_hrb03_08_072_type='number';
	/**
 	 * 注释:尿血标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_073;
	 public $_hrb03_08_073_type='number';
	/**
 	 * 注释:呕吐标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_074;
	 public $_hrb03_08_074_type='number';
	/**
 	 * 注释:配偶接触放射线情况
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_075;
	 public $_hrb03_08_075_type='varchar2';
	/**
 	 * 注释:疲乏无力标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_076;
	 public $_hrb03_08_076_type='number';
	/**
 	 * 注释:皮肤瘙痒标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_077;
	 public $_hrb03_08_077_type='number';
	/**
 	 * 注释:全身酸痛标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_078;
	 public $_hrb03_08_078_type='number';
	/**
 	 * 注释:失眠标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_079;
	 public $_hrb03_08_079_type='number';
	/**
 	 * 注释:食欲减退标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_080;
	 public $_hrb03_08_080_type='number';
	/**
 	 * 注释:视力下降标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_081;
	 public $_hrb03_08_081_type='number';
	/**
 	 * 注释:视物模糊标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_082;
	 public $_hrb03_08_082_type='number';
	/**
 	 * 注释:嗜睡标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_083;
	 public $_hrb03_08_083_type='number';
	/**
 	 * 注释:刷牙出血标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_084;
	 public $_hrb03_08_084_type='number';
	/**
 	 * 注释:死产例数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_085;
	 public $_hrb03_08_085_type='number';
	/**
 	 * 注释:四肢麻木标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_086;
	 public $_hrb03_08_086_type='number';
	/**
 	 * 注释:头昏标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_087;
	 public $_hrb03_08_087_type='number';
	/**
 	 * 注释:头痛标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_088;
	 public $_hrb03_08_088_type='number';
	/**
 	 * 注释:哮喘标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_089;
	 public $_hrb03_08_089_type='number';
	/**
 	 * 注释:心悸标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_090;
	 public $_hrb03_08_090_type='number';
	/**
 	 * 注释:心前区不适标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_091;
	 public $_hrb03_08_091_type='number';
	/**
 	 * 注释:性欲减退标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_092;
	 public $_hrb03_08_092_type='number';
	/**
 	 * 注释:胸闷标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_093;
	 public $_hrb03_08_093_type='number';
	/**
 	 * 注释:胸痛标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_094;
	 public $_hrb03_08_094_type='number';
	/**
 	 * 注释:羞明标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_095;
	 public $_hrb03_08_095_type='number';
	/**
 	 * 注释:嗅觉减退标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_096;
	 public $_hrb03_08_096_type='number';
	/**
 	 * 注释:眩晕标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_097;
	 public $_hrb03_08_097_type='number';
	/**
 	 * 注释:牙齿松动标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_098;
	 public $_hrb03_08_098_type='number';
	/**
 	 * 注释:牙痛标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_099;
	 public $_hrb03_08_099_type='number';
	/**
 	 * 注释:咽痛标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_100;
	 public $_hrb03_08_100_type='number';
	/**
 	 * 注释:眼痛标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_101;
	 public $_hrb03_08_101_type='number';
	/**
 	 * 注释:易激动标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_102;
	 public $_hrb03_08_102_type='number';
	/**
 	 * 注释:职业照射种类代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_103;
	 public $_hrb03_08_103_type='varchar2';
	/**
 	 * 注释:一般状况检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_104;
	 public $_hrb03_08_104_type='varchar2';
	/**
 	 * 注释:身高(cm)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_105;
	 public $_hrb03_08_105_type='number';
	/**
 	 * 注释:体重（kg）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_106;
	 public $_hrb03_08_106_type='number';
	/**
 	 * 注释:呼吸频率（次/分钟）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_107;
	 public $_hrb03_08_107_type='number';
	/**
 	 * 注释:脉率（次/分钟）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_108;
	 public $_hrb03_08_108_type='number';
	/**
 	 * 注释:收缩压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_109;
	 public $_hrb03_08_109_type='number';
	/**
 	 * 注释:舒张压(mmHg)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_110;
	 public $_hrb03_08_110_type='number';
	/**
 	 * 注释:四肢检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_111;
	 public $_hrb03_08_111_type='varchar2';
	/**
 	 * 注释:发育程度代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_112;
	 public $_hrb03_08_112_type='varchar2';
	/**
 	 * 注释:营养状态代码
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $hrb03_08_113;
	 public $_hrb03_08_113_type='varchar2';
	/**
 	 * 注释:感觉异常
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_114;
	 public $_hrb03_08_114_type='varchar2';
	/**
 	 * 注释:心律
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_115;
	 public $_hrb03_08_115_type='varchar2';
	/**
 	 * 注释:心率（次/分钟）
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_116;
	 public $_hrb03_08_116_type='number';
	/**
 	 * 注释:心脏听诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_117;
	 public $_hrb03_08_117_type='varchar2';
	/**
 	 * 注释:病理反射检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_118;
	 public $_hrb03_08_118_type='varchar2';
	/**
 	 * 注释:玻璃体检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_119;
	 public $_hrb03_08_119_type='varchar2';
	/**
 	 * 注释:鼻部检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_120;
	 public $_hrb03_08_120_type='varchar2';
	/**
 	 * 注释:鼻干标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_121;
	 public $_hrb03_08_121_type='number';
	/**
 	 * 注释:鼻血标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_122;
	 public $_hrb03_08_122_type='number';
	/**
 	 * 注释:低热标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_123;
	 public $_hrb03_08_123_type='number';
	/**
 	 * 注释:耳聋标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_124;
	 public $_hrb03_08_124_type='number';
	/**
 	 * 注释:气短标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_125;
	 public $_hrb03_08_125_type='number';
	/**
 	 * 注释:浮肿标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_126;
	 public $_hrb03_08_126_type='number';
	/**
 	 * 注释:肝区痛标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_127;
	 public $_hrb03_08_127_type='number';
	/**
 	 * 注释:口腔溃疡标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_128;
	 public $_hrb03_08_128_type='number';
	/**
 	 * 注释:消瘦标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_129;
	 public $_hrb03_08_129_type='number';
	/**
 	 * 注释:脱发标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_130;
	 public $_hrb03_08_130_type='number';
	/**
 	 * 注释:肾区叩痛标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_131;
	 public $_hrb03_08_131_type='number';
	/**
 	 * 注释:皮疹标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_132;
	 public $_hrb03_08_132_type='number';
	/**
 	 * 注释:口腔异味标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_133;
	 public $_hrb03_08_133_type='number';
	/**
 	 * 注释:皮下出血标志
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hrb03_08_134;
	 public $_hrb03_08_134_type='number';
	/**
 	 * 注释:肝脏触诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_135;
	 public $_hrb03_08_135_type='varchar2';
	/**
 	 * 注释:肺部听诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_136;
	 public $_hrb03_08_136_type='varchar2';
	/**
 	 * 注释:跟腱反射检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_137;
	 public $_hrb03_08_137_type='varchar2';
	/**
 	 * 注释:共济运动检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_138;
	 public $_hrb03_08_138_type='varchar2';
	/**
 	 * 注释:干燥部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_139;
	 public $_hrb03_08_139_type='varchar2';
	/**
 	 * 注释:过度角化部位
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_140;
	 public $_hrb03_08_140_type='varchar2';
	/**
 	 * 注释:肌力检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_141;
	 public $_hrb03_08_141_type='varchar2';
	/**
 	 * 注释:肌张力检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_142;
	 public $_hrb03_08_142_type='varchar2';
	/**
 	 * 注释:脊柱检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_143;
	 public $_hrb03_08_143_type='varchar2';
	/**
 	 * 注释:甲状腺检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_144;
	 public $_hrb03_08_144_type='varchar2';
	/**
 	 * 注释:晶体裂隙灯检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_145;
	 public $_hrb03_08_145_type='varchar2';
	/**
 	 * 注释:皮肤和粘膜检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_146;
	 public $_hrb03_08_146_type='varchar2';
	/**
 	 * 注释:脾脏触诊结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_147;
	 public $_hrb03_08_147_type='varchar2';
	/**
 	 * 注释:皮肤划纹症检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_148;
	 public $_hrb03_08_148_type='varchar2';
	/**
 	 * 注释:浅表淋巴结检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_149;
	 public $_hrb03_08_149_type='varchar2';
	/**
 	 * 注释:三颤检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_150;
	 public $_hrb03_08_150_type='varchar2';
	/**
 	 * 注释:色觉检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_151;
	 public $_hrb03_08_151_type='varchar2';
	/**
 	 * 注释:口腔检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_152;
	 public $_hrb03_08_152_type='varchar2';
	/**
 	 * 注释:指甲检查结果
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $hrb03_08_153;
	 public $_hrb03_08_153_type='varchar2';
}

<?php
require_once ('db_mysql.php');
/**
 * 注释:Array
 *
 * @var 
 */
class Tlbs_result extends dao_mysql
{
    public $__table = 'lbs_result';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $maslbsid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_maslbsid='lbs_result.maslbsid';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $silbsid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_silbsid='lbs_result.silbsid';
    /**
     * 注释:
     *
     * @var varchar(20)
     */
    public $msisdn;
    /**
     * 注释:
     *
     * @var varchar(20)
     */
    public $_msisdn='lbs_result.msisdn';
    /**
     * 注释:
     *
     * @var datetime
     */
    public $requesttime;
    /**
     * 注释:
     *
     * @var datetime
     */
    public $_requesttime='lbs_result.requesttime';
    /**
     * 注释:
     *
     * @var datetime
     */
    public $updatetime;
    /**
     * 注释:
     *
     * @var datetime
     */
    public $_updatetime='lbs_result.updatetime';
    /**
     * 注释:
     *
     * @var varchar(10)
     */
    public $errorcode;
    /**
     * 注释:
     *
     * @var varchar(10)
     */
    public $_errorcode='lbs_result.errorcode';
    /**
     * 注释:
     *
     * @var varchar(500)
     */
    public $errormessage;
    /**
     * 注释:
     *
     * @var varchar(500)
     */
    public $_errormessage='lbs_result.errormessage';
    /**
     * 注释:
     *
     * @var varchar(40)
     */
    public $longtitude;
    /**
     * 注释:
     *
     * @var varchar(40)
     */
    public $_longtitude='lbs_result.longtitude';
    /**
     * 注释:
     *
     * @var varchar(40)
     */
    public $latitude;
    /**
     * 注释:
     *
     * @var varchar(40)
     */
    public $_latitude='lbs_result.latitude';
    /**
     * 注释:
     *
     * @var varchar(40)
     */
    public $altitude;
    /**
     * 注释:
     *
     * @var varchar(40)
     */
    public $_altitude='lbs_result.altitude';
    /**
     * 注释:
     *
     * @var varchar(40)
     */
    public $accuracy;
    /**
     * 注释:
     *
     * @var varchar(40)
     */
    public $_accuracy='lbs_result.accuracy';
    /**
     * 注释:
     *
     * @var varchar(16)
     */
    public $applicationid;
    /**
     * 注释:
     *
     * @var varchar(16)
     */
    public $_applicationid='lbs_result.applicationid';
}

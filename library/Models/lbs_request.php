<?php
require_once ('db_mysql.php');
/**
 * 注释:Array
 *
 * @var 
 */
class Tlbs_request extends dao_mysql
{
    public $__table = 'lbs_request';
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
    public $_silbsid='lbs_request.silbsid';
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
    public $_msisdn='lbs_request.msisdn';
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
    public $_requesttime='lbs_request.requesttime';
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $loctype;
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $_loctype='lbs_request.loctype';
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $periodic;
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $_periodic='lbs_request.periodic';
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $frequency;
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $_frequency='lbs_request.frequency';
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $duration;
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $_duration='lbs_request.duration';
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $requestedaccuracy;
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $_requestedaccuracy='lbs_request.requestedaccuracy';
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $acceptableaccuracy;
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $_acceptableaccuracy='lbs_request.acceptableaccuracy';
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $maximumage;
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $_maximumage='lbs_request.maximumage';
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $responsetime;
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $_responsetime='lbs_request.responsetime';
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
    public $_applicationid='lbs_request.applicationid';
}

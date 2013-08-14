<?php
require_once ('db_mysql.php');
/**
 * 注释:Array
 *
 * @var 
 */
class Tsms_sent extends dao_mysql
{
    public $__table = 'sms_sent';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $massmsid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_massmsid='sms_sent.massmsid';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $gwsmsid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_gwsmsid='sms_sent.gwsmsid';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $sismsid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_sismsid='sms_sent.sismsid';
    /**
     * 注释:
     *
     * @var varchar(21)
     */
    public $extcode;
    /**
     * 注释:
     *
     * @var varchar(21)
     */
    public $_extcode='sms_sent.extcode';
    /**
     * 注释:
     *
     * @var varchar(21)
     */
    public $destaddr;
    /**
     * 注释:
     *
     * @var varchar(21)
     */
    public $_destaddr='sms_sent.destaddr';
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
    public $_requesttime='sms_sent.requesttime';
    /**
     * 注释:
     *
     * @var datetime
     */
    public $senttime;
    /**
     * 注释:
     *
     * @var datetime
     */
    public $_senttime='sms_sent.senttime';
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $sentresult;
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $_sentresult='sms_sent.sentresult';
    /**
     * 注释:
     *
     * @var varchar(20)
     */
    public $smsstatus;
    /**
     * 注释:
     *
     * @var varchar(20)
     */
    public $_smsstatus='sms_sent.smsstatus';
    /**
     * 注释:
     *
     * @var datetime
     */
    public $statustime;
    /**
     * 注释:
     *
     * @var datetime
     */
    public $_statustime='sms_sent.statustime';
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
    public $_applicationid='sms_sent.applicationid';
}

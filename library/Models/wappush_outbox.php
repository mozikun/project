<?php
require_once ('db_mysql.php');
/**
 * 注释:Array
 *
 * @var 
 */
class Twappush_outbox extends dao_mysql
{
    public $__table = 'wappush_outbox';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $siwappushid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_siwappushid='wappush_outbox.siwappushid';
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
    public $_extcode='wappush_outbox.extcode';
    /**
     * 注释:
     *
     * @var varchar(2000)
     */
    public $destaddr;
    /**
     * 注释:
     *
     * @var varchar(2000)
     */
    public $_destaddr='wappush_outbox.destaddr';
    /**
     * 注释:
     *
     * @var varchar(500)
     */
    public $subject;
    /**
     * 注释:
     *
     * @var varchar(500)
     */
    public $_subject='wappush_outbox.subject';
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $reqdeliveryreport;
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $_reqdeliveryreport='wappush_outbox.reqdeliveryreport';
    /**
     * 注释:
     *
     * @var varchar(500)
     */
    public $targeturl;
    /**
     * 注释:
     *
     * @var varchar(500)
     */
    public $_targeturl='wappush_outbox.targeturl';
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
    public $_requesttime='wappush_outbox.requesttime';
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
    public $_applicationid='wappush_outbox.applicationid';
}

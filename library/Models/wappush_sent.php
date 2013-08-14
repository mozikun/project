<?php
require_once ('db_mysql.php');
/**
 * 注释:Array
 *
 * @var 
 */
class Twappush_sent extends dao_mysql
{
    public $__table = 'wappush_sent';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $maswappushid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_maswappushid='wappush_sent.maswappushid';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $gwwappushid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_gwwappushid='wappush_sent.gwwappushid';
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
    public $_siwappushid='wappush_sent.siwappushid';
    /**
     * 注释:
     *
     * @var varchar(20)
     */
    public $extcode;
    /**
     * 注释:
     *
     * @var varchar(20)
     */
    public $_extcode='wappush_sent.extcode';
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
    public $_destaddr='wappush_sent.destaddr';
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
    public $_requesttime='wappush_sent.requesttime';
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
    public $_senttime='wappush_sent.senttime';
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
    public $_sentresult='wappush_sent.sentresult';
    /**
     * 注释:
     *
     * @var varchar(20)
     */
    public $wappushstatus;
    /**
     * 注释:
     *
     * @var varchar(20)
     */
    public $_wappushstatus='wappush_sent.wappushstatus';
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
    public $_statustime='wappush_sent.statustime';
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
    public $_applicationid='wappush_sent.applicationid';
}

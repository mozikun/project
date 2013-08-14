<?php
require_once ('db_mysql.php');
/**
 * 注释:Array
 *
 * @var 
 */
class Tmms_sent extends dao_mysql
{
    public $__table = 'mms_sent';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $masmmsid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_masmmsid='mms_sent.masmmsid';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $gwmmsid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_gwmmsid='mms_sent.gwmmsid';
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $simmsid;
    /**
     * 注释:
     *
     * @var varchar(50)
     */
    public $_simmsid='mms_sent.simmsid';
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
    public $_destaddr='mms_sent.destaddr';
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
    public $_senttime='mms_sent.senttime';
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
    public $_sentresult='mms_sent.sentresult';
    /**
     * 注释:
     *
     * @var varchar(40)
     */
    public $mmsstatus;
    /**
     * 注释:
     *
     * @var varchar(40)
     */
    public $_mmsstatus='mms_sent.mmsstatus';
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
    public $_statustime='mms_sent.statustime';
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
    public $_applicationid='mms_sent.applicationid';
}

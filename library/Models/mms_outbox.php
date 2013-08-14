<?php
require_once ('db_mysql.php');
/**
 * 注释:Array
 *
 * @var 
 */
class Tmms_outbox extends dao_mysql
{
    public $__table = 'mms_outbox';
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
    public $_simmsid='mms_outbox.simmsid';
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
    public $_extcode='mms_outbox.extcode';
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
    public $_destaddr='mms_outbox.destaddr';
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
    public $_reqdeliveryreport='mms_outbox.reqdeliveryreport';
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
    public $_subject='mms_outbox.subject';
    /**
     * 注释:
     *
     * @var blob
     */
    public $messagecontent;
    /**
     * 注释:
     *
     * @var blob
     */
    public $_messagecontent='mms_outbox.messagecontent';
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
    public $_requesttime='mms_outbox.requesttime';
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
    public $_applicationid='mms_outbox.applicationid';
}

<?php
require_once ('db_mysql.php');
/**
 * 注释:Array
 *
 * @var 
 */
class Tsms_outbox extends dao_mysql
{
    public $__table = 'sms_outbox';
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
    public $_sismsid='sms_outbox.sismsid';
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
    public $_extcode='sms_outbox.extcode';
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
    public $_destaddr='sms_outbox.destaddr';
    /**
     * 注释:
     *
     * @var varchar(2000)
     */
    public $messagecontent;
    /**
     * 注释:
     *
     * @var varchar(2000)
     */
    public $_messagecontent='sms_outbox.messagecontent';
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
    public $_reqdeliveryreport='sms_outbox.reqdeliveryreport';
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $msgfmt;
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $_msgfmt='sms_outbox.msgfmt';
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $sendmethod;
    /**
     * 注释:
     *
     * @var int(11)
     */
    public $_sendmethod='sms_outbox.sendmethod';
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
    public $_requesttime='sms_outbox.requesttime';
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
    public $_applicationid='sms_outbox.applicationid';
}
